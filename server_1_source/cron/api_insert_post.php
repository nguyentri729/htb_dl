<?php
include_once('../api/load_head.php');


header('Access-Control-Allow-Origin: *');

$time = time();
if(isset($_GET['table'])){
	$table = $_GET['table'];
}else{
	$table = 'posts_reactions';
}
//Kiem tra trung albums

if(preg_match('#set=a.(.+?)&type=3#is', $_GET['link'], $albums)){

		    $album_id = $albums[1];
		   $db->where('id_albums', $album_id);
		   $db->get('albums_log');
		   if($db->num_rows() == 0){
		   	$insert = array(
		   		'id_albums' => $album_id,
		   		'time_creat' => time()
		   	);

		   	$db->insert('albums_log', $insert);

		   }else{
		   		exit('no_insert');
		   }


}


$db->where('id_post', $_GET['id_post']);
$db->get($table);

if($db->num_rows() == 0){

	$insert = array(
		'id_post' => $_GET['id_post'],
		'so_luong_can' => $_GET['so_luong_dung'],
		'so_luong_da_dap_ung' => 0,
		'so_luong_lan' =>  $_GET['so_luong_lan'],
		'loai_acc_tuong_tac' =>  $_GET['loai_acc_tuong_tac'],
		'cam_xuc_su_dung' => $_GET['cam_xuc_su_dung'],
		'khoang_cach_moi_lan' => $_GET['khoang_cach_moi_lan'] * 60,
		'time_run' => time() + $_GET['khoang_cach_moi_lan'] * 60,
		'tuoi_tu' =>  $_GET['tuoi_tu'],
		'tuoi_den' =>  $_GET['tuoi_den'],
		'gioi_tinh' =>  $_GET['gioi_tinh'],
		'time_creat' => time(),
		'active' => 1
	);
	
	echo 'insert';
	$db->insert('posts_reactions', $insert);

}else{
	echo 'no_insert';
}
