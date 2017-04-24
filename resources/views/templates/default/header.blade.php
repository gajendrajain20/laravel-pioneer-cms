<nav class="topHeader">
    <div class="container">
        <div class="col-sm-4">
            <div class="row">
                <div class="top_date">
                    {{ date('l').', '.date('F').' '.date('j').', '.date('Y') }}
                </div>
                @if(!empty($site_settings['site.hotline']))
                <div class="top_hotline">
                    Hotline - {{ $site_settings['site.hotline'] }}
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-4 float_right">
            <div class="row">
            @if (!empty($site_settings['facebook.link']))
                <span class="td-social-icon-wrap">
                    <a title="Facebook" href="{{ $site_settings['facebook.link'] }}" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </span>
           @endif
           @if (!empty($site_settings['google.link']))
                <span class="td-social-icon-wrap">
                    <a title="Google+" href="{{ $site_settings['google.link'] }}" target="_blank">
                        <i class="fa fa-google" aria-hidden="true"></i>
                    </a>
                </span>
           @endif     
           @if (!empty($site_settings['twitter.link']))
                <span class="td-social-icon-wrap">
                    <a title="Twitter" href="{{ $site_settings['twitter.link'] }}" target="_blank">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </span>
           @endif     
           @if (!empty($site_settings['site.youtube']))
                <span class="td-social-icon-wrap">
                    <a title="Youtube" href="{{ $site_settings['site.youtube'] }}" target="_blank">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
                </span>
           @endif
            </div>
        </div>
    </div>
</nav>
