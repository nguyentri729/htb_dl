<?php
set_time_limit(0);
require_once 'system/FBCookie.php';
$list_acc = explode(PHP_EOL, file_get_contents('input/account.txt'));

for ($i = 0; $i < count($list_acc) ; $i++) { 
	 
	
	$ex = explode('|', $list_acc[$i]);
	if(check_live($ex[0])){
		echo $ex[2].'<br>';
	}

}
function check_live($idfb = ''){
	$info = json_decode(curl_url('https://graph.facebook.com/v2.10/'.$idfb.'?fields=id,name&access_token=2572501972761888%7C6OMcGGUcdwaRklZ-WbGkQAONJSs'), true);
	if(isset($info['id'])){
		return true;
	}else{
		return false;
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
?>

