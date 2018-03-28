<?php
	include_once("../sql_connection.php");
	include_once("../mvc/videolink.php");
	$status = 0;
	$c = 0;
	$data = "";
	//if(isset($_POST['video_link_id']))
	{
		$sql = new FSQL();
		$sql->connections();
		
		$vlop = new VideoLinkOP();
		$list = $vlop->gets($sql);
		$c = count($list);
		$data = json_encode($list);
		$sql->disconnect();
	}
	echo "{\"status\":\"{$status}\",";
	echo "\"count\":\"{$c}\",";
	echo "\"data\":{$data}}";
?>