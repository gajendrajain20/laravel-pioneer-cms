$(document).ready(function(){
	
	var storedNames = JSON.parse(localStorage.getItem("names"));
	alert(storedNames);
});