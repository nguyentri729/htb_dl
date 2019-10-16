<?php
/*require_once 'system/FBCookie.php';
$fb = new FBCookie('c_user=100029921771249;xs=30:OKvdrrYeiUeyNA:2:1541366960:-1:-1', 'EAAAAUaZA8jlABAG0rWkLRAb53uSZBzpErGfTaonz9pBQSUtUio9Bcaq9WcxTIzuZCOlsaB6HH5iOHMZBvZBBTjZAMCJJDzIXZAenxgi1k2JT2vKuBry9JeLXv3XuZArgcRG6QtoAycJo2Cub9p5XjGF5uqIrvnAtFzCJy2QFRHAQMOc96ubZAUjk0FMCaQRdR4PEZD');

$fb->copy_wall('100006996220889');*/
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nuôi clone FB</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<div class="container-fluid">
			<div style="padding-top: 5%;"></div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Danh sách account</h3>
						</div>
						<div class="panel-body">
							<div class="btn-group">

								<div class="modal fade" id="modal-add_account">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Thêm Account</h4>
											</div>
											<div class="modal-body">
													<textarea id="list_account" class="form-control" rows="3" required="required" placeholder="user|maill|pass|cookie|token|gender"></textarea>
													<hr>

													<!-- <div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
													  aria-valuemin="0" aria-valuemax="100" style="width:70%">
													    <span class="sr-only">70% Complete</span>
													  </div>
													</div> -->

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
												<button type="button" class="btn btn-primary" onclick="add_account()">Thêm Account</button>
											</div>
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-success" data-toggle="modal" href='#modal-add_account'>Thêm account</button>
								<button type="button" class="btn btn-info">Cập nhật info</button>
								<button type="button" class="btn btn-warning">Tương tác</button>
							</div>

							<hr>

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>UID</th>
											<th>USER</th>
											<th>PWD</th>
											<th>Name</th>
											<th>Avatar</th>
											<th>Gender</th>
											<th>FR</th>
											<th>GR</th>
											<th>COOKIE</th>
											<th>TOKEN</th>
											<th>CopyID</th>

										</tr>
									</thead>
									<tbody id="view_acc">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript">
			var i = 0; 
			var count_list = 0;
			var luu = [];
			function add_account(){
				var list_account = $('#list_account').val().split('\n');
				count_list = list_account.length;
				$.each(list_account, function(index, val) {
					setTimeout(function(){

						 var info = val.split('|');
						 var acc = [];
						 acc['uid']= info[0];
						 acc['mail'] = info[1];
						 acc['pass']= info[2];
						 acc['cookie'] = info[3];
						 acc['token'] = info[4];
						 acc['gender'] = info[5];
						//check avatar
						$.getJSON('https://graph.facebook.com/'+acc['uid']+'/picture', {redirect: 'false'}, function(json, textStatus) {
								acc['avatar'] = !json['data']['is_silhouette'];
						}).fail(function(){
							return false;
						});
						$.getJSON('https://graph.facebook.com/v3.1/me', {access_token: acc['token']}, function(json, textStatus) {
							acc['name'] = json.name;
						});

						$.getJSON('https://graph.facebook.com/v3.1/me/friends', {access_token: acc['token'], 'summary': true, 'limit': 0}, function(json, textStatus) {
							 acc['fr'] = !json['summary']['total_count'];	
						});
						acc['gr']  = 0;
						count_list--;
						luu[count_list] = acc;
						console.log(count_list);
						/*$.post('api/add_account.php', {data: JSON.stringify(luu[count_list])}).done(function(a){
								console.log(a);
						}).fail(function(){
								console.log('errro');
						});
*/
						if(count_list<= 0){
							//console.log(luu);
							$.each(luu, function(index, val) {
								$('#view_acc').append('<tr>\
											<td>'+index+'</td>\
											<td>'+val['uid']+'</td>\
											<td>'+val['mail']+'</td>\
											<td>'+val['pass']+'</td>\
											<td>'+val['name']+'</td>\
											<td>'+val['avatar']+'</td>\
											<td>'+val['gender']+'</td>\
											<td>'+val['fr']+'</td>\
											<td>'+val['gr']+'</td>\
											<td><input class="form-control" value="'+val['cookie']+'"></td>\
											<td><input class="form-control" value="'+val['token']+'"></td>\
											</tr>');
							});
						}
					}, i*1000);
					i++;

				});

				
			}

		</script>
 		
	</body>
</html>