-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 03:11 AM
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
-- Database: `projectrpl`
--

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
-- Table structure for table `fuzzy_rules`
--

CREATE TABLE `fuzzy_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_suhu_id` bigint(20) UNSIGNED NOT NULL,
  `parameter_kelembapan_id` bigint(20) UNSIGNED NOT NULL,
  `parameter_cahaya_id` bigint(20) UNSIGNED NOT NULL,
  `rekomendasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanaman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rekomendasi_temp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuzzy_rules`
--

INSERT INTO `fuzzy_rules` (`id`, `parameter_suhu_id`, `parameter_kelembapan_id`, `parameter_cahaya_id`, `rekomendasi`, `created_at`, `updated_at`, `tanaman_id`, `rekomendasi_temp`) VALUES
(1, 2, 6, 8, 'Monstera Adansonii', '2025-06-20 02:30:35', '2025-06-20 02:30:35', 5, NULL),
(2, 3, 6, 9, 'Monstera Albo Variegata', '2025-06-20 02:30:52', '2025-06-20 02:30:52', 6, NULL),
(3, 2, 6, 9, 'Monstera Deliciosa', '2025-06-20 02:31:13', '2025-06-20 02:31:13', 4, NULL),
(4, 2, 6, 9, 'Monstera Dubia', '2025-06-20 02:31:35', '2025-06-20 02:31:35', 8, NULL),
(5, 3, 6, 7, 'Monstera Obliqua', '2025-06-20 02:31:56', '2025-06-20 02:31:56', 12, NULL),
(6, 2, 4, 9, 'Monstera Peru', '2025-06-20 02:32:21', '2025-06-20 02:32:21', 7, NULL),
(7, 1, 6, 8, 'Monstera Pinnatipartita', '2025-06-20 02:32:42', '2025-06-20 02:32:42', 11, NULL),
(8, 1, 6, 9, 'Monstera Siltepecana', '2025-06-20 02:33:12', '2025-06-20 02:33:12', 10, NULL),
(10, 1, 5, 7, 'Monstera Standleyana', '2025-06-20 02:34:30', '2025-06-20 02:34:30', 9, NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_26_000000_rename_tanamen_table', 1),
(6, '2025_06_08_231930_create_parameter_table', 1),
(7, '2025_06_09_000054_create_fuzzy_rules_table', 1),
(8, '2025_06_18_233150_add_profile_photo_path_to_users_table', 1),
(9, '2025_10_25_000000_create_tanamans_table', 1),
(10, '2025_10_25_000001_modify_fuzzy_rules_table', 1),
(11, '2025_10_25_create_recommendation_results_table', 1),
(12, '2025_10_27_000000_add_parameter_fields_to_tanamans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `min` double(8,2) NOT NULL,
  `max` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id`, `type`, `label`, `min`, `max`, `created_at`, `updated_at`) VALUES
(1, 'suhu', 'dingin', 14.00, 18.00, '2025-06-20 02:07:47', '2025-06-20 02:07:47'),
(2, 'suhu', 'sedang', 19.00, 27.00, '2025-06-20 02:07:47', '2025-06-20 02:07:47'),
(3, 'suhu', 'panas', 28.00, 32.00, '2025-06-20 02:07:47', '2025-06-20 02:07:47'),
(4, 'kelembapan', 'kering', 0.00, 40.00, '2025-06-20 02:08:17', '2025-06-20 02:08:17'),
(5, 'kelembapan', 'lembab', 40.00, 70.00, '2025-06-20 02:08:17', '2025-06-20 02:08:17'),
(6, 'kelembapan', 'basah', 70.00, 100.00, '2025-06-20 02:08:17', '2025-06-20 02:08:17'),
(7, 'cahaya', 'redup', 0.00, 500.00, '2025-06-20 02:09:01', '2025-06-20 02:09:01'),
(8, 'cahaya', 'sedang', 500.00, 1000.00, '2025-06-20 02:09:01', '2025-06-20 02:09:01'),
(9, 'cahaya', 'terang', 1000.00, 2000.00, '2025-06-20 02:09:01', '2025-06-20 02:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `recommendation_results`
--

CREATE TABLE `recommendation_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `input_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`input_data`)),
  `results` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`results`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommendation_results`
--

INSERT INTO `recommendation_results` (`id`, `user_id`, `input_data`, `results`, `created_at`, `updated_at`) VALUES
(1, 2, '\"{\\\"suhu\\\":\\\"sedang\\\",\\\"kelembapan\\\":\\\"kering\\\",\\\"cahaya\\\":\\\"sedang\\\"}\"', '\"[{\\\"tanaman\\\":{\\\"id\\\":5,\\\"nama\\\":\\\"Monstera Adansonii\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"sedang\\\"},\\\"confidence\\\":0.6666666666666666,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":7,\\\"nama\\\":\\\"Monstera Peru\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"kering\\\",\\\"parameter_cahaya\\\":\\\"terang\\\"},\\\"confidence\\\":0.6666666666666666,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":4,\\\"nama\\\":\\\"Monstera Deliciosa\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"terang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":8,\\\"nama\\\":\\\"Monstera Dubia\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"terang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":11,\\\"nama\\\":\\\"Monstera Pinnatipartita\\\",\\\"parameter_suhu\\\":\\\"dingin\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"sedang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false}]\"', '2025-06-20 02:36:10', '2025-06-20 02:36:10'),
(2, 2, '\"{\\\"suhu\\\":\\\"dingin\\\",\\\"kelembapan\\\":\\\"kering\\\",\\\"cahaya\\\":\\\"sedang\\\"}\"', '\"[{\\\"tanaman\\\":{\\\"id\\\":11,\\\"nama\\\":\\\"Monstera Pinnatipartita\\\",\\\"parameter_suhu\\\":\\\"dingin\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"sedang\\\"},\\\"confidence\\\":0.6666666666666666,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":5,\\\"nama\\\":\\\"Monstera Adansonii\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"sedang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":7,\\\"nama\\\":\\\"Monstera Peru\\\",\\\"parameter_suhu\\\":\\\"sedang\\\",\\\"parameter_kelembapan\\\":\\\"kering\\\",\\\"parameter_cahaya\\\":\\\"terang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":9,\\\"nama\\\":\\\"Monstera Standleyana\\\",\\\"parameter_suhu\\\":\\\"dingin\\\",\\\"parameter_kelembapan\\\":\\\"lembab\\\",\\\"parameter_cahaya\\\":\\\"redup\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false},{\\\"tanaman\\\":{\\\"id\\\":10,\\\"nama\\\":\\\"Monstera Siltepecana\\\",\\\"parameter_suhu\\\":\\\"dingin\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"terang\\\"},\\\"confidence\\\":0.3333333333333333,\\\"rule\\\":false}]\"', '2025-06-20 02:36:21', '2025-06-20 02:36:21'),
(3, 2, '\"{\\\"suhu\\\":\\\"dingin\\\",\\\"kelembapan\\\":\\\"basah\\\",\\\"cahaya\\\":\\\"sedang\\\"}\"', '\"[{\\\"tanaman\\\":{\\\"id\\\":11,\\\"nama\\\":\\\"Monstera Pinnatipartita\\\",\\\"parameter_suhu\\\":\\\"dingin\\\",\\\"parameter_kelembapan\\\":\\\"basah\\\",\\\"parameter_cahaya\\\":\\\"sedang\\\"},\\\"confidence\\\":1,\\\"rule\\\":true}]\"', '2025-06-20 02:36:39', '2025-06-20 02:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `tanamans`
--

CREATE TABLE `tanamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `cara_perawatan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parameter_suhu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parameter_kelembapan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parameter_cahaya_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanamans`
--

INSERT INTO `tanamans` (`id`, `nama`, `deskripsi`, `cara_perawatan`, `gambar`, `created_at`, `updated_at`, `parameter_suhu_id`, `parameter_kelembapan_id`, `parameter_cahaya_id`) VALUES
(4, 'Monstera Deliciosa', 'Ini adalah jenis Monstera yang paling ikonik. Daunnya besar, berbentuk hati, dan berwarna hijau tua mengkilap. Seiring bertambahnya usia tanaman dan dengan cahaya yang cukup, daunnya akan mulai terbelah di bagian pinggir (dikenal sebagai fenestration), yang menjadi ciri khasnya. Tanaman ini adalah pemanjat alami yang akan mengeluarkan akar udara untuk menopang dirinya.', 'Penyiraman: Siram secara merata ketika 2-3 cm bagian atas media tanam sudah terasa kering. Pastikan air bisa mengalir keluar dari lubang pot untuk menghindari busuk akar.\r\nPemupukan: Beri pupuk cair seimbang sebulan sekali selama periode pertumbuhan aktif.\r\nMedia Tanam: Gunakan campuran media tanam yang gembur dan memiliki drainase sangat baik.\r\nLain-lain: Sediakan turus (moss pole) untuk tempatnya merambat agar pertumbuhan daun lebih maksimal.', '1750410734.jpg', '2025-06-20 02:12:14', '2025-06-20 02:12:14', 2, 6, 9),
(5, 'Monstera Adansonii', 'Berbeda dengan Deliciosa, daun Adansonii memiliki lubang-lubang di tengah helai daunnya. Ukuran daunnya lebih kecil dan bentuknya lebih lonjong. Sifatnya merambat atau menjuntai, cocok untuk pot gantung.', 'Penyiraman: Jaga agar media tanam tetap sedikit lembap, jangan becek. Siram ketika permukaan media mulai terasa kering.\r\nPemupukan: Pupuk setiap 2-4 minggu sekali dengan dosis setengah dari yang dianjurkan.', '1750410801.jpg', '2025-06-20 02:13:21', '2025-06-20 02:13:21', 2, 6, 8),
(6, 'Monstera Albo Variegata', 'Memiliki corak variegata putih krem yang acak pada daunnya. Bagian putih pada daun tidak memiliki klorofil dan lebih sensitif.', 'Penyiraman: Rentan busuk akar. Pastikan media tanam sudah kering di bagian atas sebelum menyiram lagi.\r\nPemupukan: Pupuk dengan hati-hati agar tidak merusak bagian putih yang sensitif.\r\nPerhatian Khusus: Bagian putih mudah gosong, hindari sinar matahari langsung.', '1750410941.jpg', '2025-06-20 02:15:41', '2025-06-20 02:19:55', 3, 6, 9),
(7, 'Monstera Peru', 'Memiliki daun yang tebal, bertekstur unik seperti kulit yang berkerut, dan berwarna hijau tua pekat. Tidak memiliki lubang atau belahan (fenestrasi) alami.', 'Penyiraman: Sangat toleran kekeringan. Biarkan media tanam cukup kering di antara penyiraman untuk menghindari busuk akar.\r\nPemupukan: Jarang, cukup setiap 1-2 bulan sekali selama masa pertumbuhan.', '1750411129.jpg', '2025-06-20 02:18:49', '2025-06-20 02:28:10', 2, 4, 9),
(8, 'Monstera Dubia', 'Sangat unik saat masih muda. Daunnya kecil, berbentuk hati dengan corak perak, dan menempel rata pada media rambatnya (seperti sirap atap). Saat dewasa dan memanjat tinggi, daunnya akan membesar dan mulai terbelah.', 'Penyiraman: Jaga tanah tetap lembap namun tidak basah.\r\nLain-lain: Wajib menyediakan papan atau turus datar agar sifat \"shingle\" nya keluar.', '1750411326.jpg', '2025-06-20 02:22:06', '2025-06-20 02:22:06', 2, 6, 9),
(9, 'Monstera Standleyana', 'Dikenal dengan daunnya yang lonjong, hijau tua, dan mengkilap dengan cipratan atau bintik-bintik variegata berwarna kuning atau putih krem.', 'Penyiraman: Siram saat beberapa sentimeter bagian atas media tanam sudah kering.\r\nPemupukan: Sebulan sekali selama musim tumbuh dengan pupuk seimbang.', '1750411414.jpg', '2025-06-20 02:23:34', '2025-06-20 02:23:34', 1, 5, 7),
(10, 'Monstera Siltepecana', 'Saat muda, daunnya berbentuk tombak dengan warna perak kehijauan yang khas dan urat daun hijau tua. Saat dewasa dan diberi rambatan, daunnya akan membesar, warnanya menjadi lebih hijau, dan mulai berlubang.', 'Penyiraman: Siram saat permukaan tanah mulai kering.\r\nLain-lain: Berikan turus untuk memancing pertumbuhan daun dewasa yang berlubang.', '1750411468.jpg', '2025-06-20 02:24:28', '2025-06-20 02:24:28', 1, 6, 9),
(11, 'Monstera Pinnatipartita', 'Sangat dramatis saat dewasa. Daunnya terbelah sangat dalam hingga hampir menyentuh tulang daun tengah, menciptakan tampilan seperti kerangka daun. Saat muda, daunnya utuh tanpa belahan.', 'Penyiraman: Siram saat bagian atas media tanam terasa kering.\r\nLain-lain: Wajib diberi turus untuk bisa tumbuh besar dan mengeluarkan daun dewasanya yang terbelah.', '1750411544.jpg', '2025-06-20 02:25:44', '2025-06-20 02:25:44', 1, 6, 8),
(12, 'Monstera Obliqua', 'Spesies yang sangat langka dan seringkali yang dijual adalah Monstera Adansonii. Obliqua sejati memiliki lubang yang mendominasi hingga 90% permukaan daun, membuatnya terlihat seperti jaring yang sangat halus dan rapuh.', 'Penyiraman: Butuh media yang selalu lembap secara konsisten.\r\nPerhatian Khusus: Sangat sulit dirawat di luar lingkungan terkontrol seperti terrarium.', '1750411613.jpg', '2025-06-20 02:26:53', '2025-06-20 02:26:53', 3, 6, 7);

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
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `profile_photo_path`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$10$InDsrL3MOo.RuNDp5oS1W..BMZRqBvjyIEzbhOKBG/oFSEwDaN02W', 'admin', NULL, '2025-06-20 02:01:53', '2025-06-20 02:01:53', NULL),
(2, 'Maliki', 'maliki@gmail.com', NULL, '$2y$10$X6dXbH1TqPBGI38Ig3dJjuv/4CMOIKGWvFM9HJ9n6KnNKu/E5Jpj.', 'user', NULL, '2025-06-20 02:01:53', '2025-06-20 02:01:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fuzzy_rules`
--
ALTER TABLE `fuzzy_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuzzy_rules_parameter_suhu_id_foreign` (`parameter_suhu_id`),
  ADD KEY `fuzzy_rules_parameter_kelembapan_id_foreign` (`parameter_kelembapan_id`),
  ADD KEY `fuzzy_rules_parameter_cahaya_id_foreign` (`parameter_cahaya_id`),
  ADD KEY `fuzzy_rules_tanaman_id_foreign` (`tanaman_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recommendation_results`
--
ALTER TABLE `recommendation_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recommendation_results_user_id_foreign` (`user_id`);

--
-- Indexes for table `tanamans`
--
ALTER TABLE `tanamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanamans_parameter_suhu_id_foreign` (`parameter_suhu_id`),
  ADD KEY `tanamans_parameter_kelembapan_id_foreign` (`parameter_kelembapan_id`),
  ADD KEY `tanamans_parameter_cahaya_id_foreign` (`parameter_cahaya_id`);

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
-- AUTO_INCREMENT for table `fuzzy_rules`
--
ALTER TABLE `fuzzy_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recommendation_results`
--
ALTER TABLE `recommendation_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tanamans`
--
ALTER TABLE `tanamans`
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
-- Constraints for table `fuzzy_rules`
--
ALTER TABLE `fuzzy_rules`
  ADD CONSTRAINT `fuzzy_rules_parameter_cahaya_id_foreign` FOREIGN KEY (`parameter_cahaya_id`) REFERENCES `parameter` (`id`),
  ADD CONSTRAINT `fuzzy_rules_parameter_kelembapan_id_foreign` FOREIGN KEY (`parameter_kelembapan_id`) REFERENCES `parameter` (`id`),
  ADD CONSTRAINT `fuzzy_rules_parameter_suhu_id_foreign` FOREIGN KEY (`parameter_suhu_id`) REFERENCES `parameter` (`id`),
  ADD CONSTRAINT `fuzzy_rules_tanaman_id_foreign` FOREIGN KEY (`tanaman_id`) REFERENCES `tanamans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `recommendation_results`
--
ALTER TABLE `recommendation_results`
  ADD CONSTRAINT `recommendation_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tanamans`
--
ALTER TABLE `tanamans`
  ADD CONSTRAINT `tanamans_parameter_cahaya_id_foreign` FOREIGN KEY (`parameter_cahaya_id`) REFERENCES `parameter` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tanamans_parameter_kelembapan_id_foreign` FOREIGN KEY (`parameter_kelembapan_id`) REFERENCES `parameter` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tanamans_parameter_suhu_id_foreign` FOREIGN KEY (`parameter_suhu_id`) REFERENCES `parameter` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
