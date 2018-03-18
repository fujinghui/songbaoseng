from django.http import HttpResponse;
from django.shortcuts import render_to_response;
from RegisterUser.database.fdatabase import *;

from django.views.decorators.csrf import csrf_exempt
import time;
import json;
import pymssql;
import os;
import md5;

#将一个对象转换成Response json
def getResponseJson(message):
	return HttpResponse(json.dumps(message, ensure_ascii=False), content_type="application/json");
#返回消息
def getJson(message):
	return json.dumps(message, ensure_ascii=False);
def query(sql):
	fdb = FDataBase();
	cur = fdb.cur;
	cur.execute(sql);
	return cur.fetchall();
def insert(sql,param):
	fdb = FDataBase();
	cur = fdb.cur;
	cur.execute(sql, param);
	fdb.conn.commit();
	
	
#获取好友列表
def get_friends(request):
	user_id = request.POST.get("user_id") or request.GET.get('user_id');
	user_id = str(user_id);
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		#查询当前用户是否的好友
		sql_str = "select users.* from (select DISTINCT(user2) from user_friend_relation where user_friend_relation.user1="+user_id+") AS result LEFT JOIN users on users.id=result.user2 order by is_login desc";
		ret1 = query(sql_str);
		message['data'] = ret1;
	else:
		pass;
	return getResponseJson(message);

#获取好友消息
def get_message(request):
	#当前已登录用户的id
	self_id = str(request.session.get("id"));
	#对方的id
	user_id = request.POST.get("user_id") or request.GET.get("user_id");
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		sql_str = "select message.*,users.name from message left join users on message.send_id=users.id  and ((message.send_id="+self_id+" and message.receive_id="+user_id+") or (message.send_id="+user_id+" and message.receive_id="+self_id+")) ORDER BY message.date asc";
		message['data'] = query(sql_str);
	else:
		pass;
	
	#将获取的消息写入文件中去
	#file = open("test.txt", "w");
	#file.write(str(message).encode("latin1").decode("utf-8"));
	#file.close();
	
	return getResponseJson(message);
#获取用户信息
def get_user_info(request):
	user_id = request.POST.get("user_id") or request.GET.get("user_id");
	user_id = str(user_id);
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		sql_str = "select * from users where id="+user_id;
		message['data'] = query(sql_str);
	else:
		pass;
	return getResponseJson(message);

#发送消息
def send_message(request):
	self_id = request.session.get("id");
	user_id = request.POST.get("user_id") or request.GET.get("user_id");
	send_message = request.POST.get("message") or request.GET.get("message");
	user_id = int(user_id);
	
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		sql_str = "insert into message(send_id, receive_id, message, is_send, date) values(%d,%d,%s,%d,%d)";
		value = (self_id,user_id,send_message,0,int(time.time()));
		insert(sql_str, value);
	else:
		pass;
	return getResponseJson(message);
#获取所有的房间号码
def get_groups(request):
	id = request.session.get("id");
	id = str(id);
	#user_id = string(user_id);
	#sql_str = "select group_im.* from group_im LEFT JOIN group_user on group_user.user_id="+id+" and group_user.group_id=group_im.id";
	sql_str = "select group_im.* from group_im,group_user where group_user.group_id=group_im.id and group_user.user_id="+id;
	message = {"code":200, "msg":"", "data":None};
	ret = query(sql_str);
	message['data'] = ret;
	return getResponseJson(message);
#获取该群下的消息
def get_group_message(request):
	id = request.POST.get("group_id") or request.GET.get("group_id");
	sql_str = "SELECT group_message.id, group_message.send_id, 0 AS receive_id, group_message.message, 0 AS is_send, group_message.[date],group_message.is_image, users.name FROM group_message left join users on group_message.send_id = users.id where group_message.group_id="+id+" ORDER BY group_message.date asc";
	ret = query(sql_str);
	message = {"code":200, "msg":"", "data":None};
	message['data'] = ret;
	return getResponseJson(message);
#获取该群的成员
def get_group_mitglieder(request):
	id = request.POST.get("group_id") or request.GET.get("group_id");
	id = str(id);
	sql_str = "select users.* from group_user left join users on group_user.user_id=users.id where group_id="+id;
	ret = query(sql_str);
	message = {"code":200, "msg":"", "data":None};
	message['data'] = ret;
	return getResponseJson(message);
#上传图片
@csrf_exempt
def upload_file(request):
	isGroup = request.POST.get("isGroup") or request.GET.get("isGroup");
	user_id = request.POST.get("user_id") or request.GET.get("user_id");
	friend_id = request.POST.get("friend_id") or request.GET.get("friend_id");
	image_file = request.FILES["image_file"];
	message = {"code":200, "msg":"", "data":None};
	if image_file is None:
		message['code'] = 201;
		message['msg'] = "没有选择文件";
	else:
		timeChuo = time.time();
		filename = str(image_file);
		m1 = md5.new();
		m1.update(filename+str(timeChuo));
		filename = m1.hexdigest();
		
		path = './static/image/im_image/';
		if not os.path.exists(path):
			os.makedirs(path);
		with open(path+filename, "wb+") as destination:
			for chunk in image_file.chunks():
				destination.write(chunk);
			destination.close();
		message['data'] = [filename];									#返回文件名
	return getResponseJson(message);

