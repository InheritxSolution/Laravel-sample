@extends('layouts.app')

@section('title', trans('string.edit') . ' ' . trans('string.cms'))

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.edit') . ' ' . trans('string.cms') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<!-- form start -->
						{!! Form::model($cms, ['method' => 'PATCH', 'route' => ['cms.update', $cms->id]]) !!}
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group @if($errors->has('content')) has-error @endif">
										{!! Form::label('content', trans('string.content')) !!}
										{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('string.enter') . ' ' . trans('string.content'), 'style' => 'resize: none;', 'id' => 'content']) !!}
										@if($errors->has('content'))<span class="help-block">{!!$errors->first('content')!!}</span>@endif
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							{{ Form::submit(trans('string.update'), ['class' => 'btn btn-primary']) }}
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('content', {
		allowedContent: true,
		fullPage: true,
		language: "{{ App::getLocale() }}",
		height: "300px"
	});
</script>
@endsection