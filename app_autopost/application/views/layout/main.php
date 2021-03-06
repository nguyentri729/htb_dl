<!doctype html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/turbo/pages/sample-pages/template.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Sep 2018 10:27:07 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php
 if(isset($title)){
                            echo $title;
                        }else{
                            echo 'Tổng quan';
                        }
                        

    ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?=base_url()?>assets/css/turbo.css" rel="stylesheet" />



        <link href="<?=base_url()?>assets/vendors/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">   

      

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
    <div class="loading" style="display: none;">Loading&#8230;</div>
    <div class="wrapper">

        <div class="sidebar">
            <div class="logo">
                <a href="#" class="simple-text">
                    AutoFB <span>beta</span>
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#" class="simple-text">
                    T
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="/Dashboard">
                            <i class="material-icons">dashboard</i>
                            <p>Tổng quan</p>
                        </a>
                    </li>

                    <li>
                        <a href="/Dashboards/Pages/Info">
                            <i class="material-icons">info</i>
                            <p>Giới thiệu</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-absolute" data-topbar-color="blue">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular f-26">keyboard_arrow_left</i>
                            <i class="material-icons visible-on-sidebar-mini f-26">keyboard_arrow_right</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#" onclick="quay_lai();"> <?php

                        if(isset($title)){
                            if($title !='Tổng quan'){
                                echo '<i class="fa fa-chevron-left" aria-hidden="true"></i> ';
                            }
                            echo $title;
                        }else{
                            echo 'Tổng quan';
                        }
                        ?> </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">1</span>
                                    <p class="hidden-lg hidden-md">
                                        Thông báo
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Đang trong thời gian thử nhiệm vì<br> vậy tất cả các dịch vụ đều miễn phí.</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="/Dashboards/Apps/ViewApps">
                                    <i class="material-icons">apps</i>
                                    <p class="hidden-lg hidden-md">Chức năng</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('Dashboards/Pages/Profile')?>">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Cá nhân</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('Dashboards/Pages/Setting')?>">
                                    <i class="material-icons">settings</i>
                                    <p class="hidden-lg hidden-md">Cài đặt</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <?php
                        if(isset($view)){
                            if(!isset($view['data'])){
                                $view['data'] = [];
                            }
                            $this->load->view('pages/'.$view['view'].'', $view['data'], FALSE);
                        }
                    ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <!-- <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav> -->
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">AutoFB</a> beta
                    </p>
                </div>
            </footer>
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
<script src="<?=base_url()?>assets/vendors/timepicker/bootstrap-timepicker.min.js"></script>

<!-- DateTimePicker Plugin -->
<script src="<?=base_url()?>assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

 <script src="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

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
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?=base_url()?>assets/vendors/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="<?=base_url()?>assets/vendors/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="<?=base_url()?>assets/vendors/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?=base_url()?>assets/js/turbo.js"></script>

<script type="text/javascript">
    function quay_lai(){
        $('.loading').show();
        window.history.go(-1);
    }
    <?php

        if(isset($script)){
             if(!isset($script['data'])){
                                $script['data'] = [];
                            }
            $this->load->view('script/'.$script['view'].'', $script['data'], FALSE);
        }
    ?>
</script>
<!-- Mirrored from www.urbanui.com/turbo/pages/sample-pages/template.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Sep 2018 10:27:07 GMT -->
</html>
