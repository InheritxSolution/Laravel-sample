@extends('layouts.app')

@section('title', trans('message.reset_pass_msg'))

@section('without_login')
<div class="simple-page-form animated flipInY" id="reset-email-password-form">
	<h4 class="form-title m-b-xl text-center">{{ trans('message.reset_pass_msg') }}</h4>

	<form action="{{ route('password.email') }}" method="post" novalidate>
		{{ csrf_field() }}
		<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
			<input id="reset-password-email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('string.enter') . ' ' .trans('string.email') }}">
			@if ($errors->has('email'))
			<span class="help-block">
				{{ $errors->first('email') }}
			</span>
			@endif
		</div>
		<input type="submit" class="btn btn-primary" value="{{ trans('string.send_reset_pass_link') }}">
	</form>
</div><!-- #reset-password-form -->
@endsection
