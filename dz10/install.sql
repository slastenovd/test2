-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `%database_name%`;
CREATE DATABASE `%database_name%` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `%database_name%`;

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `private` tinyint(4) NOT NULL DEFAULT '0',
  `seller_name` varchar(50) NOT NULL,
  `manager` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `allow_mails` tinyint(4) NOT NULL DEFAULT '0',
  `phone` varchar(15) NOT NULL,
  `location_id` int(11) NOT NULL,
  `metro_id` int(11) NOT NULL,
  `subcategory_id` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `price` int(11) NOT NULL,
  `date_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ads` (`ad_id`, `private`, `seller_name`, `manager`, `email`, `allow_mails`, `phone`, `location_id`, `metro_id`, `subcategory_id`, `title`, `description`, `price`, `date_change`) VALUES
(1,	0,	'Дмитрий',	'Иван иванов',	'ds_dimka@mail.ru',	1,	'+79622976146',	641800,	2025,	9,	'Suzuki Escudo',	'11111',	25563,	'2016-01-12 11:24:23'),
(3,	1,	'James Bond',	'Дмитрий',	'Alex@alex.ru',	1,	'89622976146',	641510,	2017,	9,	'Автомобиль',	'кккее',	555,	'2016-01-12 04:07:10'),
(4,	0,	'Николай',	'',	'',	1,	'',	641510,	2017,	24,	'Квартира в центре',	'',	7,	'2016-01-12 11:23:53'),
(5,	0,	'Владимир',	'Дмитрий',	'vova@kremlin.ru',	1,	'+7 988 877 23-3',	641520,	2017,	116,	'Нефть',	'',	2400,	'2016-01-12 11:22:59');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(25) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1,	'Транспорт'),
(2,	'Недвижимость'),
(3,	'Работа'),
(4,	'Услуги'),
(5,	'Личные вещи'),
(6,	'Для дома и дачи'),
(7,	'Бытовая электроника'),
(8,	'Хобби и отдых'),
(9,	'Животные'),
(10,	'Для бизнеса');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(20) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(641490,	' Барабинск'),
(641510,	' Бердск'),
(641520,	' Черепаново'),
(641600,	' Искитим'),
(641630,	' Колывань'),
(641680,	' Краснообск'),
(641710,	' Куйбышев'),
(641760,	' Мошково'),
(641780,	' Новосибирск'),
(641790,	' Обь'),
(641800,	' Ордынское'),
(641970,	' Бердск');

DROP TABLE IF EXISTS `metro_stations`;
CREATE TABLE `metro_stations` (
  `metro_station_id` int(11) NOT NULL AUTO_INCREMENT,
  `metro_station_name` varchar(25) NOT NULL,
  PRIMARY KEY (`metro_station_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `metro_stations` (`metro_station_id`, `metro_station_name`) VALUES
(2017,	'Заельцовская'),
(2018,	'Гагаринская'),
(2019,	'Красный проспект'),
(2020,	'Площадь Ленина'),
(2021,	'Октябрьская'),
(2022,	'Речной вокзал'),
(2023,	'Студенческая'),
(2024,	'Площадь Маркса'),
(2025,	'Площадь Гарина-Михайловск'),
(2026,	'Сибирская'),
(2027,	'Маршала Покрышкина'),
(2028,	'Берёзовая роща'),
(2029,	'Золотая Нива');

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(25) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subcategories` (`subcategory_id`, `category_id`, `subcategory_name`) VALUES
(9,	1,	'Автомобили с пробегом'),
(10,	1,	'Запчасти и аксессуары'),
(11,	1,	'Водный транспорт'),
(14,	1,	'Мотоциклы и мототехника'),
(19,	6,	'Ремонт и строительство'),
(20,	6,	'Мебель и интерьер'),
(21,	6,	'Бытовая техника'),
(23,	2,	'Комнаты'),
(24,	2,	'Квартиры'),
(25,	2,	'Дома, дачи, коттеджи'),
(26,	2,	'Земельные участки'),
(27,	5,	'Одежда, обувь, аксессуары'),
(28,	5,	'Часы и украшения'),
(29,	5,	'Детская одежда и обувь'),
(30,	5,	'Товары для детей и игрушк'),
(31,	7,	'Настольные компьютеры'),
(32,	7,	'Аудио и видео'),
(33,	8,	'Билеты и путешествия'),
(34,	8,	'Велосипеды'),
(36,	8,	'Коллекционирование'),
(38,	8,	'Музыкальные инструменты'),
(39,	8,	'Спорт и отдых'),
(40,	10,	'Оборудование для бизнеса'),
(42,	2,	'Коммерческая недвижимость'),
(81,	1,	'Грузовики и спецтехника'),
(82,	6,	'Продукты питания'),
(83,	8,	'Книги и журналы'),
(84,	7,	'Телефоны'),
(85,	2,	'Гаражи и машиноместа'),
(86,	2,	'Недвижимость за рубежом'),
(87,	6,	'Посуда и товары для кухни'),
(88,	5,	'Красота и здоровье'),
(89,	9,	'Собаки'),
(90,	9,	'Кошки'),
(91,	9,	'Птицы'),
(92,	9,	'Аквариум'),
(93,	9,	'Другие животные'),
(94,	9,	'Товары для животных'),
(96,	7,	'Планшеты и электронные кн'),
(97,	7,	'Игры, приставки и програм'),
(98,	7,	'Ноутбуки'),
(99,	7,	'Оргтехника и расходники'),
(101,	7,	'Товары для компьютера'),
(102,	8,	'Охота и рыбалка'),
(103,	8,	'Знакомства'),
(105,	7,	'Фототехника'),
(106,	6,	'Растения'),
(109,	1,	'Новые автомобили'),
(111,	3,	'Вакансии'),
(112,	3,	'Резюме'),
(114,	4,	'Предложения услуг'),
(115,	4,	'Запросы на услуги'),
(116,	10,	'Готовый бизнес');

-- 2016-01-12 11:27:11