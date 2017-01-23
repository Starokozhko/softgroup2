<?php
top('Вход');
?>


<section class="form-login">
	
	<h1>Вход</h1>
	<p><input id="email" type="email" placeholder="E-mail"></p>
	<p><input id="password" type="password" placeholder="Пароль"></p>
	<p><input id="captcha" type="text" placeholder="<?php captcha_show() ?>"></p>
	<p><button onclick="log_in('gform', 'login', 'email.password.captcha')">Войти</button></p>
	<p><button onclick="gotourl('recovery')">Востановить пароль</button></p>

</section>

<?php
bottom();
?>