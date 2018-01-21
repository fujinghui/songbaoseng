from RegisterUser.model.user import User;
from RegisterUser.server.server import Server;
from RegisterUser.database.fdatabase import *;

class UserServer(Server):
	name = "user";		#表名
	def __init__(self):
		self.name = "user";
		self.fdb = FDataBase();
		#super(UserServer, self).__init__();
	def FindByNameAndPassword(self, model):
		sql_str = "select * from users where name='"+model.name+"'"+" and password='"+model.password+"'";
		#self.fdb = super(UserServer, self).GetDB();
		
		self.fdb.cur.execute(sql_str);
		ret = self.fdb.cur.fetchall();
		if len(ret) == 1:
			user = User();
			LoadModel(user, ret[0]);			#调用父类加载方法
			return user;
		else:
			return None;