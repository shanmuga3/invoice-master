<div class="main-header" data-background-color="purple">
	<!-- Logo Header -->
	<div class="logo-header">
		
		<a href="index.html" class="logo">
			<img src="{{ asset('images/logoazzara.svg') }}" alt="navbar brand" class="navbar-brand">
		</a>
		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon">
				<i class="fa fa-bars"></i>
			</span>
		</button>
		<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
		<div class="navbar-minimize">
			<button class="btn btn-minimize btn-rounded">
				<i class="fa fa-bars"></i>
			</button>
		</div>
	</div>
	<!-- End Logo Header -->

	<!-- Navbar Header -->
	<nav class="navbar navbar-header navbar-expand-lg">
		
		<div class="container-fluid">
			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<li class="nav-item toggle-nav-search hidden-caret">
					<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
						<i class="fa fa-search"></i>
					</a>
				</li>
				{{--
				<li class="nav-item dropdown hidden-caret">
					<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bell"></i>
						<span class="notification">4</span>
					</a>
					<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
						<li>
							<div class="dropdown-title">You have 4 new notification</div>
						</li>
						<li>
							<div class="notif-scroll scrollbar-outer">
								<div class="notif-center">
									<a href="#">
										<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
										<div class="notif-content">
											<span class="block">
												New user registered
											</span>
											<span class="time">5 minutes ago</span> 
										</div>
									</a>
									<a href="#">
										<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
										<div class="notif-content">
											<span class="block">
												Rahmad commented on Admin
											</span>
											<span class="time">12 minutes ago</span> 
										</div>
									</a>
									<a href="#">
										<div class="notif-img"> 
											<img src="../assets/img/profile2.jpg" alt="Img Profile">
										</div>
										<div class="notif-content">
											<span class="block">
												Reza send messages to you
											</span>
											<span class="time">12 minutes ago</span> 
										</div>
									</a>
									<a href="#">
										<div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
										<div class="notif-content">
											<span class="block">
												Farrah liked Admin
											</span>
											<span class="time">17 minutes ago</span> 
										</div>
									</a>
								</div>
							</div>
						</li>
						<li>
							<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
						</li>
					</ul>
				</li>
				--}}
				<li class="nav-item dropdown hidden-caret">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
						<div class="avatar-sm">
							<img src="{{ asset('images/profile.png') }}" alt="..." class="avatar-img rounded-circle">
						</div>
					</a>
					<ul class="dropdown-menu dropdown-user animated fadeIn">
						<li>
							<div class="user-box">
								<div class="avatar-lg"><img src="{{ asset('images/profile.png') }}" alt="image profile" class="avatar-img rounded"></div>
								<div class="u-text">
									<h4>Shanmuga</h4>
									<p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
								</div>
							</div>
						</li>
						<li>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">My Profile</a>
							<a class="dropdown-item" href="#">My Balance</a>
							<a class="dropdown-item" href="#">Inbox</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Account Setting</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Logout</a>
						</li>
					</ul>
				</li>
				
			</ul>
		</div>
	</nav>
	<!-- End Navbar -->
</div>

<!-- Sidebar -->
<div class="sidebar">
	
	<div class="sidebar-background"></div>
	<div class="sidebar-wrapper scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{ asset('images/profile.png') }}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							Shanmuga
							<span class="user-level">Administrator</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="#profile">
									<span class="link-collapse">My Profile</span>
								</a>
							</li>
							<li>
								<a href="#edit">
									<span class="link-collapse">Edit Profile</span>
								</a>
							</li>
							<li>
								<a href="#settings">
									<span class="link-collapse">Settings</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<ul class="nav">
				<li class="nav-item active">
					<a href="{{ route('admin.dashboard') }}">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
						<span class="badge badge-count"></span>
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section"> Invoice </h4>
				</li>
				<li class="nav-item">
					<a href="widgets.html">
						<i class="fas fa-desktop"></i>
						<p> Reports </p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->