from django.shortcuts import render;

def client(request):
	context = {};
	return render(request, "im/client.html", context);