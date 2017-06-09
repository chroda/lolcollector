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
<meta property	="og:title"					content="<?php echo $_SESSION['seo']['title']		;?>"/>
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
<link rel="alternate" 		type="application/rss+xml"	title="<?php echo $_SESSION['seo']['ptitle'];?>" 	/>
<link rel="shortcut icon" 	type="image/x-icon" href="<?php echo CDN_DIR;?>img/favicon.png" 				/>
<link rel="shortcut icon" 	type="image/x-icon" href="<?php echo CDN_DIR;?>img/favicon.ico" 				/>
<!-- CSS -->
<link rel="stylesheet"		type="text/css"		href="<?php echo CDN_DIR;?>css/font-awesome.min.css"	media="all"	/>
<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR;?>css/bootstrap.cyborg.min.css">

<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR;?>css/style.css"/>

<?php if(rewrite(1)=='user'):?>
	<link rel="stylesheet" 		type="text/css" 	href="<?php echo CDN_DIR; ?>css/style.user.css" />
<?php endif; ?>