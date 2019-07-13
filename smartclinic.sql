-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 05:20 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `pNum` varchar(10) NOT NULL,
  `app_message` varchar(10000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `app_time` time(3) NOT NULL,
  `app_date` date NOT NULL,
  `department` varchar(100) NOT NULL,
  `client_id` int(255) NOT NULL,
  `app_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`fname`, `lname`, `pNum`, `app_message`, `email`, `app_time`, `app_date`, `department`, `client_id`, `app_id`) VALUES
('Joshua', 'Lartey', '0249643365', 'My Wife is Pregnant. Doctor Can you pls check Her for me doc', 'larteyjoshua@gmail.com', '00:00:00.000', '2019-04-15', 'General', 3, 32),
('Joshua', 'Lartey', '0249643365', 'I am sick of this people', 'larteyjoshua@gmail.com', '14:00:00.000', '2019-04-10', 'Gyaenacology', 3, 35),
('Daniel', 'bempih', '0269564323', 'i am really feeling pit for some people', 'danielbempih@gmail.com', '18:00:00.000', '2019-05-01', 'Physio', 11, 39),
('Kwame ', 'Love', '0249643365', 'my teeth is acheing me badly', 'lovekwame@gmail.com', '12:00:00.000', '2019-04-24', 'Dental', 4, 44),
('Kwame ', 'Love', '0249643365', 'I am not felling well hmmm', 'lovekwame@gmail.com', '10:55:00.000', '2019-04-19', 'Physio', 4, 53),
('Samuel ', 'Ofori', '0249456239', 'i am going to see Doc Gyan', 'samuelofori@gmail.com', '11:59:00.000', '2019-04-17', 'General', 19, 57),
('Samuel ', 'Ofori', '0249456239', 'Normal Check up', 'samuelofori@gmail.com', '16:01:00.000', '2019-04-17', 'General', 19, 58),
('Samuel ', 'Ofori', '0249456239', 'I am not really feeling good', 'samuelofori@gmail.com', '23:00:00.000', '2019-04-14', 'Physio', 19, 59),
('Samuel ', 'Ofori', '0249456239', 'i am having strange symtoms ', 'samuelofori@gmail.com', '13:01:00.000', '2019-04-16', 'Paediatrics', 19, 60),
('Samuel ', 'Ofori', '0249456239', 'my wife is feeling pains in her chest. she is 2 months pregnant ', 'samuelofori@gmail.com', '13:01:00.000', '2019-04-30', 'Gyaenacology', 19, 62),
('Samuel ', 'Ofori', '0249456239', 'I cant hear well when i am in class', 'samuelofori@gmail.com', '17:00:00.000', '2019-05-04', 'Eye or Ear', 19, 63),
('Kwame ', 'Love', '0249643365', 'My eye is tired of seeing nonsense', 'lovekwame@gmail.com', '14:00:00.000', '2019-05-04', 'Eye or Ear', 4, 64),
('issah', 'Ali', '0249523356', 'I am having Pains in my tooth  ', 'issahali@gmail.com', '13:00:00.000', '2019-05-04', 'Dental', 15, 65),
('issah', 'Ali', '0249523356', 'I am not feeling my self doc', 'issahali@gmail.com', '15:02:00.000', '2019-05-04', 'General', 15, 66),
('Mensah', 'kwame', '0234677875', 'my wife is pregnant', 'mensahkwame@gmail.com', '13:01:00.000', '2019-05-04', 'General', 23, 67);

-- --------------------------------------------------------

--
-- Table structure for table `doctorsusers`
--

CREATE TABLE `doctorsusers` (
  `fullName` varchar(100) NOT NULL,
  `LicenceNumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pNum` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorsusers`
--

INSERT INTO `doctorsusers` (`fullName`, `LicenceNumber`, `email`, `password`, `pNum`, `id`) VALUES
('Dr. kojo Ansah', 'Gr1234567', 'kojoansah@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249678954', 1),
('kojo Asare', 'Gw23456789', 'kojoasare@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249642266', 2),
('Dr. Owusu Mensah', 'Hr2456789', 'owusumensah@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0248665511', 3),
('Dr. Kwame Asare', 'KR005566778', 'kojoasare@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0204456789', 4),
('Dr. Kwame Asare', 'Gr1234567', 'kojoasare2@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0275224567', 5),
('Dr. Michael Kobby', 'GK024953345', 'michaelkobby@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0268943356', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pNum` varchar(10) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `pNum`, `id`) VALUES
('Samuel', 'Ofori', 'oforisml@gmail.com', '644fff4a2f08d80953235a3e54124b53', '0506951440', 1),
('Amos', 'Aidoo', 'aidoo@gmail.com', '644fff4a2f08d80953235a3e54124b53', '0544445444', 2),
('Kwame ', 'Love', 'lovekwame@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249643365', 4),
('Erica', 'Mensah', 'mensah@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0243778822', 5),
('Kofi', 'Bentil', 'kofibentil@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0233445577', 6),
('Richmond', 'Bentil', 'richmondbentil@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0524445566', 7),
('Sobolo ', 'Mike', 'sobolomike@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249643365', 8),
('Melody', 'owusu', 'melodyowusu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0262002244', 9),
('Favour', 'Eli', 'favoureli@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0567883321', 10),
('Daniel', 'bempih', 'danielbempih@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0269564323', 11),
('Hans', 'K', 'hans@yahoo.com', '202cb962ac59075b964b07152d234b70', '024768903', 12),
('Erica ', 'Dartey', 'derica@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249643365', 13),
('issah', 'Ali', 'issahali@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249523356', 15),
('Hans', 'Kk Kwame', 'kwame@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0245678944', 17),
('Kojo', 'Emma', 'kojoemma@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0248743344', 18),
('Samuel ', 'Ofori', 'samuelofori@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249456239', 19),
('Lartey', 'Joshua', 'larteyjoshua@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249643365', 20),
('Joshua', 'Lartey', 'larteyjoshua@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0243546789', 21),
('mensah', 'Kojo', 'mensahkojo@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0249665533', 22),
('Mensah', 'kwame', 'mensahkwame@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0234677875', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `doctorsusers`
--
ALTER TABLE `doctorsusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `doctorsusers`
--
ALTER TABLE `doctorsusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
