@extends($layout)

@section('content-header')
	<h1>
		All Menus ({!! $menus->count() !!})
		&middot;
		<small>{!! link_to_route('admin.menus.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

{!! $errors->first('menu', '<div class="text-danger">:message</div>') !!}
	<table class="table">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Author</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($menus as $menu)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $menu->title !!}</td>
				<td>{!! $menu->user->name !!}</td>
				<td>{!! $menu->created_at !!}</td>
				<td class="text-center">
					<a class="btn  btn-default" href="{!! route('admin.menus.edit', $menu->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $menu, 'name' => 'menus'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($menus) == 0)
		<p class="not-found-block">No Menu found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($menus) !!}
	</div>
@stop
