@if(!empty($articles)) 
	@if(isset($color) && isset($categoryName))
		@if($color=='')
		<h4 class="block-title balumgala_title">    
			<img src="{{ asset('templates/default/images/balumgala-ok.png') }}" />
		</h4>
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
<?php
$i = 0;
foreach ($articles as $article) {
    if($i==0){ ?>
	<div class="td_module_mx1">
		<div class="td-module-thumb">
			<img src=<?php echo $article['image'] ?> />
		</div>
		<div class="td-module-meta-info">
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
	<?php } else { ?>
	<div class="breaking_news balumgala_posts">
		<div class="row">
			<div class="col-sm-4">
				<img src=<?php echo $article['image'] ?> />
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
    <?php
    } $i++;
}
?>
@endif