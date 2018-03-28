<?php
	$connecting_link;
	function connectingDatabase(){
	/*
	$host_address = "localhost";
	$host_user = "root";
	$host_password = "wswz415114";
	$host_database = "fgame";
	*/
	
	$host_address = "bdm256530414.my3w.com";
	$host_user = "bdm256530414";
	$host_password = "wswz415114";
	$host_database = "bdm256530414_db";
	global $connecting_link;
	
		$connecting_link = @mysql_connect($host_address, $host_user, $host_password);
		if($connecting_link)
		{
			mysql_query("set names 'utf-8'");
			$select_db = @mysql_select_db($host_database, $connecting_link);
			if(!$select_db)
			{
				@mysql_close($connecting_link);
				$connecting_link = null;
			}
		}
		else
			echo "数据库连接失败！";
		return $connecting_link;
	}
	function closeDatabase(){
		global $connecting_link;
		if($connecting_link)
		{
			mysql_close($connecting_link);
			$connecting_link = null;
		}
	}
	function destory_database(){
		if(connectingDatabase()){
			$sql = "drop table user;";
			$result = mysql_query($sql);
			if($result)
			{
				echo "delete success!";
			}
			else
			{
				echo "falid";
			}
			closeDatabase();
		}
		
	}
	function init_database(){
		if(connectingDatabase())
		{
			$sql = 
			"CREATE TABLE `user`(
			`id` int(8) not null auto_increment,
			`name` varchar(20) unique not null,
			`pwd` varchar(32) not null,
			`game_progress` int(8),
			`current_scene` varchar(64),
			`x` int(8),
			`y` int(8),
			`score1` int(8),
			`score2` int(8),
			`score3` int(8),
			`score4` int(8),
			primary key(`id`)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$result = mysql_query($sql);
			if($result)
			{
				echo "success";
			}
			else
			{
				echo "faild";
			}
			closeDatabase();
		}
	}
	
?>