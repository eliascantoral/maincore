-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2016 at 01:00 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merp`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `action` int(15) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user`, `time`, `action`, `description`) VALUES
(1, 1, 0, 1, 'Prueba de log.'),
(2, 1, 1440873837, 0, 'Usuario admin intenta ingresar al sistema'),
(3, 1, 1440874004, 0, 'Usuario admin intenta ingresar al sistema'),
(4, 1, 1441041152, 0, 'Usuario admin intenta ingresar al sistema'),
(5, 1, 1441052530, 0, 'Usuario admin intenta ingresar al sistema'),
(17, 1, 1441759995, 2, 'El usuario cambio su password'),
(18, 1, 1441760216, 2, 'El usuario cambio su password'),
(19, 1, 1441761091, 2, 'El usuario cambio su password'),
(20, 1, 1441761119, 2, 'El usuario cambio su password'),
(21, 1, 1441761180, 2, 'El usuario cambio su password'),
(23, 1, 1441761210, 2, 'El usuario cambio su password'),
(38, 1, 1441828100, 0, 'Usuario admin intenta ingresar al sistema'),
(39, 0, 1441828100, 0, 'Usuario admin intenta ingresar al sistema'),
(40, 0, 1441828245, 0, 'Usuario admin intenta ingresar al sistema'),
(41, 0, 1441828248, 0, 'Usuario admin intenta ingresar al sistema'),
(42, 0, 1441836480, 0, 'Usuario admin intenta ingresar al sistema'),
(43, 0, 1441837236, 0, 'Usuario admin intenta ingresar al sistema'),
(44, 0, 1441899901, 0, 'Usuario admin intenta ingresar al sistema'),
(45, 0, 1441919048, 0, 'Usuario admin intenta ingresar al sistema'),
(46, 0, 1441982473, 0, 'Usuario admin intenta ingresar al sistema'),
(47, 0, 1441987558, 0, 'Usuario admin intenta ingresar al sistema'),
(48, 0, 1442241563, 0, 'Usuario admin intenta ingresar al sistema'),
(49, 0, 1442294579, 0, 'Usuario admin intenta ingresar al sistema'),
(50, 0, 1442323860, 0, 'Usuario admin intenta ingresar al sistema'),
(51, 0, 1442586139, 0, 'Usuario admin intenta ingresar al sistema'),
(52, 0, 1444081572, 0, 'Usuario admin intenta ingresar al sistema');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `createtime` bigint(20) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `lasttime` bigint(20) NOT NULL,
  `gmid` varchar(200) NOT NULL,
  `rol` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `creater` bigint(11) NOT NULL,
  `company` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `fname`, `lname`, `createtime`, `mail`, `tel`, `lasttime`, `gmid`, `rol`, `status`, `creater`, `company`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Web', 0, '', '', 0, '', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_otheroptions`
--

CREATE TABLE `user_otheroptions` (
  `id` bigint(20) NOT NULL,
  `catalogo` varchar(128) NOT NULL,
  `value` varchar(512) NOT NULL,
  `count` int(11) NOT NULL,
  `createtime` bigint(20) NOT NULL,
  `lastupdate` bigint(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_otheroptions`
--

INSERT INTO `user_otheroptions` (`id`, `catalogo`, `value`, `count`, `createtime`, `lastupdate`, `status`) VALUES
(1, 'fractura', 'Celular', 4, 1468312521, 1468312521, 1),
(2, 'alergia', 'CarbÃ³n', 1, 1468313365, 1468313365, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `creater` (`creater`),
  ADD KEY `company` (`company`);

--
-- Indexes for table `user_otheroptions`
--
ALTER TABLE `user_otheroptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_otheroptions`
--
ALTER TABLE `user_otheroptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
