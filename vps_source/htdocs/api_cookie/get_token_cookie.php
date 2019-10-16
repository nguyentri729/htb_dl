<?php
set_time_limit(0);
require_once 'system/FBCookie.php';
$list_acc = explode(PHP_EOL, file_get_contents('input/account.txt'));
$now = file_get_contents('input/dem.txt');
for ($i = $now; $i < $now+3 ; $i++) { 
	 $ex = explode('|', $list_acc[$i]);
	 $fb = new FBCookie($ex[3], $ex[4]);
	 $token_geted = $fb->get_token_from_cookie();
	 if($token_geted != false){
		$path = 'input/access_token.txt';
		$fp = fopen($path, 'a+');
		$a = $i+2;
		fwrite($fp, $ex[0].'|'.$ex[1].'|'.$ex[2].'|'.$ex[3].'|'.$token_geted.'|'.$ex[5].'|'.$ex[6].PHP_EOL.'');
		fclose($fp);
	 }
}
$path = 'input/dem.txt';
$fp = fopen($path, 'w');
fwrite($fp, $i);
fclose($fp);



echo '<h1>'.$i.'</h1>';
?>
<?php
	if($i > 150){
		echo '<br><h1>XONG ROI ANH YEU </h1>';
	}else{
		echo '<meta http-equiv="refresh" content="5">';
	}
?>

