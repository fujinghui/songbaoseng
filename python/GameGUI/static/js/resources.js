var trees;
var houses;
var npc1;
var npc2;
var npc3, npc4;
var npc_car;
var fences;
var system_dialog;
var phone_operator;
var wall_animal_protect = new Array();

var trees_kekexili = new Array();
var desks = new Array();			//桌子
var stones = new Array();			//最后一个实时战斗游戏的障碍物
var trees_anduo_road = new Array();
var trees_anduo = new Array();
var houses_anduo = new Array();

var npcs_main = new Array();			//主要场景里的npc
var npcs_slaughter = new Array();		//屠宰场场景里的npc
var npcs_animal_protect = new Array();	//野生动物保护协会里的npc
var npcs_crime = new Array();			//犯罪分子房间里的npc
var npcs_animals_save = new Array();	//待拯救的动物
var npcs_real_time = new Array();		//实时对战最后一个关卡的npc
var npcs_drgustore = new Array();		//药店里的npc
var npcs_kekexili = new Array();		//可可西里的npc
var npcs_anduo = new Array();			//安多县的npcs


var mini_map = null;
//系统对话框
var system_dialog;
var scoring;
var menu_button = new Array();
var menu;
var task;
var ranklist;
//音乐资源
var music_enable = true;
var music_hint, music_home_scene, music_house, music_tufu, music_beng;
var musics = new Array();
//图片资源
var image_user_info_background;
function init_all_res(){
	myajax = new FAjax();
	ranklist = new RankList();
	ranklist.w = 200;
	ranklist.h = 300;
	ranklist.x = (canvas.width - ranklist.w)/2;
	ranklist.y = (canvas.height - ranklist.h)/2;
	ranklist.init();
	
	task = new Task();
	task.w = 300;
	task.h = 200;
	task.x = (canvas.width - task.w) / 2;
	task.y = (canvas.height - task.h) / 2;
	task.init();
	task.visible = false;
	
	menu = new Menu();
	menu.SCENE_WIDTH = canvas.width;
	menu.SCENE_HEIGHT = canvas.height;
	menu.MENU_WIDTH = 200;
	menu.MENU_HEIGHT = 500;
	menu.x = (menu.SCENE_WIDTH-menu.MENU_WIDTH)/2;
	menu.y = (menu.SCENE_HEIGHT-menu.MENU_HEIGHT)/2;
	menu.init();
	menu.visible = false;
	//底下的菜单栏
	menu_button[0] = new FGAMES.Button("菜单");
	menu_button[0].setWidth(100);
	menu_button[0].setHeight(40);
	menu_button[0].setPosition(canvas.width - menu_button[0].getWidth() * 3 - 20, canvas.height - menu_button[0].getHeight());
	menu_button[0].setDefaultBackgroundImage('img/button1.png');
	menu_button[0].setOnTouchBackgroundImage('img/button1_click.png');
	menu_button[0].addOnClickListener(function(){
		menu.visible = !menu.visible;
		task.visible = false;
	})
	menu_button[1] = new FGAMES.Button("帮助");
	menu_button[1].setWidth(100);
	menu_button[1].setHeight(40);
	menu_button[1].setPosition(canvas.width-menu_button[1].getWidth()*2-10, canvas.height - menu_button[1].getHeight());
	menu_button[1].setDefaultBackgroundImage('img/button1.png');
	menu_button[1].setOnTouchBackgroundImage('img/button1_click.png');
	menu_button[1].addOnClickListener(function(){
		task.text = FRes.String.help;
		task.visible = true;
		
		menu.visible = false;
	});
	
	menu_button[2] = new FGAMES.Button("游戏启示");
	menu_button[2].setWidth(100);
	menu_button[2].setHeight(40);
	menu_button[2].setPosition(canvas.width-menu_button[2].getWidth(), canvas.height - menu_button[2].getHeight());
	menu_button[2].setDefaultBackgroundImage('img/button1.png');
	menu_button[2].setOnTouchBackgroundImage('img/button1_click.png');
	menu_button[2].addOnClickListener(function(){
		flash_game_prompt.style.display = "";
	});
	//系统对话框
	system_dialog = new DialogText(null);
	system_dialog.setWindow({w:canvas.width, h:canvas.height});
	/*
	var tt = "[\n";
	for(var i = 0; i < map_data_real_time_game.length; i ++)
	{
		tt+="["
		for(var j = 0; j < map_data_real_time_game.length; j ++)
		{
			tt = tt+""+map_data_real_time_game[i][j].f+",";
		}
		tt+="],\n"
	}
	tt+="]";
	alert(tt);
	console.log(tt);
	*/
	scoring = new Scoring(canvas.width, canvas.height);
	
	map_data_real_time_game=FTools.SetMapData({x:0,y:0,width:120,height:120, i:5, f:1},map_real_time);
	map_data_crime_house = FTools.SetMapData({x:0,y:0,width:63,height:50,i:3,f:0}, map_crime_test);
	map_data_anduo_road = FTools.SetMapDataEx(map_flag_anduo_road,map_show_anduo_road,map_res_anduo_road);
	map_data_anduo = FTools.SetMapDataEx(map_flag_anduo, map_show_anduo, map_res_anduo);
	map_data_drugstore = FTools.SetMapDataEx(map_flag_drugstore, map_show_drugstore, map_res_drugstore);
	map_data_kekexili = FTools.SetMapDataEx(map_flag_kekexili, map_show_kekexili, map_res_kekexili);
	map_data_animal_protect_house = FTools.SetMapDataEx(map_flag_anima_protect_house, map_show_animal_protect_house, map_res_animal_protect_house);
	map_data_house_slaughter = FTools.SetMapDataEx(map_flag_house_slaughter, map_show_house_slaughter, map_res_house_slaughter);
	console.log(map_data_animal_protect_house);
	//FTools.addMapFlag(map_data_anduo_road, map_flag_anduo_road);
	
	//小地图初始化
	mini_map = new MiniMap();
	mini_map.SCENE_WIDTH = canvas.width;
	mini_map.SCENE_HEIGHT = canvas.height;
	mini_map.MINI_MAP_WIDTH = canvas.width/4;
	mini_map.MINI_MAP_HEIGHT = canvas.height/4;
	mini_map.map_data = map_data_real_time_game;
	
	trees = new Array();
	trees[0] = new FGAMES.Character();
	trees[0].init(['img/trees.png']);
	trees[0].addFrame({i:0, x:320, y:100, width:160, height:170});
	trees[0].center_x = 0; trees[0].center_y = 170;
	trees[0].setPosition(140, 200);
	
	trees[1] = new FGAMES.Character();
	trees[1].init(['img/trees.png']);
	trees[1].addFrame({i:0, x:320, y:100, width:160, height:170});
	trees[1].center_x = 50; trees[1].center_y = 170;
	trees[1].setPosition(0, 200);
	
	trees[2] = new FGAMES.Character();
	trees[2].init(['img/trees.png']);
	trees[2].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[2].center_x = 0; trees[2].center_y = 170;
	trees[2].setPosition(400, 200);
	
	trees[3] = new FGAMES.Character();
	trees[3].init(['img/trees.png']);
	trees[3].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[3].center_x = 0; trees[3].center_y = 170;
	trees[3].setPosition(510, 450);
	
	trees[4] = new FGAMES.Character()
	trees[4].init(['img/trees.png']);
	trees[4].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[4].center_x = 0; trees[4].center_y = 170;
	trees[4].setPosition(320, 450);
	
	trees[5] = new FGAMES.Character()
	trees[5].init(['img/trees.png']);
	trees[5].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[5].center_x = 0; trees[5].center_y = 170;
	trees[5].setPosition(300, 600);
	
	trees[6] = new FGAMES.Character()
	trees[6].init(['img/trees.png']);
	trees[6].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[6].center_x = 0; trees[6].center_y = 170;
	trees[6].setPosition(800, 200);
	
	trees[7] = new FGAMES.Character()
	trees[7].init(['img/trees.png']);
	trees[7].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[7].center_x = 0; trees[7].center_y = 170;
	trees[7].setPosition(450, 670);
	
	trees[8] = new FGAMES.Character()
	trees[8].init(['img/trees.png']);
	trees[8].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[8].center_x = 0; trees[8].center_y = 170;
	trees[8].setPosition(70, 480);
	
	trees[9] = new FGAMES.Character();
	trees[9].init(['img/trees.png']);
	trees[9].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[9].center_x = 0; trees[9].center_y = 170;
	trees[9].setPosition(1000, 260);
	
	trees[10] = new FGAMES.Character();
	trees[10].init(['img/trees.png']);
	trees[10].addFrame({i:0, x:380, y:360, width:80, height:170});
	trees[10].center_x = 0; trees[10].center_y = 170;
	trees[10].setPosition(30, 580);
	
	trees[11] = new FGAMES.Character();
	trees[11].init(['img/trees.png']);
	trees[11].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[11].center_x = 0; trees[11].center_y = 60;
	trees[11].setPosition(110, 580);
	
	trees[12] = new FGAMES.Character();
	trees[12].init(['img/trees.png']);
	trees[12].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[12].center_x = 0; trees[12].center_y = 60;
	trees[12].setPosition(510,580);
	
	trees[13] = new FGAMES.Character();
	trees[13].init(['img/trees.png']);
	trees[13].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[13].center_x = 0; trees[13].center_y = 60;
	trees[13].setPosition(210, 580);
	
	trees[14] = new FGAMES.Character();
	trees[14].init(['img/trees.png']);
	trees[14].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[14].center_x = 0; trees[14].center_y = 60;
	trees[14].setPosition(410, 580);
	
	trees[15] = new FGAMES.Character();
	trees[15].init(['img/trees.png']);
	trees[15].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[15].center_x = 0; trees[15].center_y = 60;
	trees[15].setPosition(550, 100);
	
	trees[15] = new FGAMES.Character();
	trees[15].init(['img/trees.png']);
	trees[15].addFrame({i:0, x:310, y:290, width:90, height:80});
	trees[15].center_x = 0; trees[15].center_y = 60;
	trees[15].setPosition(660, 105);
	for(var i = 16; i < 22; i ++)
	{
		trees[i] = new FGAMES.Character();
		trees[i].init(['img/trees.png']);
		trees[i].addFrame({i:0, x:310, y:290, width:90, height:80});
		trees[i].center_x = 0; trees[i].center_y = 60;
		trees[i].setPosition(700 + (i-16)*90, 580);
	}
	
	//初始化最后一个关卡的地图资源
	var ti = 0;
	for(var i = 0; i < map_data_real_time_game.length; i ++)
	{
		for(var j = 0; j < map_data_real_time_game[0].length; j ++)
		{
			if(map_data_real_time_game[i][j].f == 1)
			{
				stones[ti] = new FGAMES.Character();
				stones[ti].init(['img/trees.png']);
				if(Math.random()>0.5)
				{
					stones[ti].addFrame({i:0, x:310, y:290, width:90, height:80});
					stones[ti].center_x = 0; stones[ti].center_y = 80;
					stones[ti].setWH(90, 100);
					stones[ti].setPosition(j*map.getGridWidth()-20, (i+1)*map.getGridHeight());
				}
				else
				{
					stones[ti].addFrame({i:0, x:380, y:360, width:80, height:170});
					stones[ti].center_x = 0; stones[ti].center_y = 170;
					stones[ti].setWH(80, 170);
					stones[ti].setPosition(j*map.getGridWidth()-10, (i+1)*map.getGridHeight());
				}
				map_data_real_time_game[i][j].object = stones[ti];
				ti = ti + 1;	
				
			}
		}
	}
	//初始化音乐
	music_hint = new Audio("music/hint.mp3");
	music_hint.loop = false;
	music_hint.play();
	
	music_home_scene = new Audio("music/home_scene.mp3");
	music_home_scene.loop = true;
	
	//music_house = new Audio("music/music_house.mp3");
	//music_house.loop = true;
	
	//music_tufu = new Audio("music/tufu.mp3");
	//music_tufu.loop = true;
	
	music_beng = new Audio("music/beng.mp3");
	music_beng.loop = false;
	
	
	musics[0] = music_hint;
	musics[1] = music_home_scene;
	musics[2] = music_house;
	musics[3] = music_tufu;
	
	//初始化手机操作界面
	phone_operator = new TouchOperator();
	
	//初始化图片
	image_user_info_background = new Image();
	image_user_info_background.src = "img/user_info_background.png";
	
	npc_car = new Npc();
	npc_car.init(['img/car.png']);
	npc_car.addFrame({i:0, x:0,y:0,width:395,height:280});
	npc_car.addFrame({i:0, x:405,y:0,width:395,height:280});
	npc_car.setWH(200, 125);
	npc_car.setShowFrameRange(0, 1);
	npc_car.center_x = 0; npc_car.center_y = 110;
	//npc_car.setPosition(100, 600);
	npc_car.setUpdateTime(300);
	
}
function stop_music(){
	for(var i = 0; i < musics.length; i ++)
	{
		musics[i].pause();
		musics[i].currentTime = 0;
	}
}
function play_music(ss){
	//console.log("ss");
	stop_music();
	if(music_enable == true)
		ss.play();
}
