-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 04:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auxilio`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`) VALUES
(2, 903058269, 'Man', 'Vadariya', 'manvadariya2@gmail.com', '12345678', '1711867928image.png'),
(3, 1096698154, 'Vansika', 'Patel', 'tinesa9557@otemdi.com', '8765432', '1711868640image2.png'),
(4, 1046986675, 'Shubham', 'Vaishnav', 'nipay78215@felibg.com', '123456', '17120618124.jpeg'),
(5, 235062389, 'aqdwnj', 'asdnj', 'gevoxe1394@kravify.com', '1234567', '17136357554.jpeg'),
(6, 613071843, 'Misva', 'Bhadja', 'misva@yahoo.com', '123', '17136801964.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(40) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `phone_no` int(12) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(400) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `business_email`, `phone_no`, `website`, `description`, `address`, `logo`, `password`) VALUES
(2, 'GOOGLE ', 'gevoxe1394@kravify.com', 1234567890, 'google.co.in', 'Big Company', 'california USA', 'images/17136839594.jpeg', '123'),
(3, 'Veda Care', 'vedacare@gmail.com', 2147483647, 'www.vedacare.com', 'adsjsjfsfjsdkjfh', 'junagadh', 'images/17136950624.jpeg', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_post` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary` int(8) NOT NULL,
  `job_description` text NOT NULL,
  `experience_required` int(2) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_post`, `location`, `salary`, `job_description`, `experience_required`, `company_id`) VALUES
(1, 'computer', 'junagadh', 5000000, 'computer eng.', 10, 0),
(2, 'post', 'nadiad', 5, 'ewfergerg', 15, 0),
(22, 'Software Engineer', 'Bengaluru', 2750000, 'We are excited to announce a job opening for the position of Software Engineer. If you\'re passionate about cutting-edge technology, solving complex problems, and working in a dynamic team, this opportunity is for you.', 4, 0),
(23, 'AI Software Engineer', 'Ahmedabad', 1250000, 'The person must maintain and involve in the software development of the existing products and Involve in the New Product developments to help the organization to innovate continuously on their products.', 2, 0),
(24, 'Senior Software Engineer (AI/ML)', 'Gandhinagar', 2500000, 'Analyze Data: Collaborate with cross-functional teams to understand data requirements and identify relevant data sources. Analyze and preprocess data to extract valuable insights and ensure data quality.', 7, 0),
(25, 'Generative AI-Software Engineer- Manager', 'Vadodara', 1450000, 'A career within Data and Analytics services will provide you with the opportunity to help organisations uncover enterprise insights and drive business results using smarter data analytics', 1, 0),
(26, 'a', 'a', 1, 'a', 1, 0),
(27, 'a', 'a', 1, 'a', 1, 3),
(28, 'a', 'a', 1, 'a', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `business_email` (`business_email`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD KEY `company_id` (`company_id`,`user_id`,`job_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `connection_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`),
  ADD CONSTRAINT `connection_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `candidate` (`user_id`),
  ADD CONSTRAINT `connection_ibfk_3` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
