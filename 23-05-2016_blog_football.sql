-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2016 at 07:36 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_football`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_group_id` tinyint(2) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
`id` int(11) NOT NULL,
  `level` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` tinyint(2) NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
`id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `intro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(20) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_static`
--

CREATE TABLE IF NOT EXISTS `content_static` (
`id` int(11) NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `cretae_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `english`
--

CREATE TABLE IF NOT EXISTS `english` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `football_menu`
--

CREATE TABLE IF NOT EXISTS `football_menu` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `site_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` tinyint(2) NOT NULL,
  `sort_order` tinyint(3) NOT NULL,
  `create_date` date DEFAULT NULL,
  `create_user` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `football_menu`
--

INSERT INTO `football_menu` (`id`, `name`, `site_title`, `parent_id`, `sort_order`, `create_date`, `create_user`, `update_date`, `update_user`) VALUES
(1, 'English', 'các giải vô địch nước anh', 0, 0, '2016-04-08', NULL, NULL, NULL),
(2, 'Spain', 'Các giải vô địch Tây Ban Nha', 0, 0, NULL, NULL, NULL, NULL),
(3, 'Germany', 'Các giải vô địch Đức', 0, 0, NULL, NULL, NULL, NULL),
(4, 'Việt Nam', 'Các giải vô địch Việt Nam', 0, 0, NULL, NULL, NULL, NULL),
(5, 'France', 'Các giải vô địch Pháp', 0, 0, NULL, NULL, NULL, NULL),
(6, 'Remain', 'Các giải vô địch còn lại trên thế giới', 0, 0, NULL, NULL, NULL, NULL),
(7, 'Photo', 'Các ảnh nổi bật ở làng bóng đá', 0, 0, NULL, NULL, NULL, NULL),
(8, 'Video', 'Các video nổi bật hàng đầu', 0, 0, NULL, NULL, NULL, NULL),
(9, 'Laliga', 'Giải vô địch hàng đầu Tây Ban Nha', 2, 2, '2016-04-29', NULL, '2016-04-30', NULL),
(10, 'Cúp Nhà Vua', 'Giải đấu cúp quốc gia Tây Ban Nha', 2, 4, '2016-05-02', NULL, '2016-05-22', NULL),
(12, 'Laliga 2', 'Giải đấu hạng hai của Tây Ban Nha', 2, 5, '2016-05-22', NULL, '2016-05-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
`id` int(11) NOT NULL,
  `intro` varchar(250) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `content` text,
  `content_left` text,
  `content_right` text,
  `type` tinyint(2) NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `intro`, `version`, `content`, `content_left`, `content_right`, `type`, `create_user`, `create_date`, `update_user`, `update_date`) VALUES
(2, 'Toàn bộ nội dung bài viết, ý kiến thành viên được kiểm duyệt, cung cấp và bảo trợ thông tin bởi Báo Thể Thao Việt Nam – Cơ quan thuộc Tổng Cục Thể Dục Thể Thao.', 'version 1.0.0', NULL, '<strong>Chịu tr&aacute;ch nhiệm nội dung: Nh&agrave; b&aacute;o, Tiến sĩ V&otilde; Danh Hải - Trưởng chi nh&aacute;nh ph&iacute;a Nam</strong>&nbsp;<strong>Bạch Thị H&agrave; - Ph&oacute; gi&aacute;m đốc C&ocirc;ng ty Cổ phần Y&ecirc;u Thể Thao</strong><br />Giấy ph&eacute;p số 29/GP-TTĐT do Bộ Th&ocirc;ng tin v&agrave; Truyền th&ocirc;ng cấp ng&agrave;y 11/02/2010 v&agrave; giấy ph&eacute;p số 88/GP-TTĐT của Sở Th&ocirc;ng tin v&agrave; Truyền th&ocirc;ng TP.HCM cấp ng&agrave;y 28/7/2015.</p>', '<p><strong>Bản quyền v&agrave; ph&aacute;t triển bởi C&ocirc;ng ty Cổ phần Y&ecirc;u Thể Thao</strong><br />\r\nĐịa chỉ: Tầng 3, số 1 Huyền Tr&acirc;n C&ocirc;ng Ch&uacute;a, P.Bến Th&agrave;nh, Q.1, TP.HCM.<br />\r\nĐiện thoại: (84-8) 38251028, fax: (84-8) 38251049.<br />\r\nQuảng c&aacute;o: 0936 00 99 59 - Email :&nbsp;<a href="mailto:commedia.ad@gmail.com">commedia.ad@gmail.com</a><br />\r\nTo&agrave; soạn &amp; hỗ trợ: (84-8) 38251028 - Email:&nbsp;<a href="mailto:hotro@bongda.com.vn">hotro@bongda.com.vn</a></p>\r\n', 1, 1, '2016-05-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `france`
--

CREATE TABLE IF NOT EXISTS `france` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `germany`
--

CREATE TABLE IF NOT EXISTS `germany` (
`id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `highlight`
--

CREATE TABLE IF NOT EXISTS `highlight` (
`id` int(20) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) DEFAULT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `create_user` tinyint(3) NOT NULL,
  `create_date` date NOT NULL,
  `update_user` tinyint(3) NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `italia`
--

CREATE TABLE IF NOT EXISTS `italia` (
`id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
`id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_list` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
`id` int(11) NOT NULL,
  `season` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `team` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `match` int(11) NOT NULL,
  `create_user` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_user` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `remain`
--

CREATE TABLE IF NOT EXISTS `remain` (
`id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spain`
--

CREATE TABLE IF NOT EXISTS `spain` (
`id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL,
  `create_user` tinyint(4) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `spain`
--

INSERT INTO `spain` (`id`, `title`, `content`, `meta_desc`, `meta_key`, `image_link`, `image_thumb`, `intro`, `views`, `parent_id`, `tags`, `create_date`, `create_user`, `update_date`, `update_user`) VALUES
(14, 'Lê Thái', '<p>hj</p>\r\n', '', '', 'http://localhost:8888/LeThai/DoAn/myfootball/public/uploads/Images/oh1.jpg', 'http://localhost:8888/LeThai/DoAn/myfootball/public/uploads/_thumbs/Images/oh1.jpg', 'jhedfghjkl;kj767errtfugygggggggggg', 0, 9, '2', '2016-05-22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE IF NOT EXISTS `support` (
`id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `sky` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sort_oder` tinyint(2) NOT NULL,
  `create_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tags_in_content` int(11) NOT NULL,
  `create_user` tinyint(4) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `tags_in_content`, `create_user`, `create_date`) VALUES
(1, 'Barcelona', 0, 1, '2016-05-02'),
(2, 'Barca', 0, 1, '2016-05-03'),
(3, 'messi', 0, 1, '2016-05-02'),
(4, 'neymar', 0, 1, '2016-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usser_permission`
--

CREATE TABLE IF NOT EXISTS `usser_permission` (
`id` int(11) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `resource_id` tinyint(4) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `feature` int(11) DEFAULT NULL,
  `create_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vietnam`
--

CREATE TABLE IF NOT EXISTS `vietnam` (
`id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `tags` tinyint(5) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `create_user` tinyint(3) DEFAULT NULL,
  `update_user` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_static`
--
ALTER TABLE `content_static`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english`
--
ALTER TABLE `english`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_menu`
--
ALTER TABLE `football_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `france`
--
ALTER TABLE `france`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `germany`
--
ALTER TABLE `germany`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `highlight`
--
ALTER TABLE `highlight`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `italia`
--
ALTER TABLE `italia`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remain`
--
ALTER TABLE `remain`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spain`
--
ALTER TABLE `spain`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usser_permission`
--
ALTER TABLE `usser_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vietnam`
--
ALTER TABLE `vietnam`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content_static`
--
ALTER TABLE `content_static`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `english`
--
ALTER TABLE `english`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `football_menu`
--
ALTER TABLE `football_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `france`
--
ALTER TABLE `france`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `germany`
--
ALTER TABLE `germany`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `highlight`
--
ALTER TABLE `highlight`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `italia`
--
ALTER TABLE `italia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `remain`
--
ALTER TABLE `remain`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spain`
--
ALTER TABLE `spain`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usser_permission`
--
ALTER TABLE `usser_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vietnam`
--
ALTER TABLE `vietnam`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
