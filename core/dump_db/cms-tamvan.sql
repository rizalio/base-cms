-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2017 at 01:26 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.23-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmmmm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `name` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `details` text NOT NULL,
  `type` varchar(50) DEFAULT 'contact',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dir` varchar(5) NOT NULL,
  `namespace` varchar(5) NOT NULL,
  `default_lang` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `name`, `dir`, `namespace`, `default_lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bahasa Indonesia', 'id', 'id', 1, '2017-08-10 00:20:43', '2017-08-10 00:20:43', NULL),
(2, 'English', 'en', 'en', 0, '2017-08-10 00:20:51', '2017-08-10 00:20:51', NULL),
(3, 'Malaysia', 'my', 'my', 0, '2017-08-10 03:08:34', '2017-08-10 23:17:15', '2017-08-10 23:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thumbnail` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `gen_id` varchar(20) NOT NULL,
  `lang` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `namespace` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section_details`
--

CREATE TABLE `section_details` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `lang` int(2) NOT NULL,
  `gen_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `value` text,
  `details` text NOT NULL,
  `setting_group` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `display_name`, `value`, `details`, `setting_group`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'site_name', 'Site Name', 'Your Site Name', '{"type":"text"}', 'general', '2017-03-10 00:33:38', '2017-09-04 20:02:17', NULL),
(2, 'site_logo', 'Logo', '/path/to/your/logo.png', '{"type":"files_images"}', 'general', '2017-03-10 01:07:46', '2017-09-04 20:02:18', NULL),
(3, 'email', 'Email', 'admin@xaerus.com', '{"type":"text"}', 'contact', '2017-03-10 01:11:26', '2017-09-04 20:02:18', NULL),
(4, 'address', 'Address', 'Your Site Address', '{"type":"textarea"}', 'contact', '2017-03-10 03:16:36', '2017-09-04 20:02:18', NULL),
(5, 'phone', 'Phone', 'Your site phone', '{"type":"text"}', 'contact', '2017-03-10 03:17:04', '2017-09-04 20:02:18', NULL),
(6, 'phone_2', 'Phone 2', NULL, '{"type":"text"}', 'contact', '2017-03-13 00:55:10', '2017-09-04 20:02:18', NULL),
(7, 'post_per_page', 'Post Per Page', '8', '{"type":"text"}', 'reading', '2017-08-11 03:12:25', '2017-09-04 20:02:18', NULL),
(8, 'site_logo_mobile', 'Site Logo Mobile', '/path/to/mobile/logo.png', '{"type":"files_images"}', 'general', '2017-08-11 03:55:00', '2017-09-04 20:02:18', NULL),
(9, 'email_alias_from', 'Email Alias From', 'your@email.com', '{"type":"text"}', 'mailable', '2017-08-16 03:57:04', '2017-09-04 20:02:18', NULL),
(10, 'email_alias_name', 'Email Alias Name', 'Your Email Name', '{"type":"text"}', 'mailable', '2017-08-16 03:57:22', '2017-09-04 20:02:18', NULL),
(11, 'email_to', 'Email To', 'your@email-again.com', '{"type":"text"}', 'mailable', '2017-08-16 03:57:37', '2017-09-04 20:02:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$HKXEIvihSfHyHTYjUaHUou0UjBiUPpF2KIcqoB.1IM46ypiWN.4W6', '2NJrv7o8qEVcSXE5kqbCQOKTYXen8L6iCzgYntVesZEEdTvJCSn4G6kOd6Jw', '2017-03-01 20:55:49', '2017-03-09 01:41:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_details`
--
ALTER TABLE `section_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `section_details`
--
ALTER TABLE `section_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
