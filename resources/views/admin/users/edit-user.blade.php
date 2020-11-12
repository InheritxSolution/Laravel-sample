@extends('layouts.app')

@section('title', trans('string.edit_user'))

<?php
$status_type = array_flip(config('params.status'));
?>

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.edit_user') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<!-- form start -->
						{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}

						<div class="row">
							<div class="col-md-12">
								<div class="form-group @if($errors->has('name')) has-error @endif">
									{!! Form::label('name', trans('string.name')) !!}
									{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('string.enter') . ' ' . trans('string.name')]) !!}
									@if ($errors->has('name'))<span class="help-block">{!!$errors->first('name')!!}</span>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group @if($errors->has('status')) has-error @endif">
									<label>{{ trans('string.status') }}</label>
									<div id="user_status_checkbox">
										<input class="user_status" data-switchery="true" value="{{ strtolower($user->status) }}" name="status" {{ (strtolower($user->status) == $status_type[1]) ? 'checked="checked"' : '' }} type="checkbox" id="button_toggle">
									</div>
									@if ($errors->has('status'))<span class="help-block">{!!$errors->first('status')!!}</span>@endif
								</div>
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
<script type="text/javascript">
	$(".user_status").change(function () {
		if(this.checked)
		{
			$(this).val('{{ $status_type[1] }}');
			$("#user_status_checkbox span").attr('title', 'Active');
		}
		else
		{
			$(this).val('{{ $status_type[0] }}');
			$("#user_status_checkbox span").attr('title', 'Inactive');
		}
	});
</script>
@endsection
