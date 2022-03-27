<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:login.php");
}
if(CheckGet('id') == false){
    header("location:404.php");
}
?>
<?php 
    if(isset($_POST['update'])){
        if(UpdateUser($_GET['id'],$_POST['username'],$_POST['phone'],$_POST['email'],$_POST['email_verify'],$_POST['password'],$_POST['status'],$conn)){
            $_SESSION['success'] = "User Updated Successfully";
            header("location:user.php");
        }
        else{
            $_SESSION['error'] = "Unable to Update User";
        }
    }

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;display:none;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"></p>
            </div>

            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;display:none;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"></p>
            </div>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>


        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="panel-body ml-20">
                        <ul class="nav nav-tabs cus" role="tablist">
                            <li class="active">
                                <a href='edituser.php?id=<?php echo $_GET['id'];?>'>Profile</a>
                            </li>
                            <li>
                                <a href="usertransaction.php?id=<?php echo $_GET['id'];?>">Transactions</a>
                            </li>
                            <li>
                                <a href="userwallet.php?id=<?php echo $_GET['id'];?>">Wallets</a>
                            </li>
                            <li>
                                <a href="userticket.php?id=<?php echo $_GET['id'];?>">Tickets</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php $row = GetUserWithId($_GET['id'],$conn);?>
                <div class="row">
                    <div class="col-md-4">
                        <h3><?php echo $row['username'];?>&nbsp;
                            <?php if($row['block_status'] == '0'){?>
                            <span class="label label-success">Active</span>
                            <?php }else{?>
                            <span class="label label-danger">Inactive</span>
                            <?php }?>
                        </h3>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-5">
                        <div class="pull-right">
                            <a style="margin-top: 15px;"
                                href="funduser.php?id=<?php echo $_GET['id'];?>"
                                class="btn btn-theme">Deposit</a>
                            &nbsp;&nbsp;&nbsp;
                            <a style="margin-top: 15px;"
                                href="#"
                                class="btn btn-theme">Payout</a>
                            &nbsp;&nbsp;&nbsp;

                            <!-- Check whether user has any crypto wallet address -->

                        </div>
                    </div>
                </div>


                <div class="box mt-20">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- form start -->
                                <form action="#" class="form-horizontal" id="user_form" method="POST">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label" for="inputEmail3">
                                                            Username
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" placeholder="Update First Name"
                                                                name="username" type="text" id="first_name"
                                                                value="<?php echo $row['username'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label" for="inputEmail3">
                                                            Phone
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="tel" class="form-control" id="phone"
                                                                name="phone" value="<?php echo $row['phone'];?>">
                                                            <span id="phone-error"></span>
                                                            <span id="tel-error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label require" for="inputEmail3">
                                                            Email
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" placeholder="Update Email"
                                                                name="email" type="email" id="email"
                                                                value="<?php echo $row['email'];?>">
                                                            <span id="emailError"></span>
                                                            <span id="email-ok" class="text-success"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label" for="inputEmail3">
                                                            Password
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control"
                                                                placeholder="Update Password (min 6 characters)"
                                                                name="password"
                                                                value="<?php echo $row['password'];?>" type="password"
                                                                id="password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label" for="inputEmail3">
                                                            Confirm Password
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control"
                                                                placeholder="Confirm password (min 6 characters)"
                                                                value="<?php echo $row['password'];?>"
                                                                name="password_confirmation" type="password"
                                                                id="password_confirmation">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label required"
                                                            for="status">Email Verification</label>
                                                        <div class="col-sm-8">
                                                            <select class="select2" name="email_verify" id="status">
                                                                <option value='1'
                                                                    <?php if($row['email_verification'] == 1){echo 'selected';}?>>
                                                                    Active</option>
                                                                <option value='0'
                                                                    <?php if($row['email_verification'] == 0){echo 'selected';}?>>
                                                                    Inactive</option>
                                                            </select>
                                                            <label id="user-status" class="error" for="status"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label required"
                                                            for="status">Status</label>
                                                        <div class="col-sm-8">
                                                            <select class="select2" name="status" id="status">
                                                                <option value='0'
                                                                    <?php if($row['block_status'] == 0){echo 'selected';}?>>
                                                                    Active</option>
                                                                <option value='1'
                                                                    <?php if($row['block_status'] == 1){echo 'selected';}?>>
                                                                    Inactive</option>
                                                                    <option value='-1'
                                                                    <?php if($row['block_status'] == -1){echo 'selected';}?>>
                                                                    Suspend</option>
                                                            </select>
                                                            <label id="user-status" class="error" for="status"></label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4" for="inputEmail3">
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <a class="btn btn-theme-danger" href="user.php"
                                                                id="users_cancel">
                                                                Cancel
                                                            </a>
                                                            <button type="submit" name="update"
                                                                class="btn btn-theme pull-right" id="users_edit">
                                                                <i class="fa fa-spinner fa-spin"
                                                                    style="display: none;"></i> <span
                                                                    id="users_edit_text">Update</span>
                                                            </button>
                                                        </div>
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
            </section>
        </div>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>

    
    <?php include 'include/script.php';?>
    <script type="text/javascript">
        $(function () {
            $(".select2").select2({
            });
        });

        // flag for button disable/enable
        var hasPhoneError = false;
        var hasEmailError = false;

        /**
         * [check submit button should be disabled or not]
         * @return  {void}
         */
        function enableDisableButton() {
            if (!hasPhoneError && !hasEmailError) {
                $('form').find("button[type='submit']").prop('disabled', false);
            } else {
                $('form').find("button[type='submit']").prop('disabled', true);
            }
        }

        function formattedPhone() {
            if ($('#phone').val != '') {
                let p = $('#phone').intlTelInput("getNumber").replace(/-|\s/g, "");
                $("#formattedPhone").val(p);
            }
        }

        // Validate email via Ajax
        $(document).ready(function () {
            $("#email").on('input', function (e) {
                var email = $(this).val();
                var id = $('#id').val();
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: SITE_URL + "/" + ADMIN_PREFIX + "/email_check",
                        dataType: "json",
                        data: {
                            'email': email,
                            'user_id': id,
                        }
                    })
                    .done(function (response) {
                        emptyEmail(email);
                        // console.log(response);
                        if (response.status == true) {

                            if (validateEmail(email)) {
                                $('#emailError').addClass('error').html(response.fail).css(
                                    "font-weight", "bold");
                                $('#email-ok').html('');
                                hasEmailError = true;
                                enableDisableButton();
                            } else {
                                $('#emailError').html('');
                            }
                        } else if (response.status == false) {
                            hasEmailError = false;
                            enableDisableButton();
                            if (validateEmail(email)) {
                                $('#emailError').html('');
                            } else {
                                $('#email-ok').html('');
                            }
                        }

                        /**
                         * [validateEmail description]
                         * @param    {null} email [regular expression for email pattern]
                         * @return  {null}
                         */
                        function validateEmail(email) {
                            var re =
                                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            return re.test(email);
                        }

                        /**
                         * [checks whether email value is empty or not]
                         * @return  {void}
                         */
                        function emptyEmail(email) {
                            if (email.length === 0) {
                                $('#emailError').html('');
                                $('#email-ok').html('');
                            }
                        }
                    });
            });
        });

        // show warnings on user status change
        $(document).on('change', '#status', function () {
            $status = $('#status').val();
            if ($status == 'Inactive') {
                $('#user-status').text('Warning! User won\'t be able to login.');
            } else if ($status == 'Suspended') {
                $('#user-status').text('Warning! User won\'t be able to do any transaction.');
            } else {
                $('#user-status').text('');
            }
        });

        $('#user_form').validate({
            rules: {
                username: {
                    required: true,
                    // letters_with_spaces_and_dot: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    minlength: 6,
                },
                password_confirmation: {
                    minlength: 6,
                    equalTo: "#password",
                },
            },
            messages: {
                password_confirmation: {
                    equalTo: "Please enter same value as the password field!",
                },
            }
        });
    </script>