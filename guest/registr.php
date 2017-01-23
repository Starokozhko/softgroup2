<?php
top('Регистрация');
?>

<section class="form-login">
	
	<h1>Регистрация</h1>
	<p><input id="firstname" type="text" placeholder="Ваше имя"> <input id="lastname" type="text" placeholder="Фамилия"></p>
	
	<p><input id="email" type="email" placeholder="E-mail"> <input id="password" type="password" placeholder="Пароль"></p>
	
	<p><input id="captcha" type="text" placeholder="<?php captcha_show() ?>"></p>
	<p><button onclick="log_in('gform', 'register', 'firstname.lastname.email.password.captcha')">Регистрация</button></p>

</section>

<?php
bottom();
?>