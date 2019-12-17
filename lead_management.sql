-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2019 at 02:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lead_management`
--
CREATE DATABASE IF NOT EXISTS `lead_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lead_management`;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_information`
--

CREATE TABLE `appointment_information` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `lead_id` varchar(100) NOT NULL,
  `calendar_id` varchar(200) NOT NULL,
  `event_id` varchar(200) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `demo_dealer` varchar(100) NOT NULL,
  `ride_along` varchar(100) NOT NULL,
  `set_by` varchar(100) NOT NULL,
  `appointment_address` varchar(200) NOT NULL,
  `appointment_notes` varchar(225) NOT NULL,
  `status` enum('1','0','','') NOT NULL,
  `synchronize` varchar(100) NOT NULL,
  `add_url` varchar(100) NOT NULL,
  `appointment_status` varchar(100) NOT NULL,
  `demo_notes` varchar(200) NOT NULL,
  `attendees` varchar(225) NOT NULL,
  `assistant` varchar(100) NOT NULL,
  `supervisor` varchar(100) NOT NULL,
  `sequence` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_information`
--

INSERT INTO `appointment_information` (`id`, `user_id`, `lead_id`, `calendar_id`, `event_id`, `start_date`, `start_time`, `end_time`, `demo_dealer`, `ride_along`, `set_by`, `appointment_address`, `appointment_notes`, `status`, `synchronize`, `add_url`, `appointment_status`, `demo_notes`, `attendees`, `assistant`, `supervisor`, `sequence`) VALUES
(1, '1', 'Ramya', '', 'j61ejafvaevnef75sfo75hcp5s', '2019-09-04', '11:00', '11:00', 'Ramu', 'Ravi', 'Rani', 'Washington D.C., DC, USA', ' note', '0', 'google', 'https://maps.google.com/?q=Washington D.C., DC, USA', '', '', 'ramu@gmail.com,ramya@gmail.com,', '', '', 0),
(2, '1', 'Ravi', 'indutestmail123@gmail.com', 'ue7fl1klt4dahj97i5cr2sd5s8', '2019-09-13', '03:00', '03:00', 'Raju', 'Raghu', 'Shanti', 'Ocean City, MD, USA', ' note', '1', 'google', 'https://maps.google.com/?q=Ocean City', '', '', 'ramu@gmail.com,ramya@gmail.com,', '', '', 0),
(3, '24', 'Hindu', '--', '', '2019-12-11', '10:10', '10:10', 'madhu', 'Sravani', '12', ' 20-4-470,Maruthi Nagar,Tirupati.', ' wswe', '1', 'local', 'https://maps.google.com/?q= 20-4-470,\nMaruthi Nagar,\nTirupati.\n\n', 'Rescheduled', ' wqewq', '', 'Swathi', 'Ragini', 0),
(4, '1', 'Ramya', 'indutestmail123@gmail.com', '', '2019-09-06', '19:00', '19:00', 'Ramu', 'Raghu', 'Shanti', 'Oklahoma City, OK, USA', ' note', '1', 'google', 'https://maps.google.com/?q=Oklahoma City, OK, USA', 'Rescheduled', 'note', '', 'Swathi', 'Ramya', 0),
(5, '1', 'Ravi', 'indutestmail123@gmail.com', '', '2019-09-07', '22:00', '22:00', 'Gowthami', 'Raghu', 'Raju', 'Oklahoma City, OK, USA', ' note', '1', 'google', 'https://maps.google.com/?q=Oklahoma City, OK, USA', 'Cancelled', 'note1', '', 'Swathi', 'Ramu', 0),
(6, '24', 'Raja', '--', '--', '2019-12-25', '01:01', '01:01', 'gowthami', 'Ravi', '12', ' Tirupati', ' dsf', '1', 'local', 'https://maps.google.com/?q= Tirupati', 'Rescheduled', ' sdf', '', 'Ramu', 'Ramu', 0),
(7, '3', 'Sravani', '', '3rdgu27jdrufghpspkb86kad3g', '2019-09-17', '11:00', '11:00', 'Raju', 'Ravi', 'Shanti', 'La Plata, Buenos Aires Province, Argentina', ' note', '0', 'google', 'https://maps.google.com/?q=La Plata, Buenos Aires Province, Argentina', '', '', '', '', '', 0),
(8, '3', 'Raja', 'hindukurakula@gmail.com', 'pbf9kmpoai94g0j5rdt9vm2u2c', '2019-09-18', '11:30', '11:30', 'Ramu', 'Ravi', 'Rani', 'Querétaro, Qro., Mexico', ' note', '1', 'google', 'https://maps.google.com/?q=Santiago de Querétaro', '', '', '', '', '', 0),
(9, '3', 'Raja', 'indutestmail123@gmail.com', 'k4n0huicukrgufji3ktpsqp2ls', '2019-09-25', '11:00', '11:00', 'Raju', 'Ravi', 'Raju', 'Daytona Beach, FL, USA', ' nyuf', '1', 'google', 'https://maps.google.com/?q=Daytona Beach', '', '', '', '', '', 0),
(10, '1', 'Ramya', 'indutestmail123@gmail.com', '7cljc9v0e6hti4hqb78dgiohfk', '2019-09-04', '11:00', '11:00', 'Gowthami', 'Ravi', 'Shanti', 'Indianapolis, IN, USA', ' note', '1', 'google', 'https://maps.google.com/?q=Indianapolis', '', '', '', '', '', 0),
(11, '1', 'Ravi', 'indutestmail123@gmail.com', '', '2019-09-04', '19:00', '19:00', 'Gowthami', 'Ravi', 'Raju1', 'La Plata, Buenos Aires Province, Argentina', ' note', '1', 'google', 'https://maps.google.com/?q=La Plata, Buenos Aires Province, Argentina', '', '', '', '', '', 0),
(12, '1', 'Ravi', 'indutestmail123@gmail.com', 'ru8ujdq89j4auueeusvjv9a2r4', '2019-09-04', '11:00', '11:00', 'Shekar', 'Raghu', 'Rani', 'Edmonton, AB, Canada', ' note', '1', 'google', 'https://maps.google.com/?q=Edmonton', '', '', '', '', '', 0),
(13, '1', 'Sravani', 'indutestmail123@gmail.com', 'j05isd9nmdih6p8d2eokqpitf0', '2019-09-03', '20:00', '20:00', 'Ramu', 'Raghu', 'Rani', 'Kelowna, BC, Canada', ' note', '1', 'google', 'https://maps.google.com/?q=Kelowna', '', '', '', '', '', 0),
(14, '1', 'Shekar', 'indutestmail123@gmail.com', 'r51bcuokqllp71d8e1j3j3nk1g', '2019-09-03', '11:00', '11:00', 'Ramu', 'Ravi', 'Raju', 'West Palm Beach, FL, USA', 'note', '1', 'google', 'https://maps.google.com/?q=West Palm Beach', '', '', '', '', '', 0),
(15, '3', 'Raja', 'indutestmail123@gmail.com', '', '2019-09-02', '22:00', '22:00', 'Ramu', 'Raghu', 'Shanti', 'Rio de Janeiro, State of Rio de Janeiro, Brazil', ' note', '1', 'google', 'https://maps.google.com/?q=Rio de Janeiro', 'Cancelled', 'some notes', '', 'Rani', 'Shiva', 0),
(16, '1', 'Hindu', 'indutestmail123@gmail.com', 'rsshdacfrn1dj709j42lbpp0e4', '2019-09-30', '23:00', '23:00', 'Gowthami', 'Raghu', 'Shanti', 'Edmonton, AB, Canada', ' notes', '1', 'google', 'https://maps.google.com/?q=Edmonton', 'Pending', ' demo note', '', '', '', 0),
(17, '1', 'Ramya', 'indutestmail123@gmail.com', 'uctib34v79rhejnvekt47sfuj8', '2019-09-30', '17:00', '17:00', 'Raju', 'Ravi', 'Rani', 'Rio de Janeiro, State of Rio de Janeiro, Brazil', 'Appointment with Raju and Ravi', '1', 'google', 'https://maps.google.com/?q=Rio de Janeiro', 'Pending', ' note', 'hindutestmail123@gmail.com,hinduharika@gmail.com,', '', '', 2),
(18, '1', 'Shekar', 'indutestmail123@gmail.com', 'i18jd4s74oqi7qnvpp2nldmabk', '2019-09-23', '11:00', '11:00', 'Shravani', 'Ravi', 'Shanti', 'Rosario, Santa Fe Province, Argentina', ' note', '1', 'google', 'https://maps.google.com/?q=Rosario', 'Demo', 'note', '', '', '', 0),
(19, '24', 'Raja', '--', '--', '2019-12-25', '01:01', '01:01', 'gowthami', 'Ravi', '12', ' Tirupati', ' dsf', '1', 'local', 'https://maps.google.com/?q= Tirupati', 'Rescheduled', ' sdf', '', 'Ramu', 'Ramu', 0),
(20, '1', 'Raja', 'lft59uno8vvd9pi0u9n9vlktnk@group.calendar.google.com', 'oeu5m16jkmidvo262or7j2pjjk', '2019-09-30', '12:00', '12:00', 'Swathi', 'Raghu', 'Rani', 'Albany, NY, USA', ' note', '1', 'google', 'https://maps.google.com/?q=Albany, NY, USA', 'Demo', ' note', '', '', '', 0),
(21, '1', 'Mukesh', 'indutestmail123@gmail.com', 'gqvddm4f8r2tbglunudm9kgoig', '2019-10-01', '20:00', '20:00', 'Ramu', 'Shekar', 'Raju', 'Albany, NY, USA', 'Appointment with Ramu and Shekar', '1', 'google', 'https://maps.google.com/?q=Albany, NY, USA', 'Rescheduled', ' note', '', 'Swathi', 'Ramya', 1),
(22, '1', 'Swathi', 'indutestmail123@gmail.com', 'i9c7p9pffak7b193rifkfkd30s', '2019-10-18', '11:05', '11:05', 'madhu', '', 'Raju', 'West Palm Beach, FL, USA', ' notes', '1', 'google', 'https://maps.google.com/?q=West Palm Beach, FL, USA', 'Rescheduled', ' note', '', 'Swathi', 'Ramu', 0),
(23, '24', 'Raja', '--', '--', '2019-12-25', '01:01', '01:01', 'gowthami', 'Ravi', '12', ' Tirupati', ' dsf', '1', 'local', 'https://maps.google.com/?q= Tirupati', 'Rescheduled', ' sdf', '', 'Ramu', 'Ramu', 0),
(24, '0', '', 'arzoo.rkcet@gmail.com', '6djp5k2g2ajh1us6msu41pebag', '2019-09-28', '01:00', '03:00', '', '', '', '', 'den', '1', 'google', 'https://www.google.com/calendar/event?eid=NmRqcDVrMmcyYWpoMXVzNm1zdTQxcGViYWcgYXJ6b28ucmtjZXRAbQ', 'confirmed', '', '', '', '', 0),
(63, '0', '', 'vishal.rkcet@gmail.com', 'au659e4tij8keboq40gike0qn0', '', '', '', '', '', '', '', 'vvcvvv. ABA dx.    ,  try GB o\n ', '1', 'google', 'https://www.google.com/calendar/event?eid=YXU2NTllNHRpajhrZWJvcTQwZ2lrZTBxbjAgdmlzaGFsLnJrY2V0QG0', 'confirmed', 'j,', '', '', '', 0),
(64, '0', '', 'vishal.rkcet@gmail.com', '0tssjr321mn2oe1gtp8sa86cck', '', '', '', '', '', '', '', '', '1', 'google', 'https://www.google.com/calendar/event?eid=MHRzc2pyMzIxbW4yb2UxZ3RwOHNhODZjY2sgdmlzaGFsLnJrY2V0QG0', 'confirmed', '', '', '', '', 0),
(65, '0', '', 'vishal.rkcet@gmail.com', '3pbprcgulahnbuict66h3cl017', '2019-09-28', '12:30', '18:45', '', '', '', 'Balaji Hall, Padmi Society, Mavdi, Rajkot, Gujarat 360004, India', 'vishal meeting', '1', 'google', 'https://www.google.com/calendar/event?eid=M3BicHJjZ3VsYWhuYnVpY3Q2NmgzY2wwMTcgdmlzaGFsLnJrY2V0QG0', 'confirmed', 'hi vishu', ',arzoo.rkcet@gmail.com,vishal.rkcet@gmail.com', '', '', 1),
(66, '0', '', 'vishal.rkcet@gmail.com', '7vp5uqc2q9pfcf3lsqbmdmdlg6', '2019-09-27', '10:00', '11:00', '', '', '', '', 'Demo sms-vja', '1', 'google', 'https://www.google.com/calendar/event?eid=N3ZwNXVxYzJxOXBmY2YzbHNxYm1kbWRsZzYgdmlzaGFsLnJrY2V0QG0', 'confirmed', '', '', '', '', 0),
(67, '0', '', 'vishal.rkcet@gmail.com', '45hkp7ee6ms8tbel3d4dhef3fi', '2019-09-28', '20:30', '21:30', '', '', '', '', 'abcdef', '1', 'google', 'https://www.google.com/calendar/event?eid=NDVoa3A3ZWU2bXM4dGJlbDNkNGRoZWYzZmkgdmlzaGFsLnJrY2V0QG0', 'confirmed', '', '', '', '', 0),
(68, '0', '', 'arzoo.rkcet@gmail.com', '7o48c52fccncu53v9m6d25g7m9', '2019-09-29', '14:30', '19:00', '', '', '', '', 'Meeting with Martyn', '1', 'google', 'https://www.google.com/calendar/event?eid=N280OGM1MmZjY25jdTUzdjltNmQyNWc3bTkgYXJ6b28ucmtjZXRAbQ', 'confirmed', '', '', '', '', 0),
(69, '24', 'Raja', '--', '----', '2019-12-25', '01:01', '01:01', 'gowthami', 'Ravi', '12', ' Tirupati', ' dsf', '1', 'local', 'https://maps.google.com/?q= Tirupati', 'Rescheduled', ' sdf', '', 'Ramu', 'Ramu', 0),
(70, '24', 'Ravi', '--', '-----', '2019-12-17', '15:15', '15:15', 'sanju', 'Raja', '12', ' Tirupati', ' dsfdsfds', '1', 'local', 'https://maps.google.com/?q= Tirupati', 'Demo', ' sds', '', 'Ramya', 'Ramu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(11) NOT NULL,
  `category_type` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `category_type`, `status`, `user_id`, `created_at`) VALUES
(1, 'category 11', 0, 24, '2019-12-14 12:38:21'),
(2, 'Category 2', 0, 24, '2019-12-14 12:38:13'),
(3, 'category 3', 1, 24, '2019-12-14 11:43:24'),
(4, 'category 5', 1, 24, '2019-12-14 11:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `lead_line` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`id`, `account_id`, `contact_name`, `designation`, `email_id`, `mobile_no`, `lead_line`, `status`) VALUES
(4, 2, 'asdas', 'asdsa', 'abcd@gmail.com', '123456789', '121212', 1),
(7, 4, 'as', 'manager', 'abcd@gmail.com', '123456789', '123213', 1),
(8, 5, 'sagar', 'manager', 'abcd@gmail.com', '123456782', '12', 1),
(9, 6, 'rakesh', '12', 'abcd@gmail.com', '123456789', '121', 1),
(10, 7, '121', '12', 'abcd@gmail.com', '123456782', '212', 1),
(11, 7, '12', 'manager', 'abcd@gmail.com', '123456789', '121121', 1),
(12, 8, 'qww', 'qw', 'qw@gmial.com', '123456781', '1232132', 1),
(13, 8, 'rakesh', '12', 'abcd@gmail.com', '123456789', '1212', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`id`, `customer_type`, `status`, `user_id`, `created_at`) VALUES
(1, 'customer1', 0, 24, '2019-12-14 12:55:07'),
(2, 'customer21', 1, 24, '2019-12-14 13:07:24'),
(3, 'customer1', 1, 24, '2019-12-14 13:01:02'),
(4, 'customer3', 1, 24, '2019-12-14 13:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_creation`
--

CREATE TABLE `dealer_creation` (
  `id` int(200) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `dealer_id` int(200) NOT NULL,
  `d_first_name` varchar(200) NOT NULL,
  `d_last_name` varchar(200) NOT NULL,
  `d_email` varchar(200) NOT NULL,
  `d_phone_num` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `d_region` varchar(200) NOT NULL,
  `d_region_type` varchar(200) NOT NULL,
  `d_address` varchar(250) NOT NULL,
  `status` enum('1','0','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer_creation`
--

INSERT INTO `dealer_creation` (`id`, `user_id`, `dealer_id`, `d_first_name`, `d_last_name`, `d_email`, `d_phone_num`, `company_name`, `d_region`, `d_region_type`, `d_address`, `status`) VALUES
(1, '1', 1001, 'Ramu', 'M', 'ramu@gmail.com', '9876544333', 'Company1', 'reg,region,ox', 'county', ' Tirupati.', '1'),
(3, '1', 1002, 'Raju', 'L', 'raju@gmail.com', '9879879870', 'company1', 'region,region1,region2', 'country', ' Chennai', '1'),
(4, '1', 1004, 'Gowthami', 'G', 'gowthami@gmail.com', '1238766893', 'company5', 'reg,hamster', 'zip', ' Tirupati', '1'),
(5, '3', 10004, 'Shekar', 'L', 'shekar@gmail.com', '3413414314', 'company1', 're,hamster', 'city', ' Tirupati', '1'),
(6, '3', 1007, 'Shravani', 'L', 'shravani@gmail.com', '4525425235', 'company8', 'lk,df', 'county', ' Tirupati', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lead_info`
--

CREATE TABLE `lead_info` (
  `id` int(50) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `martial_status` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `user_job` varchar(100) NOT NULL,
  `user_office_branchname` varchar(100) NOT NULL,
  `lead_date` varchar(100) NOT NULL,
  `lead_type` varchar(100) NOT NULL,
  `lead_source` varchar(150) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `lead_dealer` varchar(100) NOT NULL,
  `lead_status` varchar(100) NOT NULL,
  `lead_note` varchar(225) NOT NULL,
  `status` enum('1','0','','') NOT NULL,
  `spouse_first_name` varchar(200) NOT NULL,
  `spouse_last_name` varchar(200) NOT NULL,
  `spouse_email` varchar(50) NOT NULL,
  `spouse_phone` varchar(10) NOT NULL,
  `spouse_job` varchar(100) NOT NULL,
  `spouse_age` varchar(10) NOT NULL,
  `sec_fname` varchar(100) NOT NULL,
  `sec_lname` varchar(100) NOT NULL,
  `sec_email` varchar(100) NOT NULL,
  `sec_phone` varchar(100) NOT NULL,
  `sec_job` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_info`
--

INSERT INTO `lead_info` (`id`, `user_id`, `first_name`, `last_name`, `gender`, `martial_status`, `email`, `mobile`, `user_address`, `residence`, `user_job`, `user_office_branchname`, `lead_date`, `lead_type`, `lead_source`, `relation`, `lead_dealer`, `lead_status`, `lead_note`, `status`, `spouse_first_name`, `spouse_last_name`, `spouse_email`, `spouse_phone`, `spouse_job`, `spouse_age`, `sec_fname`, `sec_lname`, `sec_email`, `sec_phone`, `sec_job`) VALUES
(1, '1', 'Hindu', 'K', 'Female', 'Unmarried', 'hindu@gmail.com', '9876543287', ' 20-4-470,\nMaruthi Nagar,\nTirupati.\n\n', 'Near', 'IT', 'Main', '2019-09-20', 'Public Exhibit', ' Public_Source3', 'Cousin', 'madhu', 'processed', 'Note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(2, '1', 'Ramya', 'R', 'Female', 'Married', 'ramya@gmail.com', '4523452345', ' Tirupati', 'Near By', 'IT ', 'Sub Branch', '2019-09-03', 'Owner', 'source3', 'Father', 'madhu', 'unprocessed', 'Note1', '1', '', '', '', '', '', '', '', '', '', '', ''),
(3, '1', 'Ravi', 'L', 'Male', 'Married', 'ravi@gmail.com', '3567678890', ' Tirupati', 'Near By', 'IT', 'Branch1', '2019-09-13', 'Personal', 'Personal_Source4', 'Brother', 'sanju', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(4, '3', 'Raja', 'R', 'Male', 'Married', 'raja@gmail.com', '4523542323', ' Tirupati', 'Residence', 'IT', 'Main', '2019-09-13', 'Public Exhibit', 'Public_Source2', 'Father', 'gowthami', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(5, '3', 'Sravani', 'S', 'Female', 'Unmarried', 'sravani@gmail.com', '4252345235', ' Tirupati', 'Near By', 'IT', 'Branch1', '2019-09-11', 'Target Marketing', 'Marketing_Source2', 'Father', 'sanju', 'processed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(6, '3', 'Shekar', 'S', 'Male', 'Unmarried', 'shekar@gmail.com', '4525422345', ' Tirupati', 'Near', 'IT', 'Branch4', '2019-09-19', 'Target Marketing', 'Marketing_Source2', 'Son', 'sanju', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(7, '1', 'Rani', 'K', 'Female', 'Unmarried', 'rani@gmail.com', '4523523523', ' Tirupati', 'Near', 'IT', 'Main', '2019-09-11', 'Target Marketing', 'Marketing_Source1', 'Father', 'Dealer2', 'processed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(8, '1', 'Gowthami', 'G', 'Female', 'Unmarried', 'gowthami@gmail.com', '3423123422', ' Tirupati', 'Near', 'job', 'branch', '2019-09-13', 'Owner', 'source3', 'Neighbour', 'madhu', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(9, '1', 'Mukesh', 'N', 'Male', 'Unmarried', 'mukesh@gmail.com', '4325234522', 'Albany, NY, USA', 'Near', 'IT', 'Branch', '2019-09-18', 'Owner', 'Ravi', 'Father', 'Ramu', 'processed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(10, '1', 'Vani', 'L', 'Female', 'Married', 'vani@gmail.com', '7879987323', 'Myrtle Beach, SC, USA', 'near', 'IT', 'branch2', '2019-10-02', 'Future Owner', 'Future_owner_source2', 'Father', 'Dealer2', 'processed', 'note', '1', 'Ramesh', 'R', 'ramesh@gmail.com', '4352334553', 'Officer', '34', '', '', '', '', ''),
(11, '1', 'Rajesh', 'P', 'Male', 'Unmarried', 'rajesh@gmail.com', '3425234523', 'La Plata, Buenos Aires Province, Argentina', 'ownhouse', 'Engineer', 'branch3', '2019-09-17', 'Public Exhibit', 'Public_Source1', 'Neighbour', 'ram raj', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(12, '1', 'Vani', 'k', 'Female', 'Unmarried', 'vani123@gmail.com', '4352342342', 'Fuengirola, Spain', 'near', 'IT', 'branch2', '2019-09-19', 'Owner', 'source3', 'Neighbour', 'madhu', 'unprocessed', 'note', '1', '', '', '', '', '', '', 'Ram', 'R', 'ram@gmail.com', '4352454332', 'IT'),
(13, '1', 'Ramya', 'P', 'Female', 'Married', 'ramya@gmail.com', '3423234335', 'Estes Park, CO, USA', 'near', 'IT', 'branch2', '2019-09-11', 'Owner', 'source1', 'Brother', 'ram raj', 'processed', 'note', '1', 'Ramesh', 'R', 'ramesh@gmail.com', '3243234534', 'Officer', '34', 'Ram', 'R', 'ram@gmail.com', '4534534535', 'IT'),
(14, '1', 'Swathi', 'L', 'Female', 'Married', 'swathi@gmail.com', '3543534554', 'West Palm Beach, FL, USA', 'near', 'IT', 'branch2', '2019-09-11', 'Public Exhibit', '	 Public_Source3', 'Son', 'madhu', 'unprocessed', 'note', '1', 'Ramesh', 'R', 'ramesh@gmail.com', '3232234324', 'Officer', '34', '', '', '', '', ''),
(15, '1', 'Dileep', 'K', 'Male', 'Unmarried', 'dileep@gmail.com', '2352354254', 'Udaipur, Rajasthan, India', 'Near', 'IT ', 'Main', '2019-09-11', 'Future Owner', 'Future_owner_source2', 'Brother', 'Dealer2', 'unprocessed', 'note', '1', '', '', '', '', '', '', '', '', '', '', ''),
(16, '24', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2019-12-11', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `lead_type`
--

CREATE TABLE `lead_type` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `lead_type` varchar(100) NOT NULL,
  `status` enum('1','0','','') NOT NULL,
  `lead_source` varchar(200) NOT NULL,
  `lead_dealer` varchar(100) NOT NULL,
  `sub_lead` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_type`
--

INSERT INTO `lead_type` (`id`, `user_id`, `lead_type`, `status`, `lead_source`, `lead_dealer`, `sub_lead`) VALUES
(1, '1', 'Public Exhibit', '1', '	 Public_Source3', 'madhu', ''),
(2, '1', 'Target Marketing', '0', '	 Marketing_Source2', 'Dealer1', ''),
(5, '1', 'Owner', '1', 'source3', 'madhu', 'YES'),
(6, '1', 'Future Owner', '1', 'Future_owner_source2', 'Dealer2', ''),
(7, '1', 'Personal', '1', 'Personal_Source1', 'madhu', ''),
(8, '1', 'Survey', '1', 'Survey_Source3', 'Dealer1', ''),
(15, '3', 'Owner', '1', 'source1', 'ram raj', 'YES'),
(16, '3', 'Owner', '1', 'Owner_Source1', 'Dealer1', 'YES'),
(17, '1', 'Owner', '1', 'Owner_Source2', 'madhu', 'YES'),
(18, '3', 'Survey', '1', 'Survey_Source1', 'Dealer2', ''),
(19, '1', 'Survey', '1', 'Survey_Source2', 'sanju', ''),
(20, '3', 'Public Exhibit', '1', 'Public_Source1', 'ram raj', ''),
(21, '1', 'Public Exhibit', '1', 'Public_Source2', 'gowthami', ''),
(22, '1', 'Future Owner', '1', 'Future_owner_source1', 'madhu', ''),
(23, '3', 'Target Marketing', '1', 'Marketing_Source1', 'Dealer2', ''),
(24, '1', 'Target Marketing', '1', 'Marketing_Source2', 'sanju', ''),
(25, '3', 'Personal', '1', 'Personal_Source3', 'Dealer3', 'YES'),
(26, '1', 'Personal', '1', 'Personal_Source4', 'sanju', 'YES'),
(28, '3', 'Owner', '1', 'Source8', 'Shravani', 'YES'),
(30, '1', 'Owner', '1', 'Sravani', 'Swathi', 'YES'),
(31, '1', 'Owner', '1', 'Ravi', 'Ramu', 'YES'),
(32, '1', 'Survey', '1', 'ram', 'ramya', 'sub lead'),
(33, '1', 'Survey', '1', 'Ramya Swathi', 'Raghu Ram', 'sub lead'),
(34, '24', 'Vishal', '1', 'Vishal', 'Vishal', 'Vishal'),
(35, '24', 'c', '1', '', '', ''),
(36, '24', '', '1', '', '', ''),
(37, '24', '', '1', '', '', ''),
(38, '24', '', '1', '', '', ''),
(39, '24', '', '1', '', '', ''),
(40, '24', '', '1', '', '', ''),
(41, '24', '', '1', '', '', ''),
(42, '24', '', '1', '', '', ''),
(43, '24', '', '1', '', '', ''),
(44, '24', '', '1', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `new_account`
--

CREATE TABLE `new_account` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `no_of_employee` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_account`
--

INSERT INTO `new_account` (`id`, `date`, `category_id`, `customer_name`, `no_of_employee`, `customer_type`, `requirement`, `remark`, `created_at`, `user_id`, `status`) VALUES
(2, '2019-12-19', 4, 'sdagaqwq', 45, 4, 'sads', 'sdfds', '2019-12-16 09:38:16', 24, 1),
(3, '2019-12-06', 3, 'abcd', 12, 2, 'sdfsd', 'dsf', '2019-12-17 08:50:23', 24, 0),
(4, '2019-12-13', 3, 'abcd12', 12, 2, 'sdaf', 'dsf', '2019-12-16 09:44:13', 24, 1),
(5, '2019-12-25', 4, 'rakesh dfgdg', 21, 0, '', '', '2019-12-16 11:44:35', 24, 1),
(6, '2019-12-05', 3, 'rakesh dfgdg12', 12, 2, 'sad', 'asd', '2019-12-16 11:53:38', 24, 1),
(7, '2019-12-04', 3, 'asda', 12, 2, 'wse', 'sds', '2019-12-16 11:56:29', 24, 1),
(8, '2019-12-04', 3, '121', 12, 2, 'sda', 'sad', '2019-12-16 12:17:21', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_subscription`
--

CREATE TABLE `notification_subscription` (
  `subscription_id` int(11) NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` int(12) NOT NULL,
  `valid_till` int(12) NOT NULL,
  `channel_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_subscription`
--

INSERT INTO `notification_subscription` (`subscription_id`, `user_id`, `valid_from`, `valid_till`, `channel_name`, `add_date`) VALUES
(1, 'arzoo.rkcet@gmail.com', 0, 0, '1569500312', '2019-09-26 12:18:34'),
(2, 'arzoo.rkcet@gmail.com', 1569500799, 1570105599, '1569500799', '2019-09-26 12:26:42'),
(3, 'arzoo.rkcet@gmail.com', 1569501588, 1570106388, '1569501588', '2019-09-26 12:39:53'),
(4, 'vishal.rkcet@gmail.com', 1569513051, 1570117851, '1569513051', '2019-09-26 15:50:56'),
(5, 'vishal.rkcet@gmail.com', 1576243086, 1576847886, '1576243086', '2019-12-13 13:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `page_access`
--

CREATE TABLE `page_access` (
  `id` int(100) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_access`
--

INSERT INTO `page_access` (`id`, `user_type`, `permissions`) VALUES
(0, 'Admin', 'a:18:{i:0;s:10:\"createLead\";i:1;s:8:\"editLead\";i:2;s:10:\"deleteLead\";i:3;s:17:\"createAppointment\";i:4;s:15:\"editAppointment\";i:5;s:17:\"deleteAppointment\";i:6;s:14:\"createLeadType\";i:7;s:12:\"editLeadType\";i:8;s:14:\"deleteLeadType\";i:9;s:10:\"createUser\";i:10;s:8:\"editUser\";i:11;s:10:\"deleteUser\";i:12;s:18:\"createRelationship\";i:13;s:16:\"editRelationship\";i:14;s:18:\"deleteRelationship\";i:15;s:17:\"createPermissions\";i:16;s:15:\"editPermissions\";i:17;s:17:\"deletePermissions\";}'),
(13, 'SalesRepresentative', 'a:10:{i:0;s:10:\"createLead\";i:1;s:10:\"deleteLead\";i:2;s:17:\"createAppointment\";i:3;s:15:\"editAppointment\";i:4;s:14:\"createLeadType\";i:5;s:12:\"editLeadType\";i:6;s:14:\"deleteLeadType\";i:7;s:10:\"createUser\";i:8;s:12:\"createDealer\";i:9;s:10:\"editDealer\";}'),
(14, 'Secretary', 'a:7:{i:0;s:15:\"editAppointment\";i:1;s:12:\"editLeadType\";i:2;s:14:\"deleteLeadType\";i:3;s:8:\"editUser\";i:4;s:12:\"createDealer\";i:5;s:10:\"editDealer\";i:6;s:12:\"deleteDealer\";}');

-- --------------------------------------------------------

--
-- Table structure for table `page_names`
--

CREATE TABLE `page_names` (
  `id` int(200) NOT NULL,
  `page_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_names`
--

INSERT INTO `page_names` (`id`, `page_name`) VALUES
(1, 'Lead'),
(2, 'Appointment'),
(3, 'LeadType'),
(4, 'User'),
(5, 'Relationship'),
(6, 'Permissions'),
(7, 'CustomerType'),
(8, 'CategoryType');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit_transfor_price` decimal(10,2) NOT NULL,
  `transfor_tax` decimal(10,2) NOT NULL,
  `unit_order_value` decimal(10,2) NOT NULL,
  `order_value_tax` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`id`, `product_name`, `unit_transfor_price`, `transfor_tax`, `unit_order_value`, `order_value_tax`, `status`, `create_at`, `user_id`) VALUES
(1, 'product 1', '100.00', '10.00', '80.00', '5.00', 1, '2019-12-17 04:43:12', 1),
(2, 'product 2', '15.00', '10.00', '20.00', '10.00', 1, '2019-12-17 04:43:12', 2),
(3, 'product 3', '100.00', '5.00', '150.00', '5.00', 1, '2019-12-17 10:47:38', 0),
(4, 'p4', '150.00', '1.00', '100.00', '1.00', 1, '2019-12-17 11:42:47', 0),
(5, 'new product', '10.00', '3.00', '15.00', '2.00', 1, '2019-12-17 12:36:14', 0),
(6, 'new ', '45.00', '5.00', '30.00', '5.00', 1, '2019-12-17 12:40:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_detalis`
--

CREATE TABLE `quotation_detalis` (
  `id` int(11) NOT NULL,
  `quatation_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_transfor_price` decimal(10,2) NOT NULL,
  `transfor_tax` decimal(10,2) NOT NULL,
  `unit_order_value` decimal(10,2) NOT NULL,
  `order_tax` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `version` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation_detalis`
--

INSERT INTO `quotation_detalis` (`id`, `quatation_id`, `product_name`, `qty`, `unit_transfor_price`, `transfor_tax`, `unit_order_value`, `order_tax`, `status`, `version`) VALUES
(1, 1, 'product 3', 1, '100.00', '5.00', '150.00', '5.00', 1, '1'),
(2, 1, 'p4', 5, '150.00', '1.00', '100.00', '1.00', 1, '1'),
(3, 1, 'new product', 5, '10.00', '3.00', '15.00', '2.00', 1, '1'),
(4, 1, 'product 3', 1, '100.00', '5.00', '150.00', '5.00', 1, '2'),
(5, 1, 'p4', 5, '150.00', '1.00', '100.00', '1.00', 1, '2'),
(6, 1, 'new ', 5, '45.00', '5.00', '30.00', '5.00', 1, '2'),
(7, 1, 'product 3', 1, '100.00', '5.00', '150.00', '5.00', 1, '3'),
(8, 1, 'p4', 5, '150.00', '1.00', '100.00', '1.00', 1, '3'),
(9, 1, 'new ', 5, '45.00', '5.00', '30.00', '5.00', 1, '3'),
(10, 2, 'product 2', 1, '15.00', '10.00', '20.00', '10.00', 1, '1'),
(11, 2, 'product 3', 1, '100.00', '5.00', '150.00', '5.00', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_master`
--

CREATE TABLE `quotation_master` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `quotaion_no` varchar(30) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `ref_number` varchar(30) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `order_date` date NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `order_due_date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `total_order_value` decimal(10,2) NOT NULL,
  `total_trasfor_price` decimal(10,2) NOT NULL,
  `less_input_tax` decimal(10,2) NOT NULL,
  `less_trasportion` decimal(10,2) NOT NULL,
  `less_bg` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `less_others` decimal(10,2) NOT NULL,
  `margin` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation_master`
--

INSERT INTO `quotation_master` (`id`, `customer_name`, `quotaion_no`, `contact_person`, `ref_number`, `mobile_no`, `order_date`, `email_id`, `order_due_date`, `description`, `total_order_value`, `total_trasfor_price`, `less_input_tax`, `less_trasportion`, `less_bg`, `status`, `user_id`, `create_at`, `less_others`, `margin`) VALUES
(1, 'abcd12', '12', 'as', '150', '123456789', '2020-12-09', 'abcd@gmail.com', '2019-12-19', 'sadsdsa', '800.00', '1075.00', '5.00', '5.00', '3.00', 1, 24, '2019-12-17 12:40:20', '2.00', '-290.00'),
(2, 'rakesh dfgdg12', 'quote123', 'rakesh', 'abcd123', '123456789', '2019-12-05', 'abcd@gmail.com', '2019-12-20', 'sdfsadf', '170.00', '115.00', '5.00', '45.00', '3.00', 0, 24, '2019-12-17 13:03:35', '5.00', '-3.00');

-- --------------------------------------------------------

--
-- Table structure for table `refresh_token`
--

CREATE TABLE `refresh_token` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `refresh_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refresh_token`
--

INSERT INTO `refresh_token` (`id`, `user_id`, `refresh_token`) VALUES
(1, 'indutestmail123@gmail.com', '1/1DXaaIq_2XoCkaqFkKZevoiX1LR3ao8zF_psyGi09F4'),
(2, 'indutestmail123@gmail.com', ''),
(3, 'indutestmail123@gmail.com', '1/xIVo3Q0OYcfHUT-e-r4gLrF4JqTaIf_WbLz7d6rJV3I'),
(4, 'indutestmail123@gmail.com', ''),
(5, 'indutestmail123@gmail.com', ''),
(6, 'indutestmail123@gmail.com', ''),
(7, 'indutestmail123@gmail.com', ''),
(8, 'indutestmail123@gmail.com', ''),
(9, 'indutestmail123@gmail.com', '1/FbSfvwwHbau-nvt2BEUBo-dToiYmnOKhfcjtWF4taZdFsyJxcR3IGdXNNhYaY6SG'),
(10, 'indutestmail123@gmail.com', '1//0e7TGBVBlwVG2CgYIARAAGA4SNwF-L9IrTdhxuh3f88eAqzTOuFS_rMtGbuzu3uVtZecpdsDGf2ESx1pRSOM4cFF8iByE3wQf'),
(11, 'indutestmail123@gmail.com', '1/ztSJYPtD2A21RqCxYiKZnevpr5hjQVk_pBFxOlC3yuPVzECyKH0C-Vfh6EkuEF2P'),
(12, 'indutestmail123@gmail.com', '1/Uk4vO71HeE5cDv3wP2MQVHWDsLg_FrI7kHtljM_pOk9BWcPga6FuO9kjtB95EAt3'),
(13, 'indutestmail123@gmail.com', '1/Um1J9UDga9KVjvKfAlLh9oGtoK_SHzcFlFQPQwLPyEQ'),
(14, 'indutestmail123@gmail.com', ''),
(15, 'indutestmail123@gmail.com', '1/hGP7TSaVDJj8W7WpNN7KxrZ8eDtQ41DYKDpwR5U-b80'),
(16, 'indutestmail123@gmail.com', ''),
(17, 'indutestmail123@gmail.com', '1/SU2a7JOc2KK86bsykRL4HTsvGeF87Edx8O9txSY4yU6Bd6BDLiAfxEFy4Rzxw8ws'),
(18, 'indutestmail123@gmail.com', '1/M-uD3iGgpTME4gE8oJVDsUzAqprU9CoLVn7Sz5s7zhc'),
(19, 'indutestmail123@gmail.com', '1/RZ30TbSu8_Gy3lAdFzWN15vYgXfBhJqyHp7GeG8nKP4'),
(20, 'indutestmail123@gmail.com', '1/QB8SlkQvtQ4mgVm4Y-DLMukB2NRoj3lgVRWHEc49m4c'),
(21, 'indutestmail123@gmail.com', '1/stKpphRmBnBu9xRt_ooIBeRYM7HmHPKcHim49OF11dU'),
(22, 'indutestmail123@gmail.com', '1/oNn-6xvZSFVRWystaA_olxvO05soR_6iyQKQy2wfv78'),
(23, 'indutestmail123@gmail.com', '1/M0LxJHsL6ybKeo371pl6mxqAPrbixtKPgpyk8tOkWYc'),
(24, 'indutestmail123@gmail.com', '1/_qU9CjetEux4fZE2DjH_hyTxdN0oCIlDMpGLJuphKgs'),
(25, 'indutestmail123@gmail.com', '1/xGcBJnVX_R6DSV83s1DLVYJsr_4GkT26IzcD1cYlpG0'),
(26, 'indutestmail123@gmail.com', '1/rehpzkvapkqa2lPP20jZMoRd2TPJMiLL33gq7cSc3ZA'),
(27, 'indutestmail123@gmail.com', '1/MxL4IgXRjZVM78V2DDgSLfMzUp5bgHw6fF21QPzy0uY'),
(28, 'indutestmail123@gmail.com', '1/DQjaLlPBQi9DD_9BTWDY4BpRhxkr0KzRhotzqTESCcI'),
(29, 'indutestmail123@gmail.com', '1/7cXCxAK5oFhXOTv-2vt3bBYDYRmH57EVaTOWgJeugsa1u5LK9LQq-UhVC0rB74tL'),
(30, 'indutestmail123@gmail.com', '1/LAFTtFvzNnv9BVOtynsE7WaSAUEftIgbiBphvtN_dCo'),
(31, 'indutestmail123@gmail.com', '1/4qxyAZ2DwRxCfJ5Vsr_V2el4GpVlPWbxMOgARtk4ENA'),
(32, 'indutestmail123@gmail.com', '1/B8KzjDqTuHNZzvwzN7xMOcU_0vaCh8DwKnhP968Van2Hjk5TSSTFTv5dHi67CQSR'),
(33, 'indutestmail123@gmail.com', '1/c7-MF99xqeVYD02AW92CEjUGBI565vlH_YO4Rm2igW8'),
(34, 'indutestmail123@gmail.com', '1/q1bFLfPoGAoUF42s1ahldKWYPqmL8A9gsvU3_TQhu_s'),
(35, 'indutestmail123@gmail.com', '1/K2E3_AED2p6iDNvG5_UcyxJNjPYWtpq4fVczkw9NSsc'),
(36, 'indutestmail123@gmail.com', '1/SQrZJEarhTQJHS3wzx_tnpjSnxg8Wae9jTzQY_OLcjQ'),
(37, 'indutestmail123@gmail.com', '1/MeMvlGBbYejePmOAx3TmEPZ11UbxJaeRWsflRaLvdgg'),
(38, 'indutestmail123@gmail.com', '1/esj4wtY8UTTfkkj0KYqjQHlQbqzzp7wsHeaoWCJ4zmqJ6oQlOrc5q4c0W0GDMxGz'),
(39, 'indutestmail123@gmail.com', '1/do0ivZXz1h0_EEYqhHi2rsA5U57Tot_cdonMv_unj3Q'),
(40, 'indutestmail123@gmail.com', '1/cpqSIQ_Izq4n-kJouoO3gRO7V114Al0eKTOXR4y035hh-V9eiiyiiKhC7lh7XURB'),
(41, 'indutestmail123@gmail.com', '1/UrmpthcROqvbFyEDYOuHLjj3Ki9WqFnEYNOU4djfoENMpa1pB-I2PSnfg3bHczLM'),
(42, 'indutestmail123@gmail.com', '1/XGfLQtcF2Nr0NcgHGRWtL6xQ_Z_N3sGSe-5B_jiAtfA'),
(43, 'indutestmail123@gmail.com', '1/9M-X_IXchuPLe5652dEBbFS1ASF6oJu3VKI4h5-UG3BF6MbeErFk8nB7FBdvNA5X'),
(44, 'indutestmail123@gmail.com', '1/polfZNlKNT6vG1O2_sNCR3IRnyO-arirWwU18hREWhM'),
(45, 'indutestmail123@gmail.com', '1/Usx04p-P_TNC-afGVoR0h487h3CAaBBSYgyDNlHHRbI'),
(46, 'indutestmail123@gmail.com', '1/SRtPB_ce-KQmlIssfpOeUCQkKKpPqiHdKGC-MX0VCq8'),
(47, 'indutestmail123@gmail.com', '1/iny6bu_JrbqLYg1Ha4mA6Lf8uixD6KFzTxyJ7YRDMZNwEaVIX81hyDIvNOr1JtgM'),
(48, 'indutestmail123@gmail.com', '1/ObwJMwx1qkR3Nfga1P9wexBw4VtojmBr4qt-7GlViwo'),
(49, 'indutestmail123@gmail.com', '1/Ui_WkHwUp_vS3mhuqA_CA1BvPQrWJA20PF1BW8qlBy4'),
(50, 'indutestmail123@gmail.com', '1/sA2a2jA7_uSxicr40dCI-4pStbiCSrx0OT2Vn3XRkVA'),
(51, 'indutestmail123@gmail.com', '1/okQreHRa5Qy9lXQsbS8m-RLtwMMC0CaYazEr3ornX3w'),
(52, 'arzoo.rkcet@gmail.com', '1/L05F9L3xh5cZiUDQwhcLjkPb8__nrsvPpdSUZbc-OOyG-VNu63Hn4MNFeLn6jxhy'),
(53, 'ajazkhanpathan14@gmail.com', '1/P56GluEqCSld1oOxEze8QaKuAT2Bl_Izw3xHWTO-dDE'),
(54, 'vishal.rkcet@gmail.com', '1/RLLScgn0W1QK9jbfK1eZsDwiHUOR22ZI8UL3nbwVyBI'),
(55, 'arzoo.rkcet@gmail.com', '1/ZBaiDd6e2f3wkyLPbLrB0bRtBo10zLTKusJgTgJTtdrI8pQvH2hwsqPt4WpX-ikC');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `status` enum('1','0','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `relationship`, `status`) VALUES
(1, 'Father', '1'),
(2, 'Son', '1'),
(3, 'Neighbour', '1'),
(4, 'Brother', '1'),
(5, 'Cousin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sync_details`
--

CREATE TABLE `sync_details` (
  `sync_id` int(11) NOT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sync_details`
--

INSERT INTO `sync_details` (`sync_id`, `user_id`, `next_token`, `add_date`, `modified_date`) VALUES
(4, 'arzoo.rkcet@gmail.com', 'CIDuuc7X7uQCEIDuuc7X7uQCGAU=', '2019-09-26 14:20:49', '2019-09-26 14:20:49'),
(5, 'arzoo.rkcet@gmail.com', 'CIDuuc7X7uQCEIDuuc7X7uQCGAU=', '2019-09-26 14:20:49', '2019-09-26 14:20:49'),
(6, 'arzoo.rkcet@gmail.com', 'CIDuuc7X7uQCEIDuuc7X7uQCGAU=', '2019-09-26 14:20:49', '2019-09-26 14:20:49'),
(7, 'arzoo.rkcet@gmail.com', 'CKj-yMzY7uQCEKj-yMzY7uQCGAU=', '2019-09-26 14:25:13', '2019-09-26 14:25:13'),
(8, 'arzoo.rkcet@gmail.com', 'CKj-yMzY7uQCEKj-yMzY7uQCGAU=', '2019-09-26 14:25:13', '2019-09-26 14:25:13'),
(9, 'arzoo.rkcet@gmail.com', 'CKj-yMzY7uQCEKj-yMzY7uQCGAU=', '2019-09-26 14:25:13', '2019-09-26 14:25:13'),
(10, 'arzoo.rkcet@gmail.com', 'CMC_wuLY7uQCEMC_wuLY7uQCGAU=', '2019-09-26 14:25:59', '2019-09-26 14:25:59'),
(11, 'arzoo.rkcet@gmail.com', 'CJj35eza7uQCEJj35eza7uQCGAU=', '2019-09-26 14:35:17', '2019-09-26 14:35:17'),
(12, 'arzoo.rkcet@gmail.com', 'CIj5gObb7uQCEIj5gObb7uQCGAU=', '2019-09-26 14:39:31', '2019-09-26 14:39:31'),
(13, 'arzoo.rkcet@gmail.com', 'COi5jKjd7uQCEOi5jKjd7uQCGAU=', '2019-09-26 14:46:19', '2019-09-26 14:46:19'),
(14, 'arzoo.rkcet@gmail.com', 'CKjHhZHe7uQCEKjHhZHe7uQCGAU=', '2019-09-26 14:49:58', '2019-09-26 14:49:58'),
(15, 'arzoo.rkcet@gmail.com', 'COihmcHi7uQCEOihmcHi7uQCGAU=', '2019-09-26 15:09:33', '2019-09-26 15:09:33'),
(16, 'arzoo.rkcet@gmail.com', 'CODq66bn7uQCEODq66bn7uQCGAU=', '2019-09-26 15:36:29', '2019-09-26 15:36:29'),
(17, 'arzoo.rkcet@gmail.com', 'COivk-fo7uQCEOivk-fo7uQCGAU=', '2019-09-26 15:37:44', '2019-09-26 15:37:44'),
(18, 'arzoo.rkcet@gmail.com', 'COivk-fo7uQCEOivk-fo7uQCGAU=', '2019-09-26 15:37:44', '2019-09-26 15:37:44'),
(19, 'arzoo.rkcet@gmail.com', 'CICiu4Tp7uQCEICiu4Tp7uQCGAU=', '2019-09-26 15:38:45', '2019-09-26 15:38:45'),
(22, 'vishal.rkcet@gmail.com', 'CNC25Z7u7uQCENC25Z7u7uQCGAU=', '2019-09-26 16:02:05', '2019-09-26 16:02:05'),
(23, 'arzoo.rkcet@gmail.com', 'CKi52tbx7uQCEKi52tbx7uQCGAU=', '2019-09-26 16:17:25', '2019-09-26 16:17:25'),
(24, 'arzoo.rkcet@gmail.com', 'CNCn0PHx7uQCENCn0PHx7uQCGAU=', '2019-09-26 16:18:22', '2019-09-26 16:18:22'),
(25, 'arzoo.rkcet@gmail.com', 'CNCn0PHx7uQCENCn0PHx7uQCGAU=', '2019-09-26 16:18:22', '2019-09-26 16:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_creation`
--

CREATE TABLE `user_creation` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `emp_id` int(150) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone_num` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `google_calendar_id` varchar(200) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `region` varchar(200) NOT NULL,
  `region_type` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` enum('1','0','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_creation`
--

INSERT INTO `user_creation` (`id`, `user_id`, `emp_id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `phone_num`, `user_type`, `gender`, `title`, `department`, `comments`, `google_calendar_id`, `user_role`, `region`, `region_type`, `company_name`, `address`, `status`) VALUES
(1, '1', 1001, 'Gowthami', 'gowthami', 'tholleti', 'indutestmail123@gmail.com', '202cb962ac59075b964b07152d234b70', '874125639', 'Admin', 'Female', 'test', 'comp', ' sample', 'indutestmail123@gmail.com', '', '', '', '', '', '1'),
(3, '1', 1085, 'Hindu', 'Hindu1', 'k', 'hindukurakula@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '34127532', 'SalesRepresentative', 'Female', 'test', 'comp', ' good', 'hindukurakula@gmail.com', '', '', '', '', '', '1'),
(7, '1', 5415, 'Hindu', 'rammmm', '42', 'hindu123@gmail.com', '53fde96fcc4b4ce72d7739202324cd49', '53463', 'Secretary', '--Select--', '24', '6666', ' ', '65', '', '', '', '', '', '0'),
(18, '1', 1023, 'Swathi', 'Swathi', 'S', 'swathi@gmail.com', '202cb962ac59075b964b07152d234b70', '9879797877', 'SalesRepresentative', 'Female', '123', 'Department1', ' ccd', 'swathi@gmail.com', 'Dealer', 'reg,region2', 'county', 'company1', 'Tirupati', '1'),
(19, '1', 1045, 'Ramu', 'Ramu', 'R', 'ramu@gmail.com', '202cb962ac59075b964b07152d234b70', '9874333098', 'SalesRepresentative', 'Male', 'Title1', 'Department1', ' comments', 'ramu@gmail.com', 'Dealer', 'region1,region2', 'county', 'company1', ' address', '1'),
(20, '1', 10029, 'Ramya', 'Ramya', 'K', 'ramya@gmail.com', '202cb962ac59075b964b07152d234b70', '4245252342', 'Secretary', 'Female', 'Title3', 'Department3', ' something', 'ramya@gmail.com', 'Dealer', 'region3,region4', 'country', 'company5', 'address ', '1'),
(21, '1', 10036, 'Ragini', 'Ragini', 'R', 'ragini@gmail.com', '202cb962ac59075b964b07152d234b70', '3412341242', 'Secretary', 'Female', 'Title1', 'Department1', ' comments', 'ramya@gmail.com', 'Dealer', 'rweq,dfg', 'county', 'company1', ' address1', '1'),
(22, '1', 10047, 'arzooshaikh', 'arzoo', 'shaikh', 'arzoo.rkcet@gmail.com', '202cb962ac59075b964b07152d234b70', '8866152292', 'Admin', 'Male', 'no idea', 'dept1', ' ', 'arzoo.rkcet@gmail.com', 'User', 'india', 'county', 'ally', ' ', '1'),
(23, '22', 1245, 'Ajaz', 'Ajaz', 'Pathan', 'ajazkhanpathan14@gmail.com', '202cb962ac59075b964b07152d234b70', '8585224455', 'Admin', 'Male', 'primary', 'dept1', ' ', 'ajazkhanpathan14@gmail.com', 'User', 'india', 'county', 'Ally', ' ', '1'),
(24, '22', 10002, 'Vishalrkcet', 'Vishal', 'Patel', 'vishal.rkcet@gmail.com', '202cb962ac59075b964b07152d234b70', '8855224466', 'Admin', 'Male', 'none', 'dep', ' ', 'vishal.rkcet@gmail.com', 'User', 'india', 'county', 'Ally', ' ', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_information`
--
ALTER TABLE `appointment_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_creation`
--
ALTER TABLE `dealer_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_info`
--
ALTER TABLE `lead_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_type`
--
ALTER TABLE `lead_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_account`
--
ALTER TABLE `new_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_subscription`
--
ALTER TABLE `notification_subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `page_access`
--
ALTER TABLE `page_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_names`
--
ALTER TABLE `page_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_detalis`
--
ALTER TABLE `quotation_detalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_master`
--
ALTER TABLE `quotation_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refresh_token`
--
ALTER TABLE `refresh_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_details`
--
ALTER TABLE `sync_details`
  ADD PRIMARY KEY (`sync_id`);

--
-- Indexes for table `user_creation`
--
ALTER TABLE `user_creation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_information`
--
ALTER TABLE `appointment_information`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dealer_creation`
--
ALTER TABLE `dealer_creation`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lead_info`
--
ALTER TABLE `lead_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lead_type`
--
ALTER TABLE `lead_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `new_account`
--
ALTER TABLE `new_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_subscription`
--
ALTER TABLE `notification_subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_access`
--
ALTER TABLE `page_access`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_names`
--
ALTER TABLE `page_names`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotation_detalis`
--
ALTER TABLE `quotation_detalis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quotation_master`
--
ALTER TABLE `quotation_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `refresh_token`
--
ALTER TABLE `refresh_token`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sync_details`
--
ALTER TABLE `sync_details`
  MODIFY `sync_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_creation`
--
ALTER TABLE `user_creation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
