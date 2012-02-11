-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 11-05-16 16:01 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.9p2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `skymusic`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `C_click_log`
--

CREATE TABLE IF NOT EXISTS `C_click_log` (
  `no` int(10) NOT NULL AUTO_INCREMENT,
  `cp_id` varchar(5) NOT NULL,
  `ip_num` varchar(15) NOT NULL,
  `cp_url` varchar(100) NOT NULL,
  `click_date` varchar(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252939 ;

--
-- 테이블의 덤프 데이터 `C_click_log`
--

INSERT INTO `C_click_log` (`no`, `cp_id`, `ip_num`, `cp_url`, `click_date`) VALUES
(1, 'ds1', '218.238.10.147', 'http://www.dailystrip.co.kr/strip/pop_20101202.asp', '1291567217'),
(2, 'dk', '218.238.10.147', 'http://www.dicket.co.kr', '1291567238'),
(3, 'fr', '218.238.10.147', 'http://funirus.co.kr', '1291567336'),
(4, 'ds1', '218.238.10.147', 'http://www.dailystrip.co.kr/strip/pop_20101202.asp', '1291567357'),
(5, 'ds', '218.238.10.147', 'http://www.dailystrip.co.kr/main/index_20101203.asp', '1291567481'),
(6, 'wp', '218.238.10.147', 'http://www.wipon.co.kr/response/response_key.php?wipon_key=1108^114', '1291568451'),
(7, 'dk', '218.238.10.147', 'http://www.dicket.co.kr', '1291573059'),
(8, 'wp1', '218.238.10.147', 'http://www.wipon.co.kr/response/response_key.php?wipon_key=1106^114', '1291574938'),
(9, 'wp1', '218.238.10.147', 'http://www.wipon.co.kr/response/response_key.php?wipon_key=1106^114', '1291575059'),
(10, 'dk', '121.135.196.80', 'http://www.dicket.co.kr', '1291604818');