<?php
require_once '../system/Mysql.php';
if(isset($_GET['pass'])){
	$db->where('uid', $_GET['uid']);
	$db->get('account');
	if($db->num_rows() == 0){
		$db->insert('account', $_GET);
	}
	
}