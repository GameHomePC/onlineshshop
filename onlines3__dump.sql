-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Апр 03 2016 г., 06:48
-- Версия сервера: 5.5.48-cll
-- Версия PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `onlines3__dump`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `question` varchar(255) NOT NULL DEFAULT '',
  `answer` varchar(255) NOT NULL DEFAULT '',
  `sessID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`admID`),
  UNIQUE KEY `login` (`login`),
  KEY `sessID` (`sessID`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`admID`, `type`, `login`, `password`, `email`, `question`, `answer`, `sessID`, `time`, `IP`) VALUES
(1, 0, 'root', 'root', 'admin@domain.com', '', '', 3093951727, 1459684099, '94.112.182.219');

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `confID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(100) NOT NULL DEFAULT '',
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_author` varchar(100) NOT NULL DEFAULT '',
  `signature` text NOT NULL,
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0',
  `get_utf8` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `no_external` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `use_https` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `http_site_folder` varchar(255) NOT NULL DEFAULT '',
  `https_site_folder` varchar(255) NOT NULL DEFAULT '',
  `num_products_feat` int(10) unsigned NOT NULL DEFAULT '0',
  `num_articles` int(10) unsigned NOT NULL DEFAULT '0',
  `num_stories` int(10) unsigned NOT NULL DEFAULT '0',
  `num_news` int(10) unsigned NOT NULL DEFAULT '0',
  `num_news_feat` int(10) unsigned NOT NULL DEFAULT '0',
  `site_name` varchar(100) NOT NULL DEFAULT '',
  `contact_email` varchar(100) NOT NULL DEFAULT '',
  `auto_update_period` int(10) unsigned NOT NULL DEFAULT '0',
  `last_time_updating` int(10) unsigned NOT NULL DEFAULT '0',
  `last_time_updated` int(10) unsigned NOT NULL DEFAULT '0',
  `show_nav_line` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_nav_line_last` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cat_link_style` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `prd_link_style` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cat_name_to_url` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `prd_name_to_url` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `menu_prd_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_empty_cats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_cat_cols` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_cat_rows` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_cat_mid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_prd_big` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_not_load` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `use_wysiwyg` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_related_prds` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cat_show_spec` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cat_show_feat` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `first_page_prods` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `left_menu_style` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `export_portion` int(10) unsigned NOT NULL DEFAULT '0',
  `not_export_cats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_add_but` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `additional_percent` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `image_logo` varchar(50) NOT NULL DEFAULT '',
  `image_logo_old` varchar(50) NOT NULL DEFAULT '',
  `order_email` varchar(100) NOT NULL DEFAULT '',
  `descr_preview_num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`confID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`confID`, `meta_title`, `meta_keywords`, `meta_description`, `meta_author`, `signature`, `shop_id`, `get_utf8`, `no_external`, `use_https`, `http_site_folder`, `https_site_folder`, `num_products_feat`, `num_articles`, `num_stories`, `num_news`, `num_news_feat`, `site_name`, `contact_email`, `auto_update_period`, `last_time_updating`, `last_time_updated`, `show_nav_line`, `show_nav_line_last`, `cat_link_style`, `prd_link_style`, `cat_name_to_url`, `prd_name_to_url`, `menu_prd_count`, `show_empty_cats`, `img_cat_cols`, `img_cat_rows`, `img_cat_mid`, `img_prd_big`, `img_not_load`, `use_wysiwyg`, `show_related_prds`, `cat_show_spec`, `cat_show_feat`, `first_page_prods`, `left_menu_style`, `export_portion`, `not_export_cats`, `show_add_but`, `additional_percent`, `image_logo`, `image_logo_old`, `order_email`, `descr_preview_num`) VALUES
(1, 'Cool Shop', 'cool products', 'very cool shop', '', '', 112995, 1, 0, 0, '', '', 10, 20, 20, 20, 5, 'External Example Shop', 'contact@domain.com', 72, 1458552595, 1458552596, 1, 0, 1, 0, 1, 1, 0, 0, 3, 5, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 5, 'Healthcare', 'Cool Shop', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cstID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cstID`),
  UNIQUE KEY `email` (`email`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `file_size`
--

CREATE TABLE IF NOT EXISTS `file_size` (
  `obj_type` int(10) unsigned NOT NULL DEFAULT '0',
  `objID` int(10) unsigned NOT NULL DEFAULT '0',
  `num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obj_type`,`objID`,`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `file_size`
--

INSERT INTO `file_size` (`obj_type`, `objID`, `num`, `size`) VALUES
(2, 1727, 1, 2474),
(2, 1727, 2, 5085),
(2, 1727, 3, 5085),
(2, 1728, 1, 3881),
(2, 1728, 2, 8198),
(2, 1728, 3, 13226),
(2, 1730, 1, 2514),
(2, 1730, 2, 2514),
(2, 1730, 3, 5635),
(2, 1732, 1, 2050),
(2, 1732, 2, 4325),
(2, 1732, 3, 6965),
(2, 1737, 1, 3480),
(2, 1737, 2, 4799),
(2, 1737, 3, 4799),
(2, 1756, 1, 3519),
(2, 1756, 2, 7737),
(2, 1756, 3, 12085),
(2, 1757, 1, 3041),
(2, 1757, 2, 3041),
(2, 1757, 3, 6817),
(2, 1758, 1, 2514),
(2, 1758, 2, 2514),
(2, 1758, 3, 5635),
(2, 1759, 1, 2194),
(2, 1759, 2, 2194),
(2, 1759, 3, 4688),
(2, 1762, 1, 1109),
(2, 1762, 2, 2180),
(2, 1762, 3, 3257),
(2, 1763, 1, 3337),
(2, 1763, 2, 7077),
(2, 1763, 3, 11034),
(2, 1764, 1, 3490),
(2, 1764, 2, 7560),
(2, 1764, 3, 11941),
(2, 1772, 1, 1745),
(2, 1772, 2, 2831),
(2, 1772, 3, 4025),
(2, 1777, 1, 3480),
(2, 1777, 2, 4799),
(2, 1777, 3, 4799),
(2, 1780, 1, 5204),
(2, 1780, 2, 6987),
(2, 1780, 3, 6987),
(2, 1782, 1, 5204),
(2, 1782, 2, 6987),
(2, 1782, 3, 6987),
(2, 1783, 1, 4332),
(2, 1783, 2, 10919),
(2, 1783, 3, 13885),
(2, 1785, 1, 3480),
(2, 1785, 2, 4799),
(2, 1785, 3, 4799),
(2, 1786, 1, 3546),
(2, 1786, 2, 8152),
(2, 1786, 3, 13169),
(2, 1791, 1, 2829),
(2, 1791, 2, 4974),
(2, 1791, 3, 5773),
(2, 1794, 1, 3241),
(2, 1794, 2, 6090),
(2, 1794, 3, 8903),
(2, 1795, 1, 2776),
(2, 1795, 2, 5761),
(2, 1795, 3, 9404),
(2, 1799, 1, 1775),
(2, 1799, 2, 3769),
(2, 1799, 3, 5623),
(2, 1801, 1, 3888),
(2, 1801, 2, 8559),
(2, 1801, 3, 13862),
(2, 1803, 1, 3587),
(2, 1803, 2, 8417),
(2, 1803, 3, 13576),
(2, 1805, 1, 4991),
(2, 1805, 2, 12637),
(2, 1805, 3, 20646),
(2, 1806, 1, 5452),
(2, 1806, 2, 12792),
(2, 1806, 3, 20386),
(2, 1808, 1, 5428),
(2, 1808, 2, 12309),
(2, 1808, 3, 18950),
(2, 1812, 1, 6482),
(2, 1812, 2, 9553),
(2, 1812, 3, 9553),
(2, 1853, 1, 2040),
(2, 1853, 2, 3946),
(2, 1853, 3, 6162),
(2, 1861, 1, 1869),
(2, 1861, 2, 3778),
(2, 1861, 3, 5880),
(2, 1862, 1, 2349),
(2, 1862, 2, 5151),
(2, 1862, 3, 7994),
(2, 1865, 1, 1436),
(2, 1865, 2, 2869),
(2, 1865, 3, 4493),
(2, 1866, 1, 2284),
(2, 1866, 2, 4638),
(2, 1866, 3, 7280),
(2, 1869, 1, 1565),
(2, 1869, 2, 3127),
(2, 1869, 3, 4719),
(2, 1870, 1, 1081),
(2, 1870, 2, 2007),
(2, 1870, 3, 3083),
(2, 1871, 1, 2816),
(2, 1871, 2, 5829),
(2, 1871, 3, 9078),
(2, 1872, 1, 2410),
(2, 1872, 2, 4843),
(2, 1872, 3, 7435),
(2, 1873, 1, 1109),
(2, 1873, 2, 2180),
(2, 1873, 3, 3257),
(2, 1874, 1, 3583),
(2, 1874, 2, 7530),
(2, 1874, 3, 11091),
(2, 1875, 1, 1889),
(2, 1875, 2, 3919),
(2, 1875, 3, 6292),
(2, 1878, 1, 2526),
(2, 1878, 2, 4984),
(2, 1878, 3, 7788),
(2, 1879, 1, 4733),
(2, 1879, 2, 10295),
(2, 1879, 3, 16265),
(2, 1880, 1, 2865),
(2, 1880, 2, 5857),
(2, 1880, 3, 8950),
(2, 1881, 1, 1149),
(2, 1881, 2, 2332),
(2, 1881, 3, 14681),
(2, 1883, 1, 3829),
(2, 1883, 2, 8163),
(2, 1883, 3, 11951),
(2, 1884, 1, 2351),
(2, 1884, 2, 4467),
(2, 1884, 3, 7009),
(2, 1885, 1, 2346),
(2, 1885, 2, 4824),
(2, 1885, 3, 7479),
(2, 1886, 1, 4206),
(2, 1886, 2, 8401),
(2, 1886, 3, 12997),
(2, 1887, 1, 3246),
(2, 1887, 2, 6425),
(2, 1887, 3, 22105),
(2, 2142, 1, 3480),
(2, 2142, 2, 4799),
(2, 2142, 3, 4799),
(2, 2145, 1, 5204),
(2, 2145, 2, 6987),
(2, 2145, 3, 6987),
(2, 2146, 1, 1880),
(2, 2146, 2, 3500),
(2, 2146, 3, 5080),
(2, 2149, 1, 4500),
(2, 2149, 2, 10154),
(2, 2149, 3, 16854),
(2, 2150, 1, 4372),
(2, 2150, 2, 9314),
(2, 2150, 3, 14209),
(2, 2151, 1, 3809),
(2, 2151, 2, 8027),
(2, 2151, 3, 13023),
(2, 2158, 1, 3460),
(2, 2158, 2, 7218),
(2, 2158, 3, 11130),
(2, 2159, 1, 2424),
(2, 2159, 2, 5124),
(2, 2159, 3, 7975),
(2, 2160, 1, 1442),
(2, 2160, 2, 2634),
(2, 2160, 3, 3919),
(2, 2161, 1, 2661),
(2, 2161, 2, 5642),
(2, 2161, 3, 8569),
(2, 2164, 1, 1442),
(2, 2164, 2, 2634),
(2, 2164, 3, 3919),
(2, 2165, 1, 3747),
(2, 2165, 2, 8744),
(2, 2165, 3, 14657),
(2, 2166, 1, 3101),
(2, 2166, 2, 6774),
(2, 2166, 3, 11296),
(2, 2167, 1, 2802),
(2, 2167, 2, 5935),
(2, 2167, 3, 9795),
(2, 2168, 1, 4098),
(2, 2168, 2, 9580),
(2, 2168, 3, 15746),
(2, 2169, 1, 2730),
(2, 2169, 2, 6684),
(2, 2169, 3, 11378),
(2, 2684, 1, 4274),
(2, 2684, 2, 9736),
(2, 2684, 3, 15651),
(2, 7901, 1, 6114),
(2, 7901, 2, 12979),
(2, 7901, 3, 14093),
(2, 10374, 1, 2873),
(2, 10374, 2, 3364),
(2, 10374, 3, 5171),
(2, 933944, 1, 2364),
(2, 933944, 2, 2364),
(2, 933944, 3, 5134),
(2, 933945, 1, 2474),
(2, 933945, 2, 2474),
(2, 933945, 3, 5085),
(2, 933946, 1, 5846),
(2, 933946, 2, 5846),
(2, 933946, 3, 32049),
(2, 1061430, 1, 7088),
(2, 1061430, 2, 2194),
(2, 1061430, 3, 22259),
(2, 1061431, 1, 1852),
(2, 1061431, 2, 1852),
(2, 1061431, 3, 3706),
(2, 1061434, 1, 1395),
(2, 1061434, 2, 2620),
(2, 1061434, 3, 2620),
(2, 1061435, 1, 2364),
(2, 1061435, 2, 5134),
(2, 1061435, 3, 5134),
(2, 1064184, 1, 11458),
(2, 1064184, 2, 18073),
(2, 1064184, 3, 38415),
(2, 1064209, 1, 6482),
(2, 1064209, 2, 9553),
(2, 1064209, 3, 9553),
(2, 1064210, 1, 11039),
(2, 1064210, 2, 17717),
(2, 1064212, 1, 8287),
(2, 1064212, 2, 12314),
(2, 1064212, 3, 12314),
(2, 1064213, 1, 6448),
(2, 1064213, 2, 9542),
(2, 1064213, 3, 9542),
(2, 1064214, 1, 6448),
(2, 1064214, 2, 9542),
(2, 1064214, 3, 9542),
(2, 1064219, 1, 6448),
(2, 1064219, 2, 9542),
(2, 1064219, 3, 9542),
(2, 1064220, 1, 6459),
(2, 1064220, 2, 9782),
(2, 1064220, 3, 9782),
(2, 1138029, 1, 2173),
(2, 1138029, 2, 13748),
(2, 1138029, 3, 14235);

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `lnkID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `url_js` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`lnkID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mailing_emails`
--

CREATE TABLE IF NOT EXISTS `mailing_emails` (
  `emlID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `unsubscribed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`emlID`),
  UNIQUE KEY `email` (`email`),
  KEY `time` (`time`,`active`,`unsubscribed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mailing_templates`
--

CREATE TABLE IF NOT EXISTS `mailing_templates` (
  `tplID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `html` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `template` text NOT NULL,
  PRIMARY KEY (`tplID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mailing_templates`
--

INSERT INTO `mailing_templates` (`tplID`, `name`, `html`, `subject`, `template`) VALUES
(1, 'templ1', 1, 'Hello', 'Hello, <%NAME%>.<br />\r\nI want your money<br />\r\n<br />\r\n<%LINK%>');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `nwsID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `archive` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`nwsID`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sc_category`
--

CREATE TABLE IF NOT EXISTS `sc_category` (
  `catID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parID` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `url_name` varchar(255) NOT NULL DEFAULT '',
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`catID`),
  KEY `parID` (`parID`,`priority`,`catID`),
  KEY `active` (`active`),
  KEY `url_name` (`url_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45346 ;

--
-- Дамп данных таблицы `sc_category`
--

INSERT INTO `sc_category` (`catID`, `parID`, `active`, `priority`, `name`, `comment`, `meta_title`, `meta_keywords`, `meta_description`, `url_name`, `uplID`, `title`, `description`) VALUES
(72, 0, 1, 1, 'Drug Test Dips Multi 2,3,5,6,9,10,12 Panels', 'Drug tests, drug testing and tests', 'DRUG TEST - quality drug testing products from Mrs. Test', 'drug test, drug testing, drug test kits, drug tests, marijuana test, marijuana testing, urine drug test, hair drug test', 'Online drugstore offers easy to use rapid drug test kits for law enforcement, industry, schools, rehabilitation facilities and parental home testing.', '', 0, 'Drug tests, drug testing and tests', '<p>Multi Panel Drug testing can detect a number of drugs  present in a urine sample in any combination. The Multi-Drug urine testing kits  is easy to conduct and can be performed without using any additional  instrument. It adheres to SAMHSA cut-off levels of drug concentration. Multi Panel Drug testing can detect commonly abused drugs like Cocaine, Amphetamine,  Methamphetamine, Marijuana (THC), Opiates, Phencyclidine, Barbiturate,  Benzodiazepine, Methadone, and Ecstasy metabolites in urine. The results are  easy to read, accurate and displayed within a period of 5 minutes.</p>\n<p>The multi-panel drug testing can test for presence of number  of drugs in a single sample of urine at first attempt itself. The presence of  10-12 drugs can be known in a single attempt rather than separately testing for  each drug thereby saving a lot of time. A multi-panel urine testing is  beneficial when multiple substance presence has to be known quickly.  Multi-panel urine testing is very effective when randomly tested. With random  testing there are very less chances for a person to clear if he abused to more  than one drug, as wide range of drugs are tested. The multi-panel urine testing  can also be used for on-site testing as it gives quick results.</p>\n<p>Thus, multi-panel urine drug test increases the efficiency  of the test, which can find multiple drugs presence at single time. However,  multi-panel urine tests only provide preliminary analytical results. More  advanced methods like Gas Chromatography-Mass Spectrometry (GCMS) can be used  for confirmatory purposes.</p>'),
(45342, 0, 1, 2, 'Single Urine Drug Tests', '', 'Single Urine Drug Tests', 'single drug test,urine drug test,drug test,drug testing,drug screen,drug screening', 'We have different types of single drug test kits for the most commonly abused drugs like Marijuana, Cocaine, Opiates (Heroin, Morphine, and Codeine), Amphetamines (Amphetamine, Methamphetamine), Phencyclidine (PCP) and other.', '', 0, 'Single Urine Drug Tests', 'Single Urine Drug Tests\n\n<p>There are various methods to check for drug abuse by an  individual. The urine drug testing is the most reliable and simple to perform.  We have different types of single drug test kits for the most commonly abused  drugs like Marijuana, Cocaine, Opiates (Heroin, Morphine, and Codeine),  Amphetamines (Amphetamine, Methamphetamine), Phencyclidine (PCP) and other. </p>\n<p>  The detection period for drug abuse depends on the pH level  of the urine sample. The detection period of Marijuana is 2-3 days for single  use and 12 days for chronic abuse. For Cocaine, it is 2-4 days (it may vary if  there are any kidney disorders). The detection period for opiate drugs like  Heroin, Morphine, and Codeine is 2-4 days. The detection period for Amphetamine  and Methamphetamine is 2-4 days and 3-5 days respectively. The detection period  of Phencyclidine (PCP) is 7-14 days for single use and 30 days for chronic  abuse.</p>'),
(45343, 0, 1, 3, 'Laboratory Tests Hair,Saliva,Urine', '', 'Laboratory tests and confirmations for Hair,Saliva and Urine Tests.', 'gcms drug test,lcms drug testing,hair follicle,hair drug test,urine lab drug test,urine drug test confirmation,saliva drug test,saliva drug test confirmation', 'Laboratory based drug testing- This is the type of testing conducted by the vast majority of employers in the United States. Laboratory drug testing services are available for the different substances, like: urine, oral fluid and hair.', '', 0, 'Lboratory Tests Hair,Saliva,Urine', 'Laboratory tests and confirmations for Hair,Saliva and Urine Tests.\n\n<p>Laboratory based drug testing- This is the type of testing  conducted by the vast majority of employers in the United States. Laboratory  drug testing services are available for the different substances, like: urine,  oral fluid and hair.</p>\n<p>  The urine drug testing involves collecting a urine sample  and sending this sample to a Certified drug testing laboratory. Once received  at the laboratory an initial test is conducted to detect the presence of drugs  above a standard threshold level. If no tested drugs are detected above the  threshold level, the sampling is complete and the &quot;negative&quot; results  are sent to the company. If any tested drugs are detected above the threshold  level, the sample moves on to confirmation testing. This testing will determine  the quantitative level of the drug and is then reported to the company as a  &quot;positive&quot; if it exceeds the standard threshold level.</p>\n<p>  Hair follicle testing- This is another extremely efficient  method of detecting even the smallest traces of many different kinds of drugs.  The hair follicle testing, also known as hair drug testing, has many benefits  over other methods of testing. First, it ensures higher accuracy as compared to  urine samples because hair generally tends to stay in human body for much  longer period than urine. Thus, it can detect any drug intake ranging from  sixty to ninety days. Second, sample collection is less invasive as compared to  urine sample collection. The hair strands are tested in the laboratory and  results can be obtained in one to three days. It''s efficient enough to test  many different kinds of drugs.</p>'),
(45344, 0, 1, 4, 'Drug Testing Cups', '', 'Drug Test Cup for onsite drugs of abuse screening', 'drug cups,test cups,screen cup,drug test cup,drug screening cup', 'Drug Testing- Cups -  Products NEW Categories Drug Testing- Cups', '', 0, 'Drug Testing Cups', 'Drug Testing cups from 5 to 14 drugs of abuse.\n\n<p>One of the easiest to use onsite testing products on the market now comes in  a fully integrated drug screening cup for easy drugs testing.<br><br>\n  Our integrated urine drug test cup delivers instant, accurate results and  process convenience, including a fast and accurate screening results without  touching the specimen. Our self-contained urinalysis screening cups detects the  presence of drug metabolites in minutes, using SAMHSA cutoff levels.</p>'),
(45345, 0, 1, 5, 'Saliva Drug Tests', '', 'Saliva drug test | Oral drug test | Saliva Drug Testing', 'saliva drug test, oral drug test, saliva drug testing, screening, saliva tests, oral tests, marijuana test, testing kits, home, tests, kit, kits', 'Saliva drug testing is useful in scenarios where urine drug testing isn’t. Saliva drug testing is proven useful in detecting the drug use of automobile drivers and victims after a road accident.', '', 0, 'Saliva Drug tests', 'Saliva drug tests\n\n<p>A saliva test is  incredibly user friendly. The collection of saliva could be attained in public  areas. Cheating test is tough, since you can gather the sample with the  individual. Using some quick testing packages, collecting sample is simple and  the results acquired rapidly without lab. In comparison, a blood test might  need sample collection by a healthcare specialist and screening in lab  substantially generating up the expenses and the time required. So when you buy  a home drug test which uses saliva as the sample you can be assured you''re not  throwing money away. Since the process is non-invasive, both employees and  companies feel relaxed when executing test.</p>\n<p>Saliva drug testing is  known as an on-site drug monitoring tool. Its matrix of benefits provides a  certain niche where saliva drug testing is more advantageous over the  traditional urine drug tests. Saliva drug tests is gaining relevance for  employers who seek efficient and current drug monitoring that employs a  non-invasive approach and quick results.</p>\n<p>The advantages of  saliva drug testing over urine drug testing are multi-dimensional. First,  saliva drug tests are very donor friendly as compared to urine extraction or  blood sample monitoring. With a quick dash of padded sample collector, an  employee can be tested quickly and without much of a hassle. Saliva drug  testing is pain free and quick to administer so that employees can go about  their business without missing a step.</p>'),
(75, 0, 1, 7, 'Alcohol Tests', 'Alcohol tests', 'Alcohol test, alcohol testing and tests', 'alcohol testing', 'alcohol testing', '', 0, 'Alcohol tests', '<p>Whether we like it, or not, alcohol is part of human lives. There are many \n  false statements about the benefits, or otherwise of alcohol in many countries \n  and societies. Alcohol in reasonable doses is good for you, say some. Alcohol, \n  even in small quantities affects your ability to think and act coherently, say \n  others. Alcohol is a cause in 50% of lethal car accidents. Alcohol is responsible \n  for almost a half of accidents at work.. </p>\n<p>Drinking alcohol socially could be fun. Drinking alcohol on one''s own is almost \n  always a cause for becoming an alcoholic. In the USA different states have different \n  legal limits for alcohol consumption. Exceeding these is breaking the law. </p>\n<p>There are several different ways of detecting the volume of alcohol in human \n  body substances. Our <b>alcohol tests</b> are proven, reliable, efficient and \n  helpful. Alcohol is the most traditional drug in history. There is a certain \n  tolerance to alcohol in human society. And our tests provide tested tools to \n  make tradition comply with the rule of law and and save lives on the road, in \n  the family, at school and work.</p>'),
(115, 0, 1, 8, 'Xalex Drug Testing Kits', '', 'Xalex Drug Testing Kits', 'Xalex Drug Testing Kits', 'Xalex, the supreme quality of drug testing kits available on the market.', '', 0, 'Xalex Drug Testing Kits', 'We are committed to establishing a premier branded line of drug testing products. Our primary focus is the creation of Xalex, the supreme quality of drug testing kits available on the market. We are always enhancing our comprehensive line of drug test kits, by actively searching the marketplace, thus offering our distributors and customers the utmost in selection of the highest quality products available.'),
(77, 0, 1, 10, 'Forensic Tests', 'Forensic tests', 'Forensic Test Kits for DNA Identification, Explosives Detection, or Surface Drug Test Kits, and fire case investigations.', '', '', '', 0, 'Forensic tests', 'The Forensic testing devices uses the most advanced methods for analyzing specimens. DNA Identification, Explosives Detection, or Surface Drug Test Kits will be helpful for all your forensic needs. Excellence at the forensic test kits is recognized by both defense and prosecution agencies, seeking expertise that is timely, accurate, confidential and provided in a manner that is both clear and concise.\nForensic Tests are convenient for a private criminality''s specializing in the analysis, identification and interpretation of evidence associated with the investigation of civil and criminal cases. Forensic Test Kits was created over a decade ago and has been committed to assembling experienced and highly respected manufacturers. We are maintained the generalist focus on forensic test kits for a many different directions, as a  while continuing to develop state-of-the-art products in such specialty areas in DNA Identification, Explosives Detection, or Surface Drug Test Kits, and fire case investigations. The group also could assists attorneys with the development of cross-examination questions and pre-trial discovery support.'),
(73, 0, 1, 14, 'Pregnancy Tests', 'Pregnancy tests', 'Pregnancy test, testing and pregnancy tests', 'pregnancy symptoms', 'pregnancy symptoms', '', 0, 'Pregnancy tests', 'Pregnancy is a very important time in the life of a woman, her partner, and a \nfamily. We offer <b>pregnancy test</b> allowing to detect a small amount of a \ncertain hormone, hCG, which gives you an early and accurate result. 20 mIUs is \nconsidered to be the lowest level in the home pregnancy tests market. Our pregnancy \ntest allows you to learn whether you are pregnant as early as a week after conception. \nOur <b>pregnancy test</b> is easy to use in the comfort of your house, with the \nconfidentiality and privacy your house can offer.'),
(74, 0, 1, 16, 'Ovulation Tests', 'Ovulation tests', 'Ovulation test predictor and tests', 'ovulation predictor', 'ovulation predictor', '', 0, 'Ovulation tests', 'There is a hormone called LH (Luteinizing hormone), which is always present in the body in small quantity but surges around the middle of the menstrual cycle when it is released by the pituary gland in a bigger quantity than at any other time in the menstrual cycle. The surge lasts for up to 3 days, and this is the time when a woman is likely to ovulate. Most women ovulate 36 hours after the surge. The surge in LH is evident first in the blood, and then, some 8-12 hours later, it is detected in the urine. Ovulation Predictor tests predict with a 99% accuracy when an LH surge is taking place which is an indicator of a potential ovulation.'),
(81, 0, 1, 18, 'Disease Tests', 'Infections tests', 'Disease tests', 'Blood test', 'blood test', '', 0, 'Infections tests', '<p>Over half a million of American people live with HIV. 5% per cent of Americans \n  have been infected with the hepatitis B. About 2% have been infected with hepatitis \n  C. Infectious diseases could be detected by analyzing blood and urine. Devices \n  like cassettes and strips are used to detect the presence of infection in a \n  human body.</p>\n<p>These are effective, fast and confidential tests offering information on people''s \n  health, namely indicating the presence of HIV and Hepatitis C, and tests to \n  detect common and potentially risky conditions like increased levels of Cholesterol, \n  and Allergies which adversely affect the quality of life.</p>\n<p>These tests offer laboratory quality, and convenience and comfort of taking \n  them in the confidential home environment.</p>'),
(80, 0, 1, 20, 'Monitoring Devices', 'Monitoring devices', 'Blood pressure monitor, thermometer', 'thermometer', 'thermometer', '', 0, 'Monitoring devices', '<p>Time has become one of the more precious commodities in modern world. We want \n  to use this time conveniently and comfortably, and if possible, in the relaxed \n  surroundings of our homes. </p>\n<p>To this effect we have invented a lot of devices, tools, methods and facilities. \n  People have decided that they may save time by doing some things at home. For \n  instance, they might carry out testing at home. Not definitive testing, just \n  screening but it alerts us to many potentially unpleasant developments. </p>\n<p>We have monitoring devices that check our <b>glucose</b> and <b>cholesterol \n  level</b>, allergy disposition, <b>hepatitis presence</b>, <b>ovulation </b>potential \n  and confirm<b> pregnancy symptoms </b>- all at home. It''s not a new phenomenon: \n  people started diagnosing themselves and finding remedies long before medical \n  professions came into being. There are self-healers in the Bible. Ancient Egyptians \n  invented scale to keep a close watch on their weight - for aesthetic and health \n  reasons.</p>'),
(188, 0, 1, 22, 'Accessories', '', 'Accessories', 'Heating Packs, herbal packs, accessories', 'Our Packs provide safe, natural relief for: Back Pain, Mental Stress, Carpal Tunnel Syndrome, Strains, Sprains, Bruises, Muscle Pain, Menstrual Cramps, Sports Injuries, Neck Aches, Sinus Pressure, Insomnia and more...', '', 0, 'Accessories, heating packs, herbal packs', 'Our Packs provide safe, natural relief for: Back Pain, Mental Stress, Carpal Tunnel Syndrome, Strains, Sprains, Bruises, Muscle Pain, Menstrual Cramps, Sports Injuries, Neck Aches, Sinus Pressure, Insomnia and more...<br />\n<br />\nOur Herbal Packs are used by: Massage Therapists, Athletes, Acupuncturists, Chiropractors, Personal Trainers, Skiers, Hikers, Runners, anybody who likes to relax and rid themselves of pains and stress.');

-- --------------------------------------------------------

--
-- Структура таблицы `sc_category_newval`
--

CREATE TABLE IF NOT EXISTS `sc_category_newval` (
  `catID` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `url_name` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`catID`),
  KEY `url_name` (`url_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sc_category_prod`
--

CREATE TABLE IF NOT EXISTS `sc_category_prod` (
  `catID` int(10) unsigned NOT NULL DEFAULT '0',
  `prdID` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`,`prdID`),
  KEY `prdID` (`prdID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sc_category_prod`
--

INSERT INTO `sc_category_prod` (`catID`, `prdID`) VALUES
(72, 1730),
(72, 1732),
(72, 1757),
(72, 1758),
(72, 1759),
(72, 1799),
(72, 1853),
(72, 1861),
(72, 1862),
(72, 1871),
(72, 1872),
(72, 1874),
(72, 1883),
(72, 1884),
(72, 1885),
(72, 2159),
(72, 2161),
(72, 1061430),
(72, 1061431),
(73, 1737),
(73, 1777),
(73, 1780),
(73, 1853),
(73, 2142),
(73, 2145),
(73, 2161),
(73, 1064209),
(73, 1138029),
(74, 1772),
(74, 1782),
(74, 1783),
(74, 1785),
(74, 1786),
(74, 1853),
(74, 2146),
(74, 2161),
(74, 1138029),
(75, 1763),
(75, 1764),
(75, 2161),
(75, 1064210),
(77, 1728),
(77, 1756),
(77, 1801),
(77, 1803),
(77, 1886),
(77, 2149),
(77, 2150),
(77, 2151),
(77, 2161),
(77, 933946),
(77, 1064220),
(80, 1786),
(80, 1791),
(80, 1794),
(80, 1795),
(81, 2161),
(81, 7901),
(81, 1064212),
(81, 1138029),
(115, 1853),
(115, 1872),
(115, 2161),
(115, 2165),
(115, 2166),
(115, 2167),
(115, 2168),
(115, 2169),
(115, 1061431),
(188, 1805),
(188, 1806),
(188, 1808),
(188, 2684),
(45342, 1762),
(45342, 1812),
(45342, 1853),
(45342, 1865),
(45342, 1866),
(45342, 1869),
(45342, 1870),
(45342, 1871),
(45342, 1872),
(45342, 1873),
(45342, 1875),
(45342, 1881),
(45342, 2160),
(45342, 2161),
(45342, 2164),
(45342, 2167),
(45342, 1061431),
(45342, 1061434),
(45343, 1727),
(45343, 1879),
(45343, 933945),
(45344, 1880),
(45344, 2158),
(45344, 2161),
(45344, 10374),
(45344, 933944),
(45344, 1061435),
(45344, 1064184),
(45344, 1064213),
(45344, 1064214),
(45344, 1064219),
(45345, 1878),
(45345, 1887),
(45345, 2161);

-- --------------------------------------------------------

--
-- Структура таблицы `sc_category_stat`
--

CREATE TABLE IF NOT EXISTS `sc_category_stat` (
  `catID` int(10) unsigned NOT NULL DEFAULT '0',
  `n_prod` int(10) unsigned NOT NULL DEFAULT '0',
  `n_prod_all` int(10) unsigned NOT NULL DEFAULT '0',
  `last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `has_new` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sc_category_stat`
--

INSERT INTO `sc_category_stat` (`catID`, `n_prod`, `n_prod_all`, `last_time`, `has_new`) VALUES
(72, 19, 19, 1310961600, 0),
(73, 9, 9, 1336017600, 0),
(74, 9, 9, 1336017600, 0),
(75, 4, 4, 1313726400, 0),
(77, 11, 11, 1314244800, 0),
(80, 4, 4, 1095310800, 0),
(81, 4, 4, 1336017600, 0),
(115, 9, 9, 1310961600, 0),
(188, 4, 4, 1116475200, 0),
(45342, 18, 18, 1311048000, 0),
(45343, 3, 3, 1294030800, 0),
(45344, 10, 10, 1314158400, 0),
(45345, 3, 3, 1095307200, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sc_list`
--

CREATE TABLE IF NOT EXISTS `sc_list` (
  `lstID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `products` text NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `col` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `all_pages` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `categories` text,
  PRIMARY KEY (`lstID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sc_manufacturer`
--

CREATE TABLE IF NOT EXISTS `sc_manufacturer` (
  `mnfID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`mnfID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `sc_manufacturer`
--

INSERT INTO `sc_manufacturer` (`mnfID`, `uplID`, `name`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(5, 0, 'HAHC', 'http://www.homeaccess.com', '', '', '', ''),
(3, 0, 'wwmed', 'www.wwmed.com', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `sc_manufacturer_newval`
--

CREATE TABLE IF NOT EXISTS `sc_manufacturer_newval` (
  `mnfID` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `url_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mnfID`),
  KEY `url_name` (`url_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sc_product`
--

CREATE TABLE IF NOT EXISTS `sc_product` (
  `prdID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `time_available` int(10) unsigned NOT NULL DEFAULT '0',
  `in_stock` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_new` tinyint(3) unsigned DEFAULT NULL,
  `mnfID` int(10) unsigned NOT NULL DEFAULT '0',
  `model` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `price_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price_type_new` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `spec_time1` int(10) unsigned NOT NULL DEFAULT '0',
  `spec_time2` int(10) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `spec_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `opt1` int(10) unsigned NOT NULL DEFAULT '0',
  `price1` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `spec_price1` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `opt2` int(10) unsigned NOT NULL DEFAULT '0',
  `price2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `spec_price2` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `measure` varchar(50) NOT NULL DEFAULT '',
  `dimensions` varchar(100) NOT NULL DEFAULT '',
  `weight` decimal(10,3) unsigned NOT NULL DEFAULT '0.000',
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `uplID1` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID2` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID3` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID4` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID5` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID6` int(10) unsigned NOT NULL DEFAULT '0',
  `doc1` varchar(50) NOT NULL DEFAULT '',
  `docID1` int(10) unsigned NOT NULL DEFAULT '0',
  `doc2` varchar(50) NOT NULL DEFAULT '',
  `docID2` int(10) unsigned NOT NULL DEFAULT '0',
  `doc3` varchar(50) NOT NULL DEFAULT '',
  `docID3` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `attributes` text NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `num_choosed` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  `product_updated` tinyint(4) NOT NULL,
  PRIMARY KEY (`prdID`),
  KEY `active` (`active`,`time_available`),
  KEY `active_2` (`active`,`is_new`),
  KEY `price_type_new` (`price_type_new`,`priority`,`is_new`),
  KEY `priority` (`priority`),
  KEY `num_choosed` (`num_choosed`,`price_type_new`,`priority`),
  KEY `is_new` (`is_new`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1138030 ;

--
-- Дамп данных таблицы `sc_product`
--

INSERT INTO `sc_product` (`prdID`, `active`, `priority`, `time_available`, `in_stock`, `is_new`, `mnfID`, `model`, `url`, `price_type`, `price_type_new`, `spec_time1`, `spec_time2`, `price`, `spec_price`, `opt1`, `price1`, `spec_price1`, `opt2`, `price2`, `spec_price2`, `measure`, `dimensions`, `weight`, `meta_title`, `meta_keywords`, `meta_description`, `uplID1`, `uplID2`, `uplID3`, `uplID4`, `uplID5`, `uplID6`, `doc1`, `docID1`, `doc2`, `docID2`, `doc3`, `docID3`, `name`, `comment`, `description`, `attributes`, `quantity`, `num_choosed`, `last_modified`, `product_updated`) VALUES
(1727, 1, 0, 1095307200, 1, 0, 0, 'DA-HRT', '', 0, 0, 0, 0, '71.95', '0.00', 5, '66.45', '0.00', 10, '63.95', '0.00', '', '', '0.150', 'Drug Hair Follicular Test Kit', 'hair drug test hair test kit hair drug testing kit', 'Drug Hair Testing Kit', 2541, 2542, 2543, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Hair Follicular Test Kit', '', '<ul>\n<li>Result provided by CAP accredited Laboratory \n<li>90-day detection period \n<li>Resistance to evasion \n<li>Non-intrusive sample collection \n<li>Cost effectiveness\n</ul>\n\nThe test kit includes:\n<ul>\n<li>Hair follicular drug test specimen pouch \n<li>Specimen bag \n<li>Self-addressed envelope \n<li>Instruction \n<li>Chain of custody federal form \n\nAttention\nPlease follow the instructions carefully in filing out the Chain of Custody form and preparing the specimen. If any mistakes are made, the laboratory will not be able to perform the test, and we will not held responsible.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 5 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$54.95      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 10 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$49.95\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$47.95ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 112, 1397749165, 1),
(1728, 1, 0, 1095307200, 1, 0, 0, 'DA-DTNM', '', 0, 0, 0, 0, '39.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.250', 'Marijuana Drug Test', 'Detect Now For Marijuana Drug Test', 'Detect Now For Marijuana Drug Test', 2544, 2545, 2546, 0, 0, 0, '', 0, '', 0, '', 0, 'Detect Now For Marijuana Drug Test', '', 'Detect Now Marijuana Test is aerosol drug test for detection & identification of THC. Using special drug wipes, you simply wipe or touch the suspected surface or substance, then spray the drug wipes. You''ll receive very accurate results in seconds. \n\nEach Detect Now Marijuana Test kit includes:\n<ul>\n<li>a spray kit, \n<li>10 separate test papers, \n<li>complete directions, FAQ, "What to do", and a resource list.\n</ul>\n\nThis drug test is very accurate and there''s no lab required. This is the same drug test, which is used by law enforcement agencies. And the best thing is that you have the advantage of testing with or without the knowledge of the person being tested.', '', 1000002, 43, 1407856875, 1),
(1730, 1, 0, 1095307200, 1, 0, 0, 'DA-5PND', '', 1, 1, 0, 0, '5.50', '0.00', 10, '5.15', '0.00', 25, '4.95', '0.00', '', '', '0.050', '5 Panel Multi Drug Urine Test Kit (THC/COC/AMP/OPI/PCP)', '5 Panel Multi Drug Urine Test Kit (THC/COC/AMP/OPI/PCP)', '5 Panel Multi Drug Urine Test Kit (THC/COC/AMP/OPI/PCP)', 2547, 2548, 2549, 0, 0, 0, '', 0, '', 0, '', 0, '5 Panel Multi Drug Urine Test Kit (THC/COC/AMP/OPI/PCP)', '', 'The 5 Panel Multi Drug Urine Test Kit (THC/COC/AMP/OPI/PCP) is maybe the finest multi drug test kit; whether you are testing yourself or somebody else you are concerning. It is extremely effortless to use and really precise and rapid one-step multi drug test kit. That 5-Panel Drug test kit detects mainly frequent illegal drugs as: THC (marijuana), Cocaine (Crack), Methamphetamine (Ecstasy), Amphetamine, Opiates (Morphine), and PCP (Angel Dust).\nThe 5-Panel Multi-Drug Screen Test from MrsTest.Com, detects 5 different drug categories, displaying 5 separate results. The 5 Panel Multi Drug Urine Test Kit must be dipped in urine and removed. After 5 minutes, results are displayed in each of 5 Results Windows. \n2 Red Lines = Negative. \n1 Red Line = Preliminary Positive.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.50     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.15\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.95 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 4211, 1389897049, 1),
(1732, 1, 0, 1095307200, 1, 0, 0, 'DA-3POP', '', 0, 0, 0, 0, '4.13', '0.00', 10, '3.83', '0.00', 24, '3.53', '0.00', '', '', '0.050', 'Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI', 'Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI', 'Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI', 2550, 2551, 2552, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI', '', 'Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI is a great value combination test, FDA approved urine one-step, rapid drug test kit, detecting 3 most common drugs: Cocaine, Marijuana, Morphine and Heroin in one urine sample. This 3 panel drug screening device offers the ultimate in combination and cost. Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI could detect drug use in a time frame of drugs and their metabolites presence in urine according to scientific researches.\n\nSimply remove the cover and dip into the sample to screen for the 3 drug groups. Drug Test 3 - Panel Screen Urine Kit THC/COC/OPI supplied with full and easy to follow instructions. \n\nResults in 5 minutes.\n\n2 Red Lines = Negative. \n\n1 Red Line = Preliminary Positive.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.13     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$3.83      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$3.53 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 490, 1389897049, 1),
(1737, 1, 0, 1095307200, 1, 0, 0, 'PR-5MS', '', 1, 1, 0, 0, '9.95', '8.50', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.200', 'Midstream Pregnancy Tests (Pack of Five)', 'Midstream Pregnancy Tests (Pack of Five)', 'Midstream Pregnancy Tests (Pack of Five)', 2553, 2554, 2555, 0, 0, 0, '', 0, '', 0, '', 0, 'hCG Midstream Pregnancy Tests (Pack of Five)', '', 'Lowest Price on Internet !\nEarly home Pregnancy test in midstream detects the hormone hCG at the 20mIUs level. In the early pregnancy testing market, 20mIUs level is the lowest which means the most sensitive. This means that you can find out whether or not you are pregnant in just 6-7 days after conception.\nThis early pregnancy test is 99% accurate and is officially approved by FDA. \n\nIt''s easy-to-use and has simple test instructions. The results are ready in 2-5 minutes! Each pregnancy test is packaged individually in a sterile, and pouch bag.\n\nThis value pack includes 5 tests.\n\nShelf life - 2 years.\n\n\n<br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b></br>', '', 1000000, 87, 1389897049, 1),
(1756, 1, 0, 1095307200, 1, 0, 0, 'DA-DTNC', '', 0, 0, 0, 0, '38.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.250', 'Home drug test for cocaine', 'drug test cocaine crack', 'Detect Now Cocaine/Crack Test is an aerosol-based drug test for detection & identification of crack/cocaine.', 2556, 2557, 2558, 0, 0, 0, '', 0, '', 0, '', 0, 'Detect Now Spray Cocaine/Crack Drug Test', '', 'Detect Now Cocaine/Crack Test is an aerosol drug test for detection of crack/cocaine. Using special drug wipes, you just simply wipe or touch the suspected surface or substance, then spray the drug wipes. The very accurate results are ready in seconds. This is the same drug test, which is used by law enforcement agencies. And the best thing is that you have the advantage of testing with or without the knowledge of the person being tested.\n\nEach Detect Now Cocaine/Crack Test kit includes:\n<ul>\n<li>A spray kit \n<li>10 separate test papers, \n<li>complete instructions, FAQ, "What to do" and a resource list. \n</ul>\n\nNo lab is required! You get the results of the drug test within a few seconds!', '', 1000000, 91, 1389897049, 1),
(1757, 1, 0, 1095307200, 1, 0, 0, 'DA-10P', '', 0, 0, 0, 0, '6.95', '0.00', 10, '6.65', '0.00', 25, '6.25', '0.00', '', '', '0.070', '10 Panel Multi Drug Urine Test Kit', 'home drug test urine', 'Detection of THC/Marijuana, cocaine, Benzoylecgonine, PCP (Phencyclidine), Morphine and its related metabolites derived from Opium in human urine', 2559, 2560, 2561, 0, 0, 0, '', 0, '', 0, '', 0, '10 Panel Multi Drug Urine Test Kit', '', 'We are in the business of helping to eliminate one of our society''s most dangerous and pervasive problems: drug abuse. Drug use in America has become epidemic. It affects, directly or indirectly, all of us. In the workplace, productivity suffers, quality control is affected and workers'' safety is jeopardized. In families, it robs our children of their youth, vitality, health and future. \n\nThe detection of drugs of abuse is the first line of defense in the war against drugs. And drug testing also provides the most effective deterrent against drug use. \n\nWe offer a powerful weapon in the drug war - The Urine Multi-Drug 10 Panel Test - it is a forensic, all inclusive, point of use screening test for the rapid detection of carboxylic acid (THC/Marijuana), cocaine and its metabolite, Benzoylecgonine, PCP (Phencyclidine), Morphine and its related metabolites derived from Opium (opiates), Methamphetamines (including Ecstasy), Methadone, PCP (Angel Dust, Amphetamines, Barbiturates, TCA (Tricyclic Antidepressant) and Benzodiazepines in human urine at or above the system concentrations levels established as standard minimums by the National Institute on Drug Abuse (NIDA), the World Health Organization (WHO) and Substance Abuse and Mental Health Services Administration (SAMHSA). \n\nThe sensitivity is equal to or greater than the cut-off level for the specific drug. \n\nOur test kit is easy-to-use and inexpensive. You get negative results in 2 minutes, and positive results in 10 minutes. \n\nEach test kit is packaged individually in a sterile and pouch bag.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.95      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.65\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.25ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 2712, 1389897049, 1),
(1758, 1, 0, 1095307200, 1, 0, 0, 'DA-5PA', '', 0, 0, 0, 0, '5.50', '0.00', 10, '5.15', '0.00', 25, '4.95', '0.00', '', '', '0.060', '5 Panel Multi Drug Urine Test Kit (THC/COC/MET/OPI', '5 Panel Multi Drug Urine Test Kit (THC/COC/MET/OPI/AMP)', 'The 5 Panel Multi Drug Urine Test Kit (THC/COC/MET/OPI/AMP) is an easy, fast, qualitative, visually read competitive binding immunoassay method for screening without the need of instrumentation.', 2562, 2563, 2564, 0, 0, 0, '', 0, '', 0, '', 0, '5 Panel Multi Drug Urine Test Kit (THC/COC/MET/OPI/AMP)', '', 'The Multi Drug 5-Panel Drug Test Kit Urine is perhaps one of the best at home multi-drug test kit, whether you are testing yourself or somebody you are concerned about. It is very easy to use and extremely accurate and quick multi drug test kit. That 5-Panel Drug test kit cover most common illegal drugs as: THC (marijuana), Cocaine (Crack), Methamphetamine (Ecstasy), Amphetamine, Opiates (Morphine) and PCP (Angel Dust).\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.50     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.15\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.95 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000013, 2780, 1389897049, 1),
(1759, 1, 0, 1095307200, 1, 0, 0, 'DA-6P', '', 0, 0, 0, 0, '6.25', '0.00', 10, '5.95', '0.00', 25, '5.75', '0.00', '', '', '0.060', '6 Panel Urine Multi Drug Test Kit (COC/AMP/M-AMP/T', '6 Panel Urine Multi Drug Test Kit (COC/AMP/M-AMP/T', 'Easy, fast, qualitative, visually read competitive binding immunoassay method for screening without the need of instrumentation', 2565, 2566, 2567, 0, 0, 0, '', 0, '', 0, '', 0, '6 Panel Urine Multi Drug Test Kit (COC/AMP/M-AMP/THC/OPI/BZD)', '', 'The Multi Drug 6-Panel Drug Urine Test is a simple and precise one step rapid drug test kit, qualitative detection of cocaine, amphetamines, methamphetamines (ecstasy), opiates (heroin, morphin), tetrahydrocannabinol (marijuana, hashish), and BZD (Valium) drug testing in urine.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.25     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.95\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.75 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity\n\nIt is exactly the same test as used by officials and human resource departments.', '', 999989, 1548, 1389897049, 1),
(1762, 1, 0, 1095307200, 1, 0, 0, 'DA-SMS', '', 0, 0, 0, 0, '1.64', '0.00', 10, '1.29', '0.00', 25, '0.99', '0.00', '', '', '0.020', 'Cannabis THC Marijuana Dip Strip Drug Urine Test', 'Marijuana drug test', 'The THC (Marijuana) drug test marijuana is based on the principle of the highly specific immunochemical reactions between antigens and antibodies, which are used for the analysis of specific substances in biological fluids.', 2568, 2569, 2570, 0, 0, 0, '', 0, '', 0, '', 0, 'Cannabis THC Marijuana Dip Strip Drug Urine Test', '', 'THC (9-tetrahydrocannabinol) is the primary active ingredient in cannabinoids (marijuana). When ingested or smoked, it produces euphoric effects. Users have impairment of short-term memory and THC use slows learning. Also, it may cause \ntransient episodes of confusion, anxiety, or even frank toxic delirium. Long term, relatively heavy use may be associated with behavioral disorders. The peak effect of smoking THC occurs in 20-30 minutes and the duration is 90-120 minutes after one cigarette. Elevated levels of urinary metabolites are found within hours of exposure and remain detectable for 3-10 days after smoking. The main metabolite excreted in the urine is 11-nor- 9-tetrahydrocannabinol-9-carboxylic acid.\n\nThe THC (Marijuana) drug test marijuana is based on the principle of the highly specific immunochemical reactions between antigens and antibodies, which are used for the analysis of specific substances in biological fluids. The cutoff of the test is 50 ng/ml of THC. It is the same as the SAMHSA (The Substance Abuse and Mental Health Services Administration) recommended assay cutoff.\n\nThe THC test kit contains the following items to perform the assay:\n<ul>\n<li>THC test strip.\n<li>Instructions for use.\n<li>It''s very fast, reliable and inexpensive. You get the results in 3 to 5 minutes at the comfort of your home.\n<li>Each test kit is packaged individually in a sterile and pouch bag.\n</ul<body bgcolor="#ffffff">\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 5 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 10 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.29\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.99ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999549, 8766, 1389897049, 1),
(1763, 1, 0, 1095307200, 1, 0, 0, 'AL-STD', '', 1, 1, 0, 0, '2.95', '0.00', 10, '2.50', '0.00', 25, '2.39', '0.00', '', '', '0.020', 'Alcohol testing', 'Alcohol testing', 'Our Alcohol Saliva test is the simplest, most cost effective method of monitoring for alcohol consumption in your ZERO TOLERANCE testing program.', 2571, 2572, 2573, 0, 0, 0, '', 0, '', 0, '', 0, 'Alcohol Saliva Test - DOT Approved', '', 'The United States Department of Transportation (DOT) has determined that individuals with a commercial drivers license and those in safety sensitive occupations must not exceed the "zero tolerance" level (alcohol concentrations above 0.02%).\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.95  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.50      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.39 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity\n\nBeginning in 1996, all transportation and safety sensitive employers will be required to comply with the DOT''s alcohol testing regulations.\n\nOur Alcohol Saliva test is the simplest, most cost effective method of monitoring for alcohol consumption in your ZERO TOLERANCE testing program. \nThis Alcohol Saliva test is so effective that it has been tested and approved by the US Department of Transportation (DOT) for required testing of all transportation and safety sensitive employees for blood alcohol concentrations above the federally mandated zero tolerance level of 0.02%.\n\nAs the concentration of alcohol in saliva is very close to that in the blood, for that reason Alcohol Saliva test is more accurate than the other types of tests. It identifies the alcohol levels greater than 0.02% and works in a clean, non-invasive manner and provides results in 4 minutes. \n\nAlcohol Saliva test can be used at any time, anywhere in their individual and disposable package. Simply wet the test pad with your saliva, and get results in 4 minutes. No need for laboratory analysis.\n\nEach test kit is packaged individually in a sterile pouch bag.\n\nThis test is for forensic use only\n\nThe designation of "for forensic use only" means that the substance abuse test is not FDA 510k Cleared. These types of tests are successfully used by law enforcement, correction and probation departments.\n\nBe sure to be legal and if you need to have FDA 510K cleared status, buy the following:\n\nAlcohol Breathalyzer AlcoMate CA2000\n\nAll urine drug testing kits (except QTEST-12 urine drugs screen cup) \n\nAlcoHawk Breathalyzer\n\n\n\nNote: FDA 510k Clearance by itself does not make legal substance abuse testing procedure. Anyway, in case you get a positive test result with any instant drug testing devices, you need to confirm it with accredited. Additionally, make sure that you fill-out properly the Chain of Custody Form.', '', 999938, 3651, 1389897049, 1),
(1764, 1, 0, 1095307200, 1, 0, 0, 'AL-ST', '', 0, 0, 0, 0, '2.85', '0.00', 5, '2.60', '0.00', 24, '2.10', '0.00', '', '', '0.020', 'Alcohol testing Saliva Screen Test Kit', 'Alcohol testing Saliva', 'Our Alcohol Saliva test is intended for use as a rapid, highly sensitive alcohol test to detect the presence of alcohol in saliva and to provide an approximation of blood alcohol concentration.', 2574, 2575, 2576, 0, 0, 0, '', 0, '', 0, '', 0, 'Alcohol Saliva Screen Test', '', 'The concentration of alcohol in saliva is very close to that in the blood, for that reason it is more accurate than the other types of tests. Our Alcohol Saliva test is intended for use as a rapid, highly sensitive alcohol test to detect the presence of alcohol in saliva and to provide an approximation of blood alcohol concentration. It may also be used to non-quantitatively detect the presence of alcohol in many other fluids, such as soft drinks, blood serum, water, etc. \nIt was designed and patented in 1988 as a simple, cost-effective solution to screen for alcohol concentrations. With over 10 million tests, our test has proven to be the leading alcohol screening device in the field. Alcohol Saliva test is very sensitive because it indicates alcohol levels from 0.02% to 0.30% and requires no instrumentation or training.\n\nSaliva test can be used at any time, anywhere each in its individual and disposable package. Just wet the test pad with your saliva, and get results in 2 minutes. No need for laboratory analysis.\n\nEach test kit is packaged individually in a sterile pouch bag.\n\nThis test is for forensic use only\n\nThe designation of "for forensic use only" means that the substance abuse test is not FDA 510k Cleared. These types of tests are successfully used by law enforcement, correction and probation departments.\n\nBe sure to be legal and if you need to have FDA 510K cleared status, buy the following:\n\nAlcohol Breathalyzer AlcoMate CA2000\n\nAll urine drug testing kits (except QTEST-12 urine drugs screen cup) \n\nAlcoHawk Breathalyzer\n\n\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.85  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-23 Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.60\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.10 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999973, 1228, 1389897049, 1),
(1772, 1, 0, 1095307200, 1, 0, 0, 'OV-10SS', '', 1, 1, 0, 0, '17.90', '6.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.750', 'Ovulation Test Strips', 'Ovulation Test Strips', 'This one-step Ovulation Test predicts when there is a LH (luteinizing hormone) surge, and in turn, when you are likely to ovulate.', 2577, 2578, 2579, 0, 0, 0, '', 0, '', 0, '', 0, 'Ovulation Test Strips - Pack of Ten (10)', '', 'The One Step home Ovulation Dipstrip Test will help you find the time when you are most able to become pregnant. It can help you plan your pregnancy.\n\nYou may do this test at any time of the day, but you should test at approximately the same time each day. Reduce your liquid intake for 2 hours before testing.\n\nTo decide when to begin testing, determine the length of your normal menstrual cycle. The length of your cycle is from the beginning of one period to the beginning of the next (count the first day of bleeding or spotting as day 1).\n\nIf your cycle length is irregular, that is, if it varies by more than a few days each month, take the average number of days for the last 3 months. Use the chart to work out the day you should begin testing. The day you begin testing is listed opposite the number of days in your normal cycle.\n\nEach test is packaged individually in a sterile pouch bag. \n\nTest Kit includes: \n  10 tests.\n  Shelf life - 2 years.', '', 1000000, 77, 1438018639, 1),
(1777, 1, 0, 1095307200, 1, 0, 0, 'PR-SMS', '', 0, 0, 0, 0, '1.65', '0.00', 10, '1.59', '0.00', 25, '1.39', '0.00', '', '', '0.050', 'hCG Pregnancy Midstream Urine Test', 'Pregnancy Midstream Urine Test', 'hCG Pregnancy Midstream Urine Test', 2580, 2581, 2582, 0, 0, 0, '', 0, '', 0, '', 0, 'hCG Pregnancy Midstream Urine Test', '', 'Pregnancy Midstream Urine Test is an immunochromatographic assay designed for qualitative determination of human chorionic gonadotropin (hCG) in urine for early detection of pregnancy.\n\n<ul>\n  <li> Midstream is the most convenient formats for pregnancy tests</li>\n</ul>\n<ul>\n  <li> Test takes less than 5 minutes</li>\n</ul>\n<ul>\n  <li>Level of hCG as low as 20- 25 mlU/mL can be detected</li>\n</ul>\n\nHow home pregnancy test works:\nHuman chorionic gonadotropin is a glycopeptide hormone produced by the placenta during pregnancy. The appearance and rapid rise in the concentration of hCG in the woman''s urine makes it a good pregnancy marker. Usually, concentration of hCG in urine is at least 25 mIU/ml as early as seven to ten days after conception. \nThe concentration increases steadily and reaches its maximum between the eighth and eleventh weeks of pregnancy.\n\nFDA Approved and recommended by doctors.<br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b><br />\n\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.65  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.59      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.39 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>The shopping cart will adjust with quantity', '', 1000000, 37, 1389897049, 1),
(1780, 1, 0, 1095307200, 1, 0, 0, 'PR-SS', '', 0, 0, 0, 0, '0.99', '0.00', 10, '0.79', '0.00', 25, '0.49', '0.00', '', '', '0.020', 'hCG Pregnancy Dipstrip Urine Test', 'Pregnancy Dipstrip Urine Test', 'hCG Pregnancy Dipstrip Urine Test', 2583, 2584, 2585, 0, 0, 0, '', 0, '', 0, '', 0, 'hCG Pregnancy Dipstrip Urine Test', '', '<ul>\n  <li>It is one of the most inexpensive and accurate early pregnancy tests</li>\n</ul>\n<ul>\n  <li> Highly accurate and quick to detect pregnancy</li>\n</ul>\n<ul>\n  <li>Test takes 3 - 5 minutes</li>\n</ul>\n<ul>\n  <li>Level of hCG as low as 20 - 25 mlU/mL can be detected</li>\n</ul>\n<ul>\n  <li>FDA Approved and Doctors recommended<br>\n  </li>\n</ul>\n\nHow an early home pregnancy test works:\nWhen a woman becomes pregnant, her body produces a hormone called hCG (human Chorionic Gonadotropin). This hormone appears in the urine. The secretion of this hormone increases throughout the first trimester. Human chorionic gonadotropin (hCG) is a glycoprotein hormone secreted by the developing placenta shortly after fertilization. In normal pregnancy, hCG can be detected in serum as early as 7 days following conception, doubling every 1.3 to 2 days and reading 100 mlU/ml at the first missed menstrual period. The appearance of hCG soon after conception and its subsequent rise in concentration during early gestational growth make it an excellent marker for the early detection of pregnancy. \n\nOneStep Dipstick Pregnancy Test is a qualitative, sandwich dye conjugate immunoassay for the determination of human hCG in urine. The method employs a unique combination of monoclonal and polyclonal antibodies to selectively identify hCG in test samples with a high degree of sensitivity. In less than 5 minutes, elevated levels of hCG as low as 20 - 25 mlU/mL can be detected.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.99  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.79\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.49 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity\n\n<br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b>', '', 1000000, 552, 1389897049, 1),
(1782, 1, 0, 1095307200, 1, 0, 0, 'OV-SS', '', 0, 0, 0, 0, '0.70', '0.00', 10, '0.60', '0.00', 25, '0.49', '0.00', '', '', '0.020', 'LH Ovulation Dipstrip Urine Test', 'LH Ovulation Dipstrip Urine Test', 'LH Ovulation Dipstrip Urine Test', 2586, 2587, 2588, 0, 0, 0, '', 0, '', 0, '', 0, 'Dipstrip LH Ovulation Urine Test', '', 'The One Step Urine Ovulation LH Test will help you find the time when you are most able to become pregnant. It can help you plan your pregnancy.\n\nHow this home test works:\nThe One Step ovulation test will help you find the time when you are most able to become pregnant. It can help you plan your pregnancy. Luteinizing hormone(LH) is always present in human urine. It increases just before a woman most fertile day of the month. This LH increase triggers ovulation. During ovulation an egg is released from the ovary. Because the egg can be fertilized only 12 to 36 hours after ovulation, detecting ovulation in advance is very important.\n\nYou may do this test at any time of the day, but you should test at approximately the same time each day. Reduce your liquid intake for 2 hours before testing. \n\nTo decide when to begin testing, determine the length of your normal menstrual cycle. The length of your cycle is from the beginning of one period to the beginning of the next (count the first day of bleeding or spotting as day 1). \n\nIf your cycle length is irregular, that is, if it varies by more than a few days each month, take the average number of days for the last 3 months. Use the chart to work out the day you should begin testing. The day you begin testing is listed opposite the number of days in your normal cycle.\n\nThis product is recommended for a professional use.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.70  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.60      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.49 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999814, 462, 1389897049, 1),
(1783, 1, 0, 1095307200, 1, 0, 0, 'OV-KIT', '', 0, 0, 0, 0, '9.49', '0.00', 3, '25.80', '0.00', 5, '41.00', '0.00', '', '', '0.150', '7 Days Ovulation Prediction Test Kit', 'Ovulation Predictor Kit in a Box', '7 Days Ovulation Predictor Kit in a Box', 2589, 2590, 2591, 0, 0, 0, '', 0, '', 0, '', 0, '7 Days Ovulation Prediction Test Kit', '', 'Ovulation Predictor Test Kit predicts the time a woman is most able to become pregnant. The Ovulation Predictor is a kit to predict ovulation, thereby increasing chances of pregnancy. Ovulation Predictor is over 99% accurate in laboratories and greater than 96% accurate in consumer home. It quickly and accurately detects the increase in luteinizing hormone in your urine (LH Surge), which normally occurs 12-36 hours before ovulation.You are most likely to become pregnant if you have intercourse within 36 hours after you detect your LH Surge. \n\nThe Ovulation Predictor is simple to use, and has enough test kits for seven days. With the Ovulation Predictor Test Kit, you may do this test at any time of the day, but you should test at approximately the same time each day. Reduce your liquid intake for 2 hours before testing.\n\nOvulation tests is very easy to read: one line tells you the test is working. The appearance of a second line that is similar or darker in color than the first line means that you should ovulate within 12-36 hours.\n\nOvulation Predictor Test Kit includes:\n<ul>\n  <li> 6 Ovulation predictor tests </li>\n</ul>\n<ul>\n  <li>1 pregnancy test </li>\n</ul>\n<ul>\n  <li>Ovulation predictor tests kit instruction </li>\n</ul>\n<ul>\n  <li>Pregnancy and ovulation tests instructions </li>\n</ul>', '', 1000000, 15, 1389897049, 1),
(1785, 1, 0, 1095307200, 1, 0, 0, 'OV-SMS', '', 0, 0, 0, 0, '1.85', '0.00', 10, '1.55', '0.00', 24, '1.45', '0.00', '', '', '0.050', 'LH Ovulation Midstream Urine Test', 'LH Ovulation Midstream Urine Test', 'LH Ovulation Midstream Urine Test', 2592, 2593, 2594, 0, 0, 0, '', 0, '', 0, '', 0, 'LH Ovulation Midstream Urine Test', '', 'The One Step Ovulation Test will help you find the time when you are most able to become pregnant. It can help you plan your pregnancy.\n\nWhat is the best time for testing?\nYou may do this test at any time of the day, but you should test at approximately the same time each day. Reduce your liquid intake for 2 hours before testing.\n\nTo decide when to begin testing, determine the length of your normal menstrual cycle. The length of your cycle is from the beginning of one period to the beginning of the next (count the first day of bleeding or spotting as day 1).If your cycle length is irregular, that is, if it varies by more than a few days each month, take the average number of days for the last 3 months. Use the chart to work out the day you should begin testing. The day you begin testing is listed opposite the number of days in your normal cycle.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.85  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.55      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.45 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 44, 1438018639, 1),
(1786, 1, 0, 1095307200, 1, 0, 0, 'OV-DIGB', '', 1, 1, 0, 0, '8.50', '6.95', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.150', 'Digital Basal Thermometer LifeAid', 'Digital Basal Thermometer', 'Digital Basal Thermometer', 2595, 2596, 2597, 0, 0, 0, '', 0, '', 0, '', 0, 'Digital Basal Thermometer LifeAid', '', 'Digital Basal Thermometer includes:\n<ul>\n  <li> 1 Digital Basal Thermometer</li>\n</ul>\n<ul>\n  <li>1 Storage Case</li>\n</ul>\n<ul>\n  <li>1 Ovulation Chart for 6 months</li>\n</ul>\n<ul>\n  <li>Lifetime warranty </li>\n</ul>', '', 1000000, 98, 1389897049, 1),
(1791, 1, 0, 1095310800, 1, 0, 0, 'MO-SS1000', '', 1, 1, 0, 0, '75.00', '54.95', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '1.750', 'Samsung Blood Pressure Monitor', 'samsung blood pressure moniror blood pressure moniror blood pressure kit', 'Samsung Blood Pressure Monitor', 2598, 2599, 2600, 0, 0, 0, '', 0, '', 0, '', 0, 'Samsung Blood Pressure Monitor 3000s', '', '<ul>\n  <li>Large easy-to-read LCD panel\n  <li>Secure and comfortable arm cuff (fits arms 9"- 13") Standard cuff fits up to 13", larger cuff available from manufacturer using a coupon enclosed in box\n  <li>Simple, one button automatic inflation\n  <li>Quiet, rolling motor inflation pump\n  <li>Automatic power conservation\n  <li>Pulse monitor</li>\n</ul>\n\nThe Heart Senseô Automatic Blood Pressure Monitor\nThis exclusive system uses advanced technology to "sense" exactly how high to inflate the arm cuff, automatically adjusting for each individual user. That means quick, easy blood pressure and pulse measurements every time. It also\nmeans comfortable home monitoring because the cuff will never be inflated higher than necessary. Heart Senseô home blood pressure monitors are sensitive to your needs - only from Samsung.\n\nWarranty: 2 Years on Main unit and 1 Year on cuff\n\nFree large cuff upgrade:\nAs a special offer, Samsung will provide you with a free large cuff (fits 13" to 17" arms) to ensure comfortable and optimum measurements. Once you have purchased your Samsung blood pressure monitor, you will find the Free Coupon offer in each box. Simply complete the coupon and mail! Please allow 4-6 weeks processing time.', '', 1000006, 33, 1438018639, 1),
(1794, 1, 0, 1095310800, 1, 0, 0, 'DH-MS429', '', 0, 0, 0, 0, '9.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.350', 'Dual Head Stethoscope', 'stethoscope dual head stethoscope', 'Dual Head Stethoscope', 2601, 2602, 2603, 0, 0, 0, '', 0, '', 0, '', 0, 'Dual Head Stethoscope', '', 'Each Dual Head Stethoscope features a chrome-plated brass binaural, lightweight anodized aluminum chestpiece, 22" vinyl blue color Y-tubing, spare diaphragm and a pair of mushroom eartips. Overall Dual Head Stethoscope length is 30".\n\nThis Stethoscopes offer practical and reasonably priced technology to users. Latex-free tubing protect patients and medical professionals from allergens while provide that a strong and accurate measurement instrument. Stethoscope is adaptable stainless steel binaurals with a choice of ear tip styles provide comfort and improved sound transmission.', '', 1000000, 13, 1389897049, 1),
(1795, 1, 0, 1095310800, 1, 0, 0, 'MO-NSST', '', 0, 0, 0, 0, '6.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.350', 'Nurse Stethoscope Single Head', 'stethoscope Single Head', 'Nurse Stethoscope Single Head', 2604, 2605, 2606, 0, 0, 0, '', 0, '', 0, '', 0, 'Nurse Stethoscope Single Head', '', 'Each Nurse Stethoscope features a chrome-plated brass binaural, lightweight anodized aluminum chestpiece and 22" blue vinyl Y-tubing. Each Nurse Stethoscope is packaged with a spare diaphragm and a pair of mushroom ear tips. Overall Nurse Stethoscope length is 30".\n\nOur Stethoscopes offer realistic and inexpensive technology to physicians, nurses, students and others. Latex-free tubing protects patients and medical professionals from allergens while provided that a durable and reliable measurement instrume', '', 1000000, 6, 1438018639, 1);
INSERT INTO `sc_product` (`prdID`, `active`, `priority`, `time_available`, `in_stock`, `is_new`, `mnfID`, `model`, `url`, `price_type`, `price_type_new`, `spec_time1`, `spec_time2`, `price`, `spec_price`, `opt1`, `price1`, `spec_price1`, `opt2`, `price2`, `spec_price2`, `measure`, `dimensions`, `weight`, `meta_title`, `meta_keywords`, `meta_description`, `uplID1`, `uplID2`, `uplID3`, `uplID4`, `uplID5`, `uplID6`, `doc1`, `docID1`, `doc2`, `docID2`, `doc3`, `docID3`, `name`, `comment`, `description`, `attributes`, `quantity`, `num_choosed`, `last_modified`, `product_updated`) VALUES
(1799, 1, 0, 1095307200, 1, 0, 0, 'DA-2PC', '', 0, 0, 0, 0, '2.83', '0.00', 10, '2.63', '0.00', 25, '2.53', '0.00', '', '', '0.040', 'Drug Test Kit 2-Panel Screen  Urine THC/Cocaine', 'drug testing drug test drug test kit home drug test', 'Drug Test Kit THC / Cocaine 2 panel', 2607, 2608, 2609, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Test Kit 2-Panel Screen  Urine THC/Cocaine', '', 'The 2 Drug Screen Urine Test Kit is an immunochromatographic assay for rapid drug testing, qualitative detection of drugs and their principal metabolites in urine at specified cut-off concentrations. We provide two combinations:\n\n- THC/COC or THC/MET\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.83     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.63      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.53 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999937, 908, 1389897049, 1),
(1801, 1, 0, 1095307200, 1, 0, 0, 'DDK-20', '', 0, 0, 0, 0, '131.46', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '1.100', 'Drug Detection Spray kit THC/COC/METH/OPI', 'drug test wipe drug test spray mistral', 'Drug Detection Spray kit THC/COC/METH/OPI', 2610, 2611, 2612, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Detection Spray Kit for THC/COC/METH/OPI (20 tests)', '', '<b><font face="verdana" color="red">This product only can be shipped in US only</font></b><br>\n\n<ul>\n  <li>Non-Invazive Detection and identification of most common illegal drugs\n  <li>Accurate and will not make your suspect feel uncomfortable with a drug\n    testing procedure\n  <li>Inexpensive - One drug test assay cost less than $1.36\n  <li>Easy to use and do not have to come in contact with urine, saliva etc\n  <li>Safe and Sensitive drug test procedure</li>\n</ul>\n\nOur family of patented drug detection and identification products provide law enforcement officers and investigators\ndistinct advantages for field and laboratory use. "On the spot"\nreaction ensures a testing process that is convenient, fast and efficient. No glass ampoules, spatulas or waiting period required. Results appear in seconds. No additional tools or equipment required. The identification/detection process\nrequires no special training. Our products are non-toxic, non-carcinogenic, and environmentally friendly.\n\nDrug Detection contain detection kits for: THC/COC/METH/OPI. Each kit contains the sprays and the collection papers, in a convenient plastic carry case.', '', 1000000, 63, 1389897049, 1),
(1803, 1, 0, 1095307200, 1, 0, 0, 'F-ER100', '', 0, 0, 0, 0, '267.25', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '3.500', 'EXPRAY Explosives Detection / Identification Field Test Kit (100 Tests)', 'EXPRAY Explosives Detection / Identification Field Test Kit (100 Tests)', 'EXPRAY Explosives Detection / Identification Field Test Kit (100 Tests)', 2613, 2614, 2615, 0, 0, 0, '', 0, '', 0, '', 0, 'EXPRAY Explosives Detection / Identification Field Test Kit (100 Tests)', '', '<b><font face="verdana" color="red">This product only can be shipped in US only</font></b><br>\n\n\nExpray is a unique, aerosol-based field test kit for the detection and identification of Group A explosives (e.g. TNT, TNB, etc.), Group B explosives (e.g. Semtex H, RDX, C4, etc.) and compounds containing inorganic nitrates that are used in improvised explosives (e.g. ANFO). Expray is commonly used as a pre-blast, analytical tool, post-blast investigative tool, screen against potential terrorist elements and as a technical evaluation test in soil remediation on hazardous material "clean-up" sites. When used as a post-blast investigative tool, the product is field proven to speed up crucial investigations. The level of sensitivity (20 nanograms) surpasses that of other currently available products. The testing process is fast and efficient. No glass ampoules, spatulas or waiting period required. Results appear in seconds. No additional tools or equipment required. The identification/detection process requires no special training and testing can be performed "on the spot".\n\nFor both law enforcement and investigative personnel, Expray is a proven tool for increasing the accuracy, efficiency and number of interdictions. For forensic and environmental laboratories, it has proven to reduce the number of samples submitted for testing, saving both time and money.\n\nExpray is sold in a kit configuration, which provides all three aerosol sprays, collection papers, and an RDX-impregnated verification pad (verification pad is useful for ensuring that the spraycan still contains active reagents and for demonstrating how a positive reaction will appear) in a convenient plastic carry case. Expray kits are available in both regular size (100 tests) and mini-size (50 tests).\n\nMistral is proud to say that Expray provides a low "per test" cost and poses no risk to you or the environment\n\n"E": Expray-1 for Group A Expray-1 is used to search for GROUP A type explosives which include TNT, Tetryl, TNB, DNT, picric acid and its salts. To use, wipe suspected surface with special collector test paper. Spray with Expray-1. If a dark brown-violet color appears, this indicates the presence of TNT; An orange color indicates the presence of Tetryl and other GROUP A explosives.\n\n"X": Expray-2 for Group B Expray-2 is used to search for GROUP B type explosives which include Dynamite, Nitroglycerine, RDX, PETN, SEMTEX, Nitrocellulose and smokeless powder. If after spraying Expray-1 there is no color change, spray Expray-2. The almost immediate appearance of a pink color change indicates the presence of GROUP B explosives. Most plastic types of explosives belong to this group, including C-4 and Semtex.\n\n"I": Expray-3 for Nitrates Expray-3 is used to search for nitrate-based explosives which includes ANFO (ammonium nitrate-fuel oil), commercial and improvised explosives based on inorganic nitrates, black powder, flash powder, gun powder, potassium chlorate and nitrate, sulfur (powder), and ammonium nitrate (both fertilizer and aluminum). If there is still no reaction after using the Expray cans 1 and 2, but presence of explosives is still suspected, spray the same paper with Expray-3. A pink reaction indicates the presence of nitrates, which could be part of an improvised explosive.', '', 1000000, 143, 1389897049, 1),
(1805, 1, 0, 1095307200, 1, 0, 0, 'HP-LB', '', 0, 0, 0, 0, '31.50', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '3.000', 'Belted Lumbar Back Heating Cooling Pad', 'Belted Lumbar Back Aromatherapy Herbal Heating Cooling Pad', 'Belted Lumbar Back Aromatherapy Herbal Heating Cooling Pad', 2616, 2617, 2618, 0, 0, 0, '', 0, '', 0, '', 0, 'Belted Lumbar Back Aromatherapy Herbal Heating Cooling Pad', '', '<p>Belted Lumbar Back Aromatherapy Herbal Heating Cooling Pad can be used for \n  the lower backs, hips or strapped across diagonally upper back and shoulder \n  areas.<br>\n</p>\n<p><b>In the microwave</b>: Heat in microwave for 1 to 3 minutes. (Lighter weight \n  products require less heating time. Eye pillows will require only about 30 seconds). \n  If microwave does not have a turntable, flip Herb Pack over 1/2 way thru heating \n  to avoid burning. For a moister heat: mist with water before heating. Misting \n  also increases lif of herb by preserving freshness. When reheating, if Herb \n  Pack is still warm, heat only for 1 to 2 minutes to prevent overheating.</p>\n<p>Heat lasts for approximately 45 minutes. Heating for more than 3 minutes at \n  once could result in overheating or burning. If pack seems too hot, leave cool \n  prior to use.</p>\n<p><b>In the oven</b>: Heat oven to 350, wrap Herb Pack in tin foil. Heat for \n  approximately 15 minutes. Do not oven heat products with velcro, as velcro may \n  melt.</p>\n<p>For a Cold Pack: Place in a plastic bag and place in freezer for 1-2 hours.</p>', '', 1000001, 11, 1412773136, 1),
(1806, 1, 0, 1095307200, 1, 0, 0, 'AC-IPAC', '', 0, 0, 0, 0, '14.50', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.900', 'Lavender Eye Aromatherapy Mask', 'Lavender Eye Aromatherapy Heating Cooling Mask', 'The Lavender Eye Aromatherapy Heating Cooling Mask', 2619, 2620, 2621, 0, 0, 0, '', 0, '', 0, '', 0, 'The Lavender Eye Aromatherapy Heating Cooling Mask', '', '<p>The Lavender Eye Mask is filled with Lavender. Which was used by the early \n  Greeks to sooth the temperament and bring tranquillity, peace and harmony to \n  the mind and spirit. Used medicinally as an aid in relieving nervous exhaustion, \n  tension headaches, facial pain and bringing comfort to the user by reducing \n  stress. It also contains Flax seed which is used as the temperature element. \n  This herb was cultivated as far back as 5000 B.C. for use as a relaxant, an \n  expectorant and as a soothing anti-inflammatory herb.The Eye Pillow can be used \n  as a hot pack or a cold pack.</p>\n<p><b>In the microwave</b>: Heat in microwave for 1 to 3 minutes. (Lighter weight \n  products require less heating time. Eye pillows will require only about 30 seconds). \n  If microwave does not have a turntable, flip Herb Pack over 1/2 way thru heating \n  to avoid burning. For a moister heat: mist with water before heating. Misting \n  also increases lif of herb by preserving freshness. When reheating, if Herb \n  Pack is still warm, heat only for 1 to 2 minutes to prevent overheating.</p>\n<p>Heat lasts for approximately 45 minutes. Heating for more than 3 minutes at \n  once could result in overheating or burning. If pack seems too hot, leave cool \n  prior to use.</p>\n<p><b>In the oven</b>: Heat oven to 350, wrap Herb Pack in tin foil. Heat for \n  approximately 15 minutes. Do not oven heat products with velcro, as velcro may \n  melt.</p>\n<p>For a Cold Pack: Place in a plastic bag and place in freezer for 1-2 hours.</p>', '', 1000000, 12, 1438018639, 1),
(1808, 1, 0, 1095307200, 1, 0, 0, 'AC-BHP', '', 0, 0, 0, 0, '17.90', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '3.000', 'Basic Herbal Aromatherapy Pack', 'Basic Herbal Aromatherapy Heating Cooling Pack', 'The Basic Herbal Aromatherapy Heating Cooling Pack', 2622, 2623, 2624, 0, 0, 0, '', 0, '', 0, '', 0, 'The Basic Herbal Aromatherapy Heating Cooling Pack', '', '<p>The Basic Herbal Aromatherapy Heating Cooling Pack can be used on any part \n  of the body and any ailment. Width: 6.5" length: 13"</p>\n<p><b>In the microwave</b>: Heat in microwave for 1 to 3 minutes. (Lighter weight \n  products require less heating time. Eye pillows will require only about 30 seconds). \n  If microwave does not have a turntable, flip Herb Pack over 1/2 way thru heating \n  to avoid burning. For a moister heat: mist with water before heating. Misting \n  also increases lif of herb by preserving freshness. When reheating, if Herb \n  Pack is still warm, heat only for 1 to 2 minutes to prevent overheating.</p>\n<p>Heat lasts for approximately 45 minutes. Heating for more than 3 minutes at \n  once could result in overheating or burning. If pack seems too hot, leave cool \n  prior to use.</p>\n<p><b>In the oven</b>: Heat oven to 350, wrap Herb Pack in tin foil. Heat for \n  approximately 15 minutes. Do not oven heat products with velcro, as velcro may \n  melt.</p>\n<p>For a Cold Pack: Place in a plastic bag and place in freezer for 1-2 hours. \n  Pack will stay cold for up to 45 minutes!</p>', '', 1000000, 30, 1438018639, 1),
(1812, 1, 0, 1095307200, 1, 0, 0, 'DA-SMETC', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.040', 'Meth / Extasy Urine Drug Test Kit in Cassette', 'Meth / Extasy Urine Drug Test Kit in Cassette', 'THC is the primary active ingredient in cannabinoids (marijuana).', 2625, 2626, 2627, 0, 0, 0, '', 0, '', 0, '', 0, 'MET / Ecstasy Urine Drug Test Kit in Cassette', '', 'The rapid MET/Ecstasy (Methamphetamines) test is a simple one step test for the rapid, qualitative detection of MET and its metabolites such as oxidized, deaminated derivatives in urine. The cutoff of the test is 1000 ng/ml of MET. It is the same as the SAMHSA recommended assay cutoff.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 64, 1438018639, 1),
(1853, 1, 0, 1095307200, 1, 0, 0, 'AC-CC', '', 0, 0, 0, 0, '0.49', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.100', 'Specimen Collection Cups (105ml)', 'Specimen Collection Cups (105ml)', 'Specimen Collection Cups (105ml)', 2628, 2629, 2630, 0, 0, 0, '', 0, '', 0, '', 0, 'Specimen Collection Cups (105ml)', '', 'Our Specimen collection cups are ideal for on-site testing and to ease urine specimen collection.', '', 999952, 2097, 1438018639, 1),
(1861, 1, 0, 1095307200, 1, 0, 0, 'DA-2PMET', '', 0, 0, 0, 0, '2.83', '0.00', 10, '2.63', '0.00', 25, '2.53', '0.00', '', '', '0.040', 'Drug Test Kit 2 Panel Screen Urine', 'Drug Test Kit 2 Panel Screen Urine', 'Drug Test Kit 2 Panel Screen Urine', 2631, 2632, 2633, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Test Kit 2 Panel Screen Urine THC/METH', '', 'The 2 Drug Screen Urine Test Kit is an immunochromatographic assay for rapid drug testing, qualitative detection of drugs and their principal metabolites in urine at specified cut-off concentrations. We provide two combinations:\n\n- THC/METH(Ecstasy)\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.83     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.63      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.53ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000005, 707, 1389897049, 1),
(1862, 1, 0, 1095307200, 1, 0, 0, 'DA-REC', '', 0, 0, 0, 0, '395.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.120', 'XALEX Complete Employer''s Drug Test Kit', 'XALEX Complete Employer''s Drug Test Kit', 'XALEX Complete Employer''s Drug Test Kit', 2634, 2635, 2636, 0, 0, 0, '', 0, '', 0, '', 0, 'XALEX Complete Employer''s Drug Test Kit', '', 'You want to maximize your employees'' productivity but you have a suspicion that some employees are doing drugs. Drug testing is vital in maintaining a drug free work place. Our employer all-inclusive drug testing pack allows you to have at your disposal all the items needed to conduct testing for a variety of illegal drugs. \n\nXALEX COMPLETE DRUG TESTING PACK INLUDED EVERYTHING FOR EMPLOYERS OR SCHOOL ADMINISTRATION NEED: \n<ul>\n<li> XALEX Multi Drug NIDA-5 Panel Test Kits (50) \n<li> Powder free disposable latex gloves (50pr)\n<li> Specimen collection cups with thermometer (50)\n<li> Adulteration strips to control validity of the urine specimen (50)\n<li> 1 Urine Laboratory Test Kit (extra kits are available for purchase)\n<li> Drug Testing Applicant Notice with Acknowledgement Form (50)\n</ul>\n\nWhy Test Employees? Drug users are more likely to:\n<ul>\n<li>steal, \n<li>damage property\n<li>cause accidents, \n<li>act violently. \n</ul>\n\nDrug users are more prone to: \n<ul>\n<li>absenteeism, \n<li>low performance \n<li>criminal activity\n</ul>', '', 1000000, 1, 1438018639, 1),
(1865, 1, 0, 1095307200, 1, 0, 0, 'DA-SOC', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.040', 'Opiate (HER,MOR) Cassette Drug Urine Test', 'Opiate (HER,MOR) Cassette Drug Urine Test', 'Opiate (HER,MOR) Cassette Drug Urine Test', 2637, 2638, 2639, 0, 0, 0, '', 0, '', 0, '', 0, 'Opiate (HER,MOR) Cassette Drug Urine Test', '', 'Opiate (HER,MOR) Cassette Drug Urine Test is a simple one step immunochromatographic assay for the rapid, qualitative detection of opiates and their metabolites such as codeine and heroin in urine. The cutoff of the test is 300 ng/ml of OPI. It is the same as the SAMHSA recommended assay cutoff. \n\nNote: The opiate morphine heroin test provides only preliminary data, which should be confirmed by other methods such as gas chromatography/mass spectrometry (GC/MS). Clinical considerations and professional judgment should be applied to any drug of abuse test result, particularly when preliminary positive results are indicated.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999943, 398, 1438018639, 1),
(1866, 1, 0, 1095307200, 1, 0, 0, 'DA-SCC', '', 0, 0, 0, 0, '2.38', '0.00', 10, '1.64', '0.00', 24, '1.07', '0.00', '', '', '0.040', 'Cocaine Cassette Drug Urine Test', 'Cocaine Cassette Drug Urine Test', 'Cocaine Cassette Drug Urine Test', 2640, 2641, 2642, 0, 0, 0, '', 0, '', 0, '', 0, 'Cocaine Cassette Drug Urine Test', '', 'Cocaine(COC) Drug Urine Test is a simple one step test\nfor the rapid, qualitative detection of COC and primarily benzoylecgonine as metabolites in urine. The cutoff of the test is 300 ng/ml of COC. It is the same as the SAMHSA \nrecommended cutoff.\n\nThe COC cocaine test provides only a preliminary analytical result. A more specific alternative chemical method must be used in order to obtain a confirmed analytical result. Gas chromatography, mass spectrometry (GC/MS) is the preferred method. Clinical consideration and professional judgment should be applied to any drug of abuse test result, particularly when preliminary positive results are used.\n\nEXPLANATION OF THE TEST:\nCocaine, derived from the leaves of the coca plant, is a potent central nervous system stimulant and a local anesthetic. Cocaine induces euphoria, confidence and a sense of increased energy in the user; these psychological effects are accompanied by increased heart rate, dilation of the pupils, fever, tremors and sweating. Cocaine is used by smoking, intravenous, intranasal or oral administration, and excreted in the urine primarily as benzoylecgonine in a short time. Benzoylecgonine has a longer biological half-life (5-8 hours) than cocaine (0.5-1.5 hours) and can generally be detected for 24-80 hours after cocaine use or exposure.\n\nThe COC cocaine test is based on the principle of the highly specific immunochemical reactions between antigens and antibodies, which are used for the analysis of specific substances in biological fluids. The sensitivity of the test is 300 ng/ml of COC.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 488, 1389897049, 1),
(1869, 1, 0, 1095307200, 1, 0, 0, 'DA-SAMPC', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.040', 'Urine Cassette Drug Test for Amphetamine', 'Amphetamine Cassette Drug Urine Test', 'Amphetamine Cassette Drug Urine Test', 2643, 2644, 2645, 0, 0, 0, '', 0, '', 0, '', 0, 'Urine Cassette Drug Test for Amphetamine', '', 'The one step AMP (Amphetamines) test is a simple one step immunochromatographic assay for the rapid, qualitative detection of AMP in urine. The amount of drugs and metabolites present in the urine cannot be estimated by the assay. The assay results distinguish positive from negative samples. A positive result indicates the sample contains AMP above the cut-off concentration.\n\nThe AMP test provides only a preliminary analytical result. A more specific alternative chemical method must be used in order to obtain a confirmed analytical result. Gas chromatography / mass spectrometry (GC/MS) is the preferred method. Clinical consideration and professional judgment should be applied to any drug of abuse test result, particularly when preliminary positive results are used.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 105, 1438018639, 1),
(1870, 1, 0, 1095307200, 1, 0, 0, 'DA-SCS', '', 0, 0, 0, 0, '1.64', '0.00', 10, '1.29', '0.00', 25, '0.99', '0.00', '', '', '0.020', 'Cocaine Dipstrip Urine Drug Test', 'Cocaine Dipstrip Drug Urine Test', 'Cocaine Dipstrip Urine Drug Test', 2646, 2647, 2648, 0, 0, 0, '', 0, '', 0, '', 0, 'Cocaine Dipstrip Urine Drug Test', '', 'Cocaine(COC) Drug \\ Test is a simple one step rapid immunochromatographic assay for the rapid, qualitative detection of COC and primarily benzoylecgonine as metabolites in urine. The cutoff of the test is 300 ng/ml of COC. It is the same as the SAMHSA recommended assay cutoff.\n\nEXPLANATION OF THE TEST\nCocaine, derived from the leaves of the coca plant, is a potent central nervous system stimulant and a local anesthetic. Cocaine induces euphoria, confidence and a sense of increased energy in the user; these psychological effects are accompanied by increased heart rate, dilation of the pupils, fever, tremors and sweating. Cocaine is used by smoking, intravenous, intranasal or oral administration, and excreted in the urine primarily as benzoylecgonine in a short time. Benzoylecgonine has a longer biological half-life (5-8 hours) than cocaine (0.5-1.5 hours) and can generally be detected for 24-80 hours after cocaine use or exposure.\n\nThe COC test is based on the principle of the highly specific immunochemical reactions between antigens and antibodies, which are used for the analysis of specific substances in biological fluids. The sensitivity of the test is 300 ng/ml of COC.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 5 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 10 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.29\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.99ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999991, 911, 1389897049, 1),
(1871, 1, 0, 1095307200, 1, 0, 0, 'DA-ADT', '', 1, 1, 0, 0, '1.85', '1.75', 10, '1.67', '0.00', 25, '1.64', '0.00', '', '', '0.020', 'Adulteration Urine Drug Test', 'Urine Adulteration Test', 'Urine Adulteration Test', 2649, 2650, 2651, 0, 0, 0, '', 0, '', 0, '', 0, 'Adulteration Urine Drug Test', '', 'UrineCheck 6 is based on detection methods that can identify the presence of additives, adulterants and masking agents that are added to urine. \n\nUrineCheck 6 Drug Adulteration Test Strip: \n\nCreatinine: Testing for sample dilution. In this assay, creatinine reacts with a creatinine indicator under alkaline conditions to form a purplish-brown color complex. The concentration of creatinine is directly proportional to the color intensity of the test pad.\n\nGlutaraldehyde: Testing for the presence of exogenous aldehyde. In this assay, the aldehyde group on the glutaraldehyde reacts with an indicator to form a pink color complex.\n\nNitrite: Testing for the presence of exogenous nitrite. Nitrite reacts with an aromatic amine to form a diazonium compound in an acid medium. The diazonium compound, in turn, couples with an indicator to produce a pink-red color\n\nOxidants: Testing for the presence of oxidizing reagents. In this reaction, a color indicator reacts with oxidants such as bleach, hydrogen peroxide or pyridinium chlorochromate to form a blue color complex. Other colors may indicate the presence of other oxidants.\n\npH: Testing for the presence of acidic or alkaline adulterant. This test is based on the well-known double pH indicator method that gives distinguishable colors over a wide pH range. The colors range from orange (low pH) to yellow and green to blue (high pH). Specific Gravity: Testing for sample dilution. This test is based on the apparent pKa change of certain pretreated polyelectrolytes in relation to the ionic concentration. In the presence of an indicator, the colors range from dark blue or blue-green in urine of low ionic concentration to green and yellow in urine of higher ionic concentration', '', 999922, 673, 1389897049, 1),
(1872, 1, 0, 1095307200, 1, 0, 0, 'AC-CCT', '', 0, 0, 0, 0, '0.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.100', 'Specimen Collection Cup with Thermometer', 'Specimen Collection Cup with Thermometer', 'Specimen Collection Cup with Thermometer', 2652, 2653, 2654, 0, 0, 0, '', 0, '', 0, '', 0, 'Specimen Collection Cup with Thermometer', '', 'Our Specimen collection cups are ideal for on-site testing and to ease urine specimen collection, they are available now with urine specimen temperature monitoring thermometers.', '', 1000000, 510, 1438018639, 1),
(1873, 1, 0, 1095307200, 1, 0, 0, 'DA-SOS', '', 0, 0, 0, 0, '1.64', '0.00', 10, '1.29', '0.00', 25, '0.99', '0.00', '', '', '0.020', 'Opiate (HER,MOR) Strip Drug Urine Test', 'Opiate (HER,MOR) Strip Drug Urine Test', 'Opiate (HER,MOR) Strip Drug Urine Test', 2655, 2656, 2657, 0, 0, 0, '', 0, '', 0, '', 0, 'Opiate (HER,MOR) Strip Drug Urine Test', '', 'Opiate (HER,MOR) Strip Drug Urine Test is a simple one step immunochromatographic assay for the rapid, qualitative detection of opiates and their metabolites such as codeine and heroin in urine. The cutoff of the test is 300 ng/ml of OPI. It is the same as the SAMHSA recommended assay cutoff. \n\nNote: The opiate morphine heroin test provides only preliminary data, which should be confirmed by other methods such as gas chromatography/mass spectrometry (GC/MS). Clinical considerations and professional judgment should be applied to any drug of abuse test result, particularly when preliminary positive results are indicated.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 5 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 10 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.29\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.99ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999947, 551, 1438018639, 1),
(1874, 1, 0, 1095307200, 1, 0, 0, 'DA-3PMT', '', 0, 0, 0, 0, '4.13', '0.00', 10, '3.83', '0.00', 25, '3.53', '0.00', '', '', '0.050', 'Drug Test 3 - Panel Screen Urine Kit THC/COC/MET', 'Drug Test Kit 3 - Panel Screen Urine', 'Drug Test Kit 3 - Panel Screen Urine', 2658, 2659, 2660, 0, 0, 0, '', 0, '', 0, '', 0, 'Drug Test 3 - Panel Screen Urine Kit THC/COC/MET', '', 'The 3 Drug Screen Urine Test THC/COC/MET Kit is an immunochromatographic assay for rapid drug testing, qualitative detection of drugs and their principal metabolites in urine at specified cut-off concentrations.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.13     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$3.83      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$3.53 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 710, 1389897049, 1),
(1875, 1, 0, 1095307200, 1, 0, 0, 'DA-STC', '', 0, 0, 0, 0, '3.95', '0.00', 10, '2.75', '0.00', 25, '2.15', '0.00', '', '', '0.060', 'Cotinine/Nicotine/Tobacco Urine Test', 'Nicotine/COT(Cotinine)/Tobacco Use Test', 'Nicotine/COT(Cotinine)/Tobacco Use Test', 2661, 2662, 2663, 0, 0, 0, '', 0, '', 0, '', 0, 'Cotinine/Nicotine/Tobacco Urine Test', '', 'PROCEDURE OF THE TEST\n\n1. Remove the nicotine test disk from the foil pouch, and place it on a flat, dry surface.\n\n2. Holding the sample dropper above the test disk. Squeeze 2 drops of specimen into the sample well (See the following Figures).\n\n3. Interpret the test results at 5 minutes.\n\nINTERPRETATION OF RESULTS\n\n1. As the nicotine test kit begins to work, a purple band will appear in the left section of the result window to show that the Control Line is working properly.\n\n2. The right section of the result window indicates the test results. If another purple band appears at the right section of the result window, this band is the Test Band.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$3.95   ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.75      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.15 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 1804, 1389897049, 1),
(1878, 1, 0, 1095307200, 1, 0, 0, 'DA-OF6', '', 0, 0, 0, 0, '15.83', '0.00', 10, '14.93', '0.00', 25, '13.13', '0.00', '', '', '0.150', 'NEW! Oral Fluid 6 Multi-Drug Saliva Screen Test Kit (AMP/MAMP/COC/OPI/THC/PCP)', 'NEW! Oral Fluid 6 Multi-Drug Saliva Screen Test Kit (AMP/MAMP/COC/OPI/THC/PCP)', 'NEW! Oral Fluid 6 Multi-Drug Saliva Screen Test Kit (AMP/MAMP/COC/OPI/THC/PCP)', 2664, 2665, 2666, 0, 0, 0, '', 0, '', 0, '', 0, 'Oral Fluid 6 Multi-Drug Saliva Screen Test Kit (AMP/MAMP/COC', '', 'Oral Fluid 6 Multi-Drug Saliva Screen Test Kit (AMP/MAMP/COC/OPI/THC/PCP) \n\n<br>Oral Fluid 6 Multi-Drug Saliva Screen Test Kit is a 1-step on-site rapid drug test device for the qualitative recognition of Amphetamine, Opiates, Phencyclidine, THC (Marijuana), Methamphetamine, Cocaine, and their metabolites in oral fluid. \n\nDrug testing in oral fluid is more appropriate at this time in many facilities. Oral Fluid 6 Multi-Drug Saliva Screen Test Kit, opposing to existing well-liked drug tests that require the person to donate urine, is an oral fluids (Saliva) drug test and is top of the line product, almost unassailable for any adulterants. Oral Fluid 6 Multi-Drug Saliva Screen Test Kit detects active drugs present in the saliva.\n\nThis test is for forensic use only\n\nThe designation of "for forensic use only" means that the substance abuse test is not FDA 510k Cleared. These types of tests are successfully used by law enforcement, correction and probation departments.\n\nBe sure to be legal and if you need to have FDA 510K cleared status, buy the following: \n\nAlcohol Breathalyzer AlcoMate CA2000\n\nAll urine drug testing kits (except QTEST-12 urine drugs screen cup) \n\nAlcoHawk Breathalyzer\n\n\n\nNote: FDA 510k Clearance by itself does not make legal substance abuse testing procedure. Anyway, in case you get a positive test result with any instant drug testing devices, you need to confirm it with accredited. Additionally, make sure that you fill-out properly the Chain of Custody Form.', '', 1000000, 526, 1438018639, 1),
(1879, 1, 0, 1095307200, 1, 0, 0, 'DA-LABU', '', 0, 0, 0, 0, '37.50', '0.00', 3, '33.20', '0.00', 0, '0.00', '0.00', '', '', '0.300', 'Laboratory 6 Parameters Urine Drug Test', 'Laboratory 6 Parameters Urine Drug Test', 'Laboratory 6 Parameters Urine Drug Test', 2667, 2668, 2669, 0, 0, 0, '', 0, '', 0, '', 0, 'Laboratory 6 Parameters Urine Drug Test', '', 'The advantages of establishing a Corporate Drug Free Workplace Program has been clearly documented by lower accident rates, lower employee turnover, and lower \nworkman''s compensation insurance claims.\n\nThe first step in your Corporate Drug Free Workplace (DFW) program is to reduce the cost, hassle, and turnaround time of "drug testing". The best way to do this is by using the Lab Drug Test Kit.\n\nKIT UNCLUDES:\n  - SPECIMEN COLLECTION CUP WITH A TEMPERATURE STRIP \n  - CONTAINER AND BIOHAZARD PROTECT ENVELOPE\n  - ADDRESSED AIRBORN EXPRESS ENVELOPE\n  - CHAIN OF CUSTODY FORM\n  - MRO SERVICE AVAILABLE\n  - 10 PARAMETERS TEST AVAILABLE BY REQUEST\n\nAttention! Please follow the instructions carefully in filing out the Chain of Custody form and preparing the specimen. If any mistakes are made, the laboratory will not be able to perform the test, and we will not held responsible.', '', 1000000, 3, 1438018639, 1),
(1880, 1, 0, 1095307200, 1, 0, 0, 'DA-EZCP', '', 0, 0, 0, 0, '8.53', '0.00', 10, '7.83', '0.00', 25, '7.53', '0.00', '', '', '0.250', 'Multi Drug Screen Test Kit Cup', 'Multi Drug Screen Test Kit Cup', 'Multi Drug Screen Test Kit Cup', 2670, 2671, 2672, 0, 0, 0, '', 0, '', 0, '', 0, 'Multi Drug Screen Test Kit Cup', '', '<ul>\n  <li> The Multi-Drug Screen Test Cup is a self-contained urinalysis-screening device that can detect the presence of any of the following drug metabolites in minutes, using NIDA cutoff levels </li>\n</ul>\n<ul>\n  <li>The Multi-Drug Screen Test Cup allows you to run drug tests at your convenience. No more worries about having to read the test immediately after collecting the sample.</li>\n</ul>\n<ul>\n  <li> The Multi-Drug Screen Test Cup could detect at the same time Cocaine, Amphetamine, Marijuana(THC), Opiate(Morphine, Heroine), Methamphetamine.</li>\n</ul>', '', 1000000, 235, 1438018639, 1),
(1881, 1, 0, 1095307200, 1, 0, 0, 'DA-SBZC', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.040', 'Urine Drug  Test Cassette for BZD (Valium)', 'BZD (Valium) Urine Drug Cassette', 'BZD (Valium) Urine Drug Cassette', 2673, 2674, 2675, 0, 0, 0, '', 0, '', 0, '', 0, 'Urine Drug  Test Cassette for BZD (Valium)', '', 'The one-step BZD/Valium (Benzodiazepines)urine test is a simple one step immunochromatographic assay for the rapid, qualitative detection of BZD(Benzodiazepines) and its metabolites such as Oxazepam, Chlordiazepoxide, and some other benzodiazepines in urine. The cutoff of the test is 300 ng/ml of BZD. It is the same as the SAMHSA recommended assay cutoff.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 350, 1438018639, 1),
(1883, 1, 0, 1095307200, 1, 0, 0, 'DA-9P', '', 0, 0, 0, 0, '6.80', '0.00', 10, '6.50', '0.00', 25, '6.15', '0.00', '', '', '0.070', '9 Panel Drug Urine Test', '9 Panel Drug Urine Test', '9 Panel Drug Urine Test', 2676, 2677, 2678, 0, 0, 0, '', 0, '', 0, '', 0, '9 Panel Drug Urine Test', '', 'Urine Multi Drug 9 Panel drug Test is an forensic, all inclusive, point of use screening test for the rapid detection of 11-nor- delta 9 -Tetrahydrocannabinol -9- carboxylic acid (THC/Marijuana), Cocaine and its metabolite, Benzoylecgonine, PCP (Phencyclidine), Morphine and its related metabolites derived from Opium (opiates), Methamphetamines (including Ecstasy), Methadone,PCP(Angel Dust, Amphetamines, Barbiturates and Benzodiazepines in human urine at or above the system concentrations levels established as standard minimums by the National Institute on Drug Abuse (NIDA), the World Health Organization (WHO) and SAMHSA as shown in the chart to the right. Note system cut-off concentrations are expressed in nanograms per milliliter.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.80     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.50\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.15ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 340, 1389897049, 1);
INSERT INTO `sc_product` (`prdID`, `active`, `priority`, `time_available`, `in_stock`, `is_new`, `mnfID`, `model`, `url`, `price_type`, `price_type_new`, `spec_time1`, `spec_time2`, `price`, `spec_price`, `opt1`, `price1`, `spec_price1`, `opt2`, `price2`, `spec_price2`, `measure`, `dimensions`, `weight`, `meta_title`, `meta_keywords`, `meta_description`, `uplID1`, `uplID2`, `uplID3`, `uplID4`, `uplID5`, `uplID6`, `doc1`, `docID1`, `doc2`, `docID2`, `doc3`, `docID3`, `name`, `comment`, `description`, `attributes`, `quantity`, `num_choosed`, `last_modified`, `product_updated`) VALUES
(1884, 1, 0, 1095307200, 1, 0, 0, 'DA-5CLN', '', 0, 0, 0, 0, '5.50', '0.00', 10, '5.15', '0.00', 25, '4.95', '0.00', '', '', '0.060', 'Multi-Line 5 Drug Urine Screen Test', 'Multi-Line 5 Drug Urine Screen Test', 'Multi-Line 5 Drug Urine Screen Test', 2679, 2680, 2681, 0, 0, 0, '', 0, '', 0, '', 0, 'Multi-Line 5 Drug Urine Screen Test', '', 'The Multi Drug 5 Drug Urine Multi-Line Screen Test is a simple one step immunochromatographic assay for the rapid, qualitative detection of cocaine, amphetamine, methamphetamines (ecstasy), opiates (heroin, morphine) and tetrahydrocannabinol (marijuana, hashish) drug testing in urine.\n\nThe cutoff of the test is:\n  300 ng/ml of COC\n  1000 ng/ml of AMP\n  1000 ng/ml of MET\n  300 ng/ml of OPI\n  50 ng/ml of THC \n\nas the SAMHSA recommended cutoff for these tests are assays cutoff.\n\nThe Multi Drug 5 Drug Urine Multi-Line Screen Test are more convenient urine drug test, sharp lines, easy to use and read, less customer''s mistakes.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.50     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.15\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.95 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 222, 1438018639, 1),
(1885, 1, 0, 1095307200, 1, 0, 0, 'DA-6CLN', '', 0, 0, 0, 0, '6.25', '0.00', 10, '5.95', '0.00', 25, '5.75', '0.00', '', '', '0.050', 'Multi-Line 6 Drug Urine Screen Test', 'Multi-Line 6 Drug Urine Screen Test', 'Multi-Line 6 Drug Urine Screen Test', 2682, 2683, 2684, 0, 0, 0, '', 0, '', 0, '', 0, 'Multi-Line 6 Drug Urine Screen Test', '', 'Multi Drug 6 Drug Urine Multi-Line Screen Test is rapid one step immunochromatographic assay for the rapid detection of cocaine, amphetamine, methamphetamines (ecstasy), opiates (heroin, morphine) and tetrahydrocannabinol (marijuana, hashish) drug testing in urine.\n\nThe cutoff of the test is:\n  300 ng/ml of COC\n  1000 ng/ml of AMP\n  1000 ng/ml of MET\n  300 ng/ml of OPI\n  300 ng/ml Benzodiazepine\n  50 ng/ml of THC\n\nas The SAMHSA recommended cutoff for these tests are assays cutoff.\n\nThe Multi Drug 6 Drug Urine Multi-Line Screen Test are more convenient urine drug test, sharp lines, easy to use and read, less customer''s mistakes.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.25     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.95      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.75 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000002, 59, 1438018639, 1),
(1886, 1, 0, 1095307200, 1, 0, 0, 'DA-SP100', '', 0, 0, 0, 0, '365.57', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '2.200', 'Multi Drug Spray Test (100 Tests)', 'Multi Drug Spray Test (100 Tests)', 'Multi Drug Spray Test (100 Tests)', 2685, 2686, 2687, 0, 0, 0, '', 0, '', 0, '', 0, 'Multi Drug Spray Test (100 Tests)', '', '<b><font face="verdana" color="red">This product only can be shipped in US only</font></b><br>\n\n\nMulti Drug Spray Test. 100 Tests Kit!\n\nMulti Drug Spray Test includes two canister of sprays and four packs of testing paper. One canister contains Detect 4 Drugs, an aerosol reagent packaged as a single spray canister, and one canister contains Coca-Test, a field test reagent for the detection and identification of cocaine and crack.\n\nAdvantages of the spray drug testing method: \n<ul>\n<li>NON-INVAZIVE DETECTION AND IDENTIFICATION OF MOST COMMON ILLEGAL DRUGS \n<li>ACCURATE AND WILL NOT MAKE YOUR SUSPECT FEEL UNCOMFORTABLE WITH A DRUG TESTING PROCEDURE \n<li>INEXPENSIVE - ONE DRUG TEST ASSAY COST LESS THAN OTHER METHOD\n<li>EASY TO USE AND DO NOT HAVE TO COME IN CONTACT WITH URINE, SALIVA ETC \n<li>SAFE AND SENSITIVE DRUG TEST PROCEDURE\n</ul>', '', 1000000, 23, 1438018639, 1),
(1887, 1, 0, 1095307200, 1, 0, 0, 'DA-OFLAB', '', 0, 0, 0, 0, '35.95', '0.00', 10, '34.95', '0.00', 25, '31.95', '0.00', '', '', '0.200', 'ORAL FLUID SALIVA LABORATORY DRUG TEST', 'ORAL FLUID SALIVA LABORATORY DRUG TEST', 'ORAL FLUID SALIVA LABORATORY DRUG TEST', 2688, 2689, 2690, 0, 0, 0, '', 0, '', 0, '', 0, 'ORAL FLUID SALIVA LABORATORY DRUG TEST', '', 'SALIVA LAB DRUG TEST AVAILABLE ONLY WITH PURCHASE OF 6 PANEL SALIVA DRUG TEST\n\n\nProcedure of Specimen Collection and Handling for Lab Confirmation: \n<ul>\n<li>Cover the collection pad with the white cap. \n<li>Detach the collection pad with its white cap.\n<li>The collection pad should easily fall into its white cap.\n<li>Push the white cap until tight secured on the device. \n<li>Send your test to a lab for confirmation. \n</ul>', '', 1000000, 2, 1438018639, 1),
(2142, 1, 0, 1095307200, 1, 0, 0, 'FPMS-10pad', '', 1, 1, 0, 0, '16.90', '12.95', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.200', 'Midstream Pregnancy Tests (Pack of Ten)', 'Midstream Pregnancy Tests (Pack of Ten)', 'Midstream Pregnancy Tests (Pack of Ten)', 2691, 2692, 2693, 0, 0, 0, '', 0, '', 0, '', 0, 'hCG Midstream Pregnancy Tests (Pack of Ten)', '', 'Lowest Price on Internet !\nEarly home Pregnancy test in midstream detects the hormone hCG at the 20mIUs level. In the early pregnancy testing market, 20mIUs level is the lowest which means the most sensitive. This means that you can find out whether or not you are pregnant in just 6-7 days after conception.\nThis early pregnancy test is 99% accurate and is officially approved by FDA. \n\nIt''s easy-to-use and has simple test instructions. The results are ready in 2-5 minutes! Each pregnancy test is packaged individually in a sterile, and pouch bag.\n\nThis value pack includes 10 tests.\n\nShelf life - 2 years.\n<br><br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b></br>', '', 1000000, 44, 1389897049, 1),
(2145, 1, 0, 1095307200, 1, 0, 0, 'prs5', '', 0, 0, 0, 0, '4.65', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.100', 'hCG Pregnancy Strip Urine Test (Pack of Five)', 'Pregnancy Dipstrip Urine Test Pack of Five', 'hCG Pregnancy Strip Urine Test (Pack of Five)', 2694, 2695, 2696, 0, 0, 0, '', 0, '', 0, '', 0, 'hCG Pregnancy Strip Urine Test (Pack of Five)', '', '<ul>\n  <li>It is one of the most inexpensive and accurate early pregnancy tests</li>\n</ul>\n<ul>\n  <li> Highly accurate and quick to detect pregnancy</li>\n</ul>\n<ul>\n  <li>Test takes 3 - 5 minutes</li>\n</ul>\n<ul>\n  <li>Level of hCG as low as 20 - 25 mlU/mL can be detected</li>\n</ul>\n<ul>\n  <li>FDA Approved and Doctors recommended<br>\n  </li>\n</ul>\n\nHow an early home pregnancy test works:\nWhen a woman becomes pregnant, her body produces a hormone called hCG (human Chorionic Gonadotropin). This hormone appears in the urine. The secretion of this hormone increases throughout the first trimester. Human chorionic gonadotropin (hCG) is a glycoprotein hormone secreted by the developing placenta shortly after fertilization. In normal pregnancy, hCG can be detected in serum as early as 7 days following conception, doubling every 1.3 to 2 days and reading 100 mlU/ml at the first missed menstrual period. The appearance of hCG soon after conception and its subsequent rise in concentration during early gestational growth make it an excellent marker for the early detection of pregnancy. \n\nOneStep Dipstick Pregnancy Test is a qualitative, sandwich dye conjugate immunoassay for the determination of human hCG in urine. The method employs a unique combination of monoclonal and polyclonal antibodies to selectively identify hCG in test samples with a high degree of sensitivity. In less than 5 minutes, elevated levels of hCG as low as 20 - 25 mlU/mL can be detected.\n\nEach pregnancy test is packaged individually in a sterile pouch bag. \n\nThis value pack includes 5 tests. \n\nShelf life - 2 years. \n\nHow to detect early signs of pregnancy? Which test to choose? Find best home pregnancy tests on our site!\n<br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b><br />', '', 999998, 5, 1389897049, 1),
(2146, 1, 0, 1115784000, 1, 0, 0, 'QF-QT', '', 1, 1, 0, 0, '33.50', '22.50', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.200', 'QTEST Saliva Biotested - Ovulation Prediction Test', 'QTEST Saliva Biotested - Ovulation Prediction Test', 'It is a small microscope that could show to you structure of woman body physical liquids, like saliva or vaginal liquid. You can see three different results: Fertile Period, Non-Fertile Period, and Transitional Period.', 2697, 2698, 2699, 0, 0, 0, '', 0, '', 0, '', 0, 'QTEST Saliva Biotester - Ovulation Prediction Test', '', 'New Ovulation Prediction Biotester on Market - QTEST™. 1 Year full warranty *.\n\nIt is a small microscope that could show to you structure of woman body physical liquids, like saliva or vaginal liquid. You can see three different results: Fertile Period, Non-Fertile Period, and Transitional Period.', '', 1000000, 22, 1438018639, 1),
(2149, 1, 0, 1095307200, 1, 0, 0, 'F-DPX', '', 0, 0, 0, 0, '244.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '3.500', 'DropEx Plus Explosives Detection Field Test Kit', 'DropEx Plus Explosives Detection Field Test Kit', 'DropEx Plus Explosives Detection Field Test Kit', 2700, 2701, 2702, 0, 0, 0, '', 0, '', 0, '', 0, 'DropEx Plus Explosives Detection Field Test Kit', '', '<b><font face="verdana" color="red">This product only can be shipped in US only</font></b><br>\n\nDrop-Ex Plus is our newest Explosive Detection and Identification Kit. \nNow it is includes P.D.K. explosive field test kit and as a result could also detect improvized chlorates based and peroxide based explosive compounds. This system is based on the same reagents in Expray, but in a drop tube deliverable system, for ease of use during field and laboratory investigation. This kit is also able to detect an additional category of explosives: chlorates. When using drop # 4 for detection of chlorates (also for bromides) this drop is used by itself and does not require drops # 1, 2, or 3 to precede it. If you are not sure what type of explosive you are testing for, you will need two samples. The first sample can be tested using Drop-Ex 1, 2 and 3. The test for chlorates and bromides must be a separate test using Drop-Ex 4.\n\nDrop-Ex-1 for Group A Drop-Ex-1 is used to search for GROUP A type explosives which include TNT, Tetryl, TNB, DNT, picric acid and its salts. To use, wipe suspected surface with special collector test paper. Drop with Drop-Ex-1. If a dark brown-violet color appears, this indicates the presence of TNT; An orange color indicates the presence of Tetryl and other GROUP A explosives.\n\nDrop-Ex-2 for Group B Drop-Ex-2 is used to search for GROUP B type explosives which include Dynamite, Nitroglycerine, RDX, PETN, SEMTEX, Nitrocellulose and smokeless powder. If after Drop-Ex-1 there is no color change, use Drop-Ex-2. The almost immediate appearance of a pink color change indicates the presence of GROUP B explosives. Most plastic types of explosives belong to this group, including C-4 and Semtex.\n\nDrop-Ex-2 for Group B Drop-Ex-2 is used to search for GROUP B type explosives which include Dynamite, Nitroglycerine, RDX, PETN, SEMTEX, Nitrocellulose and smokeless powder. If after Drop-Ex-1 there is no color change, use Drop-Ex-2. The almost immediate appearance of a pink color change indicates the presence of GROUP B explosives. Most plastic types of explosives belong to this group, including C-4 and Semtex.\n\nDrop-Ex-3 for Nitrates Drop-Ex-3 is used to search for nitrate-based explosives which includes ANFO (ammonium nitrate-fuel oil), commercial and improvised explosives based on inorganic nitrates, black powder, flash powder, gun powder, potassium chlorate and nitrate, sulfur (powder), and ammonium nitrate (both fertilizer and aluminum). If there is still no reaction after using the Drop-Ex 1 and 2, but presence of explosives is still suspected, drop the same paper with Drop-Ex-3. A pink reaction indicates the presence of nitrates, which could be part of an improvised explosive.\n\nDrop-Ex-4 for Chlorates and Bromides Drop-Ex-4 is used to search for chlorates (such as potassium chlorate and sodium chlorate) and bromides. If you suspect a chlorate or bromide, use Drop-Ex-4. If there is a dark blue reaction, there is the presence of chlorates or bromides. If you have already tested with Drop-Ex 1, 2 and/or 3, you must use a fresh sample for Drop-Ex-4.\n\nP.D.K. Reagent A and B used to search for improvized chlorates based and peroxide based explosive compounds.', '', 1000000, 79, 1389897049, 1),
(2150, 1, 0, 1095307200, 1, 0, 0, 'F-DPX', '', 0, 0, 0, 0, '220.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '3.500', 'EXPRAY Explosive Detection 50 Test Kit with Spray Explosives Detection Technology', 'EXPRAY Explosive Detection 50 Test Kit with Spray Explosives Detection Technology', 'EXPRAY Explosive Detection 50 Test Kit with Spray Explosives Detection Technology', 2703, 2704, 2705, 0, 0, 0, '', 0, '', 0, '', 0, 'EXPRAY Explosive Detection 50 Test Kit with Spray Explosives Detection Technology', '', '<b><font face="verdana" color="red">This product only can be shipped in US only</font></b><br>\n\n\nExpray is a unique, aerosol-based explosive detection system field test kit for the explosives detection and identification of the following explosive types:\n\n- Group A explosives (e.g. TNT, TNB, etc.),\n\n- Group B explosives (e.g. Semtex H, RDX, C4, etc.) and\n\n- compounds containing inorganic nitrates that are used in improvised explosives (e.g. ANFO).\n\nExpray is commonly used as a pre-blast explosives detectors, analytical detection system tool, post-blast explosives investigative tool, screen against potential terrorist explosive elements and as a technical evaluation test in soil remediation on hazardous material "clean-up" sites. When used as a post-blast explosives investigative tool, the product is field proven to speed up crucial explosive investigations.\n\nThe level of sensitivity (20 nanograms) surpasses that of other currently available explosive detection products. The explosives testing process is fast and efficient. No glass ampoules, spatulas or waiting period required. Explosive detection results appear in seconds. No additional tools or other explosives detectors equipment required. The identification/detection process requires no special training and testing can be performed "on the spot".\n\nFor both law enforcement and investigative personnel, Expray is a proven explosive detection devices for increasing the accuracy, efficiency and number of interdictions. For forensic and environmental laboratories, it has proven to reduce the number of samples submitted for testing, saving both time and money.\n\nExpray is sold in a kit configuration, which provides all three aerosol sprays, explosive testing collection papers, and an RDX-impregnated verification pad (verification pad is useful for ensuring that the spraycan still contains active reagents and for demonstrating how a positive reaction will appear) in a convenient plastic carry case.', '', 1000000, 65, 1409249071, 1),
(2151, 1, 0, 1115870400, 1, 0, 0, '', '', 0, 0, 0, 0, '22.35', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.200', 'See Through Transparency Spray', 'See Through Transparency Spray', 'See Through Transparency Spray', 2706, 2707, 2708, 0, 0, 0, '', 0, '', 0, '', 0, 'See Through Transparency Spray', '', 'See-Through is a transparency spray that you can use to inspect the contents of closed envelopes or paper wrapped packages without opening or damaging them, and without leaving any marks.\n\nIt is ideal for inspecting suspect envelopes and packages in your Business, Office or Home.\nForeign matter, such as a powder, will be seen as a darkened area in the envelope.\n\nSee-Through is a clear, non-conductive liquid that when sprayed on a suspect envelope or document will allow the user to clearly see the contents.\nAfter the document or envelope is dry (it dries in minutes), See-Through will not leave any traces or watermarks. Nor does it cause inks to run.', '', 1000000, 8, 1438018639, 1),
(2158, 1, 0, 1095307200, 1, 0, 0, 'DA-10P', '', 0, 0, 0, 0, '9.33', '0.00', 10, '8.83', '0.00', 25, '8.53', '0.00', '', '', '0.200', '5 Panel Urine Drug Test Kit with Adulteration Test Integrated in E-Z Split Cup', '5 Panel Urine Drug Test Kit with Adulteration Test Integrated in E-Z Split Cup', '5 Panel Urine Drug Test Kit with Adulteration Test Integrated in E-Z Split Cup', 2709, 2710, 2711, 0, 0, 0, '', 0, '', 0, '', 0, '5 Panel Urine Drug Test EZ Split Cup with Adulteration Test', '', 'The new 5 Panel Urine Drug Test Kit with Adulteration Test Integrated in E-Z Split Cup don''t need any additional instruments or equipment, it is complete drug testing kit for detection and recognition 5 most common illegal drugs, also known as NIDA-5: Cocaine, Amphetamine, Marijuana, Opiates, and Phencyclidine.\n\nAll inclusive design of this drug test kit exclude handle of the urine sample and ensure the veracity of urine sample and drug screening results. Activation of integrated drug test kit could be turned on by collectors only, as result, donor can not manipulate with specimen. Peel able label put out of sight drug test result from those who do not need to view results. Flat surface makes documenting result easy to read and copying.\n\nIntegrated drug test cup also includes adulteration test to check the integrity of a urine specimen and eliminate any attempts to pass a drug test procedure with different additives, pills or drinks.\n\nOur drug test kit cup also provides testing for Oxidants, Special Gravity, and pH. The easy Split Key Cup is an affordable drug testing solution that provides a quality screening method with (99%) accurate results.', '', 999931, 993, 1389897049, 1),
(2159, 1, 0, 1095307200, 1, 0, 0, '', '', 0, 0, 0, 0, '445.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '5.000', 'Employer''s All-Inclusive Drug Testing Pack', 'Employer''s All-Inclusive Drug Testing Pack', 'Employer''s All-Inclusive Drug Testing Pack', 2712, 2713, 2714, 0, 0, 0, '', 0, '', 0, '', 0, 'Employer''s All-Inclusive Drug Testing Pack', '', 'Now we offer NEW DRUG TESTING PACK bundled with 1 (one) prepaid GC/MS Laboratory drug testing confirmation for non-negative results. Extra GC/MS Lab confirmations are available for purchase. Our drug test package includes everything you need to organize drug testing in your business or educational organization.\n\nList of contents:\n<ul>\n<li> 50 Integrated EZ Split Key Drug Testing Cups with adulteration tests is a 5-way drug testing kit that tests for Marijuana, Cocaine, Opiates, Methamphetamine and PCP with additional specimen validity system integrated in to the cup. \n<li> 1 GC/MS urine drug test laboratory confirmation for preliminary positive rapid drug test results (More kits available for purchase)\n<li> 50 Forms of applicant notice and acknowledgement about drug testing procedure. \n<li> 50 pair of latex powder free examination gloves.\n</ul>', '', 1000000, 1, 1389897049, 1),
(2160, 1, 0, 1095307200, 1, 0, 0, 'ox1', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.040', 'Rapid Urine OXYCONTIN Drug Test Cassette', 'Rapid Urine OXYCONTIN Drug Test Cassette', 'Rapid Urine OXYCONTIN Drug Test Cassette', 2715, 2716, 2717, 0, 0, 0, '', 0, '', 0, '', 0, 'Rapid Urine OXYCONTIN Drug Test Cassette', '', 'Rapid Urine OXYCONTINE Drug Test Cassette is a one-step, on-site, rapid urine drug test for detection of oxycodone in human urine. This drug testing kit recommended for in vitro diagnostic. The Oxycontin Rapid Urine Drug Test Cassette show a positive result when its concentration exceeds 100 ng/ml. Oxycodone also known under brand names: Precocet, Roxicet, Tylox, Hydrodocone, Roxicodone, and OxyContin and usually used to help with moderate to over moderate pain. It also is used to relieve postpartum, postoperative, and sharp dental pain. It is a semi-syntetic drug from opioid group, but it is not always detectable with opiate urine drug test kits.\n\nStreet Names: Oxy; OC; hillbilly heroin\n\nDetection in Urine: The detection time window is 1-3 days following use\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 999989, 499, 1438018639, 1),
(2161, 1, 0, 1095307200, 1, 0, 0, 'DA-3POP', '', 0, 0, 0, 0, '0.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.050', 'Latex Powder Free Exam Gloves 5 pairs', 'Latex Powder Free Exam Gloves 5 pairs', 'Latex Powder Free Exam Gloves 5 pairs', 2718, 2719, 2720, 0, 0, 0, '', 0, '', 0, '', 0, 'Latex Powder Free Exam Gloves 5 pairs', '', 'Latex Powder Free Exam Gloves 5 pairs', '', 1000000, 86, 1438018639, 1),
(2164, 1, 0, 1095307200, 1, 0, 0, 'DA-CMTC', '', 0, 0, 0, 0, '2.34', '0.00', 10, '1.64', '0.00', 25, '1.07', '0.00', '', '', '0.030', 'THC Marijuana Drug Test Urine Cassette', 'THC Marijuana Drug Test Urine Cassette', 'THC Marijuana Drug Test Urine Cassette', 2721, 2722, 2723, 0, 0, 0, '', 0, '', 0, '', 0, 'THC Marijuana Drug Test Urine Cassette', '', 'The one step THC(Tetrahydrocannabinol) marijuana drug test urine kit is a simple one step immunochromatographic drug testing assay for the rapid, qualitative detection of THC(Marijuana) in urine. The cutoff of the test is 50 ng/ml of THC(Marijuana). It is the same as the SAMHSA recommended for marijuana drug test screening assay cutoff.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.38    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.64\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.07ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 3821, 1438018639, 1),
(2165, 1, 0, 1115874000, 1, 0, 0, '', '', 0, 0, 0, 0, '6.45', '0.00', 10, '6.35', '0.00', 25, '6.20', '0.00', '', '', '0.100', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/MET/OPI/AMP)', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/MET/OPI/AMP)', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/MET/OPI/AMP)', 2724, 2725, 2726, 0, 0, 0, '', 0, '', 0, '', 0, 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/MET/OPI/AMP)', '', 'This test is for:\n\nTHC/Marijuana,COC/Cocaine,MET/Methamphetamine,OPI/Opiates,AMP/Amphetamines\n\nOrders for custom combinations can also be handled by special request with a lead time of 5-7 weeks with a minimum quantity of 1000 pieces \n<ul>\n<li>We use Xalex drugs test kits, because we demand the highest quality in our drug testing products \n<li>The conveniences of Xalex drug testing procedures are the simplest on the market for our customers\n<li>Xalex packages drug testing kits in the most attractive display \n<li>We are always stand behind Xalex drug screen testing products\n</ul>', '', 1000000, 260, 1438018639, 1),
(2166, 1, 0, 1115874000, 1, 0, 0, '', '', 0, 0, 0, 0, '6.45', '0.00', 10, '6.35', '0.00', 25, '6.20', '0.00', '', '', '0.100', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/OPI/AMP/PCP)', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/OPI/AMP/PCP)', 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/OPI/AMP/PCP)', 2727, 2728, 2729, 0, 0, 0, '', 0, '', 0, '', 0, 'Xalex Multi Drug Testing Kit for 5 Drugs (THC/COC/OPI/AMP/PCP)', '', 'This test is for:\n\nTHC/Marijuana,COC/Cocaine,OPI/Opiates,AMP/Amphetamines,PCP/Angel Dust\n\nOrders for custom combinations can also be handled by special request with a lead time of 5-7 weeks with a minimum quantity of 1000 pieces \n<ul>\n<li>We use Xalex drugs test kits, because we demand the highest quality in our drug testing products \n<li>The conveniences of Xalex drug testing procedures are the simplest on the market for our customers\n<li>Xalex packages drug testing kits in the most attractive display \n<li>We are always stand behind Xalex drug screen testing products\n</ul>', '', 1000000, 60, 1438018639, 1),
(2167, 1, 0, 1115870400, 1, 0, 0, 'xthc', '', 0, 0, 0, 0, '2.69', '0.00', 10, '2.24', '0.00', 25, '1.89', '0.00', '', '', '0.100', 'Xalex Drug Testing Kit for Marijuana (THC)', 'Xalex Drug Testing Kit for Marijuana (THC)', 'Xalex Drug Testing Kit for Marijuana (THC)', 2730, 2731, 2732, 0, 0, 0, '', 0, '', 0, '', 0, 'Xalex Drug Testing Kit for Marijuana (THC)', '', 'We offer single drug tests in a cassette or dipstrip format for detecting illegal drugs of abuse, They are packaged in a white, non descript pouches. \nOrders for custom combinations can also be handled by special request with a lead time of 5-7 weeks with a minimum quantity of 1000 pieces \n\n<ul>\n<li>We use Xalex drugs test kits, because we demand the highest quality in our drug testing products \n<li>Drug testing procedure has never been as easy and results so accurate as with the Xalex Marijuana drug testing kit \n<li>Our knowledgeable staff is always ready to help you, and answer any questions regarding Marijuana drug testing \n<li>510K FDA approved drug testing products is the right choice \n<li>There is only one Xalex drugs test kits unlike the many other generic, unbranded tests\n</ul>\n\nYour total satisfaction is our ultimate goal. We achieve it with our most accurate and easy to use drug testing products.\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.69      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$2.24\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.89 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 972, 1438018639, 1),
(2168, 1, 0, 1115874000, 1, 0, 0, '', '', 0, 0, 0, 0, '7.45', '0.00', 10, '7.30', '0.00', 25, '7.10', '0.00', '', '', '0.100', 'Xalex Multi Drug Testing Kit for 6 Drugs', 'Xalex Multi Drug Testing Kit for 6 Drugs', 'Xalex Multi Drug Testing Kit for 6 Drugs', 2733, 2734, 2735, 0, 0, 0, '', 0, '', 0, '', 0, 'Xalex Multi Drug Testing Kit for 6 Drugs', '', 'In this comprehensive urine drug test kit, we detect the presence of the 6 most common drugs that are found in today''s "drug society".\nCOC/Cocaine, AMP/Amphetamines, MAMP/Methamphetamine, THC/Marijuana, OPI/Opiates, BZO/ Benzodiazepine\n\nWe have the availability to customize the combination of illegal drugs by special request with a lead time of 5-7 weeks with a minimum quantity of 1000 pieces \n\n<ul>\n<li>6 Panel Xalex Multi drug screen urine testing kit is one of the most cost effective tests available in the market place\n<li>Multi drug screen 6 Panel Xalex urine test kit detects the six most prominent of illegal drugs being consumed \n<li>With the Xalex drug testing family of test kits you are assured of testing individuals with the highest in quality and accuracy.\n<li>Our tests kits are very simple to administer and this makes both the small and large employers require it as part of their NO DRUGS IN THE WORKPLACE policy \n<li>You can save even more when you purchase in quantity. Our test kits have a long shelf life and only need simple storage requirements\n<li>You can rely on the accuracy of the drug test kit when it has the 510K FDA approval \n</ul>', '', 1000000, 187, 1438018639, 1),
(2169, 1, 0, 1115874000, 1, 0, 0, '', '', 0, 0, 0, 0, '11.50', '0.00', 10, '11.40', '0.00', 25, '11.25', '0.00', '', '', '0.100', 'Xalex Multi Drug Testing Kit for 10 Drugs', 'Xalex Multi Drug Testing Kit for 10 Drugs', 'Xalex Multi Drug Testing Kit for 10 Drugs', 2736, 2737, 2738, 0, 0, 0, '', 0, '', 0, '', 0, 'Xalex Multi Drug Testing Kit for 10 Drugs', '', 'In this all inclusive urine drug test kit we screen for ten of the most common illegal substances found being used today. \nCOC/Cocaine, AMP/Amphetamines, MAMP/Methamphetamine, THC/Marijuana, MOP/Opiates, BZO/ Benzodiazepine, MTD/Methadone, PCP/Angel Dust, BAR/Barbiturate, TCA/Tricyclic, Antidepressants\n\nWe have the availability to customize the combination of illegal drugs by special request with a lead time of 5-7 weeks with a minimum quantity of 1000 pieces \n\n<ul>\n<li>10 Panel Xalex Multi drug screen urine testing kit is one of the most cost effective tests available in the market place\n<li>Multi drug screen 10 Panel Xalex urine test kit detects the six most prominent of illegal drugs being consumed \n<li>With the Xalex drug testing family of test kits you are assured of testing individuals with the highest in quality and accuracy.\n<li>Our tests kits are very simple to administer and this makes both the small and large employers require it as part of their NO DRUGS IN THE WORKPLACE policy \n<li>You can save even more when you purchase in quantity. Our test kits have a long shelf life and only need simple storage requirements\n<li>You can rely on the accuracy of the drug test kit when it has the 510K FDA approval \n</ul>', '', 1000000, 303, 1438018639, 1),
(2684, 1, 0, 1116475200, 1, 0, 0, '', '', 0, 0, 0, 0, '22.50', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.500', 'The Neck Ring Herbal Aromatherapy Heating Cooling Pack', 'The Neck Ring Herbal Aromatherapy Heating Cooling Pack', 'The Neck Ring Herbal Aromatherapy Heating Cooling Pack is a soothing way to relieve neck & shoulder pain. It can be used tight around the neck or loose resting on the shoulder area. Used as a hot pack it can relieve pain, stiffness, stress, and increases blood circulation', 2739, 2740, 2741, 0, 0, 0, '', 0, '', 0, '', 0, 'The Neck Ring Herbal Aromatherapy Heating Cooling Pack', '', 'The Neck Ring Herbal Aromatherapy Heating Cooling Pack is a soothing way to relieve neck & shoulder pain. It can be used tight around the neck or loose resting on the shoulder area. Used as a hot pack it can relieve pain, stiffness, stress, and increases blood circulation\n\nIn the microwave: Heat in microwave for 1 to 3 minutes. (Lighter weight products require less heating time. Eye pillows will require only about 30 seconds). If microwave does not have a turntable, flip Herb Pack over 1/2 way thru heating to avoid burning. For a moister heat: mist with water before heating. Misting also increases lif of herb by preserving freshness. When reheating, if Herb Pack is still warm, heat only for 1 to 2 minutes to prevent overheating.\n\nHeat lasts for approximately 45 minutes. Heating for more than 3 minutes at once could result in overheating or burning. If pack seems too hot, leave cool prior to use.\n\nIn the oven: Heat oven to 350, wrap Herb Pack in tin foil. Heat for approximately 15 minutes. Do not oven heat products with velcro, as velcro may melt.\n\nFor a Cold Pack:Place in a plastic bag and place in freezer for 1-2 hours. Pack will stay cold for up to 45 minutes!!!', '', 1000000, 31, 1438018639, 1),
(7901, 1, 0, 1095307200, 1, 0, 0, 'MT-HIV', '', 0, 0, 0, 0, '47.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.600', 'The Home Access HIV-1 Test Kit System', 'The Home Access HIV-1 Test Kit System', 'The Home Access HIV-1 Test Kit System', 2742, 2743, 2744, 0, 0, 0, '', 0, '', 0, '', 0, 'The Home Access HIV-1 Test Kit System', '', 'Currently there is new way in the battle with AIDS because early recognition and treatment can save life.\n\nThe latest Anti-AIDS medicines are giving a hope for the HIV infected persons. Many of AIDS infected have regained control of their lives, even if they have not yet any cure. New pharmaceutical treatments could convert AIDS into a controllable form, and some patients even have no measurable rank of AIDS virus in their blood. If you suspect any possibilities of infection there is a better time to get tested. HIV-1 Home Test Kit System from Home Access® results and counseling are absolutely anonymous. The simple at home specimen collection process combined with the accurate laboratory testing process insures that you get a reliable test result fast and easily.\n\n<ul>\n<li>HIV-1 Home Test Kit System from Home Access® FDA Approved - The only U.S. Food and Drug Administration approved HIV-1 test system. \n<li>Accurate Test - Clinically proven to be more than HIV-1 Home Test Kit System from Home Access® 99.9% accurate. \n<li>Anonymous Result - You are identified only by a code number that comes with your HIV-1 Home Test Kit System from Home Access®. \n<li>Manufacturer Help Line - Toll-free telephone support for HIV-1 Home Test Kit System from Home Access® and result questions. \n<li>Timely Test - Accurate results of HIV-1 Home Test Kit System from Home Access® in seven days.\n</ul>', '', 1000000, 75, 1438018639, 1),
(10374, 1, 0, 1095307200, 1, 0, 0, 'DOA-QT', '', 0, 0, 0, 0, '7.50', '0.00', 10, '6.50', '0.00', 25, '5.88', '0.00', '', '', '0.070', 'Multi Drug Testing Cup QTEST™', 'drug test urine', 'Multi Drug Testing Cup QTEST™', 2745, 2746, 2747, 0, 0, 0, '', 0, '', 0, '', 0, 'Multi Drug Testing Cup QTEST™-5', '', 'QTEST™ - One Step On Site Multi Drug Testing Cup could detect and recognize following illegal drugs of abuse: \n<ul>\n<li>Amphetamine (AMP)\n<li>Cocaine (COC) \n<li>Opiates (OPI) \n<li>Phencyclidine (PCP) \n<li>Marijuana (THC)\n</ul>\n\n*This combinations well known for everybody who involved in drug screening test procedure and usually named as NIDA-5, because it is the combinations of the urine drug test panels made accordind to requirments of National Institute Drugs of Abuse. \nDirections for use:\n<ul>\n<li>Insert urine into the QTEST™ cup - One Step On Site Multi Drug Testing Cup and replace cap \n<li>In 5 minutes you can read the drug screen testing results \n<li>If you need to confirm non-negative (preliminary positive) drug screen test result, send cup to laboratory \n</ul>\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$7.50    ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.50\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.88 each.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping card will adjust with quantity', '', 1000000, 169, 1438018639, 1),
(933944, 1, 0, 1294030800, 1, 0, 0, '11as', '', 0, 0, 0, 0, '12.25', '0.00', 10, '10.77', '0.00', 25, '9.88', '0.00', '', '', '0.200', '', '', '', 2748, 2749, 2750, 0, 0, 0, '', 0, '', 0, '', 0, '11 Panel Drug Test Cup QTEST CLIA', '', 'CLIA waived cup. QTEST drug test cup tests for 11 drugs simultaneously.<br />\n\n<br><b>Drug Testing Strip Name Cut-Off Detection Level (ng/ml)</b> <br />\nAMP-Amphetamine 1000 <br />\nBAR-Barbiturate 300 <br />\nBZO-Benzodiazepine 300 <br />\nCOC-Cocaine 300 <br />\nMAD-Methadone 300 <br />\nMET-Methamphetamine 1000 <br />\nOPI-Opiates 2000 <br />\nOXY-Oxycodone 100 <br />\nPCP-Phencyclidine  25 <br />\nTHC-Marijuana 50 <br />\nTCA-Tricyclic Antidepressant 1000\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$10.77 ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$10.77\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$9.88 each.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping card will adjust with quantity', '', 1000000, 36, 1389897049, 1),
(933945, 1, 0, 1294030800, 1, 0, 0, 'HT-ext', '', 0, 0, 0, 0, '84.50', '0.00', 5, '79.80', '0.00', 10, '78.50', '0.00', '', '', '0.500', '', '', '', 2751, 2752, 2753, 0, 0, 0, '', 0, '', 0, '', 0, 'Extended Opiates Hair Drug Test', '', 'Extended Opiates Hair drugs testing are able to detect Hydrocodone (Vicodin and Lortab), Hydromorphone (Dilaudid), and Oxycodone (Percocet/Percodan). Abuse of Carisoprodol (Soma) and Hydrocodone (Vicodin) at the same time can cause the Opiates to be very high. As a regular Hair Follicle Drugs of Abuse test, extented opiates test uses Gas Chromatography/Mass Spectrometry (GC/MS) to confirm if tested positive through the screening cutoffs. Laboratory drug testing results are valid for Pre-Employment, Random, Reasonable Suspicion/Cause, or Personal Testing purposes.\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 5 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$84.50      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 10 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$79.80 ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$78.50 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 0, 1389897049, 1),
(933946, 1, 0, 1095307200, 1, 0, 0, 'CH-MT', '', 0, 0, 0, 0, '49.50', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.200', 'Infidelity Home Test Kit CheckMate', 'Infidelity Home Test Kit CheckMate', 'Infidelity Home Test Kit CheckMate', 2754, 2755, 2756, 0, 0, 0, '', 0, '', 0, '', 0, 'Infidelity Home Test Kit CheckMate', '', 'Check your mate with the laboratory proved home test kit CheckMate™.\nNow each box contains second test for FREE! For Men or Women, 5 minute infidelity test kit. Do you suffer from the nightmare of suspicion and doubt caused by the infidelity of a cheating spouse? Find out "What''s really going on" the quick and easy way with the CheckMate™ semen detection test kit. He or she brings the evidence home to you without even knowing it.\n\nThe Original CheckMate semen detection test kit will quickly and easily monitor your cheating spouse''s sexual activity outside of the relationship by detecting traces of dried semen that is left in their undergarments after sex. If you need to know what''s really going on in your relationship and you need to know now, try the CheckMate semen detection test kit. Now you can quickly, easily, and accurately detect and identify suspected semen and or "sperm" stains in undergarments in 5 minutes or less with the revolutionary CheckMate semen detection test kit.\n\n<ul>\n<li> Laboratory proven test results \n<li> Quick, easy, and affordable test kit \n<li> Discreet and confidential infidelity test\n<li> 24 hr. Customer Service \n<li> Contains a full liquid ounce - Test 5 or more times\n<li> Manufacturer''s 100% Money Back Guarantee! \n<li> Available in stores\n<li> Find out what''s really going on today\n</ul>', '', 1000000, 28, 1389897049, 1),
(1061430, 1, 0, 1310961600, 1, 0, 0, 'DTP-12', '', 0, 0, 0, 0, '7.20', '0.00', 10, '6.95', '0.00', 25, '6.50', '0.00', '', '', '0.070', '', '', '', 2757, 2758, 2759, 0, 0, 0, '', 0, '', 0, '', 0, '12 Drug Test Kit', '', '12 Drug Dip Panel Test is testing for: COC, THC, OPI, AMP, mAMP, PCP, BZO, BAR, MTD, MDMA, OXY, PPX and their metabolites.<br />\n\n<br><b>Drug Name Abbreviation Cutoff  <br />\nAmphetamine AMP 1000ng/ml  <br />\nBarbiturates BAR 300ng/ml <br />\nBenzodiazepines BZO 300ng/ml <br />\nCocaine COC 300ng/ml <br />\nMarijuana THC 50ng/ml  <br />\nMethadone MTD 300ng/ml<br />\nEcstasy MDMA 500ng/ml <br />\nMethamphetamine mAMP 1000ng/ml <br />\nOpiates OPI 2000ng/ml<br />\nOxycodone OXY 100ng/ml <br />\nPhencyclidine PCP 25ng/ml <br />\nPropoxyphene PPX 300ng/ml</b>\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$7.20      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.95\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.50 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000003, 197, 1389897049, 1);
INSERT INTO `sc_product` (`prdID`, `active`, `priority`, `time_available`, `in_stock`, `is_new`, `mnfID`, `model`, `url`, `price_type`, `price_type_new`, `spec_time1`, `spec_time2`, `price`, `spec_price`, `opt1`, `price1`, `spec_price1`, `opt2`, `price2`, `spec_price2`, `measure`, `dimensions`, `weight`, `meta_title`, `meta_keywords`, `meta_description`, `uplID1`, `uplID2`, `uplID3`, `uplID4`, `uplID5`, `uplID6`, `doc1`, `docID1`, `doc2`, `docID2`, `doc3`, `docID3`, `name`, `comment`, `description`, `attributes`, `quantity`, `num_choosed`, `last_modified`, `product_updated`) VALUES
(1061431, 1, 0, 1310961600, 1, 0, 0, 'AD25', '', 0, 0, 0, 0, '14.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.150', '', '', '', 2760, 2761, 2762, 0, 0, 0, '', 0, '', 0, '', 0, 'Adulteration Tests 25 in Cannister', '', 'Tests for 7 parameters on six pads<br />\n25 tests in Cannister.<br />\nWill detect adultartion of following:<br />\n<br />\n<b>Nitrite</b> tests for commonly used commercial adulterants such as Klear or Whizzies. They work by oxidizing the major cannabinoid metabolite THC-COOH.9 Normal urine should contain no trace of nitrite. Positive results generally indicate the presence of an adulterant. <br />\n<br />\n<b>Creatinine</b> is a waste product of creatine (an amino-acid contained in muscle tissue), is a normal constituent of human urine. In specimen validity testing, creatinine is used as a marker for dilution. Specimen dilution can be either in vivo (the donor drank excessive volumes of liquids) or in vitro (liquid was added to the urine after collection) and represent the most common form of specimen tampering. In vivo dilution using diuretics is often referred to as “flushing.” Creatinine and specific gravity are often interpreted simultaneously as indicators for dilution. Low Creatinine and low specific gravity levels indicate dilute urine. <br />\n<br />\n<b>Glutaraldehyde</b> is a chemical compound that, when used as an adulterant, is believed to inactivate the enzyme used in the EMIT automated drug screening reagent. Although it is not believed to produce false negative results on a lateral flow test, commercial adulteration agents UrinAid and Clear Choice still contain Glutaraldehyde. Glutaraldehyde is not normally in urine so detection of the compound is generally an indication of adulteration.<br />\n<br />\n<b>pH</b> tests for the presence of acidic or alkaline adulterants in urine. Normal urine pH levels should be in the range of 4.0 to 9.0. Values outside of this range may indicate the sample has been adulterated.<br />\n<br />\n<b>Specific Gravity</b> tests for the “viscosity” of the urine sample. The SG range for normal human urine is from 1.003 to 1.030. Values outside this range should be considered abnormal and may indicate specimen tampering.<br />\n<br />\n<b>Oxidant/PCC</b> tests for the presence of oxidizing reagents such as bleach, hydrogen peroxide, and pyridinium chlorochromate (PCC). Like nitrites, oxidants work to modify the structure of the target drugs in urine (like THCCOOH). Many commercial adulterants contain oxidants or PCC. Examples include UrineLuck (PCC) and Stealth (peroxidase). Normal urine should contain no trace of oxidants/PCC. Nitrites are a class of chemicals not usually found in normal human urine. Commercial adulterants Klear and Whizzies use nitrites as their primary active ingredient. Nitrites work by oxidizing the major cannabinoid metabolite (THCCOOH). The intent of oxidizing THC-COOH is to render it undetectable by the immunoassay or confirmation methods. Recent research suggests that performing the immunoassay drug screen shortly after the urine collection limits the effectiveness of the nitrite since the chemical needs time to modify the THC-COOH compound. By the time a positive sample arrives to the lab for confirmation, however, the THC-COOH has often been destroyed. Normal human urine should contain no trace of nitrites and, as such, presence of nitrites in urine generally indicates the use of an adulterant.', '', 1000000, 9, 1389897049, 1),
(1061434, 1, 0, 1311048000, 1, 0, 0, 'BUP1', '', 0, 0, 0, 0, '2.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.040', '', '', '', 2763, 2764, 2765, 0, 0, 0, '', 0, '', 0, '', 0, 'Suboxone Drug Test', '', 'The Buprenorphine drug test will detect use of Suboxone® This drug used replacement for opiate addiction . Buprenorphine, a derivative of thebaine, provides pain relief and also produces a narcotic high. In fact, Buprenorphine was originally used for pain relief purposes over many years ago.<br />\n<br />\nSubutex® is a brand name for buprenorphine in its pure form. Suboxone® combines buprenorphine with naloxone, an opiate antagonist. Buprenex® or Suboxone® easier to eventually stop using.', '', 1000000, 32, 1438018639, 1),
(1061435, 1, 0, 1311048000, 1, 0, 0, '12as', '', 0, 0, 0, 0, '12.95', '0.00', 10, '10.97', '0.00', 25, '9.95', '0.00', '', '', '0.000', '', '', '', 2766, 2767, 2768, 0, 0, 0, '', 0, '', 0, '', 0, 'QTEST 12 Panel Drug testing Cup', '', '12 panel drug test for  illegal substances of abuse.<br />\n<br />\nThe determination of how long drug metabolites remain in the human system has no fixed basis. Variables such as weight, percentage of body fat, metabolism, frequency, dosage and duration of drug use affect drug detection period. <br />\nThis is very important, that list of drugs detectable and recognizable with our new drug test cup includes the OXY – Oxycodone test: <br />\n<br />\nAmphetamine cut-off level 1000ng/ml<br />\nBarbiturate cut-off level 300 ng/ml <br />\nBenzodiazepines  cut-off level 300 ng/ml <br />\nCocaine cut-off level 300 ng/ml<br />\nMarijuana  cut-off level 50 ng/ml<br />\nMethadone cut-off level 300 ng/ml<br />\nMethamphetamine cut-off level 1000 ng/ml<br />\nOpiates  cut-off level 300 ng/ml<br />\nOxycodone  cut-off level 100 ng/ml<br />\nPhencyclidine  cut-off level 25 ng/ml<br />\nPropoxyphene  cut-off level 300 ng/ml<br />\nTricyclic Antidepressant cut-off level 1000 ng/ml\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$12.95      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24\n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$10.97\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$9.95 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping card will adjust with quantity', '', 1000000, 14, 1438018639, 1),
(1064184, 1, 0, 1313640000, 1, 0, 0, '14Tcup', '', 0, 0, 0, 0, '12.00', '0.00', 5, '10.95', '0.00', 25, '9.95', '0.00', '', '', '0.200', '', '', '', 2769, 2770, 2771, 0, 0, 0, '', 0, '', 0, '', 0, '14 Panel Drug Test Cup T cup', '', '14 Panel Drug Test Cup Tests for Following Drugs of Abuse:<br />\n<br />\nCOC - Cocaine<br />\nTHC - Marijuana<br />\nOPI - Opiates<br />\nmAMP - Methamphetamines<br />\nTCA - Tricyclic Antidepressants<br />\nOXY - Oxycodone<br />\nBZO - Benzodiazepenes  BUP - Buprenorphine<br />\nBAR - Barbiturates<br />\nMTD - Methadone<br />\nAMP - Amphetamines<br />\nMDMA - Ecstasy<br />\nPCP - Phencyclidine<br />\nPPX - Propoxyphene  <br />\n<br />\n<b>And 3 Adulterants</b>\n\nSpecific Gravity \nPH\nOxidant/Bleach\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1 - 4 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$12.00     ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">5 - 24 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$10.95      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$9.95 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 85, 1389897049, 1),
(1064209, 1, 0, 1313726400, 1, 0, 0, 'HCG-C', '', 0, 0, 0, 0, '1.15', '0.00', 10, '0.90', '0.00', 25, '0.75', '0.00', '', '', '0.020', '', '', '', 2772, 2773, 2774, 0, 0, 0, '', 0, '', 0, '', 0, 'HCG Pregnancy Cassette CLIA Waived', '', 'HCG pregnanccy casstte early pregnancy test is designed for rapid determination of human chronic gonadotropin (hCG) in human urine Four drops of specimen are dropped in the sample well of the cassette. Results are read in 5 minutes.<br />\n<br />\n* CLIA Waived<br />\n* FDA Cleared <br />\n<br />\n<br><br><b>CLIA Waived HCG Urine test CPT code:81025QW Reimbursement $9.24</b><br />\n\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$1.15  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.90      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$0.75 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 309, 1389897049, 1),
(1064210, 1, 0, 1313726400, 1, 0, 0, 'AL-MA', '', 0, 0, 0, 0, '129.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '1.500', '', '', '', 2775, 2776, 0, 0, 0, 0, '', 0, '', 0, '', 0, 'AlcoMate Prestige AL-6000  Full Kit', '', 'AlcoMate Prestige (AL6000) Breathalyzer detects blood alcohol concentration for personal or business use.<br />\n<br><b>This is full kit that includes</b>:<br />\n<li>The Prestige Installed Sensor<br />\n<li>Field Carrying Case<br />\n<li>Protective Pouch<br />\n<li>5 Mouthpieces<br />\n<li>Batteries<br />\n<li>Hand Strap<br />\n<li>User''s Guide<br />\n<li>Retail Box', '', 1000000, 1, 1389897049, 1),
(1064212, 1, 0, 1313985600, 1, 0, 0, 'STREP A', '', 0, 0, 0, 0, '39.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '1.600', '', '', '', 2777, 2778, 2779, 0, 0, 0, '', 0, '', 0, '', 0, 'Strep A Test Strips, 25/bx', '', 'Strep A Test Strips, 25/bx<br />\n<br />\nFeatures of Strep A Test Strips: The  is a lateral flow, one-step immunoassay for the rapid,qualitative detection of Group A Streptococcal antigen from throat swabs. The test is intended for use as an aid in the diagnosis of Group A Streptococcal infection. Rapid Strep A antigen test. Test results in 5 minutes. CLIA-waived. Dipstick format. Controls included. Includes: 25 test packs, 25 sterile throat swabs, extraction reagent, positive control, and negative control', '', 1000000, 1, 1438018639, 1),
(1064213, 1, 0, 1313985600, 1, 0, 0, '', '', 0, 0, 0, 0, '5.99', '0.00', 10, '5.40', '0.00', 25, '4.92', '0.00', '', '', '0.300', '', '', '', 2780, 2781, 2782, 0, 0, 0, '', 0, '', 0, '', 0, 'K Cup Drug Testing Cup 5 Panel', '', '<b>KCup is a 5 Panel Integrated Drug Test Cup.</b> <br />\n<br />\nOnce the sample is provided, the operator determines when the testing begins. Perfect for collection where the testing parameters need to be controlled.<br />\n<br />\n•FDA 510K<br />\n•5-10 Panels<br />\n•Built in Temperature Strip<br />\n•Testing begins when the operator turns the included key<br />\n<br />\n <br />\n<b>This cup tests for COC/THC/OPI/AMP/mAMP</b><p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.99  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$5.40      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$4.92 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 46, 1438018639, 1),
(1064214, 1, 0, 1314072000, 1, 0, 0, '', '', 0, 0, 0, 0, '7.50', '0.00', 10, '7.15', '0.00', 25, '6.75', '0.00', '', '', '0.200', '', '', '', 2783, 2784, 2785, 0, 0, 0, '', 0, '', 0, '', 0, 'K Cup 7 Panel Drug Testing Cup', '', '<b>KCup 7 panel Drug Test Integrated Key Cup. </b><br />\n5 minute drug test. The drug test will start when the key is turned. This way you will control when to start the test.<br />\n <br />\n•FDA 510K<br />\n•5-12 Panels<br />\n•Built in Temperature Strip<br />\n•Testing begins when key is turned <br />\n<br />\n<b>Testing for following :COC/THC/OPI/AMP/mAMP/BZO/OXY</b> <br />\n<br />\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$7.50  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$7.15\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$6.50 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 105, 1389897049, 1),
(1064219, 1, 0, 1314158400, 1, 0, 0, '', '', 0, 0, 0, 0, '9.50', '0.00', 10, '9.00', '0.00', 25, '8.75', '0.00', '', '', '0.200', '', '', '', 2786, 2787, 2788, 0, 0, 0, '', 0, '', 0, '', 0, 'K Cup Drug Test Cup for 10 Drugs of Abuse', '', 'K Cup Drug Test Cup for 10 Drugs of Abuse:<br />\n<br />\n<li>Methamphetamines (MET) Amphetamines,Methamphetamines and MDMA <br />\n<li>Barbiturates (BAR) Barbitals <br />\n<li>Benzodiazepines (BZO) Diazepam, Oxazepam and more similar pills <br />\n<li>Buprenorphine (BUP) Suboxone, Subutex <br />\n<li>Cocaine (COC) – Cocaine, Crack <br />\n<li>Cannabinoids (THC) Marijuana, Hashish <br />\n<li>Methadone (MTD) Methadone and similar <br />\n<li>Opiate (OPI 2000) Morphine, Heroin <br />\n<li>Oxycodone (OXY) Hydrocodone, Hydromorphone <br />\n<li>Tricyclic Antidepressants (TCA) Nortryptiline, Desipramine and Protryptiline\n<p>\n<table border="0" cellspacing="0" cellpadding="1" width="175">\n  <tbody>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">1-9 \n      Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$9.50  ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" size="2">10-24  Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$9.00\n      ea.</font></nobr></span></td></tr>\n  <tr>\n    <td width="100%"><span class="pricing"><font color="#2662c2" \n      size=2>25+&nbsp;&nbsp; Tests</font></span></td>\n    <td><font color="#2662c2" size="2"><img border="0" \n      src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width=10 height=1></font></td>\n    <td><nobr><span class="pricing2"><font color="#2662c2" size="2">$8.75 ea.</font></nobr></span></td></tr></tbody></table><font color="#2662c2" \nsize=2><img border="0" src="http://ep.yimg.com/ca/Img/trans_1x1.gif" width="1" \nheight=5><br></font></p>\nThe shopping cart will adjust with quantity', '', 1000000, 48, 1389897049, 1),
(1064220, 1, 0, 1314244800, 1, 0, 0, '', '', 0, 0, 0, 0, '7.99', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.000', '', '', '', 2789, 2790, 2791, 0, 0, 0, '', 0, '', 0, '', 0, 'Meth Substance - Methamphetamine Surface Drug Testing', '', 'METH-X – a single drug test kit for the detection and identification of Methamphetamines on multiple surfaces. This is the test to determine if your house was used as a Meth Lab.  This test can also be used to test a suspicious substance (powder, residue, etc) to see if it is methamphetamine, ecstasy, etc.\n\n\n\n\n\n<br><br><br><img src="http://www.medimpex.us/images/Met-X-insert.jpg" alt="Met-X Drug Pen Test" width="500" height="300" align="middle"></br>', '', 999955, 78, 1438018639, 1),
(1138029, 1, 0, 1336017600, 1, 0, 0, 'UTI-1', '', 0, 0, 0, 0, '10.95', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '', '', '0.000', '', '', '', 2792, 2793, 2794, 0, 0, 0, '', 0, '', 0, '', 0, 'UTI Urinary Tract Infection 3 Tests In Box', '', 'UTI Urinary Tract Infection Test Strips. Detects urinary tract infections. Over the counter cleared 3 tests in box.', '', 1000000, 3, 1438018639, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sc_product_newval`
--

CREATE TABLE IF NOT EXISTS `sc_product_newval` (
  `prdID` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `url_name` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`prdID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `ID` varchar(32) NOT NULL DEFAULT '',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `site_gallery`
--

CREATE TABLE IF NOT EXISTS `site_gallery` (
  `imgID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(50) NOT NULL DEFAULT '',
  `alt` varchar(50) NOT NULL DEFAULT '',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`imgID`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `site_gallery`
--

INSERT INTO `site_gallery` (`imgID`, `time`, `uplID`, `comment`, `alt`, `width`, `height`) VALUES
(1, 1458676131, 1, '', '', 1366, 768);

-- --------------------------------------------------------

--
-- Структура таблицы `site_menu`
--

CREATE TABLE IF NOT EXISTS `site_menu` (
  `menuID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parID` int(10) unsigned NOT NULL DEFAULT '0',
  `static` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `pageID` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `newwin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuID`),
  KEY `parID` (`parID`,`priority`,`menuID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `site_pages`
--

CREATE TABLE IF NOT EXISTS `site_pages` (
  `pageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `static_page` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `in_map` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `url_name` varchar(255) NOT NULL DEFAULT '',
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_author` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content1` text NOT NULL,
  `content2` text NOT NULL,
  `bottom_links` varchar(255) NOT NULL DEFAULT '',
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `pageID1` int(10) unsigned NOT NULL DEFAULT '0',
  `pageID2` int(10) unsigned NOT NULL DEFAULT '0',
  `pageID3` int(10) unsigned NOT NULL DEFAULT '0',
  `pageID4` int(10) unsigned NOT NULL DEFAULT '0',
  `pageID5` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pageID`),
  KEY `type` (`type`,`priority`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Дамп данных таблицы `site_pages`
--

INSERT INTO `site_pages` (`pageID`, `type`, `static_page`, `active`, `priority`, `in_map`, `url_name`, `meta_title`, `meta_keywords`, `meta_description`, `meta_author`, `title`, `content1`, `content2`, `bottom_links`, `uplID`, `pageID1`, `pageID2`, `pageID3`, `pageID4`, `pageID5`, `last_modified`) VALUES
(1, 0, 'index.php', 1, 0, 0, '', '', '', '', '', 'Welcome to Cool Shop', 'Welcome to You!', '', '', 0, 0, 0, 0, 0, 0, 0),
(6, 0, 'map.php', 1, 0, 0, '', '', '', '', '', 'Site Map', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(8, 0, 'search.php', 1, 0, 1, '', '', '', '', '', 'Search', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(9, 0, 'search_prod.php', 1, 0, 0, '', '', '', '', '', 'Search Products', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(77, 0, 'sc.php', 1, 0, 0, '', '', '', '', '', 'Shopping Cart Content', '', '', '', 0, 0, 0, 0, 0, 0, 1146608747),
(11, 0, 'edit_item.php', 1, 0, 0, '', '', '', '', '', 'Edit Product''s Options', '<b>Here you may correct choosed product''s options</b>', '', '', 0, 0, 0, 0, 0, 0, 0),
(12, 0, 'login_form.php', 1, 0, 0, '', '', '', '', '', 'Customer Login', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(65, 0, 'addresses.php', 1, 0, 0, '', '', '', '', '', 'Enter shipping & billing info', '', '', '', 0, 0, 0, 0, 0, 0, 1146608206),
(68, 0, 'shipping_process.php', 1, 0, 0, '', '', '', '', '', 'Choose shipping method (Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608307),
(15, 0, 'login.php', 1, 0, 0, '', '', '', '', '', 'Customer Login (Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608428),
(66, 0, 'addresses_process.php', 1, 0, 0, '', '', '', '', '', 'Enter shipping & billing info (Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608214),
(67, 0, 'shipping.php', 1, 0, 0, '', '', '', '', '', 'Choose shipping method', '', '', '', 0, 0, 0, 0, 0, 0, 1146608300),
(70, 0, 'payment_process.php', 1, 0, 0, '', '', '', '', '', 'Enter payment info (Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608359),
(20, 0, 'OK.php', 1, 0, 0, '', '', '', '', '', 'Your order is processed', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(22, 0, 'contact_us.php', 1, 0, 1, '', '', '', '', '', 'Contact Us', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(30, 0, 'links.php', 1, 0, 0, '', '', '', '', '', 'Partners', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(26, 0, 'articles.php', 1, 0, 0, '', '', '', '', '', 'Articles', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(31, 0, 'stories.php', 1, 0, 0, '', '', '', '', '', 'Live Stories', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(28, 0, 'news.php', 1, 0, 1, '', '', '', '', '', 'News', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(29, 0, 'news_view.php', 1, 0, 0, '', '', '', '', '', 'View News', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(32, 0, 'story.php', 1, 0, 0, '', '', '', '', '', 'View Live Story', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(71, 0, 'register_form.php', 1, 0, 0, '', '', '', '', '', 'Customer Registration', '', '', '', 0, 0, 0, 0, 0, 0, 1146608486),
(73, 0, 'account.php', 1, 0, 0, '', '', '', '', '', 'Customer Account', '', '', '', 0, 0, 0, 0, 0, 0, 1146608595),
(41, 0, 'choice.php', 1, 0, 0, '', '', '', '', '', 'Are You Returned Customer?', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(46, 0, 'category.php', 1, 0, 0, '', '', '', '', '', 'View Category', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(47, 0, 'product.php', 1, 0, 0, '', '', '', '', '', 'View Product', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(48, 0, 'manufacturer.php', 1, 0, 0, '', '', '', '', '', 'View Manufacturer', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(75, 0, 'item_edit.php', 1, 0, 0, '', '', '', '', '', 'Edit Item in Shopping Cart', '', '', '', 0, 0, 0, 0, 0, 0, 1146608699),
(58, 0, 'order_view.php', 1, 0, 0, '', '', '', '', '', 'View Order Detail', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(61, 0, 'prod_bestseller.php', 1, 0, 1, '', '', '', '', '', 'Bestsellers', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(62, 0, 'prod_special.php', 1, 0, 1, '', '', '', '', '', 'Specials', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(63, 0, 'prod_new.php', 1, 0, 1, '', '', '', '', '', 'New Products', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(64, 0, 'prod_featured.php', 1, 0, 1, '', '', '', '', '', 'Featured Products', '', '', '', 0, 0, 0, 0, 0, 0, 0),
(69, 0, 'payment.php', 1, 0, 0, '', '', '', '', '', 'Enter payment info', '', '', '', 0, 0, 0, 0, 0, 0, 1146608350),
(72, 0, 'register.php', 1, 0, 0, '', '', '', '', '', 'Customer Registration (Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608494),
(74, 0, 'account_a.php', 1, 0, 0, '', '', '', '', '', 'Customer Account (Updating Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608603),
(76, 0, 'item_update.php', 1, 0, 0, '', '', '', '', '', 'Edit Item in Shopping Cart (Updating Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608706),
(78, 0, 'cart_update.php', 1, 0, 0, '', '', '', '', '', 'Shopping Cart Content (Updating Error)', '', '', '', 0, 0, 0, 0, 0, 0, 1146608760);

-- --------------------------------------------------------

--
-- Структура таблицы `site_uploads`
--

CREATE TABLE IF NOT EXISTS `site_uploads` (
  `suplID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `uplID` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`suplID`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `strID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`strID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `uplID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `save_name` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uplID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `uploads`
--

INSERT INTO `uploads` (`uplID`, `path`, `name`, `save_name`) VALUES
(1, 'uploads/gallery/1_1458676131', '??????????.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `uploads1`
--

CREATE TABLE IF NOT EXISTS `uploads1` (
  `uplID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `width` int(10) unsigned NOT NULL DEFAULT '0',
  `height` int(10) unsigned NOT NULL DEFAULT '0',
  `img_not_loaded` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uplID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2795 ;

--
-- Дамп данных таблицы `uploads1`
--

INSERT INTO `uploads1` (`uplID`, `path`, `name`, `width`, `height`, `img_not_loaded`) VALUES
(2541, 'uploads1/prod1/img1_00/000', '5173_1311869889.jpg', 150, 150, 0),
(2542, 'uploads1/prod1/img2_00/000', '5174_1311869889.jpg', 250, 250, 0),
(2543, 'uploads1/prod1/img3_00/000', '5175_1311869889.jpg', 250, 250, 0),
(2544, 'uploads1/products/img1', '5176_1116514766.jpg', 110, 110, 0),
(2545, 'uploads1/products/img2', '5177_1116514766.jpg', 187, 187, 0),
(2546, 'uploads1/products/img3', '5178_1116514766.jpg', 250, 250, 0),
(2547, 'uploads1/prod1/img1_00/000', '5182_1294853579.jpg', 150, 150, 0),
(2548, 'uploads1/prod1/img2_00/000', '5183_1294853579.jpg', 150, 150, 0),
(2549, 'uploads1/prod1/img3_00/000', '5184_1294853579.jpg', 250, 250, 0),
(2550, 'uploads1/products/img1', '5201_1116877019.jpg', 110, 110, 0),
(2551, 'uploads1/products/img2', '5202_1116877019.jpg', 187, 187, 0),
(2552, 'uploads1/products/img3', '5203_1116877019.jpg', 250, 250, 0),
(2553, 'uploads1/prod1/img1_00/000', '5207_1313764272.jpg', 110, 110, 0),
(2554, 'uploads1/prod1/img2_00/000', '5208_1313764283.jpg', 150, 150, 0),
(2555, 'uploads1/prod1/img3_00/000', '5209_1313764272.jpg', 150, 150, 0),
(2556, 'uploads1/products/img1', '5285_1116514791.jpg', 110, 110, 0),
(2557, 'uploads1/products/img2', '5286_1116514791.jpg', 187, 187, 0),
(2558, 'uploads1/products/img3', '5287_1116514791.jpg', 250, 250, 0),
(2559, 'uploads1/prod1/img1_00/000', '5288_1294853507.jpg', 150, 150, 0),
(2560, 'uploads1/prod1/img2_00/000', '5289_1294853507.jpg', 150, 150, 0),
(2561, 'uploads1/prod1/img3_00/000', '5290_1294853507.jpg', 250, 250, 0),
(2562, 'uploads1/prod1/img1_00/000', '5291_1294853627.jpg', 150, 150, 0),
(2563, 'uploads1/prod1/img2_00/000', '5292_1294853627.jpg', 150, 150, 0),
(2564, 'uploads1/prod1/img3_00/000', '5293_1294853627.jpg', 250, 250, 0),
(2565, 'uploads1/prod1/img1_00/000', '5294_1294853671.jpg', 150, 150, 0),
(2566, 'uploads1/prod1/img2_00/000', '5295_1294853671.jpg', 150, 150, 0),
(2567, 'uploads1/prod1/img3_00/000', '5296_1294853671.jpg', 250, 250, 0),
(2568, 'uploads1/products/img1', '5303_1115914562.jpg', 110, 110, 0),
(2569, 'uploads1/products/img2', '5304_1115914562.jpg', 187, 187, 0),
(2570, 'uploads1/products/img3', '5305_1115914562.jpg', 250, 250, 0),
(2571, 'uploads1/products/img1', '5306_1116514321.jpg', 110, 110, 0),
(2572, 'uploads1/products/img2', '5307_1116514321.jpg', 187, 187, 0),
(2573, 'uploads1/products/img3', '5308_1116514321.jpg', 250, 250, 0),
(2574, 'uploads1/products/img1', '5309_1116514297.jpg', 110, 110, 0),
(2575, 'uploads1/products/img2', '5310_1116514297.jpg', 187, 187, 0),
(2576, 'uploads1/products/img3', '5311_1116514297.jpg', 250, 250, 0),
(2577, 'uploads1/test', 'ovulationteststrips110.JPG', 110, 110, 0),
(2578, 'uploads1/test', 'ovulationteststrips187.JPG', 187, 187, 0),
(2579, 'uploads1/test', 'ovulationteststrips250.JPG', 250, 250, 0),
(2580, 'uploads1/prod1/img1_00/000', '5348_1313764386.jpg', 110, 110, 0),
(2581, 'uploads1/prod1/img2_00/000', '5349_1313764386.jpg', 150, 150, 0),
(2582, 'uploads1/prod1/img3_00/000', '5350_1313764386.jpg', 150, 150, 0),
(2583, 'uploads1/prod1/img1_00/000', '5360_1313693499.jpg', 110, 110, 0),
(2584, 'uploads1/prod1/img2_00/000', '5361_1313693499.jpg', 150, 150, 0),
(2585, 'uploads1/prod1/img3_00/000', '5362_1313693499.jpg', 150, 150, 0),
(2586, 'uploads1/prod1/img1_00/000', '5369_1314023778.jpg', 110, 110, 0),
(2587, 'uploads1/prod1/img2_00/000', '5370_1314023778.jpg', 150, 150, 0),
(2588, 'uploads1/prod1/img3_00/000', '5371_1314023778.jpg', 150, 150, 0),
(2589, 'uploads1/test', '7dayspredictor110.jpg', 110, 110, 0),
(2590, 'uploads1/test', '7dayspredictor187.jpg', 187, 187, 0),
(2591, 'uploads1/test', '7dayspredictor250.jpg', 250, 250, 0),
(2592, 'uploads1/prod1/img1_00/000', '5384_1314023460.jpg', 110, 110, 0),
(2593, 'uploads1/prod1/img2_00/000', '5385_1314023460.jpg', 150, 150, 0),
(2594, 'uploads1/prod1/img3_00/000', '5386_1314023460.jpg', 150, 150, 0),
(2595, 'uploads1/products/img1', '5390_1117573983.jpg', 110, 110, 0),
(2596, 'uploads1/products/img2', '5391_1117573983.jpg', 187, 187, 0),
(2597, 'uploads1/products/img3', '5392_1117573983.jpg', 250, 250, 0),
(2598, 'uploads1/test', 'sam1000s.jpg', 129, 106, 0),
(2599, 'uploads1/test', 'sam1000m.jpg', 210, 173, 0),
(2600, 'uploads1/test', 'sam1000b.jpg', 240, 197, 0),
(2601, 'uploads1/products/img1', '5420_1117632799.jpg', 110, 110, 0),
(2602, 'uploads1/products/img2', '5421_1117632799.jpg', 187, 187, 0),
(2603, 'uploads1/products/img3', '5422_1117632799.jpg', 250, 250, 0),
(2604, 'uploads1/products/img1', '5423_1117572710.jpg', 110, 110, 0),
(2605, 'uploads1/products/img2', '5424_1117572710.jpg', 187, 187, 0),
(2606, 'uploads1/products/img3', '5425_1117572710.jpg', 250, 250, 0),
(2607, 'uploads1/products/img1', '5435_1116873195.jpg', 110, 110, 0),
(2608, 'uploads1/products/img2', '5436_1116873195.jpg', 187, 187, 0),
(2609, 'uploads1/products/img3', '5437_1116873195.jpg', 250, 250, 0),
(2610, 'uploads1/products/img1', '5441_1117635224.jpg', 110, 110, 0),
(2611, 'uploads1/products/img2', '5442_1117635224.jpg', 187, 187, 0),
(2612, 'uploads1/products/img3', '5443_1117635224.jpg', 250, 250, 0),
(2613, 'uploads1/products/img1', '5447_1115905604.jpg', 110, 110, 0),
(2614, 'uploads1/products/img2', '5448_1115905604.jpg', 187, 187, 0),
(2615, 'uploads1/products/img3', '5449_1115905604.jpg', 250, 250, 0),
(2616, 'uploads1/test', 'beltedpad110.jpg', 110, 110, 0),
(2617, 'uploads1/test', 'beltedpad187.jpg', 187, 187, 0),
(2618, 'uploads1/test', 'beltedpad250.jpg', 250, 250, 0),
(2619, 'uploads1/test', 'lavendereye110.jpg', 110, 110, 0),
(2620, 'uploads1/test', 'lavendereye187.jpg', 187, 187, 0),
(2621, 'uploads1/test', 'lavendereye250.jpg', 250, 250, 0),
(2622, 'uploads1/test', 'basicherbal110.jpg', 110, 110, 0),
(2623, 'uploads1/test', 'basicherbal187.jpg', 187, 187, 0),
(2624, 'uploads1/test', 'basicherbal250.jpg', 250, 250, 0),
(2625, 'uploads1/prod1/img1_00/000', '5474_1314123332.jpg', 110, 110, 0),
(2626, 'uploads1/prod1/img2_00/000', '5475_1314123332.jpg', 150, 150, 0),
(2627, 'uploads1/prod1/img3_00/000', '5476_1314123332.jpg', 150, 150, 0),
(2628, 'uploads1/products/img1', '5612_1117572587.jpg', 110, 110, 0),
(2629, 'uploads1/products/img2', '5613_1117572587.jpg', 187, 187, 0),
(2630, 'uploads1/products/img3', '5614_1117572587.jpg', 250, 250, 0),
(2631, 'uploads1/products/img1', '5636_1116878022.jpg', 110, 110, 0),
(2632, 'uploads1/products/img2', '5637_1116878022.jpg', 187, 187, 0),
(2633, 'uploads1/products/img3', '5638_1116878022.jpg', 250, 250, 0),
(2634, 'uploads1/products/img1', '5639_1115924127.jpg', 110, 110, 0),
(2635, 'uploads1/products/img2', '5640_1115924127.jpg', 187, 187, 0),
(2636, 'uploads1/products/img3', '5641_1115924127.jpg', 250, 250, 0),
(2637, 'uploads1/products/img1', '5648_1116878307.jpg', 110, 110, 0),
(2638, 'uploads1/products/img2', '5649_1116878307.jpg', 187, 187, 0),
(2639, 'uploads1/products/img3', '5650_1116878307.jpg', 250, 250, 0),
(2640, 'uploads1/products/img1', '5651_1115915246.jpg', 110, 110, 0),
(2641, 'uploads1/products/img2', '5652_1115915246.jpg', 187, 187, 0),
(2642, 'uploads1/products/img3', '5653_1115915246.jpg', 250, 250, 0),
(2643, 'uploads1/products/img1', '5660_1116877463.jpg', 110, 110, 0),
(2644, 'uploads1/products/img2', '5661_1116877463.jpg', 187, 187, 0),
(2645, 'uploads1/products/img3', '5662_1116877463.jpg', 250, 250, 0),
(2646, 'uploads1/products/img1', '5663_1116873109.jpg', 110, 110, 0),
(2647, 'uploads1/products/img2', '5664_1116873109.jpg', 187, 187, 0),
(2648, 'uploads1/products/img3', '5665_1116873109.jpg', 250, 250, 0),
(2649, 'uploads1/products/img1', '5666_1117635898.jpg', 110, 110, 0),
(2650, 'uploads1/products/img2', '5667_1117635898.jpg', 187, 187, 0),
(2651, 'uploads1/products/img3', '5668_1117635898.jpg', 250, 250, 0),
(2652, 'uploads1/products/img1', '5669_1117572654.jpg', 110, 110, 0),
(2653, 'uploads1/products/img2', '5670_1117572654.jpg', 187, 187, 0),
(2654, 'uploads1/products/img3', '5671_1117572654.jpg', 250, 250, 0),
(2655, 'uploads1/products/img1', '5672_1115921406.jpg', 110, 110, 0),
(2656, 'uploads1/products/img2', '5673_1115921406.jpg', 187, 187, 0),
(2657, 'uploads1/products/img3', '5674_1115921406.jpg', 250, 250, 0),
(2658, 'uploads1/products/img1', '5675_1115916654.jpg', 110, 110, 0),
(2659, 'uploads1/products/img2', '5676_1115916654.jpg', 187, 187, 0),
(2660, 'uploads1/products/img3', '5677_1115916654.jpg', 250, 250, 0),
(2661, 'uploads1/products/img1', '5678_1116875094.jpg', 110, 110, 0),
(2662, 'uploads1/products/img2', '5679_1116875094.jpg', 187, 187, 0),
(2663, 'uploads1/products/img3', '5680_1116875094.jpg', 250, 250, 0),
(2664, 'uploads1/products/img1', '5687_1116872695.jpg', 110, 110, 0),
(2665, 'uploads1/products/img2', '5688_1116872695.jpg', 187, 187, 0),
(2666, 'uploads1/products/img3', '5689_1116872695.jpg', 250, 250, 0),
(2667, 'uploads1/test', '5param110.jpg', 110, 110, 0),
(2668, 'uploads1/test', '5param187.jpg', 187, 187, 0),
(2669, 'uploads1/test', '5param250.jpg', 250, 250, 0),
(2670, 'uploads1/products/img1', '5693_1116871873.jpg', 110, 110, 0),
(2671, 'uploads1/products/img2', '5694_1116871873.jpg', 187, 187, 0),
(2672, 'uploads1/products/img3', '5695_1116871873.jpg', 250, 250, 0),
(2673, 'uploads1/test', 'Valium110.jpg', 110, 110, 0),
(2674, 'uploads1/test', 'Valium187.jpg', 187, 187, 0),
(2675, 'uploads1/test', 'Valium250.jpg', 250, 250, 0),
(2676, 'uploads1/test', '9p-110.jpg', 110, 110, 0),
(2677, 'uploads1/test', '9p-185.jpg', 185, 185, 0),
(2678, 'uploads1/products/img3', '5704_1116004747.jpg', 250, 250, 0),
(2679, 'uploads1/products/img1', '5705_1116873337.jpg', 110, 110, 0),
(2680, 'uploads1/products/img2', '5706_1116873337.jpg', 187, 187, 0),
(2681, 'uploads1/products/img3', '5707_1116873337.jpg', 250, 250, 0),
(2682, 'uploads1/products/img1', '5711_1116872748.jpg', 110, 110, 0),
(2683, 'uploads1/products/img2', '5712_1116872748.jpg', 187, 187, 0),
(2684, 'uploads1/products/img3', '5713_1116872748.jpg', 250, 250, 0),
(2685, 'uploads1/products/img1', '5708_1117634694.jpg', 110, 110, 0),
(2686, 'uploads1/products/img2', '5709_1117634694.jpg', 187, 187, 0),
(2687, 'uploads1/products/img3', '5710_1117634694.jpg', 250, 250, 0),
(2688, 'uploads1/test', 'Oralfl110.jpg', 110, 110, 0),
(2689, 'uploads1/test', 'Oralfl187.jpg', 187, 187, 0),
(2690, 'uploads1/test', 'Oralfl250.jpg', 250, 250, 0),
(2691, 'uploads1/prod1/img1_00/000', '10695_1313764328.jpg', 110, 110, 0),
(2692, 'uploads1/prod1/img2_00/000', '10696_1313764328.jpg', 150, 150, 0),
(2693, 'uploads1/prod1/img3_00/000', '10697_1313764328.jpg', 150, 150, 0),
(2694, 'uploads1/prod1/img1_00/000', '10704_1313693072.jpg', 110, 110, 0),
(2695, 'uploads1/prod1/img2_00/000', '10705_1313693072.jpg', 150, 150, 0),
(2696, 'uploads1/prod1/img3_00/000', '10706_1313693072.jpg', 150, 150, 0),
(2697, 'uploads1/products/img1', '10707_1116874495.jpg', 110, 110, 0),
(2698, 'uploads1/products/img2', '10708_1116874495.jpg', 187, 187, 0),
(2699, 'uploads1/products/img3', '10709_1116874495.jpg', 250, 250, 0),
(2700, 'uploads1/products/img1', '10716_1115906520.jpg', 110, 110, 0),
(2701, 'uploads1/products/img2', '10717_1115906520.jpg', 187, 187, 0),
(2702, 'uploads1/products/img3', '10718_1115906520.jpg', 250, 250, 0),
(2703, 'uploads1/products/img1', '10719_1115906697.jpg', 110, 110, 0),
(2704, 'uploads1/products/img2', '10720_1115906697.jpg', 187, 187, 0),
(2705, 'uploads1/products/img3', '10721_1115906697.jpg', 250, 250, 0),
(2706, 'uploads1/products/img1', '10722_1115906978.jpg', 110, 110, 0),
(2707, 'uploads1/products/img2', '10723_1115906978.jpg', 187, 187, 0),
(2708, 'uploads1/products/img3', '10724_1115906978.jpg', 250, 250, 0),
(2709, 'uploads1/products/img1', '10743_1116871839.jpg', 110, 110, 0),
(2710, 'uploads1/products/img2', '10744_1116871839.jpg', 187, 187, 0),
(2711, 'uploads1/products/img3', '10745_1116871839.jpg', 250, 250, 0),
(2712, 'uploads1/products/img1', '10746_1115924817.jpg', 110, 110, 0),
(2713, 'uploads1/products/img2', '10747_1115924817.jpg', 187, 187, 0),
(2714, 'uploads1/products/img3', '10748_1115924817.jpg', 250, 250, 0),
(2715, 'uploads1/products/img1', '10749_1116878548.jpg', 110, 110, 0),
(2716, 'uploads1/products/img2', '10750_1116878548.jpg', 187, 187, 0),
(2717, 'uploads1/products/img3', '10751_1116878548.jpg', 250, 250, 0),
(2718, 'uploads1/products/img1', '10752_1117636504.jpg', 110, 110, 0),
(2719, 'uploads1/products/img2', '10753_1117636504.jpg', 187, 187, 0),
(2720, 'uploads1/products/img3', '10754_1117636504.jpg', 250, 250, 0),
(2721, 'uploads1/products/img1', '10761_1116874891.jpg', 110, 110, 0),
(2722, 'uploads1/products/img2', '10762_1116874891.jpg', 187, 187, 0),
(2723, 'uploads1/products/img3', '10763_1116874891.jpg', 250, 250, 0),
(2724, 'uploads1/products/img1', '10764_1115930604.jpg', 110, 110, 0),
(2725, 'uploads1/products/img2', '10765_1115930604.jpg', 187, 187, 0),
(2726, 'uploads1/products/img3', '10766_1115930604.jpg', 250, 250, 0),
(2727, 'uploads1/products/img1', '10767_1116872063.jpg', 110, 110, 0),
(2728, 'uploads1/products/img2', '10768_1116872063.jpg', 187, 187, 0),
(2729, 'uploads1/products/img3', '10769_1116872063.jpg', 250, 250, 0),
(2730, 'uploads1/products/img1', '10770_1115930967.jpg', 110, 110, 0),
(2731, 'uploads1/products/img2', '10771_1115930967.jpg', 187, 187, 0),
(2732, 'uploads1/products/img3', '10772_1115930967.jpg', 250, 250, 0),
(2733, 'uploads1/products/img1', '10773_1115931144.jpg', 110, 110, 0),
(2734, 'uploads1/products/img2', '10774_1115931144.jpg', 187, 187, 0),
(2735, 'uploads1/products/img3', '10775_1115931144.jpg', 250, 250, 0),
(2736, 'uploads1/products/img1', '10776_1115931293.jpg', 110, 110, 0),
(2737, 'uploads1/products/img2', '10777_1115931293.jpg', 187, 187, 0),
(2738, 'uploads1/products/img3', '10778_1115931293.jpg', 250, 250, 0),
(2739, 'uploads1/products/img1', '12328_1116515922.jpg', 110, 110, 0),
(2740, 'uploads1/products/img2', '12329_1116515922.jpg', 187, 187, 0),
(2741, 'uploads1/products/img3', '12330_1116515922.jpg', 250, 250, 0),
(2742, 'uploads1/products/img1', '28461_1122791445.gif', 120, 117, 0),
(2743, 'uploads1/products/img2', '28462_1122791445.gif', 187, 182, 0),
(2744, 'uploads1/products/img3', '28463_1122791445.gif', 200, 195, 0),
(2745, 'uploads1/products/img1', '36076_1123856772.jpg', 110, 110, 0),
(2746, 'uploads1/products/img2', '36077_1123856772.jpg', 187, 187, 0),
(2747, 'uploads1/products/img3', '36078_1123856772.jpg', 250, 250, 0),
(2748, 'uploads1/prod1/img1_00/000', '11490386_1294854047.jpg', 150, 150, 0),
(2749, 'uploads1/prod1/img2_00/000', '11490705_1294854047.jpg', 150, 150, 0),
(2750, 'uploads1/prod1/img3_00/000', '11490706_1294854047.jpg', 250, 250, 0),
(2751, 'uploads1/prod1/img1_00/000', '11490387_1294854240.jpg', 150, 150, 0),
(2752, 'uploads1/prod1/img2_00/000', '11490707_1294854223.jpg', 150, 150, 0),
(2753, 'uploads1/prod1/img3_00/000', '11490708_1294854223.jpg', 250, 250, 0),
(2754, 'uploads1/prod1/img1_00/000', '11490388_1294854359.jpg', 150, 113, 0),
(2755, 'uploads1/prod1/img2_00/000', '11490709_1294854359.jpg', 150, 113, 0),
(2756, 'uploads1/prod1/img3_00/000', '11490710_1294854359.jpg', 400, 336, 0),
(2757, 'uploads1/prod1/img1_00/000', '11900568_1311016997.jpg', 110, 110, 0),
(2758, 'uploads1/prod1/img2_00/000', '11900569_1311016997.jpg', 150, 150, 0),
(2759, 'uploads1/prod1/img3_00/000', '11900570_1311016997.jpg', 250, 250, 0),
(2760, 'uploads1/prod1/img1_00/000', '11900571_1311024417.jpg', 150, 150, 0),
(2761, 'uploads1/prod1/img2_00/000', '11900572_1311024417.jpg', 150, 150, 0),
(2762, 'uploads1/prod1/img3_00/000', '11900573_1311024417.jpg', 250, 250, 0),
(2763, 'uploads1/prod1/img1_00/000', '11900583_1311106362.jpg', 150, 150, 0),
(2764, 'uploads1/prod1/img2_00/000', '11900584_1311106362.jpg', 250, 250, 0),
(2765, 'uploads1/prod1/img3_00/000', '11900585_1311106362.jpg', 250, 250, 0),
(2766, 'uploads1/prod1/img1_00/000', '11900586_1311107072.jpg', 150, 150, 0),
(2767, 'uploads1/prod1/img2_00/000', '11900587_1311107072.jpg', 250, 250, 0),
(2768, 'uploads1/prod1/img3_00/000', '11900588_1311107072.jpg', 250, 250, 0),
(2769, 'uploads1/prod1/img1_00/000', '11908986_1313687922.jpg', 110, 110, 0),
(2770, 'uploads1/prod1/img2_00/000', '11908987_1313687922.jpg', 150, 150, 0),
(2771, 'uploads1/prod1/img3_00/000', '11908988_1313687922.jpg', 250, 250, 0),
(2772, 'uploads1/prod1/img1_00/000', '11909061_1313765869.jpg', 110, 110, 0),
(2773, 'uploads1/prod1/img2_00/000', '11909062_1313766001.jpg', 150, 150, 0),
(2774, 'uploads1/prod1/img3_00/000', '11909063_1313766001.jpg', 150, 150, 0),
(2775, 'uploads1/prod1/img1_00/000', '11909064_1313776261.jpg', 110, 110, 0),
(2776, 'uploads1/prod1/img2_00/000', '11909065_1313776283.jpg', 150, 150, 0),
(2777, 'uploads1/prod1/img1_00/000', '11909070_1314024613.jpg', 110, 110, 0),
(2778, 'uploads1/prod1/img2_00/000', '11909071_1314024613.jpg', 150, 150, 0),
(2779, 'uploads1/prod1/img3_00/000', '11909072_1314024613.jpg', 150, 150, 0),
(2780, 'uploads1/prod1/img1_00/000', '11909073_1314026021.jpg', 110, 110, 0),
(2781, 'uploads1/prod1/img2_00/000', '11909074_1314026021.jpg', 150, 150, 0),
(2782, 'uploads1/prod1/img3_00/000', '11909075_1314026021.jpg', 150, 150, 0),
(2783, 'uploads1/prod1/img1_00/000', '11909077_1314133394.jpg', 110, 110, 0),
(2784, 'uploads1/prod1/img2_00/000', '11909078_1314133394.jpg', 150, 150, 0),
(2785, 'uploads1/prod1/img3_00/000', '11909079_1314133394.jpg', 150, 150, 0),
(2786, 'uploads1/prod1/img1_00/000', '11909088_1314221734.jpg', 110, 110, 0),
(2787, 'uploads1/prod1/img2_00/000', '11909089_1314221734.jpg', 150, 150, 0),
(2788, 'uploads1/prod1/img3_00/000', '11909090_1314221734.jpg', 150, 150, 0),
(2789, 'uploads1/prod1/img1_00/000', '11909091_1314298113.jpg', 110, 110, 0),
(2790, 'uploads1/prod1/img2_00/000', '11909092_1314298113.jpg', 150, 150, 0),
(2791, 'uploads1/prod1/img3_00/000', '11909093_1314298113.jpg', 150, 150, 0),
(2792, 'uploads1/prod1/img1_00/000', '12225213_1336058994.jpg', 90, 90, 0),
(2793, 'uploads1/prod1/img2_00/000', '12225214_1336059283.jpg', 150, 150, 0),
(2794, 'uploads1/prod1/img3_00/000', '12225215_1336059329.jpg', 160, 160, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
