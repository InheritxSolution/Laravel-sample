@extends('layouts.app')

@section('title', '403 ' . trans('error.access_denied_forbidden'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake">403</h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.access_denied_forbidden') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.access_denied_forbidden_msg') }}</h5>
</div>
@endsection