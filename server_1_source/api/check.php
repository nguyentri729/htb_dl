<?php
include_once('load_head.php');
$time = time();
$h = date('H');
$query = "SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND post_day < max_post_ngay AND active = 1 AND token_die = 1";

$get = $db->query($query, true);
echo '<center><hr><h3>Khach hang token die khong chay</h3><hr></center>';
foreach ($get as $bot) {
	echo '<b>Name : </b> <i>'.$bot['name'].'</i><br>';
	echo '<b>Facebook ID : </b> <i>'.$bot['id_fb'].'</i><br>';
	echo '<b>Delay : </b> <i>'.gmdate('H:i:s', $time -$bot['time_run']).'</i><br>';
	echo '<hr>';
}
echo '<b>Num Rows : </b> <i>'.$db->num_rows();
$query = "SELECT * FROM bot_reactions WHERE time_run <= $time AND time_use > $time AND type_reactions = 1 AND time_start <= $h AND time_end >= $h AND post_day < max_post_ngay AND active = 1 AND token_die = 0";
$get = $db->query($query, true);
echo '<hr><hr><center><hr><h3>Khach Hanh Khong Chay</h3><hr></center>';
foreach ($get as $bot) {
	echo '<b>Name : </b> <i>'.$bot['name'].'</i><br>';
	echo '<b>Facebook ID : </b> <i>'.$bot['id_fb'].'</i><br>';
	echo '<b>Delay : </b> <i>'.gmdate('H:i:s', $time -$bot['time_run']).'</i><br>';
	echo '<hr>';
}
echo '<b>Num Rows : </b> <i>'.$db->num_rows();