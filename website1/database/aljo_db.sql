-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 07:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aljo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `text` text DEFAULT NULL,
  `subtext` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `button_name` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `page`, `text`, `subtext`, `description`, `button_name`, `button_link`, `image`, `image_2`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'asad', NULL, NULL, NULL, NULL, 'asd', '', '2022-10-11 19:05:19', '2022-10-11 19:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'storage/images//6345b2c30492f1665512131.png', '2021-10-01 08:12:38', '2022-10-11 13:15:31'),
(2, 'favicon', 'storage/images//6345b2c8961ce1665512136.png', '2021-10-01 08:12:38', '2022-10-11 13:15:36'),
(3, 'contact', '(00) 123 456 7890', '2021-10-01 08:14:41', '2022-10-11 13:38:26'),
(4, 'secondary_email', 'example@gmail.com', '2021-10-01 08:14:41', '2022-10-11 13:44:32'),
(5, 'primary_email', 'example@gmail.com', '2021-10-01 08:15:20', '2022-10-11 13:38:26'),
(6, 'website_name', 'ALJO Fruits And Veg LTD', '2022-02-18 18:12:09', '2022-10-11 13:23:53'),
(7, 'tag_line', 'Affordable intelligent Solutions for Today\'s World', '2021-10-01 08:17:05', '2021-10-01 08:17:05'),
(8, 'footer_logo', 'storage/images//621024bc84c411645225148.png', '2021-10-01 08:17:05', '2022-02-18 12:59:08'),
(9, 'footer_text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2021-10-01 08:18:00', '2022-03-15 14:14:19'),
(10, 'address', 'Lorem ipsum dolor sit ame ipsum', '2021-10-01 08:18:00', '2022-10-11 13:40:04'),
(11, 'copy_right', '©copyright. 2022 All Right Reserved.', '2022-01-13 19:32:21', '2022-02-22 08:06:38'),
(12, 'facebook', 'https://www.facebook.com/', '2022-01-20 13:32:40', '2022-09-22 12:20:44'),
(13, 'twitter', 'https://twitter.com/', '2022-01-20 13:32:40', '2022-10-11 13:44:20'),
(14, 'instagram', 'https://www.instagram.com/', '2022-01-20 13:32:40', '2022-09-22 12:20:33'),
(15, 'linked_in', 'https://www.linkedin.com/', '2022-03-21 11:46:49', '2022-10-11 13:44:20'),
(16, 'open_hours', 'monday to friday 8:30 am - 5:30pm (GMT)', '2022-09-22 17:19:08', '2022-09-22 12:19:27'),
(17, 'live_location', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d172138.65426867263!2d-122.48214825745869!3d47.613174640877745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490102c93e83355%3A0x102565466944d59a!2sSeattle%2C%20WA%2C%20USA!5e0!3m2!1sen!2s!4v1646753623814!5m2!1sen!2s\"></iframe>', '2022-09-22 17:25:38', '2022-09-22 12:25:51'),
(18, 'fax', '(00) 123 456 7890 7891', '2022-10-11 18:43:38', '2022-10-11 13:44:20');

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
  `description` longtext DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `btn_color` varchar(10) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `primary_image` text DEFAULT NULL,
  `secondary_image` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page`, `section`, `title`, `subtitle`, `description`, `short_description`, `button_text`, `btn_color`, `link`, `primary_image`, `secondary_image`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'About Us', 'Clarabelle Hair Boutique', NULL, '<p class=\"pera\">&lt;p&gt;Clarabelle is a boutique style salon ,located in the heart of naas town co kildare.I opened the doors in 2016 and have loved every minute of seeing it grow to where we are today. We pride ourselves in giving our clients a unique personal service in a friendly relaxed environment.We have over 20 years experience and are&nbsp; constantly growing our skills to keep up with all the latest hair trends and products.We have trained and continue to train with some of the best brands in the industry including L\'Oreal Professional hair colour and homecare, Olaplex ,&nbsp; ghd styling tools and elite hair extensions. Clarabelle hair boutique offer a wide range of services and specialise in hair extensions,&nbsp; balayage, and colour techniques. &lt;/p&gt;</p>', NULL, 'Read More', '#CC9F8E', 'http://localhost/mack/clarabelle-hair-boutique/public/about-us', 'storage/images/content/632c954f42de21663866191.png', NULL, NULL, '2021-10-01 13:26:31', '2022-09-22 12:03:13'),
(2, 'Home Page', 'Services', 'ARE SERVICES WHAT WE PROVIDE', 'nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. nisi ut aliqui p ex ea commodo consequat. ex ea commodo consequat. nisi uex ea commodo consequat. nisi u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:26:31', '2022-09-22 12:04:21'),
(3, 'Home Page', 'Shop', 'Our Products', NULL, NULL, NULL, NULL, NULL, NULL, 'storage/images/content/632ca299471381663869593.png', NULL, NULL, '2021-10-01 13:27:32', '2022-09-22 12:59:53'),
(4, 'Home Page', 'Why Choose Us', 'WHY CHOOSE US?', NULL, '<p>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. nisi ut aliquip ex ea c</p>\n<ul class=\"list-chose\">\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Hair Extensions</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Best Services</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> Buy Products</li>\n    <li><img src=\"{{ asset(\'web-assets/images/check.png\') }}\" alt=\"\"> lorem ipum</li>\n</ul>', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut nisi ut aliquip ex ea commodo consequat.', 'Read More', '#CC9F8E', '#', 'storage/images/content/632c95e3256961663866339.png', NULL, NULL, '2021-10-01 13:27:32', '2022-09-22 18:14:19'),
(5, 'Home Page', 'Testimonials', 'TESTIMONIAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 17:08:08'),
(6, 'Home Page', 'Gallery', 'OUR GALLERY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 17:08:08'),
(7, 'About Us Page', 'Page Content', 'Clarabelle Hair Boutique', NULL, '&lt;p&gt;Clarabelle is a boutique style salon ,located in the heart of naas town co kildare. I opened the doors in 2016 and have loved every minute of seeing it grow to where we are today. We pride ourselves in giving our clients a unique personal service in a friendly relaxed environment. We have over 20 years experience and are constantly growing our skills to keep up with all the latest hair trends and products.We have trained and continue to train with some of the best brands in the industry including L\'Oreal Professional hair colour and homecare, Olaplex , ghd styling tools and elite hair extensions. Clarabelle hair boutique offer a wide range of services and specialise in hair extensions, balayage, and colour techniques.&lt;/p&gt;', NULL, NULL, NULL, NULL, 'storage/images/content/632c97a169f031663866785.png', NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 12:13:17'),
(8, 'Contact Us', 'Each Page', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-01 13:32:29', '2022-09-22 12:13:17');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `review`, `rating`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum', 'ceo founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 4, 'storage/images/testimonial/632b72228ed571663791650.png', '2022-09-21 13:02:10', '2022-09-21 15:20:50', NULL),
(2, 'Lorem Ipsum', 'ceo founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 5, 'storage/images/testimonial/632b71ef555541663791599.png', '2022-09-21 13:02:45', '2022-09-21 15:19:59', NULL),
(3, 'Lorem Ipsum', 'Co - Founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 4, 'storage/images/testimonial/632b71f5783461663791605.png', '2022-09-21 13:03:18', '2022-09-21 15:20:05', NULL),
(4, 'Lorem Ipsum', 'Co - Founder', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standm has been the industry\'s stand', 5, 'storage/images/testimonial/632b7228388341663791656.png', '2022-09-21 13:03:36', '2022-09-21 15:20:56', NULL);

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
  `role` int(1) NOT NULL DEFAULT 0,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
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
(1, 'Administrators', 'Accounts', 'admin@aljo.com', 'mack_tester', '09007860101', NULL, '', '', '', '', 'Germany', 12345, 0, 'storage/images/profile/614e298da232b1632512397.jpg', 0, NULL, '$2y$10$GwSf3yAG3vRwEHrhHj2HieoYU7KELUIodFYvVcMOZEeC9JcMNw67u', NULL, NULL, '2022-01-21 21:45:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
