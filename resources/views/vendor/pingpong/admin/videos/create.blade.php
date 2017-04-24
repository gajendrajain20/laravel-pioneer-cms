@extends($layout)

@section('content-header')
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.videos.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		@include('admin::videos.form')
	</div>

@stop
