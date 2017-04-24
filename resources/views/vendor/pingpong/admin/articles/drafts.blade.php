@extends($layout)

@section('content-header')
	<h1>
		All Draft Posts ({!! $articles->count() !!})
		&middot;
		<small>{!! link_to_route('admin.articles.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
	{!! Form::open(['files'=> false, 'method'=>'get','id'=>'postFormID', 'route' =>'admin.articles.drafts.search']) !!} 
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
					{!! Form::select('status', array('0' => 'Draft'), (isset($_GET['status'])?$_GET['status']:''),['class' =>'select_box select_status float_none']) !!} 
				</div>
				<div class="col-sm-2"> 
					{!! Form::hidden('type', 'post',['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
					{!! Form::Submit('Search', ['class' => 'btn btn-primary','id'=>'search_btn' ] ) !!}
					{!! $errors->first('search_filters', '<div class="text-danger">:message</div>') !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}

	<table class="table table-striped">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Category</th>
			<th>Author</th>
			<th>Status</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($articles as $article)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $article->title !!}</td>
				<td>
					<?php 
					$categoryArray=array();
					
					foreach($article->categories as $category){ 
						$categoryArray[]=$category->category->name;
					}
					echo implode(', ',$categoryArray);
					?> 
				</td>
				<td>{!! $article->user->name !!}</td>
				<td>{!! $article->status == 1?'Published':'Draft' !!}</td>
				<td>{!! $article->created_at !!}</td>
				<td class="text-center">
					@if(isOnPages())
						<a class="btn btn-default" href="/page/<?php echo $article->id ?>"  target="_blank" >View</a>
						&middot;
						<a class="btn btn-default" href="{!! route('admin.pages.edit', $article->id) !!}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $article, 'name' => 'pages'])
					@else
						<a class="btn btn-default" href="/article/<?php echo $article->id ?>"  target="_blank" >View</a>
						&middot;
						<a class="btn btn-default" href="{!! route('admin.articles.edit', $article->id) !!}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $article, 'name' => 'articles'])
					@endif
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($articles) !!}
	</div>
@stop
