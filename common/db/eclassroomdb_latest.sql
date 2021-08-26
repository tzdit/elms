-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Jul 17, 2021 at 10:10 PM
=======
-- Generation Time: Aug 08, 2021 at 11:08 PM
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `collegeID` int(11) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `userID`, `collegeID`, `full_name`, `email`, `phone`) VALUES
(1, 2, 1, 'Super Admin', 'superadmin@gmail.com', '0768787878'),
(2, 3, 1, 'admin admin', 'admin@udom.ac.tz', '0687454545'),
(3, 4, 1, 'Instructor Instructor', 'instractor@udom.ac.tz', '0687454548');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `annID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
<<<<<<< HEAD
  `content` varchar(255) NOT NULL,
  `ann_date` date NOT NULL,
  `ann_time` time NOT NULL
=======
  `content` varchar(500) NOT NULL,
  `ann_date` date NOT NULL DEFAULT current_timestamp(),
  `ann_time` time NOT NULL DEFAULT current_timestamp(),
  `title` varchar(150) NOT NULL
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `assName` varchar(100) NOT NULL,
  `assType` varchar(15) DEFAULT NULL,
  `assNature` varchar(10) NOT NULL,
  `ass_desc` varchar(1000) DEFAULT NULL,
  `submitMode` varchar(10) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `finishDate` datetime DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `fileName` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assID`, `instructorID`, `course_code`, `assName`, `assType`, `assNature`, `ass_desc`, `submitMode`, `startDate`, `finishDate`, `total_marks`, `fileName`) VALUES
<<<<<<< HEAD
(129, 2, 'CP 111', 'assignment 5', 'groups', 'assignment', 'dghdg', 'unresubmit', '2021-07-15 00:00:00', '2021-07-14 00:00:00', 4, 'cover-merged.pdf'),
(136, 2, 'CP 111', 'chosen groups', 'groups', 'assignment', 'fsdfgsdfg', 'resubmit', '2021-07-15 00:00:00', '2021-07-22 00:00:00', 24, '60e44a755536d.txt'),
(137, 2, 'CP 111', 'chosen groups file', 'groups', 'assignment', 'adfad', 'resubmit', '2021-07-16 00:00:00', '2021-07-22 00:00:00', 225, '60e44b09ae63e'),
=======
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
(138, 2, 'CP 111', 'chosen student types', 'students', 'assignment', 'asdfasdfs', 'unresubmit', '2021-07-15 00:00:00', '2021-07-23 00:00:00', 21, '60e44b8618b9f.txt'),
(139, 2, 'CP 111', 'student chosen file', 'students', 'assignment', 'fgsgsfdgsdf', 'resubmit', '2021-07-23 00:00:00', '2021-07-22 00:00:00', 12, '60e44c37e4b07'),
(144, 2, 'CP 111', 'lass', 'allgroups', 'lab', 'vsgsdf', 'resubmit', '2021-07-16 00:00:00', '2021-07-15 00:00:00', 16, '60e54cf1ba435.txt'),
(145, 2, 'CP 111', 'lab for groups', 'groups', 'lab', 'adfasdsd', 'unresubmit', '2021-07-15 00:00:00', '2021-07-23 00:00:00', 10, '60e54d4b13aee.txt'),
(146, 2, 'CP 111', 'file lab', 'students', 'lab', 'asgfg', 'unresubmit', '2021-07-30 00:00:00', '2021-07-29 00:00:00', 21, '60e54ddc0379e.pdf'),
(152, 2, 'CP 111', 'testing assignment', 'allstudents', 'assignment', 'testing', 'resubmit', '2021-07-22 00:00:00', '2021-07-22 00:00:00', 15, '60e5e79317400.txt'),
<<<<<<< HEAD
(153, 2, 'CP 111', 'group assignment', 'allgroups', 'assignment', 'khalidi', 'unresubmit', '2021-07-15 00:00:00', '2021-07-29 00:00:00', 15, '60e844da2f2d6.txt'),
(156, 2, 'CP 111', 'das', NULL, 'tutorial', 'fADSF', NULL, NULL, NULL, NULL, 'cover-merged.pdf');
=======
(157, 2, 'CP 111', 'group assignment', 'allgroups', 'assignment', 'sdfsdf', 'resubmit', '2021-07-16 00:00:00', '2021-07-22 00:00:00', 15, '60f3e098a0a0a.txt'),
(163, 2, 'CS 212', 'tutorial for you', NULL, 'tutorial', NULL, NULL, NULL, NULL, NULL, '610fd5c87eab5.png');
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `assq`
--

CREATE TABLE `assq` (
  `assq_ID` int(11) NOT NULL,
  `assID` int(11) DEFAULT NULL,
  `qno` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assq`
--

INSERT INTO `assq` (`assq_ID`, `assID`, `qno`, `total_marks`) VALUES
(210, NULL, 1, 5),
(211, NULL, 2, 5),
(212, NULL, 3, 5),
(213, NULL, 4, 5),
(214, NULL, 1, 5),
(215, NULL, 2, 5),
(216, NULL, 3, 5),
(217, NULL, 4, 5),
(218, NULL, 1, 1),
(219, NULL, 2, 1),
(220, NULL, 3, 1),
(221, NULL, 4, 1),
<<<<<<< HEAD
(222, 129, 1, 1),
(223, 129, 2, 1),
(224, 129, 3, 1),
(225, 129, 4, 1),
(245, 136, 1, 6),
(246, 136, 2, 6),
(247, 136, 3, 6),
(248, 136, 4, 6),
(249, 137, 1, 55),
(250, 137, 2, 55),
(251, 137, 3, 5),
(252, 137, 4, 55),
(253, 137, 5, 55),
=======
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
(254, 138, 1, 7),
(255, 138, 2, 7),
(256, 138, 3, 7),
(257, 139, 1, 3),
(258, 139, 2, 3),
(259, 139, 3, 3),
(260, 139, 4, 3),
(275, 144, 1, 4),
(276, 144, 2, 4),
(277, 144, 3, 4),
(278, 144, 4, 4),
(279, 145, 1, 5),
(280, 145, 2, 5),
(281, 146, 1, 7),
(282, 146, 2, 7),
(283, 146, 3, 7),
(297, 152, 1, 5),
(298, 152, 2, 5),
(299, 152, 3, 5),
<<<<<<< HEAD
(300, 153, 1, 5),
(301, 153, 2, 5),
(302, 153, 3, 5);
=======
(312, 157, 1, 5),
(313, 157, 2, 5),
(314, 157, 3, 5);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('INSTRUCTOR', '30', 1620305399),
('INSTRUCTOR', '31', 1620306281),
('INSTRUCTOR', '32', 1620316138),
('INSTRUCTOR', '36', 1620317149),
('INSTRUCTOR', '38', 1620317380),
('INSTRUCTOR', '4', 1620238863),
('INSTRUCTOR & HOD', '51', 1625899607),
('STUDENT', '44', 1620477895),
('STUDENT', '45', 1620477973),
('STUDENT', '46', 1620478760),
('STUDENT', '47', 1620479291),
('STUDENT', '48', 1620479378),
('STUDENT', '49', 1620480151),
('STUDENT', '50', 1620480285),
('SUPER_ADMIN', '2', 1620221794),
('SYS_ADMIN', '3', 1620230542);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('INSTRUCTOR', 1, NULL, NULL, NULL, 1620154096, 1620154096),
('INSTRUCTOR & HOD', 1, NULL, NULL, NULL, NULL, NULL),
('STUDENT', 1, NULL, NULL, NULL, 1620154096, 1620154096),
('SUPER_ADMIN', 1, NULL, NULL, NULL, 1620154096, 1620154096),
('SYS_ADMIN', 1, NULL, NULL, NULL, 1620154096, 1620154096);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `chatText` varchar(500) NOT NULL,
  `chatDate` date NOT NULL,
  `chatTime` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `collegeID` int(11) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `college_abbrev` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`collegeID`, `college_name`, `college_abbrev`) VALUES
(1, 'College of Informatics and Virtual Education', 'CIVE');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_code` varchar(7) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `course_credit` int(11) NOT NULL,
  `course_semester` int(11) NOT NULL,
  `course_duration` int(11) DEFAULT NULL,
  `course_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_name`, `course_credit`, `course_semester`, `course_duration`, `course_status`) VALUES
('CP 111', 'Principle of Programming', 10, 1, 1, 'core'),
('CP 123', 'Introduction High Level Programming in C++', 9, 2, 1, 'CORE'),
('CS 212', 'Data Structure and Algorithms', 10, 1, 2, 'CORE'),
('TN 110', 'Introduction to Telecommunication', 10, 1, 1, 'CORE');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `collegeID` int(11) DEFAULT NULL,
  `department_name` varchar(100) NOT NULL,
  `depart_abbrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `collegeID`, `department_name`, `depart_abbrev`) VALUES
(1, 1, 'Departmwnt of Eletronics and Telecommunication Engineering', 'ETE'),
(2, 1, 'Department of Computer Science and Engineering', 'CSE'),
(3, 1, 'Department of Information System and Technology', 'IST');

-- --------------------------------------------------------

--
-- Table structure for table `ext_assess`
--

CREATE TABLE `ext_assess` (
  `assessID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ext_assess`
--

INSERT INTO `ext_assess` (`assessID`, `instructorID`, `course_code`, `title`, `total_marks`, `date_created`) VALUES
<<<<<<< HEAD
(34, 2, 'CP 111', 'my assessment', 40, '2021-07-16'),
(35, 2, 'CS 212', 'c212 test 2', 20, '2021-07-17');
=======
(63, 2, 'CP 111', 'my assess', 30, '2021-07-26'),
(64, 2, 'CP 111', 'my first test', 30, '2021-07-26'),
(70, 2, 'CS 212', 'my assess', 69, '2021-08-08');
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `fresh_thread`
--

CREATE TABLE `fresh_thread` (
  `freshID` int(11) NOT NULL,
  `threadID` int(11) DEFAULT NULL,
  `threadTitle` varchar(200) NOT NULL,
  `thread_desc` varchar(1000) NOT NULL,
  `thread_date` date NOT NULL,
  `thread_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(11) NOT NULL,
  `groupName` varchar(10) NOT NULL,
  `generation_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `groupName`, `generation_type`) VALUES
(51, 'Group 1', 18),
(52, 'Group 2', 18),
(53, 'Group 1', 19),
(54, 'Group 2', 19),
(57, 'Group 1', 21),
(58, 'Group 2', 21),
(59, 'Group 1', 22),
(60, 'Group 2', 22),
<<<<<<< HEAD
(64, 'Group 1', 28),
(65, 'Group 2', 28);
=======
(72, 'Group 1', 32),
(73, 'Group 2', 32),
(74, 'Group 3', 32),
(75, 'Group 4', 32),
(76, 'Group 5', 32),
(77, 'Group 1', 33),
(78, 'Group 2', 33),
(79, 'Group 3', 33);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `group_assignment`
--

CREATE TABLE `group_assignment` (
  `GA_ID` int(11) NOT NULL,
  `groupID` int(11) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_assignment`
--

INSERT INTO `group_assignment` (`GA_ID`, `groupID`, `assID`) VALUES
(13, 60, NULL),
(14, 59, NULL),
(16, 60, NULL),
(17, 60, NULL),
(18, 60, NULL),
(19, 60, NULL),
<<<<<<< HEAD
(20, 60, 129),
(21, 53, 136),
(22, 54, 136),
(23, 51, 137),
(24, 52, 137),
=======
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
(25, 59, 145),
(26, 60, 145);

-- --------------------------------------------------------

--
-- Table structure for table `group_assignment_submit`
--

CREATE TABLE `group_assignment_submit` (
  `submitID` int(11) NOT NULL,
  `groupID` int(11) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL,
  `fileName` varchar(70) NOT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `submit_date` date NOT NULL DEFAULT current_timestamp(),
  `submit_time` time NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_assignment_submit`
--

INSERT INTO `group_assignment_submit` (`submitID`, `groupID`, `assID`, `fileName`, `score`, `submit_date`, `submit_time`, `comment`) VALUES
<<<<<<< HEAD
(1, 57, 153, 'khalidi.pdf', '12.00', '0000-00-00', '00:00:00', 'heyyyy\n');
=======
(2, 51, 144, '', '15.00', '0000-00-00', '00:00:00', NULL),
(3, 59, 144, '', '15.00', '0000-00-00', '00:00:00', NULL);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `group_generation_assignment`
--

CREATE TABLE `group_generation_assignment` (
  `gga_ID` int(11) NOT NULL,
  `gentypeID` int(11) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_generation_assignment`
--

INSERT INTO `group_generation_assignment` (`gga_ID`, `gentypeID`, `assID`) VALUES
<<<<<<< HEAD
(43, 22, 144),
(45, 21, 153);
=======
(43, 22, 144);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `group_generation_types`
--

CREATE TABLE `group_generation_types` (
  `typeID` int(11) NOT NULL,
  `generation_type` varchar(100) NOT NULL,
  `max_groups_members` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `creator_type` varchar(20) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `reg_no` varchar(30) DEFAULT NULL,
  `created_date` date DEFAULT current_timestamp(),
  `created_time` time DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_generation_types`
--

INSERT INTO `group_generation_types` (`typeID`, `generation_type`, `max_groups_members`, `course_code`, `creator_type`, `instructorID`, `reg_no`, `created_date`, `created_time`) VALUES
(18, 'Generation type 07:02:2021 02:22:23', 0, 'CP 111', 'instructor', 2, NULL, '2021-07-02', '15:22:23'),
(19, 'Generation type 07:02:2021 02:22:30', 0, 'CP 111', 'instructor', 2, NULL, '2021-07-02', '15:22:30'),
(21, 'new group assignment', 0, 'CP 111', 'instructor', 2, NULL, '2021-07-03', '16:13:59'),
(22, 'Generation type 07:05:2021 04:53:33', 3, 'CP 111', 'instructor', 2, NULL, '2021-07-05', '17:53:33'),
<<<<<<< HEAD
(28, 'my last gen', 3, 'CP 111', 'instructor', 2, NULL, '2021-07-07', '12:47:37'),
(29, 'my last student', 2, 'CP 111', 'instructor-student', 2, NULL, '2021-07-07', '12:48:04');
=======
(29, 'my last student', 2, 'CP 111', 'instructor-student', 2, NULL, '2021-07-07', '12:48:04'),
(32, 'new group assignment', 2, 'CP 111', 'instructor', 2, NULL, '2021-08-01', '10:28:03'),
(33, 'groups for assignment 1', 3, 'CP 111', 'instructor', 2, NULL, '2021-08-01', '13:44:54'),
(34, 'groups for assignment 2', 4, 'CP 111', 'instructor-student', 2, NULL, '2021-08-01', '13:46:11');
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructorID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `PP` varchar(10) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructorID`, `userID`, `departmentID`, `full_name`, `gender`, `PP`, `phone`, `email`) VALUES
(2, 36, 1, 'Instructor Instructor', 'M', NULL, '0788676767', 'instructor@gmail.com'),
(4, 38, 1, 'Instructor Instructor', 'M', NULL, '0788676712', 'instructor1@gmail.com'),
(5, 51, 2, 'khalidi hassan', 'M', NULL, '07755888', 'hod@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_course`
--

CREATE TABLE `instructor_course` (
  `IC_ID` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor_course`
--

INSERT INTO `instructor_course` (`IC_ID`, `course_code`, `instructorID`) VALUES
(37, 'CP 111', 2),
(38, 'CP 111', 4),
(39, 'CS 212', 2),
<<<<<<< HEAD
(40, 'TN 110', 5);
=======
(40, 'TN 110', 5),
(41, 'CS 212', 5);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `instructor_notification`
--

CREATE TABLE `instructor_notification` (
  `IN_ID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `notif_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `live_lecture`
--

CREATE TABLE `live_lecture` (
  `lectureID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `lectureDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `lateEntryMaxTime` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `object` varchar(10) NOT NULL,
  `activity` varchar(15) NOT NULL,
  `logdate` date NOT NULL,
  `logtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_ID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `material_type` varchar(15) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `upload_time` time DEFAULT NULL,
  `fileName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_ID`, `instructorID`, `course_code`, `title`, `material_type`, `upload_date`, `upload_time`, `fileName`) VALUES
(17, 2, 'CP 111', 'programming', 'Notes', NULL, NULL, '60e729f376b25.pdf'),
(18, 2, 'CP 111', 'my material', 'Notes', NULL, NULL, '60f12a6e43453.pdf'),
<<<<<<< HEAD
(19, 2, 'CP 111', 'video tutorial', 'Videos', NULL, NULL, '60f12aae3e5b7.mp4');
=======
(19, 2, 'CP 111', 'video tutorial', 'Videos', NULL, NULL, '60f12aae3e5b7.mp4'),
(20, 2, 'CP 111', 'video tutorial', 'Videos', NULL, NULL, '61104224d0647.mp4');
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1620143697),
('m130524_201442_init', 1620143702),
('m140506_102106_rbac_init', 1620153520),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1620153520),
('m180523_151638_rbac_updates_indexes_without_prefix', 1620153521),
('m190124_110200_add_verification_token_column_to_user_table', 1620143702),
('m200409_110543_rbac_update_mssql_trigger', 1620153521);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_ID` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `content` varchar(100) NOT NULL,
  `notif_date` date NOT NULL,
  `notif_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programCode` varchar(10) NOT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `prog_name` varchar(100) NOT NULL,
  `prog_duration` int(11) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programCode`, `departmentID`, `prog_name`, `prog_duration`, `capacity`) VALUES
('CS1', 2, 'Bachelor of Scince in Computer Scince', 1, NULL),
('SE1', 1, 'Bachelor of Science in software Enginering Engineering', 1, NULL),
('SE2', 1, 'Bachelor of Scince in Telecommunication Engineering', 2, NULL),
('TE3', 2, 'Bachelor of Science in Telecommunication Engineering', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_course`
--

CREATE TABLE `program_course` (
  `PC_ID` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `programCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_course`
--

INSERT INTO `program_course` (`PC_ID`, `course_code`, `programCode`) VALUES
<<<<<<< HEAD
(1, 'CP 111', 'CS1'),
(2, 'CP 123', 'CS1');
=======
(6, 'CP 111', 'CS1'),
(4, 'CP 111', 'SE1'),
(7, 'CP 111', 'SE2'),
(5, 'CP 111', 'TE3'),
(8, 'CS 212', 'TE3');
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizID` int(11) NOT NULL,
  `lectureID` int(11) DEFAULT NULL,
  `total_marks` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `quiz_file` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `q_marks`
--

CREATE TABLE `q_marks` (
  `qmarkID` int(11) NOT NULL,
  `submitID` int(11) DEFAULT NULL,
  `assq_ID` int(11) DEFAULT NULL,
  `q_score` decimal(5,2) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `group_submit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `q_marks`
--

INSERT INTO `q_marks` (`qmarkID`, `submitID`, `assq_ID`, `q_score`, `comment`, `group_submit_id`) VALUES
(1, 2, 297, '3.00', NULL, NULL),
(2, 2, 298, '3.00', NULL, NULL),
(3, 2, 299, '3.00', NULL, NULL),
(4, 2, 297, '3.00', NULL, NULL),
(5, 2, 298, '2.00', NULL, NULL),
(6, 2, 299, '2.00', NULL, NULL),
(7, 2, 297, '3.00', NULL, NULL),
(8, 2, 298, '3.00', NULL, NULL),
(9, 2, 299, '3.00', NULL, NULL),
(10, 2, 297, '3.00', NULL, NULL),
(11, 2, 298, '3.00', NULL, NULL),
(12, 2, 299, '3.00', NULL, NULL),
(13, 2, 297, '3.00', NULL, NULL),
(14, 2, 298, '3.00', NULL, NULL),
(15, 2, 299, '3.00', NULL, NULL),
(16, 2, 297, '5.00', NULL, NULL),
(17, 2, 298, '5.00', NULL, NULL),
(18, 2, 299, '2.00', NULL, NULL),
(19, 2, 297, '5.00', NULL, NULL),
(20, 2, 298, '5.00', NULL, NULL),
(21, 2, 299, '5.00', NULL, NULL),
(22, 3, 297, '5.00', NULL, NULL),
(23, 3, 298, '5.00', NULL, NULL),
(24, 3, 299, '5.00', NULL, NULL),
(25, 3, 297, '5.00', NULL, NULL),
(26, 3, 298, '5.00', NULL, NULL),
(27, 3, 299, '5.00', NULL, NULL),
(28, 2, 297, '3.00', NULL, NULL),
(29, 2, 298, '3.00', NULL, NULL),
(30, 2, 299, '3.00', NULL, NULL),
(31, 3, 297, '3.00', NULL, NULL),
(32, 3, 298, '3.00', NULL, NULL),
(33, 3, 299, '3.00', NULL, NULL),
(34, 3, 297, '3.00', NULL, NULL),
(35, 3, 298, '3.00', NULL, NULL),
(36, 3, 299, '3.00', NULL, NULL),
(37, 2, 297, '1.00', NULL, NULL),
(38, 2, 298, '1.00', NULL, NULL),
(39, 2, 299, '1.00', NULL, NULL),
(40, 3, 297, '1.00', NULL, NULL),
(41, 3, 298, '1.00', NULL, NULL),
(42, 3, 299, '1.00', NULL, NULL),
(43, 3, 297, '1.00', NULL, NULL),
(44, 3, 298, '1.00', NULL, NULL),
(45, 3, 299, '1.00', NULL, NULL),
(46, 2, 297, '1.00', NULL, NULL),
(47, 2, 298, '1.00', NULL, NULL),
(48, 2, 299, '1.00', NULL, NULL),
(49, 2, 297, '2.00', NULL, NULL),
(50, 2, 298, '2.00', NULL, NULL),
(51, 2, 299, '2.00', NULL, NULL),
(52, 2, 297, '1.00', NULL, NULL),
(53, 2, 298, '1.00', NULL, NULL),
(54, 2, 299, '1.00', NULL, NULL),
(55, 2, 297, '2.00', NULL, NULL),
(56, 2, 298, '2.00', NULL, NULL),
(57, 2, 299, '2.00', NULL, NULL),
(58, 3, 297, '2.00', NULL, NULL),
(59, 3, 298, '2.00', NULL, NULL),
(60, 3, 299, '2.00', NULL, NULL),
(61, 3, 297, '2.00', NULL, NULL),
(62, 3, 298, '2.00', NULL, NULL),
(63, 3, 299, '2.00', NULL, NULL),
(64, 2, 297, '2.00', NULL, NULL),
(65, 2, 298, '2.00', NULL, NULL),
(66, 2, 299, '2.00', NULL, NULL),
(67, 3, 297, '2.00', NULL, NULL),
(68, 3, 298, '2.00', NULL, NULL),
(69, 3, 299, '2.00', NULL, NULL),
(70, 3, 297, '2.00', NULL, NULL),
(71, 3, 298, '2.00', NULL, NULL),
(72, 3, 299, '2.00', NULL, NULL),
(73, 2, 297, '1.00', NULL, NULL),
(74, 2, 298, '1.00', NULL, NULL),
(75, 2, 299, '1.00', NULL, NULL),
(76, 2, 297, '3.00', NULL, NULL),
(77, 2, 298, '3.00', NULL, NULL),
(78, 2, 299, '3.00', NULL, NULL),
(79, 3, 297, '3.00', NULL, NULL),
(80, 3, 298, '3.00', NULL, NULL),
(81, 3, 299, '3.00', NULL, NULL),
(82, 3, 297, '3.00', NULL, NULL),
(83, 3, 298, '3.00', NULL, NULL),
(84, 3, 299, '3.00', NULL, NULL),
(85, 2, 297, '3.00', NULL, NULL),
(86, 2, 298, '3.00', NULL, NULL),
(87, 2, 299, '3.00', NULL, NULL),
(88, 2, 297, '1.00', NULL, NULL),
(89, 2, 298, '1.00', NULL, NULL),
(90, 2, 299, '1.00', NULL, NULL),
(91, 2, 297, '2.00', NULL, NULL),
(92, 2, 298, '2.00', NULL, NULL),
(93, 2, 299, '2.00', NULL, NULL),
(94, 2, 297, '1.00', NULL, NULL),
(95, 2, 298, '1.00', NULL, NULL),
(96, 2, 299, '1.00', NULL, NULL),
(97, 2, 297, '2.00', NULL, NULL),
(98, 2, 298, '2.00', NULL, NULL),
(99, 2, 299, '2.00', NULL, NULL),
(100, 2, 297, '3.00', NULL, NULL),
(101, 2, 298, '3.00', NULL, NULL),
(102, 2, 299, '2.00', NULL, NULL),
(103, 3, 297, '3.00', NULL, NULL),
(104, 3, 298, '3.00', NULL, NULL),
(105, 3, 299, '2.00', NULL, NULL),
(106, 3, 297, '3.00', NULL, NULL),
(107, 3, 298, '3.00', NULL, NULL),
(108, 3, 299, '2.00', NULL, NULL),
(109, 2, 297, '3.00', NULL, NULL),
(110, 2, 298, '3.00', NULL, NULL),
(111, 2, 299, '3.00', NULL, NULL),
(112, 3, 297, '3.00', NULL, NULL),
(113, 3, 298, '3.00', NULL, NULL),
(114, 3, 299, '3.00', NULL, NULL),
(115, 3, 297, '2.00', NULL, NULL),
(116, 3, 298, '2.00', NULL, NULL),
(117, 3, 299, '2.00', NULL, NULL),
(118, 2, 297, '2.00', NULL, NULL),
(119, 2, 298, '2.00', NULL, NULL),
(120, 2, 299, '2.00', NULL, NULL),
(121, 3, 297, '2.00', NULL, NULL),
(122, 3, 298, '2.00', NULL, NULL),
(123, 3, 299, '2.00', NULL, NULL),
(124, 3, 297, '2.00', NULL, NULL),
(125, 3, 298, '2.00', NULL, NULL),
(126, 3, 299, '2.00', NULL, NULL),
(127, 2, 297, '4.00', NULL, NULL),
(128, 2, 298, '4.00', NULL, NULL),
(129, 2, 299, '4.00', NULL, NULL),
(130, 3, 297, '4.00', NULL, NULL),
(131, 3, 298, '4.00', NULL, NULL),
(132, 3, 299, '4.00', NULL, NULL),
(133, 3, 297, '4.00', NULL, NULL),
(134, 3, 298, '4.00', NULL, NULL),
(135, 3, 299, '4.00', NULL, NULL),
(136, 2, 297, '4.00', NULL, NULL),
(137, 2, 298, '4.00', NULL, NULL),
(138, 2, 299, '4.00', NULL, NULL),
(139, 2, 297, '2.00', NULL, NULL),
(140, 2, 298, '2.00', NULL, NULL),
(141, 2, 299, '2.00', NULL, NULL),
(142, 3, 297, '2.00', NULL, NULL),
(143, 3, 298, '2.00', NULL, NULL),
(144, 3, 299, '2.00', NULL, NULL),
(145, 3, 297, '2.00', NULL, NULL),
(146, 3, 298, '2.00', NULL, NULL),
(147, 3, 299, '2.00', NULL, NULL),
(148, 2, 297, '2.00', NULL, NULL),
(149, 2, 298, '2.00', NULL, NULL),
(150, 2, 299, '2.00', NULL, NULL),
(151, 3, 297, '2.00', NULL, NULL),
(152, 3, 298, '2.00', NULL, NULL),
(153, 3, 299, '2.00', NULL, NULL),
(154, 3, 297, '2.00', NULL, NULL),
(155, 3, 298, '2.00', NULL, NULL),
(156, 3, 299, '2.00', NULL, NULL),
(157, 2, 297, '3.00', NULL, NULL),
(158, 2, 298, '3.00', NULL, NULL),
(159, 2, 299, '3.00', NULL, NULL),
(160, 3, 297, '3.00', NULL, NULL),
(161, 3, 298, '3.00', NULL, NULL),
(162, 3, 299, '3.00', NULL, NULL),
(163, 3, 297, '3.00', NULL, NULL),
(164, 3, 298, '3.00', NULL, NULL),
(165, 3, 299, '3.00', NULL, NULL),
(166, 2, 297, '2.00', NULL, NULL),
(167, 2, 298, '2.00', NULL, NULL),
(168, 2, 299, '2.00', NULL, NULL),
(169, 2, 297, '3.00', NULL, NULL),
(170, 2, 298, '3.00', NULL, NULL),
(171, 2, 299, '3.00', NULL, NULL),
(172, 3, 297, '3.00', NULL, NULL),
(173, 3, 298, '3.00', NULL, NULL),
(174, 3, 299, '3.00', NULL, NULL),
(175, 3, 297, '3.00', NULL, NULL),
(176, 3, 298, '3.00', NULL, NULL),
(177, 3, 299, '3.00', NULL, NULL),
(178, 2, 297, '3.00', NULL, NULL),
(179, 2, 298, '3.00', NULL, NULL),
(180, 2, 299, '3.00', NULL, NULL),
(181, 2, 297, '3.00', NULL, NULL),
(182, 2, 298, '3.00', NULL, NULL),
(183, 2, 299, '3.00', NULL, NULL),
(184, 2, 297, '3.00', NULL, NULL),
(185, 2, 298, '3.00', NULL, NULL),
(186, 2, 299, '3.00', NULL, NULL),
(187, 3, 297, '3.00', NULL, NULL),
(188, 3, 298, '3.00', NULL, NULL),
(189, 3, 299, '3.00', NULL, NULL),
(190, 3, 297, '3.00', NULL, NULL),
(191, 3, 298, '3.00', NULL, NULL),
(192, 3, 299, '3.00', NULL, NULL),
(193, 3, 297, '3.00', NULL, NULL),
(194, 3, 298, '3.00', NULL, NULL),
(195, 3, 299, '3.00', NULL, NULL),
(196, 2, 297, '3.00', NULL, NULL),
(197, 2, 299, '3.00', NULL, NULL),
(198, 2, 297, '3.00', NULL, NULL),
(199, 2, 299, '3.00', NULL, NULL),
(200, 2, 297, '3.00', NULL, NULL),
(201, 2, 298, '4.00', NULL, NULL),
(202, 2, 299, '3.00', NULL, NULL),
(203, 3, 297, '3.00', NULL, NULL),
(204, 3, 299, '3.00', NULL, NULL),
(205, 3, 297, '3.00', NULL, NULL),
(206, 3, 298, '4.00', NULL, NULL),
(207, 3, 299, '3.00', NULL, NULL),
(208, 3, 297, '3.00', NULL, NULL),
(209, 3, 298, '4.00', NULL, NULL),
(210, 3, 299, '3.00', NULL, NULL),
(211, 2, 297, '3.00', NULL, NULL),
(212, 2, 298, '3.00', NULL, NULL),
(213, 2, 299, '3.00', NULL, NULL),
(214, 3, 297, '3.00', NULL, NULL),
(215, 3, 298, '3.00', NULL, NULL),
(216, 3, 299, '3.00', NULL, NULL),
(217, 3, 297, '3.00', NULL, NULL),
(218, 3, 298, '3.00', NULL, NULL),
(219, 3, 299, '3.00', NULL, NULL),
(220, 2, 297, '1.00', NULL, NULL),
(221, 2, 298, '1.00', NULL, NULL),
(222, 2, 299, '1.00', NULL, NULL),
(223, 2, 297, '2.00', NULL, NULL),
(224, 2, 298, '2.00', NULL, NULL),
(225, 2, 299, '2.00', NULL, NULL),
(226, 3, 297, '4.00', NULL, NULL),
(227, 3, 298, '4.00', NULL, NULL),
(228, 3, 299, '4.00', NULL, NULL),
(229, 2, 297, '3.00', NULL, NULL),
(230, 2, 298, '3.00', NULL, NULL),
(231, 2, 299, '3.00', NULL, NULL),
(232, 3, 297, '4.00', NULL, NULL),
(233, 3, 298, '4.00', NULL, NULL),
(234, 3, 299, '4.00', NULL, NULL),
(235, 2, 297, '5.00', NULL, NULL),
(236, 2, 298, '5.00', NULL, NULL),
(237, 2, 297, '3.00', NULL, NULL),
(238, 2, 298, '3.00', NULL, NULL),
(239, 2, 297, '4.00', NULL, NULL),
(240, 2, 298, '4.00', NULL, NULL),
(241, 2, 299, '4.00', NULL, NULL),
(242, 2, 297, '1.00', NULL, NULL),
(243, 2, 298, '1.00', NULL, NULL),
(244, 2, 299, '1.00', NULL, NULL),
<<<<<<< HEAD
(245, NULL, 300, '4.00', NULL, 1),
(246, NULL, 301, '4.00', NULL, 1),
(247, NULL, 302, '4.00', NULL, 1);
=======
(263, 2, 297, '5.00', NULL, NULL),
(264, 2, 298, '5.00', NULL, NULL),
(265, 2, 299, '5.00', NULL, NULL),
(266, 2, 297, '2.00', NULL, NULL),
(267, 2, 298, '2.00', NULL, NULL),
(268, 2, 299, '2.00', NULL, NULL),
(269, 2, 297, '4.00', NULL, NULL),
(270, 2, 298, '3.00', NULL, NULL),
(271, 2, 299, '3.00', NULL, NULL),
(272, 4, 254, '4.00', NULL, NULL),
(273, 4, 255, '3.00', NULL, NULL),
(274, 4, 256, '2.00', NULL, NULL),
(275, 4, 254, '3.00', NULL, NULL),
(276, 4, 255, '3.00', NULL, NULL),
(277, 4, 256, '3.00', NULL, NULL),
(278, 4, 254, '5.00', NULL, NULL),
(279, 4, 255, '2.00', NULL, NULL),
(280, 4, 256, '2.00', NULL, NULL),
(281, 4, 254, '2.00', NULL, NULL),
(282, 4, 255, '2.00', NULL, NULL),
(283, 4, 256, '2.00', NULL, NULL);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `rep_thread`
--

CREATE TABLE `rep_thread` (
  `repID` int(11) NOT NULL,
  `threadID` int(11) DEFAULT NULL,
  `parent_thread` int(11) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `repdate` date NOT NULL,
  `reptime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` varchar(20) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `programCode` varchar(10) DEFAULT NULL,
  `fname` varchar(10) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  `f4_index_no` varchar(20) DEFAULT NULL,
  `YOS` int(11) NOT NULL,
  `DOR` date NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `userID`, `programCode`, `fname`, `mname`, `lname`, `email`, `gender`, `f4_index_no`, `YOS`, `DOR`, `phone`, `status`) VALUES
<<<<<<< HEAD
=======
('T/UDOM/2019/00900', 3, 'CS1', 'winner', '', 'OG', NULL, 'M', NULL, 2, '0000-00-00', NULL, ''),
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
('T/UDOM/2020/00001', 45, 'CS1', 'STUDENT', 'STUDENT', 'STUDENT', 'student@gmail.com', 'M', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00002', 46, 'SE1', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail2.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00003', 47, 'TE3', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail3.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00004', 48, 'TE3', 'Mwambashi', 'mwambashi', 'Shabani', 'student@gmail4.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00005', 49, 'TE3', 'sutdent20', 'mwambashi', 'Shabani', 'student@gmail5.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00006', 50, 'TE3', 'Zuwena', 'Rashidi', 'Mwendachik', 'student@gmail56.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignment`
--

CREATE TABLE `student_assignment` (
  `std_assID` int(11) NOT NULL,
  `assID` int(11) DEFAULT NULL,
  `reg_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_assignment`
--

INSERT INTO `student_assignment` (`std_assID`, `assID`, `reg_no`) VALUES
(9, 138, 'T/UDOM/2020/00001'),
(10, 138, 'T/UDOM/2020/00002'),
(11, 139, 'T/UDOM/2020/00003'),
(12, 139, 'T/UDOM/2020/00004'),
(13, 146, 'T/UDOM/2020/00001'),
(14, 146, 'T/UDOM/2020/00002'),
(15, 146, 'T/UDOM/2020/00003');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `SC_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

<<<<<<< HEAD
--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`SC_ID`, `reg_no`, `course_code`) VALUES
(1, 'T/UDOM/2020/00001', 'CP 111'),
(2, 'T/UDOM/2020/00002', 'CP 111'),
(3, 'T/UDOM/2020/00003', 'CP 111'),
(4, 'T/UDOM/2020/00004', 'CP 111');

=======
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
-- --------------------------------------------------------

--
-- Table structure for table `student_ext_assess`
--

CREATE TABLE `student_ext_assess` (
  `student_assess_id` int(11) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `assessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_ext_assess`
--

INSERT INTO `student_ext_assess` (`student_assess_id`, `reg_no`, `score`, `assessID`) VALUES
<<<<<<< HEAD
(27, 'T/UDOM/2020/00001', '6.00', 35),
(28, 'T/UDOM/2020/00002', '6.00', 35);
=======
(48, 'T/UDOM/2020/00001', '12.00', 64),
(49, 'T/UDOM/2020/00002', '12.00', 64),
(51, 'T/UDOM/2020/00001', '10.00', 63),
(55, 'T/UDOM/2020/00005', '10.00', 70),
(58, 'T/UDOM/2020/00003', '4.00', 70),
(59, 'T/UDOM/2020/00006', '7.00', 70);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `SG_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_group`
--

INSERT INTO `student_group` (`SG_ID`, `reg_no`, `groupID`) VALUES
(101, 'T/UDOM/2020/00004', 51),
(102, 'T/UDOM/2020/00003', 51),
(103, 'T/UDOM/2020/00002', 52),
(104, 'T/UDOM/2020/00001', 52),
(105, 'T/UDOM/2020/00004', 53),
(106, 'T/UDOM/2020/00001', 53),
(107, 'T/UDOM/2020/00003', 54),
(108, 'T/UDOM/2020/00002', 54),
(113, 'T/UDOM/2020/00002', 57),
(114, 'T/UDOM/2020/00001', 57),
(115, 'T/UDOM/2020/00004', 58),
(116, 'T/UDOM/2020/00003', 58),
(117, 'T/UDOM/2020/00004', 59),
(118, 'T/UDOM/2020/00003', 59),
(119, 'T/UDOM/2020/00001', 59),
(120, 'T/UDOM/2020/00002', 60),
<<<<<<< HEAD
(129, 'T/UDOM/2020/00002', 64),
(130, 'T/UDOM/2020/00003', 64),
(131, 'T/UDOM/2020/00001', 64),
(132, 'T/UDOM/2020/00004', 65);
=======
(151, 'T/UDOM/2020/00002', 72),
(152, 'T/UDOM/2020/00003', 72),
(153, 'T/UDOM/2020/00001', 73),
(154, 'T/UDOM/2020/00004', 73),
(155, 'T/UDOM/2020/00003', 74),
(156, 'T/UDOM/2020/00004', 74),
(157, 'T/UDOM/2020/00001', 75),
(158, 'T/UDOM/2020/00006', 75),
(159, 'T/UDOM/2020/00005', 76),
(160, 'T/UDOM/2020/00005', 77),
(161, 'T/UDOM/2020/00003', 77),
(162, 'T/UDOM/2020/00003', 77),
(163, 'T/UDOM/2020/00004', 78),
(164, 'T/UDOM/2020/00001', 78),
(165, 'T/UDOM/2020/00001', 78),
(166, 'T/UDOM/2020/00004', 79),
(167, 'T/UDOM/2020/00002', 79),
(168, 'T/UDOM/2020/00006', 79);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `student_lecture`
--

CREATE TABLE `student_lecture` (
  `SL_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `lectureID` int(11) DEFAULT NULL,
  `participationStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_notification`
--

CREATE TABLE `student_notification` (
  `SN_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `notif_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz`
--

CREATE TABLE `student_quiz` (
  `SQ_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `quizID` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE `submit` (
  `submitID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL,
  `fileName` varchar(20) NOT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `submit_date` date NOT NULL DEFAULT current_timestamp(),
  `submit_time` time NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submit`
--

INSERT INTO `submit` (`submitID`, `reg_no`, `assID`, `fileName`, `score`, `submit_date`, `submit_time`, `comment`) VALUES
(2, 'T/UDOM/2020/00001', 152, 'nafasi.pdf', '3.00', '2021-07-07', '19:44:23', 'failed\n'),
<<<<<<< HEAD
(3, 'T/UDOM/2020/00001', 152, 'head.pdf', '12.00', '2021-07-07', '19:47:04', 'heeeeeey\n');
=======
(3, 'T/UDOM/2020/00002', 152, 'head.pdf', '12.00', '2021-07-07', '19:47:04', 'heeeeeey\n'),
(4, 'T/UDOM/2020/00001', 138, 'db_final_ER.mp4', '3.50', '0000-00-00', '00:00:00', NULL),
(5, 'T/UDOM/2020/00001', 145, 'db_final_ER.mp4', '15.00', '0000-00-00', '00:00:00', NULL),
(6, 'T/UDOM/2020/00001', 146, '', '17.00', '0000-00-00', '00:00:00', NULL);
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `threadID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `starter_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(2, 'superadmin@gmail.com', 'W51ctghW1xCld_ncVyWXRdqTBLB-3_-A', '$2y$13$naU.v.6YTv6jFxKhrCAp/O6jlekxVbXhHvH5/hi41ZCpolj9TabAK', NULL, 10, 1620221794, 1620221794, 'oXTI0OmEx-RzrMtQexlsxa1zncx2UCac_1620221794'),
(3, 'admin@udom.ac.tz', 'eLoS5U27FLCaR0ssRMkxwGbyPN2U3lXO', '$2y$13$mGxE59a0raIthNEoTssSWufM5jfNn4JAjkOAtCHgNEYx5HaL0yOdy', NULL, 10, 1620230542, 1620230542, 'FhwtL5PYc3ai1DYLYkcJivGIMjyL-_EX_1620230542'),
(4, 'instractor@udom.ac.tz', 'N8kVKIxKBFSz1gle6P8JomCIgOePdtYN', '$2y$13$YWeKAbugwCw7QQUOVbXKwOMjnf9Gjl3wwtef7qdO5.1yjl2uRS/1m', NULL, 10, 1620238863, 1620238863, '3kQNyR4h1Ultwuf32sUAFX9aXSLil1Tj_1620238863'),
(36, 'instructor@gmail.com', 'HXJgwXFWHOJfl50LMuqxeojOcAtC2jah', '$2y$13$tumI.0Eze7ZpW006XDc1ouiv2IdIVb4zlrwg5fELPNlGdR1tHUJuW', NULL, 10, 1620317149, 1620317149, '_hPkM8R7066cSxOOmN0BThNBXmVHemO7_1620317149'),
(38, 'instructor1@gmail.com', 'LQdO46HMTAeZuFBc7VCRnYlJnpURlUt1', '$2y$13$cSx3Z0IMdBRGwqCuhg0lmenVoggrW9K0D960b84RhUgVi3.H9oaO.', NULL, 10, 1620317380, 1620317380, 'rp93GLyD5Nxq1JPc8GoXjVkFTnuvb1Sn_1620317380'),
(45, 'T/UDOM/2020/00001', 'mKKy8h-_rM7ldxn8V7uZ9ymXXtEv4mXW', '$2y$13$x8q0ENzRr2Vs2IQlgeXtjObavA7SAjbU0LrMro0i4.YOYZvCcPAhi', NULL, 10, 1620477973, 1620477973, 'QIkqZhdfixFJP5dR8-oOhUrJ_CqEOMix_1620477973'),
(46, 'T/UDOM/2020/00002', 'BLeSYvp7xmFaztFiCwuT2gsPce-hQvoz', '$2y$13$.EtDdHdudB7i2tv/N8auIeT03Ul.qonRAAJNjmJNQdob5H4HvRzrq', NULL, 10, 1620478760, 1620478760, 'sRGQTOjV-IqflqfaKPlSfmDGY1dejCDx_1620478760'),
(47, 'T/UDOM/2020/00003', '7YKPavAGjFiazuNaDH2ExZvJeVYz8CMT', '$2y$13$s6nXxl4WQTv85qFUzwxUuOzXy1n41newEoY/XRsKfcQBRdJiFMSbO', NULL, 10, 1620479291, 1620479291, 'b28wb_mxjxxUDKMgj-LwwraUaqt04CST_1620479291'),
(48, 'T/UDOM/2020/00004', '67FEyg1E-IEGlBJkCJNF__ZL9CQ3mj-Y', '$2y$13$Jp8mQaBe/2.I7BnpPFZrueB1GRrV7CrHp9fcnX7vJFpxFGCHMYRFS', NULL, 10, 1620479378, 1620479378, 'mkBFhUVlS04YoX6T82YgZPKaEPkrN92-_1620479378'),
(49, 'T/UDOM/2020/00005', 'zR9kdjBWTKsmdZ3pAs4kG9rJZYyVIMmV', '$2y$13$Z4t8uHoXDQ87c8vmoOvYOu.f9TWZPddpFUM/gBazdBXsJS8Y3h/w2', NULL, 10, 1620480151, 1620480151, 'KE2YNyNG8Womx90OLdDyGCVkjBLDsHmT_1620480151'),
(50, 'T/UDOM/2020/00006', 'U9qu2XUtMVOITbWgYOZhBH4L3OAPsd6y', '$2y$13$AH0OppbJcFbSy/23rXffROh.pNVw8CVxYKjUuyIAoNbai9ZGTMmOG', NULL, 10, 1620480285, 1620480285, 'phAwORTa2r6VWTw6k-Rd0FLyDYGXC_Xd_1620480285'),
(51, 'hod@gmail.com', 'B8WVLnnt-gMF9mF36_gi6eF1fqWwNHfM', '$2y$13$52aE79R/10CNeJOQpqn9cOMJ2KCrvh6xrQ3zDEzLUtFwFq5zlwMgO', NULL, 10, 1625899607, 1625899607, 'hOHSG7SNSEd2AiVDwzUesbCIRgc0N1a4_1625899607');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `collegekey2` (`collegeID`),
  ADD KEY `userlogkey2` (`userID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`annID`),
  ADD KEY `instructorkey6` (`instructorID`),
  ADD KEY `coursekey5` (`course_code`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assID`),
  ADD KEY `instructorkey4` (`instructorID`),
  ADD KEY `coursekey3` (`course_code`);

--
-- Indexes for table `assq`
--
ALTER TABLE `assq`
  ADD PRIMARY KEY (`assq_ID`),
  ADD KEY `asskey2` (`assID`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatID`),
  ADD KEY `instrchatkey` (`instructorID`),
  ADD KEY `chatstudkey` (`reg_no`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`collegeID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`),
  ADD KEY `colkey` (`collegeID`);

--
-- Indexes for table `ext_assess`
--
ALTER TABLE `ext_assess`
  ADD PRIMARY KEY (`assessID`),
  ADD UNIQUE KEY `assess_unique_keys` (`instructorID`,`total_marks`,`course_code`,`title`),
  ADD KEY `instr` (`instructorID`),
  ADD KEY `coursekey8` (`course_code`);

--
-- Indexes for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  ADD PRIMARY KEY (`freshID`),
  ADD KEY `threadkey3` (`threadID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `generation_type` (`generation_type`);

--
-- Indexes for table `group_assignment`
--
ALTER TABLE `group_assignment`
  ADD PRIMARY KEY (`GA_ID`),
  ADD KEY `gasskey` (`assID`),
  ADD KEY `gkey` (`groupID`);

--
-- Indexes for table `group_assignment_submit`
--
ALTER TABLE `group_assignment_submit`
  ADD PRIMARY KEY (`submitID`),
  ADD KEY `groupass22` (`groupID`),
  ADD KEY `grpasskey` (`assID`);

--
-- Indexes for table `group_generation_assignment`
--
ALTER TABLE `group_generation_assignment`
  ADD PRIMARY KEY (`gga_ID`),
  ADD KEY `gentypekey` (`gentypeID`),
  ADD KEY `assID` (`assID`);

--
-- Indexes for table `group_generation_types`
--
ALTER TABLE `group_generation_types`
  ADD PRIMARY KEY (`typeID`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `reg_no` (`reg_no`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructorID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `depkey1` (`departmentID`),
  ADD KEY `userkey1` (`userID`);

--
-- Indexes for table `instructor_course`
--
ALTER TABLE `instructor_course`
  ADD PRIMARY KEY (`IC_ID`),
  ADD KEY `instrc` (`instructorID`),
  ADD KEY `cozk` (`course_code`);

--
-- Indexes for table `instructor_notification`
--
ALTER TABLE `instructor_notification`
  ADD PRIMARY KEY (`IN_ID`),
  ADD KEY `notifinstr` (`notif_ID`),
  ADD KEY `instrnotif` (`instructorID`);

--
-- Indexes for table `live_lecture`
--
ALTER TABLE `live_lecture`
  ADD PRIMARY KEY (`lectureID`),
  ADD KEY `instructorkey7` (`instructorID`),
  ADD KEY `coursekey7` (`course_code`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `userlogkey` (`userID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_ID`),
  ADD KEY `instructorkey5` (`instructorID`),
  ADD KEY `coursekey4` (`course_code`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_ID`),
  ADD KEY `coursekey6` (`course_code`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programCode`),
  ADD KEY `depkey2` (`departmentID`);

--
-- Indexes for table `program_course`
--
ALTER TABLE `program_course`
  ADD PRIMARY KEY (`PC_ID`),
<<<<<<< HEAD
=======
  ADD UNIQUE KEY `programCode` (`programCode`,`course_code`),
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
  ADD KEY `pcd` (`programCode`),
  ADD KEY `cozk2` (`course_code`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizID`),
  ADD KEY `lecturekey1` (`lectureID`);

--
-- Indexes for table `q_marks`
--
ALTER TABLE `q_marks`
  ADD PRIMARY KEY (`qmarkID`),
  ADD KEY `submitkey` (`submitID`),
  ADD KEY `qkey` (`assq_ID`),
  ADD KEY `group_submit_id` (`group_submit_id`);

--
-- Indexes for table `rep_thread`
--
ALTER TABLE `rep_thread`
  ADD PRIMARY KEY (`repID`),
  ADD KEY `threadkey1` (`threadID`),
  ADD KEY `threadkey2` (`parent_thread`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `programkey1` (`programCode`),
  ADD KEY `userkey2` (`userID`);

--
-- Indexes for table `student_assignment`
--
ALTER TABLE `student_assignment`
  ADD PRIMARY KEY (`std_assID`),
  ADD KEY `stdasskey` (`assID`),
  ADD KEY `reg_no` (`reg_no`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`SC_ID`),
<<<<<<< HEAD
=======
  ADD UNIQUE KEY `reg_no` (`reg_no`,`course_code`),
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
  ADD KEY `cozk3` (`course_code`),
  ADD KEY `studckey2` (`reg_no`);

--
-- Indexes for table `student_ext_assess`
--
ALTER TABLE `student_ext_assess`
  ADD PRIMARY KEY (`student_assess_id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`,`assessID`),
  ADD KEY `assesskey` (`assessID`);

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`SG_ID`),
  ADD KEY `gkey2` (`groupID`),
  ADD KEY `gstudkey` (`reg_no`);

--
-- Indexes for table `student_lecture`
--
ALTER TABLE `student_lecture`
  ADD PRIMARY KEY (`SL_ID`),
  ADD KEY `lecstudkey` (`reg_no`),
  ADD KEY `lecturekey2` (`lectureID`);

--
-- Indexes for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD PRIMARY KEY (`SN_ID`),
  ADD KEY `notstudkey` (`reg_no`),
  ADD KEY `notifkey` (`notif_ID`);

--
-- Indexes for table `student_quiz`
--
ALTER TABLE `student_quiz`
  ADD PRIMARY KEY (`SQ_ID`),
  ADD KEY `quizstudkey` (`reg_no`),
  ADD KEY `quizkey` (`quizID`);

--
-- Indexes for table `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`submitID`),
  ADD KEY `studk22` (`reg_no`),
  ADD KEY `asskey` (`assID`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`threadID`),
  ADD KEY `studkey2` (`reg_no`),
  ADD KEY `instructorkey3` (`instructorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
<<<<<<< HEAD
  MODIFY `annID` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `annID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
<<<<<<< HEAD
  MODIFY `assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
=======
  MODIFY `assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `assq`
--
ALTER TABLE `assq`
<<<<<<< HEAD
  MODIFY `assq_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
=======
  MODIFY `assq_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `collegeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ext_assess`
--
ALTER TABLE `ext_assess`
<<<<<<< HEAD
  MODIFY `assessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
=======
  MODIFY `assessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  MODIFY `freshID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
<<<<<<< HEAD
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
=======
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `group_assignment`
--
ALTER TABLE `group_assignment`
  MODIFY `GA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `group_assignment_submit`
--
ALTER TABLE `group_assignment_submit`
<<<<<<< HEAD
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `group_generation_assignment`
--
ALTER TABLE `group_generation_assignment`
<<<<<<< HEAD
  MODIFY `gga_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
=======
  MODIFY `gga_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `group_generation_types`
--
ALTER TABLE `group_generation_types`
<<<<<<< HEAD
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
=======
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructor_course`
--
ALTER TABLE `instructor_course`
<<<<<<< HEAD
  MODIFY `IC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
=======
  MODIFY `IC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `instructor_notification`
--
ALTER TABLE `instructor_notification`
  MODIFY `IN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_lecture`
--
ALTER TABLE `live_lecture`
  MODIFY `lectureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
<<<<<<< HEAD
  MODIFY `material_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
=======
  MODIFY `material_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_course`
--
ALTER TABLE `program_course`
<<<<<<< HEAD
  MODIFY `PC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `PC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `q_marks`
--
ALTER TABLE `q_marks`
<<<<<<< HEAD
  MODIFY `qmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
=======
  MODIFY `qmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `rep_thread`
--
ALTER TABLE `rep_thread`
  MODIFY `repID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_assignment`
--
ALTER TABLE `student_assignment`
  MODIFY `std_assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
<<<<<<< HEAD
  MODIFY `SC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
  MODIFY `SC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `student_ext_assess`
--
ALTER TABLE `student_ext_assess`
<<<<<<< HEAD
  MODIFY `student_assess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
=======
  MODIFY `student_assess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
<<<<<<< HEAD
  MODIFY `SG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
=======
  MODIFY `SG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `student_lecture`
--
ALTER TABLE `student_lecture`
  MODIFY `SL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_notification`
--
ALTER TABLE `student_notification`
  MODIFY `SN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_quiz`
--
ALTER TABLE `student_quiz`
  MODIFY `SQ_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submit`
--
ALTER TABLE `submit`
<<<<<<< HEAD
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `threadID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `collegekey2` FOREIGN KEY (`collegeID`) REFERENCES `college` (`collegeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userlogkey2` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `coursekey5` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey6` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `coursekey3` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey4` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `assq`
--
ALTER TABLE `assq`
  ADD CONSTRAINT `asskey2` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chatstudkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON UPDATE CASCADE,
  ADD CONSTRAINT `instrchatkey` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `colkey` FOREIGN KEY (`collegeID`) REFERENCES `college` (`collegeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ext_assess`
--
ALTER TABLE `ext_assess`
  ADD CONSTRAINT `coursekey8` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instr` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  ADD CONSTRAINT `threadkey3` FOREIGN KEY (`threadID`) REFERENCES `thread` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`generation_type`) REFERENCES `group_generation_types` (`typeID`) ON DELETE CASCADE;

--
-- Constraints for table `group_assignment`
--
ALTER TABLE `group_assignment`
  ADD CONSTRAINT `gasskey` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gkey` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_assignment_submit`
--
ALTER TABLE `group_assignment_submit`
  ADD CONSTRAINT `groupass22` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grpasskey` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_generation_assignment`
--
ALTER TABLE `group_generation_assignment`
  ADD CONSTRAINT `gentypekey` FOREIGN KEY (`gentypeID`) REFERENCES `group_generation_types` (`typeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_generation_assignment_ibfk_1` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE;

--
-- Constraints for table `group_generation_types`
--
ALTER TABLE `group_generation_types`
  ADD CONSTRAINT `group_generation_types_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `group_generation_types_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `group_generation_types_ibfk_3` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`),
  ADD CONSTRAINT `group_generation_types_ibfk_4` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `depkey1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userkey1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `instructor_course`
--
ALTER TABLE `instructor_course`
  ADD CONSTRAINT `cozk` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instrc` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_notification`
--
ALTER TABLE `instructor_notification`
  ADD CONSTRAINT `instrnotif` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifinstr` FOREIGN KEY (`notif_ID`) REFERENCES `notification` (`notif_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live_lecture`
--
ALTER TABLE `live_lecture`
  ADD CONSTRAINT `coursekey7` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey7` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `userlogkey` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `coursekey4` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey5` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `coursekey6` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `depkey2` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_course`
--
ALTER TABLE `program_course`
  ADD CONSTRAINT `cozk2` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcd` FOREIGN KEY (`programCode`) REFERENCES `program` (`programCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `lecturekey1` FOREIGN KEY (`lectureID`) REFERENCES `live_lecture` (`lectureID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `q_marks`
--
ALTER TABLE `q_marks`
  ADD CONSTRAINT `q_marks_ibfk_1` FOREIGN KEY (`group_submit_id`) REFERENCES `group_assignment_submit` (`submitID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qkey` FOREIGN KEY (`assq_ID`) REFERENCES `assq` (`assq_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitkey` FOREIGN KEY (`submitID`) REFERENCES `submit` (`submitID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rep_thread`
--
ALTER TABLE `rep_thread`
  ADD CONSTRAINT `threadkey1` FOREIGN KEY (`threadID`) REFERENCES `thread` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `threadkey2` FOREIGN KEY (`parent_thread`) REFERENCES `thread` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `programkey1` FOREIGN KEY (`programCode`) REFERENCES `program` (`programCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userkey2` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student_assignment`
--
ALTER TABLE `student_assignment`
  ADD CONSTRAINT `stdasskey` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_assignment_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `cozk3` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studckey2` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_ext_assess`
--
ALTER TABLE `student_ext_assess`
  ADD CONSTRAINT `assesskey` FOREIGN KEY (`assessID`) REFERENCES `ext_assess` (`assessID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `regkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `gkey2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gstudkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_lecture`
--
ALTER TABLE `student_lecture`
  ADD CONSTRAINT `lecstudkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecturekey2` FOREIGN KEY (`lectureID`) REFERENCES `live_lecture` (`lectureID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD CONSTRAINT `notifkey` FOREIGN KEY (`notif_ID`) REFERENCES `notification` (`notif_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notstudkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_quiz`
--
ALTER TABLE `student_quiz`
  ADD CONSTRAINT `quizkey` FOREIGN KEY (`quizID`) REFERENCES `quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quizstudkey` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submit`
--
ALTER TABLE `submit`
  ADD CONSTRAINT `asskey` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studk22` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `instructorkey3` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `studkey2` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
