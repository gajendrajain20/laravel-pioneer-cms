@if(!empty($articles)) 
	<?php foreach ($articles as $widget) { 
		if($widget['show_popup']){ ?>
		
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">
						@if (isset($widget['title']))
							<strong>	<?php echo $widget['title'] ?> </strong>
						@endif
					</h4>
				  </div>
				  <div class="modal-body">
					<p>{!! html_entity_decode($widget['description']) !!}</p>
				  </div>
				  
				</div>

			  </div>
			</div>
<?php	}else{ ?>
			<div id="ads_hide" class="col-sm-12" style="margin-bottom: 15px;">
			<div class="row">
				@if(isset($widget['class']))
					<div class="{!! $widget['class'] !!}">
				@else
                <div class="">
				@endif
				
				@if (isset($widget['title']))
				<strong>	<?php echo $widget['title'] ?> </strong>
				@endif
				{!! html_entity_decode($widget['description']) !!}
					<?php // echo $widget['description']; ?>
				</div>
			</div>
		</div>
<?php	} 
	 }
?>
@endif
