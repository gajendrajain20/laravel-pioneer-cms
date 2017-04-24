@extends($layout)

@section('content-header')
	<h1>
		All Events ({!! $events->count() !!})
		&middot;
		<small>{!! link_to_route('event.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No.</th>
			<th>Title</th>
			<th>Author</th>
            <th>Event Start</th>
			<th>Event End</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($events as $event)
				<td>{!! $no !!}</td>
				<td>{!! $event->title !!}</td>
				<td>{!! (isset($event->user->name)?$event->user->name:'') !!}</td>
				<td>{!! $event->eventStart !!}</td>
				<td>{!! $event->eventEnd !!}</td>
				<td class="text-center">
						<a href="{!! route('event.edit', $event->id) !!}">Edit</a>
						&middot;
						@include('event::partials.modal', ['data' => $event, 'name' => 'event'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($events) !!}
	</div>
@stop
