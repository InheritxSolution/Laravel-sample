<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<!--head-->
	@include('layouts.head')
	
	@if(array_key_exists('without_login', View::getSections()))
		<body class="simple-page">
			<div id="back-to-home">
				<a href="{{ route('home') }}" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
			</div>
			@include('layouts.flash_message')
			<div class="simple-page-wrap">
				<div class="simple-page-logo animated swing">
					<a href="{{ route('home') }}">
						<span><i class="fa fa-gg"></i></span>
						<span>{{ config('app.name') }}</span>
					</a>
				</div><!-- logo -->
				@yield('without_login')
				<!-- <div class="pull-right">
					@include('layouts.lang')
				</div> -->
			</div>
			@include('layouts.footer_script')
		</body>
	@else
		<body class="menubar-left menubar-unfold menubar-light theme-primary">
			@include('layouts.flash_message')
			
			@include('layouts.nav')
			
			@include('layouts.sidebar')
			
			@include('layouts.search')
			
			<main id="app-main" class="app-main">
				<div class="wrap">
					<section class="app-content">
						@yield('content')
					</section>
				</div>
				@include('layouts.footer')
			</main>
			
			@include('layouts.sidePanel')

			@include('layouts.footer_script')
		</body>
	@endif
</html>