-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 08:20 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(50) NOT NULL,
  `ticket_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `ticket_amount` int(11) NOT NULL,
  `date_of_issue` datetime NOT NULL,
  `date_of_payment` datetime NOT NULL,
  `payment_tick` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `ticket_id`, `user_id`, `ticket_amount`, `date_of_issue`, `date_of_payment`, `payment_tick`) VALUES
(7, '1', '4', 2, '2017-12-05 00:21:59', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `name`, `description`, `image`, `rating`) VALUES
(1, 'Pulp Fiction', './description/Pulp Fiction.txt', './images/Pulp Fiction.jpg', 8.9),
(2, 'The Shawshank Redemption', './description/The Shawshank Redemption.txt', './images/The Shawshank Redemption.jpg', 9.3),
(3, 'The Godfather', './description/The Godfather.txt', './images/The Godfather.jpg', 9.2),
(4, 'The Godfather Part II', './description/The Godfather Part II.txt', './images/The Godfather Part II.jpg', 9.3),
(5, 'The Dark Knight', './description/The Dark Knight.txt', './images/The Dark Knight.jpg', 9),
(6, '12 Angry Men', './description/12 Angry Men.txt', './images/12 Angry Men.jpg', 8.9),
(7, 'The Lord of the Rings The Return of the King', './description/The Lord of the Rings The Return of the King.txt ', './images/The Lord of the Rings The Return of the King.jpg', 8.9),
(8, 'The Good, the Bad and the Ugly', './description/The Good, the Bad and the Ugly.txt', './images/The Good, the Bad and the Ugly.jpg', 8.9);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` varchar(50) NOT NULL,
  `movie_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `review` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(50) NOT NULL,
  `movie_id` varchar(50) NOT NULL,
  `ticket_total` int(5) NOT NULL,
  `ticket_left` int(5) NOT NULL,
  `price` float NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `movie_id`, `ticket_total`, `ticket_left`, `price`, `datetime`) VALUES
(4, '2', 100, 100, 20, '2017-12-05 12:00:00'),
(3, '1', 100, 100, 10, '2017-12-05 12:00:00'),
(5, '3', 100, 100, 30, '2017-12-05 12:00:00'),
(6, '4', 100, 100, 40, '2017-12-05 12:00:00'),
(7, '5', 100, 100, 50, '2017-12-05 12:00:00'),
(8, '6', 100, 100, 60, '2017-12-05 12:00:00'),
(9, '7', 100, 100, 70, '2017-12-05 12:00:00'),
(10, '8', 100, 100, 80, '2017-12-05 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `admin_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `age`, `admin_status`) VALUES
(1, 'admin', 'admin@admin.com', '12345', 31, 1),
(4, 'user', 'user@user.com', '1234', 0, 0),
(5, 'user1', 'user1@user.com', '12345', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
