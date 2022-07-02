<?php
if (!isset($_GET['a'])) {
    include "./src/login.php";
}else {
    if ($_GET['a'] === 'home') {
        include "./src/home.php";
    } elseif ($_GET['a'] === 'user') {
        include "./src/user.php";
    } elseif ($_GET['a'] === 'ticket') {
        include "./src/ticket.php";
    } elseif ($_GET['a'] === 'identity-kyc'){
        include "./src/identity_verification.php";
    } elseif ($_GET['a'] === 'admin'){
        include "./src/admin.php";
    } elseif ($_GET['a'] === 'transaction'){
        include "./src/transaction.php";
    } elseif ($_GET['a'] === 'deposit'){
        include "./src/deposit.php";
    } elseif ($_GET['a'] === 'withdraw'){
        include "./src/withdraw.php";
    } elseif ($_GET['a'] === 'transfer'){
        include "./src/transfers.php";
    } elseif ($_GET['a'] === 'coolingperiod'){
        include "./src/coolingperiod.php";
    } elseif ($_GET['a'] === 'news'){
        include "./src/news.php";
    } elseif ($_GET['a'] === 'activity'){
        include "./src/activity.php";
    } elseif ($_GET['a'] === 'address-kyc'){
        include "./src/address_verification.php";
    } elseif ($_GET['a'] === 'ticket-reply'){
        include "./src/ticketreply.php";
    } elseif ($_GET['a'] === 'edit-user'){
        include "./src/edituser.php";
    } elseif ($_GET['a'] === 'user-transaction'){
        include "./src/usertransaction.php";
    } elseif ($_GET['a'] === 'user-wallet'){
        include "./src/userwallet.php";
    } elseif ($_GET['a'] === 'user-ticket'){
        include "./src/userticket.php";
    } elseif ($_GET['a'] === 'fund-user'){
        include "./src/funduser.php";
    } elseif ($_GET['a'] === 'payout-user'){
        include "./src/payoutuser.php";
    } elseif ($_GET['a'] === 'edit-transaction'){
        include "./src/edittransaction.php";
    } elseif ($_GET['a'] === 'edit-admin'){
        include "./src/editadmin.php";
    } elseif ($_GET['a'] === 'add-admin'){
        include "./src/addadmin.php";
    } elseif ($_GET['a'] === 'edit-identity-kyc'){
        include "./src/editidentityverification.php";
    } elseif ($_GET['a'] === 'edit-address-kyc'){
        include "./src/editaddressverification.php";
    } elseif ($_GET['a'] === 'login'){
        include "./src/login.php";
    } elseif ($_GET['a'] === '404'){
        include "./src/404.php";
    } elseif ($_GET['a'] === 'edit-cooling'){
        include "./src/enable_disable_cooling_period.php";
    } elseif ($_GET['a'] === 'edit-deposit') {
        include "./src/editdeposit.php";
    } elseif ($_GET['a'] === 'edit-withdraw') {
        include "./src/editwithdraw.php";
    } elseif ($_GET['a'] === 'edit-transfer') {
        include "./src/edittransfers.php";
    } elseif ($_GET['a'] === 'fee') {
        include "./src/fees.php";
    }
}

?>