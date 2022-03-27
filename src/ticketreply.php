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
            $_SESSION['success'] = "User Updated Successfully";
            header("location:user.php");
        }
        else{
            $_SESSION['error'] = "Unable to Update User";
        }
    }
?>
<?php if(isset($_POST['delete'])){
    $idz = $_POST['id'];
    $sql = "delete from ticket_chat where id = '$idz'";
    $r = $conn->query($sql);
    if($r){
        $_SESSION['ticket_reply_success'] = "Message Deleted Successfully";
        header("location:#");
    } 
    else{
        $conn->error;
    }
}?>
<?php $row = GetTicketDetailsWithId($_GET['id'],$conn);?>
<?php 
if (isset($_POST['send_message'])) {
    $idd = $_GET['id'];
    $description = $_POST['message'];
    $receiver = $row['owner'];
    $sender  = "Admin";
    $ticket_id = $row['id'];
    $file  = $_FILES['file']['name'];
    if (!empty($file)) {
        
        $file_tmp  = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp,'../user/assets/ticket/'.$file);
    }else{
        $file ="";
    }
    $sql = "INSERT INTO ticket_chat (sender,receiver,description,ticket_id,file,date) VALUES ('$sender','$receiver','$description','$ticket_id','$file',now())";
    if ($conn->query($sql)) {
        $_SESSION['ticket_reply_success'] = "Replyed to Ticket Successfully";
        header("location:#");
    }else{
        echo $conn->error;
    }
  
    }
?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
            <?php if(isset($_SESSION['ticket_reply_success'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['ticket_reply_success'];?></p>
            </div>
            <?php unset($_SESSION['ticket_reply_success']);}?>

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
                            <div class="col-md-9">
                                <div class="top-bar-title padding-bottom">Ticket Reply</div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="pull-right">Ticket Status:
                                    <?php if($row['status'] == '1'){?>
                                    <span class="label label-info" id="status_label">Open</span>
                                    <?php }else if($row['status'] == '0'){?>
                                    <span class="label label-danger" id="status_label">Closed</span>
                                    <?php }else if($row['status'] == '-1'){?>
                                    <span class="label label-primary" id="status_label">In Progress</span>
                                    <?php }else if($row['status'] == '-2'){?>
                                    <span class="label label-warning" id="status_label">Hold</span>
                                    <?php }?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reply Form -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4> <strong>Subject : </strong> <?php echo $row['subject'];?></h4>
                    </div>

                    <div class="box-header with-border">
                        <div class="col-md-10">
                            <span class="label label-default" style="font-size: 14px">Priority :
                                <?php echo $row['type'];?></span>
                        </div>

                        <div class="col-md-2">
                            <span>
                                <select id="status_ticket" class="form-control">
                                    <option <?php if($row['status'] == '1'){echo "selected";}?> value="1">Open</option>
                                    <option <?php if($row['status'] == '-1'){echo "selected";}?> value="-1">In Progress
                                    </option>
                                    <option <?php if($row['status'] == '-2'){echo "selected";}?> value="-2">Hold
                                    </option>
                                    <option <?php if($row['status'] == '0'){echo "selected";}?> value="0">Closed
                                    </option>
                                </select>
                            </span>
                        </div>
                    </div>


                    <div class="box-body">

                        <form class="form-horizontal" id="reply_form" action="#" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label require">Reply</label>
                                        <div class="col-sm-11">
                                            <textarea name="message" id="message" class="message form-control" cols="30"
                                                rows="10"></textarea>
                                            <div id="error-message"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- <div class="form-group">
                                                <label class="col-sm-3 control-label">Status</label>
                                                <div class="col-sm-6">
                                                    <select name="status_id" class="form-control select2">
                                                    
                                                    </select>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">File</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="file"
                                                        class="form-control input-file-field">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" name="send_message"
                                                class="btn btn-primary pull-right btn-flat" id="reply"><i
                                                    class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                <span id="reply_text">Reply</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $row1 = GetUserWithEmail($row['owner'],$conn);?>
                <?php
	$ticket_id = $_GET['id'];
    $sql = "SELECT * FROM ticket_chat WHERE ticket_id = '$ticket_id'";
    $result = $conn->query($sql);
    while($row2=mysqli_fetch_assoc($result)){
     	$sender = $row2['sender'];
     	$receiver = $row2['receiver'];
     	$description = $row2['description'];
     	$date  = $row2['date'];
     	$file  = $row2['file'];
    if ($sender=="Admin") {
    	?>
                <!--  Show Admin Reply -->
                <div class="box">
                    <div class="box-body" style="background-color: #F2F4F4">

                        <div class="col-sm-1"></div>

                        <div class="col-sm-10">
                            <p style="margin-top: 10px; text-align: justify;">
                                <p><?php echo $description;?></p>
                            </p>
                            <hr style="border-top: dotted 1px; width: 200px; float: left; margin-top: 0px">
                            <?php if(!empty($file)){?>
                            <a href="../user/assets/ticket/<?php echo $file;?>" class="pull-right"><i class="fa fa-fw fa-download"></i><?php echo $file;?></a>
                            <?php }?>
                        </div>


                        <div class="col-sm-1" style="text-align: center;">
                            <h5><a href="editadmin.php?id=<?php $r = GetAdminDetails($_SESSION['admin'],$conn); echo $r['email']?>"><?php echo $r['first_name'].' '.$r['last_name']?></a></h5>
                            <img alt="Default picture"
                                src='https://freedompayuniverse.com/public/uploads/userPic/default-image.png'
                                class="img-responsive img-circle asa">

                            <hr style="margin: 5px 0px;">

                            <form action="#" accept-charset="UTF-8" method="POST" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                <button class="btn btn-xs btn-danger btn-flat" name="delete" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="box-footer">

                        <span class="pull-right"><i class="fa fa-fw fa-clock-o"></i><small><i><?php echo $date;?></i></small></span>
                    </div>
                </div>
                <!--end admin reply-->
                <?php }else{?>
                    <!-- Show Customer Query -->
                <div class="box">
                    <div class="box-body" style="background-color: #FFFFE6">
                        <div class="col-sm-1">
                            <h5><a href="edituser.php?id=<?php echo $row1['id'];?>"><?php echo $row1['username'];?></a>
                            </h5>

                            <img alt="User profile picture"
                                src="https://freedompayuniverse.com/public/user_dashboard/profile/1636023179.png"
                                class="img-responsive img-circle asa">
                        </div>
                        <div class="col-sm-11">
                            <p style="margin-top: 10px; text-align: justify;"><?php echo $description;?></p>
                            <hr style="border-top: dotted 1px; width: 200px; float: left; margin-top: 0px">
                            <?php if(!empty($file)){?>
                            <a href="../user/assets/ticket/<?php echo $file;?>" class="pull-right"><i class="fa fa-fw fa-download"></i><?php echo $file;?></a>
                            <?php }?>
                        </div>
                    </div>
                    <div class="box-footer">

                        <span><i class="fa fa-fw fa-clock-o"></i><small><i><?php echo $date;?></i></small></span>
                    </div>
                </div>
                <?php }}?>

                <!-- Modal Start -->
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">

                        <form method="POST" action="https://freedompayuniverse.com/admin/tickets/reply/update"
                            id="replyModal">
                            <input type="hidden" name="_token" value="qH2vySzQiUISm0uvotNuelq5oAsmKfXyAtPmirq6">

                            <input type="hidden" name="id" id="reply_id">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Reply</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">

                                        <div class="modal_editor_textarea">
                                            <textarea name="message" class="form-control editor"
                                                style="height: 200px"></textarea>
                                        </div>

                                        <div id="error-message-modal"></div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-flat pull-left"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-flat">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.Modal End -->

            </section>
        </div>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".select2").select2({});
        });

        $(function () {
            $('.message').wysihtml5({
                events: {
                    change: function () {
                        if ($('.message').val().length === 0) {
                            $('#error-message').addClass('error').html('This field is required.')
                                .css("font-weight", "bold");
                        } else {
                            $('#error-message').html('');
                        }
                    }
                }
            });
        });

        $(function () {
            $('.editor').wysihtml5({
                events: {
                    change: function () {
                        if ($('.editor').val().length === 0) {
                            $('#error-message-modal').addClass('error').html(
                                'This field is required.').css("font-weight", "bold");
                        } else {
                            $('#error-message-modal').html('');
                        }
                    }
                }
            });
        });

        $('#reply_form').validate({
            ignore: ":hidden:not(textarea)",
            rules: {
                message: "required",
                file: {
                    extension: "docx|rtf|doc|pdf|png|jpg|jpeg|gif|bmp",
                },
            },
            messages: {
                file: {
                    extension: "Please select (docx, rtf, doc, pdf, png, jpg, jpeg, gif or bmp) file!"
                },
            },
            submitHandler: function (form) {
                $("#reply").attr("disabled", true);
                $(".fa-spin").show();
                $("#reply_text").text('Replying...');

                $("#customer_reply_button").attr("disabled", true);
                $("#admin_reply_button").attr("disabled", true);
                $(".edit-btn").attr("disabled", true);

                $('#customer_reply_button').click(false);
                $('#admin_reply_button').click(false);
                $('.edit-btn').click(false);
                form.submit();
            }
        });
    //   $(document).ready(function(){
    //   $("#status_ticket").change(function(){
	// 	    var id=$(this).val();
    //     $.ajax({
    //       type:'POST',
    //       url:'verify_unverify_customers.php',
    //       data:{id : id},
    //       success:function(data)
    //       {
    //         window.location.reload(true);
    //       }
    //     });
    //   });
    // });
    </script>
<?php include 'include/script.php';?>