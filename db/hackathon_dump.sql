-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 25 2023 г., 18:08
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
  `due_date` date NOT NULL,
  `category` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `id_participant` text DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `id_owner`, `task_name`, `task_description`, `due_date`, `category`, `priority`, `id_participant`, `status`, `comment`) VALUES
(1, 2, 'Задача 1', 'Описание Задачи 1', '2023-10-26', 0, 6, '2', 'Выполнено', 'Комментарий к задаче/проекту'),
(2, 2, 'Задача 2', 'Описание Задачи 2', '2023-10-31', 0, 3, '3', 'Выполнено', NULL),
(3, 2, 'Задача 3', 'Описание Задачи 3', '2023-11-03', 3, 10, NULL, 'Только создано', NULL),
(4, 2, 'Задача 4', 'описание к Задаче 4', '2023-11-05', 2, 10, NULL, 'Только создано', NULL);

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
(3, 2, 0, 'user2', '$2y$10$34rcJMRTmOBuvrEUCOBfq.VrL6XtEsD/vpQ9e..Q4NSp6ponrtg4O', 'user2@user2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
