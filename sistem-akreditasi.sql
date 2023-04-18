-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 11:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem-akreditasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `file` varchar(2048) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Perdagangan Internasional S1', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(2, 'Perpustakaan & Sains Informasi S1', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(3, 'Produksi Film & Televisi D4', '2023-02-09 10:12:27', '2023-02-09 10:12:27');

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
(1, '2013_01_27_011354_create_majors_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_01_27_011444_create_standards_table', 1),
(8, '2023_01_27_011612_create_subs_table', 1),
(9, '2023_01_27_011633_create_documents_table', 1),
(10, '2023_01_27_011958_create_permission_tables', 1),
(11, '2023_01_29_120352_create_timelines_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'access documents', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(2, 'store document', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(3, 'update document', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(4, 'delete document', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(5, 'verify document', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(6, 'access subs', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(7, 'store sub', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(8, 'update sub', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(9, 'delete sub', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(10, 'access users', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(11, 'store user operator', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(12, 'store user', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(13, 'update user', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(14, 'delete user', 'web', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(15, 'access standards', 'web', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(16, 'store standard', 'web', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(17, 'update standard', 'web', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(18, 'delete standard', 'web', '2023-02-09 10:12:27', '2023-02-09 10:12:27');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(2, 'operator', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(3, 'dekan', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(4, 'kaprodi', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26'),
(5, 'dosen', 'web', '2023-02-09 10:12:26', '2023-02-09 10:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(4, 1),
(4, 2),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 3),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `name`, `number`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Visi, Misi dan Tujuan', '1', 'Penilaian difokuskan pada kejelasan arah, komitmen dan konsistensi pengembangan program studi oleh unit pengelola program studi untuk mencapai kinerja dan mutu yang ditargetkan berdasarkan misi dan langkah-langkah program yang terencana, efektif, dan terarah dalam rangka pewujudan visi perguruan tinggi dan visi keilmuan program studi.', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(2, 'Tata Pamong, Tata Kelola dan Kerjasama', '2', 'Penilaian difokuskan pada kinerja dan keefektifan kepemimpinan, tata pamong, sistem manajemen sumber daya, sistem penjaminan mutu, sistem komunikasi dan teknologi informasi, program dan kegiatan yang diarahkan pada perwujudan visi dan penuntasan misi yang bermutu, serta terbangun dan terselenggaranya kerjasama dan kemitraan strategis dalam penyelenggaraan pendidikan tinggi, baik akademik maupun non akademik secara berkelanjutan pada tataran nasional, regional, maupun internasional untuk meningkatkan daya saing program studi.', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(3, 'Mahasiswa', '3', 'Penilaian difokuskan pada keefektifan sistem penerimaan mahasiswa baru yang adil dan objektif, keseimbangan rasio mahasiswa dengan dosen dan tenaga kependidikan yang menunjang pelaksanaan pembelajaran yang efektif dan efisien, serta program dan keterlibatan mahasiswa dalam pembinaan minat, bakat, dan keprofesian', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(4, 'Sumber Daya Manusia', '4', 'Penilaian difokuskan pada keefektifan sistem perekrutan, ketersedian sumber daya dari segi jumlah, kualifikasi pendidikan dan kompetensi, program pengembangan, penghargaan, sanksi dan pemutusan hubungan kerja, baik bagi dosen maupun tenaga kependidikan untuk menyelenggarakan kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat yang bermutu. ', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(5, 'Keuangan, Sarana dan Prasarana', '5', 'Penilaian keuangan termasuk pembiayaan difokuskan pada kecukupan, keefektifan, efisiensi, dan akuntabilitas, serta keberlanjutan pembiayaan untuk menunjang penyelenggaraan pendidikan, penelitian, dan pengabdian kepada masyarakat. Penilaian sarana dan prasarana difokuskan pada pemenuhan ketersediaan (availability) sarana prasarana, akses civitas akademika terhadap sarana prasarana (accessibility), kegunaan atau pemanfaatan (utility) sarana prasarana oleh sivitas akademika, serta keamanan, keselamatan, kesehatan dan lingkungan dalam menunjang pelaksanaan tridharma perguruan tinggi.', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(6, 'Pendidikan', '6', 'Penilaian difokuskan pada kebijakan dan pengembangan kurikulum, kesesuaian kurikulum dengan bidang ilmu program studi beserta kekuatan dan keunggulan kurikulum, budaya akademik, proses pembelajaran, sistem penilaian, dan sistem penjaminan mutu untuk menunjang tercapainya capaian pembelajaran lulusan dalam rangka pewujudan visi, misi, dan tujuan perguruan tinggi/unit pengelola program studi.', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(7, 'Penelitian', '7', 'Penilaian difokuskan pada komitmen untuk mengembangkan penelitian yang bermutu, keunggulan dan kesesuaian program penelitian dengan visi keilmuan program studi dan visi perguruan tinggi/unit pengelola program studi, serta capaian jumlah dan lingkup penelitian', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(8, 'Pengabdian Pada Masyarakat', '8', 'Penilaian difokuskan pada komitmen untuk mengembangkan dan melaksanakan pengabdian kepada masyarakat, jumlah dan jenis kegiatan, keunggulan dan kesesuaian program pengabdian kepada masyarakat, serta cakupan daerah pengabdian.', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(9, 'Luaran dan Pencapaian Tridharma', '9', 'Penilaian difokuskan pada pencapaian kualifikasi dan kompetensi lulusan berupa gambaran yang jelas tentang profil dan capaian pembelajaran lulusan dari program studi, penelusuran lulusan, umpan balik dari pengguna lulusan, dan persepsi public terhadap lulusan sesuai dengan capaian pembelajaran lulusan/kompetensi yang ditetapkan oleh program studi dan perguruan tinggi dengan mengacu pada KKNI, jumlah dan keungggulan publikasi ilmiah, jumlah sitasi, jumlah hak kekayaan intelektual, dan kemanfaatan/dampak hasil penelitian terhadap pewujudan visi dan penyelenggaraan misi, serta kontribusi pengabdian kepada masyarakat pada pengembangan dan pemberdayaan sosial, ekonomi, dan kesejahteraan masyarakat. ', '2023-02-09 10:12:27', '2023-02-09 10:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `subs`
--

CREATE TABLE `subs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subs`
--

INSERT INTO `subs` (`id`, `standard_id`, `name`, `number`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sub A', '1.1', 'Deksripsi dari Sub A', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(2, 1, 'Sub B', '1.2', 'Deksripsi dari Sub B', '2023-02-09 10:12:27', '2023-02-09 10:12:27'),
(3, 1, 'Sub C', '1.3', 'Deksripsi dari Sub C', '2023-02-09 10:12:27', '2023-02-09 10:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sub_id` bigint(20) UNSIGNED NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `operation` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `major_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `major_id`, `name`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin.siakre@widyatama.ac.id', '$2y$10$ms0NHsuxhUTU77ngTOAXLORi6DWfXUo/f828heRFQh5DOEXkd9sXa', NULL, NULL, 'R2hDx1ieZo', '2023-02-09 10:12:28', '2023-02-09 10:12:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_sub_id_foreign` (`sub_id`),
  ADD KEY `documents_user_id_foreign` (`user_id`),
  ADD KEY `documents_major_id_foreign` (`major_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `majors_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `standards_name_unique` (`name`),
  ADD UNIQUE KEY `standards_number_unique` (`number`);

--
-- Indexes for table `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subs_name_unique` (`name`),
  ADD UNIQUE KEY `subs_number_unique` (`number`),
  ADD KEY `subs_standard_id_foreign` (`standard_id`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timelines_user_id_foreign` (`user_id`),
  ADD KEY `timelines_sub_id_foreign` (`sub_id`),
  ADD KEY `timelines_major_id_foreign` (`major_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_major_id_foreign` (`major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subs`
--
ALTER TABLE `subs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_sub_id_foreign` FOREIGN KEY (`sub_id`) REFERENCES `subs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subs`
--
ALTER TABLE `subs`
  ADD CONSTRAINT `subs_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timelines`
--
ALTER TABLE `timelines`
  ADD CONSTRAINT `timelines_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timelines_sub_id_foreign` FOREIGN KEY (`sub_id`) REFERENCES `subs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timelines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
