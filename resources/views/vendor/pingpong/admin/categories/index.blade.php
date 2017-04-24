@extends($layout)

@section('content-header')
	<h1>
		All Categories ({!! $categories->count() !!})
		&middot;
		<small>{!! link_to_route('admin.categories.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	{!! $errors->first('category', '<div class="text-danger">:message</div>') !!}
	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Slug</th>
			<th>Description</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($categories as $category)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $category->name !!}</td>
				<td>{!! $category->slug !!}</td>
				<td>{!! $category->description !!}</td>
				<td>{!! $category->created_at !!}</td>
				<td class="text-center">
					<a class="btn  btn-default" href="{!! route('admin.categories.edit', $category->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $category, 'name' => 'categories'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($categories) == 0)
		<p class="not-found-block">No Categories Found</p>
	@endif

	<div class="text-center">
		{!! pagination_links($categories) !!}
	</div>
@stop
