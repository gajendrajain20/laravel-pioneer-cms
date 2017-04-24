@if(Session::has('flash_message') && (Session::get('flash_message') != 'Login Success!'))
<div class="alert flash-message text-center alert-{!! Session::get('flash_type', 'info') !!} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {!! Session::get('flash_message') !!}
</div>
@section('script')
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('.flash-message').delay(3000).slideUp();
		});
	</script>
@stop
@endif
