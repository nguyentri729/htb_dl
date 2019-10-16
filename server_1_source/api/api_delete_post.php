<?php

include_once('load_head.php');
if(isset($_GET['id_post'])){
	$id = $_GET['id_post'];
	$db->where('id_post', $id);
	echo $db->update('posts_reactions', array('active' => 0));
	//$db->query("UPDATE posts_reactions WHERE id_post = '{$id}'");
}

