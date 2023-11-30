-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 04 Kas 2023, 15:08:00
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `coursedb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategoriAdi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategoriAdi`) VALUES
(33, 'Yapay Zeka'),
(2, 'Web Geliştir'),
(3, 'Veri Analizi'),
(4, 'Mobil Uygulama');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurslar`
--

DROP TABLE IF EXISTS `kurslar`;
CREATE TABLE IF NOT EXISTS `kurslar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `baslik` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `altbaslik` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aciklama` text COLLATE utf8mb4_general_ci,
  `resim` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `yorumSayisi` int NOT NULL,
  `begeniSayisi` int NOT NULL,
  `onay` tinyint(1) NOT NULL,
  `YayınTarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anasayfa` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurslar`
--

INSERT INTO `kurslar` (`id`, `baslik`, `altbaslik`, `aciklama`, `resim`, `yorumSayisi`, `begeniSayisi`, `onay`, `YayınTarihi`, `anasayfa`) VALUES
(1, 'Php Kursu 2', 'İleri Seviye Php Dersleri', 'dfgkblsgfyasfdıyufbgs', '2.jpg', 12, 13, 1, '2023-10-10 19:42:00', 1),
(2, 'React Kursu', 'İleri Seviye React  Dersleri', '', '1.jpg', 12, 13, 1, '2023-10-10 19:42:00', 1),
(3, 'Javascriptt Kursu', 'İleri Seviye Javascript Dersleri', '', '3.jpg', 12, 13, 1, '2023-10-10 19:42:00', 0),
(4, 'Node.js Kursu', 'İleri Seviye Node.js Dersleri', '', '3.jpg', 12, 13, 1, '2023-10-10 19:42:00', 1),
(17, 'Php Kursu 3', 'PHP App', 'PHP App', '1.jpg', 2, 0, 1, '2023-11-02 17:13:11', 1),
(18, 'GORKEM', 'GORKEM  CAĞN', 'asdfsnbpdoıfhgsodpıybs', '1.jpg', 33, 0, 1, '2023-11-03 17:19:58', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurslar_kategori`
--

DROP TABLE IF EXISTS `kurslar_kategori`;
CREATE TABLE IF NOT EXISTS `kurslar_kategori` (
  `kurs_id` int NOT NULL,
  `kategori_id` int NOT NULL,
  PRIMARY KEY (`kurs_id`,`kategori_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurslar_kategori`
--

INSERT INTO `kurslar_kategori` (`kurs_id`, `kategori_id`) VALUES
(2, 2),
(3, 3),
(4, 4),
(5, 33),
(6, 1),
(6, 3),
(6, 4),
(12, 1),
(15, 4),
(18, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_added`, `users_type`) VALUES
(1, 'EmreEyenen', 'infi@eynen.com', '$2y$10$Eo94LdRtPQevLvjBp2OUUuyAJVqDWY9HMNWqvxkVDj4r5R9E4ETbq', '2023-11-03 17:40:12', 'user'),
(2, 'EmreEnesYenen', 'infi@eeynen.com', '$2y$10$Km9eZXbhwQA6vArnyOcxCe.KS42HmwfSB5EfTZZnIcqjz4dAtliYm', '2023-11-03 18:51:00', 'user'),
(3, 'yenenemreenes', 'infi@eeynen1.com', '$2y$10$x47nHhKf/ShOzMv6IjuZUunQHt05jxUx7eLDvK7ZnQDoZHn.Gvc0G', '2023-11-03 18:53:00', 'user'),
(4, 'emreenesyenen1', 'emre@gmail.com', '$2y$10$HTZXvJ0C8dWLe4XIzpQ7YeUiXftT6s6SrAfgC.bcIPSsXj1wCHpcu', '2023-11-04 15:28:01', 'Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
