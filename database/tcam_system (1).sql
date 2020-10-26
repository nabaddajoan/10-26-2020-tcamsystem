-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 03:53 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `usertype` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `usertype`) VALUES
(1, 'admin', '$2y$10$QCGfJeY8bSHLxnto22EtlueZBxpR9cRYZnU7HHUeUlZXzqsra7y9a', 'Joan', 'Nabadda', 'WIN_20200312_21_35_57_Pro.jpg', '2019-12-30', ''),
(2, 'manager', 'manager', 'Nabadda', 'Joyce', '', '2020-03-25', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `Expected_time_in` time NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `teacher_id`, `date`, `Expected_time_in`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(108, 5, '2020-01-03', '00:00:00', '00:26:00', 0, '01:45:00', 9.8),
(110, 5, '2020-01-05', '00:00:00', '23:54:00', 0, '00:55:00', 11.05),
(115, 22, '2020-05-04', '01:00:00', '16:00:00', 1, '17:00:00', 6),
(116, 21, '2020-04-04', '08:11:00', '08:16:00', 1, '09:00:00', 1),
(117, 7, '2020-06-02', '03:00:00', '04:00:00', 0, '05:00:00', 6.3),
(118, 27, '2020-06-01', '02:19:00', '02:22:00', 1, '03:11:00', 1),
(119, 27, '2020-06-04', '04:00:00', '15:00:00', 0, '16:00:00', 3.75);

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `camera_on` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `name`, `camera_on`) VALUES
(1, 'class Room A', 0),
(2, 'class Room B', 0),
(3, 'class Room C', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `individ`
-- (See below for the actual view)
--
CREATE TABLE `individ` (
`teacher_id` varchar(15)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`days` bigint(21)
,`percentage` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `Expected_time_in` time NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `Expected_time_in`, `time_in`, `time_out`) VALUES
(1, '08:00:00', '08:00:00', '09:00:00'),
(2, '11:00:00', '11:00:00', '12:00:00'),
(3, '09:00:00', '09:00:00', '10:15:00'),
(4, '12:15:00', '12:15:00', '13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `description`, `rate`) VALUES
(1, 'English', 100),
(2, 'Mathematics', 50),
(3, 'Physics', 35),
(4, 'Biology', 75),
(5, 'Literature', 50),
(9, 'Chemistry', 0),
(10, 'History', 0),
(12, 'Geography', 0),
(13, 'CRE', 0),
(15, 'Computer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `subject_id`, `schedule_id`, `photo`, `created_on`) VALUES
(5, 'TQO238109674', 'Nakalyango', 'Molly', 'Namugongo', '1997-11-23', '0703469646', 'Female', 12, 4, 'WIN_20200104_23_49_29_Pro.jpg', '2019-12-28'),
(7, 'TWY781946302', 'Makumbi', 'Shafic', 'Esp', '1995-07-11', '8467067344', 'Male', 2, 2, 'DSC00077.jpg', '2018-07-11'),
(21, 'XRF342608719', 'Najjuuko ', 'Josephine', 'Buganda', '1998-08-24', '0754028151', 'Female', 3, 1, 'WIN_20200109_15_12_37_Pro.jpg', '2020-04-11'),
(22, 'PJM174659830', 'Ssentoogo', 'Charles', 'kampala', '1995-12-24', '0706885065', 'Male', 5, 1, '', '2020-01-13'),
(23, 'WSY024678139', 'Mahande', 'Xavier', 'Busia', '1996-06-06', '0700488843', 'Male', 9, 2, '', '2020-05-23'),
(25, 'TQZ132684075', 'Nanyanzi ', 'Florence', 'Kalisizo', '1976-06-06', '0752959261', 'Female', 5, 3, 'IMG_20200515_145744_6.jpg', '2020-05-27'),
(27, 'MNR931476508', 'Kanyago', 'Justine', 'Luganzi', '1976-05-01', '0758816636', 'Female', 4, 3, '', '2020-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', 'e0397393f2258e8c6ee68e35ceb46d86a4ac5382', 'admin', 'Nabadda', 'Joan', '', '2020-01-01'),
(2, 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', 'manager', 'manager', 'manager', '', '2020-02-01');

-- --------------------------------------------------------

--
-- Structure for view `individ`
--
DROP TABLE IF EXISTS `individ`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `individ`  AS  select `teachers`.`teacher_id` AS `teacher_id`,`teachers`.`firstname` AS `firstname`,`teachers`.`lastname` AS `lastname`,count(`attendance`.`teacher_id`) AS `days`,count((`attendance`.`teacher_id` / 100)) AS `percentage` from (`teachers` left join `attendance` on((`teachers`.`teacher_id` = `attendance`.`id`))) group by `teachers`.`teacher_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
