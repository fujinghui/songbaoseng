<?php
	session_start();
	include("phptools/tools.php");
	$name = $_POST['name'];
	$pwd = $_POST['pwd'];
	$confirm = $_POST['confirm_pwd'];
	if(strcmp($pwd, $confirm) == 0)
	{
		if(connectingDatabase()){
			if(TestRegister($name, $confirm) == true){
				$_SESSION['login_state'] = 1;
				echo "<script>alert('success!');location.href='index.php';</script>";
			}else
			{
				echo "<script>alert('faild!');location.href='index.php';</script>";
			}
			closeDatabase();
		}
	}
	else{
		echo "<script>alert('两次密码必需一致！');location.href='index.php';</script>";
	}
	
?>