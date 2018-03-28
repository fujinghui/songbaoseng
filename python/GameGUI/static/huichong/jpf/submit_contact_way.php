<meta charset="utf8">
<?php
	session_start();
	include_once("sql_connection.php");
	include_once("tools.php");
	if(isset($_POST['user_name']) && isset($_POST['context']) && isset($_POST['contact_way']))
	{
		$user_name = filter($_POST['user_name']);
		$context = filter($_POST['context']);
		$contact_way = filter($_POST['contact_way']);
		$sql = new FSQL();
		$sql->connections();			//链接
		$sql_query = "insert into word_blog values(null, '{$context}', '{$user_name}', '{$contact_way}', now())";
		$result = $sql->query($sql_query);
		if($result)
		{
			echo "<script>alert('留言成功！');window.location.href='word_blog.php';</script>";
		}
		else
		{
			echo "留言失败！";
		}
		$sql->disconnect();
	}
	else
		echo "请将所有信息填写完毕!";
?>