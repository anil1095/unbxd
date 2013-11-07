-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.24-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema unbxd
--

CREATE DATABASE IF NOT EXISTS unbxd;
USE unbxd;

--
-- Definition of table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'category id',
  `cat_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of the category/sucategory',
  `parent_id` int(6) unsigned NOT NULL COMMENT 'parent category id from the same table',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'update this to 1 to deleted this category',
  PRIMARY KEY (`cat_id`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Definition of table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(6) unsigned NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `store` varchar(45) CHARACTER SET latin1 NOT NULL,
  `cat_id` int(6) unsigned NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Definition of table `product_models`
--

DROP TABLE IF EXISTS `product_models`;
CREATE TABLE `product_models` (
  `product_id` int(6) unsigned NOT NULL,
  `model_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(7) unsigned NOT NULL,
  `shipping_duration` int(2) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
