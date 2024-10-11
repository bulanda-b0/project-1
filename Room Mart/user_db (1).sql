-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 01:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_room`
--

CREATE TABLE `booked_room` (
  `booked_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `booked_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_room`
--

INSERT INTO `booked_room` (`booked_id`, `user_id`, `property_id`, `booked_date`) VALUES
(1, 2, 7, '0000-00-00'),
(2, 2, 6, '0000-00-00'),
(3, 2, 8, '2023-09-22'),
(4, 2, 7, '2023-09-22'),
(5, 3, 7, '2023-09-22'),
(6, 2, 5, '2023-09-23'),
(7, 3, 13, '2023-09-23'),
(8, 2, 3, '2023-09-23'),
(9, 3, 11, '2023-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`contact_id`, `name`, `email`, `message`) VALUES
(1, 'bulanda belbase', 'bulanda@gmail.com', 'hi guys how are you'),
(2, 'bulanda belbase', 'bulanda@gmail.com', 'hi guys how are you'),
(3, 'bijayan raj yadav', 'bijayan@gmail.com', 'hello, i need a designer'),
(4, 'sunil telli', 'sunil@gmail.com', 'i am a dumb guy'),
(5, 'sunita kumari', 'sunita@gmail.com', 'i want to design a software for my business.'),
(6, 'hari', 'hari@gmail.com', 'i am also a dev'),
(7, 'kiran', 'kiran@gmail.com', 'we want photographer'),
(8, 'bulanda', 'bulanda@gmail.com', 'hello how are you'),
(9, 'roma poudel', 'roma@gmail.com', 'hello guys'),
(10, 'amrit', 'amrit@gmail.com', 'hello'),
(11, 'hari', 'hari@gmail.com', 'hi'),
(12, 'kiran', 'kiran@gmail.com', 'hello'),
(13, 'sony shah', 'sony@gmail.com', 'hello how are you'),
(14, 'raja', 'nfjfeiffi@gmail.com', 'hi g');

-- --------------------------------------------------------

--
-- Table structure for table `listproperty_form`
--

CREATE TABLE `listproperty_form` (
  `property_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `p_location` varchar(100) NOT NULL,
  `post_date` date NOT NULL,
  `p_description` varchar(300) NOT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `property_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listproperty_form`
--

INSERT INTO `listproperty_form` (`property_id`, `user_id`, `property_type`, `price`, `p_location`, `post_date`, `p_description`, `booking_status`, `property_image`) VALUES
(2, 3, 'Flat', 1200000, 'bhaktapu, changunarayan', '2023-07-18', 'home for rent with all features available. ', NULL, 'propertypicture/butterfly.jpeg'),
(3, 3, 'Double Room', 10000, 'koteswor,3', '2023-07-18', 'two flat with kithen and washroom.', 'ok', 'propertypicture/Tomato flower.jpeg'),
(4, 3, 'Flat', 12000, 'kandaghari', '2023-07-18', 'every facilities are available.', NULL, 'propertypicture/2023-02-19 82353 AM.png'),
(5, 3, 'Single Room', 3000, 'changunarayan', '2023-07-19', 'single room for student available for cheap rate', NULL, 'propertypicture/2023-02-21 54519 PM.jpg'),
(6, 3, 'Double Room', 12000, 'nec clz side', '2023-07-19', 'two rooms available for students. one kitchen and one bedroom space. one washroom also available for whole flat', NULL, 'propertypicture/dandelionwbees.jpeg'),
(7, 6, 'Flat', 20000, 'bhaktapu, changunarayan', '2023-07-20', 'flat with 2bhk flat', NULL, 'propertypicture/rain lily.jpeg'),
(8, 3, 'Flat', 12000, 'bhaktapu, changunarayan', '2023-07-20', 'hello', NULL, 'propertypicture/IMG_20230511_072759.jpg'),
(9, 3, 'Single Room', 13000, 'kandaghari', '2023-02-04', 'two rooms with great facility', NULL, 'propertypicture/rooms.jpg'),
(11, 2, 'Single Room', 2300, 'changunarayan', '2023-09-23', 'full services with attached bathrooms', 'ok', 'propertypicture/IMG_20230405_102306.jpg'),
(12, 2, 'Flat', 20000, 'bhaktapu, changunarayan', '2023-09-23', 'everything available', 'deleted', 'propertypicture/IMG_20230404_205313.jpg'),
(13, 2, 'Double Room', 10000, 'kandaghari', '2023-09-23', 'facility is good', 'deleted', 'propertypicture/IMG_20230420_190220.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `signup_form`
--

CREATE TABLE `signup_form` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `addr` varchar(60) NOT NULL,
  `npassword` varchar(100) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  `usertype` varchar(10) NOT NULL DEFAULT 'user',
  `profile_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_form`
--

INSERT INTO `signup_form` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `mobileno`, `addr`, `npassword`, `cpassword`, `usertype`, `profile_img`) VALUES
(1, 'saroj', '', '', 'sirir@gmail.com', '', '', '', '', 'owner', NULL),
(2, 'bijayan', 'raj', 'yadav', 'bijayan@gmail.com', '9811111111', 'bhaktapur', 'bijayan123', 'bijayan123', 'tenant', 'images/2023-02-21 54329 PM.jpg'),
(3, 'sunil', 'kumar', 'telli', 'sunil@gmail.com', '9001292219', 'ktm', 'sunil123', 'sunil123', 'owner', 'images/sunil1.jpg'),
(4, 'sony', '', 'shah', 'sony@gmail.com', '9585666556', 'janakpur', 'sony123', 'sony123', 'tenant', NULL),
(5, 'raju', 'kumar', 'kc', 'raju@gmail.com', '9865655656', 'butawal,nayagaun', 'raju123', 'raju123', 'tenant', 'images/2023-02-20 94717 AM.jpg'),
(6, 'manoj', '', 'mukhiya', 'manoj@gmail.com', '9845446565', 'janakpur dham', 'manoj123', 'manoj123', 'owner', 'images/Tomato flower.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_room`
--
ALTER TABLE `booked_room`
  ADD PRIMARY KEY (`booked_id`),
  ADD KEY `book_user_fk` (`user_id`),
  ADD KEY `book_prop_fk` (`property_id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `listproperty_form`
--
ALTER TABLE `listproperty_form`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `signup_form`
--
ALTER TABLE `signup_form`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_room`
--
ALTER TABLE `booked_room`
  MODIFY `booked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `listproperty_form`
--
ALTER TABLE `listproperty_form`
  MODIFY `property_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `signup_form`
--
ALTER TABLE `signup_form`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked_room`
--
ALTER TABLE `booked_room`
  ADD CONSTRAINT `book_prop_fk` FOREIGN KEY (`property_id`) REFERENCES `listproperty_form` (`property_id`),
  ADD CONSTRAINT `book_user_fk` FOREIGN KEY (`user_id`) REFERENCES `signup_form` (`user_id`);

--
-- Constraints for table `listproperty_form`
--
ALTER TABLE `listproperty_form`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `signup_form` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
