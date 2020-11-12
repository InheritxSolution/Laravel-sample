@extends('layouts.app')

@section('title', '503 ' . trans('error.under_maintenance'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake">503</h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.under_maintenance') }}</h5>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.under_maintenance_msg') }}</h5>
</div>
@endsection
