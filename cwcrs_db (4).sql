-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 07:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwcrs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branch_no` int(11) NOT NULL,
  `Branch_name` varchar(20) DEFAULT NULL,
  `Street_no` int(11) DEFAULT NULL,
  `Street_name` varchar(25) DEFAULT NULL,
  `City` varchar(25) DEFAULT NULL,
  `Province` char(2) DEFAULT NULL,
  `Postal_code` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branch_no`, `Branch_name`, `Street_no`, `Street_name`, `City`, `Province`, `Postal_code`) VALUES
(0, 'Online Branch', 404, 'Not Found Way', 'Silicon Valley', 'YK', 'Y0Y0Y0'),
(1111, 'Calgary Branch', 1111, '1st Avenue SE', 'Calgary', 'AB', 'T1A1A1'),
(2222, 'Saskatoon Branch', 567, 'Circle Drive N', 'Saskatoon', 'SK', 'S2S2S2');

-- --------------------------------------------------------

--
-- Table structure for table `branch_phone_number`
--

CREATE TABLE `branch_phone_number` (
  `Branch_no` int(11) NOT NULL,
  `Phone_number` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `O_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Date_purchased` date NOT NULL,
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `C_UserID` int(11) NOT NULL,
  `Branch_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`C_UserID`, `Branch_no`) VALUES
(7, 1111),
(7, 2222),
(8, 1111),
(8, 2222),
(9, 0),
(9, 1111),
(9, 2222),
(10, 0),
(10, 2222);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `C_UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`C_UserID`) VALUES
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_UserID` int(11) NOT NULL,
  `SIN` char(9) NOT NULL,
  `Branch_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_UserID`, `SIN`, `Branch_no`) VALUES
(3, '987654321', 1111),
(5, '234567891', 1111),
(11, '135246579', 2222);

-- --------------------------------------------------------

--
-- Table structure for table `employs`
--

CREATE TABLE `employs` (
  `E_UserID` int(11) NOT NULL,
  `O_UserID` int(11) NOT NULL,
  `Employment_status` varchar(20) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date DEFAULT NULL,
  `Salary` float DEFAULT NULL,
  `Severance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employs`
--

INSERT INTO `employs` (`E_UserID`, `O_UserID`, `Employment_status`, `Start_date`, `End_date`, `Salary`, `Severance`) VALUES
(3, 1, 'Employed', '2020-07-14', NULL, 25000, NULL),
(5, 1, 'Employed', '2022-11-01', NULL, 12000, NULL),
(11, 1, 'Employed', '2012-12-21', NULL, 50123.4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `Year` int(4) NOT NULL,
  `Make` varchar(25) NOT NULL,
  `Model` varchar(25) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Category` varchar(25) DEFAULT NULL,
  `Trans_Driven_wheels` varchar(25) DEFAULT NULL,
  `Fuel_Air_con` varchar(25) DEFAULT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Horse_power` varchar(25) DEFAULT NULL,
  `Torque` varchar(25) DEFAULT NULL,
  `Tonnage` varchar(25) DEFAULT NULL,
  `Sunroof` varchar(10) DEFAULT NULL,
  `Seat_material` varchar(25) DEFAULT NULL,
  `Body_colour` varchar(25) DEFAULT NULL,
  `Interior_colour` varchar(25) DEFAULT NULL,
  `Fuel_economy` varchar(25) DEFAULT NULL,
  `Childseat_compatibility` varchar(25) DEFAULT NULL,
  `Number_of_passengers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`Year`, `Make`, `Model`, `VIN`, `Category`, `Trans_Driven_wheels`, `Fuel_Air_con`, `Type`, `Horse_power`, `Torque`, `Tonnage`, `Sunroof`, `Seat_material`, `Body_colour`, `Interior_colour`, `Fuel_economy`, `Childseat_compatibility`, `Number_of_passengers`) VALUES
(2021, 'Chevrolet', 'Spark', '3ABCD12EFGH345678', 'E: Economy', 'A: Auto Unspecified Drive', 'V: Petrol Air', 'C: 2/4 Door', '98', '94', '1019', 'No', 'Cloth', 'Black', 'Dark Grey', '7', 'Yes', 4),
(2021, 'Chrysler', '300', '8NMGH78GHJK456789', 'L: Luxury', 'N: Manual 4WD', 'V: Petrol Air', 'D: 4-5 Door', '363', '394', '4515', 'Yes', 'Leather', 'Black', 'White', '12', 'Yes', 5),
(2021, 'Nissan', 'Versa', '4MNBV65LKJH765432', 'C: Compact', 'D: Auto AWD', 'V: Petrol Air', 'D: 4-5 Door', '109', '107', '2519', 'No', 'Cloth', 'Blue', 'Grey', '7.5', 'Yes', 5),
(2022, 'Fiat', '500', '2ZYXW98ZYXW987654', 'M: Mini', 'C: Manual AWD', 'V: Petrol Air', 'B: 2-3 Door', '135', '200', '2366', 'No', 'Leather', 'White', 'White', '3.8', 'No', 4),
(2022, 'Kia', 'Forte', '5POIU98MNBV987652', 'I: Intermediate', 'A: Auto Unspecified Drive', 'V: Petrol Air', 'D: 4-5 Door', '147', '70', '3079', 'Yes', 'Cloth', 'Red', 'Grey', '7.5', 'Yes', 5),
(2022, 'Nissan', 'Maxima', '7BVCX76NBVC876543', 'P: Premium', 'C: Manual AWD', 'V: Petrol Air', 'E: Coupe', '300', '261', '2352', 'Yes', 'Leather', 'Orange', 'Grey', '9.9', 'Yes', 5),
(2022, 'Toyota', 'Camry', '6ASDF56ASDF567890', 'F: Fullsize', 'D: Auto AWD', 'H: Hybrid Air', 'D: 4-5 Door', '301', '186', '3340', 'No', 'Cloth', 'Black', 'Black', '9.4', 'Yes', 5),
(2022, 'Volkswagon', 'Jetta', '1HGBH41JXMN109186', 'S: Standard', 'D: Auto AWD', 'D: Diesel Air', 'D: 4-5 Door', '147', '184', '3213', 'Yes', 'Leather', 'Silver', 'Grey', '7', 'Yes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `InsuranceID` int(11) NOT NULL,
  `Ins_Type` varchar(10) NOT NULL,
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`InsuranceID`, `Ins_Type`, `Cost`) VALUES
(56781234, 'Liability', 876),
(87654321, 'Liability', 800),
(98765432, 'Full', 1300.27),
(1234567890, 'Liability', 543.21);

-- --------------------------------------------------------

--
-- Table structure for table `lease`
--

CREATE TABLE `lease` (
  `O_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date DEFAULT NULL,
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `LoginID` int(11) NOT NULL,
  `Login_username` varchar(25) NOT NULL,
  `Login_password` varchar(25) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LoginID`, `Login_username`, `Login_password`, `UserID`) VALUES
(1, 'jimbob', '123456789', 1),
(2, 'alice', '987654321', 3),
(3, 'bob', '234567891', 5),
(4, 'arnie', 'notatuma', 9),
(5, 'bill', 'password', 10),
(6, 'sly', 'rambo', 7),
(7, 'aaaa', '1111', 8),
(8, 'hook', 'peterpan', 11);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `O_UserID` int(11) NOT NULL,
  `SIN` char(9) NOT NULL,
  `Expenses` decimal(10,2) DEFAULT NULL,
  `Revenue` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`O_UserID`, `SIN`, `Expenses`, `Revenue`) VALUES
(1, '123456789', '2500.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `C_UserID` int(11) NOT NULL,
  `Price` float DEFAULT NULL,
  `Payment_method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `C_UserID`, `Price`, `Payment_method`) VALUES
(1, 7, 120.12, 'Not Paid'),
(2, 7, 120.12, 'Not Paid'),
(3, 7, 120.12, 'Not Paid'),
(5, 9, 20.02, 'Credit'),
(8, 10, 120.12, 'Cash'),
(9, 10, 120.12, 'Cash'),
(10, 7, 20.02, 'Not Paid'),
(11, 7, 20.02, 'Credit'),
(12, 9, 0, 'Not Paid'),
(13, 9, 0, 'Not Paid'),
(14, 9, 120, 'Cash'),
(16, 9, 0, 'Credit'),
(17, 9, 980, 'Credit'),
(18, 7, 90, 'Debit'),
(19, 7, 90, 'Not Paid'),
(20, 9, 80, 'Debit'),
(21, 9, 0, 'Cash'),
(22, 9, 40, 'Not Paid'),
(23, 9, 40, 'Not Paid'),
(24, 10, 20.02, 'Not Paid'),
(26, 9, 180.18, 'Debit'),
(27, 9, 120, 'Not Paid'),
(29, 9, 544.5, 'Not Paid'),
(31, 9, 120, 'Not Paid'),
(32, 9, 30, 'Not Paid'),
(35, 9, 450, 'Not Paid'),
(36, 9, 270, 'Not Paid'),
(37, 9, 450, 'Not Paid'),
(39, 9, 220.22, 'Not Paid'),
(41, 9, 480, 'Not Paid'),
(42, 9, 330, 'Not Paid'),
(44, 9, 30, 'Not Paid'),
(46, 9, 100, 'Not Paid'),
(47, 9, 210, 'Not Paid'),
(48, 9, 480, 'Not Paid'),
(50, 9, 400, 'Not Paid'),
(51, 9, 450, 'Not Paid'),
(52, 9, 240, 'Not Paid'),
(53, 9, 240, 'Not Paid'),
(54, 9, 30, 'Not Paid'),
(55, 9, 240, 'Not Paid'),
(56, 9, 450, 'Credit'),
(57, 9, 700, 'Credit'),
(58, 9, 400, 'Credit'),
(59, 9, 560, 'Not Paid');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `PermissionID` int(11) NOT NULL,
  `PermissionName` varchar(25) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`PermissionID`, `PermissionName`, `UserID`) VALUES
(1, 'Owner', 1),
(2, 'Employee', 3),
(3, 'Employee', 5),
(4, 'Customer', 9),
(5, 'Customer', 10),
(6, 'Customer', 7),
(7, 'Customer', 8),
(8, 'Employee', 11);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationID` int(11) NOT NULL,
  `Start_date` date DEFAULT NULL,
  `End_date` date DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `C_UserID` int(11) DEFAULT NULL,
  `Branch_no` int(11) DEFAULT NULL,
  `VIN` char(17) DEFAULT NULL,
  `Pickup_location` int(11) DEFAULT NULL,
  `Dropoff_location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ReservationID`, `Start_date`, `End_date`, `PaymentID`, `C_UserID`, `Branch_no`, `VIN`, `Pickup_location`, `Dropoff_location`) VALUES
(19, '2022-12-16', '2022-12-17', 24, 10, 0, '2ZYXW98ZYXW987654', 2222, 1111),
(53, '2022-12-23', '2022-12-31', 58, 9, 0, '5POIU98MNBV987652', 2222, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `O_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Date_sold` date NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_record`
--

CREATE TABLE `service_record` (
  `Invoice_no` int(11) NOT NULL,
  `Cost` float NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date DEFAULT NULL,
  `Type_of_service` varchar(25) DEFAULT NULL,
  `Scheduled_maintenance` varchar(25) DEFAULT NULL,
  `VIN` char(17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_record`
--

INSERT INTO `service_record` (`Invoice_no`, `Cost`, `Start_date`, `End_date`, `Type_of_service`, `Scheduled_maintenance`, `VIN`) VALUES
(6541, 543.21, '2022-12-01', '2022-12-01', 'Oil Change', 'Yes', '1HGBH41JXMN109186'),
(11114, 123, '2022-12-07', '2022-12-14', 'Repair', 'No', '5POIU98MNBV987652'),
(12340, 1300.27, '2020-07-14', '2020-07-21', 'Repair', 'No', '1HGBH41JXMN109186'),
(78907, 65.43, '2022-12-01', '2022-12-01', 'Oil Change', 'Yes', '5POIU98MNBV987652'),
(111111, 765.43, '2022-12-06', '2022-12-31', 'Repair', 'No', '5POIU98MNBV987652'),
(898989, 65.43, '2022-12-02', '2022-12-02', 'Oil Change', 'Yes', '2ZYXW98ZYXW987654');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `E_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Start_branch` int(11) DEFAULT NULL,
  `End_branch` int(11) DEFAULT NULL,
  `Start_date` date DEFAULT NULL,
  `End_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`E_UserID`, `VIN`, `Start_branch`, `End_branch`, `Start_date`, `End_date`) VALUES
(3, '7BVCX76NBVC876543', 2222, 1111, '2022-12-03', '2022-12-03'),
(5, '1HGBH41JXMN109186', 1111, 2222, '2022-11-30', '2022-12-01'),
(11, '1HGBH41JXMN109186', 2222, 1111, '2022-12-02', '2022-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Middle_name` varchar(50) DEFAULT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone_number` char(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Sex` char(1) DEFAULT NULL,
  `Street_no` varchar(10) DEFAULT NULL,
  `Street_name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Province` char(2) DEFAULT NULL,
  `Postal_code` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `First_name`, `Middle_name`, `Last_name`, `Email`, `Phone_number`, `DOB`, `Sex`, `Street_no`, `Street_name`, `City`, `Province`, `Postal_code`) VALUES
(1, 'Jim', 'Bob', 'Owner', 'owner@cwcrs.com', '4035551234', '1980-11-01', 'M', '123', 'Main St. NW', 'Calgary', 'AB', 'T3K3K3'),
(3, 'Alice', 'Jane', 'Employee1', 'alice@cwcrs.com', '4035552345', '2002-09-01', 'F', '1', '1 Street SW', 'Calgary', 'AB', 'T1K1C1'),
(5, 'Bob', 'Trevor', 'Employee2', 'bob@cwcrs.com', '4035553456', '2000-03-14', 'M', '2', '2nd Street NE', 'Calgary', 'AB', 'T2K2K2'),
(7, 'Sylvestor', NULL, 'Stallone', 'sly@movies.com', '2504445432', '1946-07-06', 'M', '4', 'Mulholland Drive', 'Beverly Hills', 'ON', 'M4C4C4'),
(8, 'Arthur', 'G', 'Bear', 'bear@mammal.com', '9876543210', '1997-12-02', 'o', '2', 'Forest Road', 'Rosetown', 'SK', 'S0K1K1'),
(9, 'Arnold', 'J', 'Schwarzenegger', 'arnie@bigdeal.com', '6047778876', '1947-07-30', 'm', '2', 'Da Choppa Drive', 'Malibu', 'PE', 'C0A0A0'),
(10, 'Bill', 'K', 'Jones', 'jones@gmail.com', '4444444444', '1996-06-28', 'o', '3', 'G Street', 'Calgary', 'AB', 'T2A3G3'),
(11, 'Captain', 'James', 'Hook', 'hook@cwcrs.com', '3069199191', '1953-02-05', 'M', '10', 'Jolly Rodger Way', 'Never Never Land', 'NU', 'X0A0X0');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VIN` char(17) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Mileage` int(11) NOT NULL,
  `Licence_plate_no` varchar(10) NOT NULL,
  `Registration_province` char(2) NOT NULL,
  `InsuranceID` int(11) DEFAULT NULL,
  `Branch_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VIN`, `Status`, `Mileage`, `Licence_plate_no`, `Registration_province`, `InsuranceID`, `Branch_no`) VALUES
('1HGBH41JXMN109186', 'Ready', 90000002, 'ABC123', 'AB', 98765432, 1111),
('2ZYXW98ZYXW987654', 'Ready', 8765, '777ABC', 'SK', 87654321, 1111),
('3ABCD12EFGH345678', 'Ready', 15432, 'ZYX987', 'AB', 98765432, 1111),
('4MNBV65LKJH765432', 'Not Ready', 67453, '888DEF', 'SK', 98765432, 2222),
('5POIU98MNBV987652', 'Not Ready', 123, 'LMN098', 'AB', 98765432, 2222),
('6ASDF56ASDF567890', 'Ready', 7651, 'JKL567', 'AB', 98765432, 1111),
('7BVCX76NBVC876543', 'Ready', 123, '890QWE', 'SK', 56781234, 1111),
('8NMGH78GHJK456789', 'Ready', 3456, 'FGH876', 'AB', 1234567890, 1111);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_no`),
  ADD UNIQUE KEY `Branch_name` (`Branch_name`);

--
-- Indexes for table `branch_phone_number`
--
ALTER TABLE `branch_phone_number`
  ADD PRIMARY KEY (`Branch_no`,`Phone_number`);

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`O_UserID`,`VIN`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`C_UserID`,`Branch_no`),
  ADD KEY `Branch_no` (`Branch_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`C_UserID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`E_UserID`),
  ADD KEY `Branch_no` (`Branch_no`);

--
-- Indexes for table `employs`
--
ALTER TABLE `employs`
  ADD PRIMARY KEY (`E_UserID`,`O_UserID`),
  ADD KEY `O_UserID` (`O_UserID`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`Year`,`Make`,`Model`,`VIN`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`InsuranceID`);

--
-- Indexes for table `lease`
--
ALTER TABLE `lease`
  ADD PRIMARY KEY (`O_UserID`,`VIN`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`LoginID`),
  ADD UNIQUE KEY `Login_username` (`Login_username`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`O_UserID`),
  ADD UNIQUE KEY `SIN` (`SIN`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`,`C_UserID`),
  ADD KEY `C_UserID` (`C_UserID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`PermissionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `PaymentID` (`PaymentID`),
  ADD KEY `C_UserID` (`C_UserID`),
  ADD KEY `Branch_no` (`Branch_no`),
  ADD KEY `VIN` (`VIN`),
  ADD KEY `Pickup_location` (`Pickup_location`),
  ADD KEY `Dropoff_location` (`Dropoff_location`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`O_UserID`,`VIN`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `service_record`
--
ALTER TABLE `service_record`
  ADD PRIMARY KEY (`Invoice_no`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`E_UserID`,`VIN`),
  ADD KEY `VIN` (`VIN`),
  ADD KEY `Start_branch` (`Start_branch`),
  ADD KEY `End_branch` (`End_branch`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`VIN`),
  ADD KEY `Branch_no` (`Branch_no`),
  ADD KEY `InsuranceID` (`InsuranceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `PermissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_phone_number`
--
ALTER TABLE `branch_phone_number`
  ADD CONSTRAINT `branch_phone_number_ibfk_1` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buys_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `customer` (`C_UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employs`
--
ALTER TABLE `employs`
  ADD CONSTRAINT `employs_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `employee` (`E_UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employs_ibfk_2` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lease`
--
ALTER TABLE `lease`
  ADD CONSTRAINT `lease_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lease_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `customer` (`C_UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`C_UserID`) REFERENCES `payment` (`C_UserID`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_5` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_record`
--
ALTER TABLE `service_record`
  ADD CONSTRAINT `service_record_ibfk_1` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `employee` (`E_UserID`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`InsuranceID`) REFERENCES `insurance` (`InsuranceID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
