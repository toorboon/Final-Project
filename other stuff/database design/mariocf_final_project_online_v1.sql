-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 07. Dez 2018 um 17:21
-- Server-Version: 5.7.24
-- PHP-Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mariocf_final_project`
--
CREATE DATABASE IF NOT EXISTS `mariocf_final_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mariocf_final_project`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `office_start` time DEFAULT NULL,
  `office_end` time DEFAULT NULL,
  `description` varchar(2555) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `course`
--

INSERT INTO `course` (`id`, `name`, `startdate`, `enddate`, `office_start`, `office_end`, `description`, `created_date`) VALUES
(1, 'FSWD60', '2019-01-07', '2019-04-12', '09:00:00', '16:00:00', 'Fullstack Webdevelopment Course v6.0', '2018-12-06 23:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_day`
--

DROP TABLE IF EXISTS `course_day`;
CREATE TABLE `course_day` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `technology` varchar(55) DEFAULT NULL,
  `technology_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `course_day`
--

INSERT INTO `course_day` (`id`, `course_id`, `date`, `technology`, `technology_day`) VALUES
(1, 1, '2019-01-07', 'GIT', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_exercises`
--

DROP TABLE IF EXISTS `course_exercises`;
CREATE TABLE `course_exercises` (
  `id` int(11) NOT NULL,
  `course_day_id` int(11) NOT NULL,
  `exercise_type_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `short_description` varchar(2555) DEFAULT NULL,
  `order_nr` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `course_exercises`
--

INSERT INTO `course_exercises` (`id`, `course_day_id`, `exercise_type_id`, `task_name`, `short_description`, `order_nr`) VALUES
(1, 1, 1, 'Task 1', 'Taskd 1', NULL),
(2, 1, 1, 'Task 2', 'Taskd 2', NULL),
(3, 1, 2, 'Task 1', 'Taskd 1', NULL),
(4, 1, 2, 'Task 2', 'Taskd 2', NULL),
(5, 1, 3, 'Task 1', 'Taskd 1', NULL),
(6, 1, 3, 'Task2 ', 'Taskd 2', NULL),
(7, 1, 4, 'Challenge', 'Challenged', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `enrollment`
--

INSERT INTO `enrollment` (`id`, `course_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exercise_type`
--

DROP TABLE IF EXISTS `exercise_type`;
CREATE TABLE `exercise_type` (
  `id` int(11) NOT NULL,
  `option_label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `exercise_type`
--

INSERT INTO `exercise_type` (`id`, `option_label`) VALUES
(1, 'Basic'),
(2, 'Intermediate'),
(3, 'Advanced'),
(4, 'Challenge');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pair`
--

DROP TABLE IF EXISTS `pair`;
CREATE TABLE `pair` (
  `id` int(11) NOT NULL,
  `course_day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pair_exercises`
--

DROP TABLE IF EXISTS `pair_exercises`;
CREATE TABLE `pair_exercises` (
  `id` int(11) NOT NULL,
  `pair_id` int(11) NOT NULL,
  `course_exercise_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pair_partner`
--

DROP TABLE IF EXISTS `pair_partner`;
CREATE TABLE `pair_partner` (
  `id` int(11) NOT NULL,
  `pair_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leader` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(155) NOT NULL,
  `lname` varchar(155) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` char(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `github` varchar(155) DEFAULT NULL,
  `info` text,
  `user_role_id` int(11) NOT NULL DEFAULT '1',
  `door_entry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `username`, `password`, `email`, `github`, `info`, `user_role_id`, `door_entry_id`) VALUES
(1, 'Donica', 'Kear', 'dkear0', 'Em08gQLMP', 'dkear0@cdbaby.com', NULL, NULL, 2, NULL),
(2, 'Carlynne', 'Van T\'Hoog', 'cvanthoog1', 'wvAgTdsNmPd', 'cvanthoog1@de.vu', NULL, NULL, 2, NULL),
(3, 'Ame', 'Dahill', 'adahill2', 'doD7Wg9SmZj', 'adahill2@statcounter.com', NULL, NULL, 2, NULL),
(4, 'Ingram', 'Elsey', 'ielsey3', 'NvI2E4L', 'ielsey3@berkeley.edu', NULL, NULL, 2, NULL),
(5, 'Mel', 'Birkbeck', 'mbirkbeck4', 'sRi8F0eO6fR9', 'mbirkbeck4@boston.com', NULL, NULL, 2, NULL),
(6, 'Iosep', 'Oliff', 'ioliff5', 'vAhMjKj1', 'ioliff5@pagesperso-orange.fr', NULL, NULL, 2, NULL),
(7, 'Ashton', 'Deroche', 'aderoche6', 'wFXv988h', 'aderoche6@ebay.co.uk', NULL, NULL, 2, NULL),
(8, 'Catha', 'Waything', 'cwaything7', 'IKiik3y2h5Ea', 'cwaything7@stanford.edu', NULL, NULL, 2, NULL),
(9, 'Corinna', 'Makin', 'cmakin8', 'kiowr973', 'cmakin8@so-net.ne.jp', NULL, NULL, 2, NULL),
(10, 'Thayne', 'Burdell', 'tburdell9', 'zeIHo44iZ', 'tburdell9@nationalgeographic.com', NULL, NULL, 2, NULL),
(11, 'Ingram', 'Rowell', 'irowella', '2gQM5MK4y61', 'irowella@dropbox.com', NULL, NULL, 2, NULL),
(12, 'Wallas', 'Goodier', 'wgoodierb', 'gaYreVjo', 'wgoodierb@eepurl.com', NULL, NULL, 2, NULL),
(13, 'Gertrudis', 'Brunesco', 'gbrunescoc', 'ENLz4taSY', 'gbrunescoc@bing.com', NULL, NULL, 2, NULL),
(14, 'Daisie', 'Acres', 'dacresd', 'DbiIV1', 'dacresd@patch.com', NULL, NULL, 2, NULL),
(15, 'Roxanna', 'Djokic', 'rdjokice', 'vLSHLjl', 'rdjokice@php.net', NULL, NULL, 2, NULL),
(16, 'Saloma', 'Stafford', 'sstaffordf', 'lCyfG4hzVQBt', 'sstaffordf@house.gov', NULL, NULL, 2, NULL),
(17, 'Noelani', 'Roset', 'nrosetg', 'Qj3LqqM', 'nrosetg@techcrunch.com', NULL, NULL, 2, NULL),
(18, 'Pam', 'Bastiman', 'pbastimanh', 'YMz4XwZxv9qO', 'pbastimanh@4shared.com', NULL, NULL, 2, NULL),
(19, 'Consalve', 'O\'Fearguise', 'cofearguisei', 'TNSS1kOc', 'cofearguisei@wordpress.org', NULL, NULL, 2, NULL),
(20, 'Jerrie', 'Laidler', 'jlaidlerj', 'o16BXwnn3QNi', 'jlaidlerj@gnu.org', NULL, NULL, 2, NULL),
(21, 'Elias', 'Camilleri', 'ecamillerik', 'qeASptgysk5', 'ecamillerik@cbsnews.com', NULL, NULL, 2, NULL),
(22, 'Leese', 'Richie', 'lrichiel', '8uYhIB', 'lrichiel@bloomberg.com', NULL, NULL, 2, NULL),
(23, 'Ara', 'Fenna', 'afennam', '3a587cu', 'afennam@nsw.gov.au', NULL, NULL, 2, NULL),
(24, 'Belva', 'Creek', 'bcreekn', 'JpHZya2', 'bcreekn@nifty.com', NULL, NULL, 2, NULL),
(25, 'Glyn', 'Reisen', 'greiseno', 'MGxSgK31A', 'greiseno@princeton.edu', NULL, NULL, 2, NULL),
(26, 'Timmy', 'Kesterton', 'tkestertonp', 'uAAL5k8Sc', 'tkestertonp@jigsy.com', NULL, NULL, 2, NULL),
(27, 'Lethia', 'Morshead', 'lmorsheadq', 'GDsXdV4mzU', 'lmorsheadq@timesonline.co.uk', NULL, NULL, 2, NULL),
(28, 'Saloma', 'Jacob', 'sjacobr', 'EXatFPuwkWA', 'sjacobr@amazon.com', NULL, NULL, 2, NULL),
(29, 'Barnabe', 'Bowdler', 'bbowdlers', 'Wn2fXXTg5tKR', 'bbowdlers@merriam-webster.com', NULL, NULL, 2, NULL),
(30, 'Torry', 'Keith', 'tkeitht', 'cmRFgybjVu', 'tkeitht@blog.com', NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `description` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user_role`
--

INSERT INTO `user_role` (`id`, `description`) VALUES
(1, 'guest'),
(2, 'student'),
(3, 'teacher'),
(4, 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `course_day`
--
ALTER TABLE `course_day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_day_1_idx` (`course_id`);

--
-- Indizes für die Tabelle `course_exercises`
--
ALTER TABLE `course_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_exercises_1_idx` (`course_day_id`),
  ADD KEY `fk_course_exercises_2_idx` (`exercise_type_id`);

--
-- Indizes für die Tabelle `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_enrollment_1_idx` (`user_id`),
  ADD KEY `fk_enrollment_2_idx` (`course_id`);

--
-- Indizes für die Tabelle `exercise_type`
--
ALTER TABLE `exercise_type`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pair`
--
ALTER TABLE `pair`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pair_1_idx` (`course_day_id`);

--
-- Indizes für die Tabelle `pair_exercises`
--
ALTER TABLE `pair_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pair_exercises_1_idx` (`pair_id`),
  ADD KEY `fk_pair_exercises_2_idx` (`course_exercise_id`);

--
-- Indizes für die Tabelle `pair_partner`
--
ALTER TABLE `pair_partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pair_partner_1_idx` (`pair_id`),
  ADD KEY `fk_pair_partner_2_idx` (`user_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `github_UNIQUE` (`github`),
  ADD KEY `fk_user_1_idx` (`user_role_id`);

--
-- Indizes für die Tabelle `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `course_day`
--
ALTER TABLE `course_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `course_exercises`
--
ALTER TABLE `course_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `exercise_type`
--
ALTER TABLE `exercise_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `pair`
--
ALTER TABLE `pair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pair_exercises`
--
ALTER TABLE `pair_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pair_partner`
--
ALTER TABLE `pair_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `course_day`
--
ALTER TABLE `course_day`
  ADD CONSTRAINT `fk_course_day_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `course_exercises`
--
ALTER TABLE `course_exercises`
  ADD CONSTRAINT `fk_course_exercises_1` FOREIGN KEY (`course_day_id`) REFERENCES `course_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_course_exercises_2` FOREIGN KEY (`exercise_type_id`) REFERENCES `exercise_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `fk_enrollment_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_enrollment_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `pair`
--
ALTER TABLE `pair`
  ADD CONSTRAINT `fk_pair_1` FOREIGN KEY (`course_day_id`) REFERENCES `course_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `pair_exercises`
--
ALTER TABLE `pair_exercises`
  ADD CONSTRAINT `fk_pair_exercises_1` FOREIGN KEY (`pair_id`) REFERENCES `pair` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pair_exercises_2` FOREIGN KEY (`course_exercise_id`) REFERENCES `course_exercises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `pair_partner`
--
ALTER TABLE `pair_partner`
  ADD CONSTRAINT `fk_pair_partner_1` FOREIGN KEY (`pair_id`) REFERENCES `pair` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pair_partner_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
