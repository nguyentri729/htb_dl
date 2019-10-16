<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time AND active = 1 ORDER BY RAND() LIMIT 1", true);
if($db->num_rows() == 0){
	echo '<meta http-equiv="refresh" content="200">';
}else{
	echo '<meta http-equiv="refresh" content="3">';
}
//var_dump($get);
$list_id_token = array();
foreach ($get as $post) {
	$db->query("UPDATE posts_reactions SET time_run = $time + {$post['khoang_cach_moi_lan']} WHERE id = {$post['id']}");

	$limit = $post['so_luong_lan']*2;
	
	$link_api = "{$config['server_token']}/api/get.php?get_many_token=1&gender={$post['gioi_tinh']}&loai_acc={$post['loai_acc_tuong_tac']}&limit={$limit}&where_run=reactions";
	$get_token =  json_decode(curl($link_api), true);


	$cx_arr = explode('|', trim($post['cam_xuc_su_dung']));
	$cam_xuc = name_reactions($cx_arr[rand(0, count($cx_arr)-1)]);
	//var_dump($get_token);

	$i = 0;
	foreach ($get_token as $token) {

		if($i >= $post['so_luong_lan']){
			break;
		}

		$token_trim = trim($token['access_token']);
		
		$ok = check_can_like($post['id_post'],$token_trim);

		

		if($ok){

			$start_reactions= curl("https://graph.facebook.com/{$post['id_post']}/likes?access_token={$token_trim}&method=POST");
			print_r($start_reactions);
//$start_reactions= json_decode(curl("https://graph.facebook.com/{$post['id_post']}/reactions?type=$cam_xuc&access_token={$token_trim}&method=POST"), true);

			/*if(isset($start_reactions['success'])){
				array_push($list_id_token, $token['id']);
				$i++;
			}*/
			if($start_reactions == 'true'){
				array_push($list_id_token, $token['id']);
				$i++;
			}

		}
	}
	$db->query("UPDATE posts_reactions SET so_luong_da_dap_ung = so_luong_da_dap_ung + $i, time_run = $time + {$post['khoang_cach_moi_lan']} WHERE id = {$post['id']}");
	echo $post['id_post'].': '.$i.'<hr>';
}
$update_time = base64_encode(json_encode($list_id_token));
curl("{$config['server_token']}/api/set.php?update_time={$update_time}");


function check_can_like($id, $token){

		$data = json_decode(curl("https://graph.facebook.com/v2.11/$id/likes?access_token=$token&limit=0&summary=true&method=GET"), true);
		
		if(isset($data['summary'])){
			if($data['summary']['has_liked'] == true){
				return false;
			}
			if($data['summary']['can_like'] == false){
				return false;
			}
			if($data['summary']['has_liked'] == false){
				return true;
			}
		}else{
			return true;
		}
}
function curl_test($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    
	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}
function name_reactions($id){
	switch ($id) {
	 		case 1:
	 			return 'LIKE';
	 			break;
	 		case 2:
	 			return 'LOVE';
	 			break;
	 		case 3:
	 			return 'ANGRY';
	 			break;
	 		case 4:
	 			return 'WOW';
	 			break;
	 		case 5:
	 			return 'SAD';
	 			break;
	 		case 6:
	 			return 'HAHA';
	 			break;
	 		default:
	 			return 'LOVE';
	 			break;
	 }
}
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
         
    curl_setopt($ch, CURLOPT_URL, $url);
                
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   // curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
   // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}