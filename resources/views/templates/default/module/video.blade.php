@if(!empty($articles)) 

	<h4 class="block-title red_title">    
		<span>VIDEO</span>
	</h4>

	<?php
	$i = 0;
	foreach ($articles as $article) {
		?>
		<?php if ($i == 0) { ?>
			<div class="col-sm-6">
            <div class="row video_page homevideo">
					<div class="td_module_mx1">
						<div class="td-module-thumb">
                        <a href="{{ url('video', $article['slug']) }}" title="{{ $article['title'] }}">
							<img src=<?php echo $article['image'] ?> />
                            <span class="td-video-play-ico">
                                <img class="td-retina" width="40" height="40" alt="video" src="{{ asset('templates/default/images/ico-video-large.png') }}">
                            </span>
                        </a>
						</div>
						<div class="td-module-meta-info">

							<h3 class="entry-title">
                            {{ $article['title'] }}
							</h3>
							<div class="publish_date">
								<?php echo date('Y-m-d', strtotime($article['published_on'])); ?>
							</div>
                        <div class="td-post-views white">
                            <i class="fa fa-eye" aria-hidden="true"></i> {{$article['views']}}
                        </div>
						</div>
					</div>
				</div>
			</div>
		<?php
		} break;
	}
	?>
<div class="col-sm-6" style="padding-right: 0px;">
		<?php
		$i = 0;
		foreach ($articles as $article) {
			?>
		<?php if ($i > 0) { ?>
            <div class="col-sm-6 video_page homevideo2" style="padding-right: 0px;">
					<div class="td_module_mx1">
						<div class="td-module-thumb">
                        <a href="{{ url('video', [$article['id']]) }}" title="{{ $article['title'] }}">
							<img src=<?php echo $article['image'] ?> />
                            <span class="td-video-play-ico">
                                <img class="td-retina" width="40" height="40" alt="video" src="{{ asset('templates/default/images/ico-video-large.png') }}">
                            </span>
                        </a>
						</div>
						<div class="td-module-meta-info">
							<h3 class="entry-title small">
                            {{ $article['title'] }}
							</h3>
							<div class="publish_date small">
								<?php echo date('Y-m-d', strtotime($article['published_on'])); ?>
							</div>
							<div class="td-post-views small white">
								<i class="fa fa-eye" aria-hidden="true"></i> {{$article['views']}}
							</div>
						</div>
					</div>
				</div>
		<?php
		} $i++;
	}
	?>
	</div>

@endif