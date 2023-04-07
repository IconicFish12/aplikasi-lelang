-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 11:09 AM
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
-- Database: `aplikasi_lelang`
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
-- Table structure for table `kontaks`
--

CREATE TABLE `kontaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_31_131508_create_barangs_table', 1),
(6, '2023_01_31_131537_create_lelangs_table', 1),
(7, '2023_01_31_131815_create_petugas_table', 1),
(8, '2023_01_31_133423_create_history_lelangs_table', 1),
(9, '2023_02_04_224058_create_penawarans_table', 1),
(10, '2023_02_04_225635_create_kategoris_table', 1),
(11, '2023_02_08_133015_create_pengajuan_lelangs_table', 1),
(12, '2023_02_13_093459_create_backup_barangs_table', 1),
(13, '2023_02_19_203010_create_kontaks_table', 1);

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
-- Table structure for table `tb_backup_barang`
--

CREATE TABLE `tb_backup_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `deskripsi_barang` longtext NOT NULL,
  `status_lelang` enum('ditutup','dibuka') NOT NULL DEFAULT 'ditutup',
  `proses` enum('belum','sedang','sudah') NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_backup_barang`
--

INSERT INTO `tb_backup_barang` (`id`, `kategori_id`, `nama_barang`, `harga_barang`, `deskripsi_barang`, `status_lelang`, `proses`, `created_at`, `updated_at`) VALUES
(1, 15, 'Enim rem modi sed quam.', '872456', 'Eum in et accusamus soluta non.', 'ditutup', 'sudah', '2023-03-12 04:41:53', '2023-03-12 04:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `deskripsi_barang` longtext NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_lelang` enum('ditutup','dibuka') NOT NULL DEFAULT 'ditutup',
  `proses` enum('belum','sedang','sudah') NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `user_id`, `kategori_id`, `nama_barang`, `harga_barang`, `deskripsi_barang`, `foto`, `status_lelang`, `proses`, `created_at`, `updated_at`) VALUES
(1, 3, 10, 'Doloremque quasi vel fugiat voluptatem laborum.', '165054', 'Suscipit possimus et libero rerum ut vero.', 'https://via.placeholder.com/1918x819.png/007766?text=electronics+accusantium', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(2, 2, 3, 'Nam ex quis distinctio ut.', '941257', 'Eos incidunt unde sequi explicabo perspiciatis eos ex.', 'https://via.placeholder.com/1918x819.png/00ff33?text=electronics+est', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(4, 3, 2, 'Autem dolore sint optio.', '938928', 'Veniam earum deserunt earum dolores. Et id nisi aut quam nesciunt rerum quisquam.', 'https://via.placeholder.com/1918x819.png/00aa88?text=electronics+ea', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(5, 1, 6, 'Vel magnam numquam consectetur.', '954098', 'Soluta eum dolorum asperiores expedita. Sint voluptas et doloremque facilis molestiae dolor.', 'https://via.placeholder.com/1918x819.png/0044bb?text=electronics+deserunt', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(6, 3, 4, 'Aspernatur et et earum repellendus dolorem.', '702524', 'Voluptas illo enim aperiam cupiditate esse. Consectetur sit aut recusandae quisquam culpa.', 'https://via.placeholder.com/1918x819.png/00eeaa?text=electronics+eos', 'dibuka', 'sedang', '2023-03-09 13:42:14', '2023-03-11 16:37:22'),
(7, 4, 10, 'Debitis sequi non repudiandae eius.', '114304', 'Eos dignissimos ducimus quo veniam recusandae.', 'https://via.placeholder.com/1918x819.png/00aa11?text=electronics+omnis', 'dibuka', 'sedang', '2023-03-09 13:42:14', '2023-03-11 16:37:41'),
(8, 1, 8, 'Dolor animi autem reiciendis sed quae.', '240604', 'Assumenda sunt ut esse consequatur omnis dolorem culpa.', 'https://via.placeholder.com/1918x819.png/00bb22?text=electronics+maiores', 'dibuka', 'sedang', '2023-03-09 13:42:14', '2023-03-11 16:37:04'),
(9, 2, 13, 'Similique quia dolorum dolorum.', '700518', 'Autem rem beatae dicta ex.', 'https://via.placeholder.com/1918x819.png/004433?text=electronics+qui', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(10, 3, 6, 'Aut debitis et ducimus.', '283442', 'Quis dignissimos enim repudiandae molestiae fugiat. Tempore facere accusantium quo commodi.', 'https://via.placeholder.com/1918x819.png/0088dd?text=electronics+aliquam', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(11, 2, 8, 'Neque quidem qui molestiae sit.', '929796', 'Nostrum totam voluptas et qui dicta est.', 'https://via.placeholder.com/1918x819.png/00eeee?text=electronics+neque', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(12, 3, 2, 'Non ducimus similique impedit nemo.', '432086', 'Voluptates consequatur laboriosam maiores. Consequatur atque consequatur quasi esse aperiam.', 'https://via.placeholder.com/1918x819.png/00aa55?text=electronics+recusandae', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(13, 1, 2, 'Molestias sapiente sed a delectus.', '146896', 'Quae sed ipsa quas qui. Ut voluptatem dolor culpa.', 'https://via.placeholder.com/1918x819.png/00bb99?text=electronics+velit', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(14, 4, 15, 'Iste blanditiis harum blanditiis explicabo.', '192835', 'Eligendi aut nesciunt consectetur soluta sapiente.', 'https://via.placeholder.com/1918x819.png/00bbcc?text=electronics+porro', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(15, 3, 2, 'Officiis atque consequatur omnis id.', '882454', 'Error ipsam in voluptate enim similique nesciunt ea.', 'https://via.placeholder.com/1918x819.png/008833?text=electronics+autem', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(16, 3, 10, 'Sequi iste corporis sed omnis quis tempore.', '418257', 'Deleniti tenetur enim ad enim. Earum voluptates repudiandae at tenetur necessitatibus hic maxime.', 'https://via.placeholder.com/1918x819.png/00ffbb?text=electronics+blanditiis', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(17, 3, 8, 'Unde rerum laboriosam esse aliquid.', '640255', 'Necessitatibus voluptatum at nobis in voluptas id fugiat.', 'https://via.placeholder.com/1918x819.png/005511?text=electronics+quo', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(18, 2, 8, 'Ipsam et dolorum atque id pariatur aut odit.', '397376', 'Qui fugit quis aut ea perferendis. Aut est placeat esse quis.', 'https://via.placeholder.com/1918x819.png/001199?text=electronics+tempora', 'ditutup', 'belum', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(19, 4, 1, 'Nemo est maiores inventore magni voluptas.', '907912', 'Velit repellendus est occaecati error quae.', 'https://via.placeholder.com/1918x819.png/00ff77?text=electronics+voluptatem', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(20, 4, 15, 'Minima deserunt quae et in ut fuga.', '479279', 'Aut rem quia sit soluta totam. Non facilis esse alias ut corporis sint voluptas iste.', 'https://via.placeholder.com/1918x819.png/0044ff?text=electronics+et', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(21, 4, 4, 'Voluptas non et enim quos fuga.', '827206', 'Voluptas optio doloremque accusantium fugit rerum voluptas optio.', 'https://via.placeholder.com/1918x819.png/0000ee?text=electronics+ut', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(22, 4, 2, 'Cupiditate natus consectetur ipsam.', '707963', 'Optio vel ut repellat suscipit sed dolore. Ducimus autem quo eos aliquam voluptatibus perferendis eum.', 'https://via.placeholder.com/1918x819.png/0022ee?text=electronics+a', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(23, 3, 11, 'Dolorem in non recusandae est eius exercitationem.', '589836', 'Ratione et est velit ut voluptatem nisi quia aliquid. Amet itaque ea illo.', 'https://via.placeholder.com/1918x819.png/004488?text=electronics+aut', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(24, 3, 1, 'Quia repudiandae eos nihil possimus id.', '750696', 'Ut alias omnis blanditiis ratione.', 'https://via.placeholder.com/1918x819.png/00dd66?text=electronics+itaque', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(25, 2, 12, 'Inventore voluptatem quam fugit nostrum fugit.', '928383', 'Rem omnis quo non id reprehenderit autem ipsam dolorum.', 'https://via.placeholder.com/1918x819.png/004499?text=electronics+in', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(26, 1, 13, 'Dolores et esse alias.', '237706', 'Sunt in ut et itaque doloremque ut.', 'https://via.placeholder.com/1918x819.png/0000dd?text=electronics+aut', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(27, 2, 2, 'Facilis cupiditate aut a doloremque velit.', '577389', 'Sunt placeat labore exercitationem. Ducimus aperiam temporibus est ad omnis aut.', 'https://via.placeholder.com/1918x819.png/00ffcc?text=electronics+voluptatem', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(28, 3, 2, 'Ex ut consectetur perferendis.', '228954', 'Est consectetur quis est et rerum commodi.', 'https://via.placeholder.com/1918x819.png/009988?text=electronics+aperiam', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(29, 2, 2, 'Omnis dignissimos occaecati soluta distinctio facere.', '287351', 'Libero mollitia et qui velit excepturi. Nesciunt velit ut qui voluptate.', 'https://via.placeholder.com/1918x819.png/006699?text=electronics+omnis', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15'),
(30, 3, 14, 'Ut dignissimos ea molestiae unde dolore voluptatem.', '631097', 'Ut ut ut quo soluta repudiandae nesciunt qui.', 'https://via.placeholder.com/1918x819.png/00bb11?text=electronics+optio', 'ditutup', 'belum', '2023-03-09 13:42:15', '2023-03-09 13:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_history_lelang`
--

CREATE TABLE `tb_history_lelang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `harga_lelang` varchar(255) NOT NULL,
  `tgl_lelang` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_history_lelang`
--

INSERT INTO `tb_history_lelang` (`id`, `kategori_id`, `petugas_id`, `user_id`, `nama_barang`, `harga_barang`, `harga_lelang`, `tgl_lelang`, `created_at`, `updated_at`) VALUES
(1, 15, 2, 1, 'Enim rem modi sed quam.', '872456', '875000', '2023-03-12', '2023-03-12 04:41:53', '2023-03-12 04:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Maxime et dignissimos.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(2, 'Adipisci voluptas odio.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(3, 'Animi incidunt.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(4, 'Laborum non.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(5, 'Ab dolorum.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(6, 'Rerum expedita enim.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(7, 'Explicabo et eius.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(8, 'Quia modi.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(9, 'Ipsam aut ea.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(10, 'Veritatis perspiciatis perferendis.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(11, 'Quis dolorum.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(12, 'Et provident.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(13, 'Est rerum distinctio.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(14, 'Et minus consequatur.', '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(15, 'Eius sapiente.', '2023-03-09 13:42:14', '2023-03-09 13:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `harga_awal` varchar(255) NOT NULL,
  `harga_lelang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_lelang`
--

INSERT INTO `tb_lelang` (`id`, `barang_id`, `user_id`, `petugas_id`, `tgl_mulai`, `tgl_selesai`, `tgl_lelang`, `harga_awal`, `harga_lelang`, `created_at`, `updated_at`) VALUES
(7, 8, NULL, NULL, '2023-03-11', '2023-03-16', NULL, '240604', NULL, '2023-03-11 16:37:04', '2023-03-11 16:37:04'),
(8, 6, NULL, NULL, '2023-03-11', '2023-03-16', NULL, '702524', NULL, '2023-03-11 16:37:22', '2023-03-11 16:37:22'),
(9, 7, NULL, NULL, '2023-03-11', '2023-03-17', NULL, '114304', NULL, '2023-03-11 16:37:41', '2023-03-11 16:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id`, `nama_lengkap`, `email`, `password`, `telp`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ibnu Syawal Aliefian', 'isyawalaliefian@gmail.com', '$2y$10$AWuqoHh8F1bDXNeqSnJDvuWH54PjijRzqkoqq.4xBKOyX0qt3DMES', '082162941198', NULL, NULL, NULL, NULL),
(2, 'Akhmad Alwan Rabbani', 'dragonchoroi@gmail.com', '$2y$10$gbTbJ.seH7LH51vH84nHr.YtYOEzdYXd3mcp3nDVvmoz8oD8CdR1q', '082162941194', NULL, NULL, NULL, NULL),
(3, 'Muhammad sholeh', 'alghoffarlutfi@gmail.com', '$2y$10$M3CJQrKfX8kZRAYRzggy/u79Xp3csQ5HE0YLk1CKGYLPu0V8nPohq', '082162941192', NULL, NULL, NULL, NULL),
(4, 'Muhammad Rezzqi Rabbani', 'blastergmly@gmail.com', '$2y$10$rlW9CD8Dg9c260IXzaRwbuNuZesSzFfrygYJsOmD6IWl7itkhW7.S', '082162941193', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penawaran`
--

CREATE TABLE `tb_penawaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `harga_penawaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan_lelangs`
--

CREATE TABLE `tb_pengajuan_lelangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `harga_lelang` int(11) NOT NULL,
  `lelang_dimulai` date NOT NULL,
  `lelang_diakhiri` date NOT NULL,
  `status_pengajuan` enum('disetujui','tidak_setujui') NOT NULL DEFAULT 'tidak_setujui',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pengajuan_lelangs`
--

INSERT INTO `tb_pengajuan_lelangs` (`id`, `user_id`, `kategori_id`, `nama_barang`, `harga_barang`, `harga_lelang`, `lelang_dimulai`, `lelang_diakhiri`, `status_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Changhong', 876000, 3000000, '2023-03-15', '2023-03-31', 'disetujui', '2023-03-12 04:57:20', '2023-03-12 05:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` longtext DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `telp` varchar(25) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id`, `nama_petugas`, `tgl_lahir`, `email`, `password`, `alamat`, `foto`, `telp`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Balamantri Maulana', '1972-10-27', 'yahya93@gmail.com', '$2y$10$mjlblVe0NeUXWONnlpZhcOBJNEEFaTTJWF76aqTu72mBYfToz4eI.', 'Kpg. Rajawali Barat No. 258, Bengkulu 62288, Malut, Administrasi Jakarta Barat', NULL, '0660 1039 5088', 'admin', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(2, 'Kemba Salahudin', '2008-06-22', 'cwidiastuti@yahoo.com', '$2y$10$oHYkQW0GxLG3hLeGq530Ae4ZUzFB9F5Qtg/DNWyhCekMIWQy2ZMFm', 'Jr. Setiabudhi No. 654, Padangpanjang 96612, Gorontalo, Depok', NULL, '0486 9168 5828', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(3, 'Farhunnisa Anggraini M.Kom.', '1975-06-05', 'andriani.rachel@yahoo.com', '$2y$10$sbDjduRg8AbFNA8e/YkrsOUoQ1/kc4OGIzHpbMtRNl/6tqEM5pnO6', 'Kpg. Jayawijaya No. 536, Administrasi Jakarta Selatan 83827, Kalbar, Metro', NULL, '(+62) 832 2227 5649', 'admin', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(4, 'Putri Oktaviani', '2022-02-23', 'shakila29@yahoo.com', '$2y$10$vJ9frO4BKsjHJL9y4spzEejES2zz1Tbf5GtpMO58kvxL5rVhiYgOy', 'Jln. Sutarjo No. 331, Tidore Kepulauan 87643, Jateng, Pangkal Pinang', NULL, '(+62) 223 1874 903', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(5, 'Novi Pertiwi S.H.', '1990-03-19', 'gading38@gmail.com', '$2y$10$kXmSeyRgU80Z8oeP5PJsV.q9tnoaBoKi8ixktYB2KoyrAt3s/qJJC', 'Dk. Bagas Pati No. 332, Tangerang 50788, DIY, Pariaman', NULL, '(+62) 254 4644 590', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(6, 'Tasnim Darman Dabukke S.H.', '1976-02-09', 'sinaga.ina@gmail.co.id', '$2y$10$IlbbHeyD8glHipjVomIZ2urm9mJdN4tLRyAubBBLtEtnz6vdnzRc2', 'Ds. Samanhudi No. 104, Bekasi 64889, DIY, Tomohon', NULL, '0762 4312 2651', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(7, 'Cecep Rosman Waskita', '1987-09-30', 'ulailasari@yahoo.co.id', '$2y$10$XnqFESvnusLSwNqvJjPYTe7WdXM1sWTZlUZrSzWM.VCtrwMrQilLm', 'Ds. Ters. Pasir Koja No. 792, Lubuklinggau 54279, Sulbar, Payakumbuh', NULL, '(+62) 896 0313 372', 'admin', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(8, 'Hana Pratiwi', '1985-02-25', 'darmanto51@gmail.co.id', '$2y$10$pTq1SNTzDUf6uBttBQdS0unY7xCxdLQ3Drq.YwERRpcBalTCjoYL2', 'Jln. Halim No. 622, Tomohon 98299, Banten, Prabumulih', NULL, '0332 5333 402', 'admin', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(9, 'Eva Ghaliyati Yolanda M.M.', '2016-03-15', 'mwidodo@gmail.com', '$2y$10$GPtAotKkKgCX2dwKJWZMYuCJcHCIApR/rLeueNQdu4A.Ekt7SHBEu', 'Ds. Flores No. 743, Pangkal Pinang 41451, Kepri, Tangerang Selatan', NULL, '0737 5628 675', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14'),
(10, 'Prasetya Sirait S.Kom', '2019-09-30', 'restu.maulana@yahoo.co.id', '$2y$10$BruIY9qnERwCN2e2MytWu./nOG.g.AEXxsng2jy8jo9uE9ABFEn7O', 'Gg. Gedebage Selatan No. 110, Banda Aceh 80245, Papua, Bitung', NULL, '(+62) 914 0236 634', 'petugas', NULL, NULL, '2023-03-09 13:42:14', '2023-03-09 13:42:14');

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
-- Indexes for table `kontaks`
--
ALTER TABLE `kontaks`
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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_backup_barang`
--
ALTER TABLE `tb_backup_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_history_lelang`
--
ALTER TABLE `tb_history_lelang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_masyarakat_email_unique` (`email`);

--
-- Indexes for table `tb_penawaran`
--
ALTER TABLE `tb_penawaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengajuan_lelangs`
--
ALTER TABLE `tb_pengajuan_lelangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontaks`
--
ALTER TABLE `kontaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_backup_barang`
--
ALTER TABLE `tb_backup_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_history_lelang`
--
ALTER TABLE `tb_history_lelang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_penawaran`
--
ALTER TABLE `tb_penawaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pengajuan_lelangs`
--
ALTER TABLE `tb_pengajuan_lelangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
