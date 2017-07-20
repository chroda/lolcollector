<fieldset id="error404">
	<legend>Erro 404</legend>
	<h2>Sua página não foi encontrada!</h2>
	<div class="col-lg-8">
		<div class="well well-lg">
			<p class="lead">Olá Invocador, parece que você está um pouco desorientado.</p>
			<h4>Por isso, chamamos o escoteiro <em>Teemo</em> para lhe ajudar um pouquinho.</h4>
			<br />
			<br />
			<small>Escolha uma destas opções:</small>
			<br />
			<br />
			<p><a href="<?php echo location('user/signup'); ?>" 				class="btn btn-success 	btn-sm btn-block">Eu quero me registrar!</a></p>
			<br />
			<p><a href="<?php echo location('list-summoners'); ?>" 				class="btn btn-success 	btn-sm btn-block">Desejo ver a lista de Invocadores registrados.</a></p>
		</div>
		<blockquote class="pull-right">
			<p>"Nunca subestime o código dos escoteiros!"</p>
			<small><cite title="Source Title">Teemo</cite>, o Explorador Veloz.</small>
		</blockquote>
	</div>
	<div class="col-lg-4 right">
		<img src="<?php echo CDN_DIR;?>img/404.png"/>
	</div>
</fieldset>