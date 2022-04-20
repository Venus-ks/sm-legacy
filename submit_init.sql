-- --------------------------------------------------------
-- 호스트:                          222.234.3.219
-- 서버 버전:                        5.7.33-log - MySQL Community Server (GPL)
-- 서버 OS:                        Linux
-- HeidiSQL 버전:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- sm_develop 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `sm_develop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sm_develop`;

-- 테이블 sm_develop.ad_check_review 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_check_review` (
  `id` mediumint(9) NOT NULL,
  `part` mediumint(9) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_check_review:6 rows 내보내기
DELETE FROM `ad_check_review`;
/*!40000 ALTER TABLE `ad_check_review` DISABLE KEYS */;
INSERT INTO `ad_check_review` (`id`, `part`, `title`, `content`) VALUES
	(1, 1, '평기기준', '연구제목의 명료성'),
	(2, 1, '평기기준', '연구목적의 명료성'),
	(3, 1, '평기기준', '연구방법의 적절성'),
	(4, 1, '평기기준', '결과해석 및 논의의 적절성'),
	(5, 1, '평기기준', '연구의 독창성'),
	(6, 1, '평기기준', '연구결과의 유용성');
/*!40000 ALTER TABLE `ad_check_review` ENABLE KEYS */;

-- 테이블 sm_develop.ad_config 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_config` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `regip` varchar(15) DEFAULT '',
  `service_fdate` date DEFAULT NULL,
  `service_ldate` date DEFAULT NULL,
  `paper_sample` varchar(255) DEFAULT NULL,
  `info_form` varchar(255) DEFAULT NULL,
  `ethic_form` varchar(255) DEFAULT NULL,
  `revision_form` varchar(255) DEFAULT NULL,
  `author_checklist` varchar(255) DEFAULT NULL,
  `copyright_agreement` varchar(255) DEFAULT NULL,
  `submit_rule` varchar(255) DEFAULT NULL,
  `ethic_rule` varchar(255) DEFAULT NULL,
  `review_rule` varchar(255) DEFAULT NULL,
  `publish_rule` varchar(255) DEFAULT NULL,
  `author_manual` varchar(255) DEFAULT NULL,
  `reviewer_manual` varchar(255) DEFAULT NULL,
  `manual` varchar(255) DEFAULT NULL,
  `review_form1` varchar(255) DEFAULT NULL,
  `review_form2` varchar(255) DEFAULT NULL,
  `review_form3` varchar(255) DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_config:1 rows 내보내기
DELETE FROM `ad_config`;
/*!40000 ALTER TABLE `ad_config` DISABLE KEYS */;
INSERT INTO `ad_config` (`no`, `regip`, `service_fdate`, `service_ldate`, `paper_sample`, `info_form`, `ethic_form`, `revision_form`, `author_checklist`, `copyright_agreement`, `submit_rule`, `ethic_rule`, `review_rule`, `publish_rule`, `author_manual`, `reviewer_manual`, `manual`, `review_form1`, `review_form2`, `review_form3`, `regdate`) VALUES
	(1, '172.19.0.1', '0000-00-00', '0000-00-00', '{"label":"투고논문 파일 샘플","link":null}', '{"label":"투고논문신청서","link":null}', '{"label":"연구윤리동의서","link":null}', '{"label":"논문수정표","link":null}', '{"label":"자가점검사항표","link":null}', '{"label":"저작권이양동의서","link":null}', '{"label":"논문투고규정","link":null}', '{"label":"윤리규정","link":null}', '{"label":"논문심사규정","link":null}', '{"label":"출판규정","link":null}', '{"label":"투고자 메뉴얼","link":null}', '{"label":"심사자 메뉴얼","link":null}', '{"label":"전체 메뉴얼","link":null}', '{"label":"1차 논문심사서","link":null}', '{"label":"2차 논문심사서","link":null}', '{"label":"3차 논문심사서","link":null}', '2022-04-19');
/*!40000 ALTER TABLE `ad_config` ENABLE KEYS */;

-- 테이블 sm_develop.ad_journal 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_journal` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(100) DEFAULT '',
  `mb_name` varchar(100) DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_eng` varchar(255) NOT NULL DEFAULT '',
  `issn` varchar(255) NOT NULL DEFAULT '',
  `issn_ec` varchar(255) NOT NULL DEFAULT '',
  `issn_cd` varchar(255) NOT NULL DEFAULT '',
  `sdate` varchar(10) NOT NULL DEFAULT '',
  `edate` varchar(10) NOT NULL DEFAULT '',
  `category` varchar(255) NOT NULL DEFAULT '',
  `field` varchar(255) NOT NULL DEFAULT '',
  `cont` text NOT NULL,
  `cont_eng` text NOT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_journal:1 rows 내보내기
DELETE FROM `ad_journal`;
/*!40000 ALTER TABLE `ad_journal` DISABLE KEYS */;
INSERT INTO `ad_journal` (`seq`, `mb_id`, `mb_name`, `title`, `title_eng`, `issn`, `issn_ec`, `issn_cd`, `sdate`, `edate`, `category`, `field`, `cont`, `cont_eng`, `regdate`) VALUES
	(1, '대표이메일', '', '학회명', '영문학회명', 'ISSN', '', '', '', '', '', '', '', '', '0000-00-00');
/*!40000 ALTER TABLE `ad_journal` ENABLE KEYS */;

-- 테이블 sm_develop.ad_mail_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_mail_log` (
  `parent_seq` int(11) NOT NULL,
  `mail_yn` varchar(1) NOT NULL,
  `error_info` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `regdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_mail_log:0 rows 내보내기
DELETE FROM `ad_mail_log`;
/*!40000 ALTER TABLE `ad_mail_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_mail_log` ENABLE KEYS */;

-- 테이블 sm_develop.ad_mail_text 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_mail_text` (
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `adds` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 sm_develop.ad_mail_text:0 rows 내보내기
DELETE FROM `ad_mail_text`;
/*!40000 ALTER TABLE `ad_mail_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_mail_text` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(100) DEFAULT '',
  `mb_name` varchar(100) DEFAULT '',
  `journal` varchar(255) NOT NULL DEFAULT '',
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_eng` varchar(255) NOT NULL DEFAULT '',
  `keyword` varchar(255) DEFAULT '',
  `keyword_eng` varchar(255) DEFAULT NULL,
  `abstract` text NOT NULL,
  `abstract_eng` text NOT NULL,
  `express_publication` varchar(255) DEFAULT '',
  `chklist` varchar(255) DEFAULT NULL,
  `manuscript` varchar(255) DEFAULT NULL,
  `review_category` varchar(255) NOT NULL DEFAULT '',
  `review_category_target` varchar(255) NOT NULL,
  `review_fee` varchar(1) NOT NULL,
  `submission_data` varchar(255) NOT NULL DEFAULT '',
  `submission_data2` varchar(255) NOT NULL,
  `submission_data3` varchar(255) NOT NULL,
  `submission_data4` varchar(255) NOT NULL,
  `submission_data5` varchar(255) NOT NULL,
  `submission_add_data` varchar(255) NOT NULL,
  `submission_cover_data` varchar(255) NOT NULL,
  `response_data` varchar(255) NOT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  `modify_file` varchar(255) NOT NULL DEFAULT '',
  `submit_date` date NOT NULL DEFAULT '0000-00-00',
  `reject_date` date NOT NULL,
  `reject_comment` text NOT NULL,
  `reject_comment_file` varchar(255) NOT NULL,
  `review_offcial_doc1` varchar(255) NOT NULL,
  `review_offcial_doc2` varchar(255) NOT NULL,
  `review_offcial_doc3` varchar(255) NOT NULL,
  `review_offcial_doc4` varchar(255) NOT NULL,
  `review_offcial_doc5` varchar(255) NOT NULL,
  `review_offcial_doc6` varchar(255) NOT NULL,
  `review_a_user` varchar(255) NOT NULL DEFAULT '',
  `review_b_user` varchar(255) NOT NULL DEFAULT '',
  `review_c_user` varchar(255) NOT NULL DEFAULT '',
  `review_a_date` varchar(20) NOT NULL DEFAULT '',
  `review_b_date` varchar(20) NOT NULL DEFAULT '',
  `review_c_date` varchar(20) NOT NULL DEFAULT '',
  `review_a_conf` varchar(20) NOT NULL DEFAULT '',
  `review_b_conf` varchar(20) NOT NULL DEFAULT '',
  `review_c_conf` varchar(20) NOT NULL DEFAULT '',
  `settle_date` date NOT NULL DEFAULT '0000-00-00',
  `step` int(11) DEFAULT '0',
  `review_a_step` int(11) DEFAULT '0',
  `review_b_step` int(11) DEFAULT '0',
  `review_c_step` int(11) DEFAULT '0',
  `modify_date` date NOT NULL DEFAULT '0000-00-00',
  `submission_rdata` varchar(255) DEFAULT '',
  `modify_rfile` varchar(255) DEFAULT '',
  `review_a_result` int(11) DEFAULT '0',
  `review_b_result` int(11) DEFAULT '0',
  `review_c_result` int(11) DEFAULT '0',
  `review_score` int(11) DEFAULT NULL,
  `edit_comment` text,
  `publish_vol` mediumint(9) DEFAULT NULL,
  `publish_issue` mediumint(9) DEFAULT NULL,
  `publish_conf` varchar(1) DEFAULT NULL,
  `publish_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper:0 rows 내보내기
DELETE FROM `ad_paper`;
/*!40000 ALTER TABLE `ad_paper` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper_auth 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper_auth` (
  `auth_seq` int(11) NOT NULL AUTO_INCREMENT,
  `parent_seq` int(11) DEFAULT '0',
  `auth_type` varchar(255) NOT NULL DEFAULT '',
  `auth_name` varchar(255) NOT NULL DEFAULT '',
  `auth_name_eng` varchar(255) NOT NULL,
  `auth_tel` varchar(255) NOT NULL DEFAULT '',
  `auth_email` varchar(255) NOT NULL DEFAULT '',
  `auth_mobile` varchar(255) NOT NULL DEFAULT '',
  `organization` varchar(255) NOT NULL DEFAULT '',
  `organization_eng` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`auth_seq`),
  KEY `mb_id` (`parent_seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper_auth:0 rows 내보내기
DELETE FROM `ad_paper_auth`;
/*!40000 ALTER TABLE `ad_paper_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_auth` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper_auth_deleted 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper_auth_deleted` (
  `auth_seq` int(11) NOT NULL,
  `parent_seq` int(11) DEFAULT '0',
  `auth_type` varchar(255) NOT NULL DEFAULT '',
  `auth_name` varchar(255) NOT NULL DEFAULT '',
  `auth_name_eng` varchar(255) NOT NULL,
  `auth_tel` varchar(255) NOT NULL DEFAULT '',
  `auth_email` varchar(255) NOT NULL DEFAULT '',
  `auth_mobile` varchar(255) NOT NULL DEFAULT '',
  `organization` varchar(255) NOT NULL DEFAULT '',
  `organization_eng` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  KEY `mb_id` (`parent_seq`),
  KEY `auth_seq` (`auth_seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper_auth_deleted:0 rows 내보내기
DELETE FROM `ad_paper_auth_deleted`;
/*!40000 ALTER TABLE `ad_paper_auth_deleted` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_auth_deleted` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper_deleted 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper_deleted` (
  `seq` int(11) NOT NULL,
  `mb_id` varchar(100) DEFAULT '',
  `mb_name` varchar(100) DEFAULT '',
  `jourmal` varchar(255) NOT NULL DEFAULT '',
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_eng` varchar(255) NOT NULL DEFAULT '',
  `keyword` varchar(255) DEFAULT '',
  `keyword_eng` varchar(255) DEFAULT NULL,
  `abstract` text NOT NULL,
  `abstract_eng` text NOT NULL,
  `express_publication` varchar(255) DEFAULT '',
  `chklist` varchar(255) DEFAULT NULL,
  `manuscript` varchar(255) DEFAULT NULL,
  `review_category` varchar(255) NOT NULL DEFAULT '',
  `review_category_target` varchar(255) NOT NULL,
  `review_fee` varchar(1) NOT NULL,
  `submission_data` varchar(255) NOT NULL DEFAULT '',
  `submission_data2` varchar(255) NOT NULL,
  `submission_data3` varchar(255) NOT NULL,
  `submission_data4` varchar(255) NOT NULL,
  `submission_data5` varchar(255) NOT NULL,
  `submission_add_data` varchar(255) NOT NULL,
  `submission_cover_data` varchar(255) NOT NULL,
  `response_data` varchar(255) NOT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  `modify_file` varchar(255) NOT NULL DEFAULT '',
  `submit_date` date NOT NULL DEFAULT '0000-00-00',
  `reject_date` date NOT NULL,
  `reject_comment` text NOT NULL,
  `reject_comment_file` varchar(255) NOT NULL,
  `review_offcial_doc1` varchar(255) NOT NULL,
  `review_offcial_doc2` varchar(255) NOT NULL,
  `review_offcial_doc3` varchar(255) NOT NULL,
  `review_offcial_doc4` varchar(255) NOT NULL,
  `review_offcial_doc5` varchar(255) NOT NULL,
  `review_offcial_doc6` varchar(255) NOT NULL,
  `review_a_user` varchar(255) NOT NULL DEFAULT '',
  `review_b_user` varchar(255) NOT NULL DEFAULT '',
  `review_c_user` varchar(255) NOT NULL DEFAULT '',
  `review_a_date` varchar(20) NOT NULL DEFAULT '',
  `review_b_date` varchar(20) NOT NULL DEFAULT '',
  `review_c_date` varchar(20) NOT NULL DEFAULT '',
  `review_a_conf` varchar(20) NOT NULL DEFAULT '',
  `review_b_conf` varchar(20) NOT NULL DEFAULT '',
  `review_c_conf` varchar(20) NOT NULL DEFAULT '',
  `settle_date` date NOT NULL DEFAULT '0000-00-00',
  `step` int(11) DEFAULT '0',
  `review_a_step` int(11) DEFAULT '0',
  `review_b_step` int(11) DEFAULT '0',
  `review_c_step` int(11) DEFAULT '0',
  `modify_date` date NOT NULL DEFAULT '0000-00-00',
  `submission_rdata` varchar(255) DEFAULT '',
  `modify_rfile` varchar(255) DEFAULT '',
  `review_a_result` int(11) DEFAULT '0',
  `review_b_result` int(11) DEFAULT '0',
  `review_c_result` int(11) DEFAULT '0',
  `review_score` int(11) DEFAULT NULL,
  `edit_comment` text,
  `publish_vol` mediumint(9) DEFAULT NULL,
  `publish_issue` mediumint(9) DEFAULT NULL,
  `publish_conf` varchar(1) DEFAULT NULL,
  `publish_data` varchar(255) DEFAULT NULL,
  KEY `mb_id` (`mb_id`),
  KEY `seq` (`seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper_deleted:0 rows 내보내기
DELETE FROM `ad_paper_deleted`;
/*!40000 ALTER TABLE `ad_paper_deleted` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_deleted` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper_review 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper_review` (
  `rseq` int(11) NOT NULL AUTO_INCREMENT,
  `parent_seq` int(11) DEFAULT '0',
  `type` varchar(1) DEFAULT NULL,
  `mb_id` varchar(100) DEFAULT '',
  `mb_name` varchar(100) DEFAULT '',
  `score` varchar(128) NOT NULL,
  `score_sum` smallint(6) NOT NULL,
  `result` varchar(255) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `rfile` varchar(255) DEFAULT '',
  `mfile` varchar(255) DEFAULT NULL,
  `authorfile` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  `rstep` int(11) DEFAULT '1',
  PRIMARY KEY (`rseq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper_review:0 rows 내보내기
DELETE FROM `ad_paper_review`;
/*!40000 ALTER TABLE `ad_paper_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_review` ENABLE KEYS */;

-- 테이블 sm_develop.ad_paper_total 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_paper_total` (
  `tseq` int(11) NOT NULL AUTO_INCREMENT,
  `parent_seq` int(11) DEFAULT '0',
  `mb_id` varchar(100) DEFAULT '',
  `mb_name` varchar(100) DEFAULT '',
  `result` varchar(255) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `rfile` varchar(255) DEFAULT '',
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`tseq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_paper_total:0 rows 내보내기
DELETE FROM `ad_paper_total`;
/*!40000 ALTER TABLE `ad_paper_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_total` ENABLE KEYS */;

-- 테이블 sm_develop.ad_reviewer_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `ad_reviewer_log` (
  `parent_seq` int(11) NOT NULL,
  `review_user` varchar(255) NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `regdate` date NOT NULL,
  `confirm` varchar(1) NOT NULL,
  `confirmdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.ad_reviewer_log:0 rows 내보내기
DELETE FROM `ad_reviewer_log`;
/*!40000 ALTER TABLE `ad_reviewer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_reviewer_log` ENABLE KEYS */;

-- 테이블 sm_develop.g4_config 구조 내보내기
CREATE TABLE IF NOT EXISTS `g4_config` (
  `cf_title` varchar(255) NOT NULL DEFAULT '',
  `cf_admin` varchar(255) NOT NULL DEFAULT '',
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_norobot` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0',
  `cf_login_point` int(11) NOT NULL DEFAULT '0',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0',
  `cf_new_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_login_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0',
  `cf_search_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_connect_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_read_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_point` int(11) NOT NULL DEFAULT '0',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0',
  `cf_download_point` int(11) NOT NULL DEFAULT '0',
  `cf_search_bgcolor` varchar(255) NOT NULL DEFAULT '',
  `cf_search_color` varchar(255) NOT NULL DEFAULT '',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0',
  `cf_link_target` varchar(255) NOT NULL DEFAULT '',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0',
  `cf_filter` text NOT NULL,
  `cf_possible_ip` text NOT NULL,
  `cf_intercept_ip` text NOT NULL,
  `cf_register_skin` varchar(255) NOT NULL DEFAULT 'basic',
  `cf_member_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_point` int(11) NOT NULL DEFAULT '0',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0',
  `cf_search_part` int(11) NOT NULL DEFAULT '0',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_prohibit_id` text NOT NULL,
  `cf_prohibit_email` text NOT NULL,
  `cf_new_del` int(11) NOT NULL DEFAULT '0',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0',
  `cf_use_jumin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_visit` varchar(255) NOT NULL DEFAULT '',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0',
  `cf_stipulation` text NOT NULL,
  `cf_privacy` text NOT NULL,
  `cf_open_modify` int(11) NOT NULL DEFAULT '0',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0',
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.g4_config:0 rows 내보내기
DELETE FROM `g4_config`;
/*!40000 ALTER TABLE `g4_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `g4_config` ENABLE KEYS */;

-- 테이블 sm_develop.g4_member 구조 내보내기
CREATE TABLE IF NOT EXISTS `g4_member` (
  `mb_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `mb_password` varchar(255) NOT NULL DEFAULT '',
  `mb_name` varchar(255) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_email` varchar(255) NOT NULL DEFAULT '',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_password_q` varchar(255) NOT NULL DEFAULT '',
  `mb_password_a` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0',
  `mb_jumin` varchar(255) NOT NULL DEFAULT '',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL,
  `mb_addr_jibeon` varchar(255) NOT NULL,
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_point` int(11) NOT NULL DEFAULT '0',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_1` varchar(255) NOT NULL DEFAULT '',
  `mb_2` varchar(255) NOT NULL DEFAULT '',
  `mb_3` varchar(255) NOT NULL DEFAULT '',
  `mb_4` varchar(255) NOT NULL DEFAULT '',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT '',
  `gb` varchar(10) DEFAULT 'normal',
  `field` varchar(255) DEFAULT '',
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.g4_member:7 rows 내보내기
DELETE FROM `g4_member`;
/*!40000 ALTER TABLE `g4_member` DISABLE KEYS */;
INSERT INTO `g4_member` (`mb_no`, `mb_id`, `mb_password`, `mb_name`, `mb_nick`, `mb_nick_date`, `mb_email`, `mb_homepage`, `mb_password_q`, `mb_password_a`, `mb_level`, `mb_jumin`, `mb_sex`, `mb_birth`, `mb_tel`, `mb_hp`, `mb_zip1`, `mb_zip2`, `mb_addr1`, `mb_addr2`, `mb_addr3`, `mb_addr_jibeon`, `mb_signature`, `mb_recommend`, `mb_point`, `mb_today_login`, `mb_login_ip`, `mb_datetime`, `mb_ip`, `mb_leave_date`, `mb_intercept_date`, `mb_email_certify`, `mb_memo`, `mb_lost_certify`, `mb_mailling`, `mb_sms`, `mb_open`, `mb_open_date`, `mb_profile`, `mb_memo_call`, `mb_1`, `mb_2`, `mb_3`, `mb_4`, `mb_5`, `mb_6`, `mb_7`, `mb_8`, `mb_9`, `mb_10`, `gb`, `field`) VALUES
	(1, 'admin@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '편집위원장', '', '0000-00-00', 'admin@site.com', '', '', '', 10, '*EC2A66B6D554020B8C68D442F5F31E1558D4AE69', '', '', '', '', '', '', '', '', '', '', '', '', 8700, '2021-06-30 15:36:27', '125.129.246.60', '2013-05-15 16:45:25', '114.200.239.60', '', '', '2013-05-15 16:45:25', '', '', 1, 0, 1, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'normal', ''),
	(2, 'user@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '테스터', '', '2013-06-06', 'user@site.com', '', '', '', 2, '', 'M', '19810609', '', '', '', '', '', '', '', '', '', '', 9300, '2018-12-14 09:43:44', '125.129.246.69', '2013-06-06 02:35:38', '203.234.216.182', '', '', '2013-06-06 02:35:38', '', '', 1, 1, 1, '2013-06-06', '', '', '', '', '', '', '', '', '', '', '', '', 'normal', ''),
	(3, 'a@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '심사위원A', '', '0000-00-00', 'a@site.com', '', '', '', 4, '', '', '19800611', '0000-0000-000', '', '135', '806', '', '1-1', '', '', '', '', 3500, '2021-05-21 14:59:09', '125.129.246.60', '2013-06-11 17:52:38', '1.215.232.34', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'review', '1'),
	(4, 'b@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '심사위원B', '', '0000-00-00', 'b@site.com', '', '', '', 4, '', '', '19820609', '000-0000-0000', '', '135', '807', '', '2-2', '', '', '', '', 1800, '2018-12-14 10:07:15', '125.129.246.69', '2013-06-11 17:53:55', '1.215.232.34', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'review', '1'),
	(5, 'c@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '심사위원C', '', '0000-00-00', 'c@site.com', '', '', '', 4, '', '', '19860319', '333-3333-3333', '', '135', '806', '', '3-3', '', '', '', '', 1700, '2018-12-14 10:07:33', '125.129.246.69', '2013-06-11 17:55:25', '1.215.232.34', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'review', '1'),
	(6, 'd@site.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '심사위원D', '', '0000-00-00', 'd@site.com', '', '', '', 4, '', '', '', '1234', '1234', '', '', '1234', '', '', '', '', '', 0, '2018-11-09 14:50:14', '125.129.246.60', '2017-07-21 17:18:37', '125.129.246.69', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'review', ''),
	(7, 'hjshyo@hakjisa.co.kr', '*A4B6157319038724E3560894F7F932C8886EBFCF', '시스템관리자', '', '0000-00-00', 'hjshyo@hakjisa.co.kr', '', '', '', 10, '', '', '', '02-330-5171', '1234', '', '', '1234', '', '', '', '', '', 0, '2018-11-09 14:50:14', '125.129.246.60', '2017-07-21 17:18:37', '125.129.246.69', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'review', '');
/*!40000 ALTER TABLE `g4_member` ENABLE KEYS */;

-- 테이블 sm_develop.g4_visit 구조 내보내기
CREATE TABLE IF NOT EXISTS `g4_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(255) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.g4_visit:5 rows 내보내기
DELETE FROM `g4_visit`;
/*!40000 ALTER TABLE `g4_visit` DISABLE KEYS */;
INSERT INTO `g4_visit` (`vi_id`, `vi_ip`, `vi_date`, `vi_time`, `vi_referer`, `vi_agent`) VALUES
	(1, '', '2020-05-29', '11:14:41', '', ''),
	(2, '', '2020-07-23', '16:37:10', '', ''),
	(3, '', '2020-09-07', '15:01:23', '', ''),
	(4, '', '2021-05-21', '14:02:48', '', ''),
	(5, '', '2021-06-30', '15:09:14', '', '');
/*!40000 ALTER TABLE `g4_visit` ENABLE KEYS */;

-- 테이블 sm_develop.g4_visit_sum 구조 내보내기
CREATE TABLE IF NOT EXISTS `g4_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 sm_develop.g4_visit_sum:5 rows 내보내기
DELETE FROM `g4_visit_sum`;
/*!40000 ALTER TABLE `g4_visit_sum` DISABLE KEYS */;
INSERT INTO `g4_visit_sum` (`vs_date`, `vs_count`) VALUES
	('2020-05-29', 1),
	('2020-07-23', 1),
	('2020-09-07', 1),
	('2021-05-21', 1),
	('2021-06-30', 1);
/*!40000 ALTER TABLE `g4_visit_sum` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
