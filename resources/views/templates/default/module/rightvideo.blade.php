@if(!empty($articles))
<!--
	<h4 class="block-title red_title">
		<span>Video</span>
	</h4> -->
	<div class="balumgala_posts">
		<div class="row" style="padding-right: 15px;">
			@foreach ($articles as $article)
				<div class="col-sm-6 video_page rightvideo" style="padding-right: 0px;height:auto;">
					<div class="td_module_mx1">
						<div class="td-module-thumb">
							<a href="{{ url('video', $article['slug']) }}" title="{{ $article['title'] }}">
								<img src=<?php echo $article['image'] ?> />
								<span class="td-video-play-ico">
									<img class="td-retina" width="40" height="40" alt="video" src="{{ asset('templates/default/images/ico-video-large.png') }}">
								</span>
							</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif