<?php
$sql = '
  CREATE TABLE IF NOT EXISTS `table_prefix_aboutus` (
    `aboutus` text NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  INSERT INTO `table_prefix_aboutus` (`aboutus`) VALUES
  (\'<strong>Lorem Ipsum</strong><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans; \r\nfont-size:11px">\r\n&nbsp;е елементарен примерен текст, \r\nизползван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около \r\n1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да \r\nнапечата с тях книга с примерни шрифтове. Този начин не само е оцелял повече от 5 века, \r\nно е навлязъл и в публикуването на електронни издания като е запазен почти без промяна. \r\nПопуляризиран е през 60те години на 20ти век със издаването на Letraset листи, \r\nсъдържащи Lorem Ipsum пасажи, популярен е и в наши дни във софтуер за печатни \r\nиздания като Aldus PageMaker, който включва различни версии на Lorem Ipsum.</span>\');

  CREATE TABLE IF NOT EXISTS `table_prefix_advertise` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `type` text COLLATE utf8_unicode_ci,
    `site_link` text COLLATE utf8_unicode_ci,
    `dobaven_na` text COLLATE utf8_unicode_ci,
    `banner_img` text COLLATE utf8_unicode_ci,
    `expire` text COLLATE utf8_unicode_ci,
    `link_title` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_banners` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `type` text COLLATE utf8_unicode_ci,
    `site_link` text COLLATE utf8_unicode_ci,
    `banner_img` text COLLATE utf8_unicode_ci,
    `link_title` text COLLATE utf8_unicode_ci,
    `avtor` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_ext` (
    `ext_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT \'\',
    `ext_active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
    `ext_version` text COLLATE utf8_bin NOT NULL,
    UNIQUE KEY `ext_name` (`ext_name`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

  CREATE TABLE IF NOT EXISTS `table_prefix_custom_user_access` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `username` text NOT NULL,
    `pages` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_chat` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `text` text NOT NULL,
    `date` varchar(255) NOT NULL,
    `avatar` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_comments` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `author` text NOT NULL,
    `text` text NOT NULL,
    `date` text NOT NULL,
    `avatar` text NOT NULL,
    `nick_colour` text NOT NULL,
    `user_id` text NOT NULL,
    `newsid` text NOT NULL,
    `vote` varchar(255) DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_config` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `site_name` text NOT NULL,
    `logo_text_small` text NOT NULL,
    `logo_text_big` text NOT NULL,
    `favicon` text NOT NULL,
    `admin_email` text NOT NULL,
    `chat_enable` text NOT NULL,
    `gallery_enable` text NOT NULL,
    `img_upload_enable` text NOT NULL,
    `file_upload_enable` text NOT NULL,
    `poll_enable` text NOT NULL,
    `footer_stats_enable` text NOT NULL,
    `socials_enable` text NOT NULL,
    `fb_link` text NOT NULL,
    `tw_link` text NOT NULL,
    `goo_link` text NOT NULL,
    `servers_enable` text NOT NULL,
    `video_enable` text NOT NULL,
    `cookie_policy` text NOT NULL,
    `default_language` text NOT NULL,
    `head_box_text` text NOT NULL,
    `last_news_link` text NOT NULL,
    `last_news_name` text NOT NULL,
    `google_analytics` text,
    `google_site_verify` text,
    `rating_enable` varchar(255) DEFAULT \'0\',
    `chat_auto_delete` varchar(255) DEFAULT \'1\',
    `chat_auto_delete_after` varchar(255) DEFAULT \'20\',
    `style` varchar(255) NOT NULL DEFAULT \'default\',
    `phpbb_news` varchar(255) NOT NULL DEFAULT \'0\',
    `phpbb_news_forum_id` varchar(255) NOT NULL DEFAULT \'0\',
    `files_per_page` varchar(255) DEFAULT \'5\',
    `news_per_page` varchar(255) DEFAULT \'5\',
    `videos_per_page` varchar(255) DEFAULT \'5\',
    `pics_per_page` varchar(255) DEFAULT \'5\',
    `banlist_url` varchar(255) DEFAULT \'\',
    `hide_test_menus` varchar(255) DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;


  INSERT INTO `table_prefix_config` (`id`, `site_name`, `logo_text_small`, `logo_text_big`, `favicon`, `admin_email`, `chat_enable`, `gallery_enable`, `img_upload_enable`, `file_upload_enable`, `poll_enable`, `footer_stats_enable`, `socials_enable`, `fb_link`, `tw_link`, `goo_link`, `servers_enable`, `video_enable`, `cookie_policy`, `default_language`, `head_box_text`, `last_news_link`, `last_news_name`, `google_analytics`, `google_site_verify`, `rating_enable`,  `style`, `chat_auto_delete`, `chat_auto_delete_after`, `phpbb_news`, `phpbb_news_forum_id`, `files_per_page`, `pics_per_page`, `news_per_page`, `videos_per_page`, `banlist_url`) VALUES
  (1, \'Argos\', \'Your Gaming Community\', \'ARGOS\', \'assets/img/favicon.ico\', \'email@gmail.com\', \'1\', \'1\', \'1\', \'1\', \'1\', \'1\', \'1\', \'http://facebook.com\', \'http://twitter.com\', \'http://google.bg\', \'1\', \'1\', \'1\', \'en\', \'Welcome to Argos!<br/>Best multi-gaming system!\', \'http://google.com\', \'The world has broken.\', \'\', \'\', \'1\', \'default\', \'1\', \'20\', \'0\', \'0\',\'5\',\'5\',\'5\',\'5\',\'\');


  CREATE TABLE IF NOT EXISTS `table_prefix_contacts` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `date` text COLLATE utf8_unicode_ci,
    `ip` text COLLATE utf8_unicode_ci,
    `username` text COLLATE utf8_unicode_ci,
    `text` text COLLATE utf8_unicode_ci,
    `question` text COLLATE utf8_unicode_ci,
    `email` text COLLATE utf8_unicode_ci,
    `respond` int(11) DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_dpolls` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `poll_question` text NOT NULL,
    `poll_answer` text NOT NULL,
    `poll_votes` int(11) DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;


  CREATE TABLE IF NOT EXISTS `table_prefix_dpolls_votes` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `poll_id` text NOT NULL,
    `ip` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_files` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `picture` text NOT NULL,
    `author` text NOT NULL,
    `down_counts` text NOT NULL,
    `date` text NOT NULL,
    `size` text NOT NULL,
    `type` text NOT NULL,
    `game` text NOT NULL,
    `type_not_real` text NOT NULL,
    `game_not_real` text NOT NULL,
    `category` text NOT NULL,
    `opisanie` text NOT NULL,
    `link` text NOT NULL,
    `name` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_gallery` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `date` text COLLATE utf8_unicode_ci,
    `uploader` text COLLATE utf8_unicode_ci,
    `pic_link` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_greyfish_servers` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `ip` text NOT NULL,
    `port` text NOT NULL,
    `players` text NOT NULL,
    `maxplayers` text NOT NULL,
    `version` text NOT NULL,
    `type` text NOT NULL,
    `map` text NOT NULL,
    `hostname` text NOT NULL,
    `vote` text NOT NULL,
    `status` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_jquery_js` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `jquery_js` text NOT NULL,
    `jquery_js_name` text,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

  CREATE TABLE IF NOT EXISTS `table_prefix_menus` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `title` text NOT NULL,
    `the_content` text NOT NULL,
    `position` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_news` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `author` text NOT NULL,
    `title` text NOT NULL,
    `seourl` text NOT NULL,
    `text` text NOT NULL,
    `date` varchar(128) DEFAULT NULL,
    `comments` int(3) DEFAULT NULL,
    `comments_enabled` varchar(128) DEFAULT NULL,
    `img` text NOT NULL,
    `vote` varchar(255) DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;

  CREATE TABLE IF NOT EXISTS `table_prefix_pages` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `page_name` text NOT NULL,
    `page_title` text NOT NULL,
    `menu_type` text NOT NULL,
    `type` varchar(255) NOT NULL DEFAULT \'0\',
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_sliders` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `slider_img` text COLLATE utf8_unicode_ci,
    `is_link` text COLLATE utf8_unicode_ci,
    `slider_link` text COLLATE utf8_unicode_ci,
    `text` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_stats` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `date` date DEFAULT NULL,
    `ip` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_uploadvideos` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `uploader` text NOT NULL,
    `videolink` text NOT NULL,
    `date` text NOT NULL,
    `cat` text NOT NULL,
    `site` text NOT NULL,
    `approved` text NOT NULL,
    `original_title` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

  CREATE TABLE IF NOT EXISTS `table_prefix_videocat` (
    `id` int(12) NOT NULL AUTO_INCREMENT,
    `category` text NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_voting_ip_greyfish_servers` (
    `ip_id` int(11) NOT NULL AUTO_INCREMENT,
    `mes_id_fk` int(11) DEFAULT NULL,
    `ip_add` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`ip_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_voting_ip_comments` (
    `ip_id` int(11) NOT NULL AUTO_INCREMENT,
    `mes_id_fk` int(11) DEFAULT NULL,
    `ip_add` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`ip_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

  CREATE TABLE IF NOT EXISTS `table_prefix_voting_ip_news` (
    `ip_id` int(11) NOT NULL AUTO_INCREMENT,
    `mes_id_fk` int(11) DEFAULT NULL,
    `ip_add` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`ip_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
';
$sql = str_replace("table_prefix_", $table_prefix, $sql);