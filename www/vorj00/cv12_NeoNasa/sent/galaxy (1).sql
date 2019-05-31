-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 02.Máj 2019, 14:03
-- Verzia serveru: 10.1.38-MariaDB
-- Verzia PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `test`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `galaxy`
--

CREATE TABLE `galaxy` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` decimal(8,2) DEFAULT NULL,
  `img` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `galaxy`
--

INSERT INTO `galaxy` (`id`, `name`, `capacity`, `img`) VALUES
(1, 'Polygalaceae', '18933.77', 'http://dummyimage.com/114x120.png/cc0000/ffffff'),
(2, 'Polygonaceae', '41351.62', 'http://dummyimage.com/155x120.jpg/ff4444/ffffff'),
(3, 'Caryophyllaceae', '20732.01', 'http://dummyimage.com/137x248.png/ff4444/ffffff'),
(4, 'Portulacaceae', '36637.99', 'http://dummyimage.com/109x247.png/cc0000/ffffff'),
(5, 'Asteraceae', '46382.48', 'http://dummyimage.com/212x121.jpg/dddddd/000000'),
(6, 'Fabaceae', '94817.70', 'http://dummyimage.com/250x228.bmp/dddddd/000000'),
(7, 'Rubiaceae', '75894.16', 'http://dummyimage.com/143x218.bmp/dddddd/000000'),
(8, 'Lamiaceae', '63691.52', 'http://dummyimage.com/121x195.png/dddddd/000000'),
(9, 'Apiaceae', '44533.08', 'http://dummyimage.com/196x222.png/ff4444/ffffff'),
(0, 'Malpighiaceae', '63593.76', 'http://dummyimage.com/119x196.png/ff4444/ffffff');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
