@extends($layout)

@section('content-header')
	<h1>
		{!! $title or 'All Users' !!} ({!! $users->count() !!})
		&middot;
		<small>{!! link_to_route('admin.users.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $user->name !!}</td>
				<td>{!! $user->email !!}</td>
				<td>{!! $user->created_at !!}</td>
				@if($user->is('admin') || $user['original']['name'] == Auth::user()->name)
    				<td class="text-center">
    					<a class="btn  btn-default" href="{!! route('admin.users.edit', $user->id) !!}">Edit</a>
    					&middot;
    					<a class="btn  btn-danger disabled" disabled>Delete</a>
    				</td>
				@else
    				<td class="text-center">
    					<a class="btn  btn-default" href="{!! route('admin.users.edit', $user->id) !!}">Edit</a>
    					&middot;
    					@include('admin::partials.modal', ['data' => $user, 'name' => 'users'])
    				</td>
				@endif
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($users) == 0)
		<p class="not-found-block">No User found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($users) !!}
	</div>
@stop
