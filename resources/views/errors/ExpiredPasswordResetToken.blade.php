@extends('layouts.app')

@section('title', trans('error.expired_token_error'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake"><i class="fa fa-history"></i></h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.expired_token_error') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.expired_token_error_msg') }}</h5>
</div>
@endsection
