<!-- build:js ../assets/js/core.min.js -->
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/PACE/pace.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/switchery/dist/switchery.min.js') }}"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<script src="{{ asset('/bower_components/infinity_admin/assets/js/library.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/assets/js/app.js') }}"></script>

<!-- endbuild -->
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/moment/moment.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/libs/bower/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/bower_components/infinity_admin/assets/js/fullcalendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
</script>
@yield('script')