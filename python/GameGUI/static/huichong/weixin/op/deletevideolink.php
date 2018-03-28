<?php
	include_once("../sql_connection.php");
	include_once("../mvc/videolink.php");
	$status = 0;
	$c = 0;
	$data = "";
	if(isset($_POST['video_link_id']))
	{
		$sql = new FSQL();
		$sql->connections();
		
		$vlop = new VideoLinkOP();
		$v = new VideoLink();
		$v->video_link_id = $_POST['video_link_id'];
		if($vlop->delete($v, $sql))
		{
			@unlink("img/".$v->video_link_img_src);
			$status = 1;
		}
	}
	echo "{\"status\":\"{$status}\",";
	echo "\"count\":\"{$c}\",";
	echo "\"data\":\"{$data}\"}";
?>