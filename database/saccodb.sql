-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 10:09 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saccodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `adminId` int(20) NOT NULL,
  `photo` blob NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact` varchar(20) NOT NULL,
  `joinDate` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `username` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`adminId`, `photo`, `admin_name`, `gender`, `contact`, `joinDate`, `status`, `username`, `pass`) VALUES
(7, 0x50415353504f52542e706e67, 'Harop Admin', 'Male', '78', '2020-05-04', 'Active', 'arop', '$2y$10$g2aQV.2s5RM71pvGkDN1H.vCKuh9J.YHajG3VMydykY/LEVkAUFUS'),
(8, 0x696d61676573304a3248574c4d342e6a7067, 'Prince', 'Other', '787', '2020-05-05', 'Active', 'prince', '$2y$10$6WymGNEujgz./Fi/g5E6teN8oI8uYonuH7pDWDryN.czDvqsPry36'),
(12, 0x696d61676573202833292e706e67, 'winnie', 'Female', '79', '2020-05-26', 'Active', 'winnie', '$2y$10$KWE15nYt61kl6tH0nDyEfeGH/HepfZd6HrWPMq6vUyYW2G5JTB6XW');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `logId` int(20) NOT NULL,
  `adminId` int(20) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`logId`, `adminId`, `activity`, `schedule`) VALUES
(379, 12, 'updated member information', '2020-05-26 15:43:48'),
(380, 12, 'logged out of the system', '2020-05-26 15:43:59'),
(381, 7, 'logged into the system', '2021-01-17 17:28:40'),
(382, 7, 'logged into the system', '2021-01-30 09:18:58'),
(383, 7, 'accessed admin information', '2021-01-30 09:20:23'),
(384, 7, 'updated administrator information', '2021-01-30 09:21:27'),
(385, 7, 'logged out of the system', '2021-01-30 09:28:20'),
(386, 7, 'logged into the system', '2021-01-30 13:06:05'),
(387, 7, 'logged out of the system', '2021-01-30 13:06:16'),
(388, 7, 'logged into the system', '2021-01-30 13:17:13'),
(389, 7, 'accessed admin information', '2021-01-30 13:17:38'),
(390, 7, 'logged out of the system', '2021-01-30 13:20:36'),
(391, 7, 'logged into the system', '2021-01-30 13:20:46'),
(392, 7, 'logged out of the system', '2021-01-30 13:20:49'),
(393, 7, 'logged into the system', '2021-01-30 14:07:07'),
(394, 7, 'logged out of the system', '2021-01-30 14:07:41'),
(395, 7, 'logged into the system', '2021-01-30 14:08:06'),
(396, 7, 'updated member information', '2021-01-30 14:09:44'),
(397, 7, 'added a new saving', '2021-01-30 14:11:22'),
(398, 7, 'added a new saving', '2021-01-30 14:11:49'),
(399, 7, 'approved withdraw of savings by a member', '2021-01-30 14:12:27'),
(400, 7, 'issued out a loan', '2021-01-30 14:14:38'),
(401, 7, 'recorded a loan paid back', '2021-01-30 14:16:36'),
(402, 7, 'accessed admin information', '2021-01-30 14:17:18'),
(403, 7, 'logged out of the system', '2021-01-30 14:18:25'),
(404, 7, 'logged into the system', '2021-01-30 23:30:52'),
(405, 7, 'sent a message', '2021-01-30 23:38:14'),
(406, 7, 'logged out of the system', '2021-01-30 23:38:34'),
(407, 7, 'logged into the system', '2021-01-30 23:44:10'),
(408, 7, 'recorded a loan paid back', '2021-01-30 23:47:20'),
(409, 7, 'recorded a loan paid back', '2021-01-30 23:47:41'),
(410, 7, 'recorded a loan paid back', '2021-01-30 23:48:20'),
(411, 7, 'logged out of the system', '2021-01-30 23:56:13'),
(412, 7, 'logged into the system', '2021-02-12 11:56:57'),
(413, 7, 'accessed admin information', '2021-02-12 11:59:29'),
(414, 7, 'accessed admin information', '2021-02-12 12:42:42'),
(415, 7, 'accessed admin information', '2021-02-12 12:49:20'),
(416, 7, 'recorded a loan paid back', '2021-02-12 12:50:03'),
(417, 7, 'recorded a loan paid back', '2021-02-12 12:50:33'),
(418, 7, 'recorded a loan paid back', '2021-02-12 12:50:52'),
(419, 7, 'logged into the system', '2021-06-14 11:03:27'),
(420, 7, 'updated member information', '2021-06-14 11:04:55'),
(421, 7, 'updated member information', '2021-06-14 11:05:24'),
(422, 7, 'updated member information', '2021-06-14 11:06:09'),
(423, 7, 'accessed admin information', '2021-06-14 11:06:28'),
(424, 7, 'updated administrator information', '2021-06-14 11:06:57'),
(425, 7, 'updated administrator information', '2021-06-14 11:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `expensetb`
--

CREATE TABLE `expensetb` (
  `expenseId` int(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expensetb`
--

INSERT INTO `expensetb` (`expenseId`, `date`, `description`, `amount`) VALUES
(14, '2020-05-14', 'For food', '10.00'),
(15, '2020-05-14', 'Offertory', '15.00'),
(16, '2020-05-14', 'charity', '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `gendertb`
--

CREATE TABLE `gendertb` (
  `genderId` int(20) NOT NULL,
  `gender` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gendertb`
--

INSERT INTO `gendertb` (`genderId`, `gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `historytb`
--

CREATE TABLE `historytb` (
  `historyId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historytb`
--

INSERT INTO `historytb` (`historyId`, `memberId`, `activity`, `schedule`) VALUES
(206, 102, 'logged into the system', '2020-05-26 15:44:06'),
(207, 100, 'logged into the system', '2021-01-17 17:25:09'),
(208, 100, 'logged out of the system', '2021-01-17 17:26:53'),
(209, 102, 'logged into the system', '2021-01-17 17:26:58'),
(210, 102, 'logged out of the system', '2021-01-17 17:27:02'),
(211, 102, 'logged into the system', '2021-01-30 09:13:30'),
(212, 102, 'logged out of the system', '2021-01-30 09:14:28'),
(213, 100, 'logged into the system', '2021-01-30 09:14:33'),
(214, 100, 'logged out of the system', '2021-01-30 09:14:37'),
(215, 102, 'logged into the system', '2021-01-30 09:28:24'),
(216, 102, 'logged out of the system', '2021-01-30 09:28:30'),
(217, 100, 'logged into the system', '2021-01-30 09:28:34'),
(218, 100, 'logged out of the system', '2021-01-30 13:05:49'),
(219, 100, 'logged into the system', '2021-01-30 14:18:57'),
(220, 100, 'logged out of the system', '2021-01-30 14:21:22'),
(221, 100, 'logged into the system', '2021-01-30 14:22:35'),
(222, 100, 'logged out of the system', '2021-01-30 14:22:42'),
(223, 100, 'logged into the system', '2021-01-30 23:38:47'),
(224, 100, 'sent a message', '2021-01-30 23:39:23'),
(225, 100, 'updated account information', '2021-01-30 23:42:52'),
(226, 100, 'logged out of the system', '2021-01-30 23:43:59'),
(227, 100, 'logged into the system', '2021-02-12 11:25:44'),
(228, 100, 'logged out of the system', '2021-02-12 11:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `inquirytb`
--

CREATE TABLE `inquirytb` (
  `inquiryId` int(20) NOT NULL,
  `dateComposed` datetime NOT NULL,
  `member` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquirytb`
--

INSERT INTO `inquirytb` (`inquiryId`, `dateComposed`, `member`, `contact`, `subject`, `message`) VALUES
(1, '2020-05-15 12:40:20', 'juliet', '3244', 'i want', 'i want to knw'),
(2, '2020-05-15 12:42:05', 'jmark', '32443', 'mark here', 'i am mark'),
(3, '2020-05-15 13:32:16', 'hed', '3245', 'to know', 'i would like to know if this planform is good for me or i should try somewhere else'),
(4, '2020-05-15 14:18:48', 'winnie', '3456', 'inquiry', 'i want to join you guys pliz register me'),
(5, '2020-05-15 15:21:38', 'sharon', '2345', 'clear', 'i want to close my account'),
(6, '2020-05-21 18:25:11', 'Gem', '4356', 'Check', 'hshjddhd hedwuewhyd hjdhsds hsddgeyd hdusahdh dudedejdd jddsjkdhddf kjdks fhef jkdjfhfekf jdfjhheufu jfjdfheuf jdjfjkeuf jdfdjfjeu');

-- --------------------------------------------------------

--
-- Table structure for table `loanhist`
--

CREATE TABLE `loanhist` (
  `loanhistId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `loanId` int(20) NOT NULL,
  `datePaid` date NOT NULL,
  `amountPaid` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loanhist`
--

INSERT INTO `loanhist` (`loanhistId`, `memberId`, `loanId`, `datePaid`, `amountPaid`) VALUES
(102, 100, 69, '2020-05-14', '5.00'),
(103, 100, 69, '2020-05-14', '6.00'),
(104, 100, 71, '2020-05-20', '20.00'),
(105, 100, 71, '2020-05-20', '2.00'),
(106, 101, 70, '2020-05-20', '20.00'),
(107, 101, 70, '2020-05-20', '20.00'),
(108, 101, 70, '2020-05-20', '20.00'),
(109, 101, 70, '2020-05-20', '6.00'),
(110, 100, 72, '2021-01-30', '40.00'),
(111, 100, 72, '2021-01-30', '15.00'),
(112, 100, 72, '2021-01-30', '20.00'),
(113, 100, 72, '2021-01-30', '30.00'),
(114, 100, 72, '2021-02-12', '50.00'),
(115, 100, 72, '2021-02-12', '0.00'),
(116, 100, 72, '2021-02-12', '-100.00');

-- --------------------------------------------------------

--
-- Table structure for table `loantb`
--

CREATE TABLE `loantb` (
  `loanId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `loanAmount` decimal(12,2) NOT NULL,
  `loanInterest` decimal(5,2) NOT NULL,
  `dateTaken` date NOT NULL,
  `dueDate` date NOT NULL,
  `loan_status` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loantb`
--

INSERT INTO `loantb` (`loanId`, `memberId`, `loanAmount`, `loanInterest`, `dateTaken`, `dueDate`, `loan_status`) VALUES
(69, 100, '10.00', '10.00', '2020-05-14', '2020-05-22', 0),
(70, 101, '60.00', '10.00', '2020-05-20', '2020-05-30', 0),
(71, 100, '20.00', '10.00', '2020-05-20', '2020-05-21', 0),
(72, 100, '50.00', '10.00', '2021-01-30', '2021-02-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `membertb`
--

CREATE TABLE `membertb` (
  `memberId` int(11) NOT NULL,
  `photo` blob NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact` varchar(20) NOT NULL,
  `joinDate` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membertb`
--

INSERT INTO `membertb` (`memberId`, `photo`, `member_name`, `gender`, `contact`, `joinDate`, `status`, `username`, `pass`) VALUES
(100, 0x50415353504f5254312e706e67, 'Harop', 'Other', '763', '2020-05-13', 'Active', 'harop', '$2y$10$UozxeTgucBiGo7I2Udq33elHpqcMfxdqDgD/CoqXOgG7GMw9NANvK'),
(101, 0x494d475f32303137303930315f3133303133362e6a7067, 'Jane Lillian', 'Female', '233', '2020-05-14', 'Inactive', 'jane', '$2y$10$nkSSAevfuDr7q8r7AqpZ.OwfW64pfxInonQXvg0/fUYOp3rrreOay'),
(102, 0x494d475f32303137303930315f3133303133362e6a7067, 'Suzan', 'Female', '76', '2020-05-20', 'Inactive', 'suzan', '$2y$10$xfJGzvNzrnhKRG1.Lags8Ou8pmBzDnrOZaJWZn7yVViDOeZ/sxA9m'),
(103, 0x696d6167657342514331364c504d2e6a7067, 'Winnie', 'Female', '70', '2020-05-26', 'Active', 'winnie', '$2y$10$SbSHJ0UKNraoUPc358vshOJ8TEM/CMJxJmUm3HGVBjsad15QghAqO');

-- --------------------------------------------------------

--
-- Table structure for table `messagetb`
--

CREATE TABLE `messagetb` (
  `messageId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `dateComposed` date NOT NULL,
  `messageBody` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messagetb`
--

INSERT INTO `messagetb` (`messageId`, `memberId`, `sender`, `dateComposed`, `messageBody`) VALUES
(46, 96, '96', '2020-05-11', 'hylo'),
(47, 100, 'Admin', '2020-05-14', 'hy arop'),
(48, 100, 'Admin', '2020-05-21', 'hello arop'),
(49, 100, 'Admin', '2021-01-30', 'Hey Arop this is a new message from admin'),
(50, 100, '100', '2021-01-30', 'Thank you for the message i have seen');

-- --------------------------------------------------------

--
-- Table structure for table `publicmessagetb`
--

CREATE TABLE `publicmessagetb` (
  `pid` int(20) NOT NULL,
  `adminId` int(20) NOT NULL,
  `dateComposed` datetime NOT NULL,
  `messageBody` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publicmessagetb`
--

INSERT INTO `publicmessagetb` (`pid`, `adminId`, `dateComposed`, `messageBody`) VALUES
(1, 7, '2020-05-14 00:00:00', 'good morning everyone'),
(2, 7, '2020-05-14 00:00:00', 'how are you'),
(3, 8, '2020-05-14 00:00:00', 'im prince here we have a meeting'),
(4, 8, '2020-05-14 00:00:00', 'hi all'),
(5, 8, '2020-05-14 11:43:57', 'hi arop is finishing up, please be ready'),
(6, 8, '2020-05-14 12:17:05', 'we have a meeting at 3:00pm on sunday'),
(7, 7, '2020-05-14 15:16:17', 'Meeting has been cancelled'),
(8, 7, '2020-05-14 15:44:55', 'We dont have any savings, there will be no borrowing'),
(9, 7, '2020-05-14 16:24:27', 'we are tired');

-- --------------------------------------------------------

--
-- Table structure for table `savehist`
--

CREATE TABLE `savehist` (
  `saveId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savehist`
--

INSERT INTO `savehist` (`saveId`, `memberId`, `date`, `amount`) VALUES
(92, 100, '2020-05-14', '20.00'),
(93, 101, '2020-05-14', '30.00'),
(94, 100, '2020-05-20', '70.00'),
(95, 102, '2020-05-20', '200.00'),
(96, 100, '2021-01-30', '50.00'),
(97, 100, '2021-01-30', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawtb`
--

CREATE TABLE `withdrawtb` (
  `withdrawId` int(20) NOT NULL,
  `memberId` int(20) NOT NULL,
  `date` date NOT NULL,
  `amountWithdrawn` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawtb`
--

INSERT INTO `withdrawtb` (`withdrawId`, `memberId`, `date`, `amountWithdrawn`) VALUES
(19, 101, '2020-05-14', '20.00'),
(20, 100, '2020-05-20', '20.00'),
(21, 100, '2020-05-20', '20.00'),
(22, 100, '2021-01-30', '60.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `expensetb`
--
ALTER TABLE `expensetb`
  ADD PRIMARY KEY (`expenseId`);

--
-- Indexes for table `gendertb`
--
ALTER TABLE `gendertb`
  ADD PRIMARY KEY (`genderId`);

--
-- Indexes for table `historytb`
--
ALTER TABLE `historytb`
  ADD PRIMARY KEY (`historyId`);

--
-- Indexes for table `inquirytb`
--
ALTER TABLE `inquirytb`
  ADD PRIMARY KEY (`inquiryId`);

--
-- Indexes for table `loanhist`
--
ALTER TABLE `loanhist`
  ADD PRIMARY KEY (`loanhistId`);

--
-- Indexes for table `loantb`
--
ALTER TABLE `loantb`
  ADD PRIMARY KEY (`loanId`);

--
-- Indexes for table `membertb`
--
ALTER TABLE `membertb`
  ADD PRIMARY KEY (`memberId`);

--
-- Indexes for table `messagetb`
--
ALTER TABLE `messagetb`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `publicmessagetb`
--
ALTER TABLE `publicmessagetb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `savehist`
--
ALTER TABLE `savehist`
  ADD PRIMARY KEY (`saveId`);

--
-- Indexes for table `withdrawtb`
--
ALTER TABLE `withdrawtb`
  ADD PRIMARY KEY (`withdrawId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintb`
--
ALTER TABLE `admintb`
  MODIFY `adminId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `logId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `expensetb`
--
ALTER TABLE `expensetb`
  MODIFY `expenseId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gendertb`
--
ALTER TABLE `gendertb`
  MODIFY `genderId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `historytb`
--
ALTER TABLE `historytb`
  MODIFY `historyId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `inquirytb`
--
ALTER TABLE `inquirytb`
  MODIFY `inquiryId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loanhist`
--
ALTER TABLE `loanhist`
  MODIFY `loanhistId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `loantb`
--
ALTER TABLE `loantb`
  MODIFY `loanId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `membertb`
--
ALTER TABLE `membertb`
  MODIFY `memberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `messagetb`
--
ALTER TABLE `messagetb`
  MODIFY `messageId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `publicmessagetb`
--
ALTER TABLE `publicmessagetb`
  MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `savehist`
--
ALTER TABLE `savehist`
  MODIFY `saveId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `withdrawtb`
--
ALTER TABLE `withdrawtb`
  MODIFY `withdrawId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
