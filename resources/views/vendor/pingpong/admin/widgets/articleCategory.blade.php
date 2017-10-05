@if(isset($model))

{!! Form::model($model, ['method' => 'PUT', 'files' => true,'id'=>'postFormID', 'route' => ['admin.widgets.update', $model->id]]) !!}
@else

{!! Form::open(['files' => true, 'method'=>'post','id'=>'postFormID', 'route' => 'admin.widgets.store']) !!}
@endif
<div class="container">
<div class="row">
<div class="col-md-9 wrapper_div">

	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
		{!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('show_title', 'Show Title:') !!}
		{!! Form::checkbox('show_title', '1'); !!}
		{!! $errors->first('show_title', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('module', 'Template:') !!}
		{!!Form::select('module', $templates, null, ['class' =>'form-control']) !!}
		{!! $errors->first('module', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('count', 'Count:') !!}
		{!! Form::text('count', null, ['class' => 'form-control','placeholder'=>'0']) !!}
		{!! $errors->first('count', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('categories', 'Categories to show:') !!}
		{!!Form::select('categories[]', $categories, array_filter($model->categories) != null?$model->categories : '0' , ['multiple' => 'true','class' =>'form-control']) !!}
		{!! $errors->first('categories', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('orderBy', 'OrderBy:') !!}
		{!!Form::select('orderBy', array('date'=>'Date', 'id'=>'Id', 'name'=>'Name'), null, ['class' =>'form-control']) !!}
		{!! $errors->first('orderBy', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('startDate', 'Start Date:') !!}
		{!! Form::date('startDate', (isset($model->startDate))?$model->startDate:\Carbon\Carbon::now(),['class' => 'form-control']) !!}
		{!! $errors->first('startDate', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('endDate', 'End Date:') !!}
		{!! Form::date('endDate', (isset($model->endDate))?$model->endDate:\Carbon\Carbon::now(),['class' => 'form-control']) !!}
		{!! $errors->first('endDate', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('class', 'Class:') !!}
		{!! Form::text('class', null, ['class' => 'form-control']) !!}
		{!! $errors->first('class', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('position', 'Position:') !!}
		{!!Form::select('position', $arrays['widgetArray'], null, ['class' =>'form-control']) !!}
		{!! $errors->first('position', '<div class="text-danger">:message</div>') !!}
	</div>

	 <div class="form-group">
	{!! Form::label('device', 'Device:') !!}
			<br>
	{!! Form::checkbox('device[]', 'desktop'); !!} &nbsp; Desktop
			<br>
			{!! Form::checkbox('device[]', 'mobile'); !!} &nbsp; Mobile
	{!! $errors->first('device', '<div class="text-danger">:message</div>') !!}
	</div>

	<div class="form-group">
		{!! Form::label('days_count', 'No Of Days:') !!}
		{!!Form::select('days_count', ['0'=>'No Days Limit','15'=>'15','30'=>'30','45'=>'45','60'=>'60'], '0', ['class' =>'form-control']) !!}
		{!! $errors->first('days_count', '<div class="text-danger">:message</div>') !!}

	</div>

	<div class="form-group">
		{!! Form::label('menu', 'Menu:') !!}
		{!!Form::select('menu[]', $arrays['menuArray'], isset($model['menu'])? $model['menu'] : $arrays['menuArray'], ['multiple' => 'true','class' =>'form-control', 'id' => 'select_menu']) !!}
		{!! $errors->first('menu', '<div class="text-danger">:message</div>') !!}

	</div>
</div>	<!-- Col-md-9 closed -->

<div class="col-md-3 _sidebar">
	<div  class="box box_margin_bottom">
		<div class="box box_padding" data-toggle="collapse" data-target="#publish_body">
			{!! Form::label('publish', 'Publish:') !!}
			<button type="button" class="handlediv button-link" aria-expanded="true">
				<span class="fa fa-caret-down" aria-hidden="true"></span>
			</button>
		</div>
		<div class="box collapse in" id="publish_body">
			<div class="box_body right">
				{!! Form::Submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary', 'id'=>'submitForm' ] ) !!}
			</div>
		</div>
	</div>

</div>	<!-- Col-md-3 closed -->
</div>	<!-- Row closed closed -->
	{!! Form::close() !!}
</div> <!-- Container closed -->