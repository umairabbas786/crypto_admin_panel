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
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-bar-title padding-bottom">Activity Logs</div>
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
                                                id="activity" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Date">Date</th>
                                                        <th title="User">User</th>
                                                        <th title="IP Address">IP Address</th>
                                                        <th title="Browser">Browser | Platform</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $sql = "select * from activity_log";
                                                        $r = $conn->query($sql);
                                                        $rows = array();
                                                        while($row = mysqli_fetch_array($r)){
                                                            $row['user'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['user'],$conn).'>'.$row['user'].'</a>';

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['id'];?></td>
                                                        <td><?php echo $row['date'];?></td>
                                                        <td><?php echo $row['user'];?></td>
                                                        <td><?php echo $row['ip_address'];?></td>
                                                        <td><?php echo $row['browser'];?></td>
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

        <?php include "include/footer.php";?>
		<div class="control-sidebar-bg"></div>
	</div>

	<?php include "include/script.php";?>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
	<script>
        $(document).ready(function() {
            $('#activity').DataTable({
                order: [[0, 'desc']],
            });
        } );
    </script>