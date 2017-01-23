<?php
top('История');
$_SESSION['loader'] = 0;
?>

<script type="text/javascript">
	
function loader_history() {

	$.get('/loader', function( data ) {
		

		if (data == 'empty' )
		 $('#space').text( 'История пуста' );
		else if ( data != 'end' )
			$('#space').append( data );

	}
		)

}

$(document).ready(function() {
	loader_history();
});

</script>

<button onclick="loader_history()">Загрузить</button>

<div id="space"></div>

<?php
bottom();
?>