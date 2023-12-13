-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 12:55 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytb`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `title` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `upvote` int(11) DEFAULT 0,
  `downvote` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `username`, `date`, `title`, `content`, `upvote`, `downvote`) VALUES
(1, 'admin1', '2023-12-12 13:58:33', 'Notice', 'Hi, welcome to SEF! :)', 16, -6),
(10, 'user1', '2023-12-13 17:20:46', 'Community Empowerment for Sustainable Urban Living', 'To elevate the impact of Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, a focus on community empowerment is paramount. Encouraging active community participation in decision-making processes, fostering local entrepreneurship, and promoting sustainable lifestyle choices can significantly contribute to building resilient and inclusive cities. By emphasizing grassroots initiatives, we can create a bottom-up approach to urban development that addresses the unique needs of each community, fostering a sense of ownership and responsibility. This holistic strategy not only aligns with SDG 11\'s objectives but also ensures that the benefits of sustainable urban living reach every corner of our cities.', 0, 0),
(11, 'user1', '2023-12-13 17:20:53', ' Smart Cities: Harnessing Technology for Sustainab', 'In order to enhance the implementation of Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, embracing smart city technologies is crucial. By integrating advanced technologies such as IoT, AI, and data analytics into urban planning, cities can optimize resource utilization, improve infrastructure, and enhance overall sustainability. Smart city initiatives can streamline transportation systems, reduce energy consumption, and enhance public services, ultimately creating more resilient and environmentally friendly urban spaces. Embracing innovation in urban development is a key step toward achieving the targets set by SDG 11 and building cities that are not only smart but also sustainable for future generations.', 0, 0),
(20, 'user3', '2023-12-13 19:26:48', 'Green Infrastructure: A Pathway to Sustainable Urb', 'In the pursuit of Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, prioritizing green infrastructure offers a transformative approach. Integrating nature-based solutions such as green roofs, urban parks, and sustainable landscaping into city planning not only enhances biodiversity but also mitigates the impact of climate change. By fostering a harmonious coexistence between urban development and the environment, we can create cities that are not only resilient but also provide a higher quality of life for their inhabitants. Embracing green infrastructure aligns with the principles of SDG 11, promoting ecologically sound urbanization for a more sustainable and livable future.', 0, 0),
(21, 'user3', '2023-12-13 19:27:55', 'Inclusive Urban Planning: Bridging Gaps for Sustai', 'Achieving Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, necessitates a shift towards inclusive urban planning. By placing a strong emphasis on community engagement, social equity, and accessibility, cities can ensure that their development benefits all residents. This approach involves addressing the unique needs of vulnerable populations, promoting affordable housing, and creating accessible public spaces. Through inclusive urban planning, we can build cities that not only meet the infrastructure demands but also foster a sense of belonging and shared responsibility. This people-centric strategy aligns with the core principles of SDG 11, striving for cities that are sustainable, inclusive, and resilient.', 1, -1),
(22, 'user1', '2023-12-13 19:34:57', 'Tech-Driven Urban Resilience: Revolutionizing Sust', 'In the pursuit of Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, a technological revolution is key to fostering urban resilience. Embracing innovations like smart grids, predictive analytics, and renewable energy solutions can empower cities to proactively respond to challenges such as climate change and population growth. By integrating technology into urban infrastructure, we can enhance efficiency, reduce environmental impact, and improve overall quality of life for residents. This tech-driven approach aligns with the goals of SDG 11, steering cities towards a sustainable future that leverages the power of innovation for the benefit of both the environment and its inhabitants.', 0, 0),
(23, 'user1', '2023-12-13 19:36:43', 'Circular Cities: Rethinking Urban Development for ', 'To advance Sustainable Development Goal 11 (SDG 11) - Sustainable Cities and Communities, a paradigm shift towards circular cities is imperative. Embracing circular economy principles involves minimizing waste, promoting recycling, and reimagining resource use. By adopting sustainable practices such as circular design in architecture, waste-to-energy systems, and closed-loop material cycles, cities can drastically reduce their environmental footprint. This holistic approach not only addresses the challenges of urbanization but also promotes long-term sustainability. Building circular cities aligns with the objectives of SDG 11, offering a blueprint for urban development that is regenerative, resource-efficient, and environmentally responsible.', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `redemption`
--

CREATE TABLE `redemption` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `used_points` int(11) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `reward_code` varchar(20) DEFAULT NULL,
  `redemption_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `redemption`
--

INSERT INTO `redemption` (`id`, `username`, `used_points`, `reward_id`, `reward_code`, `redemption_date`) VALUES
(1, 'admin1', 1000, 2, '$10.00OFF', '2023-12-12 13:58:33'),
(2, 'admin1', 2000, 4, '$20.00OFF', '2023-12-12 13:58:33'),
(3, 'admin1', 1500, 3, '$15.00OFF', '2023-12-12 13:58:33'),
(4, 'admin1', 500, 1, '$5.00OFF', '2023-12-12 13:58:33'),
(5, 'admin1', 500, 1, '$5.00OFF', '2023-12-12 13:58:33'),
(6, 'user1', 500, 1, '$5.00OFF', '2023-12-12 13:58:33'),
(8, 'user1', 500, 1, '$5.00OFF', '2023-12-12 13:58:55'),
(9, 'user1', 1000, 2, '$10.00OFF', '2023-12-13 00:34:01'),
(10, 'user1', 500, 1, '$5.00OFF', '2023-12-13 19:51:19'),
(11, 'user1', 500, 1, '$5.00OFF', '2023-12-13 19:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `id` int(11) NOT NULL,
  `reward_code` varchar(20) NOT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`id`, `reward_code`, `points`) VALUES
(2, '$10.00OFF', 1000),
(3, '$15.00OFF', 1500),
(4, '$20.00OFF', 2000),
(1, '$5.00OFF', 500);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) DEFAULT 2,
  `username` varchar(20) DEFAULT NULL,
  `phone_num` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `confirm_password` varchar(50) DEFAULT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user_role_id`, `username`, `phone_num`, `email`, `password`, `confirm_password`, `points`) VALUES
(1, 1, 'admin1', '0123456789', 'admin10@gmail.com', '123456', '123456', 0),
(2, 2, 'user1', '0123456789', 'user50@gmail.com', '123456', '123456', 2500),
(5, 2, 'user2', '0123456789', 'user2@gmail.com', '123456', '123456', 0),
(7, 2, 'user3', '0123456789', 'user3@gmail.com', '123456', '123456', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `user_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `user_role`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `redemption`
--
ALTER TABLE `redemption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `reward_id` (`reward_id`,`reward_code`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id`,`reward_code`),
  ADD KEY `idx_reward` (`reward_code`,`points`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `redemption`
--
ALTER TABLE `redemption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`);

--
-- Constraints for table `redemption`
--
ALTER TABLE `redemption`
  ADD CONSTRAINT `redemption_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`) ON DELETE SET NULL,
  ADD CONSTRAINT `redemption_ibfk_2` FOREIGN KEY (`reward_id`,`reward_code`) REFERENCES `reward` (`id`, `reward_code`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `tb_user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
