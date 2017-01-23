<?php

$myquery = mysqli_query($CONNECT, 'SELECT * FROM `post` LIMIT '.$_SESSION['loadnews'].', 5' );

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
	echo ("<td id='table-cor".$row['idPost']."' class='table-button table-button-red'>Ред</span></td>");
	echo ("<td id='table-del".$row['idPost']."' class='table-button table-button-del'>Дел</td>");

	echo "</tr>";



}

?>