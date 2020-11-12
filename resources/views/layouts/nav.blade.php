<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

	<!-- navbar header -->
	<div class="navbar-header">
		<button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
			<span class="sr-only">Toggle navigation</span>
			<span class="hamburger-box"><span class="hamburger-inner"></span></span>
		</button>

		<button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="zmdi zmdi-hc-lg zmdi-more"></span>
		</button>

<!--		<button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="zmdi zmdi-hc-lg zmdi-search"></span>
		</button>-->

		<a href="{{ route('home') }}" class="navbar-brand">
			<span class="brand-icon"><i class="fa fa-gg"></i></span>
			<span class="brand-name">{{ config('app.name') }}</span>
		</a>
	</div><!-- .navbar-header -->

	@php
		$back_link ="";
		$show_back_btn = "no";

		$current = url()->current();
		$currentArr = explode('/',$current);
		$last_segment = end($currentArr);

		if($last_segment == 'create' || $last_segment == 'edit') {

			if($last_segment == 'create') {
				array_pop($currentArr);
			} else {
				array_pop($currentArr);
				array_pop($currentArr);
			}
			
			$back_link = url('/').'/'.end($currentArr);			

			$show_back_btn = "yes";
		}		
	@endphp

	<div class="navbar-container container-fluid">
		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
				@if($show_back_btn == 'yes')
				<li class="hidden-float hidden-menubar-top">
					<a href="{{$back_link}}" id="main-back-arrow" role="button" class="hamburger hamburger--arrow is-active js-hamburger">
						<span class="hamburger-box"><span class="hamburger-inner"></span></span>
					</a>
				</li>
				@endif
				<li>
					<h5 class="page-title hidden-menubar-top hidden-float">@yield('title')</h5>
				</li>
			</ul>

<!--			<ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
				<li class="nav-item dropdown hidden-float">
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
						<i class="zmdi zmdi-hc-lg zmdi-search"></i>
					</a>
				</li>

				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-notifications"></i></a>
					<div class="media-group dropdown-menu animated flipInY">
						<a href="javascript:void(0)" class="media-group-item">
							<div class="media">
								<div class="media-left">
									<div class="avatar avatar-xs avatar-circle">
										<img src="{{ asset('/bower_components/infinity_admin/assets/images/221.jpg') }}" alt="">
										<i class="status status-online"></i>
									</div>
								</div>
								<div class="media-body">
									<h5 class="media-heading">John Doe</h5>
									<small class="media-meta">Active now</small>
								</div>
							</div>
						</a> .media-group-item 

						<a href="javascript:void(0)" class="media-group-item">
							<div class="media">
								<div class="media-left">
									<div class="avatar avatar-xs avatar-circle">
										<img src="{{ asset('/bower_components/infinity_admin/assets/images/205.jpg') }}" alt="">
										<i class="status status-offline"></i>
									</div>
								</div>
								<div class="media-body">
									<h5 class="media-heading">John Doe</h5>
									<small class="media-meta">2 hours ago</small>
								</div>
							</div>
						</a> .media-group-item 

						<a href="javascript:void(0)" class="media-group-item">
							<div class="media">
								<div class="media-left">
									<div class="avatar avatar-xs avatar-circle">
										<img src="{{ asset('/bower_components/infinity_admin/assets/images/207.jpg') }}" alt="">
										<i class="status status-away"></i>
									</div>
								</div>
								<div class="media-body">
									<h5 class="media-heading">Sara Smith</h5>
									<small class="media-meta">idle 5 min ago</small>
								</div>
							</div>
						</a> .media-group-item 

						<a href="javascript:void(0)" class="media-group-item">
							<div class="media">
								<div class="media-left">
									<div class="avatar avatar-xs avatar-circle">
										<img src="{{ asset('/bower_components/infinity_admin/assets/images/211.jpg') }}" alt="">
										<i class="status status-away"></i>
									</div>
								</div>
								<div class="media-body">
									<h5 class="media-heading">Donia Dyab</h5>
									<small class="media-meta">idle 5 min ago</small>
								</div>
							</div>
						</a> .media-group-item 
					</div>
				</li>

				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
					<ul class="dropdown-menu animated flipInY">
						<li><a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a></li>
						<li><a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Balance</a></li>
						<li><a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-phone-msg"></i>Connection<span class="label label-primary">3</span></a></li>
						<li><a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-info"></i>privacy</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:void(0)" class="side-panel-toggle" data-toggle="class" data-target="#side-panel" data-class="open" role="button"><i class="zmdi zmdi-hc-lg zmdi-apps"></i></a>
				</li>
			</ul>-->
		</div>
	</div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->