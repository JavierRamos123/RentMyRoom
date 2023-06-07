
DROP TABLE IF EXISTS `ad_categories`;

CREATE TABLE `ad_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  `cat_img` varchar(255) DEFAULT NULL,
  `cat_desc` text,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `add_date` datetime DEFAULT NULL,
  `add_by` int(11) unsigned DEFAULT NULL,
  `add_ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


insert  into `ad_categories`(`id`,`cat_title`,`cat_img`,`cat_desc`,`enabled`,`add_date`,`add_by`,`add_ip`) values 
(1,'Electronics','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,'2021-08-06 23:16:29',NULL,NULL),
(2,'Fashin & Life Style','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,'2021-08-06 23:16:45',NULL,NULL),
(3,'Car & Vehicles','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(4,'Hobby, Sport & Kids','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(5,'Pets & Animals','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(6,'Overseas Jobs','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(7,'Property','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(8,'Education','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(9,'Home & Garden','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL),
(10,'Business & Industry','service1.png','Emply dummy text of the printing and taypng industrxt ever sincknown.',1,NULL,NULL,NULL);


DROP TABLE IF EXISTS `ad_collections`;

CREATE TABLE `ad_collections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) unsigned NOT NULL,
  `cat_id` int(11) unsigned NOT NULL,
  `ad_type` int(11) unsigned NOT NULL,
  `ad_title` varchar(255) NOT NULL,
  `ad_desc` text,
  `ad_price` int(11) DEFAULT NULL,
  `ad_picture_1` varchar(255) DEFAULT NULL,
  `ad_picture_2` varchar(255) DEFAULT NULL,
  `ad_picture_3` varchar(255) DEFAULT NULL,
  `ad_picture_4` varchar(255) DEFAULT NULL,
  `ad_picture_5` varchar(255) DEFAULT NULL,
  `ad_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = approved, 2 = rejected, 3 = deleted',
  `add_date` datetime DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `add_ip` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_ip` varbinary(100) DEFAULT NULL,
  `status_update_by` int(11) DEFAULT NULL,
  `status_update_date` datetime DEFAULT NULL,
  `status_update_ip` varchar(100) DEFAULT NULL,
  `status_reject_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ad_types`;

CREATE TABLE `ad_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_title` varchar(200) NOT NULL,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


insert  into `ad_types`(`id`,`type_title`,`enabled`) values 
(1,'Individual',1),
(2,'Business',1);


DROP TABLE IF EXISTS `seller_profiles`;

CREATE TABLE `seller_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seller_type` varchar(100) DEFAULT NULL,
  `seller_first_name` varchar(255) NOT NULL,
  `seller_last_name` varchar(255) DEFAULT NULL,
  `seller_email` varchar(255) NOT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `account_status` tinyint(1) DEFAULT '0',
  `secret_word` varchar(255) DEFAULT NULL,
  `seller_phone` varchar(255) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `about_seller` text,
  `hide_seller_phone` tinyint(1) unsigned DEFAULT '0',
  `seller_location` varchar(255) DEFAULT NULL,
  `seller_zip_code` varchar(255) DEFAULT NULL,
  `seller_avatar` varchar(255) DEFAULT NULL,
  `seller_banner` varchar(255) DEFAULT NULL,
  `profile_heading` varchar(255) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `seller_profiles` */

insert  into `seller_profiles`(`id`,`seller_type`,`seller_first_name`,`seller_last_name`,`seller_email`,`email_verified`,`account_status`,`secret_word`,`seller_phone`,`gender`,`about_seller`,`hide_seller_phone`,`seller_location`,`seller_zip_code`,`seller_avatar`,`seller_banner`,`profile_heading`,`add_date`,`add_ip`,`update_date`,`update_ip`) values 
(1,NULL,'Javier','Ramos','admin@example.com',1,1,'21232f297a57a5a743894a0e4a801fc3',NULL,NULL,'asdsa',0,NULL,NULL,NULL,NULL,NULL,'2023-05-24 11:19:28','127.0.0.1',NULL,NULL);
