<?php
	include_once("../sql_connection.php");
	include_once("../mvc/videolink.php");
	$status = 0;
	$c = 0;
	if(isset($_POST['video_link_id']) && isset($_POST['video_link_url']) && isset($_POST['video_link_img_src']) && isset($_POST['video_link_context']))
	{
		$sql = new FSQL();
		$sql->connections();
		
		$vlop = new VideoLinkOP();
		$v = new VideoLink();
		$v->video_link_id = $_POST['video_link_id'];
		$v->video_link_url = $_POST['video_link_url'];
		$v->video_link_img_src = $_POST['video_link_img_src'];
		$v->video_link_context = $_POST['video_link_context'];
		if($vlop->update($v, $sql))
		{
			$status = 1;
		}
		$sql->disconnect();
	}
	echo "{\"status\":\"{$status}\",";
	echo "\"count\":\"{$c}\"}";
?>