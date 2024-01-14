-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 09:13 AM
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
-- Database: `trnsaction(2)`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$G6vl.2UKhRjtoMdC1WqFQu31OlrJpyWV.YBf1uDUaCS.J52tTj.Ai');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `blogID` bigint(255) NOT NULL,
  `userNAME` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `blogID`, `userNAME`, `comment`, `datetime`) VALUES
(23, 29, 'samine', 'hey', '2023-12-13 08:42:10'),
(24, 27, 'jyra', 'good!', '2023-12-13 08:43:36'),
(25, 35, 'new', 'sssss', '2024-01-07 17:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `blogID` bigint(20) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_content` varchar(255) NOT NULL,
  `dateTime_created` datetime NOT NULL,
  `blog_cat` varchar(255) NOT NULL,
  `blog_pic` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`blogID`, `blog_title`, `blog_content`, `dateTime_created`, `blog_cat`, `blog_pic`, `username`, `rating`) VALUES
(27, 'What does Lemon Grass do to your body?', 'Lemongrass offers a range of advantages, including its antioxidant properties, digestive health support, anti-inflammatory effects, potential antibacterial and antifungal capabilities, stress relief qualities through aromatherapy, etc.', '2023-12-13 01:05:28', 'herbs', 'C:\\xampp\\htdocs\\users\\uploads\\download (18).jpg', 'Jessica123', 5),
(28, 'Why is Oregano so Effective?', 'It\'s often used to treat respiratory infections, digestive issues, and even skin conditions. Some studies suggest that oregano oil may have antibacterial properties against certain strains of bacteria, potentially aiding in fighting infections.', '2023-12-13 01:07:48', 'herbs', 'C:\\xampp\\htdocs\\users\\uploads\\Oregano-Leaf-Product-Pic.jpg', 'Jessica123', 4),
(29, 'What can Siling Labuyo do to your body?', 'This compound triggers a burning sensation in the mouth, throat, and can even affect the stomach. While it can induce discomfort for some, for others, eating spicy foods like Siling Labuyo can release endorphins, creating a pleasurable sensation or a \"spi', '2023-12-13 01:53:00', 'vegetables', 'C:\\xampp\\htdocs\\users\\uploads\\images (2).jpg', 'Jyra', 3);

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire_responses`
--

CREATE TABLE `questionnaire_responses` (
  `response_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `question_1` varchar(255) NOT NULL,
  `question_2` varchar(255) NOT NULL,
  `question_3` varchar(255) DEFAULT NULL,
  `question_4` varchar(255) NOT NULL,
  `question_5` varchar(255) DEFAULT NULL,
  `question_6` varchar(255) DEFAULT NULL,
  `question_7` varchar(255) NOT NULL,
  `question_8` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionnaire_responses`
--

INSERT INTO `questionnaire_responses` (`response_id`, `username`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`, `question_7`, `question_8`) VALUES
(15, 'J', 'Health improvement', '25-34', 'Yes', 'Yes', 'hello', 'Intermediate', 'Culinary herbs', 'Yes'),
(16, 'a', 'Medicinal purposes', '18-24', 'Yes', 'Yes', '', 'Beginner', 'Medicinal herbs', 'Yes'),
(17, 'b', 'Medicinal purposes', '18-24', 'Yes', 'Yes', '', 'Beginner', 'Edible flowers', 'Yes'),
(18, 'Jollyy12', 'Medicinal purposes', '18-24', 'Yes', 'Yes', '', 'Advanced', 'Edible flowers', 'Yes'),
(19, 'DNTabalba', 'Medicinal purposes', '18-24', 'No', 'Yes', '', 'Beginner', 'Culinary herbs', 'Yes'),
(20, 'username22', 'Medicinal purposes', '18-24', 'No', 'Yes', 'none', 'Intermediate', 'Edible flowers', 'Yes'),
(21, 'username50', 'Health improvement', '18-24', 'Yes', 'No', 'none', 'Intermediate', 'Edible flowers', 'Yes'),
(22, 'username51', 'Medicinal purposes', '18-24', 'No', 'Yes', 'fsfsf', 'Beginner', 'Medicinal herbs', 'Yes'),
(23, 'itsCutie12', 'Health improvement', '35-44', 'Yes', 'Yes', 'none', 'Beginner', 'Medicinal herbs', 'Yes'),
(24, 'almDessa1', 'Medicinal purposes', '18-24', 'Yes', 'Yes', 'ssssss', 'Beginner', 'Medicinal herbs', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `firstname` varchar(11) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` varchar(1024) NOT NULL,
  `bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `birthday`, `firstname`, `lastname`, `email`, `image`, `gender`, `bio`) VALUES
('a', '$2y$10$gCXtg5X5WJev2ksu9seEQ.2EJL7Gy4l6GouPMBjgCmqSvfA9Yquwq', '2024-01-01', 'a', 'a', 'a@g.com', '', 'male', ''),
('admin', '$2y$10$T5Nm.7JWuUru6p9vQiFkGOr3T8h5ZxoVL1O48EpdzlAnFqRBN/JTy', NULL, 'Admin', 'User', 'admin@example.com', '', 'male', ''),
('admin', '$2y$10$YourActualHashHere', NULL, '', '', '', '', '', ''),
('almDessa1', '$2y$10$HNq2fRIKlYSa1YNyHa2Z7OCQzxL.ZYay97KuCqsDGqKY9Dvk.L8YC', '2001-10-14', 'Saminee', 'Almuete', 'almuete222@gmail.com', '', 'female', ''),
('b', '$2y$10$f0hT8tBn/dWVm0DitmWs5uRmXWjJqpBDtE1ItPRf8KUDl/898uQQK', '2024-01-17', 'b', 'b', 'b@gmail.com', '', 'female', ''),
('bago', '$2y$10$.qptGDmkRXCTeLrv6gCgRuvHBOowYhUv377gV0Hvj.9AuluElm7c6', '2024-01-23', 'bago', 'new', 'bago@gmail.com', '', 'male', ''),
('DNTabalba', '$2y$10$QyqYisSw5eJQ8BkOd61uA.XTTTC5bASgv3lcAu3gJLViy3JJGjRfy', '2002-10-12', 'Dywane Nico', 'Tabalba', 'DywaneTabalba@gmail.com', '', 'male', ''),
('elijahtry123', '$2y$10$bi1xkt/.ISYuxQCh2PPq7u5AvmbuTaJX9lMq./.WadOSZsaz.LMdO', '1992-02-06', 'Fragrance', 'Booyah', 'elijahtry123@gmail.com', '', 'female', ''),
('hasging', '$2y$10$hHqInsRxHfrd1TyDu6KRFOUAtgWCAMHIVcXTacKR2M4bxBp8.V8jm', '2003-02-05', 'Hera', 'Nar', 'hashing@gmail.com', '', 'male', ''),
('hasging123', '$2y$10$woQ0jSP78S7QMCP3l/xcl.dvn0hiGW75t/2879f5OvxFSfjf6OaAG', '2002-10-06', 'Hera2', 'Nar2', 'hashing123@gmail.com', '', 'female', ''),
('itsCutie12', '$2y$10$jWYwgXqrhYW1YUgjZBIe2u6cYVbrZyZTXb0cHqz6M7MNptuy/1jyq', '1984-10-13', 'Mamshiee', 'Dela Cruzz', 'Cutie_22@gmail.com', '', 'female', ''),
('J', '$2y$10$mipSnbiKhmZKXo86z0oKeOxV7Pm2AtFaEZsAuHN5up7kbDD3FGIqe', '2024-01-25', 'J', 'J', 'j@g.com', '', 'male', ''),
('jaja', '$2y$10$W91U0Xv1gt6ciCFhDZNbc.fwkLZahN2ibH5EKazeGRywnBKZk1lUm', NULL, 'ja', 'tabalba', 'a@gmail.com', '', 'female', ''),
('Jessica123', '$2y$10$4tdTL.eGeoOKF9DJkq2Ctu6euCzaLErGh8vhnX.OqEXlKj6wFgJ26', NULL, 'Jessica', 'Llego', 'jllego1@gmail.com', '', 'female', ''),
('Jollyy12', '$2y$10$szzrNXajO.1uKJ.JXonPRukfnCgRRDvDbaqb4SagskPOqe7O6HBnq', '2001-06-12', 'Jollyyyy', 'Behh', 'lestgoss@gmail.com', '', 'male', ''),
('jyra', '$2y$10$ILileKLyM4buGITZfnmNjeKa.7Xg/H5O9BUX5/hHpVX4OS.dtD9b.', NULL, 'jyra', 'jyraaaaa', 'ff@gmail.com', '', 'male', ''),
('Jyra', '$2y$10$WJMGItkQHPEvVB5gcH6zd.ci7J99dwdSHnQOVkpVLaZ8.41mxAsUm', NULL, 'Jyra', 'Villanueva', 'villanuevajyra1@gmail.com', '', 'female', ''),
('new', '$2y$10$nyDm5kYUqDr6MPEaTayYguSkIN2TBLYfL5dFoMo/24BtFgY4Zzz.u', NULL, 'new', 'smith', 'smith@gmail.com', '', 'male', ''),
('neww', '$2y$10$35cAqWp8eMbtoWaXKIBHMOt2rgqacACDFiP8975halL6sIuNIR71e', '2024-01-27', 'new', 'smith', 'smith@gmail.com', '', 'male', ''),
('neww', '$2y$10$QAclKuGAuDzHrgLA5dTjmupeutyXtzsxD9.BqOdg4vWXTHbHEiEXi', '2024-01-27', 'new', 'smith', 'smith@gmail.com', '', 'male', ''),
('samine', '$2y$10$9UiSUiPhVAvxHArDYzN5weSpQ6j/FAMlsQkDHSBfgQjEAIPCnFdWa', NULL, 'samine', 'almuete', 'ffa@gmail.com', '', 'female', ''),
('user', '$2y$10$B3UP0xzAmncsDyvI0wLSKOdx6aDUGg1EMGQje.Al2N40Yztdst5ky', NULL, 'user', 'ito', 'user@gmail.com', '', 'male', ''),
('user', '$2y$10$mxVyZg6cdnO9pIHeHXrDzuYpuMsgyzP/h5hSsiBMKNOlvJ9qidDKO', NULL, 'user', 'ito', 'user@gmail.com', '', 'male', ''),
('user123', '$2y$10$37I6J5cqpDITjJI4/S7lnOtW2e2yGI102XUVHV2y3Kf1c0Dd5AxpW', '2003-01-06', 'user123', 'last', 'gawalang@gmail.com', '', 'male', ''),
('username22', '$2y$10$7Jo/gJ/cKsCoiEhvhr0dee3DktheKCiIUunctSSYpr0lczNBy6IT2', '2000-07-13', 'Kath', 'Bernartdo', 'newTry@gmail.com', '', 'female', ''),
('username50', '$2y$10$Eq9U/x.4q29.YY9QH1wAVuNArR5gnV96Cqu4AWWA8yQQSatGn0EOy', '1992-02-13', 'Nadine', 'Lustre', 'newTrygain@gmail.com', '', 'female', ''),
('username51', '$2y$10$xKUAaEwMHmoZPIJ82gs4EOF5X5RpSKOMUThza8OjOrY7NoBqFzTzi', '1999-07-13', 'Liza', 'Soberamo', 'newTrygain@gmail.com', '', 'female', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `blogID_fk` (`blogID`),
  ADD KEY `username_fk` (`userNAME`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`blogID`),
  ADD KEY `users_fk_1` (`username`);

--
-- Indexes for table `questionnaire_responses`
--
ALTER TABLE `questionnaire_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `FK_username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`,`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `blogID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `questionnaire_responses`
--
ALTER TABLE `questionnaire_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `username_fk` FOREIGN KEY (`userNAME`) REFERENCES `user` (`username`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `users_fk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `questionnaire_responses`
--
ALTER TABLE `questionnaire_responses`
  ADD CONSTRAINT `FK_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
