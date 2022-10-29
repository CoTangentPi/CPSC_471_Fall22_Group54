-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 12:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branch_phone_number`
--

CREATE TABLE `branch_phone_number` (
  `Branch_no` int(11) NOT NULL,
  `Phone_number` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `O_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Date_purchased` date NOT NULL,
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `C_UserID` int(11) NOT NULL,
  `Branch_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `C_UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_UserID` int(11) NOT NULL,
  `SIN` char(9) NOT NULL,
  `Branch_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `InsuranceID` int(11) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `LoginID` int(11) NOT NULL,
  `Login_username` varchar(25) NOT NULL,
  `Login_password` varchar(25) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `O_UserID` int(11) NOT NULL,
  `SIN` char(9) NOT NULL,
  `Expenses` float DEFAULT NULL,
  `Revenue` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `C_UserID` int(11) NOT NULL,
  `Price` float DEFAULT NULL,
  `Payment_method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `PermissionID` int(11) NOT NULL,
  `PermissionName` varchar(25) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `O_UserID` int(11) NOT NULL,
  `VIN` char(17) NOT NULL,
  `Date_sold` date NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_phone_number`
--
ALTER TABLE `branch_phone_number`
  ADD CONSTRAINT `branch_phone_number_ibfk_1` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`);

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`),
  ADD CONSTRAINT `buys_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `customer` (`C_UserID`),
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`);

--
-- Constraints for table `employs`
--
ALTER TABLE `employs`
  ADD CONSTRAINT `employs_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `employee` (`E_UserID`),
  ADD CONSTRAINT `employs_ibfk_2` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`);

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `lease`
--
ALTER TABLE `lease`
  ADD CONSTRAINT `lease_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`),
  ADD CONSTRAINT `lease_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`C_UserID`) REFERENCES `customer` (`C_UserID`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`C_UserID`) REFERENCES `payment` (`C_UserID`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`),
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`),
  ADD CONSTRAINT `reservation_ibfk_5` FOREIGN KEY (`Pickup_location`) REFERENCES `branch` (`Branch_no`),
  ADD CONSTRAINT `reservation_ibfk_6` FOREIGN KEY (`Dropoff_location`) REFERENCES `branch` (`Branch_no`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`O_UserID`) REFERENCES `owner` (`O_UserID`),
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `service_record`
--
ALTER TABLE `service_record`
  ADD CONSTRAINT `service_record_ibfk_1` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`);

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`E_UserID`) REFERENCES `employee` (`E_UserID`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`VIN`) REFERENCES `vehicle` (`VIN`),
  ADD CONSTRAINT `transfers_ibfk_3` FOREIGN KEY (`Start_branch`) REFERENCES `branch` (`Branch_no`),
  ADD CONSTRAINT `transfers_ibfk_4` FOREIGN KEY (`End_branch`) REFERENCES `branch` (`Branch_no`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Branch_no`) REFERENCES `branch` (`Branch_no`),
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`InsuranceID`) REFERENCES `insurance` (`InsuranceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
