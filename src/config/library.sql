-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 23, 2025 at 04:29 AM
-- Server version: 5.7.44-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `BookNo` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Author1` varchar(40) NOT NULL,
  `Author2` varchar(40) DEFAULT NULL,
  `Author3` varchar(40) DEFAULT NULL,
  `Edition` varchar(10) NOT NULL,
  `Publisher` varchar(40) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Pages` int(11) DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incharge`
--

CREATE TABLE `incharge` (
  `Id` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) DEFAULT NULL,
  `LName` varchar(50) NOT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Tier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incharge`
--

INSERT INTO `incharge` (`Id`, `FName`, `MName`, `LName`, `PhoneNo`, `Designation`, `Remark`, `Tier`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', 'Incharge-Head', NULL, '1'),
(4, 'zakie', NULL, 'khan', '1234567890', 'dceg', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `incharge_auth`
--

CREATE TABLE `incharge_auth` (
  `Id` int(11) NOT NULL,
  `InchargeId` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incharge_auth`
--

INSERT INTO `incharge_auth` (`Id`, `InchargeId`, `Email`, `Password`) VALUES
(1, 1, 'mehrunkart@gmail.com', '$2y$10$iPzJ9t8Vhen3fvYgG9RI8esxpaS9IsLw0DUTZwhMBGWjak/7257ha'),
(4, 4, 'zak2022.khan@gmail.com', '$2y$10$Pd/73bULASxqyUdIZKfmUes./YeVCfrNzE5TrpnUM62nyIf3rnqdm');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `FName` varchar(15) NOT NULL,
  `MName` varchar(15) DEFAULT NULL,
  `LName` varchar(15) DEFAULT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Affiliation` varchar(30) DEFAULT NULL,
  `Remark` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `FName`, `MName`, `LName`, `PhoneNo`, `Address`, `Affiliation`, `Remark`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', NULL, NULL, NULL),
(7, 'zakie', 'mohd', 'khan', '1234567890', '72,Ram Nagar', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_auth`
--

CREATE TABLE `member_auth` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_auth`
--

INSERT INTO `member_auth` (`Id`, `MemberId`, `Email`, `Password`, `Status`) VALUES
(5, 7, 'zk.khan2003@gmail.com', '$2y$10$HicbO.sXDkMNIK6KnRsmPeU5yCJsbdF7bQvNLLNfS32SHQu6vQkEe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Id` int(11) NOT NULL,
  `BookNo` int(11) NOT NULL,
  `BorrowerId` int(11) NOT NULL,
  `LibrarianId` int(11) NOT NULL,
  `BorrowDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `Remark` varchar(40) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unverified`
--

CREATE TABLE `unverified` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_type` varchar(50) COLLATE utf8_bin NOT NULL,
  `code` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_master`
--
ALTER TABLE `book_master`
  ADD PRIMARY KEY (`BookNo`);

--
-- Indexes for table `incharge`
--
ALTER TABLE `incharge`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `InchargeId` (`InchargeId`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_auth`
--
ALTER TABLE `member_auth`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BookNo` (`BookNo`),
  ADD KEY `BorrowerId` (`BorrowerId`),
  ADD KEY `LibrarianId` (`LibrarianId`);

--
-- Indexes for table `unverified`
--
ALTER TABLE `unverified`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incharge`
--
ALTER TABLE `incharge`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_auth`
--
ALTER TABLE `member_auth`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unverified`
--
ALTER TABLE `unverified`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  ADD CONSTRAINT `incharge_auth_ibfk_1` FOREIGN KEY (`InchargeId`) REFERENCES `incharge` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `member_auth`
--
ALTER TABLE `member_auth`
  ADD CONSTRAINT `member_auth_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book_master` (`BookNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`LibrarianId`) REFERENCES `incharge` (`Id`),
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`BorrowerId`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
