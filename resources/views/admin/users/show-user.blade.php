@extends('layouts.app')

@section('title', trans('string.view_user'))

@section('content')
<div class="row">
	<!-- DOM dataTable -->
	<div class="col-md-12">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">{{ trans('string.view_user') }}</h4>
			</header><!-- .widget-header -->
			<hr class="widget-separator">
			<div class="widget-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.profile_image') }}</label>
									<div><img style="height:100px !important;width:100px !important;" class="img-circle" src="{{ (!empty($user->profile_img)) ? storageUrl($user->profile_img) : asset('/bower_components/infinity_admin/assets/images/default-avatar.png') }}" /></div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.name') }}</label>
									<div class="show-data">{{ (!empty($user->name)) ? $user->name : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.email') }}</label>
									<div class="show-data">{{ (!empty($user->email)) ? $user->email : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.username') }}</label>
									<div class="show-data">{{ (!empty($user->username)) ? $user->username : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.status') }}</label>
									<div class="show-data">{{ (!empty($user->status)) ? $user->status : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.member_since') }}</label>
									<div class="show-data">{{ (!empty($user->created_at)) ? $user->created_at->format('d M Y') : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('string.last_loggedin') }}</label>
									<div class="show-data">{{ (!empty($user->loggedin_at)) ? $user->loggedin_at->format('d M Y h:i:s A') : '-' }}</div>
								</div>
							</div>
						</div>
						<hr>
						<a href="{{ route('users.edit', $user->id) }}" class="btn mw-md btn-primary">{{ trans('string.edit_user') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
