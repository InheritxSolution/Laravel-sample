<!DOCTYPE html>
<html lang="en">
	@include('layouts.frontend.head')
	<body data-spy="scroll" data-target=".navbar-fixed-top" data-offset="60">
		<div class="wrapper">
			@include('layouts.frontend.navbar')

			@yield('content')

			@include('layouts.frontend.copyright')
		</div>
		@include('layouts.frontend.loading')

		@include('layouts.frontend.footerscript')
	</body>
</html>