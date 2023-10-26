-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 26 2023 г., 14:37
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
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_text` text DEFAULT NULL,
  `file_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_task`, `id_user`, `comment_text`, `file_path`) VALUES
(26, 17, 4, 'Пока что отложил, позже займусь', ''),
(27, 15, 4, 'схема Привет ', 'uploads/1698314687i.webp'),
(28, 19, 5, 'это мой первый комментарий', 'uploads/1698323167i.webp'),
(29, 12, 5, 'Привет всем пользователям', ''),
(30, 12, 4, 'Привет User4!', ''),
(31, 12, 4, '', 'uploads/1698323247i.webp'),
(32, 20, 8, 'Привет Это задача 5', ''),
(33, 21, 8, 'Это Мой комментарий и мой файл', 'uploads/1698323341i.webp'),
(34, 34, 13, 'Привет всем!', ''),
(35, 30, 13, 'Я хорошо сегодня поработал!', 'uploads/1698323492i.webp'),
(36, 34, 12, 'Привет, что сегодня делаем?', ''),
(37, 34, 13, 'Сегодня мы проверяем контрольные работы(((', '');

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
(11, 2, 'Разовая Задача 1', 'Описание Разовой Задачи 1', '2023-10-29', '2023-10-29', 2, 10, '4', 'В процессе', NULL),
(12, 2, 'Продолжительная Задача 1', 'Описание Продолжительной Задачи 1', '2023-10-30', '2023-10-30', 1, 5, '4, 5', 'В процессе', NULL),
(14, 2, 'Разовая Задача 2', 'Описание Разовой Задачи 2', '2023-11-03', '2023-11-03', 3, 2, '5', 'Только создано', NULL),
(15, 2, 'Продолжительная Задача 2', 'Описание Продолжительной Задачи 2', '2023-11-04', '2023-11-04', 1, 7, '4', 'Выполнено', ''),
(16, 3, 'Разовая Задача 3', 'Описание Разовой Задачи 3', '2023-11-16', '2023-11-16', 3, 5, '4, 5', 'Выполнено', ''),
(17, 3, 'Продолжительная Задача 3', 'Описание Продолжительной Задачи 3', '2023-11-17', '2023-11-17', 3, 9, '4', 'Выполнено', ''),
(18, 3, 'Разовая Задача 4', 'Описание Разовой Задачи 4', '2023-11-02', '2023-11-02', 1, 3, '5', 'Только создано', NULL),
(19, 3, 'Продолжительная Задача 4', 'Описание Продолжительной Задачи 4', '2023-11-23', '2023-11-23', 1, 10, '5', 'Выполнено', 'работа была сложная'),
(20, 6, 'Разовая Задача 5', 'Описание Разовой Задачи 5', '2023-11-12', '2023-11-12', 1, 2, '8', 'В процессе', NULL),
(21, 6, 'Продолжительная Задача 5', 'Описание Продолжительной Задачи 5', '2023-11-14', '2023-11-14', 2, 1, '8, 9', 'В процессе', NULL),
(22, 6, 'Разовая Задача 6', 'Описание Разовой Задачи 6', '2023-11-18', '2023-11-18', 3, 4, '9', 'Только создано', NULL),
(23, 6, 'Продолжительная Задача 6', 'Описание Продолжительной Задачи 6', '2023-12-12', '2023-12-12', 1, 6, '9', 'Только создано', NULL),
(24, 7, 'Разовая Задача 7', 'Описание Разовой Задачи 7', '2023-12-17', '2023-12-17', 3, 3, '8', 'Только создано', NULL),
(25, 7, 'Продолжительная Задача 7', 'Описание Продолжительной Задачи 7', '2023-12-21', '2023-12-21', 2, 1, '8', 'Выполнено', ''),
(26, 7, 'Разовая Задача 8', 'Описание Разовой Задачи 8', '2023-10-28', '2023-10-28', 3, 4, '8, 9', 'Выполнено', ''),
(27, 7, 'Продолжительная Задача 8', 'Описание Продолжительной Задачи 8', '2024-01-16', '2024-01-16', 2, 8, '8, 9', 'Выполнено', ''),
(28, 10, 'Разовая Задача 9', 'Описание Разовой Задачи 9', '2024-01-14', '2024-01-14', 1, 8, '12', 'Только создано', NULL),
(29, 10, 'Продолжительная Задача 9', 'Описание Продолжительной Задачи 9', '2024-01-29', '2024-01-29', 2, 4, '12, 13', 'Выполнено', 'Работа была сложная, но я ее сделал!'),
(30, 10, 'Разовая Задача 10', 'Описание Разовой Задачи 10', '2023-10-28', '2023-10-28', 3, 3, '13', 'В процессе', NULL),
(31, 10, 'Продолжительная Задача 10', 'Описание Продолжительной Задачи 10', '2024-02-06', '2024-02-06', 1, 5, '13', 'Только создано', NULL),
(32, 11, 'Разовая Задача 11', 'Описание Разовой Задачи 11', '2024-02-15', '2024-02-15', 2, 4, '13', 'Только создано', NULL),
(33, 11, 'Продолжительная Задача 11', 'Описание Продолжительной Задачи 11', '2024-02-17', '2024-02-17', 1, 2, '13', 'Выполнено', 'Больше не давайте мне таких заданий'),
(34, 11, 'Разовая Задача 12', 'Описание Разовой Задачи 12', '2024-02-21', '2024-02-21', 2, 2, '12, 13', 'В процессе', NULL),
(35, 11, 'Продолжительная Задача 12', 'Описание Продолжительной Задачи 12', '2024-02-22', '2024-02-22', 2, 10, '13', 'Выполнено', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role`, `login`, `password`, `email`) VALUES
(1, 1, 'admin', '$2y$10$Av7FolnonbzmzV7M5MmR.u9YqcfDj/W/l9LXu2aedQsemZjbKSM.6', 'admin@admin'),
(2, 2, 'user1', '$2y$10$zZhO1dt2Xxf5O33ICQ/7YeeFIE7iD/cgISvrXO51hTSJfEhrytLNW', 'user1@user1'),
(3, 2, 'user2', '$2y$10$34rcJMRTmOBuvrEUCOBfq.VrL6XtEsD/vpQ9e..Q4NSp6ponrtg4O', 'user2@user2'),
(4, 2, 'user3', '$2y$10$9XLkwC5gkFSMvjAo8ADb7ulS8ybjbQRZfpQ.XL31bVhIhmC8B/f9S', 'user3@user3'),
(5, 2, 'user4', '$2y$10$Ae9hbAVHVasfA6jEUuqHTOHCedH/kwrO.XJ8RP1SISJXIQxdfhdFC', 'user4@user4'),
(6, 2, 'user5', '$2y$10$aew67QMLDvKISDgiC9SzVOhXggkJPju6iRZLuodxocpO0GkO3InJe', 'user5@user5'),
(7, 2, 'user6', '$2y$10$kAsymz5yuoZf/MylwkuK1umKCX/qUqq0GhJGP95ZTm7uuqb9.Kp4a', 'user6@user6'),
(8, 2, 'user7', '$2y$10$x8koWDAvTRl77D65.TmGu.YdSTwD/IX.q2D1/kJSucD9iyPqpdJUy', 'user7@user7'),
(9, 2, 'user8', '$2y$10$X7iQGAM.Ydx0vtJBKYAi3OhFj.BpkNUY5WpQUPQPNY.Cm9lA5XTqK', 'user8@user8'),
(10, 2, 'user9', '$2y$10$iWSuIXSZpQZlc23CGMQwj.wPFmie5IJXGLO4N6LZgJ99l1uKQygP6', 'user9@user9'),
(11, 2, 'user10', '$2y$10$4L44iA9B/2hHh0T0g2vnBuY485wNRMiBYz3SzKiytvCQp06xBUhiy', 'user10@user10'),
(12, 2, 'user11', '$2y$10$rj1l3H42HycSefvOPts4Be992d7MnQqUlmQUmXRzhuBY/cvfGH8VW', 'user11@user11'),
(13, 2, 'user12', '$2y$10$lNusaS0S5dr0gOHqsXTbLu8WnR0h8Lua8UV.Xu0gfb7uKv96iTogW', 'user12@user12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
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
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
