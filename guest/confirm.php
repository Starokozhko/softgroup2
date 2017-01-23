<?php
if( !$_SESSION['confirm']['code'] ) not_found();

top('Подтверждение');
?>


<section class="form-login">
	
	<h1>Подтверждение</h1>
	<p><input id="code" type="email" placeholder="Код"></p>
	<p><button onclick="log_in('gform', 'confirm', 'code')">Подтвердить</button></p>

</section>

<?php
bottom();
?>