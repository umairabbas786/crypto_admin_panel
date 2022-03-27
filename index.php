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
    } elseif ($_GET['a'] === 'edit-transaction'){
        include "./src/edittransaction.php";
    }
    
    
    
    
    
    elseif ($_GET['a'] === 'login') {
        include "./src/login.php";
    } elseif ($_GET['a'] === 'concentrates') {
        include "./src/concentrates.php";
    } elseif ($_GET['a'] === 'vape-cartridges') {
        include "./src/vape-cartridges.php";
    } elseif ($_GET['a'] === 'store') {
        include "./src/store.php";
    } elseif ($_GET['a'] === 'edibles') {
        include "./src/edibles.php";
    } elseif ($_GET['a'] === 'pre-rolls') {
        include "./src/pre-rolls.php";
    } elseif ($_GET['a'] === 'logout') {
        include "./src/signout.php";
    } else{
        include "./src/404.php";
    }
}

?>