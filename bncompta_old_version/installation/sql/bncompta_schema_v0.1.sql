SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `manager_id` smallint(6) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_profile_id` tinyint(5) NOT NULL,
  `is_aga` tinyint(1) NOT NULL,
  `created_on` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`current_profile_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_accounting_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `closed` int(11) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='exercices comptable' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rib` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iban` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les comptes bancaires des entreprises' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_bank_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` int(10) NOT NULL,
  `ammount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les relevï¿½s bancaires des entreprises' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tva` decimal(10,0) NOT NULL,
  `cires_rcs` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les differents clients des entreprises' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_expenditures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `bank_statement_id` int(11) NOT NULL,
  `expenditure_type_id` int(11) NOT NULL,
  `accounting_year_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `ht` decimal(10,0) NOT NULL,
  `tva` decimal(10,0) NOT NULL,
  `file_path` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les depenses ' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_incomes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `bank_statement_id` int(11) NOT NULL,
  `income_type_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `accounting_year_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `ht` decimal(10,0) NOT NULL,
  `tva` decimal(10,0) NOT NULL DEFAULT '0',
  `file_path` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les recettes' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_in_ex_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` int(11) NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les codes des recettes et depenses' AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_modules` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `entreprise_id` smallint(5) NOT NULL,
  `modules` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `entreprises_profiles` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `entreprise_id` smallint(5) NOT NULL,
  `turnover` float NOT NULL,
  `siret` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_tva` tinyint(1) DEFAULT NULL,
  `tva` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `home_page` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`entreprise_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `modules` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `menu` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_core` tinyint(1) NOT NULL,
  `has_settings` tinyint(1) NOT NULL,
  `position` int(2) NOT NULL,
  `home_controller` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `controllers` text COLLATE utf8_unicode_ci NOT NULL,
  `icon_path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lang_file_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `rules` (
  `user_id` smallint(5) NOT NULL,
  `module_id` smallint(3) NOT NULL,
  `controller_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `methods` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `settings` (
  `module` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `option_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` text COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*SplitFlag*/
INSERT INTO `settings` (`module`, `option_name`, `option_value`) VALUES
('settings', 'site_name', 'BNCompta - Le logiciel libre de gestion et comptabilité'),
('settings', 'site_status', '0'),
('settings', 'site_offline_message', 'Attention! Le site est hors ligne, veuillez essayer ultérieurement. \r\n');
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(1) NOT NULL,
  `created_on` int(11) NOT NULL,
  `login_attempts` int(2) DEFAULT NULL,
  `last_login` int(11) NOT NULL,
  `last_online` int(11) NOT NULL,
  `default_lang` char(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`username`),
  UNIQUE KEY `email_2` (`email`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `users_profiles` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yahoo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gmail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
/*SplitFlag*/
CREATE TABLE IF NOT EXISTS `user_entreprise_rel` (
  `user_id` smallint(5) NOT NULL,
  `entreprise_id` smallint(5) NOT NULL,
  `role_id` smallint(5) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`,`entreprise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
