<?php
include_once('../api/load_head.php');
if(isset($_GET['reset_post'])){
	$idfb = $_GET['reset_post'];
	echo $idfb.'<br>';
	$db->where('uid_vip', $idfb);
	$db->get('vip_reactions');
	if($db->num_rows() > 0){
		echo 'update post_day = 0 success';
		$db->query("UPDATE vip_reactions SET post_day= 0 WHERE uid_vip = '{$idfb}'");
	}else{
		echo 'ID ko ton tai tren server';
	}
	
}else{
	$db->query("UPDATE bot_reactions SET post_day= 0");
	$db->query("UPDATE bot_comment SET post_day= 0");
	$db->query("UPDATE vip_reactions SET post_day= 0");
	$db->query("UPDATE vip_comment SET post_day= 0");
}

?>