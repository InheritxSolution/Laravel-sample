<section id="reviews">
	<div class="container">
        <div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="text-center">
					<img src="{{ asset('/bower_components/infinity_admin/assets/images/landing-page/talk-bubble.png') }}" alt="">
				</div>
				<div id="owl-slider" class="owl-carousel owl-theme">
					<div class="item">
						<p class="review-text">{{ trans('frontend.stj_q') }}</p>
						<h4 class="reviewer">{{ trans('frontend.stj') }}</h4>
					</div>

					<div class="item">
						<p class="review-text">{{ trans('frontend.bg_q') }}</p>
						<h4 class="reviewer">{{ trans('frontend.bg') }}</h4>
					</div>

					<div class="item">
						<p class="review-text">{{ trans('frontend.mz_q') }}</p>
						<h4 class="reviewer">{{ trans('frontend.mz') }}</h4>
					</div>
				</div><!-- #owl-slider -->
			</div><!-- /.col -->
        </div>
	</div><!-- .container -->
</section><!-- #reviews -->