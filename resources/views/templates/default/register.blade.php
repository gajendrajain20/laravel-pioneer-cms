<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{!! admin_asset('components/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
        <link href="{!! admin_asset('components/fontawesome/css/font-awesome.min.css') !!}" rel="stylesheet"
type="text/css"/>
        <!-- Theme style -->
        <link href="{!! admin_asset('adminlte/css/AdminLTE.css') !!}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('templates/'.option('site.template').'/css/style.css') }}">
        <link href="{!! admin_asset('adminlte/css/datepicker/datepicker3.css') !!}" rel="stylesheet" type="text/css" />
        
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign Up</div>
            {!! Form::open(['route' => 'frontend.register.store']) !!}
                <div class="body bg-gray">
                    @if(Session::has('flash_message'))
                        <p class="login-flash-text text-danger">
                            {{ Session::get('flash_message') }}
                        </p>
                    @endif
                    
                    <div class="form-group">
                    	<div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                       		</div>
                          	{!! Form::text('name', null,['class' => 'form-control', 'placeholder'=>'Name']) !!} 
                    	</div>
                    	{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">    
                    	<div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                       		</div>
                          	{!! Form::text('dob', null,['class' => 'form-control form-control pull-right datepicker',  'placeholder'=>'DOB']) !!} 
                    	</div>
                    	{!! $errors->first('dob', '<div class="text-danger">:message</div>') !!}
                    <!-- /.input group -->
                  	</div>
                  
                    <div class="form-group">
                        <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope-o"></i>
                           		</div>
                              	{!! Form::text('email', null,['class' => 'form-control', 'placeholder'=>'E-mail']) !!} 
                        	</div>
                        	{!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">
                    	<div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                       		</div>
                          	{!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) !!} 
                    	</div>
                    	{!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                       		</div>
                          	{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder'=>'Confirm Password']) !!} 
                    	</div>
                    	{!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
                        <!-- /.input group -->
                    </div>
                </div>
                
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Register</button>
                </div>
            {!! Form::close() !!}
        </div>

        <script src="{!! admin_asset('components/jquery/dist/jquery.min.js') !!}"></script>
        <script src="{!! admin_asset('components/bootstrap/dist/js/bootstrap.min.js') !!}" type="text/javascript"></script>
        <script src="{!! admin_asset('adminlte/js/plugins/datepicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
		<script type="text/javascript">
			$('.datepicker').datepicker();
		</script>
    </body>
</html>
