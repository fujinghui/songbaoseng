<?php
	session_start();
	if(isset($_POST['password']))
	{
		if(strcmp($_POST['password'], "JPF") == 0 || strcmp($_POST['password'], "jpf") == 0)
		{
			$_SESSION['login'] = 1;
			echo "<script>alert('������֤�ɹ���');window.location.href='manager.php';</script>";
		}
		else
		{
			echo "<script>alert('�������');window.location.href='manager.php';</script>";
		}
	}
?>