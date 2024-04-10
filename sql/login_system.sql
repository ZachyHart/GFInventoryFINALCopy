-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 12:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerfeedbacks`
--

CREATE TABLE `customerfeedbacks` (
  `FeedbackID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FeedbackTitle` varchar(50) NOT NULL,
  `FeedbackContent` varchar(500) NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerfeedbacks`
--

INSERT INTO `customerfeedbacks` (`FeedbackID`, `Email`, `FeedbackTitle`, `FeedbackContent`, `reply`) VALUES
(1, 'johanmariocampo@gmail.com', 'Iron Man Funko', 'Are there any more Iron Man funko pops in your inventory?', 'We we will restock next week :)'),
(2, 'carlos@gmail.com', 'test', 'test', ''),
(3, 'test@gmail.com', 'App Bug', 'There was a bug on login button can you fix that', 'Yes! We are currently fixing that on the moment.'),
(4, 'test@gmail.com', 'App Bug 2', 'Bug again', 'We will fix it :)'),
(9, 'paganahinutak@gmail.com', 'test feedback', 'testinggg', 'tested by K0D1G0');

-- --------------------------------------------------------

--
-- Table structure for table `customerpwdreset`
--

CREATE TABLE `customerpwdreset` (
  `cpwdResetId` int(11) NOT NULL,
  `cpwdResetEmail` text NOT NULL,
  `cpwdResetSelector` text NOT NULL,
  `cpwdResetToken` text NOT NULL,
  `cpwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerpwdreset`
--

INSERT INTO `customerpwdreset` (`cpwdResetId`, `cpwdResetEmail`, `cpwdResetSelector`, `cpwdResetToken`, `cpwdResetExpires`) VALUES
(8, 'westleywang30@gmail.com', '23f3ebf5eadb3200', '$2y$10$KKl3xPDiZp80v0R0nXN6c.MfXo..xNtxI0Se1ysCR/ectvcKn99gC', '1708671163');

-- --------------------------------------------------------

--
-- Table structure for table `customerusers`
--

CREATE TABLE `customerusers` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `confirmToken` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerusers`
--

INSERT INTO `customerusers` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `confirmToken`) VALUES
(1, 'AWEI', 'shopandshop2019@gmail.com', 'Awei', '$2y$10$Y2sCLQeCTotDx/cYg37NOu6xK0z5XqKsFxsAPH1.GhwtE5Bfjpssi', '0'),
(2, 'sda', 'wanddddgwestley@gmail.com', 'asda', '$2y$10$DvRhKqC4C9KCrPohnk1tz.i9.T5iNdyk7OVGn0zUSxc3E8B5XKD/W', '0'),
(3, 'wqe', 'qqwangwestley@gmail.com', 'qwe', '$2y$10$RHm8Qejy.nAYsGH606OL8uhBqy9O2zG5OSitZLBm4S.FBPEozEoZq', '0'),
(4, 'qwe', 'shopandshop2019@gmail.com', 'qwe', '$2y$10$Y2sCLQeCTotDx/cYg37NOu6xK0z5XqKsFxsAPH1.GhwtE5Bfjpssi', '0'),
(5, 'sdaa', 'rqfashionsddsad2018@gmail.com', 'sdad', '$2y$10$MpywNsr8x/sBbTKu5zTTh.8hzVz1neXA/smV6UAu2jT03kPxQydZy', '0'),
(6, 'aaa', 'wangwestley@gmail.com', 'aaa', '$2y$10$UJAttKZflRCcduvXA9yBg.I9MhmPU3JhymS0GslmYEyLntMCU8Au.', '0'),
(7, 'abc', 'westleywang30@gmail.com', 'abc', '$2y$10$RqHtq3bCsC9l/e5Btm1eSOlbVqoHJDaaiaxSECOAAvJ2dO0ffvB5a', '0'),
(8, 'test', 'test@gmail.com', 'test', '$2y$10$13anSoOixsU4JZ3HSaVOXO7Go2mCrxqFGJAwnUSZ3hlUD96sAFee6', '0'),
(11, 'customerako', 'paganahinutak@gmail.com', 'customerako', '$2y$10$5RyveMyR.Cas18.DWMX0aOrCcl8mxzsHoSHQ0DZTfyR42KreJdAOG', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`product_id`, `product_image`, `product_category`, `product_name`, `price`, `stock`) VALUES
(1, 'mango.jpg', 'Fruits', 'Mangos', 51, 100),
(14, 'IMG20240227133144.jpg', 'Document', 'Records', 100000000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` text NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(11, 'westleyrichard.wang.cics@ust.edu.ph', '38f18b7058f4029c', '$2y$10$lYCJjShPfAzddGgFNzn9duw8h9aXzaMZC1gFK54VxSQC/AYjhBs.G', '1708424287'),
(12, 'westleywang30@gmail.com', '00514fe098902a4b', '$2y$10$.mZpMuGRMjxOKdZgFepmI.0RHGXNZ4uk8tdlRbCEpkVusCPtUPQNK', '1708424300'),
(13, 'sfadf@qq.com', '065f67f393c1939a', '$2y$10$ZaXGjEM4yxZSxlhoX8gYoeNAXAyN7RqjHlTHjYnxpGfB1Kam03fve', '1708424436'),
(15, 'fosfjo@gmail.com', 'abdf06ca1f7e04d7', '$2y$10$g2IMeYqF10QXKSxrOnT4fuutN4EAw78AyBejLgIQUMzXWfHnZJksi', '1708425843'),
(30, 'rq', 'f250f52061942cbc', '$2y$10$HC9QsCK17pbmGUlO3D9cr.CcTT7WBXDvnNSIC/ZM4mxYnxE/W0W5a', '1708612429'),
(41, 'rqfashion2018@gmail.com', '617a836853ef29a1', '$2y$10$i1vvWUzIFZ.LLW1mLz9eQexdtypXRpTal5PlQXBPoCO3AlwsvaYvi', '1708670573'),
(42, 'test@gmail.com', '39ece5e72da2960f', '$2y$10$zi5W9IuGbnvBEQ.4rRpyO.w6S97i690UPmHr6H4NwL0aonlT6qtpu', '1709690707');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `confirmToken` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `confirmToken`) VALUES
(7, 'da', 'ssfadf@qq.com', 'dsada', '$2y$10$3g1d.tC3MVE9JkJ1JxYELe6Ncqe2S0gEkxxew9IXEBZj3OatIa8yK', 'confirmed'),
(8, 'DDsd', 'wasssngwestley@gmail.com', 'victorsds', '$2y$10$1gLFOqC2vJKyuup0QW8RJOEt49HnDLtOCnBpnHLViCAw0vuizXKLy', 'confirmed'),
(9, 'qqq', 'rqfashion2018@gmail.com', 'aaa', '$2y$10$.NKw3X8D/LE3cG7slfemdOK.xi3t9PGzdcUIvEUjNIuFd.V039UR.', 'confirmed'),
(10, 'test', 'test@gmail.com', 'test', '$2y$10$W0LPyOtNIcFZlnHvydk3WO654VJJrF9dtfgSskVYm6VkhwvT.tv2q', 'confirmed'),
(15, 'jawen', 'paganahinutak@gmail.com', 'jawen123', '$2y$10$JSfBbynu4O8CGGtMOQxjlOFTrRgeBb55fZDHjVCvjYC1SgP/JFwBy', 'confirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerfeedbacks`
--
ALTER TABLE `customerfeedbacks`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `customerpwdreset`
--
ALTER TABLE `customerpwdreset`
  ADD PRIMARY KEY (`cpwdResetId`);

--
-- Indexes for table `customerusers`
--
ALTER TABLE `customerusers`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerfeedbacks`
--
ALTER TABLE `customerfeedbacks`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customerpwdreset`
--
ALTER TABLE `customerpwdreset`
  MODIFY `cpwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customerusers`
--
ALTER TABLE `customerusers`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
