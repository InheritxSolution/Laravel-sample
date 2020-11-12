@extends('layouts.app')

@section('title', '500 ' . trans('error.internal_server_error'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake">500</h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.internal_server_error') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.internal_server_error_msg') }}</h5>
</div>
@endsection