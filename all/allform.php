<?php 

if($_POST['news_f']) {

	if( mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `post` WHERE `idPost` = '$_POST[idPost]'")) )
		message('Такой новости не существует!');
};


if ( $_POST['setcoment_f'] ) {

echo('OKEY');

		mysqli_query($CONNECT, "INSERT INTO `coments` (`id`, `idPosts`, `text`, `idauthor`) VALUES ('', '".$_POST['idpost']."', '".$_POST['comenttext']."', '".$_SESSION['id']."')");
		$countcoment = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `coments` FROM `post` WHERE `idPost` = '".$_POST['idpost']."'"));
		$count = $countcoment['coments'] + 1;
		mysqli_query($CONNECT, "UPDATE `post` SET `coments` = '".$count."' WHERE `idPost` = ".$_POST['idpost']."");
		message('Данные сохранены!');


};

if ( $_POST['setview_f'] ) {

// var_dump($_POST['title']);
	// $id = ;
		$countcoment = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `view` FROM `post` WHERE `idPost` = '".$_POST['idpost']."'"));
		$countview = $countcoment['view'] + 1;
		mysqli_query($CONNECT, "UPDATE `post` SET `view` = '".$countview."' WHERE `idPost` = ".$_POST['idpost']."");
		// // message('Данные сохранены!');
	$_SESSION['news']['idpost'] = $_POST['idpost'];
	$_SESSION['news']['title'] = $_POST['title'];
	$_SESSION['news']['text'] = $_POST['text'];
	$_SESSION['news']['datacreate'] = $_POST['datacreate'];
	$_SESSION['news']['author'] = $_POST['author'];
	$_SESSION['news']['view'] = $countview;
	$_SESSION['news']['coments'] = $_POST['coments'];
	go('news');


}
	
	?>