$(document).ready(function () {
	//initiating the image select modal
	iframeModalOpen();
	
    $(document).on("keypress", "form", function (event) {
        return event.keyCode != 13;
    });
	$(document).on("keypress", "#search", function (event) {
        if(event.keyCode == 13){
			return event.keyCode = 13;
		}
    });
	
    $(function () {
        $("#datepicker").datepicker({
            format: 'dd-mm-yyyy'
        }                
        );
    });
	
	$('#previewButton').click(function(){     
	
		localStorage.setItem("title", $('#title').val());		
		localStorage.setItem("published_on", $('#datepicker').val());		
		localStorage.setItem("body", CKEDITOR.instances['ckeditor'].getData());		
		localStorage.setItem("image", $('#selectedImage').val());		
	});
	
	function iframeModalOpen(){

		// we set the attributes to be added iframe eg: data-src will setup the url iframe
		$('.modalButton').on('click', function(e) {
			//clearing previously stored data from localStorage
			localStorage.removeItem('selectedImage');
			
			var src = $(this).attr('data-src');
			//var width = $(this).attr('data-width') || 640; 
			//var height = $(this).attr('data-height') || 360;
			var width = 1000; 
			var height = 800;

			var allowfullscreen = $(this).attr('data-video-fullscreen'); // we set the button if the allowfullscreen attribute is a video to allow you to switch to full screen mode
			
			// We print our iframe data
			$("#myModal iframe").attr({
				'src': src,
				'height': height,
				'width': width,
				'allowfullscreen':''
			});
		});

		// if you close the modal iframe we reset the data to prevent further actions even when the modal is closed
		$('#myModal').on('hidden.bs.modal', function(){
			//setting the selected image in modal to the image element in page
			var url = localStorage.getItem('selectedImage');
			if(url.length != 0){
				$('#selectedImage').val(url);
			}
			console.log("selected image url set to "+url+ " in form data");
			//add an empty image element with no src value to show our selected image
		//	$('#imagePreviewDiv').html('<img class="img-responsive" id="imagePreview" src="<?php echo $model->image ?>" >');
			$('#imagePreviewDiv').html('<img class="img-responsive" id="imagePreview" src="" >');
			//removing stored data from localStorage
			localStorage.removeItem('selectedImage');
			
			//attach selected image to our empty image element
			$("#imagePreview").attr("src",url);
			$(this).find('iframe').html("");
			$(this).find('iframe').attr("src", "");
		});
	}
	
});