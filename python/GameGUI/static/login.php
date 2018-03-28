<meta charset="utf8">
<?php
	@session_start();
	include("phptools/tools.php");
	$name = $_POST['name']; 
	$pwd = $_POST['pwd'];
	$state = TestLogin($name, $pwd);
	if($state)			//登录成功
	{
		$_SESSION['login_state'] = 1;
		echo "<script>window.location.href='index.php';</script>";
	}
	else
	{
		echo "<script>alert('用户名或密码错误！');window.location.href='index.php';</script>";
	}
	//echo $state;
	//header("location:index.php");
?>