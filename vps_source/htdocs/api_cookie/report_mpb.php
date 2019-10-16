<?php
set_time_limit(0);
require_once 'system/FBCookie.php';
$list_acc = explode(PHP_EOL, file_get_contents('input/account.txt'));

$now = file_get_contents('input/dem.txt');
for ($i = $now; $i < $now+3 ; $i++) { 
	 $ex = explode('|', $list_acc[$i]);
	 $fb = new FBCookie($ex[3], $ex[4]);
	
	 $fb->report('100029671959672');

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
		echo '<meta http-equiv="refresh" content="40">';
	}
?>

