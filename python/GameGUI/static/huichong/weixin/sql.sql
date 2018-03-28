create table video_link(
	video_link_id int(11) primary key auto_increment,
	video_link_url varchar(512) not null,
	video_link_img_src varchar(32) not null,
	video_link_context varchar(1024) not null
	);