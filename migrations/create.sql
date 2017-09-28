# Run this script to create the tables required for this site.
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

CREATE TABLE `tags` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` text NOT NULL,
	`created` date NOT NULL,
	`update` date NULL,
	`deleted` int(1) NOT NULL DEFAULT '0'
);