<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once('../api/load_head.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = time();

$h = date("H");
if(isset($_GET['type']) && isset($_GET['action'])){
	switch ($_GET['type']) {
		case 'bot_reaction':

			switch ($_GET['action']) {
				case 'check_run':
					$st = $db->query("SELECT * FROM `settings`", true);
					if($st[0]['timerun_botreactions_cookie'] > time()){
						$status = array(
							'status' => 'off',
							'run_after' => $st[0]['timerun_botreactions_cookie'] - time()
						);
					}else{
						$status = array(
							'status' => 'on',
							'run_after' => 0
						);
					}

					echo json_encode($status);
					break;
				case 'update':
					if(isset($_GET['time_update']) && (int)$_GET['time_update'] > 0){
						$tg = $_GET['time_update'] * 60;
						$st = $db->query("UPDATE `settings` SET `timerun_botreactions_cookie`= $time + ".$tg."");
						if($st){
							$status = array(
								'status' => 1
							);
						}else{
							$status = array(
								'status' => 0,
								'msg' => 'update error'
							);
						}
						
					}else{
							$status = array(
								'status' => 0,
								'msg' => 'Required time_update'
							);
					}
					echo json_encode($status);
						
				default:
					
					break;
			}

			break;
		case 'bot_reaction_token':
			switch ($_GET['action']) {
				case 'check_run':
					$st = $db->query("SELECT * FROM `settings`", true);
					if($st[0]['timerun_botreactions_token'] > time()){
						$status = array(
							'status' => 'off',
							'run_after' => $st[0]['timerun_botreactions_token'] - time()
						);
					}else{
						$status = array(
							'status' => 'on',
							'run_after' => 0
						);
					}

					echo json_encode($status);
					break;
				case 'update':
					if(isset($_GET['time_update']) && (int)$_GET['time_update'] > 0){
						$tg = $_GET['time_update'] * 60;
						$st = $db->query("UPDATE `settings` SET `timerun_botreactions_token`= $time + ".$tg."");
						if($st){
							$status = array(
								'status' => 1
							);
						}else{
							$status = array(
								'status' => 0,
								'msg' => 'update error'
							);
						}
						
					}else{
							$status = array(
								'status' => 0,
								'msg' => 'Required time_update'
							);
					}
					echo json_encode($status);
						
				default:
					
					break;
			}

			break;
		default:
			# code...
			break;
	}
}
if(isset($_GET['on_all'])){
	$st = $db->query("UPDATE `settings` SET `timerun_botreactions_cookie`= $time");
						if($st){
							$status = array(
								'status' => 1
							);
						}else{
							$status = array(
								'status' => 0,
								'msg' => 'update error'
							);
						}
						echo json_encode($status);
}
if(isset($_GET['on_all_token'])){
	$st = $db->query("UPDATE `settings` SET `timerun_botreactions_token`= $time");
						if($st){
							$status = array(
								'status' => 1
							);
						}else{
							$status = array(
								'status' => 0,
								'msg' => 'update error'
							);
						}
						echo json_encode($status);
}