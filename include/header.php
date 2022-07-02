<?php 
session_start();
ob_start();
include "include/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="MTS">
	<title>Admin Panel</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="hxU7GQmIVE8pnmrmEMPlgdVdvzCDtLrexjpl1w0f"><!-- for ajax -->
	<!---favicon-->
	<link rel="shortcut icon" href="images/logos/1635957421_favicon.png" />
	<!-- Select2 -->
	<link rel="stylesheet" type="text/css" href="backend/select2/select2.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="backend/font-awesome/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="dist/css/AdminLTE.css">
	<!-- Skins -->
	<link rel="stylesheet" type="text/css" href="dist/css/skins/_all-skins.min.css">
	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="backend/DataTables_latest/DataTables-1.10.18/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="backend/DataTables_latest/Responsive-2.2.2/css/responsive.dataTables.min.css">
	<!-- wysihtml5 -->
	<link rel="stylesheet" type="text/css" href="backend/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- custom styles -->
	<link rel="stylesheet" type="text/css" href="dist/css/styles.css">
	<!-- jQuery 3.2.1 -->
	<script src="backend/jquery/dist/jquery.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" type="text/css" href="backend/bootstrap/dist/css/bootstrap.css">
	<link href="dist/css/lightbox.css" rel="stylesheet">

</head>