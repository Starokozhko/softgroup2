<?php
$myusers = mysqli_query($CONNECT, "SELECT * FROM `new_users`");

	while ( $row = mysqli_fetch_assoc($myusers) ) {
		
		echo "<tr>";

		echo ("<td class='table-id-row'>".$row['id']."</td>");
		echo ("<td class='table-id-row'>".$row['firstname']."</td>");
		echo ("<td class='table-id-row'>".$row['lastname']."</td>");
		echo ("<td class='table-id-row'>".$row['email']."</td>");
		echo ("<td id='table-del".$row['idPost']."' class='table-button table-button-del' onclick='deluser(".$row['id'].")'>Удалить</td>");

		echo "</tr>";

	}

?>
<script>
	

function deluser(delid) {
	
	$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'deluser_f=1&iduser=' + delid,
			cache: false,
			success: function( result ) {

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});
}
</script>


