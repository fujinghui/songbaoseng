from RegisterUser.database.fdatabase import FDataBase;

import re;
class Server(object):
	name = "";
	def __init__(self):
		self.db = FDataBase();
		pass
	def FindById(id):
		sql_str = "select * from " + name;
		self.db.cur.execute(sql_str);
	
	#获取操作变量
	def GetDB(self):
		return self.db;