CREATE DATABASE /*!32312 IF NOT EXISTS*/`my_booking` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `my_booking`;


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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


insert  into `ad_categories`(`id`,`cat_title`,`cat_img`,`cat_desc`,`enabled`,`add_date`,`add_by`,`add_ip`) values 
(1,'Apartment',NULL,NULL,1,'2023-05-26 22:26:24',NULL,NULL),
(2,'Houses',NULL,NULL,1,'2023-05-26 22:27:55',NULL,NULL),
(3,'Hotel, B&B and similar',NULL,NULL,1,NULL,NULL,NULL),
(4,'Other',NULL,NULL,1,NULL,NULL,NULL);


DROP TABLE IF EXISTS `ad_collections`;

CREATE TABLE `ad_collections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) unsigned NOT NULL,
  `cat_id` int(11) unsigned NOT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `ad_price` int(11) DEFAULT NULL,
  `ad_desc` text,
  `country` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
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
  `update_ip` varchar(100) DEFAULT NULL,
  `status_update_by` int(11) DEFAULT NULL,
  `status_update_date` datetime DEFAULT NULL,
  `status_update_ip` varchar(100) DEFAULT NULL,
  `status_reject_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ad_collections` */

insert  into `ad_collections`(`id`,`seller_id`,`cat_id`,`acc_name`,`ad_price`,`ad_desc`,`country`,`address`,`city`,`postal_code`,`ad_picture_1`,`ad_picture_2`,`ad_picture_3`,`ad_picture_4`,`ad_picture_5`,`ad_status`,`add_date`,`add_by`,`add_ip`,`update_date`,`update_by`,`update_ip`,`status_update_by`,`status_update_date`,`status_update_ip`,`status_reject_reason`) values 
(1,1,3,'aaaaaaaaa',123,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Albania','sasadsa','Karachi','4543','987231685383194.jpg','434091685383195.jpg','181671685383195.jpg',NULL,NULL,0,'2023-05-29 17:59:54',NULL,'::1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,1,2,'bbbb',2334,'','Austria','sadasd','Karachi','11122','903211685383306.jpg','332731685383306.jpg','697581685383307.jpg',NULL,NULL,0,'2023-05-29 18:01:46',NULL,'::1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,1,2,'aaaaaaaaaaa',12,'','Andorra','asdsad','asdsa','asdsa','994151685618105.jpg',NULL,NULL,NULL,NULL,0,'2023-06-01 11:15:05',NULL,'127.0.0.1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,1,3,'sdddd',23,'dsada','Albania','asdas','asdsa','asdsa',NULL,NULL,NULL,NULL,NULL,0,'2023-06-01 11:20:00',NULL,'127.0.0.1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,1,3,'asdas',23,'dasdsa','American Samoa','adasd','aasdasdsa','23423423',NULL,NULL,NULL,NULL,NULL,0,'2023-06-01 11:20:53',NULL,'127.0.0.1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,1,1,'assaasdsa',23,'asdadsas','American Samoa','asdsad','aasdasdsa','asdasdas','431161685618507.jpg',NULL,NULL,NULL,NULL,0,'2023-06-01 11:21:47',NULL,'127.0.0.1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(7,1,2,'errrr',300,'AAAAAAAA','Albania','dasdasd','asdas','324','201841685618615.jpg',NULL,NULL,NULL,NULL,0,'2023-06-01 11:23:35',NULL,'127.0.0.1','2023-06-01 11:59:26',1,'127.0.0.1',NULL,NULL,NULL,NULL);

/*Table structure for table `ad_dates` */

DROP TABLE IF EXISTS `ad_dates`;

CREATE TABLE `ad_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `ad_date` date NOT NULL,
  `is_booked` tinyint(1) unsigned DEFAULT '0',
  `booked_by` int(11) unsigned DEFAULT NULL,
  `booked_on` datetime DEFAULT NULL,
  `booked_on_ip` varchar(100) DEFAULT NULL,
  `booking_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `ad_dates` */

insert  into `ad_dates`(`id`,`ad_id`,`ad_date`,`is_booked`,`booked_by`,`booked_on`,`booked_on_ip`,`booking_status`) values 
(1,1,'2023-05-30',1,2,'2023-06-02 07:40:32','127.0.0.1',1),
(2,1,'2023-05-31',1,2,'2023-06-02 07:40:32','127.0.0.1',0),
(3,1,'2023-06-01',0,2,'2023-06-02 07:40:32','127.0.0.1',2),
(4,1,'2023-06-02',0,NULL,NULL,NULL,0),
(5,2,'2023-06-27',0,NULL,NULL,NULL,0),
(6,2,'2023-06-28',0,NULL,NULL,NULL,0),
(7,2,'2023-06-29',0,NULL,NULL,NULL,0),
(8,3,'2023-06-02',0,NULL,NULL,NULL,0),
(9,3,'2023-06-03',0,NULL,NULL,NULL,0),
(10,3,'2023-06-04',0,NULL,NULL,NULL,0),
(11,3,'2023-06-05',0,NULL,NULL,NULL,0),
(12,3,'2023-06-06',0,NULL,NULL,NULL,0),
(13,3,'2023-06-07',0,NULL,NULL,NULL,0),
(14,4,'2023-06-12',0,NULL,NULL,NULL,0),
(15,4,'2023-06-13',0,NULL,NULL,NULL,0),
(16,5,'2023-06-26',0,NULL,NULL,NULL,0),
(17,5,'2023-06-27',0,NULL,NULL,NULL,0),
(18,5,'2023-06-28',0,NULL,NULL,NULL,0),
(19,6,'2023-06-19',0,NULL,NULL,NULL,0),
(20,6,'2023-06-20',0,NULL,NULL,NULL,0),
(24,7,'2023-06-13',0,NULL,NULL,NULL,0),
(23,7,'2023-06-12',0,NULL,NULL,NULL,0),
(25,7,'2023-06-14',0,NULL,NULL,NULL,0),
(26,7,'2023-06-15',0,NULL,NULL,NULL,0),
(27,7,'2023-06-16',0,NULL,NULL,NULL,0),
(28,7,'2023-06-17',0,NULL,NULL,NULL,0),
(29,7,'2023-06-18',0,NULL,NULL,NULL,0),
(30,7,'2023-06-19',0,NULL,NULL,NULL,0),
(31,7,'2023-06-20',0,NULL,NULL,NULL,0);

/*Table structure for table `ad_services_list` */

DROP TABLE IF EXISTS `ad_services_list`;

CREATE TABLE `ad_services_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_desc` varchar(255) DEFAULT NULL,
  `icon` text,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ad_services_list` */

/*Table structure for table `ad_services_offered` */

DROP TABLE IF EXISTS `ad_services_offered`;

CREATE TABLE `ad_services_offered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ad_services_offered` */

insert  into `ad_services_offered`(`id`,`ad_id`,`service_id`,`service_desc`) values 
(7,7,8,'Lock on bedroom door'),
(6,7,7,'Wifi'),
(5,7,1,'Shared backyard – Fully fenced');

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(80) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`id`,`country_name`,`phonecode`,`nationality`) values 
(1,'Afghanistan',93,NULL),
(2,'Albania',355,NULL),
(3,'Algeria',213,NULL),
(4,'American Samoa',1684,NULL),
(5,'Andorra',376,NULL),
(6,'Angola',244,NULL),
(7,'Anguilla',1264,NULL),
(8,'Antarctica',0,NULL),
(9,'Antigua and Barbuda',1268,NULL),
(10,'Argentina',54,NULL),
(11,'Armenia',374,NULL),
(12,'Aruba',297,NULL),
(13,'Australia',61,NULL),
(14,'Austria',43,NULL),
(15,'Azerbaijan',994,NULL),
(16,'Bahamas',1242,NULL),
(17,'Bahrain',973,NULL),
(18,'Bangladesh',880,NULL),
(19,'Barbados',1246,NULL),
(20,'Belarus',375,NULL),
(21,'Belgium',32,NULL),
(22,'Belize',501,NULL),
(23,'Benin',229,NULL),
(24,'Bermuda',1441,NULL),
(25,'Bhutan',975,NULL),
(26,'Bolivia',591,NULL),
(27,'Bosnia and Herzegovina',387,NULL),
(28,'Botswana',267,NULL),
(29,'Bouvet Island',0,NULL),
(30,'Brazil',55,NULL),
(31,'British Indian Ocean Territory',246,NULL),
(32,'Brunei Darussalam',673,NULL),
(33,'Bulgaria',359,NULL),
(34,'Burkina Faso',226,NULL),
(35,'Burundi',257,NULL),
(36,'Cambodia',855,NULL),
(37,'Cameroon',237,NULL),
(38,'Canada',1,NULL),
(39,'Cape Verde',238,NULL),
(40,'Cayman Islands',1345,NULL),
(41,'Central African Republic',236,NULL),
(42,'Chad',235,NULL),
(43,'Chile',56,NULL),
(44,'China',86,NULL),
(45,'Christmas Island',61,NULL),
(46,'Cocos (Keeling) Islands',672,NULL),
(47,'Colombia',57,NULL),
(48,'Comoros',269,NULL),
(49,'Congo',242,NULL),
(50,'Congo, the Democratic Republic of the',242,NULL),
(51,'Cook Islands',682,NULL),
(52,'Costa Rica',506,NULL),
(53,'Cote D\'Ivoire',225,NULL),
(54,'Croatia',385,NULL),
(55,'Cuba',53,NULL),
(56,'Cyprus',357,NULL),
(57,'Czech Republic',420,NULL),
(58,'Denmark',45,NULL),
(59,'Djibouti',253,NULL),
(60,'Dominica',1767,NULL),
(61,'Dominican Republic',1809,NULL),
(62,'Ecuador',593,NULL),
(63,'Egypt',20,NULL),
(64,'El Salvador',503,NULL),
(65,'Equatorial Guinea',240,NULL),
(66,'Eritrea',291,NULL),
(67,'Estonia',372,NULL),
(68,'Ethiopia',251,NULL),
(69,'Falkland Islands (Malvinas)',500,NULL),
(70,'Faroe Islands',298,NULL),
(71,'Fiji',679,NULL),
(72,'Finland',358,NULL),
(73,'France',33,NULL),
(74,'French Guiana',594,NULL),
(75,'French Polynesia',689,NULL),
(76,'French Southern Territories',0,NULL),
(77,'Gabon',241,NULL),
(78,'Gambia',220,NULL),
(79,'Georgia',995,NULL),
(80,'Germany',49,NULL),
(81,'Ghana',233,NULL),
(82,'Gibraltar',350,NULL),
(83,'Greece',30,NULL),
(84,'Greenland',299,NULL),
(85,'Grenada',1473,NULL),
(86,'Guadeloupe',590,NULL),
(87,'Guam',1671,NULL),
(88,'Guatemala',502,NULL),
(89,'Guinea',224,NULL),
(90,'Guinea-Bissau',245,NULL),
(91,'Guyana',592,NULL),
(92,'Haiti',509,NULL),
(93,'Heard Island and Mcdonald Islands',0,NULL),
(94,'Holy See (Vatican City State)',39,NULL),
(95,'Honduras',504,NULL),
(96,'Hong Kong',852,NULL),
(97,'Hungary',36,NULL),
(98,'Iceland',354,NULL),
(99,'India',91,NULL),
(100,'Indonesia',62,NULL),
(101,'Iran, Islamic Republic of',98,NULL),
(102,'Iraq',964,NULL),
(103,'Ireland',353,NULL),
(104,'Israel',972,NULL),
(105,'Italy',39,NULL),
(106,'Jamaica',1876,NULL),
(107,'Japan',81,NULL),
(108,'Jordan',962,NULL),
(109,'Kazakhstan',7,NULL),
(110,'Kenya',254,NULL),
(111,'Kiribati',686,NULL),
(112,'Korea, Democratic People\'s Republic of',850,NULL),
(113,'Korea, Republic of',82,NULL),
(114,'Kuwait',965,NULL),
(115,'Kyrgyzstan',996,NULL),
(116,'Lao People\'s Democratic Republic',856,NULL),
(117,'Latvia',371,NULL),
(118,'Lebanon',961,NULL),
(119,'Lesotho',266,NULL),
(120,'Liberia',231,NULL),
(121,'Libyan Arab Jamahiriya',218,NULL),
(122,'Liechtenstein',423,NULL),
(123,'Lithuania',370,NULL),
(124,'Luxembourg',352,NULL),
(125,'Macao',853,NULL),
(126,'Macedonia, the Former Yugoslav Republic of',389,NULL),
(127,'Madagascar',261,NULL),
(128,'Malawi',265,NULL),
(129,'Malaysia',60,NULL),
(130,'Maldives',960,NULL),
(131,'Mali',223,NULL),
(132,'Malta',356,NULL),
(133,'Marshall Islands',692,NULL),
(134,'Martinique',596,NULL),
(135,'Mauritania',222,NULL),
(136,'Mauritius',230,NULL),
(137,'Mayotte',269,NULL),
(138,'Mexico',52,NULL),
(139,'Micronesia, Federated States of',691,NULL),
(140,'Moldova, Republic of',373,NULL),
(141,'Monaco',377,NULL),
(142,'Mongolia',976,NULL),
(143,'Montserrat',1664,NULL),
(144,'Morocco',212,NULL),
(145,'Mozambique',258,NULL),
(146,'Myanmar',95,NULL),
(147,'Namibia',264,NULL),
(148,'Nauru',674,NULL),
(149,'Nepal',977,NULL),
(150,'Netherlands',31,NULL),
(151,'Netherlands Antilles',599,NULL),
(152,'New Caledonia',687,NULL),
(153,'New Zealand',64,NULL),
(154,'Nicaragua',505,NULL),
(155,'Niger',227,NULL),
(156,'Nigeria',234,NULL),
(157,'Niue',683,NULL),
(158,'Norfolk Island',672,NULL),
(159,'Northern Mariana Islands',1670,NULL),
(160,'Norway',47,NULL),
(161,'Oman',968,NULL),
(162,'Pakistan',92,NULL),
(163,'Palau',680,NULL),
(164,'Palestinian Territory, Occupied',970,NULL),
(165,'Panama',507,NULL),
(166,'Papua New Guinea',675,NULL),
(167,'Paraguay',595,NULL),
(168,'Peru',51,NULL),
(169,'Philippines',63,NULL),
(170,'Pitcairn',0,NULL),
(171,'Poland',48,NULL),
(172,'Portugal',351,NULL),
(173,'Puerto Rico',1787,NULL),
(174,'Qatar',974,NULL),
(175,'Reunion',262,NULL),
(176,'Romania',40,NULL),
(177,'Russian Federation',70,NULL),
(178,'Rwanda',250,NULL),
(179,'Saint Helena',290,NULL),
(180,'Saint Kitts and Nevis',1869,NULL),
(181,'Saint Lucia',1758,NULL),
(182,'Saint Pierre and Miquelon',508,NULL),
(183,'Saint Vincent and the Grenadines',1784,NULL),
(184,'Samoa',684,NULL),
(185,'San Marino',378,NULL),
(186,'Sao Tome and Principe',239,NULL),
(187,'Saudi Arabia',966,NULL),
(188,'Senegal',221,NULL),
(189,'Serbia and Montenegro',381,NULL),
(190,'Seychelles',248,NULL),
(191,'Sierra Leone',232,NULL),
(192,'Singapore',65,NULL),
(193,'Slovakia',421,NULL),
(194,'Slovenia',386,NULL),
(195,'Solomon Islands',677,NULL),
(196,'Somalia',252,NULL),
(197,'South Africa',27,NULL),
(198,'South Georgia and the South Sandwich Islands',0,NULL),
(199,'Spain',34,NULL),
(200,'Sri Lanka',94,NULL),
(201,'Sudan',249,NULL),
(202,'Suriname',597,NULL),
(203,'Svalbard and Jan Mayen',47,NULL),
(204,'Swaziland',268,NULL),
(205,'Sweden',46,NULL),
(206,'Switzerland',41,NULL),
(207,'Syrian Arab Republic',963,NULL),
(208,'Taiwan, Province of China',886,NULL),
(209,'Tajikistan',992,NULL),
(210,'Tanzania, United Republic of',255,NULL),
(211,'Thailand',66,NULL),
(212,'Timor-Leste',670,NULL),
(213,'Togo',228,NULL),
(214,'Tokelau',690,NULL),
(215,'Tonga',676,NULL),
(216,'Trinidad and Tobago',1868,NULL),
(217,'Tunisia',216,NULL),
(218,'Turkey',90,NULL),
(219,'Turkmenistan',7370,NULL),
(220,'Turks and Caicos Islands',1649,NULL),
(221,'Tuvalu',688,NULL),
(222,'Uganda',256,NULL),
(223,'Ukraine',380,NULL),
(224,'United Arab Emirates',971,NULL),
(225,'United Kingdom',44,NULL),
(226,'United States',1,NULL),
(227,'United States Minor Outlying Islands',1,NULL),
(228,'Uruguay',598,NULL),
(229,'Uzbekistan',998,NULL),
(230,'Vanuatu',678,NULL),
(231,'Venezuela',58,NULL),
(232,'Viet Nam',84,NULL),
(233,'Virgin Islands, British',1284,NULL),
(234,'Virgin Islands, U.s.',1340,NULL),
(235,'Wallis and Futuna',681,NULL),
(236,'Western Sahara',212,NULL),
(237,'Yemen',967,NULL),
(238,'Zambia',260,NULL),
(239,'Zimbabwe',263,NULL);

/*Table structure for table `seller_profiles` */

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `seller_profiles` */

insert  into `seller_profiles`(`id`,`seller_type`,`seller_first_name`,`seller_last_name`,`seller_email`,`email_verified`,`account_status`,`secret_word`,`seller_phone`,`gender`,`about_seller`,`hide_seller_phone`,`seller_location`,`seller_zip_code`,`seller_avatar`,`seller_banner`,`profile_heading`,`add_date`,`add_ip`,`update_date`,`update_ip`) values 
(1,NULL,'javier','Ramos','admin@example.com',1,1,'21232f297a57a5a743894a0e4a801fc3','1111111111',NULL,'aaaaaaaaaaaaa',0,NULL,NULL,NULL,NULL,NULL,'2023-05-27 18:51:56','::1','2023-05-28 20:36:42','::1'),
(2,NULL,'ja','ra','ja@example.com',1,1,'e85717edee88a549a7ceb7faf84ed98f','234234',NULL,'',0,NULL,NULL,NULL,NULL,NULL,'2023-05-27 18:51:56','::1',NULL,NULL);

/*Table structure for table `services_list` */

DROP TABLE IF EXISTS `services_list`;

CREATE TABLE `services_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_desc` varchar(255) DEFAULT NULL,
  `icon` text,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `services_list` */

insert  into `services_list`(`id`,`service_desc`,`icon`,`enabled`) values 
(1,'Shared backyard – Fully fenced','<div class=\"i4wvyiy i1fpqhzs dir dir-ltr\"><svg viewBox=\"0 0 32 32\" xmlns=\"http://www.w3.org/2000/svg\" style=\"display: block; height: 24px; width: 24px; fill: currentcolor;\" aria-hidden=\"true\" role=\"presentation\" focusable=\"false\"><path d=\"M16 1a5 5 0 0 1 5 5 5 5 0 0 1 0 10 5.002 5.002 0 0 1-4 4.9v4.287C18.652 23.224 21.153 22 23.95 22a8.94 8.94 0 0 1 3.737.814l.313.15.002 2.328A6.963 6.963 0 0 0 23.95 24c-3.542 0-6.453 2.489-6.93 5.869l-.02.15-.006.098a1 1 0 0 1-.876.876L16 31a1 1 0 0 1-.974-.77l-.02-.124C14.635 26.623 11.615 24 7.972 24a6.963 6.963 0 0 0-3.97 1.234l.002-2.314c1.218-.6 2.57-.92 3.968-.92 2.818 0 5.358 1.24 7.028 3.224V20.9a5.002 5.002 0 0 1-3.995-4.683L11 16l-.217-.005a5 5 0 0 1 0-9.99L11 6l.005-.217A5 5 0 0 1 16 1zm2.864 14.1c-.811.567-1.799.9-2.864.9s-2.053-.333-2.864-.9l-.062.232a3 3 0 1 0 5.851.001zM11 8a3 3 0 1 0 .667 5.926l.234-.062A4.977 4.977 0 0 1 11 11c0-1.065.333-2.053.9-2.864l-.232-.062A3.013 3.013 0 0 0 11 8zm10 0c-.228 0-.45.025-.667.074l-.234.062C20.667 8.947 21 9.935 21 11a4.977 4.977 0 0 1-.9 2.864l.232.062A3 3 0 1 0 21 8zm-5 0a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm0-5a3 3 0 0 0-2.926 3.667l.062.234C13.947 6.333 14.935 6 16 6s2.053.333 2.864.9l.062-.232A3 3 0 0 0 16 3z\"></path></svg></div>',1),
(2,'Dedicated workspace','<div class=\"i4wvyiy i1fpqhzs dir dir-ltr\"><svg viewBox=\"0 0 32 32\" xmlns=\"http://www.w3.org/2000/svg\" style=\"display: block; height: 24px; width: 24px; fill: currentcolor;\" aria-hidden=\"true\" role=\"presentation\" focusable=\"false\"><path d=\"M26 2a1 1 0 0 1 .922.612l.04.113 2 7a1 1 0 0 1-.847 1.269L28 11h-3v5h6v2h-2v13h-2l.001-2.536a3.976 3.976 0 0 1-1.73.527L25 29H7a3.982 3.982 0 0 1-2-.535V31H3V18H1v-2h5v-4a1 1 0 0 1 .883-.993L7 11h.238L6.086 8.406l1.828-.812L9.427 11H12a1 1 0 0 1 .993.883L13 12v4h10v-5h-3a1 1 0 0 1-.987-1.162l.025-.113 2-7a1 1 0 0 1 .842-.718L22 2h4zm1 16H5v7a2 2 0 0 0 1.697 1.977l.154.018L7 27h18a2 2 0 0 0 1.995-1.85L27 25v-7zm-16-5H8v3h3v-3zm14.245-9h-2.491l-1.429 5h5.349l-1.429-5z\"></path></svg></div>',1),
(3,'Shared pool',NULL,1),
(4,'Free parking on premises',NULL,1),
(5,'Washer',NULL,1),
(6,'Kitchen',NULL,1),
(7,'Wifi',NULL,1),
(8,'Lock on bedroom door',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
