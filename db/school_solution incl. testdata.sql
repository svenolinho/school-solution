-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Feb 2016 um 13:00
-- Server-Version: 5.7.11-log
-- PHP-Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `school_solution`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fach`
--

CREATE TABLE `fach` (
  `PK_Fachnr` int(11) NOT NULL,
  `FACH_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `fach`
--

INSERT INTO `fach` (`PK_Fachnr`, `FACH_name`) VALUES
(4, 'Englisch'),
(5, 'Französisch'),
(6, 'Datenbanken'),
(7, 'Mathematik'),
(8, 'Softwareentwicklung'),
(9, 'Digitaltechnik'),
(10, 'Elektrotechnik');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `klasse`
--

CREATE TABLE `klasse` (
  `PK_Klassenr` int(11) NOT NULL,
  `KLA_name` varchar(50) NOT NULL,
  `KLA_notiz` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `klasse`
--

INSERT INTO `klasse` (`PK_Klassenr`, `KLA_name`, `KLA_notiz`) VALUES
(5, 'B15sy2.1', NULL),
(6, 'B15sy3.1', NULL),
(10, 'B13te3.1', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrer`
--

CREATE TABLE `lehrer` (
  `PK_Lehrernr` int(11) NOT NULL,
  `LEH_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruefungen`
--

CREATE TABLE `pruefungen` (
  `PK_Pruefnr` int(11) NOT NULL,
  `PRUEF_fach` int(11) NOT NULL,
  `PRUEF_klasse` int(11) NOT NULL,
  `PRUEF_notenschluessel` varchar(50) NOT NULL,
  `PRUEF_datum` date NOT NULL,
  `PRUEF_maxpunktzahl` float NOT NULL,
  `PRUEF_notiz` longtext CHARACTER SET latin1 COLLATE latin1_german2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pruefungen`
--

INSERT INTO `pruefungen` (`PK_Pruefnr`, `PRUEF_fach`, `PRUEF_klasse`, `PRUEF_notenschluessel`, `PRUEF_datum`, `PRUEF_maxpunktzahl`, `PRUEF_notiz`) VALUES
(3, 6, 10, '1+(5*(e/m))', '2016-02-09', 80, NULL),
(7, 10, 10, '1+(5*(e/m))', '2016-02-10', 90, NULL),
(9, 4, 10, '1+(5*(e/m))', '2016-02-02', 60, NULL),
(11, 8, 10, '1+(5*(e/m))', '2016-02-19', 80, NULL),
(12, 4, 10, '1+(5*(e/m))', '2016-03-09', 100, NULL),
(13, 6, 5, '1+(5*(e/m))', '2016-02-18', 60, NULL),
(14, 8, 5, '1+(5*(e/m))', '2016-02-17', 90, NULL),
(15, 9, 5, '1+(5*(e/m))', '2016-03-24', 60, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruefung_student`
--

CREATE TABLE `pruefung_student` (
  `PK_PruefStudnr` int(11) NOT NULL,
  `PruefStud_pruefung` int(11) NOT NULL,
  `PruefStud_student` int(11) NOT NULL,
  `PruefStud_anwesend` tinyint(1) NOT NULL,
  `PruefStud_punktzahl` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `pruefung_student`
--

INSERT INTO `pruefung_student` (`PK_PruefStudnr`, `PruefStud_pruefung`, `PruefStud_student`, `PruefStud_anwesend`, `PruefStud_punktzahl`) VALUES
(6, 9, 31, 1, 40),
(7, 9, 80, 1, 52),
(8, 9, 46, 1, 32),
(9, 9, 41, 1, 56),
(10, 9, 45, 1, 12),
(11, 9, 87, 1, 45),
(12, 9, 92, 1, 50),
(13, 9, 38, 1, 48),
(14, 9, 73, 1, 52),
(15, 9, 26, 1, 54),
(16, 9, 110, 1, 36),
(17, 9, 68, 1, 29),
(18, 9, 47, 1, 31),
(19, 9, 79, 1, 35),
(20, 9, 54, 1, 36),
(21, 3, 31, 1, 74),
(22, 3, 80, 1, 70),
(23, 3, 46, 1, 80),
(24, 3, 41, 1, 50),
(25, 3, 41, 1, 52),
(26, 3, 45, 1, 48),
(27, 3, 87, 1, 38),
(28, 3, 92, 1, 58),
(29, 3, 38, 1, 62),
(30, 3, 73, 1, 74),
(31, 3, 26, 1, 70),
(32, 3, 110, 1, 18),
(33, 3, 68, 1, 29),
(34, 3, 47, 1, 71),
(35, 3, 79, 1, 69),
(36, 3, 54, 1, 79),
(37, 7, 31, 1, 82),
(38, 7, 80, 1, 70),
(39, 7, 46, 1, 42),
(40, 7, 41, 1, 46),
(41, 7, 45, 1, 58),
(42, 7, 87, 1, 78),
(43, 7, 92, 1, 69),
(44, 7, 38, 1, 79),
(45, 7, 73, 1, 75),
(46, 7, 73, 1, 79),
(47, 7, 26, 1, 72),
(48, 7, 110, 1, 75),
(49, 7, 68, 1, 65),
(50, 7, 47, 1, 61),
(51, 7, 79, 1, 59),
(52, 7, 54, 1, 48),
(53, 11, 31, 1, 80),
(54, 11, 80, 1, 73),
(55, 11, 46, 1, 73),
(56, 11, 41, 1, 69),
(57, 11, 45, 1, 69),
(58, 11, 87, 1, 48),
(59, 11, 92, 1, 49),
(60, 11, 38, 1, 76),
(61, 11, 73, 1, 72),
(62, 11, 26, 1, 69),
(63, 11, 110, 1, 64),
(64, 11, 68, 1, 58),
(65, 11, 47, 1, 27),
(66, 11, 79, 1, 48),
(67, 11, 54, 1, 49),
(68, 12, 31, 1, 80),
(69, 12, 80, 1, 82),
(70, 12, 46, 1, 68),
(71, 12, 41, 1, 69),
(72, 12, 45, 1, 79),
(73, 12, 87, 1, 84),
(74, 12, 92, 1, 90),
(75, 12, 38, 1, 93),
(76, 12, 73, 1, 79),
(77, 12, 26, 1, 49),
(78, 12, 110, 1, 74),
(79, 12, 68, 1, 64),
(80, 12, 47, 1, 70),
(81, 12, 79, 1, 90),
(82, 12, 54, 1, 100),
(83, 13, 115, 1, 58),
(84, 13, 106, 1, 56),
(85, 13, 120, 1, 49),
(86, 13, 81, 1, 45),
(87, 13, 40, 1, 60),
(88, 13, 112, 1, 38),
(89, 13, 69, 1, 52),
(90, 13, 10, 1, 56),
(91, 13, 9, 1, 59),
(92, 13, 72, 1, 48),
(93, 13, 44, 1, 32),
(94, 13, 17, 1, 27),
(95, 13, 77, 1, 34),
(96, 13, 89, 1, 58),
(97, 13, 94, 1, 51),
(98, 13, 88, 1, 13),
(99, 13, 88, 1, 46),
(100, 13, 108, 1, 47),
(101, 13, 102, 1, 39),
(102, 13, 95, 1, 41),
(103, 13, 50, 1, 50),
(104, 14, 115, 1, 80),
(105, 14, 106, 1, 80),
(106, 14, 120, 1, 68),
(107, 14, 81, 1, 74),
(108, 14, 40, 1, 62),
(109, 14, 112, 1, 59),
(110, 14, 69, 1, 54),
(111, 14, 10, 1, 49),
(112, 14, 9, 1, 82),
(113, 14, 72, 1, 63),
(114, 14, 44, 1, 86),
(115, 14, 17, 1, 90),
(116, 14, 77, 1, 79),
(117, 14, 89, 1, 56),
(118, 14, 94, 1, 90),
(119, 14, 88, 1, 68),
(120, 14, 108, 1, 84),
(121, 14, 102, 1, 46),
(122, 14, 95, 1, 89),
(123, 14, 50, 1, 90),
(124, 15, 115, 1, 54),
(125, 15, 106, 1, 46),
(126, 15, 120, 1, 43),
(127, 15, 81, 1, 38),
(128, 15, 40, 1, 49),
(129, 15, 112, 1, 59),
(130, 15, 69, 1, 46),
(131, 15, 10, 1, 59),
(132, 15, 9, 1, 52),
(133, 15, 72, 1, 50),
(134, 15, 44, 1, 40),
(135, 15, 17, 1, 44),
(136, 15, 77, 1, 42),
(137, 15, 89, 1, 39),
(138, 15, 94, 1, 43),
(139, 15, 88, 1, 56),
(140, 15, 108, 1, 45),
(141, 15, 102, 1, 43),
(142, 15, 95, 1, 47),
(143, 15, 50, 1, 42);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student`
--

CREATE TABLE `student` (
  `PK_Studnr` int(11) NOT NULL COMMENT 'PK',
  `STU_name` varchar(100) NOT NULL,
  `STU_vorname` varchar(100) NOT NULL,
  `STU_mail` varchar(100) NOT NULL,
  `STU_telnr` varchar(100) NOT NULL,
  `STU_notiz` longtext,
  `STU_klasse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `student`
--

INSERT INTO `student` (`PK_Studnr`, `STU_name`, `STU_vorname`, `STU_mail`, `STU_telnr`, `STU_notiz`, `STU_klasse`) VALUES
(7, 'Müller', 'Franz', 'franz.mueller@bluewin.ch', '079 862 53 24', NULL, 6),
(9, 'Maccauso', 'Ruben', 'ruben.maccauso@bluewin.ch', '076 234 65 82', NULL, 5),
(10, 'Leite', 'Rafael', 'rafael.leite99@hotmail.ch', '078 658 96 31', NULL, 5),
(13, 'Müller', 'Martin', 'martin.mueller@gmail.com', '044 562 34 85', NULL, 6),
(16, 'Notter', 'Yves', 'yvesnotter@hotmail.com', '079 858 24 12', NULL, 6),
(17, 'Mancari', 'Franco', 'francomancari@gmail.com', '085 642 86 35', NULL, 5),
(23, 'Nichols', 'Mason', 'Praesent.interdum@Quisquepurus.co.uk', ' 078 612 97 65', NULL, 6),
(26, 'Rice', 'Willow', 'et@nonummy.net', '079 768 05 61 ', NULL, 10),
(29, 'Michael', 'Liberty', 'tristique.aliquet.Phasellus@anteipsum.com', ' 076 594 32 03 ', NULL, 6),
(31, 'Padilla', 'Fay', 'malesuada.fringilla.est@Maurisvestibulumneque.com', ' 076 098 02 47 ', NULL, 10),
(38, 'Ratliff', 'Phyllis', 'felis@Quisquefringilla.co.uk', ' 076 529 91 05 ', NULL, 10),
(40, 'Kim', 'Tiger', 'mi.Aliquam.gravida@dapibusid.net', '079 107 34 93 ', NULL, 5),
(41, 'Perkins', 'Caesar', 'est.ac@atauctorullamcorper.co.uk', ' 078 548 34 64', NULL, 10),
(44, 'Maddox', 'Scarlett', 'metus@natoque.net', ' 078 351 04 51', NULL, 5),
(45, 'Peterson', 'Kirestin', 'eu.augue.porttitor@consectetuereuismod.net', ' 078 628 75 46', NULL, 10),
(46, 'Perez', 'Gail', 'euismod.in.dolor@magnaNam.ca', ' 078 957 23 53', NULL, 10),
(47, 'Rodriguez', 'Lois', 'convallis.in@tortor.org', ' 076 862 27 68 ', NULL, 10),
(50, 'Mercer', 'Harding', 'metus@nislelementum.org', ' 076 209 87 38 ', NULL, 5),
(54, 'Ross', 'Ariana', 'purus@dolor.org', ' 076 989 53 71 ', NULL, 10),
(58, 'Mercer', 'Kane', 'Nulla@consequatpurusMaecenas.edu', ' 076 122 27 90 ', NULL, 6),
(62, 'Merritt', 'Jana', 'lorem.ac.risus@lacusAliquam.org', '079 396 75 06 ', NULL, 6),
(64, 'Orr', 'Jackson', 'ac@idnunc.com', '079 231 24 34 ', NULL, 6),
(65, 'Middleton', 'Ivory', 'a.auctor@laoreetposuere.co.uk', ' 076 427 38 82 ', NULL, 6),
(66, 'Olsen', 'Dora', 'Sed@quamPellentesque.com', ' 078 892 93 69', NULL, 6),
(68, 'Rocha', 'Chiquita', 'augue.eu.tempor@nibhPhasellus.co.uk', ' 078 611 44 14', NULL, 10),
(69, 'Leblanc', 'Xerxes', 'est.ac@nonluctus.edu', ' 078 220 97 67', NULL, 5),
(72, 'Madden', 'Callie', 'odio.Aliquam.vulputate@eleifendvitaeerat.edu', ' 076 116 23 10 ', NULL, 5),
(73, 'Ray', 'Wesley', 'urna.convallis.erat@justoPraesent.com', ' 078 391 96 33', NULL, 10),
(77, 'Marquez', 'Rhiannon', 'tincidunt@Maecenasmalesuadafringilla.co.uk', ' 076 472 85 31 ', NULL, 5),
(79, 'Rodriquez', 'Fuller', 'dui.Cum@Praesentinterdumligula.com', ' 076 818 97 83 ', NULL, 10),
(80, 'Patel', 'Hashim', 'magna@uterat.com', ' 078 299 81 35', NULL, 10),
(81, 'Johnson', 'Priscilla', 'et.ipsum.cursus@viverraMaecenas.co.uk', ' 076 124 23 35 ', NULL, 5),
(85, 'Norman', 'Ursa', 'montes@mi.ca', ' 078 288 88 23', NULL, 6),
(86, 'Neal', 'Virginia', 'Aenean@mauris.edu', ' 076 374 13 70 ', NULL, 6),
(87, 'Porter', 'Joy', 'at.augue.id@liberodui.com', '079 922 72 10 ', NULL, 10),
(88, 'Mayo', 'Noelani', 'est@Integereu.ca', '079 908 08 65 ', NULL, 5),
(89, 'Marsh', 'Ruth', 'nec@egetvarius.com', ' 078 303 42 52', NULL, 5),
(90, 'Newton', 'Casey', 'Proin@mollisnec.co.uk', ' 076 732 10 28 ', NULL, 6),
(92, 'Pugh', 'Britanney', 'ut.ipsum.ac@condimentumDonecat.ca', '079 327 00 52 ', NULL, 10),
(94, 'May', 'Iola', 'Vivamus.molestie@egetlacus.org', ' 078 986 65 50', NULL, 5),
(95, 'Mccoy', 'Josiah', 'in.faucibus@mienimcondimentum.net', ' 076 431 10 02 ', NULL, 5),
(97, 'Nicholson', 'Ryder', 'a.scelerisque@vitaenibh.org', '079 259 31 85 ', NULL, 6),
(102, 'Mcclure', 'Laith', 'eu.enim@congue.org', '079 814 51 66 ', NULL, 5),
(106, 'Guggisberg', 'Sven', 'svenguggisberg@hotmail.ch', '079 294 96 94', NULL, 5),
(108, 'Mays', 'Scarlet', 'tellus.imperdiet.non@auctorullamcorper.org', ' 076 899 04 26 ', NULL, 5),
(110, 'Roberson', 'Martha', 'neque@vitae.co.uk', ' 076 722 77 13 ', NULL, 10),
(112, 'Koch', 'Maile', 'cubilia.Curae.Donec@elitdictum.org', ' 076 960 78 02 ', NULL, 5),
(115, 'Grenacher', 'Benjamin', 'benjamin.grenacher@hotmail.com', '078 300 86 62', NULL, 5),
(116, 'Orr', 'Cheyenne', 'lacus.Quisque.purus@iaculis.ca', ' 078 747 88 42', NULL, 6),
(120, 'Jimenez', 'Arden', 'eu.eros@diamloremauctor.net', ' 076 742 57 03 ', NULL, 5);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`PK_Fachnr`);

--
-- Indizes für die Tabelle `klasse`
--
ALTER TABLE `klasse`
  ADD PRIMARY KEY (`PK_Klassenr`);

--
-- Indizes für die Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  ADD PRIMARY KEY (`PK_Lehrernr`);

--
-- Indizes für die Tabelle `pruefungen`
--
ALTER TABLE `pruefungen`
  ADD PRIMARY KEY (`PK_Pruefnr`),
  ADD KEY `PRUEF_fach` (`PRUEF_fach`),
  ADD KEY `PRUEF_klasse` (`PRUEF_klasse`);

--
-- Indizes für die Tabelle `pruefung_student`
--
ALTER TABLE `pruefung_student`
  ADD PRIMARY KEY (`PK_PruefStudnr`),
  ADD KEY `PruefStud_pruefung` (`PruefStud_pruefung`),
  ADD KEY `PruefStud_student` (`PruefStud_student`);

--
-- Indizes für die Tabelle `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`PK_Studnr`),
  ADD KEY `STU_klasse` (`STU_klasse`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fach`
--
ALTER TABLE `fach`
  MODIFY `PK_Fachnr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `klasse`
--
ALTER TABLE `klasse`
  MODIFY `PK_Klassenr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `pruefungen`
--
ALTER TABLE `pruefungen`
  MODIFY `PK_Pruefnr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT für Tabelle `pruefung_student`
--
ALTER TABLE `pruefung_student`
  MODIFY `PK_PruefStudnr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT für Tabelle `student`
--
ALTER TABLE `student`
  MODIFY `PK_Studnr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=121;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  ADD CONSTRAINT `FK_lehrer` FOREIGN KEY (`PK_Lehrernr`) REFERENCES `fach` (`PK_Fachnr`);

--
-- Constraints der Tabelle `pruefungen`
--
ALTER TABLE `pruefungen`
  ADD CONSTRAINT `pruefungen_ibfk_1` FOREIGN KEY (`PRUEF_fach`) REFERENCES `fach` (`PK_Fachnr`),
  ADD CONSTRAINT `pruefungen_ibfk_2` FOREIGN KEY (`PRUEF_klasse`) REFERENCES `klasse` (`PK_Klassenr`);

--
-- Constraints der Tabelle `pruefung_student`
--
ALTER TABLE `pruefung_student`
  ADD CONSTRAINT `PruefStud_pruefung` FOREIGN KEY (`PruefStud_pruefung`) REFERENCES `pruefungen` (`PK_Pruefnr`),
  ADD CONSTRAINT `PruefStud_student` FOREIGN KEY (`PruefStud_student`) REFERENCES `student` (`PK_Studnr`);

--
-- Constraints der Tabelle `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `STU_klasse` FOREIGN KEY (`STU_klasse`) REFERENCES `klasse` (`PK_Klassenr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
