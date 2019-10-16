<?php
set_time_limit(0);
require_once 'system/FBCookie.php';
$uid_copy = explode(PHP_EOL, file_get_contents('input/uid.txt'));

//check ip
$ip = trim(file_get_contents('https://api.ipify.org'));
$path = 'input/ip_log.txt';
$fp = fopen($path, 'a+');
fwrite($fp, $ip.PHP_EOL.'');
fclose($fp);
//check_ip
if(substr_count(file_get_contents('input/ip_log.txt'), $ip) >= 3){
	if($ip =='45.32.119.235'){
		exit('HMA RESET ERROR!'); 
	}else{
		echo '<meta http-equiv="refresh" content="100">';
	}
	
}
$list_acc = explode(PHP_EOL, file_get_contents('input/account.txt'));
$now = file_get_contents('input/dem.txt');
for ($i = $now; $i < $now+3 ; $i++) { 
	 $ex = explode('|', $list_acc[$i]);
	 $fb = new FBCookie($ex[2], $ex[3]);

	 $id_copy = $uid_copy[array_rand($uid_copy, 1)];
	 $fb->copy_wall($id_copy);
	 $fb->rename($ex[1]);

	$path = 'input/account_change.txt';
	$fp = fopen($path, 'a+');
	$a = $i+2;
	fwrite($fp, $ex[0].'|'.$ex[1].'|'.$ex[2].'|'.$fb->access_token.'|'.$id_copy.PHP_EOL.'');
	fclose($fp);
}
$path = 'input/dem.txt';
$fp = fopen($path, 'w');
fwrite($fp, $i);
fclose($fp);



echo '<h1>'.$i.'</h1>';
?>
<?php
	if($i >610){
		echo '<br><h1>XONG ROI ANH YEU </h1>';
	}else{
		echo '<meta http-equiv="refresh" content="5">';
	}
?>

