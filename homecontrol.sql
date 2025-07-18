-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 13. Jun 2019 um 17:29
-- Server-Version: 10.1.38-MariaDB-0+deb9u1
-- PHP-Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `homecontrol`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `codes`
--

CREATE TABLE `codes` (
  `id_codes` mediumint(8) NOT NULL,
  `name_codes` char(10) NOT NULL,
  `protocol` int(2) NOT NULL,
  `pulselength` int(4) NOT NULL,
  `value` int(20) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `type` char(5) NOT NULL,
  `id_groups` mediumint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `codes`
--

INSERT INTO `codes` (`id_codes`, `name_codes`, `protocol`, `pulselength`, `value`, `action`, `type`, `id_groups`) VALUES
(1, '301-1', 1, 161, 1398067, 1, 'light', NULL),
(2, '301-1', 1, 161, 1398076, 0, 'light', NULL),
(3, '301-2', 1, 161, 1398211, 1, 'light', NULL),
(4, '301-2', 1, 161, 1398220, 0, 'light', NULL),
(5, '301-3', 1, 161, 1398531, 1, 'light', NULL),
(6, '301-3', 1, 161, 1398540, 0, 'light', NULL),
(7, '303-1', 1, 164, 349491, 1, 'light', NULL),
(8, '303-1', 1, 164, 349500, 0, 'light', NULL),
(9, '303-2', 1, 164, 349635, 1, 'light', NULL),
(10, '303-2', 1, 164, 349644, 0, 'light', NULL),
(11, '303-3', 1, 164, 349955, 1, 'light', NULL),
(12, '303-3', 1, 164, 349964, 0, 'light', NULL),
(13, '305-1', 1, 346, 83029, 1, 'power', NULL),
(14, '305-1', 1, 346, 83028, 0, 'power', NULL),
(15, '505-2', 1, 346, 86101, 1, 'power', NULL),
(16, '505-2', 1, 346, 86100, 0, 'power', NULL),
(17, '505-3', 1, 346, 70741, 1, 'power', NULL),
(18, '505-3', 1, 346, 70740, 0, 'power', NULL),
(19, '505-4', 1, 346, 21589, 1, 'power', NULL),
(20, '505-4', 1, 346, 21588, 0, 'power', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE `groups` (
  `id_groups` mediumint(8) NOT NULL,
  `name_groups` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `groups`
--

INSERT INTO `groups` (`id_groups`, `name_groups`) VALUES
(1, 'Gruppe 1'),
(2, 'Gruppe 2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `state`
--

CREATE TABLE `state` (
  `id_state` mediumint(8) NOT NULL,
  `name_codes` int(10) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id_codes`);

--
-- Indizes für die Tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_groups`);

--
-- Indizes für die Tabelle `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id_state`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `codes`
--
ALTER TABLE `codes`
  MODIFY `id_codes` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `groups`
--
ALTER TABLE `groups`
  MODIFY `id_groups` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `state`
--
ALTER TABLE `state`
  MODIFY `id_state` mediumint(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
