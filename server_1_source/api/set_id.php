<?php
include_once('load_head.php');
$time = time();
$h = date('H');
header('Access-Control-Allow-Origin: *');
if(isset($_GET['id_post'])){
	$id_post = $_GET['id_post'];
	$thanh_cong = (int)$_GET['thanh_cong'];
echo $thanh_cong;
	if($thanh_cong > 0 && $id_post > 0){
		$db->query("UPDATE posts_reactions SET so_luong_da_dap_ung = so_luong_da_dap_ung + $thanh_cong, time_run = $time + khoang_cach_moi_lan WHERE id_post = '{$id_post}'");
	}else{
		echo 'fail';
	}
	
}


