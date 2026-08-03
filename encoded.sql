-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2026 at 10:36 AM
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
-- Database: `edsr-cons`
--

-- --------------------------------------------------------

--
-- Table structure for table `encoded`
--

CREATE TABLE `encoded` (
  `id` int(200) NOT NULL,
  `LID` varchar(20) GENERATED ALWAYS AS (concat('2026-C',lpad(`id`,5,'0'))) VIRTUAL,
  `sbu` varchar(255) DEFAULT NULL,
  `accExec` varchar(100) NOT NULL,
  `callDate` date NOT NULL,
  `team` varchar(20) DEFAULT NULL,
  `customerId` varchar(255) DEFAULT NULL,
  `accName` varchar(200) NOT NULL,
  `arsExpiryDate` date DEFAULT NULL,
  `accCat` varchar(100) NOT NULL,
  `existingSystem` varchar(255) DEFAULT NULL,
  `endOfContractCompetitor` date DEFAULT NULL,
  `endUser` varchar(100) NOT NULL,
  `industry` varchar(200) DEFAULT NULL,
  `industrySubcategory` varchar(255) DEFAULT NULL,
  `accSource` varchar(100) DEFAULT NULL,
  `accountSourceCategory` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `branch1` varchar(15) DEFAULT NULL,
  `region1` varchar(15) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contactPerson` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `contactNumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactPerson1` varchar(255) DEFAULT NULL,
  `designation1` varchar(255) DEFAULT NULL,
  `contactNumber1` varchar(50) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `decisionMaker` varchar(255) DEFAULT NULL,
  `dmDesignation` varchar(255) DEFAULT NULL,
  `decisionMakerEmail` varchar(255) DEFAULT NULL,
  `projTitle` varchar(255) DEFAULT NULL,
  `proposedPrice` varchar(100) NOT NULL,
  `paymentTerms` varchar(100) NOT NULL,
  `contactType` varchar(100) NOT NULL,
  `projAddress` varchar(255) DEFAULT NULL,
  `productType` varchar(255) DEFAULT NULL,
  `productTypeSubcategory` varchar(255) DEFAULT NULL,
  `deviceCondition` varchar(255) DEFAULT NULL,
  `itemCode` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `productAmount` decimal(15,2) DEFAULT NULL,
  `progressDate` date DEFAULT NULL,
  `accStatus` varchar(50) DEFAULT NULL,
  `reasonSubcategory` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `endOfContract` date DEFAULT NULL,
  `branch` varchar(100) NOT NULL,
  `segment` varchar(100) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `dmNumber` varchar(100) DEFAULT NULL,
  `startContractDate` date NOT NULL,
  `endContractDate` date NOT NULL,
  `proposedSystem` varchar(100) NOT NULL,
  `callNature` varchar(100) NOT NULL,
  `actionFollow` varchar(1000) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `reason` text DEFAULT NULL,
  `accexec_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `whatTranspired` varchar(255) DEFAULT NULL,
  `estimatedDelivery` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `encoded`
--
DELIMITER $$
CREATE TRIGGER `before_insert_encoded` BEFORE INSERT ON `encoded` FOR EACH ROW BEGIN
    SET NEW.accexec_id = (SELECT id FROM users WHERE name = NEW.accexec LIMIT 1);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encoded`
--
ALTER TABLE `encoded`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_accexec` (`accexec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encoded`
--
ALTER TABLE `encoded`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encoded`
--
ALTER TABLE `encoded`
  ADD CONSTRAINT `fk_accexec` FOREIGN KEY (`accexec_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
