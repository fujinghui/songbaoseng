			function FStack(){
				this.stack = new Array();
				
				this.LARGEN_MODE = 1;
				this.LESS_MODE = 2;
				this.fsort_mode = 0;
				this.begin_index = -1;		//排序的起始和结束索引
				
				this.setSortMode = function(mode){
					this.fsort_mode = mode;
				}
				this.begin = function(){
					this.begin_index = this.stack.length;
				}
				this.end = function(){
					this.begin_index = -1;
				}
				this.push = function(obj){
					var flag = 0;				//插入的这个数字是否调换了顺序
					if(this.begin_index == -1)
					{
						this.stack[this.stack.length] = obj;
					}
					else
					{
						if(this.fsort_mode == this.LARGEN_MODE)
						{
							var k = obj.v;
							var kh = obj.h;
							var i = this.stack.length;
							var ei = i;
							while(i > this.begin_index && k < this.stack[i - 1].v)
							{
								this.stack[i] = this.stack[i-1];
								i = i - 1;
								flag = 1;
							}
						/*	while(i > this.begin_index && k == this.stack[i-1].v && this.stack[i-1].h > kh)
							{
								this.stack[i] = this.stack[i-1];
								i = i - 1;
							}
							*/
							this.stack[i] = obj;
						}
						else if(this.fsort_mode == this.LESS_MODE)
						{
							var k = obj.v;
							var kh = obj.h;
							var i = this.stack.length;
							var ei = i;
							while(i > this.begin_index && k > this.stack[i - 1].v)
							{
								this.stack[i] = this.stack[i - 1];
								i = i - 1;
								flag = 1;
							}
					/*		while(i > this.begin_index && k == this.stack[i-1].v && this.stack[i-1].h < kh)
							{
								this.stack[i] = this.stack[i-1];
								i = i - 1;
							}
							*/
							this.stack[i] = obj;
						}
					}
					return flag;
				}
				this.pop = function(){
					if(this.stack.length == 0)
						return null;
					var r = this.stack[this.stack.length - 1];
					
					this.stack.pop();
					return r;
				}
				this.empty = function(){
					if(this.stack.length == 0)
						return true;
					return false;
				}
				this.exists = function(obj){
					for(var i = 0; i < this.stack.length; i ++)
					{
						if(this.stack[i] == obj)
							return true;
					}
					return false;
				}
				this.exists_fun = function(obj, func){
					for(var i = 0; i < this.stack.length; i ++)
					{
						if(func(obj, this.stack[i]))
						{
							return true;
						}
					}
					return false;
				}
				this.get_fun = function(obj, func){
					for(var i = 0; i < this.stack.length; i ++)
					{
						if(func(obj, this.stack[i]))
							return this.stack[i];
					}
					return null;
				}
				this.remove_fun = function(obj, func){
					var i;
					for(i = 0; i < this.stack.length; i ++)
					{
						if(func(obj, this.stack[i]))
						{
							break;
						}
					}
					for(;i + 1< this.stack.length; i ++)
					{
						this.stack[i] = this.stack[i+1];
					}
					return this.stack.pop();
				}
			}
			//用于axin算法
			function cmp_map(obj1, obj2){
				if(obj1.x == obj2.x && obj1.y == obj2.y)
					return true;
				return false;
			}
			function AXinH(sp, ep, map){
				var qiang = 10000;
				var result1 = 0, result2 =0 ;
				var mx = (ep.x-sp.x)>0?1:-1;
				var my = (ep.y-sp.y)>0?1:-1;
				var x = sp.x;
				var y = sp.y;
				while(x != ep.x)
				{
					if(map[y][x].f == 1)
						result1 += qiang;
					else
						result1 += 1;
					x += mx;
				}
				while(y != ep.y)
				{
					if(map[y][x].f == 1)
						result1 += qiang;
					else
						result1 += 1;
					y += my;
				}
				x = sp.x;
				y = sp.y;
				while(y != ep.y)
				{
					if(map[y][x].f == 1)
						result2 += qiang;
					else
						result2 += 1;
					y += my;
				}	
				while(x != ep.x)
				{
					if(map[y][x].f == 1)
						result2 += qiang;
					else
						result2 += 1;
					x += mx;
				}
				
				if(result1 < result2)
					return result1;
				return result2;
				
			}
			function AXin_new(sp, ep, map){
				var path = new Array();
				var open_list = new FStack();
				var close_list = new FStack();
				var flag = 0, flag_flag = 0;
				open_list.setSortMode(open_list.LESS_MODE);
				open_list.begin();
				open_list.push({x:sp.x,y:sp.y,h:AXinH(sp,ep,map),g:0,v:0,parent:null});
				path[0] = {x:sp.x,y:sp.y,parent:null};
				/*
				 * map:
				 * x,y,g,h,v(f)
				 */
				while(1)
				{
					if(open_list.empty())
						break;
					var t = open_list.pop();
					//console.log(t);
					if(t.x == ep.x && t.y == ep.y)
					{
						path.push(t);
						break;
					}
					path[path.length] = t;
					flag = 0;
					flag_flag = 0;
					close_list.push(map[t.y][t.x]);				//将当前的点加入到关闭列表中
					//open_list.begin();
					if(t.x > 0 && map[t.y][t.x-1].f ==0 && !close_list.exists(map[t.y][t.x-1]))
					{
						var a = new Object();
						a.x = t.x-1; a.y = t.y;
						a.h = AXinH(a,ep,map);//Math.abs(a.x-ep.x)+Math.abs(a.y-ep.y);
						a.h = a.h * 3;
						a.g = t.g + 1;
						a.v = a.h + a.g;
						a.parent = t;
						if(open_list.exists_fun(a, cmp_map))
						{
							var s = open_list.get_fun(a, cmp_map);
							if(a.v < s.v)
							{
								open_list.remove_fun(s, cmp_map);
							}
						}
						else
						{
							flag_flag += open_list.push(a);
							flag ++;
						}
					}
					if(t.x < map[0].length - 1 && map[t.y][t.x+1].f==0 && !close_list.exists(map[t.y][t.x+1]))
					{
						var a = new Object();
						a.x = t.x+1; a.y = t.y;
						a.h = AXinH(a,ep,map);//Math.abs(a.x-ep.x)+Math.abs(a.y-ep.y);
						a.h = a.h * 3;
						a.g = t.g + 1;
						a.v = a.h + a.g;
						a.parent = t;
						if(open_list.exists_fun(a, cmp_map))
						{
							var s = open_list.get_fun(a, cmp_map);
							if(a.v < s.v)
							{
								open_list.remove_fun(s, cmp_map);
							}
						}
						else
						{
							flag_flag += open_list.push(a);
							flag ++;
						}
					}
					if(t.y > 0 && map[t.y-1][t.x].f == 0 && !close_list.exists(map[t.y-1][t.x]))
					{
						var a = new Object();
						a.x=t.x; a.y=t.y-1;
						a.parent = t;
						a.h = AXinH(a,ep,map);//Math.abs(a.x-ep.x)+Math.abs(a.y-ep.y);
						a.h = a.h * 3;
						a.g = t.g + 1;
						a.v = a.h + a.g;
						if(open_list.exists_fun(a, cmp_map))
						{
							var s = open_list.get_fun(a, cmp_map);
							if(a.v < s.v)
							{
								open_list.remove_fun(s, cmp_map);
							}
						}
						else
						{
							flag_flag += open_list.push(a);
							flag ++;
						}
					}
					if(t.y < map.length - 1 && map[t.y+1][t.x].f == 0 && !close_list.exists(map[t.y+1][t.x]))
					{
						var a = new Object();
						a.x=t.x;a.y=t.y+1;
						a.parent = t;
						a.h = AXinH(a,ep,map);//Math.abs(a.x-ep.x)+Math.abs(a.y-ep.y);
						a.h = a.h * 3;
						a.g = t.g + 1;
						a.v = a.h + a.g;
						if(open_list.exists_fun(a, cmp_map))
						{
							var s = open_list.get_fun(a, cmp_map);
							if(a.v < s.v)
							{
								open_list.remove_fun(s, cmp_map);
							}
						}
						else
						{
							flag_flag += open_list.push(a);
							flag ++;
						}
					}
				}
				var paths = new Array();
				var p = path.pop();
				if(p.x != ep.x || p.y != ep.y)
					return null;
				while(p.x != sp.x || p.y != sp.y)
				{
					paths.push(p);
					p = p.parent;
				}
				paths.push(p);
				return paths;
			}
			
			
			function AXin(sp, ep, map){
				var path = new Array();
				var stack = new FStack();			//开启列表
				var close_list = new FStack();		//关闭列表
				var fs = {x:sp.x, y:sp.y, h:Math.abs(ep.x-sp.x)+Math.abs(ep.y-sp.y), g:0};
				fs.f = fs.h + fs.g;
				fs.v = fs.h + fs.g;
				//e=0表示该方块加入到了关闭列表中
				//map[sp.y][sp.x].e = 0;		//设置地图起始坐标加入到关闭列表中
				var x = sp.x, y = sp.y;
				//添加第一个点
				path[0] = fs;
				while(1)
				{
					x = fs.x; y = fs.y;
					//console.log("x:"+x+" y:"+y);
					var flag = 0;
					stack.setSortMode(stack.LESS_MODE);
					stack.begin();
					//left
					//这条路没有被加入到关闭列表中，并且这条路可以走的通
					if(x - 1 >= 0 && close_list.exists(map[y][x-1]) == false && map[y][x - 1].f == 0)
					{
						flag += 1;
						var t = {x:x-1, y:y, h:Math.abs(ep.x-x+1)+Math.abs(ep.y-y), g:fs.g+1};
						t.f = t.g + t.h;
						t.v = t.f;
						stack.push(t);
					}
					if(x + 1 < map[0].length && close_list.exists(map[y][x+1]) == false && map[y][x +1].f == 0)
					{
						flag += 1;
						var t = {x:x+1, y:y, h:Math.abs(ep.x-x-1)+Math.abs(ep.y-y), g:fs.g+1};
						t.f = t.g + t.h;
						t.v = t.f;
						stack.push(t);
					}
					if(y - 1 >= 0 && close_list.exists(map[y-1][x]) == false &&map[y - 1][x].f == 0)
					{
						flag += 1;
						var t = {x:x, y:y-1, h:Math.abs(ep.x-x)+Math.abs(ep.y-y+1), g:fs.g+1};
						t.f = t.g + t.h;
						t.v = t.f;
						stack.push(t);
					}
					if(y + 1 < map.length && close_list.exists(map[y+1][x]) == false && map[y + 1][x].f == 0)
					{
						flag += 1;
						var t = {x:x, y:y+1, h:Math.abs(ep.x-x)+Math.abs(ep.y-y-1), g:fs.g+1};
						t.f = t.g + t.h;
						t.v = t.f;
						stack.push(t);
					}
					stack.end();
					//将当前方格加入到路径中
					if(flag == 0)
					{
						path.pop();
						fs = path[path.length - 1];
						if(fs == null)
						{
							var tp = stack.pop();
							if(tp == null)
							{
								return null;
								break;
							}
							fs = tp;
						}
					}
					else
					{
						//正常情况
						var tp = stack.pop();
						if(tp == null)
						{
							return null;
							break;
						}
						fs = tp;
						path[path.length] = tp;
						//console.log("x:"+tp.x+" y:"+tp.y);
					}
					//加入到关闭列表中
					close_list.push(map[tp.y][tp.x]);
					
				//	map[tp.y][tp.x].f = 2;			//标记当前路径为路过
				//	map[tp.y][tp.x].e = 0;			//标记当前方格
				//	map[tp.y][tp.x].g = fs.g;
				//	map[tp.y][tp.x].h = fs.h;
					
					if(tp.x == ep.x && tp.y == ep.y)
					{
						while((tp=stack.pop()) != null);
						//{
						//	map[tp.y][tp.x].g = tp.g;
						//	map[tp.y][tp.x].h = tp.h;
						//}
						break;
					}
				}
				return path;
			}
			