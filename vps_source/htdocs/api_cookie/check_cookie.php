<?php
header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');
require_once 'system/FBCookie.php';
if(isset($_GET['cookie'])){
	$fb = new FBCookie(base64_decode($_GET['cookie']));
	if(isset($fb->info_cookie['id_fb'])){
		header("HTTP/1.1 200 OK");
		echo json_encode($fb->info_cookie);
	}else{
		    header("HTTP/1.1 404 Not Found");

		echo json_encode(array('error' => 'Cookie die !'));
	}
	
}