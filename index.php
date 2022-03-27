<?php
if (!isset($_GET['a'])) {
    include "./src/login.php";
}else {
    if ($_GET['a'] === 'home') {
        include "./src/home.php";
    } elseif ($_GET['a'] === 'stores') {
        include "./src/stores_location.php";
    } elseif ($_GET['a'] === 'flowers') {
        include "./src/flowers.php";
    } elseif ($_GET['a'] === 'login') {
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