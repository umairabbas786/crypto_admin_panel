<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>
        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['transfer_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['transfer_success'];?></p>
            </div>
        <?php UnsetSession('transfer_success');}?>
        <?php if(isset($_SESSION['transfer_error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['transfer_error'];?></p>
            </div>
            <?php UnsetSession('transfer_error');}?>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body pb-20">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="top-bar-title padding-bottom pull-left">Transfers</div>
                            </div>

                            <!-- <div>
                                <a href="https://freedompayuniverse.com/admin/users/create" class="btn btn-theme"><span
                                        class="fa fa-plus"> &nbsp;</span>Add User</a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <h3 class="panel-title text-bold ml-5">All Transfers</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <a href="" class="btn btn-sm btn-default btn-flat" id="csv">CSV</a>&nbsp;&nbsp;
                            <a href="" class="btn btn-sm btn-default btn-flat" id="pdf">PDF</a>
                        </div>
                    </div>
                </div>

                <div class="box mt-20">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover dt-responsive"
                                                id="transfers" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Date">Date</th>
                                                        <th title="User">User</th>
                                                        <th title="Amount">Amount</th>
                                                        <!-- <th title="Fees">Fees</th>
                                                        <th title="Total">Total</th> -->
                                                        <!-- <th title="Currency">Currency</th> -->
                                                        <th title="Receiver">Receiver</th>
                                                        <th title="Note">Note</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#transfers').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllTransfers($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            { 
                                                                'data': 'date',
                                                                'title':'Date'
                                                            },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'receiver',
                                                                'title': 'Receiver' 
                                                            },
                                                            { 
                                                                'data': 'note',
                                                                'title': 'Note' 
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

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script type="text/javascript">
        $(".select2").select2({});
    </script>
<?php include 'include/script.php';?>