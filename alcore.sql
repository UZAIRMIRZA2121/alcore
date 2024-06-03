-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alcore`
--

-- --------------------------------------------------------

--
-- Table structure for table `delegates`
--

CREATE TABLE `delegates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `personal_picture` varchar(255) DEFAULT NULL,
  `personal_profile` text DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_profile` text DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delegates`
--

INSERT INTO `delegates` (`id`, `event_id`, `name`, `job_title`, `email`, `contact_number`, `personal_picture`, `personal_profile`, `company_name`, `company_profile`, `company_logo`, `created_at`, `updated_at`) VALUES
(1, 6, 'uzair mirza', 'dso', 'uzairmirza2121@gmail.com', '03086452242', '1717153052.png', 'qwerqweras', 'rqwer', 'sdfafasdfg', '1717409983_company.jpg', '2024-05-31 05:57:32', '2024-06-03 05:19:43'),
(2, 6, 'uzair mirza', 'SHO', 'uzairmirza2121@gmail.comweqe', '03086452242', '1717183821_personal.jpg', 'asdasd', 'rqwer', 'sdfsdfafg', '1717162084_company.jpg', '2024-05-31 08:28:04', '2024-05-31 14:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('pending','ongoing','completed') NOT NULL DEFAULT 'ongoing',
  `start` date NOT NULL,
  `end` date NOT NULL,
  `lock_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `status`, `start`, `end`, `lock_date`, `created_at`, `updated_at`) VALUES
(6, 'admin event', 'completed', '2024-05-12', '2024-05-23', '2024-06-02', '2024-05-23 13:35:44', '2024-05-23 13:59:45'),
(7, 'asdasdsadasd', 'completed', '2024-05-05', '2024-06-01', '2024-05-30', '2024-05-31 04:58:06', '2024-06-02 04:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_29_081756_create_sessions_table', 1),
(7, '2024_05_19_153937_create_events_table', 1),
(8, '2024_05_19_180145_create_sponsors_table', 2),
(9, '2024_05_31_101458_create_delegates_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ur4YXXyDeWOyB6GppSqrTIle1zcX5nwQAvb0yz9f', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlY3b3BlejBoM3o3TWxKZzR2cDQ4cUszZnBxajZXeHRoZHpweTFRUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zcG9uc29ycy8yIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRNZDJRNjY5Q0hma3ZFeFAyTVV1ekQuY3Aud1ZGZjdWdmltR1dvbkc2UVYuTm5WZ0VEL2RPcSI7fQ==', 1717413605);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_details` text DEFAULT NULL,
  `company_image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `username`, `email`, `password`, `status`, `event_id`, `details`, `image`, `job`, `company_name`, `company_details`, `company_image`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'admin@admin.com11', 'uzairmirza2121@gmail.com11', '$2y$10$rqIGnEYQUw72/Wqb0wC4LeKGHJG6SmeTrREcnwgZaKcZDc9162XTe', 'inactive', 7, 'aqzswdasd', 'images/1716489008_mvy63oihnldezoofosik.jpg', 'CEO', 'Halton Pharma company Ltd.', 'sdafasf', 'company_images/1716477875_WIN_20240226_23_28_21_Pro.jpg', '+923086452242', '2024-05-23 10:24:35', '2024-06-03 05:19:22'),
(3, 'Uzair', 'uzairmirza2121@gmail.com2121', '$2y$10$0DAMfIA3JesN9ow4ZCNlqenmkBHjUiq0gCKQ9tJIMfCs4krkLhttK', 'active', 6, 'fasfsdaf', 'images/1717410525_Screenshot_2.png', 'SHO', 'Searle Company Pakistan.', 'sdfsadf', 'company_images/1716478276_WIN_20240226_23_28_21_Pro.jpg', '03086452242', '2024-05-23 10:31:16', '2024-06-03 05:28:45'),
(4, 'qudsia', 'uzairmirza2121@32gmail.com', '$2y$10$bXAjJZ0zSCbER57x7JsWAOtT6.sp7PImH4WvozzYdiQVIGiiEXXYe', 'active', 7, 'asdasd', 'images/1716478468_WIN_20240226_23_28_21_Pro.jpg', 'SEO', 'Sami Pharmaceutical Company Ltd.', 'asdasd', 'company_images/1716478468_WIN_20240226_23_28_21_Pro.jpg', '+923086452242', '2024-05-23 10:34:28', '2024-05-23 10:34:28'),
(5, 'saim@saim.com', 'saim@saim.com', '$2y$10$Q8HnIqezcbGJsyUZxObAteLacy5niHR9.FohXsuB1.AI..Vjel7lC', 'active', 6, 'sadsfhadfghfdn', 'images/1716478540_WIN_20240226_23_28_21_Pro.jpg', 'Developer', 'Getz Pharmaceutical Company Ltd.', 'dfghfsghs', 'company_images/1716478540_WIN_20240226_23_28_21_Pro.jpg', '+923086452242', '2024-05-23 10:35:40', '2024-05-23 10:35:40'),
(6, 'saim@saim.com2121', 'uzairm12irza2121@gmail.com212', '$2y$10$39D47I7JQtZgVkfajAfjR.GMXV88Fwi23hf/J7DnKZcO44F25CDwe', 'active', 6, 'sdfasf', 'images/1716478668_WIN_20240226_23_28_21_Pro.jpg', 'Laravel', 'Abbott Laboratories Pakistan.', 'dfsgfg', 'company_images/1716478668_WIN_20240226_23_28_21_Pro.jpg', '+923086452242', '2024-05-23 10:37:48', '2024-05-23 10:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `is_online` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `is_online`, `created_at`, `updated_at`) VALUES
(1, 'uzair mirzad', 'admin@admin.com', NULL, '$2y$10$Md2Q669CHfkvExP2MUuzD.cp.wVFf7VvimGWonG6QV.NnVgED/dOq', NULL, NULL, NULL, NULL, NULL, '1717408064_Facebook icon.jpg', 'superadmin', 1, '2024-05-19 11:47:35', '2024-06-03 04:47:44'),
(2, 'uzair mirza', 'admin@admin.com1', NULL, '$2y$10$s3Bbg5dYFU7dW5FTR.9ODekusjnS63q24ML5f7AskLTBeUqPNnntC', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 1, '2024-05-19 12:17:55', '2024-05-19 12:17:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delegates`
--
ALTER TABLE `delegates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delegates_email_unique` (`email`),
  ADD KEY `delegates_event_id_foreign` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsors_username_unique` (`username`),
  ADD UNIQUE KEY `sponsors_email_unique` (`email`),
  ADD KEY `sponsors_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delegates`
--
ALTER TABLE `delegates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delegates`
--
ALTER TABLE `delegates`
  ADD CONSTRAINT `delegates_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
