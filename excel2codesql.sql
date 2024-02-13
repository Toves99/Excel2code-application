-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 05:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerdebit`
--

CREATE TABLE `customerdebit` (
  `id` int(11) NOT NULL,
  `transactionid` int(11) DEFAULT NULL,
  `serviceid` varchar(255) DEFAULT NULL,
  `accountnumber` varchar(255) DEFAULT NULL,
  `businessnumber` int(11) DEFAULT NULL,
  `debitamount` double DEFAULT NULL,
  `creditamount` double DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `debitdatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creditdateTime` date DEFAULT NULL,
  `paymentstatus` int(11) DEFAULT 0,
  `checkoutid` varchar(255) NOT NULL,
  `merchantrequestid` varchar(255) NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerdebit`
--

INSERT INTO `customerdebit` (`id`, `transactionid`, `serviceid`, `accountnumber`, `businessnumber`, `debitamount`, `creditamount`, `phonenumber`, `debitdatetime`, `creditdateTime`, `paymentstatus`, `checkoutid`, `merchantrequestid`, `userId`) VALUES
(30, 2147483647, 'SE001', '66656', 174379, 8, 0, '254715185271', '2023-12-04 18:41:13', NULL, 2, 'ws_CO_04122023201230292715185271', '25426-72418542-2', 22),
(31, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-04 18:41:03', NULL, 0, 'ws_CO_04122023214412542715185271', '3964-68410511-2', 22),
(32, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-04 18:59:13', NULL, 0, 'ws_CO_04122023220113046715185271', '1196-97480936-1', 22),
(33, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-07 04:46:04', NULL, 0, 'ws_CO_07122023104835585715185271', '118909-113178674-1', 22),
(34, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-07 04:58:40', NULL, 0, 'ws_CO_07122023110111576715185271', '98173-49138524-1', 22),
(35, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-07 21:36:28', NULL, 0, 'ws_CO_08122023152323558715185271', '28122-1337522-1', 22),
(36, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 13:05:16', NULL, 0, 'ws_CO_08122023162053653715185271', '17125-79417710-1', 22),
(37, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 12:31:33', NULL, 0, 'ws_CO_08122023164710927715185271', '25493-109175177-1', 22),
(38, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-08 12:41:56', NULL, 0, 'ws_CO_08122023165623622715185271', '3204-5727110-1', 22),
(39, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-08 12:51:46', NULL, 0, 'ws_CO_08122023170613308715185271', '1189-110143913-1', 22),
(40, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 12:38:44', NULL, 0, 'ws_CO_08122023175312048715185271', '42592-1800138-1', 22),
(41, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 12:46:03', NULL, 0, 'ws_CO_08122023180141422715185271', '25501-109334217-1', 22),
(42, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 17:46:09', NULL, 0, 'ws_CO_08122023204920498715185271', '17147-80078007-1', 22),
(43, 2147483647, 'SE001', '66656', 174379, 8, 0, '254715185271', '2023-12-08 21:34:27', NULL, 0, 'ws_CO_09122023115056972715185271', '98186-54206115-1', 22),
(44, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 21:36:12', NULL, 0, 'ws_CO_09122023115130832715185271', '3207-7451990-1', 22),
(45, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-08 21:40:07', NULL, 0, 'ws_CO_09122023115525686715185271', '118888-118288052-3', 22),
(46, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-08 21:45:00', NULL, 0, 'ws_CO_09122023120019077715185271', '3981-83122095-1', 22),
(47, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-08 21:29:36', NULL, 0, 'ws_CO_09122023133644334715185271', '25434-87500919-1', 22),
(48, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-09 17:16:53', NULL, 0, 'ws_CO_09122023204153993715185271', '25432-88243763-1', 22),
(49, 2147483647, 'SE001', '66656', 174379, 8, 0, '254715185271', '2023-12-09 18:01:31', NULL, 0, 'ws_CO_09122023210443155715185271', '25405-88287587-1', 22),
(50, 2147483647, 'SE001', '66656', 174379, 8, 0, '254715185271', '2023-12-09 18:04:58', NULL, 0, 'ws_CO_09122023210809886715185271', '28142-4210587-1', 22),
(51, 2147483647, 'SE001', '66656', 174379, 2, 0, '254715185271', '2023-12-09 18:12:13', NULL, 0, 'ws_CO_09122023211524127715185271', '3976-84096193-1', 22),
(52, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-09 18:03:02', NULL, 0, 'ws_CO_09122023214509404715185271', '3971-84152774-1', 22),
(53, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-09 21:09:44', NULL, 0, 'ws_CO_10122023001820702715185271', '42582-4810805-1', 22),
(54, 2147483647, 'SE001', '66656', 174379, 10, 0, '254715185271', '2023-12-09 20:29:51', NULL, 0, 'ws_CO_10122023003827293715185271', '25512-112169912-1', 22),
(55, 2147483647, 'SE001', '66656', 174379, 4, 0, '254714161912', '2023-12-10 11:19:28', NULL, 0, 'ws_CO_10122023142241731714161912', '3216-9507307-1', 22),
(56, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-11 12:42:59', NULL, 0, 'ws_CO_11122023154501730715185271', '17144-85063456-1', 22),
(57, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-11 15:29:41', NULL, 0, 'ws_CO_11122023183254680715185271', '17140-85311900-1', 22),
(58, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-11 17:07:01', NULL, 0, 'ws_CO_11122023201014675769414211', '1202-116104773-1', 22),
(59, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-11 19:01:12', NULL, 0, 'ws_CO_11122023220314347715185271', '1194-116330308-1', 22),
(60, 2147483647, 'SE001', '66656', 174379, 4, 0, '254715185271', '2023-12-11 19:50:17', NULL, 0, 'ws_CO_11122023225220166715185271', '42597-8422126-1', 22),
(61, 2147483647, 'SE001', '66656', 174379, 10, 0, '254715185271', '2023-12-12 14:29:51', NULL, 0, 'ws_CO_12122023173155222715185271', '25507-116761985-2', 22),
(62, 2147483647, 'SE001', '66656', 174379, 6, 0, '254715185271', '2023-12-12 16:08:30', NULL, 0, 'ws_CO_12122023191035508715185271', '17124-87203469-1', 22),
(63, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-12 20:19:47', NULL, 0, 'ws_CO_12122023232150546769414211', '42597-10394775-1', 22),
(64, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-12 20:20:18', NULL, 0, 'ws_CO_12122023232332970769414211', '17144-87649429-1', 22),
(65, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-13 08:02:50', NULL, 0, 'ws_CO_13122023110606351769414211', '121535-190799268-1', 22),
(66, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-13 08:06:01', NULL, 0, 'ws_CO_13122023110917221769414211', '118903-125447960-1', 22),
(67, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-13 08:08:54', NULL, 0, 'ws_CO_13122023111209689769414211', '28144-10316004-1', 22),
(68, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-13 08:25:03', NULL, 0, 'ws_CO_13122023112818911769414211', '17135-88280622-1', 22),
(69, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-13 08:28:33', NULL, 0, 'ws_CO_13122023113037705769414211', '98190-61343066-3', 22),
(70, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-13 08:47:13', NULL, 0, 'ws_CO_13122023114917477769414211', '42588-11116030-1', 22),
(71, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-13 09:03:08', NULL, 0, 'ws_CO_13122023120623926769414211', '121533-190882668-2', 22),
(72, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-13 09:26:29', NULL, 0, 'ws_CO_13122023122944589769414211', '118901-125561496-2', 22),
(73, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-13 17:09:39', NULL, 0, 'ws_CO_13122023201144243769414211', '25405-95254141-1', 22),
(74, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 07:50:28', NULL, 0, 'ws_CO_14122023105234595769414211', '1205-120653275-2', 22),
(75, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 08:20:02', NULL, 0, 'ws_CO_14122023112319323769414211', '25498-119844676-2', 22),
(76, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-14 08:21:09', NULL, 0, 'ws_CO_14122023112426577769414211', '25419-96284367-1', 22),
(77, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 08:44:20', NULL, 0, 'ws_CO_14122023114738071769414211', '118911-127368361-1', 22),
(78, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254715185271', '2023-12-14 09:55:44', NULL, 0, 'ws_CO_14122023125902103715185271', '28134-12312269-2', 22),
(79, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 11:49:54', NULL, 0, 'ws_CO_14122023145311855769414211', '121535-192964751-1', 22),
(80, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-14 12:45:28', NULL, 0, 'ws_CO_14122023154846242769414211', '118903-127738563-1', 22),
(81, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 20:09:16', NULL, 0, 'ws_CO_14122023231119801769414211', '121507-193817711-1', 22),
(82, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-14 20:29:47', NULL, 0, 'ws_CO_14122023233302748769414211', '98186-64382548-1', 22),
(83, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-14 20:37:02', NULL, 0, 'ws_CO_14122023234017603769414211', '28140-13374246-1', 22),
(84, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-14 20:48:45', NULL, 0, 'ws_CO_14122023235200643769414211', '3980-93502900-1', 22),
(85, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 08:48:10', NULL, 0, 'ws_CO_15122023115125257769414211', '28145-14025355-1', 22),
(86, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-15 09:16:41', NULL, 0, 'ws_CO_15122023121955792769414211', '1190-122567182-2', 22),
(87, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 09:19:43', NULL, 0, 'ws_CO_15122023122146582769414211', '98188-65077567-1', 22),
(88, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 09:33:36', NULL, 0, 'ws_CO_15122023123539666769414211', '25496-121762820-1', 22),
(89, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 09:57:41', NULL, 0, 'ws_CO_15122023130056415769414211', '118908-129299434-1', 22),
(90, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 11:20:47', NULL, 0, 'ws_CO_15122023142251413769414211', '3972-94386711-1', 22),
(91, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 12:11:16', NULL, 0, 'ws_CO_15122023151431871769414211', '1200-122815676-1', 22),
(92, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 16:25:01', NULL, 0, 'ws_CO_15122023192817087769414211', '121532-195170803-2', 22),
(93, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 17:03:15', NULL, 0, 'ws_CO_15122023200630702769414211', '1200-123282346-1', 22),
(94, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 17:41:42', NULL, 0, 'ws_CO_15122023204457944769414211', '1199-123358021-1', 22),
(95, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-15 17:45:02', NULL, 0, 'ws_CO_15122023204817007769414211', '121509-195330109-1', 22),
(96, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-15 17:57:16', NULL, 0, 'ws_CO_15122023205920835769414211', '98174-65906423-1', 22),
(97, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 18:48:29', NULL, 0, 'ws_CO_15122023215032370769414211', '17132-92913089-1', 22),
(98, 2147483647, 'SE001', '66656', 174379, 6, 0, '254769414211', '2023-12-15 19:26:21', NULL, 0, 'ws_CO_15122023222936927769414211', '118908-130232221-1', 22),
(99, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-15 20:04:40', NULL, 0, 'ws_CO_15122023230757368769414211', '25405-99215558-2', 22),
(100, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-15 20:23:46', NULL, 0, 'ws_CO_15122023232703260769414211', '17126-93048471-1', 22),
(101, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-16 15:00:45', NULL, 0, 'ws_CO_16122023180401404769414211', '28144-16410045-1', 22),
(102, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-16 15:01:54', NULL, 0, 'ws_CO_16122023180357334769414211', '118907-131615741-1', 22),
(103, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254726586630', '2023-12-16 15:36:42', NULL, 0, 'ws_CO_16122023183959393726586630', '3966-96669749-1', 22),
(104, 2147483647, 'SE001', '66656', 174379, 8, 0, '254769414211', '2023-12-17 09:44:52', NULL, 0, 'ws_CO_17122023124809094769414211', '3974-97937364-1', 22),
(105, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-17 10:14:14', NULL, 0, 'ws_CO_17122023131731416769414211', '17131-95660152-1', 22),
(106, 2147483647, 'SE001', '66656', 174379, 8, 0, '254769414211', '2023-12-17 10:51:58', NULL, 0, 'ws_CO_17122023135402717769414211', '3206-21987587-1', 22),
(107, 2147483647, 'SE001', '66656', 174379, 4, 0, '254769414211', '2023-12-17 10:56:45', NULL, 0, 'ws_CO_17122023140001648769414211', '3197-21994535-1', 22),
(108, 2147483647, 'SE001', '66656', 174379, 1000000, 0, '254769414211', '2023-12-17 11:07:19', NULL, 0, 'ws_CO_17122023141036609769414211', '25496-125490162-1', 22);

-- --------------------------------------------------------

--
-- Table structure for table `debttb`
--

CREATE TABLE `debttb` (
  `Id` int(11) NOT NULL,
  `paymentAmount` varchar(255) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `currentTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debttb`
--

INSERT INTO `debttb` (`Id`, `paymentAmount`, `transaction_id`, `status`, `currentTime`) VALUES
(102, '20', 2147483647, 'paid', '2023-11-02 10:26:36'),
(103, '20', 2147483647, 'paid', '2023-11-02 10:29:57'),
(104, '20', 2147483647, 'paid', '2023-11-02 10:30:30'),
(105, '20', 2147483647, 'paid', '2023-11-02 10:39:17'),
(106, '20', 2147483647, 'paid', '2023-11-02 11:03:06'),
(107, '20', 2147483647, 'paid', '2023-11-02 11:03:42'),
(108, '20', 2147483647, 'paid', '2023-11-02 11:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `excelcalculatortb`
--

CREATE TABLE `excelcalculatortb` (
  `producttId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `monthvalue` varchar(255) NOT NULL,
  `costperunit` varchar(255) NOT NULL,
  `totalCost` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `productCategory` varchar(255) NOT NULL,
  `expiryDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uploadfile` text NOT NULL,
  `orderid` int(11) DEFAULT NULL,
  `companyid` int(11) NOT NULL,
  `nature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `excelcalculatortb`
--

INSERT INTO `excelcalculatortb` (`producttId`, `productName`, `monthvalue`, `costperunit`, `totalCost`, `userId`, `productid`, `productCategory`, `expiryDate`, `uploadfile`, `orderid`, `companyid`, `nature`) VALUES
(386, 'loan calculator', '6', '1000000', '1000000', 22, '47438901101', 'loan calculator', '2024-06-17 09:15:26', 'prscalculator.xls', 397, 233639, 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `excelproductvariables`
--

CREATE TABLE `excelproductvariables` (
  `id` int(11) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `serviceid` varchar(255) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `variablename` varchar(255) DEFAULT NULL,
  `cellrefid` varchar(11) DEFAULT NULL,
  `variabletype` varchar(20) DEFAULT NULL,
  `variablesrequiresuseinput` int(1) DEFAULT 0,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freetrial`
--

CREATE TABLE `freetrial` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productCategory` varchar(255) NOT NULL,
  `uploadfile` text NOT NULL,
  `userId` int(11) NOT NULL,
  `productid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `messagehead` varchar(255) NOT NULL,
  `messagebody` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageid`, `messagehead`, `messagebody`, `userId`) VALUES
(1, 'Welcome message', 'Hello clinton welcome to excel2code converter', 22),
(2, 'Welcome message', 'Hello clinton welcome to excel2code converter', 22);

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `Id` int(11) NOT NULL,
  `count1` int(255) NOT NULL,
  `totalCost1` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`Id`, `count1`, `totalCost1`) VALUES
(1, 1, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `myorder`
--

CREATE TABLE `myorder` (
  `Id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `calcId` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `selectedValue` varchar(255) DEFAULT NULL,
  `totalAmount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `servicename` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `validityperiod` int(2) DEFAULT NULL,
  `expirydate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paidamount` double NOT NULL,
  `paymentstatus` int(11) NOT NULL,
  `paymentmessage` varchar(255) NOT NULL,
  `transactiontime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderprice` double NOT NULL,
  `serviceid` varchar(10) NOT NULL,
  `subscriptionstatus` int(1) NOT NULL,
  `costperunit` double NOT NULL,
  `packagename` varchar(255) NOT NULL,
  `subscriptionid` int(11) NOT NULL,
  `totalunit` int(11) NOT NULL,
  `nature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `servicename`, `service`, `count`, `userId`, `validityperiod`, `expirydate`, `paidamount`, `paymentstatus`, `paymentmessage`, `transactiontime`, `orderprice`, `serviceid`, `subscriptionstatus`, `costperunit`, `packagename`, `subscriptionid`, `totalunit`, `nature`) VALUES
(397, 'Excel2codeAPI', 'Excel calculator', 1, 22, 6, '2024-06-17 09:07:34', 1000000, 1, 'paid', '2023-12-17 11:07:34', 1000000, 'SE001', 0, 1000000, 'Standard', 2147483647, 1, 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `packagecode` varchar(255) NOT NULL,
  `packagename` varchar(255) NOT NULL,
  `mincalculator` int(11) NOT NULL,
  `maxcalculator` int(11) NOT NULL,
  `unitprice` double NOT NULL,
  `benefit` varchar(255) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `packagecode`, `packagename`, `mincalculator`, `maxcalculator`, `unitprice`, `benefit`, `pdate`) VALUES
(1, 'P0010', 'Standard\r\n\r\n \r\n', 0, 1, 1000000, 'Only 1 Calculator can be uploaded and used.', '2023-11-28 13:02:26'),
(2, 'P0020', 'Silver', 2, 5, 2, ' A minimum of 2 and a maximum of 5 Calculators can be uploaded and used.', '2023-11-28 13:02:26'),
(3, 'P0030', 'Gold', 6, 10, 24000, ' A minimum of 6 and a maximum of 10 Calculators can be uploaded and used.', '2023-11-28 13:02:26'),
(4, 'P0040', 'Platinum', 10, 100, 36000, ' A minimum of 10  Calculators can be uploaded there is no maximum limit.', '2023-11-28 13:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `paymentreceipt`
--

CREATE TABLE `paymentreceipt` (
  `id` int(11) NOT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `accountnumber` varchar(255) DEFAULT NULL,
  `receiptnumber` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `resultcode` int(11) DEFAULT NULL,
  `transactionid` varchar(255) NOT NULL,
  `businessnumber` varchar(255) NOT NULL,
  `checkoutid` varchar(255) NOT NULL,
  `merchantrequestid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentreceipt`
--

INSERT INTO `paymentreceipt` (`id`, `phonenumber`, `accountnumber`, `receiptnumber`, `amount`, `datetime`, `resultcode`, `transactionid`, `businessnumber`, `checkoutid`, `merchantrequestid`) VALUES
(15, '254715185271', '66656', 'RL2516X9RJ', 4, '2023-12-02 16:12:01', 0, '20231202191159', '174379', 'ws_CO_02122023191349285715185271', '18125-159818684-1'),
(16, '', '66656', '', 0, '2023-12-02 19:23:55', 1037, '', '174379', 'ws_CO_02122023222620930715185271', '7854-17953670-1'),
(17, '254714161912', '66656', 'RL261Z3ZLG', 4, '2023-12-02 19:44:23', 0, '20231202224423', '174379', 'ws_CO_02122023224715545714161912', '7859-18029126-1'),
(18, '', '66656', '', 0, '2023-12-04 08:40:00', 1019, '', '174379', 'ws_CO_04122023113934012715185271', '25498-94222100-2'),
(19, '', '66656', '', 0, '2023-12-04 09:25:56', 1037, '', '174379', 'ws_CO_04122023122721719715185271', '1198-95369543-1'),
(20, '', '66656', '', 0, '2023-12-04 09:36:07', 1037, '', '174379', 'ws_CO_04122023123837481715185271', '121507-167350914-1'),
(21, '', '66656', '', 0, '2023-12-04 09:52:05', 1032, '', '174379', 'ws_CO_04122023125504006715185271', '98172-37570357-2'),
(22, '', '66656', '', 0, '2023-12-04 16:26:50', 1037, '', '174379', 'ws_CO_04122023192930722715185271', '3956-67824226-3'),
(23, '', '66656', '', 0, '2023-12-04 17:09:58', 1037, '', '174379', 'ws_CO_04122023201230292715185271', '25426-72418542-2');

-- --------------------------------------------------------

--
-- Table structure for table `paymenttb`
--

CREATE TABLE `paymenttb` (
  `CheckoutRequestID` varchar(255) DEFAULT NULL,
  `ResultCode` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `MpesaReceiptNumber` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymenttb`
--

INSERT INTO `paymenttb` (`CheckoutRequestID`, `ResultCode`, `amount`, `MpesaReceiptNumber`, `PhoneNumber`) VALUES
('ws_CO_02112023124929680715185271', 0, 30.00, 'RK217OZLNV', '254715185271'),
('ws_CO_02112023130935608715185271', 0, 20.00, 'RK287R842U', '254715185271'),
('ws_CO_02112023132825446715185271', 0, 20.00, 'RK267TDSKO', '254715185271'),
('ws_CO_02112023140602890715185271', 0, 20.00, 'RK267XNK1W', '254715185271'),
('', 0, 0.00, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `serviceName` varchar(255) DEFAULT NULL,
  `individualService` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `serviceName`, `individualService`) VALUES
(1, 'Excel2code', 'Excelform'),
(2, 'Insurance', 'Excelform');

-- --------------------------------------------------------

--
-- Table structure for table `producttb`
--

CREATE TABLE `producttb` (
  `Id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `monthvalue` varchar(255) NOT NULL,
  `costperunit` varchar(255) NOT NULL,
  `totalCost` varchar(255) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `orderId` int(11) DEFAULT NULL,
  `productid` int(11) NOT NULL,
  `expiryDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `productCategory` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `systemsettings`
--

CREATE TABLE `systemsettings` (
  `id` int(11) NOT NULL,
  `parametername` varchar(255) DEFAULT NULL,
  `parametervalue` varchar(255) DEFAULT NULL,
  `unitofmeasurement` varchar(255) DEFAULT NULL,
  `currentdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemsettings`
--

INSERT INTO `systemsettings` (`id`, `parametername`, `parametervalue`, `unitofmeasurement`, `currentdate`) VALUES
(1, 'excelpackage duration', '14', 'days', '2023-12-16 13:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `testtb`
--

CREATE TABLE `testtb` (
  `Id` int(11) NOT NULL,
  `inputVar` varchar(255) NOT NULL,
  `outputVar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testtb`
--

INSERT INTO `testtb` (`Id`, `inputVar`, `outputVar`) VALUES
(1, 'Age', '40'),
(2, 'rate', '3%'),
(3, 'cost', '1000,000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `companyname` varchar(255) NOT NULL,
  `companyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `email`, `password`, `companyname`, `companyid`) VALUES
(22, 'clinton', 'clintonekesa90@gmail.com', '$2y$10$AjUDHhURkVhxR2.qeJJErO1ACBDWKfHB4oMAN.TNwsA94pJVPKESC', 'Britam', 233639),
(23, 'mary', 'clintonekesa10@gmail.coom', '$2y$10$5kvdgXldNLZhU5etI0ECb.p35WFBl70zOGHQAtJ34v.isFWsHHrce', 'Britam1', 245101);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerdebit`
--
ALTER TABLE `customerdebit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `debttb`
--
ALTER TABLE `debttb`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `excelcalculatortb`
--
ALTER TABLE `excelcalculatortb`
  ADD PRIMARY KEY (`producttId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `id` (`orderid`);

--
-- Indexes for table `excelproductvariables`
--
ALTER TABLE `excelproductvariables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `freetrial`
--
ALTER TABLE `freetrial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `myorder`
--
ALTER TABLE `myorder`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentreceipt`
--
ALTER TABLE `paymentreceipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `producttb`
--
ALTER TABLE `producttb`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `systemsettings`
--
ALTER TABLE `systemsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testtb`
--
ALTER TABLE `testtb`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `unique_constraint_company` (`companyname`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_constraint_name` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerdebit`
--
ALTER TABLE `customerdebit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `debttb`
--
ALTER TABLE `debttb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `excelcalculatortb`
--
ALTER TABLE `excelcalculatortb`
  MODIFY `producttId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

--
-- AUTO_INCREMENT for table `excelproductvariables`
--
ALTER TABLE `excelproductvariables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freetrial`
--
ALTER TABLE `freetrial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `myorder`
--
ALTER TABLE `myorder`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=398;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paymentreceipt`
--
ALTER TABLE `paymentreceipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `producttb`
--
ALTER TABLE `producttb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `systemsettings`
--
ALTER TABLE `systemsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testtb`
--
ALTER TABLE `testtb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerdebit`
--
ALTER TABLE `customerdebit`
  ADD CONSTRAINT `customerdebit_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `excelcalculatortb`
--
ALTER TABLE `excelcalculatortb`
  ADD CONSTRAINT `excelcalculatortb_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `excelcalculatortb_ibfk_2` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`);

--
-- Constraints for table `excelproductvariables`
--
ALTER TABLE `excelproductvariables`
  ADD CONSTRAINT `excelproductvariables_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `excelproductvariables_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `producttb` (`Id`);

--
-- Constraints for table `freetrial`
--
ALTER TABLE `freetrial`
  ADD CONSTRAINT `freetrial_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `producttb`
--
ALTER TABLE `producttb`
  ADD CONSTRAINT `producttb_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `producttb_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
