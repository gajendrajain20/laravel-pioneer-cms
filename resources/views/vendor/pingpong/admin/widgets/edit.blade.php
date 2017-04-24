@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.widgets.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		
		
		@if($widget['module'] == 'custom')
			@include('admin::widgets.form', array('model' => $widget))
		@else
			@include('admin::widgets.articleCategory', array('model' => $widget))
		@endif
	</div>

@stop
