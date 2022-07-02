<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "delete from admin where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            $_SESSION['success'] = "Admin Deleted SuccessFully";
            header("location:?a=admin");
        }
        else{
            $_SESSION['error'] = "Unable to Delete Admin";
            header("location:?a=admin");
        }
    }
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['admin_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['admin_success'];?></p>
            </div>
        <?php UnsetSession('admin_success');}?>
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
                <div class="box box-default">
                    <div class="box-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="top-bar-title padding-bottom pull-left">Admins</div>
                            </div>

                            <div>
                                <a href="?a=add-admin"
                                    class="btn btn-theme"><span class="fa fa-plus"> &nbsp;</span>Add Admin</a>
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
                                            <table class="table table-striped table-hover dt-responsive"
                                                id="admins" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="First Name">First Name</th>
                                                        <th title="Last Name">Last Name</th>
                                                        <th title="Email">Email</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#admins').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAdmins($_SESSION['admin'],$conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            { 
                                                                'data': 'firstname',
                                                                'title':'First Name'
                                                            },
                                                            { 
                                                                'data': 'lastname',
                                                                'title': 'Last Name' 
                                                            },
                                                            { 
                                                                'data': 'email',
                                                                'title': 'Email' 
                                                            },
                                                            { 
                                                                'data': 'status',
                                                                'title': 'Status' 
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
        <?php UnsetSession('admin_error');?>
        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
        function confirmationDelete(anchor)
        {
            var conf = confirm('Delete this Admin?');
            if(conf)
            window.location=anchor.attr("href");
        }
    </script>
    <?php include "include/script.php";?>