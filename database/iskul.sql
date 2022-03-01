-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2017 at 12:17 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iskul`
--

-- --------------------------------------------------------

--
-- Table structure for table `iskul_attendence`
--

CREATE TABLE `iskul_attendence` (
  `id` int(15) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `byid` int(255) NOT NULL DEFAULT '0',
  `role` int(255) NOT NULL DEFAULT '0',
  `status` int(255) NOT NULL DEFAULT '1',
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_attendence`
--

INSERT INTO `iskul_attendence` (`id`, `uid`, `byid`, `role`, `status`, `varchar(255)`) VALUES
(1, 3, 1, 0, 0, '2017-02-14 00:00:00'),
(2, 5, 1, 0, 1, '2017-02-14 00:00:00'),
(3, 6, 1, 0, 1, '2017-02-14 00:00:00'),
(4, 3, 1, 0, 0, '2017-02-14 00:00:00'),
(5, 5, 1, 0, 1, '2017-02-14 00:00:00'),
(6, 6, 1, 0, 1, '2017-02-14 00:00:00'),
(7, 3, 1, 0, 0, '2017-02-14 00:00:00'),
(8, 5, 1, 0, 1, '2017-02-14 00:00:00'),
(9, 6, 1, 0, 1, '2017-02-14 00:00:00'),
(10, 3, 1, 0, 0, '2017-02-14 00:00:00'),
(11, 5, 1, 0, 1, '2017-02-14 00:00:00'),
(12, 6, 1, 0, 1, '2017-02-14 00:00:00'),
(13, 1, 1, 3, 0, '2017-02-08 00:00:00'),
(14, 8, 1, 3, 1, '2017-02-08 00:00:00'),
(15, 9, 1, 3, 1, '2017-02-08 00:00:00'),
(16, 10, 1, 3, 1, '2017-02-08 00:00:00'),
(17, 1, 1, 3, 1, '2017-02-09 00:00:00'),
(18, 8, 1, 3, 1, '2017-02-09 00:00:00'),
(19, 9, 1, 3, 1, '2017-02-09 00:00:00'),
(20, 10, 1, 3, 1, '2017-02-09 00:00:00'),
(21, 1, 1, 3, 1, '2017-02-10 00:00:00'),
(22, 8, 1, 3, 1, '2017-02-10 00:00:00'),
(23, 9, 1, 3, 1, '2017-02-10 00:00:00'),
(24, 10, 1, 3, 1, '2017-02-10 00:00:00'),
(25, 1, 1, 3, 1, '2017-02-15 00:00:00'),
(26, 8, 1, 3, 1, '2017-02-15 00:00:00'),
(27, 9, 1, 3, 1, '2017-02-15 00:00:00'),
(28, 10, 1, 3, 1, '2017-02-15 00:00:00'),
(29, 3, 1, 0, 0, '2017-02-14 00:00:00'),
(30, 5, 1, 0, 1, '2017-02-14 00:00:00'),
(31, 6, 1, 0, 1, '2017-02-14 00:00:00'),
(32, 3, 1, 0, 1, '2017-02-17 00:00:00'),
(33, 5, 1, 0, 1, '2017-02-17 00:00:00'),
(34, 6, 1, 0, 1, '2017-02-17 00:00:00'),
(35, 1, 1, 3, 1, '2017-02-17 00:00:00'),
(36, 4, 1, 3, 0, '2017-02-17 00:00:00'),
(37, 8, 1, 3, 1, '2017-02-17 00:00:00'),
(38, 10, 1, 3, 1, '2017-02-17 00:00:00'),
(39, 3, 1, 0, 1, '2017-02-22 00:00:00'),
(40, 5, 1, 0, 1, '2017-02-22 00:00:00'),
(41, 6, 1, 0, 0, '2017-02-22 00:00:00'),
(42, 3, 1, 0, 1, '2017-02-21 00:00:00'),
(43, 5, 1, 0, 1, '2017-02-21 00:00:00'),
(44, 6, 1, 0, 1, '2017-02-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_class`
--

CREATE TABLE `iskul_class` (
  `id` int(15) NOT NULL,
  `class` int(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_class`
--

INSERT INTO `iskul_class` (`id`, `class`, `name`) VALUES
(1, 1, 'One'),
(6, 2, 'Two'),
(4, 3, 'Three'),
(7, 4, 'Four'),
(8, 6, 'Six'),
(9, 5, 'Five'),
(10, 7, 'Seven'),
(11, 8, 'Eight'),
(12, 9, 'Nine'),
(13, 10, 'Ten');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_class_routine`
--

CREATE TABLE `iskul_class_routine` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(255) NOT NULL DEFAULT '0',
  `section` int(255) NOT NULL DEFAULT '0',
  `day` varchar(255) NOT NULL DEFAULT '',
  `hourstart` varchar(255) NOT NULL DEFAULT '0',
  `hourend` varchar(255) NOT NULL DEFAULT '0',
  `minutestart` varchar(255) NOT NULL DEFAULT '0',
  `minuteend` varchar(255) NOT NULL DEFAULT '0',
  `teacher` int(255) NOT NULL DEFAULT '0',
  `subject` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_class_routine`
--

INSERT INTO `iskul_class_routine` (`id`, `name`, `class`, `section`, `day`, `hourstart`, `hourend`, `minutestart`, `minuteend`, `teacher`, `subject`) VALUES
(5, '', 1, 11, 'sunday', '15', '16', '30', '00', 8, 2),
(4, '', 1, 11, 'sunday', '13', '13', '20', '55', 10, 2),
(7, '', 1, 11, 'monday', '14', '16', '50', '00', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `iskul_exam`
--

CREATE TABLE `iskul_exam` (
  `id` int(15) NOT NULL,
  `student` int(255) NOT NULL DEFAULT '0',
  `class` int(255) NOT NULL DEFAULT '0',
  `examtype` int(255) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `mark` int(255) NOT NULL DEFAULT '0',
  `passmark` int(255) NOT NULL DEFAULT '40',
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_exam_grade`
--

CREATE TABLE `iskul_exam_grade` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `numberfrom` int(255) NOT NULL DEFAULT '0',
  `numberto` int(255) NOT NULL DEFAULT '0',
  `grade` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_exam_routine`
--

CREATE TABLE `iskul_exam_routine` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(255) NOT NULL DEFAULT '0',
  `section` int(255) NOT NULL DEFAULT '0',
  `day` varchar(255) NOT NULL DEFAULT '',
  `hourstart` int(255) NOT NULL DEFAULT '0',
  `hourend` int(255) NOT NULL DEFAULT '0',
  `minutestart` int(255) NOT NULL DEFAULT '0',
  `minuteend` int(255) NOT NULL DEFAULT '0',
  `teacher` int(255) NOT NULL DEFAULT '0',
  `subject` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_exam_type`
--

CREATE TABLE `iskul_exam_type` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_exam_type`
--

INSERT INTO `iskul_exam_type` (`id`, `name`, `session`) VALUES
(1, 'First Semister', '2017-18'),
(2, 'Second Semister', '2017-18'),
(3, 'Third Semister', '2017-18'),
(4, 'Class Test', '2017-18');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_gallery`
--

CREATE TABLE `iskul_gallery` (
  `id` int(15) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `text` text,
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_gallery`
--

INSERT INTO `iskul_gallery` (`id`, `uid`, `image`, `text`, `varchar(255)`) VALUES
(1, 1, 'gallery/img6057.jpg', 'I was in Bandarban... ^_^ with friends.. They was awesome.', '2017-02-18 02:16:57'),
(2, 1, 'gallery/img5805.jpg', 'A group picture.. at. Sorno mondir,', '2017-02-18 03:07:58'),
(3, 1, 'gallery/1681102614432013290473421000139068o.png', 'bKash Payment System...', '2017-04-07 22:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_log`
--

CREATE TABLE `iskul_log` (
  `id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `log` text NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_log`
--

INSERT INTO `iskul_log` (`id`, `title`, `log`, `time`) VALUES
(1, 'Parent', 'Sajjad Hossain added a parent Hakim Khan', '2017-02-07 01:03:46'),
(2, 'Parent', '<b>Sajjad Hossain</b> edit a parent <b>Hakim Khan</b>', '2017-02-07 01:06:27'),
(3, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-07</b>', '2017-02-08 02:09:54'),
(4, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-07</b>', '2017-02-08 02:09:54'),
(5, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-07</b>', '2017-02-08 02:09:54'),
(6, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-07</b>', '2017-02-08 02:11:09'),
(7, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-07</b>', '2017-02-08 02:11:52'),
(8, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-02</b>', '2017-02-08 02:12:07'),
(9, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-02</b>', '2017-02-08 03:38:51'),
(10, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-01</b>', '2017-02-08 04:08:53'),
(11, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-02</b>', '2017-02-08 04:19:35'),
(12, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-03</b>', '2017-02-08 04:19:54'),
(13, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-02</b>', '2017-02-08 04:23:50'),
(14, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-01</b>', '2017-02-08 04:27:01'),
(15, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-01</b>', '2017-02-08 04:31:43'),
(16, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-03</b>', '2017-02-08 04:38:55'),
(17, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-02</b>', '2017-02-08 04:39:05'),
(18, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-09</b>', '2017-02-09 10:23:46'),
(19, 'Teacher Attendence', '<b>Sajjad Hossain</b> managed attendence for teachers varchar(255) <b>2017-02-08</b>', '2017-02-09 11:02:18'),
(20, 'Teacher Attendence', '<b>Sajjad Hossain</b> managed attendence for teachers varchar(255) <b>2017-02-09</b>', '2017-02-09 11:04:14'),
(21, 'Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-09</b>', '2017-02-09 12:16:50'),
(22, 'Teacher Attendence', '<b>Sajjad Hossain</b> managed attendence for teachers varchar(255) <b>2017-02-10</b>', '2017-02-10 19:55:24'),
(23, 'Parent', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-02-13 00:38:10'),
(24, 'Teacher Attendence', '<b>Sajjad Hossain</b> managed attendence for teachers varchar(255) <b>2017-02-15</b>', '2017-02-15 18:43:27'),
(25, 'Subject', '<b>Sajjad Hossain</b> edit a subject <b>English 1ST</b> to <b>English 1ST</b>', '2017-02-16 20:04:54'),
(26, 'SMS Individual', '<b>Sajjad Hossain</b> sent individual sms to <b>Nahid Sultan Tamim,Iftekhar Haider Khan Himel,Shoriful Islam Sumon,</b>', '2017-02-17 12:01:29'),
(27, 'Bulk SMS', '<b>Sajjad Hossain</b> sent bulk sms to <b></b>', '2017-02-17 12:17:39'),
(28, 'Bulk SMS', '<b>Sajjad Hossain</b> sent bulk sms to <b></b>', '2017-02-17 12:17:59'),
(29, 'Bulk SMS', '<b>Sajjad Hossain</b> sent bulk sms to <b></b>', '2017-02-17 12:30:21'),
(30, 'Bulk SMS', '<b>Sajjad Hossain</b> sent bulk sms to <b>Student</b>', '2017-02-17 12:30:49'),
(31, 'Student Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-14</b>', '2017-02-17 17:55:45'),
(32, 'Student Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-14</b>', '2017-02-17 17:58:29'),
(33, 'Student Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-17</b>', '2017-02-17 17:58:47'),
(34, 'Teacher Attendence', '<b>Sajjad Hossain</b> managed attendence for teachers varchar(255) <b>2017-02-17</b>', '2017-02-17 18:00:02'),
(35, 'Gallery Delete', '<b>Sajjad Hossain</b> deleted a gallery photo <b>#1</b>', '2017-02-18 02:13:55'),
(36, 'Gallery Delete', '<b>Sajjad Hossain</b> deleted a gallery photo <b>#2</b>', '2017-02-18 02:14:58'),
(37, 'Gallery Delete', '<b>Sajjad Hossain</b> deleted a gallery photo <b>#5</b>', '2017-02-18 02:15:10'),
(38, 'Exam Type', '<b>Sajjad Hossain</b> add exam type <b>First Semister and session 2017-18</b>', '2017-02-21 11:55:13'),
(39, 'Exam Type', '<b>Sajjad Hossain</b> add exam type <b>Second Semister and session 2017-18</b>', '2017-02-21 11:58:15'),
(40, 'Exam Type', '<b>Sajjad Hossain</b> add exam type <b>Third Semister and session 2017-18</b>', '2017-02-21 11:58:27'),
(41, 'Exam Type', '<b>Sajjad Hossain</b> add exam type <b>Class Test and session 2017-18</b>', '2017-02-21 23:47:33'),
(42, 'Student Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-22</b>', '2017-02-22 15:07:25'),
(43, 'Student Attendence', '<b>Sajjad Hossain</b> managed attendence for Class One Section A Green varchar(255) <b>2017-02-21</b>', '2017-02-22 15:12:05'),
(44, 'Parent Add', '<b>Sajjad Hossain</b> added a parent <b>Abul Bashar</b>', '2017-03-01 14:44:15'),
(45, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abul Bashar</b>', '2017-03-01 17:59:40'),
(46, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abul Bashar</b>', '2017-03-01 18:01:08'),
(47, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abul Bashar</b>', '2017-03-01 18:02:18'),
(48, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-03-01 18:04:58'),
(49, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-03-01 18:05:15'),
(50, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-03-01 18:07:59'),
(51, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-03-01 18:08:13'),
(52, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abdul Hakim Biswas</b>', '2017-03-01 18:09:39'),
(53, 'Parent Edit', '<b>Sajjad Hossain</b> edit a parent <b>Abul Bashar</b>', '2017-03-01 23:30:04'),
(54, 'Bulk SMS', '<b>Sajjad Hossain</b> sent bulk sms to <b>Teacher</b>', '2017-03-04 19:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_notice`
--

CREATE TABLE `iskul_notice` (
  `id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL,
  `description` text,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_notice`
--

INSERT INTO `iskul_notice` (`id`, `title`, `uid`, `slug`, `description`, `keywords`, `time`, `image`, `file`) VALUES
(13, 'Written-off loans: HC asks for list of companies, individuals', 1, '', 'The High Court has sought for a list of the companies, organisations and individuals whose bank loans have been written-off till December 31 last year.\r\n\r\nThe court ordered the governor of Bangladesh Bank to submit the list to it in 30 days.\r\n\r\nThe governor has also been ordered to inform the High Court in 30 days whether those companies, organisations and individuals, whose bank loans have been written off, were further given any loan, Deputy Attorney General SM Moniruzzaman told The Daily Star.\r\n\r\nHe said the HC bench of Justice Zubayer Rahman Chowdhury and Justice Md Iqbal Kabir passed the order yesterday on a suomoto (of its own) move following a report published on The Asian Age under a headline “The Tk 30,000cr vanishing trick” on February 26.\r\n\r\nThe HC also issued a rule asking the secretaries to the ministries of finance and law and BB governor to explain as to why the provisions of Bank Companies Act 1991 that empowered the central bank to exempt anybody from loan should not be declared unconstitutional, DAG Moniruzzaman added.', '', '2017-03-01 23:14:56', '/images/notice/court.jpg', '/images/notice/files/faresult.pdf'),
(8, 'Adminnsion Notice for session 2016-17', 1, '', '2016-17 admission will start from 24 January 2017 and admission will be processed till 31 January. So admission candivarchar(255) must have to apply via our website...', '', '2017-02-03 23:27:09', '', ''),
(9, 'St Hugh''s College REVISED STATUTES', 1, '', 'The Committee on Statutes before the Privy Council, acting under authority delegated to it by Council, is minded to give consent on behalf of the University to the revised statutes of St Hugh''s College, approved by the Governing Body on 21 April 2016 and 30 November 2016, in so far as such consent is required by section 7 (2) of the Universities of Oxford and Cambridge Act 1923. The consent of the committee to the amendments to the statutes will be effective 15 days after publication unless written notice of a resolution, signed by at least 20 members of Congregation, calling upon Council to withhold that consent, has been given to the Registrar by noon on 23 January.\r\n\r\nThe effects of the amendments are to simplify the statutes and bring them into line with current practice by: updating terminology and introducing a new category of fellowship; amending provisions to ensure compliance with legislation; removing obsolete provisions; allowing greater flexibility in decision-making by Governing Body. and harmonising retirement ages with the EJRA.', '', '2017-03-01 19:24:27', '/images/notice/oxford-notice.jpeg', '/images/notice/files/faresult.pdf'),
(10, 'Vehicular movement resumes after Minister Shajahan’s call', 1, '', 'After countrywide public suffering and clashes with police, Shipping Minister Shajahan Khan has urged workers to “go back to work” citing of “assurances from the government”.\r\n\r\nAnd, after the call of the minister, who is also a top transport leader, long haul buses have started faring from Dhaka’s Gabtoli – the place that was riddled with clashes earlier today.\r\n\r\nThe minister placed the call towards striking transport workers after an internal meeting of the transport leaders, which followed another inter-ministerial meeting on this issue.\r\n\r\nAt Gabtoli, Dhaka District Transport Workers’ Union Executive Member Jahangir Alam told The Daily Star that transport leaders have received instructions to resume services.\r\n\r\nThe first bus to depart from Gabtoli was SK Enterprise, which left at 3:20pm for Manikganj. The second bus of Shammi Paribahan, destined for Paturia, was calling for passengers.\r\n\r\nTransport leader calls out to ‘lift strike’\r\n\r\nMinister Shajahan Khan, also the executive president of Bangladesh Road Transport Workers Association, placed the call at a press briefing at Bangladesh Sarak Paribahan Malik Samity office in Motijheel.\r\n\r\n“Realising the reality of the transport owners and works, the two ministers have assured that they will process legally to confront the prevailing situation,” Shajahan Khan said.\r\n\r\n“I believe, country’s transportation system will become normal following our request, he added.\r\n\r\nRoad Transport and Bridges Minister Obaidul Quader and Law Minister Anisul Huq have assured me that the government will extend its support on the legal procedures, he said.\r\n\r\nThe first meeting took place at Road Transport and Bridges Ministry with its Minister Obaidul Quader Law Minister Anisul Huq, Shipping Minister Shajahan Khan, State Minister for Rural Development & Co-operatives Division Moshiur Rahman Ranga.\r\n\r\nYesterday, transport workers took their protests to a bigger scale protesting conviction of two fellow drivers and leaving commuters stranded in Dhaka and all over the country.\r\n\r\nLast night, violence ensued in Gabtoli where law enforcers and transport workers stood in a tense standoff – a heat that ensued this morning and resulted in one worker being shot.', '', '2017-03-01 19:29:53', '/images/notice/busrace.jpg', '/images/notice/files/faresult.pdf'),
(11, 'Transport worker shot in Gabtoli clash dies at DMCH', 1, '', 'A transport worker, who was shot during clashes with police at Gabtoli earlier in the day, succumbed to his injuries at Dhaka Medical College Hospital this evening.\r\n\r\nThe worker, whose identity could not be ascertained immediately, was pronounced dead around 6:30pm, said Jesmin Nahar, resident surgeon at casualty block of the DMCH.\r\n\r\nREAD MORE: Vehicular movement resumes after Minister Shajahan’s call\r\n\r\nHe sustained pellet injuries during clashes with police ensued at Gabtoli this morning centring the countrywide strike protesting conviction of two drivers.\r\n\r\nPolice used tear gas canisters and rubber bullets to take charge of the situation at the Dhaka’s entry point as the workers vandalised about a dozen vehicles there starting from 7:00am.\r\n\r\nHe was initially taken to Selina General Hospital and later shifted to DMCH in critical condition.\r\n\r\nREAD MORE: Who''s to blame for public suffering?\r\n\r\nSporadic clashes took place between the two sides. The workers pelted brickbats on the faces of the members of police and elite force Rapid Action Battalion stationed there.\r\n\r\nPolice detained about seven picketers from the spot, Bangla daily Prothom Alo reports quoting Masudur Rahman, spokesperson for Dhaka Metropolitan Police (DMP).\r\n\r\nREAD MORE: Transport strike: People’s ordeal continues\r\n\r\nMeanwhile, elsewhere in Dhaka city, inter-city public buses were scarce and commuters were left to suffer. Long haul buses remained suspended from other exit points of the city since this evening.\r\n\r\nYesterday, transport workers took their protests to a bigger scale protesting conviction of two fellow drivers and leaving commuters stranded in Dhaka and all over the country.\r\n\r\nThe death conviction of a trucker in Dhaka the day before yesterday fueled the transport workers who were already on strike in Khulna division and helped it spread countrywide.\r\n\r\nREAD MORE: SC lawyer seeks Shajahan’s termination\r\n\r\nIn Manikganj on February 22, a court awarded life for a trucker convicting him of killing eminent filmmaker Tareque Masud and media personality Mishuk Munier in a road crash.', '', '2017-03-01 23:10:19', '', '/images/notice/files/faresult.pdf'),
(12, 'Surrendered militants to be rehabilitated: PM', 1, '', 'Prime minister Sheikh Hasina today in parliament offered militants that they would be rehabilitated with legal assistance if they shun the path of militancy.\r\n\r\nIn reply to lawmakers’ queries, the premier also said preparing a time-befitting standard operating procedure (SOP) is under process to instantly combat terrorist and militant acts.\r\n\r\n“Terrorism and militancy is a threat to the country''s development and security. Derailed militants who would come back from the wrong path of militancy would be provided legal assistance with rehabilitation,” Hasina, also Leader of the House said in a scripted answer.\r\n\r\nThe premier came up with the announcement when the country few months back witnessed some brutal militant attacks and several anti militant drives carried out by the law enforcement agencies in different parts of the country.\r\n\r\nIn the scripted answer, Hasina said a significant number of militants have already surrendered to the law enforcement agencies due to gearing up of social awareness through a massive anti-militancy campaign.\r\n\r\n"Arrangements for rehabilitation with providing legal aid to the derailed militants, who would return to normal life leaving the wrong path of militancy, would be made in future.”\r\n\r\nIn this connection, she said an arrangement for rehabilitation of the militants, who have surrendered, is being made through motivation and extending cooperation.\r\n\r\nBesides, she said, a correct list for suspected missing persons and fugitive militants has been prepared.\r\n\r\nSheikh Hasina said a significant number of missing persons have already been traced and many of them returned back home.\r\n\r\n"It''s one of the anti-militancy successes of the present government," she noted.\r\n\r\nSheikh Hasina said effective measures would be taken through law enforcement agencies and intelligence agencies so that radicalization of ideology on militancy doesn''t take place among the people due to online-based campaign of the militant outfits.\r\n\r\n“A mass resistance would be put up unitedly through conducting a massive campaign against militancy together with all political organisations, religious leaders, teachers, students, guardians, intellectuals, businesspeople and professional bodies.”\r\n\r\nSaying that Bangladesh is a country of communal harmony and the people of the country hate communalism and militancy, Hasina said, "Terrorism, communalism and militancy are threats to the balanced development and security.”\r\n\r\n“The Awami League government took effective measures after coming to power following zero tolerance policy against militancy,” she said, "Bangladesh is now being considered as a role model in the world regarding curbing militancy.”\r\n\r\n"Govt takes measures to check road accidents"\r\n\r\nPrime Minister and Leader of the House Sheikh Hasina today also said the present government has taken various steps including identification of 227 black spots on the highways to check road accidents, reports BSS. \r\n\r\n"As many as 227 black spots have been identified through conducting a survey to check road accidents, and the remedial work on 27 black spots has already been completed," she said while replying to a tabled question from treasury bench member Qamrul Ashraf Khan (Narsingdi-2).\r\n\r\nThe prime minister said the remedial work on 31 black spots on Dhaka-Chittgaong Highway and 10 black spots on Dhaka-Mymensingh Highway has been finished, while the remedial work on 15 black spots on Joydevpur-Chandra-Tangail-Elenga Highway is going on, BSS adds. \r\n\r\nSheikh Hasina said a Tk 165 crore project titled "The improvement of road safety at black spots on the national highways" for the remedial work on remaining 144 black spots is underway.\r\n\r\nTk 75 crore has been allocated for the project in 2016-17 fiscal year, she said, adding the progress of the project till January 2017 was 45.59 percent.\r\n\r\nThe premier said a separate lane has been kept for slow-moving vehicles along Joydevpur-Chandra-Tangail-Elenga Highway, Elenga-Hatikamrul-Rangpur Highway and Dhaka-Padma Bridge-Bhanga Expressway to avoid road accidents. She said the feasibility study and the work on detailed design for 1,666 kilometre highway have been completed in order to upgrade the highways to four lanes including a separate lane for slow-moving vehicles.\r\n\r\nSheikh Hasina said overpasses and flyovers are being constructed at different important rail crossings and intersections under various projects.\r\n\r\nThe prime minister said steps have been taken to set up five vehicles inspection centres (VICs) in four divisional cities to give fitness certificates automatically instead of manual system so that unfit vehicles don''t ply the highways and roads, according to BSS.\r\n\r\n"Activities of such an automatic VIC have already started in Mirpur, Dhaka," she added.\r\n\r\nSheikh Hasina said the movement of "easybike", "nasiman", "kariman", "votvoty" and battery-run vehicles and rickshaws have been banned on the national and regional highways to undertake effective measures to check road accidents and build safe roads.\r\n\r\nShe said the plying of three-wheeler auto rickshaw/tempoo and all kinds of non-mechanized vehicles on 22 national highways was banned from August 1 in 2015 for the public interest.', '', '2017-03-01 23:11:42', '/images/notice/pm.jpg', '/images/notice/files/faresult.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_online_admission`
--

CREATE TABLE `iskul_online_admission` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(255) NOT NULL DEFAULT '',
  `gender` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `phonenumber` varchar(255) NOT NULL DEFAULT '',
  `parent` int(255) NOT NULL DEFAULT '0',
  `father` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `status` int(255) NOT NULL DEFAULT '0',
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approveby` int(255) NOT NULL DEFAULT '0',
  `birthday` varchar(255) NOT NULL DEFAULT '0000-00-00',
  `transactionid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_online_admission`
--

INSERT INTO `iskul_online_admission` (`id`, `name`, `username`, `email`, `password`, `avatar`, `class`, `section`, `gender`, `address`, `phonenumber`, `parent`, `father`, `mother`, `status`, `varchar(255)`, `approveby`, `birthday`, `transactionid`) VALUES
(11, 'Iftekhar Haider Khan', 'himel', 'ihmel@gmail.com', '$2y$11$qKTYJ/72MBvxOemEaF2zlu9miUt77MDef9igoSCkMV8.s8SCIwf5K', 'images/stuent/IMG6384.JPG', '9', '5', 'Male', 'Madrasha Quarter Road, Mymensingh', '01725515358', 2, 'Abdul Hakim Khan', 'Sayeda Selima Khan', 1, '2017-02-28 02:10:42', 0, '0000-00-00', '61112847392'),
(8, 'Mustafizur Rahman Babu', 'babu', 'babu@gmail.com', '$2y$11$4n0MTVrea3Bqcbb1CFXQH.jMXbx5sVB.ZoObihMY2NEx8I0tioufG', '', '1', '11', 'Male', 'Madrasha Quarter Road, Mymensingh', '01911264739', 0, 'Nazim Uddin', 'Monuara Begum', 3, '2017-02-28 01:23:28', 0, '1994-07-07', '6122819337'),
(7, 'Mahfuzur Rahman Sayem', 'sayem', 'mahfuzrsayem@gmail.com', '$2y$11$D3.n5T53CxlAvAEDts5ixed.fzbvZEWn1Bv0TcqjQMNRroQBFrGTi', '', '1', '11', 'Male', 'Madrasha Quarter Road, Mymensingh', '01911264739', 0, 'Azizur Rahman', 'Salma Begum', 1, '2017-02-28 00:57:16', 0, '1992-08-12', '6122819337'),
(12, 'Rohit Palit', 'rohit', 'rohit@plalit.com', '$2y$11$fmHtaxwOx1KhqIDoBCKht.bTDaqOatUICcjHdpRBo0H3gs8uubFfW', 'images/student/joker.jpg', '9', '12', 'Male', 'Madrasha Quarter Road, Mymensingh', '01725515358', 0, 'Rohit Shorma', 'Patil Ghosal', 0, '2017-02-28 18:14:15', 0, '0000-00-00', '6122908654'),
(13, 'Mossarrof Hossain', 'mossarof', 'mossarof@gmail.com', '$2y$11$ew8cE9g8Ca1jKrJMQsXpoeDUkmsGfw2knIIE/eYqFeg6X85sEkojK', 'images/student/excuse.jpg', '1', '11', 'Male', 'Bura Pir Majaat Mymensingh', '01754521191', 0, 'Badal Mia', 'Champa Khatun', 0, '2017-03-01 12:42:54', 0, '0000-00-00', '711242516632'),
(14, 'Mihir Ul Haque', 'mihir', 'mhiir69@gmail.com', '$2y$11$AjjqGeI3OEkx0olm8Cfdf.Rz6UBq8QnVN/GycZJw4Ox6KuDmnC9.e', 'images/student/mihir.jpg', '9', '12', 'Male', 'Kapasia, Gazipur, Dhaka', '01811263412', 0, 'Rohmot Ul Haque', 'Selina Begum', 1, '2017-03-04 03:19:29', 0, '0000-00-00', '612512635151'),
(15, 'Farhana Akter Sinthy', 'shinthy', 'sinthy@gmail.com', '$2y$11$JADtNEbcVcYco3/rz1B6IOuaNbmZVs6ohJFlEpa.0v28LGB1gMcEa', 'images/student/sinthy.jpg', '9', '12', 'Male', 'Kendua Netrokona', '01680020371', 0, 'Kr. Khairul Amin', 'Vuilla gechi', 0, '2017-03-05 17:47:21', 0, '0000-00-00', '611294751246');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_payment`
--

CREATE TABLE `iskul_payment` (
  `id` int(15) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `type` int(255) NOT NULL DEFAULT '0',
  `fee` int(255) NOT NULL DEFAULT '0',
  `paid` int(255) NOT NULL DEFAULT '0',
  `status` int(255) NOT NULL DEFAULT '0',
  `role` int(255) NOT NULL DEFAULT '0',
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_payment_fee`
--

CREATE TABLE `iskul_payment_fee` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `fee` int(255) NOT NULL DEFAULT '0',
  `type` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_payment_type`
--

CREATE TABLE `iskul_payment_type` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `role` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_section`
--

CREATE TABLE `iskul_section` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `teacher` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_section`
--

INSERT INTO `iskul_section` (`id`, `name`, `class`, `title`, `teacher`) VALUES
(11, 'A', 1, 'Green', 38),
(2, 'B', 1, 'Blue', 1),
(3, 'C', 1, 'Purple', 1),
(4, 'D', 1, 'Yellow', 10),
(5, 'A', 2, 'Green', 1),
(6, 'B', 2, 'Blue', 8),
(7, 'C', 2, 'Purpel', 8),
(8, 'D', 2, 'Yellow', 8),
(12, 'A', 9, 'Science', 1),
(13, 'B', 9, 'Commerce', 4),
(14, 'C', 9, 'Arts', 10),
(15, 'A', 5, 'শাপলা', 8),
(16, 'B', 5, 'শালুক', 10),
(17, 'C', 5, 'রজনিগন্ধা', 8),
(18, 'D', 5, 'গোলাপ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `iskul_session`
--

CREATE TABLE `iskul_session` (
  `id` int(15) NOT NULL,
  `uid` int(100) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL DEFAULT '',
  `expire` int(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_session`
--

INSERT INTO `iskul_session` (`id`, `uid`, `code`, `expire`) VALUES
(45, 1, '535510n.$2y$10$TX22deFZMhNB6DvOhAYjQOFXmcSALRASjWMpKLvZ1jMcJkRXie22m', 1494392544);

-- --------------------------------------------------------

--
-- Table structure for table `iskul_settings`
--

CREATE TABLE `iskul_settings` (
  `id` int(15) NOT NULL,
  `name` varchar(191) NOT NULL DEFAULT '',
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_settings`
--

INSERT INTO `iskul_settings` (`id`, `name`, `value`) VALUES
(1, 'siteurl', 'http://localhost'),
(2, 'sitename', 'Iskul'),
(3, 'sitetitle', 'Education Management System'),
(4, 'favicon', 'images/icon.png'),
(5, 'logo', 'images/digitalschoool.png'),
(6, 'licence', 'skhey74dh73d'),
(7, 'installed', '2017-01-27 09:12:29'),
(8, 'address', '80 Senbari Road, Mymensingh'),
(9, 'phonenumber', '+8801811525626'),
(10, 'email', 'admin@devsbangla.com'),
(11, 'paypal_email', 'sajjad.hira12@gmail.com'),
(12, 'currency', 'BDT'),
(13, 'sms_service', '1'),
(14, 'email_service', '1'),
(15, 'session', '2017-18'),
(16, 'attendence_alert', '1'),
(17, 'student_absent_message', '    Hello, your student {$studentname} absent in school {$today} From, {$sitename}'),
(18, 'site-preloader', '0'),
(19, 'online_admission', '1');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_sms`
--

CREATE TABLE `iskul_sms` (
  `id` int(15) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `toid` int(255) NOT NULL DEFAULT '0',
  `type` int(255) NOT NULL DEFAULT '0',
  `text` text,
  `status` int(255) NOT NULL DEFAULT '0',
  `varchar(255)` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_sms_settings`
--

CREATE TABLE `iskul_sms_settings` (
  `id` int(15) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `api` varchar(255) NOT NULL DEFAULT '',
  `sid` varchar(255) NOT NULL DEFAULT '',
  `auth` varchar(255) NOT NULL DEFAULT '',
  `number` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iskul_student`
--

CREATE TABLE `iskul_student` (
  `id` int(15) NOT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `classroll` int(255) NOT NULL DEFAULT '0',
  `class` int(255) NOT NULL DEFAULT '0',
  `section` int(255) NOT NULL DEFAULT '0',
  `session` varchar(255) NOT NULL DEFAULT '',
  `guideteacher` int(255) NOT NULL DEFAULT '0',
  `parent` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_student`
--

INSERT INTO `iskul_student` (`id`, `uid`, `classroll`, `class`, `section`, `session`, `guideteacher`, `parent`) VALUES
(1, 3, 2, 1, 11, '2017-18', 1, 39),
(2, 4, 1, 1, 2, '2017-18', 1, 2),
(3, 5, 8, 1, 11, '2017-18', 1, 29),
(4, 6, 10, 1, 11, '2017-18', 1, 0),
(6, 30, 21, 2, 0, '2017-18', 10, 2),
(7, 31, 17, 1, 11, '2017-18', 1, 2),
(8, 32, 62, 1, 11, '2017-18', 1, 2),
(9, 33, 88, 1, 11, '2017-18', 10, 2),
(10, 34, 98, 1, 0, '2017-18', 10, 2),
(11, 35, 81, 1, 11, '2017-18', 10, 2),
(12, 36, 89, 1, 0, '2017-18', 10, 29);

-- --------------------------------------------------------

--
-- Table structure for table `iskul_subject`
--

CREATE TABLE `iskul_subject` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(255) NOT NULL DEFAULT '0',
  `teacher` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_subject`
--

INSERT INTO `iskul_subject` (`id`, `name`, `class`, `teacher`) VALUES
(2, 'Bangla 1ST', 1, 38),
(3, 'English 1ST', 1, 38),
(4, 'Physics', 10, 8),
(5, 'ICT', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `iskul_users`
--

CREATE TABLE `iskul_users` (
  `id` int(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` char(1) NOT NULL DEFAULT '0',
  `registered` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `class` int(255) NOT NULL DEFAULT '0',
  `section` varchar(255) NOT NULL DEFAULT '',
  `status` char(2) NOT NULL DEFAULT '0',
  `phonenumber` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'images/nophoto.jpg',
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `birthday` varchar(255) DEFAULT '0000-00-00',
  `gender` varchar(6) NOT NULL DEFAULT 'Male'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_users`
--

INSERT INTO `iskul_users` (`id`, `username`, `email`, `name`, `password`, `privilege`, `registered`, `class`, `section`, `status`, `phonenumber`, `avatar`, `address1`, `address2`, `profession`, `country`, `city`, `district`, `birthday`, `gender`) VALUES
(1, 'admin', 'admin@example.com', 'Sajjad Hossain', '$2y$11$PPIIlMNqrhZGrzRqhuLWSOAHRT7Yk7MTUK/919jtKgowxtCQMpe86', '3', '2017-01-27 14:12:29', 0, '', '0', '+88018111525626', 'images/sajjad.jpg', 'Senbari Road, Mymensinh', '', '', '', '', '', '1994-09-18', 'Male'),
(2, 'hira', 'hira@example.com', 'Abdul Hakim Biswas', '$2y$11$vvqzA4pmauDHYM/LZqRF9OoQvTVv4mkwUaOzASmrlAoz7BvlCScNi', '1', '2017-01-27 14:12:29', 0, '', '0', '+8801961937231', '/images/parent/higuin.jpg', 'Senbari Road, Mymensinh', '', 'Teacher', '', '', '', '1962-08-09', 'Male'),
(3, 'tamim', 'tamimuhs@gmail.com', 'Nahid Sultan Tamim', '$2y$11$KDhLOIPTyLLyrA9RyvdLqeCFDFJlV5CxvqD4l/5uvy9fW7LRhrqUG', '0', '2017-02-03 12:13:26', 0, '', '0', '+8801671824428', '', 'Zilla School Road', '', '', '', '', '', '1994-11-21', 'Male'),
(30, 'masum', 'masumorroshid@gmail.com', 'Masum Or Roshid', '$2y$11$78m72wFFlbqKTRcazvIbO.PVjh2xPM1aS5aj0PJe1NzYcTJ51UL16', '0', '2017-03-01 01:26:31', 0, '', '0', '+8801680020371', '', 'Madrasha Quarter Road, Mymensingh', '', '', '', '', '', '2017-01-31', 'Male'),
(5, 'ihk', 'himel.ihk@gmail.com', 'Iftekhar Haider Khan Himel', '$2y$11$pl3m2oqCfZod9aDcYcFzROuIpho3iyEXtyiNVyw4VPASsBy1dg8um', '0', '2017-02-03 22:57:22', 0, '', '0', '+8801725515358', '', 'Senbari Road, Mymensingh', '', '', '', '', '', '1994-01-01', 'Male'),
(6, 'sumon', 'sumono@gmail.com', 'Shoriful Islam Sumon', '$2y$11$jU2H9azuDsuq3EmKzt8cNuv0NDVgsOw.ESHhs7Jze/wcEwi10oUua', '0', '2017-02-03 23:42:43', 0, '', '0', '+8801938541290', '', 'Tin Kona Mur, Mymensingh', '', '', '', '', '', '1994-11-23', 'Male'),
(8, 'mahfuz', 'mahfuz@gmail.com', 'HM Mahfuz', '$2y$11$guirFopkWJQ1/7N7c31kw.04CjG8eF1ucpwlbYqwSrz/BjrrTHNr6', '3', '2017-02-05 15:44:35', 0, '', '0', '+8801826462514', '', 'Kisorgonaj', '', '', '', '', '', '1988-02-01', 'Male'),
(4, 'sabuj', 'sabujr@gmail.com', 'Sabuj Raihan', '$2y$11$Qwn8WKyJlCyAKEKq3B9DseYicYvofIJtyAA/oct0HtVeSagTFrC6y', '3', '2017-02-05 15:47:37', 0, '', '0', '+8801716273819', '/images/student/me-at-sea.jpg', 'Mission School Road, Halhuaghat', '', '', '', '', '', '1982-12-23', 'Male'),
(10, 'akkas', 'akkas@gmail.com', 'Akkas Ali', '$2y$11$ani5yAhoqlTF.jo95vpxPOD1GL0jWSDTLKu9YC9D23K9jkYuFxixG', '3', '2017-02-05 15:49:50', 0, '', '0', '+8801712573829', '', 'Kachari Pukur Par, Haluaghat, Mymensingh', '', '', '', '', '', '1962-12-23', 'Male'),
(29, 'hakim', 'hakimkhan@gmail.com', 'Abdul Hakim Khan', '$2y$11$HY3k3guMxR7BB/qBcFD0XeSTgIUrKn32c8/QM/WMwdru82TmyBw5i', '1', '2017-02-07 01:03:46', 0, '', '0', '+8801712573829', '', 'Senbari Road, Mymensinh', '', 'Business', '', '', '', '1967-02-07', 'Male'),
(31, 'dipto', 'dipto@knb.com', 'Dipto Knb', '$2y$11$EC.o6n4HCVXVZJz78jPLaegWSeDhumC4Z28z77fG9PY3EHBnAEz6K', '0', '2017-03-01 01:36:32', 0, '', '0', '+8801930336172', '/images/student/barcode.png', 'Charpara Mymensingh', '', '', '', '', '', '1992-02-02', 'Male'),
(32, 'nourin', 'nourinvai@gmail.com', 'Arfina Farjin Nourin', '$2y$11$rWFvKGsk0.mX1hnhz2nWnuo.fiAf6aTSfKyp1hmYC8Ntmg4YGlfdi', '0', '2017-03-01 01:46:28', 0, '', '0', '01713464728', '', 'Goru Khuyar, Mymensingh', '', '', '', '', '', '1994-03-21', 'Male'),
(33, 'mubarrak', 'mubarrak@gmail.com', 'Mobarrak Hossain', '$2y$11$zjxTbEF.dIgsrnA3H7nTAerI8N.XhDvTzajDcTQmVpHzJcOKWrGcm', '0', '2017-03-01 01:53:02', 0, '', '0', '+8801777381345', '/images/student/mobarrak.jpg', 'Itakhola Road, Mymensingh', '', '', '', '', '', '1995-10-22', 'Male'),
(34, 'kalam', 'kalammia@gmail.com', 'Kalam Miya', '$2y$11$J7.MWK42qAdMHP8k7fn7WO6cfiMgfRHaRS6frNNdgh8Hb232afiy.', '0', '2017-03-01 12:53:33', 0, '', '0', '01723516271', '', 'Madrasha Quarter Road, Mymensingh', '', '', '', '', '', '1950-12-22', 'Male'),
(35, 'ronin', 'ronin@info.com', 'Ronin Miya', '$2y$11$0EXdoo.vEWCYxGpxuiy6FOHqG.a.vHOgbWknvTCQ2MC6MAiaQS0.y', '0', '2017-03-01 13:06:11', 0, '', '0', '01911264739', '', 'Madrasha Quarter Road, Mymensingh', '', '', '', '', '', '1992-12-02', 'Male'),
(36, 'rohit', 'rohit@gmail.com', 'Rhoit Palit', '$2y$11$pTlIXHSX5HhOodDMCxfZz.iAGXBc27iblgZFp5YV3ZOxiNAknyy8u', '0', '2017-03-01 13:31:16', 0, '', '0', '+880178863521', '/images/student/joker-origin.jpg', 'Calcauta India', '', '', '', '', '', '1999-02-12', 'Male'),
(38, 'modon', 'modon@moha.com', 'Modon Mohan Sarker', '$2y$11$jSXtrYxEvjFyWy2uxHLTBORxQYUOa6.tlQ.HChGAu//tXrULE0TTO', '3', '2017-03-01 14:30:28', 0, '', '0', '+8801833615236', '/images/teacher/modon-sir.jpg', 'Uttar Khoyrakuri, Haluaghat, Mymensingh', '', '', '', '', '', '1932-12-23', 'Male'),
(39, 'abul', 'abul@bshar.com', 'Abul Bashar', '$2y$11$nGYsNz.lKrYKXzDGCFYRzO1Et5RaH2xJQazvMcNKdE28eWweJez3m', '1', '2017-03-01 14:44:15', 0, '', '0', '+8801680024637', '/images/parent/joker-origin.jpg', 'Goforgaon, Mymensinghq', '', 'Teacher', '', '', '', '1962-12-01', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `iskul_users_role`
--

CREATE TABLE `iskul_users_role` (
  `id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `role` int(255) NOT NULL DEFAULT '0',
  `time` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iskul_users_role`
--

INSERT INTO `iskul_users_role` (`id`, `title`, `role`, `time`) VALUES
(1, 'student', 0, '0000-00-00 00:00:00'),
(2, 'parent', 1, '0000-00-00 00:00:00'),
(3, 'staff', 2, '0000-00-00 00:00:00'),
(4, 'teacher', 3, '0000-00-00 00:00:00'),
(5, 'head teacher', 4, '0000-00-00 00:00:00'),
(6, 'admin', 5, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iskul_attendence`
--
ALTER TABLE `iskul_attendence`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_class`
--
ALTER TABLE `iskul_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class` (`class`);

--
-- Indexes for table `iskul_class_routine`
--
ALTER TABLE `iskul_class_routine`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_exam`
--
ALTER TABLE `iskul_exam`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_exam_grade`
--
ALTER TABLE `iskul_exam_grade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `iskul_exam_routine`
--
ALTER TABLE `iskul_exam_routine`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_exam_type`
--
ALTER TABLE `iskul_exam_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `iskul_gallery`
--
ALTER TABLE `iskul_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iskul_log`
--
ALTER TABLE `iskul_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iskul_notice`
--
ALTER TABLE `iskul_notice`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_online_admission`
--
ALTER TABLE `iskul_online_admission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_payment`
--
ALTER TABLE `iskul_payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `iskul_payment_fee`
--
ALTER TABLE `iskul_payment_fee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `iskul_payment_type`
--
ALTER TABLE `iskul_payment_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `iskul_section`
--
ALTER TABLE `iskul_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_session`
--
ALTER TABLE `iskul_session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `iskul_settings`
--
ALTER TABLE `iskul_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`name`);

--
-- Indexes for table `iskul_sms`
--
ALTER TABLE `iskul_sms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `iskul_sms_settings`
--
ALTER TABLE `iskul_sms_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `iskul_student`
--
ALTER TABLE `iskul_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `iskul_subject`
--
ALTER TABLE `iskul_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iskul_users`
--
ALTER TABLE `iskul_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `iskul_users_role`
--
ALTER TABLE `iskul_users_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iskul_attendence`
--
ALTER TABLE `iskul_attendence`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `iskul_class`
--
ALTER TABLE `iskul_class`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `iskul_class_routine`
--
ALTER TABLE `iskul_class_routine`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `iskul_exam`
--
ALTER TABLE `iskul_exam`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_exam_grade`
--
ALTER TABLE `iskul_exam_grade`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_exam_routine`
--
ALTER TABLE `iskul_exam_routine`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_exam_type`
--
ALTER TABLE `iskul_exam_type`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `iskul_gallery`
--
ALTER TABLE `iskul_gallery`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iskul_log`
--
ALTER TABLE `iskul_log`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `iskul_notice`
--
ALTER TABLE `iskul_notice`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `iskul_online_admission`
--
ALTER TABLE `iskul_online_admission`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `iskul_payment`
--
ALTER TABLE `iskul_payment`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_payment_fee`
--
ALTER TABLE `iskul_payment_fee`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_payment_type`
--
ALTER TABLE `iskul_payment_type`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_section`
--
ALTER TABLE `iskul_section`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `iskul_session`
--
ALTER TABLE `iskul_session`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `iskul_settings`
--
ALTER TABLE `iskul_settings`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `iskul_sms`
--
ALTER TABLE `iskul_sms`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_sms_settings`
--
ALTER TABLE `iskul_sms_settings`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iskul_student`
--
ALTER TABLE `iskul_student`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `iskul_subject`
--
ALTER TABLE `iskul_subject`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `iskul_users`
--
ALTER TABLE `iskul_users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `iskul_users_role`
--
ALTER TABLE `iskul_users_role`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
