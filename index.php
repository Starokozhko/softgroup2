<?php

if ($_SERVER['REQUEST_URI'] == '/' ) $page = 'home';
else {
	$page = substr($_SERVER['REQUEST_URI'], 1);
	if ( !preg_match('/^[A-z0-9]{3,15}$/', $page) ) exit('error url');
};

$CONNECT = mysqli_connect('db3.ho.ua', 'jcat84', 'v344va46', 'jcat84');
if ( !$CONNECT ) exit('MSQL error');

session_start();
// var_dump($_SESSION);
// var_dump($_POST);

if ( file_exists('all/'.$page.'.php') ) include 'all/'.$page.'.php';
else if ( $_SESSION['id']  and file_exists('auth/'.$page.'.php') ) include 'auth/'.$page.'.php';
else if ( !$_SESSION['id']  and file_exists('guest/'.$page.'.php') ) include 'guest/'.$page.'.php';
else exit('Страница 404');

function not_found() {
	exit('Страница 404');	
}
function message( $text ) {
	exit ('{ "message" : "'.$text.'"}');
};

function go( $url ) {
	exit ('{ "go" : "'.$url.'"}');
};

function random_str($num = 30){
	return substr(str_shuffle('0123456789abcdefghijkmnopqrstuvwxyzADCDEFGHIJKLMNOPQRSTUVWYZ'), 0, $num );
};

function captcha_show() {

	$question = array(
		1 => 'Столица Украины?',
		2 => 'Столица Великобритании?',
		3 => 'Столица США?',
		4 => 'Столица Франции?',
		5 => 'Король ПОП музыки?',
		6 => '5 + 5',
		7 => '4 + 3',
		8 => 'Фильм `Молчание ...`',
		);

	$num = mt_rand(1, count($question));
	$_SESSION['captcha'] = $num;

	echo  $question[$num];
}

function captcha_valid() {

	$answers = array(
		1 => 'киев',
		2 => 'лондон',
		3 => 'вашингтон',
		4 => 'париж',
		5 => 'майкл',
		6 => '10',
		7 => '7',
		8 => 'ягнят',
		);

	if ( $_SESSION['captcha'] != array_search( strtolower($_POST['captcha']), $answers) ) {
		message('Ответ на вопрос указан не верно');
	};
}

function email_valid() {
	if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) ) {
		message('E-mail указан не верно');
	}
}

function password_valid() {
	if ( !preg_match('/^[A-z0-9]{8,30}$/', $_POST['password']) )
		message('Пароль указан не верно и может содержать 8-30 символов A-z0-9');
	
	$_POST['password'] = md5($_POST['password']);
}



function top ( $title ) {

	echo '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="Yuriy Starokozhko">
		<link rel="shortcut icon" href="'.$_SERVER['HTTP_REFERER'].'img/favicon.ico" type="image/png">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
		<script src="'.$_SERVER["HTTP_REFERER"].'js/myscript.js"></script>
		<link rel="stylesheet" href="style.css">
		<title>'.$title.'</title>
	</head>
	<body>
		<h1 class="logo">BLOG</h1>
		<div class="wrapper">
			<header>
				<ul>
				<li><a href="home">Главная</a></li>';
						
					if($_SESSION['id']){
						echo '
						<li><a href="profile">Статьи</a></li>
						<li><a href="history">История</a></li>
						<li><a href="logout">Выход</a></li>
					</ul>
				</header>
				';
			} else {
				echo '
				<li><a href="registr">Регистрация</a></li>
				<li><a href="login">Вход</a></li>
			</ul>
		</header>
		';
	}
};

function bottom () {

	echo '
	<footer>

	</footer>

</div>
</body>
</html>';
};

?>




<?php

?>