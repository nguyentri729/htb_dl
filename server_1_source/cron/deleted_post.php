<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM posts_reactions WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time ORDER BY RAND()", true);
$posts_comment = $db->query("SELECT * FROM posts_comment WHERE so_luong_da_dap_ung < so_luong_can AND time_run < $time ORDER BY RAND()", true);
$get_token = json_decode(curl("{$config['server_token']}/api/get.php?get_one_token=1"), true);
if($get_token['status'] == true){
	$token = trim($get_token['data']);
	$check_token = json_decode(curl("https://graph.facebook.com/me?access_token=$token"), true);
	if(!isset($check_token['id'])){
		exit('Token die');
	}
}else{
	exit('Token die');
}
foreach ($get as $post) {
	$check_post = json_decode(curl("https://graph.facebook.com/{$post['id_post']}?access_token=$token"), true);
	if(!isset($check_post['id'])){
		echo '- deleted: '.$post['id_post'].' in posts_reactions<br>';
		$db->query("DELETE FROM `posts_reactions` WHERE id = {$post['id']}");
	}
}

foreach ($posts_comment as $post_cmt) {
	$check_post = json_decode(curl("https://graph.facebook.com/{$post_cmt['id_post']}?access_token=$token"), true);
	if(!isset($check_post['id'])){
		echo '- deleted: '.$post_cmt['id_post'].' in posts_comment<br>';
		$db->query("DELETE FROM `posts_comment` WHERE id = {$post_cmt['id']}");
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