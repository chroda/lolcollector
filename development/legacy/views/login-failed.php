<div class="jumbotron">
	<?php if(ISSET($_GET['lost-password'])):?>
		<h2>Recuperação de senha</h2>
		<p>
			Não podemos recuperar sua senha, pois não temos como saber qual senha foi usada,
			nós usamos a tecnologia <a href="http://pt.wikipedia.org/wiki/MD5" target="_blank">MD5</a>, 
			que criptografa a senha e portando, é preciso gerar uma nova senha. 
		</p>
		<hr/>
		<p><small>Mas nosso sistema ainda não possui esta ferramenta automatizada.</small></p>
		<p>
			Pedimos a colaboração e principalmente a compreenção de que estamos em fase beta, 
			e futuramente, este recurso estará disponível.
		</p>
		<hr/>
		<p>
			Para reaver sua conta, envie-nos um email com o título:<br/>
		 	<strong class="text-warning">LOLC - Recuperar Senha</strong> 
			para <a href="mailto:<?php echo __APP_EMAIL__?>?Subject=LOLC - Recuperar Senha" target="_blank"><?php echo __APP_EMAIL__?></a> 
			com as informações:
			<ul>
				<li>Nome de Usuário</li>
				<li>Email Cadastrado</li>
			</ul>
		</p>
		<p>É importante ressaltar que estas informações são <strong class="text-danger">obrigatórias</strong> para refazer sua senha.</p>
	<?php else:?>
		<h1>Desculpe!</h1>
		<h2>Seu login não teve sucesso.</h2>
		<p>Escolha uma destas opções.</p>
		<p><a href="<?php echo location('user/signup'); ?>" class="btn btn-warning btn-lg btn-block">Eu quero me registrar!</a></p>
		<p><a href="<?php echo location('list-summoners'); ?>" class="btn btn-default btn-lg btn-block">Desejo ver a lista de Invocadores registrados.</a></p>
		<p><a href="<?php echo location('login-failed?lost-password'); ?>" class="btn btn-danger btn-lg btn-block">Eu não lembro minha senha.</a></p>
	<?php endif;?>
</div>