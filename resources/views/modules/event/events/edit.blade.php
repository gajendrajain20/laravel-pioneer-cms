@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('event.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		@include('event::events.form', array('model' => $event))
	</div>

@stop
