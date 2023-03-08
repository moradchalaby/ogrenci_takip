-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 08 Mar 2023, 14:44:20
-- Sunucu sürümü: 10.11.2-MariaDB-log
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `akmescid`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alanlar`
--

CREATE TABLE `alanlar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alan_ad` varchar(255) NOT NULL,
  `alan_onem` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bekarhoca`
--

CREATE TABLE `bekarhoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birim`
--

CREATE TABLE `birim` (
  `birim_id` bigint(20) UNSIGNED NOT NULL,
  `birim_ad` varchar(255) NOT NULL,
  `birim_donem` varchar(255) DEFAULT NULL,
  `birim_durum` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birimhoca`
--

CREATE TABLE `birimhoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `birim_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birimsorumlu`
--

CREATE TABLE `birimsorumlu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `birim_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders`
--

CREATE TABLE `ders` (
  `ders_id` bigint(20) UNSIGNED NOT NULL,
  `ders_ad` varchar(255) DEFAULT NULL,
  `birim_id` int(11) DEFAULT NULL,
  `kullanici_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `kullanici_name` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
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
-- Tablo için tablo yapısı `hafizbelgesiz`
--

CREATE TABLE `hafizbelgesiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) UNSIGNED NOT NULL,
  `hafizlikdurum_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hafizlikdurum`
--

CREATE TABLE `hafizlikdurum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `hafizlik_durum` varchar(255) NOT NULL,
  `bast` date DEFAULT NULL,
  `sont` date DEFAULT NULL,
  `hafizlik_son` varchar(255) DEFAULT NULL,
  `hoca` int(11) DEFAULT NULL,
  `donus_suresi` varchar(255) NOT NULL DEFAULT '60',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hafizlikhoca`
--

CREATE TABLE `hafizlikhoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `birim_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hfzlkders`
--

CREATE TABLE `hfzlkders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hafizlik_sayfa` varchar(255) DEFAULT NULL,
  `hafizlik_cuz` varchar(255) DEFAULT NULL,
  `hafizlik_ders` varchar(50) DEFAULT NULL,
  `hafizlik_topl` varchar(255) DEFAULT NULL,
  `hafizlik_tarih` date DEFAULT NULL,
  `hafizlik_hata` varchar(255) DEFAULT NULL,
  `hafizlik_usul` varchar(255) DEFAULT NULL,
  `hafizlik_durum` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hrapor`
--

CREATE TABLE `hrapor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `hrapor_sayfa` varchar(255) NOT NULL,
  `hrapor_ders` varchar(255) NOT NULL,
  `hrapor_tarih` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `idarihoca`
--

CREATE TABLE `idarihoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ihtisashoca`
--

CREATE TABLE `ihtisashoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `kullanici_resim` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kullanici_dt` date NOT NULL DEFAULT '2020-01-01',
  `kullanici_tc` varchar(255) DEFAULT NULL,
  `kullanici_gsm` varchar(255) DEFAULT NULL,
  `kullanici_adres` text DEFAULT NULL,
  `kullanici_yetki` varchar(255) DEFAULT NULL,
  `kullanici_birim` varchar(255) DEFAULT NULL,
  `kullanici_sinif` varchar(255) DEFAULT NULL,
  `kullanici_durum` varchar(255) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanim`
--

CREATE TABLE `kullanim` (
  `alan_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `makbuz`
--

CREATE TABLE `makbuz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `kullanici_adsoyad` varchar(255) NOT NULL,
  `tutar` double NOT NULL,
  `kur` enum('₺','€','$') NOT NULL,
  `odeme_sekli` enum('BANKA','NAKİT') NOT NULL DEFAULT 'NAKİT',
  `tarih` date NOT NULL,
  `aciklama` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `muhtelifhoca`
--

CREATE TABLE `muhtelifhoca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odeme`
--

CREATE TABLE `odeme` (
  `odeme_id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `ogrenci_adsoyad` varchar(255) NOT NULL,
  `odeme_tutar` double NOT NULL,
  `odeme_kur` enum('₺','€','$') NOT NULL,
  `kullanici_name` varchar(255) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `odeme_tarih` date NOT NULL,
  `odeme_ay` varchar(255) NOT NULL,
  `odeme_makbuz` int(11) NOT NULL,
  `odeme_sekli` enum('BANKA','NAKİT') NOT NULL DEFAULT 'NAKİT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odevler`
--

CREATE TABLE `odevler` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baslik` varchar(255) DEFAULT NULL,
  `zaman` date DEFAULT NULL,
  `teslim` date DEFAULT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `sinif_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odevogrenci`
--

CREATE TABLE `odevogrenci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `odev_id` int(11) NOT NULL,
  `odev_durum` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_adsoyad` varchar(255) NOT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `ogrenci_dt` date NOT NULL DEFAULT '2020-01-01',
  `ogrenci_tc` varchar(255) DEFAULT NULL,
  `babaad` varchar(255) DEFAULT NULL,
  `annead` varchar(255) DEFAULT NULL,
  `babames` varchar(255) DEFAULT NULL,
  `annemes` varchar(255) DEFAULT NULL,
  `babatel` varchar(255) DEFAULT NULL,
  `annetel` varchar(255) DEFAULT NULL,
  `ogrenci_tel` varchar(255) DEFAULT NULL,
  `ogrenci_sehir` varchar(255) DEFAULT NULL,
  `ogrenci_adres` text DEFAULT NULL,
  `ogrenci_resim` varchar(255) DEFAULT NULL,
  `ogrenci_kmlk` varchar(255) DEFAULT NULL,
  `ogrenci_sglk` varchar(255) DEFAULT NULL,
  `ogrenci_belge1` varchar(255) DEFAULT NULL,
  `ogrenci_belge2` varchar(255) DEFAULT NULL,
  `ogrenci_belge3` varchar(255) DEFAULT NULL,
  `ogrenci_aciklama` text DEFAULT NULL,
  `ogrenci_yetim` enum('0','1') NOT NULL DEFAULT '0',
  `ogrenci_bosanma` enum('0','1') NOT NULL DEFAULT '0',
  `ogrenci_kytdurum` enum('0','1') NOT NULL DEFAULT '1',
  `ayrilma_tarih` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciacikl`
--

CREATE TABLE `ogrenciacikl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrencibirim`
--

CREATE TABLE `ogrencibirim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `birim_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciokul`
--

CREATE TABLE `ogrenciokul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `okul_id` int(11) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `basari` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciorgunl`
--

CREATE TABLE `ogrenciorgunl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciorta`
--

CREATE TABLE `ogrenciorta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciproje`
--

CREATE TABLE `ogrenciproje` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciuni`
--

CREATE TABLE `ogrenciuni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `okul`
--

CREATE TABLE `okul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `okul` varchar(255) NOT NULL,
  `okul_ad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `roles_slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `vazife_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinavlar`
--

CREATE TABLE `sinavlar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sinav_ad` varchar(255) DEFAULT NULL,
  `sinav_zaman` date DEFAULT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `sinif_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinavogrenci`
--

CREATE TABLE `sinavogrenci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `sinav_id` int(11) NOT NULL,
  `sinav_not` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinif`
--

CREATE TABLE `sinif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sinif_ad` varchar(255) DEFAULT NULL,
  `kullanici_id` int(11) NOT NULL,
  `sinif_birim` int(11) DEFAULT NULL,
  `sinif_durum` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinifders`
--

CREATE TABLE `sinifders` (
  `sinif_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `hoca_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teknikpersonel`
--

CREATE TABLE `teknikpersonel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `vazife` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `telegramlog`
--

CREATE TABLE `telegramlog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `telegramId` varchar(255) NOT NULL,
  `starterror` varchar(255) DEFAULT '3',
  `emailerror` varchar(255) DEFAULT '3',
  `passerror` varchar(255) DEFAULT '3',
  `ban` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `telegraph_bots`
--

CREATE TABLE `telegraph_bots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `telegraph_chats`
--

CREATE TABLE `telegraph_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telegraph_bot_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `kullanici_resim` varchar(255) NOT NULL DEFAULT 'dist/img/logo-yok.png',
  `password` varchar(255) NOT NULL,
  `telegramId` varchar(200) DEFAULT NULL,
  `kullanici_dt` date NOT NULL DEFAULT '2020-01-01',
  `kullanici_tc` varchar(255) DEFAULT NULL,
  `kullanici_gsm` varchar(255) DEFAULT NULL,
  `kullanici_adres` text DEFAULT NULL,
  `kullanici_durum` varchar(255) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoklama`
--

CREATE TABLE `yoklama` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yokalma_ad` varchar(255) NOT NULL,
  `yoklama_tarih` date NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `sinif_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoklamaogrenci`
--

CREATE TABLE `yoklamaogrenci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `yoklama_id` int(11) NOT NULL,
  `yoklama_durum` enum('0','1') NOT NULL,
  `aciklama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yuzune`
--

CREATE TABLE `yuzune` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yuzune_ad` varchar(255) NOT NULL,
  `yuzune_tur` varchar(255) DEFAULT NULL,
  `yuzune_tur2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yuzuneders`
--

CREATE TABLE `yuzuneders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `kullnaici_id` int(11) NOT NULL,
  `yuzune_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alanlar`
--
ALTER TABLE `alanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bekarhoca`
--
ALTER TABLE `bekarhoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `birim`
--
ALTER TABLE `birim`
  ADD PRIMARY KEY (`birim_id`);

--
-- Tablo için indeksler `birimhoca`
--
ALTER TABLE `birimhoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `birimsorumlu`
--
ALTER TABLE `birimsorumlu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ders`
--
ALTER TABLE `ders`
  ADD PRIMARY KEY (`ders_id`);

--
-- Tablo için indeksler `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `hafizbelgesiz`
--
ALTER TABLE `hafizbelgesiz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hafizlikdurum`
--
ALTER TABLE `hafizlikdurum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hafizlikhoca`
--
ALTER TABLE `hafizlikhoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hfzlkders`
--
ALTER TABLE `hfzlkders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hrapor`
--
ALTER TABLE `hrapor`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `idarihoca`
--
ALTER TABLE `idarihoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ihtisashoca`
--
ALTER TABLE `ihtisashoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_email_unique` (`email`);

--
-- Tablo için indeksler `makbuz`
--
ALTER TABLE `makbuz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `muhtelifhoca`
--
ALTER TABLE `muhtelifhoca`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odeme`
--
ALTER TABLE `odeme`
  ADD PRIMARY KEY (`odeme_id`);

--
-- Tablo için indeksler `odevler`
--
ALTER TABLE `odevler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odevogrenci`
--
ALTER TABLE `odevogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciacikl`
--
ALTER TABLE `ogrenciacikl`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrencibirim`
--
ALTER TABLE `ogrencibirim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciokul`
--
ALTER TABLE `ogrenciokul`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciorgunl`
--
ALTER TABLE `ogrenciorgunl`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciorta`
--
ALTER TABLE `ogrenciorta`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciproje`
--
ALTER TABLE `ogrenciproje`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciuni`
--
ALTER TABLE `ogrenciuni`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `okul`
--
ALTER TABLE `okul`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sinavlar`
--
ALTER TABLE `sinavlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sinavogrenci`
--
ALTER TABLE `sinavogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sinif`
--
ALTER TABLE `sinif`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `teknikpersonel`
--
ALTER TABLE `teknikpersonel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `telegramlog`
--
ALTER TABLE `telegramlog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telegramlog_telegramid_unique` (`telegramId`);

--
-- Tablo için indeksler `telegraph_bots`
--
ALTER TABLE `telegraph_bots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telegraph_bots_token_unique` (`token`);

--
-- Tablo için indeksler `telegraph_chats`
--
ALTER TABLE `telegraph_chats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telegraph_chats_chat_id_telegraph_bot_id_unique` (`chat_id`,`telegraph_bot_id`),
  ADD KEY `telegraph_chats_telegraph_bot_id_foreign` (`telegraph_bot_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `telegramId` (`telegramId`);

--
-- Tablo için indeksler `yoklama`
--
ALTER TABLE `yoklama`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yoklamaogrenci`
--
ALTER TABLE `yoklamaogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yuzune`
--
ALTER TABLE `yuzune`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yuzuneders`
--
ALTER TABLE `yuzuneders`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alanlar`
--
ALTER TABLE `alanlar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `bekarhoca`
--
ALTER TABLE `bekarhoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `birim`
--
ALTER TABLE `birim`
  MODIFY `birim_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `birimhoca`
--
ALTER TABLE `birimhoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `birimsorumlu`
--
ALTER TABLE `birimsorumlu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ders`
--
ALTER TABLE `ders`
  MODIFY `ders_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hafizbelgesiz`
--
ALTER TABLE `hafizbelgesiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hafizlikdurum`
--
ALTER TABLE `hafizlikdurum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hafizlikhoca`
--
ALTER TABLE `hafizlikhoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hfzlkders`
--
ALTER TABLE `hfzlkders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hrapor`
--
ALTER TABLE `hrapor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `idarihoca`
--
ALTER TABLE `idarihoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ihtisashoca`
--
ALTER TABLE `ihtisashoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `makbuz`
--
ALTER TABLE `makbuz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `muhtelifhoca`
--
ALTER TABLE `muhtelifhoca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `odeme`
--
ALTER TABLE `odeme`
  MODIFY `odeme_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `odevler`
--
ALTER TABLE `odevler`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `odevogrenci`
--
ALTER TABLE `odevogrenci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciacikl`
--
ALTER TABLE `ogrenciacikl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrencibirim`
--
ALTER TABLE `ogrencibirim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciokul`
--
ALTER TABLE `ogrenciokul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciorgunl`
--
ALTER TABLE `ogrenciorgunl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciorta`
--
ALTER TABLE `ogrenciorta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciproje`
--
ALTER TABLE `ogrenciproje`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciuni`
--
ALTER TABLE `ogrenciuni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `okul`
--
ALTER TABLE `okul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sinavlar`
--
ALTER TABLE `sinavlar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sinavogrenci`
--
ALTER TABLE `sinavogrenci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sinif`
--
ALTER TABLE `sinif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `teknikpersonel`
--
ALTER TABLE `teknikpersonel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `telegramlog`
--
ALTER TABLE `telegramlog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `telegraph_bots`
--
ALTER TABLE `telegraph_bots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `telegraph_chats`
--
ALTER TABLE `telegraph_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yoklama`
--
ALTER TABLE `yoklama`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yoklamaogrenci`
--
ALTER TABLE `yoklamaogrenci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yuzune`
--
ALTER TABLE `yuzune`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yuzuneders`
--
ALTER TABLE `yuzuneders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `telegraph_chats`
--
ALTER TABLE `telegraph_chats`
  ADD CONSTRAINT `telegraph_chats_telegraph_bot_id_foreign` FOREIGN KEY (`telegraph_bot_id`) REFERENCES `telegraph_bots` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `kullanici_resim`, `password`, `telegramId`, `kullanici_dt`, `kullanici_tc`, `kullanici_gsm`, `kullanici_adres`, `kullanici_durum`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'Murat Çelebi', 'root@root', NULL, '/storage/dimg/1resimHoca.jpg', '$2y$10$wh/nz0lVGh.hr3xMy2dTNuTHd2ZGW6kb4klEAz7r8/mIcH/wOfvza', '131850638', '2020-01-01', '60622310864', '5462057927', NULL, '1', 'y4mkbpWWTuoDOzvsi9eh70ZllFOFzuc29i6jEMz2d2FLIIdqnmXhigVxP2bQ', '2022-04-17 21:05:31', '2022-04-17 21:05:31');