@extends($layout)


@section('content-header')
	@section('content-header')
	<h1>
		Show Contact ({!! $contact->name !!}) 
		<small>{!! link_to_route('admin.contacts.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-9 wrapper_div">

			<div class="form-group">
				{!! Form::label('name', 'Name:') !!} 
				{!! Form::label('name', $contact->name,['class' => 'form-control']) !!} 
				{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('email', 'E-mail:') !!} 
				{!! Form::label('email', $contact->email,['class' => 'form-control']) !!} 
				{!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('subject', 'Subject:') !!} 
				{!!Form::label('subject', $contact->subject, ['class' =>'form-control']) !!} 
				{!! $errors->first('subject', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('message', 'Message:') !!} 
				{!! Form::textarea('message',$contact->message, ['readonly'=>'true', 'class' => 'form-control cursor_auto']) !!} 
				{!!$errors->first('message', '<div class="text-danger">:message</div>') !!}
			</div>
			
		</div>
		<!-- Col-md-9 closed -->
		
	</div>
	<!-- Row closed closed -->
	{!! Form::close() !!}
</div>
<!-- Container closed -->
	
@stop