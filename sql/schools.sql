-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 03:29 AM
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
USE learn_and_help_db;
--

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL COMMENT 'school id',
  `name` varchar(60) NOT NULL COMMENT 'school name',
  `type` varchar(25) NOT NULL COMMENT 'school type',
  `category` varchar(10) NOT NULL COMMENT 'school category',
  `grade_level_start` tinyint(2) NOT NULL COMMENT 'starting grade level',
  `grade_level_end` tinyint(2) NOT NULL COMMENT 'ending grade level',
  `current_enrollment` smallint(11) NOT NULL COMMENT 'how many students are enrolled',
  `address_text` varchar(120) NOT NULL COMMENT 'street address',
  `state_name` varchar(40) NOT NULL COMMENT 'state name',
  `state_code` varchar(2) NOT NULL COMMENT 'state abbreviation',
  `pin_code` varchar(10) NOT NULL COMMENT 'zip code, can take hyphens',
  `contact_name` varchar(80) NOT NULL COMMENT 'library administrator',
  `contact_designation` varchar(15) NOT NULL COMMENT 'administrator''s title',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT 'administrator''s phone',
  `contact_email` varchar(60) DEFAULT NULL COMMENT 'administrator''s email',
  `status` varchar(10) NOT NULL COMMENT 'school''s status',
  `notes` text NOT NULL COMMENT 'additional notes/comments'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `schools`
  ADD CONSTRAINT CHK_type CHECK (type IN ('primary school', 'upper primary school', 'high school', 'other'));
ALTER TABLE `schools`
  ADD CONSTRAINT CHK_category CHECK (category IN ('private', 'public', 'other'));
ALTER TABLE `schools`
  ADD CONSTRAINT CHK_designation CHECK (contact_designation IN ('teacher', 'head master', 'volunteer', 'other'));
ALTER TABLE `schools`
  ADD CONSTRAINT CHK_status CHECK (status IN ('proposed', 'rejected', 'approved', 'completed'));
ALTER TABLE `schools`
  ADD CONSTRAINT CHK_start CHECK (grade_level_start > 0 AND grade_level_start < 11);
ALTER TABLE `schools`
  ADD CONSTRAINT CHK_end CHECK (grade_level_end > 0 AND grade_level_end < 11);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'school id';
COMMIT;

INSERT INTO `schools` (`name`, `type`, `category`, `grade_level_start`, `grade_level_end`, `current_enrollment`, `address_text`, `state_name`, `state_code`, `pin_code`, `contact_name`, `contact_designation`, `contact_phone`, `contact_email`, `status`, `notes`) VALUES
('School A', 'primary school', 'public', 2, 5, 2200, 'Address A', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'A@SchoolA.org', 'proposed', 'some notes'),
('School B', 'upper primary school', 'public', 6, 10, 1200, 'Address B', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'Bm@SchoolB.org', 'approved', 'some more notes'),
('School C', 'high school', 'private', 9, 10, 800, 'Address C', 'Minnesota', 'MN', '55113', 'Admissions', 'volunteer', '321-654-9984', 'C@SchoolC.org', 'approved', ''),
('School D', 'primary school', 'public', 2, 5, 2200, 'Address D', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'D@Schoola.org', 'proposed', 'some notes'),
('School E', 'upper primary school', 'public', 6, 10, 1200, 'Address E', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'E@SchoolE.org', 'approved', 'some more notes'),
('School F', 'high school', 'private', 9, 10, 800, 'Address F', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'F@SchoolF.org', 'approved', ''),
('School G', 'primary school', 'public', 2, 5, 2200, 'Address G', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'G@SchoolG.org', 'proposed', 'some notes'),
('School H', 'upper primary school', 'public', 6, 10, 1200, 'Address H', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'H@SchoolH.org', 'approved', 'some more notes'),
('School I', 'high school', 'private', 9, 10, 800, 'Address I', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'I@SchoolI.org', 'approved', ''),
('School J', 'primary school', 'public', 2, 5, 2200, 'Address J', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'J@SchoolJ.org', 'proposed', 'some notes'),
('School K', 'upper primary school', 'public', 6, 10, 1200, 'Address K', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'K@SchoolK.org', 'approved', 'some more notes'),
('School L', 'high school', 'private', 9, 10, 800, 'Address L', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'L@SchoolL.org', 'approved', ''),
('School M', 'primary school', 'public', 2, 5, 2200, 'Address M', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'M@SchoolM.org', 'proposed', 'some notes'),
('School N', 'upper primary school', 'public', 6, 10, 1200, 'Address N', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'N@SchoolN.org', 'approved', 'some more notes'),
('School O', 'high school', 'private', 9, 10, 800, 'Address O', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'O@SchoolO.org', 'approved', ''),
('School P', 'primary school', 'public', 2, 5, 2200, 'Address P', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'P@SchoolP.org', 'proposed', 'some notes'),
('School Q', 'upper primary school', 'public', 6, 10, 1200, 'Address Q', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'Q@SchoolQ.org', 'approved', 'some more notes'),
('School R', 'high school', 'private', 9, 10, 800, 'Address R', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'R@SchoolR.org', 'approved', ''),
('School S', 'primary school', 'public', 2, 5, 2200, 'Address S', 'Minnesota', 'MN', '55343', 'Registrar', 'teacher', '123-456-7890', 'S@SchoolS.org', 'proposed', 'some notes'),
('School T', 'upper primary school', 'public', 6, 10, 1200, 'Address T', 'Minnesota', 'MN', '55434', 'Administrator', 'head master', '123-454-9981', 'T@SchoolT.org', 'approved', 'some more notes'),
('School U', 'high school', 'private', 9, 10, 800, 'Address U', 'Minnesota', 'MN', '55113', 'Admissions', 'teacher', '321-654-9984', 'U@SchoolU.org', 'approved', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
