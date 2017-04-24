@extends($layout)

@section('content-header')
	
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.positions.index', 'Back') !!}</small>
	</h1>
	
@stop

@section('content')
	
	<div>
		@include('admin::positions.form', array('model' => $position))
	</div>

@stop
