-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 04:31 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connect4`
--
DELIMITER $$
--
-- Διαδικασίες
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `clear_board` ()  BEGIN
		UPDATE `board` SET `piece_color`=null;
		update `players` set `nickname`=null, `token`=null;
		update `game_status` set `status`='not active', `p_turn`=null, `result`=null;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `move_piece` (IN `col_num` INT, IN `color` TEXT)  move_piece:
BEGIN
if (SELECT piece_color FROM `board` WHERE x=6 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=6 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

if (SELECT piece_color FROM `board` WHERE x=5 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=5 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

if (SELECT piece_color FROM `board` WHERE x=4 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=4 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

if (SELECT piece_color FROM `board` WHERE x=3 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=3 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

if (SELECT piece_color FROM `board` WHERE x=2 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=2 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

if (SELECT piece_color FROM `board` WHERE x=1 AND y=col_num)IS NULL THEN
UPDATE `board` SET piece_color=color WHERE x=1 AND y=col_num;
UPDATE `game_status` SET p_turn=if(color='R','Y','R');
LEAVE move_piece;
END IF;

END$$

DELIMITER ;
-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `piece_color` enum('R','Y') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`x`, `y`, `piece_color`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 7, NULL),
(2, 1, NULL),
(2, 2, NULL),
(2, 3, NULL),
(2, 4, NULL),
(2, 5, NULL),
(2, 6, NULL),
(2, 7, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 3, NULL),
(3, 4, NULL),
(3, 5, NULL),
(3, 6, NULL),
(3, 7, NULL),
(4, 1, NULL),
(4, 2, NULL),
(4, 3, NULL),
(4, 4, NULL),
(4, 5, NULL),
(4, 6, NULL),
(4, 7, NULL),
(5, 1, NULL),
(5, 2, NULL),
(5, 3, NULL),
(5, 4, NULL),
(5, 5, NULL),
(5, 6, NULL),
(5, 7, NULL),
(6, 1, NULL),
(6, 2, NULL),
(6, 3, NULL),
(6, 4, NULL),
(6, 5, NULL),
(6, 6, NULL),
(6, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game_status`
--

CREATE TABLE `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  ``p_turn`` enum('R','Y') DEFAULT NULL,
  `result` enum('Y','R','D') DEFAULT NULL,
  `last_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game_status`
--

INSERT INTO `game_status` (`status`, `p_turn`, `result`, `last_change`) VALUES
('not active', NULL, NULL, '2020-11-06 22:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `nickname` varchar(20) DEFAULT NULL,
  `piece_color` enum('R','Y') NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `last_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`nickname`, `piece_color`, `token`, `last_change`) VALUES
(NULL, 'R', NULL, '2020-11-06 22:38:30'),
(NULL, 'Y', NULL, '2020-11-06 22:38:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
