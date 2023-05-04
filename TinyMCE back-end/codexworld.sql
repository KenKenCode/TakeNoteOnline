-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 08:05 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codexworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id`, `content`, `created`) VALUES
(1, '<p>This is my textarea to be <strong>replaced</strong> with HTML editor.</p>', '2023-05-03 01:42:16'),
(2, '<p>This is my <em>textarea</em> to be <strong>replaced</strong> with HTML editor.</p>', '2023-05-03 01:43:02'),
(3, '<hr>\r\n<p>This is my <em>textarea</em> to be <strong>replaced</strong> with HTML editor.</p>\r\n<p><code>This is a code</code></p>\r\n<hr>\r\n<p>&nbsp;</p>', '2023-05-03 01:44:50'),
(4, '<p>This is my textarea to be replaced with HTML <strong>editor</strong>.</p>', '2023-05-03 10:19:09'),
(5, '<p>This is my textarea to be replaced with <strong><em>HTML</em></strong> editor.</p>', '2023-05-03 10:19:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
