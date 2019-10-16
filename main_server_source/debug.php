
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="60">
    <title>Debug Code </title>
</head>

<body>
    
     <b>* Debug: </b>
    <input type="number" id="idfb" placeholder="IDFB">
     <b>-  limit post: </b>

    <input type="number" id="limit_post" placeholder="limit post" value="4">
    <button id="debug_strart">Debug</button>
    <hr>
     <b>* Get info: </b>
    <input type="number" id="view_inf" placeholder="IDFB">
    <button id="view_start">View Info</button>
    <hr>
    <div id="result"></div>

    <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script>
        $('#view_start').click(function(){

          $.getJSON('http://sv1.hethongbotvn.com/cron/api_get_vip.php', {table: 'vip_reactions', info: $('#view_inf').val()}, function(a) {
            if(a.length < 0){
              $('#result').html('Không tồn tại trên server !');
              return true;
            }
            $.each(a[0], function(index, val) {
              $('#result').append('<span>'+index+':</span style="color: blue;"> <span style="color: blue;">'+val+'</span><br>');
            });
          }).fail(function(){
             $('#result').html('server die !');
          });

        });
        $('#debug_strart').click(function(){
        var token_fb = '';
        $.getJSON('http://sv1.hethongbotvn.com/cron/api_get_vip.php', {table: 'vip_reactions', idfb: $('#idfb').val()}, function(a) {
            if(a.length <= 0){
              $('#result').html('- Không tồn tại trên hệ thống hoặc do hết giới hạn post 1 ngày ! <br> Link reset post: <a href="http://sv1.hethongbotvn.com/cron/set_post.php?reset_post='+$('#idfb').val()+'" target="-_blank">http://sv1.hethongbotvn.com/cron/set_post.php?reset_post='+$('#idfb').val()+'</a>');
            }
            $.getJSON('http://token.hethongbotvn.com/api/get.php', {
                    get_one_token: 1
            }, function(token) {
                $.getJSON('https://graph.facebook.com/me', {access_token: token.data}).done(function(){
                      
                        token_fb = token.data;
                        $.each(a, function(key, val) {

                            setTimeout(function(){
                                $.getJSON('https://graph.facebook.com/v3.0/'+val['uid_vip']+'/feed', {access_token: token_fb, limit: $('#limit_post').val()}).done(function(post){

                                      $.each(post.data, function(d, post_data) {

                                        $.getJSON('https://graph.facebook.com/v2.11/' + post_data['id'] + '/likes', {
                                            access_token: token_fb,
                                            limit: 0,
                                            summary: true
                                        }, function(z) {

                                            if (z['summary']['can_like']) {
                                              
                                               $.get('http://sv1.hethongbotvn.com/cron/api_insert_post.php', {
                                                  table: 'posts_reactions',
                                                  id_post: post_data['id'],
                                                  so_luong_dung: val['so_luong_dung'],
                                                  so_luong_lan: val['so_luong_lan'],
                                                  loai_acc_tuong_tac: val['loai_acc_tuong_tac'],
                                                  cam_xuc_su_dung: val['cam_xuc_su_dung'],
                                                  khoang_cach_moi_lan: val['khoang_cach_moi_lan'],
                                                  tuoi_tu: val['tuoi_tu'],
                                                  tuoi_den: val['tuoi_den'],
                                                  gioi_tinh: val['gioi_tinh']
                                              }).done(function(z){
                                                 if(z =='insert'){
                                                  console.log('Insert: ' +post_data['id']+'');
                                                   $('#result').append('<i style="color: green;">+ Insert: '+post_data['id']+'</i><br>');
                                                 }else{
                                                  console.log('Update: ' +post_data['id']+'');
                                                   $('#result').append('<i style="color: black;">+ Ko Insert: '+post_data['id']+'</i><br>');
                                                 }
                                              }).fail(function(){
                                                  console.log('Ko kết nối server!');
                                              });

                                            }
                                        });





                                      });

                                }).fail(function(){

                                });
                            }, key * 2000);
                        }); 
                }).fail(function(){
                  alert('click Ok roi thu lai ! server loi !');
                   location.reload();
                    
                });
            });
        }).fail(function(){
          alert('click Ok roi thu lai ! server loi !');
           location.reload();
           
        });
        });
 

       
       
    </script>
</body>

</html>