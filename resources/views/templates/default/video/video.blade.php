<?php
$currentUrl = Request::url();
?>
@extends(option('site.template').'::layouts.articlemaster')

@section('content')

<div class="td-post-header">
    <header class="td-post-title">
        <h1 class="entry-title">{{ $video['title'] }}</h1>
        <div class="col-sm-12">
            <div class="row">
                <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getAllWidgets('inner-left-a', 0); ?>
            </div>
        </div>
        <div class="td-module-meta-info">
            <span class="td-post-date">
                <time datetime="<?php echo date('Y-m-d', strtotime($video['published_on'])); ?>" class="entry-date updated td-module-date"><?php echo date('Y-m-d', strtotime($video['published_on'])); ?></time>
            </span> 
			<div class="td-post-views">
                <i class="fa fa-eye" aria-hidden="true"></i> {{$video['views']}}
            </div>
             
			<div class="td-post-content">
			@if(isset($video['show_featured_image']) && $video['show_featured_image'] == '1')
        		<img src=<?php echo $video['image'] ?> />
        	@endif
			</div>            
        </div>
    </header>
</div>
<div class="td-post-content">
	{!!html_entity_decode($video['description'])!!}
</div>
<div class="td-post-sharing td-post-sharing-bottom ">
    <span class="td-post-share-title">SHARE</span>
    <div class="td-default-sharing">
        <a onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="<?php echo 'http://www.facebook.com/sharer.php?u=' . $currentUrl; ?>" class="td-social-sharing-buttons td-social-facebook">
            <i class="fa fa-facebook" aria-hidden="true"></i>
            <div class="td-social-but-text">Facebook</div>
        </a>
        <a href="<?php echo 'https://twitter.com/intent/tweet?via=Neth+News&amp;url=' . $currentUrl; ?>" class="td-social-sharing-buttons td-social-twitter">
            <i class="fa fa-twitter" aria-hidden="true"></i>
            <div class="td-social-but-text">Twitter</div>
        </a>
        <a onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="<?php echo 'http://plus.google.com/share?url=' . $currentUrl; ?>" class="td-social-sharing-buttons td-social-google">
            <i class="fa fa-google-plus" aria-hidden="true"></i>
        </a>
        <a onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="<?php echo 'http://pinterest.com/pin/create/button/?url=' . $currentUrl; ?>" class="td-social-sharing-buttons td-social-pinterest">
            <i class="fa fa-pinterest" aria-hidden="true"></i>
        </a>
    </div>
</div>
<h4 class="block-title red_title" style="margin-bottom: 20px;">    
    <span>You may also like</span>
</h4>
<script>
    var idcomments_acct = '1dd1de7711892fb820ebf006a457fe66';
    var idcomments_post_id;
    var idcomments_post_url;
</script>
<span id="IDCommentsPostTitle" style="display:none"></span>
<script type='text/javascript' src='https://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>

@stop