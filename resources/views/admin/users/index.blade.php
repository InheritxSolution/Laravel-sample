@extends('layouts.app')

@section('title', trans('string.users'))

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.users') }}</h4>
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
							<div class="col-sm-3 col-xs-12 pull-left">
								<div class="form-group">
									<select id="pagination_filter" class="form-control pagination-filter-select">
										<option value="0">{{ trans('string.all') }}</option>
										<option value="user" {{(Request::get('filter') == 'user') ? 'selected' : ''}}>{{ trans('string.only_users') }}</option>
										<option value="admin" {{(Request::get('filter') == 'admin') ? 'selected' : ''}}>{{ trans('string.only_admins') }}</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3 col-xs-12 pull-right">
								<div class="form-group">
									{!! Form::text('search', null, ['class' => 'form-control', 'id' => 'pagination_search', 'placeholder' => trans('string.search')]) !!}
								</div>
							</div>
							@include('layouts.indextable_hidden', ['table' => 'users-table'])
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<div class="users-table">
						@include('admin.users.indextable')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
