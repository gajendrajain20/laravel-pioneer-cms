@if(isset($model))

{!! Form::model($model, ['method' => 'PUT', 'files' => true,'id'=>'postFormID', 'route' => ['event.update', $model->id]]) !!}
@else

{!! Form::open(['files' => true, 'method'=>'post','id'=>'postFormID', 'route' => 'event.store']) !!}
@endif
<div class="container">
<div class="row">
<div class="col-md-12 wrapper_div">

	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
		{!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('eventStart', 'Event start:') !!} 
		{!! Form::date('eventStart', ((isset($model->eventEnd) && $model->eventEnd!='0000-00-00 00:00:00')?date('d-m-Y',strtotime($model->eventEnd)): \Carbon\Carbon::now())) !!}
		{!! $errors->first('eventStart', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('eventEnd', 'Event End:') !!} 
		{!! Form::date('eventEnd',((isset($model->eventEnd) && $model->eventEnd!='0000-00-00 00:00:00')?date('d-m-Y',strtotime($model->eventEnd)): \Carbon\Carbon::now())) !!}
		{!! $errors->first('eventEnd', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="box_body ">
		{!! Form::Submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary', 'id'=>'submitForm' ] ) !!}
	</div>
</div>	<!-- Col-md-12 closed -->
</div>	<!-- Row closed closed -->
	{!! Form::close() !!}
</div> <!-- Container closed -->