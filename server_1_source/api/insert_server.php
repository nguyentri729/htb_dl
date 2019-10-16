<?php
include_once('load_head.php');
$get = json_decode(file_get_contents('http://new.hethongbotvn.com/Test'), true);
foreach ($get as $user) {
	

	$db->insert('bot_reactions', $user);
}