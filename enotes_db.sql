-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 01:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enotes_db`
--

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2025_11_01_013452_create_notes_table', 1),
(5, '2025_12_02_130828_modify_notes_table_for_guest_mode', 1),
(6, '2025_12_15_080740_add_image_to_notes_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `session_token`, `title`, `content`, `image`, `author`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Est quae ut vitae.', 'Magnam qui voluptatem voluptatem dolorum repellat. Labore in fuga illo magnam cupiditate dolore magnam. Omnis blanditiis eaque explicabo neque est. Suscipit asperiores aut voluptas et aut ipsum sint.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(2, 1, NULL, 'Repellat vero et repellendus ea.', 'Earum facilis error ut molestiae. Cupiditate voluptate corrupti odio perspiciatis odit ratione earum. Et non commodi sint suscipit reiciendis.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(3, 1, NULL, 'Id id perspiciatis consequuntur labore.', 'Est in ex sed illum occaecati. Iste neque consequatur cumque eos hic ut.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(4, 1, NULL, 'Ipsum qui natus eligendi perferendis at.', 'Sint voluptas sunt ut quo et. Quos unde beatae ea aut dolores. Voluptas eos ducimus velit iusto. Assumenda dolores qui asperiores consequuntur amet et tempora.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(5, 1, NULL, 'Et blanditiis nobis dolores est.', 'Modi vitae dolor quod eum dolorum autem. Sunt qui consectetur saepe et eos rem tenetur. Quae mollitia accusamus ipsa qui libero.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(6, 1, NULL, 'Animi harum quibusdam praesentium sit doloribus.', 'Ipsum qui similique earum voluptatem. Id illo totam voluptate autem non. Quia laudantium minus porro perspiciatis iure qui ratione ex. Soluta et voluptatem aspernatur quo et nam saepe quisquam.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(7, 1, NULL, 'Nam incidunt ratione.', 'Et dolor dolores eos quidem. In consectetur atque voluptatem molestias omnis magni voluptas.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(8, 1, NULL, 'Atque qui quis.', 'Voluptatem magnam assumenda recusandae provident sit consequatur distinctio quis. Sint temporibus minus ut quis facilis quia dolor consequuntur.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(9, 1, NULL, 'Quisquam tempora mollitia expedita aspernatur.', 'Consectetur cum et officiis. Quo harum accusamus nulla ea praesentium. Repudiandae dolorem quam enim. Cum qui delectus aspernatur aliquid qui.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(10, 1, NULL, 'Laboriosam veniam quasi facilis aut officiis.', 'Qui optio eum minus ex eligendi et voluptates temporibus. Aut ipsum fugit omnis iure cumque. Rem ullam dicta sunt odio enim nemo. Ut eligendi ut cupiditate qui magni.', NULL, 'Mahasiswa Demo', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(11, NULL, 'dummy_token_for_testing', '[Guest] Animi ab consequatur et.', 'Deleniti voluptatem expedita dolorem deleniti impedit id et. Earum repellat omnis culpa amet sequi doloremque.', NULL, 'Guest User', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(12, NULL, 'dummy_token_for_testing', '[Guest] Aspernatur in ipsa autem.', 'Consequuntur quidem placeat sint. Quis illum quia perspiciatis expedita. Amet nihil omnis accusantium ipsam voluptas placeat.', NULL, 'Guest User', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(13, NULL, 'dummy_token_for_testing', '[Guest] Amet et possimus.', 'Hic sequi voluptatibus voluptatem incidunt libero. Quod voluptatum aut et non. Est et id quaerat et.', NULL, 'Guest User', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(14, NULL, 'dummy_token_for_testing', '[Guest] Sunt accusamus et.', 'Similique commodi vitae doloremque natus voluptatem voluptatem. Et ullam numquam aliquam. Possimus ab consequatur amet non expedita.', NULL, 'Guest User', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(15, NULL, 'dummy_token_for_testing', '[Guest] Reprehenderit ut reprehenderit.', 'Eos maxime ea et ut. Voluptatem harum expedita saepe.', NULL, 'Guest User', '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(23, 1, NULL, 'Jadwal UAS', 'jadwal uas kenzie', 'foto/1765798863-WhatsApp Image 2025-12-14 at 20.36.28.jpeg', 'Mahasiswa Demo', '2025-12-15 04:41:03', '2025-12-15 04:41:03');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa Demo', 'demo@enotes.com', '2025-12-07 21:53:52', '$2y$10$wUTf4hnkg3UpZaIyrLMfJOI2rs5Fya1RqNL5IcVvZqpdLlD/ENibK', NULL, '2025-12-07 21:53:52', '2025-12-07 21:53:52'),
(2, 'Kenzie', 'kenzie.carlen@gmail.com', NULL, '$2y$10$eirHZjQ6DeDquTtdN6OTheJU8W8S9b6rxs77xbQxYlyFFIC3bMiP.', '59pYTjxwBDaL80QhNbYZ3VBQSTosZnNzLz1lh3ZGZ5Rm0ovmFsivWu61yAFD', '2025-12-07 21:54:34', '2025-12-15 03:12:52'),
(3, 'vian', 'vian@gmail.com', NULL, '$2y$10$/AxdTWV.Me5kG7YqVImTtueKj2RBIMkyJUelsZJXpPnMOoSoB9Ti.', NULL, '2025-12-15 03:58:17', '2025-12-15 03:58:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_session_token_index` (`session_token`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
