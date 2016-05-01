$(document).ready( function() {
 
	$("dt a[name!=refresh_top]").click( function() {

		$(this).closest('dt').next('dd').slideToggle("fast");
		$(this).toggleClass("open close");
		if ($(this).text() == "Anzeigen")
		   $(this).text("Ausblenden")
		else
		   $(this).text("Anzeigen");	
		return false;
	} );
	
	$("a[name=refresh_top").click( function() {
		alert("Test");
		$.ajax({
			url : '/system/get_top',
			type: 'GET',
			success : function(response){
				$(this).closest('dt').next('pre').html(response);
			}
		})
	} );
		
});