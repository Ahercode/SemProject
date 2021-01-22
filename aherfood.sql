-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 03:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `susername` varchar(50) NOT NULL,
  `dusername` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `seen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `image`, `username`, `password`) VALUES
(1, 'philip Gyan', '', 'phils gh', '46bf36a7193438f81fccc9c4bcc8343e'),
(2, 'Obed Anang', '', 'tech-guy', 'f8862b27f1c17f14c690205d04507a30'),
(3, 'philip kekeli', '', 'ahercode', '65bb86549756830caa529e032f829eb2'),
(4, 'aher code', '', 'ahertoGYan', '80c9ef0fb86369cd25f90af27ef53a9e'),
(5, 'Philip Ladzaka', '', 'khuame', '1dc90e80c77fe245a82ea7ed30d1f849'),
(6, 'Jack Mensah', '', 'hener', '7097c422d46bb61fc4c169dbbae1c1e6'),
(7, 'philip aherto', '', 'kwame Gh', '287f580dee5578bed9d79202c7782c2d'),
(8, 'sediq', '', 'phils', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categ`
--

CREATE TABLE `tbl_categ` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `featured` varchar(20) NOT NULL,
  `active` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categ`
--

INSERT INTO `tbl_categ` (`id`, `title`, `image`, `featured`, `active`) VALUES
(1, 'Burger cheese', 'category_632.jpg', 'No', 'No'),
(2, 'Pizza Philip', 'category_504.jpg', 'No', 'No'),
(3, 'AherFood', 'category_296.jpg', 'Yes', 'Yes'),
(4, 'KFC', 'category_363.jpg', 'Yes', 'Yes'),
(5, 'Sweets', 'category_369.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `descrip` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categ_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `descrip`, `price`, `image`, `categ_id`, `featured`, `active`) VALUES
(6, 'Burger cheese', 'Delicious foods from aherFoods ', '15', 'food_1259.jpg', 1, 'Yes', 'Yes'),
(7, 'Pizza King', 'A taste of Ghana ever', '20', 'food_5377.jpg', 3, 'Yes', 'Yes'),
(8, 'AherFood', 'Enter a brief description of food here ', '15', 'food_9722.jpg', 2, 'Yes', 'Yes'),
(9, 'Doughnut', 'Enter a brief description of food here ', '18', 'food_387.jpg', 4, 'Yes', 'Yes'),
(10, 'Sweets', 'jcdfrrueiuijfiruierkjfiirijfif', '17', 'food_3849.jpg', 5, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_email` varchar(150) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_contact` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `date`, `status`, `cus_name`, `cus_email`, `cus_address`, `cus_contact`) VALUES
(1, '6', '15', 2, '30', '0000-00-00 00:00:00', 'Ordered', 'Philip Aherto', 'philipkelly407@gmail.com', 'Accra-Modex Junctioon', '0249182388'),
(2, '7', '20', 4, '80', '0000-00-00 00:00:00', 'Ordered', 'Philip Aherto', 'philipkelly407@gmail.com', 'Modex - Accra Ghana', '249182388'),
(3, 'Doughnut', '18', 2, '36', '2021-01-12 01:33:28', 'Delivered', 'Philip Ladzka', 'ahercode@gmail.com', 'Accra- SCC', '249182388'),
(4, 'Burger cheese', '15', 2, '30', '2021-01-12 01:40:32', 'Delivered', 'Philip Aherto', 'philipkelly407@gmail.com', 'Accra - Modex', '249182388'),
(5, 'Sweets', '17', 2, '34', '2021-01-12 01:42:57', 'OnDelivery', 'Philip Aherto', 'pahero@gail.com', 'ghana', '249182388'),
(6, 'AherFood', '15', 1, '15', '2021-01-12 01:44:59', 'Cancelled', 'Philip Ladzaka', 'yjgh@gmail.com', 'modex', '249182388'),
(7, 'Sweets', '17', 1, '17', '2021-01-12 01:47:15', 'OnDelivery', 'Philip Aherto', 'philipkelly407@gmail.com', 'west hills', '04294967295'),
(8, 'Pizza King', '20', 1, '20', '2021-01-12 01:49:14', 'Delivered', 'Philip Ladzaka', 'bestnel123@gmail.com', 'city', '4294967295'),
(9, 'Sweets', '17', 1, '17', '2021-01-12 01:53:06', 'Ordered', 'Philip Ladzaka', 'philipkelly407@gmail.com', 'Accra', '+233249182388'),
(10, 'Doughnut', '18', 2, '36', '2021-01-12 12:40:13', 'Cancelled', 'Philip Ladzaka', 'philipkelly407@gmail.com', 'gh', '+233249182388'),
(11, 'Burger cheese', '15', 2, '30', '2021-01-13 01:45:31', 'Cancelled', 'Philip Aherto', 'bestnel123@gmail.com', 'hhd', '+233249182388');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categ`
--
ALTER TABLE `tbl_categ`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_categ`
--
ALTER TABLE `tbl_categ`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

