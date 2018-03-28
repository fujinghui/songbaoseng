<?php
	session_start();
	include("phptools/connection.php");
	class User{
		var $id;
		var $name;
		var $pwd;
		var $game_progress;
		var $current_scene;
		var $x;
		var $y;
		var $score1;
		var $score2;
		var $score3;
		var $score4;
	}
	if(connectingDatabase())
	{
		$users;
		$index = 0;
		$id = $_SESSION['id'];
		$sql = "select * from user";
		$result = mysql_query($sql);
		while($result & $row = mysql_fetch_array($result))
		{
			$users[$index] = new User;
			$users[$index]->id = $row['id'];
			$users[$index]->name = $row['name'];
			$users[$index]->game_progress = $row['game_progress'];
			$users[$index]->current_scene = $row['current_scene'];
			$users[$index]->x = $row['x'];
			$users[$index]->y = $row['y'];
			$users[$index]->score1 = $row['score1'];
			$users[$index]->score2 = $row['score2'];
			$users[$index]->score3 = $row['score3'];
			$users[$index]->score4 = $row['score4'];
			
			$index = $index + 1;
		}
		
		echo "[";
		$i = 0;
		if($index > 0)
		{
			for(; $i < $index - 1; $i ++)
			{
				echo "{id:".$users[$i]->id.",name:'".$users[$i]->name."',score1:".$users[$i]->score1.",score2:".$users[$i]->score2.",score3:".$users[$i]->score3.",score4:".$users[$i]->score4."},";		
			}
			echo "{id:".$users[$i]->id.",name:'".$users[$i]->name."',score1:".$users[$i]->score1.",score2:".$users[$i]->score2.",score3:".$users[$i]->score3.",score4:".$users[$i]->score4."}";		
		}
		echo "]";	
		closeDatabase();					//close database
	}
	
?>