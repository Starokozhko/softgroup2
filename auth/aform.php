<?php

if ( $_POST['edit_f'] ) {

	if ( $_POST['password'] and md5($_POST['password']) != $_SESSION['password'] ) {

		password_valid();
		mysqli_query($CONNECT, "UPDATE `new_users` SET `password` = '$_POST[password]' WHERE `id` = $_SESSION[id]");

	}

	message('Данные сохранены!');

}

?>