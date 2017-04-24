@extends($layout)

@section('content-header')
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.widgets.choose', 'Back') !!}</small>
	</h1>
@stop

@section('content')


	<div>
	@if(isset($module))
		@include('admin::widgets.articleCategory')
	@else
		@include('admin::widgets.form')
	@endif
	</div>

@stop
