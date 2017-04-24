@if(!empty($articles)) 
	@foreach ($articles as $article)
	<div class="breaking_news">
		<div class="row">
			<div class="col-sm-6">
				<img src=<?php echo $article['image'] ?> />
			</div>
			<div class="col-sm-6">
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
				<div class="top_breaking_news_discription">
					<?php echo \Modules\Frontend\Http\helpers::truncate_html($article['body'], 60); ?>
				</div>
	<!--			<div class="td-read-more">
					<a href = "{{ url('article', [$article['id']]) }}">Read More</a>
				</div> -->
			</div>
		</div>
	</div>
	@endforeach
@endif