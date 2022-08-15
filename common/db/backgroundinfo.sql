-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 12:33 PM
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
-- Table structure for table `backgroundinfo`
--

CREATE TABLE `backgroundinfo` (
  `bi_info` int(11) NOT NULL,
  `theory` int(11) DEFAULT 0,
  `prac` int(11) DEFAULT 0,
  `employstatus` varchar(15) NOT NULL,
  `reg_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backgroundinfo`
--
ALTER TABLE `backgroundinfo`
  ADD PRIMARY KEY (`bi_info`),
  ADD KEY `reg_no` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backgroundinfo`
--
ALTER TABLE `backgroundinfo`
  MODIFY `bi_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `backgroundinfo`
--
ALTER TABLE `backgroundinfo`
  ADD CONSTRAINT `backgroundinfo_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
