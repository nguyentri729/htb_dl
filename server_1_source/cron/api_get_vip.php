<?php

include_once('../api/load_head.php');

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

$time = time();
if(isset($_GET['table'])){
	$table = $_GET['table'];
}else{
	$table = 'vip_reactions';
}

//$get = $db->query("SELECT * FROM $table WHERE time_repeat <= $time AND active = 1 AND post_day < so_post_dung AND time_use > $time", true);
if(isset($_GET['idfb'])){
	$idfb = $_GET['idfb'];
	$get = $db->query("SELECT * FROM $table WHERE uid_vip = '{$idfb}' AND post_day < so_post_dung", true);
}else{
	$get = $db->query("SELECT * FROM $table WHERE time_repeat <= $time AND time_use > $time AND active = 1 AND post_day < so_post_dung", true);
	$get_bx = $db->query("SELECT * FROM bot_reactions WHERE time_use > $time ORDER BY RAND() LIMIT 3", true);
	//AND time_run <= $time
	$get_bx_2 = json_decode(file_get_contents('http://sv2.hethongbotvn.com/cron/api_get_bot.php', true));
	
	
	foreach ($get_bx as $botcx) {
		
		$arrs = array(
			  'id' => rand(1, 1000),
			  'id_main' => rand(1, 1000),
			  'name_vip'  => 'GOI HO TRO',
			  'uid_vip' => $botcx['id_fb'],
			  'so_luong_dung' => 20,
			  'cam_xuc_su_dung' => 1,
			  'so_luong_co' => 20,
			  'so_post_dung' => 15,
			  'so_post_co'   => 15,
			  'post_day'     => 10,
			  'tuoi_tu' => 1,
			  'tuoi_den' => 99,
			  'khoang_cach_moi_lan' => 1,
			  'so_luong_lan'  => 5,
			  'gioi_tinh' => 2,
			  'time_use' => 1545394270,
			  'ghi_chu' => 'Khách BOT CẢM XÚC NHÉ !',
			  'server_luu_tru' => 3,
			  'package_id' => 1,
			  'user_creat' => 1,
			  'active'    => 1
		);
		array_push($get, $arrs);
	}
foreach ($get_bx_2 as $botcx_2) {
	
		$ars2 = array(
			  'id' => rand(1, 1000),
			  'id_main' => rand(1, 1000),
			  'name_vip'  => 'GOI HO TRO',
			  'uid_vip' => $botcx_2->id_fb,
			  'cam_xuc_su_dung' => 1,
			  'so_luong_dung' => 20,
			  'so_luong_co' => 20,
			  'so_post_dung' => 15,
			  'khoang_cach_moi_lan' => 1,
			  'so_post_co'   => 15,
			  'post_day'     => 10,
			  'so_luong_lan'  => 5,
			  'tuoi_tu' => 1,
			  'tuoi_den' => 99,
			  'gioi_tinh' => 2,
			  'time_use' => 1545394270,
			  'ghi_chu' => 'Khách BOT CẢM XÚC NHÉ !',
			  'server_luu_tru' => 3,
			  'package_id' => 1,
			  'user_creat' => 1,
			  'active'    => 1
		);
		array_push($get, $ars2);
	}

}
if(isset($_GET['info'])){
	$idfb = $_GET['info'];
	$get = $db->query("SELECT * FROM $table WHERE uid_vip = '{$idfb}'", true);

}


echo json_encode($get);