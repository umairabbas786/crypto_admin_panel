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
            <?php if(isset($_SESSION['address_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div" style="margin-bottom:0px;"
                role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['address_success'];?></p>
            </div>
            <?php UnsetSession('address_success');}?>
            <?php if(isset($_SESSION['address_error'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;" role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['address_error'];?></p>
            </div>
            <?php }?>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body pb-20">
                        <form class="form-horizontal" action="address_verification.php"
                            method="GET">
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
                                                    <option value="approved">
                                                        Approved
                                                    </option>
                                                    <option value="rejected">
                                                        Rejected
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
                        <h3 class="panel-title text-bold ml-5">All Address Verifications</h3>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <a href="" class="btn btn-sm btn-default btn-flat" id="csv">CSV</a>&nbsp;&nbsp;
                            <a href="" class="btn btn-sm btn-default btn-flat" id="pdf">PDF</a>
                        </div>
                    </div> -->
                </div>

                <div class="box mt-20">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover dt-responsive"
                                                id="address" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Date">Date</th>
                                                        <th title="User">User</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <?php if(AddressCheck($conn) == false){?>
                                                <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#address').DataTable()
                                                });
                                                </script>
                                            <?php }?>
                                            <?php if(CheckGet('status') == false){?>
                                                <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#address').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllAddressProofs($conn)?>,
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
                                                                'data': 'email',
                                                                'title': 'User' 
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
                                                    $('#address').DataTable({
                                                        "processing":true,
                                                        data: <?php GetPendingAddressProofs($conn)?>,
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
                                                                'data': 'email',
                                                                'title': 'User' 
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
                                            <?php }else if($_GET['status'] == 'approved'){?>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#address').DataTable({
                                                        "processing":true,
                                                        data: <?php GetApprovedAddressProofs($conn)?>,
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
                                                                'data': 'email',
                                                                'title': 'User' 
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
                                            <?php }else if($_GET['status'] == 'rejected'){?>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#address').DataTable({
                                                        "processing":true,
                                                        data: <?php GetRejectedAddressProofs($conn)?>,
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
                                                                'data': 'email',
                                                                'title': 'User' 
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
                                                    $('#address').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllAddressProofs($conn)?>,
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
                                                                'data': 'email',
                                                                'title': 'User' 
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
    <script type="text/javascript">
        $(".select2").select2({});

        var sDate;
        var eDate;

        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                        .endOf('month')
                    ]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                var sessionDate = 'dd-mm-yyyy';
                var sessionDateFinal = sessionDate.toUpperCase();

                sDate = moment(start, 'MMMM D, YYYY').format(sessionDateFinal);
                $('#startfrom').val(sDate);

                eDate = moment(end, 'MMMM D, YYYY').format(sessionDateFinal);
                $('#endto').val(eDate);

                $('#daterange-btn span').html('&nbsp;' + sDate + ' - ' + eDate +
                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        )

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

        });

        // csv
        $(document).ready(function () {
            $('#csv').on('click', function (event) {
                event.preventDefault();
                var startfrom = $('#startfrom').val();
                var endto = $('#endto').val();
                var status = $('#status').val();

                window.location = SITE_URL + "/" + ADMIN_PREFIX + "/address-proofs/csv?startfrom=" +
                    startfrom +
                    "&endto=" + endto +
                    "&status=" + status
            });
        });

        // pdf
        $(document).ready(function () {
            $('#pdf').on('click', function (event) {
                event.preventDefault();
                var startfrom = $('#startfrom').val();
                var endto = $('#endto').val();
                var status = $('#status').val();

                window.location = SITE_URL + "/" + ADMIN_PREFIX + "/address-proofs/pdf?startfrom=" +
                    startfrom +
                    "&endto=" + endto +
                    "&status=" + status
            });
        });
    </script>
<?php UnsetSession('address_error');?>

<?php include "include/footer.php";?>
<div class="control-sidebar-bg"></div>
</div>

<?php include "include/script.php";?>