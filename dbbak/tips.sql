-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-26 08:36:09
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
-- 表的结构 `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `key` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '键名',
  `value` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '键值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='临时表' AUTO_INCREMENT=32 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='提醒表' AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `tips`
--

INSERT INTO `tips` (`id`, `content`, `date`, `author`) VALUES
(1, 'Hello World!', '2016-07-21 04:23:37', 'admin'),
(2, 'Hello Tips!', '2016-07-21 09:08:33', 'admin'),
(10, '现在应该可以使用中文了！', '2016-07-21 12:12:00', 'admin'),
(11, '一次次的重构，相信会做的更好！', '2016-07-23 12:00:00', 'admin'),
(12, '我为爱放弃终生哭泣', '2016-07-22 12:12:00', 'admin'),
(13, '按理说执行成功之后，模态框会隐藏，并刷新页面，显示最新的数据的', '2016-07-27 12:12:00', 'admin'),
(14, '不知道是不是 把return写成了echo', '2016-07-22 12:12:00', 'admin'),
(15, '遇到这种没有报错的真是麻烦', '2016-07-22 12:12:00', 'admin'),
(16, '报错的时候应该感到开心', '2016-07-22 23:24:00', 'admin'),
(17, '我的爱如潮水，爱如潮水将我保卫', '2016-07-22 12:12:00', 'admin'),
(18, '我的爱如潮水，爱如潮水将我保卫', '2016-07-22 12:12:00', 'admin'),
(19, '反正是本地测试，我写什么都可以', '2016-07-22 12:12:00', 'admin'),
(20, '爱如潮水', '2016-07-22 12:12:00', 'admin'),
(21, '我讨厌装逼', '2016-07-22 12:12:00', 'admin'),
(22, '我讨厌装逼的领导', '2016-07-22 12:12:00', 'admin'),
(23, '技术在手，吃穿不愁', '2016-07-22 12:12:00', 'admin'),
(24, '我大概知道是什么原因了，改进了代码应该是可以了', '2016-07-22 12:12:00', 'admin'),
(25, '提醒我干嘛', '2016-07-22 12:12:00', 'admin'),
(26, '天假一条提醒', '2016-07-29 12:12:00', 'admin'),
(27, '我希望有一天能处在一个有着良好氛围的技术团队', '2016-07-26 12:12:00', 'xiao');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编码',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱地址',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role_id`) VALUES
(12, 'xiao', '845d5f1153c27beed29f479640445148', 'xiaotingyizhan@163.com', 0),
(14, 'admin', 'ee10c315eba2c75b403ea99136f5b48d', 'prprpro@163.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
