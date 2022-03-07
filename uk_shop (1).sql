-- Adminer 4.8.1 MySQL 5.7.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `login`, `password`) VALUES
(10,	'猫田 重蔵',	'静岡県静岡市葵区追手町9-6',	'',	'neko',	'CatField10'),
(15,	'小山 結',	'秋田県秋田市旭南',	'y@gmail.com',	'koyama',	'$2y$10$UXOupfR0F/spWPUTpyv1O.PkngAm4Aw8AeDRfjMA2EiTDGxU5h0E.');

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `favorite` (`customer_id`, `product_id`) VALUES
(10,	3);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `images` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`id`, `name`, `price`, `images`) VALUES
(2,	'くるみ',	270,	''),
(3,	'ひまわりの種',	210,	''),
(4,	'アーモンド',	220,	''),
(5,	'カシューナッツ',	250,	''),
(6,	'ジャイアントコーン',	180,	''),
(7,	'ピスタチオ',	310,	''),
(8,	'マカダミアナッツ',	600,	''),
(9,	'かぼちゃの種',	180,	''),
(10,	'ピーナッツ',	150,	''),
(11,	'クコの実',	400,	''),
(12,	'落花生',	1200,	''),
(13,	'枝豆',	1500,	''),
(14,	'そら豆',	1100,	''),
(28,	'ミックスナッツ',	120,	'a:3:{i:0;s:12:\"upload/1.jpg\";i:1;s:12:\"upload/2.jpg\";i:2;s:12:\"upload/3.jpg\";}'),
(29,	'ミックスナッツ2',	600,	'a:3:{i:0;s:12:\"upload/4.jpg\";i:1;s:12:\"upload/5.jpg\";i:2;s:12:\"upload/6.jpg\";}'),
(30,	'ミックスナッツ3',	700,	'a:3:{i:0;s:12:\"upload/7.jpg\";i:1;s:12:\"upload/8.jpg\";i:2;s:12:\"upload/9.jpg\";}'),
(31,	'ミックスナッツ4',	700,	'a:3:{i:0;s:12:\"upload/9.jpg\";i:1;s:13:\"upload/10.jpg\";i:2;s:13:\"upload/11.jpg\";}');

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `purchase` (`id`, `customer_id`, `date`) VALUES
(1,	10,	'2022-02-25 07:54:58'),
(2,	15,	'2022-02-26 10:05:53'),
(3,	15,	'2022-02-28 09:54:09'),
(4,	15,	'2022-03-02 05:26:21'),
(5,	15,	'2022-03-04 10:26:12');

DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE `purchase_detail` (
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `purchase_detail` (`purchase_id`, `product_id`, `count`) VALUES
(2,	14,	1),
(3,	6,	3),
(4,	7,	2),
(4,	13,	1),
(5,	8,	1);

-- 2022-03-07 10:00:30
