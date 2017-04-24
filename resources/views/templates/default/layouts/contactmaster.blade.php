<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{ $site_settings['site.name'] }}</title>
		<link rel="icon" href="/images/site/{{ $site_settings['site.favicon'] }}" type="image/gif" sizes="16x16">
        <meta name="title" content="{{ $site_settings['site.name'] }}">
        <meta name="description" content="{{ $site_settings['site.description'] }}">
        <meta name="keywords" content="{{ $site_settings['site.keywords'] }}">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('templates/'.option('site.template').'/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/'.option('site.template').'/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/'.option('site.template').'/css/font-awesome.min.css') }}">
        
        <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet"> 
		<!-- SmartMenus core CSS (required) -->
		<link href="{{ asset('templates/'.option('site.template').'/css/sm-core-css.css') }}" rel="stylesheet" type="text/css" />

		<!-- "sm-clean" menu theme (optional, you can use your own CSS, too) -->
		<link href="{{ asset('templates/'.option('site.template').'/css/sm-clean.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('templates/'.option('site.template').'/css/style.css') }}">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		
		<!-- reCaptcha -->
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!-- Google Analytics here-->
		 {!! option('tracking') !!}
    </head>
    <body>
        @include(option('site.template').'::header')
        @include(option('site.template').'::menu')
		
        <div class="container container_padding">
			<div class="row">
				<div class="col-sm-12">
						<div class="row">
							<?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('right-a'); ?>
						</div>
				</div>
			</div>
            @yield('content')
        </div>
        @include(option('site.template').'::footer')
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('templates/'.option('site.template').'/js/bootstrap.min.js') }}"></script>
		<!--  Jquery validation Script for ajax call -->
		<script src="{{ asset('templates/'.option('site.template').'/js/jquery.validate.min.js') }}"></script>
		<!--  Custom Script for ajax call -->
		<script src="{{ asset('templates/'.option('site.template').'/js/ajaxCall.js') }}"></script>
		
		<!-- SmartMenus jQuery plugin -->
		<script type="text/javascript" src="{{ asset('templates/'.option('site.template').'/js/jquery.smartmenus.js') }}"></script>
<script src="{{ asset('templates/'.option('site.template').'/js/script.js') }}"></script>

    </body>
</html>
