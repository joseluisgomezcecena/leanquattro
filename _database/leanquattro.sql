-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 12:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leanquattro`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `alert_id` int(11) NOT NULL,
  `alert_name` varchar(255) NOT NULL,
  `alert_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alert_child`
--

CREATE TABLE `alert_child` (
  `child_id` int(11) NOT NULL,
  `c_alert_id` int(11) NOT NULL,
  `child_alert_name` varchar(255) NOT NULL,
  `child_alert_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `andon_events`
--

CREATE TABLE `andon_events` (
  `id_andon` int(11) NOT NULL COMMENT 'Primary Key',
  `plant_id` int(11) NOT NULL,
  `line_id` int(11) DEFAULT NULL,
  `work_station_id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL,
  `subalert_id` int(11) NOT NULL,
  `work_order` varchar(255) DEFAULT NULL,
  `part_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `wait_time` float DEFAULT NULL,
  `offline_time` float NOT NULL,
  `service_user` int(11) DEFAULT NULL,
  `closed_user` int(11) DEFAULT NULL,
  `report_user` int(11) DEFAULT NULL,
  `service_status` int(1) NOT NULL DEFAULT 0 COMMENT '0 waiting\r\n1responded\r\n2 solved',
  `service_comment` text DEFAULT NULL,
  `solution_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--

CREATE TABLE `app_config` (
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_email` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_ssl` varchar(255) DEFAULT NULL,
  `socket_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `day_shift`
--

CREATE TABLE `day_shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  `same_day` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hour_by_hour`
--

CREATE TABLE `hour_by_hour` (
  `h_id` int(11) NOT NULL,
  `h_wo_id` int(11) NOT NULL,
  `h_ws_id` int(11) NOT NULL,
  `00h` int(11) NOT NULL,
  `01h` int(11) NOT NULL,
  `02h` int(11) NOT NULL,
  `03h` int(11) NOT NULL,
  `04h` int(11) NOT NULL,
  `05h` int(11) NOT NULL,
  `06h` int(11) NOT NULL,
  `07h` int(11) NOT NULL,
  `08h` int(11) NOT NULL,
  `09h` int(11) NOT NULL,
  `10h` int(11) NOT NULL,
  `11h` int(11) NOT NULL,
  `12h` int(11) NOT NULL,
  `13h` int(11) NOT NULL,
  `14h` int(11) NOT NULL,
  `15h` int(11) NOT NULL,
  `16h` int(11) NOT NULL,
  `17h` int(11) NOT NULL,
  `18h` int(11) NOT NULL,
  `19h` int(11) NOT NULL,
  `20h` int(11) NOT NULL,
  `21h` int(11) NOT NULL,
  `22h` int(11) NOT NULL,
  `23h` int(11) NOT NULL,
  `00p` varchar(25) DEFAULT NULL,
  `01p` varchar(25) DEFAULT NULL,
  `02p` varchar(25) DEFAULT NULL,
  `03p` varchar(25) DEFAULT NULL,
  `04p` varchar(25) DEFAULT NULL,
  `05p` varchar(25) DEFAULT NULL,
  `06p` varchar(25) DEFAULT NULL,
  `07p` varchar(25) DEFAULT NULL,
  `08p` varchar(25) DEFAULT NULL,
  `09p` varchar(25) DEFAULT NULL,
  `10p` varchar(25) DEFAULT NULL,
  `11p` varchar(25) DEFAULT NULL,
  `12p` varchar(25) DEFAULT NULL,
  `13p` varchar(25) DEFAULT NULL,
  `14p` varchar(25) DEFAULT NULL,
  `15p` varchar(25) DEFAULT NULL,
  `16p` varchar(25) DEFAULT NULL,
  `17p` varchar(25) DEFAULT NULL,
  `18p` varchar(25) DEFAULT NULL,
  `19p` varchar(25) DEFAULT NULL,
  `20p` varchar(25) DEFAULT NULL,
  `21p` varchar(25) DEFAULT NULL,
  `22p` varchar(25) DEFAULT NULL,
  `23p` varchar(25) DEFAULT NULL,
  `00r` int(11) NOT NULL,
  `01r` int(11) NOT NULL,
  `02r` int(11) NOT NULL,
  `03r` int(11) NOT NULL,
  `04r` int(11) NOT NULL,
  `05r` int(11) NOT NULL,
  `06r` int(11) NOT NULL,
  `07r` int(11) NOT NULL,
  `08r` int(11) NOT NULL,
  `09r` int(11) NOT NULL,
  `10r` int(11) NOT NULL,
  `11r` int(11) NOT NULL,
  `12r` int(11) NOT NULL,
  `13r` int(11) NOT NULL,
  `14r` int(11) NOT NULL,
  `15r` int(11) NOT NULL,
  `16r` int(11) NOT NULL,
  `17r` int(11) NOT NULL,
  `18r` int(11) NOT NULL,
  `19r` int(11) NOT NULL,
  `20r` int(11) NOT NULL,
  `21r` int(11) NOT NULL,
  `22r` int(11) NOT NULL,
  `23r` int(11) NOT NULL,
  `00pc` varchar(25) DEFAULT NULL,
  `01pc` varchar(25) DEFAULT NULL,
  `02pc` varchar(25) DEFAULT NULL,
  `03pc` varchar(25) DEFAULT NULL,
  `04pc` varchar(25) DEFAULT NULL,
  `05pc` varchar(25) DEFAULT NULL,
  `06pc` varchar(25) DEFAULT NULL,
  `07pc` varchar(25) DEFAULT NULL,
  `08pc` varchar(25) DEFAULT NULL,
  `09pc` varchar(25) DEFAULT NULL,
  `10pc` varchar(25) DEFAULT NULL,
  `11pc` varchar(25) DEFAULT NULL,
  `12pc` varchar(25) DEFAULT NULL,
  `13pc` varchar(25) DEFAULT NULL,
  `14pc` varchar(25) DEFAULT NULL,
  `15pc` varchar(25) DEFAULT NULL,
  `16pc` varchar(25) DEFAULT NULL,
  `17pc` varchar(25) DEFAULT NULL,
  `18pc` varchar(25) DEFAULT NULL,
  `19pc` varchar(25) DEFAULT NULL,
  `20pc` varchar(25) DEFAULT NULL,
  `21pc` varchar(25) DEFAULT NULL,
  `22pc` varchar(25) DEFAULT NULL,
  `23pc` varchar(25) DEFAULT NULL,
  `00wop` varchar(25) DEFAULT NULL,
  `01wop` varchar(25) DEFAULT NULL,
  `02wop` varchar(25) DEFAULT NULL,
  `03wop` varchar(25) DEFAULT NULL,
  `04wop` varchar(25) DEFAULT NULL,
  `05wop` varchar(25) DEFAULT NULL,
  `06wop` varchar(25) DEFAULT NULL,
  `07wop` varchar(25) DEFAULT NULL,
  `08wop` varchar(25) DEFAULT NULL,
  `09wop` varchar(25) DEFAULT NULL,
  `10wop` varchar(25) DEFAULT NULL,
  `11wop` varchar(25) DEFAULT NULL,
  `12wop` varchar(25) DEFAULT NULL,
  `13wop` varchar(25) DEFAULT NULL,
  `14wop` varchar(25) DEFAULT NULL,
  `15wop` varchar(25) DEFAULT NULL,
  `16wop` varchar(25) DEFAULT NULL,
  `17wop` varchar(25) DEFAULT NULL,
  `18wop` varchar(25) DEFAULT NULL,
  `19wop` varchar(25) DEFAULT NULL,
  `20wop` varchar(25) DEFAULT NULL,
  `21wop` varchar(25) DEFAULT NULL,
  `22wop` varchar(25) DEFAULT NULL,
  `23wop` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `operation_id` int(11) NOT NULL,
  `internal_id` varchar(50) NOT NULL,
  `operation_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part_numbers`
--

CREATE TABLE `part_numbers` (
  `pn_id` int(11) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_image` text NOT NULL,
  `part_description` text NOT NULL,
  `last_produced` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_lines`
--

CREATE TABLE `production_lines` (
  `line_id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_id` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `screen_description` varchar(255) NOT NULL,
  `screen_type` int(11) NOT NULL DEFAULT 1,
  `display_production` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screen_work_station`
--

CREATE TABLE `screen_work_station` (
  `screen_ws_id` int(11) NOT NULL,
  `screen_wss_id` int(11) NOT NULL,
  `screens_sc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_description` text NOT NULL,
  `escalation_1` int(11) NOT NULL DEFAULT 0,
  `escalation_2` int(11) NOT NULL DEFAULT 0,
  `escalation_3` int(11) NOT NULL DEFAULT 0,
  `escalation_4` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_alert`
--

CREATE TABLE `team_alert` (
  `team_alert_id` int(11) NOT NULL,
  `ta_alert_id` int(11) NOT NULL,
  `ta_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_location`
--

CREATE TABLE `team_location` (
  `tl_id` int(11) NOT NULL,
  `tl_line_id` int(11) NOT NULL,
  `tl_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `team_user_id` int(11) NOT NULL,
  `tu_user_id` int(11) NOT NULL,
  `team_leader` int(11) NOT NULL DEFAULT 0,
  `tu_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `signature` varchar(255) DEFAULT NULL,
  `operator` int(1) DEFAULT 0,
  `supervisor` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `wo_id` int(11) NOT NULL COMMENT 'Primary Key',
  `odoo_workorder` varchar(255) DEFAULT NULL,
  `odoo_operation` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `wo_workstation` int(11) NOT NULL,
  `wo_quantity` float DEFAULT NULL,
  `wo_todo` float NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1 registered, 2 in process, 3 finished, 4 hold, 5 cancelled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notes` text DEFAULT NULL,
  `planner_user` int(11) NOT NULL,
  `worker_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_stations`
--

CREATE TABLE `work_stations` (
  `work_station_id` int(11) NOT NULL COMMENT 'Primary Key',
  `ws_line_id` int(11) NOT NULL,
  `work_station_name` varchar(255) DEFAULT NULL,
  `work_station_number` varchar(255) DEFAULT NULL,
  `work_station_description` text DEFAULT NULL,
  `work_station_image` varchar(255) DEFAULT 'noimage.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `alert_child`
--
ALTER TABLE `alert_child`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `fk_alert_main` (`c_alert_id`);

--
-- Indexes for table `andon_events`
--
ALTER TABLE `andon_events`
  ADD PRIMARY KEY (`id_andon`),
  ADD KEY `fk_plant_id` (`plant_id`),
  ADD KEY `fk_work_station` (`work_station_id`);

--
-- Indexes for table `day_shift`
--
ALTER TABLE `day_shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `part_numbers`
--
ALTER TABLE `part_numbers`
  ADD PRIMARY KEY (`pn_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `production_lines`
--
ALTER TABLE `production_lines`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screen_id`);

--
-- Indexes for table `screen_work_station`
--
ALTER TABLE `screen_work_station`
  ADD PRIMARY KEY (`screen_ws_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_alert`
--
ALTER TABLE `team_alert`
  ADD PRIMARY KEY (`team_alert_id`);

--
-- Indexes for table `team_location`
--
ALTER TABLE `team_location`
  ADD PRIMARY KEY (`tl_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`team_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`wo_id`);

--
-- Indexes for table `work_stations`
--
ALTER TABLE `work_stations`
  ADD PRIMARY KEY (`work_station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `alert_child`
--
ALTER TABLE `alert_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id_andon` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `day_shift`
--
ALTER TABLE `day_shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `part_numbers`
--
ALTER TABLE `part_numbers`
  MODIFY `pn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_lines`
--
ALTER TABLE `production_lines`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `screen_work_station`
--
ALTER TABLE `screen_work_station`
  MODIFY `screen_ws_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team_alert`
--
ALTER TABLE `team_alert`
  MODIFY `team_alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `team_location`
--
ALTER TABLE `team_location`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `team_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `wo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `work_stations`
--
ALTER TABLE `work_stations`
  MODIFY `work_station_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert_child`
--
ALTER TABLE `alert_child`
  ADD CONSTRAINT `fk_alert_main` FOREIGN KEY (`c_alert_id`) REFERENCES `alerts` (`alert_id`);

--
-- Constraints for table `andon_events`
--
ALTER TABLE `andon_events`
  ADD CONSTRAINT `fk_plant_id` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`plant_id`),
  ADD CONSTRAINT `fk_work_station` FOREIGN KEY (`work_station_id`) REFERENCES `work_stations` (`work_station_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
