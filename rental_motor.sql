-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 06:49 PM
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
-- Database: `rental_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'Must A Nice', 'Jalan Kenangan', '34925782'),
(2, 'Ganjar an Pahala', 'Jawa Jawa Jawa', '39732856290'),
(3, 'sumanto', 'Freddy Fazbear 123', '037253283'),
(4, 'Tung Tung Tung Sahur', 'Yos Sudarsono', '5822-8526');

-- --------------------------------------------------------

--
-- Table structure for table `motors`
--

CREATE TABLE `motors` (
  `id` int(11) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `status` enum('tersedia','dipinjam') DEFAULT 'tersedia',
  `tipe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`id`, `merk`, `plat_nomor`, `status`, `tipe`) VALUES
(1, 'Honda Vario', 'B 390 LU', 'tersedia', 'Matic'),
(2, 'Yamaha NMAX', 'R 01', 'dipinjam', 'Matic'),
(3, 'Suzuki Burgman', 'D 4378 BRO', 'tersedia', 'Matic'),
(4, 'Kawasaki KLX', 'A 850 LUT', 'dipinjam', 'Kopling'),
(5, 'Ducati Panigale', 'F 457 GAS', 'dipinjam', 'Sport'),
(6, 'Ducati Panigale', 'F 457 GAS', '', 'Sport'),
(7, 'BMW S1000RR', 'G 4 COR', 'dipinjam', 'Sport'),
(8, 'Aprilia SRV850', 'G 4T4 UAH', 'dipinjam', 'Matic'),
(9, 'KTM RC8R', 'G 444 SSS', 'dipinjam', 'Sport'),
(11, 'Honda Beat ESAF Keropos', 'P 3 LAN', 'tersedia', 'Matic'),
(12, 'Honda Vario 150 Gredeg', 'B 4 GUS', 'dipinjam', 'Matic');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `motor_id` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `member_id`, `motor_id`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(1, 2, 1, '2025-04-09', '2025-04-11'),
(2, 1, 2, '2025-04-17', '2025-04-25'),
(3, 3, 4, '2025-04-20', NULL),
(5, 2, 9, '2025-04-20', '2030-06-14'),
(6, 3, 2, '2025-04-20', '0000-00-00'),
(8, 3, 12, '2025-04-20', NULL),
(9, 3, 7, '2025-04-20', NULL),
(10, 2, 8, '2025-04-20', '5622-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motors`
--
ALTER TABLE `motors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `motor_id` (`motor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `motors`
--
ALTER TABLE `motors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`motor_id`) REFERENCES `motors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
