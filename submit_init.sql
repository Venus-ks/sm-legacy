-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `ad_check_review` (
  `id` mediumint(9) NOT NULL,
  `part` mediumint(9) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ad_check_review` (`id`, `part`, `title`, `content`) VALUES
(1,	1,	'평기기준',	'연구제목의 명료성'),
(2,	1,	'평기기준',	'연구목적의 명료성'),
(3,	1,	'평기기준',	'연구방법의 적절성'),
(4,	1,	'평기기준',	'결과해석 및 논의의 적절성'),
(5,	1,	'평기기준',	'연구의 독창성'),
(6,	1,	'평기기준',	'연구결과의 유용성');

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

INSERT INTO `ad_journal` (`seq`, `mb_id`, `mb_name`, `title`, `title_eng`, `issn`, `issn_ec`, `issn_cd`, `sdate`, `edate`, `category`, `field`, `cont`, `cont_eng`, `regdate`) VALUES
(1,	'대표이메일',	'',	'학회명',	'영문학회명',	'ISSN',	'',	'',	'',	'',	'',	'',	'',	'',	'0000-00-00');

CREATE TABLE `ad_mail_log` (
  `parent_seq` int(11) NOT NULL,
  `mail_yn` varchar(1) NOT NULL,
  `error_info` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `regdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `ad_mail_text` (
  `number` int(11) NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_kor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `content_kor` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;


CREATE TABLE `ad_paper_auth_deleted` (
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
  KEY `mb_id` (`parent_seq`),
  KEY `auth_seq` (`auth_seq`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;


CREATE TABLE `ad_paper_deleted` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;


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
  `regdate` date NOT NULL DEFAULT '0000-00-00',
  `rstep` int(11) DEFAULT '1',
  PRIMARY KEY (`rseq`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE `ad_reviewer_log` (
  `parent_seq` int(11) NOT NULL,
  `review_user` varchar(255) NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `regdate` date NOT NULL,
  `confirm` varchar(1) NOT NULL,
  `confirmdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_auth` (
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `au_menu` varchar(20) NOT NULL DEFAULT '',
  `au_auth` set('r','w','d') NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_id`,`au_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_board` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_write_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_download_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_html_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_link_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_trackback_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint(4) NOT NULL DEFAULT '0',
  `bo_category_list` text NOT NULL,
  `bo_disable_tags` text NOT NULL,
  `bo_use_sideview` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_rss_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_comment` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_good` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_name` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_trackback` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_image_head` varchar(255) NOT NULL DEFAULT '',
  `bo_image_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` text NOT NULL,
  `bo_content_tail` text NOT NULL,
  `bo_insert_content` text NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_search` tinyint(4) NOT NULL DEFAULT '0',
  `bo_order_search` int(11) NOT NULL DEFAULT '0',
  `bo_count_write` int(11) NOT NULL DEFAULT '0',
  `bo_count_comment` int(11) NOT NULL DEFAULT '0',
  `bo_write_min` int(11) NOT NULL DEFAULT '0',
  `bo_write_max` int(11) NOT NULL DEFAULT '0',
  `bo_comment_min` int(11) NOT NULL DEFAULT '0',
  `bo_comment_max` int(11) NOT NULL DEFAULT '0',
  `bo_notice` text NOT NULL,
  `bo_upload_count` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bo_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_board_file` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `bf_no` int(11) NOT NULL DEFAULT '0',
  `bf_source` varchar(255) NOT NULL DEFAULT '',
  `bf_file` varchar(255) NOT NULL DEFAULT '',
  `bf_download` int(11) NOT NULL,
  `bf_content` text NOT NULL,
  `bf_filesize` int(11) NOT NULL DEFAULT '0',
  `bf_width` int(11) NOT NULL DEFAULT '0',
  `bf_height` smallint(6) NOT NULL DEFAULT '0',
  `bf_type` tinyint(4) NOT NULL DEFAULT '0',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bo_table`,`wr_id`,`bf_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_board_good` (
  `bg_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bg_flag` varchar(255) NOT NULL DEFAULT '',
  `bg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bg_id`),
  UNIQUE KEY `fkey1` (`bo_table`,`wr_id`,`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_board_new` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `bn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`bn_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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


CREATE TABLE `g4_group` (
  `gr_id` varchar(10) NOT NULL DEFAULT '',
  `gr_subject` varchar(255) NOT NULL DEFAULT '',
  `gr_admin` varchar(255) NOT NULL DEFAULT '',
  `gr_use_access` tinyint(4) NOT NULL DEFAULT '0',
  `gr_1_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_2_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_3_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_4_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_5_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_6_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_7_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_8_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_9_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_10_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_1` varchar(255) NOT NULL DEFAULT '',
  `gr_2` varchar(255) NOT NULL DEFAULT '',
  `gr_3` varchar(255) NOT NULL DEFAULT '',
  `gr_4` varchar(255) NOT NULL DEFAULT '',
  `gr_5` varchar(255) NOT NULL DEFAULT '',
  `gr_6` varchar(255) NOT NULL DEFAULT '',
  `gr_7` varchar(255) NOT NULL DEFAULT '',
  `gr_8` varchar(255) NOT NULL DEFAULT '',
  `gr_9` varchar(255) NOT NULL DEFAULT '',
  `gr_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`gr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_group_member` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `gm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`gm_id`),
  KEY `gr_id` (`gr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_login` (
  `lo_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL,
  PRIMARY KEY (`lo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `g4_login` (`lo_ip`, `mb_id`, `lo_datetime`, `lo_location`, `lo_url`) VALUES
('61.74.152.58',	'admin@site.com',	'2018-03-05 14:37:03',	'달력',	'');

CREATE TABLE `g4_mail` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_subject` varchar(255) NOT NULL DEFAULT '',
  `ma_content` mediumtext NOT NULL,
  `ma_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ma_ip` varchar(255) NOT NULL DEFAULT '',
  `ma_last_option` text NOT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

INSERT INTO `g4_member` (`mb_no`, `mb_id`, `mb_password`, `mb_name`, `mb_nick`, `mb_nick_date`, `mb_email`, `mb_homepage`, `mb_password_q`, `mb_password_a`, `mb_level`, `mb_jumin`, `mb_sex`, `mb_birth`, `mb_tel`, `mb_hp`, `mb_zip1`, `mb_zip2`, `mb_addr1`, `mb_addr2`, `mb_addr3`, `mb_addr_jibeon`, `mb_signature`, `mb_recommend`, `mb_point`, `mb_today_login`, `mb_login_ip`, `mb_datetime`, `mb_ip`, `mb_leave_date`, `mb_intercept_date`, `mb_email_certify`, `mb_memo`, `mb_lost_certify`, `mb_mailling`, `mb_sms`, `mb_open`, `mb_open_date`, `mb_profile`, `mb_memo_call`, `mb_1`, `mb_2`, `mb_3`, `mb_4`, `mb_5`, `mb_6`, `mb_7`, `mb_8`, `mb_9`, `mb_10`, `gb`, `field`) VALUES
(2,	'admin@site.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'편집위원장',	'',	'0000-00-00',	'admin@site.com',	'',	'',	'',	10,	'*EC2A66B6D554020B8C68D442F5F31E1558D4AE69',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	8700,	'2018-12-14 09:43:20',	'125.129.246.69',	'2013-05-15 16:45:25',	'114.200.239.60',	'',	'',	'2013-05-15 16:45:25',	'',	'',	1,	0,	1,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'normal',	''),
(3,	'user@site.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'테스터',	'',	'2013-06-06',	'user@site.com',	'',	'',	'',	2,	'',	'M',	'19810609',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	9300,	'2018-12-14 09:43:44',	'125.129.246.69',	'2013-06-06 02:35:38',	'203.234.216.182',	'',	'',	'2013-06-06 02:35:38',	'',	'',	1,	1,	1,	'2013-06-06',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'normal',	''),
(8,	'a@site.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'심사위원A',	'',	'0000-00-00',	'a@site.com',	'',	'',	'',	4,	'',	'',	'19800611',	'0000-0000-000',	'',	'135',	'806',	'',	'1-1',	'',	'',	'',	'',	3500,	'2018-12-14 10:05:59',	'125.129.246.69',	'2013-06-11 17:52:38',	'1.215.232.34',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	'1'),
(9,	'b@site.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'심사위원B',	'',	'0000-00-00',	'b@site.com',	'',	'',	'',	4,	'',	'',	'19820609',	'000-0000-0000',	'',	'135',	'807',	'',	'2-2',	'',	'',	'',	'',	1800,	'2018-12-14 10:07:15',	'125.129.246.69',	'2013-06-11 17:53:55',	'1.215.232.34',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	'1'),
(10,	'c@site.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'심사위원C',	'',	'0000-00-00',	'c@site.com',	'',	'',	'',	4,	'',	'',	'19860319',	'333-3333-3333',	'',	'135',	'806',	'',	'3-3',	'',	'',	'',	'',	1700,	'2018-12-14 10:07:33',	'125.129.246.69',	'2013-06-11 17:55:25',	'1.215.232.34',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	'1'),
(62,	'D@naver.com',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'1234',	'1234',	'0000-00-00',	'D@naver.com',	'',	'',	'',	4,	'',	'',	'',	'1234',	'1234',	'',	'',	'1234',	'',	'',	'',	'',	'',	0,	'2018-11-09 14:50:14',	'125.129.246.60',	'2017-07-21 17:18:37',	'125.129.246.69',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'1234',	'1234',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	''),
(64,	'cyt@jwu.ac.kr',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'조용태',	'조용태',	'0000-00-00',	'cyt@jwu.ac.kr',	'',	'',	'',	4,	'',	'',	'0',	'0',	'0',	'',	'',	'1',	'1',	'1',	'',	'',	'',	0,	'0000-00-00 00:00:00',	'',	'2018-02-01 18:11:51',	'121.191.149.4',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'0',	'0',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	''),
(65,	'lsh5510@hanmail.net',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'이성희',	'이성희',	'0000-00-00',	'lsh5510@hanmail.net',	'',	'',	'',	4,	'',	'',	'3',	'1',	'2',	'',	'',	'1',	'2',	'3',	'',	'',	'',	0,	'0000-00-00 00:00:00',	'',	'2018-02-01 18:12:52',	'121.191.149.4',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	''),
(66,	'ceyleh@hanmail.net',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'최은영',	'최은영',	'0000-00-00',	'ceyleh@hanmail.net',	'',	'',	'',	4,	'',	'',	'2',	'1',	'3',	'',	'',	'1',	'2',	'3',	'',	'',	'',	0,	'0000-00-00 00:00:00',	'',	'2018-02-01 18:13:34',	'121.191.149.4',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	''),
(67,	'1992kata@hanmail.net',	'*A4B6157319038724E3560894F7F932C8886EBFCF',	'미술치료연구',	'미술치료연구',	'0000-00-00',	'1992kata@hanmail.net',	'',	'',	'',	4,	'',	'',	'7',	'5',	'6',	'',	'',	'1',	'2',	'3',	'',	'',	'',	0,	'0000-00-00 00:00:00',	'',	'2018-02-02 06:14:20',	'116.36.238.249',	'',	'',	'0000-00-00 00:00:00',	'',	'',	0,	0,	0,	'0000-00-00',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'review',	'');

CREATE TABLE `g4_memo` (
  `me_id` int(11) NOT NULL DEFAULT '0',
  `me_recv_mb_id` varchar(255) NOT NULL DEFAULT '',
  `me_send_mb_id` varchar(255) NOT NULL DEFAULT '',
  `me_send_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  PRIMARY KEY (`me_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_point` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL DEFAULT '',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_rel_table` varchar(20) NOT NULL DEFAULT '',
  `po_rel_id` varchar(20) NOT NULL DEFAULT '',
  `po_rel_action` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`po_id`),
  KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_poll` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_subject` varchar(255) NOT NULL DEFAULT '',
  `po_poll1` varchar(255) NOT NULL DEFAULT '',
  `po_poll2` varchar(255) NOT NULL DEFAULT '',
  `po_poll3` varchar(255) NOT NULL DEFAULT '',
  `po_poll4` varchar(255) NOT NULL DEFAULT '',
  `po_poll5` varchar(255) NOT NULL DEFAULT '',
  `po_poll6` varchar(255) NOT NULL DEFAULT '',
  `po_poll7` varchar(255) NOT NULL DEFAULT '',
  `po_poll8` varchar(255) NOT NULL DEFAULT '',
  `po_poll9` varchar(255) NOT NULL DEFAULT '',
  `po_cnt1` int(11) NOT NULL DEFAULT '0',
  `po_cnt2` int(11) NOT NULL DEFAULT '0',
  `po_cnt3` int(11) NOT NULL DEFAULT '0',
  `po_cnt4` int(11) NOT NULL DEFAULT '0',
  `po_cnt5` int(11) NOT NULL DEFAULT '0',
  `po_cnt6` int(11) NOT NULL DEFAULT '0',
  `po_cnt7` int(11) NOT NULL DEFAULT '0',
  `po_cnt8` int(11) NOT NULL DEFAULT '0',
  `po_cnt9` int(11) NOT NULL DEFAULT '0',
  `po_etc` varchar(255) NOT NULL DEFAULT '',
  `po_level` tinyint(4) NOT NULL DEFAULT '0',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_date` date NOT NULL DEFAULT '0000-00-00',
  `po_ips` mediumtext NOT NULL,
  `mb_ids` text NOT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_poll_etc` (
  `pc_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `pc_name` varchar(255) NOT NULL DEFAULT '',
  `pc_idea` varchar(255) NOT NULL DEFAULT '',
  `pc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_popular` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_word` varchar(50) NOT NULL DEFAULT '',
  `pp_date` date NOT NULL DEFAULT '0000-00-00',
  `pp_ip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pp_id`),
  UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_scrap` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` varchar(15) NOT NULL DEFAULT '',
  `ms_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ms_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_token` (
  `to_token` varchar(32) NOT NULL DEFAULT '',
  `to_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `to_ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`to_token`),
  KEY `to_datetime` (`to_datetime`),
  KEY `to_ip` (`to_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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


CREATE TABLE `g4_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_write_free` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_trackback` varchar(255) NOT NULL,
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_write_notice` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_trackback` varchar(255) NOT NULL,
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `g4_write_qa` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_trackback` varchar(255) NOT NULL,
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_banner` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bn_alt` varchar(255) NOT NULL DEFAULT '',
  `bn_url` varchar(255) NOT NULL DEFAULT '',
  `bn_position` varchar(255) NOT NULL DEFAULT '',
  `bn_border` tinyint(4) NOT NULL DEFAULT '0',
  `bn_new_win` tinyint(4) NOT NULL DEFAULT '0',
  `bn_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_hit` int(11) NOT NULL DEFAULT '0',
  `bn_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_card_history` (
  `cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `od_id` varchar(10) NOT NULL DEFAULT '',
  `on_uid` varchar(32) NOT NULL DEFAULT '',
  `cd_mall_id` varchar(20) NOT NULL DEFAULT '',
  `cd_amount` int(11) NOT NULL DEFAULT '0',
  `cd_app_no` varchar(20) NOT NULL DEFAULT '',
  `cd_app_rt` varchar(8) NOT NULL DEFAULT '',
  `cd_trade_ymd` date NOT NULL DEFAULT '0000-00-00',
  `cd_trade_hms` time NOT NULL DEFAULT '00:00:00',
  `cd_quota` char(2) NOT NULL DEFAULT '',
  `cd_opt01` varchar(255) NOT NULL DEFAULT '',
  `cd_opt02` varchar(255) NOT NULL DEFAULT '',
  `cd_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cd_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`cd_id`),
  KEY `od_id` (`od_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_cart` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `on_uid` varchar(32) NOT NULL DEFAULT '',
  `it_id` varchar(10) NOT NULL DEFAULT '0',
  `it_opt1` varchar(255) NOT NULL DEFAULT '',
  `it_opt2` varchar(255) NOT NULL DEFAULT '',
  `it_opt3` varchar(255) NOT NULL DEFAULT '',
  `it_opt4` varchar(255) NOT NULL DEFAULT '',
  `it_opt5` varchar(255) NOT NULL DEFAULT '',
  `it_opt6` varchar(255) NOT NULL DEFAULT '',
  `ct_status` enum('����','�ֹ�','�غ�','���','�Ϸ�','���','��ǰ','ǰ��') NOT NULL DEFAULT '����',
  `ct_history` text NOT NULL,
  `ct_amount` int(11) NOT NULL DEFAULT '0',
  `ct_point` int(11) NOT NULL DEFAULT '0',
  `ct_point_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_stock_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_qty` int(11) NOT NULL DEFAULT '0',
  `ct_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ct_ip` varchar(25) NOT NULL DEFAULT '',
  `ct_send_cost` varchar(255) NOT NULL,
  `ct_direct` tinyint(4) NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `on_uid` (`on_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_category` (
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_name` varchar(255) NOT NULL DEFAULT '',
  `ca_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_opt1_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_opt2_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_opt3_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_opt4_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_opt5_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_opt6_subject` varchar(255) NOT NULL DEFAULT '',
  `ca_img_width` int(11) NOT NULL DEFAULT '0',
  `ca_img_height` int(11) NOT NULL DEFAULT '0',
  `ca_sell_email` varchar(255) NOT NULL DEFAULT '',
  `ca_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_stock_qty` int(11) NOT NULL DEFAULT '0',
  `ca_explan_html` tinyint(4) NOT NULL DEFAULT '0',
  `ca_head_html` text NOT NULL,
  `ca_tail_html` text NOT NULL,
  `ca_list_mod` int(11) NOT NULL DEFAULT '0',
  `ca_list_row` int(11) NOT NULL DEFAULT '0',
  `ca_include_head` varchar(255) NOT NULL DEFAULT '',
  `ca_include_tail` varchar(255) NOT NULL DEFAULT '',
  `ca_mb_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_content` (
  `co_id` varchar(20) NOT NULL DEFAULT '',
  `co_html` tinyint(4) NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_hit` int(11) NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_default` (
  `de_admin_company_owner` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_saupja_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_tel` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_fax` varchar(255) NOT NULL DEFAULT '',
  `de_admin_tongsin_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_zip` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_addr` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_email` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_use` int(11) NOT NULL DEFAULT '0',
  `de_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type1_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_use` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type2_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_use` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type3_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_use` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type4_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_use` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type5_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_height` int(11) NOT NULL DEFAULT '0',
  `de_rel_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_width` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_height` int(11) NOT NULL DEFAULT '0',
  `de_bank_use` int(11) NOT NULL DEFAULT '0',
  `de_bank_account` text NOT NULL,
  `de_card_test` int(11) NOT NULL DEFAULT '0',
  `de_card_use` int(11) NOT NULL DEFAULT '0',
  `de_card_point` int(11) NOT NULL DEFAULT '0',
  `de_card_pg` varchar(255) NOT NULL DEFAULT '',
  `de_card_max_amount` int(11) NOT NULL DEFAULT '0',
  `de_banktown_mid` varchar(255) NOT NULL DEFAULT '',
  `de_banktown_auth_key` varchar(255) NOT NULL DEFAULT '',
  `de_telec_mid` varchar(255) NOT NULL DEFAULT '',
  `de_point_settle` int(11) NOT NULL DEFAULT '0',
  `de_level_sell` int(11) NOT NULL DEFAULT '0',
  `de_send_cost_case` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_limit` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_list` varchar(255) NOT NULL DEFAULT '',
  `de_hope_date_use` int(11) NOT NULL DEFAULT '0',
  `de_hope_date_after` int(11) NOT NULL DEFAULT '0',
  `de_baesong_content` text NOT NULL,
  `de_change_content` text NOT NULL,
  `de_point_days` int(11) NOT NULL DEFAULT '0',
  `de_simg_width` int(11) NOT NULL DEFAULT '0',
  `de_simg_height` int(11) NOT NULL DEFAULT '0',
  `de_mimg_width` int(11) NOT NULL DEFAULT '0',
  `de_mimg_height` int(11) NOT NULL DEFAULT '0',
  `de_scroll_banner_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_cart_skin` varchar(255) NOT NULL DEFAULT '',
  `de_register` varchar(255) NOT NULL DEFAULT '',
  `de_sms_cont1` varchar(255) NOT NULL DEFAULT '',
  `de_sms_cont2` varchar(255) NOT NULL DEFAULT '',
  `de_sms_cont3` varchar(255) NOT NULL DEFAULT '',
  `de_sms_cont4` varchar(255) NOT NULL DEFAULT '',
  `de_sms_use1` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use2` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use3` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use4` tinyint(4) NOT NULL DEFAULT '0',
  `de_xonda_id` varchar(255) NOT NULL DEFAULT '',
  `de_sms_hp` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_mid` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_passwd` varchar(255) NOT NULL DEFAULT '',
  `de_dacom_mid` varchar(255) NOT NULL DEFAULT '',
  `de_dacom_test` tinyint(4) NOT NULL DEFAULT '0',
  `de_dacom_mertkey` varchar(255) NOT NULL DEFAULT '0',
  `de_allthegate_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_mid` varchar(255) NOT NULL DEFAULT '',
  `de_iche_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_allat_partner_id` varchar(255) NOT NULL DEFAULT '',
  `de_allat_prefix` varchar(255) NOT NULL DEFAULT '',
  `de_allat_formkey` varchar(255) NOT NULL DEFAULT '',
  `de_allat_crosskey` varchar(255) NOT NULL DEFAULT '',
  `de_tgcorp_mxid` varchar(255) NOT NULL DEFAULT '',
  `de_tgcorp_mxotp` varchar(255) NOT NULL DEFAULT '',
  `de_kspay_id` varchar(255) NOT NULL DEFAULT '',
  `de_item_ps_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_code_dup_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_point_per` tinyint(4) NOT NULL DEFAULT '0',
  `de_admin_buga_no` varchar(255) NOT NULL DEFAULT '',
  `de_different_msg` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use` varchar(255) NOT NULL DEFAULT '',
  `de_icode_id` varchar(255) NOT NULL DEFAULT '',
  `de_icode_pw` varchar(255) NOT NULL DEFAULT '',
  `de_icode_server_ip` varchar(255) NOT NULL DEFAULT '',
  `de_icode_server_port` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_site_key` varchar(255) NOT NULL DEFAULT '',
  `de_vbank_use` varchar(255) NOT NULL DEFAULT '',
  `de_taxsave_use` tinyint(4) NOT NULL,
  `de_guest_privacy` text NOT NULL,
  `de_hp_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_xonda_smskey` varchar(255) NOT NULL,
  `de_escrow_use` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_delivery` (
  `dl_id` int(11) NOT NULL AUTO_INCREMENT,
  `dl_company` varchar(255) NOT NULL DEFAULT '',
  `dl_url` varchar(255) NOT NULL DEFAULT '',
  `dl_tel` varchar(255) NOT NULL DEFAULT '',
  `dl_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_event` (
  `ev_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_group` int(11) NOT NULL DEFAULT '0',
  `ev_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_subject` varchar(255) NOT NULL DEFAULT '',
  `ev_head_html` text NOT NULL,
  `ev_tail_html` text NOT NULL,
  `ev_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ev_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_event_item` (
  `ev_id` int(11) NOT NULL DEFAULT '0',
  `it_id` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`ev_id`,`it_id`),
  KEY `it_id` (`it_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_faq` (
  `fa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fa_id`),
  KEY `fm_id` (`fm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_faq_master` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_item` (
  `it_id` varchar(10) NOT NULL DEFAULT '',
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_id2` varchar(255) NOT NULL DEFAULT '',
  `ca_id3` varchar(255) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_gallery` tinyint(4) NOT NULL DEFAULT '0',
  `it_maker` varchar(255) NOT NULL DEFAULT '',
  `it_origin` varchar(255) NOT NULL DEFAULT '',
  `it_opt1_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt2_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt3_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt4_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt5_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt6_subject` varchar(255) NOT NULL DEFAULT '',
  `it_opt1` text NOT NULL,
  `it_opt2` text NOT NULL,
  `it_opt3` text NOT NULL,
  `it_opt4` text NOT NULL,
  `it_opt5` text NOT NULL,
  `it_opt6` text NOT NULL,
  `it_type1` tinyint(4) NOT NULL DEFAULT '0',
  `it_type2` tinyint(4) NOT NULL DEFAULT '0',
  `it_type3` tinyint(4) NOT NULL DEFAULT '0',
  `it_type4` tinyint(4) NOT NULL DEFAULT '0',
  `it_type5` tinyint(4) NOT NULL DEFAULT '0',
  `it_basic` text NOT NULL,
  `it_explan` mediumtext NOT NULL,
  `it_explan_html` tinyint(4) NOT NULL DEFAULT '0',
  `it_cust_amount` int(11) NOT NULL DEFAULT '0',
  `it_amount` int(11) NOT NULL DEFAULT '0',
  `it_amount2` int(11) NOT NULL DEFAULT '0',
  `it_amount3` int(11) NOT NULL DEFAULT '0',
  `it_point` int(11) NOT NULL DEFAULT '0',
  `it_sell_email` varchar(255) NOT NULL DEFAULT '',
  `it_use` tinyint(4) NOT NULL DEFAULT '0',
  `it_stock_qty` int(11) NOT NULL DEFAULT '0',
  `it_head_html` text NOT NULL,
  `it_tail_html` text NOT NULL,
  `it_hit` int(11) NOT NULL DEFAULT '0',
  `it_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL DEFAULT '',
  `it_order` int(11) NOT NULL DEFAULT '0',
  `it_tel_inq` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`it_id`),
  KEY `ca_id` (`ca_id`),
  KEY `it_name` (`it_name`),
  KEY `it_order` (`it_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_item_info` (
  `ii_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(10) NOT NULL,
  `ii_gubun` varchar(50) NOT NULL,
  `ii_article` varchar(50) NOT NULL,
  `ii_title` varchar(255) NOT NULL,
  `ii_value` varchar(255) NOT NULL,
  PRIMARY KEY (`ii_id`),
  UNIQUE KEY `it_id` (`it_id`,`ii_gubun`,`ii_article`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_item_ps` (
  `is_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(10) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `is_name` varchar(255) NOT NULL DEFAULT '',
  `is_password` varchar(255) NOT NULL DEFAULT '',
  `is_score` tinyint(4) NOT NULL DEFAULT '0',
  `is_subject` varchar(255) NOT NULL DEFAULT '',
  `is_content` text NOT NULL,
  `is_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_ip` varchar(25) NOT NULL DEFAULT '',
  `is_confirm` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`is_id`),
  KEY `index1` (`it_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_item_qa` (
  `iq_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(10) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `iq_name` varchar(255) NOT NULL DEFAULT '',
  `iq_password` varchar(255) NOT NULL DEFAULT '',
  `iq_subject` varchar(255) NOT NULL DEFAULT '',
  `iq_question` text NOT NULL,
  `iq_answer` text NOT NULL,
  `iq_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iq_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`iq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_item_relation` (
  `it_id` varchar(10) NOT NULL DEFAULT '',
  `it_id2` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`it_id`,`it_id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_new_win` (
  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
  `nw_left` int(11) NOT NULL DEFAULT '0',
  `nw_top` int(11) NOT NULL DEFAULT '0',
  `nw_height` int(11) NOT NULL DEFAULT '0',
  `nw_width` int(11) NOT NULL DEFAULT '0',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_onlinecalc` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `oc_subject` varchar(255) NOT NULL DEFAULT '',
  `oc_category` text NOT NULL,
  `oc_head_html` text NOT NULL,
  `oc_tail_html` text NOT NULL,
  PRIMARY KEY (`oc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_on_uid` (
  `on_id` int(11) NOT NULL AUTO_INCREMENT,
  `on_uid` varchar(32) NOT NULL DEFAULT '',
  `on_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `session_id` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`on_id`),
  UNIQUE KEY `on_uid` (`on_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=651 DEFAULT CHARSET=utf8;

INSERT INTO `yc4_on_uid` (`on_id`, `on_uid`, `on_datetime`, `session_id`) VALUES
(650,	'884d247c6f65a96a7da4d1105d584ddd',	'2018-11-19 13:57:20',	'frejf7pjam7a6aroar3semkvq4'),
(649,	'55b37c5c270e5d84c793e486d798c01d',	'2018-11-19 13:57:20',	'frejf7pjam7a6aroar3semkvq4'),
(648,	'443cb001c138b2561a0d90720d6ce111',	'2018-11-19 13:57:04',	'bh4ke6uc3717vq5jbh512vrol1'),
(647,	'303ed4c69846ab36c2904d3ba8573050',	'2018-11-19 13:57:04',	'bh4ke6uc3717vq5jbh512vrol1'),
(646,	'0ff39bbbf981ac0151d340c9aa40e63e',	'2018-11-19 13:56:57',	'bh4ke6uc3717vq5jbh512vrol1'),
(645,	'5e9f92a01c986bafcabbafd145520b13',	'2018-11-19 13:56:57',	'bh4ke6uc3717vq5jbh512vrol1');

CREATE TABLE `yc4_order` (
  `od_id` varchar(10) NOT NULL DEFAULT '',
  `on_uid` varchar(32) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `od_pwd` varchar(255) NOT NULL DEFAULT '',
  `od_name` varchar(20) NOT NULL DEFAULT '',
  `od_email` varchar(100) NOT NULL DEFAULT '',
  `od_tel` varchar(20) NOT NULL DEFAULT '',
  `od_hp` varchar(20) NOT NULL DEFAULT '',
  `od_zip1` char(3) NOT NULL DEFAULT '',
  `od_zip2` char(3) NOT NULL DEFAULT '',
  `od_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_deposit_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_tel` varchar(20) NOT NULL DEFAULT '',
  `od_b_hp` varchar(20) NOT NULL DEFAULT '',
  `od_b_zip1` char(3) NOT NULL DEFAULT '',
  `od_b_zip2` char(3) NOT NULL DEFAULT '',
  `od_b_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_memo` text NOT NULL,
  `od_send_cost` int(11) NOT NULL DEFAULT '0',
  `od_temp_bank` int(11) NOT NULL DEFAULT '0',
  `od_temp_card` int(11) NOT NULL DEFAULT '0',
  `od_temp_hp` int(11) NOT NULL,
  `od_temp_point` int(11) NOT NULL DEFAULT '0',
  `od_receipt_bank` int(11) NOT NULL DEFAULT '0',
  `od_receipt_card` int(11) NOT NULL DEFAULT '0',
  `od_receipt_hp` int(11) NOT NULL,
  `od_receipt_point` int(11) NOT NULL DEFAULT '0',
  `od_bank_account` varchar(255) NOT NULL DEFAULT '',
  `od_bank_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_card_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_hp_time` datetime NOT NULL,
  `od_cancel_card` int(11) NOT NULL DEFAULT '0',
  `od_dc_amount` int(11) NOT NULL DEFAULT '0',
  `od_refund_amount` int(11) NOT NULL DEFAULT '0',
  `od_shop_memo` text NOT NULL,
  `dl_id` int(11) NOT NULL DEFAULT '0',
  `od_invoice` varchar(255) NOT NULL DEFAULT '',
  `od_invoice_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_hope_date` date NOT NULL DEFAULT '0000-00-00',
  `od_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_ip` varchar(25) NOT NULL DEFAULT '',
  `od_settle_case` varchar(255) NOT NULL DEFAULT '',
  `od_escrow1` varchar(255) NOT NULL DEFAULT '',
  `od_escrow2` varchar(255) NOT NULL DEFAULT '',
  `od_escrow3` varchar(255) NOT NULL DEFAULT '',
  `od_cash_no` varchar(255) NOT NULL,
  `od_cash_receipt_no` varchar(255) NOT NULL,
  `od_cash_app_time` varchar(255) NOT NULL,
  `od_cash_reg_stat` varchar(255) NOT NULL,
  `od_cash_reg_desc` varchar(255) NOT NULL,
  `od_cash_tr_code` varchar(255) NOT NULL,
  `od_cash_id_info` varchar(255) NOT NULL,
  `od_cash` tinyint(4) NOT NULL,
  `od_cash_allthegate_gubun_cd` varchar(255) NOT NULL,
  `od_cash_allthegate_confirm_no` varchar(255) NOT NULL,
  `od_cash_allthegate_adm_no` varchar(255) NOT NULL,
  `od_cash_tgcorp_mxissueno` varchar(255) NOT NULL,
  `od_cash_inicis_noappl` varchar(255) NOT NULL,
  `od_cash_inicis_pgauthdate` varchar(255) NOT NULL,
  `od_cash_inicis_pgauthtime` varchar(255) NOT NULL,
  `od_cash_inicis_tid` varchar(255) NOT NULL,
  `od_cash_inicis_ruseopt` varchar(255) NOT NULL,
  `od_cash_receiptnumber` varchar(255) NOT NULL,
  `od_cash_kspay_revatransactionno` varchar(255) NOT NULL,
  PRIMARY KEY (`od_id`),
  UNIQUE KEY `index1` (`on_uid`),
  KEY `index2` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `yc4_wish` (
  `wi_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `it_id` varchar(10) NOT NULL DEFAULT '0',
  `wi_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wi_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`wi_id`),
  KEY `index1` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2018-12-14 09:20:51
