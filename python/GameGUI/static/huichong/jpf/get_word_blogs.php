<?php
	include_once("sql_connection.php");
	include_once("mvc/word_blog.php");
	$word_blog_op = new WordBlogOP();
	$list = $word_blog_op->GetWordBlogs();
	$status = 1;
	$data = json_encode($list);
	$c = count($list);
	echo "{\"status\":\"{$status}\",";
	echo "\"count\":\"{$c}\",";
	echo "\"data\":{$data}}";
	
?>