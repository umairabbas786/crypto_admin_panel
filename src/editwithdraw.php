<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
if(CheckGet('id') == false){
    header("location:?a=404");
}
?>
<?php $row = GetWithdrawWithId($_GET['id'],$conn);?>
<?php 
if (isset($_POST['withdraw'])) {
    $Approve=$_GET['id'];
    $status = $_POST['status'];
    $ema = $row['sender'];
    $bal = $_POST['balnce'];
    $old = GetUserBalance($row['sender'],$conn);
    if($status == '1' && ($row['status'] == '0' || $row['status'] == '-1')){
        $newbal = $old - $bal;
        $sql = "update user set balance = '$newbal' where email = '$ema'";
        $conn->query($sql);
    }
    if(($status == '0' && $row['status'] == '1') || ($status == '-1' && $row['status'] == '1')){
        $newbal = $old + $bal;
        $sql = "update user set balance = '$newbal' where email = '$ema'";
        $conn->query($sql);
    }
    $mysqli="UPDATE  withdraw SET status='$status' WHERE id='$Approve'";
    $update = "UPDATE transection  SET status='$status' WHERE approve_id='$Approve' AND method='Withdraw'";
    $conn->query($mysqli);
    if ($conn->query($update)){
        $_SESSION['withdraw_success'] = "Withdraw Updated Successfully!";
        header("location:?a=withdraw");
    }
    else{
        $_SESSION['withdraw_error'] = "Unable to Update Withdraw";
    }
}
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <?php include "include/sidenav.php";?>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="top-bar-title padding-bottom pull-left">Withdraw Details</div>
                            </div>
                            <div>
                                <h4 class="text-left">Status : 
                                    <?php if($row['status'] == '1'){?>
                                        <span class="text-green">Success</span> 
                                    <?php }else if($row['status'] == '0'){?>
                                        <span class="text-primary">Pending</span> 
                                    <?php }else if($row['status'] == '-1'){?>
                                        <span class="text-danger">Cancelled</span> 
                                    <?php }?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="my-30">
                    <div class="row">
                        <form action="#" class="form-horizontal"
                            id="deposit_form" method="POST">
                            <!-- Page title start -->
                            <div class="col-md-8 col-xl-9">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="mt-4 p-4 bg-secondary rounded shadow">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="user">User</label>
                                                        <input type="hidden" class="form-control" name="user"
                                                            value="Philips Jane">
                                                        <div class="col-sm-9">
                                                            <p class="form-control-static"><?php echo $row['sender'];?></p>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="control-label col-sm-3"
                                                            for="deposit_uuid">Transaction ID</label>
                                                        <input type="hidden" class="form-control" name="deposit_uuid"
                                                            value="A0845F222CD77">
                                                        <div class="col-sm-9">
                                                            <p class="form-control-static">A0845F222CD77</p>
                                                        </div>
                                                    </div> -->
                                                    <?php $r = GetPayoutWithId($row['details'],$conn);?>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3"
                                                            for="currency">Method</label>
                                                        <input type="hidden" class="form-control" name="currency"
                                                            value="USD">
                                                        <div class="col-sm-9">
                                                            <p class="form-control-static"><?php echo $r['type']?></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3"
                                                            for="payment_method">Withdraw Info</label>
                                                        <input type="hidden" class="form-control" name="payment_method"
                                                            value="FreedomPay Universe">
                                                        <div class="col-sm-9">
                                                            <p class="form-control-static"><?php echo $r['details'];?></p>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label class="control-label col-sm-3"
                                                            for="created_at">Date</label>
                                                        <input type="hidden" class="form-control" name="created_at"
                                                            value="2022-02-22 12:00:32">
                                                        <div class="col-sm-9">
                                                            <p class="form-control-static">22-02-2022 6:00 PM</p>
                                                        </div>
                                                    </div> -->

                                                    <div class="form-group">
                                                        <input type="hidden" value="<?php echo $row['price'];?>" name="balnce">
                                                        <label class="control-label col-sm-3" for="status">Change
                                                            Status</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="status"
                                                                style="width: 60%;">
                                                                <option value="1" <?php if($row['status'] == '1'){echo "selected";}?>>Success</option>
                                                                <option value="0" <?php if($row['status'] == '0'){echo "selected";}?>>Pending</option>
                                                                <option value="-1" <?php if($row['status'] == '-1'){echo "selected";}?>>Cancel</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-2"><a id="cancel_anchor"
                                                                    class="btn btn-theme-danger pull-left"
                                                                    href="withdraw.php">Cancel</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button type="submit" name="withdraw" class="btn btn-theme pull-right"
                                                                    id="deposits_edit">
                                                                    <i class="fa fa-spinner fa-spin"
                                                                        style="display: none;"></i> <span
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

                            <div class="col-md-4 col-xl-3">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="mt-4 p-4 bg-secondary rounded shadow">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-6"
                                                            for="amount">Amount</label>
                                                        <div class="col-sm-6">
                                                            <p class="form-control-static">$ <?php echo $row['price'];?></p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group total-deposit-feesTotal-space">
                                                        <label class="control-label col-sm-6" for="feesTotal">Fees
                                                            <span>
                                                                <small class="transactions-edit-fee">
                                                                    (0.00% + 0.00)
                                                                </small>
                                                            </span>
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <p class="form-control-static">$ 0.00</p>
                                                        </div>
                                                    </div>

                                                    <hr class="increase-hr-height">


                                                    <div class="form-group total-deposit-space">
                                                        <label class="control-label col-sm-6" for="total">Total</label>
                                                        <input type="hidden" class="form-control" name="total"
                                                            value="120000">
                                                        <div class="col-sm-6">
                                                            <p class="form-control-static">$ <?php echo $row['price'];?></p>
                                                        </div>
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
        </div>

        <?php include "include/footer.php";?>
        <div class="control-sidebar-bg"></div>
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
<?php include 'include/script.php';?>