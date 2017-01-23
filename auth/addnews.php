<?php
top('Новая статья');
?>


<div class='oneNews'>
	<div class="">
		<p>Название статьи:
			<input id='news-title' class='correct-news-title'>
		</p>

	</div>



	<p class=''>Короткий текст:
	<textarea name="" id='news-shorttext'  rows="2"></textarea>
	</p>
	<p class=''>Полный текст:
	<textarea name="" id='news-text' ></textarea>
	</p>

	<button id='btn-corrected' onclick="addone()">Добавить новость</button>

</div>


<script>
	function addone() {

		var str_title = $('#news-title')[0].value,
				str_shorttext = $('#news-shorttext')[0].value,
				str_text = $('#news-text')[0].value;


		$.ajax({
			url: 'allform',
			type: 'POST',
			data: 'addone_f=1&title=' + str_title + '&shorttext=' + str_shorttext + '&text=' + str_text,
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