

@extends($layout)

@section('content-header')
	<h1>
		Choose Widget Type
		&middot;
		<small>{!! link_to_route('admin.widgets.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		<div class="container">
		<div class="row">
		<div class="col-md-12 wrapper_div">
			<div class="module-types">
				<ul class="uli">
					<li>
						{!! link_to_route('admin.widgets.predefined', 'Articles - Category') !!}   This module displays a list of articles from one or more categories.
					</li>
					<li>
						{!! link_to_route('admin.widgets.create', 'Custom') !!}  This module allows you to create your own Module using a WYSIWYG editor.
					</li>
				</ul>	
			</div>
		</div>	<!-- Col-md-12 closed -->
		</div>	<!-- Row closed closed -->
		</div> <!-- Container closed -->
	</div>

@stop