-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2018 at 02:42 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `llcdh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_type` varchar(100) NOT NULL,
  `admin_rol` int(11) DEFAULT NULL,
  `admin_status` int(11) NOT NULL,
  `admin_added` datetime NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=2730;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `confirm_password`, `admin_image`, `admin_type`, `admin_rol`, `admin_status`, `admin_added`) VALUES
(20181901, 'Jendy', 'Villamor', 'Manatad', 'admin', 'admin', 'admin', '13-1.jpg', 'Administrator', 1, 1, '2018-03-08 00:00:00'),
(20181902, 'Hyacinth Mae', 'G', 'Cipres', 'nurse', 'nurse', 'nurse', 'piZap_1394237757548.jpg', 'Nurse', 2, 1, '2018-03-08 05:03:28'),
(20181903, 'Gene Rose', 'G', 'Obregon', 'doctor', 'doctor', 'doctor', '2016-12-02-02-25-03--1149275481.jpeg', 'Doctor', 2, 1, '2018-03-08 05:16:36'),
(20181904, 'Pedra', 'C', 'Cruz', 'cashier', 'cashier', 'cashier', '1.jpg', 'Cashier', 2, 1, '0000-00-00 00:00:00'),
(20181905, 'Jenny', 'V', 'Manatad', 'pharmacist', 'pharmacist', 'pharmacist', '7.jpg', 'Pharmacist', 2, 1, '0000-00-00 00:00:00'),
(20181906, 'Jury', 'V', 'Manatad', 'clerk', 'clerk', 'clerk', 'Alessandro_Volta.jpeg', 'Clerk', 2, 1, '0000-00-00 00:00:00'),
(20181907, 'Jeffrey', 'V', 'Manatad', 'billings', 'billings', 'billings', '20140914_151037-1.jpg', 'Billings', 2, 1, '0000-00-00 00:00:00'),
(20181908, 'Michael', 'V', 'Manatad', 'laboratory', 'laboratory', 'laboratory', '20151202_153742~2~2.jpg', 'Laboratory', 2, 1, '0000-00-00 00:00:00'),
(20181909, 'Michael', 'V', 'Manatad', 'michael', '123456', '123456', '20160328_172143.jpg', 'Doctor', 2, 1, '0000-00-00 00:00:00'),
(201819010, 'Dominga', 'V. ', 'Manatad', 'dominga', '123456', '123456', '20160403_204911.jpg', 'Doctor', 2, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE IF NOT EXISTS `billings` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_name` varchar(255) DEFAULT NULL,
  `bill_price` decimal(10,0) DEFAULT NULL,
  `bill_ptrans_id` varchar(255) DEFAULT NULL,
  `bill_patient_id` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=60 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`bill_id`, `bill_name`, `bill_price`, `bill_ptrans_id`, `bill_patient_id`, `bill_date`) VALUES
(67, 'Urinalysis', '40', '000003005', '000003', '2018-03-09 19:10:40'),
(46, 'Blood Typing', '100', '000001004', '000001', '2018-03-08 18:25:07'),
(47, 'NS1 dengue test', '1100', '000002003', '000002', '2018-03-08 19:13:22'),
(48, 'Select Laboratory', '0', '000001004', '000001', '2018-03-08 21:33:09'),
(49, 'Select Laboratory', '0', '000001004', '000001', '2018-03-08 21:33:09'),
(68, 'Blood Uric Acid', '100', '000003005', '000003', '2018-03-09 19:11:58'),
(54, 'Blood Typing', '100', '000006009', '000006', '2018-03-09 07:39:40'),
(55, 'Blood Typing', '100', '000006009', '000006', '2018-03-09 07:39:40'),
(56, 'PSA', '950', '000006009', '000006', '2018-03-09 07:39:50'),
(57, 'PSA', '950', '000006009', '000006', '2018-03-09 07:39:50'),
(58, 'Blood Typing', '100', '000006009', '000006', '2018-03-09 07:40:07'),
(59, 'Blood Typing', '100', '000006009', '000006', '2018-03-09 07:40:07'),
(60, 'CBC', '100', '000006009', '000006', '2018-03-09 07:40:52'),
(61, 'CBC', '100', '000006009', '000006', '2018-03-09 07:40:52'),
(62, 'CBC', '100', '000006009', '000006', '2018-03-09 07:42:27'),
(63, 'Stool Routine Exam', '40', '000006009', '000006', '2018-03-09 07:42:39'),
(64, 'NS1 dengue test', '1100', '000001007', '000001', '2018-03-09 09:17:01'),
(65, 'PSA', '950', '000004008', '000004', '2018-03-09 17:08:53'),
(66, 'HBsAg', '150', '000004008', '000004', '2018-03-09 17:10:01'),
(69, 'Blood Uric Acid', '100', '000008011', '000008', '2018-09-08 13:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE IF NOT EXISTS `laboratory` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_name` varchar(50) DEFAULT NULL,
  `lab_price` decimal(19,2) DEFAULT NULL,
  `lab_date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=42 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`lab_id`, `lab_name`, `lab_price`, `lab_date_added`) VALUES
(1, 'CBC', '100.00', '2018-03-07 23:42:05'),
(2, 'PSA', '950.00', '2018-03-07 23:42:09'),
(3, 'Blood Typing', '100.00', '2018-03-09 00:06:29'),
(4, 'NS1 dengue test', '1100.00', '2018-03-09 00:04:50'),
(5, 'HBsAg', '150.00', '2018-03-09 00:07:59'),
(6, 'Pregnancy Test', '120.00', '2018-03-09 00:08:24'),
(7, 'Urinalysis', '40.00', '2018-03-09 00:08:42'),
(8, 'Stool Routine Exam', '40.00', '2018-03-09 00:09:04'),
(9, 'Albumine', '100.00', '2018-03-09 00:09:21'),
(10, 'Blood Urea Nitrogen', '85.00', '2018-03-09 00:09:47'),
(11, 'Blood Uric Acid', '100.00', '2018-03-09 00:10:42'),
(12, 'Creatinine', '85.00', '2018-03-09 00:11:00'),
(13, 'FBS', '85.00', '2018-03-09 00:12:17'),
(14, 'labtika1', '1000.00', '2018-09-09 04:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(50) DEFAULT NULL,
  `med_qty` smallint(6) DEFAULT NULL,
  `med_in` smallint(6) DEFAULT NULL,
  `med_out` smallint(6) DEFAULT NULL,
  `med_price` decimal(10,0) DEFAULT NULL,
  `expiryDate` date NOT NULL,
  `med_date_added` datetime DEFAULT NULL,
  `med_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=55 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `med_name`, `med_qty`, `med_in`, `med_out`, `med_price`, `expiryDate`, `med_date_added`, `med_status`) VALUES
(4, 'Biogesic 250mg', 27, NULL, NULL, '0', '2018-09-08', '2018-03-10 01:33:57', 'active'),
(5, 'Lopermide 200mg', 50, NULL, NULL, '6', '2018-11-14', '2018-03-10 01:34:13', 'active'),
(6, 'Mefenamic Acid 250mg', 50, NULL, NULL, '4', '2018-09-26', '2018-03-10 01:34:50', 'active'),
(7, 'Nifedipine 10mg', 50, NULL, NULL, '10', '2018-09-18', '2018-03-10 01:35:40', 'active'),
(8, 'Amoxicilin 500mg caps', 116, NULL, NULL, '0', '2018-09-10', '2018-03-10 01:36:17', 'active'),
(9, 'Aspirin 80mg Tab', 0, NULL, NULL, '0', '2018-09-25', '2018-03-10 01:36:48', 'active'),
(10, 'Kispirin 10mg', 36, NULL, NULL, '500', '2018-10-25', '2018-03-10 01:37:06', 'active'),
(11, 'Yakapsule 3mg', 50, NULL, NULL, '100', '2018-10-04', '2018-03-10 01:37:30', 'active'),
(12, 'med1', 100, NULL, NULL, '200', '2018-11-07', '2018-09-09 04:47:11', 'active'),
(13, 'Yakapsule', 100, NULL, NULL, '50', '2018-12-12', '2018-09-09 15:31:14', 'active'),
(14, 'qweq', 2, NULL, NULL, '0', '2019-02-02', '2018-09-09 17:54:43', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `med_billings`
--

CREATE TABLE IF NOT EXISTS `med_billings` (
  `mb_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_desc` varchar(255) DEFAULT NULL,
  `mb_qty` smallint(6) DEFAULT NULL,
  `mb_price` decimal(19,2) DEFAULT NULL,
  `mb_total` decimal(10,0) DEFAULT NULL,
  `patient_trans_id` varchar(255) DEFAULT NULL,
  `mb_date` date DEFAULT NULL,
  PRIMARY KEY (`mb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=69 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `med_billings`
--

INSERT INTO `med_billings` (`mb_id`, `mb_desc`, `mb_qty`, `mb_price`, `mb_total`, `patient_trans_id`, `mb_date`) VALUES
(11, 'Kispirin 10mg', 2, '500.00', '1000', '000004008', '2018-03-09'),
(12, 'Nifedipine 10mg', 5, '10.00', '50', '000004008', '2018-03-09'),
(13, 'Aspirin 80mg Tab', 15, '3.00', '45', '000001007', '2018-03-09'),
(14, 'Lopermide 200mg', 5, '6.00', '30', '000001007', '2018-03-09'),
(15, 'Biogesic 250mg', 5, '5.00', '25', '000003005', '2018-03-09'),
(16, 'Nifedipine 10mg', 5, '10.00', '50', '000003005', '2018-03-09'),
(17, 'Kispirin 10mg', 1, '500.00', '500', '000003005', '2018-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `med_in`
--

CREATE TABLE IF NOT EXISTS `med_in` (
  `med_in_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_id` varchar(100) NOT NULL,
  `medin_qty` int(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`med_in_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `med_in`
--

INSERT INTO `med_in` (`med_in_id`, `med_id`, `medin_qty`, `added_by`, `date_added`) VALUES
(3, '8', 1234, 'Jendy Villamor Manatad', '2018-09-09 17:58:05'),
(2, '8', 8, 'Jendy Villamor Manatad', '2018-09-09 17:52:35'),
(4, '9', 20, 'Jendy Villamor Manatad', '2018-09-10 03:10:14'),
(5, '8', 80, 'Jendy Villamor Manatad', '2018-09-10 03:11:38'),
(6, '9', 100, 'Jendy Villamor Manatad', '2018-09-10 03:14:58'),
(7, '8', 31, 'Jenny V Manatad', '2018-09-10 03:19:22'),
(8, '8', 5, 'Jendy Villamor Manatad', '2018-09-10 04:39:56'),
(9, '9', 1, 'Jendy Villamor Manatad', '2018-09-10 04:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `med_out`
--

CREATE TABLE IF NOT EXISTS `med_out` (
  `med_out_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(50) NOT NULL,
  `med_id` varchar(100) NOT NULL,
  `medout_qty` int(50) NOT NULL,
  `reasons` varchar(200) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`med_out_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `med_out`
--

INSERT INTO `med_out` (`med_out_id`, `patient_id`, `med_id`, `medout_qty`, `reasons`, `added_by`, `transaction_date`) VALUES
(4, '000003', '', 5, 'qweqwe', 'Jendy Villamor Manatad', '2018-09-09 17:36:25'),
(5, '000002', '', 10, 'qwe', 'Jendy Villamor Manatad', '2018-09-09 17:56:13'),
(6, '000001', '', 5, 'tambal sakit sa dughan', 'Jendy Villamor Manatad', '2018-09-10 03:09:57'),
(7, '000001', '', 23, 'werwre', 'Jenny V Manatad', '2018-09-10 03:20:41'),
(8, '000001', '', 2, '2', 'Jendy Villamor Manatad', '2018-09-10 04:33:01'),
(9, '000001', '', 5, '5', 'Jendy Villamor Manatad', '2018-09-10 04:34:09'),
(10, '000002', '', 3, '3', 'Jendy Villamor Manatad', '2018-09-10 04:34:35'),
(11, '0', '10', 4, '4', 'Jendy Villamor Manatad', '2018-09-10 04:35:14'),
(12, '000004', '9', 1, '1', 'Jendy Villamor Manatad', '2018-09-10 04:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `patient_transaction`
--

CREATE TABLE IF NOT EXISTS `patient_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_trans_id` varchar(255) DEFAULT NULL,
  `patient_id` varchar(255) DEFAULT NULL,
  `incharge_doc` varchar(255) DEFAULT NULL,
  `patient_ward_no` varchar(255) DEFAULT NULL,
  `patient_bed_no` int(11) DEFAULT NULL,
  `patient_date_discharge` datetime DEFAULT NULL,
  `patient_findings` varchar(255) DEFAULT NULL,
  `patient_doc_prescription` varchar(255) DEFAULT NULL,
  `patient_soa` varchar(255) DEFAULT NULL,
  `patient_date_incharge` date DEFAULT NULL,
  `patient_total_bills` varchar(255) DEFAULT NULL,
  `patient_status` varchar(255) DEFAULT NULL,
  `patient_tender_amount` varchar(255) DEFAULT NULL,
  `patient_change` varchar(255) DEFAULT NULL,
  `patient_remarks` varchar(255) DEFAULT NULL,
  `patient_amount_disc` decimal(8,2) DEFAULT NULL,
  `patient_total_discounted` decimal(10,0) DEFAULT NULL,
  `patient_type_disc` varchar(255) DEFAULT NULL,
  `patient_discountId` varchar(255) DEFAULT NULL,
  `patient_discSponsor` varchar(255) DEFAULT NULL,
  `patient_detDiscount` varchar(255) DEFAULT NULL,
  `patient_admit_diagnos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=100 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `patient_transaction`
--

INSERT INTO `patient_transaction` (`id`, `patient_trans_id`, `patient_id`, `incharge_doc`, `patient_ward_no`, `patient_bed_no`, `patient_date_discharge`, `patient_findings`, `patient_doc_prescription`, `patient_soa`, `patient_date_incharge`, `patient_total_bills`, `patient_status`, `patient_tender_amount`, `patient_change`, `patient_remarks`, `patient_amount_disc`, `patient_total_discounted`, `patient_type_disc`, `patient_discountId`, `patient_discSponsor`, `patient_detDiscount`, `patient_admit_diagnos`) VALUES
(69, '000001001', '000001', 'Jendy V. Manatad', '1', 1, '2018-03-08 03:20:44', 'heartache', 'Lopermide 200mg 3x/day', NULL, '2018-03-08', '50', 'Inactive', '50', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(70, '000001002', '000001', 'Hyacinth Cipres', '1', 1, '2018-03-08 14:44:04', NULL, NULL, NULL, '2018-03-08', '50', 'Inactive', '50', '25', NULL, '50.00', '25', 'Discounts', '', NULL, 'Yes', NULL),
(71, '000002003', '000002', 'Jendy V. Manatad', '2', 1, '2018-03-08 15:21:18', 'qweqe', 'Lopermide 200mg  3x/day', NULL, '2018-03-08', '1150', 'Inactive', '1200', '50', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(72, '000001004', '000001', 'Jendy V. Manatad', '1', 1, '2018-03-09 05:50:23', 'Back PAin\r\nToothAche\r\nFever', 'Lopermide 200mg 3x/day\r\nMefenamic 500mg 2x/day', NULL, '2018-03-08', '250', 'Inactive', '300', '50', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(73, '000003005', '000003', 'Hyacinth Cipres', '1', 1, '2018-03-10 03:14:15', 'Hilanat Tinoud', 'Diatabs 200mg 3x/day', NULL, '2018-03-08', '765', 'Inactive', '400', '17.5', NULL, '50.00', '383', 'SC', '09028342', NULL, 'Yes', 'Murag Hilanat'),
(74, '000001006', '000001', 'Jendy V. Manatad', '1', 0, '2018-03-09 05:56:45', 'qweqe', 'Lopermide 200mg 3x/day', NULL, '2018-03-09', '50', 'Inactive', '50', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(75, '000001007', '000001', 'Jendy V. Manatad', '1', 1, '2018-03-09 06:47:46', NULL, NULL, NULL, '2018-03-09', '1225', 'Inactive', '1300', '75', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(77, '000004008', '000004', 'Jendy V. Manatad', 'MCHA-1', 2, '2018-03-09 13:10:47', 'asasd', 'Lopermide 200mg 2x/perday', NULL, '2018-03-09', '2200', 'Inactive', '1100', '0', NULL, '50.00', '1100', 'PWD', '', NULL, 'Yes', NULL),
(82, '000006009', '000006', 'Jendy V. Manatad', 'FCHA-3', 2, '2018-03-09 15:39:54', 'Hilanat Jud', 'Neozep 200mg 3x/day', NULL, '2018-03-09', '2690', 'Inactive', '1500', '155', NULL, '50.00', '1345', 'PWD', '009193717623', NULL, 'Yes', 'Hilanat'),
(83, '0000020010', '000002', 'Gene Rose G Obregon', 'MCHA-2', 5, '2018-03-17 03:33:44', '', 'Lopermide 200mg 3x/day', NULL, '2018-03-10', NULL, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sakit sa Likod'),
(84, '000008011', '000008', 'Dominga V.  Manatad', 'MCHA-4', 4, '2018-09-09 04:41:17', 'cccv', 'Nifedipine 10mg  4', NULL, '2018-09-09', '150', 'Inactive', '100', '25', NULL, '50.00', '75', 'PWD', '3', NULL, 'Yes', 'hnhj');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vsr`
--

CREATE TABLE IF NOT EXISTS `patient_vsr` (
  `vsr_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_trans_id` varchar(255) DEFAULT NULL,
  `vsr_temp` varchar(255) DEFAULT NULL,
  `vsr_bp` varchar(255) DEFAULT NULL,
  `vsr_pr` varchar(255) DEFAULT NULL,
  `vsr_rr` varchar(255) DEFAULT NULL,
  `vsr_date` datetime DEFAULT NULL,
  PRIMARY KEY (`vsr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=60 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patient_vsr`
--

INSERT INTO `patient_vsr` (`vsr_id`, `patient_trans_id`, `vsr_temp`, `vsr_bp`, `vsr_pr`, `vsr_rr`, `vsr_date`) VALUES
(2, '000006009', '38', '120/80', '26/bpm', '50/bpm', '2018-03-09 14:32:57'),
(3, '0000020010', '39', '100/70', '30bpm', '50bpm', '2018-03-10 03:33:34'),
(4, '000008011', '45', '45', '45', '45', '2018-09-09 04:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `guardian` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=1489 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `patient_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `guardian`, `address`, `status`, `religion`, `age`, `birthdate`, `remarks`, `date_added`) VALUES
(49, '000001', 'GENE ROSE', 'OPALLA', 'OBREGON', '09123124121', 'Female', 'Tinangs', 'DAYAS, CORDOVA', 'Widow', 'Widow', '27', '1991-03-09', 'Active', '2018-03-07 18:10:54'),
(50, '000002', 'HYACINTH MAE', 'G', 'CIPRES', '09234234252', 'Female', 'FREDA CIPRES', 'AGUS, LLC', 'Single', 'Single', '18', '2000-09-09', 'Active', '2018-03-07 18:17:04'),
(51, '000003', 'JURIE', 'MANATAD', 'DACULLO', '09273846274', 'Male', 'MILA DACULLO', 'BUENAVISTA, BOHOL', 'Single', 'Born Again', '24', '1994-06-19', 'Active', '2018-03-07 18:26:18'),
(52, '000004', 'JEFFREY', 'VILLAMOR', 'MANATAD', '09234234243', 'Male', 'CRIS', 'MANILA', 'Single', 'Roman Catholic', '28', '1990-07-12', 'Active', '2018-03-07 18:32:10'),
(53, '000005', 'YVECK', 'T', 'CENECERO', '09623423424', 'Female', 'NIYOG', 'LUSONG', 'Single', 'Born Again', '25', '1993-09-07', 'Active', '2018-03-07 18:34:57'),
(54, '000006', 'MELYN', 'T', 'CENECERO', '09234245239', 'Female', 'TIMI', 'BOHOL', 'Single', 'Roman Catholic', '29', '1989-09-13', 'Active', '2018-03-07 18:36:25'),
(55, '000007', 'GERRY', 'M', 'CENIZA', '09172342342', 'Female', 'LOPER', 'BOHOL', 'Married', 'Roman Catholic', '26', '1991-07-12', 'Active', '2018-03-07 18:38:07'),
(56, '000008', 'hjnbjhb', 'jkjk', 'jkk', '09123456789', 'Male', '   bnm', 'nmmnm', 'Widow', 'Protestant', '21', '1993-11-04', 'Active', '2018-09-08 13:29:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
