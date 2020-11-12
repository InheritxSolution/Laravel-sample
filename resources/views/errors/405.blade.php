@extends('layouts.app')

@section('title', '405 ' . trans('error.method_not_allowed'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake">405</h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.method_not_allowed') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.method_not_allowed_msg') }}</h5>
</div>
@endsection
