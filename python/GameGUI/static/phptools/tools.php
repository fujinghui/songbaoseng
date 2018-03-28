<?php
	include("connection.php");
	function TestLogin($name, $pwd){
		$r = false;
		if(connectingDatabase())
		{
			$sql = "select * from user where name='$name' and pwd='$pwd'";
			$result = mysql_query($sql);
			if($result && $row = mysql_fetch_array($result))	//登录成功
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['pwd'] = $row['pwd'];
				$_SESSION['game_progress'] = $row['game_progress'];
				$_SESSION['current_scene'] = $row['current_scene'];
				$_SESSION['x'] = $row['x'];
				$_SESSION['y'] = $row['y'];
				$_SESSION['score1'] = $row['score1'];
				$_SESSION['score2'] = $row['score2'];
				$_SESSION['score3'] = $row['score3'];
				$_SESSION['score4'] = $row['score4'];
				$r = true;
			}
			closeDatabase();
		}
		return $r;
	}
	function TestRegister($name, $pwd){
		$r = false;
		if(connectingDatabase())
		{
			$current_scene = "home_scene_map()";
			$game_progress = 0;
			$x = 0;$y = 530;	
			$score1 = 0; $score2 = 0; $score3 = 0; $score4 = 0;
			$sql = "insert into user(id, name, pwd, game_progress, current_scene, x, y, score1, score2, score3, score4) values(null, '$name', '$pwd', $game_progress, '$current_scene', $x, $y, $score1, $score2, $score3,$score4)";
			$result = mysql_query($sql);
			if($result)
			{
				$sql = "select * from user where name='$name' and pwd='$pwd'";
				$res = mysql_query($sql);
				//login success
				if($res && $row = mysql_fetch_array($res))
				{
					$_SESSION['id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['pwd'] = $row['pwd'];
					$_SESSION['game_progress'] = $row['game_progress'];
					$_SESSION['current_scene'] = $row['current_scene'];
					$_SESSION['x'] = $row['x'];
					$_SESSION['y'] = $row['y'];
					$_SESSION['score1'] = $row['score1'];
					$_SESSION['score2'] = $row['score2'];
					$_SESSION['score3'] = $row['score3'];
					$_SESSION['score4'] = $row['score4'];
					$r = true;
				}
			}
		}
		return $r;
	}
?>