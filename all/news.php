<?php
top('Статья: '.$_SESSION['news']['title']);
// $mycoment = mysqli_query($CONNECT, "SELECT * FROM `coments` WHERE `idPosts` = $_SESSION[news][idpost] ORDER BY `id` DESC ");
?>


<script type="text/javascript">
	
	function loader_coments() {

		$.get('/loadcoment', function( data ) {


			if (data == 'empty' )
				$('.coments').text( 'Нет коментариев' );
			else if ( data != 'end' )
				$('.coments').append( data );

		}
		)

	}



	$(document).ready(function() {
// 	loader_news();

$('#userComentsText').css('display','block');
$('.longtext').css('display','block');
// $('.btn').className = 'btn-comment';
// $('.btn-comment').attr('id', 'btn-comment');
if($('.btn-comment')) {

$('.btn-comment').click(function(){
				
				alert('OKs');


				var str_idpost = $('#idPosts')[0].value;
				var str_coment = $('#userComentsText')[0].value;
				console.log(str_idpost);
				$.ajax({
					url: 'allform',
					type: 'POST',
					data: 'setcoment_f=1&comenttext=' + str_coment + '&idpost=' + str_idpost,
					cache: false,
					success: function( result ) {

						// console.log(result);
						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});

			});
} else { alert('No')}


});

</script>
<?php
?>




<div class='oneNews'>
	<div class="left">
		<h2 id='news-title' class='left news-title'><?= $_SESSION['news']['title']  ?></h2>
		<h6 class='left clear'>Созданна: <span id='news-datacreate'><?= $_SESSION['news']['datacreate'] ?></span></h6>
		<h6 class='left clear'>Автор: <span id='news-author'><?= $_SESSION['news']['author'] ?></span></h6>
	</div>

	<div class="right news-countviews">
		<div class='pictograph right' >Просмотров: <span id='news-view'><?= $_SESSION['news']['view'] ?></span></div>
		<div class='pictograph  right clear' >Коментариев: <span id='news-coments'><?= $_SESSION['news']['coments'] ?></span></div>
	</div>


	<p class='clear longtext'><?= $_SESSION['news']['text'] ?></p>
	<h5 class='title-comit'>Коментарии:</h5>
	<input  id='idPosts' value=<?= $_SESSION['news']['idpost'] ?>>
	<div class='coments'>



		<?php
		if($_SESSION['id']){
			echo ("<textarea name='coment_user' id='userComentsText'  placeholder='Enter yuor comment'></textarea>");
			?> 
			<p><button id='btn-comment'>Коментировать...</button></p> <!--onclick="log_in('allform', 'onenews', 'idPost')" -->
			<?php
		} else {

		}

		if( $_SESSION['news']['coments'] > 0) {
			$id = $_SESSION['news']['idpost'];
			$mycoment = mysqli_query($CONNECT, "SELECT * FROM `coments` WHERE `idPosts` = $id ORDER BY `id` DESC ");
			// echo(mysqli_fetch_assoc($mycoment));
		// echo ("<div class='coments'> ");

			while ( $row3 = mysqli_fetch_assoc($mycoment) ) {
				echo ("<div class='coments-item'>");

				echo ("<h6 class='coments-author'>Дата: ".$row3['data']."</h6>");
				echo ("<p class='coments-text'>".$row3['text']."</p>");
				echo ("</div>");
			}
		// echo ("</div>");
		} else {
			echo ("<p>Коментариев нет.</p>");
		}

		?>
	</div>
</div>


<!-- </div> -->



<?php
bottom();
?>