-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 08:06 PM
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
-- Database: `leanquattro_v1`
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

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`alert_id`, `alert_name`, `alert_description`, `created_at`, `updated_at`) VALUES
(6, 'Etiquetado', 'Falla en impresion de etiquetas', '2024-09-05 23:56:05', '2024-09-05 23:56:05'),
(7, 'Setup', 'Falla en setup de maquinaria', '2024-09-05 23:57:02', '2024-09-05 23:57:02');

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

--
-- Dumping data for table `alert_child`
--

INSERT INTO `alert_child` (`child_id`, `c_alert_id`, `child_alert_name`, `child_alert_description`) VALUES
(10, 6, 'Bar Teneder', ''),
(11, 6, 'Impresora Generica', ''),
(12, 6, 'Impresora Circular', ''),
(13, 6, 'Error en PC', ''),
(14, 7, 'Dimensiones incorrectas', ''),
(15, 7, 'Cortes incorrectos ', ''),
(16, 7, 'Configuracion', '');

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

--
-- Dumping data for table `andon_events`
--

INSERT INTO `andon_events` (`id_andon`, `plant_id`, `line_id`, `work_station_id`, `alert_id`, `subalert_id`, `work_order`, `part_number`, `created_at`, `service_at`, `closed_at`, `wait_time`, `offline_time`, `service_user`, `closed_user`, `report_user`, `service_status`, `service_comment`, `solution_comment`) VALUES
(26, 4, 4, 11, 7, 14, NULL, '4', '2024-10-07 21:15:57', '2024-10-08 10:41:43', NULL, 20.43, 0, 2, 2, 2, 2, 'test 3', NULL),
(39, 4, 5, 13, 6, 10, NULL, '4', '2024-10-07 22:30:55', NULL, NULL, NULL, 0, NULL, NULL, 2, 0, NULL, NULL);

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

--
-- Dumping data for table `hour_by_hour`
--

INSERT INTO `hour_by_hour` (`h_id`, `h_wo_id`, `h_ws_id`, `00h`, `01h`, `02h`, `03h`, `04h`, `05h`, `06h`, `07h`, `08h`, `09h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, `16h`, `17h`, `18h`, `19h`, `20h`, `21h`, `22h`, `23h`, `00p`, `01p`, `02p`, `03p`, `04p`, `05p`, `06p`, `07p`, `08p`, `09p`, `10p`, `11p`, `12p`, `13p`, `14p`, `15p`, `16p`, `17p`, `18p`, `19p`, `20p`, `21p`, `22p`, `23p`, `00r`, `01r`, `02r`, `03r`, `04r`, `05r`, `06r`, `07r`, `08r`, `09r`, `10r`, `11r`, `12r`, `13r`, `14r`, `15r`, `16r`, `17r`, `18r`, `19r`, `20r`, `21r`, `22r`, `23r`, `00pc`, `01pc`, `02pc`, `03pc`, `04pc`, `05pc`, `06pc`, `07pc`, `08pc`, `09pc`, `10pc`, `11pc`, `12pc`, `13pc`, `14pc`, `15pc`, `16pc`, `17pc`, `18pc`, `19pc`, `20pc`, `21pc`, `22pc`, `23pc`, `00wop`, `01wop`, `02wop`, `03wop`, `04wop`, `05wop`, `06wop`, `07wop`, `08wop`, `09wop`, `10wop`, `11wop`, `12wop`, `13wop`, `14wop`, `15wop`, `16wop`, `17wop`, `18wop`, `19wop`, `20wop`, `21wop`, `22wop`, `23wop`, `created_at`, `updated_at`) VALUES
(2, 26, 11, 0, 0, 0, 0, 0, 0, 100, 63, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '233-152BB', '233-151BB', '56145', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', 'WH/MO/00119', 'WH/MO/00118', 'WH/MO/00347', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-09-27 03:35:00', '2024-09-27 03:35:00'),
(3, 27, 11, 0, 0, 0, 0, 0, 52, 100, 63, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '233-152BB', '233-152BB', '233-151BB', '56145', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'WH/MO/00119', 'WH/MO/00119', 'WH/MO/00118', 'WH/MO/00347', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-09-27 04:03:44', '2024-09-27 19:29:30'),
(4, 28, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 5, 5, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '233-111BB', '233-171BB', '233-135BB', '248-011BB', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '233-111BB', '233-171BB', '233-135BB', '248-011BB', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'WH/MO/00116', 'WH/MO/00120', 'WH/MO/00126', 'WH/MO/00114', '', '', '', '', '', '', '', '', '', '2024-10-03 18:29:50', '2024-10-04 20:42:22'),
(5, 29, 11, 0, 0, 0, 0, 0, 0, 0, 0, 5, 5, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '233-111BB', '233-111BB', '233-111BB', '233-111BB', '233-111BB', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '233-111BB', '233-111BB', '233-111BB', '233-111BB', '233-111BB', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'WH/MO/00116', 'WH/MO/00116', 'WH/MO/00116', 'WH/MO/00116', 'WH/MO/00116', '', '', '', '', '', '', '', '', '', '', '', '2024-10-04 22:06:32', '2024-10-04 22:08:14');

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

--
-- Dumping data for table `part_numbers`
--

INSERT INTO `part_numbers` (`pn_id`, `part_number`, `part_image`, `part_description`, `last_produced`, `created_at`, `updated_at`) VALUES
(4, '56147', 'noimage.jpg', 'Fender Black Knob', '0000-00-00 00:00:00', '2024-09-05 23:39:51', '2024-09-05 23:39:51'),
(5, '01011-00-20', 'noimage.jpg', 'TITANAL 020 DIA 35%/45% COLDWORKED', '0000-00-00 00:00:00', '2024-09-05 23:40:52', '2024-09-05 23:41:13');

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

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plant_id`, `plant_name`, `created_at`, `updated_at`) VALUES
(4, 'Avanti Manufacturing', '2024-09-05 23:32:50', '2024-09-05 23:32:50');

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

--
-- Dumping data for table `production_lines`
--

INSERT INTO `production_lines` (`line_id`, `line_name`, `plant_id`, `created_at`, `updated_at`) VALUES
(4, 'CNC', 4, '2024-09-05 23:33:27', '2024-09-05 23:33:27'),
(5, 'Pulido', 4, '2024-09-05 23:33:41', '2024-09-05 23:33:41'),
(6, 'Inspeccion', 4, '2024-09-05 23:34:01', '2024-09-05 23:34:01'),
(7, 'Etiquetado', 4, '2024-09-05 23:34:12', '2024-09-05 23:34:12'),
(8, 'Almacen', 4, '2024-09-05 23:34:21', '2024-09-05 23:34:21');

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

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screen_id`, `screen_name`, `screen_description`, `screen_type`, `display_production`, `created_at`, `updated_at`) VALUES
(4, 'Pantalla #1', 'Pantalla con cnc1, cnc2, pol1, lab1', 1, 0, '2024-09-12 20:11:40', '2024-09-12 20:11:40'),
(5, 'Pantalla #2', 'Pantalla con cnc1, cnc2', 1, 0, '2024-09-12 21:23:55', '2024-09-12 21:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `screen_work_station`
--

CREATE TABLE `screen_work_station` (
  `screen_ws_id` int(11) NOT NULL,
  `screen_wss_id` int(11) NOT NULL,
  `screens_sc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screen_work_station`
--

INSERT INTO `screen_work_station` (`screen_ws_id`, `screen_wss_id`, `screens_sc_id`) VALUES
(14, 12, 5),
(15, 11, 5),
(16, 11, 4),
(17, 12, 4),
(18, 13, 4),
(19, 14, 4);

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

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_description`, `escalation_1`, `escalation_2`, `escalation_3`, `escalation_4`, `created_at`, `updated_at`) VALUES
(23, 'Equipo de etiquetas', 'Primer respuesta Andon', 1, 1, 1, 1, '2024-09-06 00:03:49', '2024-09-06 00:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `team_alert`
--

CREATE TABLE `team_alert` (
  `team_alert_id` int(11) NOT NULL,
  `ta_alert_id` int(11) NOT NULL,
  `ta_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_alert`
--

INSERT INTO `team_alert` (`team_alert_id`, `ta_alert_id`, `ta_team_id`) VALUES
(24, 6, 23);

-- --------------------------------------------------------

--
-- Table structure for table `team_location`
--

CREATE TABLE `team_location` (
  `tl_id` int(11) NOT NULL,
  `tl_line_id` int(11) NOT NULL,
  `tl_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_location`
--

INSERT INTO `team_location` (`tl_id`, `tl_line_id`, `tl_team_id`) VALUES
(29, 7, 23);

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

--
-- Dumping data for table `team_user`
--

INSERT INTO `team_user` (`team_user_id`, `tu_user_id`, `team_leader`, `tu_team_id`) VALUES
(84, 2, 1, 23),
(85, 10, 0, 23);

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
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `is_admin`, `created_at`, `updated_at`, `signature`) VALUES
(2, NULL, NULL, NULL, 'administrator', 'admin@admin.com', '', '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 11:39:23', '2024-04-05 13:13:54', NULL),
(10, NULL, 'Jose Luis', 'Gomez Cecena', 'jgomez', 'jose.gomez@avantimanufacturing.com', '6862594319', '$2y$10$nIaYOKKbakqfXSj9LokA7uOZU/wknuxl4UyA0WnD2yBEqQkVdnw7q', 1, '2024-09-05 23:25:23', '2024-09-05 23:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `wo_id` int(11) NOT NULL COMMENT 'Primary Key',
  `part_number` varchar(255) DEFAULT NULL,
  `wo_workstation` int(11) NOT NULL,
  `wo_quantity` float DEFAULT NULL,
  `wo_todo` float NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1 registered, 2 in process, 3 finished, 4 hold, 5 cancelled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`wo_id`, `part_number`, `wo_workstation`, `wo_quantity`, `wo_todo`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `notes`) VALUES
(14, NULL, 11, NULL, 0, '2024-09-13 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-13 20:38:15', '2024-09-20 21:25:41', 'now test'),
(15, NULL, 11, NULL, 0, '2024-09-14 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-14 23:43:35', '2024-09-14 23:43:35', 'dieofew'),
(16, NULL, 13, NULL, 0, '2024-09-14 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-14 23:44:06', '2024-09-14 23:44:06', 'fdfdds'),
(17, NULL, 12, NULL, 0, '2024-09-14 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-15 02:05:39', '2024-09-15 02:05:39', 'nueva'),
(18, NULL, 15, NULL, 0, '2024-09-14 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-15 03:06:19', '2024-09-15 03:06:19', 'ddewdwed'),
(19, NULL, 11, NULL, 0, '2024-09-19 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-19 18:43:43', '2024-09-19 18:43:43', 'una orden de prueba'),
(20, NULL, 12, NULL, 0, '2024-09-19 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-19 19:43:05', '2024-09-19 19:43:05', ''),
(21, NULL, 14, NULL, 0, '2024-09-19 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-19 19:44:04', '2024-09-19 19:44:04', ''),
(22, NULL, 11, NULL, 0, '2024-09-20 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-20 19:18:55', '2024-09-20 19:18:55', 'now test edited 9/20/2024'),
(23, NULL, 11, NULL, 0, '2024-09-27 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-27 02:48:32', '2024-09-27 02:48:32', 'orden para el viernes urgente'),
(24, NULL, 11, NULL, 0, '2024-09-26 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-27 02:51:50', '2024-09-27 02:51:50', 'fewfw'),
(25, NULL, 11, NULL, 0, '2024-09-26 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-27 03:26:10', '2024-09-27 03:26:10', 'cdscds'),
(26, NULL, 11, NULL, 0, '2024-09-26 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-27 03:35:00', '2024-09-27 03:35:00', 'fewfw'),
(27, NULL, 11, NULL, 0, '2024-09-26 00:00:00', '0000-00-00 00:00:00', 1, '2024-09-27 04:03:44', '2024-09-27 19:29:30', 'fewfw ttt2'),
(28, NULL, 11, NULL, 0, '2024-10-04 00:00:00', '0000-00-00 00:00:00', 1, '2024-10-03 18:29:50', '2024-10-04 17:42:05', 'Pinzas maquinado 10/3/2024.'),
(29, NULL, 11, NULL, 0, '2024-10-07 00:00:00', '0000-00-00 00:00:00', 1, '2024-10-04 22:06:32', '2024-10-04 22:06:32', 'lunes prueba');

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
-- Dumping data for table `work_stations`
--

INSERT INTO `work_stations` (`work_station_id`, `ws_line_id`, `work_station_name`, `work_station_number`, `work_station_description`, `work_station_image`, `created_at`, `updated_at`) VALUES
(11, 4, 'CNC 1', 'CNC01', 'Maquinado CNC para pinzas', 'noimage.jpg', '2024-09-05 23:35:07', '2024-09-05 23:35:07'),
(12, 4, 'CNC 2', 'CNC02', 'Maquinado CNC para pinzas', 'noimage.jpg', '2024-09-05 23:35:28', '2024-09-05 23:35:28'),
(13, 5, 'POL 1', 'POL01', 'Estacion de pulido', 'noimage.jpg', '2024-09-05 23:36:00', '2024-09-05 23:36:00'),
(14, 7, 'LAB 1', 'LAB 01', 'Estacion de etiquedato', 'noimage.jpg', '2024-09-05 23:36:41', '2024-09-05 23:36:41'),
(15, 7, 'LAB 2', 'LAB 02', 'Estacion de etiquetado para etiquetas circulares', 'noimage.jpg', '2024-09-05 23:37:07', '2024-09-05 23:37:30');

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
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `andon_events`
--
ALTER TABLE `andon_events`
  ADD PRIMARY KEY (`id_andon`);

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
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `alert_child`
--
ALTER TABLE `alert_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id_andon` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `day_shift`
--
ALTER TABLE `day_shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `team_alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team_location`
--
ALTER TABLE `team_location`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `team_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `wo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `work_stations`
--
ALTER TABLE `work_stations`
  MODIFY `work_station_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
