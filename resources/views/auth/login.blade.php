@extends('layouts.app')

@section('title', trans('string.login'))

@section('without_login')
<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">{{ trans('message.signin_msg') }}</h4>
	<form action="{{ route('login') }}" method="post" novalidate>
		{{ csrf_field() }}
		<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
			<input id="sign-in-email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('string.enter') . ' ' .trans('string.email') }}">
			@if ($errors->has('email'))
			<span class="help-block">
				{{ $errors->first('email') }}
			</span>
			@endif
		</div>

		<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
			<input id="sign-in-password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="{{ trans('string.enter') . ' ' .trans('string.password') }}">
			@if($errors->has('password'))
			<span class="help-block">
				{{ $errors->first('password') }}
			</span>
			@endif
		</div>

		<div class="form-group m-b-xl">
			<div class="checkbox checkbox-primary">
				<input type="checkbox" name="remember" id="keep_me_logged_in" {{ old('remember') ? 'checked' : '' }} />
				<label for="keep_me_logged_in">{{ trans('string.remember_me') }}</label>
			</div>
		</div>
		<input type="submit" class="btn btn-primary" value="{{ trans('string.signin') }}">
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p><a href="{{ route('password.request') }}">{{ trans('message.forgot_pass_msg') }}</a></p>
<!--	<p>
		<small>Don't have an account ?</small>
		<a href="signup.html">CREATE AN ACCOUNT</a>
	</p>-->
</div><!-- .simple-page-footer -->
@endsection