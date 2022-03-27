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
        if(UpdateUser($_GET['id'],$_POST['username'],$_POST['phone'],$_POST['email'],$_POST['password'],$_POST['status'],$conn)){
            $_SESSION['success'] = "1";
            header("location:?a=user");
        }
        else{
            $_SESSION['error'] = "0";
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
                            <li>
                                <a href='?a=edit-user&id=<?php echo $_GET['id'];?>'>Profile</a>
                            </li>
                            <li>
                                <a href="?a=user-transaction&id=<?php echo $_GET['id'];?>">Transactions</a>
                            </li>
                            <li class="active">
                                <a href="?a=user-wallet&id=<?php echo $_GET['id'];?>">Wallets</a>
                            </li>
                            <li>
                                <a href="?a=user-ticket&id=<?php echo $_GET['id'];?>">Tickets</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php $ee = GetUserEmail($_GET['id'],$conn);?>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover dt-responsive transactions"
                                        id="userwallet" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th title="ID">ID</th>
                                                <th title="Balance">Balance</th>
                                                <th title="Currency">Currency</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <?php if(UserWalletCheck($ee, $conn) == false){?>
                                        <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#userwallet').DataTable();
                                        });
                                        </script>
                                    <?php }else{?>
                                    <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#userwallet').DataTable({
                                                "processing": true,
                                                data: <?php GetUserWalletDetails($ee, $conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'balance',
                                                        'title': 'Balance'
                                                    },
                                                    {
                                                        'data': 'currency',
                                                        'title': 'Currency'
                                                    }
                                                ]
                                            });
                                        });
                                    </script>
                                    <?php }?>
                                </div>
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