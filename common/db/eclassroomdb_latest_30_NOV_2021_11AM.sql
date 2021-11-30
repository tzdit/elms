-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 09:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `yearID` int(11) NOT NULL,
  `starts_in` smallint(4) NOT NULL,
  `ends_in` smallint(4) NOT NULL,
  `title` varchar(15) NOT NULL,
  `date_launched` datetime NOT NULL,
  `duration` int(2) NOT NULL COMMENT 'duration in months',
  `status` varchar(10) NOT NULL COMMENT 'ex: ongoing or finished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`yearID`, `starts_in`, `ends_in`, `title`, `date_launched`, `duration`, `status`) VALUES
(1, 2021, 2022, '2021 - 2022', '2021-11-28 03:43:39', 12, 'ongoing'),
(2, 2020, 2021, '2020-2021', '2021-11-28 07:53:52', 12, 'finished');

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
  `content` varchar(500) NOT NULL,
  `ann_date` date NOT NULL DEFAULT current_timestamp(),
  `ann_time` time NOT NULL DEFAULT current_timestamp(),
  `title` varchar(150) NOT NULL,
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`annID`, `instructorID`, `course_code`, `content`, `ann_date`, `ann_time`, `title`, `yearID`) VALUES
(24, 2, 'CP 111', 'cgnfgjfghjfg', '2021-11-19', '22:37:23', 'new test', 1);

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
  `fileName` varchar(70) DEFAULT NULL,
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assID`, `instructorID`, `course_code`, `assName`, `assType`, `assNature`, `ass_desc`, `submitMode`, `startDate`, `finishDate`, `total_marks`, `fileName`, `yearID`) VALUES
(138, 2, 'CP 111', 'chosen student types', 'students', 'assignment', 'asdfasdfs', 'unresubmit', '2021-07-15 00:00:00', '2021-07-23 00:00:00', 21, '60e44b8618b9f.txt', 0),
(152, 2, 'CP 111', 'testing assignment', 'allstudents', 'assignment', 'testing', 'resubmit', '2021-07-22 00:00:00', '2021-07-22 00:00:00', 15, '60e5e79317400.txt', 0),
(163, 2, 'CS 212', 'tutorial for you', NULL, 'tutorial', NULL, NULL, NULL, NULL, NULL, '610fd5c87eab5.png', 0),
(165, 2, 'CP 111', 'my tutorial', NULL, 'tutorial', '', NULL, NULL, NULL, NULL, '6180dcf2646d1.xlsx', 0),
(166, 2, 'CP 111', 'testing assignment 2', 'allstudents', 'assignment', '', 'resubmit', '2021-11-12 00:00:00', '2021-11-19 00:00:00', 27, '618220b910c27.txt', 0),
(167, 2, 'CP 111', 'test lab assignment', 'allgroups', 'assignment', 'do in groups of 5', 'unresubmit', '2021-11-11 00:00:00', '2021-11-12 00:00:00', 9, '6182374da0b46.txt', 0),
(171, 2, 'CP 111', 'Our assignment', 'allstudents', 'lab', 'mfkjadf', 'unresubmit', '2021-11-18 00:00:00', '2021-11-18 00:00:00', 10, '6182c0460c386.txt', 1),
(172, 2, 'CP 111', 'hali', NULL, 'tutorial', '', NULL, NULL, NULL, NULL, '619824d85f48f.pdf', 1),
(173, 2, 'CP 111', 'my tut', NULL, 'tutorial', '', NULL, NULL, NULL, NULL, '61a22d02216f5.pdf', 1);

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
(254, 138, 1, 7),
(255, 138, 2, 7),
(256, 138, 3, 7),
(297, 152, 1, 5),
(298, 152, 2, 5),
(299, 152, 3, 5),
(322, 166, 1, 9),
(323, 166, 2, 9),
(324, 166, 3, 9),
(325, 167, 1, 3),
(326, 167, 2, 3),
(327, 167, 3, 3),
(336, 171, 1, 1),
(337, 171, 2, 2),
(338, 171, 3, 3),
(339, 171, 4, 4);

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
('INSTRUCTOR & HOD', '53', 1632896999),
('STUDENT', '100', 1636701204),
('STUDENT', '101', 1636701336),
('STUDENT', '44', 1620477895),
('STUDENT', '45', 1620477973),
('STUDENT', '46', 1620478760),
('STUDENT', '47', 1620479291),
('STUDENT', '48', 1620479378),
('STUDENT', '49', 1620480151),
('STUDENT', '50', 1620480285),
('STUDENT', '52', 1632854018),
('STUDENT', '61', 1636185703),
('STUDENT', '62', 1636185703),
('STUDENT', '64', 1636185774),
('STUDENT', '66', 1636185940),
('STUDENT', '67', 1636185941),
('STUDENT', '70', 1636186926),
('STUDENT', '74', 1636187441),
('STUDENT', '75', 1636187442),
('STUDENT', '76', 1636292482),
('STUDENT', '77', 1636293783),
('STUDENT', '78', 1636295556),
('STUDENT', '79', 1636483079),
('STUDENT', '83', 1636484167),
('STUDENT', '84', 1636484300),
('STUDENT', '85', 1636484424),
('STUDENT', '86', 1636485587),
('STUDENT', '87', 1636485685),
('STUDENT', '88', 1636530872),
('STUDENT', '89', 1636531996),
('STUDENT', '90', 1636532404),
('STUDENT', '91', 1636532620),
('STUDENT', '92', 1636532725),
('STUDENT', '93', 1636532795),
('STUDENT', '94', 1636532920),
('STUDENT', '95', 1636533023),
('STUDENT', '96', 1636533144),
('STUDENT', '98', 1636696932),
('STUDENT', '99', 1636700986),
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
  `course_credit` decimal(3,1) NOT NULL,
  `course_semester` int(11) NOT NULL,
  `course_duration` int(11) DEFAULT NULL,
  `course_status` varchar(10) DEFAULT NULL,
  `departmentID` int(11) NOT NULL,
  `YOS` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_name`, `course_credit`, `course_semester`, `course_duration`, `course_status`, `departmentID`, `YOS`) VALUES
('CD459', 'java', '9.0', 2, 2, 'CORE', 1, 0),
('CD4591', 'introduction to programming in python', '9.0', 2, 2, 'CORE', 1, 0),
('CH111', 'java', '9.0', 2, 3, 'CORE', 1, 1),
('CP 111', 'Principle of Programming', '10.0', 1, 1, 'core', 1, 1),
('CP 123', 'Introduction High Level Programming in C++', '9.0', 2, 1, 'CORE', 1, 0),
('CS 212', 'Data Structure and Algorithms', '10.0', 1, 2, 'CORE', 1, 0),
('TN 110', 'Introduction to Telecommunication', '10.0', 1, 1, 'CORE', 1, 0);

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
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ext_assess`
--

INSERT INTO `ext_assess` (`assessID`, `instructorID`, `course_code`, `title`, `total_marks`, `date_created`, `yearID`) VALUES
(63, 2, 'CP 111', 'my assess', 30, '2021-07-26', 0),
(64, 2, 'CP 111', 'my first test', 30, '2021-07-26', 0),
(70, 2, 'CS 212', 'my assess', 69, '2021-08-08', 0),
(71, 2, 'CS 212', 'my testing', 40, '2021-11-02', 0),
(72, 2, 'CP 111', 'kjhsfd', 30, '2021-11-03', 1),
(73, 2, 'CS 212', 'my testing', 50, '2021-11-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

CREATE TABLE `forum_answer` (
  `answer_id` int(11) NOT NULL,
  `answer_content` text NOT NULL,
  `time_added` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comment`
--

CREATE TABLE `forum_comment` (
  `comment_id` int(11) NOT NULL,
  `comment_content` varchar(500) NOT NULL,
  `comment_type` int(1) NOT NULL,
  `time_added` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_qn_tag`
--

CREATE TABLE `forum_qn_tag` (
  `tag_id` int(11) NOT NULL,
  `course_code` varchar(7) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_question`
--

CREATE TABLE `forum_question` (
  `question_id` int(11) NOT NULL,
  `question_tittle` varchar(150) NOT NULL,
  `question_desc` text NOT NULL,
  `time_add` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(257, 'Group 1', 107),
(258, 'Group 2', 107),
(259, 'Group 3', 107),
(260, 'Group 1', 108),
(261, 'Group 2', 108),
(262, 'Group 1', 109),
(263, 'Group 2', 109),
(264, 'Group 1', 110),
(265, 'Group 2', 110),
(266, 'Group 1', 111),
(267, 'Group 2', 111),
(268, 'Group 1', 112);

-- --------------------------------------------------------

--
-- Table structure for table `group_assignment`
--

CREATE TABLE `group_assignment` (
  `GA_ID` int(11) NOT NULL,
  `groupID` int(11) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `group_generation_assignment`
--

CREATE TABLE `group_generation_assignment` (
  `gga_ID` int(11) NOT NULL,
  `gentypeID` int(11) DEFAULT NULL,
  `assID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_time` time DEFAULT current_timestamp(),
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_generation_types`
--

INSERT INTO `group_generation_types` (`typeID`, `generation_type`, `max_groups_members`, `course_code`, `creator_type`, `instructorID`, `reg_no`, `created_date`, `created_time`, `yearID`) VALUES
(107, 'Generation type 11:29:2021 02:26:19', 4, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:26:19', 1),
(108, 'Generation type 11:29:2021 02:27:08', 5, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:27:08', 1),
(109, 'Generation type 11:29:2021 02:27:21', 5, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:27:21', 1),
(110, 'Generation type 11:29:2021 02:27:48', 5, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:27:48', 1),
(111, 'Generation type 11:29:2021 02:28:04', 5, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:28:04', 1),
(112, 'Generation type 11:29:2021 02:54:42', 56, 'CP 111', 'instructor', 2, NULL, '2021-11-29', '16:54:42', 1);

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
(5, 51, 2, 'khalidi hassan', 'M', NULL, '07755888', 'hod@gmail.com'),
(6, 53, 2, 'noel kinabo', 'M', NULL, '0755189736', 'kinabo@gmail.com');

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
(42, 'CD459', 5),
(43, 'TN 110', 2);

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
-- Table structure for table `lectureroominfo`
--

CREATE TABLE `lectureroominfo` (
  `lectureroomID` int(11) NOT NULL,
  `lectureID` int(11) NOT NULL,
  `meetingID` varchar(255) NOT NULL,
  `duration` int(3) NOT NULL,
  `mpw` varchar(255) NOT NULL,
  `attpw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectureroominfo`
--

INSERT INTO `lectureroominfo` (`lectureroomID`, `lectureID`, `meetingID`, `duration`, `mpw`, `attpw`) VALUES
(51, 69, '?\\+?ҽ?Sd>???씍2169fded53d951b21551cfea4b62b2fd3296bd2810fd937e5bf9d472f09da64fC(L?8??????????;~`4Q???=2?jj?', 80, '?zr\n$qy?3???6H??e733c0e78521cf7e1a0a92ad8daa617edc9162d35db6dea2b08c3a02ef97104d1\'M???z??HsC??W?mF??H1?i?Y4zB0?', '?µ?E}??????K?D8cd93960606619979e96c5df45de95c4212d3b2716f4b439f0053af6c330149f??&n,l?????y???????????%)/??'),
(52, 70, '??P?u?^.?;??cca4b11b05b9c89535a7d5fa9a2ff7c1bb1bc7ecf28256b15d1b962e24e9490a?\r??\n???yc??S?s?6?f??:D?}N??\\?', 70, '???&??j.5BNu??a?ba02ded13b8169e6ddfbfda2d46293299f92bc50b9c35eeca5e9de8cfcc6f004o?a?lZGC??v4????M???s觯 X؏??', '?Ʈ!#<5?K?{\0????9567c631d245d3193bb70fc8f584f5c829e7fba26c4fcc65c513694aa1ef429ek???\nK?u??54???$$.*?? ??R???p?\"'),
(53, 72, '?;ݙ??ؗ`?6??oA2c55b6daf2afcd2197b2a6f10c7acf68201b512daaffb9d21dd2e267c049651e\n???Ļ??ɘ???F?AVS?h?Skg%xq}', 80, '???MWt???????:?05181efc920657d33df26bccfd7feec01b4190214db30e16c97bc560054a581di?b,vMmz?0?#?[uBm0ˮS|&??ȏ?', '}���=_?|??ծ??55bcbbedc2802cc8ad0931f1493e1e05b5794f29986940e2f3fdc8d0be77c673??s?Ĵ~???l?yl?׭Xc(?k?0=?[?'),
(54, 73, '??L?b?X??X[m?8d6e712d7d7d7a0f93aa117f8b65082c8225c901c5285eb78a23e61b922106af?~????mu=տ>7??(??t?T+??N??}?^R', 79, '?[?h?=?]7??v?X?add18fd9270eb4efb9ceae0c56c0f8abc428f8cf5a2b79029b5d28bb372f084f?x?g????yh?>?!Ǜ??8?UA8*z??', '?Js???=ue?X??<ed49bde981993b50500c6ca8fbd73ed8bdc78324409b7aaef62d1733c8542867?:^r}?ڼ?c?k?]x;TI??Ұ?????A?H'),
(55, 75, '?G????i]?K???M7f642ea9b07b6c2ca50e95d58d8a83f529690c0bb577f20b44543406ef0aecd8?oX?O?t?????_?G2???Ȗ???Bu?8?', 80, '??l??O\Z?0?s??:d4a64f34c89bd46353d5ce54ff2cd0319458e1f9c978e380ac35ce3ae2da6c7c??rw;	\0?\'m?v???*P^?8\"?6?jn??\0\np', '?л?V7????@??9b3c8efae681b214a261f0fdfcf253528e5bf0c8fdacc3bc82f7bdd40612a1783???\n??????Kj?l?Pc??N??d???*:4f?'),
(56, 76, '?G*[[B?}?\"??0K5ffb4445d6f3ac7dfea713fb5f7f871d246ee9b5c1601f34c54da9c01fd7a0f9?????ve?bh(?M9YŰ???ǣ???g', 80, 'F????????0r?,?7d169f7b483e0be072aa83d7956ecd410f5f91728e5517f418ac13ba49bc1750b???1??y?9??/?S7$&?r|?N??ќ', 'u?h(?\'ۊ[?=]-72081cb04340650a488679edc3913c15e000ec25885f4913fdd1c347149bd717LWg?C?;?)?+w?h???է!?Qm\r????]N'),
(57, 77, '?h??? ?p?@??a?lcee7bc02a18b4394d3f5858e0a1abfb7326dd9715e7a498f4b4e7209932a79c2b]<+??/???. ?%_?H??\n??????', 80, '#??F?\r??t?j??d784876dfe82c93bbf708abc4a1f29a854138ddfc5d07d5beb6e37725d80750cͅ1L?M?\\?0e?r??V+8?8\'??,?K?f?', '???k_???0???7??142532df0b325da41799dcfd4861d5b852797fb29e0e4657092779325835d212a?????W4?5?QD7?7??E?8A!X)?????'),
(58, 78, '(?˞?߸_?cd?I?Y69cb41e02eb026afd3c08c3502927f22181721b9d16c69dd4ad7378d0886e5ad=~??d???kv?7Z_?}???`??QO}??', 80, '?:??d\\??m??$?6bd54b7921f6fa1745673674dc3ad8149bef8708c63c1eec13b0a5835eb48ff0J\Z=??R??M\Z??mz???z???????H?', 'h?}t??r???????b10c90d2fcdd267dd1d5b7b8f2e29ca604a57671546ae7d1ca07be8fcb6f83cd?nj??*??x?WdlEM???ܧ;?j?o???'),
(59, 79, 'n^?I?/?>/?F?\r~??0e2b94e9d5050d531b73f702587260af483e197f5f5de931e0a37d566900ab8d??b>Cb/?k?Dm?nw??b\r?n?-??^6?', 80, '????eym??H??2<?ca8526b220355a176f4a5d5d626a9eaa3c3f911e0ad543d1c746321eae699c86??t???H?????CCpo??:?k0`S>?dC/', '?b????SPh?	?/4d924002c7feec2dc9a1b41f0742e007004b7f472a9c09e1aee9be62f7c1e599??KG6]A?Am?AeB?<?J3?6?U???'),
(60, 80, '?5n?Z?????\Z\n}3a48940cb5ef603672e435be3d9142180c01af71fd1dca4b89354f176de43ad3~?\'#x\"?g?C?\n12?=_Qq???\n>??C', 80, '6%?\r???q?&??c96e9b7325a14bd838ff59f11f17e5410391c1a5bf489670c932a7b05010107b??ʩ1????x?.?)b?????_@???[?o', '???53pFfq?????1ae0f9c7ec8ca5cb6ba5421791aa07e69667837bd2ce5d07216baa2080f64692;vl؂2#??o?3?b{???ھ,J?+;?Z?@?'),
(61, 83, 'CP 111', 9, 'CP 111lecturer', 'CP 111student'),
(62, 84, 'CP 111', 80, 'CP 111lecturer', 'CP 111student'),
(63, 85, 'CP 111', 70, 'CP 111lecturer', 'CP 111student'),
(64, 86, 'CP 111', 7, 'CP 111lecturer', 'CP 111student'),
(65, 87, 'CP 111', 7, 'CP 111lecturer', 'CP 111student'),
(66, 88, 'CP 111', 57, 'CP 111lecturer', 'CP 111student');

-- --------------------------------------------------------

--
-- Table structure for table `live_lecture`
--

CREATE TABLE `live_lecture` (
  `lectureID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lectureDate` date NOT NULL,
  `lectureTime` time NOT NULL,
  `duration` int(1) NOT NULL,
  `lateEntryMaxTime` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `live_lecture`
--

INSERT INTO `live_lecture` (`lectureID`, `instructorID`, `course_code`, `title`, `description`, `lectureDate`, `lectureTime`, `duration`, `lateEntryMaxTime`, `status`, `yearID`) VALUES
(69, 2, 'CP 111', 'thewinner', 'csdfgsdfg', '2021-11-12', '05:05:00', 80, NULL, 'new', 1),
(70, 2, 'CP 111', 'another', 'sfdgsdfg', '2021-11-12', '05:05:00', 70, NULL, 'new', 1),
(72, 2, 'CP 111', 'tings', 'zcvzxcv', '2021-11-20', '06:06:00', 80, NULL, 'new', 1),
(73, 2, 'CP 111', 'lecture 9', 'zsfsdf', '2021-11-19', '06:06:00', 79, NULL, 'new', 1),
(75, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(76, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(77, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(78, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(79, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(80, 2, 'CP 111', 'sdfgsdf', 'sdfgsdf', '2021-11-19', '04:04:00', 80, NULL, 'new', 1),
(83, 2, 'CP 111', 'final testing 2', 'fvxcb', '2021-11-20', '04:04:00', 9, NULL, 'new', 1),
(84, 2, 'CP 111', 'final winner', 'asvgasdfg', '2021-11-20', '04:04:00', 80, NULL, 'new', 1),
(85, 2, 'CP 111', 'my session', 'asdfasdf', '2021-11-20', '04:04:00', 70, NULL, 'new', 1),
(86, 2, 'CP 111', 'another sessin', 'sfsdfgsdf', '2021-11-28', '03:03:00', 7, NULL, 'new', 1),
(87, 2, 'CP 111', 'another sessin', 'sfsdfgsdf', '2021-11-28', '03:03:00', 7, NULL, 'new', 1),
(88, 2, 'CP 111', 'daddy', 'asdfasd', '2021-11-20', '03:03:00', 57, NULL, 'new', 1);

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
  `logtime` time NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `yearID` int(11) DEFAULT NULL
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
  `fileName` varchar(20) DEFAULT NULL,
  `yearID` int(11) NOT NULL,
  `moduleID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_ID`, `instructorID`, `course_code`, `title`, `material_type`, `upload_date`, `upload_time`, `fileName`, `yearID`, `moduleID`) VALUES
(60, 2, 'CP 111', 'material 2', 'Videos', NULL, NULL, '61a0d24fd9c7f.mp4', 1, 22);

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
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `moduleID` int(11) NOT NULL,
  `moduleName` varchar(200) NOT NULL,
  `module_description` varchar(400) DEFAULT NULL,
  `course_code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`moduleID`, `moduleName`, `module_description`, `course_code`) VALUES
(19, 'my module', 'my module', 'CS 212'),
(21, 'another module', 'another module', 'CS 212'),
(22, 'cp 111 module', 'yes yes', 'CP 111');

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
  `notif_time` time NOT NULL,
  `yearID` int(11) NOT NULL
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
('Bsc. - IDI', 2, 'asdfasdfa', 3, NULL),
('Bsc. - IS', 3, 'rtyujrtyu', 3, NULL),
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
  `programCode` varchar(20) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_course`
--

INSERT INTO `program_course` (`PC_ID`, `course_code`, `programCode`, `level`) VALUES
(22, 'CP 111', 'CS1', 1),
(23, 'CP 111', 'TE3', 2);

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
  `status` varchar(10) NOT NULL,
  `yearID` int(11) NOT NULL
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
(2, 2, 298, '5.00', NULL, NULL),
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
(22, 3, 297, '1.00', NULL, NULL),
(23, 3, 298, '1.00', NULL, NULL),
(24, 3, 299, '1.00', NULL, NULL),
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
(263, 2, 297, '5.00', NULL, NULL),
(264, 2, 298, '5.00', NULL, NULL),
(265, 2, 299, '5.00', NULL, NULL),
(266, 2, 297, '2.00', NULL, NULL),
(267, 2, 298, '2.00', NULL, NULL),
(268, 2, 299, '2.00', NULL, NULL),
(269, 2, 297, '4.00', NULL, NULL),
(270, 2, 298, '3.00', NULL, NULL),
(271, 2, 299, '3.00', NULL, NULL);

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
  `programCode` varchar(20) DEFAULT NULL,
  `fname` varchar(60) NOT NULL,
  `mname` varchar(60) DEFAULT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  `f4_index_no` varchar(20) DEFAULT NULL,
  `YOS` int(11) NOT NULL,
  `DOR` date NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `userID`, `programCode`, `fname`, `mname`, `lname`, `email`, `gender`, `f4_index_no`, `YOS`, `DOR`, `phone`, `status`) VALUES
('T/UDOM/2017/00091', 77, 'TE3', 'joshua', 'A', 'njau', 'joshua@gmail.com', 'M', NULL, 2, '2021-11-07', NULL, 'REGISTERED'),
('T/UDOM/2017/20154', 76, 'SE2', 'khalidi', 'hassan', 'thewinner', 'thewinnerog@gmail.com', 'M', NULL, 4, '2021-11-07', NULL, 'REGISTERED'),
('T/UDOM/2017/90000', 78, 'SE1', 'kinabo', 'q', 'juma', 'juma@gmail.com', 'M', NULL, 2, '2021-11-07', NULL, 'REGISTERED'),
('T/UDOM/2019/00900', 3, 'CS1', 'winner', '', 'OG', NULL, 'M', NULL, 2, '0000-00-00', NULL, ''),
('T/UDOM/2020/00001', 45, 'CS1', 'STUDENT', 'STUDENT', 'STUDENT', 'student@gmail.com', 'M', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00002', 46, 'SE1', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail2.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00003', 47, 'TE3', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail3.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00004', 48, 'TE3', 'Mwambashi', 'mwambashi', 'Shabani', 'student@gmail4.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00005', 49, 'TE3', 'sutdent20', 'mwambashi', 'Shabani', 'student@gmail5.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00006', 50, 'TE3', 'Zuwena', 'Rashidi', 'Mwendachik', 'student@gmail56.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00798', 52, 'SE1', 'thewinner', 'm.', 'hassan', 'thewinner@gmail.com', 'M', NULL, 2, '2021-09-28', NULL, 'REGISTERED'),
('T/UDOM/2020/05510', 61, 'TE3', 'khalidi ', 'r', 'hassan', 'khalid@gmail.com', 'M', NULL, 3, '2021-11-06', '89991', 'ok'),
('T/UDOM/2020/15510', 62, 'SE2', 'joshua', 'f', 'njau', 'winner1@gmail.com12', 'M', NULL, 2, '2021-11-06', '77495099299', 'okay'),
('T/UDOM/2020/155100', 64, 'SE2', 'joshua', 'f', 'njau', 'winner1@gmail.com120', 'M', NULL, 2, '2021-11-06', '7995099299', 'okay'),
('T/UDOM/2020/33332', 70, 'sE2', 'khalidi ', 'r', 'hassan', 'musa@udom.com', 'M', NULL, 3, '2021-11-06', '333555', 'ok'),
('T/UDOM/2020/44452', 75, 'SE2', 'cosmas', 'r', 'yadunia', 'musa@udom.com5', 'M', NULL, 3, '2021-11-06', '33135355', 'ok'),
('T/UDOM/2020/55553', 74, 'TE3', 'ona', 'r', 'kowero', 'khalidi@yahoo.com5', 'M', NULL, 3, '2021-11-06', '1213110', 'ok'),
('T/UDOM/2020/8800', 66, 'TE3', 'khalidi ', 'r', 'hassan', 'khalid@gmail.com32', 'M', NULL, 3, '2021-11-06', '18999', 'ok'),
('T/UDOM/2020/9990', 67, 'SE2', 'joshua', 'f', 'njau', 'winner1@gmail.com1202', 'M', NULL, 2, '2021-11-06', '17995099299', 'okay'),
('T/UDOM/2021/04300', 94, 'SE1', 'MATATA', 'A', 'hassan', 'juma10@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04301', 95, 'CS1', 'MATATA', 'q', 'thewinner', 'juma00@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04303', 98, 'SE1', 'MATATA', NULL, 'juma', 'juma5@gmail.com', 'M', NULL, 1, '2021-11-12', NULL, 'REGISTERED'),
('T/UDOM/2021/04309', 96, 'SE1', 'khalidi', 'm.', 'SELEMANI', 'juma09@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04311', 88, 'SE2', 'MATATA', 'm.', 'juma', 'thewinnerog1@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04312', 101, 'CS1', 'MATATA', 'A', 'njau', 'juma66@gmail.com', 'M', NULL, 1, '2021-11-12', NULL, 'REGISTERED'),
('T/UDOM/2021/04322', 100, 'CS1', 'MATATA', 'hassan', 'SELEMANI', 'juma55@gmail.com', 'M', NULL, 1, '2021-11-12', NULL, 'REGISTERED'),
('T/UDOM/2021/04342', 89, 'SE1', 'MATATA', 'q', 'njau', 'joshua2@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04344', 86, 'TE3', 'MATATA', 'R', 'thewinner', 'juma4@gmail.com', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04345', 87, 'TE3', 'khalidi', 'R', 'SELEMANI', 'juma6@gmail.com', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04348', 79, 'SE2', 'MATATA', 'R', 'SELEMANI', '', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04350', 83, 'SE2', 'MATATA', 'R', 'thewinner', 'thewinnerog2@gmail.com', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04351', 84, 'SE1', 'MATATA', 'R', 'testing', 'juma2@gmail.com', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04352', 85, 'TE3', 'MATATA', 'hassan', 'testing', 'juma3@gmail.com', 'M', NULL, 1, '2021-11-09', NULL, 'REGISTERED'),
('T/UDOM/2021/04353', 93, 'SE1', 'MATATA', 'A', 'thewinner', 'matatabrangr2@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04354', 92, 'SE1', 'khalidi', 'hassan', 'SELEMANI', 'juma9@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04355', 90, 'SE1', 'khalidi', 'q', 'njau', 'jumah@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04356', 91, 'SE1', 'MATATA', 'A', 'testing', 'juma7@gmail.com', 'M', NULL, 1, '2021-11-10', NULL, 'REGISTERED'),
('T/UDOM/2021/04666', 99, 'CS1', 'MATATA', 'R', 'SELEMANI', 'matatabrangr55@gmail.com', 'M', NULL, 1, '2021-11-12', NULL, 'REGISTERED');

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
(10, 138, 'T/UDOM/2020/00002');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `SC_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`SC_ID`, `reg_no`, `course_code`) VALUES
(10, 'T/UDOM/2017/20154', 'CP 123'),
(9, 'T/UDOM/2020/00001', 'CP 111'),
(8, 'T/UDOM/2020/00798', 'CP 111'),
(7, 'T/UDOM/2020/00798', 'CP 123');

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
(48, 'T/UDOM/2020/00001', '12.00', 64),
(49, 'T/UDOM/2020/00002', '12.00', 64),
(51, 'T/UDOM/2020/00001', '10.00', 63),
(55, 'T/UDOM/2020/00005', '10.00', 70),
(58, 'T/UDOM/2020/00003', '4.00', 70),
(59, 'T/UDOM/2020/00006', '7.00', 70),
(60, 'T/UDOM/2020/00002', '3.00', 72),
(61, 'T/UDOM/2020/00798', '3.00', 72),
(62, 'T/UDOM/2020/00003', '3.00', 72),
(63, 'T/UDOM/2020/00004', '3.00', 72),
(64, 'T/UDOM/2020/00005', '3.00', 72),
(65, 'T/UDOM/2020/00006', '3.00', 72),
(66, 'T/UDOM/2019/00900', '3.00', 72),
(67, 'T/UDOM/2020/00001', '3.00', 72),
(68, 'T/UDOM/2020/00003', '3.00', 73),
(69, 'T/UDOM/2020/00004', '3.00', 73),
(70, 'T/UDOM/2020/00005', '3.00', 73),
(71, 'T/UDOM/2020/00006', '3.00', 73);

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
(829, 'T/UDOM/2021/04352', 257),
(830, 'T/UDOM/2021/04344', 257),
(831, 'T/UDOM/2017/00091', 257),
(832, 'T/UDOM/2021/04345', 257),
(833, 'T/UDOM/2020/00001', 258),
(834, 'T/UDOM/2020/00798', 258),
(835, 'T/UDOM/2020/00004', 258),
(836, 'T/UDOM/2020/00006', 258),
(837, 'T/UDOM/2020/00005', 259),
(838, 'T/UDOM/2020/00003', 259),
(839, 'T/UDOM/2020/00004', 260),
(840, 'T/UDOM/2021/04344', 260),
(841, 'T/UDOM/2020/00798', 260),
(842, 'T/UDOM/2020/00003', 260),
(843, 'T/UDOM/2020/00001', 260),
(844, 'T/UDOM/2021/04345', 261),
(845, 'T/UDOM/2017/00091', 261),
(846, 'T/UDOM/2020/00006', 261),
(847, 'T/UDOM/2021/04352', 261),
(848, 'T/UDOM/2020/00005', 261),
(849, 'T/UDOM/2020/00001', 262),
(850, 'T/UDOM/2017/00091', 262),
(851, 'T/UDOM/2020/00004', 262),
(852, 'T/UDOM/2020/00003', 262),
(853, 'T/UDOM/2021/04344', 262),
(854, 'T/UDOM/2020/00798', 263),
(855, 'T/UDOM/2021/04352', 263),
(856, 'T/UDOM/2020/00006', 263),
(857, 'T/UDOM/2020/00005', 263),
(858, 'T/UDOM/2021/04345', 263),
(859, 'T/UDOM/2017/00091', 264),
(860, 'T/UDOM/2020/00006', 264),
(861, 'T/UDOM/2020/00001', 264),
(862, 'T/UDOM/2021/04345', 264),
(863, 'T/UDOM/2021/04352', 264),
(864, 'T/UDOM/2020/00005', 265),
(865, 'T/UDOM/2020/00004', 265),
(866, 'T/UDOM/2021/04344', 265),
(867, 'T/UDOM/2020/00798', 265),
(868, 'T/UDOM/2020/00003', 265),
(869, 'T/UDOM/2020/00001', 266),
(870, 'T/UDOM/2021/04345', 266),
(871, 'T/UDOM/2021/04344', 266),
(872, 'T/UDOM/2020/00004', 266),
(873, 'T/UDOM/2021/04352', 266),
(874, 'T/UDOM/2020/00006', 267),
(875, 'T/UDOM/2020/00798', 267),
(876, 'T/UDOM/2017/00091', 267),
(877, 'T/UDOM/2020/00003', 267),
(878, 'T/UDOM/2020/00005', 267),
(879, 'T/UDOM/2020/00001', 268),
(880, 'T/UDOM/2021/04345', 268),
(881, 'T/UDOM/2017/00091', 268),
(882, 'T/UDOM/2020/00003', 268),
(883, 'T/UDOM/2020/00005', 268),
(884, 'T/UDOM/2020/00006', 268),
(885, 'T/UDOM/2020/00798', 268),
(886, 'T/UDOM/2021/04344', 268),
(887, 'T/UDOM/2020/00004', 268),
(888, 'T/UDOM/2021/04352', 268);

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
(2, 'T/UDOM/2020/00001', 152, 'nafasi.pdf', '11.00', '2021-07-07', '19:44:23', 'passed'),
(3, 'T/UDOM/2021/04342', 152, 'head.pdf', '3.00', '2021-07-07', '19:47:04', 'failed'),
(11, 'T/UDOM/2020/00001', 152, 'db_final_ER.mp4', '10.00', '0000-00-00', '00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_entry`
--

CREATE TABLE `tbl_audit_entry` (
  `audit_entry_id` int(11) NOT NULL,
  `audit_entry_timestamp` varchar(100) NOT NULL,
  `audit_entry_model_name` varchar(100) NOT NULL,
  `audit_entry_operation` varchar(100) NOT NULL,
  `audit_entry_field_name` varchar(100) NOT NULL,
  `audit_entry_old_value` text DEFAULT NULL,
  `audit_entry_new_value` text NOT NULL,
  `audit_entry_user_id` varchar(100) NOT NULL,
  `audit_entry_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_audit_entry`
--

INSERT INTO `tbl_audit_entry` (`audit_entry_id`, `audit_entry_timestamp`, `audit_entry_model_name`, `audit_entry_operation`, `audit_entry_field_name`, `audit_entry_old_value`, `audit_entry_new_value`, `audit_entry_user_id`, `audit_entry_ip`) VALUES
(1, '1638216371', 'Module', 'UPDATE', 'course_code', NULL, 'CP 111', '36', '::1'),
(2, '1638216371', 'Module', 'UPDATE', 'moduleName', NULL, 'xdfgdf', '36', '::1'),
(3, '1638216372', 'Module', 'UPDATE', 'module_description', NULL, 'dfhgdfg', '36', '::1'),
(4, '1638216372', 'Module', 'UPDATE', 'moduleID', NULL, '24', '36', '::1'),
(5, '1638216610', 'Module', 'UPDATE', 'course_code', NULL, 'CP 111', '36', '::1'),
(6, '1638216610', 'Module', 'UPDATE', 'moduleName', NULL, 'my module', '36', '::1'),
(7, '1638216610', 'Module', 'UPDATE', 'module_description', NULL, '333', '36', '::1'),
(8, '1638216610', 'Module', 'UPDATE', 'moduleID', NULL, '25', '36', '::1'),
(9, '1638216781', 'GroupGenerationTypes', 'UPDATE', 'generation_type', NULL, 'winner', '36', '::1'),
(10, '1638216781', 'GroupGenerationTypes', 'UPDATE', 'course_code', NULL, 'CP 111', '36', '::1'),
(11, '1638216781', 'GroupGenerationTypes', 'UPDATE', 'creator_type', NULL, 'instructor-student', '36', '::1'),
(12, '1638216782', 'GroupGenerationTypes', 'UPDATE', 'instructorID', NULL, '2', '36', '::1'),
(13, '1638216782', 'GroupGenerationTypes', 'UPDATE', 'yearID', NULL, '1', '36', '::1'),
(14, '1638216782', 'GroupGenerationTypes', 'UPDATE', 'max_groups_members', NULL, '2', '36', '::1'),
(15, '1638216782', 'GroupGenerationTypes', 'UPDATE', 'typeID', NULL, '116', '36', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `threadID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `starter_type` varchar(10) NOT NULL,
  `yearID` int(11) NOT NULL
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
(36, 'instructor@gmail.com', 'GuRbp_dZnRawmalhinFLcx60sS9gJg9k', '$2y$13$Mp2lCvU4Dys6IYbiSTT55efxyT5E/HKfshllyUbkyEw57jU5vVayC', NULL, 10, 1620317149, 1637160739, 'jm-WpUFZXbNj5qXPm0n-uUVUZF6GLp9m_1637160715'),
(38, 'instructor1@gmail.com', 'LQdO46HMTAeZuFBc7VCRnYlJnpURlUt1', '$2y$13$cSx3Z0IMdBRGwqCuhg0lmenVoggrW9K0D960b84RhUgVi3.H9oaO.', NULL, 10, 1620317380, 1620317380, 'rp93GLyD5Nxq1JPc8GoXjVkFTnuvb1Sn_1620317380'),
(45, 'T/UDOM/2020/00001', 'E74yoddrlMMbGVdH-DrcgrD_QNEpQAaU', '$2y$13$iCjOCcU4qS7dOIRhzeFBP.sNgAstxXxzaloHg2N3VAtcrswTGRV7C', NULL, 10, 1620477973, 1637160592, 'Q1WoVTIiWLOak_x0thFiGqVuagjDSdna_1637160557'),
(46, 'T/UDOM/2020/00002', 'BLeSYvp7xmFaztFiCwuT2gsPce-hQvoz', '$2y$13$.EtDdHdudB7i2tv/N8auIeT03Ul.qonRAAJNjmJNQdob5H4HvRzrq', NULL, 10, 1620478760, 1620478760, 'sRGQTOjV-IqflqfaKPlSfmDGY1dejCDx_1620478760'),
(47, 'T/UDOM/2020/00003', '7YKPavAGjFiazuNaDH2ExZvJeVYz8CMT', '$2y$13$s6nXxl4WQTv85qFUzwxUuOzXy1n41newEoY/XRsKfcQBRdJiFMSbO', NULL, 10, 1620479291, 1620479291, 'b28wb_mxjxxUDKMgj-LwwraUaqt04CST_1620479291'),
(48, 'T/UDOM/2020/00004', '67FEyg1E-IEGlBJkCJNF__ZL9CQ3mj-Y', '$2y$13$Jp8mQaBe/2.I7BnpPFZrueB1GRrV7CrHp9fcnX7vJFpxFGCHMYRFS', NULL, 10, 1620479378, 1620479378, 'mkBFhUVlS04YoX6T82YgZPKaEPkrN92-_1620479378'),
(49, 'T/UDOM/2020/00005', 'zR9kdjBWTKsmdZ3pAs4kG9rJZYyVIMmV', '$2y$13$Z4t8uHoXDQ87c8vmoOvYOu.f9TWZPddpFUM/gBazdBXsJS8Y3h/w2', NULL, 10, 1620480151, 1620480151, 'KE2YNyNG8Womx90OLdDyGCVkjBLDsHmT_1620480151'),
(50, 'T/UDOM/2020/00006', 'U9qu2XUtMVOITbWgYOZhBH4L3OAPsd6y', '$2y$13$AH0OppbJcFbSy/23rXffROh.pNVw8CVxYKjUuyIAoNbai9ZGTMmOG', NULL, 10, 1620480285, 1620480285, 'phAwORTa2r6VWTw6k-Rd0FLyDYGXC_Xd_1620480285'),
(51, 'hod@gmail.com', 'B8WVLnnt-gMF9mF36_gi6eF1fqWwNHfM', '$2y$13$52aE79R/10CNeJOQpqn9cOMJ2KCrvh6xrQ3zDEzLUtFwFq5zlwMgO', NULL, 10, 1625899607, 1625899607, 'hOHSG7SNSEd2AiVDwzUesbCIRgc0N1a4_1625899607'),
(52, 'T/UDOM/2020/00798', 'TOA9IqdPxS4HKMUm9Jf-ySff8KcMV0_R', '$2y$13$ofUh7XUdadwfvyGwOjxn/.9Xb8pFBXf1TSV7.mJoyNEoxSbmpt1WO', NULL, 10, 1632854018, 1632854018, 'cG6Y_Ag9fQxi80s_p39OtaoNVBDtzEiS_1632854018'),
(53, 'kinabo@gmail.com', 'zQ0OZdtz1cgrQnVCXh--ZewCK4P2WXl8', '$2y$13$8ZybMDtlDfoLmH4hcFjz5OpRLvgaRCG6hllVGjI.xSk1hpercJvMS', NULL, 10, 1632896999, 1632896999, 'eDa4lc1zE_y24mUUWPqCxK30a-Xkxzho_1632896998'),
(54, 'T/UDOM/2020/05555', 'Wx_6P612vh69WGkO_FZv0QYXyKpezF58', '$2y$13$k9S/1Wnl5iy8kLiw7EjqEeFzJ3mPkXZ7uGSqALlwPl1Pnv9Ez20w.', NULL, 10, 1636184521, 1636184521, 'FBeYRt670llbZzcRfcHcf6RwabdfTIPZ_1636184521'),
(55, 'T/UDOM/2020/055551', 'sR4JvV16MinnFD-MSGTKi6tAwSB4FrXx', '$2y$13$8RSK2C0VycHN1ROQhixxX.Fh6OTyV5jga3awQLEhJfub8pYftF7wK', NULL, 10, 1636185027, 1636185027, 'Z2TeLBLUKCFO-x2RZQ1_IKyuIxtJFAQu_1636185027'),
(56, 'T/UDOM/2020/000111', 'cZKOgc_7NxjE6NP_lWD8_SDa0GWfgEoP', '$2y$13$LRDS4zy5ZX45MdmaXwebReZgL38MYPxUcS9Xl2vW4iC1Ruq8cUcCO', NULL, 10, 1636185027, 1636185027, 'Bgn8rqtse1oYOry8I54CVWTpGmy_iHFD_1636185027'),
(58, 'T/UDOM/2020/0551', '85Rp2Vaisqjxmturaz4RMCL14Jx8XEjG', '$2y$13$LdjRLXXy/SM1lQixpukAuOLzfMe4qM8NEweA7Xr2gOjACI6dQTImC', NULL, 10, 1636185446, 1636185446, 'TviqqD-ekWT0yZ5IUmopHXnr49TQICUs_1636185446'),
(59, 'T/UDOM/2020/15511', 'VRzL41CRlBVVgq4wfG3U6Ak0piRqyb1_', '$2y$13$7n.AccvAGm2UuCEKcEl5eu9KU0rnT732a8W3hYQXbS6dITiiUSCtq', NULL, 10, 1636185446, 1636185446, '9GWPO69PML2ob-A44HvqwoONjY0fSPbL_1636185446'),
(61, 'T/UDOM/2020/05510', 'KYmQATYQ55uTk3az9WYGA98TH8TBAOaY', '$2y$13$UZeHidACtgo4mhsO5R/3j.J4kS6eJXD4B/9UCWHQAFKLthFsKxecG', NULL, 10, 1636185703, 1636185703, 'T2Y4haBLccLqfJUcuYzqZSYXJ_J4X1uB_1636185703'),
(62, 'T/UDOM/2020/15510', 'sf26GM6ydRFQuISSHcnsgxNQdYeom7DD', '$2y$13$r5tddGRWM.F10Ea0MEsgZueKN/BkuEGzDjLh0p.21Lfrk15Xx03EG', NULL, 10, 1636185703, 1636185703, 'kvixFxH5QeA-4i2-7qXyOGFCQv6GZiKT_1636185703'),
(63, 'T/UDOM/2020/055100', 'vWv11ypaAinCo70gZnfHTSpKMZqiaLBw', '$2y$13$uf.MF3jJ/xPgpTYWim/L5OM6ZoTwAT8z3epPfSRhiZ9Dypza4U8nu', NULL, 10, 1636185774, 1636185774, 'WJsz7rg5X_Sw8-By-s28lp0jgvsrSAyB_1636185774'),
(64, 'T/UDOM/2020/155100', 'zSOoJbT1rlKnUHK7GYIELdbSogaG4OXX', '$2y$13$0.IU/RPokDFNvncmU0K5vuLSL8nGqp6189G1k5DlTMmr.FpFTubaq', NULL, 10, 1636185774, 1636185774, 'Ldt4u5StvY1eBwQCiNB54JWQOBAsra2f_1636185774'),
(66, 'T/UDOM/2020/8800', 'r1R4XE8A9dLVW-rSBn3pDxblR71-q3y8', '$2y$13$OQ4v13MfgJSitCzttWC1Geb.yelqPG3UpBStBktKgMumJcjYU/apa', NULL, 10, 1636185940, 1636185940, 'ryW_0V3-hHsg--vot-m15r-Oa5WN5XwB_1636185940'),
(67, 'T/UDOM/2020/9990', 'Td1KRUAZY35niSDDE5H7Z15pHDHCFDjK', '$2y$13$qqoPY5FUEcT9/b48pZ4K1Oy77dcPronmE9i4x/Ux7D9ciMz1Gkmg6', NULL, 10, 1636185940, 1636185940, 'CsR_5aouuQSOOv8WOPPk4kdLM6_1Pl5M_1636185940'),
(69, 'T/UDOM/2020/22222', 'e8ofGs7XF6GIYxrVhi-uc1N8rnOHi5ls', '$2y$13$oH6RROQhVSJsKrpiICLxY.0TKtv.jI/FAxA1TeddPH2x1BCdL9t/.', NULL, 10, 1636186925, 1636186925, 'K9gLOcXReDywWLEnoGkRfmEa2t84p1k8_1636186925'),
(70, 'T/UDOM/2020/33332', 'LT9eyEGFSsz-cNf-kX0in8RsCOSNcjFL', '$2y$13$fkFT.Pyd3g/wapCRpo6gI.frLFCjSL4HlgEGre3TroIrtDRM5s196', NULL, 10, 1636186926, 1636186926, '2lFfzBQHoulDg9W5YDl28ujT64s4pgmK_1636186926'),
(72, 'T/UDOM/2020/55555', 'zYWaqr0QxH_NxVhdM30HzyyDat3Ur9o4', '$2y$13$1f.Jpz1K3gENljIEVvSMKuv/Cnd3ZnnEr1VcbbzYcnREB7H5InFA6', NULL, 10, 1636187327, 1636187327, 'ABkwdr-ANqNEnE5ctWFK4G3D0iks96cS_1636187327'),
(73, 'T/UDOM/2020/44442', 'Duh5CnHtFpJ1TEB5uoI5_2Vu9v-8bLmv', '$2y$13$mJeQARYyHyBXD3NM3k0e4eDjjcLPWAHikHyfRiNn4C34zZWppY.Am', NULL, 10, 1636187327, 1636187327, 'NuhWSFb9dUr_vpw9HWlZE8U0Dv0kee3u_1636187327'),
(74, 'T/UDOM/2020/55553', 'nvgJlyEvS61vBv3vw-8ykCpaGk0WO5LT', '$2y$13$qtK6VqIR2uHWCUU3oIQmROgGds9Zy6.jLFfUT33W/4lR29zKBDGGC', NULL, 10, 1636187441, 1636187441, 'S_rtUQ53-RRFlkOyNfGF7zE6tQEy2sqO_1636187441'),
(75, 'T/UDOM/2020/44452', 'XYaRWGFVW4YVCZSWMu6jpsCzNydWkJfM', '$2y$13$7SLBnT5Cjo4bboggi0KDEuzoOqyXa.tjYyh7XBounO9iotZGaSrW.', NULL, 10, 1636187442, 1636187442, 'F3PkXv8ZtT_PKSTTsP-r6uK9975MMpXy_1636187442'),
(76, 'T/UDOM/2017/20154', 'mFVErJfqarssP68g-tC4oeTZo5zglyKr', '$2y$13$OqJiwmNOxf3V1/qXq6JtX.uzbvMYHp1PcFKJvXUrm2BmfAXFwxIIy', NULL, 10, 1636292482, 1636292482, 'AP_Q0VODCVo8v_e8tXRcb3Cxf5jpdHVx_1636292482'),
(77, 'T/UDOM/2017/00091', 'AYqSjREbbxivviGcquQ_-pTATpmGbYrl', '$2y$13$bWZ7YF0hCycjynsAQaKLiOYVTA06thnyw72yksPMsxh7PVbIQKTtm', NULL, 10, 1636293783, 1636293783, '-j6KaUbDy4lgDx8-VbFiZbA25t11XUbF_1636293783'),
(78, 'T/UDOM/2017/90000', 'uJ4ia5UiJuTD3tZ0d6YpJCbYSEOc6jq6', '$2y$13$ZhPwwRBRSLADGxMBIeSQIeW.Aabhsr1vxPK.2U/04fU9zIdzf.ZHi', NULL, 10, 1636295556, 1636295556, '_8V0mofCu4c6-P_5uQ7crp8twJMxnl3i_1636295556'),
(79, 'T/UDOM/2021/04348', '1nTFxqB3xbdqBvTsb_A80C8YZ0Vgrfa8', '$2y$13$6aP36yYxDJQWN5LbMz.aeuPsqtAEz3N7VW4.j.QE70p0X1LmfNCzO', NULL, 10, 1636483079, 1636483079, 'HEeIuNhlm0q3Z8ZRqfl8MUZ7t-HbOFPl_1636483078'),
(83, 'T/UDOM/2021/04350', 'XGUtG_-_vS94Q-Vdk-P6UVCKeXMuChNC', '$2y$13$hjNhZY0jvwxtj20p9vRTCeAk4VrfYYqINXxi0kzlwWUMf2jW1JU92', NULL, 10, 1636484167, 1636484167, 'hphkxsKhUNDxhQsOFhlUb-pA87Wyzprn_1636484167'),
(84, 'T/UDOM/2021/04351', 'CCLYR4hv3KzRhRuxcAnDsGqnPhFdW8XF', '$2y$13$7Jh7Az3DAO0qSdFyRb1A8OoeeEEN5bVEa.4gXXGSkB8TRja7HJziG', NULL, 10, 1636484300, 1636484300, 'PCi1s3opPJTw6XIg_WHP4J_B7v-DCijh_1636484300'),
(85, 'T/UDOM/2021/04352', 'EPH-tMQfqi8QS86EAyt12ijTNnAw26q6', '$2y$13$GohI6PM0og6Syi.uy.j84.DR7pS9NZ1wuBUKrhbiUEP7QFvjT4BsO', NULL, 10, 1636484424, 1636484424, 'PL4csijqdIDgSk46Ix2KoXLrSr5gsGep_1636484424'),
(86, 'T/UDOM/2021/04344', 'X764oI5lYCIzm48zgq3B9l-PEgAqcpnR', '$2y$13$ehYnhe3CKsZvYY/w0mflBO58BC4Lp/6JhORYexAx7DNQmjIurQFZ2', NULL, 10, 1636485587, 1636485587, 'wKnvSqbfd3toZDcu5Ohy5x7lqamT_wJt_1636485587'),
(87, 'T/UDOM/2021/04345', '0kKzBN_iei7Ugg-t2aVn4Re20VEqZ2TV', '$2y$13$1zWyo3baXH9c2vAbAoc7U.PJf0dOK8O.xOfhFc/8cxAFRICj0wXGe', NULL, 10, 1636485684, 1636485684, 'iRBAW2sTjLEdUeq5ljJ5Cg3f3NjBg3CH_1636485684'),
(88, 'T/UDOM/2021/04311', '1ouBMcX0rijMTx7tl6coscbg24QCDFif', '$2y$13$7jd5e.m9eKywPYfNjjGar.qhONhFEUliiCqciG0/Cja1BW2KXzfFm', NULL, 10, 1636530872, 1636530872, 'Easjxp2bI5FBcOiqHk4Pt5WnBFTz-4vI_1636530872'),
(89, 'T/UDOM/2021/04342', 'nDlpODJkSCINu-aQq1PDQL5x1xxuDRx_', '$2y$13$a8NGtrIU0wRa2/61ALfgIe8fYbzlKQWLbmjCsdeD9GHBw6SfAt0L6', NULL, 10, 1636531996, 1636531996, 'Imju3rvuRt8jN8AUcgLTTpJeJUa72kr4_1636531996'),
(90, 'T/UDOM/2021/04355', 'pz91PUj41L6v4dxDytKaHTuiVweBiiKK', '$2y$13$NUBZNSBmy0d8UsM1Ob7Kde/BdIScSsgJ5DAaI1nfpfldPj/lyQ97a', NULL, 10, 1636532404, 1636532404, 'pL24j_ycbkENLmqhyeaLBoB2HCSLRK6E_1636532404'),
(91, 'T/UDOM/2021/04356', 'vPdOBbClPXUrC84SvU2L3Q_Tu664MbZm', '$2y$13$IoZF.0Dx0VBpV44vIe7Xv.Il52XKfR5FvyvgOtX6fdqNSPKEvXj6q', NULL, 10, 1636532620, 1636532620, 'VaBEyuZX0W-zCMKx7qbz92_9FBvptcjs_1636532620'),
(92, 'T/UDOM/2021/04354', 'U9l_QincCCBFKMaZUC4iW5OCVtb_BEjY', '$2y$13$iod64XoqTdWp9CFGvQjdX.hp8C/4bAhlRKGHV/z2TVtIz7dkbGvJi', NULL, 10, 1636532725, 1636532725, 'Z0FyUu0_pmeaGRJCyJa4Dvi3H-qhUhW0_1636532725'),
(93, 'T/UDOM/2021/04353', 'cp4abaECATXW9eENEUYe2jQsbNdufUvH', '$2y$13$PZoerJVHQ7OHsaaLUzc6J.s1q2wAqFkDtYsb4T35hpaa0bgEjEysO', NULL, 10, 1636532795, 1636532795, 'LSOdMoybTvVARjOrewZhEfoUMAA0Tie5_1636532795'),
(94, 'T/UDOM/2021/04300', 'nQQrXGHdEmzzZa2bfzZjIRBz5HD7FRwD', '$2y$13$B/Yfgti2csQI7XCTARG21eKqir8SNZbecAH.IREOXCSxQXIMoetCu', NULL, 10, 1636532920, 1636532920, 'Z5a5175LROHQWmBz6NlbNj9UFUTf2mTO_1636532920'),
(95, 'T/UDOM/2021/04301', 'aa8yTcw7LpBxGecveIPNWhXGo3vZidAF', '$2y$13$dYSFXqqfNy9iQZvRc8tB0ujsWqqr0uteFk.mlSPWVclgqW/3j5dJe', NULL, 10, 1636533023, 1636533023, 'TUL0wQ0TuZ26zgdE1GaRxTJRuJ5mZZa__1636533023'),
(96, 'T/UDOM/2021/04309', '3pMDrpIvuh7g83IeqN8HHuRsvEy43UX0', '$2y$13$h1pVP.5QSzdlhVB9WFJ2meQXVd6PIc4GRrZkfETgOe9Din/cjwYvm', NULL, 10, 1636533143, 1636533143, 'cD-Pzkxl4Yh7wlcRU5XkHm3MyRgaK3A5_1636533143'),
(98, 'T/UDOM/2021/04303', 'SwgznuwYPbAgxlyvPzNMDKV7bfaZF7EC', '$2y$13$MH/0CV2UyuA7DU0nz0N/TOZiJ8GtGRKmdK.4OYz5m9H.P3E6JgsYi', NULL, 10, 1636696932, 1636696932, 'iy5hgKiJrA4-sH6PViQTiA_P0eXYw8jH_1636696932'),
(99, 'T/UDOM/2021/04666', 'Cr-wkLGxuO1oW_FN4VWtS5ONfs31sVRx', '$2y$13$hkSCkHPrX7LuLtLjx8c69uOpaU6dthgc4aYZOlz4wKTdHDBPa9Dza', NULL, 10, 1636700986, 1636700986, 'Xw06y-tL7xEwO8Rq7BSr2zcwl7UN-woH_1636700986'),
(100, 'T/UDOM/2021/04322', 'C14UX5uToYw1I_id2fo96LW2-4BAmDlI', '$2y$13$LL4bUMQ9semNpFp28NCAc.Gc6JmPiGTjzdPMkG0RdNMsnZWzpM9Cu', NULL, 10, 1636701204, 1636701204, 'iQZPoIPSD4LWwy6sorpDoNwb2EWggoXL_1636701204'),
(101, 'T/UDOM/2021/04312', 'NWH9KMUWjxyZImD4hHZlIOSAPl-VKqGZ', '$2y$13$mTEOhj1TNvi3taOZM7/wju8Y3qzm0ldq9cVB7De2UagXW8gUmDz5O', NULL, 10, 1636701336, 1636701336, 'REwgPUknWsguhZ4Ztch75DBwTvw7m-aw_1636701336');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`yearID`);

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
  ADD PRIMARY KEY (`course_code`),
  ADD KEY `departmentID` (`departmentID`);

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
-- Indexes for table `forum_answer`
--
ALTER TABLE `forum_answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_user_answer` (`user_id`),
  ADD KEY `fk_question_answer` (`question_id`);

--
-- Indexes for table `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_user_comment` (`user_id`),
  ADD KEY `fk_question_comment` (`question_id`),
  ADD KEY `fk_answer_comment` (`answer_id`);

--
-- Indexes for table `forum_qn_tag`
--
ALTER TABLE `forum_qn_tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `fk_question_tag` (`question_id`),
  ADD KEY `fk_course_tag` (`course_code`);

--
-- Indexes for table `forum_question`
--
ALTER TABLE `forum_question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_user_qn` (`user_id`);

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
-- Indexes for table `lectureroominfo`
--
ALTER TABLE `lectureroominfo`
  ADD PRIMARY KEY (`lectureroomID`),
  ADD KEY `lectureID` (`lectureID`);

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
  ADD KEY `userlogkey` (`userID`),
  ADD KEY `yearID` (`yearID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_ID`),
  ADD KEY `instructorkey5` (`instructorID`),
  ADD KEY `coursekey4` (`course_code`),
  ADD KEY `moduleID` (`moduleID`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleID`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_ID`),
  ADD KEY `coursekey6` (`course_code`),
  ADD KEY `yearID` (`yearID`);

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
  ADD UNIQUE KEY `assignment_uniqueness` (`programCode`,`course_code`,`level`),
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
  ADD UNIQUE KEY `reg_no` (`reg_no`,`course_code`),
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
-- Indexes for table `tbl_audit_entry`
--
ALTER TABLE `tbl_audit_entry`
  ADD PRIMARY KEY (`audit_entry_id`),
  ADD KEY `audit_entry_operation` (`audit_entry_operation`),
  ADD KEY `audit_entry_user_id` (`audit_entry_user_id`),
  ADD KEY `audit_entry_ip` (`audit_entry_ip`),
  ADD KEY `audit_entry_model_name` (`audit_entry_model_name`);

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
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `yearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `annID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `assq`
--
ALTER TABLE `assq`
  MODIFY `assq_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

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
  MODIFY `assessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `forum_answer`
--
ALTER TABLE `forum_answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_comment`
--
ALTER TABLE `forum_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_qn_tag`
--
ALTER TABLE `forum_qn_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_question`
--
ALTER TABLE `forum_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  MODIFY `freshID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `group_assignment`
--
ALTER TABLE `group_assignment`
  MODIFY `GA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `group_assignment_submit`
--
ALTER TABLE `group_assignment_submit`
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group_generation_assignment`
--
ALTER TABLE `group_generation_assignment`
  MODIFY `gga_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `group_generation_types`
--
ALTER TABLE `group_generation_types`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor_course`
--
ALTER TABLE `instructor_course`
  MODIFY `IC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `instructor_notification`
--
ALTER TABLE `instructor_notification`
  MODIFY `IN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lectureroominfo`
--
ALTER TABLE `lectureroominfo`
  MODIFY `lectureroomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `live_lecture`
--
ALTER TABLE `live_lecture`
  MODIFY `lectureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_course`
--
ALTER TABLE `program_course`
  MODIFY `PC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `q_marks`
--
ALTER TABLE `q_marks`
  MODIFY `qmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

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
  MODIFY `SC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_ext_assess`
--
ALTER TABLE `student_ext_assess`
  MODIFY `student_assess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `SG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=889;

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
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_audit_entry`
--
ALTER TABLE `tbl_audit_entry`
  MODIFY `audit_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `threadID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `forum_answer`
--
ALTER TABLE `forum_answer`
  ADD CONSTRAINT `fk_question_answer` FOREIGN KEY (`question_id`) REFERENCES `forum_question` (`question_id`),
  ADD CONSTRAINT `fk_user_answer` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD CONSTRAINT `fk_answer_comment` FOREIGN KEY (`answer_id`) REFERENCES `forum_answer` (`answer_id`),
  ADD CONSTRAINT `fk_question_comment` FOREIGN KEY (`question_id`) REFERENCES `forum_question` (`question_id`),
  ADD CONSTRAINT `fk_user_comment` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `forum_qn_tag`
--
ALTER TABLE `forum_qn_tag`
  ADD CONSTRAINT `fk_course_tag` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `fk_question_tag` FOREIGN KEY (`question_id`) REFERENCES `forum_question` (`question_id`);

--
-- Constraints for table `forum_question`
--
ALTER TABLE `forum_question`
  ADD CONSTRAINT `fk_user_qn` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
-- Constraints for table `lectureroominfo`
--
ALTER TABLE `lectureroominfo`
  ADD CONSTRAINT `lectureroominfo_ibfk_1` FOREIGN KEY (`lectureID`) REFERENCES `live_lecture` (`lectureID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `userlogkey` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `coursekey4` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey5` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `material_ibfk_2` FOREIGN KEY (`moduleID`) REFERENCES `module` (`moduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `coursekey6` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_5` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_6` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_7` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_8` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`),
  ADD CONSTRAINT `notification_ibfk_9` FOREIGN KEY (`yearID`) REFERENCES `academicyear` (`yearID`);

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
