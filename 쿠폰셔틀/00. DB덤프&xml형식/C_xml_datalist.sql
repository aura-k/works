-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 11-05-16 16:00 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.9p2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `couponshuttle`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `C_xml_datalist`
--

CREATE TABLE IF NOT EXISTS `C_xml_datalist` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(30) NOT NULL,
  `c_productIndex` varchar(20) NOT NULL,
  `c_url` varchar(200) NOT NULL,
  `c_title` text NOT NULL,
  `c_ori_price` varchar(20) NOT NULL,
  `c_price` varchar(20) NOT NULL,
  `c_rate` varchar(10) NOT NULL,
  `c_img` varchar(100) NOT NULL,
  `c_people` int(20) NOT NULL,
  `c_date` varchar(10) NOT NULL,
  `c_add` varchar(100) NOT NULL,
  `c_cp_name` varchar(50) NOT NULL,
  `c_cp_phone` varchar(50) NOT NULL,
  `c_cate` varchar(10) NOT NULL,
  `c_region` varchar(10) NOT NULL,
  `c_StringCate` varchar(30) DEFAULT NULL,
  `c_StringRegion` varchar(30) DEFAULT NULL,
  `shuttleRecommend` int(11) DEFAULT '0',
  `rank` int(10) NOT NULL DEFAULT '-1',
  `categoryRank` int(11) NOT NULL DEFAULT '-1',
  `regionRank` int(11) NOT NULL DEFAULT '-1',
  `c_fullAddress` varchar(35) NOT NULL,
  `c_description` text NOT NULL,
  `c_urlSelected` int(11) NOT NULL,
  `c_start_at` datetime NOT NULL,
  `c_end_at` datetime NOT NULL,
  `c_soldout` int(11) NOT NULL,
  `clickLog` int(11) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `c_name` (`c_name`),
  KEY `c_date` (`c_date`),
  KEY `c_start_at` (`c_start_at`),
  KEY `c_end_at` (`c_end_at`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69007 ;

--
-- 테이블의 덤프 데이터 `C_xml_datalist`
--

INSERT INTO `C_xml_datalist` (`no`, `c_name`, `c_productIndex`, `c_url`, `c_title`, `c_ori_price`, `c_price`, `c_rate`, `c_img`, `c_people`, `c_date`, `c_add`, `c_cp_name`, `c_cp_phone`, `c_cate`, `c_region`, `c_StringCate`, `c_StringRegion`, `shuttleRecommend`, `rank`, `categoryRank`, `regionRank`, `c_fullAddress`, `c_description`, `c_urlSelected`, `c_start_at`, `c_end_at`, `c_soldout`, `clickLog`) VALUES
(10231, 'tibusan', '0', 'ticketbusan.co.kr/?idx=18', '롱아일랜드아이스티', '31000', '15000', '52', '../img/coupon/11_02_12/tibusan0_resize.jpg', 63, '1297436400', '35.1378119, 129.102468', '롱아일랜드아이스티', '051-623-1975', '1', '418', '맛집카페', '부산', 0, -1, -1, -1, '부산시 남구 대연3동 54-23 2층', '롱아일랜드아이스티 스미노프+안주 50%,맥주o', 0, '2011-02-11 00:00:00', '2011-02-11 23:59:59', 0, 0),
(10230, 'ff', '32', 'http://funfunprice.com/social/index.php?seq=32', '구룡포과메기 홈세트', '24000', '15000', '37', '../img/coupon/11_02_12/ff32_resize.jpg', 28, '1297436400', '35.8565116, 128.6366821', '펀펀프라이스닷컴', '1644-5457', '7', '504', '맛집', '대구', 0, -1, -1, -1, '대구 수성구 범어4동 268-13', '구룡포과메기 20쪽과 각종 야채를 38% 할인', 0, '2011-02-08 00:00:00', '2011-02-13 23:59:59', 0, 0),
(10229, 'ticuma', '177', 'http://ticuma.com/preview.php?idx=177', '[영등포]얼짱몸짱 에스테닉 케어가 19,500원!!', '50000', '19500', '61', '../img/coupon/11_02_12/ticuma177_resize.jpg', 93, '1297436400', '37.5196345, 126.9044004', '[영등포]얼짱몸짱', '010-123-1234', '2', '116', '공연전시', '전국', 0, -1, -1, -1, '서울 영등포구 영등포동4가  67-2 2층', '1약초 임플란트 - 1회권 48,000원\r\n ', 0, '2011-02-10 00:00:00', '2011-02-12 23:59:59', 0, 0),
(10228, 'ticuma', '178', 'http://ticuma.com/preview.php?idx=178', '[압구정] 봉추찜닭! 말이 필요 없는 앙코르 봉추찜닭!', '21000', '9900', '53', '../img/coupon/11_02_12/ticuma178_resize.jpg', 1001, '1297436400', '37.5265093, 127.0382018', '[압구정]봉추찜닭', '010-123-1234', '1', '110', '공연전시', '전국', 0, -1, -1, -1, '서울 강남구 신사동  663-7', '오전에 매진 되어버린 앙코르 봉추찜닭! 이번에', 0, '2011-02-10 00:00:00', '2011-02-12 23:59:59', 0, 0),
(10227, 'heer', '31', 'http://heer.co.kr/social/index.php?seq=31', '어린이 영어동화 - EBS 디즈니 리틀 아인슈타인 시리즈 17종', '144500', '86700', '40', '../img/coupon/11_02_12/heer31_resize.jpg', 26, '1297436400', '37.5047213, 127.0532418', '에듀카코리아', '', '7', '142', '', '전국', 0, 80, -1, -1, '서울 강남구 대치동 890-60 H타워(구 오이타워) 5층', 'EBS 방영작~!! 월트 디즈니 리틀 아인슈타', 0, '2011-02-12 00:00:00', '2011-02-15 23:59:59', 0, 0),
(10226, 'heer', '29', 'http://heer.co.kr/social/index.php?seq=29', '부들부들 사랑스런 앙고라 모자~♥', '18000', '10', '99', '../img/coupon/11_02_12/heer29_resize.jpg', 254, '1297436400', '37.6397458, 127.0108829', '태경산업', '070-8271-2175', '5', '143', '', '전국', 0, -1, -1, -1, '전국 서울 강북구 인수동 521-49', '꽃샘추위~ 물럿거라!! 앙고라 모자가 왔다~!', 0, '2011-02-10 00:00:00', '2011-02-13 23:59:59', 0, 0),
(10225, 'ton', '47', 'http://www.t-on.kr/social/index.php?seq=47', '[청주02-12]매직아트 특별전+마술쇼+색깔놀이체험 몽땅 다 6,000원', '12000', '6000', '50', '../img/coupon/11_02_12/ton47_resize.jpg', 531, '1297436400', '36.3454929, 127.3906711', '모닝기획', '', '4', '800', '', '청주', 0, 120, -1, -1, '대전 서구 탄방동 11', '[청주]매직아트 특별전+마술쇼+색깔놀이체험 몽', 0, '2011-02-12 00:00:00', '2011-02-12 23:59:59', 0, 0),
(10224, 'ton', '46', 'http://www.t-on.kr/social/index.php?seq=46', '[태평동 꼬마김밥 야채호떡]김밥의 참맛을 알 수 있는 꼬마김밥', '10000', '5000', '50', '../img/coupon/11_02_12/ton46_resize.jpg', 148, '1297436400', '36.3439879, 127.3947422', '이음소프트', '042-471-4868', '1', '607', '', '대전', 0, -1, -1, 1, '대전 서구 탄방동 64-9', '단돈 5,000원에 고추김밥(10)+참치깁밥(', 0, '2011-02-11 00:00:00', '2011-02-13 23:59:59', 0, 0),
(10223, 'ton', '39', 'http://www.t-on.kr/social/index.php?seq=39', '[전국무료배송]예스쇼콜라 수제초콜릿 15%할인', '17500', '14900', '14', '../img/coupon/11_02_12/ton39_resize.jpg', 200, '1297436400', '36.3439879, 127.3947422', '이음소프트', '042-471-4868', '7', '607', '', '대전', 0, -1, -1, -1, '대전 서구 탄방동 64-9', '예스쇼콜라 100% 핸드메이드 수제추콜릿으로 ', 0, '2011-02-07 00:00:00', '2011-02-13 23:59:59', 0, 0),
(10222, 'ton', '38', 'http://www.t-on.kr/social/index.php?seq=38', '[천안 서북구]Sweet Aroma 나만의 천연 화장품 만들기!50%할인', '45000', '18000', '60', '../img/coupon/11_02_12/ton38_resize.jpg', 16, '1297436400', '36.3454929, 127.3906711', '스윗아로마', '', '6', '800', '', '천안', 0, -1, -1, -1, '대전 서구 탄방동', '나만의 천연 화장품 만들기!자연을 바르세요^^', 0, '2011-02-07 00:00:00', '2011-02-13 23:59:59', 0, 0);
