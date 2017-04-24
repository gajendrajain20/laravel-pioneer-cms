@extends(option('site.template').'::layouts.articlemaster')
@section('content')
<h4 class="block-title red_title">    
    <span>VIDEO</span>
</h4>

<div class="video_page">
    <?php
    foreach ($videos as $video) {
        ?>
        <div class="col-sm-6 video_list">

            <div class="td_module_mx1">
                <div class="td-module-thumb">
                    <a href="{{ url('video', $video['slug']) }}" title="{{ $video['title'] }}">
                        <img src=<?php echo $video['image'] ?> />
                        <span class="td-video-play-ico">
                            <img class="td-retina" width="40" height="40" alt="video" 
                            	src="{{ asset('templates/default/images/ico-video-large.png') }}">
                        </span>
                    </a>
                </div>
                <div class="td-module-meta-info">

                    <h3 class="entry-title">
                        {{ $video['title'] }}
                    </h3>
                    <div class="publish_date">
                        <?php echo date('Y-m-d', strtotime($video['published_on'])); ?>
                    </div>
					<span class="td-post-views">
                        <i class="fa fa-eye"></i> {{$video['views']}}
					</span>

                </div>
            </div>
        </div>

        <?php
    }
    ?>
    <div class="text-center">
        {!! pagination_links($videos) !!}
    </div>
</div>
@stop