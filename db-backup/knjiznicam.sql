-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 01:33 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knjiznicam`
--
CREATE DATABASE IF NOT EXISTS `knjiznicam` DEFAULT CHARACTER SET utf8 COLLATE utf8_croatian_ci;
USE `knjiznicam`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `Ime` text COLLATE utf8_croatian_ci NOT NULL,
  `Prezime` text COLLATE utf8_croatian_ci NOT NULL,
  `OIB` int(11) NOT NULL,
  `Kontakt` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `Ime` text COLLATE utf8_croatian_ci NOT NULL,
  `Prezime` text COLLATE utf8_croatian_ci NOT NULL,
  `OIB` int(11) NOT NULL,
  `spol` text COLLATE utf8_croatian_ci NOT NULL,
  `Datumrodenja` int(11) NOT NULL,
  `AdresaStanovanja` text COLLATE utf8_croatian_ci NOT NULL,
  `Email` text COLLATE utf8_croatian_ci NOT NULL,
  `Kontakt` int(11) NOT NULL,
  `Ovlast` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

DROP TABLE IF EXISTS `kategorija`;
CREATE TABLE `kategorija` (
  `Id` int(11) NOT NULL,
  `Kategorija` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knjiga`
--

DROP TABLE IF EXISTS `knjiga`;
CREATE TABLE `knjiga` (
  `Id` int(11) NOT NULL,
  `Naslov` text COLLATE utf8_croatian_ci NOT NULL,
  `Autor` text COLLATE utf8_croatian_ci NOT NULL,
  `Kolicina` int(11) NOT NULL,
  `GodinaIzdavanja` int(11) NOT NULL,
  `Izdavackakuca` text COLLATE utf8_croatian_ci NOT NULL,
  `ISBN` int(11) NOT NULL,
  `ISSN` int(11) NOT NULL,
  `KategorijaId` int(11) NOT NULL,
  `Opis` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `IdEmployee` int(11) NOT NULL,
  `username` text COLLATE utf8_croatian_ci NOT NULL,
  `Password` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posudenje`
--

DROP TABLE IF EXISTS `posudenje`;
CREATE TABLE `posudenje` (
  `id` int(11) NOT NULL,
  `IdCustomer` int(11) NOT NULL,
  `KnjigaId` int(11) NOT NULL,
  `DatumPosudenja` int(11) NOT NULL,
  `Aktivnost` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `knjiga`
--
ALTER TABLE `knjiga`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `posudenje`
--
ALTER TABLE `posudenje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `knjiga`
--
ALTER TABLE `knjiga`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posudenje`
--
ALTER TABLE `posudenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
