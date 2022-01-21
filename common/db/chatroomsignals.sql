-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 06:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclassroomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroomsignals`
--

CREATE TABLE `chatroomsignals` (
  `signalID` int(11) NOT NULL,
  `signaler` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `room_type` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `signal_type` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroomsignals`
--
ALTER TABLE `chatroomsignals`
  ADD PRIMARY KEY (`signalID`),
  ADD KEY `signaler` (`signaler`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatroomsignals`
--
ALTER TABLE `chatroomsignals`
  MODIFY `signalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=834;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatroomsignals`
--
ALTER TABLE `chatroomsignals`
  ADD CONSTRAINT `chatroomsignals_ibfk_1` FOREIGN KEY (`signaler`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
