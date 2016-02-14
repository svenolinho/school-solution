-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2016 at 04:23 AM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_solution`
--
CREATE DATABASE IF NOT EXISTS `school_solution` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `school_solution`;

-- --------------------------------------------------------

--
-- Table structure for table `fach`
--

DROP TABLE IF EXISTS `fach`;
CREATE TABLE IF NOT EXISTS `fach` (
  `PK_Fachnr` int(11) NOT NULL,
  `FACH_name` varchar(50) NOT NULL,
  `FACH_notiz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `klasse`
--

DROP TABLE IF EXISTS `klasse`;
CREATE TABLE IF NOT EXISTS `klasse` (
  `PK_Klassenr` int(11) NOT NULL,
  `KLA_name` varchar(50) NOT NULL,
  `KLA_notiz` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lehrer`
--

DROP TABLE IF EXISTS `lehrer`;
CREATE TABLE IF NOT EXISTS `lehrer` (
  `PK_Lehrernr` int(11) NOT NULL,
  `LEH_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pruefungen`
--

DROP TABLE IF EXISTS `pruefungen`;
CREATE TABLE IF NOT EXISTS `pruefungen` (
  `PK_Pruefnr` int(11) NOT NULL,
  `PRUEF_fach` int(11) NOT NULL,
  `PRUEF_klasse` int(11) NOT NULL,
  `PRUEF_notenschluessel` varchar(50) NOT NULL,
  `PRUEF_datum` date NOT NULL,
  `PRUEF_maxpunktzahl` float NOT NULL,
  `PRUEF_notiz` longtext CHARACTER SET latin1 COLLATE latin1_german2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pruefung_student`
--

DROP TABLE IF EXISTS `pruefung_student`;
CREATE TABLE IF NOT EXISTS `pruefung_student` (
  `PK_PruefStudnr` int(11) NOT NULL,
  `PruefStud_pruefung` int(11) NOT NULL,
  `PruefStud_student` int(11) NOT NULL,
  `PruefStud_anwesend` tinyint(1) NOT NULL,
  `PruefStud_punktzahl` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `PK_Studnr` int(11) NOT NULL COMMENT 'PK',
  `STU_name` varchar(100) NOT NULL,
  `STU_vorname` varchar(100) NOT NULL,
  `STU_mail` varchar(100) NOT NULL,
  `STU_telnr` varchar(100) NOT NULL,
  `STU_notiz` longtext,
  `STU_klasse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`PK_Fachnr`);

--
-- Indexes for table `klasse`
--
ALTER TABLE `klasse`
  ADD PRIMARY KEY (`PK_Klassenr`);

--
-- Indexes for table `lehrer`
--
ALTER TABLE `lehrer`
  ADD PRIMARY KEY (`PK_Lehrernr`);

--
-- Indexes for table `pruefungen`
--
ALTER TABLE `pruefungen`
  ADD PRIMARY KEY (`PK_Pruefnr`),
  ADD KEY `PRUEF_fach` (`PRUEF_fach`),
  ADD KEY `PRUEF_klasse` (`PRUEF_klasse`);

--
-- Indexes for table `pruefung_student`
--
ALTER TABLE `pruefung_student`
  ADD PRIMARY KEY (`PK_PruefStudnr`),
  ADD KEY `PruefStud_pruefung` (`PruefStud_pruefung`),
  ADD KEY `PruefStud_student` (`PruefStud_student`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`PK_Studnr`),
  ADD KEY `STU_klasse` (`STU_klasse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fach`
--
ALTER TABLE `fach`
  MODIFY `PK_Fachnr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `klasse`
--
ALTER TABLE `klasse`
  MODIFY `PK_Klassenr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pruefungen`
--
ALTER TABLE `pruefungen`
  MODIFY `PK_Pruefnr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pruefung_student`
--
ALTER TABLE `pruefung_student`
  MODIFY `PK_PruefStudnr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `PK_Studnr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK';
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lehrer`
--
ALTER TABLE `lehrer`
  ADD CONSTRAINT `FK_lehrer` FOREIGN KEY (`PK_Lehrernr`) REFERENCES `fach` (`PK_Fachnr`);

--
-- Constraints for table `pruefungen`
--
ALTER TABLE `pruefungen`
  ADD CONSTRAINT `pruefungen_ibfk_1` FOREIGN KEY (`PRUEF_fach`) REFERENCES `fach` (`PK_Fachnr`),
  ADD CONSTRAINT `pruefungen_ibfk_2` FOREIGN KEY (`PRUEF_klasse`) REFERENCES `klasse` (`PK_Klassenr`);

--
-- Constraints for table `pruefung_student`
--
ALTER TABLE `pruefung_student`
  ADD CONSTRAINT `PruefStud_pruefung` FOREIGN KEY (`PruefStud_pruefung`) REFERENCES `pruefungen` (`PK_Pruefnr`),
  ADD CONSTRAINT `PruefStud_student` FOREIGN KEY (`PruefStud_student`) REFERENCES `student` (`PK_Studnr`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `STU_klasse` FOREIGN KEY (`STU_klasse`) REFERENCES `klasse` (`PK_Klassenr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
