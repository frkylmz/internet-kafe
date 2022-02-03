-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 18 Ara 2021, 23:01:28
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `internet_kafe`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

DROP TABLE IF EXISTS `ayarlar`;
CREATE TABLE IF NOT EXISTS `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` text NOT NULL,
  `site_slogan` text NOT NULL,
  `site_description` text NOT NULL,
  `site_keywords` text NOT NULL,
  `site_copright` varchar(255) NOT NULL,
  `site_telefon` varchar(255) NOT NULL,
  `site_calsaat` text NOT NULL,
  `site_eposta` text NOT NULL,
  `site_adres` text NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_title`, `site_slogan`, `site_description`, `site_keywords`, `site_copright`, `site_telefon`, `site_calsaat`, `site_eposta`, `site_adres`, `updatedAt`) VALUES
(1, 'BBF İnternet Kafe', 'BBF İnternet Kafe', 'BBF İnternet Kafe', 'bbf internet kafe', 'Copyright © 2021', '(0232) 412 12 12', 'Pazartesi - Cumartesi 08:00 - 23:00', 'bbfinternetkafe@gmail.com', 'Adatepe, Erdem Cd., 35400 Buca/İzmir', '2021-12-18 16:57:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

DROP TABLE IF EXISTS `duyurular`;
CREATE TABLE IF NOT EXISTS `duyurular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` text NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yazar` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `icerik`, `tarih`, `yazar`) VALUES
(2, 'Arama', 'Randevu talebinizden sonra sizi arayacağız.', '2021-12-17 04:12:51', 'Faruk Yılmaz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetler`
--

DROP TABLE IF EXISTS `hizmetler`;
CREATE TABLE IF NOT EXISTS `hizmetler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urunbaslik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `hizmetler`
--

INSERT INTO `hizmetler` (`id`, `urunbaslik`, `tarih`, `ekleyen`) VALUES
(1, 'Platinum Gaming 8₺', '2021-12-17 01:00:58', 'Faruk'),
(4, 'Elite Gaming 12₺', '2021-12-17 01:01:34', 'Faruk'),
(5, 'Stream Render 16₺', '2021-12-17 01:01:51', 'Faruk');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `randevular`
--

DROP TABLE IF EXISTS `randevular`;
CREATE TABLE IF NOT EXISTS `randevular` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adsoyad` text COLLATE utf8_turkish_ci NOT NULL,
  `telefon` text COLLATE utf8_turkish_ci NOT NULL,
  `hizmet` text COLLATE utf8_turkish_ci NOT NULL,
  `randevu_tarihi` date NOT NULL,
  `randevu_saati` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `yoneticicevap` text COLLATE utf8_turkish_ci NOT NULL,
  `durum` text CHARACTER SET utf8 NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `randevular`
--

INSERT INTO `randevular` (`id`, `adsoyad`, `telefon`, `hizmet`, `randevu_tarihi`, `randevu_saati`, `aciklama`, `yoneticicevap`, `durum`, `createdAt`) VALUES
(124, 'Tayfun Dağcı', '0541 382 79 24', 'Platinum Gaming 8₺', '2021-12-17', '08:00', 'Deneme', 'Onaylı', '1', '2021-12-18 16:41:49'),
(125, 'Bengisu Taşdelen', '0541 222 11 33', 'Stream Render 16₺', '2022-04-15', '17:00', 'Deneme 2', 'İptal', '1', '2021-12-18 18:02:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

DROP TABLE IF EXISTS `yoneticiler`;
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alanid` text NOT NULL,
  `kullaniciadi` text NOT NULL,
  `email` text,
  `password` text,
  `adiniz` text NOT NULL,
  `aciklama` text NOT NULL,
  `telefon` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `alanid`, `kullaniciadi`, `email`, `password`, `adiniz`, `aciklama`, `telefon`) VALUES
(1, '', 'yonetici', 'yonetici@farukyilmaz.com', '12345', 'Faruk Yılmaz', 'demo', 'demo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
