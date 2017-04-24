@extends($layout)

@section('content-header')
	
	<h1>
		All Positions ({!! $positions->count() !!})
		&middot;
		<small>{!! link_to_route('admin.positions.create', 'Add New') !!}</small>
	</h1>
	
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Nutshell/Comment</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($positions as $position)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $position->position !!}</td>
				<td><?php echo (isset($position->nutshell) && $position->nutshell != null)?$position->nutshell:'<i>-- No comment --</i>'?></td>
				<td class="text-center">
					<a class="btn  btn-default" href="{!! route('admin.positions.edit', $position->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $position, 'name' => 'positions'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($positions) == 0)
		<p class="not-found-block">No Position found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($positions) !!}
	</div>
@stop
