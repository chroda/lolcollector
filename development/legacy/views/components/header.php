<!DOCTYPE html>
<html lang="<?php echo $_SESSION['user']['locale'];?>">
	<head><?php require_once(__VIEW_CPT_PATH__.'head.php');?></head>
	<body>
		<header>
			<?php if($_SESSION['user']['platform']=='desktop'):?>
				<div id="nav-random-champions">
					<div class="container-fluid">
						<div class="col-lg-1"></div>
						<div class="col-lg-4" id="random-left">
							<img src="<?php echo CDN_DIR;?>img/nav-random/<?php echo $c = topChampionShuffle();?>" />
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-4" id="random-right">
							<img src="<?php echo CDN_DIR;?>img/nav-random/<?php echo $c;?>" />
						</div>
						<div class="col-lg-1"></div>
					</div>
				</div>
			<?php endif;?>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">

					<?php if($_SESSION['user']['platform']=='desktop'):?>
						<div class="navbar-header">
							<a class="navbar-brand " href="<?php location(false,false,false);?>"><img src="<?php echo CDN_DIR;?>img/nav-logo.png" /></a>
						</div>
					<?php endif;?>
					
					<div class="navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav navbar-left">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Navegação</span></button>
							<li><a href="<?php location('list-summoners');?>"><i class="fa fa-users"></i> Lista de Invocadores <span class="badge btn-lolc"><?php echo count($summoners);?></span></a></li>
							<!-- <li><a href="<?php location('donations');?>"><i class="fa fa-users"></i> Ajude </a></li> -->
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<?php if($user->isLoggedIn()):?>
							<!-- 
								<li>
									<a href="<?php location('user/'.$user->getUsername().'/configuration');?>" ><i class="fa fa-user"></i> Configurar</a>
								</li>
							-->
								<li>
									<a href="<?php location($user->getUsername());?>" ><i class="fa fa-user"></i> <?php echo $user->getName();?></a>
								</li>
								<li>
									<a href="<?php location('user?logout');?>" ><i class="fa fa-sign-out"></i> Sair</a>
								</li>
							<?php else:?>
								<li>
									<form class="navbar-form" role="login" method="post" action="<?php location('user/login');?>" name="login-form">
										<div class="form-group input-group-sm">
											<input 	type="text" 	class="form-control input-sm" placeholder="Usuário" name="username" autocomplete="off" />
											<input 	type="password" class="form-control input-sm" placeholder="Senha" 	name="password" autocomplete="off" />
											<button	type="submit" 	class="btn btn-lolc btn-sm"><i class="fa fa-sign-in"></i> Entrar</button>
											<a href="<?php location('user/signup');?>" ><button	type="button" class="btn btn-primary btn-sm"><i class="fa fa-key"></i> Registrar-se</button></a>
										</div>
									</form>
								</li>
							<?php endif;?>
							<?php /** /?>
								<li>
									<!-- INICIO FORMULARIO BOTAO PAGSEGURO -- >
									<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
										<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -- >
										<input type="hidden" name="receiverEmail" value="christianmarcell@gmail.com" />
										<input type="hidden" name="currency" value="BRL" />
										<input type="hidden" name="donationValue" value="10" />
										<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-cinza-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
									</form>
									<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
								</li>
							<? /**/?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		<div class="container" id="wrapper">
			<ul class="breadcrumb">
				<?php foreach(rewrite() as $key => $value):
						if($key==0){
							$url 		= false;
							$breadcrumb = $_SESSION['seo']['ptitle'];
							$print 		= true;
						}elseif($key == 1 && rewrite(1)=='user' && rewrite(2)=='signup'){
							$url 		= rewrite(0);
							$breadcrumb = $_SESSION['seo']['page'];
							$print 		= true;
						}elseif($key == 1 && rewrite(1)=='user' && rewrite(2)!='signup'){
							$mysql->Select('user',array('username'=>rewrite(2)));
							$url 		= rewrite(1).'/'.rewrite(2);
							$breadcrumb = $mysql->aArrayedResults[0]['name'];
							$print 		= true;
						}elseif($key == 2 && rewrite(1)=='user' && rewrite(2)!='signup' && rewrite(3)=='champions'){
							$url 		= rewrite(0);
							$breadcrumb = 'Campeões';
							$print 		= true;
						}elseif($key == 2 && rewrite(1)=='user' && rewrite(2)!='signup' && rewrite(3)=='skins'){
							$url 		= rewrite(0);
							$breadcrumb = 'Skins';
							$print 		= true;
						}elseif($key == 2 && rewrite(1)=='user' && rewrite(2)!='signup' && rewrite(3)=='stats'){
							$url 		= rewrite(0);
							$breadcrumb = 'Stats';
							$print 		= true;
						}elseif(
							rewrite(1)=='login-failed' 		||
							rewrite(1)=='list-summoners' 	||
							rewrite(1)=='login-failed'
						){
							$url 		= rewrite(1);
							$breadcrumb = $_SESSION['seo']['page'];
							$print 		= true;
						}else{$print 	= false;}
						if($print):?>
							<li><a href="<?php location($url);?>"><?php echo $breadcrumb;?></a></li>
						<?php endif;
					endforeach;?>
			</ul>
			<div class="alert alert-dismissable alert-clean">
				<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
				<h3 class="text-center text-info">Olá Invocadores!</h3>
				<p class="text-center">O Lol Collector está em fase BETA, e com isso algumas funções ainda estão em desenvolvimento.</p>
				<!-- <p class="text-center">Nós <strong class="text-danger">desabilitamos</strong> o cadastro de novos invocadores no momento, pois estamos modificando o método do mesmo.</p> -->
				<h4 class="text-center"><a href="<?php echo $_SESSION['social']['facebook']	;?>" target="_blank" class="text-primary">Curta nossa fanpage</a> para ficar por dentro das novidades</h4>
			</div>
			<div id="fb-root"></div>
			<?php if($_SESSION['user']['api']['status']=='down'): ?>
				<div class="api503 alert alert-dismissable alert-danger">
					<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
					<h3>Código 503 API Riot</h3>
					<p>Invocadores, algumas funções do nosso serviço estão indisponíveis no momento, pois <strong>dependemos</strong> da API Riot.</p>
					<p>Pedimos desculpas pelo inconveniente, esperamos que o sistema volte logo.</p>
				</div>
			<?php endif;?>
			<div id="content">
				<div class="panel panel-short">
					<?php echo adsence('6458992883',false,90,970);?>
				</div>