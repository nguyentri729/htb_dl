<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM buff_rate WHERE da_dap_ung < so_luong AND time_run < $time ORDER BY RAND() LIMIT 2", true);

$limit = 10;
$list_id_token = array();
$i1 = 0;
$id_i1 = '';
$i2 = 0;
$id_i2 = '';
$link_api = "{$config['server_token']}/api/get.php?get_many_token=1&loai_acc={$like['type_clone']}&limit={$limit}&where_run=all";
$get_token =  json_decode(curl($link_api), true);
foreach ($get_token as $token) {
	$token_trim = trim($token['access_token']);
	$dem = 0;
	foreach ($get as $like) {
		$dem++;


		$start_like= curl("https://graph.facebook.com/{$like['uid']}/ratings?access_token={$token_trim}&rating={$like['rate']}&method=POST");
		if($start_like == 'true'){
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
	$db->query("UPDATE buff_rate SET da_dap_ung = da_dap_ung + {$i1}, time_run = {$time} + 300 WHERE id = {$id_i1}");
}
if($id_i2 != ''){
	$db->query("UPDATE buff_rate SET da_dap_ung = da_dap_ung + {$i2}, time_run = {$time} + 300 WHERE id = {$id_i2}");

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