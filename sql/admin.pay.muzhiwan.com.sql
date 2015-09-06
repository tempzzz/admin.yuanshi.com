-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: 10.1.1.151
-- 生成日期: 2015 年 09 月 06 日 12:37
-- 服务器版本: 5.1.52-log
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sdk`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_group`
--

INSERT INTO `admin_group` (`id`, `name`, `desc`) VALUES
(1, '系统管理员', '最高权限');

-- --------------------------------------------------------

--
-- 表的结构 `admin_group_nodes`
--

CREATE TABLE IF NOT EXISTS `admin_group_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` smallint(5) unsigned DEFAULT NULL,
  `nodes_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=637 ;

--
-- 转存表中的数据 `admin_group_nodes`
--

INSERT INTO `admin_group_nodes` (`id`, `group_id`, `nodes_id`) VALUES
(600, 1, 3),
(601, 1, 6),
(602, 1, 7),
(603, 1, 8),
(604, 1, 9),
(605, 1, 10),
(606, 1, 12),
(607, 1, 43),
(608, 1, 44),
(609, 1, 45),
(610, 1, 46),
(611, 1, 17),
(612, 1, 18),
(613, 1, 19),
(614, 1, 20),
(615, 1, 21),
(616, 1, 22),
(617, 1, 23),
(618, 1, 30),
(619, 1, 31),
(620, 1, 32),
(621, 1, 33),
(622, 1, 42),
(623, 1, 35),
(624, 1, 36),
(625, 1, 37),
(626, 1, 38),
(627, 1, 39),
(628, 1, 40),
(629, 1, 41),
(630, 1, 47),
(631, 1, 48),
(632, 1, 49),
(633, 1, 50),
(634, 1, 51),
(635, 1, 52),
(636, 1, 53);

-- --------------------------------------------------------

--
-- 表的结构 `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `c` varchar(50) DEFAULT NULL,
  `m` varchar(50) DEFAULT NULL,
  `request_uri` varchar(255) DEFAULT NULL,
  `createtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

--
-- 转存表中的数据 `admin_log`
--

INSERT INTO `admin_log` (`id`, `uid`, `ip`, `c`, `m`, `request_uri`, `createtime`) VALUES
(1, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437619231),
(2, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437619338),
(3, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437619518),
(4, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437621147),
(5, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437621162),
(6, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437621186),
(7, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437621249),
(8, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437621606),
(9, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437621623),
(10, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437704699),
(11, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437705040),
(12, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437705054),
(13, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1437705094),
(14, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437705199),
(15, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437709959),
(16, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1437709974),
(17, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437978181),
(18, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437980591),
(19, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437980610),
(20, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437982664),
(21, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437983023),
(22, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437983042),
(23, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1437983286),
(24, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437983369),
(25, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1437983401),
(26, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437983416),
(27, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437986111),
(28, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1437995059),
(29, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438057927),
(30, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438058539),
(31, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438058617),
(32, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438065851),
(33, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438065861),
(34, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438137293),
(35, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438220909),
(36, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438332216),
(37, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438332231),
(38, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438332243),
(39, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438332286),
(40, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438333091),
(41, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438333107),
(42, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438569491),
(43, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438569639),
(44, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438569662),
(45, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438573498),
(46, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438573517),
(47, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438591449),
(48, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438591465),
(49, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438591531),
(50, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438591877),
(51, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438591963),
(52, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438591981),
(53, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438591988),
(54, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592060),
(55, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592091),
(56, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592163),
(57, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592252),
(58, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592314),
(59, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592386),
(60, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592391),
(61, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592413),
(62, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592444),
(63, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592523),
(64, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592559),
(65, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438592723),
(66, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593432),
(67, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593556),
(68, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593579),
(69, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593719),
(70, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593886),
(71, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593925),
(72, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593963),
(73, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438593976),
(74, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438594181),
(75, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438594250),
(76, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438596032),
(77, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438596088),
(78, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438659154),
(79, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438659504),
(80, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438659521),
(81, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1438661482),
(82, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1438661506),
(83, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1438661585),
(84, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1438661640),
(85, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438669925),
(86, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438670406),
(87, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438670425),
(88, 1, '127.0.0.1', 'app', 'add', '/App/add', 1438671495),
(89, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438738598),
(90, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438740329),
(91, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438740353),
(92, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438742694),
(93, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438742755),
(94, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438742832),
(95, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438742898),
(96, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438742911),
(97, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438744140),
(98, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438744205),
(99, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438744226),
(100, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438744307),
(101, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438744418),
(102, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438744441),
(103, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438760965),
(104, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1438760993),
(105, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1438761004),
(106, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438845655),
(107, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438921853),
(108, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1438925011),
(109, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1439259523),
(110, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1439260960),
(111, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1439260998),
(112, 1, '127.0.0.1', 'flushnodes', 'rebuild', '/FlushNodes/rebuild', 1439263027),
(113, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1439263041),
(114, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439265682),
(115, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/17', 1439265723),
(116, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439265774),
(117, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/18', 1439265894),
(118, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439265907),
(119, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/19', 1439265919),
(120, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266000),
(121, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266025),
(122, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266122),
(123, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266130),
(124, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266170),
(125, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266194),
(126, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266465),
(127, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266468),
(128, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266745),
(129, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266961),
(130, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439266979),
(131, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267072),
(132, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267266),
(133, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267279),
(134, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267293),
(135, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267519),
(136, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267529),
(137, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267852),
(138, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267903),
(139, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439267986),
(140, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268009),
(141, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268057),
(142, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268075),
(143, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268084),
(144, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268281),
(145, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268327),
(146, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/28', 1439268417),
(147, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/29', 1439268420),
(148, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/27', 1439268422),
(149, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/12', 1439268435),
(150, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268443),
(151, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268452),
(152, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/31', 1439268633),
(153, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439268639),
(154, 1, '127.0.0.1', 'group', 'edit', '/Group/edit', 1439277668),
(155, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439278530),
(156, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439278555),
(157, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439278598),
(158, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439278821),
(159, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439278828),
(160, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439279907),
(161, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1439368086),
(162, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1439439726),
(163, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451042),
(164, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451187),
(165, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451249),
(166, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451840),
(167, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451847),
(168, 1, '127.0.0.1', 'app', 'payment_del', '/App/payment_del/id/32', 1439451861),
(169, 1, '127.0.0.1', 'app', 'payment_add', '/App/payment_add', 1439451869),
(170, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1439451879),
(171, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1439538589),
(172, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1439882550),
(173, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1440051305),
(174, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1440126078),
(175, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1440496059),
(176, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1440669035),
(177, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1440744705),
(178, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1441003815),
(179, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1441003965),
(180, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1441004180),
(181, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1441014530),
(182, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1441014570),
(183, 1, '127.0.0.1', 'app', 'payment_edit', '/App/payment_edit', 1441015269),
(184, 1, '127.0.0.1', 'login', 'auth', '/Login/auth', 1441096854),
(185, 1, '127.0.0.1', 'app', 'edit', '/App/edit', 1441096873);

-- --------------------------------------------------------

--
-- 表的结构 `admin_nodes`
--

CREATE TABLE IF NOT EXISTS `admin_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) DEFAULT NULL,
  `controller_name` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `method_name` varchar(50) DEFAULT NULL,
  `ismenu` tinyint(3) unsigned DEFAULT NULL,
  `rootid` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `admin_nodes`
--

INSERT INTO `admin_nodes` (`id`, `controller`, `controller_name`, `method`, `method_name`, `ismenu`, `rootid`) VALUES
(1, 'FlushNodes', '更新节点', NULL, NULL, 1, 0),
(3, 'FlushNodes', NULL, 'rebuild', '初始化节点数据', 0, 1),
(4, 'Group', '用户组管理', NULL, NULL, 1, 0),
(6, 'Group', NULL, 'add_form', '添加用户组（模板）', 0, 4),
(7, 'Group', NULL, 'add', '添加用户组（提交）', 0, 4),
(8, 'Group', NULL, 'edit_form', '编辑用户组(模板)', 0, 4),
(9, 'Group', NULL, 'edit', '编辑用户组(提交)', 0, 4),
(10, 'Group', NULL, 'del', '删除用户组', 0, 4),
(11, 'Index', '后台管理', NULL, NULL, 1, 0),
(12, 'Index', NULL, 'index', '后台首页', 1, 11),
(15, 'User', '用户管理', NULL, NULL, 1, 0),
(17, 'User', NULL, 'add_form', '添加用户(模板)', 0, 15),
(18, 'User', NULL, 'add', '添加用户(提交)', 0, 15),
(19, 'User', NULL, 'edit_form', '编辑用户(模板)', 0, 15),
(20, 'User', NULL, 'edit', '编辑(提交)', 0, 15),
(21, 'User', NULL, 'del', '删除用户', 0, 15),
(22, 'User', NULL, 'edit_mypassword_form', '修改个人密码(模板)', 0, 15),
(23, 'User', NULL, 'edit_mypassword', '修改个人密码(提交)', 0, 15),
(27, 'Member', '交易管理', NULL, NULL, 1, 0),
(30, 'Member', NULL, 'money', '用户代币查询', 1, 27),
(31, 'Member', NULL, 'orderlist', '订单查询', 1, 27),
(32, 'Member', NULL, 'orderview', '订单详情', 0, 27),
(33, 'Member', NULL, 'moneyview', '用户流水详情', 0, 27),
(34, 'App', 'App管理', NULL, NULL, 1, 0),
(35, 'App', NULL, 'index', '返利管理', 1, 34),
(36, 'App', NULL, 'add_form', '添加一个app（模板）', 0, 34),
(37, 'App', NULL, 'getappinfo', '获取app信息(ajax查询)', 0, 34),
(38, 'App', NULL, 'add', '添加app(提交)', 0, 34),
(39, 'App', NULL, 'edit_form', '编辑app（模板）', 0, 34),
(40, 'App', NULL, 'edit', '编辑app（提交）', 0, 34),
(41, 'App', NULL, 'del', '删除app（提交）', 0, 34),
(42, 'Member', NULL, 'bonusview', '用户点劵详情', 0, 27),
(43, 'Index', NULL, 'group', '用户组管理', 1, 11),
(44, 'Index', NULL, 'user', '用户管理', 1, 11),
(45, 'Index', NULL, 'nodes', '浏览节点', 1, 11),
(46, 'Index', NULL, 'logview', '浏览所有日志', 1, 11),
(47, 'App', NULL, 'payment', '支付渠道管理', 1, 34),
(48, 'App', NULL, 'payment_add_form', '添加一个app支付方式（模板）', 0, 34),
(49, 'App', NULL, 'payment_add', '添加app支付方式(提交)', 0, 34),
(50, 'App', NULL, 'payment_edit_form', '编辑app支付方式（模板）', 0, 34),
(51, 'App', NULL, 'payment_edit', '编辑app支付方式（提交）', 0, 34),
(52, 'App', NULL, 'payment_del', '删除app支付方式（提交）', 0, 34),
(53, 'App', NULL, 'payment_getappinfo', '获取app支付渠道信息(ajax查询)', 0, 34);

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `group_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `group_id`) VALUES
(1, 'admin', 'cf287cb3c51486f44b30169785f16d37', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
