-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2016 at 07:28 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
`id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `username`, `password`, `name`, `lastname`) VALUES
(6, 'MRaoofnia', '123456', 'mohammad', 'raoofnia'),
(7, 'AKalemati', '132465', 'abolfazl', 'kalemati'),
(8, 'HSadeghi', '321456', 'hosein', 'sadeghi');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `title`) VALUES
(1, 'mobile', 'mobile'),
(2, 'laptop', 'laptop');

-- --------------------------------------------------------

--
-- Table structure for table `category_relationship`
--

CREATE TABLE IF NOT EXISTS `category_relationship` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_relationship`
--

INSERT INTO `category_relationship` (`post_id`, `category_id`) VALUES
(2, 1),
(3, 1),
(2, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `post_id` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `content`, `date`, `email`, `post_id`) VALUES
(1, 'a guy', 'it was such a very useful article.\r\nthank you guys.', '2016-05-17', 'lonelyguy@gmail.com', 2),
(2, 'buddy', 'you''re awesome guys.', '2016-05-18', 'buddy@gmail.com', 2),
(3, 'your honey', 'love you abolfazl. you''re my own love.', '2016-05-18', 'honeyboney@yahoo.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
`id` int(11) NOT NULL,
  `display_name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `display_name`, `address`) VALUES
(1, 'link 1', 'www.blog.ut.ir'),
(2, 'link 2', 'www.blog.ut.com'),
(3, 'google', 'www.google.com'),
(4, 'w3', 'www.w3schools.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `comment_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `active`, `title`, `content`, `date`, `comment_count`, `user_id`) VALUES
(2, 1, 'first post', 'hello guys.\r\nit''s my new blog which I will use since now.\r\nI hope it be such a useful blog for you and me myself.\r\n;)', '2016-05-18', 2, 6),
(3, 0, 'inactive post', 'it''s an inactive post to test the blog.', '2016-05-17', 0, 6),
(4, 1, 'my first official post', 'it''s my first post and after this one I will post better contents for  you.\r\nthanks.', '2016-05-16', 1, 7),
(6, 1, 'test 4', 'its another test to see if the posting part works or not\r\nthank you\r\n', '2016-06-02', 0, 6),
(7, 1, 'nlnkdkvnsdv', 'sdbkvlsjbvljsbvlj.lblskbvk;sdkvbsv;ksbk;vbsvl''bs;kvbskv', '2016-06-24', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `blog_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '""',
  `admin_mail` varchar(100) DEFAULT NULL,
  `posts_per_page` int(5) NOT NULL DEFAULT '10',
  `blog_icon_url` varchar(255) NOT NULL DEFAULT 'img/default_avatar.jpg',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '""',
`id` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`blog_title`, `admin_mail`, `posts_per_page`, `blog_icon_url`, `description`, `id`) VALUES
('my blog', 'admin@shahroodut.ac.ir', 15, 'img/default_avatar.jpg', 'it''s a test blog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`) VALUES
(1, 'tag 1'),
(2, 'tag 2'),
(3, 'tag 3'),
(4, 'tag 4');

-- --------------------------------------------------------

--
-- Table structure for table `tag_relationship`
--

CREATE TABLE IF NOT EXISTS `tag_relationship` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag_relationship`
--

INSERT INTO `tag_relationship` (`post_id`, `tag_id`) VALUES
(2, 1),
(4, 2),
(3, 3),
(2, 4),
(3, 4),
(4, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_relationship`
--
ALTER TABLE `category_relationship`
 ADD PRIMARY KEY (`post_id`,`category_id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_relationship`
--
ALTER TABLE `tag_relationship`
 ADD PRIMARY KEY (`post_id`,`tag_id`), ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_relationship`
--
ALTER TABLE `category_relationship`
ADD CONSTRAINT `category_relationship_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
ADD CONSTRAINT `category_relationship_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `tag_relationship`
--
ALTER TABLE `tag_relationship`
ADD CONSTRAINT `tag_relationship_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
ADD CONSTRAINT `tag_relationship_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
