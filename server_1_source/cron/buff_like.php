<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM buff_like WHERE da_dap_ung < so_luong AND time_run < $time ORDER BY RAND() LIMIT 2", true);

$limit = 20;
$list_id_token = array();
$i1 = 0;
$id_i1 = '';
$i2 = 0;
$id_i2 = '';
$link_api = "{$config['server_token']}/api/get.php?get_many_token=1&loai_acc={$like['type_clone']}&limit={$limit}&where_run=reactions";
$get_token =  json_decode(curl($link_api), true);
foreach ($get_token as $token) {
	$token_trim = trim($token['access_token']);
	$dem = 0;
	foreach ($get as $like) {
		$dem++;
		if(check_like($like['uid'], $token_trim)){
			$start_like = curl("https://graph.facebook.com/{$like['uid']}/likes?access_token={$token_trim}&method=POST");
		}else{
			$start_like = false;
		}

		if($start_like == true){
			if($dem == 1){
				$i1++;
				$id_i1 = $like['id'];
			}else{
				$i2++;
				$id_i2 = $like['id'];
			}
		}
	}
	array_push($list_id_token, $token['id']);
}
$update_time = base64_encode(json_encode($list_id_token));
curl("{$config['server_token']}/api/set.php?update_time={$update_time}");
if($id_i1 != ''){
	$db->query("UPDATE buff_like SET da_dap_ung = da_dap_ung + {$i1}, time_run = {$time} + 35 WHERE id = {$id_i1}");
}
if($id_i2 != ''){
	$db->query("UPDATE buff_like SET da_dap_ung = da_dap_ung + {$i2}, time_run = {$time} + 35 WHERE id = {$id_i2}");

}
/*$check = check_like('177303326267150', 'EAAAAUaZA8jlABALdV9mMtWhD9UqtCqAjxIoZAQLIJfG8s5A9OZCnDhdaAWOq6ZC0OeCkyFiNV80DCRa1FaQvot9524wdoDuaRyg7kZB7guQV6J7Wf6vjOl0frWvCZAVToMybZCAfbrMFzO688LxaUwnf7Dq7ZCnvLH0uapoL2WmGCwZDZD');
var_dump($check);*/
function check_like($id, $token){
	$data_like = json_decode(curl("https://graph.facebook.com/fql?q=SELECT%20page_id%20FROM%20page_fan%20WHERE%20uid=me()%20AND%20page_id=$id&access_token=$token"), true);
	if(isset($data_like['data'][0]['page_id'])){
		return true;
	}else{
		return false;
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