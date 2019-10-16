<?php
set_time_limit(0);

$list_token = explode(PHP_EOL, file_get_contents('input/access_token_ios.txt'));

for ($i = 0; $i < count($list_token) ; $i++) { 

	$access_token = convert($list_token[$i]);
	if($access_token != false){
		echo $access_token.PHP_EOL;
	}

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
 function convert($token){

		$get_app = json_decode(curl_url('https://b-api.facebook.com/restserver.php?method=auth.getSessionForApp&format=json&access_token='.$token.'&new_app_id=6628568379&generate_session_cookies=0&__mref=message_bubble'), true);

		if(isset($get_app['access_token'])){

			return $get_app['access_token'];

		}else{

			return false;

		}

	}

?>

