@extends('layouts.app')

@section('title', trans('string.cms'))

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.cms') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-3 col-xs-12 pull-left">
								<div class="form-group">
									<select id="pagination_row" class="form-control pagination-rows-select">
										@foreach(config('params.pagination.rows') as $row)
										<option value="{{$row}}" {{(Request::get('row') == $row) ? 'selected' : ''}}>{{$row}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-3 col-xs-12 pull-right">
								<div class="form-group">
									{!! Form::text('search', null, ['class' => 'form-control', 'id' => 'pagination_search', 'placeholder' => trans('string.search')]) !!}
								</div>
							</div>
							@include('layouts.indextable_hidden', ['table' => 'cms-table'])
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<div class="cms-table">
						@include('admin.cms.indextable')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
