@extends('layouts.app')

@section('title', trans('message.reset_pass_success'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake"><i class="fa fa-key"></i></h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('message.success') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('message.reset_pass_success') }}</h5>
</div>
@endsection

