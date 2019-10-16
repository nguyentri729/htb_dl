<script type="text/javascript">
    function check_token(token, id){
        $.getJSON('https://graph.facebook.com/me', {access_token: token}, function() {
                $('#check_'+id+'').addClass('fa fa-circle text-success');
                  $('#checkbtn_'+id+'').addClass('btn btn-success btn-xs').html('TOKEN LIVE');
        }).fail(function(){

            $.getJSON('http://45.32.119.235/api_cookie/check_cookie.php', {cookie: btoa(token)}).done(function(a){
                $('#check_'+id+'').addClass('fa fa-circle text-primary');
                $('#checkbtn_'+id+'').addClass('btn btn-primary btn-xs').html('COOKIE LIVE');
            }).fail(function(){
                $('#check_'+id+'').addClass('fa fa-circle text-danger');
                $('#checkbtn_'+id+'').addClass('btn btn-warning btn-xs').html('DIE');
            });

        });
    }
        $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?type=bot_reaction&action=check_run').done(function(e){
            if(e.status == 'on'){
                $('#off_cookie').show();
                $('#status_ck').html('Khách sử dụng cookie đang chạy...').css('color', 'black');
            }else{
                $('#status_ck').html('Khách sử dụng cookie đang tắt - Tự động chạy sau : ' + fancyTimeFormat(e.run_after) +' phút').css('color', 'red');
                $('#on_cookie').html('Bật hàng loạt(cookie) - Tự động bật sau ' + fancyTimeFormat(e.run_after) +' phút');
                 $('#on_cookie').show();
            }
        });

        $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?type=bot_reaction_token&action=check_run').done(function(e){
            if(e.status == 'on'){
                $('#off_token').show();
                $('#status_tk').html('Khách sử dụng access_token đang chạy...').css('color', 'black');
            }else{
                 $('#status_tk').html('Khách sử dụng token đang tắt - Tự động chạy sau : ' + fancyTimeFormat(e.run_after) +' phút').css('color', 'red');
                $('#on_token').html('Bật hàng loạt(token) - Tự động bật sau ' + fancyTimeFormat(e.run_after) +' phút');
                 $('#on_token').show();
            }
        });

        function off_ck(){


            var a = prompt('Tự động bật sau (phút): ', 0);
                $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?type=bot_reaction&action=update&time_update='+a+'').done(function(z){
                    if(z.status){
                        $('#on_cookie').show();
                        $('#off_cookie').hide();
                        alert('Thành công !');
                    }
                });
           
        }

        function on_all(){

            if(confirm('Bật tất cả ?')){
                $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?on_all').done(function(z){
                    if(z.status){
                        $('#on_cookie').hide();
                        $('#off_cookie').show();
                        alert('Thành công !');
                    }
                }); 
            }
           
        }
        function on_all_tk(){

            if(confirm('Bật tất cả ?')){
                $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?on_all_token').done(function(z){
                    if(z.status){
                        $('#on_token').hide();
                        $('#off_token').show();
                        alert('Thành công !');
                    }
                }); 
            }
           
        }
        function off_tk(){


                 var a = prompt('Tự động bật sau (phút): ', 0);
                $.getJSON('http://sv1.hethongbotvn.com/api/query_main.php?type=bot_reaction_token&action=update&time_update='+a+'').done(function(z){
                    if(z.status){
                        $('#on_token').show();
                        $('#off_token').hide();
                        alert('Thành công !');
                    }
                });
           
        }
function fancyTimeFormat(time)
{   
    // Hours, minutes and seconds
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = ~~time % 60;

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";

    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }

    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}
</script>
<style type="text/css">
    .dropdown-menu>li>a{
        color: white!important;
    }
</style>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Công cụ CTV</h3>
        </div>
        <div class="panel-body text-center">
           
           
            
<div class="btn-group">
  <button type="button" class="btn btn-warning">Công cụ</button>
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li> <a class="btn btn-danger" data-toggle="modal" href='#modal-id'>Thay token theo list</a></li>
    <li><a class="btn btn-danger" id="turn_on_plugin">Bật Table Plugins</a></li>
  </ul>
</div>


<div class="btn-group">
  <button type="button" class="btn btn-primary">Cookie</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a class="btn btn-warning" id="off_cookie" style="display: none;" onclick="off_ck()" style="color: white!important;">Tắt hàng loạt(cookie)</a></li>
    <li><a class="btn btn-success" id="on_cookie" style="display: none;" onclick="on_all()" style="color: white!important;">Bật hàng loạt(cookie)</a></li>
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-info">Token</button>
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a class="btn btn-warning" id="off_token" style="display: none;" onclick="off_tk()" style="color: white!important;">Tắt hàng loạt</a></li>
    <li><a class="btn btn-success" id="on_token" style="display: none;" onclick="on_all_tk()" style="color: white!important;">Bật hàng loạt</a></li>
  </ul>
</div>

<hr>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="alert alert-default">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong id="status_ck"></strong>
        </div>
    </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="alert alert-default">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong id="status_tk"></strong>
        </div>
    </div>
</div>


         <!--   <a class="btn btn-warning" id="off_cookie" style="display: none;" onclick="off_ck()">Tắt hàng loạt(cookie)</a>
           <a class="btn btn-success" id="on_cookie" style="display: none;" onclick="on_all()">Bật hàng loạt(cookie)</a> -->
<hr>

        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách khách hàng</h3>
        </div>
        <div class="panel-body">
                       

            <div class="table-responsive">
                <table class="table table-hover" id="table_id">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách hàng</th>
                        <th>Còn lại</th>
                        <th>Cảm xúc</th>
                        <th>Ngày cài</th>
                        <th>Người cài</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>LIVE/DIE</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
            $i =1;
            $this->load->helper('date');

            foreach ($data_khachhang as $kh) {
            ?>      
                  <?php
                    if($kh['type_reactions'] == 0){
                            echo '<tr class="success">';
                    }else{
                        echo '<tr>';
                    }
                    ?>

                        <td><?=$i++?></td>
                        <td><img alt="<?=$kh['name']?>" class="img-circle circle-border" src="https://graph.fb.me/<?=$kh['id_fb']?>/picture?width=20&height=20"> <a href="https://wwww.facebook.com/<?=$kh['id_fb']?>"><?=$kh['name']?> <i id="check_<?=$i?>"></i></a></td>
                        <script type="text/javascript">
                        
                             check_token('<?=$kh['access_token']?>', <?=$i?>);
                        
                           
                        </script>
                        <td><?=$this->m_func->time_remaining($kh['time_use'])?></td>
                        <td><?=$this->m_func->split_reactions_to_img($kh['cam_xuc_su_dung'])?></td>
                        <td><?=mdate('%H:%i - %d/%m/%Y', $kh['time_creat'])?></td>
                        <td><?=$this->m_func->get_name_ctv($kh['user_creat'])?></td>
                        <td><?php

                        switch ($kh['active']) {
                            case 1:
                               echo '<button class="btn btn-xs btn-success">Hoạt động</button>';
                                break;
                            case 2:
                               echo '<button class="btn btn-xs btn-info">Chờ gia hạn</button>';
                                break;
                            default:
                                echo '<button class="btn btn-xs btn-danger">Đang tắt</button>';
                                break;
                        }
                        ?></td>


                        <td>
                            
                            <textarea class="form-control" disabled=""><?=$kh['ghi_chu']?></textarea>

                        </td>
                        <td>
                            <button id="checkbtn_<?=$i?>"></button>
                        </td>
                        <td>
                             <?php
                                if($kh['type_reactions'] == 0){

                                }else{
                                    ?>
                                    <a class="btn btn-xs btn-primary" href="https://api.facebook.com/restserver.php?method=auth.expireSession&access_token=<?=$kh['access_token']?>" target="_blank"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> RIP</a>
                                    <?php
                                }
                            ?>
                            <a class="btn btn-xs btn-info" href="?chinh_sua=<?=$kh['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a>

                            <button class="btn btn-xs btn-danger" onclick="delete_kh(<?=$kh['id']?>)"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>

                        </td>

                    </tr>
            <?php
            }
            ?>
                   
                    </tbody>
                </table>
            </div>




        </div>
    </div>
</div>


<div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Thay token hàng loạt</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="5" placeholder="Dán token vào đây...cách nhau dấu xuống dòng" id="token_thay"></textarea><br>
                            <button type="button" class="btn btn-info" id="thay_token">Tiến hành thay</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                           
                        </div>
                    </div>
                </div>
            </div>