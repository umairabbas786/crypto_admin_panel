<?php
session_start();
ob_start();
include "include/conn.php";
include "include/functions.php";
?>
<?php 
if(isset($_POST['id'])){
    $id=$_POST['id'];
    if(SetCoolingPeriodStatus($id,0,$conn)){
        $_SESSION['success_cooling']="User Cooling Period Disabled Successfully";
    }
    else{
        $conn->error;
    }
}
?>
<?php
    if(isset($_POST['idd'])){
        $id = $_POST['idd'];
        if(SetCoolingPeriodStatus($id,1,$conn)){
            $_SESSION['success_cooling']="User Cooling Period Enabled Successfully";
        }
        else{
            $conn->error;
        }
    }
?>