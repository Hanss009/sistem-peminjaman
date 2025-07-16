-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2025 pada 17.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_kendaraan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asets`
--

CREATE TABLE `asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `tipe_aset` enum('properti','elektronik_it','inventaris') NOT NULL,
  `no_aset` varchar(255) NOT NULL,
  `status_aset` enum('aktif','tidak_aktif','services') NOT NULL,
  `foto_aset` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `asets`
--

INSERT INTO `asets` (`id`, `nama_aset`, `tipe_aset`, `no_aset`, `status_aset`, `foto_aset`, `created_at`, `updated_at`) VALUES
(3, 'Ruangan Hall', 'inventaris', '1122', 'aktif', '1750217944_hansen.jpeg', '2025-06-17 20:39:04', '2025-06-17 20:39:04'),
(4, 'meja', 'properti', '12344', 'aktif', '1751435529_Screenshot-2022-11-08-141508-1024x564.jpg', '2025-07-01 22:52:09', '2025-07-01 22:52:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `kendaraans`
--

CREATE TABLE `kendaraans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kendaraan` varchar(255) NOT NULL,
  `plat_nomor` varchar(255) NOT NULL,
  `jenis_kendaraan` enum('mobil','sepeda_motor') NOT NULL,
  `merk_kendaraan` enum('daihatsu','toyota','mitsubishi','honda','dll') NOT NULL DEFAULT 'dll',
  `warna_kendaraan` varchar(255) NOT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `tgl_berakhir_stnk` date NOT NULL,
  `status_kepemilikan` enum('pribadi','yayasan','sewa') NOT NULL,
  `status_kendaraan` enum('aktif','tidak_aktif','services','rusak') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kendaraans`
--

INSERT INTO `kendaraans` (`id`, `nama_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `merk_kendaraan`, `warna_kendaraan`, `foto_kendaraan`, `tgl_berakhir_stnk`, `status_kepemilikan`, `status_kendaraan`, `created_at`, `updated_at`) VALUES
(2, 'Xpander cross', 'BM 9034 ARK', 'mobil', 'mitsubishi', 'HITAM', '1749684036_samsung a14.jpeg', '2025-06-20', 'pribadi', 'aktif', '2025-06-11 16:20:37', '2025-06-11 16:20:37'),
(3, 'Innova', 'BM 2020 AR', 'mobil', 'toyota', 'hijau', '1750217885_samsung-galaxy-s24-ultra-5g-sm-s928-0-600x600.jpg', '2025-06-26', 'pribadi', 'aktif', '2025-06-17 20:38:05', '2025-06-17 20:38:05'),
(4, 'Mc Laren Senna', 'BM 3008 IRU', 'mobil', 'dll', 'Orange', '1751557663_Screenshot-2022-11-08-141508-1024x564 (1).jpg', '2025-08-08', 'pribadi', 'aktif', '2025-07-03 08:47:44', '2025-07-03 08:47:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjamans_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_28_141713_create_kendaraans_table', 1),
(6, '2025_05_28_141755_create_peminjamans_table', 1),
(7, '2025_05_28_141810_create_laporans_table', 1),
(8, '2025_05_29_171634_create_asets_table', 1),
(9, '2025_05_30_125104_create_peminjaman_asets_table', 1),
(10, '2025_06_18_141612_add_keterangan_setelah_and_foto_setelah_to_peminjamans_table', 2),
(11, '2025_06_24_035804_add_kondisi_dan_foto_setelah_to_peminjaman_asets_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kendaraan_id` bigint(20) UNSIGNED NOT NULL,
  `waktu_awal_pinjam` datetime NOT NULL,
  `waktu_akhir_pinjam` datetime NOT NULL,
  `tujuan` text NOT NULL,
  `with_driver` enum('driver','bawa_sendiri') NOT NULL,
  `level_kepentingan` enum('penting','sangat_penting') NOT NULL DEFAULT 'penting',
  `keterangan` text NOT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `km_pergi` varchar(255) DEFAULT NULL,
  `km_kembali` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','tidak_disetujui','sedang_digunakan','selesai','menunggu_approval','pending') NOT NULL DEFAULT 'menunggu_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kondisi_setelah` text DEFAULT NULL,
  `foto_setelah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `user_id`, `kendaraan_id`, `waktu_awal_pinjam`, `waktu_akhir_pinjam`, `tujuan`, `with_driver`, `level_kepentingan`, `keterangan`, `waktu_kembali`, `km_pergi`, `km_kembali`, `status`, `created_at`, `updated_at`, `kondisi_setelah`, `foto_setelah`) VALUES
(8, 1, 4, '2025-06-12 12:00:00', '2025-06-14 12:00:00', 'bengkalis', 'driver', 'sangat_penting', 'dinas', '2025-06-14 12:00:00', '1000', '2000', 'selesai', '2025-06-17 20:27:53', '2025-07-12 23:15:16', NULL, NULL),
(9, 9, 3, '2025-07-12 22:22:00', '2025-08-12 12:00:00', 'kampar', 'bawa_sendiri', 'sangat_penting', 'dinas', '2025-08-14 22:22:00', '112233', '2000000', 'selesai', '2025-06-17 20:43:29', '2025-06-18 08:19:05', NULL, 'foto_pengembalian/ZG5u1jHRxuvsnYNBaCQMCpp6UkAhvYu6E23Dx6tc.jpg'),
(11, 9, 3, '2025-06-18 12:00:00', '2025-06-20 13:00:00', 'ke dinas', 'driver', 'penting', 'oke', '2025-06-20 14:00:00', NULL, '2000', 'selesai', '2025-06-17 20:58:55', '2025-06-18 08:23:06', NULL, 'foto_pengembalian/ytbkzEOwcTz4AgoNqgp4zeKDOfaztQ4RUsxA1kPe.jpg'),
(12, 9, 2, '2025-06-12 05:05:00', '2025-06-14 22:02:00', 'kampar', 'driver', 'sangat_penting', 'dinas', '2025-06-14 05:55:00', '1222', '300000', 'selesai', '2025-06-17 22:02:05', '2025-06-17 22:04:34', NULL, NULL),
(17, 1, 2, '2025-09-12 22:02:00', '2025-09-15 20:00:00', 'kamboja', 'bawa_sendiri', 'penting', 'study tour', '2025-02-15 22:22:00', '1000', '2000', 'selesai', '2025-06-18 06:16:23', '2025-06-18 08:26:22', 'bensin hilang', 'foto_pengembalian/IejK5ig5qdBd9rTVF9nkUUSSyY6JGsLjEME39hEV.jpg'),
(18, 9, 3, '2025-12-10 21:22:00', '2025-12-12 12:02:00', 'semarang', 'driver', 'sangat_penting', 'renang', '2025-12-13 12:02:00', '2000', '3000', 'selesai', '2025-06-18 06:25:27', '2025-07-09 06:26:10', 'aman', NULL),
(19, 9, 2, '2025-12-12 12:00:00', '2025-12-14 12:00:00', 'jepang', 'bawa_sendiri', 'sangat_penting', 'dinas', '2026-02-15 03:33:00', '1500', '145500', 'selesai', '2025-06-19 06:24:53', '2025-07-09 06:21:06', 'gacor', 'foto_pengembalian/PlTnHDj9XgjsXgp8TEf67iA6bqU8Uc4KcMOkFnOU.jpg'),
(20, 1, 2, '2024-02-12 22:22:00', '2025-02-12 03:03:00', 'lnl', 'driver', 'sangat_penting', 'dskdkd', '2025-03-12 22:02:00', '2344', '1234567', 'selesai', '2025-07-01 19:31:57', '2025-07-01 22:14:27', 'bagus', NULL),
(21, 9, 3, '2025-07-02 07:00:00', '2025-07-02 10:00:00', 'bengkalis', 'driver', 'penting', 'okr', '2025-07-02 10:06:00', '8000', '8100', 'selesai', '2025-07-01 20:45:24', '2025-07-09 06:06:12', 'bagus', 'foto_pengembalian/o5Ye79QTlIb49wCKxUoAERuTL0M9cbFiwnkupRiJ.jpg'),
(22, 1, 4, '2025-01-12 22:22:00', '2025-02-28 00:00:00', 'aceh', 'driver', 'sangat_penting', 'naise dude', NULL, '2000', NULL, 'tidak_disetujui', '2025-07-03 08:48:44', '2025-07-03 08:49:05', NULL, NULL),
(25, 9, 4, '2024-12-12 03:33:00', '2024-12-14 22:22:00', 'aceh', 'bawa_sendiri', 'penting', 'oke', '2015-02-12 22:22:00', '13555', '234566', 'selesai', '2025-07-07 00:51:23', '2025-07-09 05:54:11', NULL, NULL),
(26, 1, 2, '2022-02-20 22:02:00', '2025-02-25 22:02:00', 'amer', 'bawa_sendiri', 'penting', 'okeh', NULL, '1234', NULL, 'tidak_disetujui', '2025-07-07 01:03:48', '2025-07-09 06:05:39', NULL, NULL),
(28, 9, 4, '2012-10-10 02:02:00', '2013-10-10 20:20:00', 'inggris', 'bawa_sendiri', 'penting', 'ookee', NULL, '2000', NULL, 'tidak_disetujui', '2025-07-09 06:38:13', '2025-07-09 06:58:08', NULL, NULL),
(29, 9, 4, '2015-12-15 00:00:00', '2016-12-15 22:00:00', 'australia', 'bawa_sendiri', 'sangat_penting', 'oke', NULL, '122345', NULL, 'tidak_disetujui', '2025-07-09 06:40:20', '2025-07-09 06:58:41', NULL, NULL),
(33, 1, 3, '2022-03-12 22:02:00', '2024-02-22 04:44:00', 'pilipina', 'driver', 'penting', 'good', NULL, '12345', NULL, 'pending', '2025-07-09 07:15:19', '2025-07-09 07:15:27', NULL, NULL),
(34, 1, 2, '2002-08-30 13:59:00', '2025-08-30 00:00:00', 'dunia', 'bawa_sendiri', 'sangat_penting', 'liove u all', NULL, '800', NULL, 'tidak_disetujui', '2025-07-09 07:27:37', '2025-07-09 07:27:59', NULL, NULL),
(35, 9, 3, '2022-02-12 20:00:00', '2022-02-14 20:00:00', 'rumbai', 'driver', 'sangat_penting', 'damn', '2022-04-11 22:02:00', '1000', '10000', 'selesai', '2025-07-09 09:50:30', '2025-07-14 21:40:23', 'gas', NULL),
(36, 9, 2, '2022-02-12 22:02:00', '2022-04-24 22:02:00', 'rumbai', 'bawa_sendiri', 'penting', 'ok', '2022-06-25 20:00:00', '12345', '23456', 'selesai', '2025-07-09 09:53:56', '2025-07-14 21:26:59', 'mantul', NULL),
(37, 9, 2, '2022-02-12 22:02:00', '2025-04-14 05:05:00', 'rumbai', 'driver', 'penting', 'ok', '2025-12-15 00:00:00', '12345', '23456', 'selesai', '2025-07-09 09:55:28', '2025-07-14 21:26:07', 'oke', NULL),
(38, 9, 4, '2022-02-12 20:00:00', '2023-04-14 22:02:00', 'okee', 'bawa_sendiri', 'penting', 'naidd', NULL, '123', NULL, 'pending', '2025-07-09 10:01:56', '2025-07-12 08:55:08', NULL, NULL),
(39, 1, 4, '2012-12-12 12:12:00', '2013-11-11 11:11:00', 'wokeh', 'bawa_sendiri', 'sangat_penting', 'gasspol', NULL, '1000', NULL, 'sedang_digunakan', '2025-07-12 08:00:00', '2025-07-12 08:55:03', NULL, NULL),
(40, 1, 3, '2009-09-09 09:09:00', '2012-10-10 20:20:00', 'babussalam', 'bawa_sendiri', 'sangat_penting', 'okmen', NULL, '100', NULL, 'tidak_disetujui', '2025-07-12 08:36:00', '2025-07-12 08:54:59', NULL, NULL),
(41, 1, 4, '2024-12-12 20:20:00', '2025-12-12 12:21:00', 'afrika', 'bawa_sendiri', 'penting', 'oke bang', '2025-12-12 20:00:00', '10000', '1000', 'selesai', '2025-07-12 08:46:24', '2025-07-14 21:25:02', 'oke gas', NULL),
(42, 1, 4, '2022-02-20 22:22:00', '2023-02-23 23:23:00', 'medan', 'driver', 'penting', 'gas baang', '2012-12-14 22:02:00', '4000', '9000', 'selesai', '2025-07-12 08:47:59', '2025-07-14 21:15:15', 'gas', NULL),
(43, 9, 4, '2020-12-12 20:20:00', '2020-12-20 20:20:00', '2020', 'driver', 'penting', 'oke', '2025-07-15 07:00:00', '2000', '2300', 'selesai', '2025-07-12 21:51:00', '2025-07-15 00:29:11', 'bagus', NULL),
(44, 1, 4, '2024-08-30 20:59:00', '2024-11-09 22:02:00', 'rusia', 'driver', 'penting', 'oke kk', NULL, '990', NULL, 'menunggu_approval', '2025-07-14 20:35:53', '2025-07-14 20:35:53', NULL, NULL),
(45, 1, 2, '2012-12-12 12:12:00', '2014-08-30 22:00:00', 'amsterdam', 'bawa_sendiri', 'penting', 'mok', NULL, '1000', NULL, 'menunggu_approval', '2025-07-14 20:57:20', '2025-07-14 20:57:20', NULL, NULL),
(46, 1, 3, '2012-12-12 12:02:00', '2013-12-14 12:12:00', 'oke', 'driver', 'penting', 'oke', NULL, '2000', NULL, 'menunggu_approval', '2025-07-14 23:56:35', '2025-07-14 23:56:35', NULL, NULL),
(47, 1, 3, '2012-12-14 12:01:00', '2012-12-15 12:12:00', 'ok', 'bawa_sendiri', 'penting', 'ok', '2025-07-15 19:00:00', '100', '200', 'selesai', '2025-07-14 23:59:08', '2025-07-15 00:32:06', NULL, NULL),
(48, 1, 3, '2025-07-15 09:00:00', '2025-07-16 09:10:00', 'kemenag', 'driver', 'penting', 'oke', NULL, '1000', NULL, 'menunggu_approval', '2025-07-15 00:16:52', '2025-07-15 00:16:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_asets`
--

CREATE TABLE `peminjaman_asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `aset_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_awal_pinjam` datetime NOT NULL,
  `tgl_akhir_pinjam` datetime NOT NULL,
  `keperluan` text DEFAULT NULL,
  `status` enum('disetujui','tidak_disetujui','sedang_digunakan','menunggu_approval','selesai','pending') NOT NULL DEFAULT 'menunggu_approval',
  `tgl_kembali` datetime DEFAULT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `kondisi_setelah` text DEFAULT NULL,
  `foto_setelah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_asets`
--

INSERT INTO `peminjaman_asets` (`id`, `user_id`, `aset_id`, `tgl_awal_pinjam`, `tgl_akhir_pinjam`, `keperluan`, `status`, `tgl_kembali`, `nama_penerima`, `catatan`, `kondisi_setelah`, `foto_setelah`, `created_at`, `updated_at`) VALUES
(7, 1, 3, '2011-11-11 11:01:00', '2012-12-12 12:12:00', 'poke', 'disetujui', NULL, 'irlm', 'oke', NULL, NULL, '2025-07-10 07:44:30', '2025-07-11 17:42:20'),
(8, 1, 3, '2014-12-14 14:14:00', '2015-12-15 15:15:00', 'ngaji', 'selesai', '2015-12-16 05:01:00', 'irerummi', 'jahad', 'momok', NULL, '2025-07-12 12:23:16', '2025-07-12 22:46:32'),
(9, 1, 4, '2008-08-08 08:08:00', '2009-09-09 09:09:00', 'entah', 'selesai', '2024-12-12 21:21:00', 'mungkin saya', 'sikit', 'okeoke', NULL, '2025-07-12 12:28:49', '2025-07-12 22:44:29'),
(10, 1, 4, '2012-12-12 12:12:00', '2014-12-12 14:14:00', '1414', 'pending', NULL, 'airm', 'koe', NULL, NULL, '2025-07-12 12:36:13', '2025-07-12 12:38:02'),
(13, 1, 4, '2012-12-12 12:12:00', '2017-12-12 17:17:00', '1717', 'selesai', '2017-12-14 10:10:00', 'ijuk', 'naisek', 'oke', 'foto_pengembalian/FoKjBfduteDXeNKOaWb6mRiF92HvDl77pbBA0swz.jpg', '2025-07-12 12:37:52', '2025-07-14 05:15:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','gs','pegawai') NOT NULL DEFAULT 'pegawai',
  `unit` enum('masjid','bmt','tkit','sdit','mts','smpit','smait','sekretariat','keuangan','tpa','warung','dapur','direktorat') NOT NULL,
  `nip` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `unit`, `nip`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$E6/bzKCWE5S98BEUQqWl3ecFkZP73VsAKZCrSxvLDqFZJY5CWs7aW', 'admin', 'sekretariat', '123456', NULL, NULL, '2025-05-30 08:45:52', '2025-05-30 08:45:52'),
(2, 'GS', 'general@gmail.com', NULL, '$2y$12$IfLxD97ur4Z88fEjaR5jGOY5gN0Qk2bLeN41tTDoNbzTiugjmi.Te', 'gs', 'sekretariat', '1234567', NULL, NULL, '2025-05-30 08:45:52', '2025-05-30 08:45:52'),
(9, 'rahmat1', 'rahmat@gmail.com', NULL, '$2y$12$07nwRq3IODB8SoAF0RuEhuWmYFtVqiqP2/U4LoP43lpK0hGGQEO3S', 'pegawai', 'sdit', '112233', '1750217660_samsung a14.jpeg', NULL, '2025-06-17 20:34:21', '2025-06-17 20:34:53'),
(11, 'yatman', 'yatman@gmail.com', NULL, '$2y$12$KW0EnahnsJ5fWcAWFiXWDebmHE7yH3PMpZMXSzhkW3gLMkoDl23N2', 'pegawai', 'smpit', '123123', '1752074502_samsung-galaxy-s24-ultra-5g-sm-s928-0-600x600.jpg', NULL, '2025-07-09 08:21:43', '2025-07-09 08:21:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_peminjamans_id_index` (`peminjamans_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_user_id_foreign` (`user_id`),
  ADD KEY `peminjamans_kendaraan_id_foreign` (`kendaraan_id`);

--
-- Indeks untuk tabel `peminjaman_asets`
--
ALTER TABLE `peminjaman_asets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_asets_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_asets_aset_id_foreign` (`aset_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asets`
--
ALTER TABLE `asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraans`
--
ALTER TABLE `kendaraans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_asets`
--
ALTER TABLE `peminjaman_asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_peminjamans_id_foreign` FOREIGN KEY (`peminjamans_id`) REFERENCES `peminjamans` (`id`);

--
-- Ketidakleluasaan untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman_asets`
--
ALTER TABLE `peminjaman_asets`
  ADD CONSTRAINT `peminjaman_asets_aset_id_foreign` FOREIGN KEY (`aset_id`) REFERENCES `asets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_asets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
