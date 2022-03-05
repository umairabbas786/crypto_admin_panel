<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:login.php");
}
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>
        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['transaction_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['transaction_success'];?></p>
            </div>
        <?php UnsetSession('transaction_success');}?>
        <?php if(isset($_SESSION['transaction_error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['transaction_error'];?></p>
            </div>
            <?php UnsetSession('transaction_error');}?>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body pb-20">
                        <form class="form-horizontal" action=""
                            method="GET" id='transaction_form'>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="d-flex flex-wrap">
                                            <div class="pr-25">
                                                <label for="status">Status</label><br>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="all" selected>All</option>
                                                    <option value="cancelled">
                                                        Cancelled
                                                    </option>
                                                    <option value="success">
                                                        Success
                                                    </option>
                                                    <option value="pending">
                                                        Pending
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group" style="margin-top: 25px;">
                                                <button type="submit" class="btn btn-theme"
                                                    id="btn">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <h3 class="panel-title text-bold ml-5">All Transactions</h3>
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
                                            <table class="table table-striped table-hover dt-responsive transactions"
                                                id="transactions" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Date">Date</th>
                                                        <th title="UUID">Transaction ID</th>
                                                        <th title="User">User</th>
                                                        <th title="Type">Type</th>
                                                        <th title="Amount">Amount</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <?php if(AddressCheck($conn) == false){?>
                                                <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#transactions').DataTable()
                                                });
                                                </script>
                                            <?php }?>
                                            <?php if(CheckGet('status') == false){?>
                                                <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#transactions').DataTable({
                                                "processing": true,
                                                data: <?php GetAllTransaction($conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'date',
                                                        'title': 'Date'
                                                    },
                                                    {
                                                        'data': 'transection_id',
                                                        'title': 'UUID'
                                                    },
                                                    {
                                                        'data': 'user',
                                                        'title': 'User'
                                                    },
                                                    {
                                                        'data': 'type',
                                                        'title': 'Type'
                                                    },
                                                    {
                                                        'data': 'amount',
                                                        'title': 'Amount'
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
                                            <?php }else if($_GET['status'] == 'pending'){?>
                                                <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#transactions').DataTable({
                                                "processing": true,
                                                data: <?php GetPendingTransaction($conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'date',
                                                        'title': 'Date'
                                                    },
                                                    {
                                                        'data': 'transection_id',
                                                        'title': 'UUID'
                                                    },
                                                    {
                                                        'data': 'user',
                                                        'title': 'User'
                                                    },
                                                    {
                                                        'data': 'type',
                                                        'title': 'Type'
                                                    },
                                                    {
                                                        'data': 'amount',
                                                        'title': 'Amount'
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
                                            <?php }else if($_GET['status'] == 'success'){?>
                                                <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#transactions').DataTable({
                                                "processing": true,
                                                data: <?php GetSuccessTransaction($conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'date',
                                                        'title': 'Date'
                                                    },
                                                    {
                                                        'data': 'transection_id',
                                                        'title': 'UUID'
                                                    },
                                                    {
                                                        'data': 'user',
                                                        'title': 'User'
                                                    },
                                                    {
                                                        'data': 'type',
                                                        'title': 'Type'
                                                    },
                                                    {
                                                        'data': 'amount',
                                                        'title': 'Amount'
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
                                            <?php }else if($_GET['status'] == 'cancelled'){?>
                                                <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#transactions').DataTable({
                                                "processing": true,
                                                data: <?php GetCancelledTransaction($conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'date',
                                                        'title': 'Date'
                                                    },
                                                    {
                                                        'data': 'transection_id',
                                                        'title': 'UUID'
                                                    },
                                                    {
                                                        'data': 'user',
                                                        'title': 'User'
                                                    },
                                                    {
                                                        'data': 'type',
                                                        'title': 'Type'
                                                    },
                                                    {
                                                        'data': 'amount',
                                                        'title': 'Amount'
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
                                            <?php }else if($_GET['status'] == 'all'){?>
                                                <script type="text/javascript" language="javascript">
                                        $(document).ready(function () {
                                            $('#transactions').DataTable({
                                                "processing": true,
                                                data: <?php GetAllTransaction($conn);?>,
                                                columns : [{
                                                        'data': 'id',
                                                        'title': 'ID'
                                                    },
                                                    {
                                                        'data': 'date',
                                                        'title': 'Date'
                                                    },
                                                    {
                                                        'data': 'transection_id',
                                                        'title': 'UUID'
                                                    },
                                                    {
                                                        'data': 'user',
                                                        'title': 'User'
                                                    },
                                                    {
                                                        'data': 'type',
                                                        'title': 'Type'
                                                    },
                                                    {
                                                        'data': 'amount',
                                                        'title': 'Amount'
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
                                            <?php } ?>
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