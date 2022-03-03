<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:login.php");
}
?>
<?php 
    if(isset($_POST['update_news'])){
        if(UpdateNews($_POST['id'],$_POST['news'],$conn)){
            $_SESSION['success_news'] = "News Updated Successfully";
            header("location:news.php");
        }
        else{
            $_SESSION['error_news'] = "Unable to Update News";
            header("location:news.php");
        }
    }
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
            <?php if(isset($_SESSION['success_news'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['success_news'];?></p>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['error_news'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['error_news'];?></p>
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
                        <div class="row">
                            <div class="col-md-9">
                                <div class="top-bar-title padding-bottom">Animated News</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $row = GetNews($conn);?>
                <!-- Reply Form -->
                <div class="box">
                    <div class="box-body">
                        <form class="form-horizontal" id="reply_form" action="#" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label require">Update News</label>
                                        <div class="col-sm-11">
                                            <textarea name="news" id="message" value="Hello World" class="message form-control" cols="50"
                                                rows="10"><?php echo $row['text'];?></textarea>
                                            <div id="error-message"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <button type="submit" name="update_news"
                                                class="btn btn-primary btn-flat" id="reply"><i
                                                    class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                <span id="reply_text">Update</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
    </script>
<?php include 'include/script.php';?>