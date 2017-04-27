<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
					<a href="/" class="site-name-anchor">
						@if(!empty($site_settings['site.footer.logo']))
							<div class="row">
								<img src="{{ asset('images/site/'.$site_settings['site.footer.logo']) }}" class="frontend_logo_images"/>
							</div>
						@endif
					</a>
                </div>
                <div class="col-sm-8 float_right">
                    <div class="row">
                    @if(!empty($site_settings['site.android']))
                        <span class="td-social-icon-wrap">
                            <a title="Android" href="{{ $site_settings['site.android'] }}" target="_blank">
                                <i class="fa fa-android" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.apple']))
                        <span class="td-social-icon-wrap">
                            <a title="Apple" href="{{ $site_settings['site.apple'] }}" target="_blank">
                                <i class="fa fa-apple" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['facebook.link']))
                        <span class="td-social-icon-wrap">
                            <a title="Facebook" href="{{ $site_settings['facebook.link'] }}" target="_blank">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['google.link']))
                        <span class="td-social-icon-wrap">
                            <a title="Google+" href="{{ $site_settings['google.link'] }}" target="_blank">
                                <i class="fa fa-google-plus" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['twitter.link']))
                        <span class="td-social-icon-wrap">
                            <a title="Twitter" href="{{ $site_settings['twitter.link'] }}" target="_blank">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.youtube']))
                        <span class="td-social-icon-wrap">
                            <a title="Youtube" href="{{ $site_settings['site.youtube'] }}" target="_blank">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.linkedin']))
                        <span class="td-social-icon-wrap">
                            <a title="Linkedin" href="{{ $site_settings['site.linkedin'] }}" target="_blank">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.mail']))
                        <span class="td-social-icon-wrap">
                            <a title="Mail" href="{{ $site_settings['site.mail'] }}" target="_blank">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.alert']))
                        <span class="td-social-icon-wrap">
                            <a title="Alerts" href="{{ $site_settings['site.alert'] }}" target="_blank">
                                <i class="fa fa-flash" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($site_settings['site.rss']))
                         <span class="td-social-icon-wrap">
                            <a title="Rss" href="{{ $site_settings['site.rss'] }}" target="_blank">
                                <i class="fa fa-rss" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($site_settings['site.copyright']))
    <div class="copyright">
        <div class="container">
            <div class="center">
               {{ $site_settings['site.copyright'] }}             
            </div>
        </div>
    </div>
    @endif
</footer>