-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 11:32 AM
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
-- Database: `restaurentms`
--

-- --------------------------------------------------------

--
-- Table structure for table `acroom`
--

CREATE TABLE `acroom` (
  `id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `roomtype` varchar(20) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'un book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acroom`
--

INSERT INTO `acroom` (`id`, `roomno`, `roomtype`, `price`, `detail`, `img`, `status`) VALUES
(133, 1, 'Delux', 700, 'nice', 'ac2.jpeg', 'book'),
(134, 11, 'Ac', 900, 'very nice', 'ac4.jpg', 'un book'),
(135, 903, 'Ac', 800, 'dfghj', 'ac5.jpg', 'un book'),
(136, 908, 'Delux', 800, 'very good', 'ac6.jpeg', 'un book');

-- --------------------------------------------------------

--
-- Table structure for table `addfood`
--

CREATE TABLE `addfood` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `foodtype` varchar(50) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `addfood`
--

INSERT INTO `addfood` (`id`, `name`, `foodtype`, `detail`, `price`, `img`) VALUES
(106, 'Dhosa', 'South Indian', 'dhosa', 200, 'dhosa.png'),
(107, 'khishti', 'Chinese', 'yummy', 300, 'chillipasta.jpg'),
(109, 'Coco', 'Deserts', 'yummy', 300, 'coldcoffee.jpg'),
(110, 'Burger', 'Italian', 'Burger', 60, 'burger.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_edit`
--

CREATE TABLE `admin_edit` (
  `admin_id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `roomtype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_edit`
--

INSERT INTO `admin_edit` (`admin_id`, `roomno`, `roomtype`) VALUES
(1, 121, 'deluxAC'),
(3, 523, 'nonAC'),
(4, 122, 'deluxAC'),
(5, 524, 'nonAC');

--
-- Triggers `admin_edit`
--
DELIMITER $$
CREATE TRIGGER `Audit_ac` AFTER INSERT ON `admin_edit` FOR EACH ROW BEGIN
        
IF (NEW.roomtype = 'AC') THEN
            INSERT INTO acroom

    SET  
	roomno = NEW.roomno,

    	roomtype =  NEW.roomtype,
	
	price = 3000,

	status = 'un book';

     
      END IF;
   

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audit_delux` AFTER INSERT ON `admin_edit` FOR EACH ROW BEGIN
     IF ( NEW.roomtype = 'deluxAC') THEN
        INSERT INTO deluxacroom
           SET
    
            roomno = NEW.roomno,

            roomtype =  NEW.roomtype,

           price = 5000,

           status = 'un book';
      
            
      END IF;
   
    

    

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audit_nonac` AFTER INSERT ON `admin_edit` FOR EACH ROW BEGIN
        
IF (NEW.roomtype = 'nonAC') THEN
            INSERT INTO nonac

    SET  
	    roomno = NEW.roomno,

    	roomtype =  NEW.roomtype,
	
	   price = 1500,

	   status = 'un book';

     
      END IF;
   

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `card details`
--

CREATE TABLE `card details` (
  `id` int(11) NOT NULL,
  `cardno` bigint(16) NOT NULL,
  `cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card details`
--

INSERT INTO `card details` (`id`, `cardno`, `cvv`) VALUES
(1, 1111111111111111, 111),
(2, 2222222222222222, 222),
(5, 123412341234, 123);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `mobile`, `address`, `message`) VALUES
(3, 'neel', 'neel@gmail.com', 1223344558, '', 'food is not good'),
(4, 'jasprit', 'jasprit@gmail.com', 9889988998, '', 'what is the price of AC room?'),
(5, 'harsh', 'harsh@gmail.com', 1234567899, '', 'room pricw'),
(6, '222', 'shruti@gmail.com', 4545465, '', 'xghc\r\n'),
(7, 'Mihir Gediya', 'berlin.asd123@gmail.com', 70699965355, '', 'hey there'),
(8, 'Maulik Gediya', 'michalcorl7@gmail.com', 70699965355, '', 'Tatakae'),
(9, 'Maulik Gediya', 'michalcorl7@gmail.com', 70699965355, '', 'Tatakae'),
(10, 'Maulik Gediya', 'michalcorl7@gmail.com', 70699965355, '', 'Tatakae'),
(11, 'naruto', 'mk@email.com', 70699965355, '', 'Shinzo wo Sasageyo!'),
(12, 'Mili', 'berlin.asd123@gmail.com', 70699965355, '', 'Shinzo wo Sasageyo!'),
(13, 'Mihir Gediya', 'michalcorl7@gmail.com', 70699965355, '', 'Tatakae'),
(14, 'naruto', 'mgediya00@gmail.com', 70699965355, '', 'hey there'),
(15, 'mili', 'akashmangukiya9651@gmail.com', 9156011597, '331-32 FLAT 304 NARAYAN NAGAR SOC. ,KATARGAM', 'dfghj'),
(16, 'krushal', 'krushalsardhara16@gmail.com', 8156011597, '331-32 FLAT 304 NARAYAN NAGAR SOC. ,KATARGAM', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`) VALUES
(96, 'mili', 'akashmangukiya9651@gmail.com', 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(255) NOT NULL,
  `user_id` text NOT NULL,
  `phone` bigint(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `user_id`, `phone`, `address`) VALUES
(5, 'rohiy', 336366363, 'munoooo'),
(6, 'giri', 5555666677, 'pune'),
(19, 'virat', 102030405, 'burud goan road'),
(23, 'Yash pokharna ', 7768561235, 'burud goan road'),
(24, 'Yash pokharna ', 7765898978, 'burud goan road'),
(25, 'unnatti ', 9421197320, 'saras nagar nali me'),
(26, 'jasprit ', 9889988998, 'chandan nagar'),
(27, 'Yash pokharna ', 1223344558, 'burud goan road'),
(28, 'harsh', 1223344558, 'burud goan road'),
(29, 'BHADRESHBHAI', 9825880386, '8,Dharmajivan house kalakunj Nana varacha Surat'),
(30, 'shruti', 5656565656, 'kalakunj'),
(31, 'BHADRESHBHAI', 9825880386, '8,Dharmajivan house kalakunj Nana varacha Surat'),
(32, 'Gojo Satoru', 70699965355, 'ghar'),
(33, 'Gojo Satoru', 70699965355, 'ghar'),
(34, 'Gojo Satoru', 70699965355, 'ghar'),
(35, 'satoru_gojo', 1234567899, 'ghar');

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `id` int(11) NOT NULL,
  `hno` int(11) NOT NULL,
  `hallyype` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 200,
  `status` varchar(20) NOT NULL DEFAULT 'un book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`id`, `hno`, `hallyype`, `price`, `detail`, `image`, `capacity`, `status`) VALUES
(5, 1, 'Anniversary', 20000, 'fully ac hall', 'hall2.jpg', 200, 'not booked');

-- --------------------------------------------------------

--
-- Table structure for table `hall-bookings`
--

CREATE TABLE `hall-bookings` (
  `id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall-bookings`
--

INSERT INTO `hall-bookings` (`id`, `h_id`, `date`) VALUES
(1, 5, '2023-03-30'),
(2, 5, '2023-04-01'),
(12, 5, '2023-09-04'),
(13, 6, '2023-04-09'),
(14, 6, '2023-04-16'),
(15, 6, '2023-04-23'),
(16, 6, '2023-04-23'),
(17, 6, '2023-04-23'),
(18, 5, '2023-04-02'),
(19, 5, '2024-02-03'),
(20, 5, '2024-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `hall_details`
--

CREATE TABLE `hall_details` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `hallbookingid` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `members` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall_details`
--

INSERT INTO `hall_details` (`id`, `userid`, `hallbookingid`, `username`, `members`) VALUES
(19, 0, 0, '', 125),
(20, 0, 0, '', 0),
(21, 0, 0, '', 160),
(22, 0, 0, '', 125),
(23, 0, 0, '', 125),
(24, 0, 0, '', 125),
(25, 0, 0, '', 99);

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `age` int(50) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `mno` bigint(10) NOT NULL,
  `adno` bigint(12) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `name`, `username`, `age`, `gen`, `email`, `password`, `address`, `city`, `state`, `mno`, `adno`, `status`, `resettoken`, `resettokenexpire`) VALUES
(16, 'Gojo Satoru', 'satoru_gojo', 0, 'Male', 'berlin.asd123@gmail.com', '$2y$10$7LY4iBbtCOY0yY.UG9PwdOobSDunGu4I2aPI6q8c5G7aQJhW9RkaO', 'ghar', 'surat', 'gujarat', 7069965355, 111122223333, NULL, NULL, NULL),
(20, 'krushal', 'krushal12', 20, 'Male', 'krushalsaradhara16@gmail.com', '$2y$10$dP5kL829446didF2BGk3YuJHZXrbzy46r5077dInsRu8PEE45ADIq', '331-32 FLAT 304 NARAYAN NAGAR SOC. ,KATARGAM', 'SURAT', 'Gujarat', 8156011597, 123412341234, '1', NULL, NULL),
(21, 'krushal', 'krushal16', 20, 'Male', 'krushalsardhara16@gmail.com', '$2y$10$Wm0w2PBMrDlWn4HFqOJW3u5GUq2YX3qcEutWJleMROIRwAiDgpK0.', '331-32 FLAT 304 NARAYAN NAGAR SOC. ,KATARGAM', 'SURAT', 'Gujarat', 8156011597, 123412341234, NULL, NULL, NULL),
(19, 'mili', 'milijiyani', 21, 'Female', 'milijiyani53@gmail.com', '$2y$10$U4BaoZQ4N4T0LZtHgZIU5eSqgZewFU.WOY6PRjyhKBolHeySSu28a', '331-32 FLAT 304 NARAYAN NAGAR SOC. ,KATARGAM', 'SURAT', 'Gujarat', 8156011597, 123412341234, '0', NULL, NULL),
(6, 'sk', 'sk1', 0, 'Female', 'shrutikathiriya1413@gmail.com', '$2y$10$kyNrPEpZ0f9i6N7iWXTUPOrPe.spa/myD7Q2OviXIvRgRI6tBICAe', 'kalakunj', 'surat', 'gujarat', 9825880386, 121212121212, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room booking`
--

CREATE TABLE `room booking` (
  `id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `cout` varchar(20) NOT NULL,
  `members` int(11) NOT NULL,
  `roomtype` varchar(20) DEFAULT NULL,
  `no of rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room booking`
--

INSERT INTO `room booking` (`id`, `r_id`, `name`, `address`, `state`, `city`, `email`, `cin`, `cout`, `members`, `roomtype`, `no of rooms`) VALUES
(93, 0, 'harsh', 'burud goan', 'maharashtra', 'Ahmednagar', 'harsh@gmail.com', '2021-12-11', '2021-12-12', 1, 'Delux AC', 1),
(94, 0, 'skk', '8,Dharmajivan', 'Gujarat', 'Surat', 'manishkathirya4758@email.com', '2023-04-02', '2023-04-09', 10, 'Ac rooms', 4),
(95, 0, 'skk', '8,Dharmajivan', 'Gujarat', 'Surat', 'manishkathirya4758@email.com', '2023-04-02', '2023-04-09', 10, 'Ac rooms', 4),
(97, 133, 'milijiyani', '', '', '', '', '2024-02-02 22:35:00', '2024-02-02 22:35:00', 2, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acroom`
--
ALTER TABLE `acroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addfood`
--
ALTER TABLE `addfood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_edit`
--
ALTER TABLE `admin_edit`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `card details`
--
ALTER TABLE `card details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hall-bookings`
--
ALTER TABLE `hall-bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hall_details`
--
ALTER TABLE `hall_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `room booking`
--
ALTER TABLE `room booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acroom`
--
ALTER TABLE `acroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `addfood`
--
ALTER TABLE `addfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_edit`
--
ALTER TABLE `admin_edit`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `card details`
--
ALTER TABLE `card details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `hall`
--
ALTER TABLE `hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hall-bookings`
--
ALTER TABLE `hall-bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hall_details`
--
ALTER TABLE `hall_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `room booking`
--
ALTER TABLE `room booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
