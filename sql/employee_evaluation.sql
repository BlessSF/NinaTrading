-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 02:48 AM
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
-- Database: `employee_evaluation`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `date_hired` date NOT NULL,
  `status` varchar(50) DEFAULT 'Probationary',
  `branch` varchar(50) NOT NULL,
  `sub_branch` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `surname`, `first_name`, `date_hired`, `status`, `branch`, `sub_branch`) VALUES
(770, 'Alarcon', 'Jhon Rey', '2023-05-24', 'Probationary', 'STELLA', NULL),
(771, 'Ardelosa', 'Eric ', '2024-02-03', 'Probationary', 'STELLA', NULL),
(772, 'Arquilola', 'Lourence Mark', '2020-09-21', 'Regular', 'STELLA', NULL),
(773, 'Bibanco', 'Dave Mitchel', '2024-03-07', 'Probationary', 'STELLA', NULL),
(774, 'Bongais', 'John Aris', '2022-06-24', 'Probationary', 'STELLA', NULL),
(775, 'Canada', 'Jose Jr.', '2021-11-15', 'Regular', 'STELLA', NULL),
(776, 'Catalan', 'Ryan', '2023-04-13', 'Probationary', 'STELLA', NULL),
(777, 'Estancia', 'Nole', '2022-06-06', 'Probationary', 'STELLA', NULL),
(778, 'Estibal', 'John Adonis', '2024-01-16', 'Regular', 'STELLA', NULL),
(779, 'Estibal', 'Zymer', '2023-07-31', 'Regular', 'STELLA', NULL),
(780, 'Gadian', 'Kristine', '2022-04-22', 'Regular', 'STELLA', NULL),
(781, 'Honorio', 'Lara Joy', '2023-05-22', 'Regular', 'STELLA', NULL),
(782, 'Labarosa', 'Stephen Bryan', '2022-07-26', 'Probationary', 'STELLA', NULL),
(783, 'Labos', 'Aira Joyce ', '2022-12-12', 'Probationary', 'STELLA', NULL),
(784, 'Napilay', 'John Christian', '2024-02-04', 'Probationary', 'STELLA', NULL),
(785, 'Patanao', 'Martin John', '2023-03-28', 'Regular', 'STELLA', NULL),
(786, 'Tajonera', 'Romagel', '2017-06-07', 'Regular', 'STELLA', NULL),
(787, 'Radjudin', 'Norama', '2024-04-09', 'Probationary', 'STELLA', NULL),
(788, 'Villaruz', 'Carl Angel', '2023-06-24', 'Probationary', 'STELLA', NULL),
(789, 'Anlap', 'Valent John', '2024-06-02', 'Probationary', 'STELLA', NULL),
(790, 'Dela cruz', 'Jeremy', '2024-05-22', 'Probationary', 'STELLA', NULL),
(791, 'Young', 'Kevin Ken', '2024-04-01', 'Probationary', 'STELLA', NULL),
(792, 'Veloso', 'Christine Mae', '2024-06-22', 'Probationary', 'STELLA', NULL),
(793, 'Ngalan', 'Jennieveb', '2024-07-13', 'Probationary', 'STELLA', NULL),
(794, 'Pabilona', 'Eira Faith', '2024-09-28', 'Probationary', 'STELLA', NULL),
(795, 'Sentil', 'Wendel', '2024-10-29', 'Probationary', 'STELLA', NULL),
(796, 'Aaron', 'Melanie Shieme', '2024-05-02', 'Probationary', 'DOIS', NULL),
(797, 'Altura', 'John Hyder', '2024-01-19', 'Regular', 'DOIS', NULL),
(798, 'Barredo', 'Christian Glen', '2024-01-20', 'Probationary', 'DOIS', NULL),
(799, 'Bayona', 'Vicente Jr.', '2024-04-24', 'Probationary', 'DOIS', NULL),
(800, 'Belgira', 'Mar John', '2023-01-21', 'Probationary', 'DOIS', NULL),
(801, 'Cenal', 'Patrick', '2024-11-28', 'Probationary', 'DOIS', NULL),
(802, 'Cordero', 'Spike Ian', '2024-11-28', 'Probationary', 'DOIS', NULL),
(803, 'Diaz', 'Flora Mae', '2024-05-10', 'Probationary', 'DOIS', NULL),
(804, 'Gavileño', 'Rizaldy', '2024-01-18', 'Regular', 'DOIS', NULL),
(805, 'Lencioco', 'Lyka', '2018-12-15', 'Probationary', 'DOIS', NULL),
(806, 'Malijoc', 'Micheal Jan', '2023-05-02', 'Regular', 'DOIS', NULL),
(807, 'Naparato', 'Shantily', '2019-02-18', 'Regular', 'DOIS', NULL),
(808, 'Palomo', 'Melboy', '2024-01-13', 'Regular', 'DOIS', NULL),
(809, 'Pragados', 'Mary Rose', '2019-03-17', 'Regular', 'DOIS', NULL),
(810, 'Tinasas', 'Jerry', '2024-04-01', 'Probationary', 'DOIS', NULL),
(811, 'Traña', 'Micheal', '2023-02-14', 'Probationary', 'DOIS', NULL),
(812, 'Valencia', 'Erwin Paul', '2023-02-28', 'Regular', 'DOIS', NULL),
(813, 'Hermogenes', 'Adrian', '2024-05-11', 'Regular', 'DOIS', NULL),
(814, 'Patriarca', 'Angie Lyn', '2024-08-16', 'Probationary', 'DOIS', NULL),
(815, 'Tajuela', 'John Peter', '2024-08-03', 'Probationary', 'DOIS', NULL),
(816, 'Vega', 'Vince  Chrisler', '2024-11-28', 'Probationary', 'DOIS', NULL),
(817, 'Abella', 'Randy', '2021-12-01', 'Regular', 'PUB', 'Main Office'),
(818, 'Alacrito', 'Genard', '2024-06-10', 'Probationary', 'PUB', 'Nina Food Products Trading'),
(819, 'Andrade', 'Remar', '2019-06-04', 'Regular', 'PUB', 'Nina Food Products Trading'),
(820, 'Batara', 'Moriel Raquel', '2024-07-23', 'Probationary', 'PUB', 'Main Office'),
(821, 'Billones', 'Ella', '2024-10-22', 'Probationary', 'PUB', 'Main Office'),
(822, 'Berber', 'Reina', '2023-06-03', 'Probationary', 'PUB', 'Main Office'),
(823, 'Calawigan', 'Jaime', '2017-05-05', 'Regular', 'PUB', 'Nina Food Products Trading'),
(824, 'Damasco', 'Realyn', '2025-11-12', 'Probationary', 'PUB', 'Main Office'),
(825, 'Emolaga', 'Genoveva', '2023-11-28', 'Regular', 'PUB', 'Pub Express Resto-Employers'),
(826, 'Gonzales', 'Roben', '2023-10-16', 'Probationary', 'PUB', 'Nina Food Products Trading'),
(827, 'Haudar', 'Jerlyn', '2018-07-05', 'Regular', 'PUB', 'Shock Sisig'),
(828, 'Ituriaga', 'Mary Queen', '2024-04-17', 'Regular', 'PUB', 'Main Office'),
(829, 'Mateo', 'Jun Mark', '2018-12-01', 'Regular', 'PUB', 'Pub Express Resto-Employers'),
(830, 'Moquete', 'Claribel', '2021-09-30', 'Regular', 'PUB', 'Main Office'),
(831, 'Palomo', 'Dean', '2021-06-24', 'Regular', 'PUB', 'Nina Food Products Trading'),
(832, 'Pasol', 'Priselle Anne', '2024-10-30', 'Probationary', 'PUB', 'Pub Express Resto-Employers'),
(833, 'Patino', 'Honey Vee', '2022-06-08', 'Probationary', 'PUB', 'Pub Express Resto-Employers'),
(834, 'Posadas', 'Lynie', '2021-06-15', 'Regular', 'PUB', 'Main Office'),
(835, 'Pusoc', 'Rhea Mae', '2022-09-26', 'Probationary', 'PUB', 'Nina Food Products Trading'),
(836, 'Rubido', 'Cherry Joy', '2023-09-15', 'Regular', 'PUB', 'Main Office'),
(837, 'Sarasola', 'Dungie', '2024-07-02', 'Probationary', 'PUB', 'Main Office'),
(838, 'Silveo', 'Stephanie Grace', '2022-08-23', 'Regular', 'PUB', 'Main Office'),
(839, 'Sunio', 'Hannah Grace', '2024-11-14', 'Probationary', 'PUB', 'Main Office'),
(840, 'Velagio', 'Evangeline', '2024-05-15', 'Probationary', 'PUB', 'Pub Express Resto-Employers'),
(841, 'Verdadero', 'Jose', '2022-06-06', 'Probationary', 'PUB', 'Nina Food Products Trading');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=842;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
