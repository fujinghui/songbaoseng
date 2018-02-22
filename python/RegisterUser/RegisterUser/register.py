# -*- coding: utf-8 -*-
from django.http import HttpResponse;
from django.shortcuts import render_to_response;
from RegisterUser.database.fdatabase import *;
import json;
import pymssql;

def logout(request):
	request.session['user'] = None;
	return HttpResponse("注销成功！", content_type="application/json");

def register_html(request):
	return render_to_response('form.html');

def login(request):
	request.encoding = 'utf-8';
	name = request.GET.get('name');
	password = request.GET.get('password');
	message = {"status":200, "msg":""};
	if name is None or password is None:
		message['status'] = 501;
		message['msg'] = "参数错误";
	else:
		fdb = FDataBase();
		cur = fdb.cur;
		sql_str = "select * from users where name='"+name+"' and password='"+password+"'";
		cur.execute(sql_str);
		ret = cur.fetchall();
		if len(ret) >= 1:
			request.session['id'] = ret[0][0];
			request.session['name'] = name;
			request.session['password'] = password;
			request.session['user'] = True;
			message['msg'] = "登录成功！";
			pass;
		else:
			message['status'] = 404;
			message['msg'] = "登录失败！";
		return HttpResponse(json.dumps(message, ensure_ascii=False), content_type="application/json");
def register(request):
	request.encoding = 'utf-8';
	name = request.GET.get('name');
	password = request.GET.get('password');
	message = {"status":200, "msg":""};
	if name is None or password is None:
		message['status'] = 501;
		message['msg'] = "参数错误";
	else:
		#conn = pymssql.connect(host='127.0.0.1', user='sa', password='root', database='IMDBS');
		#cur = conn.cursor();
		fdb = FDataBase();
		cur = fdb.cur;
		sql_str = 'select * from users where name=\''+name+'\'';
		cur.execute(sql_str);
		ret = cur.fetchall();
		if len(ret) >= 1:
			message['status'] = 400;
			message['msg'] = '用户已存在!';		#str(ret);
		else:								#用户注册
			sql_insert = "insert into users(name, password) values('"+name+"', '"+password+"')";
			cur.execute(sql_insert);
			#cur.commit();
			message['msg'] = "注册成功！";
	
		#cur.close();
		#conn.close();
		
		#cur.commit();
		#message = 'name:' + request.GET['name'];
		#message = message + "<br />password:" + request.GET['password'];
	
	return HttpResponse(json.dumps(message, ensure_ascii=False), content_type="application/json");
