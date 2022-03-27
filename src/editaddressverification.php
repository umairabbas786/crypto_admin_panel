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
        if(UpdateAddressProof($_GET['id'],$_POST['status'],$conn)){
            $_SESSION['address_success'] = "Address Status Updated Successfully";
            header("location:address_verification.php");
        }
        else{
            $_SESSION['address_error'] = "Unable to Update Address Status";
        }
    }

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <?php include "include/sidenav.php";?>
        <?php $row = GetAddressProofWithId($_GET['id'],$conn);?>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="top-bar-title padding-bottom pull-left">Address Verification Details</div>
                            </div>

                            <div>
                                <h4 class="text-left">Status : <span class="text-blue"><?php if ($row['status'] == '1'){echo "Approved";}else if($row['status'] == '0'){echo "Pending";}else if($row['status'] == '-1'){echo "Rejected";}?></span> </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="min-vh-100">
                    <div class="my-30">
                        <div class="row">
                            <form action="#" class="form-horizontal" id="deposit_form" method="POST">
                                <!-- Page title start -->
                                <div class="col-md-8 col-xl-9">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <div class="mt-4 p-4 bg-secondary rounded shadow">
                                                        <input type="hidden" value="1946" name="id" id="id">
                                                        <input type="hidden" value="1076" name="user_id" id="user_id">
                                                        <input type="hidden" value="address" name="verification_type"
                                                            id="verification_type">

                                                        <div class="panel panel-default">
                                                            <div class="panel-body">

                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-3"
                                                                        for="user">User</label>
                                                                    <input type="hidden" class="form-control"
                                                                        name="user" value="Shivom Pandey">
                                                                    <div class="col-sm-9">
                                                                        <p class="form-control-static"><?php echo $row['email'];?></p>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-3"
                                                                        for="created_at">Date</label>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_at" value="2022-02-21 19:23:04">
                                                                    <div class="col-sm-9">
                                                                        <p class="form-control-static"><?php echo $row['date'];?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-3"
                                                                        for="status">Change Status</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control select2"
                                                                            name="status" style="width: 60%;">
                                                                            <option value="1" <?php if($row['status'] == '1'){echo "selected";}?>>Approved</option>
                                                                            <option value="0" <?php if($row['status'] == '0'){echo "selected";}?>>Pending
                                                                            </option>
                                                                            <option value="-1" <?php if($row['status'] == '-1'){echo "selected";}?>>Rejected</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-3"></div>
                                                                            <div class="col-md-2"><a id="cancel_anchor"
                                                                                    class="btn btn-theme-danger pull-left"
                                                                                    href="address_verification.php">Cancel</a>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <button type="submit"
                                                                                    class="btn btn-theme pull-right"
                                                                                    id="deposits_edit" name="update">
                                                                                    <i class="fa fa-spinner fa-spin"
                                                                                        style="display: none;"></i>
                                                                                    <span
                                                                                        id="deposits_edit_text">Update</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-3">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <div class="mt-4 p-4 bg-secondary rounded shadow">
                                                        <div>
                                                            <ul style="list-style-type: none;">
                                                                <h4 style="text-decoration: underline;">Passport Front
                                                                </h4>
                                                                <li> <?php echo $row['front_pass'];?>
                                                                    <a class="text-info pull-right"
                                                                        href="../user/assets/kyc/<?php echo $row['front_pass']?>" target="_blank">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                </li>
                                                                <br>
                                                                <h4 style="text-decoration: underline;">Passport Back
                                                                </h4>
                                                                <li> <?php echo $row['back_pass'];?>
                                                                    <a class="text-info pull-right"
                                                                        href="../user/assets/kyc/<?php echo $row['back_pass']?>" target="_blank">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <?php include "include/footer.php";?>
    </div>
    <script type="text/javascript">
        $(".select2").select2({});

        // disabling submit and cancel button after form submit
        $(document).ready(function () {
            $('form').submit(function () {
                $("#deposits_edit").attr("disabled", true);

                $('#cancel_anchor').attr("disabled", "disabled");

                $(".fa-spin").show();

                $("#deposits_edit_text").text('Updating...');

                // Click False
                $('#deposits_edit').click(false);
                $('#cancel_anchor').click(false);
            });
        });
    </script>
    <?php include "include/script.php";?>