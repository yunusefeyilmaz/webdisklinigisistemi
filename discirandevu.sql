-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql312.epizy.com
-- Üretim Zamanı: 20 May 2023, 03:45:02
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `epiz_34242564_discirandevu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktorlar`
--

CREATE TABLE `doktorlar` (
  `doktor_id` smallint(5) UNSIGNED NOT NULL,
  `doktor_kullaniciadi` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `doktor_adsoyadi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sifre` varchar(128) COLLATE utf8mb4_turkish_ci NOT NULL,
  `unvan` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `doktorlar`
--

INSERT INTO `doktorlar` (`doktor_id`, `doktor_kullaniciadi`, `doktor_adsoyadi`, `sifre`, `unvan`) VALUES
(1, 'yunus', 'Yunus Efe Yılmaz', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Doktor'),
(3, 'mehmet', 'Mehmet Yıldız', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Yardımcı'),
(4, 'muhammed', 'Muhammed ', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Professör');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastalar`
--

CREATE TABLE `hastalar` (
  `hasta_id` smallint(5) UNSIGNED NOT NULL,
  `adsoyadi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_turkish_ci NOT NULL,
  `telno` varchar(11) COLLATE utf8mb4_turkish_ci NOT NULL,
  `doktor_id` int(11) NOT NULL,
  `randevu_tarih` date NOT NULL,
  `randevu_saat` time NOT NULL,
  `hasta_text` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hastalar`
--

INSERT INTO `hastalar` (`hasta_id`, `adsoyadi`, `email`, `telno`, `doktor_id`, `randevu_tarih`, `randevu_saat`, `hasta_text`) VALUES
(5, 'Ayşe', 'asddas@dasdas.com', '25465452', 2, '2023-05-19', '02:11:00', '\0Diş bakımı'),
(12, 'Mehmet Güven', 'mehmet@hotmail.com', '05484564545', 1, '2023-05-24', '09:00:00', 'Diş ağrısı NOT alinidi'),
(32, 'adsdas', 'asdsad@adasads.com', '05467894561', 1, '2023-05-21', '10:19:00', 'Ağrı');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `doktorlar`
--
ALTER TABLE `doktorlar`
  ADD PRIMARY KEY (`doktor_id`);

--
-- Tablo için indeksler `hastalar`
--
ALTER TABLE `hastalar`
  ADD PRIMARY KEY (`hasta_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `doktorlar`
--
ALTER TABLE `doktorlar`
  MODIFY `doktor_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `hastalar`
--
ALTER TABLE `hastalar`
  MODIFY `hasta_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
