@if(!empty($articles))

	<div class="balumgala_posts">
		@foreach ($articles as $article)
		<div class="breaking_news">
			<div class="row">
				<div class="col-sm-4">
					<img src=<?php echo $article['image'] ?>/>
				</div>
				<div class="col-sm-8">
					<div class="row">
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
			</div>
		</div>
    </div>
		@endforeach
	</div>

	@if(isset($category_id))
<!--	<div class="td-read-more">
		<a href = "/category/<?php //echo $category_id ?>">See All</a>
	</div> -->
	@endif
@endif
