CREATE DATABASE `blog`;
USE `blog`;

CREATE TABLE `posts` (
  	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  	`title` text NOT NULL,
  	`content` text NOT NULL,
  	`created` date NOT NULL,
	`updated` date NULL,
	`deleted` int NOT NULL DEFAULT '0'
);