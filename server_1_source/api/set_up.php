<?php
include_once('load_head.php');
//Set up bot cảm xúc
$db->query("CREATE TABLE `bot_reactions` ( `id` INT NOT NULL AUTO_INCREMENT , `access_token` VARCHAR(255) NOT NULL , `name` VARCHAR(100) NOT NULL , `id_fb` VARCHAR(50) NOT NULL , `time_use` INT NOT NULL , `time_start` INT NOT NULL , `time_end` INT NOT NULL , `post_mot_lan` INT NOT NULL , `khoang_cach_lan` INT NOT NULL , `max_post_ngay` INT NOT NULL , `group_tt` INT NOT NULL , `page_tt` INT NOT NULL , `profile_tt` INT NOT NULL , `list_tt` INT NOT NULL , `age_start` INT NOT NULL , `age_end` INT NOT NULL , `gender` INT NOT NULL , `ds_list` INT NOT NULL , `cum_tu_ko_tt` TEXT NOT NULL , `nguoi_ko_tt` VARCHAR(255) NOT NULL , `cam_xuc_su_dung` INT NOT NULL , `ghi_chu` VARCHAR(255) NOT NULL , `server_luu_tru` INT NOT NULL , `token_die` INT NOT NULL , `cookie_die` INT NOT NULL , `time_creat` INT NOT NULL , `user_creat` INT NOT NULL , `active` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
$db->query("ALTER TABLE `bot_reactions` ADD `type_reactions` INT NOT NULL COMMENT 'Loại sử dụng : 1 là token, 0 là cookie' AFTER `cookie_die`;");
$db->query("ALTER TABLE `bot_reactions` CHANGE `cam_xuc_su_dung` `cam_xuc_su_dung` VARCHAR(255) NOT NULL;");
$db->query("ALTER TABLE `bot_reactions` ADD `id_main` INT NOT NULL AFTER `id`;");




	   