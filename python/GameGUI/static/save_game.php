<?php
	session_start();
	include("phptools/connection.php");
	$id = $_SESSION['id'];
	$game_progress = $_POST['game_progress'];
	$current_scene = $_POST['current_scene'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$score1 = $_POST['score1'];
	$score2 = $_POST['score2'];
	$score3 = $_POST['score3'];
	$score4 = $_POST['score4'];
	if(connectingDatabase())
	{
		$sql = "update user set game_progress=$game_progress,current_scene='$current_scene',x=$x,y=$y,score1=$score1,score2=$score2,score3=$score3,score4=$score4 where id=$id";
		$result = mysql_query($sql);
		if($result)
		{
			$_SESSION['game_progress'] = $game_progress;
			$_SESSION['current_scene'] = $current_scene;
			$_SESSION['x'] = $x;
			$_SESSION['y'] = $y;
			$_SESSION['score1'] = $score1;
			$_SESSION['score2'] = $score2;
			$_SESSION['score3'] = $score3;
			$_SESSION['score4'] = $score4;
			echo "success";
		}
		else
		{
			echo "faild";
		}
		closeDatabase();
	}
?>