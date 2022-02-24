<!-- sidebar -->
<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu mt-20">
					<li class="active">
						<a href="index.php">
							<i class="fa fa-dashboard"></i><span>Dashboard</span>
						</a>
					</li>
					<!--users-->
					<li treeview>
						<a href="#">
							<i class="glyphicon glyphicon-user"></i><span>Users</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="user.php">
									<i class="fa fa-user-circle-o"></i><span>Users</span>
								</a>
							</li>
							<li>
								<a href="admin.php">
									<i class="fa fa-user-md"></i><span>Admins</span>
								</a>
							</li>
						</ul>
					</li>

					<li treeview>
						<a href="#">
							<svg id="e1WnpxAjyv41" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" width="16" class="svgicon"
								stroke="currentColor" viewBox="0 -20 512 512" shape-rendering="geometricPrecision"
								text-rendering="geometricPrecision">
								<path id="e1WnpxAjyv42" stroke-width="2"
									d="M452,0L60,0C26.914062,0,0,26.914062,0,60L0,412C0,445.085938,26.914062,472,60,472L452,472C485.085938,472,512,445.085938,512,412L512,60C512,26.914062,485.085938,0,452,0ZM60,40L452,40C463.027344,40,472,48.972656,472,60L472,120L40,120L40,60C40,48.972656,48.972656,40,60,40ZM452,432L60,432C48.972656,432,40,423.027344,40,412L40,160L472,160L472,412C472,423.027344,463.027344,432,452,432ZM70,80C70,68.953125,78.953125,60,90,60C101.046875,60,110,68.953125,110,80C110,91.046875,101.046875,100,90,100C78.953125,100,70,91.046875,70,80ZM140,80C140,68.953125,148.953125,60,160,60C171.046875,60,180,68.953125,180,80C180,91.046875,171.046875,100,160,100C148.953125,100,140,91.046875,140,80ZM346.640625,185.859375L416.785156,256L346.640625,326.140625L318.359375,297.859375L340.214844,276L235,276L235,236L340.214844,236L318.359375,214.140625ZM171.785156,316L275,316L275,356L171.785156,356L193.640625,377.859375L165.359375,406.140625L95.214844,336L165.359375,265.859375L193.640625,294.140625ZM171.785156,316">
								</path>
							</svg>
							<span>Transactions</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
						</a>
						<ul class="treeview-menu">
							<!-- transactions -->
							<li>
								<a href="transaction.php"><i class="fa fa-history"></i><span>All
										Transactions</span></a>
							</li>
							<!-- deposits -->
							<li>
								<a href="deposit.php"><i class="fa fa-arrow-down"></i><span>Deposits</span></a>
							</li>

							<!-- Payouts -->
							<li>
								<a href="withdraw.php"><i class="fa fa-arrow-up"></i><span>Withdrawals</span></a>
							</li>

							<!-- transfers -->
							<li>
								<a href="transfers.php"><i class="fa fa-exchange"></i><span>Transfers</span></a>
							</li>
						</ul>
					</li>

					<!-- revenues -->
					<li>
						<a href="#"><i class="fa fa-book"></i><span>Revenues</span></a>
					</li>

					<!-- Tickets -->
					<li>
						<a href="ticket.php"><i class="fa fa-spinner"></i><span>Tickets</span></a>
					</li>

					<!-- activity_logs -->
					<li>
						<a href="activity.php"><i class="fa fa-eye"></i><span>Activity Logs</span></a>
					</li>

					<!--verifications-->
					<li treeview>
						<a href="#">
							<i class="glyphicon glyphicon-check"></i><span>Verifications</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="identity_verification.php">
									<i class="fa fa-user-circle-o"></i><span>Identity Verification</span>
								</a>
							</li>

							<li>
								<a href="address_verification.php">
									<i class="fa fa-address-book"></i><span>Address Verification</span>
								</a>
							</li>
						</ul>
					</li>

					<p class="pl-4 configuration">Configurations</p>
					<!-- Currencies & Fees -->
					<li>
						<a href="#"><i class="fa fa-money"></i><span>Currencies</span></a>
					</li>

					<!-- settings -->
					<li class="treeview">
						<a href="#">
							<i class="fa fa-wrench"></i><span>Settings</span>
							<span class="pull-right-container"></span>
						</a>
					</li>
				</ul>
			</section>
		</aside>