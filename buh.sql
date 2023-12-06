-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2023 г., 17:47
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `buh`
--

-- --------------------------------------------------------

--
-- Структура таблицы `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `num_day` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `days`
--

INSERT INTO `days` (`id`, `num_day`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04'),
(5, '05'),
(6, '06'),
(7, '07'),
(8, '08'),
(9, '09'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15'),
(16, '16'),
(17, '17'),
(18, '18'),
(19, '19'),
(20, '20'),
(21, '21'),
(22, '22'),
(23, '23'),
(24, '24'),
(25, '25'),
(26, '26'),
(27, '27'),
(28, '28'),
(29, '29'),
(30, '30'),
(31, '31');

-- --------------------------------------------------------

--
-- Структура таблицы `info_buh`
--

CREATE TABLE `info_buh` (
  `id` int(11) NOT NULL,
  `version` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `info_buh`
--

INSERT INTO `info_buh` (`id`, `version`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `month`
--

CREATE TABLE `month` (
  `id` int(100) NOT NULL,
  `month` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month_num` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `month`
--

INSERT INTO `month` (`id`, `month`, `month_num`) VALUES
(1, 'Январь', '01'),
(2, 'Февраль', '02'),
(3, 'Март', '03'),
(4, 'Апрель', '04'),
(5, 'Май', '05'),
(6, 'Июнь', '06'),
(7, 'Июль', '07'),
(8, 'Август', '08'),
(9, 'Сентябрь', '09'),
(10, 'Октябрь', '10'),
(11, 'Ноябрь', '11'),
(12, 'Декабрь', '12');

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE `statistics` (
  `id` int(255) NOT NULL,
  `year_s` int(100) NOT NULL,
  `month_s` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_s` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coming` int(200) NOT NULL,
  `expenses` int(200) NOT NULL,
  `balance` int(200) NOT NULL,
  `type_s` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`id`, `year_s`, `month_s`, `day_s`, `coming`, `expenses`, `balance`, `type_s`, `comment`) VALUES
(38, 2023, '12', '06', 5000, 100, 4900, '1', 'Данные не указаны'),
(39, 2023, '12', '06', 0, 4000, -4000, '2', 'екек ек');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login_user` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_user` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_main` int(100) NOT NULL DEFAULT '2023',
  `month_main` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login_user`, `pass_user`, `year_main`, `month_main`) VALUES
(1, 'admin', '$2y$10$O/pMkenzeF1YZLm8w7VKJOXSBqawyPBMSsxCtdY42ryySI4z/w9YK', 2023, '12');

-- --------------------------------------------------------

--
-- Структура таблицы `years`
--

CREATE TABLE `years` (
  `id` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `year_actual` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `years`
--

INSERT INTO `years` (`id`, `year`, `year_actual`) VALUES
(1, 2023, 1),
(2, 2024, 0),
(3, 2025, 0),
(4, 2026, 0),
(5, 2027, 0),
(6, 2028, 0),
(7, 2029, 0),
(8, 2030, 0),
(9, 2031, 0),
(10, 2032, 0),
(11, 2033, 0),
(12, 2034, 0),
(13, 2035, 0),
(14, 2036, 0),
(15, 2037, 0),
(16, 2038, 0),
(17, 2039, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `info_buh`
--
ALTER TABLE `info_buh`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `info_buh`
--
ALTER TABLE `info_buh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `month`
--
ALTER TABLE `month`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `years`
--
ALTER TABLE `years`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
