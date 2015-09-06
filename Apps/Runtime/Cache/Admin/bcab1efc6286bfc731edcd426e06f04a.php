<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>Login</title>

    <link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="/assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="/assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/xenon-core.css">
    <link rel="stylesheet" href="/assets/css/xenon-forms.css">
    <link rel="stylesheet" href="/assets/css/xenon-components.css">
    <link rel="stylesheet" href="/assets/css/xenon-skins.css">
    <link rel="stylesheet" href="/assets/css/custom.css">

    <script src="/assets/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-body login-page">


<div class="login-container">

    <div class="row">

        <div class="col-sm-6">

            <script type="text/javascript">
                jQuery(document).ready(function($)
                {
                    // Reveal Login form
                    setTimeout(function(){
                        $(".fade-in-effect").addClass('in');
                    }, 1);


                    // Validation and Ajax action
                    $("form#login").validate({
                        rules: {
                            username: {
                                required: true
                            },

                            passwd: {
                                required: true
                            },

                            verifycode: {
                                required: true
                            }
                        },

                        messages: {
                            username: {
                                required: 'Please enter your username.'
                            },

                            passwd: {
                                required: 'Please enter your password.'
                            },

                            verifycode: {
                                required: 'Please enter VerifyCode.'
                            }
                        },

                        // Form Processing via AJAX
                        submitHandler: function(form)
                        {
                            show_loading_bar(70); // Fill progress bar to 70% (just a given value)

                            var opts = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-full-width",
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };

                            $.ajax({
                                url: "<?php echo ($loginURL); ?>",
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    do_login: true,
                                    username: $(form).find('#username').val(),
                                    password: $(form).find('#passwd').val(),
                                    verifycode:$(form).find('#verifycode').val()
                                },
                                success: function(resp)
                                {
                                    show_loading_bar({
                                        delay: .5,
                                        pct: 100,
                                        finish: function(){

                                            // Redirect after successful login page (when progress bar reaches 100%)
                                            if(resp.accessGranted == 'success')
                                            {

                                                window.location.href = '/';

                                            }
                                            else if(resp.accessGranted == -1)
                                            {
                                                toastr.error("You have entered wrong VerifyCode, please try again.", "Invalid Login!", opts);
                                                $('#verifycode').select();
                                                flushVerifyCode();
                                            }else{
                                                toastr.error("You have entered wrong password, please try again.", "Invalid Login!", opts);
                                                $passwd.select();
                                            }
                                        }
                                    });

                                }
                            });

                        }
                    });

                    // Set Form focus
                    $("form#login .form-group:has(.form-control):first .form-control").focus();
                });
            </script>

            <!-- Errors container -->
            <div class="errors-container">


            </div>

            <!-- Add class "fade-in-effect" for login form effect -->
            <form method="post" role="form" id="login" class="login-form fade-in-effect">

                <div class="login-header">
                    <a href="/" class="logo">
                        <h1 style="color:white">Ooop...</h1>

                    </a>

                </div>


                <div class="form-group">
                    <label class="control-label" for="username">Username</label>
                    <input type="text" class="form-control input-dark" name="username" id="username" autocomplete="off" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="passwd">Password</label>
                    <input type="password" class="form-control input-dark" name="passwd" id="passwd" autocomplete="off" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="verifycode">验证码</label>
                    <input type="text" class="form-control input-dark" name="verifycode" id="verifycode" autocomplete="off" />
                </div>

                <div class="form-group">
                    <img src='http://admin.pay.muzhiwan.com/login/verify?_t=<?php echo time(); ?>' onclick="flushVerifyCode(this);" style="cursor: pointer" id="verifyImg" />
                </div>




                <div class="form-group">
                    <button type="submit" class="btn btn-blue  btn-block text-left">
                        <i class="fa-lock"></i>
                        Log In
                    </button>
                </div>
            </form>


        </div>

    </div>

</div>


<script>
    function flushVerifyCode(){
        var obj = document.getElementById('verifyImg');
        obj.src = 'http://admin.pay.muzhiwan.com/login/verify?_t='+Math.random();
    }
</script>
<!-- Bottom Scripts -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/TweenMax.min.js"></script>
<script src="/assets/js/resizeable.js"></script>
<script src="/assets/js/joinable.js"></script>
<script src="/assets/js/xenon-api.js"></script>
<script src="/assets/js/xenon-toggles.js"></script>
<script src="/assets/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/assets/js/toastr/toastr.min.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="/assets/js/xenon-custom.js"></script>
</body>
</html>