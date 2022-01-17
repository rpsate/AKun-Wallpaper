-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-07-02 05:15:01
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `searchimages`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_root`
--

CREATE TABLE `admin_root` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `admin_root`
--

INSERT INTO `admin_root` (`id`, `username`, `password`, `email`) VALUES
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rpsates@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `imageName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagePath` char(40) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `images`
--

INSERT INTO `images` (`id`, `imageName`, `imagePath`) VALUES
(57, '习大大大大大', 'e59ffc584b9f4b58cb96501e1506a7d4.jpg'),
(58, '习大大大大大大', '54dbc32738de77bb0685030a15f463eb.jpg'),
(61, '1', 'dfde92df1571446b6d0d22ae15f58613.jpg'),
(62, '12', 'fc0dd211a27d2e52ae3997347c3f62de.jpg'),
(63, '13', 'b77fc9e80f6ea5768dbbd3d9c3507e52.jpg'),
(64, '14', '4733064dd13d6a1a9b6890b6fd7f312c.jpg'),
(65, '15', 'b1ea474b38ef8ab1a00f56bbe9070f2e.jpg'),
(66, '16', '7821549a85924b6a92bdf901c7f9c2c2.jpg'),
(67, '17', 'c24d5813ecc7bbccb4ab89ddb7677b13.jpg'),
(68, '18', '4e4d68e88b9454e713fdf4863efa501e.jpg'),
(69, '19', '3e82f1024d7c2dbcda7b083f9faac313.jpg'),
(70, '10', 'ff7a72b3c197076a89e95a50ef3d30bb.jpg'),
(71, '111', '7147e111ab448697e9245efe94a3e428.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_root`
--
ALTER TABLE `admin_root`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `imageName` (`imageName`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_root`
--
ALTER TABLE `admin_root`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
