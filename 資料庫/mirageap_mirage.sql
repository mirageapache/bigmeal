-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- 主機: 192.168.2.200:3306
-- 產生時間： 2016 年 10 月 24 日 10:50
-- 伺服器版本: 5.5.50-MariaDB
-- PHP 版本： 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mirageap_mirage`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order_content`
--

CREATE TABLE `order_content` (
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `amount` smallint(6) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `order_list`
--

CREATE TABLE `order_list` (
  `order_id` varchar(20) NOT NULL,
  `state` tinyint(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deliver_type` tinyint(4) NOT NULL,
  `pay_type` tinyint(4) NOT NULL,
  `order_time` datetime DEFAULT NULL,
  `pay_time` datetime DEFAULT NULL,
  `deliver_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `user_id` varchar(36) NOT NULL,
  `name` varchar(6) NOT NULL,
  `post_code` varchar(5) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(8) NOT NULL,
  `stock` smallint(6) DEFAULT '0',
  `place` varchar(10) NOT NULL,
  `b_type` varchar(10) NOT NULL,
  `s_type` varchar(10) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `description` varchar(300) NOT NULL,
  `standard` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `stock`, `place`, `b_type`, `s_type`, `unit`, `description`, `standard`) VALUES
('1111', '南投市旺來山土鳳梨', '100', 92, '南投', '生鮮', '水果', '台斤', '南投市旺來山土鳳梨', '土鳳梨'),
('1112', '日本富士蘋果', '60', 94, '日本', '生鮮', '水果', '斤', '日本富士蘋果', '蘋果'),
('1113', '台灣愛文芒果', '50', 48, '彰化', '生鮮', '水果', '台斤', '台灣愛文芒果', '芒果'),
('1114', '澳洲奇異果', '60', 47, '澳洲', '生鮮', '水果', '斤', '澳洲奇異果', '奇異果'),
('1115', '台灣大香蕉', '30', 42, '屏東', '生鮮', '水果', '台斤', '台灣大香蕉', '香蕉'),
('1116', '紅蘿蔔', '30', 0, '台灣', '生鮮', '水果', '台斤', '台灣紅蘿蔔', '紅蘿蔔'),
('1117', '台灣蕃薯', '30', 100, '台灣', '生鮮', '蔬菜', '台斤', '台灣蕃薯', '蕃薯'),
('1118', '宜蘭三星蔥', '30', 10, '宜蘭', '生鮮', '蔬菜', '台斤', '宜蘭三星蔥', '三星蔥'),
('1119', '洋蔥', '30', 10, '台灣', '生鮮', '蔬菜', '台斤', '洋蔥', '洋蔥'),
('1120', '馬鈴薯', '30', 4, '台灣', '生鮮', '蔬菜', '台斤', '馬鈴薯', '馬鈴薯');

-- --------------------------------------------------------

--
-- 資料表結構 `product_img`
--

CREATE TABLE `product_img` (
  `img_id` varchar(20) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `img_name` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product_img`
--

INSERT INTO `product_img` (`img_id`, `product_id`, `img_name`, `path`) VALUES
('3333', '1111', '3333', '/data/products/fruit'),
('1112', '1112', '1112', '/data/products/fruit'),
('1113', '1113', '1113', '/data/products/fruit'),
('1114', '1114', '1114', '/data/products/fruit'),
('1115', '1115', '1115', '/data/products/fruit'),
('1116', '1116', '1116', '/data/products/vegetable'),
('1117', '1117', '1117', '/data/products/vegetable'),
('1118', '1118', '1118', '/data/products/vegetable'),
('1119', '1119', '1119', '/data/products/vegetable'),
('1120', '1120', '1120', '/data/products/vegetable');

-- --------------------------------------------------------

--
-- 資料表結構 `temp_order_list`
--

CREATE TABLE `temp_order_list` (
  `order_id` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `order_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `ID` varchar(36) COLLATE utf8_bin NOT NULL,
  `account` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `create_day` date NOT NULL,
  `state` tinyint(4) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `email_confirm` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `user_info` (
  `name` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `cellphone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `post_code` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `user_info`
--

INSERT INTO `user_info` (`name`, `telephone`, `cellphone`, `post_code`, `address`, `email`, `user_id`) VALUES
('柯P', '02-4444444', '0912345678', '001', '台北市市政區市政路1段1號市長辦公室', 'kpkp@kpkp.gov.tw', 'a1e54779e-4744-f589-52f8-c4a610a3e7e'),
('魯夫', '05-654321', '0912345678', NULL, '新北市新北區新北路1號', 'loufea@gmail.com', '9bbe1223c-2b6d-37a4-3fb4-b6cda4837b4');

-- --------------------------------------------------------

--
-- 資料表結構 `user_log`
--

CREATE TABLE `user_log` (
  `time` datetime NOT NULL,
  `ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `os_info` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(36) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `user_log`
--

INSERT INTO `user_log` (`time`, `ip`, `os_info`, `user_id`) VALUES
('2016-10-24 10:07:52', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safa', ''),
('2016-10-24 10:08:13', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safa', '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `order_content`
--
ALTER TABLE `order_content`
  ADD KEY `order_id` (`order_id`);

--
-- 資料表索引 `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`img_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`);

--
-- 資料表索引 `temp_order_list`
--
ALTER TABLE `temp_order_list`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `user_info`
--
ALTER TABLE `user_info`
  ADD KEY `user_id` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
