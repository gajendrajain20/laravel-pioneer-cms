@extends(option('site.template').'::layouts.master')

@section('content')

@if(!empty($articles))
	<h4 class="block-title">
		<a>LATEST NEWS</a>
	</h4>
	@foreach ($articles as $article)
	<div class="breaking_news">
		<div class="row">
			<div class="col-sm-3">
				<img src=<?php echo $article['image'] ?> />
			</div>
			<div class="col-sm-9">
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
                 <?php echo \Modules\Frontend\Http\helpers::truncate_html($article['body'], 90); ?>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	
	@if(isset($category_id))
	<div class="td-read-more">
	    <a href = "/category/<?php echo $category_id ?>">See All</a>
	</div>
	@endif
@endif
@stop