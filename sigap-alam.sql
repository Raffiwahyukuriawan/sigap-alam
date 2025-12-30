-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2025 at 08:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigap-alam`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `disaster_category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','pending','published','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `views` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `disaster_category_id`, `title`, `slug`, `content`, `cover_image`, `status`, `published_at`, `views`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Mengenal Banjir dan Cara Menghadapinya', 'mengenal-banjir-dan-cara-menghadapinya', '<p><strong>Banjir</strong> merupakan bencana alam yang sering terjadi di Indonesia, terutama saat musim hujan dengan intensitas tinggi.</p><ul><li>Penyebab utama banjir antara lain:</li><li>Curah hujan tinggi</li><li>Sistem drainase yang buruk</li><li>Penebangan hutan secara liar</li></ul><p><strong>Langkah pencegahan banjir:</strong></p><ul><li>Tidak membuang sampah sembarangan</li><li>Membersihkan saluran air secara rutin</li><li>Menanam pohon di sekitar lingkungan</li></ul>', 'articles/2B7SarxEesttZy04xL1Pl4ewwI9A5JoKmujb2k6J.jpg', 'published', '2025-12-30 00:57:36', 6, '2025-12-25 00:37:36', '2025-12-30 01:07:13'),
(3, 3, 2, 'Gempa Bumi: Apa yang Harus Dilakukan?', 'gempa-bumi-apa-yang-harus-dilakukan-1767077291', '<p><strong>Gempa bumi</strong> terjadi akibat pergerakan lempeng bumi yang tidak dapat diprediksi secara pasti.</p><p>📌 <strong>Saat terjadi gempa:</strong></p><ul><li>Berlindung di bawah meja</li><li>Jauhi kaca dan benda berat</li><li>Tetap tenang dan tidak panik</li></ul><p>📌 <strong>Setelah gempa:</strong></p><ul><li>Keluar menuju area terbuka</li><li>Periksa kondisi sekitar</li><li>Ikuti informasi resmi dari pihak berwenang</li></ul>', 'articles/bCIutD7frn0o2tQftneHfnECOS4QBqX3sqteSs3Z.jpg', 'published', '2025-12-30 00:57:12', 0, '2025-12-29 23:48:11', '2025-12-30 00:57:12'),
(4, 4, 5, 'Ancaman di Daerah Perbukitan', 'ancaman-di-daerah-perbukitan-1767077616', '<p>Tanah longsor adalah pergerakan massa tanah atau batuan dari tempat tinggi ke tempat yang lebih rendah.</p><p><strong>Dampak yang ditimbulkan:</strong></p><ul><li>Kerusakan rumah dan fasilitas umum</li><li>Akses jalan terputus</li><li>Korban jiwa</li></ul><p>⚠️ <strong>Waspadai tanda-tanda longsor seperti:</strong></p><ul><li>Retakan tanah</li><li>Pohon miring</li><li>Mata air baru muncul</li></ul>', 'articles/K4LxhVeyJyctE9l1ZHyUvURWY2z11OL1wWDDvcpw.jpg', 'published', '2025-12-30 00:35:45', 0, '2025-12-29 23:53:36', '2025-12-30 00:35:45'),
(6, 3, 4, 'Kebakaran Hutan dan Dampaknya bagi Lingkungan', 'kebakaran-hutan-dan-dampaknya-bagi-lingkungan', '<p>Kebakaran hutan tidak hanya merusak ekosistem, tetapi juga berdampak langsung pada kesehatan manusia.</p><p><strong>Akibat kebakaran hutan:</strong></p><ul><li>Kabut asap</li><li>Gangguan pernapasan</li><li>Hilangnya habitat satwa</li></ul><p><strong>Upaya pencegahan:</strong></p><ul><li>Tidak membuka lahan dengan cara dibakar</li><li>Melaporkan titik api sejak dini</li><li>Edukasi masyarakat sekitar hutan</li></ul>', 'articles/PMh7mdv9JJBPwSS3AfGw36EPJcrupBB7XAbEQPqc.jpg', 'published', '2025-12-30 00:34:57', 2, '2025-12-30 00:05:26', '2025-12-30 00:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `article_approvals`
--

CREATE TABLE `article_approvals` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `action` enum('approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_comments`
--

CREATE TABLE `article_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_comments`
--

INSERT INTO `article_comments` (`id`, `article_id`, `user_id`, `name`, `email`, `comment`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, 'Xpander', 'xpander@gmail.com', 'menarik', '2025-12-27 23:39:31', '2025-12-27 23:39:31'),
(5, 1, NULL, 'xenia', 'a@gmail.com', 'mantap', '2025-12-28 21:48:08', '2025-12-28 21:48:08'),
(6, 4, NULL, 'admin', 'mtawang07@gmail.com', 'oke', '2025-12-30 00:34:09', '2025-12-30 00:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disaster_categories`
--

CREATE TABLE `disaster_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disaster_categories`
--

INSERT INTO `disaster_categories` (`id`, `name`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Banjir', 'bi-droplet-fill', 'Banjir adalah peristiwa tergenangnya daratan oleh air dalam jumlah besar. Pelajari cara pencegahan dan mitigasi banjir.', '2025-12-24 07:15:15', '2025-12-25 21:35:47'),
(2, 'Gempa Bumi', 'bi-exclamation-triangle-fill', 'Gempa bumi adalah getaran atau guncangan yang terjadi di permukaan bumi akibat pelepasan energi dari dalam secara tiba-tiba.', '2025-12-25 21:27:33', '2025-12-25 21:36:08'),
(3, 'Tsunami', 'bi-water', 'Tsunami adalah gelombang laut yang sangat besar yang disebabkan oleh gangguan di dasar laut seperti gempa atau letusan gunung api.', '2025-12-25 21:28:17', '2025-12-25 21:36:23'),
(4, 'Kebakaran Hutan', 'bi-fire', 'Kebakaran hutan dan lahan adalah bencana yang merusak ekosistem dan menghasilkan polusi udara berbahaya.', '2025-12-25 21:29:08', '2025-12-25 21:36:37'),
(5, 'Tanah Longsor', 'bi-triangle-fill', 'Tanah longsor adalah perpindahan material pembentuk lereng berupa batuan, bahan rombakan, tanah, atau material campuran.', '2025-12-25 21:30:10', '2025-12-25 21:37:13'),
(6, 'Badai', 'bi-wind', 'Badai adalah gangguan atmosfer yang ditandai dengan angin kencang, hujan deras, petir, dan kondisi cuaca ekstrem lainnya.', '2025-12-25 21:30:35', '2025-12-25 21:37:28'),
(7, 'Kekeringan', 'bi-cloud-drizzle', 'Kekeringan adalah kondisi kekurangan pasokan air dalam waktu yang cukup lama akibat curah hujan di bawah normal.', '2025-12-25 23:06:19', '2025-12-25 23:06:19'),
(8, 'Gunung Meletus', 'bi-lightning-fill', 'Letusan gunung berapi adalah peristiwa keluarnya magma, abu vulkanik, dan gas dari dalam bumi melalui gunung berapi.', '2025-12-25 23:07:08', '2025-12-25 23:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_23_120405_create_disaster_categories_table', 1),
(5, '2025_12_23_120422_create_articles_table', 1),
(6, '2025_12_23_120512_create_article_approvals_table', 1),
(7, '2025_12_23_120549_create_article_comments_table', 1),
(8, '2025_12_23_120624_create_prevention_tips_table', 1),
(9, '2025_12_28_042655_article_comment', 2),
(10, '2025_12_29_032146_add_views_to_articles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prevention_tips`
--

CREATE TABLE `prevention_tips` (
  `id` bigint UNSIGNED NOT NULL,
  `disaster_category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prevention_tips`
--

INSERT INTO `prevention_tips` (`id`, `disaster_category_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(2, 1, 'Membersihkan saluran air', 'Tidak membuang sampah sembarangan, Membersihkan saluran air secara rutin, Menanam pohon di sekitar lingkungan', '2025-12-28 19:25:20', '2025-12-30 01:05:10'),
(3, 2, 'Saat terjadi gempa', 'Berlindung di bawah meja, kaca dan benda berat, Tetap tenang dan tidak panik', '2025-12-28 19:25:52', '2025-12-30 01:06:04'),
(4, 5, 'Waspadai tanda-tanda longsor seperti:', 'Retakan tanah, Pohon miring, Mata air baru muncul', '2025-12-30 01:04:27', '2025-12-30 01:04:27'),
(5, 4, 'Upaya pencegahan', 'Tidak membuka lahan dengan cara dibakar, Melaporkan titik api sejak dini,  masyarakat sekitar hutan', '2025-12-30 01:06:50', '2025-12-30 01:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LOQp71OEH19XflDIDzX12zTE6f2S1Fubkw86hTII', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVnl2MVF0YkwwbGU1bDY5eVVyWDREU25BTWxVS2psaTdzbFZIN2V0ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9zaWdhcC1hbGFtLnRlc3QvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1767082192);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','contributor','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Xpander', 'mtawang07@gmail.com', '$2y$12$JadQRKzgA3C6OjnlZx3DQOQQ9J6SelhXmqMAim3vwtC4wIDKGRW4K', 'admin', '2025-12-24 06:58:22', '2025-12-29 08:43:35'),
(2, 'Raffi', 'xxpandercross@gmail.com', '$2y$12$EdATA53WuSR/ylAdY1mgx.nstU4STeLIrD8Y5dPU7M/d3jvI7s1ny', 'contributor', '2025-12-24 06:59:26', '2025-12-24 06:59:26'),
(3, 'Dr. Ahmad Hidayat', 'ahmadh@gmail.com', '$2y$12$MGCUa7N.LcCBxRQkfzd5TOIOWw.mR5YR/gfOAEwacjxX/VB5bvEKW', 'contributor', '2025-12-24 08:24:30', '2025-12-30 00:23:16'),
(4, 'Prof. Budi Santoso', 'budiii@gmail.com', '$2y$12$coE2WJSWLfK4lWc5Py0vUefAj6WV8B9XWoplvZvmHyacqWvHm5R1K', 'contributor', '2025-12-30 00:21:21', '2025-12-30 00:21:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_user_id_foreign` (`user_id`),
  ADD KEY `articles_disaster_category_id_foreign` (`disaster_category_id`);

--
-- Indexes for table `article_approvals`
--
ALTER TABLE `article_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_approvals_article_id_foreign` (`article_id`),
  ADD KEY `article_approvals_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `article_comments`
--
ALTER TABLE `article_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_comments_article_id_foreign` (`article_id`),
  ADD KEY `article_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `disaster_categories`
--
ALTER TABLE `disaster_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `prevention_tips`
--
ALTER TABLE `prevention_tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prevention_tips_disaster_category_id_foreign` (`disaster_category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_approvals`
--
ALTER TABLE `article_approvals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article_comments`
--
ALTER TABLE `article_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `disaster_categories`
--
ALTER TABLE `disaster_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prevention_tips`
--
ALTER TABLE `prevention_tips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_disaster_category_id_foreign` FOREIGN KEY (`disaster_category_id`) REFERENCES `disaster_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_approvals`
--
ALTER TABLE `article_approvals`
  ADD CONSTRAINT `article_approvals_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_approvals_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_comments`
--
ALTER TABLE `article_comments`
  ADD CONSTRAINT `article_comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `prevention_tips`
--
ALTER TABLE `prevention_tips`
  ADD CONSTRAINT `prevention_tips_disaster_category_id_foreign` FOREIGN KEY (`disaster_category_id`) REFERENCES `disaster_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
