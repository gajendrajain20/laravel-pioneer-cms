@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.templates.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		@include('admin::templates.form', array('model' => $template))
	</div>

@stop
