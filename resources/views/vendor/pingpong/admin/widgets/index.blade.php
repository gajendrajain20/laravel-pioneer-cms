@extends($layout)

@section('content-header')
	<h1>
		All Widgets ({!! $widgets->count() !!})
		&middot;
		<small>{!! link_to_route('admin.widgets.choose', 'Add New') !!}</small>
	</h1>
	
@stop

@section('content')
        {!! Form::open(['files'=> false, 'method'=>'get','id'=>'postFormID', 'route' =>'admin.widgets.search']) !!} 
                <div class="col-sm-12 search-form">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3>Search Filters</h3>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::text('search',  (isset($_GET['search'])?$_GET['search']:'') ,['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                            </div>                            
                            <div class="col-sm-2"> 
                                {!! Form::Submit('Search', ['class' => 'btn btn-primary','id'=>'search_btn' ] ) !!}
                                {!! $errors->first('search_filters', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                </div>
        {!! Form::close() !!}
	<table class="table">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Author</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($widgets as $widget)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $widget->title !!}</td>
				<td>{!! $widget->user->name !!}</td>
				<td>{!! $widget->created_at !!}</td>
				<td class="text-center">
						<a class="btn  btn-default" href="{!! route('admin.widgets.edit', $widget->id) !!}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $widget, 'name' => 'widgets'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($widgets) == 0)
		<p class="not-found-block">No Widget found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($widgets) !!}
	</div>
@stop
