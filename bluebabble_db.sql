-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 10 sep 2014 om 13:22
-- Serverversie: 5.5.36
-- PHP-versie: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bluebabble`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `bottles` int(255) NOT NULL DEFAULT '0',
  `infinity` int(10) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '0.0.0.0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `email` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `name`, `bottles`, `infinity`, `ip`, `banned`, `email`) VALUES
(54, '100002580408386', 'Bob Desaunois', 2147483620, 1, '84.104.49.137', 0, ''),
(63, '100007369263868', 'Bill Amgcfibfchfh Wongescusenskysonbergmansteinwitz', 33, 0, '145.101.48.201', 0, ''),
(64, '100007390893780', 'Betty Amgcijhicghj Fallersen', 35, 0, '145.101.48.201', 0, ''),
(65, '100007956031802', 'Bill Amgiefjcahjb Okelolasen', 35, 0, '145.101.48.201', 0, ''),
(66, '100000061543959', 'Logan Brentzel', 35, 0, '74.107.69.82', 0, ''),
(67, '100002969239155', 'Samuel Aten', 32, 0, '75.86.216.138', 0, ''),
(68, '100000482912597', 'Vincent de Heer', 24, 0, '145.101.48.210', 0, ''),
(69, '100005626261118', 'Charlotte-Victoria Bailey', 25, 0, '86.163.246.190', 0, ''),
(70, '100001498682193', 'Marloes Steeman', 24, 0, '77.165.210.37', 0, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blacklists`
--

CREATE TABLE IF NOT EXISTS `blacklists` (
  `username` varchar(40) NOT NULL DEFAULT '',
  `words` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `blacklists`
--

INSERT INTO `blacklists` (`username`, `words`) VALUES
('', 'vliegtuig'),
('100002580408386', 'kaas hooiwagen kaas op een plaatje koe boer vliegtuig hoerenzooi sssss');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(240) DEFAULT NULL,
  `sender` varchar(40) DEFAULT NULL,
  `receiver` varchar(40) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `flagged` int(11) NOT NULL DEFAULT '0',
  `responded` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `flagged` (`flagged`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=346 ;

--
-- Gegevens worden geëxporteerd voor tabel `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender`, `receiver`, `seen`, `flagged`, `responded`) VALUES
(329, 'Hello.', '100007369263868', '100002580408386', 1, 0, 1),
(330, 'Sup nigga', '100007369263868', '100002580408386', 1, 0, 1),
(331, 'sd', '100002580408386', '100007956031802', 0, 0, 0),
(332, 'Cheesebutt.', '100002580408386', '100007390893780', 0, 0, 0),
(333, 'lkasjdgfasjdklgjlksadjglkjasdlkgjslakdjgklsajglksjaglkjsdlkagjlksajdglkjsakldgjsakldjglkasdjgkljsdlkgjsdlkajglksadjglksdjaglkjsadlkgjsadlkgjslkadjglksajdglksdjglksjadglkjsadlkgjsdalkgj', '100002580408386', '100007956031802', 0, 0, 0),
(334, 'asgsdggds', '100002580408386', '100000061543959', 0, 0, 0),
(335, 'This is a message. This message is a test. This test message is for you, stranger. I have no idea who you are.', '100002969239155', '100007956031802', 0, 0, 0),
(336, 'This is a message. This message is a test. This test message is for you, stranger. I have no idea who you are.', '100002969239155', '100007956031802', 0, 0, 0),
(337, 'hello', '100000482912597', '100002969239155', 1, 0, 1),
(338, 'Derp.', '100002969239155', '100007956031802', 0, 0, 0),
(339, 'I wonder if this application will ever get off the ground.', '100002580408386', '100002969239155', 0, 0, 0),
(340, 'It probably won''t.', '100002580408386', '100000061543959', 0, 0, 0),
(341, ':(', '100002580408386', '100007956031802', 0, 0, 0),
(342, 'Always stay positive and enjoy the little things! :D', '100001498682193', '100000061543959', 0, 0, 0),
(343, 'lololololololol', '100002580408386', '100007956031802', 0, 0, 0),
(344, 'piemels', '100002580408386', '100007956031802', 0, 0, 0),
(345, 'asdfghjkl', '100002580408386', '100002969239155', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `response` varchar(240) DEFAULT NULL,
  `original_message` varchar(240) DEFAULT NULL,
  `sender` varchar(40) DEFAULT NULL,
  `receiver` varchar(40) DEFAULT NULL,
  `seen` int(10) NOT NULL DEFAULT '0',
  `foreign_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

--
-- Gegevens worden geëxporteerd voor tabel `responses`
--

INSERT INTO `responses` (`id`, `response`, `original_message`, `sender`, `receiver`, `seen`, `foreign_id`) VALUES
(137, 'Hello there!', 'Hello.', '100002580408386', '100002580408386', 1, 329),
(138, 'Hello niggnogg', 'Sup nigga', '100002580408386', '100007369263868', 1, 330),
(139, 'No.\r\n', 'hello', '100002969239155', '100000482912597', 0, 337);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
