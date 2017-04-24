@extends($layout)

@section('content-header')
	@if( ! isOnPages())
	<h1>
		All Posts ({!! $articles->count() !!})
		&middot;
		<small>{!! link_to_route('admin.articles.create', 'Add New') !!}</small>
	</h1>
	@else
	<h1>
		All Pages ({!! $articles->count() !!})
		&middot;
		<small>{!! link_to_route('admin.pages.create', 'Add New') !!}</small>
	</h1>
	@endif
	 
@stop

@section('content')

	@if( ! isOnPages())
        {!! Form::open(['files'=> false, 'method'=>'get','id'=>'postFormID', 'route' =>'admin.articles.search']) !!} 
		<div class="col-sm-12 search-form">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3>Search Filters</h3>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::text('search',  (isset($_GET['search'])?$_GET['search']:'') ,['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('category', $articles->categories_list, (isset($_GET['category'])?$_GET['category']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
							<div class="col-sm-2">
                                {!! Form::select('month_list', $articles->month_list, (isset($_GET['month_list'])?$_GET['month_list']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('user_id', $articles->users_list, (isset($_GET['user_id'])?$_GET['user_id']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('status', array(''=>'Select Status','1' => 'Publish', '0' => 'Draft'), (isset($_GET['status'])?$_GET['status']:''),['class' =>'select_box select_status float_none']) !!} 
                            </div>
                            <div class="col-sm-2"> 
                                {!! Form::hidden('type', 'post',['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                                {!! Form::Submit('Search', ['class' => 'btn btn-primary','id'=>'search_btn' ] ) !!}
                                {!! (isset($errors) && $errors != null)?$errors->first('search_filters', '<div class="text-danger">:message</div>'):'' !!}
                            </div>
                        </div>
                </div>
	@else
        {!! Form::open(['files'=> false, 'method'=>'get','id'=>'postFormID', 'route' =>'admin.pages.search']) !!} 
                <div class="col-sm-12 search-form">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3>Search Filters</h3>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::text('search',  (isset($_GET['search'])?$_GET['search']:'') ,['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                            </div>
							<div class="col-sm-2">
                                {!! Form::select('month_list', $articles->month_list, (isset($_GET['month_list'])?$_GET['month_list']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
							<div class="col-sm-2">
                                {!! Form::select('user_id', $articles->users_list, (isset($_GET['user_id'])?$_GET['user_id']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>							
                            <div class="col-sm-2">
                                {!! Form::select('status', array(''=>'Select Status','1' => 'Publish', '0' => 'Draft'), (isset($_GET['status'])?$_GET['status']:''),['class' =>'select_box select_status float_none']) !!} 
                            </div>
                            <div class="col-sm-2"> 
                                {!! Form::hidden('type', 'page',['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                                {!! Form::Submit('Search', ['class' => 'btn btn-primary','id'=>'search_btn' ] ) !!}
                                {!! (isset($errors) && $errors != null)?$errors->first('search_filters', '<div class="text-danger">:message</div>'):'' !!}
                            </div>
							<div class="col-sm-2"></div>
                        </div>
                </div>		
	@endif
	{!! Form::close() !!} 
	<table class="table table-striped">
		<thead>
			<th>No</th>
			<th>Title</th>
			@if( ! isOnPages())
			<th>Categories</th>
			@endif
			<th>Author</th>
			<th>Status</th>
            <th>Views</th>
			<th>Date</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($articles as $article)
				@if ($article->user->name == Auth::user()->name)			
    			<tr>
    				<td>{!! $no !!}</td>
    				<td>{!! $article->title !!}</td>
    				@if( ! isOnPages())
    				<td>                                    
    					<?php 
    					$categoryArray=array();
    					
    					foreach($article->categories as $category){ 
    						$categoryArray[]=$category->category->name;
    					}
    					echo implode(', ',$categoryArray);
    					?>                                    
    				</td>
    				@endif
    				<td>{!! (isset($article->user->name)?$article->user->name:'') !!}</td>
    				
    				<td>{!! $article->status == 1?'Published':'Draft' !!}</td>
                	<td>{!! $article->views !!}</td>
    				<td>{!! date('Y-m-d',strtotime($article->published_on)) !!}</td>
    				<td class="text-center">
    					@if(isOnPages())
    						<a class="btn btn-default" href="/page/<?php echo $article->slug ?>"  target="_blank" >View</a>
    						&middot;
    						<a class="btn btn-default" href="{!! route('admin.pages.edit', $article->slug) !!}">Edit</a>
    						&middot;
    						@include('admin::partials.modal', ['data' => $article, 'name' => 'pages'])
    					@else
    						<a class="btn btn-default" href="/article/<?php echo $article->slug ?>" target="_blank" >View</a>
    						&middot;
    						<a class="btn btn-default" href="{!! route('admin.articles.edit', $article->slug) !!}">Edit</a>
    						&middot;
    						@include('admin::partials.modal', ['data' => $article, 'name' => 'articles'])
    					@endif
    				</td>
    			</tr>
				<?php $no++ ;?>
				@endif	
			@endforeach
		</tbody>
	</table>
	@if(count($articles) == 0)
		@if(isOnPages())
			<p class="not-found-block">No Page Found</p>
		@else
			<p class="not-found-block">No Post Found</p>
		@endif
		
	@endif
	<div class="text-center">
		{!! pagination_links($articles) !!}
	</div>
@stop
