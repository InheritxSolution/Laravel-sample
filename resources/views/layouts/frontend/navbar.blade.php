<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">

        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#page-menu-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand animated" href="#">
				<i class="brand-icon fa fa-gg"></i>
				<span class="brand-name">{{ config('app.name') }}</span>
			</a>
        </div><!-- .navbar-header -->

        <div class="navbar-collapse collapse" id="page-menu-collapse">
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li><a data-scroll href="#header">{{ trans('frontend.home') }}</a></li>
					<li><a data-scroll href="#features">{{ trans('frontend.features') }}</a></li>
					<li><a data-scroll href="#brief">{{ trans('frontend.brief') }}</a></li>
					<li><a data-scroll href="#states">{{ trans('frontend.numbers') }}</a></li>
					<li><a data-scroll href="#subscribe">{{ trans('frontend.news_letter') }}</a></li>
					<li><a data-scroll href="#price">{{ trans('frontend.pricing') }}</a></li>
					<li><a data-scroll href="#reviews">{{ trans('frontend.clients') }}</a></li>
					<li>
						<div style="padding: 20px 15px;">
							@include('layouts.lang')
						</div>
					</li>
				</ul>
			</div>
        </div><!-- .navbar-collapse -->

	</div><!-- .container -->
</nav>