<?php
include_once('../api/load_head.php');
$time = time();
$get = $db->query("SELECT * FROM vip_reactions WHERE time_repeat <= $time AND time_use > $time AND active = 1 AND post_day < so_post_dung", true);
//$get = $db->query("SELECT * FROM vip_reactions WHERE uid_vip = '100016976838808'", true);
foreach ($get as $vip) {

	//get random token
	$get_token = json_decode(curl("{$config['server_token']}/api/get.php?get_one_token=1"), true);
	
	if($get_token['status'] == true){
		$token = trim($get_token['data']);
	}else{
		break;
	}

	$get_feed = json_decode(curl("https://graph.facebook.com/v3.0/{$vip['uid_vip']}/feed?access_token=$token&limit=2"), true);
	var_dump($get_feed);
	if(isset($get_feed['data'])){
		$i = 0;
		foreach ($get_feed['data'] as $post) {
			$ex = explode('_', $post['id']);
			if($ex[0] != $vip['uid_vip']){
				continue;
			}
			$db->where('id_post', $post['id']);
			$db->get('posts_reactions');

			if($db->num_rows() == 0){

				$insert = array(
					'id_post' => $post['id'],
					'so_luong_can' => $vip['so_luong_dung'],
					'so_luong_da_dap_ung' => 0,
					'so_luong_lan' =>  $vip['so_luong_lan'],
					'loai_acc_tuong_tac' =>  $vip['loai_acc_tuong_tac'],
					'cam_xuc_su_dung' => $vip['cam_xuc_su_dung'],
					'khoang_cach_moi_lan' => $vip['khoang_cach_moi_lan'] * 60,
					'time_run' => time() + $vip['khoang_cach_moi_lan'] * 60,
					'tuoi_tu' =>  $vip['tuoi_tu'],
					'tuoi_den' =>  $vip['tuoi_den'],
					'gioi_tinh' =>  $vip['gioi_tinh'],
					'time_creat' => time(),
					'active' => 1
				);
				echo ' + Đã insert: '.$post['id'].'<br>';
				$db->insert('posts_reactions', $insert);
				$i++;
			}else{
				echo ' + Không insert: '.$post['id'].'<br>';
			}
		}

		echo $vip['id'].'<hr>';
		$db->query("UPDATE vip_reactions SET time_repeat = $time + 60, post_day = post_day + $i WHERE id = {$vip['id']}");
	}else{
		echo 'Access token die sml <hr>';
	}

	


}
echo '<meta http-equiv="refresh" content="60">';
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