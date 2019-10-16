<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once('../api/load_head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = time();

$h = date("H");
$st = $db->query("SELECT * FROM `settings`", true);
if(isset($_GET['type'])){
	if($_GET['type'] == 'cookie'){
		
		if($st[0]['timerun_botreactions_cookie'] < time()){
			$get = $db->query("SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 0 AND time_start <= $h AND time_end >= $h AND cookie_die = 3 AND post_day < max_post_ngay AND active = 1 ORDER BY rand() LIMIT 5", true);
		}else{
			$get = null;
		}
		
		//$get = $db->query("SELECT * FROM bot_reactions WHERE cookie_die = 3 ORDER BY rand() LIMIT 5", true);
	}
}else{

	if($st[0]['timerun_botreactions_token'] < time()){
		#$get = $db->query("SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 0 AND time_start <= $h AND time_end >= $h AND cookie_die = 3 AND post_day < max_post_ngay AND active = 1 ORDER BY rand() LIMIT 5", true);
		$qur = "SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use >= $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND token_die = 0 AND post_day < max_post_ngay AND active = 1 ORDER BY rand() LIMIT 5";
		$get = $db->query($qur, true);
	}else{
		$get = null;
	}

	#$qur = "SELECT * FROM bot_reactions WHERE time_run <= $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND token_die = 0 AND post_day < max_post_ngay AND active = 1 ORDER BY rand() LIMIT 5";
	#echo $qur;
	
	#$get = $db->query("SELECT * FROM bot_reactions WHERE id_fb='100013556130854' AND ", true);
}
#echo 1561474444-time();
echo json_encode($get, JSON_PRETTY_PRINT);
