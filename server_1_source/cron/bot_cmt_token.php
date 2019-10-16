<?php

include_once('../api/load_head.php');

$time = time();

$h = date("H");

$get = $db->query("SELECT * FROM bot_comment WHERE time_run <= $time AND time_use > $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND post_day < max_post_ngay AND active = 1 AND token_die = 0 ORDER BY rand() LIMIT 2", true);

foreach ($get as $bot) {

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

			$id_nguoi_post =  (string)explode('_', $post['id'])[0]; //ID người post





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



			$name_file_log = '../log_comments/'.$bot['id'].'_'.$post['id'].''; //Tên của file log

			//Kiểm tra file log

			if(file_exists($name_file_log)){

				continue;

			}

			//Get noi dung comment





			$nd = json_decode(curl($config['server'].'/API/Bot/Comment/get_comment?id='.$bot['id_main'].''), true);

			if(isset($nd['data'])){





				if($nd['data']['message'] == ''){

					$message = '';

				}else{

					$message = 'message='.creat_message($nd['data']['message'], $id_nguoi_post).'&';

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





				$tt = json_decode(curl("https://graph.facebook.com/{$post['id']}/comments?access_token={$bot['access_token']}&$message$attachment_id$attachment_url&method=POST"), true);

				

				if(isset($tt['id'])){

					$i++;

					//Ghi log

					if(!file_exists($name_file_log)){

					    $f = fopen($name_file_log,'w');

					    fwrite($f,'');

					    fclose($f);

					}

				}



				

				



				



			}else{

				break;

			}





			//echo $post['id'].'<hr>';









		}



		$data_update = array(

			'time_run' => time() + $bot['khoang_cach_lan'] * 60

		);

		$db->where('id', $bot['id']);

		$db->update('bot_comment', $data_update);

		$db->query("UPDATE bot_comment SET post_day = post_day + $i WHERE id = {$bot['id']}");

	}else{

		$data_update = array(

			'token_die' => 1

		);

		$db->where('id', $bot['id']);

		$db->update('bot_comment', $data_update);

		continue;

	}



}

function creat_message($string, $id=''){

	$string_arr = explode('|', $string);

	$text = $string_arr[rand(0, count($string_arr)-1)];

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

			    ? ((date("Y") - $birthDate[2]) - 1)

			    : (date("Y") - $birthDate[2]));

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



