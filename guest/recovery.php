<?php
top('Востановление пароля');
?>

<section class="form-login">
	
	<h1>Востановление пароля</h1>
	<p><input id="email" type="email" placeholder="E-mail"></p>
	<p><input id="captcha" type="text" placeholder="<?php captcha_show() ?>"></p>
	<p><button onclick="log_in('gform', 'recovery', 'email.captcha')">Востановить</button></p>

</section>

<?php
bottom();
?>