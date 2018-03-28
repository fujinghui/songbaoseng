<?php
	session_start();
		function CheckSubstrs($substrs,$text){  
	        foreach($substrs as $substr){  
	            if(false!==strpos($text,$substr)){  
	                return true;  
	            }else{  
	                return false;  
	            }  
	        }  
	    }
	function isMobile1(){ 
	    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
	    $useragent_commentsblock=preg_match('|.∗?|',$useragent,$matches)>0?$matches[0]:'';  

	    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  
	    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
	       
	    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || CheckSubstrs($mobile_token_list,$useragent);  
	       
	    if ($found_mobile){  
	        return true;  
	    }else{    
	        return false;  
	    }  
	}
	function isMobile()
	{ 
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	    {
	        return true;
	    } 
	    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset ($_SERVER['HTTP_VIA']))
	    { 
	        // 找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    } 
	    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
	    if (isset ($_SERVER['HTTP_USER_AGENT']))
	    {
	        $clientkeywords = array ('nokia',
	            'sony',
	            'ericsson',
	            'mot',
	            'samsung',
	            'htc',
	            'sgh',
	            'lg',
	            'sharp',
	            'sie-',
	            'philips',
	            'panasonic',
	            'alcatel',
	            'lenovo',
	            'iphone',
	            'ipod',
	            'blackberry',
	            'meizu',
	            'android',
	            'netfront',
	            'symbian',
	            'ucweb',
	            'windowsce',
	            'palm',
	            'operamini',
	            'operamobi',
	            'openwave',
	            'nexusone',
	            'cldc',
	            'midp',
	            'wap',
	            'mobile'
	            ); 
	        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
	        {
	            return true;
	        } 
	    } 
	    // 协议法，因为有可能不准确，放到最后判断
	    if (isset ($_SERVER['HTTP_ACCEPT']))
	    { 
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
	        {
	            return true;
	        } 
	    } 
	    return false;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" >
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="x-share-icon" content="http://i5.51h5.com/item/1706/23/594cd1da0fbd1_wx.jpg"><meta name="x-share-desc" content="小伙伴们来吧，等你来挑战！"><meta name="screen-orientation" content="portrait"><meta name="x-key" content="2463d8c29321155343f3e747d7fc32cd"><meta name="x-id" content="3459">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	
		<title>救赎游戏</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		
		<style type="text/css" id="pc_phone">

		</style>
		<style type="text/css" >
			canvas{
				cursor:'hand'
			}
			.modal-dialog-f {
			    position: absolute; 
			    top: 0; 
			    bottom: 0; 
			    left: 0; 
			    right: 0; 
			}
			
			.modal-content-f {
			    /*overflow-y: scroll; */ 
			    position: absolute; 
			    top: 0; 
			    bottom: 0; 
			    width: 100%; 
			}
			.modal-body-f {
			    overflow-y: scroll; 
			    position: absolute; 
			    top: 55px; 
			    bottom: 65px; 
			    width: 100%; 
			}
			.modal-header-f .close-f {margin-right: 15px;}
			
			.modal-footer-f {
			    position: absolute; 
			    width: 100%; 
			    bottom: 0; 
			}
		</style>
		<!--<script language="JavaScript" src="js/tools.js" ></script>-->
		<script language="JavaScript" src="js/FemyEngine.js"></script>
		<script language="JavaScript" src="js/home.js" ></script>
		
		<script language="JavaScript">
		var FILE_TYPE_IMAGE = 0, FILE_TYPE_JS = 1, FILE_TYPE_MUSIC = 2, FILE_TYPE_SWF = 3;
		
		var canvas, context;
		var fps;
		var games = new Array();
		var scene;
		
		//加载的资源
		var res;
		var iamges_mj;
		
		//加载界面的对象
		var progress, loads;
		var scene_load;
		var canvas_x, canvas_y = 0;
		//flash游戏对象
		var flash_game_find, flash_game_car, flash_game_beng, flash_game_end;
		var flash_game_prompt;
		var plot_hint;
		var game_pause = false;
		var is_login = false;				//是否登录
		var user_name = "";
		var is_hint = true;					//是否有新手提示
		var game_progress = 0;				//游戏进度
		var current_scene = "";
		var myajax;
		//三个关卡的成绩
		var score1 = 0;
		var score2 = 0;
		var score3 = 0;
		function fmodal_open(id){
			var obj = document.getElementById(id);
			var s = document.createElement("div");
			s.setAttribute("class", "modal-backdrop fade in");
			var body = document.getElementById("main_body");
			
			body.setAttribute("class", "modal-open");
			body.appendChild(s);
			obj.setAttribute("class", "modal fade in");
			obj.setAttribute("aria-hidden", "false");
			obj.style.display = "block";
			
		}
		var flag_show = true;
		function fmodal_close(id){
			var obj = document.getElementById(id);
			document.getElementById("main_body").setAttribute("class", " ");
			obj.setAttribute("css", "modal fade");
			obj.style.display = "none";
			obj.setAttribute("aria-hidden","true");
			$("#main_body").find("div").last().remove();
			
			if(lead_first_pass && flag_show == true&& game_progress == 0 && lead_first_pass.x == 0 && lead_first_pass.y == 530)
			{
				flag_show = false;
				system_dialog.setText(FRes.String.dialog2.dialog_21);
				system_dialog.visible = true;
			}
		}
		function fmodal_transmit(resid, desid){
			fmodal_close(resid);
			fmodal_open(desid);
		}
		//关闭警示框
		function game_prompt_close(){
			flash_game_prompt.style.display = "none";
		}
		function game_end_close(){
			flash_game_end.style.display = "none";
		}
		function set_plot_hint(){
			var text = document.getElementById("plot_hint_text");
			if(game_progress < 2)
				text.innerHTML = FRes.String.plot_hint1;
			else if(game_progress < 6)
				text.innerHTML = FRes.String.plot_hint2;
			else if(game_progress < 11)
				text.innerHTML = FRes.String.plot_hint3;
			else if(game_progress < 12)
				text.innerHTML = FRes.String.plot_hint4;
		}
		function set_plot_hint_all(){
			var text = document.getElementById("plot_hint_text");
			text.innerHTML = FRes.String.plot_hintall;
		}
		//隐藏logo
		function logo_hide(){
			document.getElementById("logo_backward").style.display = "none";
			document.getElementById("logo_forward").style.display = "none";
		}
		//显示logo
		function logo_display(){
			document.getElementById("logo_backward").style.display = "";
			document.getElementById("logo_forward").style.display = "";
		}
		function load_from_server(){
			//game_progress:
			/*
			 * 0:刚进来
			 * 1:第一关闯关失败
			 * 2:第一个关卡闯关成功！
			 * 3:系统提示的独白
			 * 4:和老汉对话完毕
			 * 5:和肉贩子对话完毕后
			 * 6:第二关闯关成功
			 * 7:系统提示的独白（第一次到达安多县）
			 * 8:和医生npc对话完之后
			 * 9:可可西里第一个触发对话
			 * 10:可可西里第二个触发对话
			 * 11:第三个游戏闯关成功
			 * 12:第四个游戏闯关成功
			 */
			//game_progress = 11;
			//根据当前游戏进度设置
			
			//home_scene_enter();
			//real_time_game_map();
			lead_first_pass.x = 70;
			lead_first_pass.y = 320;
			map.x = 0;
			map.y = 0;
			//map.show_table_line = true;
			//slaughter_house_map();
			//animal_protect_house_map();
			//anduo_road_map();
			//anduo_map();
			//drugstore_map();
			//lead_first_pass.setPosition(200, 50);
			<?php
				if(isset($_SESSION['login_state']) && $_SESSION['login_state'] == 1)			//用户已经登录
				{
				//	echo "alert('".$_SESSION['y']."');\n";
					echo "game_progress=".$_SESSION['game_progress'].";\n";
					echo "current_scene='".$_SESSION['current_scene']."';\n";
					echo "lead_first_pass.x=".($_SESSION['x']%10000).";\n";
					echo "lead_first_pass.y=".($_SESSION['y']%10000).";\n";
					echo "map.x=".floor($_SESSION['x']/10000).";\n";
					echo "map.y=".floor($_SESSION['y']/10000).";\n";
					echo "score1=".$_SESSION['score1'].";\n";
					echo "score2=".$_SESSION['score2'].";\n";
					echo "score3=".$_SESSION['score3'].";\n";
					echo "score4=".$_SESSION['score4'].";\n";
					echo $_SESSION['current_scene'].";\n";
				}
			?>
			
			npc_dialog_init();
			npc_ai_init();
			//real_time_game_map();
			//kekexili_map();
			//home_scene_map();
		}
		/*
		 * 插入排序
		 * getURL("javascript:find_not_success()");
		 */
		function find_not_success(score){
			//玩家完成了当前游戏，直接到进度2
			game_progress = 2;
			npcs_animal_protect[0].dialog_text.setText(FRes.String.dialog2.dialog_3);
			npcs_animal_protect[0].dialog_text.visible = true;
			game_pause = true;
			npcs_animal_protect[0].dialog_text.setCallFunc(function(){
				//玩家已经成功了游戏，以下是该npc最终的显示文字
				npcs_animal_protect[0].dialog_text.setText(FRes.String.dialog2.dialog_5);
				npcs_animal_protect[0].dialog_text.setCallFunc(function(){});
			});

			npcs_main[0].dialog_text.setText(null);
			npcs_main[3].dialog_text.setText(FRes.String.dialog2.dialog_6);
			npcs_main[3].dialog_text.setCallFunc(function(){
				npcs_main[3].dialog_text.setText(FRes.String.dialog2.dialog_7);
				npcs_main[3].dialog_text.setCallFunc(function(){});
				game_progress = 4;
			});
			//设置肉贩市场npc对话
			npcs_slaughter[0].dialog_text.setText(FRes.String.dialog2.dialog_8);
			npcs_slaughter[0].dialog_text.setCallFunc(function(){
				npcs_slaughter[0].dialog_text.setText(FRes.String.dialog2.dialog_9);
				npcs_slaughter[0].dialog_text.setCallFunc(function(){});
				game_progress = 5;
			});
			score1 = score;
			find_close_window();
		}
		function find_not_faild(){
			//玩家没有完成此次测验，到进度1
			game_progress = 1;
			npcs_animal_protect[0].dialog_text.setText(FRes.String.dialog2.dialog_4);
			npcs_animal_protect[0].dialog_text.visible = true;
			npcs_animal_protect[0].dialog_text.setCallFunc(function(){
				npcs_animal_protect[0].dialog_text.setText(FRes.String.dialog2.dialog_2);
				npcs_animal_protect[0].dialog_text.visible = false;
				//
				npcs_animal_protect[0].dialog_text.text_index = -1;
				npcs_animal_protect[0].dialog_text.setCallFunc(function(){
					stop_music();
					flash_game_find.style.display = "";
					game_pause = true;
				});
			});
			find_close_window();
		}
		function find_close_window(){
			play_music(music_house);
			game_pause = false;
			flash_game_find.style.display = "none";
		}
		function car_not_success(score){
			map.x = 0;
			map.y = 0;
			lead_first_pass.setPosition(860, 50);
			map.removeObject(npc_car);
			game_progress = 6;
			system_dialog.setText(FRes.String.dialog2.dialog_11);
			system_dialog.visible = true;
			system_dialog.setCallFunc(function(){
				
			});
			score2 = score;
			car_close_window();
		}
		function car_not_faild(){
			car_close_window();
		}
		function car_close_window(){
			music_home_scene.play();
			game_pause = false;
			flash_game_car.style.display = "none";
		}
		
		function beng_not_success(score){
			game_progress = 11;			//玩家成功了第三个游戏，游戏进度到达11
			system_dialog.setText(FRes.String.dialog2.dialog_17);
			system_dialog.visible = true;
			system_dialog.setCallFunc(function(){
				
			});
			score3 = score;
			beng_close_window();
		}
		
		function beng_not_faild(){
			system_dialog.setText(FRes.String.dialog2.dialog_18);
			system_dialog.visible = true;
			system_dialog.setCallFunc(function(){
				game_progress = 8;
				scene_first_pass.exitScene(function(){
					//lead_first_pass.setPosition(800, 100);
					map.x = 200;
					map.y = 0;
					lead_first_pass.setPosition(1200, 80);
					anduo_map();
				});
			});
			beng_close_window();
		}
		function beng_close_window(){
			music_home_scene.play();
			game_pause = false;
			flash_game_beng.style.display = "none";
		}
		
		window.onload = function(){				
			//$("#my_canvas").attr("width", document.documentElement.clientWidth);
			//$("#my_canvas").attr("height", document.documentElement.clientHeight);
				
			//window.close();
			//var ss = [4, 3, 2, 5, 6, 1, 10, 9];
			//sorts(ss, 0, ss.length - 1);
			//console.log("result:"+ss);
			canvas = document.getElementById("my_canvas");
			var bbpx = canvas.getBoundingClientRect();
			canvas_x = bbpx.left;
			cavnas_y = bbpx.top;
			
			context = canvas.getContext("2d");
			context.textBaseline = "top";
			//获取flash对象资源
			flash_game_find = document.getElementById("flash_game_find");
			flash_game_car = document.getElementById("flash_game_car");
			flash_game_beng = document.getElementById("flash_game_beng");
			flash_game_end = document.getElementById("flash_game_end");
			flash_game_prompt = document.getElementById("flash_game_prompt");
			
			flash_game_find.style.left = ((canvas.width-flash_game_find.width)/2)+"px";
			flash_game_find.style.top = ((canvas.height-flash_game_find.height)/2)+"px";
			flash_game_car.style.left = ((canvas.width-flash_game_car.width)/2)+"px";
			flash_game_car.style.top = ((canvas.height-flash_game_car.height)/2)+"px";
			flash_game_beng.style.left = flash_game_find.style.left;
			flash_game_beng.style.top = flash_game_find.style.top;
			flash_game_end.style.left = ((canvas.width-flash_game_end.width)/2) + "px";
			flash_game_end.style.top = ((canvas.height - flash_game_end.height)/2) + "px";
			flash_game_prompt.style.left = ((canvas.width-flash_game_prompt.width)/2)+"px";
			flash_game_prompt.style.top = ((canvas.height-flash_game_prompt.height)/2)+"px";

			
			//console.log(plot_hint.style.width);
		//	plot_hint.style.left = ((canvas.width-400)/2)+"px";
		//	plot_hint.style.top = ((canvas.height-400)/2)+"px";
		//	fmodal_open("plot_hint");
			
			//flash_game_end.style.display = "";
			//flash_game_find.style.display = "";
			//显示flash
			//flash_game_find.style.display = "";
			scene_load = new FGAMES.Scene();
			scene_load.setCanvas(canvas);
			scene_load.setBackgroundColor(20, 25, 20);
			//进度条对象
			progress = new ProgressBarImage();
			//progress.init((canvas.width - 400)/2, (canvas.height-100)/2, 400, 20);
			progress.init(scene_load.getContextBuffer(), "img/home_progress.png", (canvas.width - 353) / 2, (canvas.height - 34) / 2);
			progress.setProgress(0);
			
			loads = new Load();
			res = new Array();
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/home_progress.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/Image1.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/text.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/tools.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/home_background.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button_style.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button_style_click.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/home_earth.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/background_sky.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/mj.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/road.bmp',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/atlas.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/houses.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/map_res.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/map_data.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/GameObject.js',
				object:null
			});
			//加载任人物资源
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/leading.png',
				object:null
			});
			//加载游戏
			res.push({
				type:FILE_TYPE_JS,
				path:'js/Game.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'other_res/test_character.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/trees.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/resources.js',
				object:null
			});
			//21
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/roads.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/bubble.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/arithmetic.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/tufu.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_JS,
				path:'js/Game2.js',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/lead_qiang.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/zhangguan.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/animals.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_MUSIC,
				path:'music/hint.mp3',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/background_image.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/car.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/daolie1.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/daolie2.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/daolie3.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button1.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button1_click.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button2.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/button2_click.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/laohan.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/dialog_text_background.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/transmit_point.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/china_animals_protect.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/china_animals_protect.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/drugstore.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/meat_market.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/bullet.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/animals_save.png',
				object:null
			});
			
			
			res.push({
				type:FILE_TYPE_MUSIC,
				path:'music/home_scene.mp3',
				object:null				
			});
			res.push({
				type:FILE_TYPE_MUSIC,
				path:'music/music_house.mp3',
				object:null
			});
			res.push({
				type:FILE_TYPE_MUSIC,
				path:'music/tufu.mp3',
				object:null
			});
			res.push({
				type:FILE_TYPE_MUSIC,
				path:'music/beng.mp3',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/dimian.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/user_info_background.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/space.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/ranklist_background.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/ranklist.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/dialog_background.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/dialog_background_small.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/phone_shou3.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/phone_qiang.png',
				object:null
			});
			res.push({
				type:FILE_TYPE_IMAGE,
				path:'img/phone_jiu.png',
				object:null
			});
			
			//res.push({
			//	type:FILE_TYPE_SWF,
			//	path:'flash/flash.swf',
			//	object:null
			//});
			/*
			for(var i = 1; i <= 49 ; i ++)
			{
				res.push({
					type:FILE_TYPE_IMAGE,
					path:"img/people/people00"+i+".png",
					object:null
				});
				if(i < 10)
				{
					res[res.length - 1].path = "img/people/people000"+i+".png";
				}
			}
			*/
			
			loads.load(res, load_completion);
			scene_load.add(progress);
			//scene_load.setBackgroundColor(255, 255, 255);
		//	canvas.onmouseover = function(){
		//		this.style.cursor = 'pointer';
				//pointer:手型
				//Crosshair                         :十字架
		//	}
			load_draw();
		}
		
		var is_load = false;
		function load_draw(){
			scene_load.render();
			progress.setProgress(loads.getLoadProgress());
			//判断资源是否加载完毕(并且进度条动画也结束了)，如果都加载完毕了，则退出加载界面
			if(is_load && progress.getParticesCount() == 0)
			{
				<?php
				//User user = (User)request.getSession().getAttribute("user");
				if(isset($_SESSION['login_state']))
				{
					echo "is_login = true\n;";
					echo "user_name=\"".$_SESSION['name']."\";\n";
				}
				?>
				//用户已登录，开始进入游戏
				if(is_login == true)
				{
					scene_load.clearAll();
					scene_load.setBackgroundImage('img/background_image.png');
					scene_load.exitScene(init_first_pass);//init
				}
				//未登录，弹出模态框让用户登录
				else
				{
           			//$("#login-modal").modal();
           			fmodal_open("login-modal");
				}
			}
			else
				requestAnimationFrame(load_draw);
		}
		
		//所有的资源赋值语句
		//var angle = 0.0;
		//var angle_v = 0.04;
		//地图资源对象
		var map = new FGAMES.Map();
		var map_home = new FGAMES.Map();						//主要场景地图
		//资源加载完毕函数
		//在这里进行资源的赋值
		function load_completion(){
			progress.setProgress(100);
			progress.setParticesProduces(false);				//不再产生粒子
			is_load = true;
			init_resources();
			//销毁res所占用的内存空间
			while(res.length)
				res.pop();
			
			//初始化后面游戏所要用到的资源
			init_all_res();
		}
		
		function init_resources(){
			//资源加载完毕，获取资源
			map.addImage(res[9].object);
			map.addImage(res[10].object);
			map.addImage(res[12].object);
			map.addImage(res[13].object)
			map.addImage(res[21].object);
			var im = new Image();
			im.src = "img/dimian.png";
			map.addImage(im);
			//map.setMapData(map_data_home1);
			
			
			fps = new FPS();
		}
		
		//进入动画的界面
		var enter_text;
		var enter_text_prompt;
		var enter_scene;
		var text_show_end = false;
		var exit_enter_scene = false;
		function init_enter(){
			enter_scene = new FGAMES.Scene();
			enter_scene.setCanvas(canvas);
			enter_scene.setBackgroundColor(10, 20, 10);
			
			enter_text = new FGAMES.Text("据中国野生动物保护协会称：xx犯罪集团为牟取\n"+
										 "利益,在我国可可西里地区大肆扑杀藏羚羊，盗取\n"+
										 "毛皮，使可可西里的藏羚羊数量锐减，严重的破\n"+
										 "坏了当地的生态平衡\n");
			enter_text.setFontSize(20);
			enter_text.setTextColor(125, 200, 125);
			enter_text.x = (canvas.width - enter_text.getWidth(context)) / 2; enter_text.y = 0;
			enter_text.rotate_center_x = 0;
			enter_text.IncreaseEnable(true);
			//enter_text.AlphaEnable(true);
			var timer = new FGAMES.Timer();
			//添加定时器
			timer.add({
				time:20
			});
			enter_text.InstallTimer(timer);
			enter_text.setTimerEnable(true);
			
			enter_text.setEndFunc(function(){
				text_show_end = true;
				//enter_text.resetText();
				//enter_text.setTimerEnable(false);
				//当文字全部显示完毕后，设置文字显示
				enter_text_prompt.setVisible(true);
			});
			var timer2 = new FGAMES.Timer();
			timer2.add({
				time:10
			});
			
			enter_text_prompt = new FGAMES.Text("请点击任意区域继续...");
			enter_text_prompt.setFontSize(30);
			enter_text_prompt.setTextColor(255, 255, 125);
			enter_text_prompt.x = (canvas.width - enter_text_prompt.getWidth(context)) / 2;
			enter_text_prompt.y = 400;
			enter_text_prompt.AlphaEnable(true);
			enter_text_prompt.InstallTimer(timer2);
			enter_text_prompt.setTimerEnable(true);
			enter_text_prompt.setVisible(false);
			
			enter_scene.add(enter_text);
			enter_scene.add(enter_text_prompt);
			
			//enter_scene.big_mirror_enable = true;	//开启放大镜
			enter_scene.setBigMirrorEnable(false);
			
			//enter_scene.renderBuffer();			//先渲染一片缓冲区
			enter_scene.enterScene(draw_enter);	//开始进入动画
			enter_scene.addMouseUp(function(){
				//当文字显示完毕时，可以处理用户点击屏幕的事件
				if(text_show_end == true)
					exit_enter_scene = true;
			});
		}
		
		function draw_enter(){
			enter_scene.render();
			//文字显示完毕，退出当前场景，进入下一个场景
			if(exit_enter_scene == true)
			{
				enter_scene.exitScene(init);
			}
			else
				requestAnimationFrame(draw_enter);
		}
		
		//主界面对象
		var scene_home;
		var text_home;
		var button_start_game, button_help, button_register, button_login;
		//图像文件
		var home_people;
		var home_earth;
		var home_background;
		var home_car;
		var lead;
		var home_is_loop = true;
		function init(){	
			scene_load.clearAll();			//清理所有资源
			scene_load = null;
			button_start_game = new FGAMES.Button("开始游戏");
			button_help = new FGAMES.Button("帮助");
			button_register = new FGAMES.Button("登录");
			button_login = new FGAMES.Button("注册");
			//设置监听器
			button_start_game.addOnClickListener(function(e){
				home_is_loop = false;
				scene.exitScene(init_first_pass);
			//	console.log("click");
			});
			button_start_game.addMouseDown(function(e){
			//	console.log("x:"+e.x+" y:"+e.y+" down");
			});
			button_start_game.addMouseUp(function(e){
			//	console.log("x:"+e.x+" y:"+e.y+" up");
			});
			button_start_game.addOnTouch(function(e){
			//	console.log("x:"+e.x+" y:"+e.y+" ontouch");
			});
			//监听器设置
			button_register.addOnIn(function(e){
				button_register.setTextColor(255, 0, 0);
			});
			button_register.addOnOut(function(){
				button_register.setTextColor(0, 0, 0);
			});
			button_login.addOnIn(function(e){
				button_login.setTextColor(255, 0, 0);
			});
			button_login.addOnOut(function(e){
				button_login.setTextColor(0, 0, 0);
			});
			button_register.background_is_exist = false;
			button_login.background_is_exist = false;
			
			button_start_game.setPosition(240, 500);
			button_help.setPosition(380, 500);
			button_register.setPosition(900, 10);
			button_login.setPosition(940, 10);
			
		//	button_exit_game.setDefaultBackgroundColor(255, 125, 0);
		//	button_exit_game.setOnTouchBackgroundColor(0, 0, 255);
			button_start_game.setTextSize(20);
			button_start_game.setDefaultBackgroundImage("img/button_style.png");
			button_start_game.setOnTouchBackgroundImage("img/button_style_click.png");
			button_start_game.setTextColor(255, 0, 0);
			//button_start_game.background_is_exist = false;				//设置不存在背景
			
			button_help.setTextSize(20);
			button_help.setDefaultBackgroundImage("img/button_style.png");
			button_help.setOnTouchBackgroundImage("img/button_style_click.png");
			button_help.setTextColor(255, 0, 0);
			
			//canvas.style.background = "rgb(180, 200, 180)";
			
			scene = new FGAMES.Scene();
			scene.setCanvas(canvas);
			//scene.setBackgroundColor(200, 240, 200);
			scene.setBackgroundColor(255, 255, 255);
			
			home_people = FGAMES.CreateCharacter();
			var res_img = new Array();
			for(var i = 01; i < 50; i ++)
			{
				res_img.push("img/people/people00"+i+".png");
				if(i < 10)
				{
					res_img[res_img.length - 1] = "img/people/people000"+i+".png";
				}
			}
			//home people
			home_people.init(res_img);
			home_people.setWH(154, 139);
			home_people.setPosition(0, canvas.height-home_people.getHeight());
			home_people.setUpdateTime(33);
			
			home_earth = FGAMES.CreateCharacter();
			home_earth.init(["img/home_earth.png"]);
			home_earth.setWH(800, 800);
			home_earth.setRotatePosition(400, 400);
			home_earth.setPosition(0, canvas.height - home_earth.getHeight() / 2);
			
			home_background = FGAMES.CreateCharacter();
			home_background.init(["img/background_sky.png"]);
			home_background.setWH(800, 600);
			home_background.setPosition(0, 0);
			
			var y = 0;
			for(var i = 0; i < 1000 ; i ++)
			{
				games[i] = FGAMES.CreateCharacter();
				games[i].init(["img/Image1.png", "img/Image2.png", "img/Image3.png"]);
				games[i].setWH(40, 40);
				games[i].setRotatePosition(20, 20);
				games[i].setUpdateTime(100);
				games[i].setPosition(i * 40 - y * canvas.width, y * 40);
				if(i * 40 - y * canvas.width >= canvas.width - 40)
				{
					y ++;
				}
				if(y * 40 >= canvas.height)
					y = 0;
			}
			//car 
//			home_car = new FGAMES.Character();
//			home_car.setUpdateTime(500);
//			home_car.init(['img/atlas.png']);
//			home_car.addFrame({i:0, x:0, y:630, width:25, height:50});
//			home_car.addFrame({i:0, x:0, y:680, width:25, height:50});
//			home_car.setPosition(10, 200);
//			home_car.setShowFrameRange(0, 1);
			home_car = new Car();
			home_car.init(['img/atlas.png']);
			home_car.addFrame({i:0, x:0, y:630, width:25, height:50});
			home_car.grid_width = 65; home_car.grid_height = 55;
			home_car.setGridPosition(0, 9);
			home_car.setDestionGridPosition(1, 9);
			home_car.vx = 1;
			home_car.destion_angle = Math.PI / 2;
			home_car.setMapData(map_data_home);
			//home_car.setWH(25, 20);
			
			home_car.map_data = map_data_home;
			//map.add(home_car);					//将小车对象添加到地图对象里去
			
			
			scene.add(map);
			scene.add(home_people);
			scene.add(button_start_game);
			scene.add(button_help);
			scene.add(button_register);
			scene.add(button_login);
			
			scene.addKeyDown(function(e){
				
			});
			
			scene.setBigMirrorEnable(false);
			
			//scene.setBackgroundImage("img/home_background.png");
			scene.renderBuffer();
			scene.enterScene(draw);
			
		//	draw();
		}
		
		function draw(){
			for(var i = 0; i < games.length; i ++)
			{
				games[i].rotate(angle);
				//games[i].x+= 1;
				//games[i].y+= 1;
			}
			angle += angle_v;
			if(angle >= Math.PI || angle < 0.0)
				angle_v = - angle_v;
			
			//text_home.toRight();
			home_earth.rotate(home_earth.getRotateAngle() + 0.001);
			scene.render();
			
			//scene.getContext().drawImage(document.getElementById("my_images"), 0, 0)
			if(home_is_loop == true)
				requestAnimationFrame(draw);
		}
		</script>
	</head>
	<body id="main_body" style="background-color:#ccccff">
		<div id="my_div" style="width:1024px;height:610px;margin:0 auto;cursor:default;position:relative;border:0px solid #00ff00">
			<canvas id="my_canvas" width="1024" height="600" style="background:#101010;margin:0px;;padding: 0;display: block;border:0px solid #5a0;">
			
			</canvas>
			<img id="my_images" src="img/logo.gif" style="display:none"></img>
			
			<object id="flash_game_find" style="display:none;position:absolute;left:0px;right:0px;" type="application/x-shockwave-flash" data="flash/<?php 
				if(isMobile()) 
					echo "find_2.swf";
				else
					echo "find.swf";
				
				?>" width="800" height="500">
  				<param name="WMODE" value="transparent">
			</object>
			<object id="flash_game_car" style="display:none;position:absolute;left:0px;top:0px;" type="application/x-shockwave-flash" data="flash/<?php 
				if(isMobile())
					echo "car_2.swf";
				else
					echo "car.swf";
				?>" width="650" height="400">
				<param name="WMODE" value="transparent">
			</object>
			<object id="flash_game_beng" style="display:none;position:absolute;" type="application/x-shockwave-flash" data="flash/<?php
				if(isMobile())
					echo "beng_2.swf";
				else
					echo "beng.swf";
				?>" width="800" height="500">
				<param name="WMODE" value="transparent">
			</object>
			<object id="flash_game_end" style="display:none;position:absolute;" type="application/x-shockwave-flash" data="flash/end.swf" width="1220" height="620">
				<param name="WMODE" value="transparent">
			</object>
			<object id="flash_game_prompt" style="display:none;position:absolute;" type="application/x-shockwave-flash" data="flash/prompt.swf" width="1220" height="620">
				<param name="WMODE" value="transparent">
			</object>
			<object id="flash_game_test" style="display:none;position:absolute;left:10px;top:10px;" type="application/x-shockwave-flash" data="flash/test.swf" width="300" height="200">
			</object>
			<object id="flash_game_test" style="display:'';position:absolute;left:10px;bottom:10px;" type="application/x-shockwave-flash" data="flash/copyright.swf" width="300" height="36">
				<param name="WMODE" value="transparent">
			</object>
			
			
			
			<!--
	        	作者：772725447@qq.com
	        	时间：2017-04-03
	        	描述：情节提示框
	       
			<div id="plot_hint" class="row pre-scrollable" width="400" height="400" style="font-size:25px;position:absolute;left:10px;top:10px;;width:400px;height:400px;border:1px solid #ff0">
				faskfdhakjshffasdfadfadfadffasfasdfa
				sfdkjafa
				faksdjf
				fdkajsfd
				fdkjafs
				
				
			</div>
			-->
		
		<img id="logo_backward" src="img/logo_back.png" style="position:absolute;width:120;height:120px;left:-5px;top:20px;"></img>
		<img id="logo_forward" src="img/logo.gif" style="position:absolute;left:0px;top:25px;width:110px;height:110px;"></img>
		
		<!--<img src="img/logo2.png" style="position:absolute;width:120;height:120px;left:0px;top:0px;"></img>	
		-->
		</div>
		<!-- 登录 -->
		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"
			aria-labelledby="modal-label" aria-hidden="false" >
			<div class="modal-dialog" style="width:300px;">
				<div class="modal-content" style="background:url(img/login_register.png);background-size:cover;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick="fmodal_close('login-modal')">
							<span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title" id="modal-label">登录</h4>
					</div>
					<div class="modal-body">
						<form action="login.php" method="post" >
							用户名：<input type="input" name="name" class="form-control" ></input><br /><br />
							密&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd" class="form-control" ></input><br /><br  >
							<div style="text-align: center;">
								<input type="submit" class="btn btn-default" class="form-control" value="登录" style="width:220px;background:url(img/color4.bmp)"></input>
							</div>
						</form>
					</div>
					<div class="modal-footer">

						<button type="button" onclick="fmodal_transmit('login-modal', 'register-modal')" style="background:url(img/color3.bmp)" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#register-modal">
							注册
						</button>
					</div>
				</div>
			</div>
		</div>
		
		<!--注册-->
		<div class="modal fade" id="register-modal" tabindex="-1" role="dialog"
			aria-labelledby="modal-label" aria-hidden="false">
			<div class="modal-dialog" style="width:300px;" >
				<div class="modal-content" style="background:url(img/login_register.png);background-size: cover;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick="fmodal_close('register-modal')">
							<span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title" id="modal-label">注册</h4>
					</div>
					<div class="modal-body">
						<form action="register.php" method="post">
							用&nbsp;户&nbsp;名：<input type="input" name="name" class="form-control"></input><br /><br />
							密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd" class="form-control" ></input><br /><br  >
							确认密码：<input type="password" name="confirm_pwd"class="form-control"></input><br /><br />
							<div style="text-align: center;">
								<input type="submit" class="btn btn-default" class="btn btn-default" value="注册" style="width:220px;background:url(img/color4.bmp)"></input>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="fmodal_transmit('register-modal','login-modal')" style="background:url(img/color3.bmp)" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">
							登录
						</button>
					</div>
				</div>
			</div>
		</div>
		
		
		<!--
        	作者：772725447@qq.com
        	时间：2017-04-03
        	描述：用户情节提示框
       -->
		<div class="modal fade" id="plot_hint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-f" >
                                                      <!--
                                                      	作者：772725447@qq.com
                                                      	时间：2017-04-04
                                                      	描述：background:#44DD66;height:400px;
                                                      -->
		        <div class="modal-content modal-content-f" style="height:400px;background:url(img/ranklist2.png);background-size: cover;">
		            <div class="modal-header modal-header-f" style="font-weight: bold;">
		                <button type="button" class="close" data-dismiss="modal" onclick="fmodal_close('plot_hint')">
		                    <span aria-hidden="true">&times;</span><span class="sr-only"><sp:message code="sys.close" /></span>
		                </button>
		                <h4 class="modal-title" id="myModalLabel"><sp:message code="user.info"/>本关剧情提示：<sp:message code="sys.edit"/></h4>
		            </div>
		            <div class="modal-body modal-body-f" >
		                    <div class="form-group" style="font-size:25px;" id="plot_hint_text">
		                    </div>
		            </div>
		            <!-- modal-body END -->
		            <div class="modal-footer modal-footer-f">
		            	<a id="" type="" class="btn btn-primary" onclick="set_plot_hint_all()">所有剧情</a>
		            	<button id="" type="" class="btn btn-primary" onclick="set_plot_hint()">当前剧情</button>
		                <button id="btn-submit" type="submit" class="btn btn-primary" onclick="fmodal_close('plot_hint')"><sp:message code="sys.submit"/>确定</button>
		            </div>
		        </div>
		    </div>
		</div>
		
		
		<!-- <p><a data-toggle="modal" href="#login-modal" class="btn btn-primary btn-large">发动演示模态框</a></p> 
		-->
		<script language="javascript">
			var s = document.getElementById("my_a_id");
			//s.submit();
			//alert(s);
		</script>
	</body>
	<script src="js/jquery-1.11.1.min.js"></script>
	<!--<script src="js/bootstrap.min.js"></script>
	-->
</html>
