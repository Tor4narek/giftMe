-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 16 2022 г., 09:37
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `giftme`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `user_token` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `party_id` varchar(1000) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `user_token`, `name`, `email`, `password`, `party_id`, `date`) VALUES
(1, '11b3bb9a153c52ed9e88', '4e13cce9769e43bb375e79df9ea184aa', '674b571f278d03b0e3d9de78d28e8044', '9b2b34c8502622e7fccab2815fa9636c', '', NULL),
(2, '9c6b7364c70c3e772d96', '4e13cce9769e43bb375e79df9ea184aa', 'b1b7e3665b081e5c02301262be72b631', '9b2b34c8502622e7fccab2815fa9636c', '', NULL),
(3, '4a8b5a326f6306897999', '4e13cce9769e43bb375e79df9ea184aa', '9ba3ce3352ad267dc24256f4fdabac28', '9b2b34c8502622e7fccab2815fa9636c', '', NULL),
(5, 'd3c7ea0dfed677dc122e', '4e13cce9769e43bb375e79df9ea184aa', '70cf2a0826ac8a5e98934487270410de', 'e10adc3949ba59abbe56e057f20f883e', '', '2004-11-19'),
(8, 'e870e1b68d01a545d518', '0JXQs9C+0YA=', 'ZWtyZTRldG92QHlhbmRleC5ydQ==', '9b2b34c8502622e7fccab2815fa9636c', '0f69d5e90b', '2004-11-19'),
(9, '89d52e3602b52eb74de8', '0JLQsNC00LjQvA==', 'dmFkaW1AeWFuZGV4LnJ1', '827ccb0eea8a706c4c34a16891f84e7b', '00cb5c47fc', '1999-02-23');

-- --------------------------------------------------------

--
-- Структура таблицы `presents`
--

CREATE TABLE `presents` (
  `id` int(100) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `descr` varchar(1000) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `present_token` varchar(1000) NOT NULL,
  `link_title` varchar(1000) NOT NULL,
  `status` int(1) NOT NULL,
  `party_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `presents`
--

INSERT INTO `presents` (`id`, `title`, `descr`, `link`, `url`, `present_token`, `link_title`, `status`, `party_id`) VALUES
(5, 'Подарок 2', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', '123456', 'Купить подарок', 0, ''),
(6, 'Подарок 3', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', '12345645455', 'Купить подарок', 0, ''),
(15, 'Подарок 3', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', 'a68516251920b3bcd3ea', 'Ссылка на сайт', 0, '0f69d5e90b '),
(16, 'Подарок 4', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', 'e5c5e2206bd698d92403', 'Ссылка на сайт', 0, '0f69d5e90b '),
(17, 'Подарок 5', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', '9c5482ac337d58efbd2b', 'Ссылка на сайт', 0, '0f69d5e90b '),
(18, 'Подарок', 'Стоимость подписки первого года: 50$', 'https://www.jetbrains.com/ru-ru/webstorm/buy/#personal?billing=yearly', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/WebStorm_Icon.png/1024px-WebStorm_Icon.png', 'e25a1c0411500b4a3f08', 'Ссылка на сайт', 1, '00cb5c47fc ');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `present_token` varchar(1000) NOT NULL,
  `user_token` varchar(1000) NOT NULL,
  `party_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `present_token`, `user_token`, `party_id`) VALUES
(12, 'ZWtyZTRldG92QHlhbmRleC5ydQ==', '9b2b34c8502622e7fccab2815fa9636c', 'e25a1c0411500b4a3f08', 'b5261c9e4cca3d3376ef', '00cb5c47fc');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `presents`
--
ALTER TABLE `presents`
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
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `presents`
--
ALTER TABLE `presents`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
