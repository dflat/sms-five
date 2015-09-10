$(function(){
	
	 $(".modal-location-button").hover(function() {
	 	var display_text = ($(this).attr('data-destination'));
 	 $("#hovered-icon-text").html(display_text);
 	 
		});
});