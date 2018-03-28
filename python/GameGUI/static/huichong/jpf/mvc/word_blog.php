<?php 
	class WordBlog{
		public $word_id;
		public $context;
		public $user_name;
		public $contact_way;
		public $word_date;
	}
	class WordBlogOP{
		function __call($name, $args){
			$args_count = count($args);
			$funcname = null;
			
			if($name == "GetWordBlogs")
			{
				if($args_count == 0)
				{
					$funcname = $name."0";
				}
				else if($args_count == 1)
				{
					$funcname = $name."1";
				}
			}
			else if($name == "DeleteWordBlog")
			{
				if($args_count == 1)
				{
					$funcname = $name."1";
				}
				else if($args_count == 2)
				{
					$funcname = $name."2";
				}
			}
			
			if($funcname != null)
				return call_user_func_array(array($this, $funcname), $args);
			else
				return null;
		}
		function DeleteWordBlog1($args){
			$id = $args[0];
			$sql = new FSQL();
			$sql->connections();
			$sql_query = "delete from word_blog2 where word_id=$id";
			$result = $sql->query($sql_query);
			if($result)
			{
				$sql->disconnect();
				return true;
			}
			$sql->disconnect();
			return false;
		}		
		function DeleteWordBlog2($args){
			$id = $args[0];
			$sql = $args[1];
			$sql_query = "delete from word_blog2 where word_id=$id";
			$result = $sql->query($sql_query);
			if($result)
			{
				return true;
			}
			return false;
		}
		function GetWordBlogs0(){
			$result_array = Array();
			$sql = new FSQL();
			$sql->connections();
			$sql_query = "select * from word_blog2";
			$result = $sql->query($sql_query);
			if($result && $result->num_rows > 0)
			{
				while(($row=$result->fetch_assoc()))
				{
					$m = new WordBlog();
					$m->word_id = $row['word_id'];
					$m->context = $row['context'];
					$m->user_name = $row['user_name'];
					$m->contact_way = $row['contact_way'];
					$m->word_date = $row['word_date'];
					$result_array[count($result_array)] = $m;
				}
			}
			$sql->disconnect();
			return $result_array;
		}
		function GetWordBlogs1($args){
			$sql = $args[0];
			$result_array = Array();
			$sql_query = "select * from word_blog2";
			$result = $sql->query($sql_query);
			if($result && $result->num_rows > 0)
			{
				while(($row=$result->fetch_assoc()))
				{
					$m = new WordBlog();
					$m->word_id = $row['word_id'];
					$m->context = $row['context'];
					$m->user_name = $row['user_name'];
					$m->contact_way = $row['contact_way'];
					$m->word_date = $row['word_date'];
					$result_array[count($result_array)] = $m;
				}
			}
			return $result_array;
		}
	}
?>