@if(!empty($articles)) 
	<h2 class="block-title news_gallery_title">
    NEWS GALLERY
	</h2>
	<div class="news_gallery_posts">
		@foreach ($articles as $article)
			<div class="col-sm-4">
				<img src=<?php echo $article['image'] ?> />
				<h3 class="entry-title">
					<a title="{{ $article['title'] }}" rel="bookmark" 
						href="{{ url('article', $article['slug']) }}">{{ $article['title'] }}</a>
				</h3>
				<div class="publish_date">
					<?php echo date('Y-m-d', strtotime($article['published_on'])); ?>
				</div>
				<div class="td-post-views">
					<i class="fa fa-eye" aria-hidden="true"></i> {{$article['views']}}
				</div>
			</div>
		@endforeach
	</div>
@endif