<!DOCTYPE html>
<?php
	@session_start();
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>狗狗训练营</title>
		<!-- bootstrap插件 -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/femy.css" rel="stylesheet">
		<script src="css/bootstrap-theme.min.css"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<!-- clock -->
		<script src="js/data.js" ></script>
		<script src="js/clock.js" ></script>
		<style type="text/css">
			.row div ul li a{
				background:
			}
			.row div ul li a:hover{
				-webkit-transition:background-color 0.2s ease-in;
				transition:background-color 0.2s ease-in;
				background-color:#eee;
				color:#555;
			}
			.row div ul li:hover{
				-webkit-transition:background-color 0.2s ease-in;
				transition:background-color 0.2s ease-in;
				background-color:#eee;
			}
			li{
				word-break: break-all;
				word-wrap: break-word;
			}
		</style>
		<script language="javascript">
			function UpdateVideoLink(obj, id){
				var sobj = $(obj).parent().parent().find("textarea");
				var url = sobj[0].value;
				var src = sobj[1].value;
				var context = sobj[2].value;
				
				$.post("op/updatevideolink.php", {video_link_id:id, video_link_url:url, video_link_img_src:src, video_link_context:context}, function(data){
					console.log(data);
					var s = JSON.parse(data);
					if(s.status == 1)
					{
						alert("修改成功！");
					}
				});
			}
			
			function DeleteVideoLink(obj, id){
				$.post("op/deletevideolink.php", {video_link_id:id}, function(data){
					console.log(data);
					var s = JSON.parse(data);
					if(s.status == 1)
					{
						alert("删除成功！");
						$(obj).parent().parent().parent().parent().remove();
					}
				});
			}
			
			function SetVideoLink(){
				$.post("op/getvideolinks.php", {}, function(data){
					var s = JSON.parse(data);
					console.log(data);
					
					var show_text = "<div style='margin-top:10px;'><ul class='list-group'>";
					for(var i = 0; i < s.count; i ++)
					{
						show_text += "<li class='list-group-item' style='background:#fff;'><div class='row' style='margin-left:10px;'><div class='form-inline'>";
						show_text += "<img src=\"img/"+s.data[i].video_link_img_src+"\" style=\"width:100px;height:100px;\"/>";
						
						show_text += "<textarea style='height:100px;width:100px;' class='form-control' placeholder=''>";
						show_text += s.data[i].video_link_url;
						show_text += "</textarea>";
						show_text += "<textarea type='hidden' style='height:100px;width:100px;display:none' class='form-control' placeholder=''>";
						show_text += s.data[i].video_link_img_src;
						show_text += "</textarea>";
						show_text += "<textarea style='height:100px;width:100px;' class='form-control' placeholder=''>";
						show_text += s.data[i].video_link_context;
						show_text += "</textarea>";
							
						show_text += "<div class='pull-right'>";
						show_text += "<a href='javascript:void(0)' onclick='UpdateVideoLink(this, "+s.data[i].video_link_id+")' class='btn btn-warning'>确认修改</a>";
						show_text += "<a href='javascript:void(0)' onclick='DeleteVideoLink(this, "+s.data[i].video_link_id+")' class='btn btn-danger'>删除</a>";
						show_text += "</div>"
						
						show_text += "</div></div></li>";
					}
					show_text += "</ul></div>";
					
                    show_text += "<form method=\"post\" id='form_picture' action=\"uploadimage.php\" enctype=\"multipart/form-data\"><div class=\"form-group\">"+
                    "<label class=\"col-sm-4 control-label\">请选择文件：</label><div class=\"col-sm-8\"><input type=\"file\" class=\"form-control\" name=\"file_picture\">"+
                    "</div></div><br /><div class=\"form-group\">&nbsp;&nbsp;<button type=\"submit\" class=\"btn btn-info\">上传</button></div></form>";
					$("#show_tools").html(show_text);
					
				});
			}
		</script>
	</head>
	<body style="background:#ffc">
		<?php
			include_once("sql_connection.php");
			
			if(isset($_SESSION['login']))
			{
				
			$sql = new FSQL();
			$sql->connections();	
		?>
			<!---- navbar-fixed-top --->
				<nav class="navbar navbar-default" role="navigation" style="box-shadow:5px 10px 0px rgba(100, 100, 100, 0.1)">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
									data-target="#demo-navbar" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="huichong.php">慧宠微信视频链接管理</a>
						</div>
						<div class="collapse navbar-collapse" id="demo-navbar">
							<ul class="nav navbar-nav ">
							</ul>
							 <ul class="nav navbar-nav navbar-right ">
							
							 </ul>
						</div>
					</div>
				</nav>
				
				<!--- 用户菜单选项 --->
				<!-- visible-lg visible-md -->
				<div class="container" style="background-color:#fff;position:fixed;width:200px;height: calc(100% - 80px);box-shadow:6px 2px 10px rgba(100, 0, 0, 0.2) ">
					<div class="row">
						<div class="span1">
							<ul class="nav nav-list slide" >
								<li class="nav-header"><h3 style="color:#999">慧宠微信视频链接管理</h3></li>
								
								<li><a href="javascript:void(0)" onclick="SetVideoLink()">设置链接文字</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- 功能展示区 -->
				<div id="show_tools" class="container pre-scrollable" style="max-height: calc(100% - 80px);border-radius:10px;background-color:#ffe;width: calc(100% - 240px); position:fixed;left:230px;box-shadow:5px 5px 10px rgba(0, 0, 0, 0.2)">
					
				</div>
				<?php
					}
					else
					{
				?>
					<div class="container" style="">
						<h1><span style="color:#0aabff">请输入管理密码：</span></h1>
						<form method="post" action="confirm.php">
							<input type="password" class="form-control" name="password" placeholder="请输入密码">
							<br />
							<input type="submit" class="form-control btn-info" style="background:#aaaaf" value="确认">
						</form>
						<br />
						<div style="width:400px;height:300px;margin:0px auto;" >
							<canvas id="clock_canvas" width="400" height="300" style="">
							
							</canvas>
						</div>
					</div>
				<?php
				}
				?>
	</body>
</html>

