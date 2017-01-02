<div class="jumbotron">
	<?php if($user->isLoggedIn()):?>
		<h1>Bem vindo <?php echo $user->getName(true);?>!</h1>
		<h2>
			Sua página de coleção esta ativa em
			<a href="<?php echo location($user->getUsername());?>" class="btn btn-lolc btn-lg">
				lolcollector.chroda.com.br/<?php echo $user->getUsername();?>
			</a>
		</h2>
	<?php else:?>
		<h1>Bem vindos Invocadores!</h1>
		<h2>Este é o League of Legends Collector.</h2>
		<p>Somos uma ferramenta de coleção de campeões e skins de <a target="_blank" href="http://br.leagueoflegends.com/pt/">League of Legends</a>.</p>
		<p><a href="<?php echo location('user/signup'); ?>" class="btn btn-lolc btn-lg btn-block">Registrar-se!</a></p>
	<?php endif;?>
</div>
