-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 10:05 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22218468_my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `full_name`, `phone_number`, `address`, `user_id`) VALUES
(7, 'Jonas Gestopas', '09352315582', 'Pilipinas', 1),
(42, 'Pusagala', '92394832', 'Manila', 15),
(43, 'Kanluran', '09823742', 'Silanagan', 16),
(62, 'test', '23423423', 'adfsdif', 17),
(64, 'Paku', '037373', 'Yum', 28),
(65, 'weawewa', '09056739305', 'weaweawe', 29);

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`id`, `quantity`, `cat_id`, `user_id`) VALUES
(120, 99, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Cats`
--

CREATE TABLE `Cats` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Cats`
--

INSERT INTO `Cats` (`id`, `cat_name`, `price`, `file_name`) VALUES
(1, 'Willow', 10.00, 'cute_kitten1.jpg'),
(2, 'Sadie', 15.00, 'cute_kitten2.jpg'),
(3, 'Tasha', 20.00, 'cute_kitten3.jpg'),
(4, 'Boots', 25.00, 'cute_kitten4.jpg'),
(5, 'Stella', 30.00, 'cute_kitten5.jpg'),
(6, 'Daisy', 35.00, 'cute_kitten6.jpg'),
(7, 'Zoey', 40.00, 'cute_kitten7.jpg'),
(8, 'Sassy', 45.00, 'cute_kitten8.jpg'),
(9, 'Angel', 50.00, 'cute_kitten9.jpg'),
(10, 'Cleopatra', 55.00, 'cute_kitten10.jpg'),
(11, 'Mia', 60.00, 'cute_kitten11.jpg'),
(12, 'Rosie', 65.00, 'cute_kitten12.jpg'),
(13, 'Gracie', 70.00, 'cute_kitten13.jpg'),
(14, 'Lily', 75.00, 'cute_kitten14.jpg'),
(15, 'Molly', 80.00, 'cute_kitten15.jpg'),
(16, 'Ginger', 85.00, 'cute_kitten16.jpg'),
(17, 'Chloe', 90.00, 'cute_kitten17.jpg'),
(18, 'Jasmine', 95.00, 'cute_kitten18.jpg'),
(19, 'Lucy', 100.00, 'cute_kitten19.jpg'),
(20, 'Winnie', 10.00, 'cute_kitten20.jpg'),
(21, 'Olive', 15.00, 'cute_kitten21.jpg'),
(22, 'Ruby', 20.00, 'cute_kitten22.jpg'),
(23, 'Phoebe', 25.00, 'cute_kitten23.jpg'),
(24, 'Nala', 30.00, 'cute_kitten24.jpg'),
(25, 'Princess', 35.00, 'cute_kitten25.jpg'),
(26, 'Cleo', 40.00, 'cute_kitten26.jpg'),
(27, 'Misty', 45.00, 'cute_kitten27.jpg'),
(28, 'Bella', 50.00, 'cute_kitten28.jpg'),
(29, 'Trixie', 55.00, 'cute_kitten29.jpg'),
(30, 'Pepper', 60.00, 'cute_kitten30.jpg'),
(31, 'Luna', 65.00, 'cute_kitten31.jpg'),
(32, 'Penny', 70.00, 'cute_kitten32.jpg'),
(33, 'Sophie', 75.00, 'cute_kitten33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Purchase`
--

CREATE TABLE `Purchase` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Purchase`
--

INSERT INTO `Purchase` (`id`, `user_id`, `cat_id`, `quantity`, `total`, `purchase_date`) VALUES
(1, 1, 4, 1, 25.00, '2024-05-24 13:58:04'),
(2, 1, 9, 1, 50.00, '2024-05-24 13:58:04'),
(3, 1, 23, 3, 75.00, '2024-05-24 13:58:04'),
(4, 1, 11, 6, 360.00, '2024-05-24 13:58:04'),
(5, 1, 4, 1, 25.00, '2024-05-24 14:01:58'),
(6, 1, 9, 1, 50.00, '2024-05-24 14:01:58'),
(7, 1, 23, 3, 75.00, '2024-05-24 14:01:58'),
(8, 1, 11, 6, 360.00, '2024-05-24 14:01:58'),
(9, 1, 4, 1, 25.00, '2024-05-24 14:03:14'),
(10, 1, 9, 1, 50.00, '2024-05-24 14:03:14'),
(11, 1, 23, 3, 75.00, '2024-05-24 14:03:14'),
(12, 1, 11, 6, 360.00, '2024-05-24 14:03:14'),
(13, 1, 3, 1, 20.00, '2024-05-24 14:04:36'),
(14, 1, 20, 1, 10.00, '2024-05-24 14:27:14'),
(15, 1, 21, 2, 30.00, '2024-05-24 14:27:14'),
(16, 1, 18, 2, 190.00, '2024-05-24 14:27:14'),
(17, 1, 4, 3, 75.00, '2024-05-24 14:52:14'),
(18, 2, 2, 10, 150.00, '2024-05-24 17:37:46'),
(19, 2, 1, 6, 60.00, '2024-05-24 17:37:46'),
(20, 2, 3, 3, 60.00, '2024-05-24 17:37:46'),
(21, 2, 7, 1, 40.00, '2024-05-24 17:37:46'),
(22, 2, 6, 1, 35.00, '2024-05-24 17:37:46'),
(23, 2, 9, 1, 50.00, '2024-05-24 17:37:46'),
(24, 2, 10, 1, 55.00, '2024-05-24 17:37:46'),
(25, 2, 4, 1, 25.00, '2024-05-24 17:37:46'),
(26, 2, 17, 1, 90.00, '2024-05-24 17:38:46'),
(27, 2, 18, 1, 95.00, '2024-05-24 17:38:46'),
(28, 2, 19, 1, 100.00, '2024-05-24 17:38:46'),
(29, 2, 33, 1, 75.00, '2024-05-24 17:38:46'),
(30, 1, 2, 1, 15.00, '2024-05-24 21:46:28'),
(31, 1, 15, 1, 80.00, '2024-05-24 21:46:28'),
(32, 1, 13, 3, 210.00, '2024-05-24 21:46:28'),
(33, 1, 24, 2, 60.00, '2024-05-24 21:46:28'),
(34, 15, 4, 4, 100.00, '2024-05-24 22:13:02'),
(35, 15, 3, 1, 20.00, '2024-05-24 22:13:02'),
(36, 16, 3, 7, 140.00, '2024-05-24 22:22:49'),
(37, 16, 2, 1, 15.00, '2024-05-24 22:22:49'),
(38, 16, 6, 1, 35.00, '2024-05-24 22:22:49'),
(39, 16, 16, 2, 170.00, '2024-05-24 22:22:49'),
(40, 16, 13, 3, 210.00, '2024-05-24 22:22:49'),
(41, 17, 8, 6, 270.00, '2024-05-24 22:23:43'),
(42, 17, 16, 2, 170.00, '2024-05-24 22:23:43'),
(43, 17, 4, 1, 25.00, '2024-05-24 22:48:15'),
(44, 17, 4, 6, 150.00, '2024-05-24 22:50:05'),
(45, 17, 2, 4, 60.00, '2024-05-24 22:53:43'),
(46, 17, 1, 1, 10.00, '2024-05-24 23:15:05'),
(47, 17, 4, 1, 25.00, '2024-05-24 23:15:59'),
(48, 1, 5, 5, 150.00, '2024-05-24 23:20:33'),
(49, 1, 3, 2, 40.00, '2024-05-25 09:06:21'),
(50, 1, 2, 5, 75.00, '2024-05-25 09:06:21'),
(51, 1, 1, 5, 50.00, '2024-05-25 09:06:21'),
(52, 1, 4, 2, 50.00, '2024-05-25 09:06:21'),
(53, 1, 5, 2, 60.00, '2024-05-25 09:06:21'),
(54, 1, 8, 1, 45.00, '2024-05-25 09:06:21'),
(55, 1, 7, 1, 40.00, '2024-05-25 09:06:21'),
(56, 28, 1, 4, 40.00, '2024-05-26 06:50:29'),
(57, 29, 4, 1, 25.00, '2024-05-26 06:55:57'),
(58, 29, 11, 1, 60.00, '2024-05-26 06:55:57'),
(59, 29, 12, 1, 65.00, '2024-05-26 06:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`) VALUES
(1, 'user', 'user@test.com', '$2y$10$dwY8IMQZb5EQs3HzYTqrIuuBKuWKlhvD73Aq2cSuFcvK11I4KCaHO'),
(2, 'luffytaro', 'luffytaro@onepiece.com', '$2y$10$qdeRJuyRKYqv9sryFwvq6uoDfWllVEGtqGgj589eAJzCCMf6SzS62'),
(3, 'Spiderman', 'spiderman@gmail.com', '$2y$10$PG/ab5ocrmwh0YG.wM3v3ekKrlyPIFqIJ3QmSLikEAVb25JXAHYSm'),
(4, 'batman', 'batman@gmail.com', '$2y$10$1I5krC.Vv7TMBTMpI9coUurnotA96XMX/N5iSZtpE9nrq91OjNwqS'),
(5, 'superwoman', 'superwoman@gmail.com', '$2y$10$9fr7CWYuNqhMQR8VSWCKpe/.G0R55uYqF843I5v0vm0jyrql0RbMC'),
(6, 'tst2', 'tst2@gmail.com', '$2y$10$peDO3VwxR7ZMamu2pmUIV.lCMQnP7zhniGhVNE2.cgklce4mGbD0W'),
(8, 'tst3', 'tst3@test.com', '$2y$10$YC.R1xzsychK4eHedtCAeOaeZ7dQR.QPU6L0yjboa77SU0de2BVoq'),
(10, 'tst4', 'tst4@test.com', '$2y$10$Pku5ljJ/9Drw73xnbnnl9uLEphrGBXKh/ORvdPxsZjQsM1auY5LOO'),
(11, 'tsers', 'test22@test.com', '$2y$10$5O0sz.UAmdje91LqClKZSu7XRTVM6sOxCWrb0SKtBwl3VVIbtYecq'),
(12, 'dsafkf', 'ajsdf@gmail.cm', '$2y$10$0U8X73ybqf3V/qyvBzIsLOa0fKoeZeXlckJwHA/Dg4KAP9j7n/f0C'),
(13, 'adsfdsfa', 'tesrasdf@gmail.com', '$2y$10$r8JjsAoc1T2g8X3dsJe8cOOGtMok.wP8eFguBuOQq2huj290fdvsS'),
(15, 'pusagala', 'meow@m.com', '$2y$10$mMsjMuqJSgkehAqYWxTXqeBCN0oDPVPIiUVxXHWKsSQ8SH1gxkVC2'),
(16, 'gokunomo', 'gokonomu@gmail.com', '$2y$10$6w2oR/uO3hZ2LtLRAeoTDe6FwoZW4w1UoAeH1FswwxGdSyeV5GcyG'),
(17, 'gohan', 'gohan@gmail.com', '$2y$10$tZPTtBuE0fcN1D71esYSceTMfgjxR9fCQXAuzAjGgOmvn49Iag2zq'),
(18, 'freeza', 'freeza@gmail.com', '$2y$10$xI3WCKBzgjzg8AOyvJAwy.IGe3hSm4Ji0YjpQUsaZw2cB.YI5fGC6'),
(19, 'traydor', 'traydor@gmail.com', '$2y$10$BPz418bD.lxYOUMVZf3KPOHz9W1Kjg91ltM2iF5QNQRRbrgzXOSXS'),
(20, 'pussycat', 'pus@gmail.com', '$2y$10$lkZInt.R5419fG2Bd9gHz.hvjKdqzmIzUwbyRt22XtATK6Kfgo4a2'),
(21, 't1', 't1@t.com', '$2y$10$G7twDMh1ZAffddVlTX2QEuYmLXE/yK9S7DE1Pz/JSSTOHqt.dXpLq'),
(22, 't2', 't2@t.com', '$2y$10$fJI1DaDSFAgxSh9XZBiVduEFd0PFCU8m3An/sXfWikgzrVUwRGxSm'),
(23, 't4', 't4@t.com', '$2y$10$F88FWPXfvCppN0tY0xfC8.y2d5GLJVGOCcb6no7XSnERWTQIW5BY6'),
(24, 't5', 't5@t.com', '$2y$10$sAfK.5XPCHCSxS75eQwOX.ppV0vp0ERXh30j.rVyvnSj8kd6aKsRG'),
(26, 't6', 't6@t.com', '$2y$10$YURbNKht00lz00vWZ4DWOeOK1B6tuKPqYSi2VP8/KKTAHcjElw6eG'),
(27, 'sixtynine', 'sixnine@test.com', '$2y$10$VzdSwFAnqocnj4DnO156uOyVnZbKnXkN7cjy1VBEJomBxsDw8..bO'),
(28, 'Kans', 'kans@test.com', '$2y$10$23B5ANc7YFD33c5LN0H4V.WIm1m7Pmv0MzhJ/2Q5sTqgm5KTF8mWq'),
(29, 'melton', 'meltonjhon50@gmail.com', '$2y$10$Nc9JRTqVd4sN4VCFtFn2POWIfeX70artIY7Myr9v6m910bd90WPU6'),
(30, 'wewew', 'ewew', '$2y$10$4kbuP1l9FKykPYQC7CBXy.s/k8/Hj7SIy7/4oV.Hz3x8iiPmBPd2i'),
(31, 'asdfadf', 'adf', '$2y$10$qooVFOOGZohVAgSJRNMj0OUvVPTtIOMaQYkP7Z8.NhmiwJwVs1cl6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_catid_userid` (`cat_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Cats`
--
ALTER TABLE `Cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Purchase`
--
ALTER TABLE `Purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `Cats`
--
ALTER TABLE `Cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Purchase`
--
ALTER TABLE `Purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Cats` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Purchase`
--
ALTER TABLE `Purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `Cats` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
