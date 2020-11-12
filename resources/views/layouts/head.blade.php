<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" sizes="196x196" href="{{ asset('/bower_components/infinity_admin/assets/images/logo.png') }}">
	<title>
		@if(array_key_exists('title', View::getSections()))
			@yield('title') {{ ' - ' . config('app.name') }}
		@else
			{{ config('app.name') }}
		@endif
	</title>
	
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css') }}">
	<!-- build:css ../assets/css/app.min.css -->
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/libs/bower/switchery/dist/switchery.min.css') }}">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<link rel="stylesheet" href="{{ asset('/bower_components/flag-icon-css/css/flag-icon.min.css') }}">
	@if(array_key_exists('without_login', View::getSections()))
		<link rel="stylesheet" href="{{ asset('/bower_components/infinity_admin/assets/css/misc-pages.css') }}">
	@endif
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	@yield('style')
	<script src="{{ asset('/bower_components/infinity_admin/libs/bower/breakpoints.js/dist/breakpoints.min.js') }}"></script>
	<script>
		Breakpoints();
	</script>
</head>