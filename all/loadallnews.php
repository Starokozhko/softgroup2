<?php

$myquery = mysqli_query($CONNECT, 'SELECT * FROM `post` ORDER BY `idPost` DESC LIMIT '.$_SESSION['loadallnews'].', 5' );
$myquery2 = mysqli_query($CONNECT, 'SELECT `id`, `firstname`, `lastname` FROM `new_users`');
$myauthor = mysqli_query($CONNECT, 'SELECT `id`, `firstname`, `lastname` FROM `new_users`');

if ( !mysqli_num_rows($myquery) ) {
	if ( $_SESSION['loadallnews'] == 0 ) exit('empty'); 
	else exit('end');
	exit;
}
$_SESSION['loadallnews'] += 5;

while ( $row2 = mysqli_fetch_assoc($myquery2) ) {


	while ( $row = mysqli_fetch_assoc($myquery) ) {
		if($row['idAuthor'] == $row2['id']){

			echo "<div class='news-item'>";
			echo ("<h2 id='news-title' class='left news-title'>".$row['titlePost']."</h2>");
			echo ("<h6 class='left clear'>Созданна: <span id='news-datacreate'>".$row['datecreate']."</span></h6>");
			echo ("<h6 class='left clear'>Автор: <span id='news-author'>".$row2['firstname']." ".$row2['lastname']."</span></h6>");

			echo ("<div class='pictograph right' >Просмотров: <span id='news-view'>".$row['view']."</span></div>");
			echo ("<div class='pictograph  right clear' >Коментариев: <span id='news-coments'>".$row['coments']."</span></div>");


			echo ("<p class='clear shorttext'>".$row['shortText']."</p>");
			echo ("<p class='clear longtext'>".$row['shortText']." ".$row['text']."</p>");


				echo ("<input  id='idPosts' value='".$row['idPost']."'/>");
			if($_SESSION['id']){
				echo ("<textarea name='coment_user' id='userComentsText'  placeholder='Enter yuor comment'></textarea>");
				?> 
				<p><button class='btn' >Подробнее...</button></p> 
				<?php
			} else {
				?>
				<p><button class='btn' >Подробнее...</button></p>
				<?php
			}


			echo "</div>";
		};
	}
}

?>
<script>

	$('.btn').click(function(){

		$(this).parent().parent()[0].className = 'oneNews';
		$('.allnews-title')[0].innerHTML = 'Статья: ';
		$('.news-item').remove();
		$('.mooNews').remove();

		$('.longtext').css('display','block');
		$('.coments').css('display','block');
		$('.title-comit').css('display','block');

		
		var str_idpost = $('#idPosts')[0].value;
				str_title = $('.news-title')[0].innerHTML,
				str_text = $('.longtext')[0].innerHTML,
				str_datecreate = $('#news-datacreate')[0].innerHTML,
				str_author = $('#news-author')[0].innerHTML,
				str_view = $('#news-view')[0].innerHTML,
				str_coments = $('#news-coments')[0].innerHTML;

		$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'setview_f=1&idpost=' + str_idpost  + '&title=' + str_title + '&text=' + str_text + '&datacreate=' + str_datecreate + '&author=' + str_author + '&view=' + str_view + '&coments=' + str_coments , 
			cache: false,
			success: function( result ) {


						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});


		if($('#userComentsText')[0]){
			$('#userComentsText').css('display','block');
			$(this)[0].className = 'btn-comment';
			$('.btn-comment').attr('id', 'btn-comment');
			$(this)[0].innerHTML = 'Коментировать';
			$('.btn-comment').attr("onklick", "setcoment()");

			$('.btn-comment').click(function(){

				var str_coment = $('#userComentsText')[0].value;
				$.ajax({
					url: 'allform',
					type: 'POST',
					data: 'setcoment_f=1&comenttext=' + str_coment + '&idpost=' + str_idpost,
					cache: false,
					success: function( result ) {

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});

			});
		} else {
			$('.btn').remove();
		}

		$('.shorttext').css('display','none');
	});



</script>