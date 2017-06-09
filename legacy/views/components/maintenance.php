<?php 
define('__TITLE_SEP__', ' &bull; ');
define('__DESCR_SEP__', ' &mdash; ');
$seo_title='Manutenção';
$_SESSION['seo']['ptitle'] = __APP_TITLE__;
$_SESSION['seo']['title'] = $seo_title.__TITLE_SEP__.$_SESSION['seo']['ptitle'];$_SESSION['seo']['page'] 	= $seo_title;
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['user']['locale'];?>">
	<head>
		<title><?php echo $_SESSION['seo']['title'];?></title>
		<base href="<?php location(false,false,false);?>"/>
		<meta charset	="utf-8"																			/>
		<meta name		="author" 					content="<?php echo $_SESSION['seo']['author']		;?>"/>
		<meta name		="keywords" 				content="<?php echo $_SESSION['seo']['keywords']	;?>"/>
		<meta name		="description"				content="<?php echo $_SESSION['seo']['description']	;?>"/>
		<meta name		="rating"					content="GENERAL" 										/>
		<meta name		="robots"					content="INDEX, ALL"									/>
		<meta name		="robots"					content="INDEX, FOLLOW"									/>
		<meta name		="revisit-after"			content="7 days"										/>
		<meta name		="viewport" 				content="width=device-width, initial-scale=1.0"			/>
		<meta name		="google-site-verification"	content="s8DCAf-SsBZCRT6UKG7Z6KsjPTLv_kAdt4Ld4N1adaQ" 	/>
		<meta property	="og:locale"				content="<?php echo $_SESSION['user']['locale']		;?>"/>
		<meta property	="og:url"					content="<?php location(false,false,false)			;?>"/>
		<meta property	="og:title"					content="<?php echo $_SESSION['seo']['ptitle']		;?>"/>
		<meta property	="og:site_name"				content="<?php echo $_SESSION['seo']['ptitle']		;?>"/>
		<meta property	="og:description"			content="<?php echo $_SESSION['seo']['description']	;?>"/>
		<meta property	="og:image" 				content="<?php echo CDN_DIR;?>img/nav-logo.png"			/>
		<meta property	="og:image:type" 			content="image/png"										/>
		<meta property	="og:image:width" 			content="340"											/>
		<meta property	="og:image:height" 			content="245"											/>
		<meta property	="og:type"					content="website"										/>
		<!-- FEEDS -->
		<!--[if lt IE 7]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script><![endif]-->
		<!--[if lt IE 8]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script><![endif]-->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link rel="alternate" 		type="application/rss+xml"	title="<?php echo $_SESSION['seo']['ptitle'];?>" 															/>
		<link rel="shortcut icon" 	type="image/x-icon" href="<?php echo CDN_DIR;?>img/favicon.png" 																		/>
		<link rel="shortcut icon" 	type="image/x-icon" href="<?php echo CDN_DIR;?>img/favicon.ico" 																		/>
	    <!-- CSS -->
	    <link rel="stylesheet"		type="text/css"		href="<?php echo CDN_DIR;?>css/font-awesome.min.css"													media="all"	/>
		<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR;?>css/bootstrap.cyborg.min.css">
		<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR;?>css/style.css" />
		<?php if(rewrite(1)=='user'):?>
			<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR; ?>css/style.user.css" />
		<?php else: ?>
		<?php endif; ?>
	    <!--[if lt IE 9]>
	    <script src="<?php echo CDN_DIR; ?>js/html5shiv.js"></script>
	    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DIR; ?>css/style_ie.css"           		media="all" />
	    <![endif]-->
 	</head>
	<body>
		<header>
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
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand " href="<?php location(false,false,false);?>"><img src="<?php echo CDN_DIR;?>img/nav-logo.png" /></a>
					</div>
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav navbar-left">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Navegação</span></button>
						</ul>
						<ul class="nav navbar-nav navbar-right">

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
							$url 		= rewrite(0);
							$breadcrumb = $_SESSION['seo']['page'].' &mdash; '.$mysql->aArrayedResults[0]['name'];;
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
			<div id="content">
				<div class="panel panel-short">
					<?php echo adsence('6458992883',false,90,970);?>
				</div>
				<fieldset id="maintenance">
					<legend>Manutenção</legend>
					<h2>Opa! Estamos em manutenção!</h2>
					<div class="col-lg-8">
						<div class="well well-lg">
							<p class="lead">Olá Invocador, nosso site esta indisponível temporariamente.</p>
							<h4>Parece que <em>Heimerdinger</em> esta fazendo ajustes em nosso sistema.</h4>
						</div>
						<blockquote class="pull-right">
							<p>"Hmmm! Deixe-me consertar isto."</p>
							<small><cite title="Source Title">Heimerdinger</cite>, o Inventor Idolatrado.</small>
						</blockquote>
					</div>
					<div class="col-lg-4 right">
						<img src="<?php echo CDN_DIR;?>img/maintenance.png"/>
					</div>
				</fieldset>
				<div class="panel">
					<?php echo adsence('7935726087',false,90,970);?>
				</div>
			</div>
			<div id="column">
				<div class="panel panel-default">
					<div class="panel-heading"><h6 class="panel-title text-center"><small>PUBLICIDADE </small></h6></div>
					<div class="panel-body">
						<?php rewrite(1)=='list-summoners' ? $resp = true : $resp = false; ?>
						<?php echo adsence('5120030489',$resp);?>
						<?php echo adsence('2026963288',$resp);?>
						<?php echo adsence('4561627281',$resp);?>
					</div>
					<div class="panel-footer"><h6 class="panel-title text-center"><small>PUBLICIDADE </small></h6></div>
				</div>
			</div>
		</div>
		<footer class="navbar navbar-inverse" role="navigation">
			<div class="col-lg-11">
				<p class="navbar-text"><?php echo 'Todos os direitos reservados © Copyright - '.__APP_PACKAGE__.' '.date('Y');?></p>
			</div>
			<div class="col-lg-1">
				<a href="<?php echo $_SESSION['social']['facebook']	;?>" target="_blank" class="btn navbar-btn btn-default btn-social"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $_SESSION['social']['twitter']	;?>" target="_blank" class="btn navbar-btn btn-default btn-social"><i class="fa fa-twitter"></i></a>
			</div>
		</footer>
	</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49850415-1', 'lolcollector.com.br');
  ga('send', 'pageview');
</script>
<script type="text/javascript"	src="<?php echo CDN_DIR; ?>js/jquery.min.js"						></script>
<script type="text/javascript"  src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" async></script>