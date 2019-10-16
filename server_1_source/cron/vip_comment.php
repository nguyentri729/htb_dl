<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM posts_comment WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time ORDER BY RAND() LIMIT 2", true);
//var_dump($get);
$list_id_token = array();
$turn_off_comment = array();
foreach ($get as $post) {
	$limit = $post['so_luong_lan']*2;
	
	$link_api = "{$config['server_token']}/api/get.php?get_many_token=1&gender={$post['gioi_tinh']}&loai_acc={$post['loai_acc_tuong_tac']}&limit={$limit}&where_run=comment";
	$get_token =  json_decode(curl($link_api), true);




	$i = 0;
	foreach ($get_token as $token) {

		if($i >= $post['so_luong_lan']){
			break;
		}

		$token_trim = trim($token['access_token']);
		
		$ok = check_can_like($post['id_post'],$token_trim);

		

		if($ok){

			$nd = json_decode(curl($config['server'].'/API/Vip/Comment/get_comment?id='.$post['id_main'].''), true);

			$name_file_log = '../log_vip_comments/'.$post['id_post'].'_'.$nd['data']['id'].''; //Tên của file log
			//Kiểm tra file log
			if(file_exists($name_file_log)){
				continue;
			}

			if(isset($nd['data'])){

				if($nd['data']['message'] == ''){
					$message = '';
				}else{
					$message = 'message='.creat_message($nd['data']['message'], $post['id_vip']).'&';
				}
				if($nd['data']['sticker_id'] == ''){
					$attachment_id = '';
				}else{
					$attachment_id = 'attachment_id='.$nd['data']['sticker_id'].'&';
				}
				if($nd['data']['image_url'] == ''){
					$attachment_url = '';
				}else{
					$attachment_url = 'attachment_url='.$nd['data']['image_url'].'&';
				}

				$tt = json_decode(curl("https://graph.facebook.com/{$post['id_post']}/comments?access_token={$token_trim}&$message$attachment_id$attachment_url&method=POST"), true);
				
				if(isset($tt['id'])){

					//Ghi log
					if(!file_exists($name_file_log)){
					    $f = fopen($name_file_log,'w');
					    fwrite($f,'');
					    fclose($f);
					}

					array_push($list_id_token, $token['id']);
					//array_push($turn_off_comment, array('id_post' => $post['id_post'], 'token' => $token_trim));
					$i++;

				}
			}

		}
	}
	if($i> 0){
		$db->query("UPDATE posts_comment SET so_luong_da_dap_ung = so_luong_da_dap_ung + $i, time_run = $time + {$post['khoang_cach_moi_lan']} WHERE id = {$post['id']}");
	}
	
	echo $post['id_post'].': '.$i.'<hr>';
}


$update_time = base64_encode(json_encode($list_id_token));
$off_token = base64_encode(json_encode($turn_off_comment));
curl("{$config['server_token']}/api/set.php?update_time={$update_time}");

//curl("{$config['server_token']}/api/off_noti.php?data={$off_token}");


function check_can_like($id, $token){

	/*	$data = json_decode(curl("https://graph.facebook.com/v2.11/$id/likes?access_token=$token&limit=0&summary=true&method=GET"), true);
		
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
		}*/
		return true;
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
function creat_message($string, $id=''){
	$string_arr = explode('|', $string);
	$text = $string_arr[rand(0, count($string_arr))];
	//icon ramdom
	$icon = array(
		urldecode('%F3%BE%80%80'),
		urldecode('%F3%BE%80%81'),
		urldecode('%F3%BE%80%82'),
		urldecode('%F3%BE%80%83'),
		urldecode('%F3%BE%80%84'),
		urldecode('%F3%BE%80%85'),
		urldecode('%F3%BE%80%87'), 
		urldecode('%F3%BE%80%B8'), 
		urldecode('%F3%BE%80%BC'),
		urldecode('%F3%BE%80%BD'),
		urldecode('%F3%BE%80%BE'),
		urldecode('%F3%BE%80%BF'),
		urldecode('%F3%BE%81%80'),
		urldecode('%F3%BE%81%81'),
		urldecode('%F3%BE%81%82'),
		urldecode('%F3%BE%81%83'),
		urldecode('%F3%BE%81%85'),
		urldecode('%F3%BE%81%86'),
		urldecode('%F3%BE%81%87'),
		urldecode('%F3%BE%81%88'),
		urldecode('%F3%BE%81%89'), 
		urldecode('%F3%BE%81%91'),
		urldecode('%F3%BE%81%92'),
		urldecode('%F3%BE%81%93'), 
		urldecode('%F3%BE%86%90'),
		urldecode('%F3%BE%86%91'),
		urldecode('%F3%BE%86%92'),
		urldecode('%F3%BE%86%93'),
		urldecode('%F3%BE%86%94'),
		urldecode('%F3%BE%86%96'),
		urldecode('%F3%BE%86%9B'),
		urldecode('%F3%BE%86%9C'),
		urldecode('%F3%BE%86%9D'),
		urldecode('%F3%BE%86%9E'),
		urldecode('%F3%BE%86%A0'),
		urldecode('%F3%BE%86%A1'),
		urldecode('%F3%BE%86%A2'),
		urldecode('%F3%BE%86%A4'),
		urldecode('%F3%BE%86%A5'),
		urldecode('%F3%BE%86%A6'),
		urldecode('%F3%BE%86%A7'),
		urldecode('%F3%BE%86%A8'),
		urldecode('%F3%BE%86%A9'),
		urldecode('%F3%BE%86%AA'),
		urldecode('%F3%BE%86%AB'),
		urldecode('%F3%BE%86%AE'),
		urldecode('%F3%BE%86%AF'),
		urldecode('%F3%BE%86%B0'),
		urldecode('%F3%BE%86%B1'),
		urldecode('%F3%BE%86%B2'),
		urldecode('%F3%BE%86%B3'), 
		urldecode('%F3%BE%86%B5'),
		urldecode('%F3%BE%86%B6'),
		urldecode('%F3%BE%86%B7'),
		urldecode('%F3%BE%86%B8'),
		urldecode('%F3%BE%86%BB'),
		urldecode('%F3%BE%86%BC'),
		urldecode('%F3%BE%86%BD'),
		urldecode('%F3%BE%86%BE'),
		urldecode('%F3%BE%86%BF'),
		urldecode('%F3%BE%87%80'),
		urldecode('%F3%BE%87%81'),
		urldecode('%F3%BE%87%82'),
		urldecode('%F3%BE%87%83'),
		urldecode('%F3%BE%87%84'),
		urldecode('%F3%BE%87%85'),
		urldecode('%F3%BE%87%86'),
		urldecode('%F3%BE%87%87'), 
		urldecode('%F3%BE%87%88'),
		urldecode('%F3%BE%87%89'),
		urldecode('%F3%BE%87%8A'),
		urldecode('%F3%BE%87%8B'),
		urldecode('%F3%BE%87%8C'),
		urldecode('%F3%BE%87%8D'),
		urldecode('%F3%BE%87%8E'),
		urldecode('%F3%BE%87%8F'),
		urldecode('%F3%BE%87%90'),
		urldecode('%F3%BE%87%91'),
		urldecode('%F3%BE%87%92'),
		urldecode('%F3%BE%87%93'),
		urldecode('%F3%BE%87%94'),
		urldecode('%F3%BE%87%95'),
		urldecode('%F3%BE%87%96'),
		urldecode('%F3%BE%87%97'),
		urldecode('%F3%BE%87%98'),
		urldecode('%F3%BE%87%99'),
		urldecode('%F3%BE%87%9B'), 
		urldecode('%F3%BE%8C%AC'),
		urldecode('%F3%BE%8C%AD'),
		urldecode('%F3%BE%8C%AE'),
		urldecode('%F3%BE%8C%AF'),
		urldecode('%F3%BE%8C%B0'),
		urldecode('%F3%BE%8C%B2'),
		urldecode('%F3%BE%8C%B3'),
		urldecode('%F3%BE%8C%B4'),
		urldecode('%F3%BE%8C%B6'),
		urldecode('%F3%BE%8C%B8'),
		urldecode('%F3%BE%8C%B9'),
		urldecode('%F3%BE%8C%BA'),
		urldecode('%F3%BE%8C%BB'),
		urldecode('%F3%BE%8C%BC'),
		urldecode('%F3%BE%8C%BD'),
		urldecode('%F3%BE%8C%BE'),
		urldecode('%F3%BE%8C%BF'), 
		urldecode('%F3%BE%8C%A0'),
		urldecode('%F3%BE%8C%A1'),
		urldecode('%F3%BE%8C%A2'),
		urldecode('%F3%BE%8C%A3'),
		urldecode('%F3%BE%8C%A4'),
		urldecode('%F3%BE%8C%A5'),
		urldecode('%F3%BE%8C%A6'),
		urldecode('%F3%BE%8C%A7'),
		urldecode('%F3%BE%8C%A8'),
		urldecode('%F3%BE%8C%A9'),
		urldecode('%F3%BE%8C%AA'),
		urldecode('%F3%BE%8C%AB'), 
		urldecode('%F3%BE%8D%80'),
		urldecode('%F3%BE%8D%81'),
		urldecode('%F3%BE%8D%82'),
		urldecode('%F3%BE%8D%83'),
		urldecode('%F3%BE%8D%84'),
		urldecode('%F3%BE%8D%85'),
		urldecode('%F3%BE%8D%86'),
		urldecode('%F3%BE%8D%87'),
		urldecode('%F3%BE%8D%88'),
		urldecode('%F3%BE%8D%89'),
		urldecode('%F3%BE%8D%8A'),
		urldecode('%F3%BE%8D%8B'),
		urldecode('%F3%BE%8D%8C'),
		urldecode('%F3%BE%8D%8D'),
		urldecode('%F3%BE%8D%8F'),
		urldecode('%F3%BE%8D%90'),
		urldecode('%F3%BE%8D%97'),
		urldecode('%F3%BE%8D%98'),
		urldecode('%F3%BE%8D%99'),
		urldecode('%F3%BE%8D%9B'),
		urldecode('%F3%BE%8D%9C'),
		urldecode('%F3%BE%8D%9E'), 
		urldecode('%F3%BE%93%B2'), 
		urldecode('%F3%BE%93%B4'),
		urldecode('%F3%BE%93%B6'), 
		urldecode('%F3%BE%94%90'),
		urldecode('%F3%BE%94%92'),
		urldecode('%F3%BE%94%93'),
		urldecode('%F3%BE%94%96'),
		urldecode('%F3%BE%94%97'),
		urldecode('%F3%BE%94%98'),
		urldecode('%F3%BE%94%99'),
		urldecode('%F3%BE%94%9A'),
		urldecode('%F3%BE%94%9C'),
		urldecode('%F3%BE%94%9E'),
		urldecode('%F3%BE%94%9F'),
		urldecode('%F3%BE%94%A4'),
		urldecode('%F3%BE%94%A5'),
		urldecode('%F3%BE%94%A6'),
		urldecode('%F3%BE%94%A8'), 
		urldecode('%F3%BE%94%B8'),
		urldecode('%F3%BE%94%BC'),
		urldecode('%F3%BE%94%BD'), 
		urldecode('%F3%BE%9F%9C'), 
		urldecode('%F3%BE%A0%93'),
		urldecode('%F3%BE%A0%94'),
		urldecode('%F3%BE%A0%9A'),
		urldecode('%F3%BE%A0%9C'),
		urldecode('%F3%BE%A0%9D'),
		urldecode('%F3%BE%A0%9E'),
		urldecode('%F3%BE%A0%A3'), 
		urldecode('%F3%BE%A0%A7'),
		urldecode('%F3%BE%A0%A8'),
		urldecode('%F3%BE%A0%A9'), 
		urldecode('%F3%BE%A5%A0'), 
		urldecode('%F3%BE%A6%81'),
		urldecode('%F3%BE%A6%82'),
		urldecode('%F3%BE%A6%83'), 
		urldecode('%F3%BE%AC%8C'),
		urldecode('%F3%BE%AC%8D'),
		urldecode('%F3%BE%AC%8E'),
		urldecode('%F3%BE%AC%8F'),
		urldecode('%F3%BE%AC%90'),
		urldecode('%F3%BE%AC%91'),
		urldecode('%F3%BE%AC%92'),
		urldecode('%F3%BE%AC%93'),
		urldecode('%F3%BE%AC%94'),
		urldecode('%F3%BE%AC%95'),
		urldecode('%F3%BE%AC%96'),
		urldecode('%F3%BE%AC%97'),
		);
	$pattern = "/\[random_icon\]/";
	while(preg_match($pattern, $text)) {
		$text = preg_replace($pattern, $icon[array_rand($icon)], $text, 1);
	}
	$text = str_replace('[tag]','@['.$id.':1] ', $text);

    if(preg_match('#tag=(.+?)=tag#is',$text, $av)){
       $text = str_replace('tag='.$av[1].'=tag',  '@['.$av[1].':1] ', $text);
    }
	return urlencode($text);
}