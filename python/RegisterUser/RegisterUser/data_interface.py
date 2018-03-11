from django.http import HttpResponse;
from django.shortcuts import render_to_response;
from RegisterUser.database.fdatabase import *;
import time;
import json;
import pymssql;

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
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		#查询当前用户是否的好友
		sql_str = "select * from users";#select users.* from (select DISTINCT(user2) from user_friend_relation where user_friend_relation.user1="+user_id+") AS result LEFT JOIN users on users.id=result.user2 order by is_login desc";
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
		sql_str = "select * from message where (send_id="+self_id+" and receive_id="+user_id+") or (send_id="+user_id+" and receive_id="+self_id+") ORDER BY date asc";
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