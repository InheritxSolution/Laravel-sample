@extends('layouts.app')

@section('title',trans('string.change_password'))

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.change_password') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<!-- form start -->
						<form action="{{ url('/change-password') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="PATCH" />
							<div class="form-group has-feedback {{ $errors->has('current_password') ? 'has-error' : '' }}">
								{!! Form::label('current_password', trans('string.current_password')) !!}
								<input type="password" class="form-control" id="current_password" placeholder="{{ trans('string.enter') . ' ' . trans('string.current_password') }}" name="current_password" value="{{ old('current_password') }}" />
								@if ($errors->has('current_password'))
									<span class="help-block">
										{{ $errors->first('current_password') }}
									</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
								{!! Form::label('new_password', trans('string.new_password')) !!}
								<input type="password" class="form-control" id="new_password" placeholder="{{ trans('string.enter') . ' ' . trans('string.new_password') }}" name="new_password" value="{{ old('new_password') }}" />
								@if ($errors->has('new_password'))
									<span class="help-block">
										{{ $errors->first('new_password') }}
									</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
								{!! Form::label('confirm_password', trans('string.confirm_password')) !!}
								<input type="password" class="form-control" id="confirm_password" placeholder="{{ trans('string.enter') . ' ' . trans('string.confirm_password') }}" name="confirm_password" value="{{ old('confirm_password') }}" />
								@if ($errors->has('confirm_password'))
									<span class="help-block">
										{{ $errors->first('confirm_password') }}
									</span>
								@endif
							</div>
							<button type="submit" class="btn btn-primary">{{ trans('string.update') }}</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection