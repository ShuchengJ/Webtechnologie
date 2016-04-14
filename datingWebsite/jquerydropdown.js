$(document).ready(function () {
	$( "#slider" ).slider({
		min:18,
		max:100,
		values:[ 18, 25 ],
		range:true,
		slide: function(event, ui) {
	        $("#amount").val(ui.values[0] + " - " + ui.values[1]);
	    }
	});
	
	$(".dropdown dt a").on('click', function() {
		  $(".dropdown dd ul").slideToggle('fast');
	});

	$('.listofbrands input[type="checkbox"]').on('click', function() {

		 var title = $(this).closest('.listofbrands').find('input[type="checkbox"]').val(),
		 title = $(this).val();

		 if ($(this).is(':checked')) {
		   var html = '<span title="' + title + '">&nbsp;' + title + '</span>';
		   if($('.showtext').text() == "Select here"){
				   $('.showtext').empty();
		   }
		   $('.showtext').append(html);
		 } else {
		   $('span[title="' + title + '"]').remove();
		 }
       $("#brands").val($('.showtext').text());
	   if(!$('.showtext').text())
		   $('.showtext').text("Select here");
	});
});
	