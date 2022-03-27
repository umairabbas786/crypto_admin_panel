<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
if(CheckGet('id') == false){
    header("location:?a=404");
}
?>
<?php $row = GetUserWithId($_GET['id'],$conn);?>
<?php 
    if(isset($_POST['funduser'])){
        if(AddFundToUserWallet($row['email'],$_POST['amount'],$conn)){
            $_SESSION['success'] = "User Funded Successfully";
            header("location:?a=user");
        }
        else{
            $_SESSION['error'] = "Unable to Fund User";
        }
    }

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper_custom">
        <?php include "include/nav.php";?>

        <!-- Flash Message  -->
        <div class="flash-container">
            <div class="alert alert-success text-center" id="success_deposit" style="margin-bottom:0px;display:none;"
                role="alert">
                <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                <p id="success_deposit"></p>
            </div>
        </div>
        <!-- /.Flash Message  -->

        <?php include "include/sidenav.php";?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="panel-body">
                        <ul class="nav nav-tabs cus" role="tablist">
                            <li class="active">
                                <a href='?a=edit-user&id=<?php echo $_GET['id'];?>'>Profile</a>
                            </li>
                            <li>
                                <a href="?a=user-transaction&id=<?php echo $_GET['id'];?>">Transactions</a>
                            </li>
                            <li>
                                <a href="?a=user-wallet&id=<?php echo $_GET['id'];?>">Wallets</a>
                            </li>
                            <li>
                                <a href="?a=user-ticket&id=<?php echo $_GET['id'];?>">Tickets</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3><?php echo $row['username'];?></h3>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <div class="pull-right">
                            <button style="margin-top: 15px;" type="button"
                                class="pull-right btn btn-theme active">Deposit</button>
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
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Amount</label>
                                                            <input type="text" class="form-control amount" name="amount"
                                                                placeholder="0.00" type="text" id="amount"
                                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                                value="" oninput="restrictNumberToPrefdecimal(this)">
                                                            <span class="amountLimit"
                                                                style="color: red;font-weight: bold"></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="col-md-5">
                                                        <a href="?a=edit-user&id=<?php echo $_GET['id'];?>"
                                                            class="btn btn-theme-danger"><span><i
                                                                    class="fa fa-angle-left"></i>&nbsp;Back</span></a>
                                                        <button type="submit" name="funduser" onclick="return confirm('Are you sure you want to deposit?');" class="btn btn-theme" id="deposit-create">
                                                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                            <span id="deposit-create-text">Deposit&nbsp;</span>
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