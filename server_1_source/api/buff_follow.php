<?php
include_once('load_head.php');
if($_GET['type']){
	switch ($_GET['type']) {
		case 'add':
			$result = array('status' => false, 'message' => 'Có lỗi xảy ra !');
			$data_insert = json_decode(base64_decode($_GET['data']), true);
			$data_insert['time_run'] = time() + 60;
			$data_insert['da_dap_ung'] = 0;
			if($db->insert('buff_follow', $data_insert)){
				$result = array('status' => true, 'message' => 'Thêm thành công !');
			}else{
				$result = array('status' => false, 'message' => 'Không thể thêm vào db');
			}
			
			echo json_encode($result);

			break;
		case 'view_status':
			$result = array(
				'status' => false
			);
			$get = $db->query("SELECT * FROM buff_follow WHERE id_main = {$_GET['id_main']}", true);
			if($db->num_rows() > 0){
				$result = array(
					'status' => true,
					'data' => $get[0]
				);
				
			}
			echo json_encode($result);
			
			break;
		default:
			# code...
			break;
	}
}