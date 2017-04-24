
@extends(option('site.template').'::layouts.contactmaster')

@section('content')
<div style="margin-bottom: 10px;display: flex;">
<?php echo $article['body']; ?>
</div>
<div class="col-sm-6">
    <div class="row">
        <h4 class="block-title">
            <span>SEND US YOUR IDEAS</span>
        </h4>
		<div class="box_body clearfix" id="message">
				
		</div>
		<div>
			{!! Form::open(['name' =>'contactForm', 'method'=>'post','id'=>'postFormID', 'route' =>'frontend.contact.store']) !!} 
			
			<div class="form-group">
				{!! Form::label('name', 'Name:') !!} 
				{!! Form::text('name', null,['class' => 'form-control','autofocus'=>'autofocus']) !!} 
				{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('email', 'Email:') !!} 
				{!! Form::text('email', null,['class' => 'form-control']) !!} 
				{!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('subject', 'Subject:') !!} 
				{!! Form::text('subject', null,['class' => 'form-control']) !!} 
				{!! $errors->first('subject', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('message', 'Message:') !!} 
				{!! Form::textarea('message',null, ['class' => 'form-control', 'id' => 'ckeditor']) !!} 
				{!!$errors->first('message', '<div class="text-danger">:message</div>') !!}
			</div>
			<div class="box_body form-group">
			<div class="g-recaptcha" data-sitekey="6LfIvwcUAAAAAMTtRW4IxTRGxzPkQ3Tg2lUWQava"></div>
				{!!$errors->first('g-recaptcha-response', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="box_body form-group">{!! Form::Submit('Submit', ['class' => 'btn btn-primary','id'=>'submitForm' ] ) !!}
			</div>
			
			{!! Form::close() !!} 
		</div>
    </div>
</div>
<div class="modal_loader"><!-- Place at bottom of page --></div>
<div class="col-sm-6">
    
</div>
@stop