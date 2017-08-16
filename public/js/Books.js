$( document ).ready(function() {
	
	$( "#ajaxCall" ).click(function() {
			$.ajax({ 
				 url: "application/controllers/admin/BooksController",
		         type: 'GET',
		         success: function(result) {
		            $( "#ajaxResult" ).append( "<p>Total Records: "+result+"</p>" );
		    }
	  	});
	});

});
