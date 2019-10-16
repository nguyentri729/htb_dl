<?php
include_once('../api/load_head.php');
$time = time();
$buff_follow = $db->query("SELECT * FROM buff_follow WHERE da_dap_ung >= so_luong LIMIT 2", true);
$buff_like = $db->query("SELECT * FROM buff_like WHERE da_dap_ung >= so_luong LIMIT 2", true);
$buff_rate = $db->query("SELECT * FROM buff_rate WHERE da_dap_ung >= so_luong LIMIT 2", true);
$buff_share = $db->query("SELECT * FROM buff_share WHERE da_dap_ung >= so_luong LIMIT 2", true);
$buff_reactions = $db->query("SELECT * FROM buff_reactions WHERE da_dap_ung >= so_luong LIMIT 2", true);
foreach ($buff_follow as $buff) {
	$curl = curl($config['server'].'/API/Buff/SetActive?set_active='.$buff['id_main'].'&where=buff_follow');
	if(trim($curl) == 'success'){
		$db->where('id', $buff['id']);
		$db->delete('buff_follow');
	}
}

foreach ($buff_like as $buff) {
	$curl = curl($config['server'].'/API/Buff/SetActive?set_active='.$buff['id_main'].'&where=buff_like');
	if(trim($curl) == 'success'){
		$db->where('id', $buff['id']);
		$db->delete('buff_like');
	}
}


foreach ($buff_rate as $buff) {
	$curl = curl($config['server'].'/API/Buff/SetActive?set_active='.$buff['id_main'].'&where=buff_rate');
	if(trim($curl) == 'success'){
		$db->where('id', $buff['id']);
		$db->delete('buff_rate');
	}
}

foreach ($buff_share as $buff) {
	$curl = curl($config['server'].'/API/Buff/SetActive?set_active='.$buff['id_main'].'&where=buff_share');
	if(trim($curl) == 'success'){
		$db->where('id', $buff['id']);
		$db->delete('buff_share');
	}
}


foreach ($buff_reactions as $buff) {
	$curl = curl($config['server'].'/API/Buff/SetActive?set_active='.$buff['id_main'].'&where=buff_reactions');
	if(trim($curl) == 'success'){
		$db->where('id', $buff['id']);
		$db->delete('buff_reactions');
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