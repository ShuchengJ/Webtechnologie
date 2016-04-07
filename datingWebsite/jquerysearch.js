$(document).ready(function () {
	
	$( "#slider-range" ).slider({
	      range: true,
	      min: 18,
	      max: 100,
	      values: [ 18, 100 ],
	      slide: function( event, ui ) {
	        $( "#age" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
	      }
	    });
	
	$( "#age" ).val($( "#slider-range" ).slider( "values", 0 ) +
	      " - " + $( "#slider-range" ).slider( "values", 1 ) );
	
});
	