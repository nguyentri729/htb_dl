<?php
include_once('../api/load_head.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$time = time();
/*$db->get('access_token');
if($db->num_rows() < 1000){
	$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time AND so_luong_can > 20 ORDER BY RAND() LIMIT 1", true);
}else{
	$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time ORDER BY RAND() LIMIT 1", true);
}*/
if(isset($_GET['like_ho_tro'])){
	$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time AND so_luong_can = 20 ORDER BY RAND() LIMIT 1", true);
}else{
	$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time ORDER BY RAND() LIMIT 1", true);
}
if(isset($_GET['test'])){
	$get = $db->query("SELECT * FROM posts_reactions WHERE id_post = '100004802405961_1172542876249115' ORDER BY RAND() LIMIT 1", true);
}
//var_dump($get);
echo json_encode($get);