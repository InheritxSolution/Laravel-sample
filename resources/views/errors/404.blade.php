<?php session_start(); ?>
@extends('layouts.app')

@section('title', '404 ' . trans('error.page_not_found'))
@section('without_login')
<div class="_error_panel">
	<h1 class="_error_title animated shake">404</h1>
	<h5 class="_error_msg animated slideInUp">{{ trans('error.page_not_found') }}</h5>
	<h6 class="_error_msg animated slideInUp">{{ trans('error.page_not_found_msg') }}</h6>
</div>
@endsection