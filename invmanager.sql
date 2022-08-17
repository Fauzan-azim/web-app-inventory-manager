-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 10:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id-item` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Desc` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id-item`, `Name`, `Desc`, `stock`, `image`) VALUES
(19, 'Secret Lab Chair', 'Kursi Gaming s', 24, '38f3c6f071031504de3d4a2d5621ccd2.png'),
(20, 'IPhone 12 XR', 'Smartphone', 3, 'f0728bd9b0f90a5b5550ddcace88c306.png'),
(22, 'Samsung Galaxy 10', 'Smartphone', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item-in`
--

CREATE TABLE `item-in` (
  `id-in` int(11) NOT NULL,
  `id-item` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `assignee` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item-in`
--

INSERT INTO `item-in` (`id-in`, `id-item`, `Date`, `assignee`, `qty`) VALUES
(31, 18, '2021-12-29 02:26:45', 'Pembeli', 1),
(33, 19, '2021-12-29 03:50:36', 'Suparminto', 12),
(34, 20, '2021-12-29 13:43:54', 'Pembeli', 3);

-- --------------------------------------------------------

--
-- Table structure for table `item-out`
--

CREATE TABLE `item-out` (
  `id-out` int(11) NOT NULL,
  `id-item` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Receiver` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item-out`
--

INSERT INTO `item-out` (`id-out`, `id-item`, `date`, `Receiver`, `qty`) VALUES
(7, 14, '2021-12-28 18:12:46', 'Pembeli', 11),
(8, 16, '2021-12-29 01:24:15', 'Suparmin', 10),
(12, 18, '2021-12-29 02:24:48', 'Suparmin', 12),
(13, 17, '2021-12-29 03:29:06', 'Pembeli', 1),
(15, 19, '2021-12-29 03:54:10', 'Pembeli', 2),
(16, 20, '2021-12-31 14:09:58', 'Pembeli', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id-user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `regist_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id-user`, `username`, `email`, `password`, `level`, `regist_date`) VALUES
(14, 'admin', 'admin@email.com', 'e00cf25ad42683b3df678c61f42c6bda', 'admin', '2021-12-29 04:19:07'),
(15, 'fauzan', 'zan@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 'guest', '2021-12-29 04:59:35'),
(17, 'zizi', 'zizi@gmail.com', 'dc5c7986daef50c1e02ab09b442ee34f', 'guest', '2021-12-31 19:27:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id-item`);

--
-- Indexes for table `item-in`
--
ALTER TABLE `item-in`
  ADD PRIMARY KEY (`id-in`);

--
-- Indexes for table `item-out`
--
ALTER TABLE `item-out`
  ADD PRIMARY KEY (`id-out`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id-user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id-item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `item-in`
--
ALTER TABLE `item-in`
  MODIFY `id-in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `item-out`
--
ALTER TABLE `item-out`
  MODIFY `id-out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id-user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
