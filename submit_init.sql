-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: sm_develop
-- ------------------------------------------------------
-- Server version	5.7.26-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
--
-- Table structure for table `ad_check_review`
--

DROP TABLE IF EXISTS `ad_check_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_check_review` (
  `id` mediumint(9) NOT NULL,
  `part` mediumint(9) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_check_review`
--

LOCK TABLES `ad_check_review` WRITE;
/*!40000 ALTER TABLE `ad_check_review` DISABLE KEYS */;
INSERT INTO `ad_check_review` VALUES (1,1,'평기기준','연구제목의 명료성'),(2,1,'평기기준','연구목적의 명료성'),(3,1,'평기기준','연구방법의 적절성'),(4,1,'평기기준','결과해석 및 논의의 적절성'),(5,1,'평기기준','연구의 독창성'),(6,1,'평기기준','연구결과의 유용성');
/*!40000 ALTER TABLE `ad_check_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_config`
--

DROP TABLE IF EXISTS `ad_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_config` (
  `content01` text NOT NULL,
  `content02` text NOT NULL,
  `content03` text NOT NULL,
  `content04` text NOT NULL,
  `regip` varchar(15) DEFAULT '',
  `service_fdate` date DEFAULT NULL,
  `service_ldate` date DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_config`
--

LOCK TABLES `ad_config` WRITE;
/*!40000 ALTER TABLE `ad_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_journal`
--

DROP TABLE IF EXISTS `ad_journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_journal` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_journal`
--

LOCK TABLES `ad_journal` WRITE;
/*!40000 ALTER TABLE `ad_journal` DISABLE KEYS */;
INSERT INTO `ad_journal` VALUES (1,'대표이메일','','학회명','영문학회명','ISSN','','','','','','','','','0000-00-00');
/*!40000 ALTER TABLE `ad_journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_mail_log`
--

DROP TABLE IF EXISTS `ad_mail_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_mail_log` (
  `parent_seq` int(11) NOT NULL,
  `mail_yn` varchar(1) NOT NULL,
  `error_info` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `regdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_mail_log`
--

LOCK TABLES `ad_mail_log` WRITE;
/*!40000 ALTER TABLE `ad_mail_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_mail_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_mail_text`
--

DROP TABLE IF EXISTS `ad_mail_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_mail_text` (
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `adds` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_mail_text`
--

LOCK TABLES `ad_mail_text` WRITE;
/*!40000 ALTER TABLE `ad_mail_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_mail_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper`
--

DROP TABLE IF EXISTS `ad_paper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper`
--

LOCK TABLES `ad_paper` WRITE;
/*!40000 ALTER TABLE `ad_paper` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper_auth`
--

DROP TABLE IF EXISTS `ad_paper_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper_auth` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper_auth`
--

LOCK TABLES `ad_paper_auth` WRITE;
/*!40000 ALTER TABLE `ad_paper_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper_auth_deleted`
--

DROP TABLE IF EXISTS `ad_paper_auth_deleted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper_auth_deleted` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper_auth_deleted`
--

LOCK TABLES `ad_paper_auth_deleted` WRITE;
/*!40000 ALTER TABLE `ad_paper_auth_deleted` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_auth_deleted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper_deleted`
--

DROP TABLE IF EXISTS `ad_paper_deleted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper_deleted` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper_deleted`
--

LOCK TABLES `ad_paper_deleted` WRITE;
/*!40000 ALTER TABLE `ad_paper_deleted` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_deleted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper_review`
--

DROP TABLE IF EXISTS `ad_paper_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper_review` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper_review`
--

LOCK TABLES `ad_paper_review` WRITE;
/*!40000 ALTER TABLE `ad_paper_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_paper_total`
--

DROP TABLE IF EXISTS `ad_paper_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_paper_total` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_paper_total`
--

LOCK TABLES `ad_paper_total` WRITE;
/*!40000 ALTER TABLE `ad_paper_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_paper_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_reviewer_log`
--

DROP TABLE IF EXISTS `ad_reviewer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_reviewer_log` (
  `parent_seq` int(11) NOT NULL,
  `review_user` varchar(255) NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `regdate` date NOT NULL,
  `confirm` varchar(1) NOT NULL,
  `confirmdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_reviewer_log`
--

LOCK TABLES `ad_reviewer_log` WRITE;
/*!40000 ALTER TABLE `ad_reviewer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_reviewer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g4_config`
--

DROP TABLE IF EXISTS `g4_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g4_config` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g4_config`
--

LOCK TABLES `g4_config` WRITE;
/*!40000 ALTER TABLE `g4_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `g4_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g4_member`
--

DROP TABLE IF EXISTS `g4_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g4_member` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g4_member`
--

LOCK TABLES `g4_member` WRITE;
/*!40000 ALTER TABLE `g4_member` DISABLE KEYS */;
INSERT INTO `g4_member` VALUES (1,'admin@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','편집위원장','','0000-00-00','admin@site.com','','','',10,'*EC2A66B6D554020B8C68D442F5F31E1558D4AE69','','','','','','','','','','','','',8700,'2020-05-29 11:15:16','125.129.246.60','2013-05-15 16:45:25','114.200.239.60','','','2013-05-15 16:45:25','','',1,0,1,'0000-00-00','','','','','','','','','','','','','normal',''),(2,'user@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','테스터','','2013-06-06','user@site.com','','','',2,'','M','19810609','','','','','','','','','','',9300,'2018-12-14 09:43:44','125.129.246.69','2013-06-06 02:35:38','203.234.216.182','','','2013-06-06 02:35:38','','',1,1,1,'2013-06-06','','','','','','','','','','','','','normal',''),(3,'a@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','심사위원A','','0000-00-00','a@site.com','','','',4,'','','19800611','0000-0000-000','','135','806','','1-1','','','','',3500,'2018-12-14 10:05:59','125.129.246.69','2013-06-11 17:52:38','1.215.232.34','','','0000-00-00 00:00:00','','',0,0,0,'0000-00-00','','','','','','','','','','','','','review','1'),(4,'b@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','심사위원B','','0000-00-00','b@site.com','','','',4,'','','19820609','000-0000-0000','','135','807','','2-2','','','','',1800,'2018-12-14 10:07:15','125.129.246.69','2013-06-11 17:53:55','1.215.232.34','','','0000-00-00 00:00:00','','',0,0,0,'0000-00-00','','','','','','','','','','','','','review','1'),(5,'c@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','심사위원C','','0000-00-00','c@site.com','','','',4,'','','19860319','333-3333-3333','','135','806','','3-3','','','','',1700,'2018-12-14 10:07:33','125.129.246.69','2013-06-11 17:55:25','1.215.232.34','','','0000-00-00 00:00:00','','',0,0,0,'0000-00-00','','','','','','','','','','','','','review','1'),(6,'d@site.com','*A4B6157319038724E3560894F7F932C8886EBFCF','심사위원D','','0000-00-00','d@site.com','','','',4,'','','','1234','1234','','','1234','','','','','',0,'2018-11-09 14:50:14','125.129.246.60','2017-07-21 17:18:37','125.129.246.69','','','0000-00-00 00:00:00','','',0,0,0,'0000-00-00','','','','','','','','','','','','','review',''),(7,'hjshyo@hakjisa.co.kr','*A4B6157319038724E3560894F7F932C8886EBFCF','시스템관리자','','0000-00-00','hjshyo@hakjisa.co.kr','','','',10,'','','','02-330-5171','1234','','','1234','','','','','',0,'2018-11-09 14:50:14','125.129.246.60','2017-07-21 17:18:37','125.129.246.69','','','0000-00-00 00:00:00','','',0,0,0,'0000-00-00','','','','','','','','','','','','','review','');
/*!40000 ALTER TABLE `g4_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g4_visit`
--

DROP TABLE IF EXISTS `g4_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g4_visit` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g4_visit`
--

LOCK TABLES `g4_visit` WRITE;
/*!40000 ALTER TABLE `g4_visit` DISABLE KEYS */;
INSERT INTO `g4_visit` VALUES (1,'','2020-05-29','11:14:41','','');
/*!40000 ALTER TABLE `g4_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g4_visit_sum`
--

DROP TABLE IF EXISTS `g4_visit_sum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g4_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g4_visit_sum`
--

LOCK TABLES `g4_visit_sum` WRITE;
/*!40000 ALTER TABLE `g4_visit_sum` DISABLE KEYS */;
INSERT INTO `g4_visit_sum` VALUES ('2020-05-29',1);
/*!40000 ALTER TABLE `g4_visit_sum` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-29 16:43:45
