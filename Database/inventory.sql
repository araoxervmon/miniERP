-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2012 at 04:53 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `ccode` varchar(2) NOT NULL DEFAULT '',
  `country` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`ccode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ccode`, `country`) VALUES
('AF', 'Afghanistan'),
('AX', 'Åland Islands'),
('AL', 'Albania'),
('DZ', 'Algeria'),
('AS', 'American Samoa'),
('AD', 'Andorra'),
('AO', 'Angola'),
('AI', 'Anguilla'),
('AQ', 'Antarctica'),
('AG', 'Antigua and Barbuda'),
('AR', 'Argentina'),
('AM', 'Armenia'),
('AW', 'Aruba'),
('AU', 'Australia'),
('AT', 'Austria'),
('AZ', 'Azerbaijan'),
('BS', 'Bahamas'),
('BH', 'Bahrain'),
('BD', 'Bangladesh'),
('BB', 'Barbados'),
('BY', 'Belarus'),
('BE', 'Belgium'),
('BZ', 'Belize'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BT', 'Bhutan'),
('BO', 'Bolivia'),
('BA', 'Bosnia and Herzegovina'),
('BW', 'Botswana'),
('BV', 'Bouvet Island'),
('BR', 'Brazil'),
('IO', 'British Indian Ocean Territory'),
('BN', 'Brunei Darussalam'),
('BG', 'Bulgaria'),
('BF', 'Burkina Faso'),
('BI', 'Burundi'),
('KH', 'Cambodia'),
('CM', 'Cameroon'),
('CA', 'Canada'),
('CV', 'Cape Verde'),
('KY', 'Cayman Islands'),
('CF', 'Central African Republic'),
('TD', 'Chad'),
('CL', 'Chile'),
('CN', 'China'),
('CX', 'Christmas Island'),
('CC', 'Cocos (Keeling) Islands'),
('CO', 'Colombia'),
('KM', 'Comoros'),
('CG', 'Congo'),
('CD', 'Congo, The Democratic Republic of the'),
('CK', 'Cook Islands'),
('CR', 'Costa Rica'),
('CI', 'Côte D''Ivoire'),
('HR', 'Croatia'),
('CU', 'Cuba'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DK', 'Denmark'),
('DJ', 'Djibouti'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('EC', 'Ecuador'),
('EG', 'Egypt'),
('SV', 'El Salvador'),
('GQ', 'Equatorial Guinea'),
('ER', 'Eritrea'),
('EE', 'Estonia'),
('ET', 'Ethiopia'),
('FK', 'Falkland Islands (Malvinas)'),
('FO', 'Faroe Islands'),
('FJ', 'Fiji'),
('FI', 'Finland'),
('FR', 'France'),
('GF', 'French Guiana'),
('PF', 'French Polynesia'),
('TF', 'French Southern Territories'),
('GA', 'Gabon'),
('GM', 'Gambia'),
('GE', 'Georgia'),
('DE', 'Germany'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GR', 'Greece'),
('GL', 'Greenland'),
('GD', 'Grenada'),
('GP', 'Guadeloupe'),
('GU', 'Guam'),
('GT', 'Guatemala'),
('GG', 'Guernsey'),
('GN', 'Guinea'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HT', 'Haiti'),
('HM', 'Heard Island and McDonald Islands'),
('VA', 'Holy See (Vatican City State)'),
('HN', 'Honduras'),
('HK', 'Hong Kong'),
('HU', 'Hungary'),
('IS', 'Iceland'),
('IN', 'India'),
('ID', 'Indonesia'),
('IR', 'Iran, Islamic Republic of'),
('IQ', 'Iraq'),
('IE', 'Ireland'),
('IM', 'Isle of Man'),
('IL', 'Israel'),
('IT', 'Italy'),
('JM', 'Jamaica'),
('JP', 'Japan'),
('JE', 'Jersey'),
('JO', 'Jordan'),
('KZ', 'Kazakhstan'),
('KE', 'Kenya'),
('KI', 'Kiribati'),
('KP', 'Korea, Democratic People''s Republic of'),
('KR', 'Korea, Republic of'),
('KW', 'Kuwait'),
('KG', 'Kyrgyzstan'),
('LA', 'Lao People''s Democratic Republic'),
('LV', 'Latvia'),
('LB', 'Lebanon'),
('LS', 'Lesotho'),
('LR', 'Liberia'),
('LY', 'Libyan Arab Jamahiriya'),
('LI', 'Liechtenstein'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('MO', 'Macao'),
('MK', 'Macedonia, The Former Yugoslav Republic of'),
('MG', 'Madagascar'),
('MW', 'Malawi'),
('MY', 'Malaysia'),
('MV', 'Maldives'),
('ML', 'Mali'),
('MT', 'Malta'),
('MH', 'Marshall Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MU', 'Mauritius'),
('YT', 'Mayotte'),
('MX', 'Mexico'),
('FM', 'Micronesia, Federated States of'),
('MD', 'Moldova, Republic of'),
('MC', 'Monaco'),
('MN', 'Mongolia'),
('ME', 'Montenegro'),
('MS', 'Montserrat'),
('MA', 'Morocco'),
('MZ', 'Mozambique'),
('MM', 'Myanmar'),
('NA', 'Namibia'),
('NR', 'Nauru'),
('NP', 'Nepal'),
('NL', 'Netherlands'),
('AN', 'Netherlands Antilles'),
('NC', 'New Caledonia'),
('NZ', 'New Zealand'),
('NI', 'Nicaragua'),
('NE', 'Niger'),
('NG', 'Nigeria'),
('NU', 'Niue'),
('NF', 'Norfolk Island'),
('MP', 'Northern Mariana Islands'),
('NO', 'Norway'),
('OM', 'Oman'),
('PK', 'Pakistan'),
('PW', 'Palau'),
('PS', 'Palestinian Territory, Occupied'),
('PA', 'Panama'),
('PG', 'Papua New Guinea'),
('PY', 'Paraguay'),
('PE', 'Peru'),
('PH', 'Philippines'),
('PN', 'Pitcairn'),
('PL', 'Poland'),
('PT', 'Portugal'),
('PR', 'Puerto Rico'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('BL', 'Saint Barthélemy'),
('SH', 'Saint Helena'),
('KN', 'Saint Kitts and Nevis'),
('LC', 'Saint Lucia'),
('MF', 'Saint Martin'),
('PM', 'Saint Pierre and Miquelon'),
('VC', 'Saint Vincent and the Grenadines'),
('WS', 'Samoa'),
('SM', 'San Marino'),
('ST', 'Sao Tome and Principe'),
('SA', 'Saudi Arabia'),
('SN', 'Senegal'),
('RS', 'Serbia'),
('SC', 'Seychelles'),
('SL', 'Sierra Leone'),
('SG', 'Singapore'),
('SK', 'Slovakia'),
('SI', 'Slovenia'),
('SB', 'Solomon Islands'),
('SO', 'Somalia'),
('ZA', 'South Africa'),
('GS', 'South Georgia and the South Sandwich Islands'),
('ES', 'Spain'),
('LK', 'Sri Lanka'),
('SD', 'Sudan'),
('SR', 'Suriname'),
('SJ', 'Svalbard and Jan Mayen'),
('SZ', 'Swaziland'),
('SE', 'Sweden'),
('CH', 'Switzerland'),
('SY', 'Syrian Arab Republic'),
('TW', 'Taiwan, Province Of China'),
('TJ', 'Tajikistan'),
('TZ', 'Tanzania, United Republic of'),
('TH', 'Thailand'),
('TL', 'Timor-Leste'),
('TG', 'Togo'),
('TK', 'Tokelau'),
('TO', 'Tonga'),
('TT', 'Trinidad and Tobago'),
('TN', 'Tunisia'),
('TR', 'Turkey'),
('TM', 'Turkmenistan'),
('TC', 'Turks and Caicos Islands'),
('TV', 'Tuvalu'),
('UG', 'Uganda'),
('UA', 'Ukraine'),
('AE', 'United Arab Emirates'),
('GB', 'United Kingdom'),
('US', 'United States'),
('UM', 'United States Minor Outlying Islands'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VU', 'Vanuatu'),
('VE', 'Venezuela'),
('VN', 'Viet Nam'),
('VG', 'Virgin Islands, British'),
('VI', 'Virgin Islands, U.S.'),
('WF', 'Wallis And Futuna'),
('EH', 'Western Sahara'),
('YE', 'Yemen'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `country_list`
--

CREATE TABLE IF NOT EXISTS `country_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_hist_suppliers`
--

CREATE TABLE IF NOT EXISTS `fuel_hist_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `supplier_id` int(11) NOT NULL,
  `address_id` varchar(255) NOT NULL,
  `address_type_code` int(11) NOT NULL COMMENT 'References address Type table',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zip_or_postalcode` varchar(10) NOT NULL,
  `state_id` int(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_suppliers`
--

CREATE TABLE IF NOT EXISTS `fuel_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `supplier_id` int(11) NOT NULL,
  `address_id` varchar(255) NOT NULL,
  `address_type_code` int(11) NOT NULL COMMENT 'References address Type table',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zip_or_postalcode` varchar(10) NOT NULL,
  `state_id` int(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE IF NOT EXISTS `inventory_items` (
  `item_supplier_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `average_monthly_usage` float NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `reorder_quantity` int(11) NOT NULL,
  `other_item_details` mediumtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_suppliers`
--

CREATE TABLE IF NOT EXISTS `item_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `value_supplied_to_date` float NOT NULL,
  `quantity_supplied_to_date` int(11) NOT NULL,
  `first_item_supplied_date` date NOT NULL,
  `last_item_supplied_date` date NOT NULL,
  `delivery_lead_time` varchar(10) NOT NULL,
  `standard_price` float NOT NULL,
  `percentage_discount` float NOT NULL,
  `min_order_quantity` int(11) NOT NULL,
  `max_order_quantity` int(11) NOT NULL,
  `description` tinytext NOT NULL COMMENT 'Other Item Supplier Details',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_address_code`
--

CREATE TABLE IF NOT EXISTS `ref_address_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `name` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_item_categories`
--

CREATE TABLE IF NOT EXISTS `ref_item_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE IF NOT EXISTS `state_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
