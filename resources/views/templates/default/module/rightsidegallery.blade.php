@if(!empty($articles))
	<div class="row" style="padding-right: 15px;">
		@foreach ($articles as $article)
		<div class="col-sm-6" style="margin-bottom: 20px;padding-right: 0px;height:90px;">
			<a title="{{ $article['title'] }}" rel="bookmark" href="{{ url('article', $article['slug']) }}">
				<img src=<?php echo $article['image'] ?> />
			</a>
		</div>
		@endforeach
	</div>
@endif