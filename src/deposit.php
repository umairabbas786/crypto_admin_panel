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
        <?php if(isset($_SESSION['deposit_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['deposit_success'];?></p>
            </div>
        <?php UnsetSession('deposit_success');}?>
        <?php if(isset($_SESSION['deposit_error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['deposit_error'];?></p>
            </div>
            <?php UnsetSession('deposit_error');}?>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body pb-20">
                        <form class="form-horizontal" action="" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="d-flex flex-wrap">
                                            <!-- Status -->
                                            <div class="pr-25">
                                                <label for="status">Status</label><br>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="all" selected>All</option>
                                                    <option value="pending">
                                                        Pending
                                                    </option>
                                                    <option value="success">
                                                        Success
                                                    </option>
                                                    <option value="cancelled">
                                                        Cancelled
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
                        <h3 class="panel-title text-bold ml-5">All Deposits</h3>
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
                                                id="depositt" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <!-- <th title="Date">Date</th> -->
                                                        <th title="User">User</th>
                                                        <!-- <th title="Amount">Amount</th>
                                                        <th title="Fees">Fees</th> -->
                                                        <th title="Amount">Amount</th>
                                                        <th title="Payment Method">Payment Method</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <?php if(AddressCheck($conn) == false){?>
                                                <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#depositt').DataTable()
                                                });
                                                </script>
                                            <?php }?>
                                            <?php if(CheckGet('status') == false){?>
                                                <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#depositt').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllDeposit($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            // { 
                                                            //     'data': 'date',
                                                            //     'title':'Date'
                                                            // },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'method',
                                                                'title': 'Payment Method' 
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
                                                    $('#depositt').DataTable({
                                                        "processing":true,
                                                        data: <?php GetPendingDeposit($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            // { 
                                                            //     'data': 'date',
                                                            //     'title':'Date'
                                                            // },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'method',
                                                                'title': 'Payment Method' 
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
                                                    $('#depositt').DataTable({
                                                        "processing":true,
                                                        data: <?php GetSuccessDeposit($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            // { 
                                                            //     'data': 'date',
                                                            //     'title':'Date'
                                                            // },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'method',
                                                                'title': 'Payment Method' 
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
                                                    $('#depositt').DataTable({
                                                        "processing":true,
                                                        data: <?php GetCancelledDeposit($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            // { 
                                                            //     'data': 'date',
                                                            //     'title':'Date'
                                                            // },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'method',
                                                                'title': 'Payment Method' 
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
                                                    $('#depositt').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllDeposit($conn)?>,
                                                        columns : [
                                                            { 
                                                                'data': 'id',
                                                                'title':'ID'
                                                            },
                                                            // { 
                                                            //     'data': 'date',
                                                            //     'title':'Date'
                                                            // },
                                                            { 
                                                                'data': 'user',
                                                                'title': 'User' 
                                                            },
                                                            { 
                                                                'data': 'amount',
                                                                'title': 'Amount' 
                                                            },
                                                            { 
                                                                'data': 'method',
                                                                'title': 'Payment Method' 
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
                </div>
            </section>
        </div>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script type="text/javascript">
        $(".select2").select2({});

        $(document).ready(function () {
            $("#daterange-btn").mouseover(function () {
                $(this).css('background-color', 'white');
                $(this).css('border-color', 'grey !important');
            });

            var startDate = "";
            var endDate = "";

            // alert(startDate);
            if (startDate == '') {
                $('#daterange-btn span').html(
                    '<i class="fa fa-calendar"></i> &nbsp;&nbsp; Pick a date range &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                    );
            } else {
                $('#daterange-btn span').html(startDate + ' - ' + endDate +
                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }

            $("#user_input").on('keyup keypress', function (e) {
                if (e.type == "keyup" || e.type == "keypress") {
                    var user_input = $('form').find("input[type='text']").val();
                    if (user_input.length === 0) {
                        $('#user_id').val('');
                        $('#error-user').html('');
                        $('form').find("button[type='submit']").prop('disabled', false);
                    }
                }
            });

            $('#user_input').autocomplete({
                source: function (req, res) {
                    if (req.term.length > 0) {
                        $.ajax({
                            url: 'https://freedompayuniverse.com/admin/deposits/user_search',
                            dataType: 'json',
                            type: 'get',
                            data: {
                                search: req.term
                            },
                            success: function (response) {
                                // console.log(response);
                                // console.log(req.term.length);

                                $('form').find("button[type='submit']").prop('disabled',
                                    true);

                                if (response.status == 'success') {
                                    res($.map(response.data, function (item) {
                                        return {
                                            id: item
                                            .user_id, //user_id is defined
                                            first_name: item
                                            .first_name, //first_name is defined
                                            last_name: item
                                            .last_name, //last_name is defined
                                            value: item.first_name + ' ' +
                                                item
                                                .last_name //don't change value
                                        }
                                    }));
                                } else if (response.status == 'fail') {
                                    $('#error-user').addClass('text-danger').html(
                                        'User Does Not Exist!');
                                }
                            }
                        })
                    } else {
                        console.log(req.term.length);
                        $('#user_id').val('');
                    }
                },
                select: function (event, ui) {
                    var e = ui.item;

                    $('#error-user').html('');

                    $('#user_id').val(e.id);

                    $('form').find("button[type='submit']").prop('disabled', false);
                },
                minLength: 0,
                autoFocus: true
            });
        });
    </script>
<?php include 'include/script.php';?>