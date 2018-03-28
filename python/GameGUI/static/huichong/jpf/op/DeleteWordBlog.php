<?php
	include_once("../sql_connection.php");
	include_once("../mvc/word_blog.php");
	include_once("../tools.php");
	$status = 0;
	$delete_state = 0;
	if(isset($_POST['word_id']))
	{
		$status = 1;
		$word_id = filter($_POST['word_id']);
		$word_blog_op = new WordBlogOP();
		if($word_blog_op->DeleteWordBlog($word_id) == true)
		{
			$delete_state = 1;
		}
		else
		{
			$delete_state = 0;
		}
	}
	echo "{\"status\":\"{$status}\",";
	echo "\"delete_state\":\"{$delete_state}\"}";
?>