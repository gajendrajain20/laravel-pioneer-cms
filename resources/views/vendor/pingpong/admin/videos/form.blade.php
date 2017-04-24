@if(isset($model))

{!! Form::model($model, ['method' => 'PUT', 'files' => true,'id'=>'postFormID', 'route' => ['admin.videos.update', $model->id]]) !!}
@else

{!! Form::open(['files' => true, 'method'=>'post','id'=>'postFormID', 'route' => 'admin.videos.store']) !!}
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
		{!! Form::label('slug', 'Slug:') !!} 
		{!! Form::text('slug', null,['class' => 'form-control']) !!} 
		{!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
	</div>
	
        <div class="form-group">
		{!! Form::label('description', 'Description:') !!} 
		{!! Form::textarea('description',null, ['class' => 'form-control', 'id' => 'ckeditor']) !!} 
		{!!$errors->first('description', '<div class="text-danger">:message</div>') !!}
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
                    <div class="box_padding form-group">
						{!! Form::label('status', 'Status:') !!} 
						{!! Form::select('status',array('0' => 'Draft', '1' => 'Publish'),(isset($model->status)?$model->status:'1'),['class' =>'select_box select_status']) !!} 
						{!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
					</div>
					<div class="box_padding form-group">
						{!! Form::label('published_on', 'Publish On:') !!} 
						{!! Form::text('published_on', ((isset($model->published_on) && $model->published_on!='0000-00-00 00:00:00')?date('d-m-Y',strtotime($model->published_on)):date('d-m-Y')),['id' => 'datepicker']) !!}
						{!! $errors->first('published_on', '<div class="text-danger">:message</div>') !!}
					</div>
			<div class="box_body right">
				<a href="/preview" target='_blank' id = 'previewButton'>
						{!! Form::button('Preview',['class' => 'btn btn-primary']) !!}
				</a>
				{!! Form::Submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary', 'id'=>'submitForm' ] ) !!}
			</div>
		</div>
	</div>

	<div  class="box box_margin_bottom">
		<div class="box box_padding" data-toggle="collapse" data-target="#meta_title_body">
			{!! Form::label('meta_title', 'Meta Title:') !!}
			<button type="button" class="handlediv button-link" aria-expanded="true">
				<span class="fa fa-caret-down" aria-hidden="true"></span>
			</button>
		</div>
		@if(isset($model) && $model->meta_title)
				<div class="box collapse in" id="meta_title_body">
			@else
				<div class="box collapse" id="meta_title_body">
		@endif
			<div class="box_body">
				{!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Meta Title']) !!}
			</div>
		</div>
		{!! $errors->first('meta_title', '<div class="box_padding text-danger">:message</div>') !!}
	</div>
	
	<div  class="box box_margin_bottom">
		<div class="box box_padding" data-toggle="collapse" data-target="#meta_description_body">
			{!! Form::label('meta_description', 'Meta Description:') !!}
			<button type="button" class="handlediv button-link" aria-expanded="true">
				<span class="fa fa-caret-down" aria-hidden="true"></span>
			</button>
		</div>
		@if(isset($model) && $model->meta_description)
				<div class="box collapse in" id="meta_description_body">
			@else
				<div class="box collapse" id="meta_description_body">
		@endif
			<div class="box_body">
				{!! Form::text('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Meta Description']) !!}
			</div>
		</div>
		{!! $errors->first('meta_desc', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div  class="box box_margin_bottom">
		<div class="box box_padding" data-toggle="collapse" data-target="#tags_body">
			{!! Form::label('tags', 'Tags:') !!}
			<button type="button" class="handlediv button-link" aria-expanded="true">
				<span class="fa fa-caret-down" aria-hidden="true"></span>
			</button>
		</div>
		@if(isset($model) && $model->tags)
			<div class="box collapse in" id="tags_body">
		@else
			<div class="box collapse" id="tags_body">
		@endif
			<div id="tags" class="box_body2">
				{!! Form::text('tags', null, ['class' => 'form-control no_border_radius block', 'data-role' => 'tagsinput' , 'placeholder' => 'Tags']) !!}
			</div>
			
		</div>
		{!! $errors->first('tags', '<div class="box_padding text-danger">:message</div>') !!}
	</div>
	<div  class="box box_margin_bottom">
		<div class="box box_padding" data-toggle="collapse" data-target="#featuredImage_body">
			{!! Form::label('image', 'Featured Image:') !!}
			<button type="button" class="handlediv button-link" aria-expanded="true">
				<span class="fa fa-caret-down" aria-hidden="true"></span>
			</button>
		</div>

        <div class="box collapse in" id="featuredImage_body">
			<div class="form-group" id="imagePreviewDiv">
				@if(isset($model))
					@if($model->image) <img class="img-responsive" id="imagePreview" src="<?php echo $model->image ?>" > @endif
				@endif
			</div>
			<div> 	
				<label for="featured_image_in_content" class="featured-image-text">
    				{!!Form::checkbox('show_featured_image', 1,
    				(isset($model) && $model['show_featured_image'])? true:"", ['class' =>'form-control']) !!}
    				Show Featured image in Video
				 </label>
				<button type="button" class="modalButton btn btn-primary" data-toggle="modal" data-src="/admin/filemanager/showModal" data-width="768" data-height="1280" data-target="#myModal" data-video-fullscreen="true">Select Image</button>
				{!! Form::text('image', null,['class' => 'form-control hidden','id' => 'selectedImage' ,'placeholder' => 'image']) !!}
				
			</div>
		</div>
		{!! $errors->first('image', '<div class="box_padding text-danger">:message</div>') !!}
	</div>
	<!-- including file manager modal-->
	@include('admin::filemanager.imageselect_modal')	
</div>	<!-- Col-md-3 closed -->
</div>	<!-- Row closed closed -->
	{!! Form::close() !!}
</div> <!-- Container closed -->

@section('script')

    {!! script('vendor/ckeditor/ckeditor.js') !!} 
    {!! script('vendor/ckfinder/ckfinder.js') !!}
	
	<script type="text/javascript">
		var prefix = '{!! asset(option("ckfinder.prefix")) !!}';
		CKEDITOR.editorConfig = function( config ) {
		   config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
		   config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
		   config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
		   config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		   config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		   config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
		};

		var editor = CKEDITOR.replace( 'ckeditor' );
		CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
	</script>
@stop