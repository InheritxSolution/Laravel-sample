@extends('layouts.app')

@section('title',trans('string.edit_profile'))

@section('style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.3/cropper.css">
	<link rel="stylesheet" href="{{ asset('/css/crop_img.css') }}">
@endsection

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.edit_profile') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<!-- form start -->
						{!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@updateProfile'], 'files'=> true]) !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{!! Form::label('name', trans('string.name')) !!}
									{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('string.enter') . ' ' . trans('string.name')]) !!}
									@if ($errors->has('name'))
										<span class="help-block">
											{{$errors->first('name')}}
										</span>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									{!! Form::label('email', trans('string.email')) !!}
									{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('string.enter') . ' ' . trans('string.email')]) !!}
									@if ($errors->has('email'))
										<span class="help-block">
											{{$errors->first('email')}}
										</span>
									@endif
								 </div>
							</div>
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
									{!! Form::label('contact_number', trans('string.contact_number')) !!}
									{!! Form::text('contact_number', null, ['class' => 'form-control', 'placeholder' => trans('string.enter') . ' ' . trans('string.contact_number')]) !!}
									@if ($errors->has('contact_number'))
										<span class="help-block">
											{{$errors->first('contact_number')}}
										</span>
									@endif
								 </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('profile_img') ? 'has-error' : '' }}">
									{!! Form::label('profile_img', trans('string.profile_image')) !!}
									{{ Form::file('profile_img', ['class' => 'file', 'id' => 'profile_img', 'accept' => 'image/png,image/jpeg']) }}
									@if ($errors->has('profile_img'))
										<span class="help-block">
											{{$errors->first('profile_img')}}
										</span>
									@endif

									@if($user->profile_img)
										<img src="{{ url('/img').'/'.$user->profile_img }}" width="30%" height="30%" style="margin-top: 10px;"/>
									@endif

									{{ Form::hidden('profile_img_thumb', '', ['id' => 'profile_img_thumb']) }}
								 </div>
							</div>
							<div class="col-md-6">
								@include('layouts.crop')
							</div>
						</div>
						{{ Form::submit(trans('string.update'), ['class' => 'btn btn-primary']) }}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.3/cropper.js"></script>
	<script src="{{ asset('/js/crop_img.js') }}"></script>
@endsection