@extends($layout)


@section('content-header')
	<h1>
		All Queries ({!! $contacts->count() !!})
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>

			<th>Subject</th>
			<th>Message</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
		
		<?php $no = 1 ;?>
			@foreach ($contacts as $contact)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $contact->name !!}</td>
				<td>{!! $contact->email !!}</td>
				
				<td>{!! $contact->subject !!}</td>
				<td>{!! $contact->message !!}</td>
				<td class="text-center">
					<a class="btn  btn-default" href="{!! route('admin.contacts.show', $contact->id) !!}">View</a>
						&middot;
					@include('admin::partials.modal', ['data' => $contact, 'name' => 'contacts'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($contacts) !!}
	</div>
@stop
