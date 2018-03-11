import pymssql;
import re;

class FDataBase:
	conn = pymssql.connect(host='127.0.0.1', user='sa', password='root', database='IMDBS',charset='utf8');
	cur = conn.cursor();
	def __init__(self):
		#self.conn = pymssql.connect(host='127.0.0.1', user='sa', password='root', database='IMDBS');
		#self.cur = self.conn.cursor();
		pass;
	def __del__(self):
		#self.cur.close();
		pass;
	def show(self, name, password):
		sql_str = 'select * from users where name=\''+name+'\' and password=\''+password+'\'';
		self.cur.execute(sql_str);
		ret = self.cur.fetchall();
		if len(ret) >= 1:
			return "用户存在！";
		else:
			return "用户不存在！";
				
	#根据模型变量加载
	#model 模型变量
	#dict 元组

def LoadModel(model, dict):
	index = 0;
	dirs = dir(model);
	for _ in dirs:
		if re.search("^__.*__$", _) is None:		#根据正则匹配
			setattr(model, _, dict[index]);
			index = index + 1;