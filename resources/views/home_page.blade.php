@extends('layouts.frontend.app')

@section('content')
	@include('layouts.frontend.header')

	@include('layouts.frontend.video-modal')

	@include('layouts.frontend.features')

	@include('layouts.frontend.brief')

	@include('layouts.frontend.states')

	@include('layouts.frontend.subscribe')

	@include('layouts.frontend.price')

	@include('layouts.frontend.reviews')

	@include('layouts.frontend.footer')
@endsection