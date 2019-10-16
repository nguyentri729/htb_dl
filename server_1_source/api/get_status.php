<?php
include_once('load_head.php');
header('Content-Type: application/json');
if(isset($_GET['type'])){
	switch ($_GET['type']) {
		case 'server_vip':
			$db->get('vip_reactions');
			$vip_reactions = $db->num_rows();
			$db->get('vip_comment');
			$vip_comment = $db->num_rows();
			/*$db->get('vip_share');
			$vip_share = $db->num_rows();*/
			$result = array(
				'vip_reactions' => $vip_reactions,
				'vip_comment' => $vip_comment,
				//'vip_share' => $vip_share
			);
			break;
		case 'server_bot':
			$db->get('bot_reactions');
			$bot_reactions = $db->num_rows();
			$db->get('bot_comment');
			$bot_comment = $db->num_rows();
			//$db->get('bot_post');
			//$bot_post = $db->num_rows();
			$result = array(
				'bot_reactions' => $bot_reactions,
				'bot_comment' => $bot_comment,
				//'bot_post' => $bot_post
			);
			break;
		default:
			$db->get('buff_like');
			$buff_like = $db->num_rows();
			$db->get('buff_reactions');
			$buff_reactions = $db->num_rows();
			$db->get('buff_share');
			$buff_share = $db->num_rows();
			$db->get('buff_follow');
			$buff_follow = $db->num_rows();
			$db->get('buff_rate');
			$buff_rate = $db->num_rows();
			$result = array(
				'buff_like' => $buff_like,
				'buff_reactions' => $buff_reactions,
				'buff_share' => $buff_share,
				'buff_follow' => $buff_follow,
				'buff_rate' => $buff_rate,
			);
			break;
	}
	echo json_encode($result);
}