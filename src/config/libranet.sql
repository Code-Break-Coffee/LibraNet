-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2025 at 11:49 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libranet`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `BookNo` int NOT NULL,
  `Title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Author1` varchar(40) NOT NULL,
  `Author2` varchar(40) DEFAULT NULL,
  `Author3` varchar(40) DEFAULT NULL,
  `Edition` varchar(10) NOT NULL,
  `Publisher` varchar(40) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Pages` int DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incharge`
--

CREATE TABLE `incharge` (
  `Id` int NOT NULL,
  `FName` int NOT NULL,
  `MName` int DEFAULT NULL,
  `LName` int NOT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incharge_auth`
--

CREATE TABLE `incharge_auth` (
  `Id` int NOT NULL,
  `InchargeId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Id` int NOT NULL,
  `FName` varchar(15) NOT NULL,
  `MName` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `LName` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PhoneNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Address` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Affiliation` varchar(30) DEFAULT NULL,
  `Remark` varchar(30) DEFAULT NULL,
  `Status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_auth`
--

CREATE TABLE `member_auth` (
  `Id` int NOT NULL,
  `MemberId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Id` int NOT NULL,
  `BookNo` int NOT NULL,
  `BorrowerId` int NOT NULL,
  `LibrarianId` int NOT NULL,
  `BorrowDate` timestamp NOT NULL,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `Remark` varchar(40) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_auth`
--
ALTER TABLE `member_auth`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `member_auth_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book_master` (`BookNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`LibrarianId`) REFERENCES `incharge` (`Id`),
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`BorrowerId`) REFERENCES `member` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
