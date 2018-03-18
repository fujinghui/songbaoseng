"""RegisterUser URL Configuration

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
from . import view, register,play,filter,im,data_interface;
from django.conf import settings
from django.conf.urls.static import static

"""

"""
urlpatterns = [
    #url(r'^admin/', include(admin.site.urls)),
    #url(r'^$', view.hello),
    #url(r'^*', filter.index),
	#url(r'', filter.index),		#截获所有的url
	url(r'^[^json].*$', filter.index),
	url(r'^im/client$', im.client),
	url(r'^register_html$', register.register_html),
	
	url(r'^json/logout$', register.logout),
    url(r'^json/register$', register.register),
	url(r'^json/login$', register.login),
	url(r'^json/play$', play.play),
	#与用户信息相关的文件的配置
	url(r'^json/get_friends$', data_interface.get_friends),						#获取好友列表
	url(r'^json/get_message$', data_interface.get_message),						#获取发送的消息
	url(r'^json/get_user_info$', data_interface.get_user_info),					#获取用户信息
	url(r'^json/send_message$', data_interface.send_message),					#发送消息
	url(r'^json/get_groups$', data_interface.get_groups),						#获取所有的群,
	url(r'^json/get_group_message$', data_interface.get_group_message),			#获取群的消息
	url(r'^json/get_group_mitglieder$', data_interface.get_group_mitglieder),	#获取群组底下的成员
	url(r'^json/upload_file$', data_interface.upload_file),
]