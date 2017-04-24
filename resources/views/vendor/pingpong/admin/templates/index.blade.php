@extends($layout)

@section('content-header')
	<h1>
		All Templates ({!! $templates->count() !!})
		&middot;
		<small>{!! link_to_route('admin.templates.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No.</th>
			<th>Template Name</th>
			<th>UserID</th>
			<th>Uploaded File Name</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($templates as $template)
			<tr <?php if(isset($template->applied)){echo "class='applied_template'";}?> >
				<td>{!! $no !!}</td>
				<td>{!! $template->name !!}</td>
				<td>{!! (isset($template->user_id)?$template->user_id:'Unknown') !!}</td>
				<td>{!! $template->zipName!!}</td>
				<td class="text-center">
					@if(isset($template->id) && $template->id !='1')
						@if (isset($template->applied))
							<a class="btn btn-default" href="{!! route('admin.templates.deactivate') !!}">Deactivate</a>
						@else
							<a class="btn btn-default" href="{!! route('admin.templates.apply', $template->id) !!}">Apply</a>
						@endif
						&middot;
						@include('admin::partials.modal', ['data' => $template, 'name' => 'templates'])
					@else
						@if (isset($template->applied))
							<a class="btn btn-default" disabled>Deactivate</a>
						@else
							<a class="btn btn-default" disabled>Apply</a>
						@endif
						&middot;
							<a class="btn btn-danger" disabled>Delete</a>
					@endif
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($templates) == 0)
		<p class="not-found-block">No Template found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($templates) !!}
	</div>
@stop
