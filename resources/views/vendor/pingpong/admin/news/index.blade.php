@extends($layout)

@section('content-header')
	<h1>
		All Recieved News ({!! $news->count() !!})
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Number</th>
			<th>Message</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
		
		<?php $no = 1 ;?>
			@foreach ($news as $currentNews)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $currentNews->name !!}</td>
				<td>{!! $currentNews->email !!}</td>
				
				<td>{!! $currentNews->number !!}</td>
				<td>{!! $currentNews->message !!}</td>
				<td class="text-center">
					<a class="btn  btn-default" href="{!! route('admin.news.show', $currentNews->id) !!}">View</a>
						&middot;
					@include('admin::partials.modal', ['data' => $currentNews, 'name' => 'news'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($news) !!}
	</div>
@stop
