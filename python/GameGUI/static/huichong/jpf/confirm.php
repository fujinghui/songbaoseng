<?php
	session_start();
	if(isset($_POST['password']))
	{
		if(strcmp($_POST['password'], "JPF") == 0 || strcmp($_POST['password'], "jpf") == 0)
		{
			$_SESSION['login'] = 1;
			echo "<script>alert('密码验证成功！');window.location.href='manager.php';</script>";
		}
		else
		{
			echo "<script>alert('密码错误！');window.location.href='manager.php';</script>";
		}
	}
?>