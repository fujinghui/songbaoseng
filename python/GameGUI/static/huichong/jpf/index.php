<meta charset="utf8">
<html>
	<head>
		<title>慧宠趣视频</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/jquery.mobile.icons.min.css" >
		<link rel="stylesheet" href="css/femy.min.css" >
		
		
		<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery.mobile-1.4.5.min.js"></script>
	</head>
	<body>
		<div data-role="page" data-theme="d">
			<div data-role="header" data-t>
				<h1>狗狗训练视频</h1>
			</div>
			<div data-role="content">
				<ul data-role="listview">
					<?php 
						include_once("sql_connection.php");
						include_once("mvc/videolink.php");
						$sql = new FSQL();
						$sql->connections();
						
						$vlop = new VideoLinkOP();
						$list = $vlop->gets($sql);
						for($i = 0; $i < count($list); $i ++)
						{
							$obj = $list[$i];
					?>
						<li data-icon="false"><a href="<?php echo $obj->video_link_url;?>" data-ajax="false"><img src="img/<?php echo $obj->video_link_img_src;?>" style="height:100px;width:100px;"><span><?php echo $obj->video_link_context;?></span></a></li>
					<!--
						<li><a href="https://v.qq.com/x/page/q0511qdfkcj.html"><img src="img/1.png" style="height:100px;width:100px;"><span>狗狗向你示好啦！</span></a></li>
						<li><a href="https://v.qq.com/x/page/g0511vsovze.html"><img src="img/2.png" style="height:100px;width:100px;"><span>可爱边牧宝宝滑滑板</span></a></li>
					-->
					<?php 
						}
					?>
				</ul>
			</div>
			<?php 
				$sql->disconnect();
			?>
		</div>
	</body>
</html>