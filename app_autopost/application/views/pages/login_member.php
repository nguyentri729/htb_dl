<!doctype html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/turbo/pages/sample-pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Sep 2018 10:27:07 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login Member</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?=base_url()?>assets/css/turbo.css" rel="stylesheet" />
    
    <!--     Fonts and icons     -->
    <link href="<?=base_url()?><?=base_url()?>maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>
<style type="text/css">
/* fix padding */
.login-page > .content, .lock-page > .content {
    padding-top: 15% !important;
}
.lds-facebook {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-facebook div {
  display: inline-block;
  position: absolute;
  left: 6px;
  width: 13px;
  background: #2196F3;
  animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
  left: 6px;
  animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
  left: 26px;
  animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
  left: 45px;
  animation-delay: 0;
}
@keyframes lds-facebook {
  0% {
    top: 6px;
    height: 51px;
  }
  50%, 100% {
    top: 19px;
    height: 26px;
  }
}

</style>
<body>
   
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page"  data-color="blue">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="#" action="#">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center">
                                        <h4 class="card-title">Đăng nhập hệ thống</h4>
                                    </div>
                                    <div class="card-content">
                  <div id="paste_token">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">account_box</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tài khoản</label>
                                                <input type="text" class="form-control" id="user">
                                            </div>
                                           
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Mật khẩu</label>
                                                <input type="text" class="form-control" id="pwd">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-block" id="login_fb">Đăng nhập bằng Facebook</button>
                                               
                                               <center><small class="text-muted">hoặc</small></center>
                                               
 <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">code</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Access Token</label>
                                                <input type="text" class="form-control" id="access_token">
                                            </div>
                                        </div>

                                                 <div class="text-center">
                                                     <a data-toggle="modal" href='#modal-id'>Hướng dẫn đăng nhập hệ thống?</a>
                                                 </div>
                      </div>
                                        <div id="preview_login" class="text-center" style="display: none;">
                                            
                                                <img alt="image" class="img-circle circle-border" src="" id="image_preview">
                                               
                                                <h3 class="text-primary"><b id="name_preview">Name</b></h3>
                                                <div id="list_button">
                                                    <button class="btn btn btn-primary" onclick="login();">Vâng ! Đây là tôi !</button>
                                                    <a href="" class="btn btn btn-danger">Không phải </a>
                                                </div>
                                               
                                        </div>
                                         <div id="loading" style="display: none;" class="text-center">
                                             <center>
                                                    <div class="lds-facebook"><div></div><div></div><div></div></div>
                                                   
                                                    <p class="text-primary">Xác minh đăng nhập...</p>
                                                    <hr>
                                                    <small class="text-muted">Quá trình xác minh có thể mất đến vài phút.</small>
                                                    </center>
                                                </div>
                                    </div>
                                  
                                     
                                     
                                      
                                       <div class="modal fade" id="modal-id">
                                           <div class="modal-dialog">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                       <h4 class="modal-title">Video hướng dẫn đăng nhập</h4>
                                                   </div>
                                                   <div class="modal-body">
                                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/cUmpJ2zwfVU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                       
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="<?=base_url()?>assets/vendors/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/vendors/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/vendors/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/vendors/material.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/vendors/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="<?=base_url()?>assets/vendors/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?=base_url()?>assets/vendors/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="<?=base_url()?>assets/vendors/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="<?=base_url()?>assets/vendors/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="<?=base_url()?>assets/vendors/bootstrap-notify.js"></script>
<!-- DateTimePicker Plugin -->
<script src="<?=base_url()?>assets/vendors/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="<?=base_url()?>assets/vendors/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="<?=base_url()?>assets/vendors/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Select Plugin -->
<script src="<?=base_url()?>assets/vendors/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="<?=base_url()?>assets/vendors/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?=base_url()?>assets/vendors/sweetalert2.js"></script>
<!--  Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?=base_url()?>assets/vendors/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="<?=base_url()?>assets/vendors/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="<?=base_url()?>assets/vendors/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?=base_url()?>assets/js/turbo.js"></script>

<script type="text/javascript">
   setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
    }, 200);
   $('#access_token').change(function(event) {
   	 check_login();
   });
   function check_login(){
        var token = $('#access_token').val();
        if(token == ''){
             swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Không thể đăng nhập'
                 
                });
            return false;
        }
        $.getJSON('https://graph.facebook.com/me', {access_token: token}, function(a) {
              $('#preview_login').show();$('#paste_token').hide();
              $('#image_preview').attr({
                  src: 'https://graph.fb.me/'+a.id+'/picture?width=300',
              });
              $('#name_preview').html(a.name);
              $('.card-title').html('Đây có phải bạn ?');

        }).fail(function(){
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Access token của bạn không chính xác !'
                 
                });
        });

   }
   $('#login_fb').click(function(){
    var u = $('#user').val(); var p = $('#pwd').val();
    if(u == '' || p ==''){
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Điền đầy đủ tên tài khoản và mật khẩu'
                });
                return false;
    }
    $(this).attr({
      disabled: true
    }).html('Đang kết nối tới Facebook...');

      $.get('/Login/get_token', {u: u, p: p}).done(function(a){
        if(a.access_token){
          var token = a.access_token;
          $('#access_token').val(token);
          check_login();
        }else{
            try {
               var err = $.parseJSON(a.error_data);
                swal({
                  type: 'error',
                  title: err.error_title,
                  text: err.error_message,
                });
            }
            catch(err) {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Lỗi không xác định !'
                });
            }
            reset_btn();

        }

      });
   });
   function reset_btn(){
      $('#login_fb').attr({
        disabled: false
      }).html('Đăng nhập bằng Facebook');
   }
   function login(){
    var _token = $('#access_token').val().trim();
     $('.card-title').hide();
    $('#preview_login').hide();
    $('#loading').show();
       $.getJSON('/Login/ajax', {access_token: _token}, function(a) {
                if(a['status']){
                    swal("Thành công !", a.msg, "success").then(() => {
                         location.reload();
                    });

                }else{
                    swal("Có lỗi !", a.msg, "warning").then(() => {
                         location.reload();
                    });

                }
        }).fail(function(){

        });
   }
</script>


<!-- Mirrored from www.urbanui.com/turbo/pages/sample-pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Sep 2018 10:27:07 GMT -->
</html>