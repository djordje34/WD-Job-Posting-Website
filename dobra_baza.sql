-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2022 at 03:59 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dobra_baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `firme`
--

DROP TABLE IF EXISTS `firme`;
CREATE TABLE IF NOT EXISTS `firme` (
  `id_f` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv_firme` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `id_poslodavca` int(11) NOT NULL,
  `slika` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_f`),
  UNIQUE KEY `Naziv_firme` (`Naziv_firme`),
  KEY `id_poslodavca` (`id_poslodavca`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `firme`
--

INSERT INTO `firme` (`id_f`, `Naziv_firme`, `id_poslodavca`, `slika`) VALUES
(25, 'opa', 87, NULL),
(26, 'bpfbpnmgnmg', 88, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id_k` int(11) NOT NULL AUTO_INCREMENT,
  `komentar` varchar(4000) COLLATE utf8mb4_bin NOT NULL,
  `ocena` int(11) NOT NULL,
  `id_firme` int(11) NOT NULL,
  `id_korisnika` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_k`),
  KEY `id_firme` (`id_firme`),
  KEY `id_korisnika` (`id_korisnika`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

DROP TABLE IF EXISTS `oglasi`;
CREATE TABLE IF NOT EXISTS `oglasi` (
  `id_o` int(11) NOT NULL AUTO_INCREMENT,
  `lokacija` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(4000) COLLATE utf8mb4_bin NOT NULL,
  `rok` date NOT NULL,
  `kontakt` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `sprema` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `struka` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `id_firme` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  PRIMARY KEY (`id_o`),
  KEY `id_firme` (`id_firme`),
  KEY `id_korisnika` (`id_korisnika`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`id_o`, `lokacija`, `opis`, `rok`, `kontakt`, `sprema`, `struka`, `id_firme`, `id_korisnika`) VALUES
(47, '56436534', '65478658657', '2022-03-09', '+381-65-500-1535', 'Osnovne studije', 'Mašinski inženjering', 25, 87),
(48, '6547651212543gmtmgt', 'jblujbueljuelj', '2022-03-09', '+381-65-500-1535', 'Osnovne studije', 'Mašinski inženjering', 25, 87),
(49, '121432', 'mbpnuejbpelbj', '2022-03-12', '+381-65-500-1535', 'Master studije', 'Mašinski inženjering', 25, 87),
(50, 'mgnmgemnemn', 'jbpjpbjpb', '2022-03-12', '+381-64-132-8407', 'Master studije', 'Telekomunikacioni inženjering', 26, 88),
(51, 'nmgfpbtw3`4326543', 'bpfbpfjmbpg', '2022-02-22', '+381-64-132-8407', 'Master studije', 'Telekomunikacioni inženjering', 26, 88),
(52, '21321312', 'mbgnmbgm', '2022-01-31', '+381-64-132-8407', 'Master studije', 'Telekomunikacioni inženjering', 26, 88),
(53, '1243', 'mgtmtg', '2022-02-05', '+381-64-132-8407', 'Osnovne studije', 'Telekomunikacioni inženjering', 26, 88),
(54, 'nmgnmgnmg', '231321', '2022-01-31', '+381-65-500-1535', 'Master studije', 'Mašinski inženjering', 25, 87);

-- --------------------------------------------------------

--
-- Table structure for table `poslodavac`
--

DROP TABLE IF EXISTS `poslodavac`;
CREATE TABLE IF NOT EXISTS `poslodavac` (
  `id_p` int(11) NOT NULL,
  `struka` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `poslodavac`
--

INSERT INTO `poslodavac` (`id_p`, `struka`) VALUES
(87, 'Mašinski inženjering'),
(88, 'Telekomunikacioni inženjering');

-- --------------------------------------------------------

--
-- Table structure for table `prijave`
--

DROP TABLE IF EXISTS `prijave`;
CREATE TABLE IF NOT EXISTS `prijave` (
  `id_pr` int(11) NOT NULL AUTO_INCREMENT,
  `id_prijavljenog` int(11) NOT NULL,
  `id_oglas` int(11) NOT NULL,
  `Datum_prijave` date DEFAULT NULL,
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `radnik`
--

DROP TABLE IF EXISTS `radnik`;
CREATE TABLE IF NOT EXISTS `radnik` (
  `id_r` int(11) NOT NULL,
  `Ime` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `informacije` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `polozaj` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `iskustvo` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `obrazovanje` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `CV` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id_r`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `radnik`
--

INSERT INTO `radnik` (`id_r`, `Ime`, `informacije`, `polozaj`, `iskustvo`, `obrazovanje`, `CV`) VALUES
(86, 'Filip', '2143245325433', 'Urbani inÅ¾enjering', '21', 'Master akademske studije', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_u` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `kontakt` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `choice` int(11) NOT NULL,
  PRIMARY KEY (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_u`, `username`, `password`, `email`, `kontakt`, `choice`) VALUES
(14, 'admin', '$2a$10$tBlDHAmlkFpyaxFn67tUKu4OE5j751iZZfJ4.25ehqHUu1y0jCuaS', 'admin@gmail.com', NULL, 3),
(86, 'test123', '$2y$10$poybcQavrvDIDpGi896Do.6zsunOZFidjQrknN8SZSne7t0P0sdbm', 'test123@t.t', '+381-65-300-1523', 2),
(87, 'test223', '$2y$10$SKje6giK2i0y/7e8YqqHIOGryCeuTnQhEZ5trrjHhCd9cr/0sj26u', 'test223@t.t', '+381-65-500-1535', 1),
(88, 'test323', '$2y$10$4../IiTyKhAqs1.yHiEN9.XplLJBXOvBDh/0kP8oRj7eAD/nulovW', 'test323@t.t', '+381-64-132-8407', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `poslodavac`
--
ALTER TABLE `poslodavac`
  ADD CONSTRAINT `poslodavac_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `users` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radnik`
--
ALTER TABLE `radnik`
  ADD CONSTRAINT `radnik_ibfk_1` FOREIGN KEY (`id_r`) REFERENCES `users` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
