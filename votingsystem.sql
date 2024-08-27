-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 09:32 AM
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
-- Database: `votingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `fullname`, `email`, `password`, `profile_image`) VALUES
(1, 'perril', 'Perris Njoki', 'perry@gmail.com', '$2y$10$iVwMO35HMhyU2QqKN1b9dOlFxo9c68QDF7r1ZCirMGptBwN5k8pTa', 'uploads/254714460274_status_bc72bac13e184368b1d21ab9f6a44de6.jpg'),
(2, 'Joe', 'kim', 'josephmwenda980@gmail.com', '$2y$10$nHbk40mm8.U3VbAexRR87O.NuVzv1QRp5qqRIxaNrIBugZ6sjCgIe', 'uploads/254702245799_status_f5bc1f86c8f246be93f236a0463bea7a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(255) NOT NULL,
  `candidate_no` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_no`, `regno`, `fullname`, `username`, `email`, `faculty`, `profile_image`) VALUES
(1, 'fst001', 'eb1/45675/20', 'esther wanjira', 'BlueLady', 'essicira@gmail.com', 'FST', 'uploads/254702245799_status_f5bc1f86c8f246be93f236a0463bea7a.jpg'),
(9, 'fst003', 'AB7/45638/20', 'Jonnes Maina', 'jojo', 'joan@gmail.com', 'FST', 'uploads/254719823953_status_92d471a85a6646198ffc4afedc6140d0.jpg'),
(10, 'fst004', 'AB5/98789/21', 'Everlyne Mwangi', 'Eva', 'Everlyne@gmail.com', 'FST', 'uploads/flower2.jpg'),
(11, 'aged001', 'DB1/23456/21', 'Victoria Nyakio', 'Vickie', 'Victoria@gmail.com', 'AGED', 'uploads/Hillary 20210719_163607.jpg'),
(12, 'aged002', 'DB2/12343/21', 'Jackline Muthoni', 'Jackie', 'jackie@gmail.com', 'AGED', 'uploads/2c53b07a04ef483989f6e04c451c3783.jpg'),
(13, 'aged003', 'DB2456783/21', 'Shadrac Kibet', 'Letting', 'letting@gmail.com', 'AGED', 'uploads/254758313591_status_1faa76df25b64ce4828e45cf30a2e93b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(255) NOT NULL,
  `electionname` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `electionname`, `startdate`, `enddate`, `position`) VALUES
(1, 'Faculty of Science,Engineering and Technoloy', '2024-02-26', '2024-02-26', 'FST'),
(2, 'Bachelor of Commerce', '2024-02-29', '2024-02-29', 'BCOM');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` int(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `voted_candidate_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `regno`, `fullname`, `username`, `faculty`, `email`, `password`, `profile_image`, `voted_candidate_no`) VALUES
(1, 'Eb3/12345/20', 'Joseph karanja', 'Joe', 'FST', 'joseph@gmail.com', 567890, 'uploads/254719823953_status_92d471a85a6646198ffc4afedc6140d0.jpg', ''),
(2, 'AB5/98789/21', 'Victoria Nyakio', 'Vickie', 'FST', 'Victoria@gmail.com', 12345678, 'uploads/254714460274_status_bc72bac13e184368b1d21ab9f6a44de6.jpg', ''),
(3, 'AB7/45638/20', 'Jonnes Maina', 'Jojo', 'AGED', 'joan@gmail.com', 456789, 'uploads/254715559834_status_75fbc0c17a744248827718f3994ec281.jpg', ''),
(4, 'EDSC1/69135/23', 'Joseph Kimathi', 'Joe', 'AGED', 'josephmwenda980@gmail.com', 42779263, 'uploads/254702245799_status_6e79af062f01480d85f11b88d58860ca.jpg', ''),
(5, 'DB2/456378/21', 'Sarah Muthoni', 'SitiSarah', 'AGED', 'sarah@gmail.com', 987612, 'uploads/best-love-wallpaper-download (1).jpg', ''),
(6, 'EB348988/20', 'Eunice Njoki', 'Njoki', 'FST', 'eunice@gmail.com', 36126885, 'uploads/254704044128_status_c04ed532d79f422184918db2990f5219.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `candidate_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `regno`, `candidate_no`) VALUES
(1, 'DB2/456378/21', 'aged001'),
(2, 'EDSC1/69135/23', 'aged001'),
(3, 'AB5/98789/21', 'fst004'),
(4, 'Eb3/12345/20', 'fst004'),
(5, 'EB348988/20', 'fst004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`,`candidate_no`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `regno` (`regno`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`,`regno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
