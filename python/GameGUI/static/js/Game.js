var scene_first_pass;
var map_first_pass;
var lead_first_pass;
var place_name = null;
var rect;						//对话框

var map_grid_width = 65, map_grid_height = 55;
var knap;						//背包对象
var otherPlayer = [];
//创建一个新的角色
function newLeader(){
	var lfp = new LeadCharacter();
	lfp.is_lead = false;
	lfp.init(['img/leading.png', 'img/lead_qiang.png']);
	lfp.addFrame({i:0, x:0, y:0,   	 width:141, height:250});
	lfp.addFrame({i:0, x:142, y:0, 	 width:141, height:250});
	lfp.addFrame({i:0, x:283, y:0,   width:141, height:250});
	lfp.addFrame({i:0, x:425, y:0,	 width:141, height:250});
	lfp.addFrame({i:0, x:567, y:0, 	 width:141, height:250});
	lfp.addFrame({i:0, x:709, y:0, 	 width:141, height:250});
	
	lfp.addFrame({i:0, x:0, y:255, 	 width:141, height:250});
	lfp.addFrame({i:0, x:142, y:255, width:141, height:250});
	lfp.addFrame({i:0, x:283, y:255, width:141, height:250});
	lfp.addFrame({i:0, x:425, y:255, width:141, height:250});
	lfp.addFrame({i:0, x:567, y:255, width:141, height:250});
	lfp.addFrame({i:0, x:709, y:255, width:141, height:250});
	//拿枪的动作
	lfp.addFrame({i:1, x:20, y:0, 	 width:130, height:244});
	lfp.addFrame({i:1, x:150*1, y:0, width:150, height:244});
	lfp.addFrame({i:1, x:150*2, y:0, width:150, height:244});
	lfp.addFrame({i:1, x:150*3+10, y:0, width:140, height:244});
		
	lfp.setShowFrameRange(1, 1);			//默认停止动作
	lfp.setWH(40, 80);
	lfp.setUpdateTime(200);
	lfp.setPosition(6 * map.getGridWidth(), 1 * map.getGridHeight());
	lfp.center_x = 0; lfp.center_y = 80;
	
	
	lfp.addKeyAction({key:65,
		frame:{
		up:{start:12, 		end:12},
		left:{start:13, 	end:13},
		down:{start:14, 	end:14},
		right:{start:15, 	end:15}
		}, update_time:400});
	
	return lfp;
}
function init_first_pass(){
	//设置主角的属性
	lead_first_pass = new LeadCharacter();		//继承自FGAMES.Character();
	lead_first_pass.is_lead = true;				//标记是主角
	lead_first_pass.left = 0;
	lead_first_pass.right = 0;
	lead_first_pass.up = 0;
	lead_first_pass.down = 0;
	
	lead_first_pass.init(['img/leading.png', 'img/lead_qiang.png']);
	lead_first_pass.addFrame({i:0, x:0, y:0, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:142, y:0, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:283, y:0, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:425, y:0, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:567, y:0, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:709, y:0, width:141, height:250});
	
	lead_first_pass.addFrame({i:0, x:0, y:255, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:142, y:255, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:283, y:255, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:425, y:255, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:567, y:255, width:141, height:250});
	lead_first_pass.addFrame({i:0, x:709, y:255, width:141, height:250});
	//拿枪的动作
	lead_first_pass.addFrame({i:1, x:20, y:0, width:130, height:244});
	lead_first_pass.addFrame({i:1, x:150*1, y:0, width:150, height:244});
	lead_first_pass.addFrame({i:1, x:150*2, y:0, width:150, height:244});
	lead_first_pass.addFrame({i:1, x:150*3+10, y:0, width:140, height:244});
	
	lead_first_pass.setShowFrameRange(1, 1);			//默认停止动作
	lead_first_pass.setWH(40, 80);
	lead_first_pass.setUpdateTime(200);
	lead_first_pass.setPosition(6 * map.getGridWidth(), 1 * map.getGridHeight());
	lead_first_pass.center_x = 0; lead_first_pass.center_y = 80;
	
	lead_first_pass.addKeyAction({key:65,
		frame:{
		up:		{start:12, 	end:12},
		left:	{start:13, 	end:13},
		down:	{start:14, 	end:14},
		right:	{start:15, 	end:15}
		}, update_time:400});
	
	//背包对象
	knap = new Knapsack();
	knap.visible = false;
	map.show_table_line = false;
	scene_first_pass = new FGAMES.Scene();
	/*
	 * 默认为传统的动画模式，此处设置为新的动画模式(之后的游戏场景切换均采用新的(2.0?)动画模式)，
	 * 其实也就是为了兼容之前自己写的代码(太恶心啦，你知道吗，为了兼容，代码我自己都快看不懂了。)
	 */
	scene_first_pass.setTraditionAnimation(true);
	//scene_first_pass.setAnimationBackgroundColor(40, 60, 70);
	scene_first_pass.setAnimationBackgroundColor(255, 255, 255);
	scene_first_pass.setCanvas(canvas);
	scene_first_pass.setBackgroundColor(255, 255, 255);
	scene_first_pass.setBackgroundImage('img/background_image.png');
	//往场景里添加显示物体
	scene_first_pass.add(map);
	scene_first_pass.add(knap);
	scene_first_pass.addKeyDown(FirstKeyDown);			//添加键盘按下处理
	scene_first_pass.addKeyUp(FirstKeyUp);				//添加键盘松开处理
	//scene_first_pass.addMouseDown(FirstMouseDown);
//	scene_first_pass.renderBuffer();						//现将图像渲染到缓冲区中
//	scene_first_pass.enterScene(first_pass_draw);
	for(var i = 0; i < menu_button.length; i ++)
	{
		scene_first_pass.add(menu_button[i]);
	}
	//添加phone操作
	//phone_operator.setCanvas(scene_first_pass.getCanvasBuffer());
	//load_from_server();
	//first_pass_draw();
	//real_time_game_map();
	imServer.init();
}

function FirstKeyDown(e){
	var code = e.keyCode;
	imServer.sendMessage(
		new MTypeObject(MTYPE_GET_POSITION, 
		"{\"code\":"+code+",\"x\":"+lead_first_pass.x+",\"y\":"+lead_first_pass.y+"}"), 
		function(msg){});
	
	var map_width = 0, map_height = 0;
	var grid_height = map.getGridHeight();
	var grid_width = map.getGridWidth();
	//获取地图的宽和高
	if(map.map_data)
	{
		map_height = map.map_data.length * grid_height;
		map_width = map.map_data[0].length * grid_width;
	}
}
function FirstKeyUp(e){
	//if(lead_first_pass.vx == 0 && lead_first_pass.vy == 0){
		imServer.sendMessage(
			new MTypeObject(MTYPE_CANCEL_ACTION, 
			"{\"code\":"+(e.keyCode)+",\"x\":"+lead_first_pass.x+",\"y\":"+lead_first_pass.y+"}"),
			function(msg){});
	//}
}
function unsetPlayerPosition(player){
	var n = Math.round((player.getShowStartIndex()+1) / 3 - 0.5) * 3;
	player.setShowFrameRange(n + 1, n + 1);
	player.vx = 0;
	player.vy = 0;
	player.left = 0;
	player.right = 0;
	player.up = 0;
	player.down = 0;
}
function setPlayerPosition(player, code){
	if(code == 39)					//right
	{
		player.right = 1;
		player.vx = 2;
		player.vy = 0;
		player.setShowFrameRange(0, 2);
		player.setUpdateTime(150);
		player.forward = player.RIGHT;
	}
	else if(code == 37)				//left
	{
		player.left = 1;
		player.vx = -2;
		player.vy = 0;
		player.setShowFrameRange(3, 5);
		player.setUpdateTime(150);
		player.forward = player.LEFT;
	}
	else if(code == 38)			//up
	{
		player.up = 1;
		player.vy = -2;
		player.vx = 0;
		player.setShowFrameRange(9, 11);
		player.setUpdateTime(150);
		player.forward = player.UP;
	}
	else if(code == 40)			//down
	{
		player.down = 1;
		player.vy = 2;
		player.vx = 0;
		player.setShowFrameRange(6, 8);
		player.setUpdateTime(150);
		player.forward = player.DOWN;
	}
}

var score_current = 0;
function first_pass_draw(){
	if(game_pause == false)
	{
		
	//	user_info = user_name+" "+"上一关得分："+(score1+score2+score3);
		user_info = player_name + " "+"得分："+score_current;
		scene_first_pass.getContext().textBaseline = "top";
		scene_first_pass.getContext().font = "bold 25px KaiTi,sans-serif";
		scene_first_pass.getContext().fillStyle = "rgba(255, 255, 255, 0.5)";
		
		scene_first_pass.render();
		if(FTools.isPc())
		{
			var width = scene_first_pass.getContext().measureText(user_info).width + 40;
			//scene_first_pass.getContext().fillRect(130, 0, width, 30);
			//绘制背景
			scene_first_pass.getContext().drawImage(image_user_info_background,
				0, 0, image_user_info_background.width, image_user_info_background.height,
				0, -15, width, 60);
			scene_first_pass.getContext().fillStyle = "rgb(0, 0, 0)";
			
			scene_first_pass.getContext().fillText(user_info, 20, 0);
		}
		if(place_name)
		{
			width = scene_first_pass.getContext().measureText(place_name).width + 50;
			scene_first_pass.getContext().drawImage(image_user_info_background,
			0, 0, image_user_info_background.width, image_user_info_background.height,
			scene_first_pass.getCanvas().width - width, -15, width, 70);
			scene_first_pass.getContext().fillText(place_name, scene_first_pass.getCanvas().width-25*place_name.length-30, 8);
		}
		//scene_first_pass.getContext().fillText(user_name, 140, 0);
		//scene_first_pass.getContext().fillText("得分："+(score1 + score2 + score3), 200, 0);
		fps.frame();					//every frame call
		scene_first_pass.getContext().font = "20px Arial";
		//scene_first_pass.getContext().fillText("fps:"+fps.getFps(), 0, 0);
		//console.log("game progress:"+game_progress);
	}
	requestAnimationFrame(first_pass_draw);
}
