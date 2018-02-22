from django.http import HttpResponse;
from django.shortcuts import render_to_response;
from RegisterUser.database.fdatabase import *;
import json;
import pymssql;
#获取好友列表
def get_friends(request):
	user_id = request.POST.get("user_id") or request.GET.get('user_id');
	message = {"code":200, "msg":"", "data":None};
	if user_id is not None:
		#查询当前用户是否具有的用户量
		fdb = FDataBase();
		cur = fdb.cur;
		sql_str = "select users.* from (select DISTINCT(user2) from user_friend_relation where user_friend_relation.user1="+user_id+") AS result LEFT JOIN users on users.id=result.user2 order by is_login desc";
		cur.execute(sql_str);
		ret = cur.fetchall();
		message['data'] = ret;
	else:
		pass;
	return HttpResponse(json.dumps(message, ensure_ascii=False), content_type="application/json");
	
	