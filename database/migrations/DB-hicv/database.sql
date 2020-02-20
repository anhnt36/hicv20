-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2017 at 03:41 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hicv`
--

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `number_page` int(2) NOT NULL DEFAULT '1',
  `layout` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `font` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `templates` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(10) NOT NULL,
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_achievement`
--

CREATE TABLE `resume_achievement` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_education`
--

CREATE TABLE `resume_education` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `school` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `field` text COLLATE utf8_unicode_ci,
  `date_from` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_going` tinyint(2) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_experience`
--

CREATE TABLE `resume_experience` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_summary` text COLLATE utf8_unicode_ci,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_from` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_going` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_interest`
--

CREATE TABLE `resume_interest` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `interest` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_language`
--

CREATE TABLE `resume_language` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `proficiency` text COLLATE utf8_unicode_ci,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_passion`
--

CREATE TABLE `resume_passion` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `passion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_project`
--

CREATE TABLE `resume_project` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_summary` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `date_from` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_going` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_skill`
--

CREATE TABLE `resume_skill` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `skill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_strength`
--

CREATE TABLE `resume_strength` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_summary`
--

CREATE TABLE `resume_summary` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `summary` text COLLATE utf8_unicode_ci,
  `setting` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `logined_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_achievement`
--
ALTER TABLE `resume_achievement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`) USING BTREE;

--
-- Indexes for table `resume_education`
--
ALTER TABLE `resume_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume_experience`
--
ALTER TABLE `resume_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume_interest`
--
ALTER TABLE `resume_interest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume_language`
--
ALTER TABLE `resume_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume_passion`
--
ALTER TABLE `resume_passion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_project`
--
ALTER TABLE `resume_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_skill`
--
ALTER TABLE `resume_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume_strength`
--
ALTER TABLE `resume_strength`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_summary`
--
ALTER TABLE `resume_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `resume_achievement`
--
ALTER TABLE `resume_achievement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `resume_education`
--
ALTER TABLE `resume_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `resume_experience`
--
ALTER TABLE `resume_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `resume_interest`
--
ALTER TABLE `resume_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resume_language`
--
ALTER TABLE `resume_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `resume_passion`
--
ALTER TABLE `resume_passion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `resume_project`
--
ALTER TABLE `resume_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `resume_skill`
--
ALTER TABLE `resume_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `resume_strength`
--
ALTER TABLE `resume_strength`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `resume_summary`
--
ALTER TABLE `resume_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;