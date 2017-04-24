$(document).ready(function(){
	
	var title = localStorage.getItem("title");
	var image = localStorage.getItem("image");
	var date = localStorage.getItem("published_on");
	var body = localStorage.getItem("body");
	
	$('#title').html(title);
	$('#body_content').html(body);
	$('#image').attr('src',image);
	$('#date').html(date);
});