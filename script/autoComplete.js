$( document ).ready(function() {
	$("input[name^='stu']").autocomplete({
		source: function(request, response) {
	  		$.ajax({
	  			url : "autoComplete.php",
	  			dataType: "json",
				data: {
				   name_startsWith: request.term,
				   type: "usernameAutoComplete"
				},
				success: function( data ) {
					response( $.map( data, function( item ) {
						return {
							label: item,
							value: item
						}
					}));
				}
	  		});
	  	}, 	
	  	minLength: 1
	});
	
	// $("input[name^='ex']").autocomplete({
	// 	source: function(request, response) {
	//   		$.ajax({
	//   			url : "autoComplete.php",
	//   			dataType: "json",
	// 			data: {
	// 			   name_startsWith: request.term,
	// 			   type: "exAutoComplete",
	// 			   ex: document.getElementsByTagName("select")[0].value
	// 			},
	// 			success: function( data ) {
	// 				response( $.map( data, function( item ) {
	// 					return {
	// 						label: item,
	// 						value: item
	// 					}
	// 				}));console.log(data);
	// 			}
	//   		});
	//   	}, 	
	//   	minLength: 0
	// });
});