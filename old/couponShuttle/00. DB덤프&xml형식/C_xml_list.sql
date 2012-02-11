-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 11-05-16 15:43 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.9p2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `couponshuttle`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `C_xml_list`
--

CREATE TABLE IF NOT EXISTS `C_xml_list` (
  `no` int(10) NOT NULL AUTO_INCREMENT,
  `cp_name` varchar(30) NOT NULL,
  `cp_id` varchar(30) NOT NULL,
  `cp_url` varchar(100) NOT NULL,
  `is_active` varchar(5) NOT NULL DEFAULT 'yes',
  `region` varchar(20) DEFAULT NULL,
  `cp_origin_url` varchar(50) NOT NULL,
  `alwaysYesterday` int(11) NOT NULL DEFAULT '-1',
  `maximumCouponCnt` int(11) NOT NULL DEFAULT '-1',
  `useOriginalImage` int(11) NOT NULL DEFAULT '0',
  `useGivenCategory` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`no`),
  KEY `cp_name` (`cp_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=172 ;

--
-- 테이블의 덤프 데이터 `C_xml_list`
--

INSERT INTO `C_xml_list` (`no`, `cp_name`, `cp_id`, `cp_url`, `is_active`, `region`, `cp_origin_url`, `alwaysYesterday`, `maximumCouponCnt`, `useOriginalImage`, `useGivenCategory`) VALUES
(1, '디켓', 'dk', 'http://www.dicket.co.kr/xxx.php', 'yes', NULL, 'http://www.dicket.co.kr', -1, -1, 0, 0),
(2, '데일리스트립', 'ds', 'http://124.243.127.13/dailystrip/xxx.asp', 'yes', NULL, 'http://124.243.127.13', -1, -1, 0, 0),
(3, '허니밤', 'hb', 'http://honeybam.com/xxx.php', 'yes', NULL, 'http://honeybam.com', -1, -1, 0, 0),
(4, '퍼니러스', 'fr', 'http://funirus.co.kr/xxx.xml', 'yes', NULL, 'http://funirus.co.kr', -1, -1, 0, 0),
(5, '위폰', 'wp', 'http://www.wipon.co.kr/rss/xxx.php', 'yes', NULL, 'http://www.wipon.co.kr', -1, -1, 0, 0),
(52, '펀타임스', 'ft', 'http://funtimes.co.kr/xxx.php', 'no', NULL, 'http://funtimes.co.kr', 1, -1, 0, 0),
(9, '티켓나이트', 'tn', 'http://ticketnight.co.kr/rss/xxx.php', 'no', NULL, 'http://ticketnight.co.kr', -1, -1, 0, 0),
(10, '데일리픽', 'dp', 'http://www.dailypick.co.kr/external/xxx.php', 'yes', NULL, 'http://www.dailypick.co.kr', -1, -1, 0, 0),
(11, '키위', 'qw', 'http://qiwi.co.kr/xxx', 'yes', NULL, 'http://qiwi.co.kr', -1, -1, 0, 0),
(12, '쇼킹온', 'sk', 'http://showkingon.com/api/xxx.php', 'yes', NULL, 'http://showkingon.com', -1, 10, 0, 0),
(13, '닥터쿠폰', 'dc', 'http://www.drcoupon.co.kr/xml/xxx.html', 'yes', NULL, 'http://www.drcoupon.co.kr', -1, -1, 0, 0),
(14, '세븐데일리', 'sd', 'http://sevendaily.co.kr/xxx.php', 'yes', NULL, 'http://sevendaily.co.kr', -1, -1, 0, 0),
(73, '요기야', 'thisyo', 'http://www.thisyo.com/xxx.php', 'no', NULL, 'http://www.thisyo.com', -1, -1, 0, 0);