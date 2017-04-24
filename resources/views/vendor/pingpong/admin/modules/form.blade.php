@extends($layout)

@section('content-header')
	<h1>
	Modules
	</h1>
@stop

@section('content')
<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#upload" data-toggle="tab">Upload</a></li>
	<li><a href="#create" data-toggle="tab">Create</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="upload">
		<div id="uploadmodule">
			<h3></h3>
			{!! Form::open(['files'=> true, 'method'=>'post','id'=>'postFormID', 'route' =>'admin.modules.store']) !!} 
			
			<div class="form-group">
				{!! Form::label('name', 'Module Name:') !!}
				{!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Give your Module a Name']) !!}
				{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('routeName', 'Frontend Route Name:') !!}
				{!! Form::text('routeName', null, ['class' => 'form-control','placeholder'=>'Enter the frontend route']) !!}
				{!! $errors->first('routeName', '<div class="text-danger">:message</div>') !!}
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
	</div>
	
	<div class="tab-pane" id="create">
		<div id="addmodule">
			<h3></h3>
			{!! Form::open(['files'=> false, 'method'=>'post','id'=>'moduleCreate', 'route' =>'admin.modules.createModule']) !!} 
			
			<div class="form-group">
				{!! Form::label('moduleName', 'Module Name:') !!}
				{!! Form::text('moduleName', null, ['class' => 'form-control','placeholder'=>'Give your Module a Name']) !!}
				{!! $errors->first('moduleName', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('note', 'Note: Module will be created in modules folder ') !!}
			</div>
			
			<div class="form-group">
				{!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
