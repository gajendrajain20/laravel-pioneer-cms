@extends($layout)

@section('content-header')
	<h1>
		All Modules ({!! $modules->count() !!})
		&middot;
		<small>{!! link_to_route('admin.modules.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No.</th>
			<th>Module Name</th>
			<th>User</th>
			<th>Characterstic</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($modules as $module)
			<tr <?php if(isset($module->applied)){echo "class='applied_module'";}?> >
				<td>{!! $no !!}</td>
				<td>{!! $module->name !!}</td>
				<td>{!! (isset($module->user->name)?$module->user->name:'') !!}</td>
				<td>{!! (isset($module->zipName)&& ($module->zipName != ''|| $module->zipName != null ))?'Uploaded':'Created'!!}</td>
				<td class="text-center">
					@if (isset($module->applied))
						<a class="btn  btn-default" href="{!! route('admin.modules.deactivate', $module->id) !!}">Deactivate</a>
					@else
						<a class="btn  btn-default" href="{!! route('admin.modules.apply', $module->id) !!}">Apply</a>
					@endif
					&middot;
					@include('admin::partials.modal', ['data' => $module, 'name' => 'modules'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>
	@if(count($modules) == 0)
		<p class="not-found-block">No Module found</p>
	@endif
	<div class="text-center">
		{!! pagination_links($modules) !!}
	</div>
@stop
