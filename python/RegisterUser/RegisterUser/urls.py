﻿"""RegisterUser URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.8/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Add a URL to urlpatterns:  url(r'^blog/', include('blog.urls'))
"""
from django.conf.urls import include, url
from django.contrib import admin
from . import view, register,play,filter,im,friend;
from django.conf import settings
from django.conf.urls.static import static

"""

"""
urlpatterns = [
    # url(r'^admin/', include(admin.site.urls)),
    # url(r'^$', view.hello),
    #url(r'^*', filter.index),
	#url(r'', filter.index),		#截获所有的url
	url(r'^[^json].*$', filter.index),
	url(r'^im/client$', im.client),
	url(r'^register_html$', register.register_html),
	url(r'^json/logout$', register.logout),
    url(r'^json/register$', register.register),
	url(r'^json/login$', register.login),
	url(r'^play$', play.play),
	#与用户信息相关的文件的配置
	url(r'^json/get_friends$', friend.get_friends),
]