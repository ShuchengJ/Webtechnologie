$(document).ready(function () {
	$logged_in = false;
	$.ajax({
	    type: "GET",
	    url: 'home/isLoggedIn',
	    dataType:"text",
	    success: function (data){
	    	if(data == 1){
	    		$logged_in = true;
	    	}
	    	getMatches();
	    }
	});
	
	function getMatches(){
	$.ajax({
	    type: "GET",
	    url: 'home/match_get',
	    dataType:"json",
	    success: function (data){
	    	if($logged_in){
	    		
	    		for(i = 0; i < data.length; i++){
	    	
	    		if(data[i].image != 'none'){
	    			$image = '../picture_'+data[i].image+'.jpg';
	    		}else{
	    			$image = '../picture'+data[i].gender+'.png';
	    		}
	    		$(".match#"+i).html("<img src='" + $image + "' class=images height=150px width=150px id=" + i + "><br>" +
	    				matchString(data));
	    		
	    		$(".match#"+i).addClass("status"+data[i].status);
	    		}
	    		
	    	}else{
	    	for(i = 0; i < data.length; i++){
	    		$(".match#"+i).html("<img src='../picture"+data[i].gender+".png' class=images height=150px width=150px id=" + i + "><br>" +
	    				matchString(data));
	    		}
	    	}
	    	for(j = data.length; j < 6; j++){
        		$(".match#"+j).html("no more matches!");
        	}
	    },
	});
	}
	
		$('#search').on('submit', function(e) {
	        e.preventDefault();
	        $.ajax({
	            url : "home/search",
	            type: "POST",
	            dataType:"json",
	            data: $(this).serialize(),
	            success: function (data) {
	            	if($logged_in){
	    	    		for(i = 0; i < data.length; i++){
	    	    
	    	    		if(data[i].image != 'none'){
	    	    			$image = '../picture_'+data[i].image+'.jpg';
	    	    		}else{
	    	    			$image = '../picture'+data[i].gender+'.png';
	    	    		}
	    	    		$(".match#"+i).html("<a href='home/detailUser'> <img src='" + $image + "' class=images height=150px width=150px>" +
	    	    				matchString(data));
	    	    		}
	    	    	}else{
	    	    	for(i = 0; i < data.length; i++){
	    	    		$(".match#"+i).html("<img src='../picture"+data[i].gender+".png' class=images height=150px width=150px><br>" +
	    	    				matchString(data));
	    	    		}
	    	    	}
	            	for(j = data.length; j < 6; j++){
	            		$(".match#"+j).html("no more results!");
	            	}
	            },
	            error: function (jXHR, textStatus, errorThrown) {
	                alert(errorThrown);
	                
	            }
	        });
	    });
	$('#zomaar').click(function(){
		getMatches();
	})
	
	function matchString(data){
		var description = "None";
		if(data[i].description)
			description = data[i].description.split('.')[0] + ".";
		var brands = "None";
		if(data[i].brands)
			brands = data[i].brands.split(' ', 5).join(" ");
		return 	"Nickname: " + data[i].nickname + "<br>" + 
				"Gender: " + data[i].gender + "<br>" + 
				"Age: " + data[i].age + "<br>" + 
				"Description: " + description + "<br>" + 
				"Personality: " + data[i].gender + "<br>" + 
				"Brands: " + brands;
	}
	
	$( "#slider-range" ).slider({
	      range: true,
	      min: 18,
	      max: 100,
	      values: [ 18, 25 ],
	      slide: function( event, ui ) {
	        $( "#age" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
	      }
	    });
	
	$( "#age" ).val($( "#slider-range" ).slider( "values", 0 ) +
	      " - " + $( "#slider-range" ).slider( "values", 1 ) );
	
});
	