<?php
set_time_limit(0);
$arr = array(
	'status' => false,
	'name' => array(
		'first' => '',
		'middle' => '',
		'last'  => ''
	)
);
$get = curl_url('https://www.fakenamegenerator.com/advanced.php?t=country&n%5B%5D=vn&c%5B%5D=us&gen=50&age-min=19&age-max=85');
if(preg_match('#<h3>(.+?)</h3>#is',$get, $_jickme)){
		$name_now = explode(' ', $_jickme[1]);
		if(count($name_now) == 3){
			$arr = array(
				'status' => true,
				'name' => array(
					'first' => $name_now[0],
					'middle' => $name_now[1],
					'last'  => $name_now[2]
				)
			);
		}else{
			$arr = array(
				'status' => true,
				'name' => array(
					'first' => $name_now[0],
					'middle' => $name_now[1],
					'last'  => $name_now[2].' '.$name_now[3]
				)
			);
		}
		
}
echo json_encode($arr);
function curl_url($url){

	    $ch = @curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);

	    curl_setopt($ch, CURLOPT_ENCODING, '');

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

	        'Expect:'

	    ));

	    $page = curl_exec($ch);

	    curl_close($ch);

	    return $page;
	}
