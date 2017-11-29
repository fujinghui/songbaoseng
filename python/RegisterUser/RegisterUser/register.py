from django.http import HttpResponse;
from django.shortcuts import render_to_response;

def register_html(request):

	return render_to_response('form.html');

def register(request):
	request.encoding='utf-8';
	message = 'name:' + request.GET['name'];
	message = message + "<br />password:" + request.GET['password'];
	return HttpResponse(message);