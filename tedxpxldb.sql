-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 21 mei 2015 om 20:22
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `tedxpxldb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `naam` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `beginuur` time NOT NULL,
  `einduur` time DEFAULT NULL,
  `commentaar` varchar(255) DEFAULT NULL,
  `locatie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `events`
--

INSERT INTO `events` (`naam`, `datum`, `beginuur`, `einduur`, `commentaar`, `locatie`) VALUES
('Presentatie basic security', '2015-05-22', '11:10:00', '11:40:00', '', ''),
('Presentatie web project', '2015-05-26', '10:40:00', '11:10:00', 'Succes jongens!', 'Elfde-Liniestraat 24, Hasselt, Belgium'),
('VWclub België Meeting', '2015-05-30', '10:00:00', '18:00:00', 'Polo''s, Golf''s, Passat''s,... Allemaal welkom!', 'C-Mine, Genk, Belgium');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `temp_users`
--

CREATE TABLE IF NOT EXISTS `temp_users` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'hello@welcome.com', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`naam`), ADD FULLTEXT KEY `commentaar` (`commentaar`);

--
-- Indexen voor tabel `temp_users`
--
ALTER TABLE `temp_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `temp_users`
--
ALTER TABLE `temp_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
