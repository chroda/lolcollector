<!DOCTYPE html>
<html lang="<?php echo $_SESSION['user']['locale'];?>">
	<head>
		<title>Em Breve &bull; LoL Collector</title>
		<base href="<?php location(false,false,false)?>" />
		<meta charset	="utf-8"																	/>
		<meta name="author" 		content="Dev n' Quest">
		<meta name="keywords" 		content="collector lol LeagueOfLegends" />
		<meta name="description" 	content="Em breve" />
		<meta name="robots" 		content="FOLLOW" />
		<meta name="viewport" 		content="width=device-width, initial-scale=1.0">
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

	    <!--[if lt IE 9]>
	    <script src="<?php echo CDN_DIR; ?>js/html5shiv.js"></script>
	    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DIR; ?>css/style_ie.css"           		media="all" />
	    <![endif]-->
		<style>
			body{
				margin:0;
				padding:0;
				background-color:#3f3f40;
			}
			#container{
				position:absolute;
				top:50%;
				left:50%;
				margin-top:-320px; 
				margin-left:-480px;
				display:block;
				background-color:#EEE;
				width:960px;
				height:620px;
				padding:6px;
				color:#4f4f50;
				font-family:helvetica;
				border:4px dashed #3f3f40;
			}
			#cute-rammus{
				background-image:url('<?php echo CDN_DIR;?>img/layouts/cute-rammus.png');
				display:block;
				width:500px;
				height:517px;
				margin:0 auto; 
			}
			h1{
				display:block;
				margin:0 auto;
				width:300px;
				text-align:center;
 				border-bottom:1px solid #445;
			}
			p{
				display:block;
				margin:0 auto;
				width:100%;
				text-align:center;
				font-weight:bold;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<h1>LoL Collector</h1>
			<span id="cute-rammus"></span>
			<p>Em breve uma nova aplicação para os invocadores brasileiros.</p>
		</div>
	</body>
</html>