<?php

if($_SESSION['news']['coments'] > 0){
	
	$id = $_SESSION['news']['idpost'];
		$mycoment = mysqli_query($CONNECT, "SELECT * FROM `coments` WHERE `idPosts` = $_SESSION[news][idpost] ORDER BY `id` DESC ");


		while ( $row3 = mysqli_fetch_assoc($mycoment) ) {
			echo ("<div class='coments-item'>");
			echo ("<h6 class='coments-author'>Дата: ".$row3['data']."</h6>");
			echo ("<p class='coments-text'>".$row3['text']."</p>");
			echo ("</div>");
		}
}

?>