<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>
<?php 
    if(isset($_GET['id'])){
        $row = GetUserWithId($_GET['id'],$conn);
        if(DeleteUser($row['email'],$conn)){
            $_SESSION['success'] = "User Deleted SuccessFully";
            header("location:?a=user");
        }
        else{
            $_SESSION['error'] = "Unable to Delete User";
            header("location:?a=user");
        }
    }
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['success'];?></p>
            </div>
        <?php UnsetSession('success');}?>
        <?php if(isset($_SESSION['error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['error'];?></p>
            </div>
            <?php }?>
        </div>
        <!-- /.Flash Message  -->



        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="top-bar-title padding-bottom pull-left">Users</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover dt-responsive" id="users"
                                                width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Name">Name</th>
                                                        <th title="Email">Email</th>
                                                        <th title="Password">Password</th>
                                                        <th title="Balance">Balance</th>
                                                        <th title="Email Verification">Email Verification</th>
                                                        <th title="Block Status">Block Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#users').DataTable({
                                                        "processing":true,
                                                        "order": [[ 0, "desc" ]]
                                                        ,
                                                        data: <?php GetUserDetails($conn)?>,
                                                        "deferRender": true,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            { 
                                                                'data': 'username',
                                                                'title':'Name'
                                                            },
                                                            { 
                                                                'data': 'email',
                                                                'title': 'Email' 
                                                            },
                                                            { 
                                                                'data': 'password',
                                                                'title': 'Password' 
                                                            },
                                                            { 
                                                                'data': 'balance',
                                                                'title': 'Balance' 
                                                            },
                                                            { 
                                                                'data': 'email_verification',
                                                                'title': 'Email Verification' 
                                                            },
                                                            { 
                                                                'data': 'block_status',
                                                                'title': 'Block Status' 
                                                            },
                                                            { 
                                                                'data': 'action',
                                                                'title': 'Action'
                                                            }
                                                        ]
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php UnsetSession('error');?>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
        function confirmationDelete(anchor)
        {
            var conf = confirm('Delete this User?');
            if(conf)
            window.location=anchor.attr("href");
        }
    </script>
    <?php include "include/script.php";?>
    