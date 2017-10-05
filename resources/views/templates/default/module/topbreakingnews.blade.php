@if(!empty($articles))

	@foreach ($articles as $article)
	<div class="top_breaking_news_image">
		<img src=<?php echo $article['image'] ?>/>
	</div>
	<div class="top_breaking_news_content">
		<div class="top_breaking_news_title">
			<h3 class="entry-title td-module-title">
				<a title="{{ $article['title'] }}" rel="bookmark" href="{{ url('article', $article['slug']) }}">{{ $article['title'] }}</a>
			</h3>
			<div class="publish_date">
				<?php echo date('Y-m-d',strtotime($article['published_on'])); ?>
			</div>
			<div class="td-post-views">
				<i class="fa fa-eye" aria-hidden="true"></i> {{$article['views']}}
			</div>
		</div>
		<div class="top_breaking_news_discription">
			 <?php echo \Modules\Frontend\Http\helpers::truncate_html($article['body'], 100); ?>
			<div class="td-read-more">
				<a href = "{{ url('article', [$article['id']]) }}">Read More</a>
			</div>
		</div>
	</div>
	@endforeach

@endif
