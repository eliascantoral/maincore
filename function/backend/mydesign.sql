-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2015 at 05:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydesign`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `action` int(15) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

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

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `company` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `mail` (`mail`),
  KEY `creater` (`creater`),
  KEY `company` (`company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `fname`, `lname`, `createtime`, `mail`, `tel`, `lasttime`, `gmid`, `rol`, `status`, `creater`, `company`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Web', 0, '', '', 0, '', 0, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
