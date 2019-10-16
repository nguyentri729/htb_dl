<?php

include_once('../api/load_head.php');
$time = time();
$h = date("H");
$st = $db->query("SELECT * FROM `settings`", true);
if($st[0]['timerun_botreactions_token'] < time()){
	$get = $db->query("SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND post_day < max_post_ngay AND token_die = 0 AND active = 1 ORDER BY rand() LIMIT 5", true);
}else{
   $get = null;
}
foreach ($get as $bot) {

	$data_update = array(
		'time_run' => time() + $bot['khoang_cach_lan'] * 60
	);
	$db->where('id', $bot['id']);
	$db->update('bot_reactions', $data_update);

	if($bot['list_tt'] == 1){

		$ds_list = explode(PHP_EOL, $bot['ds_list']);
		if(count($ds_list) <= 0){
			continue;
		}else{
			$quet_id = $ds_list[rand(0, count($ds_list))].'/feed';
		}
	}else{
		$quet_id = 'me/home';
	}
	//Bắt đầu quét
	if($bot['post_mot_lan'] < 5){
		$nhan = 6;
	}else{
		$nhan = 3;
	}
	$limit_post = $bot['post_mot_lan'] * $nhan;
	
	$url_api = "https://graph.facebook.com/v3.0/$quet_id?access_token={$bot['access_token']}&fields=message&limit=$limit_post&method=GET";
	
	$quet = json_decode(curl($url_api), true);

	if(isset($quet['data'])){
		$i = 0;
		//Quét danh sách bài viết
		foreach ($quet['data'] as $post) {

			//Dừng vòng lặp khi đủ post
			if($i >= $bot['post_mot_lan']){
				break;
			}
			$id_nguoi_post =  explode('_', $post['id'])[0]; //ID người post


			//Nếu ko sử dụng cảm xúc list.
			if($bot['list_tt'] == 0){
				

				$arr_tt = array();
				if($bot['group_tt'] == 1){
					array_push($arr_tt, 'group');
				}
				if($bot['page_tt'] == 1){
					array_push($arr_tt, 'page');
				}
				if($bot['profile_tt'] == 1){
					array_push($arr_tt, 'profile');
				}
				//Get id type
				$id_type = id_type($id_nguoi_post, $bot['access_token']);

				if(!in_array($id_type['type'], $arr_tt)){
					continue;
				}
				if($id_type['type'] == 'profile'){
					$age_id = $id_type['data']['age'];
					$gender_id = $id_type['data']['gender'];
					//Check Tuổi
					if( $age_id != ''){
						if($age_id < $bot['age_start'] OR $age_id > $bot['age_end']){
							continue;
						}
					}
					//Check giới tính
					if($gender_id != ''){
						if($bot['gender'] != 2){
							if($gender_id != $bot['gender']){
								
								continue;
							}
						}
					}
				}
			}

			//Lọc cụm từ không tương tác
			if($bot['cum_tu_ko_tt'] != ''){
				if(preg_match("({$bot['cum_tu_ko_tt']})", $post['message'])){
					//echo 'Lọc từ';
					continue;
				}
			}
			//Lọc ID không tương tác
			if($bot['nguoi_ko_tt'] != ''){
				$ds_nguoi = explode(PHP_EOL, $bot['nguoi_ko_tt']);
				if(in_array($id_nguoi_post, $ds_nguoi)){
					//echo 'Lọc người không tương tác';
					continue;
				}
			}




			$name_file_log = '../log_reactions/'.$bot['id'].'_'.$post['id'].''; //Tên của file log
			//Kiểm tra file log
			if(file_exists($name_file_log)){
				continue;
			}

			echo $post['id'].'<hr>';
			//Bắt đầu reactions
			$cx_arr = explode('|', $bot['cam_xuc_su_dung']);
		   $cam_xuc = $cx_arr[rand(0, count($cx_arr)-1)];



			//Start reactions
			//reaction($token,$idstt,$uid,$type="LIKE")
			$tt = reaction($bot['access_token'], $post['id'], $bot['id_fb'], $cam_xuc);

			//$tt = json_decode(curl("https://graph.facebook.com/{$post['id']}/reactions?type=$cam_xuc&access_token={$bot['access_token']}&method=POST"), true);




			if($tt == 'true'){
				echo 'ok';
				$i++;

				
				//Ghi log
				if(!file_exists($name_file_log)){
				    $f = fopen($name_file_log,'w');
				    fwrite($f,'');
				    fclose($f);
				}

			}
		}


		if($i == 0){
			$data_update = array(
				'time_run' => $bot['time_run']
			);
			$db->where('id', $bot['id']);
			$db->update('bot_reactions', $data_update);
		}
	
		$db->query("UPDATE bot_reactions SET post_day = post_day + $i WHERE id = {$bot['id']}");
	}else{
		$data_update = array(
			'token_die' => 1
		);
		$db->where('id', $bot['id']);
		$db->update('bot_reactions', $data_update);
		continue;
	}

}
//Group : 326257041219363
//Profile: 4
//Page: 316684158823331
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
         
    curl_setopt($ch, CURLOPT_URL, $url);
                
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}
function id_type($id, $token){
	$ok = json_decode(curl("https://graph.facebook.com/$id?access_token=$token&method=GET"), true);
	//print_r($ok);
	if(isset($ok['likes'])){
		 $return =  array(
		  	'type' => 'page',
		 );
	}elseif (isset($ok['icon'])) {
		 $return =  array(
		  	'type' => 'group',
		 );
	}else{
		 $return =  array(
		  	'type' => 'profile',
		  	'data' => array(
		  		'age' => '',
		  		'gender' => ''
		  	)
		 );
		 //Kiểm tra ngày sinh
		if(isset($ok['birthday'])){

		  $birthDate = explode("/", $ok['birthday']);
		  if(count($birthDate) > 0){
			  	if(count($birthDate) == 1){
			  		$ngay = 1;
			  		$thang = 1;
			  		$nam = $birthDate[0];
			  	}elseif (count($birthDate) == 2) {
			  		$ngay = 1;
			  		$thang = $birthDate[0];
			  		$nam = $birthDate[1];
			  	}else{
			  		$ngay = $birthDate[1];
			  		$thang = $birthDate[0];
			  		$nam = $birthDate[2];
			  	}
			//get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $thang, $ngay, $nam))) > date("md")
			    ? ((date("Y") - $nam) - 1)
			    : (date("Y") - $nam));
			if($age > 100){
				 $return['data']['age'] = '';
			}else{
				$return['data']['age'] = $age;
			}

		  }else{
		  	$return['data']['age'];
		  }
		}
		//Kiểm tra giới tính
		if(isset($ok['gender'])){
			if($ok['gender'] == 'male'){
				$return['data']['gender'] = '0';
			}else{
				$return['data']['gender'] = '1';
			}
		}
		

	}
	return $return;
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

function reaction($token,$idstt,$uid,$type="LIKE"){
    $idstt = explode("_",$idstt);
    $uidtarget = $idstt[0];
    $idstt = $idstt[1];
    $reac = "3";
    switch ($type) {
        case "1":
            $reac = "1";
            break;
        case "2":
            $reac = "2";
            break;
        case "6":
            $reac = "4";
            break;
        case "4":
            $reac = "3";
            break;
        case "5":
            $reac = "7";
            break;
        case "3":
            $reac = "8";
            break;
        default:
            $reac = "3";
    }
    $idsttbase64 = urlencode( base64_encode("feedback:".$idstt));
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://graph.facebook.com/graphql",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "doc_id=1465022236921477&method=post&locale=vi_VN&pretty=false&format=json&variables=%7B%220%22%3A%7B%22tracking%22%3A%5B%22%7B%5C%22top_level_post_id%5C%22%3A%5C%22".$idstt."%5C%22%2C%5C%22tl_objid%5C%22%3A%5C%22".$idstt."%5C%22%2C%5C%22throwback_story_fbid%5C%22%3A%5C%22".$idstt."%5C%22%2C%5C%22profile_id%5C%22%3A%5C%22".$uidtarget."%5C%22%2C%5C%22profile_relationship_type%5C%22%3A2%2C%5C%22actrs%5C%22%3A%5C%22".$uidtarget."%5C%22%7D%22%2C%22%7B%5C%22image_loading_state%5C%22%3A0%2C%5C%22radio_type%5C%22%3A%5C%22wifi-none%5C%22%7D%22%5D%2C%22feedback_source%22%3A%22video_channel_feed%22%2C%22feedback_reaction%22%3A".$reac."%2C%22client_mutation_id%22%3A%22a6c63b5d-d926-".rand(111,999)."f-92a6-e35xf8f".rand(1111,9999)."4%22%2C%22nectar_module%22%3A%22unknown%22%2C%22actor_id%22%3A%22".$uid."%22%2C%22feedback_id%22%3A%22".$idsttbase64."%22%2C%22action_timestamp%22%3A".$uid."%7D%7D&fb_api_req_friendly_name=ViewerReactionsMutation&fb_api_caller_class=graphservice",
      CURLOPT_HTTPHEADER => array(
        "accept-encoding: gzip, deflate",
        "authorization: OAuth ".$token,
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "host: graph.facebook.com",
        "user-agent: [FBAN/FB4A;FBAV/153.0.0.54.88;FBBV/84570987;FBDM/{density=2.0,width=720,height=1280};FBLC/vi_VN;FBRV/85070460;FBCR/Android;FBMF/x86;FBBD/generic;FBPN/com.facebook.katana;FBDV/Samsung Galaxy S".rand(3,7)." - ".rand(4,6).".0.".rand(1,7)." - API 16 - 720x1280;FBSV/4.1.1;FBOP/1;FBCA/x86:unknown;]",
        "x-fb-connection-type: WIFI",
        "x-fb-friendly-name: ViewerReactionsMutation",
        "x-fb-http-engine: Liger",
        "x-fb-net-hni: 310260",
        "x-fb-sim-hni: 310270"
      ),
    ));
    
    echo $response = curl_exec($curl);
    curl_close($curl);
    if(strpos($response,'{"data":{"feedback_react":{"feedback":{"id":"') !== false){
        return "true";
    }else{
        if(strpos($response,'"code": 190,') || strpos($response,'"code":190,')){
            return "tokendie";
        }
        if(strpos($response,'"code": 12,') || strpos($response,'"code":12,')){
            return "tokennotable";
        }
    }
}
