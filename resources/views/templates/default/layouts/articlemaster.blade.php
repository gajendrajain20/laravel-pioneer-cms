<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<link rel="icon" href="/images/site/{{ $site_settings['site.favicon'] }}" type="image/gif" sizes="16x16">
        <title>
			{{ $site_settings['site.name'] }} 
			@if(isset($article['title'])) {{':: '.$article['title']}}@endif
		</title>
		
		@if(isset($article['meta_title']) && $article['meta_title'] != '' && $article['meta_title'] != null )
			<meta name="title" content="{{ $article['meta_title'] }}">
			<?php $siteTitle = $article['meta_title']; ?>
		@else
			<meta name="title" content="{{ $site_settings['site.name'] }}">
			<?php $siteTitle = $site_settings['site.name']; ?>
		@endif
		
		@if(isset($article['meta_description']) && $article['meta_description'] != '' && $article['meta_description'] != null)
			<meta name="description" content="{{ $article['meta_description'] }}">
			<?php $siteDescription = $article['meta_description']; ?>
		@else
			<meta name="description" content="{{ $site_settings['site.description'] }}">
			<?php $siteDescription = $site_settings['site.description']; ?>
		@endif
		
		@if(isset($article['tags']) && $article['tags'] != '' && $article['tags'] != null)
			<meta name="keywords" content="{{ $article['tags'] }}">
		@else
			 <meta name="keywords" content="{{ $site_settings['site.keywords'] }}">
		@endif
		
		<!-- You can use Open Graph tags to customize link previews.
		Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
		<meta property="og:url"           content=<?php	$currentUrl = Request::url(); echo $currentUrl; ?> />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Testing fb share og:title property" />
		<meta property="og:description"   content="fb share  dummy description" />
		<meta property="og:image"         content=<?php echo(isset($article['image']) && $article['image'] !='' && $article['image'] != null)?$article['image']:"/images/site/".$site_settings['site.favicon'] ?> />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="400" />
		<meta property="og:image:height" content="300" />
		
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
		<!-- Google Analytics here-->
		 {!! option('tracking') !!}
    </head>
    <body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
        @include(option('site.template').'::header')
        @include(option('site.template').'::menu')
        <div class="container container_padding">
            <div class="col-sm-8 content_left">
                <div class="row">
					<div class="col-sm-12">
                        <div class="row">
                            <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('left-a'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('left-b'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 content_right">
                <div class="col-sm-12">
                    <div class="row">
                        <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('right-a'); ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('right-b'); ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('right-c'); ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getRightVideoNews(); ?>
                    </div>
                </div>
            </div>
			<script>
				var idcomments_acct = '1dd1de7711892fb820ebf006a457fe66';
				var idcomments_post_id;
				var idcomments_post_url;
			</script>
				<span id="IDCommentsPostTitle" style="display:none"></span>
			<script type='text/javascript' src='https://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>
        </div>
        @include(option('site.template').'::footer')
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('templates/'.option('site.template').'/js/bootstrap.min.js') }}"></script>
		
		<!-- SmartMenus jQuery plugin -->
		<script type="text/javascript" src="{{ asset('templates/'.option('site.template').'/js/jquery.smartmenus.js') }}"></script>
		<script src="{{ asset('templates/'.option('site.template').'/js/script.js') }}"></script>
		<script type='text/javascript' src='/preview.js'></script>

    </body>
</html>
