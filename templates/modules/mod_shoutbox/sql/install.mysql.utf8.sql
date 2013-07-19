CREATE TABLE IF NOT EXISTS #__shoutbox (
	`id` int(11) NOT NULL auto_increment,
	`sbid` int(2) NOT NULL DEFAULT '0',
	`time` int(11) DEFAULT '0' NOT NULL,
	`name` varchar(25) NOT NULL,
	`avatar` varchar(255) DEFAULT '0' NOT NULL, 
	`text` text NOT NULL,
	`url` varchar(225) NOT NULL,
	`ip` varchar(255) NOT NULL,
	PRIMARY KEY  (`id`)
);