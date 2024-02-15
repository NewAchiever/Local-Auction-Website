-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2019 at 08:05 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `seller` text NOT NULL,
  `buyer` text NOT NULL,
  `name` text NOT NULL,
  `chat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `random-string`
--

CREATE TABLE `random-string` (
  `id` int(11) NOT NULL,
  `random` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `random-string`
--

INSERT INTO `random-string` (`id`, `random`) VALUES
(1, '5Io2S8sIvrqStN6mch1N'),
(2, 'G3falFOIyfPxJPvajYmk'),
(3, 'IttBdAJEDhXcc0GBSN9X'),
(4, '68NITBpuRmPZdPnLSAlF'),
(5, 'uUkhwI4fhwdbDsz7yaJ3'),
(6, 'XzjyzgSN7ez1tNGOLDyK'),
(7, 'ZNjwMKX33xivsbQxJNbM'),
(8, 'XLfn0ZAcrsuyyIS5vSog'),
(9, 'EJfkK2WFK8sHJvMgUKxe'),
(10, 'pSlnc5jhWbtROUerZDvJ'),
(11, 'S5cTuZl6PDVqGMODZBIh'),
(12, 'CdF48JoAsMM16SytNn8z'),
(13, '1IAH8keCjy9PY6wAfZwA'),
(14, 'x5SWP1qamJL6H00VfXwu'),
(15, 'vAb3eCZtaQPLfx4iTlzM'),
(16, 'l8kFRSbmYpPD7dpHmQKb'),
(17, 'dnBQ0VwoDBG0Nxr0h5rd'),
(18, '4ZvV7X6HGL3YRMpu7nZz'),
(19, 'bbfOM44etRx1sE3SVJQy'),
(20, 'qtBmzVj1MuEmnI5POHpy'),
(21, 'ijdsYdwLv6r3r9GNLTrn'),
(22, '8BTUoftwqCc6QnGC3u56'),
(23, 'ytguTvQPZWg0es5oqaMv'),
(24, 'qyyKSctXd8mZ5jp6cdPE'),
(25, '4qSLsot1tGyyn4cT5XGh'),
(26, 'FiII90elQbHZ3nap5L4W'),
(27, '1yXRq132x4VL5cXlZUhh'),
(28, 'R7xpOlcw0OeOgohsLQrL'),
(29, 'X1sFQLvLUiBMe1ukqOLh'),
(30, 'loZ3CUEC9h8DLP4Qco9X'),
(31, '5298bj3Bjg3V0wT6XLtu'),
(32, 'QnPsKTtidM3GQXvQTmyO'),
(33, 'mCWmEtrxMUY1CpoUhMKr'),
(34, 'E2FNjziFSC5K3AutJNdz'),
(35, 'CEjlDIlbypyNOV6wuuQ2'),
(36, 'UpUZnZAfaRHzzhP4CMJ7'),
(37, 'Eli5a9TyYzDLpp1dlc6q'),
(38, 'cLDMopr9bMXSSeT76IXl'),
(39, 'uzeYmrh026UMonZJLSAP'),
(40, 'ZVXaBC0OhGYXWJMakNTz'),
(41, 'MleBeeybX4bJgYgwmNXL'),
(42, 'N0m8IQbY8wYUSnfhqUS8'),
(43, 'uS13WVT5Ii0yoKjlWGwt'),
(44, '5DJfGetzXFkfLufAqwrf'),
(45, 'I8aqSvlJzIzKEA1OURJX'),
(46, 'ExQ0uSwPstWVoyZlTgN8'),
(47, 'pLut7ioFI78ZK3kL13dG'),
(48, 'pCXtC8xyR7QFYZEav8i6'),
(49, 'fasPRfRSDjRZwd7IwGfi'),
(50, 'iln94aDQD4WA1OHUR5cV'),
(51, 'sMMAqa5mrPxCYdakkwon'),
(52, 'ELhs7oKJmwTY2yAUK3Uo'),
(53, 'goxka9DTQ5v5vXi3rqJa'),
(54, 'uQHW1xUQaZPs1lKUaW1U'),
(55, 'utwOnzYKEZblPiw46nLx'),
(56, 'CEjtqMiOiTZQl0Mj1xQ1'),
(57, 'J5m3UMHrp2frjeP7Z6Mh'),
(58, 'dquF2bBV9wDEQmRAqmUb'),
(59, 'Flbbtdq7LVxoG9LXUMIn'),
(60, 'Be6wtLsXu5JzErR4sZJ9'),
(61, 'tTZ9HMlviMTE22OOjnJN'),
(62, 'SIa7icxAenU9GIVFBMOQ'),
(63, 'wL9hxmAG1csjdZHls1fC'),
(64, 'CukvXsEdb5j0yn3GJhfn'),
(65, '1NK7GWJldjTA3dOJgYGR'),
(66, 'Gylrpfv9uiCDupr9lB2s'),
(67, '7LqPsQAa1oW8HYV51QQr'),
(68, 'arYIu2f2592PlDGA5Tx8'),
(69, '76ohGuLNhiUFelyLJ2hR'),
(70, 'aAToreF4cytcHlZGRWvv'),
(71, 'YB3ZvJ73cUPlJ94RLqS9'),
(72, 'RIBO7mfUrHz7AUlsFEiP'),
(73, 'OUtsKz0IYg57rIRP64CC'),
(74, 'cB57VmqoyBm1TdkAB1A7'),
(75, 'tWa6HPY9EdQExcQdFEpR'),
(76, 'DJOxJ9Nl1LSiJYyM8JD5'),
(77, 'beKzfay9IBnwtZ0WKoub'),
(78, 'VSZYKIZLW3lwfwk5CnsX'),
(79, 'WLn7lH4Gmy6qUrWmf0x3'),
(80, 'qaXWmouNDAyVGiMMzY1U'),
(81, 'dO0TTEesHY9TDQkdvTVA'),
(82, 'Xs9WSd4lEwKmwVDFTLRy'),
(83, 'DJJMttikul3cyROwdI3G'),
(84, 'PiREsetaNa7LEg73DgXc'),
(85, '7GhxeDKNF4BQYkS681Ko'),
(86, '6A1p6usjfzKyC9AI4WjG'),
(87, 'xL0JbXikKQNsRARxJPZL'),
(88, '1uXjoDmuW9kGNf462KeQ'),
(89, '8iYwQrNG28HU8yKJAFTH'),
(90, 'RgEVXchBYzRw9q5cnaZI'),
(91, 'XPcAqQYsu6fS8jGSmYhz'),
(92, 'jT9PlRy3M0L6uOxzCZgb'),
(93, 'AdSx5loKAiKqPwysmoWj'),
(94, 'HoqRio3hyma1LkQTQmjm'),
(95, '6ZYOEZHcti9XYTNAiQOc'),
(96, 'NtmoC44zGU2bfPV6V7JE'),
(97, 'kmbrnw5rotHqdWMeEydt'),
(98, 'y5l4yTlbgDQH3OCjsf2Q'),
(99, 'bDP54E1jO2wpDdR1Ca2g'),
(100, 'TwVkm6qsWCXQM1DagHXk'),
(101, 'FJnkDFIo15MYEQKOqhJ7'),
(102, 'uKK5Xs0t3PyJXpIK6wth'),
(103, 'vZgHd7WtL4t9mYg3SWZZ'),
(104, 'kg8jrcQXqFBi75GAdO6W'),
(105, 'Mv05HZPfPvxOJ10Un0Wo'),
(106, 'qxNsvUJH3ELwETYFO6Ql'),
(107, 'xdfzlpHGo2g3NXS3KGZC'),
(108, 'cqccbNHbx34AA83h67VK'),
(109, 'scT9IFm8DnBou02mBkZK'),
(110, 'aSJj1OKw2CuW2qdKkDK7'),
(111, 'IUhzs7qjrINCOlJjvhMr'),
(112, 'QrTpCaAPsN4uZeHVSS1x'),
(113, 'h5x0giYTCO8JhAxUFT5Y'),
(114, 'gtCzAShcTKB79xjyKvcN'),
(115, 'vgHH0kH6P7uvmufCbn1x'),
(116, '3wFj8YJA2ifKf82vUsvO'),
(117, 'JGsUp05aiQIk7S5dycSs'),
(118, 'Ok9I6JF3diIixVKTNULv'),
(119, '5fe5HZ90lh1vbxzKpNa6'),
(120, 's5WkISU4chdBvbej7fK6'),
(121, 'fKUJmcTUmqo8EAjApW7C'),
(122, 'zwNxzOzX8EtS9LwYFKk7'),
(123, 'hiY633yJrVNoNtfAoNCS'),
(124, 'cqB8rOoK4vgsYRtcPfzp'),
(125, 'IzgLeUdT9MDZ4LJmm5G7'),
(126, 'bdltNqVYwv1jGNptFGCc'),
(127, 'hlYJwwOkA2jiQTRhlkhD'),
(128, 'B5cbCq06vd3cbCK6Xvbl'),
(129, 'W8QenhoflSRzrBsz9sz3'),
(130, 'XGKF40RplbomX73ahL7a'),
(131, 'ZR0IMVUprmrf2fjJcJjz'),
(132, 'ZBHhH9pi78yHEZ7f9Gsa'),
(133, '6UTFfCahEnewv0IEIODg'),
(134, '0CbRXCAvGIFQVcgeWgwD'),
(135, 'KG3wrGD8FYQUMTcBAHHi'),
(136, '7sv39raaeednsVS4grYN'),
(137, '92rQcpBNFf64mM4cDj17'),
(138, 'JMgXJeUMmzZ8DwzUdBS7'),
(139, 'p3UG75ET5qpmE4jeyTbh'),
(140, 'HqemD58TRUuIl1h6iQZt'),
(141, 'gVf71vpIxWGELhynNWoV'),
(142, '4Syp3vYsJ1NKUdIHOxeH'),
(143, '6gtlb3uf3b97YzBgkHwq'),
(144, 'IOy9l13Nb6lbkYEpAulH'),
(145, 'roklqaebU16i8oxbSiTj'),
(146, 'sKsA29k8RdOYk6XfSySO'),
(147, 'OsYYLZNKaU4QkAghw3sw'),
(148, 'cA0v5LaSGrI4RqnWzEoj'),
(149, 'xSb42MGsJ3KejVow4n5E'),
(150, 'LWJwXsLkOcF4qEniRqiR');

-- --------------------------------------------------------

--
-- Table structure for table `temp-data`
--

CREATE TABLE `temp-data` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `en-email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `user` text NOT NULL,
  `catagory` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `price` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(14, 'nsp48981@gmail.com', '5a69c18a4cbc28c68830e30348b53b40'),
(15, 'nilkumarpatel48@gmail.com', 'ed5f8614c6e6e7342f60fbb6ded29549');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `random-string`
--
ALTER TABLE `random-string`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp-data`
--
ALTER TABLE `temp-data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `random-string`
--
ALTER TABLE `random-string`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `temp-data`
--
ALTER TABLE `temp-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
