<script src="{{ asset('/bower_components/infinity_admin/libs/bower/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/misc/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/smooth-scroll/dist/js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/counterup/jquery.counterup.min.js') }}"></script>

<script>
$(function () {
	$(window).on('load', function () {
		$(document.body).addClass('loading-done');
	});

	//= shrink and expand the navbar 
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > 50)
			$('.navbar').addClass('shrink');
		else
			$('.navbar').removeClass('shrink');
	});

	//= autoplay the video when the modal show up
	autoPlayYouTubeModal();

	//= equal columns height
	matchHeight('#states .col-inner');

	//= counterUp plugin
	$('.counterUp').counterUp({delay: 10, time: 1500});

	//= set the max-height property for .navbar-collapse
	$(window).on('load resize orientationchange', function () {
		$('.navbar-collapse').css('max-height', $(window).height() - $('.navbar').height());
	});

	$(document).on('click', '[data-toggle="collapse"]', function (e) {
		var $trigger = $(e.target);
		$trigger.is('[data-toggle="collapse"]') || ($trigger = $trigger.parents('[data-toggle="collapse"]'));
		var $target = $($trigger.attr('data-target'));
		if ($target.attr('id') === 'page-menu-collapse')
			$(document.body).toggleClass('navbar-collapse-show', !$trigger.hasClass('collapsed'))
	});

	//= initialize smooth scroll plugin
	smoothScroll.init({
		offset: 60,
		speed: 1000,
		updateURL: false
	});

	// initializing owlCarousel
	$("#owl-slider").owlCarousel({
		slideSpeed: 300,
		paginationSpeed: 400,
		singleItem: true,
		autoPlay: true
	});

	// initialize waypoints for section-headings
	$('.section-heading').waypoint(function (direction) {
		if (direction === 'down')
			$(this.element).addClass('fadeInUp');
		else
			$(this.element).removeClass('fadeInUp');
	}, {offset: '96%'});
});

autoPlayYouTubeModal = function () {
	$('#play-video').on("click", function () {
		var theModal = $(this).data("target"),
				videoSRC = $('#video-modal iframe').attr('src'),
				videoSRCauto = videoSRC + "?autoplay=1";
		$(theModal + ' iframe').attr('src', videoSRCauto);
		$(theModal + ' button.close').on("click", function () {
			$(theModal + ' iframe').attr('src', videoSRC);
		});
		$('.modal').on("click", function () {
			$(theModal + ' iframe').attr('src', videoSRC);
		});
	});
};

matchHeight = function (selector) {
	var height, max = 0, $selector = $(selector);
	$selector.each(function (index, item) {
		height = $(item).height();
		if (height > max)
			max = height;
	});
	$selector.height(max);
};
</script>