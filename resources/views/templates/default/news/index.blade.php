
@extends(option('site.template').'::layouts.contactmaster')

@section('content')

<div class="col-sm-6">
    <div class="row">
        <h4 class="block-title">
            <span>SUBMIT YOUR NEWS HERE</span>
        </h4>
		<div class="box_body clearfix" id="message">
			
		</div>
		@if(Session::has('flash_message'))
			@if(Session::get('flash_type') == 'success')
				<p class="login-flash-text alert alert-success fade in">
					{{ Session::get('flash_message') }}
				</p>
				@else
					<p class="login-flash-text text-danger">
					{{ Session::get('flash_message') }}
				</p>
				@endif
		@endif
		
		<div>
			{!! Form::open(['files'=> true, 'method'=>'post','id'=>'postFormID', 'route' =>'frontend.news.store']) !!} 
			
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
				{!! Form::label('number', 'Number:') !!} 
				{!! Form::text('number', null,['class' => 'form-control']) !!} 
				{!! $errors->first('number', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('message', 'Message:') !!} 
				{!! Form::textarea('message',null, ['class' => 'form-control']) !!} 
				{!!$errors->first('message', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::file('file',['class' => 'orm-control']) !!}
				{!!$errors->first('file', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="box_body">
			<div class="g-recaptcha" data-sitekey="6LfIvwcUAAAAAMTtRW4IxTRGxzPkQ3Tg2lUWQava"></div>
				{!!$errors->first('g-recaptcha-response', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="box_body right">{!! Form::Submit('Submit', ['class' => 'btn btn-primary','id'=>'submitForm' ] ) !!}
			</div>
			
			{!! Form::close() !!} 
		</div>
    </div>
</div>


@stop