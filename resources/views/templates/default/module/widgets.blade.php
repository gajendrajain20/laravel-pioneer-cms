@if(!empty($widgets))

	<?php foreach ($widgets as $widget) { ?>
    <div id="ads_hide" class="col-sm-12" style="margin-bottom: 15px;">
			<div class="row">
				@if(isset($widget['class']))
					<div class="{!! $widget['class'] !!}">
				@else
					<div class="">
				@endif
				 <?php $truncatedHtml =  \Modules\Frontend\Http\helpers::truncate_html($widget['description'], 60); ?>
				{!! html_entity_decode($truncatedHtml) !!}
					<?php // echo $widget['description']; ?>
				</div>
			</div>
		</div>
	<?php }
	?>
@endif
