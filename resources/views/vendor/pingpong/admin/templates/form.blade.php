@extends($layout)

@section('content-header')
	<h1>
	Templates
	</h1>
@stop

@section('content')

<div id="addTemplate">
	<h3></h3>
	{!! Form::open(['files'=> true, 'method'=>'post','id'=>'postFormID', 'route' =>'admin.templates.store']) !!} 
	
	<div class="form-group">
		{!! Form::label('name', 'Template Name:') !!}
		{!! Form::text('name', null, ['autofocus'=>'true','class' => 'form-control','placeholder'=>'Give your Template a Name']) !!}
		{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('zipName', 'Upload your zip here') !!}
		{!! Form::file('zipName','',array('id'=>'zipName','class'=>'form-control')) !!}
		{!! $errors->first('zipName', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
</div>
@stop
