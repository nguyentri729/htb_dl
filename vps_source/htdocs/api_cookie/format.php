<?php
set_time_limit(0);
require_once 'system/FBCookie.php';
$list_acc = explode(PHP_EOL, file_get_contents('input/format.txt'));

for ($i = 0; $i < count($list_acc) ; $i++) { 
	 $ex = explode('|', $list_acc[$i]);
	 //var_dump($ex);
	echo $ex[3].PHP_EOL;
	/*$ex = explode('|', $list_acc[$i]);
	$info = json_decode(curl_url('https://graph.facebook.com/me?access_token='.$ex[3].''), true);
	if(isset($info['id'])){
		echo $info['id'].'|'.$ex[1].'|'.convert_token_to_cookie($ex[3]).$ex[3].'<br>';
	}*/
	

}

function curl_url($url){

	    $ch = @curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);

	    curl_setopt($ch, CURLOPT_ENCODING, '');

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

	        'Expect:'

	    ));

	    $page = curl_exec($ch);

	    curl_close($ch);

	    return $page;
	}
 function convert_token_to_cookie($token){

		$get_app = json_decode(curl_url('https://graph.facebook.com/app?access_token='.$token.''), true);

		if(isset($get_app['id'])){

			$get_cookie = json_decode(curl_url('https://api.facebook.com/method/auth.getSessionforApp?access_token='.$token.'&format=json&new_app_id='.$get_app['id'].'&generate_session_cookies=1'), true);

			if(isset($get_cookie['session_cookies'])){

				$ss_cookies = $get_cookie['session_cookies'];

				$cookie = $ss_cookies[0]['name'].'='.$ss_cookies[0]['value'].'; '.$ss_cookies[1]['name'].'='.$ss_cookies[1]['value'].'; '.$ss_cookies[2]['name'].'='.$ss_cookies[2]['value'].'; '.$ss_cookies[3]['name'].'='.$ss_cookies[3]['value'].'; ';

				return $cookie;

			}

		}else{

			return false;

		}

	}

?>

