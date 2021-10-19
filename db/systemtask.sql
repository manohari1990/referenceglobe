-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 07:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemtask`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(20) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_designation` varchar(50) NOT NULL,
  `emp_dob` date DEFAULT NULL,
  `emp_doj` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `mobile` int(12) DEFAULT NULL,
  `emp_address` text DEFAULT NULL,
  `identity_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_name`, `emp_designation`, `emp_dob`, `emp_doj`, `blood_group`, `mobile`, `emp_address`, `identity_file`) VALUES
(1, 'Mohit Singh', 'Developer', '1990-06-08', '2001-07-03', 'B+', 984856230, 'Hyderabad', ''),
(2, 'Hritik Kelkar', 'Sr. Developer', '1995-06-08', '2011-07-03', 'B-', 984856230, 'Hyderabad', ''),
(3, 'Kishor Kumar', 'Software Engineer Tester', '1989-06-08', '1999-06-01', 'A+', 987432106, 'Hyderabad', ''),
(4, 'John Deo', 'HR', '1991-06-08', '2007-08-17', 'O+', 984856230, 'Hyderabad', ''),
(5, 'Meena Kumari', 'Sr. Software Engineer', '1985-06-08', '2004-10-28', 'B+', 984856230, 'Hyderabad', ''),
(6, 'Pradeep Patel', 'Accountant', '1990-06-08', '2001-11-16', 'B+', 2147483647, 'Hyderabad', ''),
(7, 'Jyoti Thakur', 'Jr. HR', '1990-01-08', '1991-07-05', 'O+', 2147483647, 'Hyderabad', ''),
(8, 'Keshav Singh', 'Jr. Developer', '1995-06-08', '2012-04-16', 'b+', 984856230, 'Hyderabad', ''),
(9, 'Ravali L', 'Jr. Developer', '1995-10-08', '2012-04-16', 'b+', 984856230, 'Hyderabad', ''),
(10, 'Megha S', 'Jr. Developer', '1993-12-12', '2012-04-16', 'b+', 984856230, 'Hyderabad', ''),
(11, 'Pooja H', 'Jr. Developer', '1996-06-08', '2012-04-16', 'b+', 984856230, 'Hyderabad', ''),
(13, 'Shyam S', 'Sr. Developer', '1997-05-28', '2018-04-16', 'b+', 984856230, 'Hyderabad...................', 'http://localhost/referenceglobe/assets/uploads/Shyam S20211018201002.pdf'),
(15, 'Keshav Singh', 'Jr. Developer', '1995-06-08', '2012-04-16', 'b+', 984856230, 'Hyderabad', ''),
(16, 'Aditya K', 'Recruiting Manager', '1988-06-08', '2001-04-16', 'b+', 984856230, 'Hyderabad', ''),
(17, 'Ashish G', 'Accountant', '1986-06-08', '2018-04-16', 'b+', 984856230, 'Hyderabad............', 'http://localhost/referenceglobe/assets/uploads/tempfile.pdf'),
(18, 'Manohari', 'Sr Software Engineer', '1990-08-06', '2019-09-12', 'B+', 2147483647, 'test', 'http://localhost/referenceglobe/assets/uploads/Manohari20211018161036.pdf'),
(19, 'fdsffg', 'dgdfg', '2021-10-06', '2021-10-13', 'b-', 2147483647, 'etsett', 'http://localhost/referenceglobe/assets/uploads/fdsffg20211018181054.pdf'),
(20, 'test', 'test', '2021-10-06', '2021-10-13', 'b+', 2147483647, 'testsett', 'http://localhost/referenceglobe/assets/uploads/test20211018191010.pdf'),
(21, 'dgdf', 'dfgdfg', '2021-10-07', '2021-10-08', 'b-', 2147483647, 'testst', 'http://localhost/referenceglobe/assets/uploads/dgdf20211019061050.jpg'),
(23, 'manohari', 'gara', '2021-09-27', '2021-10-13', 'B+', 2147483647, 'tsette', 'http://localhost/referenceglobe/assets/uploads/manohari20211019061057.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
