<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
set_time_limit(0);
header('Access-Control-Allow-Origin: *');  
$time = time() -28800;

require('system/FBCookie.php');
class CurlServer
{
	function query($query){
		$this->curl('http://sv1.hethongbotvn.com/api/api_query.php?query='.base64_encode($query).'');
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
	            
	    

	    $html = curl_exec($ch);
	    curl_close($ch);
	    return $html;
	}

}
$db = new CurlServer;
$get_user = json_decode(file_get_contents('http://sv1.hethongbotvn.com/api/api_get_botreactions.php?type=cookie'), true);
foreach ($get_user as $bot) {
	$cookie = $bot['access_token'];
	$fb = new FBCookie($cookie);
	$s = 0;
	$id_user = $bot['id_fb'];
	if(!isset($fb->info_cookie['id_fb'])){
		$qur = "UPDATE bot_reactions SET time_run = {$time} + 3600 WHERE id = {$bot['id']}";
		$db->query($qur);
		echo 'cookie die <br>';
		continue;
	}else{
			$kc = $bot['khoang_cach_lan'] * 60;
			$qur = "UPDATE bot_reactions SET time_run = {$time} + {$kc} WHERE id = {$bot['id']}";
			
			$db->query($qur);
	}
	$url = curl("https://m.facebook.com/", $cookie);
        if (preg_match_all('#ft_ent_identifier=(.+?)&#is', $url, $jickme)) {
            for ($i = 0; $i < count($jickme[1]); $i++) {
                if (file_exists('log/' . $jickme[1][$i] . '_' . $id_user . '')) {
                    $chay = 1;
                } else {
                    $f = fopen('log/' . $jickme[1][$i] . '_' . $id_user . '', 'w');
                    fwrite($f, '');
                    fclose($f);
                    $chay = 0;
                }
                if($s >= $bot['post_mot_lan']){

                	break;
                }
                if ($chay == 0) {
					$cx_arr = explode('|', $bot['cam_xuc_su_dung']);
				    $cam_xuc = $cx_arr[rand(0, count($cx_arr)-1)];
				    switch ($cam_xuc) {
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
                    
                    $code = $fb->reaction($reac,  $jickme[1][$i]);
                    if($code == 200){
                    	$s++;
                    }
                    sleep(1);
                }
            }
        }
		if($s == 0){
			$qur = "UPDATE bot_reactions SET time_run = {$time} WHERE id = {$bot['id']}";
			$db->query($qur);
		}else{
			
		}
		
		$db->query("UPDATE bot_reactions SET post_day = post_day + $s WHERE id = {$bot['id']}");
}


function curl($url, $cookie)
{
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
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

function post_data($site, $data, $cookie)
{
    $datapost = curl_init();
    $headers = array("Expect:");
    curl_setopt($datapost, CURLOPT_URL, $site);
    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
    curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
    curl_setopt($datapost, CURLOPT_COOKIE, $cookie);
    ob_start();
    $code  = curl_getinfo($datapost, CURLINFO_HTTP_CODE);
    $html = curl_exec($datapost);
    return $code;
    //    ob_end_clean();
    //    curl_close ($datapost);
    //    unset($datapost);
}