<?php
include_once('../system/Mysql.php');
	
$db = new MySQL('localhost', 'sv1_sv1', 'lFz9Tmpp8c', 'sv1_sv1');
$config['server'] = 'http://new.hethongbotvn.com';
$config['server_token'] = 'http://token.hethongbotvn.com';
date_default_timezone_set('Asia/Ho_Chi_Minh');
set_time_limit(0);
//header('Content-Type: application/json');