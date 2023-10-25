-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 25 2023 г., 22:23
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hackathon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Воспитательная работа'),
(2, 'Проектная работа'),
(3, 'Профориентированная работа');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_description` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `category` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `id_participant` text DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `id_owner`, `task_name`, `task_description`, `start_date`, `due_date`, `category`, `priority`, `id_participant`, `status`, `comment`) VALUES
(7, 2, 'Разовая Задача 1', 'Описание разовой задачи 1', '2023-10-26', '0000-00-00', 2, 10, '2', 'Только создано', NULL),
(8, 2, 'Продолжительная Задача 2', 'Описание продолжительной задачи 2', '2023-11-25', '2023-11-26', 1, 10, '4', 'Выполнено', NULL),
(9, 2, 'Разовая Задача 2', 'Описание разовой задачи 2', '2023-10-27', '2023-10-27', 3, 10, '2', 'Только создано', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role`, `id_group`, `login`, `password`, `email`) VALUES
(1, 1, 0, 'admin', '$2y$10$Av7FolnonbzmzV7M5MmR.u9YqcfDj/W/l9LXu2aedQsemZjbKSM.6', 'admin@admin'),
(2, 2, 0, 'user1', '$2y$10$zZhO1dt2Xxf5O33ICQ/7YeeFIE7iD/cgISvrXO51hTSJfEhrytLNW', 'user1@user1'),
(3, 2, 0, 'user2', '$2y$10$34rcJMRTmOBuvrEUCOBfq.VrL6XtEsD/vpQ9e..Q4NSp6ponrtg4O', 'user2@user2'),
(4, 2, 0, 'user3', '$2y$10$9XLkwC5gkFSMvjAo8ADb7ulS8ybjbQRZfpQ.XL31bVhIhmC8B/f9S', 'user3@user3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
