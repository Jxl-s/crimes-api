-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 02:47 PM
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
CREATE DATABASE IF NOT EXISTS `crimes_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crimes_db`;
-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `crime_code` int(11) NOT NULL,
  `crime_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`crime_code`, `crime_desc`) VALUES
(110, 'Homicide'),
(113, 'Manslaughter'),
(121, 'Rape'),
(122, 'Attempted Rape'),
(210, 'Robbery'),
(220, 'Robbery - attempted'),
(230, 'ADW'),
(231, 'ADW against LAPD Police Officer'),
(235, 'Child beating'),
(236, 'Spousal beating'),
(250, 'Shots Fired'),
(251, 'Shots fired inhabited dwelling'),
(310, 'Burglary'),
(320, 'Burglary - attempted'),
(330, 'Burg from Vehicle'),
(331, 'Theft from Vehicle - $950.01 & over'),
(341, 'Theft - $950.01 & over'),
(343, 'Shoplifting - $950.01 & over'),
(345, 'Dishonest employee - grand theft'),
(350, 'Theft from person'),
(351, 'Pursesnatch'),
(352, 'Pickpocket'),
(353, 'Drunkroll'),
(354, 'Theft of Identity'),
(410, 'Burg from Vehicle - attempted'),
(420, 'Theft from Vehicle - $950 & under'),
(421, 'Theft from Vehicle - attempted'),
(433, 'DWOC'),
(435, 'Lynching'),
(436, 'Lynching - attempted'),
(437, 'Resisting Arrest'),
(440, 'Theft - $950 & under'),
(441, 'Theft - attempted'),
(442, 'Shoplifting - $950 & under'),
(443, 'Shoplifting - attempted'),
(444, 'Dishonest employee - petty theft'),
(445, 'Dishonest employee - attempted'),
(450, 'Theft from person - attempted'),
(451, 'Pursesnatch - attempted'),
(452, 'Pickpocket - attempted'),
(453, 'Drunkroll - attempted'),
(470, 'Till Tap - $950.01 & over'),
(471, 'Till Tap - $950 & under'),
(472, 'Till Tap - attempted'),
(473, 'Theft from coin m/c - $950.01 & over'),
(474, 'Theft from coin m/c - $950 & under'),
(475, 'Theft from coin m/c - attempted'),
(480, 'Bicycle - stolen'),
(485, 'Bicycle - attempted stolent'),
(487, 'Boat - stolen'),
(491, 'Boat - attempted stolen'),
(510, 'Stolen Vehicle'),
(520, 'Stolen Vehicle - attempted'),
(622, 'Battery on Firefighter'),
(623, 'Battery on Police Officer'),
(624, 'Battery - misdemeanor'),
(625, 'Other Misd. Assault'),
(626, 'Spousal/Cohab Abuse - Simple Assault'),
(627, 'Child Abuse - Simple Assault'),
(647, 'Throwing substance at vehicle'),
(745, 'Vandalism - Misdeameanor ($399 or under)'),
(761, 'Brandishing'),
(763, 'Stalking'),
(815, 'Sexual Penetration w/ Foreign Object'),
(820, 'Oral Copulation'),
(821, 'Sodomy'),
(845, 'Sex Offender registrant out of compliance'),
(926, 'Train Wrecking'),
(928, 'Threatening Phone Calls / Letters'),
(930, 'Criminal Threats');

-- --------------------------------------------------------

--
-- Table structure for table `criminal`
--

CREATE TABLE `criminal` (
  `criminal_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `is_arrested` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `criminal`
--

INSERT INTO `criminal` (`criminal_id`, `person_id`, `is_arrested`) VALUES
(0, 0, 0),
(1, 1, 1),
(2, 4, 1),
(3, 6, 1),
(4, 7, 1),
(5, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` varchar(4) NOT NULL,
  `st_name` varchar(20) NOT NULL,
  `bureau` varchar(20) NOT NULL,
  `precinct` int(11) NOT NULL,
  `omega_label` varchar(20) NOT NULL,
  `station` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `st_name`, `bureau`, `precinct`, `omega_label`, `station`) VALUES
('0', '0', '0', 0, '0', '0'),
('1001', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1001', 'WEST VALLEY'),
('1003', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1003', 'WEST VALLEY'),
('1004', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1004', 'WEST VALLEY'),
('1005', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1005', 'WEST VALLEY'),
('1006', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1006', 'WEST VALLEY'),
('1007', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1007', 'WEST VALLEY'),
('1008', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1008', 'WEST VALLEY'),
('1009', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1009', 'WEST VALLEY'),
('101', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0101', 'CENTRAL'),
('1011', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1011', 'WEST VALLEY'),
('1012', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1012', 'WEST VALLEY'),
('1015', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1015', 'WEST VALLEY'),
('1017', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1017', 'WEST VALLEY'),
('1018', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1018', 'WEST VALLEY'),
('1019', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1019', 'WEST VALLEY'),
('1021', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1021', 'WEST VALLEY'),
('1023', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1023', 'WEST VALLEY'),
('1024', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1024', 'WEST VALLEY'),
('1025', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1025', 'WEST VALLEY'),
('1027', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1027', 'WEST VALLEY'),
('1028', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1028', 'WEST VALLEY'),
('1029', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1029', 'WEST VALLEY'),
('1031', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1031', 'WEST VALLEY'),
('1033', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1033', 'WEST VALLEY'),
('1034', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1034', 'WEST VALLEY'),
('1035', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1035', 'WEST VALLEY'),
('1037', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1037', 'WEST VALLEY'),
('1039', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1039', 'WEST VALLEY'),
('1041', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1041', 'WEST VALLEY'),
('1043', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1043', 'WEST VALLEY'),
('1044', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1044', 'WEST VALLEY'),
('1045', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1045', 'WEST VALLEY'),
('1047', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1047', 'WEST VALLEY'),
('1049', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1049', 'WEST VALLEY'),
('105', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0105', 'CENTRAL'),
('1061', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1061', 'WEST VALLEY'),
('1063', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1063', 'WEST VALLEY'),
('1065', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1065', 'WEST VALLEY'),
('1067', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1067', 'WEST VALLEY'),
('1068', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1068', 'WEST VALLEY'),
('1075', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1075', 'WEST VALLEY'),
('1077', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1077', 'WEST VALLEY'),
('1078', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1078', 'WEST VALLEY'),
('1079', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1079', 'WEST VALLEY'),
('1083', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1083', 'WEST VALLEY'),
('1088', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1088', 'WEST VALLEY'),
('1089', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1089', 'WEST VALLEY'),
('109', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0109', 'CENTRAL'),
('1091', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1091', 'WEST VALLEY'),
('1094', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1094', 'WEST VALLEY'),
('1097', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1097', 'WEST VALLEY'),
('1098', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1098', 'WEST VALLEY'),
('1099', 'West Valley Division', 'VALLEY BUREAU', 10, 'LAPD 1099', 'WEST VALLEY'),
('1101', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1101', 'NORTHEAST'),
('1102', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1102', 'NORTHEAST'),
('1105', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1105', 'NORTHEAST'),
('1107', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1107', 'NORTHEAST'),
('1109', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1109', 'NORTHEAST'),
('111', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0111', 'CENTRAL'),
('1112', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1112', 'NORTHEAST'),
('1113', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1113', 'NORTHEAST'),
('1115', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1115', 'NORTHEAST'),
('1116', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1116', 'NORTHEAST'),
('1117', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1117', 'NORTHEAST'),
('1118', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1118', 'NORTHEAST'),
('1119', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1119', 'NORTHEAST'),
('112', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0112', 'CENTRAL'),
('1122', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1122', 'NORTHEAST'),
('1123', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1123', 'NORTHEAST'),
('1124', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1124', 'NORTHEAST'),
('1125', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1125', 'NORTHEAST'),
('1126', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1126', 'NORTHEAST'),
('1127', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1127', 'NORTHEAST'),
('1128', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1128', 'NORTHEAST'),
('1129', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1129', 'NORTHEAST'),
('1132', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1132', 'NORTHEAST'),
('1133', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1133', 'NORTHEAST'),
('1134', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1134', 'NORTHEAST'),
('1135', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1135', 'NORTHEAST'),
('1136', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1136', 'NORTHEAST'),
('1137', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1137', 'NORTHEAST'),
('1138', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1138', 'NORTHEAST'),
('1139', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1139', 'NORTHEAST'),
('1141', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1141', 'NORTHEAST'),
('1142', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1142', 'NORTHEAST'),
('1143', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1143', 'NORTHEAST'),
('1144', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1144', 'NORTHEAST'),
('1145', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1145', 'NORTHEAST'),
('1146', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1146', 'NORTHEAST'),
('1147', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1147', 'NORTHEAST'),
('1148', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1148', 'NORTHEAST'),
('1149', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1149', 'NORTHEAST'),
('1151', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1151', 'NORTHEAST'),
('1152', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1152', 'NORTHEAST'),
('1153', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1153', 'NORTHEAST'),
('1157', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1157', 'NORTHEAST'),
('1158', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1158', 'NORTHEAST'),
('1159', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1159', 'NORTHEAST'),
('1161', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1161', 'NORTHEAST'),
('1162', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1162', 'NORTHEAST'),
('1163', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1163', 'NORTHEAST'),
('1169', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1169', 'NORTHEAST'),
('1171', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1171', 'NORTHEAST'),
('1172', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1172', 'NORTHEAST'),
('1173', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1173', 'NORTHEAST'),
('1174', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1174', 'NORTHEAST'),
('1175', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1175', 'NORTHEAST'),
('1176', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1176', 'NORTHEAST'),
('1177', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1177', 'NORTHEAST'),
('1178', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1178', 'NORTHEAST'),
('1179', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1179', 'NORTHEAST'),
('118', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0118', 'CENTRAL'),
('1181', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1181', 'NORTHEAST'),
('1183', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1183', 'NORTHEAST'),
('1184', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1184', 'NORTHEAST'),
('1185', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1185', 'NORTHEAST'),
('1186', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1186', 'NORTHEAST'),
('1189', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1189', 'NORTHEAST'),
('119', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0119', 'CENTRAL'),
('1195', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1195', 'NORTHEAST'),
('1199', 'Northeast Division', 'CENTRAL BUREAU', 11, 'LAPD 1199', 'NORTHEAST'),
('1203', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1203', '77TH STREET'),
('1204', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1204', '77TH STREET'),
('1205', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1205', '77TH STREET'),
('1207', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1207', '77TH STREET'),
('1208', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1208', '77TH STREET'),
('1209', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1209', '77TH STREET'),
('121', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0121', 'CENTRAL'),
('1211', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1211', '77TH STREET'),
('1213', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1213', '77TH STREET'),
('1215', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1215', '77TH STREET'),
('1218', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1218', '77TH STREET'),
('1219', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1219', '77TH STREET'),
('122', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0122', 'CENTRAL'),
('123', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0123', 'CENTRAL'),
('1231', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1231', '77TH STREET'),
('1232', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1232', '77TH STREET'),
('1233', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1233', '77TH STREET'),
('1235', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1235', '77TH STREET'),
('1239', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1239', '77TH STREET'),
('124', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0124', 'CENTRAL'),
('1241', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1241', '77TH STREET'),
('1242', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1242', '77TH STREET'),
('1243', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1243', '77TH STREET'),
('1245', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1245', '77TH STREET'),
('1248', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1248', '77TH STREET'),
('1249', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1249', '77TH STREET'),
('1251', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1251', '77TH STREET'),
('1252', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1252', '77TH STREET'),
('1253', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1253', '77TH STREET'),
('1255', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1255', '77TH STREET'),
('1256', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1256', '77TH STREET'),
('1257', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1257', '77TH STREET'),
('1258', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1258', '77TH STREET'),
('1259', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1259', '77TH STREET'),
('1263', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1263', '77TH STREET'),
('1265', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1265', '77TH STREET'),
('1266', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1266', '77TH STREET'),
('1267', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1267', '77TH STREET'),
('1268', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1268', '77TH STREET'),
('1269', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1269', '77TH STREET'),
('127', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0127', 'CENTRAL'),
('1273', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1273', '77TH STREET'),
('128', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0128', 'CENTRAL'),
('1283', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1283', '77TH STREET'),
('129', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0129', 'CENTRAL'),
('1293', '77th Street Division', 'SOUTH BUREAU', 12, 'LAPD 1293', '77TH STREET'),
('1303', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1303', 'NEWTON'),
('1307', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1307', 'NEWTON'),
('1309', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1309', 'NEWTON'),
('131', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0131', 'CENTRAL'),
('1311', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1311', 'NEWTON'),
('1313', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1313', 'NEWTON'),
('1317', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1317', 'NEWTON'),
('132', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0132', 'CENTRAL'),
('1321', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1321', 'NEWTON'),
('1322', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1322', 'NEWTON'),
('1323', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1323', 'NEWTON'),
('1324', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1324', 'NEWTON'),
('1325', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1325', 'NEWTON'),
('1326', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1326', 'NEWTON'),
('1327', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1327', 'NEWTON'),
('133', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0133', 'CENTRAL'),
('1331', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1331', 'NEWTON'),
('1333', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1333', 'NEWTON'),
('134', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0134', 'CENTRAL'),
('1341', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1341', 'NEWTON'),
('1342', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1342', 'NEWTON'),
('1343', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1343', 'NEWTON'),
('1344', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1344', 'NEWTON'),
('1345', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1345', 'NEWTON'),
('1346', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1346', 'NEWTON'),
('1347', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1347', 'NEWTON'),
('135', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0135', 'CENTRAL'),
('1351', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1351', 'NEWTON'),
('1352', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1352', 'NEWTON'),
('1353', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1353', 'NEWTON'),
('1354', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1354', 'NEWTON'),
('1361', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1361', 'NEWTON'),
('1362', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1362', 'NEWTON'),
('1363', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1363', 'NEWTON'),
('1364', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1364', 'NEWTON'),
('1365', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1365', 'NEWTON'),
('1367', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1367', 'NEWTON'),
('1371', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1371', 'NEWTON'),
('1372', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1372', 'NEWTON'),
('1373', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1373', 'NEWTON'),
('1375', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1375', 'NEWTON'),
('1377', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1377', 'NEWTON'),
('138', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0138', 'CENTRAL'),
('1381', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1381', 'NEWTON'),
('1383', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1383', 'NEWTON'),
('1385', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1385', 'NEWTON'),
('139', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0139', 'CENTRAL'),
('1391', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1391', 'NEWTON'),
('1393', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1393', 'NEWTON'),
('1394', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1394', 'NEWTON'),
('1395', 'Newton Division', 'CENTRAL BUREAU', 13, 'LAPD 1395', 'NEWTON'),
('1401', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1401', 'PACIFIC'),
('1402', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1402', 'PACIFIC'),
('1403', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1403', 'PACIFIC'),
('1405', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1405', 'PACIFIC'),
('1406', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1406', 'PACIFIC'),
('1407', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1407', 'PACIFIC'),
('1408', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1408', 'PACIFIC'),
('1409', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1409', 'PACIFIC'),
('141', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0141', 'CENTRAL'),
('1411', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1411', 'PACIFIC'),
('1412', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1412', 'PACIFIC'),
('1413', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1413', 'PACIFIC'),
('1414', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1414', 'PACIFIC'),
('1415', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1415', 'PACIFIC'),
('1416', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1416', 'PACIFIC'),
('142', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0142', 'CENTRAL'),
('1424', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1424', 'PACIFIC'),
('1425', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1425', 'PACIFIC'),
('1426', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1426', 'PACIFIC'),
('1427', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1427', 'PACIFIC'),
('1428', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1428', 'PACIFIC'),
('143', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0143', 'CENTRAL'),
('1431', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1431', 'PACIFIC'),
('1432', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1432', 'PACIFIC'),
('1433', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1433', 'PACIFIC'),
('1434', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1434', 'PACIFIC'),
('1435', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1435', 'PACIFIC'),
('1436', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1436', 'PACIFIC'),
('1437', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1437', 'PACIFIC'),
('1438', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1438', 'PACIFIC'),
('144', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0144', 'CENTRAL'),
('1441', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1441', 'PACIFIC'),
('1443', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1443', 'PACIFIC'),
('1444', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1444', 'PACIFIC'),
('1445', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1445', 'PACIFIC'),
('1446', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1446', 'PACIFIC'),
('1449', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1449', 'PACIFIC'),
('145', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0145', 'CENTRAL'),
('1451', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1451', 'PACIFIC'),
('1452', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1452', 'PACIFIC'),
('1453', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1453', 'PACIFIC'),
('1454', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1454', 'PACIFIC'),
('1455', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1455', 'PACIFIC'),
('1456', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1456', 'PACIFIC'),
('1457', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1457', 'PACIFIC'),
('1458', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1458', 'PACIFIC'),
('1459', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1459', 'PACIFIC'),
('146', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0146', 'CENTRAL'),
('1462', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1462', 'PACIFIC'),
('1463', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1463', 'PACIFIC'),
('1464', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1464', 'PACIFIC'),
('1465', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1465', 'PACIFIC'),
('1466', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1466', 'PACIFIC'),
('1467', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1467', 'PACIFIC'),
('1468', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1468', 'PACIFIC'),
('1469', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1469', 'PACIFIC'),
('147', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0147', 'CENTRAL'),
('1471', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1471', 'PACIFIC'),
('1472', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1472', 'PACIFIC'),
('1473', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1473', 'PACIFIC'),
('1474', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1474', 'PACIFIC'),
('1475', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1475', 'PACIFIC'),
('1476', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1476', 'PACIFIC'),
('1477', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1477', 'PACIFIC'),
('1479', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1479', 'PACIFIC'),
('148', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0148', 'CENTRAL'),
('1483', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1483', 'PACIFIC'),
('1484', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1484', 'PACIFIC'),
('1485', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1485', 'PACIFIC'),
('1486', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1486', 'PACIFIC'),
('1487', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1487', 'PACIFIC'),
('1488', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1488', 'PACIFIC'),
('1489', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1489', 'PACIFIC'),
('1491', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1491', 'PACIFIC'),
('1492', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1492', 'PACIFIC'),
('1493', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1493', 'PACIFIC'),
('1494', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1494', 'PACIFIC'),
('1495', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1495', 'PACIFIC'),
('1496', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1496', 'PACIFIC'),
('1497', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1497', 'PACIFIC'),
('1498', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1498', 'PACIFIC'),
('1499', 'Pacific Division', 'WEST BUREAU', 14, 'LAPD 1499', 'PACIFIC'),
('1501', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1501', 'NORTH HOLLYWOOD'),
('1502', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1502', 'NORTH HOLLYWOOD'),
('1503', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1503', 'NORTH HOLLYWOOD'),
('1504', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1504', 'NORTH HOLLYWOOD'),
('1505', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1505', 'NORTH HOLLYWOOD'),
('1506', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1506', 'NORTH HOLLYWOOD'),
('1508', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1508', 'NORTH HOLLYWOOD'),
('1509', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1509', 'NORTH HOLLYWOOD'),
('151', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0151', 'CENTRAL'),
('1511', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1511', 'NORTH HOLLYWOOD'),
('1512', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1512', 'NORTH HOLLYWOOD'),
('1513', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1513', 'NORTH HOLLYWOOD'),
('1514', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1514', 'NORTH HOLLYWOOD'),
('1515', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1515', 'NORTH HOLLYWOOD'),
('1516', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1516', 'NORTH HOLLYWOOD'),
('1517', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1517', 'NORTH HOLLYWOOD'),
('1519', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1519', 'NORTH HOLLYWOOD'),
('152', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0152', 'CENTRAL'),
('1521', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1521', 'NORTH HOLLYWOOD'),
('1522', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1522', 'NORTH HOLLYWOOD'),
('1523', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1523', 'NORTH HOLLYWOOD'),
('1524', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1524', 'NORTH HOLLYWOOD'),
('1525', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1525', 'NORTH HOLLYWOOD'),
('1526', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1526', 'NORTH HOLLYWOOD'),
('1527', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1527', 'NORTH HOLLYWOOD'),
('1529', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1529', 'NORTH HOLLYWOOD'),
('153', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0153', 'CENTRAL'),
('1531', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1531', 'NORTH HOLLYWOOD'),
('1532', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1532', 'NORTH HOLLYWOOD'),
('1533', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1533', 'NORTH HOLLYWOOD'),
('1535', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1535', 'NORTH HOLLYWOOD'),
('1538', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1538', 'NORTH HOLLYWOOD'),
('1539', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1539', 'NORTH HOLLYWOOD'),
('154', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0154', 'CENTRAL'),
('1541', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1541', 'NORTH HOLLYWOOD'),
('1543', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1543', 'NORTH HOLLYWOOD'),
('1544', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1544', 'NORTH HOLLYWOOD'),
('1545', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1545', 'NORTH HOLLYWOOD'),
('1546', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1546', 'NORTH HOLLYWOOD'),
('1547', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1547', 'NORTH HOLLYWOOD'),
('1548', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1548', 'NORTH HOLLYWOOD'),
('1549', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1549', 'NORTH HOLLYWOOD'),
('155', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0155', 'CENTRAL'),
('1551', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1551', 'NORTH HOLLYWOOD'),
('1553', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1553', 'NORTH HOLLYWOOD'),
('1555', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1555', 'NORTH HOLLYWOOD'),
('1557', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1557', 'NORTH HOLLYWOOD'),
('1559', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1559', 'NORTH HOLLYWOOD'),
('156', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0156', 'CENTRAL'),
('1562', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1562', 'NORTH HOLLYWOOD'),
('1563', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1563', 'NORTH HOLLYWOOD'),
('1565', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1565', 'NORTH HOLLYWOOD'),
('1566', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1566', 'NORTH HOLLYWOOD'),
('1567', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1567', 'NORTH HOLLYWOOD'),
('1569', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1569', 'NORTH HOLLYWOOD'),
('157', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0157', 'CENTRAL'),
('158', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0158', 'CENTRAL'),
('1581', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1581', 'NORTH HOLLYWOOD'),
('1583', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1583', 'NORTH HOLLYWOOD'),
('1585', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1585', 'NORTH HOLLYWOOD'),
('1586', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1586', 'NORTH HOLLYWOOD'),
('1587', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1587', 'NORTH HOLLYWOOD'),
('1588', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1588', 'NORTH HOLLYWOOD'),
('1589', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1589', 'NORTH HOLLYWOOD'),
('159', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0159', 'CENTRAL'),
('1591', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1591', 'NORTH HOLLYWOOD'),
('1595', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1595', 'NORTH HOLLYWOOD'),
('1596', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1596', 'NORTH HOLLYWOOD'),
('1599', 'North Hollywood Divi', 'VALLEY BUREAU', 15, 'LAPD 1599', 'NORTH HOLLYWOOD'),
('1601', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1601', 'FOOTHILL'),
('1602', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1602', 'FOOTHILL'),
('1603', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1603', 'FOOTHILL'),
('1605', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1605', 'FOOTHILL'),
('1606', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1606', 'FOOTHILL'),
('1608', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1608', 'FOOTHILL'),
('161', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0161', 'CENTRAL'),
('1611', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1611', 'FOOTHILL'),
('1612', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1612', 'FOOTHILL'),
('1613', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1613', 'FOOTHILL'),
('1614', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1614', 'FOOTHILL'),
('1615', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1615', 'FOOTHILL'),
('1617', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1617', 'FOOTHILL'),
('1618', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1618', 'FOOTHILL'),
('1619', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1619', 'FOOTHILL'),
('162', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0162', 'CENTRAL'),
('1621', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1621', 'FOOTHILL'),
('1622', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1622', 'FOOTHILL'),
('1623', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1623', 'FOOTHILL'),
('163', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0163', 'CENTRAL'),
('1633', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1633', 'FOOTHILL'),
('1634', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1634', 'FOOTHILL'),
('1635', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1635', 'FOOTHILL'),
('1636', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1636', 'FOOTHILL'),
('1637', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1637', 'FOOTHILL'),
('1638', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1638', 'FOOTHILL'),
('1639', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1639', 'FOOTHILL'),
('164', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0164', 'CENTRAL'),
('1641', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1641', 'FOOTHILL'),
('1642', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1642', 'FOOTHILL'),
('1643', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1643', 'FOOTHILL'),
('1645', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1645', 'FOOTHILL'),
('165', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0165', 'CENTRAL'),
('1651', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1651', 'FOOTHILL'),
('1653', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1653', 'FOOTHILL'),
('1654', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1654', 'FOOTHILL'),
('1655', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1655', 'FOOTHILL'),
('1656', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1656', 'FOOTHILL'),
('1657', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1657', 'FOOTHILL'),
('1658', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1658', 'FOOTHILL'),
('1659', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1659', 'FOOTHILL'),
('166', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0166', 'CENTRAL'),
('1661', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1661', 'FOOTHILL'),
('1663', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1663', 'FOOTHILL'),
('1664', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1664', 'FOOTHILL'),
('1665', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1665', 'FOOTHILL'),
('1667', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1667', 'FOOTHILL'),
('1668', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1668', 'FOOTHILL'),
('1669', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1669', 'FOOTHILL'),
('1672', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1672', 'FOOTHILL'),
('1673', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1673', 'FOOTHILL'),
('1675', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1675', 'FOOTHILL'),
('1676', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1676', 'FOOTHILL'),
('1677', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1677', 'FOOTHILL'),
('1678', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1678', 'FOOTHILL'),
('1679', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1679', 'FOOTHILL'),
('1681', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1681', 'FOOTHILL'),
('1682', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1682', 'FOOTHILL'),
('1684', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1684', 'FOOTHILL'),
('1685', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1685', 'FOOTHILL'),
('1687', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1687', 'FOOTHILL'),
('1689', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1689', 'FOOTHILL'),
('1691', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1691', 'FOOTHILL'),
('1693', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1693', 'FOOTHILL'),
('1695', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1695', 'FOOTHILL'),
('1698', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1698', 'FOOTHILL'),
('1699', 'Foothill Division', 'VALLEY BUREAU', 16, 'LAPD 1699', 'FOOTHILL'),
('1701', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1701', 'DEVONSHIRE'),
('1703', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1703', 'DEVONSHIRE'),
('1705', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1705', 'DEVONSHIRE'),
('1707', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1707', 'DEVONSHIRE'),
('1708', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1708', 'DEVONSHIRE'),
('1709', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1709', 'DEVONSHIRE'),
('171', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0171', 'CENTRAL'),
('1712', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1712', 'DEVONSHIRE'),
('1713', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1713', 'DEVONSHIRE'),
('1714', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1714', 'DEVONSHIRE'),
('1715', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1715', 'DEVONSHIRE'),
('1716', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1716', 'DEVONSHIRE'),
('1717', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1717', 'DEVONSHIRE'),
('1718', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1718', 'DEVONSHIRE'),
('1719', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1719', 'DEVONSHIRE'),
('1721', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1721', 'DEVONSHIRE'),
('1722', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1722', 'DEVONSHIRE'),
('1723', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1723', 'DEVONSHIRE'),
('1725', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1725', 'DEVONSHIRE'),
('1727', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1727', 'DEVONSHIRE'),
('1728', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1728', 'DEVONSHIRE'),
('1729', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1729', 'DEVONSHIRE'),
('1735', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1735', 'DEVONSHIRE'),
('1737', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1737', 'DEVONSHIRE'),
('1738', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1738', 'DEVONSHIRE'),
('1739', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1739', 'DEVONSHIRE'),
('174', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0174', 'CENTRAL'),
('1743', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1743', 'DEVONSHIRE'),
('1745', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1745', 'DEVONSHIRE'),
('1747', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1747', 'DEVONSHIRE'),
('1749', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1749', 'DEVONSHIRE'),
('1751', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1751', 'DEVONSHIRE'),
('1752', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1752', 'DEVONSHIRE'),
('1753', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1753', 'DEVONSHIRE'),
('1754', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1754', 'DEVONSHIRE'),
('1755', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1755', 'DEVONSHIRE'),
('1756', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1756', 'DEVONSHIRE'),
('1757', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1757', 'DEVONSHIRE'),
('1758', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1758', 'DEVONSHIRE'),
('1759', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1759', 'DEVONSHIRE'),
('176', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0176', 'CENTRAL'),
('1761', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1761', 'DEVONSHIRE'),
('1762', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1762', 'DEVONSHIRE'),
('1763', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1763', 'DEVONSHIRE'),
('1764', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1764', 'DEVONSHIRE'),
('1765', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1765', 'DEVONSHIRE'),
('1766', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1766', 'DEVONSHIRE'),
('1767', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1767', 'DEVONSHIRE'),
('1768', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1768', 'DEVONSHIRE'),
('1771', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1771', 'DEVONSHIRE'),
('1772', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1772', 'DEVONSHIRE'),
('1773', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1773', 'DEVONSHIRE'),
('1774', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1774', 'DEVONSHIRE'),
('1775', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1775', 'DEVONSHIRE'),
('1776', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1776', 'DEVONSHIRE'),
('1777', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1777', 'DEVONSHIRE'),
('1778', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1778', 'DEVONSHIRE'),
('1779', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1779', 'DEVONSHIRE'),
('1781', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1781', 'DEVONSHIRE'),
('1782', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1782', 'DEVONSHIRE'),
('1783', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1783', 'DEVONSHIRE'),
('1785', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1785', 'DEVONSHIRE'),
('1787', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1787', 'DEVONSHIRE'),
('1788', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1788', 'DEVONSHIRE'),
('1791', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1791', 'DEVONSHIRE'),
('1792', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1792', 'DEVONSHIRE'),
('1793', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1793', 'DEVONSHIRE'),
('1794', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1794', 'DEVONSHIRE'),
('1795', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1795', 'DEVONSHIRE'),
('1796', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1796', 'DEVONSHIRE'),
('1797', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1797', 'DEVONSHIRE'),
('1798', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1798', 'DEVONSHIRE'),
('1799', 'Devonshire Division', 'VALLEY BUREAU', 17, 'LAPD 1799', 'DEVONSHIRE'),
('1801', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1801', 'SOUTHEAST'),
('1802', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1802', 'SOUTHEAST'),
('1803', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1803', 'SOUTHEAST'),
('1804', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1804', 'SOUTHEAST'),
('1805', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1805', 'SOUTHEAST'),
('1806', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1806', 'SOUTHEAST'),
('181', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0181', 'CENTRAL'),
('182', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0182', 'CENTRAL'),
('1821', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1821', 'SOUTHEAST'),
('1822', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1822', 'SOUTHEAST'),
('1823', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1823', 'SOUTHEAST'),
('1824', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1824', 'SOUTHEAST'),
('1826', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1826', 'SOUTHEAST'),
('1827', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1827', 'SOUTHEAST'),
('1829', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1829', 'SOUTHEAST'),
('1831', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1831', 'SOUTHEAST'),
('1832', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1832', 'SOUTHEAST'),
('1834', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1834', 'SOUTHEAST'),
('1835', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1835', 'SOUTHEAST'),
('1836', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1836', 'SOUTHEAST'),
('1837', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1837', 'SOUTHEAST'),
('1838', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1838', 'SOUTHEAST'),
('1839', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1839', 'SOUTHEAST'),
('1841', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1841', 'SOUTHEAST'),
('1842', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1842', 'SOUTHEAST'),
('1844', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1844', 'SOUTHEAST'),
('1846', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1846', 'SOUTHEAST'),
('1849', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1849', 'SOUTHEAST'),
('185', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0185', 'CENTRAL'),
('1851', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1851', 'SOUTHEAST'),
('1861', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1861', 'SOUTHEAST'),
('1862', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1862', 'SOUTHEAST'),
('1863', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1863', 'SOUTHEAST'),
('1864', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1864', 'SOUTHEAST'),
('1871', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1871', 'SOUTHEAST'),
('1881', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1881', 'SOUTHEAST'),
('1891', 'Southeast Division', 'SOUTH BUREAU', 18, 'LAPD 1891', 'SOUTHEAST'),
('1901', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1901', 'MISSION'),
('1902', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1902', 'MISSION'),
('1903', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1903', 'MISSION'),
('1904', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1904', 'MISSION'),
('1905', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1905', 'MISSION'),
('1906', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1906', 'MISSION'),
('1907', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1907', 'MISSION'),
('1908', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1908', 'MISSION'),
('1909', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1909', 'MISSION'),
('191', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0191', 'CENTRAL'),
('1911', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1911', 'MISSION'),
('1912', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1912', 'MISSION'),
('1913', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1913', 'MISSION'),
('1915', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1915', 'MISSION'),
('1916', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1916', 'MISSION'),
('1917', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1917', 'MISSION'),
('1918', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1918', 'MISSION'),
('1919', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1919', 'MISSION'),
('192', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0192', 'CENTRAL'),
('1921', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1921', 'MISSION'),
('1924', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1924', 'MISSION'),
('1925', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1925', 'MISSION'),
('1931', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1931', 'MISSION'),
('1934', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1934', 'MISSION'),
('1935', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1935', 'MISSION'),
('1936', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1936', 'MISSION'),
('1941', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1941', 'MISSION'),
('1943', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1943', 'MISSION'),
('1944', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1944', 'MISSION'),
('1945', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1945', 'MISSION'),
('195', 'Central Division', 'CENTRAL BUREAU', 1, 'LAPD 0195', 'CENTRAL'),
('1951', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1951', 'MISSION'),
('1952', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1952', 'MISSION'),
('1954', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1954', 'MISSION'),
('1955', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1955', 'MISSION'),
('1956', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1956', 'MISSION'),
('1958', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1958', 'MISSION'),
('1959', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1959', 'MISSION'),
('1961', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1961', 'MISSION'),
('1962', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1962', 'MISSION'),
('1963', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1963', 'MISSION'),
('1964', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1964', 'MISSION'),
('1966', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1966', 'MISSION'),
('1967', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1967', 'MISSION'),
('1969', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1969', 'MISSION'),
('1971', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1971', 'MISSION'),
('1972', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1972', 'MISSION'),
('1974', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1974', 'MISSION'),
('1975', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1975', 'MISSION'),
('1977', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1977', 'MISSION'),
('1979', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1979', 'MISSION'),
('1981', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1981', 'MISSION'),
('1982', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1982', 'MISSION'),
('1983', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1983', 'MISSION'),
('1984', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1984', 'MISSION'),
('1985', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1985', 'MISSION'),
('1987', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1987', 'MISSION'),
('1988', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1988', 'MISSION'),
('1989', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1989', 'MISSION'),
('1991', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1991', 'MISSION'),
('1993', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1993', 'MISSION'),
('1994', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1994', 'MISSION'),
('1995', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1995', 'MISSION'),
('1998', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1998', 'MISSION'),
('1999', 'Mission Division', 'VALLEY BUREAU', 19, 'LAPD 1999', 'MISSION'),
('2001', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2001', 'OLYMPIC'),
('2002', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2002', 'OLYMPIC'),
('2004', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2004', 'OLYMPIC'),
('2005', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2005', 'OLYMPIC'),
('201', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0201', 'RAMPART'),
('2011', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2011', 'OLYMPIC'),
('2013', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2013', 'OLYMPIC'),
('2014', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2014', 'OLYMPIC'),
('2015', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2015', 'OLYMPIC'),
('2016', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2016', 'OLYMPIC'),
('2017', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2017', 'OLYMPIC'),
('2019', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2019', 'OLYMPIC'),
('202', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0202', 'RAMPART'),
('2021', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2021', 'OLYMPIC'),
('2022', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2022', 'OLYMPIC'),
('2023', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2023', 'OLYMPIC'),
('2024', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2024', 'OLYMPIC'),
('2025', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2025', 'OLYMPIC'),
('2026', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2026', 'OLYMPIC'),
('2027', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2027', 'OLYMPIC'),
('2029', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2029', 'OLYMPIC'),
('203', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0203', 'RAMPART'),
('2031', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2031', 'OLYMPIC'),
('2033', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2033', 'OLYMPIC'),
('2034', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2034', 'OLYMPIC'),
('2035', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2035', 'OLYMPIC'),
('2036', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2036', 'OLYMPIC'),
('2038', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2038', 'OLYMPIC'),
('2039', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2039', 'OLYMPIC'),
('204', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0204', 'RAMPART'),
('2041', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2041', 'OLYMPIC'),
('2042', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2042', 'OLYMPIC'),
('2044', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2044', 'OLYMPIC'),
('2045', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2045', 'OLYMPIC'),
('2046', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2046', 'OLYMPIC'),
('2049', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2049', 'OLYMPIC'),
('205', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0205', 'RAMPART'),
('2053', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2053', 'OLYMPIC'),
('2054', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2054', 'OLYMPIC'),
('2055', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2055', 'OLYMPIC'),
('2056', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2056', 'OLYMPIC'),
('2058', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2058', 'OLYMPIC'),
('2062', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2062', 'OLYMPIC'),
('2063', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2063', 'OLYMPIC');
INSERT INTO `district` (`district_id`, `st_name`, `bureau`, `precinct`, `omega_label`, `station`) VALUES
('2064', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2064', 'OLYMPIC'),
('2069', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2069', 'OLYMPIC'),
('2071', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2071', 'OLYMPIC'),
('2073', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2073', 'OLYMPIC'),
('2074', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2074', 'OLYMPIC'),
('2076', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2076', 'OLYMPIC'),
('2079', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2079', 'OLYMPIC'),
('2081', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2081', 'OLYMPIC'),
('2083', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2083', 'OLYMPIC'),
('2088', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2088', 'OLYMPIC'),
('2091', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2091', 'OLYMPIC'),
('2093', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2093', 'OLYMPIC'),
('2097', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2097', 'OLYMPIC'),
('2099', 'Olympic Division', 'WEST BUREAU', 20, 'LAPD 2099', 'OLYMPIC'),
('2101', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2101', 'TOPANGA'),
('2102', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2102', 'TOPANGA'),
('2103', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2103', 'TOPANGA'),
('2104', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2104', 'TOPANGA'),
('2105', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2105', 'TOPANGA'),
('2106', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2106', 'TOPANGA'),
('2107', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2107', 'TOPANGA'),
('211', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0211', 'RAMPART'),
('2111', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2111', 'TOPANGA'),
('2113', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2113', 'TOPANGA'),
('2114', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2114', 'TOPANGA'),
('2115', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2115', 'TOPANGA'),
('2118', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2118', 'TOPANGA'),
('212', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0212', 'RAMPART'),
('2125', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2125', 'TOPANGA'),
('2126', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2126', 'TOPANGA'),
('2128', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2128', 'TOPANGA'),
('2129', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2129', 'TOPANGA'),
('2131', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2131', 'TOPANGA'),
('2132', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2132', 'TOPANGA'),
('2133', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2133', 'TOPANGA'),
('2134', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2134', 'TOPANGA'),
('2136', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2136', 'TOPANGA'),
('2137', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2137', 'TOPANGA'),
('2138', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2138', 'TOPANGA'),
('2139', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2139', 'TOPANGA'),
('2141', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2141', 'TOPANGA'),
('2142', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2142', 'TOPANGA'),
('2143', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2143', 'TOPANGA'),
('2144', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2144', 'TOPANGA'),
('2145', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2145', 'TOPANGA'),
('2146', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2146', 'TOPANGA'),
('2147', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2147', 'TOPANGA'),
('2148', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2148', 'TOPANGA'),
('2149', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2149', 'TOPANGA'),
('215', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0215', 'RAMPART'),
('2155', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2155', 'TOPANGA'),
('2156', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2156', 'TOPANGA'),
('2157', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2157', 'TOPANGA'),
('2158', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2158', 'TOPANGA'),
('2159', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2159', 'TOPANGA'),
('216', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0216', 'RAMPART'),
('2161', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2161', 'TOPANGA'),
('2162', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2162', 'TOPANGA'),
('2169', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2169', 'TOPANGA'),
('217', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0217', 'RAMPART'),
('2172', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2172', 'TOPANGA'),
('2173', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2173', 'TOPANGA'),
('2175', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2175', 'TOPANGA'),
('2177', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2177', 'TOPANGA'),
('218', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0218', 'RAMPART'),
('2183', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2183', 'TOPANGA'),
('2185', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2185', 'TOPANGA'),
('2187', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2187', 'TOPANGA'),
('2189', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2189', 'TOPANGA'),
('219', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0219', 'RAMPART'),
('2196', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2196', 'TOPANGA'),
('2197', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2197', 'TOPANGA'),
('2198', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2198', 'TOPANGA'),
('2199', 'Topanga Division', 'VALLEY BUREAU', 21, 'LAPD 2199', 'TOPANGA'),
('221', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0221', 'RAMPART'),
('231', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0231', 'RAMPART'),
('233', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0233', 'RAMPART'),
('235', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0235', 'RAMPART'),
('236', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0236', 'RAMPART'),
('237', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0237', 'RAMPART'),
('238', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0238', 'RAMPART'),
('239', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0239', 'RAMPART'),
('241', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0241', 'RAMPART'),
('245', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0245', 'RAMPART'),
('246', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0246', 'RAMPART'),
('247', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0247', 'RAMPART'),
('248', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0248', 'RAMPART'),
('249', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0249', 'RAMPART'),
('251', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0251', 'RAMPART'),
('256', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0256', 'RAMPART'),
('257', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0257', 'RAMPART'),
('261', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0261', 'RAMPART'),
('265', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0265', 'RAMPART'),
('266', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0266', 'RAMPART'),
('269', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0269', 'RAMPART'),
('271', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0271', 'RAMPART'),
('275', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0275', 'RAMPART'),
('279', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0279', 'RAMPART'),
('281', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0281', 'RAMPART'),
('285', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0285', 'RAMPART'),
('289', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0289', 'RAMPART'),
('291', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0291', 'RAMPART'),
('292', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0292', 'RAMPART'),
('295', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0295', 'RAMPART'),
('299', 'Rampart Division', 'CENTRAL BUREAU', 2, 'LAPD 0299', 'RAMPART'),
('301', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0301', 'SOUTHWEST'),
('303', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0303', 'SOUTHWEST'),
('305', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0305', 'SOUTHWEST'),
('307', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0307', 'SOUTHWEST'),
('308', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0308', 'SOUTHWEST'),
('309', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0309', 'SOUTHWEST'),
('311', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0311', 'SOUTHWEST'),
('312', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0312', 'SOUTHWEST'),
('313', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0313', 'SOUTHWEST'),
('314', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0314', 'SOUTHWEST'),
('315', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0315', 'SOUTHWEST'),
('316', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0316', 'SOUTHWEST'),
('317', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0317', 'SOUTHWEST'),
('318', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0318', 'SOUTHWEST'),
('319', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0319', 'SOUTHWEST'),
('321', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0321', 'SOUTHWEST'),
('325', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0325', 'SOUTHWEST'),
('326', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0326', 'SOUTHWEST'),
('327', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0327', 'SOUTHWEST'),
('328', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0328', 'SOUTHWEST'),
('329', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0329', 'SOUTHWEST'),
('331', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0331', 'SOUTHWEST'),
('332', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0332', 'SOUTHWEST'),
('333', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0333', 'SOUTHWEST'),
('334', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0334', 'SOUTHWEST'),
('335', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0335', 'SOUTHWEST'),
('336', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0336', 'SOUTHWEST'),
('337', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0337', 'SOUTHWEST'),
('338', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0338', 'SOUTHWEST'),
('341', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0341', 'SOUTHWEST'),
('343', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0343', 'SOUTHWEST'),
('351', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0351', 'SOUTHWEST'),
('353', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0353', 'SOUTHWEST'),
('354', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0354', 'SOUTHWEST'),
('355', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0355', 'SOUTHWEST'),
('356', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0356', 'SOUTHWEST'),
('357', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0357', 'SOUTHWEST'),
('358', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0358', 'SOUTHWEST'),
('359', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0359', 'SOUTHWEST'),
('361', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0361', 'SOUTHWEST'),
('362', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0362', 'SOUTHWEST'),
('363', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0363', 'SOUTHWEST'),
('373', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0373', 'SOUTHWEST'),
('374', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0374', 'SOUTHWEST'),
('375', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0375', 'SOUTHWEST'),
('376', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0376', 'SOUTHWEST'),
('377', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0377', 'SOUTHWEST'),
('378', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0378', 'SOUTHWEST'),
('379', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0379', 'SOUTHWEST'),
('391', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0391', 'SOUTHWEST'),
('392', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0392', 'SOUTHWEST'),
('393', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0393', 'SOUTHWEST'),
('394', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0394', 'SOUTHWEST'),
('395', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0395', 'SOUTHWEST'),
('396', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0396', 'SOUTHWEST'),
('397', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0397', 'SOUTHWEST'),
('398', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0398', 'SOUTHWEST'),
('399', 'Southwest Division', 'SOUTH BUREAU', 3, 'LAPD 0399', 'SOUTHWEST'),
('401', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0401', 'HOLLENBECK'),
('402', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0402', 'HOLLENBECK'),
('403', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0403', 'HOLLENBECK'),
('404', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0404', 'HOLLENBECK'),
('405', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0405', 'HOLLENBECK'),
('406', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0406', 'HOLLENBECK'),
('407', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0407', 'HOLLENBECK'),
('408', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0408', 'HOLLENBECK'),
('409', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0409', 'HOLLENBECK'),
('411', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0411', 'HOLLENBECK'),
('412', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0412', 'HOLLENBECK'),
('413', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0413', 'HOLLENBECK'),
('414', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0414', 'HOLLENBECK'),
('415', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0415', 'HOLLENBECK'),
('416', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0416', 'HOLLENBECK'),
('417', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0417', 'HOLLENBECK'),
('418', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0418', 'HOLLENBECK'),
('421', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0421', 'HOLLENBECK'),
('422', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0422', 'HOLLENBECK'),
('423', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0423', 'HOLLENBECK'),
('424', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0424', 'HOLLENBECK'),
('426', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0426', 'HOLLENBECK'),
('427', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0427', 'HOLLENBECK'),
('428', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0428', 'HOLLENBECK'),
('429', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0429', 'HOLLENBECK'),
('437', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0437', 'HOLLENBECK'),
('438', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0438', 'HOLLENBECK'),
('439', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0439', 'HOLLENBECK'),
('441', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0441', 'HOLLENBECK'),
('442', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0442', 'HOLLENBECK'),
('443', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0443', 'HOLLENBECK'),
('445', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0445', 'HOLLENBECK'),
('448', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0448', 'HOLLENBECK'),
('449', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0449', 'HOLLENBECK'),
('451', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0451', 'HOLLENBECK'),
('452', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0452', 'HOLLENBECK'),
('453', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0453', 'HOLLENBECK'),
('454', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0454', 'HOLLENBECK'),
('455', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0455', 'HOLLENBECK'),
('456', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0456', 'HOLLENBECK'),
('457', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0457', 'HOLLENBECK'),
('459', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0459', 'HOLLENBECK'),
('461', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0461', 'HOLLENBECK'),
('462', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0462', 'HOLLENBECK'),
('463', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0463', 'HOLLENBECK'),
('464', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0464', 'HOLLENBECK'),
('465', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0465', 'HOLLENBECK'),
('466', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0466', 'HOLLENBECK'),
('467', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0467', 'HOLLENBECK'),
('468', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0468', 'HOLLENBECK'),
('469', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0469', 'HOLLENBECK'),
('471', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0471', 'HOLLENBECK'),
('473', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0473', 'HOLLENBECK'),
('477', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0477', 'HOLLENBECK'),
('478', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0478', 'HOLLENBECK'),
('479', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0479', 'HOLLENBECK'),
('483', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0483', 'HOLLENBECK'),
('487', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0487', 'HOLLENBECK'),
('488', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0488', 'HOLLENBECK'),
('489', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0489', 'HOLLENBECK'),
('491', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0491', 'HOLLENBECK'),
('497', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0497', 'HOLLENBECK'),
('499', 'Hollenbeck Division', 'CENTRAL BUREAU', 4, 'LAPD 0499', 'HOLLENBECK'),
('501', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0501', 'HARBOR'),
('502', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0502', 'HARBOR'),
('503', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0503', 'HARBOR'),
('504', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0504', 'HARBOR'),
('505', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0505', 'HARBOR'),
('506', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0506', 'HARBOR'),
('507', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0507', 'HARBOR'),
('508', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0508', 'HARBOR'),
('509', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0509', 'HARBOR'),
('511', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0511', 'HARBOR'),
('512', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0512', 'HARBOR'),
('513', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0513', 'HARBOR'),
('514', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0514', 'HARBOR'),
('515', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0515', 'HARBOR'),
('516', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0516', 'HARBOR'),
('517', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0517', 'HARBOR'),
('518', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0518', 'HARBOR'),
('519', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0519', 'HARBOR'),
('521', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0521', 'HARBOR'),
('522', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0522', 'HARBOR'),
('523', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0523', 'HARBOR'),
('524', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0524', 'HARBOR'),
('525', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0525', 'HARBOR'),
('526', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0526', 'HARBOR'),
('527', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0527', 'HARBOR'),
('528', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0528', 'HARBOR'),
('529', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0529', 'HARBOR'),
('531', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0531', 'HARBOR'),
('532', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0532', 'HARBOR'),
('541', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0541', 'HARBOR'),
('551', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0551', 'HARBOR'),
('555', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0555', 'HARBOR'),
('557', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0557', 'HARBOR'),
('558', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0558', 'HARBOR'),
('559', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0559', 'HARBOR'),
('561', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0561', 'HARBOR'),
('562', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0562', 'HARBOR'),
('563', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0563', 'HARBOR'),
('564', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0564', 'HARBOR'),
('565', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0565', 'HARBOR'),
('566', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0566', 'HARBOR'),
('567', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0567', 'HARBOR'),
('569', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0569', 'HARBOR'),
('581', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0581', 'HARBOR'),
('583', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0583', 'HARBOR'),
('584', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0584', 'HARBOR'),
('585', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0585', 'HARBOR'),
('587', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0587', 'HARBOR'),
('589', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0589', 'HARBOR'),
('599', 'Harbor Division', 'SOUTH BUREAU', 5, 'LAPD 0599', 'HARBOR'),
('615', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0615', 'HOLLYWOOD'),
('621', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0621', 'HOLLYWOOD'),
('622', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0622', 'HOLLYWOOD'),
('625', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0625', 'HOLLYWOOD'),
('626', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0626', 'HOLLYWOOD'),
('627', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0627', 'HOLLYWOOD'),
('628', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0628', 'HOLLYWOOD'),
('629', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0629', 'HOLLYWOOD'),
('631', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0631', 'HOLLYWOOD'),
('632', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0632', 'HOLLYWOOD'),
('635', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0635', 'HOLLYWOOD'),
('636', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0636', 'HOLLYWOOD'),
('637', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0637', 'HOLLYWOOD'),
('638', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0638', 'HOLLYWOOD'),
('639', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0639', 'HOLLYWOOD'),
('642', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0642', 'HOLLYWOOD'),
('643', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0643', 'HOLLYWOOD'),
('644', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0644', 'HOLLYWOOD'),
('645', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0645', 'HOLLYWOOD'),
('646', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0646', 'HOLLYWOOD'),
('647', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0647', 'HOLLYWOOD'),
('648', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0648', 'HOLLYWOOD'),
('649', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0649', 'HOLLYWOOD'),
('656', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0656', 'HOLLYWOOD'),
('657', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0657', 'HOLLYWOOD'),
('659', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0659', 'HOLLYWOOD'),
('663', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0663', 'HOLLYWOOD'),
('666', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0666', 'HOLLYWOOD'),
('667', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0667', 'HOLLYWOOD'),
('668', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0668', 'HOLLYWOOD'),
('669', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0669', 'HOLLYWOOD'),
('676', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0676', 'HOLLYWOOD'),
('677', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0677', 'HOLLYWOOD'),
('678', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0678', 'HOLLYWOOD'),
('679', 'Hollywood Division', 'WEST BUREAU', 6, 'LAPD 0679', 'HOLLYWOOD'),
('701', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0701', 'WILSHIRE'),
('702', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0702', 'WILSHIRE'),
('705', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0705', 'WILSHIRE'),
('706', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0706', 'WILSHIRE'),
('711', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0711', 'WILSHIRE'),
('713', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0713', 'WILSHIRE'),
('714', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0714', 'WILSHIRE'),
('715', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0715', 'WILSHIRE'),
('717', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0717', 'WILSHIRE'),
('719', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0719', 'WILSHIRE'),
('721', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0721', 'WILSHIRE'),
('722', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0722', 'WILSHIRE'),
('723', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0723', 'WILSHIRE'),
('724', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0724', 'WILSHIRE'),
('725', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0725', 'WILSHIRE'),
('726', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0726', 'WILSHIRE'),
('727', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0727', 'WILSHIRE'),
('729', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0729', 'WILSHIRE'),
('732', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0732', 'WILSHIRE'),
('733', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0733', 'WILSHIRE'),
('734', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0734', 'WILSHIRE'),
('735', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0735', 'WILSHIRE'),
('736', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0736', 'WILSHIRE'),
('737', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0737', 'WILSHIRE'),
('738', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0738', 'WILSHIRE'),
('739', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0739', 'WILSHIRE'),
('742', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0742', 'WILSHIRE'),
('743', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0743', 'WILSHIRE'),
('745', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0745', 'WILSHIRE'),
('747', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0747', 'WILSHIRE'),
('749', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0749', 'WILSHIRE'),
('752', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0752', 'WILSHIRE'),
('753', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0753', 'WILSHIRE'),
('755', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0755', 'WILSHIRE'),
('758', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0758', 'WILSHIRE'),
('759', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0759', 'WILSHIRE'),
('762', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0762', 'WILSHIRE'),
('763', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0763', 'WILSHIRE'),
('764', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0764', 'WILSHIRE'),
('765', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0765', 'WILSHIRE'),
('766', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0766', 'WILSHIRE'),
('767', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0767', 'WILSHIRE'),
('769', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0769', 'WILSHIRE'),
('773', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0773', 'WILSHIRE'),
('774', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0774', 'WILSHIRE'),
('775', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0775', 'WILSHIRE'),
('776', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0776', 'WILSHIRE'),
('777', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0777', 'WILSHIRE'),
('778', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0778', 'WILSHIRE'),
('779', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0779', 'WILSHIRE'),
('782', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0782', 'WILSHIRE'),
('783', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0783', 'WILSHIRE'),
('784', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0784', 'WILSHIRE'),
('785', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0785', 'WILSHIRE'),
('787', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0787', 'WILSHIRE'),
('788', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0788', 'WILSHIRE'),
('789', 'Wilshire Division', 'WEST BUREAU', 7, 'LAPD 0789', 'WILSHIRE'),
('801', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0801', 'WEST LOS ANGELES'),
('802', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0802', 'WEST LOS ANGELES'),
('803', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0803', 'WEST LOS ANGELES'),
('804', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0804', 'WEST LOS ANGELES'),
('805', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0805', 'WEST LOS ANGELES'),
('806', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0806', 'WEST LOS ANGELES'),
('807', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0807', 'WEST LOS ANGELES'),
('808', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0808', 'WEST LOS ANGELES'),
('809', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0809', 'WEST LOS ANGELES'),
('811', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0811', 'WEST LOS ANGELES'),
('812', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0812', 'WEST LOS ANGELES'),
('813', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0813', 'WEST LOS ANGELES'),
('814', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0814', 'WEST LOS ANGELES'),
('815', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0815', 'WEST LOS ANGELES'),
('816', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0816', 'WEST LOS ANGELES'),
('817', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0817', 'WEST LOS ANGELES'),
('818', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0818', 'WEST LOS ANGELES'),
('819', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0819', 'WEST LOS ANGELES'),
('821', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0821', 'WEST LOS ANGELES'),
('822', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0822', 'WEST LOS ANGELES'),
('823', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0823', 'WEST LOS ANGELES'),
('824', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0824', 'WEST LOS ANGELES'),
('825', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0825', 'WEST LOS ANGELES'),
('826', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0826', 'WEST LOS ANGELES'),
('827', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0827', 'WEST LOS ANGELES'),
('828', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0828', 'WEST LOS ANGELES'),
('829', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0829', 'WEST LOS ANGELES'),
('831', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0831', 'WEST LOS ANGELES'),
('832', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0832', 'WEST LOS ANGELES'),
('833', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0833', 'WEST LOS ANGELES'),
('834', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0834', 'WEST LOS ANGELES'),
('835', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0835', 'WEST LOS ANGELES'),
('836', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0836', 'WEST LOS ANGELES'),
('837', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0837', 'WEST LOS ANGELES'),
('838', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0838', 'WEST LOS ANGELES'),
('839', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0839', 'WEST LOS ANGELES'),
('841', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0841', 'WEST LOS ANGELES'),
('842', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0842', 'WEST LOS ANGELES'),
('843', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0843', 'WEST LOS ANGELES'),
('847', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0847', 'WEST LOS ANGELES'),
('848', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0848', 'WEST LOS ANGELES'),
('849', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0849', 'WEST LOS ANGELES'),
('851', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0851', 'WEST LOS ANGELES'),
('852', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0852', 'WEST LOS ANGELES'),
('853', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0853', 'WEST LOS ANGELES'),
('854', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0854', 'WEST LOS ANGELES'),
('855', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0855', 'WEST LOS ANGELES'),
('857', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0857', 'WEST LOS ANGELES'),
('858', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0858', 'WEST LOS ANGELES'),
('859', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0859', 'WEST LOS ANGELES'),
('861', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0861', 'WEST LOS ANGELES'),
('871', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0871', 'WEST LOS ANGELES'),
('872', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0872', 'WEST LOS ANGELES'),
('881', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0881', 'WEST LOS ANGELES'),
('882', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0882', 'WEST LOS ANGELES'),
('883', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0883', 'WEST LOS ANGELES'),
('884', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0884', 'WEST LOS ANGELES'),
('885', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0885', 'WEST LOS ANGELES'),
('886', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0886', 'WEST LOS ANGELES'),
('887', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0887', 'WEST LOS ANGELES'),
('889', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0889', 'WEST LOS ANGELES'),
('891', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0891', 'WEST LOS ANGELES'),
('892', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0892', 'WEST LOS ANGELES'),
('893', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0893', 'WEST LOS ANGELES'),
('895', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0895', 'WEST LOS ANGELES'),
('896', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0896', 'WEST LOS ANGELES'),
('897', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0897', 'WEST LOS ANGELES'),
('898', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0898', 'WEST LOS ANGELES'),
('899', 'West Los Angeles Div', 'WEST BUREAU', 8, 'LAPD 0899', 'WEST LOS ANGELES'),
('901', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0901', 'VAN NUYS'),
('904', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0904', 'VAN NUYS'),
('905', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0905', 'VAN NUYS'),
('906', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0906', 'VAN NUYS'),
('909', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0909', 'VAN NUYS'),
('911', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0911', 'VAN NUYS'),
('914', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0914', 'VAN NUYS'),
('915', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0915', 'VAN NUYS'),
('916', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0916', 'VAN NUYS'),
('919', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0919', 'VAN NUYS'),
('923', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0923', 'VAN NUYS'),
('926', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0926', 'VAN NUYS'),
('929', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0929', 'VAN NUYS'),
('931', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0931', 'VAN NUYS'),
('932', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0932', 'VAN NUYS'),
('933', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0933', 'VAN NUYS'),
('935', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0935', 'VAN NUYS'),
('937', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0937', 'VAN NUYS'),
('938', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0938', 'VAN NUYS'),
('939', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0939', 'VAN NUYS'),
('941', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0941', 'VAN NUYS'),
('943', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0943', 'VAN NUYS'),
('946', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0946', 'VAN NUYS'),
('948', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0948', 'VAN NUYS'),
('952', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0952', 'VAN NUYS'),
('955', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0955', 'VAN NUYS'),
('957', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0957', 'VAN NUYS'),
('961', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0961', 'VAN NUYS'),
('963', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0963', 'VAN NUYS'),
('964', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0964', 'VAN NUYS'),
('966', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0966', 'VAN NUYS'),
('969', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0969', 'VAN NUYS'),
('971', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0971', 'VAN NUYS'),
('974', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0974', 'VAN NUYS'),
('976', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0976', 'VAN NUYS'),
('979', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0979', 'VAN NUYS'),
('981', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0981', 'VAN NUYS'),
('984', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0984', 'VAN NUYS'),
('985', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0985', 'VAN NUYS'),
('989', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0989', 'VAN NUYS'),
('991', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0991', 'VAN NUYS'),
('994', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0994', 'VAN NUYS'),
('998', 'Van Nuys Division', 'VALLEY BUREAU', 9, 'LAPD 0998', 'VAN NUYS');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incident_id` int(11) NOT NULL,
  `reported_time` datetime NOT NULL,
  `occurred_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incident_id`, `reported_time`, `occurred_time`) VALUES
(1, '2020-02-22 12:00:00', '2020-02-19 12:00:00'),
(2, '2020-01-08 12:00:00', '2020-01-08 22:30:00'),
(3, '2020-01-02 00:00:00', '2020-01-01 03:30:00'),
(4, '2020-04-14 00:00:00', '2020-02-13 12:00:00'),
(5, '2020-01-01 00:00:00', '2020-01-01 17:30:00');

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
  `latitude` decimal(7,4) NOT NULL,
  `longitude` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `district_id`, `address`, `cross_street`, `area_name`, `latitude`, `longitude`) VALUES
(1, '932', '14700 FRIAR ST', '', 'Van Nuys', 34.1857, -118.4574),
(2, '377', '1100 W 39TH PL', '', 'Southwest', 34.0141, -118.2978),
(3, '163', '700 S HILL ST', '', 'Central', 34.0459, -118.2545),
(4, '155', '200 E 6TH ST', '', 'Central', 34.0448, -118.2474),
(5, '1543', '5400 CORTEEN PL', '', 'N Hollywood', 34.1685, -118.4019);

-- --------------------------------------------------------

--
-- Table structure for table `modus`
--

CREATE TABLE `modus` (
  `mo_code` varchar(10) NOT NULL,
  `mo_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `modus`
--

INSERT INTO `modus` (`mo_code`, `mo_desc`) VALUES
('0100', 'Suspect Impersonate'),
('0101', 'Aid victim'),
('0102', 'Blind'),
('0103', 'Physically disabled'),
('0104', 'Customer'),
('0105', 'Delivery'),
('0106', 'Doctor'),
('0107', 'God'),
('0108', 'Infirm'),
('0109', 'Inspector'),
('0110', 'Involved in traffic/accident'),
('0112', 'Police'),
('0113', 'Renting'),
('0114', 'Repair Person'),
('0115', 'Returning stolen property'),
('0116', 'Satan'),
('0117', 'Salesman'),
('0118', 'Seeking someone'),
('0119', 'Sent by owner'),
('0120', 'Social Security/Medicare'),
('0121', 'DWP/Gas Company/Utility worker'),
('0122', 'Contractor'),
('0123', 'Gardener/Tree Trimmer'),
('0200', 'Suspect wore disguise'),
('0201', 'Bag'),
('0202', 'Cap/hat'),
('0203', 'Cloth (with eyeholes)'),
('0204', 'Clothes of opposite sex'),
('0205', 'Earring'),
('0206', 'Gloves'),
('0207', 'Handkerchief'),
('0208', 'Halloween mask'),
('0209', 'Mask'),
('0210', 'Make up (males only)'),
('0211', 'Shoes'),
('0212', 'Nude/partly nude'),
('0213', 'Ski mask'),
('0214', 'Stocking'),
('0215', 'Unusual clothes'),
('0216', 'Suspect wore hood/hoodie'),
('0217', 'Uniform'),
('0218', 'Wig'),
('0219', 'Mustache-Fake'),
('0220', 'Suspect wore motorcycle helmet'),
('0301', 'Escaped on (used) transit train'),
('0302', 'Aimed gun'),
('0303', 'Ambushed'),
('0304', 'Ate/drank on premises'),
('0305', 'Attacks from rear'),
('0306', 'Crime on upper floor'),
('0307', 'Defecated/urinated'),
('0308', 'Demands jewelry'),
('0309', 'Drive-by shooting'),
('0310', 'Got victim to withdraw savings'),
('0311', 'Graffiti'),
('0312', 'Gun in waistband'),
('0313', 'Hid in building'),
('0314', 'Hot Prowl'),
('0315', 'Jumped counter/goes behind counter'),
('0316', 'Makes victim give money'),
('0317', 'Pillowcase/suitcase'),
('0318', 'Prepared exit'),
('0319', 'Profanity Used'),
('0320', 'Quiet polite'),
('0321', 'Ransacked'),
('0322', 'Smashed display case'),
('0323', 'Smoked on premises'),
('0324', 'Takes money from register'),
('0325', 'Took merchandise'),
('0326', 'Used driver'),
('0327', 'Used lookout'),
('0328', 'Used toilet'),
('0329', 'Vandalized'),
('0330', 'Victims vehicle taken'),
('0331', 'Mailbox Bombing'),
('0332', 'Mailbox Vandalism'),
('0333', 'Used hand held radios'),
('0334', 'Brandishes weapon'),
('0335', 'Cases location'),
('0336', 'Chain snatch'),
('0337', 'Demands money'),
('0338', 'Disables Telephone'),
('0339', 'Disables video camera'),
('0340', 'Suspect follows victim/follows victim home'),
('0341', 'Makes vict lie down'),
('0342', 'Multi-susps overwhelm'),
('0343', 'Orders vict to rear room'),
('0344', 'Removes vict property'),
('0345', 'Riding bike'),
('0346', 'Snatch property and runs'),
('0347', 'Stalks vict'),
('0348', 'Takeover other'),
('0349', 'Takes mail'),
('0350', 'Concealed victim\'s body'),
('0351', 'Disabled Security'),
('0352', 'Took Victim\'s clothing or jewelry'),
('0353', 'Weapon Concealed'),
('0354', 'Suspect takes car keys'),
('0355', 'Demanded property other than money'),
('0356', 'Suspect spits on victim'),
('0357', 'Cuts or breaks purse strap'),
('0358', 'Forces Entry'),
('0359', 'Made unusual statement'),
('0360', 'Suspect is Other Family Member'),
('0361', 'Suspect is neighbor'),
('0362', 'Suspect attempts to carry victim away'),
('0363', 'Home invasion'),
('0364', 'Suspect is babysitter'),
('0365', 'Takeover robbery'),
('0366', 'Ordered vict to open safe'),
('0367', 'Was Transit Patrol'),
('0368', 'Suspect speaks foreign language'),
('0369', 'Suspect speaks spanish'),
('0370', 'Frisks victim/pats down victim/searches victim'),
('0371', 'Gang affiliation questions asked/made gang stateme'),
('0372', 'Photographed victim/took pictures of victim'),
('0373', 'Physicall disabled/in wheelchair'),
('0374', 'Gang signs/threw gang signs using hands'),
('0375', 'Removes cash register'),
('0376', 'Makes victim kneel'),
('0377', 'Takes vict\'s identification/driver license'),
('0378', 'Brings own bag'),
('0379', 'Turns off lights/electricity'),
('0380', 'Distracts Victim'),
('0381', 'Suspect apologizes'),
('0382', 'Removed money/property from safe'),
('0383', 'Suspect entered during open house/party/estate/yar'),
('0384', 'Suspect removed drugs from location'),
('0385', 'Suspect removed parts from vehicle'),
('0386', 'Suspect removed property from trunk of vehicle'),
('0387', 'Weapon (other than gun) in waistband'),
('0388', 'Suspect points laser at plane/helicopter'),
('0389', 'Knock-knock'),
('0390', 'Purse snatch'),
('0391', 'Used demand note'),
('0392', 'False Emergency Reporting'),
('0393', '911 Abuse'),
('0394', 'Susp takes UPS, Fedex, USPS packages'),
('0395', 'Murder/Suicide'),
('0396', 'Used paper plates to disguise license number'),
('0397', 'Cut lock (to bicycle, gate, etc.'),
('0398', 'Roof access (remove A/C, equip, etc.)'),
('0399', 'Vehicle to Vehicle shooting'),
('0400', 'Force used'),
('0401', 'Bit'),
('0402', 'Blindfolded'),
('0403', 'Bomb Threat, Bomb found'),
('0404', 'Bomb Threat, no bomb'),
('0405', 'Bound'),
('0406', 'Brutal Assault'),
('0407', 'Burned Victim'),
('0408', 'Choked/uses choke hold/Strangulation'),
('0409', 'Cover mouth w/hands'),
('0410', 'Covered victim\'s face'),
('0411', 'Cut/stabbed'),
('0412', 'Disfigured'),
('0413', 'Drugged'),
('0414', 'Gagged'),
('0415', 'Handcuffed/Metal'),
('0416', 'Hit-Hit w/ weapon'),
('0417', 'Kicked'),
('0418', 'Kidnapped'),
('0419', 'Pulled victims hair'),
('0420', 'Searched'),
('0421', 'Threaten to kill'),
('0422', 'Threaten Victims family'),
('0423', 'Tied victim to object'),
('0424', 'Tore clothes off victim'),
('0425', 'Tortured'),
('0426', 'Twisted arm'),
('0427', 'Whipped'),
('0428', 'Dismembered'),
('0429', 'Vict knocked to ground'),
('0430', 'Vict shot'),
('0431', 'Sprayed with chemical'),
('0432', 'Intimidation'),
('0433', 'Makes victim kneel'),
('0434', 'Bed Sheets/Linens'),
('0435', 'Chain'),
('0436', 'Clothing'),
('0437', 'Flexcuffs/Plastic Tie'),
('0438', 'Rope/Cordage'),
('0439', 'Tape/Electrical etc...'),
('0440', 'Telephone/Electric Cord'),
('0441', 'Wire'),
('0442', 'Active Shooter/Armed person who has used deadly ph'),
('0443', 'Threaten to harm victim (other than kill)'),
('0444', 'Pushed'),
('0445', 'Suspect swung weapon'),
('0446', 'Suspect swung fist'),
('0447', 'Suspect threw object at victim'),
('0448', 'Grabbed'),
('0449', 'Put a weapon to body'),
('0450', 'Suspect shot at victim (no hits)'),
('0451', 'Suffocation'),
('0500', 'Sex related acts'),
('0501', 'Susp ejaculated outside victim'),
('0502', 'Fecal Fetish'),
('0503', 'Fondle victim'),
('0504', 'Forced to disrobe'),
('0505', 'Forced to fondle suspect'),
('0506', 'Forced to masturbate suspect'),
('0507', 'Forced to orally copulate suspect'),
('0508', 'Hit victim prior, during, after act'),
('0509', 'Hugged'),
('0510', 'Kissed victims body/face'),
('0511', 'Masochism/bondage'),
('0512', 'Orally copulated victim'),
('0513', 'Photographed victim'),
('0514', 'Pornography'),
('0515', 'Put hand, finger or object into vagina'),
('0516', 'Reached climax/ejaculated'),
('0517', 'Sadism/Sexual gratification obtained by infliction'),
('0518', 'Simulated intercourse'),
('0519', 'Sodomy'),
('0520', 'Solicited/offered immoral act'),
('0521', 'Tongue or mouth to anus'),
('0522', 'Touched'),
('0523', 'Unable to get erection'),
('0524', 'Underwear Fetish'),
('0525', 'Urinated'),
('0526', 'Utilized Condom'),
('0527', 'Actual Intercourse'),
('0528', 'Masturbate'),
('0529', 'Indecent Exposure'),
('0530', 'Used lubricant'),
('0531', 'Suspect made sexually suggestive remarks'),
('0532', 'Suspect undressed victim'),
('0533', 'Consentual Sex'),
('0534', 'Suspect in vehicle nude/partially nude'),
('0535', 'Suspect asks minor\'s name'),
('0536', 'Suspect removes own clothing'),
('0537', 'Suspect removes victim\'s clothing'),
('0538', 'Suspect fondles self'),
('0539', 'Suspect puts hand in victim\'s rectum'),
('0540', 'Suspect puts finger(s) in victim\'s rectum'),
('0541', 'Suspect puts object(s) in victim\'s rectum'),
('0542', 'Orders victim to undress'),
('0543', 'Orders victim to fondle suspect'),
('0544', 'Orders victim to fondle self'),
('0545', 'Male Victim of sexual assault'),
('0546', 'Susp instructs vict to make certain statements'),
('0547', 'Suspect force vict to bathe/clean/wipe'),
('0548', 'Suspect gives victim douche/enema'),
('0549', 'Suspect ejaculates in victims mouth'),
('0550', 'Suspect licks victim'),
('0551', 'Suspect touches victim genitalia/genitals over clo'),
('0552', 'Suspect is Victim\'s Father'),
('0553', 'Suspect is Victim\'s Mother'),
('0554', 'Suspect is Victim\'s Brother'),
('0555', 'Suspect is Victim\'s Sister'),
('0556', 'Suspect is Victim\'s Step-Father'),
('0557', 'Suspect is Victim\'s Step-Mother'),
('0558', 'Suspect is Victim\'s Uncle'),
('0559', 'Suspect is Victim\'s Aunt'),
('0560', 'Suspect is Victim\'s Guardian'),
('0561', 'Suspect is Victim\'s Son'),
('0562', 'Suspect is Victim\'s Daughter'),
('0563', 'Fetish, Other'),
('0601', 'Business'),
('0602', 'Family'),
('0603', 'Landlord/Tenant/Neighbor'),
('0604', 'Reproductive Health Services/Facilities'),
('0605', 'Traffic Accident/Traffic related incident'),
('0701', 'THEFT: Trick or Device'),
('0800', 'BUNCO'),
('0901', 'Organized Crime'),
('0902', 'Political Activity'),
('0903', 'Hatred/Prejudice'),
('0904', 'Strike/Labor Troubles'),
('0905', 'Terrorist Group'),
('0906', 'Gangs'),
('0907', 'Narcotics (Buy-Sell-Rip)'),
('0908', 'Prostitution'),
('0909', 'Ritual/Occult'),
('0910', 'Public Transit (Metrolink/Train Station,Metro Rail'),
('0911', 'Revenge'),
('0912', 'Insurance'),
('0913', 'Victim knew Suspect'),
('0914', 'Other Felony'),
('0915', 'Parolee'),
('0916', 'Forced theft of vehicle (Car-Jacking)'),
('0917', 'Victim\'s Employment'),
('0918', 'Career Criminal'),
('0919', 'Road Rage'),
('0920', 'Homeland Security'),
('0921', 'Hate Incident'),
('0922', 'ATM Theft with PIN number'),
('0923', 'Stolen/Forged Checks (Personal Checks)'),
('0924', 'Stolen/Forged Checks (Business Checks)'),
('0925', 'Stolen/Forged Checks (Cashier\'s Checks)'),
('0926', 'Forged or Telephonic Prescription'),
('0927', 'Fraudulent or forged school loan'),
('0928', 'Forged or Fraudulent credit applications'),
('0929', 'Unauthorized use of victim\'s bank account informat'),
('0930', 'Unauthorized use of victim\'s credit/debit card or '),
('0931', 'Counterfeit or forged real estate documents'),
('0932', 'Suspect uses victim\'s identity in reporting a traf'),
('0933', 'Suspect uses victim\'s identity when arrested'),
('0934', 'Suspect uses victim\'s identity when receiving a ci'),
('0935', 'Misc. Stolen/Forged documents'),
('0936', 'Dog Fighting'),
('0937', 'Cock Fighting'),
('0938', 'Animal Neglect'),
('0939', 'Animal Hoarding'),
('0940', 'Met online/Chat Room/on Party Line'),
('0941', 'Non-Revocable Parole (NRP)'),
('0942', 'Party/Flier party/Rave Party'),
('0943', 'Human Trafficking'),
('0944', 'Bait Operation'),
('0945', 'Estes Robbery'),
('0946', 'Gang Feud'),
('0947', 'Motorized Rental Scooter/Bike (Bird, Lime, etc).'),
('1000', 'Suspects offers/solicits'),
('1001', 'Aid for vehicle'),
('1002', 'Amusement'),
('1003', 'appraise'),
('1004', 'Assistant'),
('1005', 'Audition'),
('1006', 'Bless'),
('1007', 'Candy'),
('1008', 'Cigarette'),
('1009', 'Directions'),
('1010', 'Drink (not liquor)'),
('1011', 'Employment'),
('1012', 'Find a job'),
('1013', 'Food'),
('1014', 'Game'),
('1015', 'Gift'),
('1016', 'Hold for safekeeping'),
('1017', 'Information'),
('1018', 'Liquor'),
('1019', 'Money'),
('1020', 'Narcotics                                         '),
('1021', 'Repair'),
('1022', 'Ride'),
('1023', 'Subscriptions'),
('1024', 'Teach'),
('1025', 'Train'),
('1026', 'Use the phone or toilet'),
('1027', 'Change'),
('1028', 'Suspect solicits time of day'),
('1100', 'Shots Fired'),
('1101', 'Shots Fired (Animal) - Animal Services'),
('1201', 'Absent-advertised in paper'),
('1202', 'Victim was aged (60 & over) or blind/physically di'),
('1203', 'Victim of crime past 12 months'),
('1204', 'Moving'),
('1205', 'On Vacation/Tourist'),
('1206', 'Under influence drugs/liquor'),
('1207', 'Hitchhiker'),
('1208', 'Victim was undocumented alien'),
('1209', 'Salesman, Jewelry'),
('1210', 'Professional (doctor, Lawyer, etc.)'),
('1211', 'Public Official'),
('1212', 'LA Police Officer'),
('1213', 'LA Fireman'),
('1214', 'Banking, ATM'),
('1215', 'Prostitute'),
('1216', 'Sales'),
('1217', 'Teenager(Use if victim\'s age is unknown)'),
('1218', 'Victim was Homeless/Transient'),
('1219', 'Nude'),
('1220', 'Partially Nude'),
('1221', 'Missing Clothing/Jewelry'),
('1222', 'Victim was gay'),
('1223', 'Riding bike'),
('1224', 'Drive-through (not merchant)'),
('1225', 'Stop sign/light'),
('1226', 'Catering Truck Operator'),
('1227', 'Delivery person'),
('1228', 'Leaving Business Area'),
('1229', 'Making bank drop'),
('1230', 'Postal employee'),
('1231', 'Taxi Driver'),
('1232', 'Bank, Arriving at'),
('1233', 'Bank, Leaving'),
('1234', 'Bar Customer'),
('1235', 'Bisexual/sexually oriented towards both sexes'),
('1236', 'Clerk/Employer/Owner'),
('1237', 'Victim was customer'),
('1238', 'Victim was physically disabled'),
('1239', 'Transgender'),
('1240', 'Vehicle occupant/Passenger'),
('1241', 'Spouse'),
('1242', 'Parent'),
('1243', 'Co-habitants'),
('1244', 'Victim was forced into business'),
('1245', 'Victim was forced into residence'),
('1247', 'Opening business'),
('1248', 'Closing business'),
('1251', 'Victim was a student'),
('1252', 'Victim was a street vendor'),
('1253', 'Bus Driver'),
('1254', 'Train Operator'),
('1255', 'Followed Transit System'),
('1256', 'Patron'),
('1257', 'Victim is Newborn-5 years old'),
('1258', 'Victim is 6 years old thru 13 years old'),
('1259', 'Victim is 14 years old thru 17 years old'),
('1260', 'Deaf/Hearing Impaired'),
('1261', 'Victim was mentally challenged/mentally disabled'),
('1262', 'Raped while unconscious'),
('1263', 'Agricultural Target'),
('1264', 'Pipeline'),
('1265', 'Mailbox'),
('1266', 'Victim was security guard'),
('1267', 'Home under construction'),
('1268', 'Victim was 5150/Mental Illness'),
('1269', 'Victim was armored car driver'),
('1270', 'Victim was gang member'),
('1271', 'Victim was Law Enforcement (not LAPD)'),
('1272', 'Victim was at/leaving medical/retail/non-retail ca'),
('1273', 'Home was being fumigated'),
('1274', 'Victim was Inmate/Incarcerated'),
('1275', 'Vacant Residence/Building'),
('1276', 'Pregnant'),
('1277', 'Gardner'),
('1278', 'Victim was Uber/Lyft driver'),
('1279', 'Victim was Foster child'),
('1280', 'Victim was Foster parent'),
('1281', 'Victim was Pistol-whipped'),
('1300', 'Vehicle involved'),
('1301', 'Forced victim vehicle to curb'),
('1302', 'Suspect forced way into victim\'s vehicle'),
('1303', 'Hid in rear seat'),
('1304', 'Stopped victim vehicle by flagging down, forcing T'),
('1305', 'Victim forced into vehicle'),
('1306', 'Victim parking, garaging vehicle'),
('1307', 'Breaks window'),
('1308', 'Drives by and snatches property'),
('1309', 'Susp uses vehicle'),
('1310', 'Victim in vehicle'),
('1311', 'Victim removed from vehicle'),
('1312', 'Suspect follows victim in vehicle'),
('1313', 'Suspect exits vehicle and attacks pedestrian'),
('1314', 'Victim loading vehicle'),
('1315', 'Victim unloading vehicle'),
('1316', 'Victim entering their vehicle'),
('1317', 'Victim exiting their vehicle'),
('1318', 'Suspect follows victim home'),
('1401', 'Blood Stains'),
('1402', 'Evidence Booked (any crime)'),
('1403', 'Fingerprints'),
('1404', 'Footprints'),
('1405', 'Left Note'),
('1406', 'Tool Marks'),
('1407', 'Bullets/Casings'),
('1408', 'Bite Marks'),
('1409', 'Clothes'),
('1410', 'Gun Shot Residue'),
('1411', 'Hair'),
('1412', 'Jewelry'),
('1413', 'Paint'),
('1414', 'Photographs'),
('1415', 'Rape Kit'),
('1416', 'Saliva'),
('1417', 'Semen'),
('1418', 'Skeleton/Bones'),
('1419', 'Firearm booked as evidence'),
('1420', 'Video surveillance booked/available'),
('1501', 'Other MO (see rpt)'),
('1505', 'Bias:  Mental Disability'),
('1506', 'Bias:  Physical disability'),
('1507', 'Bias : Anti-female'),
('1508', 'Bias:  Anti-male'),
('1509', 'Bias:  Anti-Gender non-conforming '),
('1510', 'Bias:  Anti-Transgender'),
('1511', 'Bias:  Anti-American/Alaskan Native'),
('1512', 'Bias:  Anti-Arab'),
('1513', 'Bias:  Anti-Asian'),
('1514', 'Bias:  AntI-Black or African American'),
('1515', 'Bias:  Anti-Citizenship Status'),
('1516', 'Bias:  Anti-Hispanic or Latino'),
('1517', 'Bias:  Anti-Multiple Races (Group)'),
('1518', 'Bias:  Anti-Native Hawaiian or Other Pacific Islan'),
('1519', 'Bias:  Anti-Other Race/Ethnicity/Ancestry'),
('1520', 'Bias:  Anti-White'),
('1521', 'Bias:  Anti-Atheism/Agnosticism'),
('1522', 'Bias:  Anti-Buddhist'),
('1523', 'Bias:  Anti-Catholic'),
('1524', 'Bias:  Anti-Eastern Orthodox (Russian/Greek/Other)'),
('1525', 'Bias:  Anti-Hindu'),
('1526', 'Bias:  Anti-Islamic (Muslim)'),
('1527', 'Bias:  Anti-Jehovah\'s Witness'),
('1528', 'Bias:  Anti-Jewish'),
('1529', 'Bias:  Anti-Mormon'),
('1530', 'Bias:  Anti-Multiple Religions Group'),
('1531', 'Bias:  Anti-Other Christian'),
('1532', 'Bias:  Anti-Other Religion'),
('1533', 'Bias:  Anti-Protestant'),
('1534', 'Bias:  Anti-Sikh'),
('1535', 'Bias:  Anti-Bisexual'),
('1536', 'Bias:  Anti-Gay (Male)'),
('1537', 'Bias:  Anti-Heterosexual'),
('1538', 'Bias:  Anti-Lesbian'),
('1539', 'Bias:  Anti-Lesbian/Gay/Bisexual or Transgender (M'),
('1601', 'Bodily Force'),
('1602', 'Cutting Tool'),
('1603', 'Knob Twist'),
('1604', 'Lock Box'),
('1605', 'Lock slip/key/pick'),
('1606', 'Open/unlocked'),
('1607', 'Pried'),
('1608', 'Removed'),
('1609', 'Smashed'),
('1610', 'Tunneled'),
('1611', 'Shaved Key'),
('1612', 'Punched/Pulled Door Lock'),
('1701', 'Elder Abuse/Physical'),
('1702', 'Elder Abuse/Financial'),
('1801', 'Susp is/was mother\'s boyfriend'),
('1802', 'Susp is/was victim\'s co-worker'),
('1803', 'Susp is/was victim\'s employee'),
('1804', 'Susp is/was victim\'s employer'),
('1805', 'Susp is/was fellow gang member'),
('1806', 'Susp is/was father\'s girlfriend'),
('1807', 'Susp is/was priest/pastor'),
('1808', 'Susp is/was other religious confidant'),
('1809', 'Susp is/was rival gang member'),
('1810', 'Susp is/was roommate'),
('1811', 'Susp is/was victim\'s teacher/coach'),
('1812', 'Susp is/was foster parent/sibling'),
('1813', 'Susp is/was current/former spouse/co-habitant'),
('1814', 'Susp is/was current/former boyfriend/girlfriend'),
('1815', 'Susp was student'),
('1816', 'Suspect is/was known gang member'),
('1817', 'Acquaintance'),
('1818', 'Caretaker/care-giver/nanny'),
('1819', 'Common-law Spouse'),
('1820', 'Friend'),
('1821', 'Spouse'),
('1822', 'Stranger'),
('1823', 'Brief encounter/Date'),
('1824', 'Classmate'),
('1900', 'Auction Fraud/eBay/cragslist,etc. (Internet based '),
('1901', 'Child Pornography/In possession of/Via computer'),
('1902', 'Credit Card Fraud/Theft of services via internet'),
('1903', 'Cyberstalking (Stalking using internet to commit t'),
('1904', 'Denial of computer services'),
('1905', 'Destruction of computer data'),
('1906', 'Harrassing E-Mail/Text Message/Other Electronic Co'),
('1907', 'Hate Crime materials/printouts/e-mails'),
('1908', 'Identity Theft via computer'),
('1909', 'Introduction of virus or contaminants into compute'),
('1910', 'Minor solicited for sex via internet/Known minor'),
('1911', 'Theft of computer data'),
('1912', 'Threatening E-mail/Text Messages'),
('1913', 'Suspect meets victim on internet/chatroom'),
('1914', 'Unauthorized access to computer system'),
('1915', 'Internet Extortion'),
('1916', 'Victim paid by wire transfer'),
('2000', 'Domestic violence'),
('2001', 'Suspect on drugs'),
('2002', 'Suspect intoxicated/drunk'),
('2003', 'Suspect was 5150/mentally disabled'),
('2004', 'Suspect is homeless/transient'),
('2005', 'Suspect uses wheelchair'),
('2006', 'Suspect was transgender'),
('2007', 'Suspect was gay'),
('2008', 'In possession of a Ballistic vest'),
('2009', 'Suspect was Inmate/Incarcerated'),
('2010', 'Suspect was Jailer/Police Officer'),
('2011', 'Vendor (street or sidewalk)'),
('2012', 'Suspect was costumed character (e.g., Barney, Dart'),
('2013', 'Tour Bus/Van Operator'),
('2014', 'Suspect was Uber/Lyft driver'),
('2015', 'Suspect was Foster child'),
('2016', 'Suspect was Train Operator'),
('2017', 'Suspect was MTA Bus Driver'),
('2018', 'Cannabis related'),
('2019', 'Theft of animal (non-livestock)'),
('2020', 'Mistreatment of animal'),
('2021', 'Suspect was Aged (60+over)'),
('2022', 'Suspect was Hitchhiker'),
('2023', 'Suspect was Prostitute'),
('2024', 'Suspect was Juvenile '),
('2025', 'Suspect was Bisexual'),
('2026', 'Suspect was Deaf/hearing impaired'),
('2027', 'Suspect was Pregnant'),
('2028', 'Suspect was Repeat/known shoplifter'),
('2029', 'Victim used profanity'),
('2030', 'Victim used racial slurs'),
('2031', 'Victim used hate-related language'),
('2032', 'Victim left property unattended'),
('2033', 'Victim refused to cooperate w/investigation'),
('2034', 'Victim was asleep/unconscious'),
('2035', 'Racial slurs'),
('2036', 'Hate-related language'),
('2037', 'Temporary/Vacation rental (AirBnB, etc)'),
('2038', 'Restraining order in place between suspect and vic'),
('2039', 'Victim was costumed character (e.g., Barney, Darth'),
('2040', 'Threats via Social Media'),
('2041', 'Harassment via Social Media'),
('2042', 'Victim staying at short-term vacation rental'),
('2043', 'Victim is owner of short-term vacation rental'),
('2044', 'Suspect staying at short-term vacation rental'),
('2045', 'Suspect is owner of short-term vacation rental'),
('2046', 'Suspect damaged property equal to or exceeding $25'),
('2047', 'Victim was injured requiring transportation away f'),
('2048', 'Victim was on transit platform'),
('2049', 'Victim was passenger on bus'),
('2050', 'Victim was passenger on train'),
('2051', 'Suspect was passenger on bus'),
('2052', 'Suspect was passenger on train'),
('2053', 'Victim targeted based on religion'),
('2054', 'Victim targeted based on sexual orientation'),
('2055', 'Victim targeted based on Race/Ethnicity/Ancestry'),
('2056', 'Victim targeted based on gender'),
('2057', 'Victim targeted based on disability'),
('2058', 'Victim targeted based on Gender Non-conforming'),
('2059', 'Vict rptd sexual assault at time of arst for unrel'),
('2060', 'Victim inside tent'),
('2100', 'Observation/Surveillance'),
('2101', 'Counter Surveillance efforts'),
('2102', 'Questions about-security procedures'),
('2103', 'Appears to take measurements'),
('2104', 'Photography (pics or video footage)'),
('2105', 'Draws diagrams or takes notes'),
('2106', 'Abandons suspicious package/item'),
('2107', 'Abandons vehicle restricted area'),
('2108', 'Enters restricted area w/o authorization'),
('2109', 'Testing or Probing of Security'),
('2110', 'Contraband at security check point'),
('2111', 'Susp purchase of legal materials'),
('2112', 'Acquires restricted items/information'),
('2113', 'Acquires illegal explosive/precur agents'),
('2114', 'Acquires illegal chemical agent'),
('2115', 'Acquires illegal biological agents'),
('2116', 'Acquires illegal rediological material'),
('2117', 'Uses explosives for illegal purposes'),
('2118', 'Uses chemical agent illegally'),
('2119', 'Uses biological agent illegally'),
('2120', 'Uses radiological material illegally'),
('2121', 'Acquires uniforms without legit reason'),
('2122', 'Acquires official vehicle without legit reason'),
('2123', 'Pursues training/education with suspect motives'),
('2124', 'Large unexplained sum of currency'),
('2125', 'Multiple passports/ID\'s/travel documents'),
('2126', 'Expressed or Implied threats'),
('2127', 'Brags about affiliation with extremist organizatio'),
('2128', 'Coded conversation or transmission'),
('2129', 'Overt support of terrorist network'),
('2130', 'Uses Facsimile/Hoax explosive device (susp offer/s'),
('2131', 'Uses Facsimile/Hoax dispersal device (susp offer/s'),
('2135', 'Sensitive event schedules(susp offer/solicts)'),
('2136', 'VIP appearance or travel schedules (susp offer/sol'),
('2137', 'Security schedules (susp offer/solicts)'),
('2138', 'Blueprints/building plans (susp offer/solicts)'),
('2139', 'Evacuation or emergency plans (susp offer/solicts)'),
('2140', 'Security plans (susp offer/solicts)'),
('2141', 'Weapons or ammunition (susp offer/solicts)'),
('2142', 'Explosive materials(susp offer/solicts)'),
('2143', 'Illicit chemical agents (susp offer/solicts)'),
('2144', 'Illicit biological agents (susp offer/solicts)'),
('2145', 'Illicit radiological material (susp offer/solicts)'),
('2146', 'Other sensitive materials (susp offer/solicts) '),
('2150', 'Coded/ciphered literature/correspondence'),
('2151', 'Sensitive event schedules (susp in possession)'),
('2152', 'VIP appearance or travel schedules (susp in posses'),
('2153', 'Security schedules (susp in possession)'),
('2154', 'Blueprints/building plans (susp in possession)'),
('2155', 'Evacuation or emergency plans (susp in possession)'),
('2156', 'Security plans (susp in possession)'),
('2157', 'Weapons or ammunition (susp in possession)'),
('2158', 'Explosive materials (susp in possession)'),
('2159', 'Illicit chemical agents (susp in possession)'),
('2160', 'Illicit biological agents (susp in possession)'),
('2161', 'Illicit radiological material (susp in possession)'),
('2162', 'Other sensitive materials (susp in possession)'),
('2163', 'Facsimile/Hoax explosive device (susp in possessio'),
('2164', 'Facsimile/Hoax dispersal device (susp in possessio'),
('2170', 'Associates with known/susp terrorist'),
('2171', 'Corresponds w/suspected terrorist'),
('2172', 'In photos w/suspected terrorists'),
('2173', 'Organization supports overthrow/violent acts'),
('2180', 'Bomb/explosive device'),
('2181', 'Biological agent'),
('2182', 'Chemical agent'),
('2183', 'Radiological matter'),
('2184', 'Military ordinance'),
('2185', 'Incendiary device'),
('2186', 'Pyrotechnics'),
('2187', 'Facsimile/Hoax device'),
('2190', 'Financing terrorism'),
('2191', 'Victim\'s religion'),
('2192', 'Victim\'s national origin'),
('2193', 'Influencing societal action'),
('2194', 'Furthering objectives by force'),
('2197', 'SSI - Food/Agriculture'),
('2198', 'Pipeline'),
('2199', 'SSI - Postal/Shipping/Mailbox'),
('2200', 'SSI - Government Facilities/Bldg. '),
('2201', 'Church'),
('2202', 'Synagogue'),
('2203', 'University'),
('2204', 'School'),
('2205', 'Sports Venue'),
('2206', 'Theater'),
('2207', 'Amusement Park'),
('2208', 'Shopping Mall'),
('2209', 'Convention Center'),
('2210', 'Mass Gathering Location'),
('2211', 'Bridge'),
('2212', 'High-Rise Building'),
('2213', 'Airport'),
('2214', 'Freight Train'),
('2215', 'Train Tracks'),
('2216', 'SSI - Chemical storage/Manufacturing plant'),
('2217', 'SSI - Telecommunication Facility/Location'),
('2218', 'SSI - Energy Plant/Facility'),
('2219', 'SSI - Water Facility'),
('2220', 'Sewage Facility/Pipe'),
('2221', 'SSI - Nuclear Facility, Reactors, Materials & Wast'),
('2222', 'SSI - Dam/Reservoir'),
('2223', 'SSI - National Monuments/Icon/Cultural significanc'),
('2224', 'Tactical significance'),
('2225', 'SSI - Healthcare & Public Health/Hospital/Medical '),
('2226', 'Abortion clinic'),
('2227', 'SSI - Defense Industrial Base/Facility'),
('2228', 'SSI - Transportation System'),
('2229', 'SSI - Commercial Facilities'),
('2230', 'SSI - Information Technology'),
('2231', 'SSI - Banking and Finance'),
('2232', 'SSI - Critical Manufacturing'),
('2233', 'SSI - Emergency Services'),
('2234', 'SSI - Waste'),
('2301', 'Breach/Attempted Intrusion'),
('2302', 'Misrepresentation'),
('2303', 'Theft/Loss/Diversion'),
('2304', 'Sabotage/Tampering/Vandalism'),
('2305', 'Cyber Attack'),
('2306', 'Espouses violent extremist views'),
('2307', 'Aviation activity'),
('2308', 'Eliciting information'),
('2309', 'Recruiting'),
('2310', 'Materials '),
('2311', 'Acquisition of expertise'),
('2312', 'Weapons discovery'),
('2313', 'Finance'),
('2314', 'TSC hit'),
('2315', 'Sector-Specific Incident (SSI)'),
('3001', 'T/C - Veh vs Non-collision'),
('3002', 'T/C - Officer Involved T/C'),
('3003', 'T/C - Veh vs Ped'),
('3004', 'T/C - Veh vs Veh'),
('3005', 'T/C - Veh vs Veh on other roadway'),
('3006', 'T/C - Veh vs Parked Veh'),
('3007', 'T/C - Veh vs Train'),
('3008', 'T/C - Veh vs Bike'),
('3009', 'T/C - Veh vs M/C'),
('3010', 'T/C - Veh vs Animal'),
('3011', 'T/C - Veh vs Fixed Object'),
('3012', 'T/C - Veh vs Other Object'),
('3013', 'T/C - M/C vs Veh'),
('3014', 'T/C - M/C vs Fixed Object'),
('3015', 'T/C - M/C vs Other'),
('3016', 'T/C - Bike vs Veh'),
('3017', 'T/C - Bike vs Train'),
('3018', 'T/C - Bike vs Other'),
('3019', 'T/C - Train vs Veh'),
('3020', 'T/C - Train vs Train'),
('3021', 'T/C - Train vs Bike'),
('3022', 'T/C - Train vs Ped'),
('3023', 'T/C - Train vs Fixed Object'),
('3024', 'T/C - (A) Severe Injury'),
('3025', 'T/C - (B) Visible Injury'),
('3026', 'T/C - (C) Complaint of Injury'),
('3027', 'T/C - (K) Fatal Injury'),
('3028', 'T/C - (N) Non Injury'),
('3029', 'T/C - Hit and Run Fel'),
('3030', 'T/C - Hit and Run Misd'),
('3032', 'T/C - Private Property - Yes'),
('3033', 'T/C - Private Property - No'),
('3034', 'T/C - City Property Involved - Yes'),
('3035', 'T/C - City Property Involved - No'),
('3036', 'T/C - At Intersection - Yes'),
('3037', 'T/C - At Intersection - No'),
('3038', 'T/C - DUI Felony'),
('3039', 'T/C - DUI Misdemeanor'),
('3040', 'T/C - Resulting from Street Racing/Speed Exhibitio'),
('3062', 'T/C - Bicyclist in Bicycle Lane'),
('3063', 'T/C - E-Bike'),
('3064', 'T/C - Motorized Scooter'),
('3101', 'T/C - PCF (A) In the Narrative'),
('3102', 'T/C - PCF (B) Other Improper Driving'),
('3103', 'T/C - PCF (C) Other Than Driver'),
('3104', 'T/C - PCF (D) Unk'),
('3201', 'T/C - Weather/Lighting/Roadway'),
('3301', 'T/C - Traffic Control Devices'),
('3401', 'T/C - Type of Collision'),
('3501', 'T/C - Ped Actions'),
('3601', 'T/C - Special Information and Other'),
('3602', 'T/C - Unlicensed motorist'),
('3603', 'T/C - Bicyclists colliding into opened vehicle doo'),
('3701', 'T/C - Movement Preceding Collision'),
('3801', 'T/C - Sobriety'),
('3901', 'T/C - Safety Equipment'),
('4001', 'T/C - Central'),
('4002', 'T/C - Rampart'),
('4003', 'T/C - Southwest'),
('4004', 'T/C - Hollenbeck'),
('4005', 'T/C - Harbor'),
('4006', 'T/C- Hollywood'),
('4007', 'T/C - Wilshire'),
('4008', 'T/C - West Los Angeles'),
('4009', 'T/C - Van Nuys'),
('4010', 'T/C - West Valley'),
('4011', 'T/C - Northeast'),
('4012', 'T/C - 77th'),
('4013', 'T/C - Newton'),
('4014', 'T/C - Pacific'),
('4015', 'T/C - North Hollywood'),
('4016', 'T/C - Foothill'),
('4017', 'T/C - Devonshire'),
('4018', 'T/C - Southeast'),
('4019', 'T/C - Mission'),
('4020', 'T/C - Olympic'),
('4021', 'T/C - Topanga'),
('4024', 'T/C - Central Traffic (CTD)'),
('4025', 'T/C - South Traffic (STD)'),
('4026', 'T/C - Valley Traffic (VTD)'),
('4027', 'T/C - West Traffic (WTD)'),
('9999', 'Indistinctive MO');

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

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `first_name`, `last_name`, `age`, `sex`, `height`, `descent`) VALUES
(0, 'N/A', 'N/A', 0, 'X', 0, 'X'),
(1, 'Rene', 'Martell ', 26, 'M', 173, 'W'),
(2, 'Glen', 'Smith', 46, 'M', 187, 'B'),
(3, 'Barbara', 'Sherman', 36, 'F', 162, 'B'),
(4, 'Alex', 'Cortez', 41, 'M', 174, 'H'),
(5, 'Alejandro', 'Garcia', 25, 'M', 176, 'H'),
(6, 'John', 'Lee', 25, 'M', 179, 'K'),
(7, 'Ron', 'Dayton', 36, 'M', 169, 'W'),
(8, 'Jean', 'McGill', 76, 'F', 162, 'W'),
(9, 'Kuuno', 'de Ruyter', 13, 'M', 156, 'W');

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

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`badge_id`, `first_name`, `last_name`, `join_date`, `rank`, `district_id`) VALUES
(1, 'James', 'Crimes', '1992-03-19', 'Police commissioner', '101'),
(2, 'Ron', 'Geeseson', '2000-07-12', 'Inspector', '155'),
(3, 'Ely', 'Harrelson ', '2010-03-10', 'Captain', '163'),
(4, 'Henry', 'Sherman', '2009-11-26', 'Lieutenant', '377'),
(5, 'Wilford', 'Waters ', '2015-09-04', 'Sargeant', '932'),
(6, 'Harry', 'Dubois', '2008-09-04', 'Lieutenant', '1543');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `report_status` varchar(10) NOT NULL,
  `fatalities` int(11) NOT NULL,
  `case_status` varchar(10) NOT NULL,
  `premise` varchar(50) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `weapon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `last_update`, `report_status`, `fatalities`, `case_status`, `premise`, `incident_id`, `location_id`, `weapon_id`) VALUES
(1, '2020-02-22 00:00:00', 'IC', 0, 'Solved', 'MULTI-UNIT DWELLING (APARTMENT, DUPLEX, ETC)', 1, 1, NULL),
(2, '2020-01-08 00:00:00', 'AO', 0, 'Solved', 'SINGLE FAMILY DWELLING', 2, 2, 400),
(3, '2020-01-01 00:00:00', 'IC', 0, 'Solved', 'SIDEWALK', 3, 3, 500),
(4, '2020-04-14 00:00:00', 'AA', 0, 'Solved', 'POLICE FACILITY', 4, 4, NULL),
(5, '2020-01-01 00:00:00', 'IC', 0, 'Solved', 'MULTI-UNIT DWELLING (APARTMENT, DUPLEX, ETC)', 5, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_crime`
--

CREATE TABLE `report_crime` (
  `report_id` int(11) NOT NULL,
  `crime_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report_crime`
--

INSERT INTO `report_crime` (`report_id`, `crime_code`) VALUES
(1, 354),
(2, 624),
(3, 624),
(4, 845),
(5, 745);

-- --------------------------------------------------------

--
-- Table structure for table `report_criminal`
--

CREATE TABLE `report_criminal` (
  `report_id` int(11) NOT NULL,
  `criminal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report_criminal`
--

INSERT INTO `report_criminal` (`report_id`, `criminal_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 0),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `report_modus`
--

CREATE TABLE `report_modus` (
  `report_id` int(11) NOT NULL,
  `mo_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report_modus`
--

INSERT INTO `report_modus` (`report_id`, `mo_code`) VALUES
(1, '1501'),
(1, '1822'),
(2, '0444'),
(2, '0913'),
(3, '0416'),
(3, '1414'),
(3, '1822'),
(4, '1501'),
(5, '0329'),
(5, '1402');

-- --------------------------------------------------------

--
-- Table structure for table `report_police`
--

CREATE TABLE `report_police` (
  `report_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report_police`
--

INSERT INTO `report_police` (`report_id`, `badge_id`) VALUES
(1, 5),
(2, 4),
(3, 3),
(4, 2),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `report_victim`
--

CREATE TABLE `report_victim` (
  `report_id` int(11) NOT NULL,
  `victim_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report_victim`
--

INSERT INTO `report_victim` (`report_id`, `victim_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 0),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `victim`
--

CREATE TABLE `victim` (
  `victim_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `victim`
--

INSERT INTO `victim` (`victim_id`, `person_id`) VALUES
(0, 0),
(1, 2),
(2, 3),
(3, 5),
(5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `weapon`
--

CREATE TABLE `weapon` (
  `weapon_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `material` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `weapon`
--

INSERT INTO `weapon` (`weapon_id`, `type`, `material`, `color`, `description`) VALUES
(101, 'Firearm', 'Metal', 'Various', 'REVOLVER'),
(102, 'Firearm', 'Metal', 'Black', 'HAND GUN'),
(103, 'Firearm', 'Metal', 'Various', 'RIFLE'),
(104, 'Firearm', 'Metal', 'Black', 'SHOTGUN'),
(105, 'Firearm', 'Metal', 'Various', 'SAWED OFF RIFLE/SHOTGUN'),
(106, 'Firearm', 'Metal', 'Various', 'UNKNOWN FIREARM'),
(107, 'Firearm', 'Metal', 'Various', 'OTHER FIREARM'),
(108, 'Firearm', 'Metal', 'Various', 'AUTOMATIC WEAPON/SUB-MACHINE GUN'),
(109, 'Firearm', 'Metal', 'Black', 'SEMI-AUTOMATIC PISTOL'),
(110, 'Firearm', 'Metal', 'Various', 'SEMI-AUTOMATIC RIFLE'),
(111, 'Firearm', 'Plastic', 'Various', 'STARTER PISTOL/REVOLVER'),
(112, 'Other', 'Plastic', 'Various', 'TOY GUN'),
(113, 'Other', 'Plastic', 'Black', 'SIMULATED GUN'),
(114, 'Firearm', 'Plastic', 'Various', 'AIR PISTOL/REVOLVER/RIFLE/BB GUN'),
(115, 'Firearm', 'Metal', 'Various', 'ASSAULT WEAPON/UZI/AK47/ETC'),
(116, 'Firearm', 'Metal', 'Various', 'ANTIQUE FIREARM'),
(117, 'Firearm', 'Metal', 'Various', 'UNKNOWN TYPE SEMIAUTOMATIC ASSAULT RIFLE'),
(118, 'Firearm', 'Metal', 'Various', 'UZI SEMIAUTOMATIC ASSAULT RIFLE'),
(119, 'Firearm', 'Metal', 'Various', 'MAC-10 SEMIAUTOMATIC ASSAULT WEAPON'),
(120, 'Firearm', 'Metal', 'Various', 'MAC-11 SEMIAUTOMATIC ASSAULT WEAPON'),
(121, 'Firearm', 'Metal', 'Various', 'HECKLER & KOCH 91 SEMIAUTOMATIC ASSAULT RIFLE'),
(122, 'Firearm', 'Metal', 'Various', 'HECKLER & KOCH 93 SEMIAUTOMATIC ASSAULT RIFLE'),
(123, 'Firearm', 'Metal', 'Various', 'M1-1 SEMIAUTOMATIC ASSAULT RIFLE'),
(124, 'Firearm', 'Metal', 'Various', 'M-14 SEMIAUTOMATIC ASSAULT RIFLE'),
(125, 'Firearm', 'Metal', 'Various', 'RELIC FIREARM'),
(200, 'Melee', 'Metal', 'Various', 'KNIFE WITH BLADE 6INCHES OR LESS'),
(201, 'Melee', 'Metal', 'Various', 'KNIFE WITH BLADE OVER 6 INCHES IN LENGTH'),
(202, 'Melee', 'Metal', 'Various', 'BOWIE KNIFE'),
(203, 'Melee', 'Metal', 'Various', 'DIRK/DAGGER'),
(204, 'Melee', 'Metal', 'Silver', 'FOLDING KNIFE'),
(205, 'Melee', 'Metal', 'Various', 'KITCHEN KNIFE'),
(206, 'Melee', 'Metal', 'Various', 'SWITCH BLADE'),
(207, 'Melee', 'Metal', 'Various', 'OTHER KNIFE'),
(208, 'Melee', 'Metal', 'Various', 'RAZOR'),
(209, 'Melee', 'Metal', 'Various', 'STRAIGHT RAZOR'),
(210, 'Melee', 'Metal', 'Various', 'RAZOR BLADE'),
(211, 'Melee', 'Metal', 'Various', 'AXE'),
(212, 'Melee', 'Glass', 'Clear', 'BOTTLE'),
(213, 'Melee', 'Metal', 'Various', 'CLEAVER'),
(214, 'Melee', 'Metal', 'Silver', 'ICE PICK'),
(215, 'Melee', 'Metal', 'Various', 'MACHETE'),
(216, 'Melee', 'Metal', 'Silver', 'SCISSORS'),
(217, 'Melee', 'Metal', 'Various', 'SWORD'),
(218, 'Melee', 'N/A', 'N/A', 'OTHER CUTTING INSTRUMENT'),
(219, 'Melee', 'Metal', 'Various', 'SCREWDRIVER'),
(220, 'Melee', 'Plastic', 'Various', 'SYRINGE'),
(221, 'Other', 'Glass', 'Various', 'GLASS'),
(223, 'Melee', 'Metal', 'Various', 'UNKNOWN TYPE CUTTING INSTRUMENT'),
(300, 'Melee', 'Wood', 'Various', 'BLACKJACK'),
(301, 'Melee', 'Metal', 'Various', 'BELT FLAILING INSTRUMENT/CHAIN'),
(302, 'Melee', 'Wood', 'Brown', 'BLUNT INSTRUMENT'),
(303, 'Melee', 'Metal', 'Various', 'BRASS KNUCKLES'),
(304, 'Melee', 'N/A', 'N/A', 'CLUB/BAT'),
(305, 'Other', 'Various', 'Various', 'FIXED OBJECT'),
(306, 'Melee', 'Stone', 'Brown', 'ROCK/THROWN OBJECT'),
(307, 'Other', 'Metal', 'Various', 'VEHICLE'),
(308, 'Melee', 'Wood', 'Brown', 'STICK'),
(309, 'Melee', 'Wood', 'Various', 'BOARD'),
(310, 'Melee', 'Stone', 'Various', 'CONCRETE BLOCK/BRICK'),
(311, 'Melee', 'Metal', 'Various', 'HAMMER'),
(312, 'Melee', 'Metal', 'Various', 'PIPE/METAL PIPE'),
(400, 'Melee', 'N/A', 'N/A', 'STRONG-ARM (HANDS, FIST, FEET OR BODILY FORCE)'),
(500, 'Other', 'N/A', 'N/A', 'UNKNOWN WEAPON/OTHER WEAPON'),
(501, 'Hazard', 'N/A', 'N/A', 'BOMB THREAT'),
(502, 'Other', 'Wood', 'Various', 'BOW AND ARROW'),
(503, 'Hazard', 'Various', 'Various', 'CAUSTIC CHEMICAL/POISON'),
(504, 'Other', 'Paper', 'White', 'DEMAND NOTE'),
(505, 'Hazard', 'Various', 'Various', 'EXPLOSIVE DEVICE'),
(506, 'Hazard', 'N/A', 'N/A', 'FIRE'),
(507, 'Other', 'Various', 'Various', 'LIQUOR/DRUGS'),
(508, 'Melee', 'Various', 'Various', 'MARTIAL ARTS WEAPONS'),
(509, 'Melee', 'Various', 'Various', 'ROPE/LIGATURE'),
(510, 'Hazard', 'Various', 'Various', 'SCALDING LIQUID'),
(511, 'Hazard', 'N/A', 'N/A', 'VERBAL THREAT'),
(512, 'Hazard', 'Plastic', 'Various', 'MACE/PEPPER SPRAY'),
(513, 'Hazard', 'Plastic', 'Various', 'STUN GUN'),
(514, 'Melee', 'Metal', 'Various', 'TIRE IRON'),
(515, 'Hazard', 'N/A', 'N/A', 'PHYSICAL PRESENCE'),
(516, 'Other', 'N/A', 'N/A', 'DOG/ANIMAL (SIC ANIMAL ON)');

-- --------------------------------------------------------

--
-- Table structure for table `ws_log`
--

CREATE TABLE `ws_log` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

CREATE TABLE `ws_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `ws_log`
--
ALTER TABLE `ws_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criminal`
--
ALTER TABLE `criminal`
  MODIFY `criminal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `victim`
--
ALTER TABLE `victim`
  MODIFY `victim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `weapon`
--
ALTER TABLE `weapon`
  MODIFY `weapon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `ws_log`
--
ALTER TABLE `ws_log`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
