<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>
<?php 
    $sql = "select price from fees where method = 'deposit' and gateway = 'coin'";
    $row1 = mysqli_fetch_assoc($conn->query($sql));
    $coin = $row1['price'];
    $sql = "select price from fees where method = 'deposit' and gateway = 'stripe'";
    $row1 = mysqli_fetch_assoc($conn->query($sql));
    $stripe = $row1['price'];
    $sql = "select price from fees where method = 'deposit' and gateway = 'paypal'";
    $row1 = mysqli_fetch_assoc($conn->query($sql));
    $paypal = $row1['price'];
    $sql = "select price from fees where method = 'transfer' and gateway = 'no'";
    $row1 = mysqli_fetch_assoc($conn->query($sql));
    $transfer = $row1['price'];
    $sql = "select price from fees where method = 'withdraw' and gateway = 'btc'";
    $row1 = mysqli_fetch_assoc($conn->query($sql));
    $withdraw = $row1['price'];
    if(isset($_POST['fee'])){
        $coin = $_POST['coin'];
        $stripe = $_POST['stripe'];
        $paypal = $_POST['paypal'];
        $transfer = $_POST['transfer'];
        $withdraw = $_POST['withdraw'];
        $sql = "update fees set price = '$coin' where method = 'deposit' and gateway = 'coin'";
        $conn->query($sql);
        $sql = "update fees set price = '$stripe' where method = 'deposit' and gateway = 'stripe'";
        $conn->query($sql);
        $sql = "update fees set price = '$paypal' where method = 'deposit' and gateway = 'paypal'";
        $conn->query($sql);
        $sql = "update fees set price = '$transfer' where method = 'transfer' and gateway = 'no'";
        $conn->query($sql);
        $sql = "update fees set price = '$withdraw' where method = 'withdraw' and gateway = 'btc'";
        $r = $conn->query($sql);
        if($r){
            $_SESSION['success_fee'] = "Fees Updated Successfully";
            header("location:?a=fee");
        }
        else{
            $_SESSION['error_fee'] = "Unable to Update Fees";
        }
    }

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
        <?php if(isset($_SESSION['success_fee'])){?>
            <div class="alert alert-success text-center" id="success_message_div"
                style="margin-bottom:0px;" role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_message"><?php echo $_SESSION['success_fee'];?></p>
            </div>
        <?php }?>
        <?php if(isset($_SESSION['error_fee'])){?>
            <div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;"
                role="alert">
                <p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
                <p id="error_message"><?php echo $_SESSION['error_fee'];?></p>
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
                                <div class="top-bar-title padding-bottom pull-left">Fees</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box mt-20">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <form action="#"
                                            method="post" accept-charset='UTF-8' id="admin-user-deposit-create">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <h3>Deposit Fee</h3>
                                                        <div class="form-group">
                                                            <label for="">Coin Payments</label>
                                                            <input type="text" class="form-control amount" name="coin"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="<?php echo $coin;?>" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Stripe</label>
                                                            <input type="text" class="form-control amount" name="stripe"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="<?php echo $stripe;?>" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Paypal</label>
                                                            <input type="text" class="form-control amount" name="paypal"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="<?php echo $stripe;?>" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <h3>Transfer Fee</h3>
                                                        <div class="form-group">
                                                            <label for="">Wallet Transfer</label>
                                                            <input type="text" class="form-control amount" name="transfer"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="<?php echo $transfer;?>" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <h3>Withdraw Fee</h3>
                                                        <div class="form-group">
                                                            <label for="">Payout</label>
                                                            <input type="text" class="form-control amount" name="withdraw"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="<?php echo $withdraw;?>" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="col-md-5">
                                                        <a href="?a=home"
                                                            class="btn btn-theme-danger"><span><i
                                                                    class="fa fa-angle-left"></i>&nbsp;Back</span></a>
                                                        <button type="submit" name="fee" onclick="return confirm('Are you sure you want to update fee?');" class="btn btn-theme" id="deposit-create">
                                                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                            <span id="deposit-create-text">Save Changes&nbsp;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
        function restrictNumberToPrefdecimal(e) {
            let decimaFormat = '2';
            let num = $.trim(e.value);
            if (num.length > 0 && !isNaN(num)) {
                switch (decimaFormat) {
                    case '1':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '2':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '3':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '4':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '5':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '6':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '7':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                    case '8':
                        e.value = digitCheck(num, 8, decimaFormat);
                        break;
                }
                return e.value;
            }
        }

        function digitCheck(num, beforeDecimal, afterDecimal) {
            return num.replace(/[^\d.]/g, '')
                .replace(new RegExp("(^[\\d]{" + beforeDecimal + "})[\\d]", "g"), '$1')
                .replace(/(\..*)\./g, '$1')
                .replace(new RegExp("(\\.[\\d]{" + afterDecimal + "}).", "g"), '$1');
        }
    </script>
    <script type="text/javascript">
        $(".select2").select2({});

        $('#admin-user-deposit-create').validate({
            rules: {
                amount: {
                    required: true,
                },
            },
        });
    </script>
    <?php include 'include/script.php';?>