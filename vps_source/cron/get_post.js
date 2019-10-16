const axios = require('axios');
var _token = '';
var _uid_now = '';
var _id_post = '';
var __id_post_insert = '';
var info_feed = [];
var z = 0;
var data = [];


setInterval(function(){
	
	bot_cx();

}, 60000);


function get_id_vip(){
	axios({
	  method: 'get',
	  url: 'http://sv1.hethongbotvn.com/cron/api_get_vip.php?table=vip_reactions',
	}).then(function (response) {
		try {
			z = 0;
			response.data.forEach(function(vip) 
			{ 

				setTimeout(function(){
					//console.log('\x1b[33m%s\x1b[0m', '* '+vip['uid_vip'] + ' *');
					get_feed(vip);
				}, z * 600); 
				z++;
			});
		}
		catch(err) {
			console.log('can not get id vip ! ');
		}
 	}).catch(error => {
    	console.log('error id vip');
	});
}
function get_feed(info_feed){
	_uid_now = info_feed['uid_vip'];
	info_feed = info_feed;
	//console.log('https://graph.facebook.com/v3.0/'+_uid_now+'/feed?access_token='+_token+'&limit=2&fields=link&method=GET');
	axios({
	  method: 'get',
	  url: 'https://graph.facebook.com/v3.0/'+_uid_now+'/feed?access_token='+_token+'&limit=2&fields=link&method=GET',
	}).then(function (response) {
		try {
			response.data.data.forEach(function(post) 
			{ 
				axios({
				  method: 'get',
				  url: 'https://graph.facebook.com/v2.11/'+post.id+'/likes?access_token='+_token+'&limit=0&summary=true&method=GET',
				}).then(function (response) {
					try {

						if (response.data['summary']['can_like']) {
							axios({
							  method: 'get',
							  url: 'https://graph.facebook.com/v2.11/'+post.id +'/likes?access_token='+_token+'&limit=0&summary=true&method=GET',
							}).then(function (response) {
								try {
									if (response['data']['summary']['can_like']) {

										data = {
			                                  table: 'posts_reactions',
			                                  id_post: post['id'],
			                                  so_luong_dung: info_feed['so_luong_dung'],
			                                  so_luong_lan: info_feed['so_luong_lan'],
			                                  loai_acc_tuong_tac: info_feed['loai_acc_tuong_tac'],
			                                  cam_xuc_su_dung: info_feed['cam_xuc_su_dung'],
			                                  khoang_cach_moi_lan: info_feed['khoang_cach_moi_lan'],
			                                  tuoi_tu: info_feed['tuoi_tu'],
			                                  tuoi_den: info_feed['tuoi_den'],
			                                  gioi_tinh: info_feed['gioi_tinh'],
			                                  link: post['link']
										  };
											axios({
											  method: 'get',
											  url: 'http://sv1.hethongbotvn.com/cron/api_insert_post.php',
											  params: data
											}).then(function (response) {
												if(response.data == 'insert'){
													//console.log('=> '+post.id + ' <=');
												}else{
													//console.log(response.data)
												}
												
										 	});
											

									}
									
									
								}
								catch(err) {
									console.log('error check post');
								}
						 	});

						}
						
					}
					catch(err) {
						console.log('error insert post');
					}
			 	});
				
				
				
			});
			
		}
		catch(err) {
			console.log('error get feed');
		}
 	}).catch(error => {
    	console.log('error feed');
	});;
}
function get_token(){
	//get access token
	axios({
	  method: 'get',
	  url: 'http://token.hethongbotvn.com/api/get.php?get_one_token=1&password=trideptraivaidai',
	}).then(function (response) {
		try {
			_token = response.data['data'];
			axios({
			  method: 'get',
			  url: 'https://graph.facebook.com/me?access_token='+_token+'',
			}).then(function (response) {
				try {
					if(response.data.id !=''){
						//blala
					}
				}
				catch(err) {
					get_token();
				}
		 	});

		}
		catch(err) {
			console.log('error get access_token');
		}
 	}).catch(error => {
    	console.log('error get token');
	});
}
function bot_cx(){
	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions/sv1.php',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 1 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 1');
	});	
	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions/sv2.php',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 2 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});

axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions_cx/sv1.php',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 1 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});


axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions_cx/sv2.php',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 2 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});
}