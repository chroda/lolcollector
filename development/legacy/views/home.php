<?php


//pr(__APP_RIOTAPI_KEYS__);
//pr(unserialize(__APP_RIOTAPI_KEYS__));

?>


<div class="jumbotron">
	<?php if($user->isLoggedIn()):?>
		Olá invocador, sua página de coleção esta ativa em <a href="<?php echo location('user/signup'); ?>" class="btn btn-lolc btn-lg btn-block">Registrar-se!</a>

	<?php else:?>
		<h1>Bem vindos Invocadores!</h1>
		<h2>Este é o League of Legends Collector.</h2>
		<p>Somos uma ferramenta de coleção de campeões e skins de <a target="_blank" href="http://br.leagueoflegends.com/pt/">League of Legends</a>.</p>
		<p><a href="<?php echo location('user/signup'); ?>" class="btn btn-lolc btn-lg btn-block">Registrar-se!</a></p>
	<?php endif;?>
</div>