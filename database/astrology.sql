-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2021 at 07:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astrology`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test category1', 1, '2021-04-18 12:04:27', '2021-04-18 12:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_abbr` char(3) NOT NULL,
  `country_iso` varchar(2) DEFAULT NULL,
  `country_prefix` int(10) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `display_sequence` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_abbr`, `country_iso`, `country_prefix`, `country_name`, `status_id`, `display_sequence`) VALUES
(1, 'AFG', 'AF', 93, 'Afghanistan', 1, 0),
(2, 'ALB', 'AL', 355, 'Albania', 1, 0),
(3, 'DZA', 'DZ', 213, 'Algeria', 1, 0),
(4, 'ASM', 'AS', 1684, 'American Samoa', 1, 0),
(5, 'AND', 'AD', 376, 'Andorra', 1, 0),
(6, 'AGO', 'AO', 244, 'Angola', 1, 0),
(7, 'AIA', 'AI', 1264, 'Anguilla', 1, 0),
(8, 'ATA', 'AQ', 672, 'Antarctica', 1, 0),
(9, 'ATG', 'AG', 1268, 'Antigua & Barbuda', 1, 0),
(10, 'ARG', 'AR', 54, 'Argentina', 1, 0),
(11, 'ARM', 'AM', 374, 'Armenia', 1, 0),
(12, 'ABW', 'AW', 297, 'Aruba', 1, 0),
(13, 'AUS', 'AU', 61, 'Australia', 1, 0),
(14, 'AUT', 'AT', 43, 'Austria', 1, 0),
(15, 'AZE', 'AZ', 994, 'Azerbaijan', 1, 0),
(16, 'BHS', 'BS', 1242, 'Bahamas', 1, 0),
(17, 'BHR', 'BH', 973, 'Bahrain', 1, 0),
(18, 'BGD', 'BD', 880, 'Bangladesh', 1, 0),
(19, 'BRB', 'BB', 1246, 'Barbados', 1, 0),
(20, 'BLR', 'BY', 375, 'Belarus', 1, 0),
(21, 'BEL', 'BE', 32, 'Belgium', 1, 0),
(22, 'BLZ', 'BZ', 501, 'Belize', 1, 0),
(23, 'BEN', 'BJ', 229, 'Benin', 1, 0),
(24, 'BMU', 'BM', 1441, 'Bermuda', 1, 0),
(25, 'BTN', 'BT', 975, 'Bhutan', 1, 0),
(26, 'BOL', 'BO', 591, 'Bolivia', 1, 0),
(27, 'BIH', 'BA', 387, 'Bosnia & Herzegovina', 1, 0),
(28, 'BWA', 'BW', 267, 'Botswana', 1, 0),
(29, 'BVT', 'BV', 55, 'Bouvet island', 2, 0),
(30, 'BRA', 'BR', 55, 'Brazil', 1, 0),
(31, 'IOT', 'IO', 246, 'British Indian Ocean Territory', 2, 0),
(32, 'BRN', 'BN', 673, 'Brunei', 1, 0),
(33, 'BGR', 'BG', 359, 'Bulgaria', 1, 0),
(34, 'BFA', 'BF', 226, 'Burkina Faso', 1, 0),
(35, 'BDI', 'BI', 257, 'Burundi', 1, 0),
(36, 'KHM', 'KH', 855, 'Cambodia', 1, 0),
(37, 'CMR', 'CM', 237, 'Cameroon', 1, 0),
(38, 'CAN', 'CA', 1, 'Canada', 1, 0),
(39, 'CPV', 'CV', 238, 'Cape Verde', 1, 0),
(40, 'CYM', 'KY', 1345, 'Cayman Islands', 1, 0),
(41, 'CAF', 'CF', 236, 'Central African Republic', 1, 0),
(42, 'TCD', 'TD', 235, 'Chad', 1, 0),
(43, 'CHL', 'CL', 56, 'Chile', 1, 0),
(44, 'CHN', 'CN', 86, 'China', 1, 0),
(45, 'CXR', 'CX', 618916, 'Christmas Island', 2, 0),
(46, 'CCK', 'CC', 61891, 'Cocos Islands', 2, 0),
(47, 'COL', 'CO', 57, 'Colombia', 1, 0),
(48, 'COM', 'KM', 269, 'Comoros', 1, 0),
(49, 'COD', 'CD', 243, 'Democratic Republic of Congo', 1, 0),
(50, 'COG', 'CG', 242, 'Republic of the Congo', 1, 0),
(51, 'COK', 'CK', 682, 'Cook Islands', 1, 0),
(52, 'CRI', 'CR', 506, 'Costa Rica', 1, 0),
(53, 'CIV', 'CI', 225, 'Cote D\'ivoire', 1, 0),
(54, 'HRV', 'HR', 385, 'Croatia', 1, 0),
(55, 'CUB', 'CU', 53, 'Cuba', 1, 0),
(56, 'CYP', 'CY', 357, 'Cyprus', 1, 0),
(57, 'CZE', 'CZ', 420, 'Czech Republic', 1, 0),
(58, 'DNK', 'DK', 45, 'Denmark', 1, 0),
(59, 'DJI', 'DJ', 253, 'Djibouti', 1, 0),
(60, 'DMA', 'DM', 1767, 'Dominica', 1, 0),
(61, 'DOM', 'DO', 1809, 'Dominican Republic', 1, 0),
(62, 'TLS', 'TP', 670, 'East Timor', 2, 0),
(63, 'ECU', 'EC', 593, 'Ecuador', 1, 0),
(64, 'EGY', 'EG', 20, 'Egypt', 1, 0),
(65, 'SLV', 'SV', 503, 'El salvador', 1, 0),
(66, 'GNQ', 'GQ', 240, 'Equatorial Guinea', 1, 0),
(67, 'ERI', 'ER', 291, 'Eritrea', 1, 0),
(68, 'EST', 'EE', 372, 'Estonia', 1, 0),
(69, 'ETH', 'ET', 251, 'Ethiopia', 1, 0),
(70, 'FLK', 'FK', 500, 'Falkland Islands', 1, 0),
(71, 'FRO', 'FO', 298, 'Faeroe Islands', 1, 0),
(72, 'FJI', 'FJ', 679, 'Fiji', 1, 0),
(73, 'FIN', 'FI', 358, 'Finland', 1, 0),
(74, 'FRA', 'FR', 33, 'France', 1, 0),
(75, 'FXX', 'FX', 0, 'France Metropolitan', 2, 0),
(76, 'GUF', 'GF', 594, 'French Guiana', 1, 0),
(77, 'PYF', 'PF', 689, 'French Polynesia', 1, 0),
(78, 'ATF', 'TF', 0, 'French Southern Territories', 2, 0),
(79, 'GAB', 'GA', 241, 'Gabon', 1, 0),
(80, 'GMB', 'GM', 220, 'Gambia', 1, 0),
(81, 'GEO', 'GE', 995, 'Georgia', 1, 0),
(82, 'DEU', 'DE', 49, 'Germany', 1, 0),
(83, 'GHA', 'GH', 233, 'Ghana', 1, 0),
(84, 'GIB', 'GI', 350, 'Gibraltar', 1, 0),
(85, 'GRC', 'GR', 30, 'Greece', 1, 0),
(86, 'GRL', 'GL', 299, 'Greenland', 1, 0),
(87, 'GRD', 'GD', 1473, 'Grenada', 1, 0),
(88, 'GLP', 'GP', 590, 'Guadeloupe', 1, 0),
(89, 'GUM', 'GU', 1671, 'Guam', 1, 0),
(90, 'GTM', 'GT', 502, 'Guatemala', 1, 0),
(91, 'GIN', 'GN', 224, 'Guinea', 1, 0),
(92, 'GNB', 'GW', 245, 'Guinea Bissau', 1, 0),
(93, 'GUY', 'GY', 592, 'Guyana', 1, 0),
(94, 'HTI', 'HT', 509, 'Haiti', 1, 0),
(95, 'HMD', 'HM', 0, 'Heard & Mc Donald Islands', 2, 0),
(96, 'HND', 'HN', 504, 'Honduras', 1, 0),
(97, 'HKG', 'HK', 852, 'Hong kong', 1, 0),
(98, 'HUN', 'HU', 36, 'Hungary', 1, 0),
(99, 'ISL', 'IS', 354, 'Iceland', 1, 0),
(100, 'IND', 'IN', 91, 'India', 1, 499),
(101, 'IDN', 'ID', 62, 'Indonesia', 1, 0),
(102, 'IRN', 'IR', 98, 'Iran', 1, 0),
(103, 'IRQ', 'IQ', 964, 'Iraq', 1, 0),
(104, 'IRL', 'IE', 353, 'Ireland', 1, 0),
(105, 'ISR', 'IL', 972, 'Israel', 1, 0),
(106, 'ITA', 'IT', 39, 'Italy', 1, 0),
(107, 'JAM', 'JM', 1876, 'Jamaica', 1, 0),
(108, 'JPN', 'JP', 81, 'Japan', 1, 0),
(109, 'JOR', 'JO', 962, 'Jordan', 1, 0),
(110, 'KAZ', 'KZ', 7, 'Kazakhstan', 1, 0),
(111, 'KEN', 'KE', 254, 'Kenya', 1, 0),
(112, 'KIR', 'KI', 686, 'Kiribati', 1, 0),
(113, 'PRK', 'KP', 850, 'North Korea', 1, 0),
(114, 'KOR', 'KR', 82, 'South Korea', 1, 0),
(115, 'KWT', 'KW', 965, 'Kuwait', 1, 0),
(116, 'KGZ', 'KG', 996, 'Kyrgyzstan', 1, 0),
(117, 'LAO', 'LA', 856, 'Laos', 1, 0),
(118, 'LVA', 'LV', 371, 'Latvia', 1, 0),
(119, 'LBN', 'LB', 961, 'Lebanon', 1, 0),
(120, 'LSO', 'LS', 266, 'Lesotho', 1, 0),
(121, 'LBR', 'LR', 231, 'Liberia', 1, 0),
(122, 'LBY', 'LY', 218, 'Libya', 1, 0),
(123, 'LIE', 'LI', 423, 'Liechtenstein', 1, 0),
(124, 'LTU', 'LT', 370, 'Lithuania', 1, 0),
(125, 'LUX', 'LU', 352, 'Luxembourg', 1, 0),
(126, 'MAC', 'MO', 853, 'Macau', 1, 0),
(127, 'MKD', 'MK', 389, 'Macedonia', 1, 0),
(128, 'MDG', 'MG', 261, 'Madagascar', 1, 0),
(129, 'MWI', 'MW', 265, 'Malawi', 1, 0),
(130, 'MYS', 'MY', 60, 'Malaysia', 1, 0),
(131, 'MDV', 'MV', 960, 'Maldives', 1, 0),
(132, 'MLI', 'ML', 223, 'Mali', 1, 0),
(133, 'MLT', 'MT', 356, 'Malta', 1, 0),
(134, 'MHL', 'MH', 692, 'Marshall Islands', 1, 0),
(135, 'MTQ', 'MQ', 596, 'Martinique', 1, 0),
(136, 'MRT', 'MR', 222, 'Mauritania', 1, 0),
(137, 'MUS', 'MU', 230, 'Mauritius', 1, 0),
(138, 'MYT', 'YT', 262, 'Mayotte', 1, 0),
(139, 'MEX', 'MX', 52, 'Mexico', 1, 0),
(140, 'FSM', 'FM', 691, 'Micronesia', 1, 0),
(141, 'MDA', 'MD', 373, 'Moldova', 1, 0),
(142, 'MCO', 'MC', 377, 'Monaco', 1, 0),
(143, 'MNG', 'MN', 976, 'Mongolia', 1, 0),
(144, 'MSR', 'MS', 1664, 'Montserrat', 1, 0),
(145, 'MAR', 'MA', 212, 'Morocco', 1, 0),
(146, 'MOZ', 'MZ', 258, 'Mozambique', 1, 0),
(147, 'MMR', 'MM', 95, 'Myanmar', 1, 0),
(148, 'NAM', 'NA', 264, 'Namibia', 1, 0),
(149, 'NRU', 'NR', 674, 'Nauru', 1, 0),
(150, 'NPL', 'NP', 977, 'Nepal', 1, 0),
(151, 'NLD', 'NL', 31, 'Netherlands', 1, 0),
(152, 'ANT', 'AN', 599, 'Netherlands Antilles', 1, 0),
(153, 'NCL', 'NC', 687, 'New Caledonia', 1, 0),
(154, 'NZL', 'NZ', 64, 'New Zealand', 1, 0),
(155, 'NIC', 'NI', 505, 'Nicaragua', 1, 0),
(156, 'NER', 'NE', 227, 'Niger', 1, 0),
(157, 'NGA', 'NG', 234, 'Nigeria', 1, 0),
(158, 'NIU', 'NU', 683, 'Niue', 1, 0),
(159, 'NFK', 'NF', 672, 'Norfolk Islands', 1, 0),
(160, 'MNP', 'MP', 1670, 'Mariana Islands', 1, 0),
(161, 'NOR', 'NO', 47, 'Norway', 1, 0),
(162, 'OMN', 'OM', 968, 'Oman', 1, 0),
(163, 'PAK', 'PK', 92, 'Pakistan', 1, 0),
(164, 'PLW', 'PW', 680, 'Palau', 1, 0),
(165, 'PSE', 'PS', 970, 'Palestine', 1, 0),
(166, 'PAN', 'PA', 507, 'Panama', 1, 0),
(167, 'PNG', 'PG', 675, 'Papua New Guinea', 1, 0),
(168, 'PRY', 'PY', 595, 'Paraguay', 1, 0),
(169, 'PER', 'PE', 51, 'Peru', 1, 0),
(170, 'PHL', 'PH', 63, 'Philippines', 1, 0),
(171, 'PCN', 'PN', 870, 'Pitcairn', 1, 0),
(172, 'POL', 'PL', 48, 'Poland', 1, 0),
(173, 'PRT', 'PT', 351, 'Portugal', 1, 0),
(174, 'PRI', 'PR', 1, 'Puerto Rico', 1, 0),
(175, 'QAT', 'QA', 974, 'Qatar', 1, 0),
(176, 'REU', 'RE', 262, 'Reunion Island', 1, 0),
(177, 'ROU', 'RO', 40, 'Romania', 1, 0),
(178, 'RUS', 'RU', 7, 'Russia', 1, 0),
(179, 'RWA', 'RW', 250, 'Rwanda', 1, 0),
(180, 'KNA', 'KN', 1869, 'St. Kitts', 1, 0),
(181, 'LCA', 'LC', 1758, 'St. Lucia', 1, 0),
(182, 'VCT', 'VC', 1784, 'St. Vincent', 1, 0),
(183, 'WSM', 'WS', 685, 'Samoa', 1, 0),
(184, 'SMR', 'SM', 378, 'San Marino', 1, 0),
(185, 'STP', 'ST', 239, 'Sao Tome', 1, 0),
(186, 'SAU', 'SA', 966, 'Saudi Arabia', 1, 0),
(187, 'SEN', 'SN', 221, 'Senegal', 1, 0),
(188, 'SYC', 'SC', 248, 'Seychelles', 1, 0),
(189, 'SLE', 'SL', 232, 'Sierra Leone', 1, 0),
(190, 'SGP', 'SG', 65, 'Singapore', 1, 0),
(191, 'SVK', 'SK', 421, 'Slovakia', 1, 0),
(192, 'SVN', 'SI', 386, 'Slovenia', 1, 0),
(193, 'SLB', 'SB', 677, 'Solomon Islands', 1, 0),
(194, 'SOM', 'SO', 252, 'Somalia', 1, 0),
(195, 'ZAF', 'ZA', 27, 'South africa', 1, 0),
(196, 'SGS', 'GS', 500, 'South Georgia and the South Sandwich Islands', 1, 0),
(197, 'ESP', 'ES', 34, 'Spain', 1, 0),
(198, 'LKA', 'LK', 94, 'Sri Lanka', 1, 0),
(199, 'SHN', 'SH', 290, 'St. Helena', 1, 0),
(200, 'SPM', 'PM', 508, 'St. Pierre & Miquelon', 1, 0),
(201, 'SDN', 'SD', 249, 'Sudan', 1, 0),
(202, 'SUR', 'SR', 597, 'Suriname', 1, 0),
(203, 'SJM', 'SJ', 47, 'Svalbard and Jan Mayen Islands', 1, 0),
(204, 'SWZ', 'SZ', 268, 'Swaziland', 1, 0),
(205, 'SWE', 'SE', 46, 'Sweden', 1, 0),
(206, 'CHE', 'CH', 41, 'Switzerland', 1, 0),
(207, 'SYR', 'SY', 963, 'Syria', 1, 0),
(208, 'TWN', 'TW', 886, 'Taiwan', 1, 0),
(209, 'TJK', 'TJ', 992, 'Tajikistan', 1, 0),
(210, 'TZA', 'TZ', 255, 'Tanzania', 1, 0),
(211, 'THA', 'TH', 66, 'Thailand', 1, 0),
(212, 'TGO', 'TG', 228, 'Togo', 1, 0),
(213, 'TKL', 'TK', 690, 'Tokelau', 1, 0),
(214, 'TON', 'TO', 676, 'Tonga', 1, 0),
(215, 'TTO', 'TT', 1868, 'Trinidad & Tobago', 1, 0),
(216, 'TUN', 'TN', 216, 'Tunisia', 1, 0),
(217, 'TUR', 'TR', 90, 'Turkey', 1, 0),
(218, 'TKM', 'TM', 993, 'Turkmenistan', 1, 0),
(219, 'TCA', 'TC', 1649, 'Turks & Caicos Islands', 1, 0),
(220, 'TUV', 'TV', 688, 'Tuvalu', 1, 0),
(221, 'UGA', 'UG', 256, 'Uganda', 1, 0),
(222, 'UKR', 'UA', 380, 'Ukraine', 1, 0),
(223, 'ARE', 'AE', 971, 'United Arab Emirates', 1, 0),
(224, 'GBR', 'GB', 44, 'United Kingdom', 1, 500),
(225, 'USA', 'US', 1, 'United States of America', 1, 498),
(226, 'UMI', 'UM', 581, 'United States Minor Outlying Islands', 1, 0),
(227, 'URY', 'UY', 598, 'Uruguay', 1, 0),
(228, 'UZB', 'UZ', 998, 'Uzbekistan', 1, 0),
(229, 'VUT', 'VU', 678, 'Vanuatu', 1, 0),
(230, 'VAT', 'VA', 39, 'Vatican', 1, 0),
(231, 'VEN', 'VE', 58, 'Venezuela', 1, 0),
(232, 'VNM', 'VN', 84, 'Viet nam', 1, 0),
(233, 'VGB', 'VG', 1284, 'British Virgin Islands', 1, 0),
(234, 'VIR', 'VI', 1340, 'US Virgin Islands', 1, 0),
(235, 'WLF', 'WF', 681, 'Wallis & Futuna Islands', 1, 0),
(236, 'ESH', 'EH', 212, 'Western Sahara', 1, 0),
(237, 'YEM', 'YE', 967, 'Yemen', 1, 0),
(238, 'YUG', 'YU', 891, 'Yugoslavia', 2, 0),
(239, 'ZMB', 'ZM', 260, 'Zambia', 1, 0),
(240, 'ZWE', 'ZW', 263, 'Zimbabwe', 1, 0),
(241, 'SRB', 'RS', 381, 'Serbia', 1, 0),
(242, 'MNE', 'ME', 382, 'Montenegro', 1, 0),
(243, 'YAR', 'YE', 0, 'North Yemen', 2, 0),
(244, 'SSD', 'SD', 211, 'South Sudan', 1, 0),
(245, 'SCG', 'CS', 381, 'Kosovo', 1, 0),
(246, 'MAF', 'MF', 1599, 'St. Martin', 1, 0),
(247, 'ASC', 'AC', 247, 'Ascension Island', 2, 0),
(248, 'ACT', '', 672, 'Australian Territories', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

DROP TABLE IF EXISTS `extensions`;
CREATE TABLE IF NOT EXISTS `extensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `name`, `status`, `active`, `created_at`, `updated_at`) VALUES
(1, '1001', 0, 1, '2021-04-18 11:48:22', '2021-04-18 11:48:22'),
(2, '1003', 0, 1, '2021-04-18 11:48:38', '2021-04-18 11:48:38'),
(3, '1004', 0, 1, '2021-04-18 11:48:38', '2021-04-18 11:48:38'),
(4, '1005', 0, 1, '2021-04-18 11:48:38', '2021-04-18 11:48:38'),
(5, '1006', 0, 1, '2021-04-18 11:50:19', '2021-04-18 11:50:19'),
(6, '1007', 0, 1, '2021-04-18 11:50:19', '2021-04-18 11:50:19'),
(7, '1008', 0, 1, '2021-04-18 11:50:19', '2021-04-18 11:50:19'),
(8, '1009', 0, 1, '2021-04-18 11:50:19', '2021-04-18 11:50:19'),
(9, '1010', 0, 1, '2021-04-18 11:50:19', '2021-04-18 11:50:19'),
(14, '1016', 1, 1, '2021-04-18 11:53:25', '2021-04-18 12:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test package', '52', 'inr', 1, '2021-04-17 16:27:04', '2021-04-17 16:33:46'),
(2, 'Basic Pacakge', '10', 'usd', 1, '2021-04-17 16:31:26', '2021-04-17 16:31:26'),
(4, 'test new pacakge', '20', 'usd', 0, '2021-04-17 16:34:31', '2021-04-18 06:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `alternate_phone` varchar(15) DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `extension` int(11) DEFAULT NULL,
  `education` varchar(256) NOT NULL,
  `country_id` int(4) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `currency` varchar(110) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `type` int(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `fname`, `mname`, `lname`, `dob`, `sex`, `address`, `address_2`, `mobile`, `alternate_phone`, `category_id`, `extension`, `education`, `country_id`, `city`, `state`, `zip`, `amount`, `currency`, `image`, `type`, `status`, `description`, `created_at`, `updated_at`) VALUES
(5, 'admin', 'admin@test.com', '$2y$10$y7QxpCb4oKAy8xIEzglsXO1YRCHeNEJwXuOX/N4JhQv3zkKIyCFZO', NULL, NULL, NULL, '0000-00-00', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-09-14 20:53:30', '2020-09-14 20:53:30'),
(8, 'fdsfds fdsfds', 'test123323@test.com', '$2y$10$0uWifh5QfPL7dBmZ15U7qOBjHfnZeLKTuCJQmlpP6Yt9pCTRhMjU.', 'fdsfds', 'fdsfdsf', 'fdsfds', '2014-01-08', 'male', 'fdsfs', NULL, '065463456', 'fdsfs', '1', 1, 'fdfsd', NULL, NULL, NULL, NULL, '20', 'inr', NULL, 2, NULL, 'fdsfdsafds', '2021-04-16 17:01:26', '2021-05-08 16:22:32'),
(9, 'Shyam Pandey', 'test12311@test.com', '$2y$10$fdje/xvMHDDs8OPtnTDSFedJ4ht.5j5rlLJWZRdjzwolm7gfIr65.', 'Shyam', 'Vinay', 'Pandey', '2002-10-08', 'male', 'mariahilfer', NULL, '065463456', '065463456', '1', 1, 'fdsfds', NULL, NULL, NULL, NULL, '5', 'dollor', NULL, 2, NULL, 'ghgfdhdgfh', '2021-04-16 17:04:13', '2021-05-08 16:19:14'),
(11, 'vcxv Pandey', 'shyamvinayp85@gmail.com', '$2y$10$KMQPXB/dZl1qLT2B104qeOAFfISwl0J9GGH7PSDxkLMFlZHQWbVqu', 'vcxv', 'Vinay', 'Pandey', '2010-10-08', 'male', 'mariahilfer', NULL, '065463456', NULL, '1', 1, 'fdsfds', NULL, NULL, NULL, NULL, '7', 'inr', NULL, 2, NULL, 'dfdsfds', '2021-04-16 17:05:12', '2021-05-08 16:18:14'),
(20, 'Customer', 'agent@test.com', '$2y$10$c3vnGaDAkhEq/uvKSt5qf.0nG4.mjHzkT1gh1GTmaWo8bYdo5zCkK', 'fdsfsupd', 'fdsfds', 'fdsf upd', '2021-04-24', 'female', 'fdsfds', NULL, '65456465', NULL, '1', 1, 'fdsfds', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, '2021-04-24 08:42:04', '2021-04-24 09:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(10) NOT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `id_pancard` varchar(256) DEFAULT NULL,
  `id_adharcard` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `account_number`, `bank_name`, `ifsc_code`, `bank_branch`, `id_pancard`, `id_adharcard`, `created_at`, `updated_at`) VALUES
(1, 20, '6584564564', 'test', '121212', 'test', NULL, NULL, '2021-04-24 08:42:05', '2021-04-24 08:42:05'),
(2, 11, '6584564564', 'test', '121212', 'test', NULL, NULL, '2021-05-08 16:17:54', '2021-05-08 16:17:54'),
(3, 9, '6584564564', 'test', '121212', 'test', NULL, NULL, '2021-05-08 16:19:14', '2021-05-08 16:19:14'),
(4, 8, '6584564564', 'test', '121212', 'test', NULL, NULL, '2021-05-08 16:22:32', '2021-05-08 16:22:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
