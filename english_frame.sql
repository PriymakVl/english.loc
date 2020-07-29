-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 29 2020 г., 06:05
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `english_frame`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `phrases`
--

CREATE TABLE `phrases` (
  `id` int(11) NOT NULL,
  `engl` varchar(255) DEFAULT NULL,
  `ru` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `text_id` int(11) DEFAULT NULL,
  `sound_id` int(11) DEFAULT NULL,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sounds_old`
--

CREATE TABLE `sounds_old` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sounds_phrases`
--

CREATE TABLE `sounds_phrases` (
  `id` int(11) NOT NULL,
  `ru` varchar(100) DEFAULT NULL,
  `en` varchar(100) DEFAULT NULL,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sounds_words`
--

CREATE TABLE `sounds_words` (
  `id` int(11) NOT NULL,
  `ru` varchar(100) DEFAULT NULL,
  `en` varchar(100) DEFAULT NULL,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `texts`
--

CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `engl` text DEFAULT NULL,
  `ru` text DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` smallint(2) DEFAULT 1,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `engl` varchar(255) NOT NULL,
  `ru` varchar(255) NOT NULL,
  `sound_id` int(11) DEFAULT NULL,
  `status` smallint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `words_states`
--

CREATE TABLE `words_states` (
  `id` int(11) NOT NULL,
  `word_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `value` smallint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `phrases`
--
ALTER TABLE `phrases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sounds_old`
--
ALTER TABLE `sounds_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Индексы таблицы `sounds_phrases`
--
ALTER TABLE `sounds_phrases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `en` (`en`),
  ADD UNIQUE KEY `ru` (`ru`);

--
-- Индексы таблицы `sounds_words`
--
ALTER TABLE `sounds_words`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `engl` (`engl`);

--
-- Индексы таблицы `words_states`
--
ALTER TABLE `words_states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `phrases`
--
ALTER TABLE `phrases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=928;

--
-- AUTO_INCREMENT для таблицы `sounds_old`
--
ALTER TABLE `sounds_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2557;

--
-- AUTO_INCREMENT для таблицы `sounds_phrases`
--
ALTER TABLE `sounds_phrases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT для таблицы `sounds_words`
--
ALTER TABLE `sounds_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1809;

--
-- AUTO_INCREMENT для таблицы `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1822;

--
-- AUTO_INCREMENT для таблицы `words_states`
--
ALTER TABLE `words_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1802;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
