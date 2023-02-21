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
<style>
    .delete{
        background-color:red;
        color:white !important;
        padding:5px;
    }
</style>
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
                                                <tbody>
                                                    <?php 
                                                        $sql = "select * from user order by id desc";
                                                        $r = $conn->query($sql);
                                                        while($row = mysqli_fetch_assoc($r)){
                                                            $id = $row['id'];
                                                            $action = "";
                                                            $action.= "<a class='btn btn-xs btn-primary' href='?a=edit-user&id=$id' ><i class='glyphicon glyphicon-edit'></i></a>";
                                                            $action.= "<a class='delete' href='?a=user&id=$id' ><i class='glyphicon glyphicon-trash'></i></a>";
                                                            if($row['email_verification'] == '1'){
                                                                $row['email_verification'] = '<span class="label label-success">Verified</span>';
                                                            }
                                                            if($row['email_verification'] == '0'){
                                                                $row['email_verification'] = '<span class="label label-danger">Unverified</span>';
                                                            }
                                                            if($row['block_status'] == '1'){
                                                                $row['block_status'] = '<span class="label label-danger">Blocked</span>';
                                                            }
                                                            if($row['block_status'] == '0'){
                                                                $row['block_status'] = '<span class="label label-success">Unblocked</span>';
                                                            }
                                                            if($row['block_status'] == '-1'){
                                                                $row['block_status'] = '<span class="label label-primary">Suspended</span>';
                                                            }
                                                            if($row['balance'] < 1){
                                                                $row['balance'] = '$0.00';
                                                            }
                                                            else{
                                                                $row['balance'] = "$". $row['balance'];
                                                            }
                                                            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $row['id'];?></th>
                                                        <th><?php echo $row['username'];?></th>
                                                        <th><?php echo $row['email'];?></th>
                                                        <th><?php echo $row['password'];?></th>
                                                        <th><?php echo $row['balance'];?></th>
                                                        <th><?php echo $row['email_verification'];?></th>
                                                        <th><?php echo $row['block_status'];?></th>
                                                        <th><?php echo $action;?></th>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
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

    <?php include "include/script.php";?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
    
        <script>
    $(".delete").click(function(){
        if (window.confirm('Are you sure？')) {
     window.location=$(this).attr("href"); 
    }else{
        return false;
    }
           
    })
       
    </script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                order: [[0, 'desc']],
            });
        } );
    </script>