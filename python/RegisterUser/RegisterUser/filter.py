from django.http import HttpResponse
from django.shortcuts import render;
from server.userserver import UserServer;
from model.user import *;
import json;
#重定向包
from django.http import HttpResponseRedirect;

from database import fdatabase;
def ResponseModel(status, msg):
	return {"status":status, "msg":msg};
	
def index(request):
	userServer = UserServer();
	content = {};
	#判断用户是否登录
	if request.session.get("user") is None:
		return render(request, "login.html", content);
	else:
		content['id'] = request.session.get("id");
		content['name'] = request.session.get("name");
		content['password'] = request.session.get("password");
		return render(request, "im/client.html", content);
		
		#return HttpResponseRedirect(request.path);
		#return HttpResponseRedirect(request.path);
		#return HttpResponse(request.path, content_type="application/json");
		#return render(request, "im/client.html", content);
	
	
	#username = request.GET['username'];
	#password = request.GET['password'];
	#context = {};
	#db = fdatabase.FDataBase();
	#context['hello'] = db.show(username, password);
	#context['test'] = request.get_full_path();
	#user = authenticate(username=username,password=password);
	#if user is not None:
	#	print("login");
	
	#return HttpResponse("hello");#render(request, "hello.html", context);
	#response = None;
	#user = User();
	#user.name = username;
	#user.password = password;
	#result = userServer.FindByNameAndPassword(user);
	#if result is None:
	#	response = ResponseModel(1000, "用户不存在！");
	#else:
	#	response = ResponseModel(200, "用户已存在！");
	#return HttpResponse(json.dumps(response, ensure_ascii=False), content_type="application/json");