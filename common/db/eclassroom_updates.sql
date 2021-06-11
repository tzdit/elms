-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 12:55 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclassroom`
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
  `content` varchar(255) NOT NULL,
  `ann_date` date NOT NULL,
  `ann_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `assName` varchar(10) NOT NULL,
  `assType` varchar(10) DEFAULT NULL,
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
(3, 2, 'CP 111', 'hjwef', 'individual', 'tutorial', 'hiuwrer wfbkbk', 'resubmit', '2021-06-01 00:00:00', '2021-06-03 00:00:00', 10, 'yii2.pdf'),
(4, 2, 'CP 111', 'Tutorial 1', NULL, 'tutorial', 'tutorial one', NULL, NULL, NULL, NULL, 'asa.pdf'),
(6, 2, 'CP 111', 'hhhh', 'individual', 'lab', 'ggg', 'resubmit', '2021-06-02 00:00:00', '2021-06-03 00:00:00', 10, 'AGA-OP19-geita.pdf'),
(9, 2, 'CP 111', 'twit', NULL, 'tutorial', 'twit description', NULL, NULL, NULL, NULL, 'aaa.pdf'),
(10, 2, 'CP 111', 'lab 11', 'individual', 'lab', 'lab descr', 'resubmit', '2021-06-05 00:00:00', '2021-06-12 00:00:00', 10, 'josure cv.pdf'),
(11, 2, 'CS 212', 'tut 2', NULL, 'tutorial', 'tut 2 descr', NULL, NULL, NULL, NULL, 'asa.pdf'),
(12, 2, 'CS 212', 'tut44', NULL, 'tutorial', 'tutu44', NULL, NULL, NULL, NULL, 'josure cv.pdf'),
(13, 2, 'CP 111', 'njau', 'individual', 'assignment', 'njau descr', 'resubmit', '2021-06-06 00:00:00', '2021-06-09 00:00:00', 10, 'Yii2FrameworkCMS.pdf'),
(14, 2, 'CP 111', 'two', 'individual', 'assignment', 'two descr', 'resubmit', '2021-06-07 00:00:00', '2021-06-09 00:00:00', 12, 'djangobook.pdf'),
(15, 2, 'CP 111', 'lab one', 'individual', 'lab', 'dhuj gugui', 'resubmit', '2021-06-03 00:00:00', '2021-06-01 00:00:00', 22, 'MY COVER LETTER.pdf'),
(16, 2, 'CP 111', 'hhh11', 'individual', 'assignment', 'ggddssaa', 'unresubmit', '2021-06-08 00:00:00', '2021-06-11 00:00:00', 10, 'Marking Scheme.pdf'),
(17, 2, 'CP 111', 'jsaxj jsj', 'individual', 'assignment', 'jksj jksaj jas', 'resubmit', '2021-06-08 00:00:00', '2021-06-11 00:00:00', 10, 'yii2.pdf'),
(18, 2, 'CP 111', 'ccc', 'individual', 'assignment', 'ccc ccc cc', 'unresubmit', '2021-06-08 00:00:00', '2021-06-24 00:00:00', 55, 'djangobook.pdf'),
(19, 2, 'CP 111', 'lab lab', 'individual', 'lab', 'lab lab njaui', 'resubmit', '2021-06-08 00:00:00', '2021-06-24 00:00:00', 12, 'djangobookwzy482.pdf'),
(20, 2, 'CP 111', 'ttyy', NULL, 'tutorial', 'ttyy ttyy ttyy', NULL, NULL, NULL, NULL, 'Yii2FrameworkCMS.pdf'),
(21, 2, 'CP 111', 'kiki', 'individual', 'assignment', 'kiki descr', 'resubmit', '2021-06-09 00:00:00', '2021-06-23 00:00:00', 10, 'yii2.pdf'),
(22, 2, 'CP 111', 'jiji', 'individual', 'lab', 'jiji descr', 'resubmit', '2021-06-09 00:00:00', '2021-06-16 00:00:00', 5, 'yii_tutorial.pdf'),
(23, 2, 'CP 111', 'tut 11', NULL, 'tutorial', 'tut description', NULL, NULL, NULL, NULL, 'yii_tutorial.pdf'),
(24, 2, 'CP 111', 'test lab', 'individual', 'lab', 'test lab 111', 'resubmit', '2021-06-02 00:00:00', '2021-06-15 00:00:00', 10, 'yii_tutorial.pdf'),
(25, 2, 'CP 111', 'chai tut', NULL, 'tutorial', 'chai tut descr', NULL, NULL, NULL, NULL, 'CV UPDATES BOT.pdf'),
(26, 2, 'CP 111', 'lab chai', 'individual', 'lab', 'lab chai decr', 'resubmit', '2021-06-10 00:00:00', '2021-06-24 00:00:00', 10, 'CV UPDATES BOT.pdf'),
(27, 2, 'CP 111', 'm at mat', 'individual', 'assignment', 'mat mat mat', 'resubmit', '2021-06-10 00:00:00', '2021-06-30 00:00:00', 5, 'CV UPDATES BOT.pdf'),
(28, 2, 'CP 111', 'title', 'group', 'assignment', 'title title title', 'resubmit', '2021-06-10 00:00:00', '2021-06-29 00:00:00', 7, 'CV UPDATES BOT.pdf'),
(29, 2, 'CP 111', 'hh', 'individual', 'assignment', 'jj', 'resubmit', '2021-06-01 00:00:00', '2021-06-14 00:00:00', 10, 'db_final_ER.pdf'),
(30, 2, 'CP 111', 'kjkj', 'individual', 'assignment', 'kjkjkjk', 'resubmit', '2021-06-01 00:00:00', '2021-06-15 00:00:00', 10, 'db_final_ER.pdf'),
(31, 2, 'CP 111', 'bvbvbv', 'individual', 'assignment', 'bvvbgf', 'resubmit', '2021-06-10 00:00:00', '2021-06-17 00:00:00', 10, 'db_final_ER.pdf'),
(32, 2, 'CP 111', 'manufaa', 'individual', 'assignment', 'manufaa descrf', 'resubmit', '2021-06-11 00:00:00', '2021-06-15 00:00:00', 10, 'db_final_ER.pdf'),
(33, 2, 'CP 111', 'ASS 34', 'individual', 'assignment', 'ASS 34 DESC', 'resubmit', '2021-06-11 00:00:00', '2021-06-15 00:00:00', 10, 'db_final_ER.pdf'),
(34, 2, 'CP 111', 'LAB 8', 'individual', 'lab', 'LAB 8 DESC', 'resubmit', '2021-06-10 00:00:00', '2021-06-15 00:00:00', 15, 'db_final_ER.pdf'),
(35, 2, 'CP 111', 'TUTORIAL 7', NULL, 'tutorial', 'TUTORIAL 7 DESC', NULL, NULL, NULL, NULL, 'db_final_ER.pdf');

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
  `reg_no` varchar(20) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL
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
  `course_code` varchar(7) DEFAULT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `creator_type` varchar(10) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 38, 1, 'Instructor Instructor', 'M', NULL, '0788676712', 'instructor1@gmail.com');

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
(3, 'CP 111', 2),
(5, 'CS 212', 2);

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
(1, 2, 'CP 111', 'gagag', 'Videos', NULL, NULL, 'ASSnotesTN_327.pdf'),
(2, 2, 'CP 111', 'mama', 'Videos', '0000-00-00', '00:00:02', 'asa.pdf'),
(3, 2, 'CP 111', 'assign', 'Videos', NULL, NULL, 'CV.pdf'),
(4, 2, 'CP 111', 'taratara', 'Videos', NULL, NULL, 'djangobook.pdf'),
(5, 2, 'CP 111', 'ffddd', 'Notes', NULL, NULL, 'CV UPDATES BOT.pdf'),
(6, 2, 'CP 111', 'sasasas', 'Videos', NULL, NULL, 'yii2.pdf'),
(7, 2, 'CP 111', 'test material', 'Videos', NULL, NULL, 'yii2.pdf'),
(8, 2, 'CP 111', 'NEW MATERIAL 8', 'Videos', NULL, NULL, 'db_final_ER.pdf');

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
(1, 'CP 111', 'CS1'),
(2, 'CP 123', 'CS1');

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
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('T/UDOM/2020/00001', 45, 'CS1', 'STUDENT', 'STUDENT', 'STUDENT', 'student@gmail.com', 'M', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00002', 46, 'SE1', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail2.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00003', 47, 'TE3', 'Hmiasa', 'rashidi', 'Shabani', 'student@gmail3.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00004', 48, 'TE3', 'Mwambashi', 'mwambashi', 'Shabani', 'student@gmail4.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00005', 49, 'TE3', 'sutdent20', 'mwambashi', 'Shabani', 'student@gmail5.com', 'F', NULL, 1, '2021-05-08', NULL, 'REGISTERED'),
('T/UDOM/2020/00006', 50, 'TE3', 'Zuwena', 'Rashidi', 'Mwendachik', 'student@gmail56.com', 'F', NULL, 2, '2021-05-08', NULL, 'REGISTERED');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `SC_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `course_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `SG_ID` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `score` decimal(5,2) NOT NULL,
  `submit_date` date NOT NULL,
  `submit_time` time NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(50, 'T/UDOM/2020/00006', 'U9qu2XUtMVOITbWgYOZhBH4L3OAPsd6y', '$2y$13$AH0OppbJcFbSy/23rXffROh.pNVw8CVxYKjUuyIAoNbai9ZGTMmOG', NULL, 10, 1620480285, 1620480285, 'phAwORTa2r6VWTw6k-Rd0FLyDYGXC_Xd_1620480285');

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
  ADD KEY `studk` (`reg_no`),
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
  ADD KEY `coursekey1` (`course_code`),
  ADD KEY `studkey1` (`reg_no`),
  ADD KEY `instructorkey1` (`instructorID`);

--
-- Indexes for table `group_assignment`
--
ALTER TABLE `group_assignment`
  ADD PRIMARY KEY (`GA_ID`),
  ADD KEY `gasskey` (`assID`),
  ADD KEY `gkey` (`groupID`);

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
  ADD KEY `qkey` (`assq_ID`);

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
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`SC_ID`),
  ADD KEY `cozk3` (`course_code`),
  ADD KEY `studckey2` (`reg_no`);

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
  MODIFY `annID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `assq`
--
ALTER TABLE `assq`
  MODIFY `assq_ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `assessID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  MODIFY `freshID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_assignment`
--
ALTER TABLE `group_assignment`
  MODIFY `GA_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructor_course`
--
ALTER TABLE `instructor_course`
  MODIFY `IC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `material_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_course`
--
ALTER TABLE `program_course`
  MODIFY `PC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `q_marks`
--
ALTER TABLE `q_marks`
  MODIFY `qmarkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rep_thread`
--
ALTER TABLE `rep_thread`
  MODIFY `repID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `SC_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `SG_ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `threadID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
  ADD CONSTRAINT `instr` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `studk` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fresh_thread`
--
ALTER TABLE `fresh_thread`
  ADD CONSTRAINT `threadkey3` FOREIGN KEY (`threadID`) REFERENCES `thread` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `coursekey1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructorkey1` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `studkey1` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `group_assignment`
--
ALTER TABLE `group_assignment`
  ADD CONSTRAINT `gasskey` FOREIGN KEY (`assID`) REFERENCES `assignment` (`assID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gkey` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `cozk3` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studckey2` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

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
