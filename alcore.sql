-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 08:44 PM
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
(1, 7, 'uzair mirza', 'dso', 'uzairmirza2121@gmail.com', '03086452242', '1717153052.png', '\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti velit atque iusto doloremque aspernatur quia ab distinctio accusamus, pariatur modi ea similique recusandae? Ratione rerum minima sunt saepe, non molestias.', 'Pak', '\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti velit atque iusto doloremque aspernatur quia ab distinctio accusamus, pariatur modi ea similique recusandae? Ratione rerum minima sunt saepe, non molestias.', '1717409983_company.jpg', '2024-05-31 05:57:32', '2024-06-03 05:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `delegate_answers`
--

CREATE TABLE `delegate_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delegate_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 'asdasdsadasd', 'completed', '2024-05-05', '2024-06-01', '2024-06-07', '2024-05-31 04:58:06', '2024-06-02 04:33:35');

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
(9, '2024_05_31_101458_create_delegates_table', 3),
(10, '2024_06_06_093315_create_priorities_table', 4),
(11, '2024_06_08_203448_create_questions_table', 5),
(12, '2024_06_22_104745_create_delegate_answers_table', 6);

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
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `delegates_id` bigint(20) UNSIGNED NOT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT ' pending',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `event_id`, `sponsor_id`, `delegates_id`, `priority`, `status`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 7, 4, 1, 5, ' pending', NULL, NULL, '2024-06-06 04:44:13', '2024-06-06 05:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `qus` varchar(255) NOT NULL,
  `ans` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ans`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `event_id`, `qus`, `ans`, `created_at`, `updated_at`) VALUES
(8, 6, 'fvrt color', '[{\"value\":\"asdsad\"},{\"value\":\"asdlkh\"},{\"value\":\"askljd\"}]', '2024-06-23 13:09:12', '2024-06-23 13:09:12');

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
('FbCLWyEnInUJb9qipy5ouC0laFz1kcYblwWFgkHh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWliSGVyZFNyWGlwSkx5RWhrTmVwTHFTSVFuZWZFZWVubVo5SDFlVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nwb25zb3IvbWVldGluZyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1719220191),
('HtMvFO9Cgh96s1qlLclhzaJJUr3SAzYL7eSe3oUZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicG9ZTXFITVRHOWRTOW1nVEJSWXVEMnZvVk5PcVJuUFVWSjBBTkdPOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2RlbGVnYXRlcy84L2VkaXQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Nwb25zb3JzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRNZDJRNjY5Q0hma3ZFeFAyTVV1ekQuY3Aud1ZGZjdWdmltR1dvbkc2UVYuTm5WZ0VEL2RPcSI7fQ==', 1719172667),
('JuZLOILkIi6j8GDM1zFE5bXrw7h1jgzslp7MjO3n', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiT2dtQ2dlZ3gwVHMwNFNRU2RudmQzcENCWVd6QjQ4aVRtbHY5QWRrbSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Nwb25zb3JzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zcG9uc29ycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkTWQyUTY2OUNIZmt2RXhQMk1VdXpELmNwLndWRmY3VnZpbUdXb25HNlFWLk5uVmdFRC9kT3EiO30=', 1719220512),
('tESMSyWfLHt85aaITQ1XDMnwGwzXimYvWuPu2vgF', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS1hiOU0xeTdsTm1jZDY3VTVnOThWbVR5Yk5oa0c2TXZXNUhKc1ZZdiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nwb25zb3IvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zcG9uc29yL21lZXRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU0OiJsb2dpbl9zcG9uc29yXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1719168355);

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
(4, 'qudsiaasdasd111', 'uzairmirza2121@32gmail.11', '$2y$10$WKFGXwSyuaD6/nUdD46EX.J2Ph2QCLUDVnK6fWP3cxKuTnszQbAdK', 'active', 7, 'asdasddasd111', 'images/1717507424_Whatsapp icon.jpg', 'SEO', 'Sami Pharmaceutical Company Ltd.', 'asdasd11', 'company_images/1717507455_Black and Red Professional Business Youtube Thumbnail.png', '+92308645224211', '2024-05-23 10:34:28', '2024-06-04 08:24:15'),
(7, 'asdasd', 'dirudsypusjta9432.64753@gmail.com', '$2y$10$l.KSeO5Hn8uMsfMP3FCVJOKjHZlYyJ0VCeQ7Dp3GA.O8dsShF.Svu', 'active', 6, 'sdafafsdf', 'images/1719172319_menu.png', NULL, NULL, 'sfdf', 'company_images/1719172319_menu.png', '+923086452242', '2024-06-23 14:51:59', '2024-06-23 14:51:59'),
(12, 'wqwqw', 'uzairmirza2121@gmaqil.com', '$2y$10$Pagsjw28fF7r7nL1kMkmyennarAUNrYcFmBj06xPeKah1INJdiveG', 'active', 7, 'asdasd', 'images/1719220509_Black and Red Professional Business Youtube Thumbnail.png', NULL, NULL, 'asdsad', 'company_images/1719220509_TikTok icon.jpg', '+923086452242', '2024-06-24 04:13:25', '2024-06-24 04:15:09');

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
(1, 'ADMIN', 'admin@admin.com', NULL, '$2y$10$Md2Q669CHfkvExP2MUuzD.cp.wVFf7VvimGWonG6QV.NnVgED/dOq', NULL, NULL, NULL, NULL, NULL, '1717416890_pexels-julia-m-cameron-4143798.jpg', 'superadmin', 1, '2024-05-19 11:47:35', '2024-06-22 05:39:54');

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
-- Indexes for table `delegate_answers`
--
ALTER TABLE `delegate_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delegate_answers_delegate_id_foreign` (`delegate_id`),
  ADD KEY `delegate_answers_question_id_foreign` (`question_id`);

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
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priorities_event_id_foreign` (`event_id`),
  ADD KEY `priorities_sponsor_id_foreign` (`sponsor_id`),
  ADD KEY `priorities_delegates_id_foreign` (`delegates_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_event_id_foreign` (`event_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delegate_answers`
--
ALTER TABLE `delegate_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `delegate_answers`
--
ALTER TABLE `delegate_answers`
  ADD CONSTRAINT `delegate_answers_delegate_id_foreign` FOREIGN KEY (`delegate_id`) REFERENCES `delegates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delegate_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `priorities`
--
ALTER TABLE `priorities`
  ADD CONSTRAINT `priorities_delegates_id_foreign` FOREIGN KEY (`delegates_id`) REFERENCES `delegates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `priorities_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `priorities_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
