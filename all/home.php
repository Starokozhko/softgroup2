<?php
top('Главная');
$_SESSION['loadallnews'] = 0;
?>


<script type="text/javascript">
	
function loader_allnews() {

	$.get('/loadallnews', function( data ) {
		

		if (data == 'empty' )
		 $('#allnews').text( 'Новостей нет' );
		else if ( data != 'end' )
			$('#allnews').append( data );

	}
		)

}

$(document).ready(function() {
	loader_allnews();
});

</script>

<section id="allnews">
	<h1 class='allnews-title'>Список статей:</h1>

</section>
<button class="mooNews" onclick="loader_allnews()">Еще новости</button>



<?php
bottom();
?>