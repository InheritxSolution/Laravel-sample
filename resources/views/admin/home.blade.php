@extends('layouts.app')

@section('title', trans('string.dashboard'))

@section('content')
	@include('layouts.flash_message')
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<a href="{{ route('users.index', ['filter' => 'user']) }}">
				<div class="widget p-md clearfix">
					<div class="pull-left">
						<h3 class="widget-title">{{ trans('string.users') }}</h3>
					</div>
					<span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp">{{ number_format($total_users) }}</span>
				</div><!-- .widget -->
			</a>
		</div>

		<div class="col-md-6 col-sm-6">
			<a href="{{ route('users.index', ['filter' => 'admin']) }}">
				<div class="widget p-md clearfix">
					<div class="pull-left">
						<h3 class="widget-title">{{ trans('string.admins') }}</h3>
					</div>
					<span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp">{{ number_format($total_admins) }}</span>
				</div><!-- .widget -->
			</a>
		</div>
	</div><!-- .row -->
@endsection