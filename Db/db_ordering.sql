-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 08:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `fname`, `lname`, `gender`, `address`, `username`, `password`) VALUES
(1, 'Luz', 'Zuniga', 'Female', 'Brgy Pob East', 'admin', '7488e331b8b64e5794da3fa4eb10ad5d');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_title`, `status`) VALUES
(16, 'Softdrinks/Juices', 'active'),
(17, 'Liquors and Beers', 'active'),
(18, 'Can Goods', 'active'),
(20, 'snacks', 'inactive'),
(21, 'snacks to', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `checkout_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `checkout_Qty` int(11) NOT NULL,
  `status_order` int(11) NOT NULL DEFAULT 0,
  `proof_of_delivery` varchar(255) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `proof_gcpayment` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`checkout_id`, `reg_id`, `menu_id`, `cat_id`, `phone`, `address`, `checkout_Qty`, `status_order`, `proof_of_delivery`, `payment_method`, `proof_gcpayment`, `active`, `order_date`, `delivered_date`) VALUES
(63, 24, 15, 16, 21231312, 'asdfafdsa', 1, 3, './uploads/_pic66ed6e98e67adresumepic.jpg', 'Cash On Delivery', '', 3, '2024-09-20 15:16:05', '2024-09-20 06:46:16'),
(64, 24, 16, 16, 2321321, 'adfsa', 1, 3, './uploads/_pic66ed6edc9f002typing test speed.png', 'Cash On Delivery', '', 3, '2024-09-20 12:55:52', '2024-09-20 06:47:24'),
(65, 24, 16, 16, 2433, 'asda', 1, 3, './uploads/_pic66ed920caced8LAPTOP SPECS.png', 'Cash On Delivery', '', 3, '2024-09-20 15:17:40', '2024-09-20 09:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_ratings`
--

CREATE TABLE `tbl_item_ratings` (
  `rate_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `product_quality` int(11) NOT NULL DEFAULT 0,
  `seller_service` int(11) NOT NULL DEFAULT 0,
  `delivery_speed` int(11) NOT NULL DEFAULT 0,
  `message` text NOT NULL,
  `raviews_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_item_ratings`
--

INSERT INTO `tbl_item_ratings` (`rate_id`, `menu_id`, `user_id`, `product_quality`, `seller_service`, `delivery_speed`, `message`, `raviews_date`) VALUES
(3, 15, 23, 4, 4, 4, 'Good Items!', '2024-07-16 17:09:16'),
(4, 15, 24, 3, 4, 4, 'k lang', '2024-08-24 11:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `stocks` int(11) NOT NULL,
  `pic` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `cat_id`, `title`, `description`, `price`, `stocks`, `pic`, `status`) VALUES
(15, 16, 'Chuckie 110ml', '110ml', 151, 19, './uploads/_pic66d8ad64bc6c8tryyyy.png', 'active'),
(16, 16, 'Chuckie 180ml', '180ml', 25, 398, './uploads/_Avatar661fd8613bb9c436332208_733883788903614_8237104876848054411_n.jpg', 'active'),
(17, 16, 'Chuckie 180ml', '180ml', 25, 0, './uploads/_Avatar661fd8fcc8330436565351_806836684115213_3282588920605190974_n.jpg', 'active'),
(18, 16, 'Zesto Big 250ml', '250ml', 15, 0, './uploads/_Avatar661fdaa1bd821436565351_806836684115213_3282588920605190974_n.jpg', 'active'),
(19, 16, 'Zesto BIG 250ml', '250ml', 12, 0, './uploads/_Avatar661fdad204ad6436236045_357708003366410_748773373423386221_n.jpg', 'active'),
(20, 16, 'Zesto 150ml', '150ml', 8, 0, './uploads/_Avatar661fdbde46113436068996_1029219338523410_2474952627244943371_n.jpg', 'active'),
(21, 16, 'C2 SOLO 230ml', '230ml', 13, 0, './uploads/_Avatar661fdcb6f1f1010043243_c2-solo-green-tea-apple-230ml-24s.png', 'active'),
(22, 16, 'Gatorade 500ml', '500ml', 50, 0, './uploads/_Avatar661fdd473716bgatorade-blue-bolt-500ml_2.jpg', 'active'),
(23, 16, 'Gatorade 350ml', '350ml', 50, 496, './uploads/_Avatar661fdebe098f8Screenshot (162).png', 'active'),
(24, 16, 'Coke,Royal,Sprite liter', '1.liter', 75, 496, './uploads/_Avatar661fdfc7f04f4Screenshot (163).png', 'active'),
(25, 16, 'Coke,Royal,Sprite Kasalo', 'kasalo', 25, 499, './uploads/_Avatar661fe096af748Screenshot (164).png', 'active'),
(26, 16, 'Coke,Royal,Sprite 120z', '120z', 35, 500, './uploads/_Avatar661fe20db6f11Screenshot (165).png', 'active'),
(27, 16, 'Coke,Royal,Sprite 8 0z.', '8 0z.', 10, 500, './uploads/_Avatar661fe28a6aeabScreenshot (166).png', 'active'),
(28, 16, 'Coke,Royal,Sprite Mismo', 'Mismo', 20, 500, './uploads/_Avatar661fe33d8095fScreenshot (167).png', 'active'),
(29, 16, 'Coke Sakto', 'Sakto', 25, 500, './uploads/_Avatar661fe48c69371Screenshot (168).png', 'active'),
(30, 16, 'Nestea Apple,Lemon', 'Nestea', 20, 500, './uploads/_Avatar661fe4bd59acaScreenshot (169).png', 'active'),
(31, 16, 'Cobra 350ml', '350ml', 40, 500, './uploads/_Avatar661fe56360a4bScreenshot (170).png', 'active'),
(32, 17, 'Emperador Light ', '750ml', 170, -6, './uploads/_Avatar661fe61f1cd0eScreenshot (171).png', 'active'),
(33, 17, 'San Mig Light ', '330ml', 45, 1000, './uploads/_Avatar661fe74d3d640Screenshot (172).png', 'active'),
(34, 17, 'Tanduay Ice', '330ml', 55, 900, './uploads/_Avatar661fe8113c697Screenshot (173).png', 'active'),
(35, 17, 'Soju', '360ml', 130, 1000, './uploads/_Avatar661fe879028eeScreenshot (174).png', 'active'),
(36, 17, 'Alfonso', 'light', 500, 2000, './uploads/_Avatar661fe8e14d5c9Screenshot (175).png', 'active'),
(37, 17, 'Ginebra San Miguel', 'Kwatro Kantos and bilog', 120, 1000, './uploads/_Avatar661fe95a64b72Screenshot (176).png', 'active'),
(38, 17, 'Red Horse', '330ml', 60, 1000, './uploads/_Avatar661fea5b71b99Screenshot (177).png', 'active'),
(39, 18, 'Corned Beef Purefoods', ' Purefoods', 105, 1202, './uploads/_Avatar661fedc3235caScreenshot (178).png', 'active'),
(40, 18, 'Corned Beef Argentina', 'argentina', 70, 1500, './uploads/_Avatar661fee208fe4cScreenshot (179).png', 'active'),
(41, 18, 'Corned Beef Star', 'Star', 70, 1450, './uploads/_Avatar661fee70b6690Screenshot (180).png', 'active'),
(42, 18, 'Sardines Mega', 'Mega', 35, 1000, './uploads/_Avatar661fef0154531Screenshot (181).png', 'active'),
(43, 18, 'Sardines 555', '555', 38, 1000, './uploads/_Avatar661fef516467dScreenshot (182).png', 'active'),
(44, 18, 'Tuna', 'century', 45, 1000, './uploads/_Avatar661fef7f5ec60Screenshot (183).png', 'active'),
(45, 20, 'asda', 'dsada', 24234, 245, './uploads/_pic6625d03914536Screenshot (199).png', 'inactive'),
(46, 20, 'nova', 'barbeque', 15, 500, './uploads/_pic6625d071083b6Screenshot (198).png', 'inactive'),
(47, 21, 'nova', 'barbeque', 15, 400, './uploads/_pic662600024b3cfScreenshot (198).png', 'active'),
(48, 21, 'safdsa', 'asfdsa', 22.22, 11, './uploads/_pic66c77007a4a5etyping test speed.png', 'inactive'),
(49, 18, 'asdasd', 'asdsa', 10, 22, './uploads/_pic66d8a30b4cbc7tryyyy.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `reg_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `userCode` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`reg_id`, `fname`, `m_name`, `lname`, `userCode`, `password`) VALUES
(1, 'john', '', 'doe', 'user', '3a4ebf16a4795ad258e5408bae7be341'),
(2, 'james', '', 'doe', 'james', 'b4cc344d25a2efe540adbf2678e2304c'),
(3, 'jillian', '', 'De Leon', '123456', '25d55ad283aa400af464c76d713c07ad'),
(4, 'graceann', '', 'abesamis', 'Grace1', '25d55ad283aa400af464c76d713c07ad'),
(5, 'jillian', '', 'De Leon', 'jillian', 'd656b781b766b7ad96dbdc18cc32c766'),
(6, 'Angelika', '', 'Pangilinan', 'Angelika1', 'ccd5750831e54bd24410607b559269bc'),
(7, 'grasya', '', 'simaseba', 'grasya', '5ad4991b04f670a9ab8fa71fc293e642'),
(8, 'ace', '', 'esporna', 'ace', '1b16e56f227e9dc88e6b0f761cd5eed8'),
(9, 'grasis', '', 'hernando', 'grasis', 'b10fad26edc925ad42d1e7f07c203246'),
(10, 'dan', '', 'apan', 'dan12', '52fde997e6940d0ddec1943a4383a89e'),
(11, 'dan12', '', 'apan', 'dan12', '52fde997e6940d0ddec1943a4383a89e'),
(12, 'joana', '', 'mallare', 'joana1', '3f2ae483a1c3445565f1c0a138647ac8'),
(13, 'jane', '', 'pajarillaga', 'jane123', '80e9348050f6191b9ec5e3692e259998'),
(14, 'john', '', 'doe', 'johndoe@gmail.com', '29a1df4646cb3417c19994a59a3e022a'),
(15, 'jerome', '', 'Rivera', 'Jerome2', '2df21e820448b51a7e1f99f9466875bd'),
(16, 'bianca', '', 'de leon', 'bianca10', 'abd3f32417d24d49c6de6d745eb25dfe'),
(17, 'ivan', '', 'Dela Cruz', 'ivan12', 'cf1c48aab0920df9ad3287f851d8a942'),
(18, 'claire', '', 'paguio', 'clare1', 'dcbcb26137c6122365df6dcc240e6170'),
(19, 'ronna', '', 'magisa', 'ronna1', '18c97ab7c719bfcdfb73d662d8d7a914'),
(20, 'jona', '', 'diaz', 'jona12', 'ea2cb077846492795e91c64136661c52'),
(21, 'jomari', '', 'manabat', 'jomari1', '653525044ec872ff7d934135d9806091'),
(22, 'john', '', 'doe', 'jena1', '25d55ad283aa400af464c76d713c07ad'),
(23, 'John', '', 'Doe', 'doe@gmail.com', '4b0a48c3c0a19a4d4ba9a0cd3b6147b4'),
(24, 'sample', 'User', 'lang', 'sample', '4e91b1cbe42b5c884de47d4c7fda0555'),
(25, 'Try', 'Lang', 'Ulit', 'try', 'bced1d9f04f74cec2bb81e73af32303f'),
(26, 'Gago', 'Ka', 'Ba?', 'gago', '700c792882f6547bc4c1903995aafaf8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rates` int(11) NOT NULL,
  `review` text NOT NULL,
  `comment` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `name`, `rates`, `review`, `comment`, `status`) VALUES
(3, 'drinks', 0, 'Very Poor', 'bad taste!', 'inactive'),
(4, 'jane', 0, 'Very Poor', 'good taste', 'inactive'),
(5, 'john doe', 5, 'Product Qulity', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, aut!', 'active'),
(6, 'jane doe', 1, 'Delivery Speed', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, aut!', 'active'),
(7, 'Grace ann', 5, 'Product Qulity', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, aut!', 'active'),
(8, 'jomari', 5, 'Product Qulity', 'delicious', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `tbl_item_ratings`
--
ALTER TABLE `tbl_item_ratings`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_item_ratings`
--
ALTER TABLE `tbl_item_ratings`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
