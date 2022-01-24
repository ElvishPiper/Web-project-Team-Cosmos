-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 11:29 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp5310 website`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `user_name` varchar(64) NOT NULL,
  `uploaded` date NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`user_name`, `uploaded`, `file_name`, `image_id`) VALUES
('test', '2020-01-07', 'bulb.jpg', 1),
('rick', '2022-01-19', 'cute.jpg', 2),
('howard', '2020-08-18', 'mountain.jpg', 3),
('rick', '2021-09-14', 'rabbit.jpg', 4),
('test', '2021-07-12', 'lego.jpg', 5),
('howard', '2021-03-15', 'forest.jpg', 6),
('rigot', '2020-05-06', 'random.jpg', 7),
('howard', '2022-01-22', 'firework.jpg', 10),
('howard', '2022-01-22', 'cats.jpg', 11),
('howard', '2022-01-23', 'light.jpeg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_password` varchar(35) NOT NULL,
  `user_bio` text NOT NULL,
  `user_pic` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_bio`, `user_pic`) VALUES
(2, 'test', 'email@email.com', 'password', 'hello, welcome to my page!', 'test_avatar.png'),
(3, 'asd', 'asdas@hotm.com', '1234', '', ''),
(4, 'rigot', 'asdsad@hotmail.com', 'abba', 'I like listening to music and dancing in my free time', ''),
(7, 'rick', 'testemail@whatever.com', 'test', '', ''),
(8, 'howard', 'duck@what.com', 'youtube', 'I\'m Howard Grayson, and I\'m a recent college graduate with a Bachelor\'s Degree in Web Design. I\'m seeking a full-time opportunity where I can employ my programming skills.', ''),
(9, 'raaaaa', 'hello@email.com', 'this', 'pew pew pew pew ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
