-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2022 at 01:30 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `democustomlinks_clarabelle-hair-boutique_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `text` text,
  `subtext` varchar(255) DEFAULT NULL,
  `description` text,
  `button_name` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `page`, `text`, `subtext`, `description`, `button_name`, `button_link`, `image`, `created_at`, `updated_at`) VALUES
(18, 'Home Page', 'Come Find Your hair', 'Happiness', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitati', 'READ MORE', '#', 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 15:06:28'),
(19, 'About Us Page', 'About Us', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(20, 'Services Page', 'Services', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(21, 'Products Page', 'Products', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(22, 'FAQ Page', 'FAQs', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(23, 'Hair Extensions Page', 'Hair Extensions', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(24, 'Cart Page', 'Cart', NULL, NULL, NULL, NULL, 'storage/images/banner/632b4f04a0a0d1663782660.png', '2022-09-21 17:30:34', '2022-09-21 12:53:03'),
(25, 'Thankyou', 'Thankyou', NULL, NULL, NULL, NULL, 'storage/images/banner/63336d35aa70f1664314677.png', '2022-09-27 21:37:18', '2022-09-27 16:37:58'),
(26, 'Contact Us', 'Contact Us', NULL, NULL, NULL, NULL, 'storage/images/banner/63336d35aa70f1664314677.png', '2022-09-27 21:37:18', '2022-09-27 16:37:58'),
(27, 'Login', 'Login', NULL, NULL, NULL, NULL, 'storage/images/banner/63336d35aa70f1664314677.png', '2022-09-27 21:37:18', '2022-09-27 16:37:58'),
(28, 'Register', 'REGISTER YOURSELF', NULL, NULL, NULL, NULL, 'storage/images/banner/63336d35aa70f1664314677.png', '2022-09-27 21:37:18', '2022-09-27 16:37:58'),
(29, 'Product Detail', 'Product Detail', NULL, NULL, NULL, NULL, 'storage/images/banner/63336d35aa70f1664314677.png', '2022-09-27 21:37:18', '2022-09-27 16:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` int(10) NOT NULL,
  `top_marked` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `is_active`, `top_marked`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hair Extensions', 'hair-extensions', 1, 0, '2022-09-21 15:33:55', '2022-09-21 20:33:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'storage/images//63339807c36981664325639.png', '2021-10-01 08:12:38', '2022-09-28 04:40:39'),
(2, 'favicon', 'storage/images//632b47f9714f11663780857.png', '2021-10-01 08:12:38', '2022-09-21 12:20:57'),
(3, 'contact', '021-13587-548', '2021-10-01 08:14:41', '2022-09-21 12:24:09'),
(4, 'secondary_email', 'bratasatester@gmail.com', '2021-10-01 08:14:41', '2021-10-01 08:14:41'),
(5, 'primary_email', 'loremipus@gmaiil.com', '2021-10-01 08:15:20', '2022-09-21 12:24:22'),
(6, 'website_name', 'Clarabelle Hair Boutique', '2022-02-18 18:12:09', '2022-09-21 12:20:31'),
(7, 'tag_line', 'Affordable intelligent Solutions for Today\'s World', '2021-10-01 08:17:05', '2021-10-01 08:17:05'),
(8, 'footer_logo', 'storage/images//621024bc84c411645225148.png', '2021-10-01 08:17:05', '2022-02-18 12:59:08'),
(9, 'footer_text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2021-10-01 08:18:00', '2022-03-15 14:14:19'),
(10, 'address', 'Street 12345 lorem ipsum', '2021-10-01 08:18:00', '2022-09-22 12:16:42'),
(11, 'copy_right', '©copyright. 2022 All Right Reserved.', '2022-01-13 19:32:21', '2022-02-22 08:06:38'),
(12, 'facebook', 'https://www.facebook.com/', '2022-01-20 13:32:40', '2022-09-22 12:20:44'),
(13, 'twitter', 'https://twitter.com/j_grzywa', '2022-01-20 13:32:40', '2022-06-27 17:53:56'),
(14, 'instagram', 'https://www.instagram.com/', '2022-01-20 13:32:40', '2022-09-22 12:20:33'),
(15, 'linked_in', 'https://www.linkedin.com/company/82275042/admin/', '2022-03-21 11:46:49', '2022-06-27 17:59:16'),
(16, 'open_hours', 'monday to friday 8:30 am - 5:30pm (GMT)', '2022-09-22 17:19:08', '2022-09-22 12:19:27'),
(17, 'live_location', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d172138.65426867263!2d-122.48214825745869!3d47.613174640877745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490102c93e83355%3A0x102565466944d59a!2sSeattle%2C%20WA%2C%20USA!5e0!3m2!1sen!2s!4v1646753623814!5m2!1sen!2s\"></iframe>', '2022-09-22 17:25:38', '2022-09-22 12:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` longtext,
  `short_description` text,
  `button_text` varchar(255) DEFAULT NULL,
  `btn_color` varchar(10) DEFAULT NULL,
  `link` text,
  `primary_image` text,
  `secondary_image` text,
  `video` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page`, `section`, `title`, `subtitle`, `description`, `short_description`, `button_text`, `btn_color`, `link`, `primary_image`, `secondary_image`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'About Us', 'Clarabelle Hair Boutique', NULL, '<p class=\"pera\">&lt;p&gt;Clarabelle is a boutique style salon ,located in the heart of naas town co kildare.I opened the doors in 2016 and have loved every minute of seeing it grow to where we are today. We pride ourselves in giving our clients a unique personal service in a friendly relaxed environment.We have over 20 years experience and are&nbsp; constantly growing our skills to keep up with all the latest hair trends and products.We have trained and continue to train with some of the best brands in the industry including L\'Oreal Professional hair colour and homecare, Olaplex ,&nbsp; ghd styling tools and elite hair extensions. Clarabelle hair boutique offer a wide range of services and specialise in hair extensions,&nbsp; balayage, and colour techniques. &lt;/p&gt;</p>', NULL, 'Read More', '#CC9F8E', 'http://localhost/mack/clarabelle-hair-boutique/public/about-us', 'storage/images/content/632c954f42de21663866191.png', NULL, NULL, '2021-10-01 13:26:31', '2022-09-22 12:03:13'),
(2, 'Home Page', 'Services', 'SERVICES WHAT WE PROVIDE', 'nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. nisi ut aliqui p ex ea commodo consequat. ex ea commodo consequat. nisi uex ea commodo consequat. nisi u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:26:31', '2022-09-28 23:02:10'),
(3, 'Home Page', 'Shop', 'Our Products', NULL, NULL, NULL, NULL, NULL, NULL, 'storage/images/content/632ca299471381663869593.png', NULL, NULL, '2021-10-01 13:27:32', '2022-09-22 12:59:53'),
(4, 'Home Page', 'Why Choose Us', 'WHY CHOOSE US?', NULL, '<p>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. nisi ut aliquip ex ea c</p>\n<ul class=\"list-chose\">\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Hair Extensions</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Best Services</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Buy Products</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> lorem ipum</li>\n</ul>', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut nisi ut aliquip ex ea commodo consequat.', 'Read More', '#CC9F8E', '#', 'storage/images/content/632c95e3256961663866339.png', NULL, NULL, '2021-10-01 13:27:32', '2022-09-22 18:14:19'),
(5, 'Home Page', 'Testimonials', 'TESTIMONIAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 17:08:08'),
(6, 'Home Page', 'Gallery', 'OUR GALLERY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 17:08:08'),
(7, 'About Us Page', 'Page Content', 'Clarabelle Hair Boutique', NULL, '&lt;p&gt;Clarabelle is a boutique style salon ,located in the heart of naas town co kildare. I opened the doors in 2016 and have loved every minute of seeing it grow to where we are today. We pride ourselves in giving our clients a unique personal service in a friendly relaxed environment. We have over 20 years experience and are constantly growing our skills to keep up with all the latest hair trends and products.We have trained and continue to train with some of the best brands in the industry including L\'Oreal Professional hair colour and homecare, Olaplex , ghd styling tools and elite hair extensions. Clarabelle hair boutique offer a wide range of services and specialise in hair extensions, balayage, and colour techniques.&lt;/p&gt;', NULL, NULL, NULL, NULL, 'storage/images/content/632c97a169f031663866785.png', NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 12:13:17'),
(8, 'Contact Us', 'Each Page', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 12:13:17'),
(9, 'Contact Us', 'Page Titles', 'Send us a message', 'Contact Us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-28 23:18:05'),
(10, 'Login', 'Login Form TItle', 'Login Your Account', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-28 23:22:06'),
(11, 'Register', 'Register Form Title', 'Register Your Account', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-28 23:22:06'),
(12, 'Services Page', 'Top Info', 'ARE SERVICES WHAT WE PROVIDE', 'nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. nisi ut aliqui p ex ea commodo consequat. ex ea commodo consequat. nisi uex ea commodo consequat. nisi u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-10-04 21:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(15) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Where is the salon located?', '37 North Main Street Naas Co Kildare W91 PKN1', 1, '2022-09-21 15:23:18', '2022-09-21 20:31:57', NULL),
(2, 'Do you offer free consultations?', 'Yes feel free to pop in any time for a free consultation on any of our service', 1, '2022-09-21 15:23:40', '2022-09-21 20:32:02', NULL),
(3, 'What are your prices?', 'You can view our price list here (link)', 1, '2022-09-21 15:23:57', '2022-09-21 20:32:11', NULL),
(4, 'Do I need to pay a deposit?', 'We require a deposit on all hair extension bookings and may require deposits on colouring services that exceed 2 hours', 1, '2022-09-21 15:24:10', '2022-09-21 20:32:13', NULL),
(5, 'What colour brand do you use?', 'We use loreal professional colours and toners', 1, '2022-09-21 15:24:21', '2022-09-21 20:32:15', NULL),
(6, 'Do you offer hair extension services?', 'Yes we offer a range of services from fillers to full heads a consultation is required before booking. Please note we do not take clients that have had extensions applied elsewhere.', 1, '2022-09-21 15:24:34', '2022-09-21 20:32:18', NULL),
(7, 'Do I need a patch test?', 'Yes all new clients are required to have a patch test 48 hours prior to colouring service', 1, '2022-09-21 15:24:48', '2022-09-21 20:32:20', NULL),
(8, 'What is the required age for Colouring services?', '16 with signed parental consent', 1, '2022-09-21 15:25:15', '2022-09-21 20:32:23', NULL),
(9, 'Do I need to make an appointment?', 'In order to secure your ideal appointment we recommend booking in, but we do offer a walk in service upon availability', 1, '2022-09-21 15:25:29', '2022-09-21 20:32:25', NULL),
(10, 'Do you take cash or credit card?', 'We accept both', 1, '2022-09-21 15:25:43', '2022-09-21 20:32:28', NULL),
(11, 'testing FAQ', 'testing FAQ', 1, '2022-09-28 03:33:16', '2022-09-28 00:08:09', '2022-09-28 00:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `primary_image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `primary_image`, `created_at`, `updated_at`) VALUES
(1, 'storage/images/gallery_images/632b9ecb98fdb1663803083.jpg', '2022-09-21 18:31:23', '2022-09-21 23:31:23'),
(2, 'storage/images/gallery_images/632b9ed455ce61663803092.jpg', '2022-09-21 18:31:32', '2022-09-21 23:31:32'),
(3, 'storage/images/gallery_images/632b9edbdbd2a1663803099.jpg', '2022-09-21 18:31:39', '2022-09-21 23:31:39'),
(4, 'storage/images/gallery_images/632b9eeea70fc1663803118.jpg', '2022-09-21 18:31:58', '2022-09-21 23:31:58'),
(5, 'storage/images/gallery_images/632b9ef631d301663803126.jpg', '2022-09-21 18:32:06', '2022-09-21 23:32:06'),
(6, 'storage/images/gallery_images/632b9efee00531663803134.jpg', '2022-09-21 18:32:14', '2022-09-21 23:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mack', 'test@gmail.com', NULL, 'testing', '2022-09-22 12:42:23', '2022-09-22 17:42:23', NULL),
(2, 'Tester here', 'test@gmail.com', NULL, 'asd', '2022-09-22 12:44:12', '2022-09-22 17:44:12', NULL),
(3, 'john smith', 'john_smith@gmail.com', NULL, NULL, '2022-09-27 18:00:38', '2022-09-27 23:00:38', NULL),
(4, 'james', '#$$a@gmail.com', NULL, NULL, '2022-09-29 22:02:43', '2022-09-29 18:02:43', NULL),
(5, 'mufasa', 'mufasa@gmail.com', NULL, 'Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.', '2022-09-29 22:03:45', '2022-09-29 18:03:45', NULL),
(6, 'andy', 'andy@gmail.com', NULL, 'Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.', '2022-09-29 22:04:07', '2022-09-29 18:04:07', NULL),
(7, 'asd', '#$%$%^@gmail.com', NULL, NULL, '2022-09-29 22:08:28', '2022-09-29 18:08:28', NULL),
(8, 'test test', 'test@test.com', NULL, 'sad', '2022-09-30 01:02:42', '2022-09-29 21:02:42', NULL),
(9, 'dummy', 'asd@gmail.com', NULL, NULL, '2022-09-30 19:38:30', '2022-09-30 15:38:30', NULL),
(10, 'dummy', 'dummy@gmail.com', NULL, 'Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.', '2022-09-30 19:40:17', '2022-09-30 15:40:17', NULL),
(11, 'dummy', 'johnjenson@yopmail.com', NULL, 'Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.Vestibulum neque massa, scelerisque sit amet ligula eu, congue molestie mi. Praesent ut varius sem. Nullam at porttitor arcu, nec lacinia nisi. Ut ac dolor vitae odio interdum condimentum. Vivamus dapibus sodales ex, vitae malesuada ipsum cursus convallis. Maecenas sed egestas nulla, ac condimentum orci. Mauris diam felis, vulputate ac suscipit et, iaculis non est. Curabitur semper arcu ac ligula semper, nec luctus nisl blandit. Integer lacinia ante ac libero lobortis imperdiet. Nullam mollis convallis ipsum, ac accumsan nunc vehicula vitae. Nulla eget justo in felis tristique fringilla. Morbi sit amet tortor quis risus auctor condimentum. Morbi in ullamcorper elit. Nulla iaculis tellus sit amet mauris tempus fringilla.', '2022-09-30 19:41:09', '2022-09-30 15:41:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` text NOT NULL,
  `type` text NOT NULL,
  `notifiable_type` varchar(50) NOT NULL,
  `notifiable_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `user_id`, `name`, `sku`, `quantity`, `image`, `category`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '3', 'GHD6', 'GHghd6-HE-250437029', 1, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-09-27 17:09:17', '2022-09-27 17:09:17'),
(2, 1, '3', 'GHD3', 'GHghd3-HE-365043011', 3, 'storage/images/products/632b89e121c991663797729.png', 1, '200', '2022-09-27 17:09:17', '2022-09-27 17:09:17'),
(3, 2, '4', 'dummy 01', 'DUdummy-01-HE-552872934', 1, 'storage/images/products/6334a969c6ad81664395625.png', 1, '250', '2022-09-29 22:52:40', '2022-09-29 22:52:40'),
(4, 3, '4', 'GHD6', 'GHghd6-HE-250437029', 1, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-09-29 23:22:00', '2022-09-29 23:22:00'),
(5, 4, '4', 'dummy 01', 'DUdummy-01-HE-552872934', 1, 'storage/images/products/6334a969c6ad81664395625.png', 1, '250', '2022-10-04 03:13:10', '2022-10-04 03:13:10'),
(6, 5, '4', 'dummy 01', 'DUdummy-01-HE-552872934', 1, 'storage/images/products/6334a969c6ad81664395625.png', 1, '250', '2022-10-04 03:48:32', '2022-10-04 03:48:32'),
(7, 5, '4', 'GHD6', 'GHghd6-HE-250437029', 2, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-10-04 03:48:32', '2022-10-04 03:48:32'),
(8, 5, '4', 'GHD5', 'GHghd5-HE-365353445', 4, 'storage/images/products/632b8a27323301663797799.png', 1, '200', '2022-10-04 03:48:32', '2022-10-04 03:48:32'),
(9, 6, '3', 'GHD6', 'GHghd6-HE-250437029', 2, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-10-04 03:58:16', '2022-10-04 03:58:16'),
(10, 7, '3', 'GHD6', 'GHghd6-HE-250437029', 2, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-10-04 03:59:00', '2022-10-04 03:59:00'),
(11, 8, '3', 'GHD6', 'GHghd6-HE-250437029', 2, 'storage/images/products/632b8a571ef1b1663797847.png', 1, '200', '2022-10-04 04:01:45', '2022-10-04 04:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `billing_first_name` varchar(255) DEFAULT NULL,
  `billing_last_name` varchar(255) DEFAULT NULL,
  `billing_city` varchar(50) DEFAULT NULL,
  `billing_state` varchar(50) DEFAULT NULL,
  `billing_address1` varchar(255) DEFAULT NULL,
  `billing_address2` varchar(255) DEFAULT NULL,
  `billing_zipcode` varchar(20) DEFAULT NULL,
  `billing_country` varchar(255) NOT NULL,
  `billing_contact` varchar(20) DEFAULT NULL,
  `billing_email` varchar(255) NOT NULL,
  `shipping_first_name` varchar(255) DEFAULT NULL,
  `shipping_last_name` varchar(255) DEFAULT NULL,
  `shipping_contact` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_address1` varchar(255) DEFAULT NULL,
  `shipping_address2` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_state` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_zip` varchar(255) DEFAULT NULL,
  `order_items` int(11) DEFAULT '0',
  `user_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_email` varchar(255) DEFAULT NULL,
  `payment_info` text,
  `payment_status` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` int(11) DEFAULT '0',
  `order_status` varchar(100) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `billing_first_name`, `billing_last_name`, `billing_city`, `billing_state`, `billing_address1`, `billing_address2`, `billing_zipcode`, `billing_country`, `billing_contact`, `billing_email`, `shipping_first_name`, `shipping_last_name`, `shipping_contact`, `shipping_email`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `order_items`, `user_id`, `quantity`, `subtotal`, `total`, `order_email`, `payment_info`, `payment_status`, `updated_at`, `created_at`, `is_deleted`, `order_status`) VALUES
(1, '6333748d', 'Mack', 'Tester', NULL, 'Testing state', 'Testing address one', 'Testing address two', '12345', 'American Samoa', '123456789', 'mackasauser@gmail.com', 'Mack', 'Tester', '123456789', 'mackasauser@gmail.com', 'Testing address one', 'Testing address two', NULL, 'Testing state', 'American Samoa', '12345', 0, '3', 2, 200, 800, NULL, NULL, NULL, '2022-09-27 18:19:44', '2022-09-27 17:09:17', 0, '0'),
(2, '6335e978', 'liam', 'jenson', NULL, 'newyork', '142', 'street', '123', 'United Kingdom', '1111111111', 'liamjenson@yopmail.com', 'liam', 'jenson', '1111111111', 'liamjenson@yopmail.com', 'Dummy', '142 street', NULL, 'newyork', 'Pakistan', '123', 0, '4', 1, 250, 250, NULL, NULL, NULL, '2022-09-29 23:27:38', '2022-09-29 22:52:40', 0, '2'),
(3, '6335f058', 'clay', 'jenson', NULL, 'newyork', '142', 'street', '123', 'United States', '123456789', 'clayjenson105@gmail.com', 'clay', 'jenson', '123456789', 'clayjenson105@gmail.com', '142', 'street', NULL, 'newyork', 'United States', '123', 0, '4', 1, 200, 200, NULL, NULL, NULL, '2022-09-29 23:27:19', '2022-09-29 23:22:00', 0, '1'),
(4, '633b6c86', 'clay', 'jenson', NULL, 'newyork', '142', 'street', '123', 'United States', '441-234-5678', 'clayjenson105@gmail.com', 'clay', 'jenson', '441-234-5678', 'clayjenson105@gmail.com', '142', 'street', NULL, 'newyork', 'United States', '123', 0, '4', 1, 250, 250, NULL, NULL, NULL, '2022-10-04 03:15:16', '2022-10-04 03:13:10', 0, '2'),
(5, '633b74d0', 'clay', 'jenson', NULL, 'newyork', '142', 'street', '123', 'United States', '441-234-5678', 'clayjenson105@gmail.com', 'clay', 'jenson', '441-234-5678', 'clayjenson105@gmail.com', '142', 'street', NULL, 'newyork', 'United States', '123', 0, '4', 3, 200, 1450, NULL, NULL, NULL, '2022-10-04 03:50:11', '2022-10-04 03:48:32', 0, '1'),
(6, '633b7718', 'Mack', 'Tester', NULL, 'Testing state', 'Testing address one', 'Testing address two', '12345', 'Albania', '123-456-789', 'mackasauser@gmail.com', 'Mack', 'Tester', '123-456-789', 'mackasauser@gmail.com', 'Testing address one', 'Testing address two', NULL, 'Testing state', 'Albania', '12345', 0, '3', 1, 200, 400, NULL, NULL, NULL, '2022-10-04 03:58:16', '2022-10-04 03:58:16', 0, '0'),
(7, '633b7744', 'Mack', 'Tester', NULL, 'Testing state', 'Testing address one', 'Testing address two', '12345', 'Albania', '123-456-789', 'mackasauser@gmail.com', 'Mack', 'Tester', '123-456-789', 'mackasauser@gmail.com', 'Testing address one', 'Testing address two', NULL, 'Testing state', 'Albania', '12345', 0, '3', 1, 200, 400, NULL, NULL, NULL, '2022-10-04 03:59:00', '2022-10-04 03:59:00', 0, '0'),
(8, '633b77e9', 'Mack', 'Tester', NULL, 'Testing state', 'Testing address one', 'Testing address two', '12345', 'Andorra', '123-456-789', 'mackasauser@gmail.com', 'Mack', 'Tester', '123-456-789', 'mackasauser@gmail.com', 'Testing address one', 'Testing address two', NULL, 'Testing state', 'Andorra', '12345', 0, '3', 1, 200, 400, NULL, NULL, NULL, '2022-10-04 04:01:45', '2022-10-04 04:01:45', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `selling_price` int(10) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_featured` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `category_id`, `short_description`, `description`, `selling_price`, `stock`, `image`, `is_active`, `is_featured`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GHD', 'ghd', 'GHghd-HE-794861591', 1, 'Lorem Ipsum is simply dummied text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b884c1977b1663797324.png', 1, 1, NULL, '2022-09-21 16:55:24', '2022-09-21 22:33:47', NULL),
(2, 'GHD2', 'ghd2', 'GHghd2-HE-797158942', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b89b90a08b1663797689.png', 1, 1, NULL, '2022-09-21 17:01:29', '2022-09-21 22:33:39', NULL),
(3, 'GHD3', 'ghd3', 'GHghd3-HE-365043011', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b89e121c991663797729.png', 1, 1, NULL, '2022-09-21 17:02:09', '2022-09-21 22:33:50', NULL),
(4, 'GHD4', 'ghd4', 'GHghd4-HE-444536666', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b8a06dc3001663797766.png', 1, 0, NULL, '2022-09-21 17:02:46', '2022-09-21 22:43:25', NULL),
(5, 'GHD5', 'ghd5', 'GHghd5-HE-365353445', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b8a27323301663797799.png', 1, 0, NULL, '2022-09-21 17:03:19', '2022-09-21 22:43:27', NULL),
(6, 'GHD6', 'ghd6', 'GHghd6-HE-250437029', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 9, 'storage/images/products/632b8a571ef1b1663797847.png', 1, 0, NULL, '2022-09-21 17:04:07', '2022-10-04 00:01:45', NULL),
(7, 'GHD7', 'ghd7', 'GHghd7-HE-166726305', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><p class=\"scnd-p\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br></p>', 200, 12, 'storage/images/products/632b901f9e1fa1663799327.png', 0, 0, 1, '2022-09-21 17:28:47', '2022-09-27 22:58:34', NULL),
(8, 'dummy 01', 'dummy-01', 'DUdummy-01-HE-552872934', 1, 'sd', '<p>asdasdsadasdsdsa</p>', 250, 1, 'storage/images/products/6334a969c6ad81664395625.png', 1, 0, 1, '2022-09-29 00:07:05', '2022-09-28 20:07:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(15) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/images/products/632b884c44ec01663797324.png', '2022-09-21 16:55:24', '2022-09-21 21:55:24'),
(2, 1, 'storage/images/products/632b884c7fbd81663797324.png', '2022-09-21 16:55:24', '2022-09-21 21:55:24'),
(3, 2, 'storage/images/products/632b89b94b8ec1663797689.png', '2022-09-21 17:01:29', '2022-09-21 22:01:29'),
(4, 2, 'storage/images/products/632b89b98e7351663797689.png', '2022-09-21 17:01:29', '2022-09-21 22:01:29'),
(5, 3, 'storage/images/products/632b89e1413671663797729.png', '2022-09-21 17:02:09', '2022-09-21 22:02:09'),
(6, 3, 'storage/images/products/632b89e1679391663797729.png', '2022-09-21 17:02:09', '2022-09-21 22:02:09'),
(7, 4, 'storage/images/products/632b8a071dcd31663797767.png', '2022-09-21 17:02:47', '2022-09-21 22:02:47'),
(8, 4, 'storage/images/products/632b8a07386e51663797767.png', '2022-09-21 17:02:47', '2022-09-21 22:02:47'),
(9, 5, 'storage/images/products/632b8a27545741663797799.png', '2022-09-21 17:03:19', '2022-09-21 22:03:19'),
(10, 5, 'storage/images/products/632b8a277a7711663797799.png', '2022-09-21 17:03:19', '2022-09-21 22:03:19'),
(11, 6, 'storage/images/products/632b8a574c4671663797847.png', '2022-09-21 17:04:07', '2022-09-21 22:04:07'),
(12, 6, 'storage/images/products/632b8a5778e521663797847.png', '2022-09-21 17:04:07', '2022-09-21 22:04:07'),
(13, 7, 'storage/images/products/632b901fd613f1663799327.png', '2022-09-21 17:28:47', '2022-09-21 22:28:47'),
(14, 7, 'storage/images/products/632b90200681f1663799328.png', '2022-09-21 17:28:48', '2022-09-21 22:28:48'),
(17, 8, 'storage/images/products/6334bbb049c061664400304.png', '2022-09-29 01:25:04', '2022-09-28 21:25:04'),
(18, 8, 'storage/images/products/6334bbb07b5be1664400304.png', '2022-09-29 01:25:04', '2022-09-28 21:25:04'),
(19, 8, 'storage/images/products/6334bbb09c55d1664400304.png', '2022-09-29 01:25:04', '2022-09-28 21:25:04'),
(20, 8, 'storage/images/products/6334bbb0b2fa61664400304.png', '2022-09-29 01:25:04', '2022-09-28 21:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `primary_image` varchar(255) NOT NULL,
  `secondary_image` varchar(255) NOT NULL,
  `is_active` int(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `short_description`, `description`, `primary_image`, `secondary_image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CUTTING', 'cutting', 'Looking for a new do? we can advise you on all different lengths and styles. If you’re looking for a short cropped style, a layered bob or long locks with volume will be able to offer you a style to suit your lifestyle and face shape', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334ca1f584841664403999.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:26:39', NULL),
(2, 'HAIR EXTENSIONS', 'hair-extensions', 'Clara has being doing hair extensions for over ten years ,and is very passionate about the ability they have to completely transform your look. Whether its fillers to thicken fine hair or a full head for long luscious locks we can customize the package that\'s right for you.\r\nWe use 100% human hair, bonded extensions from Irish suppliers elite hair extensions the quality and feel of the hair is amazing and will last up to 3 months .There are over 30 shades to choose from which can be blended to get your perfect match.\r\n*A consultation is required before booking to assess the best option for you.', '<p></p><p>&lt;p&gt;Clara has being doing hair extensions for over ten years ,and is very passionate about the ability they have to completely transform your look. Whether its fillers to thicken fine hair or a full head for long luscious locks we can customize the package that\'s right for you.&lt;/p&gt;&lt;p&gt;We use 100% human hair, bonded extensions from Irish suppliers elite hair extensions the quality and feel of the hair is amazing and will last up to 3 months .There are over 30 shades to choose from which can be blended to get your perfect match. &lt;/p&gt;&lt;p&gt;&lt;i&gt;*A consultation is required before booking to assess the best option for you.&lt;/i&gt;&lt;/p&gt;</p><p></p>', 'storage/images/services/632cb0f9913411663873273.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:40:36', NULL),
(3, 'BALAYAGE THE APPEAL', 'balayage-the-appeal', 'You can achieve so many different effects from soft, natural highlights to something strong and bold. The fact it’s so low maintenance is such a drawcard for women too. People want to look fashionable and feel good about their appearance but in this day and age we don\'t all have the time to be in the salon every few weeks for a touch up so this technique is a great alternative to highlighting your hair as you never have a solid demarcation line or regrowth. We use our expertise and skills to tailor your balayage look using free hand painting and foil techniques. We recommend a consultation before booking to get an understanding of your goals as some balayage and ombre looks will require more than 1 session.', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334cd844d8711664404868.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:41:08', NULL),
(4, 'BLOWDRYING', 'blowdrying', 'We believe everyone deserves to feel confident & beautiful – and there’s no better feeling than a salon blowdry! Whether you’re seeking sleek & straight, beachy waves or classic curls, there’s a blowdry for everyone!', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334cda4534b41664404900.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:41:40', NULL),
(5, 'COLOURING', 'colouring', 'Changing your overall hair colour tone can be a difficult decision, whether to go a warm brunette colour or a vibrant fashion tone we can advise you on a hair colour that will suit your daily life. Choose from a wide range of hair shades and tones from our alfa parf range of permanent and semi-permanent collections.', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334cdc3143111664404931.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:42:11', NULL),
(6, 'REGROWTH', 'regrowth', 'To keep your hair colour looking in top condition, speak to your stylist about hair regrowth. Everyone\'s hair grows at different rates, but we advise regrowth services every 4-6 weeks.\r\n*patch test is required 48hrs prior to colouring service for all new clients.', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334cde9c97ca1664404969.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:42:49', NULL),
(7, '12 WEEK BLOWDRY', '12-week-blowdry', 'If you are tired of your unruly locks, then Lisse Design by alfaparf is created especially for you!\r\nLisse Design Keratin Therapy is a smoothing treatment for all hair types. This is a revolutionary treatment to create smooth, velvety, glossy and tangle free hair using an innovative Keratin based technique.', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334ce0fb706a1664405007.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:43:27', NULL),
(8, 'SPECIAL OFFERS', 'special-offers', 'Changing your overall hair colour tone can be a difficult decision, whether to go a warm brunette colour or a vibrant fashion tone we can advise you on a hair colour that will suit your daily life. Choose from a wide range of hair shades and tones from our alfa parf range of permanent and semi-permanent collections.', '<p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inv entore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum cia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Neque porro quisquam est, qui dolorem ipsum</p><br></p>', 'storage/images/services/6334ce0fb706a1664405007.png', 'storage/images/services/632cb0b04b3491663873200.jpg', 1, '2022-09-22 14:00:00', '2022-09-28 22:43:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `review`, `rating`, `image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum', 'ceo founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 4, 'storage/images/testimonial/632b72228ed571663791650.png', 1, '2022-09-21 13:02:10', '2022-09-29 01:21:30', NULL),
(2, 'Lorem Ipsum', 'ceo founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 5, 'storage/images/testimonial/632b71ef555541663791599.png', 1, '2022-09-21 13:02:45', '2022-09-29 01:21:37', NULL),
(3, 'Lorem Ipsum', 'Co - Founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 4, 'storage/images/testimonial/632b71f5783461663791605.png', 1, '2022-09-21 13:03:18', '2022-09-29 01:21:38', NULL),
(4, 'Lorem Ipsum', 'Co - Founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 5, 'storage/images/testimonial/632b7228388341663791656.png', 1, '2022-09-21 13:03:36', '2022-09-29 01:21:41', NULL),
(5, 'clay', 'ceo', 'dummy', 3, 'storage/images/testimonial/633c69c07954a1664903616.png', 1, '2022-09-29 21:37:15', '2022-10-04 21:13:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `contact`, `secondary_contact`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `role`, `profile_image`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrators', 'Accounts', 'admin@chb.com', 'mack_tester', '09007860101', NULL, '', '', '', '', 'Germany', 12345, 0, 'storage/images/profile/614e298da232b1632512397.jpg', 0, NULL, '$2y$10$GwSf3yAG3vRwEHrhHj2HieoYU7KELUIodFYvVcMOZEeC9JcMNw67u', NULL, NULL, '2022-01-22 02:45:10'),
(3, 'Mack', 'Tester', 'mackasauser@gmail.com', 'mack tester', '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$fUotVbvTtQKY5wN4h7.ZNukM24S05DqY9liXWn2/0hKQmeXokRJP2', '15ys5EwFzeOZ1VVuxkYhrq1BLxsjSTpQdQCekV7TXo4R7djMh0DCTNDESznV', '2022-09-22 15:38:39', '2022-09-23 01:42:23'),
(4, 'clay', 'jenson', 'clayjenson105@gmail.com', NULL, '11111111111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$lgWaq7sm7kUmB24B8c1D7ucT0X0a9vvmf.76qwL3ctzHr/PP9TEWW', 'fyAplwLR5nAukWBq0OXEg8T6dJy55FP3O87eVemL49bBUCVBE6Z9RhnDqpXQ', '2022-09-29 00:00:25', '2022-10-04 03:43:11'),
(5, '213', '213', '#$%@gmail.com', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$FyvQPh2gMcM2QNGu.q3/2uVNhDWTjLQsFpLkSvpi9R/vZJuXPEU6a', 'Dk2eYJgle4vpPUaQhVa3el8FlXeXp4ONkuLiOnr73F7VsJhMryKyth2c4uyv', '2022-09-29 22:15:57', '2022-09-29 22:15:57'),
(6, '123', '123', 'clayjenson1055@gmail.com', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$3XVDidtIhjkNTHl0DojVo.ntwq0ik4V9xIhamFbbwr.byH5UkwARW', 'BOA6eDDM2QZU50Yjzd0ipzM9r74LD5PbA5CVO3YzNV6uns7ECfbaU3LcOhgA', '2022-09-30 19:49:46', '2022-09-30 19:49:46'),
(7, '123', '123', 'clayjenson1053@gmail.com', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$o9WxPCyDEBnyLeZ049ec4evq4A9pGTYfXM4LcEk8BNOCfCeU7OMii', '0SOQxIxFNIpOrh8rX7KyKDBLVgffooQzU5nipB4ERmvRBTG2ZTSfPDMFNfZB', '2022-09-30 19:58:32', '2022-09-30 19:58:32'),
(8, '12', '21', 'clayjenson1054@gmail.com', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '$2y$10$KRw0hoULcV1vAM5/4CWkl.LIsxk2ZZZu23gWLbR2OGulC9MeJRxDm', 'yDXn6mMXdjTJBnb3GiZO1FzVZuktUnUIqYLIxOGxKjtxddBh8YuP8JLarQG5', '2022-09-30 20:09:22', '2022-09-30 20:09:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
