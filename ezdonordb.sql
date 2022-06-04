-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 03:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezdonordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `UserID`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `AdsID` int(11) NOT NULL,
  `AdsName` varchar(100) NOT NULL,
  `AdsDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `ApprovalID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `ApprovalStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`ApprovalID`, `RequestID`, `AdminID`, `ApprovalStatus`) VALUES
(39, 7, 1, 'Approve'),
(40, 34, 1, 'Decline'),
(41, 55, 0, 'Decline');

-- --------------------------------------------------------

--
-- Table structure for table `dapur`
--

CREATE TABLE `dapur` (
  `DapurID` int(11) NOT NULL,
  `DapurName` varchar(100) NOT NULL,
  `DapurLocation` varchar(60) NOT NULL,
  `DapurDescription` varchar(100) NOT NULL,
  `DapurDeliveryHours` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dapur`
--

INSERT INTO `dapur` (`DapurID`, `DapurName`, `DapurLocation`, `DapurDescription`, `DapurDeliveryHours`, `UserID`) VALUES
(1, 'dj', 'dj', 'dj', 'dj', 4),
(4, 'da', 'da', 'da', 'da', 40),
(5, 'da', 'da', 'da', 'da', 41);

-- --------------------------------------------------------

--
-- Table structure for table `donee`
--

CREATE TABLE `donee` (
  `DoneeID` int(11) NOT NULL,
  `DoneeName` varchar(100) NOT NULL,
  `DoneePhone` varchar(15) NOT NULL,
  `DoneeDescription` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doneecatalogue`
--

CREATE TABLE `doneecatalogue` (
  `DoneeCatalogueID` int(11) NOT NULL,
  `DoneeCatalogueName` varchar(100) NOT NULL,
  `DoneeCataloguePhoneNumber` varchar(15) NOT NULL,
  `DoneeCatalogueDescription` varchar(500) NOT NULL,
  `DoneeCatalogueImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doneecatalogue`
--

INSERT INTO `doneecatalogue` (`DoneeCatalogueID`, `DoneeCatalogueName`, `DoneeCataloguePhoneNumber`, `DoneeCatalogueDescription`, `DoneeCatalogueImage`) VALUES
(1, 'rumah anak yatim 1', '139947677', 'Sumbangan untuk 31 anak yatim', 'rumahanakyatim1.png'),
(2, 'rumah anak yatim 2', '139947676', 'Sumbangan untuk 32 anak yatim', 'rumahanakyatim2.png'),
(3, 'rumah anak yatim 3', '139947675', 'Sumbangan untuk 31 anak yatim', 'rumahanakyatim3.png'),
(4, 'rumah anak yatim 4', '139947674', 'Sumbangan untuk 32 anak yatim', 'rumahanakyatim4.png'),
(5, 'rumah anak yatim 5', '139947673', 'Sumbangan untuk 31 anak yatim', 'rumahanakyatim5.png');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `DonorID` int(11) NOT NULL,
  `DonorName` varchar(100) NOT NULL,
  `DonorIC` varchar(20) NOT NULL,
  `DonorPhone` varchar(15) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`DonorID`, `DonorName`, `DonorIC`, `DonorPhone`, `UserID`) VALUES
(1, 'donor name 1', '980129115797', '0139947676', 6);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GuestID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `OrderID` int(11) NOT NULL,
  `DonorID` int(11) NOT NULL,
  `DoneeID` int(11) NOT NULL,
  `DapurID` int(11) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `OrderAmount` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderStatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`OrderID`, `DonorID`, `DoneeID`, `DapurID`, `PackageID`, `OrderAmount`, `OrderDate`, `OrderStatus`) VALUES
(1, 1, 1, 1, 1, 100, '2022-05-30', 'Finished'),
(2, 1, 2, 1, 2, 200, '2022-05-30', 'Finished'),
(4, 1, 2, 1, 1, 3, '2022-05-31', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `PackageID` int(11) NOT NULL,
  `PackageName` varchar(100) NOT NULL,
  `PackagePrice` float NOT NULL,
  `PackageMinOrder` int(11) NOT NULL,
  `DapurID` int(11) NOT NULL,
  `PackageImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`PackageID`, `PackageName`, `PackagePrice`, `PackageMinOrder`, `DapurID`, `PackageImage`) VALUES
(1, 'p1', 1, 1, 1, ''),
(2, 'p2', 2, 2, 1, ''),
(3, 'p3', 3, 3, 4, ''),
(4, 'p4', 4, 4, 5, ''),
(5, 'p5', 5, 5, 4, ''),
(6, 'p6', 6, 6, 5, ''),
(38, 'buger', 1, 1, 1, 'burger.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `DoneeID` int(11) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `PackagePrice` int(11) NOT NULL,
  `PaymentAmount` float NOT NULL,
  `PaymentTotalPrice` float NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `Currency` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `PaymentStatus` varchar(255) NOT NULL,
  `ReceiverEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `RequestName` varchar(100) NOT NULL,
  `RequestIC` varchar(15) NOT NULL,
  `RequestPhone` varchar(15) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `RequestLocation` varchar(60) NOT NULL,
  `RequestICPic` varchar(255) NOT NULL,
  `ApprovalID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `RequestName`, `RequestIC`, `RequestPhone`, `PackageID`, `RequestLocation`, `RequestICPic`, `ApprovalID`) VALUES
(7, 'haziq', '980129115797', '0139947676', 0, 'dungun', 'picture', 39),
(34, 'dawd', 'awdawda', 'awdawd', 0, 'dawdawd', 'dadawd', 40),
(55, 'dwdw', 'dawdawd', 'wdawda', 0, 'wdawdaw', 'dwadaw', 41),
(61, 'dwd', 'dwdwdd', 'wdawdawd', 0, 'wdwddfg2', 'akb takahashi ayane girl.png', 0),
(68, 'dwd', 'dwdwdd', 'wdawdawd', 0, 'wdwddfg2', '36-1024x641.png', 0),
(69, 'dwd', 'dwdwdd', 'wdawdawd', 4, 'wdwddfg2', '36-1024x641.png', 0),
(70, 'dwd', 'dwdwdd', 'wdawdawd', 4, 'wdwddfg2', '36-1024x641.png', 0),
(71, 'dwd', 'dwdwdd', 'wdawdawd', 4, 'wdwddfg2', '36-1024x641.png', 0),
(72, 'dwd', 'dwdwdd', 'wdawdawd', 4, 'wdwddfg2', '36-1024x641.png', 0),
(73, 'dwd', 'dwdwdd', 'wdawdawd', 4, 'wdwddfg2', '36-1024x641.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserUsername` varchar(30) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserAccountType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserUsername`, `UserPassword`, `UserAccountType`) VALUES
(5, 'admin', 'admin', 1),
(6, 'donor', 'donor', 2),
(7, 'donee', 'donee', 3),
(8, 'dapur', 'dapur', 4),
(12, 'admin1', 'admin1', 1),
(13, 'dapur2', 'dapur2', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`AdsID`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`ApprovalID`);

--
-- Indexes for table `dapur`
--
ALTER TABLE `dapur`
  ADD PRIMARY KEY (`DapurID`);

--
-- Indexes for table `donee`
--
ALTER TABLE `donee`
  ADD PRIMARY KEY (`DoneeID`);

--
-- Indexes for table `doneecatalogue`
--
ALTER TABLE `doneecatalogue`
  ADD PRIMARY KEY (`DoneeCatalogueID`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`DonorID`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`PackageID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `AdsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `dapur`
--
ALTER TABLE `dapur`
  MODIFY `DapurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donee`
--
ALTER TABLE `donee`
  MODIFY `DoneeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doneecatalogue`
--
ALTER TABLE `doneecatalogue`
  MODIFY `DoneeCatalogueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `DonorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `PackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
