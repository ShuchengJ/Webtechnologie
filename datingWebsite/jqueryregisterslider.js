$(document).ready(function () {
	$( "#sliderEI" ).slider({
		min:0,
		max:100,
		value:0,
		slide: function(event, ui) {
	        $("#PersonEI").val(100 - ui.value);
	        $("#PersonI").val(ui.value);
	    }
	});
	
	$( "#sliderNS" ).slider({
		min:0,
		max:100,
		value:0,
		slide: function(event, ui) {
	        $("#PersonNS").val(100 - ui.value);
	        $("#PersonS").val(ui.value);
	    }
	});
	
	$( "#sliderFT" ).slider({
		min:0,
		max:100,
		value:0,
		slide: function(event, ui) {
	        $("#PersonFT").val(100 - ui.value);
	        $("#PersonF").val(ui.value);
	    }
	});
	
	$( "#sliderJP" ).slider({
		min:0,
		max:100,
		value:0,
		slide: function(event, ui) {
	        $("#PersonJP").val(100 - ui.value);
	        $("#PersonP").val(ui.value);
	    }
	});
});
	