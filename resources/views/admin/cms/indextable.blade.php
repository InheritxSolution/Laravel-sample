@if(!$cms->isEmpty())
<table class="table table-striped" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>
				@include('layouts.sorting', ['base_link' => route('cms.index'), 'page' => $cms->currentPage(), 'order' => 'type', 'name' => trans('string.type')])
			</th>
			<th>
				@include('layouts.sorting', ['base_link' => route('cms.index'), 'page' => $cms->currentPage(), 'order' => 'lang', 'name' => trans('string.lang')])
			</th>
			<th>{{ trans('string.action') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($cms as $cm)
		<tr>
			<td><?= (!empty($cm->type)) ? ucfirst(str_replace('_', ' ', $cm->type)) : '-' ?></td>
			<td><?= (!empty($cm->lang)) ? $cm->lang : '-' ?></td>
			<td>
				<a title="{{ trans('string.edit') }}" href="{{ route('cms.edit', $cm->id) }}">
					<i class="fa fa-fw fa-edit"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
	<p style="text-align: center">{{ trans('string.no_data_found') }}</p>
@endif

@if(!$cms->isEmpty())
<div class="panel-footer">
	<div class="row">
		<div class="col-md-4">
			<div class="pull-left pagination-page-info">
				{{ trans('string.page') . ' ' . $cms->currentPage() . ' ' . trans('string.of') . ' ' .  $cms->lastPage() }}
			</div>
		</div>
		<div class="col-md-8">
			<div class="pull-right pagination-button">
				{{ $cms->links() }}
			</div>
		</div>
	</div>
</div>
@endif