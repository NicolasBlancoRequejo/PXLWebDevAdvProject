CREATE DATABASE user_auth;
USE user_auth;
CREATE TABLE ci_sessions (
session_id varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
ip_address varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
user_agent varchar(120) COLLATE utf8_bin DEFAULT NULL,
last_activity int(10) unsigned NOT NULL DEFAULT '0',
user_data text COLLATE utf8_bin NOT NULL,
PRIMARY KEY (session_id),
KEY last_activity_idx (last_activity)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
CREATE TABLE users (
usr_id int(11) NOT NULL AUTO_INCREMENT,
acc_id int(11) NOT NULL COMMENT 'account id',
usr_fname varchar(125) NOT NULL,
usr_lname varchar(125) NOT NULL,
usr_uname varchar(50) NOT NULL,
usr_email varchar(255) NOT NULL,
usr_hash varchar(255) NOT NULL,
usr_add1 varchar(255) NOT NULL,
usr_add2 varchar(255) NOT NULL,
usr_add3 varchar(255) NOT NULL,
usr_town_city varchar(255) NOT NULL,
usr_zip_pcode varchar(10) NOT NULL,
usr_access_level int(2) NOT NULL COMMENT 'up to 99',
usr_is_active int(1) NOT NULL COMMENT '1 (active) or 0 (inactive)',
usr_created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
usr_pwd_change_code varchar(50) NOT NULL,
usr_profilepic varchar(255) NOT NULL,
PRIMARY KEY (usr_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
  cm_id int(11) NOT NULL AUTO_INCREMENT,
  ds_id int(11) NOT NULL,
  cm_body text NOT NULL,
  cm_created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usr_id int(11) NOT NULL,
  cm_is_active int(1) NOT NULL,
  PRIMARY KEY (cm_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS discussions;
CREATE TABLE discussions (
  ds_id int(11) NOT NULL AUTO_INCREMENT,
  usr_id int(11) NOT NULL,
  ds_title varchar(255) NOT NULL,
  ds_body text NOT NULL,
  ds_created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ds_is_active int(1) NOT NULL,
  PRIMARY KEY (ds_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
