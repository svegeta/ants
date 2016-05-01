$(document).ready( function() {
 
	$('dt').click( function() {

		$(this).next('dd').slideToggle("slow");
		$(this).children("a").toggleClass("open close");
		if ($(this).children("a").text() == "Anzeigen")
		   $(this).children("a").text("Ausblenden")
		else
		   $(this).children("a").text("Anzeigen");
;		
		return false;
	} );
		
});