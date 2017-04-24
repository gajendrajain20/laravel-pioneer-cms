@extends($layout)

@section('content-header')
	<h1>
		All Videos ({!! $videos->count() !!})
		&middot;
		<small>{!! link_to_route('admin.videos.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
        {!! Form::open(['files'=> false, 'method'=>'get','id'=>'postFormID', 'route' =>'admin.videos.search']) !!} 
                <div class="col-sm-12 search-form">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3>Search Filters</h3>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::text('search',  (isset($_GET['search'])?$_GET['search']:'') ,['class' => 'form-control search', 'placeholder' => 'Search', 'id' => 'search_text']) !!}
                            </div>
							<div class="col-sm-2">
                                {!! Form::select('month_list', $videos->month_list, (isset($_GET['month_list'])?$_GET['month_list']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
							<div class="col-sm-2">
                                {!! Form::select('user_id', $videos->users_list, (isset($_GET['user_id'])?$_GET['user_id']:'') ,['class' =>'select_box select_status float_none']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('status', array(''=>'Select Status','1' => 'Publish', '0' => 'Draft'), (isset($_GET['status'])?$_GET['status']:''),['class' =>'select_box select_status float_none']) !!} 
                            </div>
                            <div class="col-sm-2"> 
                                {!! Form::Submit('Search', ['class' => 'btn btn-primary','id'=>'search_btn' ] ) !!}
                                {!! $errors->first('search_filters', '<div class="text-danger">:message</div>') !!}
                            </div>
							<div class="col-sm-2"></div>
                        </div>
                </div>
        {!! Form::close() !!}
	<table class="table table-striped">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Author</th>
			<th>Views</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($videos as $video)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $video->title !!}</td>
				<td>{!! (isset($video->user->name)?$video->user->name:'') !!}</td>
                                <td>{!! $video->views !!}</td>
				<td>{!! $video->created_at !!}</td>
				<td class="text-center">
						<a class="btn btn-default" href="/video/<?php echo $video->slug ?>"  target="_blank" >View</a>
						&middot;
						<a class="btn btn-default" href="{!! route('admin.videos.edit', $video->slug) !!}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $video, 'name' => 'videos'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($videos) == 0)
		<p class="not-found-block">No Video found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($videos) !!}
	</div>
@stop
