<?php

$myquery = mysqli_query($CONNECT, 'SELECT * FROM `post` ORDER BY `idPost` DESC LIMIT '.$_SESSION['loadnews'].', 5' );

if ( !mysqli_num_rows($myquery) ) {
	if ( $_SESSION['loadnews'] == 0 ) exit('empty'); 
	else exit('end');
	exit;
}
$_SESSION['loadnews'] += 5;

while ( $row = mysqli_fetch_assoc($myquery) ) {
	echo "<tr>";

	echo ("<td class='table-id-row'>".$row['idPost']."</td>");
	echo ("<td class='table-title'>".$row['titlePost']."</td>");
	echo ("<td id='table-cor".$row['idPost']."' class='table-button table-button-red' onclick='correctnews(".$row['idPost'].")'>Ред</span></td>");
	echo ("<td id='table-del".$row['idPost']."' class='table-button table-button-del' onclick='delnews(".$row['idPost'].")'>Дел</td>");

	echo "</tr>";



}

?>
<script>
	

function delnews(delid) {

	$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'delnews_f=1&idPost=' + delid,
			cache: false,
			success: function( result ) {

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});
}

function correctnews(corid) {
$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'correctnews_f=1&idPost=' + corid,
			cache: false,
			success: function( result ) {

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});
}

</script>