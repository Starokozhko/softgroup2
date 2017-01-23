<?php

$myquery = mysqli_query($CONNECT, 'SELECT `text` FROM `history` LIMIT '.$_SESSION['loader'].', 2' );

if ( !mysqli_num_rows($myquery) ) {
	if ( $_SESSION['loader'] == 0 ) exit('empty'); 
	else exit('end');
	exit;
}
$_SESSION['loader'] += 2;
while ( $row = mysqli_fetch_assoc($myquery) ) {
	echo "<p>".$row['text']."</p>";
}

?>