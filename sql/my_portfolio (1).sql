-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2022 at 09:34 AM
-- Server version: 8.0.30-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `short_title`, `media_id`, `birthdate`, `phone`, `city`, `age`, `degree`, `email`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
('06a08cef-c506-4d95-b2b9-9e7f0c825b93', 'Back-End Developers', 'deebd42d-5142-43a4-acff-3a53ddd33935', '2000-05-10', '09638212926', 'vadodara', '22', 'BCA', 'khansalman0326@gmail.com', 1, 0, '2022-09-19 10:00:37', '2022-09-19 11:15:00', '2022-09-19 10:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `media_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
('20d13e04-55fe-4969-8416-9b4e44ca183a', 'Salman Hayat', 'salman', '$2y$10$D3AOsCefbucwJNT953ka3.wZtW1y80iU3.Y.aNnZ2m9dnAkRrGKY.', NULL, 1, 0, '2022-09-19 09:17:40', '2022-09-19 09:28:41', NULL),
('866bffba-97e9-4772-9075-26d6ea20c5c3', 'Mohammed Sufyan Shaikh', 'sufyan', '$2y$10$Pw2CyhRNd7zRNDDqJvljDuVUPdKPbMcko4Y2r3dHdOTimAKvJaB56', NULL, 0, 0, '2021-07-28 18:25:21', '2022-09-19 09:28:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `media_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_description`, `description`, `is_featured`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`, `media_id`, `url_slug`) VALUES
('4c0f28aa-dab7-4994-8496-33663bbbadb7', 'Data Engineering Best Practices to Drive Transformation', 'Data Engineering Best Practices To succeed in this age of digital transformation', '<p>To succeed in this age of digital transformation, enterprises are embracing data-driven decision-making. And, making quality data available in a reliable manner proves to be a major determinant of success for data analytics initiatives. The data engineering teams straddle between building infrastructure, running jobs &amp; fielding ad-hoc requests from the analytics and BI teams. And, this is where the data engineers are tasked to take into account a broader set of dependencies and requirements as they design and build their data pipelines.</p><p><br></p><p>But is there a way to structure it logically? Well, the answer is both yes and no. To start with you’ll need to understand the current state of affairs, including the decentralization of the modern data stack, the fragmentation of the data team, the rise of the cloud, and how all these factors have changed the role of the data engineering forever. And, how a proven framework with best data engineering practices can help tie the data pieces together to make decision-making seamless.</p><p>Through this article, based on our experience we’ll shed light on some of the data engineering best practices to enable you to work with data easier while delivering innovative solutions, faster.</p><p><br></p><h2>Final Words</h2><p>With data engineering as a service, every business can accelerate value creation from data collected, extract intelligence to improve strategies &amp; optimize analytics to drive real-time decisions.&nbsp;The listed best practices would enable making your data pipelines consistent, robust, scalable, reliable, reusable &amp; production ready. And, with that data consumers like data scientists can focus on science, instead of worrying about data management.</p><p>Since this stream, doesn’t have a wide range of well-established best practices like software engineering – you can work with a data engineering partner and benefit from their experience. They can help you achieve these goals by leveraging the right tech stack, on-premises architecture, or cloud platforms &amp; integrating ETL pipelines, data warehouses, BI tools &amp; governance processes. This would result in accurate, complete &amp; error-free data that lays a solid groundwork for swift &amp; seamless adoption of AI &amp; analytics.</p>', 0, 1, 0, '2022-09-13 10:46:52', '2022-09-19 10:59:59', '2022-09-15 04:09:55', '937e06a6-d2e8-43d8-935f-fef98ac062eb', 'data-engineering-best-practices');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` enum('IMAGE','VIDEO','DOCUMENT') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'IMAGE',
  `type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int DEFAULT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `value`, `directory`, `media_type`, `type`, `size`, `caption`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
('3b4bffab-bf3e-4f1d-8336-d0b2267f298b', '46-download.jpeg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 6767, NULL, NULL, 1, 0, '2022-09-19 10:17:46', '2022-09-19 10:17:46', NULL),
('4c7b956f-a2bd-4a35-b549-49c4102cdf1a', '58-aa.jpg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 524504, NULL, NULL, 1, 0, '2022-09-19 10:03:58', '2022-09-19 10:03:58', NULL),
('636fcd19-8a39-4e87-ada6-623c77c52079', '37-aa.jpg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 524504, NULL, NULL, 1, 0, '2022-09-19 10:00:37', '2022-09-19 10:00:37', NULL),
('825a6895-3869-4cc4-bd54-595b9e260a47', '26-aa.jpg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 524504, NULL, NULL, 1, 0, '2022-09-19 10:18:26', '2022-09-19 10:18:26', NULL),
('937e06a6-d2e8-43d8-935f-fef98ac062eb', '59-download.jpeg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 6767, NULL, NULL, 1, 0, '2022-09-19 10:59:59', '2022-09-19 10:59:59', NULL),
('a8cd1752-baf6-47c0-b829-5f46f950b68a', '47-aa.jpg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 524504, NULL, NULL, 1, 0, '2022-09-19 10:16:47', '2022-09-19 10:16:47', NULL),
('a9e358a8-81fb-406e-8bc8-4fab9ec1ff5e', '11-download.jpeg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 6767, NULL, NULL, 1, 0, '2022-09-19 10:03:11', '2022-09-19 10:03:11', NULL),
('deebd42d-5142-43a4-acff-3a53ddd33935', '33-download.jpeg', 'webroot/files/Media/value/', 'IMAGE', 'image/jpeg', 6767, NULL, NULL, 1, 0, '2022-09-19 10:18:33', '2022-09-19 10:18:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `media_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `is_featured`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`, `media_id`, `url_slug`) VALUES
('4bcd59b1-0aec-4e35-a4ed-676b173efdcf', 'test', 0, 1, 0, '2022-09-19 10:03:58', '2022-09-19 10:03:58', NULL, '4c7b956f-a2bd-4a35-b549-49c4102cdf1a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_media_id` (`media_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adm_media_id` (`media_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_b_media_id` (`media_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_media_id` (`media_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abouts`
--
ALTER TABLE `abouts`
  ADD CONSTRAINT `fk_t_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_adm_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fk_b_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_p_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
