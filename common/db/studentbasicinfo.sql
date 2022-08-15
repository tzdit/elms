-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 12:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ditclassroomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `studentbasicinfo`
--

CREATE TABLE `studentbasicinfo` (
  `infoID` int(11) NOT NULL,
  `profil` varchar(20) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `nida` varchar(25) DEFAULT NULL,
  `region` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `ward` varchar(20) DEFAULT NULL,
  `maritalstatus` varchar(20) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `spouseaddress` varchar(20) DEFAULT NULL,
  `spousephone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentbasicinfo`
--
ALTER TABLE `studentbasicinfo`
  ADD PRIMARY KEY (`infoID`),
  ADD KEY `reg_no` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentbasicinfo`
--
ALTER TABLE `studentbasicinfo`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentbasicinfo`
--
ALTER TABLE `studentbasicinfo`
  ADD CONSTRAINT `studentbasicinfo_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
