@extends($layout)

@section('content-header')
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.templates.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		@include('admin::templates.form')
	</div>

@stop
