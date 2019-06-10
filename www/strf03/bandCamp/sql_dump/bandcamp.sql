-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 10. čen 2019, 01:45
-- Verze serveru: 10.1.38-MariaDB
-- Verze PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bandcamp`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `content` longtext COLLATE utf8mb4_bin NOT NULL,
  `bands_band_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`article_id`, `header`, `content`, `bands_band_id`) VALUES
(13, 'První článek skupiny Kabát', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sit amet magna in magna gravida vehicula. Fusce aliquam vestibulum ipsum. Etiam neque. Praesent vitae arcu tempor neque lacinia pretium. Nullam dapibus fermentum ipsum. Sed convallis magna eu sem. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Pellentesque arcu. Aliquam erat volutpat.', 54),
(14, 'Druhý článek skupiny Kabát', 'Nulla non arcu lacinia neque faucibus fringilla. Nunc dapibus tortor vel mi dapibus sollicitudin. Aenean id metus id velit ullamcorper pulvinar. Phasellus faucibus molestie nisl. Nullam at arcu a est sollicitudin euismod. In convallis. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Vivamus porttitor turpis ac leo. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Etiam posuere lacus quis dolor.', 54),
(15, 'lorem ipstum', 'Nulla non arcu lacinia neque faucibus fringilla. Nunc dapibus tortor vel mi dapibus sollicitudin. Aenean id metus id velit ullamcorper pulvinar. Phasellus faucibus molestie nisl. Nullam at arcu a est sollicitudin euismod. In convallis. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Vivamus porttitor turpis ac leo. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Etiam posuere lacus quis dolor.', 55),
(16, 'Mydy rabycad article', 'Nulla non arcu lacinia neque faucibus fringilla. Nunc dapibus tortor vel mi dapibus sollicitudin. Aenean id metus id velit ullamcorper pulvinar. Phasellus faucibus molestie nisl. Nullam at arcu a est sollicitudin euismod. In convallis. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Vivamus porttitor turpis ac leo. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam.', 56);

-- --------------------------------------------------------

--
-- Struktura tabulky `bands`
--

CREATE TABLE `bands` (
  `band_id` int(11) NOT NULL,
  `band_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `likes` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_started` date NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `bands`
--

INSERT INTO `bands` (`band_id`, `band_name`, `email`, `likes`, `avatar`, `date_started`, `district`, `password`) VALUES
(54, 'Kabát', 'kabat@kabat.cz', 0, 'kabat1.png', '1971-01-01', 'Ústecký', '$2y$10$MF1BCiFey77bslWlVbDtUuXMneLFRzpOuWjvhUS867oHW79SXpeYq'),
(55, 'Fiktivní', 'fiktivni@fiktivni.cz', 0, 'fiktivni.png', '2019-03-12', 'Praha', '$2y$10$dRgpzN9jf6cmqCVJptNFAe8TPqmOA.zK75toBTk6F1bdMSDIv/Rje'),
(56, 'Mydy Rabycad', 'mydy@rabycad.cz', 0, 'mydyrabycad.png', '2016-06-22', 'Středočeský', '$2y$10$juXa5xlcZty87hBTnwSzzeztX9nDoQM35W1StNggRdfdD///In8j.');

-- --------------------------------------------------------

--
-- Struktura tabulky `bands_genres`
--

CREATE TABLE `bands_genres` (
  `music_genres_music_genre_id` int(11) NOT NULL,
  `bands_band_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `bands_genres`
--

INSERT INTO `bands_genres` (`music_genres_music_genre_id`, `bands_band_id`) VALUES
(1, 54),
(1, 55),
(2, 55),
(2, 56),
(3, 55),
(4, 55),
(5, 55),
(6, 55),
(7, 55),
(8, 55),
(8, 56);

-- --------------------------------------------------------

--
-- Struktura tabulky `band_members`
--

CREATE TABLE `band_members` (
  `users_user_id` int(11) NOT NULL,
  `bands_band_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_bin,
  `users_user_id` int(11) NOT NULL,
  `articles_articles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struktura tabulky `instruments`
--

CREATE TABLE `instruments` (
  `instrument_id` int(11) NOT NULL,
  `instrument_name` varchar(45) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `instruments`
--

INSERT INTO `instruments` (`instrument_id`, `instrument_name`) VALUES
(1, 'Klavír'),
(2, 'Kytara'),
(3, 'Bicí'),
(4, 'Saxofon'),
(5, 'Flétna'),
(6, 'Baskytara'),
(7, 'Basa'),
(8, 'Klávesy'),
(9, 'Banjo'),
(10, 'Klarinet'),
(11, 'Harmonika'),
(12, 'Housle'),
(13, 'Harfa');

-- --------------------------------------------------------

--
-- Struktura tabulky `listens_to`
--

CREATE TABLE `listens_to` (
  `users_user_id` int(11) NOT NULL,
  `music_genres_music_genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `listens_to`
--

INSERT INTO `listens_to` (`users_user_id`, `music_genres_music_genre_id`) VALUES
(20, 1),
(20, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `music_genres`
--

CREATE TABLE `music_genres` (
  `music_genre_id` int(11) NOT NULL,
  `music_genre_name` varchar(45) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `music_genres`
--

INSERT INTO `music_genres` (`music_genre_id`, `music_genre_name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Jazz'),
(4, 'Hip hop'),
(5, 'Country'),
(6, 'Blues'),
(7, 'Folk'),
(8, 'Electronic');

-- --------------------------------------------------------

--
-- Struktura tabulky `person_instrument`
--

CREATE TABLE `person_instrument` (
  `users_user_id` int(11) NOT NULL,
  `instruments_instrument_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `person_instrument`
--

INSERT INTO `person_instrument` (`users_user_id`, `instruments_instrument_id`) VALUES
(20, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_bin DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `email`, `first_name`, `last_name`, `phone`, `avatar`, `district`, `password`) VALUES
(20, 'strf03@vse.cz', 'František', 'Štrba', '987654321', NULL, 'Praha', '$2y$10$MlFiruDR8WDWBJa0mrGLWueOX3SvZYJn65WBQS7beFl7/bqZmgJSi');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `fk_Articles_Bands1_idx` (`bands_band_id`);

--
-- Klíče pro tabulku `bands`
--
ALTER TABLE `bands`
  ADD PRIMARY KEY (`band_id`);

--
-- Klíče pro tabulku `bands_genres`
--
ALTER TABLE `bands_genres`
  ADD UNIQUE KEY `Unique` (`music_genres_music_genre_id`,`bands_band_id`),
  ADD KEY `fk_Music_genres_has_Bands_Bands1_idx` (`bands_band_id`),
  ADD KEY `fk_Music_genres_has_Bands_Music_genres1_idx` (`music_genres_music_genre_id`);

--
-- Klíče pro tabulku `band_members`
--
ALTER TABLE `band_members`
  ADD PRIMARY KEY (`bands_band_id`,`users_user_id`),
  ADD KEY `fk_Users_has_Bands_Bands1_idx` (`bands_band_id`),
  ADD KEY `fk_Users_has_Bands_Users1_idx` (`users_user_id`);

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_Comments_Users1_idx` (`users_user_id`),
  ADD KEY `fk_Comments_Articles1_idx` (`articles_articles_id`);

--
-- Klíče pro tabulku `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`instrument_id`);

--
-- Klíče pro tabulku `listens_to`
--
ALTER TABLE `listens_to`
  ADD UNIQUE KEY `Unique_listens_to` (`users_user_id`,`music_genres_music_genre_id`),
  ADD KEY `fk_Users_has_Music_genres_Music_genres1_idx` (`music_genres_music_genre_id`),
  ADD KEY `fk_Users_has_Music_genres_Users1_idx` (`users_user_id`);

--
-- Klíče pro tabulku `music_genres`
--
ALTER TABLE `music_genres`
  ADD PRIMARY KEY (`music_genre_id`);

--
-- Klíče pro tabulku `person_instrument`
--
ALTER TABLE `person_instrument`
  ADD PRIMARY KEY (`users_user_id`,`instruments_instrument_id`),
  ADD KEY `fk_Users_has_Instruments_Instruments1_idx` (`instruments_instrument_id`),
  ADD KEY `fk_Users_has_Instruments_Users_idx` (`users_user_id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `bands`
--
ALTER TABLE `bands`
  MODIFY `band_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `instruments`
--
ALTER TABLE `instruments`
  MODIFY `instrument_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `music_genres`
--
ALTER TABLE `music_genres`
  MODIFY `music_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_Articles_Bands1` FOREIGN KEY (`bands_band_id`) REFERENCES `bands` (`band_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `bands_genres`
--
ALTER TABLE `bands_genres`
  ADD CONSTRAINT `fk_Music_genres_has_Bands_Bands1` FOREIGN KEY (`bands_band_id`) REFERENCES `bands` (`band_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Music_genres_has_Bands_Music_genres1` FOREIGN KEY (`music_genres_music_genre_id`) REFERENCES `music_genres` (`music_genre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `band_members`
--
ALTER TABLE `band_members`
  ADD CONSTRAINT `fk_Users_has_Bands_Bands1` FOREIGN KEY (`bands_band_id`) REFERENCES `bands` (`band_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Bands_Users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_Comments_Articles1` FOREIGN KEY (`articles_articles_id`) REFERENCES `articles` (`article_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comments_Users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `listens_to`
--
ALTER TABLE `listens_to`
  ADD CONSTRAINT `fk_Users_has_Music_genres_Music_genres1` FOREIGN KEY (`music_genres_music_genre_id`) REFERENCES `music_genres` (`music_genre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Music_genres_Users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `person_instrument`
--
ALTER TABLE `person_instrument`
  ADD CONSTRAINT `fk_Users_has_Instruments_Instruments1` FOREIGN KEY (`instruments_instrument_id`) REFERENCES `instruments` (`instrument_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Instruments_Users` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
