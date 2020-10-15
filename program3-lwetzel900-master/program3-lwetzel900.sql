-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 05:21 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `program3-lwetzel900`
DROP DATABASE IF EXISTS `wedding`;
DROP DATABASE IF EXISTS `program3-lwetzel900`;
CREATE DATABASE `program3-lwetzel900`;
USE `program3-lwetzel900`;
-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageID` int(11) NOT NULL,
  `galleryImages` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `galleryImages`) VALUES
(2, 'images/gallery/brideGroom.jpg'),
(3, 'images/gallery/grandmaDancing.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceID` int(11) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  `serviceDescription` varchar(225) NOT NULL,
  `servicePic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceID`, `serviceType`, `serviceDescription`, `servicePic`) VALUES
(1, 'Wedding', 'your wedding ceromony', 'images/service/brideGroom.jpg'),
(2, 'Wedding Reception', 'For everything after the ceremony', 'images/service/weddingReception.jpg'),
(3, 'Anniversary ', 'celebrating a big turning point in a relationship? we can cover that to', 'images/service/serviceDefault.jpg'),
(8, 'Birthday', 'Rather it is for your 4 or 40 year old, we got you covered', 'images/service/birthday.jpg'),
(14, 'Yum', 'Taste testing', 'images/service/tasteTest.jpg'),
(16, 'Graduation Reception', 'your special person is graduating high school or college, you guessed it. we do that as well', 'images/service/graduation.jpg'),
(17, 'Haha', 'stand up comedy', 'images/service/standup.jpg'),
(20, 'All in All', 'all in all this has been interesting', 'images/service/serviceDefault.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fName` varchar(15) NOT NULL,
  `lName` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `zip` int(5) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fName`, `lName`, `email`, `address`, `city`, `zip`, `phone`, `password`) VALUES
(1, 'Loren', 'Wetzel', 'lwetzel90@gmail.com', '609 4th Ave', 'Nebraska City', 68410, '4028817220', '$2y$12$33CoiE0rHEZR/Fk.qheCg.S0718wisKuyZweG4ZpWzjp37781/arG'),
(2, 'jonny', 'jonson', 'jon@jonson.com', '156 johnnyway', 'jonsville', 68450, '7896541523', '$2y$12$nIjUEHtRovHmlPhqIRm9b.53t8xb9o0YyJ8z7MFGhjm7K0ek9gb2u');


-- --------------------------------------------------------

--
-- Table structure for table `userselection`
--

CREATE TABLE `userselection` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `venueID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userselection`
--

INSERT INTO `userselection` (`id`, `userID`, `venueID`, `serviceID`) VALUES
(14, 2, 1, 4),
(17, 2, 2, 3),
(23, 1, 5, 1),
(24, 0, 0, 11),
(26, 1, 1, 2),
(27, 1, 1, 14),
(28, 1, 2, 3),
(29, 1, 2, 1),
(30, 1, 6, 16),
(31, 1, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venueID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `venuePic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venueID`, `name`, `city`, `state`, `venuePic`) VALUES
(1, 'Fox Center', 'Nebraska City', 'NE', 'images/venue/venue.jpeg'),
(2, 'Arbor Lodge', 'Nebraska City', 'NE', 'images/venue/receptionBride.jpg'),
(5, 'blah blah', 'blahville', 'BA', 'images/venue/venueDefault.jpg'),
(6, 'That Venue', 'Over There', 'BS', 'images/venue/venueDefault.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `venueservice`
--

CREATE TABLE `venueservice` (
  `id` int(11) NOT NULL,
  `venueID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venueservice`
--

INSERT INTO `venueservice` (`id`, `venueID`, `serviceID`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 2, 3),
(5, 2, 1),
(8, 5, 9),
(10, 5, 1),
(11, 5, 3),
(12, 5, 2),
(14, 2, 13),
(15, 1, 14),
(16, 5, 15),
(17, 1, 16),
(18, 5, 8),
(19, 5, 19),
(20, 6, 20),
(21, 1, 21),
(22, 5, 22),
(23, 6, 8),
(26, 6, 11),
(27, 1, 8),
(28, 2, 8),
(29, 2, 16),
(30, 6, 16),
(31, 5, 17),
(32, 1, 1),
(36, 6, 2),
(37, 2, 2),
(39, 6, 14),
(40, 2, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userselection`
--
ALTER TABLE `userselection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venueID`);

--
-- Indexes for table `venueservice`
--
ALTER TABLE `venueservice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userselection`
--
ALTER TABLE `userselection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `venueservice`
--
ALTER TABLE `venueservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
