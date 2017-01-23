<?php
top('Статьи');
$_SESSION['loadnews'] = 0;
?>

<script type="text/javascript">
	
function loader_news() {

	$.get('/loadnews', function( data ) {
		

		if (data == 'empty' )
		 $('#table').text( 'Записей нет' );
		else if ( data != 'end' )
			$('#table').append( data );

	}
		)

}

$(document).ready(function() {
	loader_news();
});

</script>
<!-- <section class="form-login">
	<h1>Редакторование</h1>
	<p><input id="password" type="password" placeholder="Новый пароль"></p>
	<p><button onclick="log_in('aform', 'edit', 'password')">Сохранить</button></p>
</section> -->
 <section class="form-login">
 <h1>Список записей</h1>

<table id="table">

				<tr>
					<th class='table-id'>№</th>
					<th class='table-title'>Название статьи</th>
					<th colspan='2' id='table-add' class='table-button-plus'>Добавить</th>
				</tr>

				</tr>


	</table>
<button onclick="loader_news()">Еще саписи</button>

 </section>



<?php
bottom();
?>