-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 05:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crimes_db`
--
CREATE DATABASE IF NOT EXISTS `crimes_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crimes_db`;

-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `crime_code` int(11) NOT NULL,
  `crime_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminal`
--

CREATE TABLE `criminal` (
  `criminal_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `is_arrested` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` varchar(4) NOT NULL,
  `st_name` varchar(20) NOT NULL,
  `bureau` varchar(20) NOT NULL,
  `precint` int(11) NOT NULL,
  `omega_label` varchar(20) NOT NULL,
  `station` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incident_id` int(11) NOT NULL,
  `reported_time` datetime NOT NULL,
  `occured_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `district_id` varchar(4) NOT NULL,
  `address` varchar(20) NOT NULL,
  `cross_street` varchar(20) NOT NULL,
  `area_name` varchar(30) NOT NULL,
  `latitude` decimal(6,4) NOT NULL,
  `longitude` decimal(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modus`
--

CREATE TABLE `modus` (
  `mo_code` varchar(10) NOT NULL,
  `mo_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `height` int(11) NOT NULL,
  `descent` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `badge_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  `rank` varchar(20) NOT NULL,
  `district_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `last_update` date NOT NULL,
  `report_status` varchar(10) NOT NULL,
  `fatalities` int(11) NOT NULL,
  `case_status` varchar(10) NOT NULL,
  `premise` varchar(20) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `weapon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_crime`
--

CREATE TABLE `report_crime` (
  `report_id` int(11) NOT NULL,
  `crime_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_criminal`
--

CREATE TABLE `report_criminal` (
  `report_id` int(11) NOT NULL,
  `criminal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_modus`
--

CREATE TABLE `report_modus` (
  `report_id` int(11) NOT NULL,
  `mo_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_police`
--

CREATE TABLE `report_police` (
  `report_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_victim`
--

CREATE TABLE `report_victim` (
  `report_id` int(11) NOT NULL,
  `victim_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `victim`
--

CREATE TABLE `victim` (
  `victim_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weapon`
--

CREATE TABLE `weapon` (
  `weapon_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `material` varchar(4) NOT NULL,
  `color` varchar(15) NOT NULL,
  `other` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`crime_code`);

--
-- Indexes for table `criminal`
--
ALTER TABLE `criminal`
  ADD PRIMARY KEY (`criminal_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incident_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `modus`
--
ALTER TABLE `modus`
  ADD PRIMARY KEY (`mo_code`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`badge_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `weapon_id` (`weapon_id`);

--
-- Indexes for table `report_crime`
--
ALTER TABLE `report_crime`
  ADD PRIMARY KEY (`report_id`,`crime_code`),
  ADD KEY `crime_code` (`crime_code`);

--
-- Indexes for table `report_criminal`
--
ALTER TABLE `report_criminal`
  ADD PRIMARY KEY (`report_id`,`criminal_id`),
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `report_modus`
--
ALTER TABLE `report_modus`
  ADD PRIMARY KEY (`report_id`,`mo_code`),
  ADD KEY `mo_code` (`mo_code`);

--
-- Indexes for table `report_police`
--
ALTER TABLE `report_police`
  ADD PRIMARY KEY (`report_id`,`badge_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Indexes for table `report_victim`
--
ALTER TABLE `report_victim`
  ADD PRIMARY KEY (`report_id`,`victim_id`),
  ADD KEY `victim_id` (`victim_id`);

--
-- Indexes for table `victim`
--
ALTER TABLE `victim`
  ADD PRIMARY KEY (`victim_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `weapon`
--
ALTER TABLE `weapon`
  ADD PRIMARY KEY (`weapon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criminal`
--
ALTER TABLE `criminal`
  MODIFY `criminal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `victim`
--
ALTER TABLE `victim`
  MODIFY `victim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weapon`
--
ALTER TABLE `weapon`
  MODIFY `weapon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criminal`
--
ALTER TABLE `criminal`
  ADD CONSTRAINT `criminal_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `police`
--
ALTER TABLE `police`
  ADD CONSTRAINT `police_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`weapon_id`);

--
-- Constraints for table `report_crime`
--
ALTER TABLE `report_crime`
  ADD CONSTRAINT `report_crime_ibfk_1` FOREIGN KEY (`crime_code`) REFERENCES `crime` (`crime_code`),
  ADD CONSTRAINT `report_crime_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `report_criminal`
--
ALTER TABLE `report_criminal`
  ADD CONSTRAINT `report_criminal_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`),
  ADD CONSTRAINT `report_criminal_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `report_modus`
--
ALTER TABLE `report_modus`
  ADD CONSTRAINT `report_modus_ibfk_1` FOREIGN KEY (`mo_code`) REFERENCES `modus` (`mo_code`),
  ADD CONSTRAINT `report_modus_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `report_police`
--
ALTER TABLE `report_police`
  ADD CONSTRAINT `report_police_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `police` (`badge_id`),
  ADD CONSTRAINT `report_police_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `report_victim`
--
ALTER TABLE `report_victim`
  ADD CONSTRAINT `report_victim_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`),
  ADD CONSTRAINT `report_victim_ibfk_2` FOREIGN KEY (`victim_id`) REFERENCES `victim` (`victim_id`);

--
-- Constraints for table `victim`
--
ALTER TABLE `victim`
  ADD CONSTRAINT `victim_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
