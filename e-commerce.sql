-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 03:27 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `printer_tb`
--

CREATE TABLE `printer_tb` (
  `IdPrinter` int(11) NOT NULL,
  `NamaPrinter` varchar(50) NOT NULL,
  `SpesifikasiPrinter` varchar(50) NOT NULL,
  `HargaPrinter` int(50) NOT NULL,
  `UserIdUser` int(10) DEFAULT NULL,
  `image` varchar(150) NOT NULL,
  `stok` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printer_tb`
--

INSERT INTO `printer_tb` (`IdPrinter`, `NamaPrinter`, `SpesifikasiPrinter`, `HargaPrinter`, `UserIdUser`, `image`, `stok`) VALUES
(1, 'RAM VGEN', 'DDR4 8GB', 200000, NULL, 'ram.svg', 21),
(2, 'RAM KINGSTONE', 'DDR4 8GB', 400000, NULL, 'ram.svg', 24),
(4, 'RAM SANDISK', 'DDR4 4GB', 120000, NULL, 'ram.svg', 60),
(5, 'RAM HYNIX', 'DDR4 12GB', 390000, NULL, 'ram.svg', 20),
(25, 'Printer Epson', 'Hard Graphics Color', 400000, NULL, 'preview.png', 15),
(26, 'Printer Canon 2020', 'Support Scan', 200000, NULL, 'preview.png', 12),
(27, 'Printer Epson 2019', 'Support Foto Copy', 400000, NULL, 'preview.png', 53),
(28, 'Printer Brother 2022', 'Support Scan + Fotocopy', 2000000, NULL, 'preview.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` int(11) NOT NULL,
  `Jumlah` int(10) NOT NULL,
  `UserIdUser` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL,
  `Printer_tbIdPrinter` int(10) NOT NULL,
  `UserIdUser2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IdTransaksi`, `Jumlah`, `UserIdUser`, `status`, `Printer_tbIdPrinter`, `UserIdUser2`) VALUES
(18, 1440000, 1, 2, 4, 1),
(19, 400000, 1, 1, 2, 1),
(20, 2400000, 1, 1, 1, 1),
(23, 800000, 1, 1, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `IdUser` int(11) NOT NULL,
  `Username` varchar(155) NOT NULL,
  `Password` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IdUser`, `Username`, `Password`) VALUES
(1, 'dewa', 'dewa12345'),
(2, 'admin', 'admin12345'),
(3, 'user', 'user'),
(4, 'userdua', 'dewa12345'),
(5, 'usertiga', 'dewa12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `printer_tb`
--
ALTER TABLE `printer_tb`
  ADD PRIMARY KEY (`IdPrinter`),
  ADD KEY `UserIdUser` (`UserIdUser`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IdTransaksi`),
  ADD KEY `Printer_tbIdPrinter` (`Printer_tbIdPrinter`),
  ADD KEY `UserIdUser2` (`UserIdUser2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `printer_tb`
--
ALTER TABLE `printer_tb`
  MODIFY `IdPrinter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `IdTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `printer_tb`
--
ALTER TABLE `printer_tb`
  ADD CONSTRAINT `printer_tb_ibfk_1` FOREIGN KEY (`UserIdUser`) REFERENCES `user` (`IdUser`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Printer_tbIdPrinter`) REFERENCES `printer_tb` (`IdPrinter`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`UserIdUser2`) REFERENCES `user` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
