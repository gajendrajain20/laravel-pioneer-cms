@if(isset($model))
{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.positions.update', $model->id]]) !!}
@else
{!! Form::open(['files' => true, 'route' => 'admin.positions.store']) !!}
@endif
	<div class="form-group">
		{!! Form::label('position', 'Name:') !!}
		{!! Form::text('position', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
		{!! $errors->first('position', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('nutshell', 'Nutshell / Comment :') !!}
		{!! Form::text('nutshell', null, ['class' => 'form-control']) !!}
		{!! $errors->first('nutshell', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}
