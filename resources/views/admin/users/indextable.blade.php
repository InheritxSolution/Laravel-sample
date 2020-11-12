@if(!$users->isEmpty())
<table class="table table-striped" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>{{ trans('string.profile') }}</th>
			<th>
				@include('layouts.sorting', ['base_link' => route('users.index'), 'page' => $users->currentPage(), 'order' => 'name', 'name' => trans('string.name')])
			</th>
			<th>
				@include('layouts.sorting', ['base_link' => route('users.index'), 'page' => $users->currentPage(), 'order' => 'email', 'name' => trans('string.email')])
			</th>
			<th>
				<a class="tbl_sort" href="{{ url()->current() }}?page={{ Request::get('page') }}&order={{ Request::get('order') }}&dir={{ (Request::get('dir') && Request::get('dir') == 'desc') ? 'asc' : 'desc' }}">
					{{ trans('string.member_since') }} 
					<i class="fa {{ Request::get('dir') && Request::get('dir') == 'desc' ? 'fa-sort-numeric-desc' : 'fa-sort-numeric-asc' }}"></i>
				</a>				
			</th>
			<th>{{ trans('string.action') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td style="text-align: center;">
				@if(!empty($user->profile_img))
				<img src="{{ url('/img/'.$user->profile_img) }}" class="img-circle">
				@else
				<img src="{{ asset('/bower_components/infinity_admin/assets/images/default-avatar.png') }}" class="img-circle">
				@endif
			</td>
			<td><a title="{{ trans('string.view') }}" href="{{ route('users.show', $user->id) }}"><?= (!empty($user->name)) ? $user->name : '-' ?></a></td>
			<td><?= (!empty($user->email)) ? $user->email : '-' ?></td>
			<td><?= (!empty($user->created_at)) ? $user->created_at->format('d M Y') : '-' ?></td>
			<td>
				<a title="{{ trans('string.edit') }}" href="{{ route('users.edit', $user->id) }}">
					<i class="fa fa-fw fa-edit"></i>
				</a>
				<a title="{{ trans('string.delete') }}" href="javascript:void(0)" class="btn-delete-submit" data-id="{{ 'delete-form-' . $user->id }}">
					<i class="fa fa-fw fa-trash"></i>
				</a>
				<form id="{{ 'delete-form-' . $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
					<input type="hidden" name="_method" value="DELETE" />
					{{ csrf_field() }}
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<p style="text-align: center">{{ trans('string.no_data_found') }}</p>
@endif

@if(!$users->isEmpty())
<div class="panel-footer">
	<div class="row">
		<div class="col-md-4">
			<div class="pull-left pagination-page-info">
				{{ trans('string.page') . ' ' . $users->currentPage() . ' ' . trans('string.of') . ' ' .  $users->lastPage() }}
			</div>
		</div>
		<div class="col-md-8">
			<div class="pull-right pagination-button">
				{{ $users->links() }}
			</div>
		</div>
	</div>
</div>
@endif