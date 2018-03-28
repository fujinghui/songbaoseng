<meta charset="utf8">
<?php
	include_once("sql_connection.php");
	include_once("mvc/videolink.php");
	if($_FILES['file_picture']['error']>0)
	{
		echo "上传出错！";
	}
	else
	{
		$file = $_FILES['file_picture'];
		$sql = new FSQL();
		$sql->connections();
		$vlop = new VideoLinkOP();
		$v = new VideoLink();
		$v->video_link_id = null;
		$v->video_link_url = "";
		$v->video_link_img_src = md5($file['name'].date("Y-m-d H:i:s"));
		$v->video_link_context = "";
		
		
		if($vlop->insert($v, $sql))
		{
			echo "上传成功！<br />";
			if(move_uploaded_file($file["tmp_name"], "img/".$v->video_link_img_src) == false)
			{
				echo "<span style='color:#f00'>但是文件操作失败!（<span style='color:#ff0'>请返回删除该条记录</span>）</span>";
			}
		}
		else
			echo "插入数据库失败！";
		$sql->disconnect();
	}
?>