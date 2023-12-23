-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2023 at 01:42 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uros_projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id_komentara` int(11) NOT NULL AUTO_INCREMENT,
  `posetilac` varchar(45) NOT NULL,
  `id_vesti` int(11) NOT NULL,
  `sadrzaj` varchar(200) NOT NULL,
  `broj_lajkova` int(11) NOT NULL,
  `broj_dislajkova` int(11) NOT NULL,
  `datum_vreme` datetime DEFAULT NULL,
  PRIMARY KEY (`id_komentara`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `novinar_rubrika`
--

DROP TABLE IF EXISTS `novinar_rubrika`;
CREATE TABLE IF NOT EXISTS `novinar_rubrika` (
  `id_novinar_rubrika` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubrike` int(11) NOT NULL,
  `id_novinara` int(11) NOT NULL,
  PRIMARY KEY (`id_novinar_rubrika`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `redakcija`
--

DROP TABLE IF EXISTS `redakcija`;
CREATE TABLE IF NOT EXISTS `redakcija` (
  `id_korisnika` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(300) NOT NULL,
  `ime_prezime` varchar(70) NOT NULL,
  `uloga` varchar(45) NOT NULL,
  PRIMARY KEY (`id_korisnika`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rubrika`
--

DROP TABLE IF EXISTS `rubrika`;
CREATE TABLE IF NOT EXISTS `rubrika` (
  `id_rubrike` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rubrike`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tagovi`
--

DROP TABLE IF EXISTS `tagovi`;
CREATE TABLE IF NOT EXISTS `tagovi` (
  `id_taga` int(11) NOT NULL AUTO_INCREMENT,
  `id_vesti` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id_taga`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `urednik_rubrika`
--

DROP TABLE IF EXISTS `urednik_rubrika`;
CREATE TABLE IF NOT EXISTS `urednik_rubrika` (
  `id_urednik_rubrika` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubrike` int(11) NOT NULL,
  `id_urednika` int(11) NOT NULL,
  PRIMARY KEY (`id_urednik_rubrika`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vest`
--

DROP TABLE IF EXISTS `vest`;
CREATE TABLE IF NOT EXISTS `vest` (
  `id_vesti` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(200) NOT NULL,
  `sadrzaj` mediumtext NOT NULL,
  `id_rubrike` int(11) NOT NULL,
  `datum_vreme` datetime DEFAULT NULL,
  `broj_lajkova` int(11) NOT NULL,
  `broj_dislajkova` int(11) NOT NULL,
  `stanje` varchar(45) NOT NULL,
  `id_novinara` int(11) NOT NULL,
  PRIMARY KEY (`id_vesti`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
