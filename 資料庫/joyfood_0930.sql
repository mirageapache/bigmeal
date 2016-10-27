-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2016 �?09 ??30 ??11:46
-- 伺服器版本: 5.6.17
-- PHP 版本： 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `joyfood`
--

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` varchar(36) COLLATE utf8_bin NOT NULL,
  `account` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `create_day` date NOT NULL,
  `state` tinyint(4) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `email_confirm` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`ID`, `account`, `password`, `email`, `create_day`, `state`, `user_type`, `email_confirm`) VALUES
('10327f3f75-9adc-a8b8-3b85-b986f2475e', 'test', 'test1234', 'test@test.com', '2016-09-07', 1, 1, 0),
('1c9342524-15d4-e54c-3bfe-56c4fa5f347', 'test6', 'test1234', 'test6@test.com', '2016-09-07', 1, 1, 0),
('35b5331049-fe7b-9aaa-de4b-af110b78f1', 'test11', 'test1234', 'test11@test.com.tw', '2016-09-07', 1, 1, 0),
('4102a53b9c-e883-910ae-e389-6827c1034', 'test123456', 'test123456', 'test123456@email.com', '2016-09-06', 1, 1, 0),
('593cc33ce-c6810-9d210-c154-b56861103', 'test5', 'test1234', 'test5@test.com', '2016-09-07', 1, 1, 0),
('68b104874c-ca61-544b-1096c-107de13f1', 'test13', 'test1234', 'test13@test.com.tw', '2016-09-07', 1, 1, 0),
('6d107775ea-8eb8-de51-75c10-3786418d6', 'test3333', 'test3333', 'test3333@test.com', '2016-09-07', 1, 1, 0),
('7139310b79-eb210-c479-34ba-5cc3c910b', 'test12', 'test1234', 'test12@test.com.tw', '2016-09-07', 1, 1, 0),
('71eafbab2-47e3-1034a-b439-86ba2103ee', 'test15', 'test1234', 'test15@test.com.tw', '2016-09-07', 1, 1, 0),
('8dd4d21e8-13e10-2682-3293-da21f61011', 'mirageapache', 'mirage123456', 'mirageapache@gmail.com', '2016-09-07', 1, 1, 0),
('96ab57321-710f3-95ea-5c610-e932c8c91', 'test10', 'test1234', 'test10@test.com.tw', '2016-09-07', 1, 1, 0),
('97210c6a44-7dd3-e8a2-5324-10852b10ac', 'test9', 'test1234', 'test9@test.com.tw', '2016-09-07', 1, 1, 0),
('9bbe1223c-2b6d-37a4-3fb4-b6cda4837b4', 'test2', 'test1234', 'test@yahoo.com', '2016-09-07', 1, 1, 0),
('a1e54779e-4744-f589-52f8-c4a610a3e7e', 'test1', 'test1234', 'test1@test.com', '2016-09-07', 1, 1, 0),
('ae7dabd43-813c-9666-7847-2aaf67d524b', 'test3', 'test1234', 'test3@test.com', '2016-09-07', 1, 1, 0),
('b109e666d3-1f7b-b941-822d-410a12fb7d', 'test4444', 'test4444', 'test4444@test.com', '2016-09-07', 1, 1, 0),
('b35c872be-5f3a-25610-c3ea-81dd4da361', 'test2222', 'test2222', 'test2222@test.com', '2016-09-07', 1, 1, 0),
('b4cd3ce10a-89c3-7d8a-c182-7657c1fc84', 'test14', 'test1234', 'test14@test.com.tw', '2016-09-07', 1, 1, 0),
('cf9a262cb-bc43-4104d-10d65-2bbea8c4c', 'test4', 'test1234', 'test4@test.com', '2016-09-07', 1, 1, 0),
('fba34cf6f-cc44-917d-8510f-8894c23103', 'test8', 'test1234', 'test8@test.com', '2016-09-07', 1, 1, 0),
('fda10ef5a10-53bc-568f-f7be-b99674cfc', 'test7', 'test1234', 'test7@test.com', '2016-09-07', 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `name` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `cellphone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `user_info`
--

INSERT INTO `user_info` (`name`, `telephone`, `cellphone`, `address`, `email`, `user_id`) VALUES
('柯P', '024444444', '0912345678', '台北市市政區市政路1段1號市長辦公室', 'kpkp@kpkp.gov.tw', 'a1e54779e-4744-f589-52f8-c4a610a3e7e'),
('魯夫', '05-654321', '0912345678', '新北市新北區新北路1號', 'loufea@gmail.com', '9bbe1223c-2b6d-37a4-3fb4-b6cda4837b4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
