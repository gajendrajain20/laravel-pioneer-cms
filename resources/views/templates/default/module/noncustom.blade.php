@if(!empty($widgetsData)) 
	<?php foreach ($widgetsData as $i => $data) {
		$widgetData = $data['widgetData']; ?>
		@if($widgetData != null)
		
			<div id="ads_hide" class="col-sm-12" style="margin-bottom: 15px;">
				<div class="row">
					@if(isset($widgetData['class']))
						<div class="{!! $widgetData['class'] !!}">
					@else
						<div class="">
					@endif
					
					@if (isset($widgetData['title']))
					<strong>
						<h4 class="block-title red_title">    
							<span>{{ $widgetData['title'] }}</span>
						</h4>
					</strong>
					@endif
				<?php	echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->createView($data['module'], $data['ncData']); ?>	

				</div>
				@if (isset($widgetData['seeAll']))
					<div class="td-read-more">
						<a href = "/category/<?php echo $widgetData['seeAll'] ?>">See All</a>
					</div>
				@endif
				</div>
			</div>
		
		@else
		<?php 	echo App::make("Modules\Frontend\Http\Controllers\FrontendController")->createView($data['module'], $data['ncData']);  ?>
		@endif
<?php	
	}
?>
@endif