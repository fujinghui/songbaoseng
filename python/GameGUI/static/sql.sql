CREATE DATABASE FGame;
USE FGame;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`(
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
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
