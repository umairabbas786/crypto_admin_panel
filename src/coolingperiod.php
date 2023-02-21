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
        <?php if(isset($_SESSION['success_cooling'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['success_cooling'];?></p>
            </div>
        <?php UnsetSession('success_cooling');}?>
        <?php if(isset($_SESSION['error_cooling'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['error_cooling'];?></p>
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
                                <div class="top-bar-title padding-bottom pull-left">Cooling Period</div>
                            </div>
                            <!-- <div>
                                <a href="addcooling.php" class="btn btn-theme"><span
                                        class="fa fa-plus"> &nbsp;</span>Add User</a>
                            </div> -->
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
                                            <table class="table table-striped table-hover dt-responsive" id="cooling"
                                                width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th title="ID">ID</th>
                                                        <th title="Email">Email</th>
                                                        <th title="Status">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $sql = "select * from cooling_period";
                                                        $r = $conn->query($sql);
                                                        $rows = array();
                                                        while($row = mysqli_fetch_array($r)){
                                                            if($row['status'] == '1'){
                                                                $row['status'] = '<div class="togglebutton"><label><input type="checkbox" name="status" value="'.$row['id'].'" checked=""><span class="toggle"></span></label></div>';
                                                            }
                                                            if($row['status'] == '0'){
                                                                $row['status'] = '<div class="togglebutton"><label><input type="checkbox" name="statuss" value="'.$row['id'].'"><span class="toggle"></span></label></div>';
                                                            }
                                                            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['id'];?></td>
                                                        <td><?php echo $row['email'];?></td>
                                                        <td><?php echo $row['status'];?></td>
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
        <?php UnsetSession('error_cooling');?>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
      $(document).ready(function(){
      $('input[name=status]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'?a=edit-cooling',
          data:{id : id},
          success:function(data)
          {
            window.location.reload(true);
          }
        });
      });
    });
    $(document).ready(function(){
      $('input[name=statuss]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'?a=edit-cooling',
          data:{idd : id},
          success:function(data)
          {
            window.location.reload(true);
          }
        });
      });
    });
    
    </script>
    <?php include "include/script.php";?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
	<script>
        $(document).ready(function() {
            $('#cooling').DataTable({
                order: [[0, 'desc']],
            });
        } );
    </script>
    