@extends('layouts.app')

@section('title', trans('message.reset_pass_msg'))

@section('without_login')
<div class="simple-page-form animated flipInY" id="reset-password-form">
	<h4 class="form-title m-b-xl text-center">{{ trans('message.reset_pass_msg') }}</h4>

	<form action="{{ route('password.request') }}" method="post" novalidate>
		{{ csrf_field() }}

		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
			<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('string.enter') . ' ' .trans('string.email') }}">
			@if ($errors->has('email'))
				<span class="help-block">
					{{ $errors->first('email') }}
				</span>
			@endif
		</div>
		<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
			<input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="{{ trans('string.enter') . ' ' .trans('string.password') }}">
			@if($errors->has('password'))
				<span class="help-block">
					{{ $errors->first('password') }}
				</span>
			@endif
		</div>
		<div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
			<input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('string.enter') . ' ' .trans('string.confirm_password') }}">
			@if($errors->has('password_confirmation'))
				<span class="help-block">
					{{ $errors->first('password_confirmation') }}
				</span>
			@endif
		</div>
		<input type="submit" class="btn btn-primary" value="{{ trans('message.reset_pass_msg') }}" />
	</form>
</div>
@endsection
