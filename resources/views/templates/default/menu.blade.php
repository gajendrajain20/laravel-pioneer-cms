<nav class="topMenu">
    <div class="container">
		<div class="navbar-header">
			@if(!empty($site_settings['site.logo']))
			<img src="{{ asset('images/site/'.$site_settings['site.logo']) }}" class="frontend_logo_images"/>
			@endif
			<a href="/" class="site-name-anchor"><span class="site-name">{{ $site_settings['site.name'] }}</span></a>	
			<button aria-controls="navbar" aria-expanded="false" data-target="#main-nav" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
			<?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllMenus(); ?>
    </div>
</nav>