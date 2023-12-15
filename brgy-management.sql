-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 11:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brgy-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'General Cleaning', 'General Cleaning 2023', 'posts/YXZe2gRt68uDQCBGrV3wiQUe6zjSLjiaCQLDCX26.jpg', '2023-12-15 01:07:06', '2023-12-15 02:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(10) UNSIGNED NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `doc_type` enum('bc','cor','cli') COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('approved','pending','declined') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery` enum('email','pick-up') COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_09_24_061150_create_users_table', 1),
(3, '2023_09_24_061204_create_residents_table', 1),
(4, '2023_09_24_061221_create_documents_table', 1),
(5, '2023_09_24_061237_create_announcements_table', 1),
(6, '2023_09_24_061251_create_officials_table', 1),
(7, '2023_10_23_021209_create_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `official_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` enum('captain','secretary','treasurer','councilor','sk') COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('current','archived') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`official_id`, `name`, `position`, `year`, `img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Juan Dela Cruz', 'captain', '', 'officials/aV2vELA6eroeaZkSWVsIalICUwOruiTIZMlxxi4L.jpg', 'current', '2023-12-14 23:03:11', '2023-12-15 01:36:48'),
(2, 'Juan Dela Cruz', 'secretary', '', 'officials/IaEcK24zhR1ug2aonyLvL3cfMss6nyD4qt8Z3PEk.jpg', 'current', '2023-12-14 23:03:11', '2023-12-15 01:37:04'),
(3, 'Juan Dela Cruz', 'treasurer', '', 'officials/ps0DkDWPl9GVEUi2IywHnf93SCZmNJ9E18Xdiffz.jpg', 'current', '2023-12-14 23:03:11', '2023-12-15 01:37:14'),
(4, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(5, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(6, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(7, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(8, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(9, 'Juan Dela Cruz', 'councilor', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11'),
(10, 'Juan Dela Cruz', 'councilor', '', 'officials/j5ticuTuiuRcVpJiFGYccF3SaDilPJo5nUYCOoiI.jpg', 'current', '2023-12-14 23:03:11', '2023-12-15 01:37:28'),
(11, 'Juan Dela Cruz', 'sk', '', '', 'current', '2023-12-14 23:03:11', '2023-12-14 23:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `reset_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female','lgbt') COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` enum('single','married','widowed','separated') COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `four_ps` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` enum('yes','pending','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','resident') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$i8ass8B8ybNBot..JYMPQuR/fgqVKMw6s9qqA99Os0IiYQaN9rfwC', 'active', 'admin', '2023-12-14 23:03:11', '2023-12-14 23:03:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`),
  ADD UNIQUE KEY `announcements_announcement_id_unique` (`announcement_id`),
  ADD KEY `announcements_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `announcements_title_index` (`title`),
  ADD KEY `announcements_description_index` (`description`(768)),
  ADD KEY `announcements_image_index` (`image`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD UNIQUE KEY `documents_document_id_unique` (`document_id`),
  ADD KEY `documents_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `documents_resident_id_index` (`resident_id`),
  ADD KEY `documents_doc_type_index` (`doc_type`),
  ADD KEY `documents_purpose_index` (`purpose`),
  ADD KEY `documents_status_index` (`status`),
  ADD KEY `documents_delivery_index` (`delivery`),
  ADD KEY `documents_schedule_index` (`schedule`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`official_id`),
  ADD UNIQUE KEY `officials_official_id_unique` (`official_id`),
  ADD KEY `officials_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `officials_name_index` (`name`),
  ADD KEY `officials_position_index` (`position`),
  ADD KEY `officials_year_index` (`year`),
  ADD KEY `officials_img_index` (`img`),
  ADD KEY `officials_status_index` (`status`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`reset_id`),
  ADD UNIQUE KEY `resets_reset_id_unique` (`reset_id`),
  ADD KEY `resets_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `resets_email_index` (`email`),
  ADD KEY `resets_code_index` (`code`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `residents_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `residents_user_id_index` (`user_id`),
  ADD KEY `residents_firstname_index` (`firstname`),
  ADD KEY `residents_middlename_index` (`middlename`),
  ADD KEY `residents_lastname_index` (`lastname`),
  ADD KEY `residents_address_index` (`address`),
  ADD KEY `residents_birthdate_index` (`birthdate`),
  ADD KEY `residents_nationality_index` (`nationality`),
  ADD KEY `residents_gender_index` (`gender`),
  ADD KEY `residents_civil_status_index` (`civil_status`),
  ADD KEY `residents_occupation_index` (`occupation`),
  ADD KEY `residents_phone_index` (`phone`),
  ADD KEY `residents_email_index` (`email`),
  ADD KEY `residents_valid_id_index` (`valid_id`),
  ADD KEY `residents_four_ps_index` (`four_ps`),
  ADD KEY `residents_verified_index` (`verified`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `users_username_index` (`username`),
  ADD KEY `users_password_index` (`password`),
  ADD KEY `users_status_index` (`status`),
  ADD KEY `users_type_index` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resets`
--
ALTER TABLE `resets`
  MODIFY `reset_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`);

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
