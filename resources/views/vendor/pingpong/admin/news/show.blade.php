@extends($layout)


@section('content-header')
	@section('content-header')
	<h1>
		Submitted News ({!! $news->name !!}) 
		<small>{!! link_to_route('admin.news.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-9 wrapper_div">

			<div class="form-group">
				{!! Form::label('name', 'Name:') !!} 
				{!! Form::label('name', $news->name,['class' => 'form-control']) !!} 
			</div>

			<div class="form-group">
				{!! Form::label('email', 'E-mail:') !!} 
				{!! Form::label('email', $news->email,['class' => 'form-control']) !!} 
			</div>

			<div class="form-group">
				{!! Form::label('number', 'Number:') !!} 
				{!!Form::label('number', $news->number, ['class' =>'form-control']) !!} 
			</div>

			<div class="form-group">
				{!! Form::label('message', 'Message:') !!} 
				{!! Form::textarea('message',$news->message, ['readonly'=>'true', 'class' => 'form-control cursor_auto']) !!} 
			</div>
			
			<div class="form-group">
				{!! Form::label('file', 'File:') !!} 
				{!! HTML::link($news->file, 'Download File',['target' => '_blank']) !!}
			</div>
			
		</div>
		<!-- Col-md-9 closed -->
		
	</div>
	<!-- Row closed closed -->
	{!! Form::close() !!}
</div>
<!-- Container closed -->
	
@stop