<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>Muzhiwan.com</title>

    <!--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">-->
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

<style>
    .top-nav{display: none;}
    @media screen and (max-width: 320px) {
        .top-nav{display:block;}
    }
    .sidebar-menu{width:240px;}
</style>
</head>
<body class="page-body">



<nav class="navbar horizontal-menu navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

<div class="navbar-inner">

<!-- Navbar Brand -->
<div class="navbar-brand">
    <a href="/" class="logo">
       用户后台
    </a>

</div>

<!-- Mobile Toggles Links -->
<div class="nav navbar-mobile">

    <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
    <div class="mobile-menu-toggle">
        <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->

        <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
        <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
        <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
        <a href="#" data-toggle="mobile-menu-horizontal">
            <i class="fa-bars"></i>
        </a>
    </div>

</div>

<div class="navbar-mobile-clear"></div>



<!-- main menu -->

<ul class="navbar-nav top-nav">
   <?php $menu = $_SESSION['menu']; ?>
    <?php if(is_array($menu)&&!empty($menu)): ?>
    <?php foreach($menu as $k => $v): ?>
    <li>
        <a href="javascript:void(0);">
            <i class=""></i>
            <span class="title"><?php echo $menu[$k]['name']; ?></span>
        </a>
        <ul>
            <?php foreach($v['nodes'] as $m => $row): ?>
            <?php if($row['ismenu']): ?>
            <li>
                <a href="/<?php echo $k.'/'.$m; ?>">
                    <span class="title"><?php echo $row['method_name']; ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </li>
    <?php endforeach; ?>
    <?php endif; ?>

</ul>


<!-- notifications and other links -->
<ul class="nav nav-userinfo navbar-right">




<li class="dropdown user-profile">
    <a href="#" data-toggle="dropdown">
        <img src="/assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
						<span>
							<?php echo $_SESSION['username']; ?>
							<i class="fa-angle-down"></i>
						</span>
    </a>

    <ul class="dropdown-menu user-profile-menu list-unstyled">

        <li>
            <a href="/User/edit_mypassword_form">
                <i class="fa-wrench"></i>
                Change Password
            </a>
        </li>


        <li class="last">
            <a href="/Login/logout">
                <i class="fa-lock"></i>
                Logout
            </a>
        </li>
    </ul>
</li>



</ul>

</div>

</nav>


<div class="page-container">
<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
<div class="sidebar-menu toggle-others fixed">

<div class="sidebar-menu-inner">



<ul id="main-menu" class="main-menu">
    <li>
        <a href="#" data-toggle="sidebar">
            <i class="linecons-eye"></i>
            <span class="title">收起侧边栏</span>
        </a>
    </li>
<!-- add class "multiple-expanded" to allow multiple submenus to open -->
<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
<?php if(is_array($menu)&&!empty($menu)): $mArr = array(); ?>
    <?php foreach($menu as $k => $v):$count=0; ?>
    <li id="<?php echo ($k); ?>" <?php echo strtolower(CONTROLLER_NAME) == strtolower($k) ? 'class="active expanded opened"':''; ?>>
    <a href="javascript:void(0);">
        <?php $icons = C('icon'); ?>

        <i class="<?php echo $icons[strtolower($k)]; ?>"></i>
        <span class="title" ><?php echo $menu[$k]['name']; ?></span>
    </a>
    <ul>
        <?php foreach($v['nodes'] as $m => $row): ?>
                <?php if($row['ismenu'] && $m):$count++; ?>
                <li >
                    <a href="/<?php echo $k.($m=='index'?'':'/'.$m); ?>" <?php echo strtolower(CONTROLLER_NAME) == strtolower($k) && strtolower(ACTION_NAME) == strtolower($m) ? 'class="chooseChild"':''; ?>>
                        <span class="title"><?php echo $row['method_name']; ?></span>
                    </a>
                </li>
                <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    </li>
    <?php if($count == 0) $mArr[] = $k; ?>
    <?php endforeach; ?>
    <?php $str = implode(',',$mArr); echo "<script>var str ='$str';</script>"; ?>
    <script>
        var arr = str.split(',');
        for(var i=0;i<arr.length;i++)
            document.getElementById(arr[i]).style.display = 'none';
    </script>


<?php endif; ?>
</ul>

</div>

</div>
<div class="main-content">


<div class="page-title">

    <div class="title-env">
        <h1 class="title">用户管理</h1>
        <p class="description">编辑用户</p>
    </div>

</div>

<div class="panel panel-default">



    <div class="panel-body">

        <form role="form" id="form1" method="post" class="validate" action="/User/edit" autocomplete="off" onsubmit="return checkData(this);">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
            <div class="form-group">
                <label class="control-label"><strong>所属管理组</strong></label>
                <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        $("#sboxit-1").selectBoxIt().on('open', function()
                        {
                            // Adding Custom Scrollbar
                            $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
                        });
                    });
                </script>

                <select class="form-control" id="sboxit-1" name="groups">
                    <?php if(is_array($groups)): foreach($groups as $key=>$row): ?><option value="<?php echo ($row["id"]); ?>"  <?php if($data['group_id'] == $row['id'] ): ?>selected="selected"<?php endif; ?>><?php echo ($row["name"]); ?> (<?php echo ($row["desc"]); ?>)</option><?php endforeach; endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label"><strong>输入密码</strong>(不修改密码不用填写)</label>
                <input type="password" class="form-control" name="password" id="password" value="" />
            </div>
            <div class="form-group">
                <label class="control-label"><strong>重复输入密码</strong></label>
                <input type="password" class="form-control" name="password1" id="password1" value="" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">提交</button>
            </div>

        </form>

    </div>

</div>
<script>

   function checkData(obj){
       var p = obj.password.value;
       var p1 = obj.password1.value;

       var modes = 0;

       //正则表达式验证符合要求的
       if (p.length > 0 ){
           if(p.length < 8) {
           MSGBOX.show('密码最小长度为8位，且包含数字、大写字母、小写字母、特殊字符中任意两种','',MSGBOX.MSGTYPE_ALERT);
           return false;
           }

           if (/\d/.test(p)) modes++; //数字
           if (/[a-z]/.test(p)) modes++; //小写
           if (/[A-Z]/.test(p)) modes++; //大写
           if (/\W/.test(p)) modes++; //特殊字符

           if(modes < 2){
               MSGBOX.show('密码长度必须超过8位，且包含数字、大写字母、小写字母、特殊字符中任意两种','',MSGBOX.MSGTYPE_ALERT);
               return false;
           }

           if(p!=p1){
               MSGBOX.show('两次输入密码不一致，请重新输入','',MSGBOX.MSGTYPE_ALERT);
               return false;
           }
       }
       return true;
   }
</script>


<link rel="stylesheet" href="/assets/js/select2/select2.css">
<link rel="stylesheet" href="/assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="/assets/js/multiselect/css/multi-select.css">


<script src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>



</div><!--main-content"-->

</div><!--page-container-->

<!-- Bottom Scripts -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/TweenMax.min.js"></script>
<script src="/assets/js/resizeable.js"></script>
<script src="/assets/js/joinable.js"></script>
<script src="/assets/js/xenon-api.js"></script>
<script src="/assets/js/xenon-toggles.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="/assets/js/xenon-custom.js"></script>
<!--<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>-->

<?php if($_SESSION['notice']): ?>
    <script>
        $(document).ready(function(){
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
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

            toastr.<?php echo $_SESSION['notice']['code'] ?>("<?php echo $_SESSION['notice']['text'] ?>",'提示', opts);
        } )

    </script>
    <script src="/assets/js/toastr/toastr.min.js"></script>
    <?php unset($_SESSION['notice']);endif; ?>


<!-- Modal 1 (Basic)-->
<div class="modal fade" id="modal-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Message</h4>
            </div>

            <div class="modal-body">
                Hello I am a Modal!
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-cancle" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-info btn-submit" id="btn-callback">确定</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/custom.js"></script>
<script src="/js/global.js"></script>
</body>
</html>