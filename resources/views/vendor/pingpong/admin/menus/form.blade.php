@if(isset($model))
	
{!! Form::model($model, ['method' => 'PUT', 'files' => true,'id'=>'postFormID', 'route' => ['admin.menus.update', $model->id]]) !!}
@else

{!! Form::open(['files' => true, 'method'=>'post','id'=>'postFormID', 'route' => 'admin.menus.store']) !!}
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
				{!! Form::text('slug', null, ['class' => 'form-control']) !!}
				{!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
            </div>
            
            <div class="form-group">
				{!! Form::label('class', 'Class:') !!}
				{!! Form::text('class', null, ['class' => 'form-control']) !!}
				{!! $errors->first('class', '<div class="text-danger">:message</div>') !!}
            </div>

            <div class="form-group">
				{!! Form::label('position', 'Menu Position:') !!} 
                {!!Form::select('position',$menu_model['menuTypeArray'], null, ['class' =>'form-control']) !!} 
                {!! $errors->first('position', '<div class="text-danger">:message</div>') !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('type', 'Menu Type:') !!} 
                {!!Form::select('type', [''=>'Select Menu Type','category'=>'Category','post'=>'Post','page'=>'Page','video'=>'Video', 'module'=>'Module', 'custom'=>'Custom'], null, ['class' =>'form-control', 'id' => 'menu_type']) !!} 
                {!! $errors->first('type', '<div class="text-danger">:message</div>') !!}               
		
            </div>
            
            <div class="form-group" id="menu_type_elements_div">
                {!! Form::label('post_id', 'Post/Page/Category:', ['id' => "menu_type_elements"]) !!} 
                {!!Form::select('post_id', $menu_model['elements'], null, ['class' =>'form-control']) !!} 
                {!! $errors->first('post_id', '<div class="text-danger">:message</div>') !!}            	
            </div>
            
            <div class="form-group" id="custom_url_div">
                {!! Form::label('custom', 'Custom Url:') !!}
                {!! Form::text('custom', null, ['class' => 'form-control']) !!}
                {!! $errors->first('custom', '<div class="text-danger">:message</div>') !!}
            </div>
                       
            <div class="form-group">
                {!! Form::label('parent', 'Parent Menu:') !!} 
                {!!Form::select('parent', $menu_model['menuArray'], null, ['class' =>'form-control']) !!} 
                {!! $errors->first('parent', '<div class="text-danger">:message</div>') !!}               
		
            </div>
            
            <div class="form-group">
                {!! Form::label('status', 'Status:') !!} 
                {!!Form::select('status', [''=>'Select Status','1'=>'Active','0'=>'Inactive'], null, ['class' =>'form-control']) !!} 
                {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}               
		
            </div>
            
        </div>

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
        </div>
    </div>
</div>

<div class="loading-modal"></div>

@section('script')

<script type="text/javascript">

$(document).on({
    ajaxStart: function() { $("body").addClass("loading");   },
    ajaxStop: function()  { $("body").removeClass("loading"); }
});


    $(document).ready(function () {
		
		//Hiding the custom url textfield & element type list in starting stage
		$("#custom_url_div").hide();
		$("#menu_type_elements_div").hide();
		
		//showing the required field on the selected menu type
		if($("#menu_type").text() !=null){
			var str = "";
			str = $("#menu_type option:selected").text().toLowerCase();
		//	alert("str is : "+str.toLowerCase());
			if(str != "custom"){
				$("#custom_url_div").hide();
				$("#menu_type_elements_div").show();
				//$("#post_id").val(str);
				//Changing Label above seect box
				$("#menu_type_elements").text("Select a "+str);
			}else{
				$("#custom_url_div").show();
				$("#menu_type_elements_div").hide();
			}
		}
		
		// if nothing is selected in menu type then don't show any list below it 
		if($("#menu_type option:selected").text().toLowerCase() == "select menu type")
		{
			$("#menu_type_elements").text("Post/Page/Category:");
			$('#menu_type_elements_div select').html('<option value = null >Select menu type first</option>');
		}
		
		//pupulating the select box with different list on the selected menu type
		// url gets the selected string in the select box & siteUrl gets the base url of our site,
		// which is used to get the specific list on the basis of selected menu type
		function populate_select(url,siteUrl){
			$("#custom_url_div").hide();
			$.ajax({url: siteUrl+"/admin/"+url+"/get_"+url+"_list", success: function(result){
				
				var arrayLength = result.length;
				//Getting array length & iterating through it
				$('#menu_type_elements_div').find('option').remove();
					
					html_str = "";
						for (var i = 0; i < arrayLength; i++) {
							html_str += '<option value="'+result[i]['id']+'">'+result[i]['title']+'</option>';
						}
				//adding the new options to select menu
				$('#menu_type_elements_div select').html(html_str);
			}});
		}
		
		$( "#menu_type" ).change(function () {
			var str = "";
			$( "#menu_type option:selected" ).each(function() {
			  str = $( this ).text();
				if(str == "Custom"){
					$("#custom_url_div").show();
					$("#menu_type_elements_div").hide();
				}else if(str == "Post"){
					populate_select("article",'{!! $url=url() !!}'); //url() gives the base url of domain
				}else if(str == "Video"){
					populate_select("video",'{!! $url=url() !!}');
				}else if(str == "Page"){
					populate_select("page",'{!! $url=url() !!}');
				}else if(str == "Category"){
					populate_select("category",'{!! $url=url() !!}');
				}else if(str == "Module"){
					populate_select("module",'{!! $url=url() !!}');
				}
				if(str != "Custom"){
					$("#menu_type_elements_div").show();
					$("#custom_url_div").hide();
					//Changing Label above select box
					if($("#menu_type option:selected").text().toLowerCase() == "select menu type")
					{
						$("#menu_type_elements").text("Post/Page/Category:");
						$('#menu_type_elements_div select').html('<option value = null >Select menu type first</option>');
					}else{
						$("#menu_type_elements").text("Select a "+str);
					}
				}
			});
		});
    });
</script>
@stop
