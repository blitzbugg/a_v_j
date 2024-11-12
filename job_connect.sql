-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 10:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `recruiter_id` int(100) NOT NULL,
  `recruiter_username` varchar(100) NOT NULL,
  `recruiter_password` varchar(100) NOT NULL,
  `recruiter_name` varchar(30) NOT NULL,
  `job_title` varchar(30) NOT NULL,
  `job_description` varchar(200) NOT NULL,
  `recruiter_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruiter`
--

INSERT INTO `recruiter` (`recruiter_id`, `recruiter_username`, `recruiter_password`, `recruiter_name`, `job_title`, `job_description`, `recruiter_contact`) VALUES
(1, 'john_doe', 'secure_password123', 'tata consultancy', 'Software Engineer', 'Responsible for developing and maintaining software applications.', 'tcs1@gmail.com'),
(2, 'mon_joe', 'secure_password223', 'wipro', 'android developer', 'Responsible for developing robust andorid applications.', 'wipro@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` (
  `seeker_id` int(100) NOT NULL,
  `seeker_username` varchar(30) NOT NULL,
  `seeker_password` varchar(100) NOT NULL,
  `seeker_name` varchar(100) NOT NULL,
  `seeker_role` varchar(100) NOT NULL,
  `seeker_skills` varchar(500) NOT NULL,
  `seeker_experience` int(70) NOT NULL,
  `seeker_description` varchar(500) NOT NULL,
  `seeker_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`seeker_id`, `seeker_username`, `seeker_password`, `seeker_name`, `seeker_role`, `seeker_skills`, `seeker_experience`, `seeker_description`, `seeker_contact`) VALUES
(1, 'jephy_jose', 'secure_password456', 'jephy_joseph', 'Python Developer', 'Django, Python, SQL', 3, 'python developer looking to build scalable applications.', 'jephy_jose@example.com'),
(2, 'alex_smith', 'secure_password789', 'Alex Smith', 'Data Analyst', 'Excel, SQL, Tableau', 2, 'Detail-oriented data analyst with a knack for turning data into actionable insights.', 'alex.smith@example.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
