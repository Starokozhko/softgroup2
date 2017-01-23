<?php 

if($_POST['news_f']) {

	if( mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `post` WHERE `idPost` = '$_POST[idPost]'")) )
		message('Такой новости не существует!');
};


if ( $_POST['setcoment_f'] ) {

		mysqli_query($CONNECT, "INSERT INTO `coments` (`id`, `idPosts`, `text`, `idauthor`) VALUES ('', '".$_POST['idpost']."', '".$_POST['comenttext']."', '".$_SESSION['id']."')");
		$countcoment = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `coments` FROM `post` WHERE `idPost` = '".$_POST['idpost']."'"));
		$count = $countcoment['coments'] + 1;
		mysqli_query($CONNECT, "UPDATE `post` SET `coments` = '".$count."' WHERE `idPost` = ".$_POST['idpost']."");
		$_SESSION['news']['coments'] = $count;
		go('news');


};

if ( $_POST['setview_f'] ) {

		$countcoment = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `view` FROM `post` WHERE `idPost` = '".$_POST['idpost']."'"));
		$countview = $countcoment['view'] + 1;
		mysqli_query($CONNECT, "UPDATE `post` SET `view` = '".$countview."' WHERE `idPost` = ".$_POST['idpost']."");


	$_SESSION['news']['idpost'] = $_POST['idpost'];
	$_SESSION['news']['title'] = $_POST['title'];
	$_SESSION['news']['text'] = $_POST['text'];
	$_SESSION['news']['datacreate'] = $_POST['datacreate'];
	$_SESSION['news']['author'] = $_POST['author'];
	$_SESSION['news']['view'] = $countview;
	$_SESSION['news']['coments'] = $_POST['coments'];
	go('news');

};

if ( $_POST['delnews_f'] ) {

mysqli_query($CONNECT, "DELETE FROM `post` WHERE `post`.`idPost` = '$_POST[idPost]'");

go('profile');
};



if ( $_POST['correctnews_f'] ) {

		$myquery =  mysqli_query($CONNECT, "SELECT * FROM `post` WHERE `idPost` = '".$_POST[idPost]."'");

	while ( $row = mysqli_fetch_assoc($myquery) ) {

	$_SESSION['correct']['idpost'] = $row['idPost'];
	$_SESSION['correct']['title'] = $row['titlePost'];
	$_SESSION['correct']['shortText'] = $row['shortText'];
	$_SESSION['correct']['text'] = $row['text'];
	$_SESSION['correct']['datecreate'] = $row['datecreate'];
	$_SESSION['correct']['idAuthor'] = $row['idAuthor'];
	}
	go('correctnews');

};


if ( $_POST['correct_f'] ) {

		mysqli_query($CONNECT, "UPDATE `post` SET `titlePost` = '".$_POST['title']."', `shortText` = '".$_POST['shorttext']."', `text` = '".$_POST['text']."' WHERE `idPost` = ".$_POST['idPost']."");

	go('profile');

};



if ( $_POST['addnews_f'] ) {
		go('addnews');
};



if ( $_POST['addone_f'] ) {

mysqli_query($CONNECT, "INSERT INTO `post`(`idPost`, `titlePost`, `shortText`, `text`, `idAuthor`) VALUES ('', '$_POST[title]', '$_POST[shorttext]', '$_POST[text]', '$_SESSION[id]')");
		go('profile');

};

if ( $_POST['adduser_f'] ) {
$pass = md5($_POST['password']);
	mysqli_query($CONNECT, "INSERT INTO `new_users`(`id`, `email`, `password`, `firstname`, `lastname`) VALUES 
	 ('', '$_POST[email]', '$pass', '$_POST[firstname]', '$_POST[lastname]')");
		go('users');

};

if ( $_POST['deluser_f'] ) {

mysqli_query($CONNECT, "DELETE FROM `new_users` WHERE `new_users`.`id` = '$_POST[iduser]'");
go('users');

};
	
	?>