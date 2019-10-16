<?php
include_once('load_head.php');
if($_GET['type']){
	switch ($_GET['type']) {
		case 'add':
			$result = array('status' => false, 'message' => 'Có lỗi xảy ra !');
			$data_insert = json_decode(base64_decode($_GET['data']), true);
			$data_insert['time_run'] = time() + $data_insert['khoang_cach_lan'] * 60;
			if($db->insert('bot_comment', $data_insert)){
				$result = array('status' => true, 'message' => 'Thêm thành công !');
			}else{
				$result = array('status' => false, 'message' => 'Không thể thêm vào db');
			}
			
			echo json_encode($result);

			break;
		case 'update':
			$result = array('status' => false, 'message' => 'Có lỗi xảy ra !');
			$data_insert = json_decode(base64_decode($_GET['data']), true);
			$data_insert['time_run'] = time() + $data_insert['khoang_cach_lan'] * 60;
			$data_insert['post_day'] = 0;
			$db->where('id_main', $data_insert['id_main']);
			if($db->update('bot_comment', $data_insert)){
				$result = array('status' => true, 'message' => 'Thêm thành công !');
			}else{
				$result = array('status' => false, 'message' => 'Không thể thêm vào db');
			}

			echo json_encode($result);

			break;
		case 'delete':
			$db->where('id_main', $_GET['id_main']);
			if($db->delete('bot_comment')){
				exit('true');
			}else{
				exit('false');
			}
		default:
			# code...
			break;
	}
}