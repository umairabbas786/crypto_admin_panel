<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "delete from ticket where id = '$id'";
        $r = $conn->query($sql);
        $s = "delete from ticket_chat where ticket_id = '$id'";
        $rr = $conn->query($s);
        if($r && $rr){
            $_SESSION['success'] = "Ticket Deleted SuccessFully";
            header("location:?a=ticket");
        }
        else{
            $_SESSION['error'] = "Unable to Delete Ticket";
            header("location:?a=ticket");
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
                                <div class="top-bar-title padding-bottom pull-left">Tickets</div>
                            </div>
                            <!-- <div>
                                <a href="#" class="btn btn-theme"><span class="fa fa-plus"> &nbsp;</span>Add Ticket</a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-2">
                                <div class="panel panel-primary">
                                    <div class="panel-body text-center">
                                        <span style="font-size: 20px;"><?php echo GetOpenTicketCount($conn);?></span><br>
                                        <span style="font-weight: bold; color: #00a65a ;">Open</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="panel panel-primary">
                                    <div class="panel-body text-center">
                                        <span style="font-size: 20px;"><?php echo GetProgressTicketCount($conn);?></span><br>
                                        <span style="font-weight: bold; color: #3c8dbc ;">In Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="panel panel-primary">
                                    <div class="panel-body text-center">
                                        <span style="font-size: 20px;"><?php echo GetHoldTicketCount($conn);?></span><br>
                                        <span style="font-weight: bold; color: #f39c12 ;">Hold</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="panel panel-primary">
                                    <div class="panel-body text-center">
                                        <span style="font-size: 20px;"><?php echo GetClosedTicketCount($conn);?></span><br>
                                        <span style="font-weight: bold; color: #dd4b39 ;">Closed</span>
                                    </div>
                                </div>
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
                                                id="ticket" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Date">Date</th>
                                                        <th title="User">User</th>
                                                        <th title="Subject">Subject</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Priority">Priority</th>
                                                        <th title="Action">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <script type="text/javascript" language="javascript">
                                                $(document).ready(function () {
                                                    $('#ticket').DataTable({
                                                        "processing":true,
                                                        data: <?php GetAllTickets($conn)?>,
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
                                                                'data': 'subject',
                                                                'title': 'Subject' 
                                                            },
                                                            { 
                                                                'data': 'status',
                                                                'title': 'Status' 
                                                            },
                                                            { 
                                                                'data': 'priority',
                                                                'title': 'Priority' 
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
    </div>

    <script type="text/javascript">
        $(".select2").select2({});
    </script>

<script>
        function confirmationDelete(anchor)
        {
            var conf = confirm('Delete this Ticket?');
            if(conf)
            window.location=anchor.attr("href");
        }
    </script>
<?php include 'include/script.php';?>