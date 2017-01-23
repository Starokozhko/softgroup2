<?php
top('Редактирование статьи: '.$_SESSION['correct']['title']);
?>




<div class='oneNews'>
	<div class="">
		<p>Название статьи:
			<input id='news-title' class='correct-news-title'  value='<?= $_SESSION['correct']['title']  ?>'>
		</p>

	</div>



	<p class=''>Короткий текст:
	<textarea name="" id='news-shorttext'  rows="2"><?= $_SESSION['correct']['shortText'] ?></textarea>
	</p>
	<p class=''>Полный текст:
	<textarea name="" id='news-text' ><?= $_SESSION['correct']['text'] ?></textarea>
	</p>

	<input  id='idPosts' value=<?= $_SESSION['correct']['idpost'] ?>>

	<button id='btn-corrected' onclick="correct()">Сохранить изменения</button>

</div>

<script>
	function correct() {

		var str_idpost = $('#idPosts')[0].value,
				str_title = $('#news-title')[0].value,
				str_shorttext = $('#news-shorttext')[0].value,
				str_text = $('#news-text')[0].value;



		$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'correct_f=1&idPost=' + str_idpost + '&title=' + str_title + '&shorttext=' + str_shorttext + '&text=' + str_text,
			cache: false,
			success: function( result ) {
				

						var obj = jQuery.parseJSON( result );

						if( obj.go ) gotourl( obj.go )
							else alert( obj.message );

					},
				});
	}

</script>

<?php
bottom();
?>