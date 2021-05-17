-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 17 2021 г., 20:26
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cafe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `acquired_money`
--

CREATE TABLE `acquired_money` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `acquired_money`
--

INSERT INTO `acquired_money` (`id`, `user_id`, `menu_id`) VALUES
(4, 4, 2),
(9, 3, 2),
(10, 3, 3),
(11, 3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `acquired_points`
--

CREATE TABLE `acquired_points` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `acquired_points`
--

INSERT INTO `acquired_points` (`id`, `user_id`, `menu_id`) VALUES
(2, 3, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `path` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu_money`
--

CREATE TABLE `menu_money` (
  `id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `points_required` int(11) NOT NULL,
  `money_required` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_money`
--

INSERT INTO `menu_money` (`id`, `name`, `points_required`, `money_required`, `money`, `points`) VALUES
(1, 'Thunderhawk Egg', 30, 200, 20, 3),
(2, 'Fried Slime', 0, 0, 5, 1),
(3, 'Goblin\'s Thigh', 0, 10, 5, 1),
(4, 'Orc\'s meat', 5, 40, 15, 1),
(5, 'Eagle\'s meat', 50, 400, 35, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `menu_points`
--

CREATE TABLE `menu_points` (
  `id` int(11) NOT NULL,
  `name` varchar(24) NOT NULL,
  `points_required` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_points`
--

INSERT INTO `menu_points` (`id`, `name`, `points_required`, `points`) VALUES
(1, 'Dragon\'s egg', 1000, 30),
(2, 'Dragon\'s Tongue', 800, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL,
  `login` varchar(48) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(48) NOT NULL,
  `money` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `owner`, `login`, `password`, `email`, `money`, `points`, `avatar_id`) VALUES
(1, 0, 'Test1', '6779a4fa7ad34e7a8b78f20cbb6ce8a9', 'Test1@gmail.com', 0, 0, 0),
(2, 0, 'Test2', '830bf57205215d17a453cf5d8c8212ea', '', 0, 0, 0),
(3, 1, 'Test3', 'bd890f18b91394848bc8094675dc0fae', '', 320, 12140, 0),
(4, 1, 'Test4', 'a19e363ea0e2e612bbdad8e742f2ff7b', 'Test4@gmail.com', 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `acquired_money`
--
ALTER TABLE `acquired_money`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `acquired_money_ibfk_2` (`menu_id`);

--
-- Индексы таблицы `acquired_points`
--
ALTER TABLE `acquired_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acquired_points_ibfk_1` (`user_id`),
  ADD KEY `acquired_points_ibfk_2` (`menu_id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_money`
--
ALTER TABLE `menu_money`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_points`
--
ALTER TABLE `menu_points`
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
-- AUTO_INCREMENT для таблицы `acquired_money`
--
ALTER TABLE `acquired_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `acquired_points`
--
ALTER TABLE `acquired_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu_money`
--
ALTER TABLE `menu_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `menu_points`
--
ALTER TABLE `menu_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `acquired_money`
--
ALTER TABLE `acquired_money`
  ADD CONSTRAINT `acquired_money_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acquired_money_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu_money` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `acquired_points`
--
ALTER TABLE `acquired_points`
  ADD CONSTRAINT `acquired_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acquired_points_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu_points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
