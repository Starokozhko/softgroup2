<?php
top('Пользователи');
?>

<script>
	
	function getusers() {

	$.get('/loaduser', function( data ) {
		

		if (data == 'empty' )
		 $('#table').text( 'Записей нет' );
		else if ( data != 'end' )
			$('#table').append( data );

	}
		)

};
getusers();

</script>

 <section class="form-users">
 <h1>Список пользователей</h1>

<table id="table">

				<tr>
					<th class='table-id'>№</th>
					<th class='table-title'>Имя</th>
					<th class='table-title'>Фамилия</th>
					<th class='table-title'>Електронный адрес</th>
					<th id='table-add' class='table-button-plus' onclick='showline()'>Добавить</th>
				</tr>

				</tr>


	</table>


 </section>
 <section class="form-adduser">
	
	<h1>Добавление пользователя</h1>
	<p><input id="firstnameA" type="text" placeholder="Ваше имя"> <input id="lastnameA" type="text" placeholder="Фамилия"></p>
	
	<p><input id="emailA" type="email" placeholder="E-mail"> <input id="passwordA" type="password" placeholder="Пароль"></p>
	
	<p><button onclick="adduser()">Добавить пользователя</button></p>

</section>
<script>

function showline() {
	$('.form-adduser').css('display', 'block');
}
	
function adduser() {

	var firstname = $('#firstnameA')[0].value,
			lastname = $('#lastnameA')[0].value,
			email = $('#emailA')[0].value,
			password = $('#passwordA')[0].value;
			
			$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'adduser_f=1&firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&password=' + password,
			cache: false,
			success: function( result ) {

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});
	};


</script>

<?php
bottom();
?>