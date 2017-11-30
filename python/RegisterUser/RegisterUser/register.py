# -*- coding: utf-8 -*-
from django.http import HttpResponse;
from django.shortcuts import render_to_response;
import pymssql;

def register_html(request):
	return render_to_response('form.html');

def register(request):
	request.encoding = 'utf-8';
	name = request.GET['name'];
	password = request.GET['password'];
	conn = pymssql.connect(host='127.0.0.1', user='sa', password='root', database='IMDBS');
	cur = conn.cursor();
	sql_str = 'select * from users where name=\''+name+'\' and password=\''+password+'\'';
	cur.execute(sql_str);
	#print cur.fetchall();
	ret = cur.fetchall();
	if len(ret) >= 1:
		message = '用户已存在!';		#str(ret);
	else:								#用户注册
		sql_insert = "insert into users(name, password) values('"+name+"', '"+password+"')";
		cur.execute(sql_insert);
		#cur.commit();
		message=  "注册成功！";
	cur.close();
	conn.close();
	
	#cur.commit();
	#message = 'name:' + request.GET['name'];
	#message = message + "<br />password:" + request.GET['password'];
	
	return HttpResponse(message);
