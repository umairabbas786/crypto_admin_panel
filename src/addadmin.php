<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>

<?php 
    if(isset($_POST['addadmin'])){
        if(EmailCheck($_POST['email'],$conn) >=1){
            $_SESSION['admin_error'] = "Email Already Exists";
        }
        else{
            if(AddAdmin($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password'],$conn)){
                $_SESSION['admin_success'] = "Admin Created Successfully";
                header("location:?a=admin");
            }
            else{
                $_SESSION['admin_error'] = "Unable to Create Admin";
            }
        }

    }

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['admin_error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['admin_error'];?></p>
            </div>
            <?php }?>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Admin</h3>
                </div>
                <form action="#" class="form-horizontal" id="user_form"
                      method="POST">
                    <div class="box-body">
                                                <div class="form-group">
                            <label class="col-sm-3 control-label">
                                First Name
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Enter First Name" name="first_name" type="text"
                                       id="first_name" value="">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Last Name
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Enter Last Name" name="last_name" type="text"
                                       id="last_name" value="">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label require">
                                Email
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Enter a valid email" name="email" type="email"
                                       id="email">
                                </input>
                                <span id="email_error"></span>
                                <span id="email_ok" class="text-success"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label require">
                                Password
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Enter new Password (min 6 characters)"
                                       name="password" type="password" id="password">
                                </input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label require">
                                Confirm Password
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Confirm password (min 6 characters)"
                                       name="password_confirmation" type="password" id="password_confirmation">
                                </input>
                            </div>
                        </div>

                        <!-- box-footer -->
                        <div class="box-footer">
                            <a class="btn btn-theme-danger pull-left" href="?a=admin"
                               id="users_cancel">Cancel</a>
                            <button type="submit" class="btn btn-theme pull-right" id="users_create" name="addadmin"><i
                                        class="fa fa-spinner fa-spin" style="display: none;"></i> <span
                                        id="users_create_text">Create</span></button>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    </input>
                </form>
            </div>
        </div>
    </div>
<?php UnsetSession('admin_error');?>
                </section>
            </div>

            <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
        
<!-- jquery.validate -->
<script src="https://freedompayuniverse.com/public/dist/js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {
        $(".select2").select2({});
    })

    // $('#role').select2({
    //     placeholder: 'Select a role',
    //     width: '200px'
    // });

    $.validator.setDefaults({
        highlight: function (element) {
            $(element).parent('div').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent('div').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });

    $('#user_form').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            password_confirmation: {
                equalTo: "Please enter same value as the password field!"
            }
        },
        submitHandler: function (form) {
            $("#users_create").attr("disabled", true);
            $(".fa-spin").show();
            $("#users_create_text").text('Creating...');
            $('#users_cancel').attr("disabled", "disabled");
            form.submit();
        }
    });

    // Validate Emal via Ajax
    $(document).ready(function () {
        $("#email").on('keyup keypress', function (e) {
            if (e.type == "keyup" || e.type == "keypress") {
                var email = $('#email').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: SITE_URL+"/"+ADMIN_PREFIX+"/email_check",
                    dataType: "json",
                    data: {
                        'email': email,
                        'type': 'admin-email'
                    }
                })
                    .done(function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            emptyEmail();
                            if (validateEmail(email)) {
                                $('#email_error').addClass('error').html(response.fail).css("font-weight", "bold");
                                $('#email_ok').html('');
                                $('form').find("button[type='submit']").prop('disabled',true);
                            } else {
                                $('#email_error').html('');
                            }
                        }
                        else if (response.status == false) {
                            emptyEmail();
                            if (validateEmail(email)) {
                                $('#email_error').html('');
                            } else {
                                $('#email_ok').html('');
                            }
                            $('form').find("button[type='submit']").prop('disabled',false);
                        }

                        /**
                         * [validateEmail description]
                         * @param    {null} email [regular expression for email pattern]
                         * @return  {null}
                         */
                        function validateEmail(email) {
                            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            return re.test(email);
                        }

                        /**
                         * [checks whether email value is empty or not]
                         * @return  {void}
                         */
                        function emptyEmail() {
                            if (email.length === 0) {
                                $('#email_error').html('');
                                $('#email_ok').html('');
                            }
                        }
                    });
            }
        });
    });


</script>
<?php include "include/script.php";?>

