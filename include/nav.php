<header class="main-header">
			<!-- Logo -->
			<div class="full-width">
				<a href="index.php" class="logo">
					<span class="logo-mini"><b>NGS</b></span>
					<img src="https://newglobalswift.us/public/images/logos/1614196665_logo.png" width="180" height="59" class="company-logo">
				</a>
			</div>

			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="mobile-width">
					<a href="index.php" class="mobile-logo">
						<span class="logo-lg" style="font-size: 13px;"><b>New Global Swift</b></span>
					</a>
				</div>
				<div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">

                                <img src=uploads/userPic/default-image.png class="user-image" alt="User Image"
                                    style="width: 25px; height: 25px;"><!-- User image -->
                                <span class="hidden-xs"><?php $r = GetAdminDetails($_SESSION['admin'],$conn);echo $r['first_name'] .' '. $r['last_name'];?></span>
                            </a>

                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src=uploads/userPic/default-image.png class="img-circle" alt="User Image"
                                        style="width: 90px; height: 90px;">
                                    <p>
                                        <small>Email: <?php $r = GetAdminDetails($_SESSION['admin'],$conn);echo $r['email'];?></small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="?a=profile"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">

                                        <a href="?a=logout"
                                            class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
			</nav>
		</header>