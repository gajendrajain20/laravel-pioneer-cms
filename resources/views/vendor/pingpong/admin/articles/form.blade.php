@if(isOnPages()) 
    @if(isset($model)) 
    {!! Form::model($model, ['method' =>'PUT', 'files' => true,'id'=>'postFormID', 'route' =>['admin.pages.update', $model->id]]) !!} 
    @else 
    {!! Form::open(['files'=> true, 'method'=>'post','id'=>'postFormID', 'route' =>'admin.pages.store']) !!} 
    @endif 
@else 
    @if(isset($model)) 
    {!!Form::model($model, ['method' => 'PUT', 'files' =>true,'id'=>'postFormID', 'route' => ['admin.articles.update',$model->id]]) !!} 
    @else 
    {!! Form::open(['files' => true,'method'=>'post', 'id'=>'postFormID', 'route' =>'admin.articles.store']) !!} 
    @endif 
@endif
<div class="container">
	<div class="row">
		<div class="col-md-9 wrapper_div">

			<div class="form-group">
				{!! Form::label('title', 'Title:') !!} 
				{!! Form::text('title', null,['class' => 'form-control', 'id' => 'title', 'autofocus'=>'autofocus']) !!} 
				{!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
			</div>

			<div class="form-group">
				{!! Form::label('slug', 'Slug:') !!} 
				{!! Form::text('slug', null,['class' => 'form-control']) !!} 
				{!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('body', 'Body:') !!} 
				{!! Form::textarea('body',null, ['class' => 'form-control body_content', 'id' => 'ckeditor']) !!} 
				{!!$errors->first('body', '<div class="text-danger">:message</div>') !!}
			</div>
			
		</div>
		<!-- Col-md-9 closed -->

		<div class="col-md-3 _sidebar">
			<div class="box box_margin_bottom">
				<div class="box box_padding" data-toggle="collapse"
					data-target="#publish_body">
					{!! Form::label('publish', 'Publish:') !!}
					<button type="button" class="handlediv button-link"
						aria-expanded="true">
						<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
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
						{!! Form::Submit(isset($model) ?'Update' : 'Save', ['class' => 'btn btn-primary','id'=>'submitForm' ] ) !!}
					</div>
				</div>
			</div>
			
			@if(! isOnPages())
				<div class="box box_margin_bottom">
					<div class="box box_padding" data-toggle="collapse"
						data-target="#categories_listing">
						{!! Form::label('categories', 'Categories:') !!}
						<button type="button" class="handlediv button-link"
							aria-expanded="true">
							<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
						</button>
					</div>
					@if(isset($model) && $model->category_id)
						<div class="box collapse in" id="categories_listing">
					@else
						<div class="box collapse" id="categories_listing">
					@endif
					<div class="box_body">
						@if(isset($model))
							@include('admin::partials.listCategories', ['categories' => $categories, 'model'=>$model])
						@else
							@include('admin::partials.listCategories', ['categories' => $categories])
						@endif
							
					</div>
					</div>
					{!! $errors->first('category_id', '<div class="text-danger">:message</div>') !!}
				</div>
			@else 
				{!! Form::hidden('type', 'page') !!}                         
			@endif
			
			<div class="box box_margin_bottom">
				<div class="box box_padding" data-toggle="collapse"
					data-target="#meta_title_body">
					{!! Form::label('meta_title', 'Meta Title:') !!}
					<button type="button" class="handlediv button-link"
						aria-expanded="true">
						<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
					</button>
				</div>
				@if(isset($model) && $model->meta_title)
					<div class="box collapse in" id="meta_title_body">
				@else
					<div class="box collapse" id="meta_title_body">
				@endif
				<div class="box_body">{!! Form::text('meta_title', null, ['class'
					=> 'form-control', 'placeholder' => 'Meta Title']) !!}</div>
				</div>
				{!! $errors->first('meta_title', '
				<div class="box_padding text-danger">:message</div>
				') !!}
			</div>

				<div class="box box_margin_bottom">
					<div class="box box_padding" data-toggle="collapse"
						data-target="#meta_description_body">
						{!! Form::label('meta_description', 'Meta Description:') !!}
						<button type="button" class="handlediv button-link"
							aria-expanded="true">
							<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
						</button>
					</div>
					@if(isset($model) && $model->meta_description)
					<div class="box collapse in" id="meta_description_body">
						@else
						<div class="box collapse" id="meta_description_body">
							@endif
							<div class="box_body">{!! Form::text('meta_description', null,
								['class' => 'form-control', 'placeholder' => 'Meta Description']) !!}</div>
						</div>
						{!! $errors->first('meta_desc', '
						<div class="text-danger">:message</div>
						') !!}
					</div>

					@if(! isOnPages())
					<div class="box box_margin_bottom">
						<div class="box box_padding" data-toggle="collapse"
							data-target="#tags_body">
							{!! Form::label('tags', 'Tags:') !!}
							<button type="button" class="handlediv button-link"
								aria-expanded="true">
								<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
							</button>
						</div>
						@if(isset($model) && $model->tags)
						<div class="box collapse in" id="tags_body">
							@else
							<div class="box collapse" id="tags_body">
								@endif
								<div id="tags" class="box_body2">
								{!! Form::text('tags',null,['class'=>'tag-input','id'=>'tag-input-box']) !!}
								</div>
							</div>
							{!! $errors->first('tags', '
							<div class="box_padding text-danger">:message</div>
							') !!}
						</div>
						@endif
						
						<div class="box box_margin_bottom">
							<div class="box box_padding" data-toggle="collapse"
								data-target="#featuredImage_body">
								{!! Form::label('image', 'Featured Image:') !!}
								<button type="button" class="handlediv button-link"
									aria-expanded="true">
									<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
								</button>
							</div>
							@if(isset($model) && $model->image)
							<div class="box collapse in" id="featuredImage_body">
							@else
							<div class="box collapse" id="featuredImage_body">
							@endif
								<label for="featured_image_in_content" class="featured-image-text">
    							{!!Form::checkbox('show_featured_image', 1,
        						(isset($model) && $model['show_featured_image'])? true:"", ['class' =>'form-control']) !!}
        						Show Featured image in post
        						 </label>
								<div class="form-group" id="imagePreviewDiv" >
								@if(isset($model))
									@if($model->image) <img class="img-responsive" id="imagePreview" src="<?php echo $model->image ?>" > @endif
								@endif
								</div>
								<div >
									<button type="button" class="modalButton btn btn-primary" data-toggle="modal" data-src="/admin/filemanager/showModal" data-width="768" data-height="1280" data-target="#myModal" data-video-fullscreen="true">Select Image</button>
									{!! Form::text('image', null,['class' => 'form-control hidden','id' => 'selectedImage' ,'placeholder' => 'image']) !!}	
								</div>
							</div>
							{!! $errors->first('image', '<div class="box_padding text-danger">:message</div>') !!}
						</div> 
						{!! Form::close() !!}

						</div>
						<!-- Col-md-3 closed -->
					</div>
					<!-- Row closed closed -->
					<div class="modal"></div>
					@include('admin::filemanager.imageselect_modal')
					
				</div>
				<!-- Container closed -->
				@section('script') 
				{!! script('vendor/ckeditor/ckeditor.js') !!} 
				{!!	script('vendor/ckfinder/ckfinder.js') !!}
				
				
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

					$(document).ready(function(){

						// Instantiate the Bloodhound suggestion engine
						var tags = new Bloodhound({
						    datumTokenizer: function (datum) {
						        return Bloodhound.tokenizers.whitespace(datum.value);
						    },
						    queryTokenizer: Bloodhound.tokenizers.whitespace,
						    remote: {
						        url: '/admin/tags/search?query=%QUERY',
						        filter: function (tags) {
						            // Map the remote source JSON array to a JavaScript object array
						            return $.map(tags, function (_tag) {
						                return {
						                    tag: _tag.tag
						                };
						            });
						        }
						    }
						});

						// Initialize the Bloodhound suggestion engine
						tags.initialize();

						$('.tag-input').tagInput({

							  // tags separator
							  tagDataSeparator: ',',

							  // allow duplicate tags
							  allowDuplicates: false,

							  // enable typehead.js
							  typeahead: true,

							  // tyhehead.js options
							  typeaheadOptions: {
							      highlight: true
							  },

							  // typehead dataset options
							  typeaheadDatasetOptions: {
							    displayKey: 'tag',
							    source: tags.ttAdapter()
							  }
							  
						});
					});
					
				</script>
				@stop