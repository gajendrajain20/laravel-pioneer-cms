@extends(option('site.template').'::layouts.articlemaster')

@section('content')
<h4 class="block-title">
    <a href="">{{ $category['name'] }}</a>
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

            <div class="top_breaking_news_discription">
                <?php echo \Modules\Frontend\Http\helpers::truncate_html($article['body'], 150); ?>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="text-center">
    {!! pagination_links($articles) !!}
</div>
@stop
