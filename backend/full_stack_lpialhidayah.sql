-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk unggul_bangsa
CREATE DATABASE IF NOT EXISTS `unggul_bangsa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `unggul_bangsa`;

-- membuang struktur untuk table unggul_bangsa.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.cache: ~4 rows (lebih kurang)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1769772853),
	('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1769772853;', 1769772853),
	('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1769935279),
	('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1769935279;', 1769935279);

-- membuang struktur untuk table unggul_bangsa.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table unggul_bangsa.facilities
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.facilities: ~8 rows (lebih kurang)
INSERT INTO `facilities` (`id`, `name`, `type`, `description`, `imageUrl`, `jenjang`, `created_at`, `updated_at`) VALUES
	(1, 'Lab Komputer MA', 'ekstra', 'Laboratorium modern untuk riset IT.', 'https://images.unsplash.com/photo-1531482615713-2afd69097998', 'MA', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(2, 'Perpustakaan Digital', 'ekstra', 'Akses e-book dan jurnal akademik.', 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f', 'KAMPUS', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(3, 'Studio Multimedia', 'ekstra', 'Produksi konten dakwah dan edukasi digital.', 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2', 'KAMPUS', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(4, 'Lapangan Olahraga', 'ekstra', 'Futsal, basket, dan olahraga sunnah.', 'https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf', 'MA', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(5, 'Robotik MA', 'fasilitas', 'Pengembangan teknologi robotika.', 'https://images.unsplash.com/photo-1561557944-6e7860d1a7eb', 'MA', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(8, 'Asrul Maaliy', 'fasilitas', 'asdfasdfasdfsda', 'facilities/1769688260_gedung asmah.jpeg', 'MI', '2026-01-29 05:04:20', '2026-01-29 05:04:20'),
	(9, '2024/2025', 'fasilitas', 'sdfgghghd', 'http://127.0.0.1:8000/storage/facilities/1769688439_gedung 2.jpeg', 'SMPT', '2026-01-29 05:07:19', '2026-01-29 05:07:19'),
	(10, 'x', 'ekstra', 'x', 'http://localhost:8000/storage/facilities/1769755467_x.jpg', 'KAMPUS', '2026-01-29 23:44:27', '2026-01-29 23:44:27');

-- membuang struktur untuk table unggul_bangsa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table unggul_bangsa.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table unggul_bangsa.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.job_batches: ~0 rows (lebih kurang)

-- membuang struktur untuk table unggul_bangsa.journals
CREATE TABLE IF NOT EXISTS `journals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mentor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `date` date NOT NULL,
  `is_best` tinyint(1) NOT NULL DEFAULT '0',
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.journals: ~6 rows (lebih kurang)
INSERT INTO `journals` (`id`, `title`, `category`, `abstract`, `author`, `mentor`, `score`, `date`, `is_best`, `jenjang`, `documentUrl`, `created_at`, `updated_at`) VALUES
	(1, 'Zakat & Ekonomi Digital', 'Ekonomi Syariah', 'Studi efisiensi pengelolaan zakat via aplikasi.', 'Ahmad Mahasiswa', 'Dr. Zainal', 98, '2024-06-01', 1, 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 18:21:22'),
	(2, 'Eksperimen Bio-Gas Sekolah', 'Sains Terapan', 'Pemanfaatan limbah kantin menjadi energi.', 'Siswa MA', 'Guru Kimia', 92, '2024-05-01', 0, 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(3, 'AI untuk Prediksi Cuaca Lokal', 'Teknologi Informasi', 'Implementasi machine learning untuk prediksi cuaca.', 'Tim Riset Kampus', 'Dr. Fikri', 95, '2024-04-01', 0, 'KAMPUS', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(4, 'Pengaruh Tahfidz terhadap Prestasi Akademik', 'Pendidikan Islam', 'Analisis korelasi hafalan Al-Qur’an dan nilai akademik.', 'Siswa MA', 'Ust. Hasan', 90, '2024-03-01', 0, 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(5, 'asfd', 'Pendidikan', 'afsd', 'asfd', 'asf', 25, '2026-01-30', 0, 'MI', 'http://localhost:8000/storage/journals/documents/dhfVCLE9Ep1vDbao2tkHkZXh4SSv2pjky7C5jvBC.pdf', '2026-01-29 17:41:29', '2026-01-29 17:41:29'),
	(8, 'x', 'Sains', 'x', 'x', 'x', 99, '2026-01-30', 0, 'KAMPUS', 'journals/documents/01KG6TCJ8TYKCSYYTNPHPFKVFV.pdf', '2026-01-29 23:45:27', '2026-01-29 23:45:27');

-- membuang struktur untuk table unggul_bangsa.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('contact','complaint') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_content` text COLLATE utf8mb4_unicode_ci,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.messages: ~2 rows (lebih kurang)
INSERT INTO `messages` (`id`, `name`, `contact_info`, `message`, `category`, `type`, `jenjang`, `reply_subject`, `reply_content`, `replied_at`, `created_at`, `updated_at`) VALUES
	(1, 'as', 'lostsaga06k@gmail.com', 'as', NULL, 'contact', 'UMUM', 'Re: lostsaga06k@gmail.com', 'josjis', '2026-02-01 01:57:43', '2026-01-30 04:13:52', '2026-02-01 01:57:43'),
	(2, 're', 'lostsaga06k@gmail.com', 're', 'Sarana Prasarana', 'complaint', 'UMUM', NULL, NULL, NULL, '2026-01-30 04:14:11', '2026-01-30 04:14:11');

-- membuang struktur untuk table unggul_bangsa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.migrations: ~11 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_01_29_104051_create_news_table', 1),
	(5, '2026_01_29_104052_create_journals_table', 1),
	(6, '2026_01_29_104052_create_projects_table', 1),
	(7, '2026_01_29_104053_create_facilities_table', 1),
	(8, '2026_01_30_003838_add_document_url_to_journals_table', 2),
	(9, '2026_01_30_010859_add_level_to_news_table', 3),
	(11, '2026_01_30_110518_create_messages_table', 4),
	(12, '2026_01_30_111032_add_jenjang_to_messages_table', 5),
	(15, '2026_02_01_001154_create_activity_logs_table', 6),
	(16, '2026_02_01_084224_add_reply_columns_to_messages_table', 7);

-- membuang struktur untuk table unggul_bangsa.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.news: ~12 rows (lebih kurang)
INSERT INTO `news` (`id`, `title`, `excerpt`, `content`, `date`, `views`, `category`, `level`, `jenjang`, `main_image`, `gallery`, `created_at`, `updated_at`) VALUES
	(1, 'Siswa MA Menangkan Olimpiade Sains Nasional', 'Prestasi membanggakan kembali diraih oleh siswa MA...', 'Siswa Madrasah Aliyah Unggul Bangsa berhasil meraih juara Olimpiade Sains Nasional berkat kerja keras dan bimbingan intensif para guru.', '2024-05-24', 1252, 'prestasi', 'Sekolah', 'MI', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d', '["https://images.unsplash.com/photo-1523580846011-d3a5bc25702b", "https://images.unsplash.com/photo-1581092919534-1c6c7f0d6f47"]', '2026-01-29 03:44:28', '2026-01-31 10:01:53'),
	(2, 'Lomba Mewarnai MI Unggul Bangsa', 'Keceriaan santri MI dalam lomba mewarnai...', 'Kegiatan lomba mewarnai diikuti oleh seluruh santri MI sebagai sarana pengembangan kreativitas dan motorik halus.', '2024-05-10', 503, 'Kegiatan', NULL, 'MI', 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9', '["https://images.unsplash.com/photo-1588072432836-e10032774350", "https://images.unsplash.com/photo-1516627145497-ae6968895b74"]', '2026-01-29 03:44:28', '2026-01-31 10:03:26'),
	(3, 'Workshop AI untuk Guru MA', 'Peningkatan kompetensi guru melalui workshop AI...', '<p>Workshop&nbsp;Artificial&nbsp;Intelligence&nbsp;dilaksanakan&nbsp;untuk&nbsp;meningkatkan&nbsp;kompetensi&nbsp;guru&nbsp;MA&nbsp;dalam&nbsp;pembelajaran&nbsp;berbasis&nbsp;teknologi.</p>', '2026-01-31', 820, 'Kegiatan', NULL, 'MA', 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b', '["https://images.unsplash.com/photo-1519389950473-47ba0277781c"]', '2026-01-29 03:44:28', '2026-01-31 11:26:35'),
	(4, 'Santri MTs Juara Tahfidz Se-Kabupaten', 'Hafalan Al-Qur’an santri MTs tembus tingkat kabupaten...', 'Santri MTs Unggul Bangsa berhasil meraih juara dalam lomba Tahfidz Al-Qur’an tingkat kabupaten.', '2024-05-02', 940, 'Prestasi', NULL, 'SMPT', 'https://images.unsplash.com/photo-1604882357278-7c5d2b8a52b8', '["https://images.unsplash.com/photo-1517841905240-472988babdf9", "https://images.unsplash.com/photo-1509062522246-3755977927d7"]', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(5, 'Peringatan Isra Mi’raj Bersama Seluruh Jenjang', 'Peringatan Isra Mi’raj berlangsung khidmat...', '<p>Seluruh&nbsp;civitas&nbsp;akademika&nbsp;mengikuti&nbsp;peringatan&nbsp;Isra&nbsp;Mi’raj&nbsp;dengan&nbsp;penuh&nbsp;khidmat&nbsp;dan&nbsp;nuansa&nbsp;keislaman.</p>', '2026-01-31', 1500, 'Kegiatan', NULL, 'UMUM', 'https://images.unsplash.com/photo-1544717305-2782549b5136', '["https://images.unsplash.com/photo-1500530855697-b586d89ba3ee", "https://images.unsplash.com/photo-1529156069898-49953e39b3ac"]', '2026-01-29 03:44:28', '2026-01-31 15:59:46'),
	(6, 'Ekstrakurikuler Robotik MA Raih Juara Regional', 'Tim robotik MA menunjukkan inovasi luar biasa...', 'Tim robotik MA Unggul Bangsa berhasil meraih juara dalam kompetisi robotik tingkat regional.', '2024-04-20', 1100, 'Prestasi', NULL, 'MA', 'https://images.unsplash.com/photo-1581092919534-1c6c7f0d6f47', '["https://images.unsplash.com/photo-1581092334504-1c6c7f0d6f48", "https://images.unsplash.com/photo-1531482615713-2afd69097998"]', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(7, 'Outing Class MI ke Museum Sains', 'Belajar sambil bermain di Museum Sains...', 'Kegiatan outing class MI bertujuan menumbuhkan rasa ingin tahu santri terhadap ilmu pengetahuan.', '2024-04-15', 430, 'Kegiatan', NULL, 'MI', 'https://images.unsplash.com/photo-1588072432836-e10032774350', '["https://images.unsplash.com/photo-1523050854058-8df90110c9f1"]', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(8, 'Seminar Parenting Islami untuk Wali Santri', 'Penguatan peran orang tua dalam pendidikan anak...', '<p>Seminar&nbsp;parenting&nbsp;islami&nbsp;membahas&nbsp;sinergi&nbsp;orang&nbsp;tua&nbsp;dan&nbsp;sekolah&nbsp;dalam&nbsp;mendidik&nbsp;generasi&nbsp;Qurani.</p>', '2026-01-31', 670, 'Kegiatan', NULL, 'MA', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f', '["https://images.unsplash.com/photo-1517248135467-4c7edcad34c4"]', '2026-01-29 03:44:28', '2026-01-31 11:22:42'),
	(11, 'asfd', 'asdf', '<p>asfd</p>', '2026-01-31', 2, 'Prestasi', 'Kecamatan', 'MA', 'http://localhost:8000/storage/news/main/u0QWndfI0dVLehQvG4nvuRtgekBbGvNN3oeo18To.jpg', '[]', '2026-01-29 18:12:16', '2026-01-31 11:47:44'),
	(12, 'a', 'aaaaa', 'a', '2026-01-30', 2, 'Kegiatan', NULL, 'KAMPUS', 'http://127.0.0.1:8000/storage/news/main/Vb0AUCfdmuT1RFK6Oc7dLfcC77hrbxa1iZLkvKCW.jpg', '[]', '2026-01-29 20:27:22', '2026-01-31 10:00:17'),
	(13, 's', 's', '<p>s</p>', '2026-01-30', 6, 'Kegiatan', NULL, 'MI', 'news/main/01KG6SX3BF0MN8ETSF6P32TWFD.jpg', '["news/gallery/01KG6SX3BV7ZJ30GQ6MSE4Y3QE.jpg"]', '2026-01-29 23:37:01', '2026-01-31 10:16:46'),
	(14, 'x', 'x', '<p>x</p>', '2026-01-30', 10, 'Kegiatan', NULL, 'KAMPUS', 'news/main/01KG6TFEZVKFE8DD3YRKEAXM4B.jpg', '[]', '2026-01-29 23:47:02', '2026-01-31 17:04:34');

-- membuang struktur untuk table unggul_bangsa.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table unggul_bangsa.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `imageUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.projects: ~11 rows (lebih kurang)
INSERT INTO `projects` (`id`, `title`, `category`, `description`, `author`, `date`, `imageUrl`, `jenjang`, `documents`, `created_at`, `updated_at`) VALUES
	(1, 'Irigasi IoT MA', 'Sains & Teknologi', 'Sistem irigasi otomatis berbasis IoT untuk pertanian sekolah.', 'Tim MA', '2024-05-01', 'https://images.unsplash.com/photo-1518770660439-4636190af475', 'MA', '[{"url": "https://example.com/storage/projects/irigasi-iot/proposal.pdf", "type": "proposal", "title": "Proposal Proyek Irigasi IoT", "format": "pdf"}, {"url": "https://example.com/storage/projects/irigasi-iot/laporan-akhir.pdf", "type": "report", "title": "Laporan Akhir Proyek", "format": "pdf"}]', '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(2, 'Irigasi IoT MI', 'sains', 'Pengenalan sistem irigasi otomatis sederhana untuk siswa MI.', 'Tim MI', '2024-05-01', 'https://images.unsplash.com/photo-1518770660439-4636190af475', 'MA', '[{"url": "https://example.com/storage/projects/irigasi-iot/proposal.pdf", "type": "proposal", "title": "Proposal Proyek Irigasi IoT", "format": "pdf"}]', '2026-01-29 03:44:28', '2026-01-29 18:21:03'),
	(3, 'Robot Pembersih Masjid', 'Sains & Teknologi', 'Robot otomatis untuk membersihkan lantai masjid sekolah.', 'Ekstrakurikuler Robotik MA', '2024-04-01', 'https://images.unsplash.com/photo-1581091012184-5c7c41c6e0c6', 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(4, 'Aplikasi Hafalan Qur’an', 'Keagamaan', 'Aplikasi mobile untuk monitoring hafalan Al-Qur’an santri.', 'Tim Riset Kampus', '2024-04-01', 'https://images.unsplash.com/photo-1509021436665-8f07dbf5bf1d', 'KAMPUS', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(5, 'Komposter Digital Sekolah', 'Lingkungan', 'Pengolahan sampah organik sekolah berbasis sensor.', 'Tim MTs', '2024-03-01', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b', 'SMPT', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(6, 'Website Profil Sekolah', 'Teknologi Informasi', 'Pengembangan website profil sekolah berbasis React & Laravel.', 'Tim IT MA', '2024-03-01', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085', 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(7, 'Media Pembelajaran Interaktif MI', 'Pendidikan', 'Media pembelajaran berbasis animasi untuk siswa MI.', 'Guru MI', '2024-02-01', 'https://images.unsplash.com/photo-1513258496099-48168024aec0', 'MI', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(8, 'Sistem Absensi QR Code', 'Teknologi Informasi', 'Sistem absensi santri menggunakan QR Code dan dashboard web.', 'Tim MA', '2024-02-01', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c', 'MA', NULL, '2026-01-29 03:44:28', '2026-01-29 03:44:28'),
	(10, 'sdfg', 'Penelitian', 'sdf', 'sdf', '2026-01-30', 'http://localhost:8000/storage/projects/images/JGmMQVTQzBLJ1tfKQC4ksSe9mzOF77iJhCJZXRWC.jpg', 'MA', '[{"url": "http://localhost:8000/storage/projects/documents/uatPU9N0LFoPTa9lJ0thCNTUXN1ExaleMxntkpM3.docx", "type": "document", "title": "jadwal tenis meja", "format": "docx"}, {"url": "http://localhost:8000/storage/projects/documents/Kw89WhO7BP0UHzhbXQIsHv47xowIhKi7yMZpxqtB.docx", "type": "document", "title": "JUKNIS TENIS MEJA TUNGGAL SANTRI CUP", "format": "docx"}]', '2026-01-29 17:04:34', '2026-01-29 17:04:34'),
	(11, 'asfd', 'Sains & Teknologi', '<p>asfsda</p>', 'asdf', '2026-01-31', 'http://127.0.0.1:8000/storage/projects/images/IMKlu9mWvFuYTsEjyKZXyPXmcBwZEku8bG8zXARl.jpg', 'MA', '[{"url": "http://127.0.0.1:8000/storage/projects/documents/Mm5ZdYeJ1FpveIvwFO4rTdAA3Umb16r7rWBj7eEW.docx", "type": "document", "title": "jadwal tenis meja", "format": "docx"}]', '2026-01-29 17:16:34', '2026-01-31 16:45:25'),
	(12, 'a', 'Sains & Teknologi', 'aaaaaa', 'a', '2026-01-30', 'http://127.0.0.1:8000/storage/projects/images/aThNOd3Of1iwBjzykbtfBfeZ3LyX2u5iaHakKEDk.jpg', 'MA', '[{"url": "http://127.0.0.1:8000/storage/projects/documents/baWHyTj9b3yMFusLqfsk3jGmaZ5ovMgkHOVumk1c.docx", "type": "document", "title": "jadwal tenis meja", "format": "docx"}]', '2026-01-29 20:28:57', '2026-01-29 21:00:21'),
	(13, 'x', 'Inovasi', 'x', 'x', '2026-01-30', 'projects/images/01KG6TJ39KX41H6Z9PC1AQHEQ2.jpg', 'KAMPUS', '[{"url": "projects/documents/01KG6TJ3A09HR2P4BH2C1Q7R1B.pdf", "type": "document", "title": "x", "format": "tmp"}]', '2026-01-29 23:48:28', '2026-01-29 23:48:28');

-- membuang struktur untuk table unggul_bangsa.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.sessions: ~27 rows (lebih kurang)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('60ViPmsnnVgKpuuLrMqnIwx26DNjkcW1q8mIGGAv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlNCREpvV21GQk1kVDVzMmxZb0R2YTZXS3FkQWttdzZtZDhiQ3pSSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769920273),
	('6RIuvG1FHkPzH8AVugAMVpJ0ttIPlSGHhXZH2cdA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODJNNGZvamFZeXZQVHoxM1Y3elJnTEV5QW1nbnB3MHBvOHlQZFdCdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qZW5qYW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922575),
	('8leUBqnj1RZ8eBAXosY1xIxOYjF6CNIeKasecr9r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXVrejcwbEQweWJkOUNJU3ZkalZSOVN5MjVTZVRNUlZPNXBxcWd3NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9qZWN0cy9saW1pdC8yIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920284),
	('aiFQSOdhYTDAc8ZnZ3XloYeqbAYwb8fslgnu8HOF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjRCTHFEMFBCaWhtYTVDTEZETmNLT0lUZ1VpcEdMRTFCYTBkY0dydSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qZW5qYW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920261),
	('apRiXo7JEqERwBNXJDsaTSlEwiwrtk5Lp9ySYE9d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGJYeDQ4NXZGQjVIZ2pFZFA1RFVFWWE0NFRrRHV2eXQ2SEtVUTM2biI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qZW5qYW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922574),
	('BNrrnIV9V538XuWkuLrB6IGCRPuY6TWS5UZioU7l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1phMFloRmdSbjdkZUdHNGNDMkFBQ3A1Tzl1ZlZoUGd1Wm9JejNIYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qZW5qYW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769935122),
	('ct9IDytmfLsLnRegkexGkm95EJzxGF0HGX9Uan0g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXR2WXB2elk0U0E4S2dFRElNTUVsejFSUmduSDZuMzdwTXhEdTA1byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769922576),
	('CTiQH4xyrIXNgqsgO2eMqdwNg6wvkfxCwRXC2KWy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUVMb1czMTRNaWJCS3hpbk1hdFpqS1RHdUZTOEFYaEwzc0lUSEk4QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9qZWN0cy9saW1pdC8yIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769935125),
	('cwlG8DbkEDRF0cov5iB6IsaWjdsND5EdFdZpZIQc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXpDTHo2Q0lmaGc0UkUxbVh1dXgwU05sRGg0N2tFeGxKeUIweG5zcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769920293),
	('cxdqcyjpwnelqX0jPXCNbrjXMiTPNuMZO9DppezP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1dFcGtJT0dJSER0Y1k4RE9jVzl0U2Y2WGZRY1NaVXpGa2d4ZnM3OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9qZWN0cy9saW1pdC8yIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920269),
	('dwC6olGiNmbLVo4QTDSRYu9He42qZmDBzyWerKf5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkM5M3JiTmpjRVdmSDJvd05OSGJDRUFqRlNrYWVYdktsRWxTazZaYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9qZWN0cy9saW1pdC8yIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922577),
	('i3fEWfvO68S79l4qT6cF2qudS0Am4ndJsxDMzlRA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmtpWjVTT0FVV2RmSktpUHpsUTU4N2NOQXdwdGJ5bk5VYnhRdVMwQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscy9iZXN0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922578),
	('IRyPJwSRcO2x1hFwDrrxIWfZYiChLTa0MtjALR6P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFZnR09sRzg3ckU0c0FPYVZldWk1OTJBWGtldUlmZWtQVnVBZGhIZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscy9iZXN0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769935130),
	('JipKVNWeOuGstJ1JL4CyGLPgXgsDQZgNIjh6vRrM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1RqbEthVlBDaFdlNlgwakNISlZKVWxocXBIS1VCNjFwOThrV1J4diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769935163),
	('LkOwKfqnDNXyCqTBqEvV1CMOuZr2Ybs550yU92bz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmpxUGRxSzVqQVlZWFhOT1VQMU45UzRLaVp0TUlDV1N2TUd6YTc3SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qZW5qYW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920259),
	('m1hIB4KKvDjg7Yg1vDiY8Il1RBt5OLRlJMZOVfOV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkFBYkRZdkF4UVJ3RHlVWmJweUFoam9mVTFnZXg1U2dGMnRZUWFWZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769920262),
	('nSOKXbADIR7rbwyNpwtnkVuzx9gQEa34BeYolQNn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlZKc2xCa1RUWmpEcDJPalZmSjdac1lydXNNMzhWRTIxeklNOTFDSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769920277),
	('ODTDxG8q0yJpdHd6gjetb1bOzcMlcIaih0Srhm2Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGR6UlVDcnhHc0pUMm10ZTg2U2x2MWpRcktMc21Ya1R1MVF6R3h1NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769922577),
	('OGQCNuSe8KOJwI6468Hu2omGsg5Femrp09lb68jN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFczOVJ6MGx5SFdaeWN0cXhwdFhTazJ0MGZ2QlBySm9QV2NiZ3VkTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769935133),
	('RcJ3ObpApODvfgIYaDLxFrKIMhqGoAOL6H9cNidL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDJlQU1lWGJRZk9lbDgyWmFOZ0hGYWNqenhSbkhlMXhTTzdhaE5jSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9qZWN0cy9saW1pdC8yIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922579),
	('RSgwKwq8SPmXCgqOlOD645OqV4WLzLXjqfBVGTsu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3pqMUg4Vm5jY2pFc01sVHhlYU9UbVg0M1JGYm5ZSEdvZTJUUk9KdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769935128),
	('SYbntfLwUgrM4TnYgOuIBuDFwk1TnmXq6txDNxJM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSldubnAyblBqRTdrbnY3eFJkY05VY0FHR09yUExzVzhrQzBkOVlISyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9uZXdzL2xpbWl0LzMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769922581),
	('WOQekAzU0q9rC912jpwdAyvQkbaiD7Xif3qIorjc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVdjVWcyeEx6d2RwVE54YVYxeWg1NU9xMjJKTWlYd1c3T2QzdW96NSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscy9iZXN0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920281),
	('xbWq2PiIaTU12pkwtXhfxG4nnUUyDom0oAQgDdg7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiUDFrU3RpVGVNcDFuNGUxaEVsVTJQMmdhbUhNNGdsbTRBTWxyUVBXMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tZXNzYWdlcyI7czo1OiJyb3V0ZSI7czozOToiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLm1lc3NhZ2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjllYmUwODA0YmYwMWZlNTZlN2FjODQ4YjdmN2I2YzMzODBjYjAzMTdhZWM2NGM2NWJmNGExMDBiODEzMjA0NzMiO3M6NjoidGFibGVzIjthOjE6e3M6NDA6IjU4YzI4NDUyYzRlMTM0MmZjMmEwODdiNTdkOTUxOTU5X2NvbHVtbnMiO2E6Nzp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjQ6Im5hbWUiO3M6NToibGFiZWwiO3M6NDoiTmFtYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6ImNvbnRhY3RfaW5mbyI7czo1OiJsYWJlbCI7czo2OiJLb250YWsiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjg6ImNhdGVnb3J5IjtzOjU6ImxhYmVsIjtzOjg6IkthdGVnb3JpIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJ0eXBlIjtzOjU6ImxhYmVsIjtzOjQ6IlRpcGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6ImplbmphbmciO3M6NToibGFiZWwiO3M6NzoiSmVuamFuZyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTM6IkRpdGVyaW1hIHBhZGEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJyZXBsaWVkX2F0IjtzOjU6ImxhYmVsIjtzOjExOiJTZGggRGliYWxhcyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1769936557),
	('Y2NUyhvaTHTLi5j64k209rf3Vpi8Vfbgv9OngC4y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWVqa3RPYTZJVFA2NUFHVk5TV0RRZ0FPUmdRdzlLdHpZMjJ5clNwYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscy9iZXN0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769922576),
	('z55RrIChp87DG4GUdi2Bn2vhj9AGSX0vg4zWLoiv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVZCcFZ3T1Zmd1gxUGpxSXpBUGlKZnVZcW9udFJsZFNCTlNNblZzQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769922578),
	('ZGjsSe9JwcUnfE0ZfmDZ1vo4j2KeMZIGBBfFzkq1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFhtc3Bka1dwSVJzcmZWM3BGbVYzaTAxZllPbU9ubUNUemVqVTZHTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qb3VybmFscy9iZXN0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769920266);

-- membuang struktur untuk table unggul_bangsa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel unggul_bangsa.users: ~0 rows (lebih kurang)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@email.com', NULL, '$2y$12$P6Z2.cDNDl64IcydPSeXoOvyg5Y0MnWeg4mITrzsgh3/eKZ7brkte', NULL, '2026-01-29 04:29:14', '2026-01-29 04:29:14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
