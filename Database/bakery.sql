-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2012 at 01:53 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minihoodukuerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_customers`
--

CREATE TABLE IF NOT EXISTS `fuel_customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `customer_cell_phone` varchar(10) NOT NULL,
  `customer_fax` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'Other customer Details',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `last_modified` date NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `address_id` varchar(255) NOT NULL,
  `address_type_code` int(11) NOT NULL COMMENT 'References address Type table',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zip_or_postalcode` varchar(10) NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fuel_customers`
--

INSERT INTO `fuel_customers` (`customer_id`, `name`, `email`, `phone`, `customer_cell_phone`, `customer_fax`, `description`, `date_added`, `created_by`, `last_modified`, `modified_by`, `address_id`, `address_type_code`, `date_from`, `date_to`, `line_1`, `line_2`, `line_3`, `city`, `zip_or_postalcode`, `state_id`, `country_id`) VALUES
(1, 'Gaurav Gautam', 'ggautam@hooduku.com', '9036086261', '9036086261', 0, '', '2012-07-17 04:58:52', '1', '2012-07-17', '', '', 0, '0000-00-00', '0000-00-00', 'Forum Mall, Kormanagala', '', '', 'Bangalore', '560029', 'Karnataka', 0),
(2, 'Abhilash Rao', 'arao@hooduku.com', '9844618604', '9844618604', 0, '', '2012-07-17 05:01:46', '1', '2012-07-17', '', '', 0, '0000-00-00', '0000-00-00', '77/A, 4th Main,', 'C-Block,', 'Kormanagla.', 'Bangalore', '560034', 'Karnataka', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_inventory_lists`
--

CREATE TABLE IF NOT EXISTS `fuel_inventory_lists` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_sku` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `item_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `item_cost` float NOT NULL DEFAULT '0',
  `item_weight` float NOT NULL DEFAULT '0',
  `quantity_on_hand` float NOT NULL DEFAULT '0',
  `quantity_on_order` float NOT NULL DEFAULT '0',
  `average_monthly_usage` float DEFAULT '0',
  `minimum_stock_level` float NOT NULL DEFAULT '0',
  `reorder_quantity` float NOT NULL DEFAULT '0',
  `active` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `sku` (`item_sku`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fuel_inventory_lists`
--

INSERT INTO `fuel_inventory_lists` (`item_id`, `item_sku`, `item_name`, `description`, `brand_name`, `supplier_id`, `item_cost`, `item_weight`, `quantity_on_hand`, `quantity_on_order`, `average_monthly_usage`, `minimum_stock_level`, `reorder_quantity`, `active`, `creation_date`, `modified_date`) VALUES
(1, 'SKU_1', 'Hide & Seek', 'Hide & Seek Milano is a rich and exotic cookie. Available in four flavours - Chocolate Chip, Butterscotch, Butter Nut and Choconut.', 'Parle', 4, 15, 200, 100, 0, 25, 25, 0, 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'SKU_2', 'KrackJack', 'KrackJack is India''s first & original sweet and salty biscuit. It is crispy and delicious with a perfect balance of sweetness and saltiness.', 'Parle', 5, 10, 100, 250, 100, 20, 2, 0, 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_suppliers`
--

CREATE TABLE IF NOT EXISTS `fuel_suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `supplier_cell_phone` varchar(10) NOT NULL,
  `supplier_fax` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'Other Supplier Details',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `last_modified` date NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `address_id` varchar(255) NOT NULL,
  `address_type_code` int(11) NOT NULL COMMENT 'References address Type table',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zip_or_postalcode` varchar(10) NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fuel_suppliers`
--

INSERT INTO `fuel_suppliers` (`supplier_id`, `name`, `email`, `phone`, `supplier_cell_phone`, `supplier_fax`, `description`, `date_added`, `created_by`, `last_modified`, `modified_by`, `address_id`, `address_type_code`, `date_from`, `date_to`, `line_1`, `line_2`, `line_3`, `city`, `zip_or_postalcode`, `state_id`, `country_id`) VALUES
(4, 'Hooduku It Solutions', 'ashenoy@hooduku.com', '9739459122', '9844618604', 123456789, '', '2012-06-25 21:50:36', '1', '2012-06-25', '', '', 0, '0000-00-00', '0000-00-00', '9th Main', 'HSR Layout', '7th sector', 'Bangalore', '575006', 'Karnataka', 0),
(5, 'Hooduku Cloud', 'ggautam@hooduku.com', '9036086261', '9036086261', 123456789, '', '2012-06-25 21:50:36', '1', '2012-06-25', '', '', 0, '0000-00-00', '0000-00-00', '9th Main', 'HSR Layout', '7th sector', 'Bangalore', '575006', 'Karnataka', 0);


CREATE TABLE IF NOT EXISTS `fuel_inventory_adjustment` (
  `adj_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_sku` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `added_quantity` int(11) NOT NULL DEFAULT '0',
  `adj_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adj_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
