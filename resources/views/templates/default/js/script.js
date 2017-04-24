$(document).ready(function(){
	$("img").ready(function () {
	
		$("img").error(function () {
			console.log("img error occured.... switching to deafult image");
			if ($(this).attr("src") != "/public/images/default.jpg"){
				$(this).attr("src","/public/images/default.jpg");
			}	
		});
	});
	$(function() {
		$('#main-menu').smartmenus({
			mainMenuSubOffsetX: -1,
			mainMenuSubOffsetY: 4,
			subMenusSubOffsetX: 6,
			subMenusSubOffsetY: -6
		});
	});
	
// to show loader on screen while making ajax call
	$body = $("body");

	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		ajaxStop: function() { $body.removeClass("loading"); }    
	});
});

 $(window).load(function(){
     $('#myModal').modal('show');
   });