<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>狗狗训练营</title>
		<!-- bootstrap插件 -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/femy.css" rel="stylesheet">
		<script src="css/bootstrap-theme.min.css"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<form action="submit_contact_way.php" method="post" class="form-inline">
			
			您的姓名：<input type="text" name="user_name" maxlength="32" class="form-control"><br/><br/>
			留言：<textarea class="form-control"style="width:90%;height:300px;margin-left:10px;" name="context" maxlength="1024"></textarea><br/>
			联系方式：<input class="form-control"type="text" placeholder="手机号码或者邮箱" name="contact_way" maxlength="32" onkeyup=""><br />
			<input class="pull-right btn btn-info" type="submit" value="提交" class="form-control">
			
		</form>
	</body>
</html>