<?php include "include/header.php";include "include/functions.php"?>
<?php 
if(Sessionset('admin') == false){
	header("location:?a=login");
}
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper_custom">
		<?php include "include/nav.php";?>
		<!-- Flash Message  -->
		<div class="flash-container">
			<div class="alert alert-success text-center" id="success_message_div"
				style="margin-bottom:0px;display:none;" role="alert">
				<a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
				<p id="success_message"></p>
			</div>

			<div class="alert alert-danger text-center" id="error_message_div" style="margin-bottom:0px;display:none;"
				role="alert">
				<p><a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a></p>
				<p id="error_message"></p>
			</div>
		</div>
		<!-- /.Flash Message  -->

		<?php include "include/sidenav.php";?>

		<div class="content-wrapper">
			<!-- Main content -->
			<section class="content">
				<section class="content">

					<div class="row">
						<div class="col-md-3">
							<!-- small box -->
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3><?php echo GetTotalUsers($conn);?></h3>
									<p>Total Users</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="?a=user" class="small-box-footer">More info <i
										class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-md-3">
							<!-- small box -->
							<div class="small-box bg-red">
								<div class="inner">
									<h3>$ <?php echo round(GetUsersBalance($conn),2);?></h3>
									<p>Total User Balance</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="?a=user" class="small-box-footer">More info <i
									class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-md-3">
							<!-- small box -->
							<div class="small-box bg-aqua">
								<div class="inner">
									<h3><?php echo GetTotalTickets($conn);?></h3>
									<p>Total Tickets</p>
								</div>
								<div class="icon">
									<i class="fa fa-envelope-o"></i>
								</div>
								<a href="?a=ticket" class="small-box-footer">More info <i
										class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-md-3">
							<!-- small box -->
							<div class="small-box bg-green">
								<div class="inner">
									<h3><?php echo KycRequests($conn);?></h3>
									<p>Total Kyc Requests</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="?a=identity-kyc" class="small-box-footer">More info <i
										class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="box box-info">
								<div class="box-header text-center">
									<h4 class="text-info text-justify"><b>Latest Ticket</b></h4>
								</div>
								<div class="box box-body">
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead class="text-left">
												<tr>
													<th>Subject</th>
													<th>User</th>
													<th>Priority</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$sql = "select * from ticket order by id desc limit 5";
													$r = $conn->query($sql);
													while($row = mysqli_fetch_assoc($r)){
												?>
												<tr class="text-left">
													<td style="width: 35%;"><a href='?a=ticket-reply&id=<?php echo $row['id'];?>'><?php echo $row['subject'];?></a></td>
													<td style="width: 20%;"><?php echo $row['owner']?></td>
													<td style="width: 10%;"><?php echo $row['type']?></td>
													<td style="width: 20%;"><?php echo $row['date']?></td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-4">
							<div class="box box-info">
								<div class="box-header">
									<div style="font-weight:bold; font-size:20px;" class="text-info">
										Wallet Balance
									</div>
								</div>
								<div class="box box-body">


									<div style="min-height:45px;border-bottom: 1px solid gray;padding: 5px 0px;">
										<div style="width:60%;float: left;">
											<div style="min-height: 25px;">USD</div>
											<div class="clearfix"></div>
											<div class="clearfix"></div>
										</div>
										<div style="width:40%;float: left;text-align: right;">
											136,208.74
										</div>
									</div>
									<div class="clearfix"></div>

									<div style="min-height:45px;border-bottom: 1px solid gray;padding: 5px 0px;">
										<div style="width:60%;float: left;">
											<div style="min-height: 25px;">EUR</div>
											<div class="clearfix"></div>
											<div class="clearfix"></div>
										</div>
										<div style="width:40%;float: left;text-align: right;">
											3.63
										</div>
									</div>
									<div class="clearfix"></div>

									<div style="min-height:45px;border-bottom: 1px solid gray;padding: 5px 0px;">
										<div style="width:60%;float: left;">
											<div style="min-height: 25px;">USD TDF</div>
											<div class="clearfix"></div>
											<div class="clearfix"></div>
										</div>
										<div style="width:40%;float: left;text-align: right;">
											8,754,628.91
										</div>
									</div>
									<div class="clearfix"></div>

								</div>
							</div>
						</div> -->
					</div>
				</section>
			</section>
		</div>

		<?php include "include/footer.php";?>
		<div class="control-sidebar-bg"></div>
	</div>
	<?php unset($_SESSION['success_news']);?>
	<?php unset($_SESSION['error_news']);?>
	<?php UnsetSession('success_fee');?>
	<?php include "include/script.php";?>