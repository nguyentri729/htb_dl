const axios = require('axios');

setInterval(function(){

	get_post();

}, 1000);

function get_post(){
	var limit = 0;
	var id_post = '';
	var a = [];
	var z = 0;
	var data = [];
	var s = 0;
	var tong = 0;
	axios({
	  method: 'get',
	  url: 'http://sv1.hethongbotvn.com/cron/get_id.php?test=ok',
	}).then(function (response) {
		 	a = response.data;
            limit = a['so_luong_lan'];
            id_post = a['id_post'];
            data = {
	                get_many_token: 1,
	                gender: a['gioi_tinh'],
	                loai_acc: 1,
	                limit: limit,
	                where_run: 'reactions'
				};
				
			axios({
				method: 'get',
				url: 'http://token.hethongbotvn.com/api/get.php',
				params: data
			}).then(function (response) {
				tong = response.data.length;
				response.data.forEach(function(token){ 
					z++;
					setTimeout(function(){
						tong--;
						var data_get = {
	                        access_token: token['access_token'],
	                        limit: 0,
	                        summary: true
						};

						axios({
						  method: 'get',
						  url: 'https://graph.facebook.com/v2.11/'+id_post+'/likes',
						  params: data_get
						}).then(function (z) {
							
							try {
								 if (z['data']['summary']['has_liked'] == false) {
									axios({
									  method: 'post',
									  url: 'https://graph.facebook.com/'+id_post+'/likes',
									  params: {
									  	access_token: token['access_token']
									  }
									}).then(function (response) {
										
										console.log(response.data);
										s++;
										if(tong <= 0){
											var inf = {
						                      id_post: id_post,
						                      thanh_cong: s
											};
											console.log(inf);
											axios({
											  method: 'get',
											  url: 'http://sv1.hethongbotvn.com/api/set_id.php',
											  params: inf
											});

										}
								 	}).catch(function (error) {
								 		if (error.response) {
								 			console.log('error');
								 		}
	  								});

								 }
							}catch(err){
								console.log('error get');
							}
									
									
					 	});

					}, z*1000);
					
					
					

				});	

								
			});

 	});
}
