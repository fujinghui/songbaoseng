function real_time_game_map(){
	if(FTools.isPc())
	{
		//scene_first_pass.add(phone_operator);
	}
	else
	{
		//$("#pc_phone").text("body{transform: rotate(90deg);-o-transform: rotate(90deg);-webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);}");
		/*$("body").css('transform', 'rotate(90deg)');
		
		$("#my_div").css("width",document.documentElement.clientHeight);
		$("#my_div").css("height",document.documentElement.clientWidth);
		$("#my_div").css("margin","0px");
		$("#my_div").css("position","");
		
		$("#my_canvas").attr("width", document.documentElement.clientHeight);
		$("#my_canvas").attr("height", document.documentElement.clientWidth);
		*/
		
		$("#my_div").css("width", document.documentElement.clientWidth);
		$("#my_div").css("height", document.documentElement.clientHeight);
		$("#my_div").css("margin", "0px");
		$("#my_div").css("position", "");
		
		
		$("#my_canvas").attr("width", document.documentElement.clientWidth);
		$("#my_canvas").attr("height", document.documentElement.clientHeight);
		
		$("#flash_game_prompt").attr("width", document.documentElement.clientWidth);
		$("#flash_game_prompt").attr("height", document.documentElement.clientHeight);
		
		scene_first_pass.add(phone_operator);
		canvas.addEventListener('touchmove', phone_operator.touchmove);
		canvas.addEventListener('touchend', phone_operator.touchend);
		canvas.addEventListener('touchstart', phone_operator.touchstart);
	}
	current_scene = "real_time_game_map()";
	lead_first_pass.setPosition(6*65, 55);
	place_name = null;
	//设置地图属性
	map.clear();
	map.clearTransmitPoint();
	map.setMapData(map_data_real_time_game);
	map.show_table_line = false;
	//往地图里添加主角对象
	map.add(lead_first_pass);
	
	//往地图里添加其他玩家
	for(var i = 0; i < otherPlayer.length; i ++)
	{
		otherPlayer[i].setPosition(6*65, 55);
		map.add(otherPlayer[i]);
		mini_map.addCrime(otherPlayer[i]);
	}
	//添加障碍物
	for(var i = 0; i < stones.length; i ++)
		map.add(stones[i]);
	
	//mini_map.addAnimal(npcs_animals_save[i]);
	mini_map.leader = lead_first_pass;
	scene_first_pass.add(mini_map);
	//scene_first_pass.add(scoring);							//往场景里添加计分器
	
	lead_first_pass.tussle = new Tussle(lead_first_pass);
	lead_first_pass.tussle.map_data = map_data_real_time_game;
	lead_first_pass.tussle.map_grid_width = map.getGridWidth();
	lead_first_pass.tussle.map_grid_height = map.getGridHeight();
	//发送炮弹
	lead_first_pass.send_bullet_call_func = function(){
		var mtype = new MTypeObject(MTYPE_SEND_BULLET, "");
		mtype.x = lead_first_pass.x;
		mtype.y = lead_first_pass.y;
		mtype.forward = lead_first_pass.forward;
		//发送炮弹
		imServer.sendMessage(mtype, function(){});
	};
	//设置击打到其他玩家的回调
	lead_first_pass.tussle.auf_call_func = function(enemy){
		score_current ++;
	}
	//血条产生变化的回调函数
	lead_first_pass.tussle.health_change_call_func = function(health){
		var mtype = new MTypeObject(MTYPE_UPDATE_HEALTH,"");
		mtype.health = health;
		imServer.sendMessage(mtype, function(){});
	}
	
	//主角死亡函数
	lead_first_pass.tussle.setDieCallFunc(function(obj){
		//system_dialog.setText(FRes.String.dialog.dialog_11);
		//system_dialog.visible = true;
		map.removeObject(this.parent);
		mini_map.remove(this.parent);
		alert("您已经死亡！");
		//imServer.sendMessage(new MTypeObject(MTYPE_OUT_HOUSE, ""), function(){});
		//imServer.onopen(null);							//死亡后回到页面重新登录
		//restartView();
		//allinit();
		//刷新页面
		location.reload();
	});
	
	
	initOtherPlay(player_list);
	scene_first_pass.enterScene(function(){
	});
}

//在玩家列表中
function isContainsPlayer(player,play_list){
	for(var i = 0; i < play_list.length; i ++){
		if(play_list[i].player_id == player.player_id && play_list[i].name == player.name){
			return true;
		}
	}
	return false;
}
/*
	2018.3.25
	唉，写这些代码的时候，我真的很伤心，满脑子都是那个女生的身影，我该怎么办？
	感觉已经失去了理想，，，真的很后悔，，，很后悔，为什么自己成熟的这么晚，真是傻子
*/
function initOtherPlay(player_list){
	for(var i = 0; i < otherPlayer.length; i ++){
		//包含就不管了
		if(isContainsPlayer(otherPlayer[i], player_list)){
		}
		else{
			//不包含的
			map.removeObject(otherPlayer[i]);					//从地图里移除该对象
			mini_map.remove(otherPlayer[i]);					//小地图里移除这个对象
			otherPlayer[i] = null;								//删掉她
		}
	}
	//重组数据
	var i, j;
	for(i = 0, j = 0; i < otherPlayer.length; i ++){
		if(otherPlayer[i] == null){
			continue;
		}
		otherPlayer[j] = otherPlayer[i];
		j ++;
	}
	//删除所有需要删的
	while(i > j){
		otherPlayer.pop();
		i --;
	}
	//将不包含的添加进来
	for(var i = 0; i < player_list.length; i ++){
		if(!isContainsPlayer(player_list[i], otherPlayer)){
			//将当前的用户添加进来
			var lfp = newLeader();							//添加一个新的领导进来
			lfp.player_id = player_list[i].id;
			lfp.name = player_list[i].name;
			lfp.sendBulletKeyDown = lfp.onkeydown;			//其他玩家发射炮弹
			lfp.onkeydown = null;							//阻止按键按下
			console.log(player_list[i]);
			
			//console.log(lfp);
			
			//添加打斗类
			lfp.tussle = new Tussle(lfp);
			lfp.tussle.map_data = map_data_real_time_game;
			lfp.tussle.map_grid_width = map.getGridWidth();
			lfp.tussle.map_grid_height = map.getGridHeight();
			lfp.tussle.setDieCallFunc(function(obj){
				
				map.removeObject(this.parent);
				mini_map.remove(this.parent);
			});
			
			otherPlayer.push(lfp);
			//添加到地图中去
			mini_map.addCrime(lfp);
			map.add(lfp);
		}
	}
	lead_first_pass.tussle.clearEnemys();
	
	//添加打斗类
	for(var i = 0; i < otherPlayer.length; i ++){
		otherPlayer[i].tussle.clearEnemys();
		otherPlayer[i].tussle.addEnemy(lead_first_pass);		//其他玩家添加当前玩家
		lead_first_pass.tussle.addEnemy(otherPlayer[i]);
		
		//添加其他的玩家
		for(var j = 0; j < otherPlayer.length; j ++){
			if(otherPlayer[i].player_id != otherPlayer[j].player_id){
				otherPlayer[i].tussle.addEnemy(otherPlayer[j]);
			}
		}
	}
	return;
	
	//添加npc
	for(var i = 0; i < otherPlayer.length; i ++)
	{
		map.add(otherPlayer[i]);
		//添加打斗对象
		otherPlayer[i].tussle = new Tussle(otherPlayer[i]);
		otherPlayer[i].tussle.map_data = map_data_real_time_game;
		otherPlayer[i].tussle.map_grid_width = map.getGridWidth();
		otherPlayer[i].tussle.map_grid_height = map.getGridHeight();
		
		otherPlayer[i].tussle.setDieCallFunc(function(obj){
			map.removeObject(this.parent);
			mini_map.remove(this.parent);
			//当前犯罪分子死亡，开启牢笼
			for(var i = 0; i < this.parent.die_expose_position.length; i ++)
			{
				map.removeObject( [this.parent.die_expose_position[i].y][this.parent.die_expose_position[i].x].object);	
				map_data_real_time_game[this.parent.die_expose_position[i].y][this.parent.die_expose_position[i].x].object = null;
				map_data_real_time_game[this.parent.die_expose_position[i].y][this.parent.die_expose_position[i].x].f = 0;
			}
			this.parent.die_expose_position = null;
			scoring.kill_enemy_count += 1;			//主角杀死的动物数量加1
		});
		
		lead_first_pass.tussle.addEnemy(otherPlayer[i]);
		otherPlayer[i].tussle.addEnemy(lead_first_pass);
	}
}