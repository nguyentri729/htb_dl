<?php
header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *');  
include_once('../api/load_head.php');
$time = time();
$h = date("H");
if(isset($_GET['method'])){
	switch ($_GET['method']) {
		case 'GET':
			
			$limit = $_GET['limit'];

			$get = $db->query("SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND post_day < max_post_ngay AND token_die = 0 AND active = 1 ORDER BY rand() LIMIT $limit", true);
			echo json_encode($get);



			break;
		
		default:
			# code...
			break;
	}
}

