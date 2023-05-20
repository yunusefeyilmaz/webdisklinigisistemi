-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 May 2023, 11:23:36
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `discirandevu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktorlar`
--

CREATE TABLE `doktorlar` (
  `doktor_id` smallint(5) UNSIGNED NOT NULL,
  `doktor_kullaniciadi` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `doktor_adsoyadi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(128) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `unvan` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `adsoyadi` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telno` varchar(11) NOT NULL,
  `doktor_id` int(11) NOT NULL,
  `randevu_tarih` date NOT NULL,
  `randevu_saat` time NOT NULL,
  `hasta_text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hastalar`
--

INSERT INTO `hastalar` (`hasta_id`, `adsoyadi`, `email`, `telno`, `doktor_id`, `randevu_tarih`, `randevu_saat`, `hasta_text`) VALUES
(5, 'Ayşe', 'asddas@dasdas.com', '25465452', 2, '2023-05-19', '02:11:00', 'Diş bakımı'),
(12, 'Mehmet Güven', 'mehmet@hotmail.com', '05484564564', 1, '2023-05-21', '09:00:00', 'Diş ağrısı NOT alinidi'),
(13, 'Mehmet Yüksek', 'mehmet@gmail.com', '05461234567', 1, '2023-05-19', '13:59:00', 'Diş ağrısı'),
(30, 'Ayşe Öztürk', 'ayse@gmail.com', '05891234567', 1, '2023-05-20', '18:20:00', 'Diş teli'),
(31, 'Kadriye Türk', 'kadriye@hotmail.com', '05784567891', 1, '2023-05-20', '14:50:00', 'Diş ağrısı');

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
  MODIFY `hasta_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
