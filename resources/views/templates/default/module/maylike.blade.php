@if(!empty($articles))
    <!-- <h4 class="block-title red_title" style="margin-bottom: 20px;">
        <span>You may also like</span>
	</h4> -->
    @foreach ($articles as $article)
        <div class="col-sm-4 maylikediv">
            <img src=<?php echo $article['image'] ?> />

            <h3 class="entry-title entry-title-small">
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
    @endforeach
@endif