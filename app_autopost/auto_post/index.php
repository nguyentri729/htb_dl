
<?php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
set_time_limit(0);
$fb = new \Facebook\Facebook([
  'app_id' => '6628568379',
  'app_secret' => 'c1e620fa708a1d5696fb991c1bde5662',
  'default_graph_version' => 'v2.10'
  
]);
$posts = json_decode(file_get_contents('http://app.hethongbotvn.com/CronJobs/AutoPost'),true);



foreach ($posts as $post) {
	$anh = false;
	$fb->setDefaultAccessToken($post['access_token']);
	$attached_media = []; 
  //if post where albums
	if($post['post_where'] == 'albums'){

		$arr_gr = json_decode($post['ab_gr'], false, 512, JSON_BIGINT_AS_STRING);
    	

		foreach (json_decode($post['image'], true) as $photo) {
	       $data = array(
	        'url' => $photo,
	        'caption' => $post['message']
	      );
	      $response = $fb->post($arr_gr[array_rand($arr_gr, 1)].'/photos', $data);
	   }
     file_get_contents('http://app.hethongbotvn.com/CronJobs/AutoPost/PostDone/'.$post['id']);
	   continue;
	 }
   if($post['image'] !='null'){
      $img = json_decode($post['image'], true);
      foreach ($img as $photo) {
         $data = array(
          'url' => $photo,
          'published' => false

        );
        $response = $fb->post('/me/photos', $data);
        if(isset($response->getGraphNode()['id'])){
          array_push($attached_media, '{"media_fbid":"'.$response->getGraphNode()['id'].'"}');
        }
      }
   }
    
    $arr_post = array();
    if(count($attached_media) > 0){
    	$arr_post['attached_media'] = $attached_media;
      if($post['message'] !=''){
        $arr_post['message'] = $post['message'];
      }
    	$anh = true;
    }else{
      $arr_post['message'] = $post['message'];
    }
    switch ($post['post_where']) {
    	case 'group':
    		$arr_gr = json_decode($post['ab_gr'], false, 512, JSON_BIGINT_AS_STRING);
    		$url = $arr_gr[array_rand($arr_gr, 1)].'/feed';
    		
    		break;
    	default:
    		$url ='me/feed';
    		break;
    }
     $post_img = $fb->post($url, $arr_post);
     var_dump($post_img->getGraphNode()['id']);
	 if(isset($post_img->getGraphNode()['id'])){

        $id_post = $post_img->getGraphNode()['id'];
        if($id_post !=''){
        	file_get_contents('http://app.hethongbotvn.com/CronJobs/AutoPost/PostDone/'.$post['id']);
        }
        $fb->post($id_post, array(
          'privacy' => array(
            'value' => privacy_convert($post['privacy'])
          )
        ))->getGraphNode();
     }

}
function privacy_convert($pr){
	switch ($pr) {
		case 'everyone':
			return 'EVERYONE';
			break;
		case 'friend':
			return 'ALL_FRIENDS';
			break;
		default:
			return 'SELF';
			break;
	}
}
exit();
