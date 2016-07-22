-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-21 16:19:24
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tips`
--

-- --------------------------------------------------------

--
-- 表的结构 `tips`
--

CREATE TABLE IF NOT EXISTS `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编码',
  `content` varchar(140) CHARACTER SET utf8 NOT NULL COMMENT '内容',
  `date` datetime NOT NULL COMMENT '发表日期',
  `author` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='提醒表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tips`
--

INSERT INTO `tips` (`id`, `content`, `date`, `author`) VALUES
(1, 'Hello World!', '2016-07-21 04:23:37', 'admin'),
(2, 'Hello Tips!', '2016-07-21 09:08:33', 'admin'),
(10, '现在应该可以使用中文了！', '2016-07-21 12:12:00', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
