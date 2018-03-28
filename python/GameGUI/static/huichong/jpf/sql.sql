create table video_link(
	video_link_id int(11) primary key auto_increment,
	video_link_url varchar(512) not null,
	video_link_img_src varchar(32) not null,
	video_link_context varchar(1024) not null
)default charset=utf8;
create table word_blog(
	word_id int(12) primary key auto_increment,
	context varchar(1024) not null,
	user_name char(32) not null,
	contact_way varchar(32) not null,
	word_date varchar(64) not null
)default charset=utf8;
