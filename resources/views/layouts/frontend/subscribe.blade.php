<section id="subscribe">
	<div class="container">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="text-center">
					<h2 class="section-heading animated">{{ trans('frontend.subscribe') }}</h2>
					<p class="section-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt accusantium est illum ratione corporis?</p>
				</div>
			</div><!-- /.col -->
        </div><!-- .row -->

        <div class="subs-form">
			<form action="#" class="form-horizontal">
				<div class="col-md-4">
					<div class="control-wrap">
						<input type="text" class="form-control" placeholder="{{ trans('frontend.your_name') }}">
						<img src="{{ asset('/bower_components/infinity_admin/assets/svg/users.svg') }}" alt="">
					</div>
				</div><!-- /.col -->

				<div class="col-md-4">
					<div class="control-wrap">
						<input type="text" class="form-control" placeholder="{{ trans('frontend.your_email') }}">
						<img src="{{ asset('/bower_components/infinity_admin/assets/svg/email.svg') }}" alt="">
					</div>
				</div><!-- /.col -->

				<div class="col-md-4">
					<input type="submit" value="{{ trans('frontend.subscribe_now') }}" class="btn btn-block btn-primary">
				</div><!-- /.col -->
			</form>
        </div>
	</div><!-- .container -->
</section><!-- #subscribe -->