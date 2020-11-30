-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 12:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emi_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, '2020_11_29_060426_create_tbl_user_group', 1),
(5, '2020_11_29_063102_create_tbl_parent_menu', 1),
(6, '2020_11_29_064158_create_tbl_child_menu', 1),
(7, '2020_11_29_064538_create_tbl_sub_child_menu', 1),
(8, '2020_11_29_064810_create_tbl_menu_user_group', 1),
(9, '2020_11_29_070017_create_tbl_cache', 1);

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
-- Table structure for table `tbl_cache`
--

CREATE TABLE `tbl_cache` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cache_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cache`
--

INSERT INTO `tbl_cache` (`id`, `cache_name`, `id_user`, `created_at`, `updated_at`) VALUES
(30, 'parent-menu-index-page-1-pageselected-10-search--sortby-parent_position-sortdirection-asc-user-1', 1, '2020-11-30 04:26:19', '2020-11-30 04:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_menu`
--

CREATE TABLE `tbl_child_menu` (
  `id_child_menu` bigint(20) UNSIGNED NOT NULL,
  `id_parent_menu` bigint(20) NOT NULL,
  `nama_child_menu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_user_group`
--

CREATE TABLE `tbl_menu_user_group` (
  `id_menu_user_group` bigint(20) UNSIGNED NOT NULL,
  `id_user_group` bigint(20) NOT NULL,
  `id_parent_menu` bigint(20) NOT NULL,
  `id_child_menu` bigint(20) NOT NULL,
  `id_sub_child_menu` bigint(20) NOT NULL,
  `can_view` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_add` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_edit` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_delete` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent_menu`
--

CREATE TABLE `tbl_parent_menu` (
  `id_parent_menu` bigint(20) UNSIGNED NOT NULL,
  `parent_position` int(11) NOT NULL,
  `nama_parent_menu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_parent_menu`
--

INSERT INTO `tbl_parent_menu` (`id_parent_menu`, `parent_position`, `nama_parent_menu`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sales Order', 'sales-order', '', '1', '2020-11-30 04:12:31', '2020-11-30 04:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_child_menu`
--

CREATE TABLE `tbl_sub_child_menu` (
  `id_sub_child_menu` bigint(20) UNSIGNED NOT NULL,
  `id_child_menu` bigint(20) NOT NULL,
  `nama_sub_child_menu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `kd_user_wrs` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '397db0bc83f7a25cf99544b0c9a7a025',
  `nama_user` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user_group` bigint(20) NOT NULL,
  `id_dealer` bigint(20) NOT NULL DEFAULT 0,
  `id_dealer_level` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_access` int(11) NOT NULL DEFAULT 4,
  `status_atpm` enum('atpm','dealer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dealer',
  `is_from_wrs` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `kd_user_wrs`, `username`, `password`, `nama_user`, `email`, `id_user_group`, `id_dealer`, `id_dealer_level`, `level_access`, `status_atpm`, `is_from_wrs`, `status`, `created_at`, `updated_at`) VALUES
(1, '2011110100000000000000000008', 'roktavianus', '397db0bc83f7a25cf99544b0c9a7a025', 'Rafael Devy Oktavianus', 'roktavianus@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(2, '2012112100000000000000000001', 'berika', '397db0bc83f7a25cf99544b0c9a7a025', 'Benedictus Erika Montolalu', 'berika@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(3, '2011110100000000000000000011', 'sbinjamin', '397db0bc83f7a25cf99544b0c9a7a025', 'Surya Binjamin', 'sbinjamin@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(4, '2019091900000000000000000001', 'karina.dewi', '397db0bc83f7a25cf99544b0c9a7a025', 'KARINA DEWI', 'karina.dewi@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(5, '2012071200000000000000000001', 'sapto.mmi', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(6, '2015092300000000000000000001', 'mermawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Mariana Ermawan', 'mermawan@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(7, '2011120200000000000000000001', 'ssamudr1', '397db0bc83f7a25cf99544b0c9a7a025', 'Sadmego Samudro', 'ssamudr1@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(8, '2012080300000000000000000001', 'snishida', '397db0bc83f7a25cf99544b0c9a7a025', 'Shiro Nishida', 'snishida@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(9, '2013042300000000000000000001', 'dyusuf', '397db0bc83f7a25cf99544b0c9a7a025', 'Daniel Yusuf', 'dyusuf@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(10, '2012101800000000000000000001', 'vardinda', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman Ardinda', 'vardinda@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(11, '2014011700000000000000000001', 'awilliam', '397db0bc83f7a25cf99544b0c9a7a025', 'Alexander William Arief', 'awilliam@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(12, '2014011700000000000000000002', 'dnovita', '397db0bc83f7a25cf99544b0c9a7a025', 'Dian Novita', 'dnovita@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(13, '2013020700000000000000000001', 'hfaizal', '397db0bc83f7a25cf99544b0c9a7a025', 'Hanim Faizal', 'hfaizal@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(14, '2015012700000000000000000001', 'fpriadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Fiky Priadi', 'fpriadi@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(15, '2015033100000000000000000001', 'djaslim', '397db0bc83f7a25cf99544b0c9a7a025', 'Dania Karima Jaslim', 'dania.jaslim@star-indonesia.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(16, '2012020100000000000000000002', 'dpinurbo', '397db0bc83f7a25cf99544b0c9a7a025', 'Dharumas Pinurbo', 'dpinurbo_@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(17, '2015112600000000000000000001', 'dhidayat', '397db0bc83f7a25cf99544b0c9a7a025', 'Dennis', 'dhidayat@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(18, '2011110100000000000000000001', 'sadiwigati', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(19, '2016012100000000000000000001', 'gramadhan', '397db0bc83f7a25cf99544b0c9a7a025', 'Gilang Ramadhan', 'gramadhan@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:45', '2020-11-30 00:59:45'),
(20, '2016051600000000000000000001', 'herianto', '397db0bc83f7a25cf99544b0c9a7a025', 'Herianto', 'herianto@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(21, '2017021600000000000000000001', 'ricky', '397db0bc83f7a25cf99544b0c9a7a025', 'Ricky Thio', 'ricky@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(22, '2011072900000000000000000001', 'tampan', '397db0bc83f7a25cf99544b0c9a7a025', 'tampan', 'support@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(23, '2016071200000000000000000001', 'namanah', '397db0bc83f7a25cf99544b0c9a7a025', 'Novika Amanah Eka Sakti', 'namanah@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(24, '2017110200000000000000000001', 'denny.loka', '397db0bc83f7a25cf99544b0c9a7a025', 'Denny Loka Saputra', 'denny.loka@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(25, '2017080800000000000000000001', 'meistha.ramadhian', '397db0bc83f7a25cf99544b0c9a7a025', 'Meistha Ramadhian', 'meistha.ramadhian@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(26, '2017090600000000000000000001', 'nanggraini', '397db0bc83f7a25cf99544b0c9a7a025', 'Novita Anggraini', 'nanggraini@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(27, '2017100500000000000000000001', 'igor.panjaitan', '397db0bc83f7a25cf99544b0c9a7a025', 'Igor H O Panjaitan', 'igor.panjaitan@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(28, '2017101600000000000000000001', 'eangelika', '397db0bc83f7a25cf99544b0c9a7a025', 'Eprilia Angelika', 'eangelika@mazdaco.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(29, '2017030100000000000000000001', 'herlijoso', '397db0bc83f7a25cf99544b0c9a7a025', 'Constantinus Herlijoso', 'constantinus.herlijoso@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(30, '2017081500000000000000000001', 'yoel.lewi', '397db0bc83f7a25cf99544b0c9a7a025', 'Yoel Lewi Adi Prabowo', 'yoel.lewi@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(31, '2017070700000000000000000001', 'andri.widjaja', '397db0bc83f7a25cf99544b0c9a7a025', 'Andri Widjaja', 'andri.widjaja@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(32, '2017042000000000000000000001', 'hartono.setio', '397db0bc83f7a25cf99544b0c9a7a025', 'Hartono Setio', 'hartono.setio@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(33, '2017122800000000000000000001', 'angelina.sali', '397db0bc83f7a25cf99544b0c9a7a025', 'Angelina Sali', 'angelina.sali@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(34, '2018040400000000000000000001', 'pharibowo', '397db0bc83f7a25cf99544b0c9a7a025', 'Prasetyo Haribowo', 'pharibowo@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(35, '2018041800000000000000000001', 'leo.kusuma', '397db0bc83f7a25cf99544b0c9a7a025', 'Leo Kusuma', 'leo.kusuma@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(36, '2017121100000000000000000001', 'donny', '397db0bc83f7a25cf99544b0c9a7a025', 'Donny', 'donny@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(37, '2019041800000000000000000001', 'nagustina', '397db0bc83f7a25cf99544b0c9a7a025', 'Nensy Agustina', 'nensy.agustina@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(38, '2017092600000000000000000001', 'septyatha', '397db0bc83f7a25cf99544b0c9a7a025', 'septyatha', 'spetyatha@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(39, '2015061300000000000000000001', 'csatriatama', '397db0bc83f7a25cf99544b0c9a7a025', 'Canggih Satriatama', 'csatriatama@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(40, '2017092600000000000000000002', 'kenny.wala', '397db0bc83f7a25cf99544b0c9a7a025', 'Kenny Wala', 'kenny.wala@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(41, '2018080600000000000000000001', 'iman.gumelar', '397db0bc83f7a25cf99544b0c9a7a025', 'Iman Gumelar', 'iman.gumelar@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(42, '2017100200000000000000000001', 'andrew.yoseph', '397db0bc83f7a25cf99544b0c9a7a025', 'Andrew Yoseph', 'andrew.yoseph@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(43, '2019072300000000000000000001', 'roli.rusli', '397db0bc83f7a25cf99544b0c9a7a025', 'Roli Rusli', 'rrusli@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(44, '2019032800000000000000000001', 'mnurmuhaemin', '397db0bc83f7a25cf99544b0c9a7a025', 'Mohammad Nurmuhaemin', 'mohammad.nurmuhaemin@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:46', '2020-11-30 00:59:46'),
(45, '2019081900000000000000000001', 'tini.envy', '397db0bc83f7a25cf99544b0c9a7a025', 'Tini Envy', 'tini.envy@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(46, '2017111600000000000000000001', 'deddy.kurniawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Deddy Kurniawan Saputro', 'deddy.kurniawan@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(47, '2017110100000000000000000001', 'mhauwita', '397db0bc83f7a25cf99544b0c9a7a025', 'Martin Hauwita', 'martin.hauwita@mazda.co.id', 2, 0, NULL, 4, 'atpm', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(48, '2012072400000000000000000007', 'hasnan.hasjim', '397db0bc83f7a25cf99544b0c9a7a025', 'Hasnan Hasjim', 'hasnan.hasjim@kumalamotor.com', 3, 120, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(49, '2011112300000000000000000003', 'smklpgdg02', '397db0bc83f7a25cf99544b0c9a7a025', 'Yusack', 'yusack@eurokars.co.id', 3, 151, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(50, '2012072400000000000000000002', 'iqbal', '397db0bc83f7a25cf99544b0c9a7a025', 'Muhammad Iqbal', 'muhammad.iqbal@kumalamotor.com', 3, 120, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(51, '2011112300000000000000000001', 'bmklpgdg', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Kelapa Gading', 'ferania@eurokars.co.id', 3, 151, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(52, '2012070500000000000000000004', 'wisnu.bramadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Wisnu Bramadi', 'bramazda@gmail.com', 3, 140, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(53, '2012070500000000000000000005', 'judie.oktavianus', '397db0bc83f7a25cf99544b0c9a7a025', 'Judie Oktavianus', 'oktavianusjudie@yahoo.co.id', 3, 140, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(54, '2012070500000000000000000006', 'wahyu.priambodo', '397db0bc83f7a25cf99544b0c9a7a025', 'D. Wahyu Priambodo', 'wahyu_mazda@yahoo.co.id', 3, 140, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(55, '2012070500000000000000000007', 'lianda.rifani', '397db0bc83f7a25cf99544b0c9a7a025', 'Lianda Rifani', 'liandarifani@gmail.com', 3, 140, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(56, '2015051300000000000000000001', 'ziad.cholid', '397db0bc83f7a25cf99544b0c9a7a025', 'Ziad Cholid', 'ziad.cholid@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(57, '2012070500000000000000000010', 'prima.sari', '397db0bc83f7a25cf99544b0c9a7a025', 'Prima Sari', 'imoetprima@yahoo.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(58, '2012041100000000000000000005', 'susanto', '397db0bc83f7a25cf99544b0c9a7a025', 'Susanto', 'susanto@nusantara-group.co.id', 3, 220, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(59, '2012041000000000000000000002', 'amelia.sujana', '397db0bc83f7a25cf99544b0c9a7a025', 'Amelia Sujana', 'amelia.mazdacirebon@gmail.com', 3, 233, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(60, '2012070500000000000000000013', 'fani', '397db0bc83f7a25cf99544b0c9a7a025', 'M. Fani R', 'fanipsychologyhrd@yahoo.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(61, '2012062600000000000000000003', 'prayitno', '397db0bc83f7a25cf99544b0c9a7a025', 'Neo', 'admin@mazda-bali.com', 3, 160, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(62, '2012041000000000000000000007', 'margaret.limbert', '397db0bc83f7a25cf99544b0c9a7a025', 'Margaret Limbert', 'margaret_nusantara@yahoo.com', 3, 222, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:47', '2020-11-30 00:59:47'),
(63, '2012070600000000000000000001', 'sapto.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 221, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(64, '2012070500000000000000000008', 'dodi.putra', '397db0bc83f7a25cf99544b0c9a7a025', 'Dodi Putra', 'dodiprunama86@gmail.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(65, '2016021100000000000000000001', 'linda.adityawarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Linda Witanti', 'LindaW@eurokars.co.id', 3, 154, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(66, '2012070700000000000000000001', 'sapto.bjm', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 200, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(67, '2012041000000000000000000008', 'joe.surya', '397db0bc83f7a25cf99544b0c9a7a025', 'Joe Surya', 'joe_surya@nusantara-group.co.id', 3, 222, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(68, '2012070700000000000000000003', 'sapto.btr', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 223, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(69, '2012071200000000000000000002', 'sapto.btm', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 180, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(70, '2012071200000000000000000003', 'branchmanager', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager', 'branchmanager@mazdapekanbaru.com', 3, 110, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(71, '2014111000000000000000000001', 'ahmad.musyafak', '397db0bc83f7a25cf99544b0c9a7a025', 'Ahmad Musyafak', 'ahmad.mazdajatim@gmail.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(72, '2012041100000000000000000011', 'nata', '397db0bc83f7a25cf99544b0c9a7a025', 'Nata', 'nata_mazdabjm@nusantara-group.co.id', 3, 200, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(73, '2012041300000000000000000001', 'elly.rahmah.bjm', '397db0bc83f7a25cf99544b0c9a7a025', 'Elly Rahmah', 'e.rahmah@nusantara.co.id', 3, 200, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(74, '2012041300000000000000000002', 'elly.rahmah.bpp', '397db0bc83f7a25cf99544b0c9a7a025', 'Elly Rahmah', 'e.rahmah@nusantara.co.id', 3, 201, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(75, '2012041300000000000000000003', 'elly.rahmah.jmb', '397db0bc83f7a25cf99544b0c9a7a025', 'Elly Rahmah', 'e.rahmah@nusantara.co.id', 3, 211, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(76, '2012071600000000000000000003', 'anastasia.widji', '397db0bc83f7a25cf99544b0c9a7a025', 'Anastasia Widji', 'anastasia_wiwit@yahoo.com', 3, 202, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(77, '2012043000000000000000000003', 'rina.nurjanah', '397db0bc83f7a25cf99544b0c9a7a025', 'Rina Nurjanah', 'rinanur.mazdacirebon@gmail.com', 3, 233, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(78, '2012043000000000000000000008', 'ningsih', '397db0bc83f7a25cf99544b0c9a7a025', 'Ningsih', 'galician.mazdabandung@gmail.com', 3, 232, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:48', '2020-11-30 00:59:48'),
(79, '2015040100000000000000000001', 'linarjuan', '397db0bc83f7a25cf99544b0c9a7a025', 'Linarjuan Pratama', 'ar_mazdabatam@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(80, '2012071700000000000000000001', 'sapto.bpp', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 201, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(81, '2012071800000000000000000001', 'pin.hong', '397db0bc83f7a25cf99544b0c9a7a025', 'Pin Hong', 'pinhong@cmd.co.id', 3, 170, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(82, '2012050300000000000000000001', 'yandra1', '397db0bc83f7a25cf99544b0c9a7a025', 'Yandra', 'yandra_mazdajkt@nusantara-group.co.id', 3, 221, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(83, '2012041100000000000000000012', 'bobby.susanto', '397db0bc83f7a25cf99544b0c9a7a025', 'Bobby Susanto', 'bobbymazdaspg@gmail.com', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(84, '2012050300000000000000000002', 'yuyun.kurniawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Yuyun Kurniawan', 'y.kurniawan@nas.co.id', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(85, '2012071800000000000000000002', 'adelaide', '397db0bc83f7a25cf99544b0c9a7a025', 'Adelaide', 'adelaide.n@cmd.co.id', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(86, '2012071800000000000000000003', 'linda.salim', '397db0bc83f7a25cf99544b0c9a7a025', 'Linda Salim', 'linda.salim@cmd.co.id', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(87, '2012051400000000000000000001', 'kristiana', '397db0bc83f7a25cf99544b0c9a7a025', 'Kristiana', 'kristiana.mazdaplg@yahoo.co.id', 3, 210, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(88, '2012051400000000000000000002', 'tri.susilawati', '397db0bc83f7a25cf99544b0c9a7a025', 'Tri Susilawati', 'trimazdajambi@yahoo.co.id', 3, 211, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(89, '2012041100000000000000000008', 'sanna', '397db0bc83f7a25cf99544b0c9a7a025', 'Sanna', 'sanna2502@gmail.com', 3, 211, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(90, '2012041100000000000000000007', 'yandra', '397db0bc83f7a25cf99544b0c9a7a025', 'Yandra', 'yandra_mazdajkt@nusantara-group.co.id', 3, 220, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(91, '2012052200000000000000000001', 'iwan', '397db0bc83f7a25cf99544b0c9a7a025', 'Iwan S Macang', 'mazdabpp@yahoo.com', 3, 201, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(92, '2012052200000000000000000002', 'samad', '397db0bc83f7a25cf99544b0c9a7a025', 'Samad', 'samadmazda@gmail.com', 3, 201, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(93, '2012071800000000000000000004', 'dedy', '397db0bc83f7a25cf99544b0c9a7a025', 'Dedy', 'dedy_388@yahoo.com', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(94, '2012052200000000000000000004', 'juan', '397db0bc83f7a25cf99544b0c9a7a025', 'Juan', 'ahmadjuansyah@ymail.com', 3, 202, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(95, '2012071800000000000000000006', 'melly', '397db0bc83f7a25cf99544b0c9a7a025', 'Melly', 'melly.pina@cmd.co.id', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(96, '2012041100000000000000000002', 'amung.sarono.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'a.sarono@nusantara-group.co.id', 3, 221, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(97, '2012072400000000000000000001', 'sapto.mks', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 120, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(98, '2012052800000000000000000002', 'elly.rahmah.smd', '397db0bc83f7a25cf99544b0c9a7a025', 'Elly Rahmah', 'e.rahmah@nusantara.co.id', 3, 202, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(99, '2012052800000000000000000003', 'maria', '397db0bc83f7a25cf99544b0c9a7a025', 'maria', 'maria.adwiah@yahoo.com', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(100, '2014051300000000000000000001', 'aditya.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Aditya', 'aditya.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(101, '2012052800000000000000000004', 'tri.rahma', '397db0bc83f7a25cf99544b0c9a7a025', 'Tri Rahma', 'tribjm_mazda@yahoo.co.id', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(102, '2012052800000000000000000001', 'evy.khrisna', '397db0bc83f7a25cf99544b0c9a7a025', 'Evy Khrisna', 'evykhrisna@yahoo.com', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(103, '2012072400000000000000000005', 'anto', '397db0bc83f7a25cf99544b0c9a7a025', 'Anto', 'anto_mazda@kumalamotor.com', 3, 120, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(104, '2014050200000000000000000002', 'warsono', '397db0bc83f7a25cf99544b0c9a7a025', 'Warsono', 'onnowarsono@gmail.com', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(105, '2012061800000000000000000012', 'edy.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:49', '2020-11-30 00:59:49'),
(106, '2012052900000000000000000002', 'ahmad.yamani', '397db0bc83f7a25cf99544b0c9a7a025', 'Ahmad Yamani', 'ahmadyamani53@yahoo.co.id', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(107, '2012060100000000000000000001', 'lehong', '397db0bc83f7a25cf99544b0c9a7a025', 'Lehong', 'lehong@mazdapekanbaru.com', 3, 110, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(108, '2012062100000000000000000005', 'anwar', '397db0bc83f7a25cf99544b0c9a7a025', 'Anwar', 'c.anwar.mazdabandung@gmail.com', 3, 232, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(109, '2012062100000000000000000006', 'maurits', '397db0bc83f7a25cf99544b0c9a7a025', 'Maurits', 'mauritsmazdabandung@gmail.com', 3, 232, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(110, '2012062100000000000000000007', 'richard.liem', '397db0bc83f7a25cf99544b0c9a7a025', 'Richard Liem', 'Liem_richard73@yahoo.co.id', 3, 200, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(111, '2012060600000000000000000002', 'tjoa.sunyan', '397db0bc83f7a25cf99544b0c9a7a025', 'Tjoa Sun Yan', 't.yan@nusantara-group.co.id', 3, 222, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(112, '2012062200000000000000000001', 'sapto.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 231, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(113, '2012060600000000000000000003', 'triiswahyudi', '397db0bc83f7a25cf99544b0c9a7a025', 'Tri Iswahyudi', 'triiswahyudi@yahoo.com', 3, 222, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(114, '2012062200000000000000000002', 'tunjung', '397db0bc83f7a25cf99544b0c9a7a025', 'Tunjung', 'tnuzuardy@yahoo,co.id', 3, 200, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(115, '2014121000000000000000000002', 'meike.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Mieke', 'meike.wawolangi@nusantara-mazda.co.id', 3, 224, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(116, '2012060700000000000000000001', 'heni', '397db0bc83f7a25cf99544b0c9a7a025', 'Heni', 'heni.mazda.jogja@gmail.com', 3, 241, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(117, '2012060700000000000000000002', 'candria', '397db0bc83f7a25cf99544b0c9a7a025', 'Candria', 'candria.mk@gmail.com', 3, 242, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(118, '2012041000000000000000000012', 'sapto', '397db0bc83f7a25cf99544b0c9a7a025', 'sapto', 'sadiwigati@mazda.co.id', 3, 233, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(119, '2012060700000000000000000003', 'vaygor', '397db0bc83f7a25cf99544b0c9a7a025', 'Vaygor', 'vaygor@yahoo.com', 3, 249, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(120, '2012060700000000000000000004', 'agus.harjono.jgj', '397db0bc83f7a25cf99544b0c9a7a025', 'Agus Harjono', 'agus.harjono@gmail.com', 3, 241, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(121, '2012060700000000000000000005', 'agus.harjono.slo', '397db0bc83f7a25cf99544b0c9a7a025', 'Agus Harjono', 'agus.harjono@gmail.com', 3, 242, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(122, '2012060800000000000000000001', 'sari.slo', '397db0bc83f7a25cf99544b0c9a7a025', 'Sari', 'sari_auto@yahoo.co.id', 3, 242, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(123, '2012060800000000000000000002', 'sari.jgj', '397db0bc83f7a25cf99544b0c9a7a025', 'Sari', 'sari_auto@yahoo.co.id', 3, 241, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(124, '2012061000000000000000000005', 'jumin', '397db0bc83f7a25cf99544b0c9a7a025', 'Jumin', 'jumin@cmd.co.id', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(125, '2012061000000000000000000006', 'masnopo', '397db0bc83f7a25cf99544b0c9a7a025', 'Masnopo', 'masnopo@yahoo.com', 3, 170, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(126, '2012061000000000000000000007', 'eddi', '397db0bc83f7a25cf99544b0c9a7a025', 'Eddi', 'eddi_mazdamakassar@kumalamotor.com', 3, 120, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(127, '2012061000000000000000000008', 'nina', '397db0bc83f7a25cf99544b0c9a7a025', 'Nina', 'mazda.makassar@kumalamotor.com', 3, 120, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(128, '2012041100000000000000000009', 'merry.simon', '397db0bc83f7a25cf99544b0c9a7a025', 'Merry Simon', 'merry_mazda@yahoo.co.id', 3, 202, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(129, '2012061100000000000000000001', 'djunaedi', '397db0bc83f7a25cf99544b0c9a7a025', 'Djunaedi', 'djunaedi.h@gmail.com', 3, 230, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(130, '2015040800000000000000000001', 'fakhri', '397db0bc83f7a25cf99544b0c9a7a025', 'Fakhri', 'vardinda@mazda.co.id', 3, 500, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(131, '2012061200000000000000000004', 'junaika.sudrajat', '397db0bc83f7a25cf99544b0c9a7a025', 'Junaika Sudrajat', 'junaeka.mazdabogor@gmail.com', 3, 234, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:50', '2020-11-30 00:59:50'),
(132, '2014050200000000000000000003', 'sadiwigati.sby02', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 154, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(133, '2012052800000000000000000005', 'meike', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 200, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(134, '2012061300000000000000000002', 'meike.bpp', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 201, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(135, '2012061300000000000000000004', 'meike.smd', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 202, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(136, '2014082600000000000000000001', 'meike.rizki', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike Rizki', 'meikemazda@kumalamotor.com', 3, 120, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(137, '2012061300000000000000000010', 'rudi.kelana', '397db0bc83f7a25cf99544b0c9a7a025', 'Rudi Kelana', 'rudikelana.mazdajakarta@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(138, '2012061300000000000000000011', 'andrea.lo', '397db0bc83f7a25cf99544b0c9a7a025', 'Andrea Lo', 'andrea.mazdajaktim@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(139, '2012062200000000000000000009', 'fralensia', '397db0bc83f7a25cf99544b0c9a7a025', 'Fralensia', 'fralen.mazdabdg2@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(140, '2012062200000000000000000010', 'lis', '397db0bc83f7a25cf99544b0c9a7a025', 'Lis', 'lis.mazdabandung2@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(141, '2012062200000000000000000011', 'erjan', '397db0bc83f7a25cf99544b0c9a7a025', 'Erjan', 'erjanmazdabandung1@gmail.com', 3, 231, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(142, '2012062200000000000000000006', 'adhian', '397db0bc83f7a25cf99544b0c9a7a025', 'Adhian', 'adhian.mazda@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(143, '2012061800000000000000000001', 'devi.windiawaty', '397db0bc83f7a25cf99544b0c9a7a025', 'Devi Windiawaty', 'd.windiawaty@nusantara-group.co.id', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(144, '2012061800000000000000000003', 'andy.widjaja', '397db0bc83f7a25cf99544b0c9a7a025', 'Andy Widjaja', 'a.widjaja@nusantara-group.co.id', 3, 223, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(145, '2012061300000000000000000001', 'meike.plb', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 210, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(146, '2012041100000000000000000014', 'tri.iswahyudi', '397db0bc83f7a25cf99544b0c9a7a025', 'Tri Iswahyudi', 'triiswahyudi@yahoo.com', 3, 220, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(147, '2012062200000000000000000005', 'unggul', '397db0bc83f7a25cf99544b0c9a7a025', 'Unggul', 'unggul.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(148, '2012062500000000000000000001', 'sapto.bali', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 160, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(149, '2012062600000000000000000001', 'sonny', '397db0bc83f7a25cf99544b0c9a7a025', 'Sonny', 'admin@mazda-bali.com', 3, 160, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(150, '2012062600000000000000000002', 'sin', '397db0bc83f7a25cf99544b0c9a7a025', 'Sin', 'sin888@balikitamotor.co.id', 3, 160, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(151, '2012062000000000000000000003', 'eka.pramana', '397db0bc83f7a25cf99544b0c9a7a025', 'Eka Pramana', 'mr3k4.mazda@gmail.com', 3, 233, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(152, '2012062000000000000000000004', 'wisa.samdani', '397db0bc83f7a25cf99544b0c9a7a025', 'Wisa Samdani', 'wisa.mazdacirebon@gmail.com', 3, 233, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(153, '2012062000000000000000000002', 'prana.arista', '397db0bc83f7a25cf99544b0c9a7a025', 'Prana Arista', 'prana.mazdacrb@gmail.com', 3, 233, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(154, '2012062000000000000000000006', 'reza.fachrizal', '397db0bc83f7a25cf99544b0c9a7a025', 'Reza Fachrizal', 'reza.mazdacirebon@gmail.com', 3, 233, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(155, '2012062100000000000000000001', 'imroatul', '397db0bc83f7a25cf99544b0c9a7a025', 'Imroatul', 'imroatul.mazdabandung@gmail.com', 3, 232, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(156, '2012062100000000000000000003', 'dewi.nur', '397db0bc83f7a25cf99544b0c9a7a025', 'Dewi Nur', 'dewinur.mazdabandung@gmail.com', 3, 232, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(157, '2012062100000000000000000004', 'sapto.crb', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 233, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(158, '2012061800000000000000000005', 'edy.jmb', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 211, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(159, '2012061800000000000000000006', 'edy.plb', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 210, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(160, '2012061800000000000000000007', 'edy.bpp', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 201, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:51', '2020-11-30 00:59:51'),
(161, '2012061800000000000000000008', 'edy.smd', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 202, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(162, '2012061800000000000000000009', 'edy.pcg', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 220, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(163, '2012061800000000000000000010', 'edy.spn', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 222, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(164, '2012061800000000000000000011', 'edy.btr', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy_mazdabjm@nusantara-group.co.id', 3, 223, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(165, '2012062100000000000000000002', 'sapto.bdg1', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 232, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(166, '2014042200000000000000000011', 'hwibowo.mth', '397db0bc83f7a25cf99544b0c9a7a025', 'Haris Wibowo', 'hrd.hariswibowo@yahoo.co.id', 3, 263, 'HS', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(167, '2012062200000000000000000004', 'Ajat', '397db0bc83f7a25cf99544b0c9a7a025', 'Ajat', 'ajat.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(168, '2012080300000000000000000002', 'sapto.smg', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 240, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(169, '2012041000000000000000000014', 'lie.miekowiguna', '397db0bc83f7a25cf99544b0c9a7a025', 'Lie Mieko Wiguna', 'liemieko@yahoo.co.id', 3, 240, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(170, '2012041000000000000000000006', 'lisa', '397db0bc83f7a25cf99544b0c9a7a025', 'Lisa', 'elisabethkusuma@gmail.com', 3, 240, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(171, '2012041000000000000000000003', 'johanes.handoko', '397db0bc83f7a25cf99544b0c9a7a025', 'Johanes Handoko', 'johanes.handoko@gmail.com', 3, 240, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(172, '2012041000000000000000000013', 'bambang.pirngadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang Pirngadi', 'bambangpirngadi@yahoo.com', 3, 240, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(173, '2012041000000000000000000005', 'sari', '397db0bc83f7a25cf99544b0c9a7a025', 'Sari', 'sari_auto@yahoo.co.id', 3, 240, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(174, '2012041000000000000000000004', 'agus.harjono', '397db0bc83f7a25cf99544b0c9a7a025', 'Agus Harjono', 'agus.harjono@gmail.com', 3, 240, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(175, '2012080300000000000000000004', 'priyatna.jktm', '397db0bc83f7a25cf99544b0c9a7a025', 'Priyatna', 'mazdajaktim.sp@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(176, '2012080300000000000000000005', 'sapto.plt', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 250, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(177, '2012070500000000000000000001', 'sapto.jtm', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 140, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(178, '2012070500000000000000000002', 'sapto.mdn', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 170, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(179, '2015120700000000000000000001', 'andriyanto.235', '397db0bc83f7a25cf99544b0c9a7a025', 'Andriyanto', 'andriyanto.mazda@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:52', '2020-11-30 00:59:52'),
(180, '2012080800000000000000000004', 'lexi.alexander', '397db0bc83f7a25cf99544b0c9a7a025', 'Lexi Alexander Marua', 'lexi.marua@yahoo.com', 3, 280, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(181, '2012080800000000000000000006', 'jonan.rahardjo', '397db0bc83f7a25cf99544b0c9a7a025', 'Jonan Rahardjo', 'jonan_rahardjo@yahoo.com', 3, 280, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(182, '2012080900000000000000000001', 'elyzabeth.arvian', '397db0bc83f7a25cf99544b0c9a7a025', 'Elyzabeth Arvian Roring', 'lisamazda23@gmail.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(183, '2015121600000000000000000001', 'pandu.waskita.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Pandu Waskita', 'henckey@yahoo.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(184, '2012081200000000000000000001', 'sapto.ptk', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 270, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(185, '2012081300000000000000000001', 'kencana', '397db0bc83f7a25cf99544b0c9a7a025', 'Kencana', 'kcm_ptk@yahoo.co.id', 3, 270, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(186, '2012081300000000000000000002', 'muliawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Muliawan', 'tedyatmaja@hotmail.com', 3, 270, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(187, '2012070500000000000000000011', 'michael', '397db0bc83f7a25cf99544b0c9a7a025', 'Michael C.H', 'michael@mazdajawatimur.com', 3, 140, 'GM', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(188, '2012072400000000000000000003', 'michael.alfons', '397db0bc83f7a25cf99544b0c9a7a025', 'Michael Alfons', 'michael.alfons@kumalamotor.com', 3, 120, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(189, '2012083000000000000000000001', 'apisesa', '397db0bc83f7a25cf99544b0c9a7a025', 'Andik Pisesa', 'apisesa@mazda.co.id', 3, 500, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(190, '2012041000000000000000000016', 'guntur.setya', '397db0bc83f7a25cf99544b0c9a7a025', 'Guntur Setyawan', 'setyawanguntur@yahoo.com', 3, 241, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(191, '2012083000000000000000000002', 'ssamudr1', '397db0bc83f7a25cf99544b0c9a7a025', 'Sadmego Samudro', 'ssamudr1@mazda.co.id', 3, 500, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(192, '2012090600000000000000000001', 'virman.mks', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 120, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(193, '2012072400000000000000000006', 'jacky', '397db0bc83f7a25cf99544b0c9a7a025', 'Jacky', 'jacky_mazda@yahoo.com', 3, 120, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(194, '2012071200000000000000000004', 'sapto.mmi', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 500, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(195, '2012101200000000000000000003', 'merryana', '397db0bc83f7a25cf99544b0c9a7a025', 'Merryana', 'admsales@mazdalampung.com', 3, 281, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:53', '2020-11-30 00:59:53'),
(196, '2012101300000000000000000001', 'maulida.mansyuri', '397db0bc83f7a25cf99544b0c9a7a025', 'Maulida Mansyuri', 'spv_sls2@mazdalampung.com', 3, 281, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(197, '2012100300000000000000000001', 'abdul.mujib', '397db0bc83f7a25cf99544b0c9a7a025', 'Abdul Mujib', 'mujibmazda@gmail.com', 3, 140, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(198, '2012101200000000000000000004', 'indra.setiawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Indra Setiawan', 'sps_sls1@mazdalampung.com', 3, 281, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(199, '2012103000000000000000000001', 'liani.febriani', '397db0bc83f7a25cf99544b0c9a7a025', 'Liany Febriani', 'lianyfebriani@gmail.com', 3, 281, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(200, '2012051000000000000000000001', 'sapto2', '397db0bc83f7a25cf99544b0c9a7a025', 'sapto2', 'sadiwigati@mazda.co.id', 3, 151, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(201, '2012112200000000000000000001', 'sapto.pdg', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 290, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(202, '2012112200000000000000000005', 'adriany.nurman', '397db0bc83f7a25cf99544b0c9a7a025', 'Adriany Nurman', 'nurman_adriany@yahoo.com', 3, 290, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(203, '2012112300000000000000000001', 'sutrisno.wijaya', '397db0bc83f7a25cf99544b0c9a7a025', 'Sutrisno Wijaya', 'sutrisno_wjy@yahoo.com', 3, 290, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(204, '2012112900000000000000000001', 'gumarus.sukito', '397db0bc83f7a25cf99544b0c9a7a025', 'Gumarus Sukito', 'gums.mazdabandung@gmail.com', 3, 232, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(205, '2012101200000000000000000002', 'benny.sugiono', '397db0bc83f7a25cf99544b0c9a7a025', 'Benny Sugiono', 'benny@mazdalampung.com', 3, 281, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(206, '2012121900000000000000000002', 'eka.fitria', '397db0bc83f7a25cf99544b0c9a7a025', 'Eka Fitria', 'ekafitria.mazdabandung2@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(207, '2012122000000000000000000001', 'hardi.gouw', '397db0bc83f7a25cf99544b0c9a7a025', 'Hardi Gouw', 'hardigouw.mazdajaktim@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(208, '2012083100000000000000000002', 'virman.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 231, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(209, '2012061200000000000000000003', 'bambang.sujatmiko', '397db0bc83f7a25cf99544b0c9a7a025', 'RM Bambang Sujatmiko', 'rmb.mazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(210, '2012112200000000000000000003', 'andri.martha', '397db0bc83f7a25cf99544b0c9a7a025', 'Andri Martha', 'andri_0396@yahoo.com', 3, 290, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(211, '2013020100000000000000000001', 'virman.jtm', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman Ardinda', 'support@mazda.co.id', 3, 140, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(212, '2012041000000000000000000017', 'herry.ch', '397db0bc83f7a25cf99544b0c9a7a025', 'Herry CH', 'herry.mazdasolo@gmail.com', 3, 242, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(213, '2013021100000000000000000002', 'wongso.darno.pdg', '397db0bc83f7a25cf99544b0c9a7a025', 'Wongso Darno', 'wongsodarno@gmail.com', 3, 290, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(214, '2012061000000000000000000002', 'putu.suryani', '397db0bc83f7a25cf99544b0c9a7a025', 'putu.suryani', 'backoffice@mazda-bali.com', 3, 160, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(215, '2013021800000000000000000001', 'suhud.budiman', '397db0bc83f7a25cf99544b0c9a7a025', 'Suhud Budiman', 'budi@mazda-bali.com', 3, 160, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(216, '2013021800000000000000000003', 'suhud.budiman02', '397db0bc83f7a25cf99544b0c9a7a025', 'Suhud Budiman', 'budi@mazda-bali.com', 3, 161, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(217, '2013021900000000000000000002', 'muhamad.ekhsan', '397db0bc83f7a25cf99544b0c9a7a025', 'Muhamad Ekhsan', 'Muhamad.ekhsan@yahoo.com', 3, 262, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(218, '2013021900000000000000000004', 'iwan.tarmizi', '397db0bc83f7a25cf99544b0c9a7a025', 'Iwan Tarmizi', 'Iwan.tarmizi@mazdathamrin.com', 3, 262, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(219, '2013021900000000000000000005', 'haryadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Haryadi', 'Haryadi.monoarfa@mazdathamrin.com', 3, 262, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(220, '2013022000000000000000000001', 'adminmenteng', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Menteng', 'nonearie@yahoo.co.id', 3, 261, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(221, '2013022000000000000000000002', 'bmmenteng', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Menteng', 'finance.mazdathamrin@gmail.com', 3, 261, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(222, '2014051300000000000000000003', 'sukron.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Sukron', 'sukron80.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(223, '2014112100000000000000000002', 'rani.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'rudi rosadi', 'rudirosa81@gmail.com', 3, 221, 'AS', 4, 'dealer', '1', '1', '2020-11-30 00:59:54', '2020-11-30 00:59:54'),
(224, '2015120100000000000000000002', 'mujianto', '397db0bc83f7a25cf99544b0c9a7a025', 'Mujianto', 'muji1571mj@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(225, '2012080800000000000000000001', 'sapto.bks', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 280, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(226, '2011110800000000000000000001', 'hrdtham', '397db0bc83f7a25cf99544b0c9a7a025', 'HRD Thamrin', 'nonearie@yahoo.co.id', 3, 260, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(227, '2012061800000000000000000002', 'raymond', '397db0bc83f7a25cf99544b0c9a7a025', 'Raymond SW', 'raymond.sianik@yahoo.com', 3, 221, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(228, '2013032000000000000000000001', 'hadi.winoto', '397db0bc83f7a25cf99544b0c9a7a025', 'Hadi Winoto', 'winoto.hadi@gmail.com', 3, 261, 'GM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(229, '2013032000000000000000000002', 'johan.liem', '397db0bc83f7a25cf99544b0c9a7a025', 'Johan Liem', 'finance.mazdathamrin@gmail.com', 3, 261, 'FIN', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(230, '2013032000000000000000000004', 'salesmenteng', '397db0bc83f7a25cf99544b0c9a7a025', 'Sales Only', 'mazdamenteng@gmail.com', 3, 261, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(231, '2013032000000000000000000006', 'ike.pratiwi', '397db0bc83f7a25cf99544b0c9a7a025', 'Ike Pratiwi', 'hrd_mazdamenteng@yahoo.com', 3, 261, 'HS', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(232, '2013032000000000000000000009', 'rpurnamasari', '397db0bc83f7a25cf99544b0c9a7a025', 'Rita Purnamasari', 'puguh.priambada@mazdathamrin.com', 3, 261, 'AS', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(233, '2013041100000000000000000001', 'asiswoyo', '397db0bc83f7a25cf99544b0c9a7a025', 'Aris Siswoyo', 'arismazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(234, '2013041600000000000000000001', 'gede.eka', '397db0bc83f7a25cf99544b0c9a7a025', 'Gede Eka', 'gede.eka@mazda-bali.co.id', 3, 161, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(235, '2016010400000000000000000002', 'bnuryanto.DPK', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang', 'bnuryanto@mazda.co.id', 3, 262, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55');
INSERT INTO `tbl_user` (`id_user`, `kd_user_wrs`, `username`, `password`, `nama_user`, `email`, `id_user_group`, `id_dealer`, `id_dealer_level`, `level_access`, `status_atpm`, `is_from_wrs`, `status`, `created_at`, `updated_at`) VALUES
(236, '2012073100000000000000000001', 'virman.bdg', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 232, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(237, '2012072300000000000000000001', 'rusli.kurniawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Rusli Kurniawan', 'rusli@majestygroup.co.id', 3, 180, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(238, '2012090300000000000000000001', 'linda', '397db0bc83f7a25cf99544b0c9a7a025', 'Linda', 'linda@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(239, '2013032000000000000000000003', 'martind', '397db0bc83f7a25cf99544b0c9a7a025', 'Martin Dewanta', 'mazdamenteng@gmail.com', 3, 261, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(240, '2014070300000000000000000003', 'johan.depok', '397db0bc83f7a25cf99544b0c9a7a025', 'Johan Liem', 'finance.mazdathamrin@gmail.com', 3, 262, 'FM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(241, '2014040800000000000000000001', 'renny', '397db0bc83f7a25cf99544b0c9a7a025', 'Renny', 'renny.damayanti@mazdathamrin.com', 3, 260, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(242, '2012090300000000000000000002', 'rumina', '397db0bc83f7a25cf99544b0c9a7a025', 'Dina', 'ar_mazdabatam@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(243, '2012062000000000000000000005', 'ika.nasykah', '397db0bc83f7a25cf99544b0c9a7a025', 'Ika Nasykah', 'ika.mazdacirebon@gmail.com', 3, 233, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(244, '2015021700000000000000000001', 'virna.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Virna F.Q', 'virna.mazdabandung2@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(245, '2013052900000000000000000001', 'felix.dono', '397db0bc83f7a25cf99544b0c9a7a025', 'Felix Dono Suryo Prasetyo', 'felix80mazdajaktim@gmail.com', 3, 230, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(246, '2013053100000000000000000001', 'sin.bali02', '397db0bc83f7a25cf99544b0c9a7a025', 'Sin', 'sin888@balikitamotor.co.id', 3, 161, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(247, '2013053100000000000000000002', 'virman.bali', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 160, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(248, '2013070100000000000000000002', 'sapto.tham', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 260, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:55', '2020-11-30 00:59:55'),
(249, '2013070100000000000000000003', 'sapto.jakbar', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 100, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(250, '2013041600000000000000000002', 'yurike.kusen', '397db0bc83f7a25cf99544b0c9a7a025', 'Yuri Kusen', 'yuri@mazda-bali.co.id', 3, 161, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(251, '2013021800000000000000000004', 'didit.andrea', '397db0bc83f7a25cf99544b0c9a7a025', 'Didit Andrea', 'budi@mazda-bali.com', 3, 161, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(252, '2013061100000000000000000001', 'rdermawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Ricky Dermawan', 'ricky.dermawan@gmail.com', 3, 281, 'FM', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(253, '2013070500000000000000000001', 'indah', '397db0bc83f7a25cf99544b0c9a7a025', 'Indah Rakhmawati', 'admin@mazda-bali.com', 3, 160, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(254, '2013070800000000000000000002', 'astria.dewi', '397db0bc83f7a25cf99544b0c9a7a025', 'Astria Dewi', 'astria.mazda.cibubur@gmail.com', 3, 235, 'AH', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(255, '2013070800000000000000000005', 'dian.wibowo', '397db0bc83f7a25cf99544b0c9a7a025', 'Dian Bowo Winanto', 'dianbowo.mazdacibubur@gmail.com', 3, 235, 'HoS', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(256, '2014051300000000000000000004', 'aryo.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Aryo', 'aryomazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(257, '2013070800000000000000000003', 'khaled.arafah01', '397db0bc83f7a25cf99544b0c9a7a025', 'Khaled Arafah Maulida', 'ale.mazdastm@gmail.com', 3, 235, 'HoS', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(258, '2013070800000000000000000004', 'aris.siswoyo', '397db0bc83f7a25cf99544b0c9a7a025', 'Aris Siswoyo', 'aris.mazdastm@gmail.com', 3, 235, 'HoS', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(259, '2013072200000000000000000002', 'indra.setiwan', '397db0bc83f7a25cf99544b0c9a7a025', 'Indra Setiwan', 'indra.mazdacibubur@gmail.com', 3, 235, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(260, '2013072400000000000000000001', 'arief.pribadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Arief Septi Pribadi', 'areifmazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(261, '2012083100000000000000000001', 'vardinda', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 500, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(262, '2015051300000000000000000002', 'hery.purwanto', '397db0bc83f7a25cf99544b0c9a7a025', 'Hery Purwanto', 'hery.purwanto@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(263, '2013072600000000000000000001', 'virman.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 235, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(264, '2018081500000000000000000001', '235.spv02', '397db0bc83f7a25cf99544b0c9a7a025', 'ELICE', 'alice_erisu@yahoo.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(265, '2013090400000000000000000003', 'yanti.lestari', '397db0bc83f7a25cf99544b0c9a7a025', 'Yanti Lestari', 'yanti.lestari@eurokars.co.id', 3, 153, 'AS', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(266, '2013091600000000000000000001', 'jtobing', '397db0bc83f7a25cf99544b0c9a7a025', 'Joshua Lumban Tobing', 'jhosualumbantobing@yahoo.com', 3, 262, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(267, '2013032000000000000000000005', 'rume.rasita', '397db0bc83f7a25cf99544b0c9a7a025', 'Rume Rasita', 'rumerasita@yahoo.co.id', 3, 261, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 00:59:56', '2020-11-30 00:59:56'),
(268, '2013070100000000000000000001', 'rume.thamrin', '397db0bc83f7a25cf99544b0c9a7a025', 'Rume Rasita', 'rumerasita@yahoo.co.id', 3, 260, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(269, '2013040300000000000000000001', 'rrasita.depok', '397db0bc83f7a25cf99544b0c9a7a025', 'Rume Rasita', 'rumerasita@yahoo.co.id', 3, 262, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(270, '2012080800000000000000000005', 'greasi.esterlyta', '397db0bc83f7a25cf99544b0c9a7a025', 'Yanti Laia', 'yanti_laia@yahoo.co.id', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(271, '2012052200000000000000000003', 'sofyan', '397db0bc83f7a25cf99544b0c9a7a025', 'Mohamad Sofyan Noor', 'mohamad.noor@nusantara-mazda.co.id', 3, 202, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(272, '2012061300000000000000000003', 'meike.jmb', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 211, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(273, '2013041800000000000000000001', 'fani.ruswanda', '397db0bc83f7a25cf99544b0c9a7a025', 'Fani Ruswandana', 'fani_ruswandana@yahoo.com', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(274, '2013100400000000000000000001', 'radriansyah', '397db0bc83f7a25cf99544b0c9a7a025', 'Roy Adriansyah', 'roy.mazdastm@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(275, '2013100400000000000000000002', 'hsimon', '397db0bc83f7a25cf99544b0c9a7a025', 'Henryco Simon', 'henryco.mazda@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(276, '2014093000000000000000000001', 'ivernanda.jktm', '397db0bc83f7a25cf99544b0c9a7a025', 'Irina Vernanda', 'Irina.mazdajaktim@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(277, '2013101800000000000000000002', 'rsasono', '397db0bc83f7a25cf99544b0c9a7a025', 'Roosman Sasono', 'roosman.sasono@eurokars.co.id', 3, 153, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(278, '2013101800000000000000000001', 'mkristanti', '397db0bc83f7a25cf99544b0c9a7a025', 'Margareth Kristanti', 'margareth.kristanti@eurokars.co.id', 3, 153, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(279, '2013102800000000000000000001', 'sumiyati', '397db0bc83f7a25cf99544b0c9a7a025', 'Sumiyati', 'sumiyati@eurokars.co.id', 3, 153, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(280, '2013081500000000000000000001', 'susi', '397db0bc83f7a25cf99544b0c9a7a025', 'Susi', 'lehong@mazdapekanbaru.com', 3, 110, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(281, '2014051300000000000000000005', 'dody.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Dody Iskandar', 'dodyis.mazda@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(282, '2012101200000000000000000001', 'virman.plb', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'ardindaviman@yahoo.com', 3, 210, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(283, '2013110700000000000000000001', 'sandy', '397db0bc83f7a25cf99544b0c9a7a025', 'Sandy Tirtokusumo', 'sandy.tirtokusumo@eurokars.co.id', 3, 153, 'GM', 4, 'dealer', '1', '1', '2020-11-30 00:59:57', '2020-11-30 00:59:57'),
(284, '2013111400000000000000000001', 'virman.str', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 153, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(285, '2013112200000000000000000001', 'sapto.suryo', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwiati', 'sadiwigati@mazda.co.id', 3, 222, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(286, '2013081500000000000000000002', 'selamat', '397db0bc83f7a25cf99544b0c9a7a025', 'Selamat', 'lehong@mazdapekanbaru.com', 3, 110, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(287, '2012061800000000000000000004', 'meike.pcg', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 220, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(288, '2014042200000000000000000002', 'bsatrya', '397db0bc83f7a25cf99544b0c9a7a025', 'Budi Satrya', 'Budhi.Satrya@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(289, '2013082700000000000000000002', 'aditia.perdana', '397db0bc83f7a25cf99544b0c9a7a025', 'Aditia Perdana', 'aditia.perdana@eurokars.co.id', 3, 152, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(290, '2013120200000000000000000001', 'sapto.jaksel', '397db0bc83f7a25cf99544b0c9a7a025', 'sapto.jaksel', 'sadiwigati@mazda.co.id', 3, 152, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(291, '2015041600000000000000000001', 'nety.tangerang', '397db0bc83f7a25cf99544b0c9a7a025', 'Nety Srihartanti', 'netysrihartanti@gmail.com', 3, 225, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(292, '2014011300000000000000000003', 'fredy', '397db0bc83f7a25cf99544b0c9a7a025', 'Fredy Simangunsong', 'Fredy.Simangunsong@eurokars.co.id', 3, 150, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(293, '2014011300000000000000000004', 'jerry', '397db0bc83f7a25cf99544b0c9a7a025', 'Jerry Temaluru', 'jerry@eurokars.co.id', 3, 150, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(294, '2012061300000000000000000006', 'meike.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 221, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(295, '2014011300000000000000000008', 'rudi.sulaeman', '397db0bc83f7a25cf99544b0c9a7a025', 'Rudi Sulaeman', 'rudi.sulaeman@euroakars.co.id', 3, 150, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(296, '2014011300000000000000000009', 'aditia.jaksel', '397db0bc83f7a25cf99544b0c9a7a025', 'Aditia Perdana', 'aditia.perdana@eurokars.co.id', 3, 150, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(297, '2014011300000000000000000006', 'fumar', '397db0bc83f7a25cf99544b0c9a7a025', 'Fahrudin Umar', 'fahrudin.umar@eurokars.co.id', 3, 150, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(298, '2011081000000000000000000006', 'bmjakbar', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Jakarta Barat', 'wae@wae.co.id', 3, 100, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(299, '2012030700000000000000000003', 'adminbjm', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Banjarmasin', 'edy_mazdabjm@nusantara-group.co.id', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(300, '2012030700000000000000000011', 'adminsmd', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Samarinda', 'edy_mazdabjm@nusantara-group.co.id', 3, 202, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(301, '2012030700000000000000000002', 'bmbpn', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Balikpapan', 'membang_mazdabpp@nusantara-group.co.id', 3, 201, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(302, '2012030700000000000000000001', 'adminbpn', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Balikpapan', 'edy_mazdabjm@nusantara-group.co.id', 3, 201, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(303, '2014093000000000000000000002', 'dirmawan.jktm', '397db0bc83f7a25cf99544b0c9a7a025', 'Denny Irmawan', 'denny.mazda@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(304, '2012041100000000000000000004', 'susilo', '397db0bc83f7a25cf99544b0c9a7a025', 'Susilo', 'meike_adhmazda@nusantara-group.co.id', 3, 210, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(305, '2012030700000000000000000007', 'adminplb', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Palembang', 'meike_adhmazda@nusantara-group.co.id', 3, 210, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(306, '2012030700000000000000000008', 'bmplb', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Palembang', 'meike_adhmazda@nusantara-group.co.id', 3, 210, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(307, '2012030700000000000000000006', 'bmjmb', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda jambi', 'sanna2502@gmail.com', 3, 211, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(308, '2012030700000000000000000005', 'adminjmb', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Jambi', 'trimazdajambi@yahoo.co.id', 3, 211, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:58', '2020-11-30 00:59:58'),
(309, '2015020200000000000000000001', 'smaulana', '397db0bc83f7a25cf99544b0c9a7a025', 'Surya Maulana', 'surya.mazdajaktim@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(310, '2012030700000000000000000013', 'bmspg', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Serpong', 'raymond.sianik@yahoo.com', 3, 221, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(311, '2012030700000000000000000012', 'adminspg', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Serpong', 'bobbymazdaspg@gmail.com', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(312, '2015111200000000000000000001', 'andreas.nikodemus.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Andreas Nikodemus Koisine', 'nicovin2211@outlook.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(313, '2011112300000000000000000002', 'smklpgdg', '397db0bc83f7a25cf99544b0c9a7a025', 'RINNA', 'Rinna.Meilia@eurokars.co.id', 3, 151, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(314, '2013090400000000000000000002', 'isde', '397db0bc83f7a25cf99544b0c9a7a025', 'Ratna', 'Ratna.Sari@eurokars.co.id', 3, 153, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(315, '2011111700000000000000000001', 'adminmmi', '397db0bc83f7a25cf99544b0c9a7a025', 'adminthamrinmmi', 'mazda.thamrin@gmail.com', 3, 260, 'GM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(316, '2012061300000000000000000007', 'meike.spn', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 222, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(317, '2011101900000000000000000002', 'adminjakbar', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Jakarta Barat', 'finace-acc@wae.co.id', 3, 100, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(318, '2012070500000000000000000009', 'dedy.tri', '397db0bc83f7a25cf99544b0c9a7a025', 'Dedy Tri S', 'ddytt7_s@yahoo.com', 3, 140, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(319, '2012070500000000000000000012', 'riza.pahlevi', '397db0bc83f7a25cf99544b0c9a7a025', 'F. Riza Pahlevi', 'riza@mazdajawatimur.com', 3, 140, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(320, '2014012000000000000000000001', 'rio.ardy', '397db0bc83f7a25cf99544b0c9a7a025', 'Rio Ardy Sutjiadi', 'rio.mazdacirebon@gmail.com', 3, 233, 'SM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(321, '2012070600000000000000000003', 'virman5', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 240, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(322, '2012070600000000000000000002', 'virman4', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 242, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(323, '2018121400000000000000000001', 'sarmila', '397db0bc83f7a25cf99544b0c9a7a025', 'Sarmila', 'mila.mazdacibubur@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(324, '2012082700000000000000000001', 'virman.ptk', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 270, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(325, '2013021800000000000000000002', 'maya.bali02', '397db0bc83f7a25cf99544b0c9a7a025', 'Maya', 'yuri@mazda-bali.co.id', 3, 161, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(326, '2012121900000000000000000003', 'virman.pdg', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'aaa@yahoo.com', 3, 290, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(327, '2014022100000000000000000001', 'dirmawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Denny Irmawan', 'denny.mazda@gmail.com', 3, 234, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(328, '2014022100000000000000000002', 'muhamad.emi', '397db0bc83f7a25cf99544b0c9a7a025', 'Muhamad Emi', 'emimazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(329, '2014022100000000000000000003', 'ssulaeman', '397db0bc83f7a25cf99544b0c9a7a025', 'Sena Sulaeman', 'sena.mazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(330, '2012061300000000000000000005', 'meike.btr', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 223, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(331, '2014022100000000000000000004', 'c.anwar', '397db0bc83f7a25cf99544b0c9a7a025', 'Choirul Anwar', 'c.anwar.mazdabandung@gmail.com', 3, 231, 'BM', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(332, '2012091900000000000000000001', 'virman.plt', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 250, 'PR', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(333, '2012041100000000000000000003', 'edy', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy', 'edy.alpiani@nusantara-mazda.co.id', 3, 200, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 00:59:59', '2020-11-30 00:59:59'),
(334, '2014043000000000000000000001', 'meike.plk', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike C Wawolangi', 'meike.wawolangi@nusantara-mazda.co.id', 3, 204, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(335, '2013082700000000000000000001', 'herlin.inasih', '397db0bc83f7a25cf99544b0c9a7a025', 'Herlin Inasih', 'yanti.lestari@eurokars.co.id', 3, 152, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(336, '2015041500000000000000000001', 'willy.tangerang', '397db0bc83f7a25cf99544b0c9a7a025', 'WILLY', 'willy.fernando@nusantara-mazda.co.id', 3, 225, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(337, '2017052300000000000000000001', 'mermawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Mariana Ermawan', 'mermawan@mazda.co.id', 3, 888, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(338, '2018121800000000000000000001', 'husni.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Husni', 'husni.mazdacibubur@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(339, '2014031800000000000000000002', 'sutami', '397db0bc83f7a25cf99544b0c9a7a025', 'Sri Utami', 'silvi.mazdapalangkaraya@gmail.com', 3, 204, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(340, '2014031800000000000000000003', 'moctavia', '397db0bc83f7a25cf99544b0c9a7a025', 'Monica Octavia', 'silvi.mazdapalangkaraya@gmail.com', 3, 204, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(341, '2014031800000000000000000004', 'birawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Benny Irawan', 'silvi.mazdapalangkaraya@gmail.com', 3, 204, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(342, '2014031800000000000000000005', 'drahayu', '397db0bc83f7a25cf99544b0c9a7a025', 'Dewi Rahayu', 'silvi.mazdapalangkaraya@gmail.com', 3, 204, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(343, '2014031800000000000000000001', 'sindriani', '397db0bc83f7a25cf99544b0c9a7a025', 'Silvia Indriani', 'silvi.mazdapalangkaraya@gmail.com', 3, 204, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(344, '2014032000000000000000000001', 'sadiwigati', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 500, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(345, '2013071800000000000000000001', 'dina', '397db0bc83f7a25cf99544b0c9a7a025', 'Dina', 'ar_mazdabatam@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(346, '2018010200000000000000000001', 'bmpuri', '397db0bc83f7a25cf99544b0c9a7a025', 'BM MAZDA PURI', 'meilani.haryani@performanceauto.co.id', 3, 101, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(347, '2014043000000000000000000002', 'edy.plk', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy Alfiani', 'edy.alpiani@nusantara-mazda.co.id', 3, 204, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(348, '2014043000000000000000000003', 'tri.plk', '397db0bc83f7a25cf99544b0c9a7a025', 'Tri Rahma Yanti', 'tri.yanti@nusantara-mazda.co.id', 3, 204, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(349, '2018012300000000000000000001', '154.salessupervisor3', '397db0bc83f7a25cf99544b0c9a7a025', 'Yudi Siada', 'Yudi.siada@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(350, '2018012900000000000000000001', '235.spv', '397db0bc83f7a25cf99544b0c9a7a025', 'Sales Supervisor Mazda Cibubur', 'idam.mazda@gmail.com', 3, 235, 'HoS', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(351, '2012080200000000000000000002', 'sapto.bgr', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 234, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(352, '2012100500000000000000000001', 'virman.btm', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'mazd@mazda.co.id', 3, 180, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(353, '2015092900000000000000000001', 'budi.darmawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Budi Darmawan', 'budidarm8327@gmail.com', 3, 241, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:00', '2020-11-30 01:00:00'),
(354, '2014060300000000000000000003', 'wongso.darno.ckrg', '397db0bc83f7a25cf99544b0c9a7a025', 'Wongso Darno', 'wongsodarno@gmail.com', 3, 282, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(355, '2014082100000000000000000005', 'jenny.mdn2', '397db0bc83f7a25cf99544b0c9a7a025', 'JENNY', 'jenny_sidik@yahoo.com', 3, 171, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(356, '2013022500000000000000000001', 'meike.bjm2', '397db0bc83f7a25cf99544b0c9a7a025', 'Meike', 'meike.wawolangi@nusantara-mazda.co.id', 3, 203, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(357, '2014070300000000000000000002', 'johan.thamrin', '397db0bc83f7a25cf99544b0c9a7a025', 'Johan Liem', 'finance.mazdathamrin@gmail.com', 3, 260, 'FM', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(358, '2014072100000000000000000001', 'apermana', '397db0bc83f7a25cf99544b0c9a7a025', 'Andika Ganda Permana', 'hos3.mazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(359, '2014082100000000000000000001', 'fjuliana.mdn2', '397db0bc83f7a25cf99544b0c9a7a025', 'FITRI JULIANA', 'fitri.jt@mazda-medan.co.id', 3, 171, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(360, '2014082100000000000000000002', 'swahyuni.mdn2', '397db0bc83f7a25cf99544b0c9a7a025', 'SRI WAHYUNI', 'sri.wahyuni@mazda-medan.co.id', 3, 171, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(361, '2014072100000000000000000002', 'awicaksono', '397db0bc83f7a25cf99544b0c9a7a025', 'Andri Wicaksono', 'andri.mazdabogor@gmail.com', 3, 234, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(362, '2015042200000000000000000001', 'amung.sarono.tng', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'amung.sarono@nusantara-mazda.co.id', 3, 225, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(363, '2014042200000000000000000003', 'ffelmmy', '397db0bc83f7a25cf99544b0c9a7a025', 'Felly Felmmy', 'Felly.Felmmy@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(364, '2014042200000000000000000004', 'plaksono', '397db0bc83f7a25cf99544b0c9a7a025', 'Pudjo Laksono', 'Pudjo.Laksono@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(365, '2014042200000000000000000006', 'ejohan', '397db0bc83f7a25cf99544b0c9a7a025', 'Erni Johan', 'erni.johan@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(366, '2014042200000000000000000007', 'rrahmad', '397db0bc83f7a25cf99544b0c9a7a025', 'Rudi Rahmad', 'Rudi.Rahmad@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(367, '2014043000000000000000000004', 'ckoestono', '397db0bc83f7a25cf99544b0c9a7a025', 'Cynthia Koestono', 'cynthia.koestono@eurokars.co.id', 3, 154, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(368, '2014072500000000000000000001', 'pdermawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Pangeran Dermawan', 'hos4.mazdabogor@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(369, '2012061900000000000000000002', 'virman1', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 230, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(370, '2014082100000000000000000003', 'yirawan.mdn2', '397db0bc83f7a25cf99544b0c9a7a025', 'YUDI IRAWAN', 'yudi_legal0806@yahoo.com', 3, 171, 'HS', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(371, '2014082100000000000000000004', 'virman.mdn2', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman Ardinda', 'vardinda@mazda.co.id', 3, 171, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(372, '2014093000000000000000000003', 'andita.jtkm', '397db0bc83f7a25cf99544b0c9a7a025', 'Andita Wahyu', 'andita.mazdajaktim@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(373, '2012072500000000000000000001', 'virman.mdn', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'support@mazda.co.id', 3, 170, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(374, '2013050800000000000000000001', 'yanta.winata', '397db0bc83f7a25cf99544b0c9a7a025', 'Yanta Winata Chandra', 'yanta@majestygroup.co.id', 3, 180, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(375, '2014092300000000000000000001', 'arif.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Arif', 'arfmazdacibubur@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(376, '2015042900000000000000000002', 'anita.tng', '397db0bc83f7a25cf99544b0c9a7a025', 'Anita Kasmana', 'anita.kasmana@nusantara-mazda.co.id', 3, 225, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(377, '2014092300000000000000000003', 'surya.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Surya Maulana', 'surya.mazdacibubur@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(378, '2014093000000000000000000004', 'sakirman.jktm', '397db0bc83f7a25cf99544b0c9a7a025', 'M.Sakirman', 'iman.mazdajktm@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(379, '2013031400000000000000000002', 'virman.menteng1', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 261, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(380, '2015020200000000000000000002', 'wondha.jktm', '397db0bc83f7a25cf99544b0c9a7a025', 'Wondhanagusa', 'wondha17@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(381, '2015113000000000000000000001', 'chellyn.180', '397db0bc83f7a25cf99544b0c9a7a025', 'Chellyn', 'doc_admin@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:01', '2020-11-30 01:00:01'),
(382, '2013022600000000000000000001', 'edy.alfian.bjm2', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy alfian', 'edy.alpiani@nusantara-mazda.co.id', 3, 203, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(383, '2013022600000000000000000002', 'elly.rahmah.bjm2', '397db0bc83f7a25cf99544b0c9a7a025', 'Elly Rahmah', 'tri.yanti@nusantara-mazda.co.id', 3, 203, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(384, '2014100900000000000000000001', 'dsetiawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Dedi Setiawan', 'dedi.setiawan@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(385, '2012092100000000000000000001', 'virman.spn', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 222, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(386, '2014112000000000000000000002', 'edy.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy Halim', 'halim_eddy@ymail.com', 3, 224, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(387, '2014101700000000000000000001', 'aditya.adityawarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Aditya Eka', 'aditya.eka@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(388, '2014112100000000000000000001', 'hikmah.serpong', '397db0bc83f7a25cf99544b0c9a7a025', 'Hikmah Merdekawati', 'hikmahmerdekawati@yahoo.com', 3, 221, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(389, '2012080800000000000000000009', 'virman.bg', '397db0bc83f7a25cf99544b0c9a7a025', 'virman.bg', 'virman@mazda.co.id', 3, 234, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(390, '2014112800000000000000000002', 'johan.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Johan Yuliansyah', 'johanyuliansyah@yahoo.co.id', 3, 224, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(391, '2014120800000000000000000001', 'siti.spg', '397db0bc83f7a25cf99544b0c9a7a025', 'Siti Sarapiah', 'sitis.nella@gmail.com', 3, 221, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(392, '2012101100000000000000000001', 'sapto.lpg', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto', 'sadiwigati@mazda.co.id', 3, 281, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(393, '2012061900000000000000000001', 'virman', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 100, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(394, '2015021800000000000000000001', 'herry.jgj', '397db0bc83f7a25cf99544b0c9a7a025', 'Herry Cahyono Harumdito', 'herry.juara@gmail.com', 3, 241, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(395, '2015041500000000000000000002', 'sujarwo.tangerang', '397db0bc83f7a25cf99544b0c9a7a025', 'SUJARWO', 'sujarwo@nusantara-mazda.co.id', 3, 225, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(396, '2015041500000000000000000003', 'hasim.tangerang', '397db0bc83f7a25cf99544b0c9a7a025', 'HASIM', 'muhamad.hasim@nusantara-mazda.co.id', 3, 225, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(397, '2015030200000000000000000001', 'akusuma.bgr', '397db0bc83f7a25cf99544b0c9a7a025', 'Arya Kusuma', 'arya.mazdabogor@gmail.com', 3, 234, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(398, '2012043000000000000000000010', 'viola.setiawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Viola Setiawan', 'viola.mazdabandung@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(399, '2015042000000000000000000001', 'rachmat.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Rahmat', 'rahmat.mazdastm@gmail.com', 3, 235, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(400, '2015042000000000000000000002', 'erna.cibubur', '397db0bc83f7a25cf99544b0c9a7a025', 'Erna', 'erna.mazdacibubur@gmail.com', 3, 235, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(401, '2015050600000000000000000001', 'virman.adityawarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman Ardinda', 'vardinda@mazda.co.id', 3, 154, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(402, '2014051300000000000000000002', 'amin.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Amin Muslimin', 'amin.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(403, '2015051300000000000000000003', 'darfi.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Darfiansyah', 'darvi@mazda-bandung.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(404, '2015051300000000000000000004', 'desi.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'DESI PERDA', 'desi.mazdabandung@gmail.com', 3, 231, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(405, '2015070800000000000000000001', 'ade.adityawarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Ade Firnando', 'ade.firnando@eurokars.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(406, '2015110200000000000000000001', 'tomy.heriyanto.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Tomy Heriyanto', 'tomiedavie@yahoo.co.id', 3, 280, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(407, '2014050200000000000000000001', 'esaraswati', '397db0bc83f7a25cf99544b0c9a7a025', 'Erlia Saraswati', 'erlia.saraswati@mazda.co.id', 3, 154, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(408, '2018022200000000000000000001', 'riko.test', '397db0bc83f7a25cf99544b0c9a7a025', 'Riko', 'riko@procyon.co.id', 3, 261, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:02', '2020-11-30 01:00:02'),
(409, '2015081400000000000000000001', 'aulia.sunter', '397db0bc83f7a25cf99544b0c9a7a025', 'Aulia Napitupulu', 'aulia.napitupulu@eurokars.co.id', 3, 153, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(410, '2015110200000000000000000002', 'heri.murdiwiyanto.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Heri Murdiwiyanto', 'heri.mazdabekasi@gmail.com', 3, 280, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(411, '2015110200000000000000000004', 'lexi.marua.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Lexi Alexander Marua', 'lexi.marua@yahoo.com', 3, 280, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(412, '2015110200000000000000000005', 'miko.280', '397db0bc83f7a25cf99544b0c9a7a025', 'N. M Miko', 'micochen007@gmail.com', 3, 280, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(413, '2015110200000000000000000003', 'budi.darmawan.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Budi Darmawan', 'budi.ssmazda@gmail.com', 3, 280, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(414, '2012071800000000000000000005', 'fitri', '397db0bc83f7a25cf99544b0c9a7a025', 'Fitri', 'fitri_capellamazindo@yahoo.com', 3, 170, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(415, '2012030700000000000000000004', 'bmbjm', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Banjarmasin', 'edy_mazdabjm@nusantara-group.co.id', 3, 200, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(416, '2015110200000000000000000008', 'christian.dwi.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Christian Dwi Putra', 'tianhimura@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(417, '2013042200000000000000000001', 'virman.lpg', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'ardindavirman@yahoo.com', 3, 281, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(418, '2013022800000000000000000001', 'virman.bks', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 280, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(419, '2015110900000000000000000002', 'roby.chandra.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Roby Chandra', 'cen_roby@yahoo.com', 3, 280, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(420, '2015120200000000000000000001', 'hermawan.setiadi', '397db0bc83f7a25cf99544b0c9a7a025', 'Hermawan Setiadi', 'setyadi455@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(421, '2015111200000000000000000003', 'bima.murhandi.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Bima Murhandi', 'murhandibima@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(422, '2015111900000000000000000001', 'donny.aditywarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Donny Veriyanto', 'Donny.Veriyanto@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(423, '2015111200000000000000000004', 'riki.rudiansyah.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Riki Rudiansyah', 'rickyrudi72@yahoo.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(424, '2015111200000000000000000005', 'guntur.santoso.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Guntur Santoso', 'guntursantoso12345@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:03', '2020-11-30 01:00:03'),
(425, '2015111200000000000000000006', 'anas.ibnu.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Anas Ibnu Safaruddin', 'anas.mazda@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(426, '2015111200000000000000000007', 'imam.fauzi.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Imam Fauzi', 'imamf316.if@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(427, '2015111200000000000000000008', 'rais.rukmana.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Rais Rukmana Rahayu', 'raisrahayu.rr@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(428, '2016010400000000000000000003', 'bnuryanto.THM', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang', 'bnuryanto@mazda.co.id', 3, 260, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(429, '2015111200000000000000000010', 'tirta.maulana.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Tirta Maulana', 'tirtamaulana08@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(430, '2015111200000000000000000002', 'andareas.manalu.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Andareas Manalu', 'andareasmanalu@yahoo.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(431, '2015111200000000000000000011', 'fajar.widyatmoko.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Fajar Widyatmoko', 'fajarjar620@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(432, '2015111200000000000000000012', 'zaid.alfajri.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Zaid Alfajri', 'zaid.alfajri@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(433, '2015111200000000000000000013', 'hariyanto.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Hariyanto', 'antoniushariyanto@yahoo.co.id', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(434, '2013072200000000000000000001', 'asri.imanus', '397db0bc83f7a25cf99544b0c9a7a025', 'Arie Kurniawan', 'arie.mazdacibubur@gmail.com', 3, 235, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(435, '2015112000000000000000000001', 'bnuryanto.bks', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang N', 'bnuryanto@mazda.co.id', 3, 280, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(436, '2015111200000000000000000015', 'abdul.hakim.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Abdul Hakim Mubarok', 'barokwords@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(437, '2015111200000000000000000016', 'dwi.hananto.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Dwi Hananto Adi Nugroho', 'dwi.mazda68@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(438, '2015111200000000000000000009', 'arief.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Arief Triesmawardi', 'areif.sneed@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(439, '2015111200000000000000000017', 'mesa.ayu.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Mesa Ayu Laraswati', 'mesyaayu28@yahoo.co.id', 3, 280, 'SC', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(440, '2015110200000000000000000010', 'radea.adi.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Radea Adi Putra Natawijaya', 'radea.adiputra@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(441, '2015110200000000000000000009', 'rifky.ardiansyah.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Rifky Ardiansyah', 'rifky.ardiansyah@ymail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(442, '2015111200000000000000000014', 'lucky.lukman.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Lucky Lukmansyah', 'luckymazda7@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(443, '2015121100000000000000000001', 'yuwandi', '397db0bc83f7a25cf99544b0c9a7a025', 'Yuwandi', 'yuwandi.ben2@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(444, '2015120400000000000000000001', 'jamil.225', '397db0bc83f7a25cf99544b0c9a7a025', 'Jamil', 'jamil.aming@gmail.com', 3, 225, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(445, '2013021100000000000000000001', 'sadiwigati.dpk', '397db0bc83f7a25cf99544b0c9a7a025', 'Sapto Adiwigati', 'sadiwigati@mazda.co.id', 3, 262, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(446, '2015121400000000000000000001', 'henckey.tan.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Henckey Tan Zelley', 'henckey@yahoo.com', 3, 280, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:04', '2020-11-30 01:00:04'),
(447, '2016010400000000000000000004', 'bnuryanto.MTG', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang', 'bnuryanto@mazda.co.id', 3, 261, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(448, '2015110200000000000000000007', 'virza.handy.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Virza Handy S', 'virzacestaro9999@yahoo.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(449, '2012061900000000000000000003', 'virman2', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman', 'support@mazda.co.id', 3, 260, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(450, '2016021800000000000000000003', '223.esisdianto', '397db0bc83f7a25cf99544b0c9a7a025', 'Ersi Sisdianto', 'ersi.sisdianto@nusantara-mazda.co.id', 3, 223, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(451, '2016010500000000000000000001', 'darius.syahputra', '397db0bc83f7a25cf99544b0c9a7a025', 'Darius Syahputra', 'darius.syahputra@gmail.com', 3, 280, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(452, '2015110200000000000000000006', 'ria.febriani.280', '397db0bc83f7a25cf99544b0c9a7a025', 'Ria Febriani', 'febri_momon@yahoo.com', 3, 280, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(453, '2015121100000000000000000002', 'aries.bustandi', '397db0bc83f7a25cf99544b0c9a7a025', 'Aries Bustandi', 'yuwandi.ben2@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(454, '2016030100000000000000000001', 'achmad.aditywarman', '397db0bc83f7a25cf99544b0c9a7a025', 'Achmad Chudori', 'Achmad.chudori@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(455, '2016040100000000000000000001', '234.kartina.wong', '397db0bc83f7a25cf99544b0c9a7a025', 'KARTINA WONG', 'tinawong.mazdabogor@gmail.com', 3, 234, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(456, '2016050200000000000000000001', 'alfian', '397db0bc83f7a25cf99544b0c9a7a025', 'Alfian', 'alfyanfyan@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(457, '2016050200000000000000000002', 'lili.gunarso', '397db0bc83f7a25cf99544b0c9a7a025', 'Lili Gunarso', 'lili.gunarso@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(458, '2014060900000000000000000001', 'fitri.ckrg', '397db0bc83f7a25cf99544b0c9a7a025', 'Fitri Angraeni', 'angraenifitri@gmail.com', 3, 282, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(459, '2012080800000000000000000002', 'wongso.darno', '397db0bc83f7a25cf99544b0c9a7a025', 'Wongso Darno', 'wongsodarno@gmail.com', 3, 280, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(460, '2012061000000000000000000003', 'witri.janita', '397db0bc83f7a25cf99544b0c9a7a025', 'Witri Janita', 'j.witri@yahoo.com', 3, 280, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(461, '2012061000000000000000000004', 'rohmabussolina', '397db0bc83f7a25cf99544b0c9a7a025', 'Rohmabussolina', 'rohmah_999@yahoo.com', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(462, '2013092300000000000000000002', 'yanti.laia', '397db0bc83f7a25cf99544b0c9a7a025', 'Ferry Yanti Laia', 'yanti_laia@yahoo.co.id', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(463, '2012080800000000000000000008', 'tenni.aditya', '397db0bc83f7a25cf99544b0c9a7a025', 'Tenni Aditya Purwandhani', 'lupateyus@yahoo.com', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(464, '2014060300000000000000000001', 'saldian.ckrg', '397db0bc83f7a25cf99544b0c9a7a025', 'Saldian', 'saldian.mazda@gmail.com', 3, 282, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05');
INSERT INTO `tbl_user` (`id_user`, `kd_user_wrs`, `username`, `password`, `nama_user`, `email`, `id_user_group`, `id_dealer`, `id_dealer_level`, `level_access`, `status_atpm`, `is_from_wrs`, `status`, `created_at`, `updated_at`) VALUES
(465, '2014060300000000000000000002', 'dlilis', '397db0bc83f7a25cf99544b0c9a7a025', 'Dewi Lilys Siregar', 'dewililismazda@gmail.com', 3, 282, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(466, '2011101900000000000000000001', 'adminjaksel', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Radio Dalam', 'yanti.lestari@eurokars.co.id', 3, 152, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(467, '2011081000000000000000000002', 'bmjaksel', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Radio Dalam', 'yanti@eurokars.co.id', 3, 152, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(468, '2018031200000000000000000001', '190.adh', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Palembang', 'Septyatha@mazda.co.id', 3, 190, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(469, '2014011300000000000000000007', 'siti.zaenab', '397db0bc83f7a25cf99544b0c9a7a025', 'Siti Zaenab', 'siti.zaenab@eurokars.co.id', 3, 150, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(470, '2014011300000000000000000001', 'jean.michael', '397db0bc83f7a25cf99544b0c9a7a025', 'Jean Michael David', 'yanti@eurokars.co.id', 3, 150, 'GM', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(471, '2012062700000000000000000001', 'amung.sarono.btr', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'a.sarono@nusantara-group.co.id', 3, 223, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:05', '2020-11-30 01:00:05'),
(472, '2016021800000000000000000001', '223.rwibowo', '397db0bc83f7a25cf99544b0c9a7a025', 'Ratno Wibowo Budirahardja', 'ratno.budirahardja@nusantara-mazda.co.id', 3, 223, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(473, '2016021800000000000000000002', '223.bsusanto', '397db0bc83f7a25cf99544b0c9a7a025', 'Bobby Susanto', 'bobby.susanto@nusantara-mazda.co.id', 3, 223, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(474, '2012043000000000000000000002', 'agustina', '397db0bc83f7a25cf99544b0c9a7a025', 'Agustina', 'a.rachmathun@nas.co.id', 3, 223, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(475, '2014112800000000000000000003', 'amung.sarono.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'amung.sarono@mazda.co.id', 3, 224, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(476, '2014112000000000000000000001', 'yuyun.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Yuyun Kurniawan', 'yuyun.kurniawan@nusantara-mazda.co.id', 3, 224, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(477, '2015041600000000000000000002', 'hasim.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Hasim', 'muhamad20hasim@gmail.com', 3, 224, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(478, '2012041100000000000000000001', 'amung.sarono.pcg', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'a.sarono@nusantara-group.co.id', 3, 220, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(479, '2012061200000000000000000005', 'dini.kurniasih', '397db0bc83f7a25cf99544b0c9a7a025', 'Dini Kurniasih', 'd.kurniasih@nusantara-group.co.id', 3, 220, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(480, '2012030700000000000000000010', 'bmpcn', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Pecenongan', 'susanto@nusantara-group.co.id', 3, 220, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(481, '2012041100000000000000000013', 'didit', '397db0bc83f7a25cf99544b0c9a7a025', 'M. Adyatma', 'a.sarono@nusantara-group.co.id', 3, 220, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(482, '2012030700000000000000000015', 'bmspn', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Suryopranoto', 'a.sarono@nusantara-group.co.id', 3, 222, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(483, '2012041000000000000000000011', 'amung.sarono.spn', '397db0bc83f7a25cf99544b0c9a7a025', 'Amung Sarono', 'a.sarono@nusantara-group.co.id', 3, 222, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(484, '2012030700000000000000000014', 'adminspn', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Suryopranoto', 'a.sarono@nusantara-group.co.id', 3, 222, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(485, '2013041600000000000000000004', 'lisa.wijaya', '397db0bc83f7a25cf99544b0c9a7a025', 'Lisa Wijaya Lopez', 'lisa.wijaya@nusantara-group.co.id', 3, 222, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(486, '2012041000000000000000000010', 'okti.budiman', '397db0bc83f7a25cf99544b0c9a7a025', 'Okti Budiman', 'oktibudiman_mazda@nusantara-group.co.id', 3, 222, 'GM', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(487, '2013032000000000000000000010', 'nurlaela', '397db0bc83f7a25cf99544b0c9a7a025', 'Nurlaela', 'nurlaela.mukhtar@yahoo.co.id', 3, 261, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(488, '2013032000000000000000000008', 'sfranciska', '397db0bc83f7a25cf99544b0c9a7a025', 'Shinta Franciska', 'puguh.priambada@mazdathamrin.com', 3, 261, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:06', '2020-11-30 01:00:06'),
(489, '2013032000000000000000000007', 'ppriambada', '397db0bc83f7a25cf99544b0c9a7a025', 'Puguh Priambada', 'puguh.priambada@mazdathamrin.com', 3, 261, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(490, '2013040500000000000000000001', 'puguh.thamrin', '397db0bc83f7a25cf99544b0c9a7a025', 'Puguh Priambada', 'puguh.priambada@mazdathamrin.com', 3, 260, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(491, '2011101900000000000000000003', 'adminthamrin', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda Thamrin', 'felix.christianto@mazdathamrin.com', 3, 260, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(492, '2011101900000000000000000004', 'bmtham', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Thamrin', 'felix.christianto@mazdathamrin.com', 3, 260, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(493, '2013032100000000000000000001', 'puguh.depok', '397db0bc83f7a25cf99544b0c9a7a025', 'Puguh Priambada', 'puguh.priambada@mazdathamrin.com', 3, 262, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(494, '2013092500000000000000000001', 'suharyati.depok', '397db0bc83f7a25cf99544b0c9a7a025', 'Suharyati', 'ade82mazdadepok@gmail.com', 3, 262, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(495, '2013072300000000000000000001', 'hendrick.kurniawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Hendrick Kurniawan', 'kurniawan.mazdajakarta@gmail.com', 3, 230, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(496, '2012080400000000000000000001', 'hendrick', '397db0bc83f7a25cf99544b0c9a7a025', 'Hendrick Kurniawan', 'kurniawan.mazdajakarta@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(497, '2012110200000000000000000001', 'harieka.kurniawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Hari Eka Kurniawan', 'hari.ekakurniawan.mazdajakarta@gmail.com', 3, 230, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(498, '2012043000000000000000000006', 'haerudin', '397db0bc83f7a25cf99544b0c9a7a025', 'haerudin', 'haer.mazdajaktim@gmail.com', 3, 230, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(499, '2012080400000000000000000002', 'denny.irmawan', '397db0bc83f7a25cf99544b0c9a7a025', 'Denny Irmawan', 'denny.irmawan@yahoo.com', 3, 230, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(500, '2012043000000000000000000005', 'sugianti', '397db0bc83f7a25cf99544b0c9a7a025', 'Sugianti', 'yanti.mazdajaktim@gmail.com', 3, 230, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(501, '2013052200000000000000000001', 'dyah.ismidayanti', '397db0bc83f7a25cf99544b0c9a7a025', 'Dyah Ismidayanti', 'dyahismidayanti@yahoo.com', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(502, '2012080800000000000000000003', 'rohmatussoliha', '397db0bc83f7a25cf99544b0c9a7a025', 'Rohmatussoliha', 'rohmah_999@yahoo.com', 3, 280, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(503, '2016061000000000000000000001', 'haerudin.bgr', '397db0bc83f7a25cf99544b0c9a7a025', 'Haerudin', 'haer.mazdajaktim@gmail.com', 3, 234, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(504, '2016061000000000000000000002', 'haerudin.bdg1', '397db0bc83f7a25cf99544b0c9a7a025', 'Haerudin', 'haer.mazdajaktim@gmail.com', 3, 232, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(505, '2016061000000000000000000003', 'haerudin.bdg2', '397db0bc83f7a25cf99544b0c9a7a025', 'Haerudin', 'haer.mazdajaktim@gmail.com', 3, 231, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(506, '2016061000000000000000000004', 'haerudin.crbn', '397db0bc83f7a25cf99544b0c9a7a025', 'Haerudin', 'haer.mazdajaktim@gmail.com', 3, 233, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(507, '2016061000000000000000000005', 'haerudin.cbbr', '397db0bc83f7a25cf99544b0c9a7a025', 'Haerudin', 'haer.mazdajaktim@gmail.com', 3, 235, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(508, '2014112600000000000000000001', 'agunarsa', '397db0bc83f7a25cf99544b0c9a7a025', 'Agun Gunarsa', 'agungcarawaks@yahoo.com; djul.mazdajaktim@gmail.com', 3, 230, 'HoS', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(509, '2016062200000000000000000002', 'andriyani', '397db0bc83f7a25cf99544b0c9a7a025', 'Andriyani', 'admin@wae.co.id', 3, 101, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(510, '2012061000000000000000000009', 'jenie', '397db0bc83f7a25cf99544b0c9a7a025', 'Jenie Lie', 'jenie_lie@majestygroup.co.id', 3, 180, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:07', '2020-11-30 01:00:07'),
(511, '2017082400000000000000000001', 'yoel.lewi', '397db0bc83f7a25cf99544b0c9a7a025', 'Yoel Lewi Adi P', 'yoel.lewi@mazda.co.id', 3, 888, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(512, '2016100500000000000000000001', 'saryo.joko.utomo', '397db0bc83f7a25cf99544b0c9a7a025', 'Saryo Joko Utomo', 'saryojoko85@gmail.com', 3, 280, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(513, '2016100600000000000000000001', '154.bayueko', '397db0bc83f7a25cf99544b0c9a7a025', 'Bayu Eko Windharto', 'Bayu.Windharto@eurokars.co.id', 3, 154, 'HRD Manager', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(514, '2016072600000000000000000001', '154.salessupervisor', '397db0bc83f7a25cf99544b0c9a7a025', 'Lianda Rifani', 'lianda.rifani@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(515, '2016081600000000000000000001', 'indah.sunset', '397db0bc83f7a25cf99544b0c9a7a025', 'Indah Rakhmawati', 'admin@mazda-bali.com', 3, 161, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(516, '2016111700000000000000000001', '154.wahyuwidodo', '397db0bc83f7a25cf99544b0c9a7a025', 'Wahyu Widodo', 'wahyu.widodo@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(517, '2016120700000000000000000001', 'panji.aditya', '397db0bc83f7a25cf99544b0c9a7a025', 'PANJI ADITYA', 'panji068@gmail.com', 3, 151, 'SCS', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(518, '2017052400000000000000000001', 'mermawan.mmi', '397db0bc83f7a25cf99544b0c9a7a025', 'Mermawan', 'mermawan@mazda.co.id', 3, 500, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(519, '2012041000000000000000000001', 'banu.ajisasmito', '397db0bc83f7a25cf99544b0c9a7a025', 'Banu Aji Sasmito', 'banu.mazdacirebon@gmail.com', 3, 233, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(520, '2017071700000000000000000002', '233.afenay', '397db0bc83f7a25cf99544b0c9a7a025', 'Afenay Yonathan', 'afenay.mazdacirebon@gmail.com', 3, 233, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(521, '2017072400000000000000000001', 'andi.halgan', '397db0bc83f7a25cf99544b0c9a7a025', 'Andi Halgan', 'andimazda9@gmail.com', 3, 234, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(522, '2017080700000000000000000001', '233.spv', '397db0bc83f7a25cf99544b0c9a7a025', 'Supervisor Mazda Cirebon', 'murniamazda66@gmail.com', 3, 233, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(523, '2016091500000000000000000001', '232.adhbandung1', '397db0bc83f7a25cf99544b0c9a7a025', 'ADH BANDUNG 1', 'silvia.mazdabandung1@gmail.com', 3, 232, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(524, '2018032600000000000000000001', '241.bm', '397db0bc83f7a25cf99544b0c9a7a025', 'Yudo Tanoko', 'mrtanoko@gmail.com', 3, 241, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(525, '2017112700000000000000000001', '232.mulijono', '397db0bc83f7a25cf99544b0c9a7a025', 'Mulijono', 'mulijono@abm-mazda.co.id', 3, 232, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(526, '2017112700000000000000000004', '230.mulijono', '397db0bc83f7a25cf99544b0c9a7a025', 'Mulijono', 'mulijono@abm-mazda.co.id\n', 3, 230, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(527, '2017112700000000000000000015', '234.melisa', '397db0bc83f7a25cf99544b0c9a7a025', 'Melisa', 'melisa@abm-mazda.co.id\n', 3, 234, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(528, '2017112700000000000000000007', '231.mulijono', '397db0bc83f7a25cf99544b0c9a7a025', 'Mulijono\n', 'mulijono@abm-mazda.co.id\n\n', 3, 231, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(529, '2017112700000000000000000016', '235.mulijono', '397db0bc83f7a25cf99544b0c9a7a025', 'Mulijono', 'mulijono@abm-mazda.co.id\n\n', 3, 235, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(530, '2018032600000000000000000002', '240.bm', '397db0bc83f7a25cf99544b0c9a7a025', 'WIDODO WIBISONO', 'widodowibisono40@gmail.com', 3, 240, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(531, '2018040500000000000000000001', '102.bambang', '397db0bc83f7a25cf99544b0c9a7a025', 'Bambang Tjahyono', 'bambang.tjahyono@performanceauto.co.id', 3, 102, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(532, '2012061400000000000000000001', 'bismillah', '397db0bc83f7a25cf99544b0c9a7a025', 'Virman ', 'vardinda@mazda.co.id', 3, 151, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(533, '2019012200000000000000000001', '103.adminbsd', '397db0bc83f7a25cf99544b0c9a7a025', 'Admin Mazda BSD City', 'lilis.tjinderawati@performanceauto.co.id', 3, 103, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:08', '2020-11-30 01:00:08'),
(534, '2019022500000000000000000001', 'jurianto.180', '397db0bc83f7a25cf99544b0c9a7a025', 'JURIANTO', 'mazdabatam_account@majestygroup.co.id', 3, 180, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(535, '2019022600000000000000000001', '154.salessupervisor2', '397db0bc83f7a25cf99544b0c9a7a025', 'Budi Santoso', 'budi.santoso@eurokars.co.id', 3, 154, 'SP', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(536, '2014011300000000000000000002', 'asbernadet', '397db0bc83f7a25cf99544b0c9a7a025', 'Asbernadet', 'vardinda@mazda.co.id', 3, 150, 'SM', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(537, '2019043000000000000000000001', '154.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Adityawarman', 'crc@test.com', 3, 154, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(538, '2019041800000000000000000002', '150.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC JAKSEL', 'it.helpdesk@mazda.co.id', 3, 150, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(539, '2019043000000000000000000003', '232.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Bandung 1', 'it.helpdesk@mazda.co.id', 3, 232, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(540, '2019043000000000000000000004', 'lyanarti', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Bandung 2', 'it.helpdesk@mazda.co.id', 3, 231, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(541, '2019043000000000000000000005', 'cromazda', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Bogor', 'it.helpdesk@mazda.co.id', 3, 234, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(542, '2019043000000000000000000006', 'crc.cibubur.235', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Cibubur', 'it.helpdesk@mazda.co.id', 3, 235, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(543, '2019043000000000000000000007', 'CRC.CIREBON.233', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Cirebon', 'it.helpdesk@mazda.co.id', 3, 233, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(544, '2019043000000000000000000008', '230.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Jakarta Timur', 'it.helpdesk@mazda.co.id', 3, 230, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(545, '2019043000000000000000000009', '103.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda BSD City', 'it.helpdesk@mazda.co.id', 3, 103, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(546, '2019043000000000000000000010', '100.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Jakarta Barat', 'it.helpdesk@mazda.co.id', 3, 100, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 02:22:42'),
(547, '2019043000000000000000000011', '231.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Bandung 2', 'it.helpdesk@mazda.co.id', 3, 231, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(548, '2019043000000000000000000012', '234.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Bogor', 'it.helpdesk@mazda.co.id', 3, 234, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(549, '2019043000000000000000000013', '102.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda MT Haryono', 'it.helpdesk@mazda.co.id', 3, 102, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(550, '2019043000000000000000000015', '201.CRC', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Balikpapan', 'it.helpdesk@mazda.co.id', 3, 201, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(551, '2019043000000000000000000016', '211.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Jambi', 'it.helpdesk@mazda.co.id', 3, 211, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:09', '2020-11-30 01:00:09'),
(552, '2019043000000000000000000017', '202.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Samarinda', 'it.helpdesk@mazda.co.id', 3, 202, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(553, '2019043000000000000000000018', '241.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Jogja', 'it.helpdesk@mazda.co.id', 3, 241, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(554, '2019043000000000000000000019', '240.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Semarang', 'it.helpdesk@mazda.co.id', 3, 240, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(555, '2019043000000000000000000020', '242.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Solo', 'it.helpdesk@mazda.co.id', 3, 242, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(556, '2019043000000000000000000022', '281.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Lampung', 'it.helpdesk@mazda.co.id', 3, 281, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(557, '2019043000000000000000000023', '170.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Medan', 'it.helpdesk@mazda.co.id', 3, 170, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(558, '2019043000000000000000000024', '290.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Padang', 'it.helpdesk@mazda.co.id', 3, 290, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(559, '2019043000000000000000000025', '180.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Batam', 'it.helpdesk@mazda.co.id', 3, 180, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(560, '2019043000000000000000000026', '161.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Bali Sunset Road', 'it.helpdesk@mazda.co.id', 3, 161, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(561, '2019043000000000000000000027', '140.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Jawa Timur', 'it.helpdesk@mazda.co.id', 3, 140, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(562, '2019043000000000000000000028', '120.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Makassar', 'it.helpdesk@mazda.co.id', 3, 120, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(563, '2019043000000000000000000029', '110.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Pekanbaru', 'it.helpdesk@mazda.co.id', 3, 110, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(564, '2019043000000000000000000030', '270.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Pontianak', 'it.helpdesk@mazda.co.id', 3, 270, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(565, '2019043000000000000000000031', '235.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Cibubur', 'it.helpdesk@mazda.co.id', 3, 235, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(566, '2019043000000000000000000032', '233.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Cirebon', 'it.helpdesk@mazda.co.id', 3, 233, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(567, '2019050200000000000000000001', '300.adh01', '397db0bc83f7a25cf99544b0c9a7a025', 'Administration Head Bintaro Jaya', 'adh.panjang@sunmotor.com', 3, 300, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(568, '2019050200000000000000000002', '300.adh02', '397db0bc83f7a25cf99544b0c9a7a025', 'Sales Admin Bintaro Jaya', 'adh.panjang@sunmotor.com', 3, 300, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(569, '2019043000000000000000000002', '151.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Kelapa Gading', 'it.helpdesk@mazda.co.id', 3, 151, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(570, '2019051300000000000000000001', '224.crc.1', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda BSD', 'it.helpdesk@mazda.co.id', 3, 224, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:10', '2020-11-30 01:00:10'),
(571, '2014112800000000000000000001', '224.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'Lidia Widyawati', 'zheta.donalduck13@gmail.com', 3, 224, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(572, '2012030700000000000000000009', '220.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Pecengongan', 'it.helpdesk@mazda.co.id', 3, 220, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(573, '2019043000000000000000000014', '101.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'wulan crc ', 'it.helpdesk@mazda.co.id', 3, 101, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(574, '2012071600000000000000000001', 'virman.btr', '397db0bc83f7a25cf99544b0c9a7a025', 'virman', 'mail@mazda.co.id', 3, 223, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(575, '2015042900000000000000000001', 'edy.tng', '397db0bc83f7a25cf99544b0c9a7a025', 'Edy Alpian', 'edy.alpiani@nusantara-mazda.co.id', 3, 225, 'Adm', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(576, '2014121000000000000000000001', 'edy.alpian.bsd', '397db0bc83f7a25cf99544b0c9a7a025', 'edy alpiani', 'edy.alpiani@nusantara-mazda.co.id', 3, 224, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(577, '2019081400000000000000000001', 'mirwan.nasri', '397db0bc83f7a25cf99544b0c9a7a025', 'Mirwan Nasri', 'mirwan.gmm@gmail.com', 3, 172, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(578, '2019081400000000000000000002', 'catrien.adh', '397db0bc83f7a25cf99544b0c9a7a025', 'Catrien', 'gmmplb.adh@gmail.com', 3, 172, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(579, '2019082700000000000000000001', '233.adh', '397db0bc83f7a25cf99544b0c9a7a025', 'Administration Head', 'ika.mazdacirebon@gmail.com', 3, 233, 'AH', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(580, '2019082700000000000000000002', '233.bm', '397db0bc83f7a25cf99544b0c9a7a025', 'Branch Manager Mazda Cirebon', 'mifahofacirebon@gmail.com', 3, 233, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(581, '2017112700000000000000000010', '233.mulijono', '397db0bc83f7a25cf99544b0c9a7a025', 'Mulijono', 'mulijono@abm-mazda.co.id', 3, 233, 'PR', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(582, '2018081500000000000000000002', '235.bm', '397db0bc83f7a25cf99544b0c9a7a025', 'AGUN GUNARSA', 'agungcarawaks@yahoo.com', 3, 235, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(583, '2014042900000000000000000008', 'tsinaga', '397db0bc83f7a25cf99544b0c9a7a025', 'Heri Adriyadi', 'heriadriyadi.mazda@gmail.com', 3, 235, 'BM', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(584, '2018030600000000000000000001', '232.adh2', '397db0bc83f7a25cf99544b0c9a7a025', 'Silvia Oktaviani', 'admservice.mazdabandung1@gmail.com', 3, 232, 'AS', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(585, '2019043000000000000000000021', '282.crc', '397db0bc83f7a25cf99544b0c9a7a025', 'CRC Mazda Cikarang', 'it.helpdesk@mazda.co.id', 3, 282, 'CRC', 4, 'dealer', '1', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(586, '1', 'bernand.hermawan', '5798b82d469d41d0c5480144138f6e7f', 'Bernando Torrez', 'Bernand.Dayamuntari@eurokars.co.id', 1, 0, NULL, 1, 'atpm', '0', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(587, '2', 'dewi.purnamasari', 'e9472b9334d078a9629a52c1ac058ab1', 'Dewi Purnamasari', 'Dewi.Purnamasari@eurokars.co.id', 1, 0, NULL, 1, 'atpm', '0', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(588, '3', 'brian.yunanda', 'a7808d4dfc6a34528f5fd47db55d27b8', 'Brian Yunanda', 'Brian.Yunanda@eurokars.co.id', 1, 0, NULL, 1, 'atpm', '0', '1', '2020-11-30 01:00:11', '2020-11-30 01:00:11'),
(589, NULL, 'bernando', 'b93d8edbf25891cfc309e7fcb0a7b217', 'bernando torrez', 'bernandotorrez4@gmail.com', 1, 0, NULL, 1, 'atpm', '0', '1', '2020-11-30 01:01:53', '2020-11-30 01:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_group`
--

CREATE TABLE `tbl_user_group` (
  `id_user_group` bigint(20) UNSIGNED NOT NULL,
  `nama_group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`id_user_group`, `nama_group`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin001', '1', '2020-11-30 01:00:13', '2020-11-30 01:00:13'),
(2, 'atpm001', '1', '2020-11-30 01:00:13', '2020-11-30 01:00:13'),
(3, 'dealer001', '1', '2020-11-30 01:00:13', '2020-11-30 01:00:13');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbl_cache`
--
ALTER TABLE `tbl_cache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_child_menu`
--
ALTER TABLE `tbl_child_menu`
  ADD PRIMARY KEY (`id_child_menu`);

--
-- Indexes for table `tbl_menu_user_group`
--
ALTER TABLE `tbl_menu_user_group`
  ADD PRIMARY KEY (`id_menu_user_group`);

--
-- Indexes for table `tbl_parent_menu`
--
ALTER TABLE `tbl_parent_menu`
  ADD PRIMARY KEY (`id_parent_menu`);

--
-- Indexes for table `tbl_sub_child_menu`
--
ALTER TABLE `tbl_sub_child_menu`
  ADD PRIMARY KEY (`id_sub_child_menu`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  ADD PRIMARY KEY (`id_user_group`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_cache`
--
ALTER TABLE `tbl_cache`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_child_menu`
--
ALTER TABLE `tbl_child_menu`
  MODIFY `id_child_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menu_user_group`
--
ALTER TABLE `tbl_menu_user_group`
  MODIFY `id_menu_user_group` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_parent_menu`
--
ALTER TABLE `tbl_parent_menu`
  MODIFY `id_parent_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sub_child_menu`
--
ALTER TABLE `tbl_sub_child_menu`
  MODIFY `id_sub_child_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  MODIFY `id_user_group` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
