<?php include "include/header.php";include "include/functions.php";?>

<?php 
    if(isset($_POST['login'])){
        if(AdminStatusCheck($_POST['email'],$conn) == true){
            if(ValidateLogin($_POST['email'],$_POST['password'],$conn) >= 1){
                $_SESSION['admin'] = $_POST['email'];
                header("location:?a=home");
            }
            else{
                $_SESSION['loginerr'] = "Please Check Your Email/Password";
            }
        }else{
            $_SESSION['loginerr'] = "Account is Blocked";
        }
    }
?>

<body class="hold-transition login-page" style="background-color:#ececec;">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><img src='https://newglobalswift.us/public/images/logos/1614196665_logo.png'
                    class="img-responsive" width="282" height="63" style="width:75%; margin:auto;"></a>
        </div><!-- /.login-logo -->
        <div class="login-box-body" style="padding:40px 20px; box-shadow:0 0 5px #121212;">
        <?php if(isset($_SESSION['loginerr'])){?>
            <div class="alert alert-danger text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><?php echo $_SESSION['loginerr'];?></strong>
            </div>
            <?php UnsetSession('loginerr');}?>
            <form action="#" method="POST" id="admin_login_form">
                <input type="hidden" name="_token" value="MaT8QdnQJTVERe6HoLySGP5bi7RHEmWaQUSkAXEW">

                <div class="form-group has-feedback ">
                    <label class="control-label sr-only" for="inputSuccess2">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback ">
                    <label class="control-label sr-only" for="inputSuccess2">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" name="login" class="btn btn-theme btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- iCheck -->
    <script src="https://freedompayuniverse.com/public/backend/iCheck/icheck.min.js" type="text/javascript"></script>
    <?php include "include/script.php";?>