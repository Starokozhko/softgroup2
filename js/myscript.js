
	function log_in( url, name, data ) {

		var str = '';

		$.each( data.split('.'), function(key, value) {
			str += '&' + value + '=' + $('#' + value).val();
		} );



		$.ajax({
			url: '/' + url,
			type: 'POST',
			data: name + '_f=1' + str,
			cache: false,
			success: function( result ) {
				
				var obj = jQuery.parseJSON( result );

				if( obj.go ) gotourl( obj.go )
					else alert( obj.message );

			},
		});



	}
	
	function gotourl( url ) {
		window.location.href = '/' + url;
	}



// 		


	// }
