<?php

if($_POST['login_f']) {
	captcha_valid();
	email_valid();
	password_valid();

	if( mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `new_users` WHERE `email` = '$_POST[email]' AND `password` = '$_POST[password]'")) )
		message('Аккаунт не найден!');

 $row = mysqli_fetch_assoc( mysqli_query($CONNECT, "SELECT * FROM `new_users` WHERE `email` = '$_POST[email]'") ); 

	foreach ($row as $key => $value){
		$_SESSION[$key] = $value;
	};

	go('profile');


} else if($_POST['register_f']) {
	captcha_valid();
	email_valid();
	password_valid();
	

	if( mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `new_users` WHERE `email` = '".$_POST[email]."'")) )
		message('Этот E-mail занят!');

	$code = random_str(5);

	$_SESSION['confirm'] = array(
		'type' => 'register',
		'email' => $_POST['email'],
		'password' => $_POST['password'],
		'firstname' => $_POST['firstname'],
		'lastname' => $_POST['lastname'],
		'code' => $code,
		);


	mail( $_POST['email'], 'Регистрация', "Код подтверждения регистрации: <b>$code</b>" );
	
	go('confirm');





} else if($_POST['recovery_f']) {
	captcha_valid();
	email_valid();

	if( !mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `new_users` WHERE `email` = '".$_POST[email]."'")) )
		message('Аккаунт не найден!');

$code = random_str(5);

	$_SESSION['confirm'] = array(
		'type' => 'recovery',
		'email' => $_POST['email'],
		'code' => $code,
		);

	mail( $_POST['email'], 'Востановление пароля', "Код подтверждения востановление пароля: <b>$code</b>" );

	go('confirm');



} else if($_POST['confirm_f']) {

	if( $_SESSION['confirm']['type'] == 'register') {

		if( $_SESSION['confirm']['code'] != $_POST['code'] )
			message('Код подтверждения регистрации указан не верно!');

		mysqli_query( $CONNECT, 'INSERT INTO `new_users` (`id`, `email`, `password`, `firstname`, `lastname`) 
			VALUES ("", 
				"'.$_SESSION['confirm']['email'].'", 
				"'.$_SESSION['confirm']['password'].'",
				"'.$_SESSION['confirm']['firstname'].'", 
				"'.$_SESSION['confirm']['lastname'].'")');

		unset($_SESSION['confirm']);

		go('login');




	} else if( $_SESSION['confirm']['type'] == 'recovery') {

		if( $_SESSION['confirm']['code'] != $_POST['code'] )
			message('Код подтверждения востановления пароля указан не верно!');
	
		$newpass = random_str(10);
		mysqli_query( $CONNECT, 'UPDATE `new_users` SET `password` = "'.md5($newpass).'" WHERE `email` = "'.$_SESSION['confirm']['email'].'"');
		unset($_SESSION['confirm']);

		message("Ваш новый пароль: $newpass");

	}	
	else not_found();


}

?>