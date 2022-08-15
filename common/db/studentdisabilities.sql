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
-- Table structure for table `studentdisabilities`
--

CREATE TABLE `studentdisabilities` (
  `disabID` int(11) NOT NULL,
  `DEAFBLIND` int(11) DEFAULT 0,
  `MULTIIMPARED` int(11) DEFAULT 0,
  `ALBINO` int(11) DEFAULT 0,
  `VISUALLYIMPARED` int(11) DEFAULT 0,
  `PHYSICALLYIMPARED` int(11) DEFAULT 0,
  `HEARINGIMPARED` int(11) DEFAULT 0,
  `reg_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentdisabilities`
--
ALTER TABLE `studentdisabilities`
  ADD PRIMARY KEY (`disabID`),
  ADD KEY `reg_no` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentdisabilities`
--
ALTER TABLE `studentdisabilities`
  MODIFY `disabID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentdisabilities`
--
ALTER TABLE `studentdisabilities`
  ADD CONSTRAINT `studentdisabilities_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
