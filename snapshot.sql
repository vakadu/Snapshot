-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 06:07 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-7+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snapshot`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `author`, `body`) VALUES
(5, '14', 'Itachi', 'No she ain\'t');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`) VALUES
(11, 'Panda Kung FU', 'Pandaaaaaa', '<p>hululuuuu</p>\n<p><span style="text-decoration: underline;">Hey there</span></p>', 'cartoon-characters-1v.jpg', 'haaaaaaaaaaaaa', 'image/jpeg', '458498'),
(12, 'PAIN', 'Yashiko', 'Rineegan', '7c6e3fce33885859e55aa1dc3e712d1e1116c334.jpg', 'Almighty push', 'image/jpeg', '22295'),
(13, 'Fuu', '', '', 'Fullmetal.Alchemist.full.1632834.jpg', '', 'image/jpeg', '689602'),
(14, '', '', '', 'pexels-photo-24859.jpg', '', 'image/jpeg', '153578'),
(15, '', '', '', 'pexels-photo-169743.jpeg', '', 'image/jpeg', '289957'),
(16, '', '', '', 'naruto_uchiha_itachi_mangekyou_sharingan_112353_3840x2160.jpg', '', 'image/jpeg', '779692'),
(17, '', '', '', 'pexels-photo-395132.jpeg', '', 'image/jpeg', '831310'),
(18, '', '', '', 'cartoon-characters-41a.jpg', '', 'image/jpeg', '148390'),
(20, '', '', '', '67371179-portgas-d-ace-wallpapers.jpg', '', 'image/jpeg', '295997'),
(22, '', '', '', 'pexels-photo-76093.jpeg', '', 'image/jpeg', '295663'),
(23, '', '', '', 'pexels-photo-196643.jpeg', '', 'image/jpeg', '292594'),
(24, '', '', '', 'phoenix-marco-fire-fist-ace-one-piece-hd-wallpaper-1080p.jpg', '', 'image/jpeg', '894218'),
(25, '', '', '', 'portgas-d-ace-fire-fist-wallpaper-one-piece-anime-1920x1200.jpg', '', 'image/jpeg', '1278096'),
(26, '', '', '', 'roronoa-zoro-one-piece-anime-hd-wallpaper-katana-sword-1600x900.jpg', '', 'image/jpeg', '666989'),
(27, '', '', '', 'sabo-luffy-ace-hd-wallpaper-one-piece-art-1920x1080.jpg', '', 'image/jpeg', '209238');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`) VALUES
(1, 'ace', 'ace', 'Portugas', '.D.', '67371179-portgas-d-ace-wallpapers.jpg'),
(16, 'itachi', 'itachi', 'Uchiha11', 'Itachi', 'naruto_uchiha_itachi_mangekyou_sharingan_112353_3840x2160.jpg'),
(20, 'adriana', 'adriana', 'Adriana', 'Lima', 'adriana_lima_by_desdea-dayo114.jpg'),
(22, 'zoro', 'zoro', 'Roronora', 'Zoro', 'roronoa-zoro-underwater-hd-wallpaper-one-piece-katana-1920x1200.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
