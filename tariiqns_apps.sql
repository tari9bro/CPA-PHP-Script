-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2025 at 06:59 PM
-- Server version: 10.6.20-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tariiqns_apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(2, 'ubermenschios', '$2y$10$iEWOzbNvcK5.iEqsOkI/YOEy22bf73azf9wwLtDQ/WW.UJJI6.dZS');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(6) UNSIGNED NOT NULL,
  `app_name` varchar(100) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `icon_url` varchar(255) NOT NULL,
  `download_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `app_name`, `platform`, `icon_url`, `download_url`, `created_at`) VALUES
(1, 'Bingo Blitz MOD', 'All Platforms', 'https://i.ibb.co/hMZ9730/1-10.webp', 'https://theshell.shop/og.php?u=/cl/i/dvmp2o', '2024-09-14 00:30:04'),
(2, '1xbet predictor', 'All Platforms', 'https://i.ibb.co/SRbQq1q/1-1.webp', 'https://theshell.shop/og.php?u=/cl/i/6dll8j', '2024-09-14 12:47:31'),
(3, '1win bet predictor', 'All Platforms', 'https://i.ibb.co/RbCrnwq/1-16.webp', 'https://theshell.shop/og.php?u=/cl/i/8dwwo3', '2024-09-14 15:23:33'),
(4, 'Bingo Bash MOD', 'All Platforms', 'https://i.ibb.co/JccJYTL/1-34.webp', 'https://theshell.shop/og.php?u=/cl/i/j7dek', '2024-09-15 12:30:18'),
(5, 'Caesars Slots MOD', 'All Platforms', 'https://i.ibb.co/jzHfMtv/1-11.webp', 'https://theshell.shop/og.php?u=/cl/i/5kxx83', '2024-09-16 12:02:07'),
(6, 'Cash Frenzy Slots MOD', 'All Platforms', 'https://i.ibb.co/ygN054t/1-35.webp', 'https://theshell.shop/og.php?u=/cl/i/o6ll1d', '2024-09-16 12:03:59'),
(7, 'Cashman Casino slots MOD', 'All Platforms', 'https://i.ibb.co/zbmHz5n/1-24.webp', 'https://theshell.shop/og.php?u=/cl/i/kl225g', '2024-09-16 12:59:39'),
(8, 'DoubleDown Casino MOD', 'All Platforms', 'https://i.ibb.co/GvmZ3Z5/1-28.webp', 'https://theshell.shop/og.php?u=/cl/i/dv1151', '2024-09-16 13:01:07'),
(9, 'DoubleU Slots MOD', 'All Platforms', 'https://i.ibb.co/mBzkbhp/1-12.webp', 'https://theshell.shop/og.php?u=/cl/i/vo332x', '2024-09-16 13:02:22'),
(10, 'Gold Fish Casino MOD', 'All Platforms', 'https://i.ibb.co/RYDJR8D/1-13.webp', 'https://theshell.shop/og.php?u=/cl/i/2l228p', '2024-09-16 13:03:27'),
(11, 'Heart of Vegas MOD', 'All Platforms', 'https://i.ibb.co/9ZY1pgM/1-6.webp', 'https://theshell.shop/og.php?u=/cl/i/j6vv5k', '2024-09-16 13:05:11'),
(12, 'Hit It Rich! MOD', 'All Platforms', 'https://i.ibb.co/fHwCXyS/1-26.webp', 'https://theshell.shop/og.php?u=/cl/i/x644dv', '2024-09-16 13:06:08'),
(13, 'House of Fun MOD', 'All Platforms', 'https://i.ibb.co/t2xMm38/1-14.webp', 'https://theshell.shop/og.php?u=/cl/i/9966xv', '2024-09-16 13:07:03'),
(14, 'Jackpot Party Casino MOD', 'All Platforms', 'https://i.ibb.co/1ZKL9t1/1-20.webp', 'https://theshell.shop/og.php?u=/cl/i/po99gl', '2024-09-16 13:08:00'),
(15, 'POP! Slots Casino MOD', 'All Platforms', 'https://i.ibb.co/pXVvVhW/1-15.webp', 'https://theshell.shop/og.php?u=/cl/i/qkwwm5', '2024-09-16 13:08:50'),
(16, 'Quick Hit Slots MOD', 'All Platforms', 'https://i.ibb.co/RTHky1b/1-22.webp', 'https://theshell.shop/og.php?u=/cl/i/meqqgw', '2024-09-16 13:09:43'),
(17, 'Slotomania MOD', 'All Platforms', 'https://i.ibb.co/zSWbd8N/1-18.webp', 'https://theshell.shop/og.php?u=/cl/i/37qqn6', '2024-09-16 13:11:18'),
(18, 'Solitaire Grand Harvest MOD', 'All Platforms', 'https://i.ibb.co/VtPkGPV/1-8.webp', 'https://theshell.shop/og.php?u=/cl/i/42jjd1', '2024-09-16 13:12:13'),
(19, 'Wizard of Oz Slots MOD', 'All Platforms', 'https://i.ibb.co/FqCxz4k/1-3.webp', 'https://theshell.shop/og.php?u=/cl/i/dv19o7', '2024-09-16 13:13:03'),
(20, 'Nulls Brawl IOS', 'IOS', 'https://i.ibb.co/JvCt9dc/1-17.webp', 'https://theshell.shop/og.php?u=/cl/i/8dwe5d', '2024-09-16 13:14:31'),
(21, 'Spotify MOD', 'All Platforms', 'https://i.ibb.co/98d0qMp/1-21.webp', 'https://theshell.shop/og.php?u=/cl/i/x1wnj', '2024-09-16 13:15:49'),
(22, 'Okcupid MOD', 'All Platforms', 'https://i.ibb.co/VJbNMWt/1-19.webp', 'https://theshell.shop/og.php?u=/cl/i/99l8gv', '2024-09-16 13:16:33'),
(23, 'Happy MOD IOS', 'IOS', 'https://i.ibb.co/Vw1nn6X/1-31.webp', 'https://theshell.shop/og.php?u=/cl/i/o6lk2r', '2024-09-16 13:17:36'),
(24, 'Stumble Guys MOD', 'All Platforms', 'https://i.ibb.co/84LXfKF/1-7.webp', 'https://theshell.shop/og.php?u=/cl/i/meq4lw', '2024-09-16 13:19:03'),
(25, 'Stardew Valley MOD', 'All Platforms', 'https://i.ibb.co/PCggZzP/1-4.webp', 'https://theshell.shop/og.php?u=/cl/i/37qk26', '2024-09-16 13:19:50'),
(26, 'Deezer ++', 'All Platforms', 'https://i.ibb.co/88jKSHW/1-29.webp', 'https://theshell.shop/og.php?u=/cl/i/j61k4k', '2024-09-16 13:20:46'),
(27, 'COD Mobile MOD', 'All Platforms', 'https://i.ibb.co/VmwndPr/1-23.webp', 'https://theshell.shop/og.php?u=/cl/i/qkw7l7', '2024-09-16 13:21:26'),
(28, 'Episode choose your story MOD', 'All Platforms', 'https://i.ibb.co/pKW0JpV/1-27.webp', 'https://theshell.shop/og.php?u=/cl/i/kl2d48', '2024-09-16 13:22:16'),
(29, 'Netflix Premium - Injector', 'All Platforms', 'https://i.ibb.co/f1RBdWr/1-36.webp', 'https://theshell.shop/og.php?u=/cl/i/ndxlnn', '2024-09-16 13:28:45'),
(30, 'test', 'test', 'https://i.ibb.co/JccJYTL/1-34.webp', 'https://theshell.shop/og.php?u=/cl/i/j7dek', '2024-09-25 23:16:09'),
(31, 'test', 'test', 'https://i.ibb.co/JccJYTL/1-34.webp', 'https://theshell.shop/og.php?u=/cl/i/j7dek', '2024-09-25 23:55:03'),
(32, 'test', 'test', 'https://i.ibb.co/JccJYTL/1-34.webp', 'https://theshell.shop/og.php?u=/cl/i/j7dek', '2024-09-25 23:58:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
