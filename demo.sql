-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sie 2020, 16:05
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `demo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `participation` int(11) NOT NULL,
  `contributors` varchar(1024) DEFAULT NULL,
  `participations_contributors` varchar(255) DEFAULT NULL,
  `ministerial_points` int(11) NOT NULL,
  `journal` varchar(255) NOT NULL,
  `conference` varchar(255) NOT NULL,
  `doi` varchar(255) NOT NULL,
  `date_of_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `participation`, `contributors`, `participations_contributors`, `ministerial_points`, `journal`, `conference`, `doi`, `date_of_publication`) VALUES
(1, 'Electronic circuitry', 'Pawel Lech', 70, 'Adrian Kos', '30', 23, 'Journal of IT', 'Symposium (academic)', '10.1310/112', '2019-05-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `university`, `roles`, `password`) VALUES
(1, 'admin', '', '', '[]', '$argon2id$v=19$m=65536,t=4,p=1$alAxSjV2V3N1dEdsYUxTNA$X8mBaUzhuATBqua7IuOqEBbpxPpaZjXo1PTTPgC60kM'),
(2, 'qwerty', '', '', '[]', '$argon2id$v=19$m=65536,t=4,p=1$VXRRMVhQQjYveXBJMU9FLg$oxPAzI9O6EbnFl++1Yfp1VvG9I5K8tO83C5osTghJI4'),
(5, 'qwwwwwww', 'qweeerrr@o2.pl', '', '[]', '$argon2id$v=19$m=65536,t=4,p=1$b2JQRXFIQTdsOHNheXBOMQ$4Fz4eCJnxpmtWKXtiCcP2L+cEb40wwIgoB+6ollbdqE'),
(6, 'Pawel Lech', 'plech@tlen.pl', 'ZUT', '[]', '$argon2id$v=19$m=65536,t=4,p=1$OTA1Q1QxSzNRRWhHbVdNdg$fO0U9MXKd367zAMET8Ynjnfvs0lt5SNpFVAZnkHOtC0'),
(7, 'Mateusz Makowski', 'mmakowski@gmail.com', 'US', '[]', '$argon2id$v=19$m=65536,t=4,p=1$d1F4cFRucU8xbU04OVBLZA$Ms9+GKwXdYts6dA6gAnoiRCxxtUFop9sX06YrgcjJS4'),
(8, 'a', 'a@gmail.com', 'a', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Q3dVYTFJUExDODhOWTJSMQ$HIAqhlwdT7KMNA0QH4VEQZIUbNLrOmNT6khsURazK7s');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
