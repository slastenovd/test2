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
  `category_id` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `price` int(11) NOT NULL,
  `date_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ads` (`ad_id`, `private`, `seller_name`, `manager`, `email`, `allow_mails`, `phone`, `location_id`, `metro_id`, `category_id`, `title`, `description`, `price`, `date_change`) VALUES
(1,	1,	'Дмитрий',	'Иван иванов',	'ds_dimka@mail.ru',	0,	'+79622976146',	641520,	2025,	112,	'Suzuki Escudo',	'11111',	25563,	'2016-01-17 06:09:44'),
(3,	1,	'James Bond2',	'Дмитрий',	'Alex@alex.ru',	1,	'89622976146',	641510,	2017,	0,	'Автомобиль',	'кккее',	555,	'2016-01-17 04:43:50'),
(4,	1,	'Николай',	'Елена',	'',	1,	'666-666-000',	641510,	2017,	24,	'Квартира в центре',	'',	7,	'2016-01-17 04:48:30'),
(6,	1,	'Петр Николаевич',	'Николай Петрович',	'',	1,	'555-555-000',	641490,	2017,	11,	'Шкаф славянский',	'Шкаф',	100,	'2016-01-17 04:45:32');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(25) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`) VALUES
(1,	'Транспорт',	NULL),
(2,	'Недвижимость',	NULL),
(3,	'Работа',	NULL),
(4,	'Услуги',	NULL),
(5,	'Личные вещи',	NULL),
(6,	'Для дома и дачи',	NULL),
(7,	'Бытовая электроника',	NULL),
(8,	'Хобби и отдых',	NULL),
(9,	'Животные',	NULL),
(10,	'Для бизнеса',	NULL),
(11,	'Водный транспорт',	1),
(12,	'Запчасти и аксессуары',	1),
(13,	'Автомобили с пробегом',	1),
(14,	'Мотоциклы и мототехника',	1),
(19,	'Ремонт и строительство',	6),
(20,	'Мебель и интерьер',	6),
(21,	'Бытовая техника',	6),
(23,	'Комнаты',	2),
(24,	'Квартиры',	2),
(25,	'Дома, дачи, коттеджи',	2),
(26,	'Земельные участки',	2),
(27,	'Одежда, обувь, аксессуары',	5),
(28,	'Часы и украшения',	5),
(29,	'Детская одежда и обувь',	5),
(30,	'Товары для детей и игрушк',	5),
(31,	'Настольные компьютеры',	7),
(32,	'Аудио и видео',	7),
(33,	'Билеты и путешествия',	8),
(34,	'Велосипеды',	8),
(36,	'Коллекционирование',	8),
(38,	'Музыкальные инструменты',	8),
(39,	'Спорт и отдых',	8),
(40,	'Оборудование для бизнеса',	10),
(42,	'Коммерческая недвижимость',	2),
(81,	'Грузовики и спецтехника',	1),
(82,	'Продукты питания',	6),
(83,	'Книги и журналы',	8),
(84,	'Телефоны',	7),
(85,	'Гаражи и машиноместа',	2),
(86,	'Недвижимость за рубежом',	2),
(87,	'Посуда и товары для кухни',	6),
(88,	'Красота и здоровье',	5),
(89,	'Собаки',	9),
(90,	'Кошки',	9),
(91,	'Птицы',	9),
(92,	'Аквариум',	9),
(93,	'Другие животные',	9),
(94,	'Товары для животных',	9),
(96,	'Планшеты и электронные кн',	7),
(97,	'Игры, приставки и програм',	7),
(98,	'Ноутбуки',	7),
(99,	'Оргтехника и расходники',	7),
(101,	'Товары для компьютера',	7),
(102,	'Охота и рыбалка',	8),
(103,	'Знакомства',	8),
(105,	'Фототехника',	7),
(106,	'Растения',	6),
(109,	'Новые автомобили',	1),
(111,	'Вакансии',	3),
(112,	'Резюме',	3),
(114,	'Предложения услуг',	4),
(115,	'Запросы на услуги',	4),
(116,	'Готовый бизнес',	10);

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

-- 2016-01-17 06:10:22
