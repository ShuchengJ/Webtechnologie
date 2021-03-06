$(document).ready(function () {
	$logged_in = false;
	$.ajax({
	    type: "GET",
	    url: 'like/isLoggedIn',
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
	    url: 'like/match_get',
	    dataType:"json",
	    success: function (data){
	    	if($logged_in){
	    		
	    		for(i = 0; i < data.length; i++){
	    	
	    		if(data[i].image != 'none'){
	    			$image = '../picture_'+data[i].image+'.jpg';
	    		}else{
	    			$image = '../picture'+data[i].gender+'.png';
	    		}
	    		$(".match#"+i).html("<img src='" + $image + "' height=150px width=150px id=" + i + "><br>" +
						"nickname: " + data[i].nickname + 
						"<br>" + 
						"gender: " + data[i].gender + "   " + data[i].age);
	    		
	    		$(".match#"+i).addClass("status"+data[i].status);
	    		}
	    		
	    	}else{
	    	for(i = 0; i < data.length; i++){
	    		$(".match#"+i).html("<img src='../picture"+data[i].gender+".png' height=150px width=150px id=" + i + "><br>" +
	    							"nickname: " + data[i].nickname + 
	    							"<br>" + 
	    							"gender: " + data[i].gender  + "   " + data[i].age);
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
	    	    		$(".match#"+i).html("<a href='home/detailUser'> <img src='" + $image + "' height=150px width=150px>" +
	    						"nickname: " + data[i].nickname + 
	    						"<br>" + 
	    						"gender: " + data[i].gender  + "   " + data[i].age);
	    	    		}
	    	    	}else{
	    	    	for(i = 0; i < data.length; i++){
	    	    		$(".match#"+i).html("<img src='../picture"+data[i].gender+".png' height=150px width=150px><br>" +
	    	    							"nickname: " + data[i].nickname + 
	    	    							"<br>" + 
	    	    							"gender: " + data[i].gender  + "   " + data[i].age);
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
	$('.zomaar').click(function(){
		getMatches();
	})

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
	