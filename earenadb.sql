-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2018 at 01:52 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earenadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `tempatID` char(5) NOT NULL,
  `lapanganID` char(5) NOT NULL,
  `dateAndTime` datetime NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`tempatID`, `lapanganID`, `dateAndTime`, `userName`) VALUES
('TP001', 'LP003', '2020-12-14 00:00:00', 'pius');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `tempatID` char(5) NOT NULL,
  `lapanganID` char(5) NOT NULL,
  `lapanganName` char(30) NOT NULL,
  `lapanganPicture` varchar(50) NOT NULL,
  `lapanganPrice` int(11) NOT NULL,
  `lapanganTipe` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`tempatID`, `lapanganID`, `lapanganName`, `lapanganPicture`, `lapanganPrice`, `lapanganTipe`) VALUES
('TP001', 'LP001', 'Lapangan Futsal', 'soccer/2.jpg', 150000, 'futsal'),
('TP001', 'LP002', 'Futsal Sintetis', 'soccer/3.jpg', 210000, 'futsal'),
('TP001', 'LP003', 'Mini Soccer', 'futsal/3.jpg', 320000, 'minisoccer'),
('TP002', 'LP001', 'Basket Normal', 'basket 1.jpg', 120000, 'basket'),
('TP002', 'LP002', 'Basket Besar', 'basket/2.jpg', 250000, 'basket'),
('TP003', 'LP001', 'Badminton Aspal', 'badminton/1.jpg', 175000, 'badminton'),
('TP004', 'LP001', 'Volley Pantai', 'volley/2.jpg', 175000, 'volley');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `ownerName` varchar(30) NOT NULL,
  `ownerPassword` varchar(30) NOT NULL,
  `ownerPicture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`ownerName`, `ownerPassword`, `ownerPicture`) VALUES
('mafaowner', 'mafaowner', '5bec14ae8c44a.png'),
('piusowner', 'piusowner', '5bec13cf46ae8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `tempatID` char(5) NOT NULL,
  `tempatName` varchar(30) NOT NULL,
  `tempatAddress` varchar(255) NOT NULL,
  `tempatPicture` varchar(50) NOT NULL,
  `ownerName` varchar(30) NOT NULL,
  `tempatDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`tempatID`, `tempatName`, `tempatAddress`, `tempatPicture`, `ownerName`, `tempatDesc`) VALUES
('TP001', 'Tangkas Sport Center', 'Jl. Rawa Belong nomor 34, Kebon Jeruk, Jakarta Barat', 'soccer/1.jpg', 'piusowner', 'Ayo main bareng kami! Suasana nyaman,fasilitas lengkap, serta tempat mudah dijangkau bakal bikin main kamu jadi lebih seru!'),
('TP002', 'Bengkel Basket', 'Jl. Pondok Kelapa Raya nomor 31, Duren Sawit, Jakarta Timur', 'basket/1.jpg', 'piusowner', 'Khusus kamu yang suka basket! Main bareng temen kamu ditempat terbaik buat main basket! dimana lagi kalo bukan di Bengkel Basket! Terdapat promo akhir bulan'),
('TP003', 'Badmin Fever', 'Jalan Kuningan Raya nomor 31, Jakarta Pusat', 'badminton/1.jpg', 'mafaowner', 'Main disini dan raih kesempatan kamu untuk ketemu Jojo! main 10x dan kamu berpeluang juga ketemu Shinta!'),
('TP004', 'Volley Mantul', 'Jalan Kebon Sari, Tanah Abang, Jakarta Pusat', 'volley/1.jpeg', 'mafaowner', 'Yuk main volley bareng temen-temen kamu hanya di Volley Mantul!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(30) NOT NULL,
  `userPassword` varchar(30) NOT NULL,
  `userPicture` varchar(50) NOT NULL,
  `userMoney` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `userPassword`, `userPicture`, `userMoney`) VALUES
('pius', 'pius', '5bec166d562d0.jpg', 9679999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`tempatID`,`lapanganID`,`dateAndTime`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`tempatID`,`lapanganID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`ownerName`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`tempatID`),
  ADD KEY `c1` (`ownerName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`tempatID`,`lapanganID`) REFERENCES `lapangan` (`tempatID`, `lapanganID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`);

--
-- Constraints for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD CONSTRAINT `c2` FOREIGN KEY (`tempatID`) REFERENCES `tempat` (`tempatID`);

--
-- Constraints for table `tempat`
--
ALTER TABLE `tempat`
  ADD CONSTRAINT `c1` FOREIGN KEY (`ownerName`) REFERENCES `owner` (`ownerName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
