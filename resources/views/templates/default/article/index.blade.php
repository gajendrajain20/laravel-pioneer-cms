<?php
$currentUrl = Request::url();
?>
@extends(option('site.template').'::layouts.articlemaster')

@section('content')

<div class="td-post-header">
    <header class="td-post-title">
        <h1 class="entry-title">{{ $article['title'] }}</h1>
		@if(isset($article['tags']) && $article['tags'] != '' && $article['tags'] != null)
			<?php 
				$tags = explode(',',$article['tags']);
				$count = count($tags);
				if($count > 1){
					echo '<i class="fa fa-tags tags" aria-hidden="true"></i>';
				}elseif ($count = 1){
					echo '<i class="fa fa-tag tags" aria-hidden="true"></i>';
				}
				foreach($tags as $tag){
					echo '<span class="btn btn-info tag"><a href="/tag/'.$tag.'">'.$tag.'</a></span>';
				}
			?>
		@endif
        
        <div class="td-module-meta-info">
            <span class="td-post-date">
                <time datetime="<?php echo date('Y-m-d', strtotime($article['published_on'])); ?>" 
                class="entry-date updated td-module-date">
                <?php echo date('Y-m-d', strtotime($article['published_on'])); ?></time>
            </span> 
            <div class="td-post-views">
                <i class="fa fa-eye" aria-hidden="true"></i> {{$article['views']}}
            </div>                
        </div>
    </header>
</div>
<div class="td-post-content">
	@if(isset($article['show_featured_image']) && $article['show_featured_image'] == '1')
		<img src=<?php echo $article['image'] ?> />
	@endif
</div>
<div class="td-post-content">
{!!html_entity_decode($article['body'])!!}
</div>
<div class="td-post-sharing td-post-sharing-bottom ">
    <span class="td-post-share-title">SHARE</span>
    <div class="td-default-sharing">
	
       <div class="fb-share-button " data-href="<?php echo $currentUrl;?>" data-layout="button_count" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftesting.dev&amp;src=sdkpreparse">Share</a></div>
	   
        <a onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="<?php echo 'https://twitter.com/intent/tweet?via=Neth+News&amp;url=' . $currentUrl; ?>" class="td-social-sharing-buttons td-social-twitter">
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
<div class="col-sm-12" style="margin-bottom: 20px;">
    <div class="row getMayLike">
    <?php echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->getMayLikeNews($category); ?>
    </div>
</div>
@include('intense-debate-script')

@stop