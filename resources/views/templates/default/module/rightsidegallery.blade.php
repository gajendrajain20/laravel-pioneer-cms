@if(!empty($articles)) 
	@if(isset($color) && isset($categoryName))
		@if($color=='')
		<h2 class="block-title balumgala_title">    
			<img src="{{ asset('templates/default/images/balumgala-ok.png') }}" />
		</h2>
		@elseif($color=='red')
		<h4 class="block-title red_title">    
			<span>{{ $categoryName }}</span>
		</h4>
		@elseif($color=='black')
		<h4 class="block-title black_title">    
			<span>{{ $categoryName }}</span>
		</h4>
		@endif
	@endif
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