<?php
	class VideoLink{
		public $video_link_id;
		public $video_link_url;
		public $video_link_img_src;
		public $video_link_context;
	}
	class VideoLinkOP{
		public function gets($sql){
			$list = Array();
			$result = $sql->query("select * from video_link");
			if($result && $result->num_rows > 0)
			{
				while($row=$result->fetch_assoc())
				{
					$m = new VideoLink();
					$m->video_link_id = $row['video_link_id'];
					$m->video_link_url = $row['video_link_url'];
					$m->video_link_img_src = $row['video_link_img_src'];
					$m->video_link_context = $row['video_link_context'];
					$list[count($list)] = $m;								//add line
				}
			}
			return $list;
		}
		public function getbyid($id, $sql){
			$result = $sql->query("select * from video_link video_link_id=$id");
			if($result && $result->num_rows > 0)
			{
				while($row=$result->fetch_assoc())
				{
					$m = new VideoLink();
					$m->video_link_id = $row['video_link_id'];
					$m->video_link_src = $row['video_link_url'];
					$m->video_link_img_src = $row['video_link_img_src'];
					$m->vide_link_context = $row['video_link_context'];
					
					return $m; 
				}
			}
		}
		public function update($v, $sql){
			if($sql->query("update video_link set video_link_url='{$v->video_link_url}',video_link_img_src='{$v->video_link_img_src}', video_link_context='{$v->video_link_context}' where video_link_id={$v->video_link_id}"))
			{
				return true;
			}
			return false;
		}
		public function insert($v, $sql){
			if($sql->query("insert into video_link values(null, '{$v->video_link_url}', '{$v->video_link_img_src}', '{$v->video_link_context}')"))
				return true;
			return false;
		}
		public function delete($v, $sql){
			$result = $sql->query("select * from video_link where video_link_id={$v->video_link_id}");
			if($result && $result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$v->video_link_url = $row['video_link_url'];
				$v->video_link_img_src = $row['video_link_img_src'];
				$v->video_link_context = $row['video_link_context'];
				if($sql->query("delete from video_link where video_link_id={$v->video_link_id}"))
					return true;
			}
			return false;
		}
	}
?>