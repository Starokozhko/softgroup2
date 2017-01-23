<?php

$myquery = mysqli_query($CONNECT, "SELECT * FROM `post` WHERE `idPost` = $_SESSION[www]" );

if ( !mysqli_num_rows($myquery) ) {
	if ( $_SESSION['loadonenews'] == 0 ) exit('empty'); 
	else exit('end');
	exit;
}

while ( $row = mysqli_fetch_assoc($myquery) ) {
	echo "<p>".$row['idPost']."</p>";
	echo "<p>".$row['titlePost']."</p>";
	echo "<p>".$row['shortText']."</p>";
	echo "<p>".$row['text']."</p>";
	echo "<p>".$row['datecreate']."</p>";
}

?>