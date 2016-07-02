<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 *
 * This file have purpose to serve and set before the file(required by user) be called.
 */
 
/**
 * Setting a locale.
 */
if (! isset( $_SESSION['user']['locale'] ) ){
	$_SESSION['user']['locale'] = __LOCALE__;
}

/**
 * Setting a platform.
 */
require_once __CONTROLLERS_DIR__.'Mobile_Detect.php';
$detect = new Mobile_Detect;
						$_SESSION['user']['platform']='desktop';
if($detect->isTablet()){$_SESSION['user']['platform']='tablet';}
if($detect->isMobile()){$_SESSION['user']['platform']='mobile';}

/**
 * Starting SEO.
 */
$_SESSION['seo'] = Array(
	'ptitle'		=> ($title = __APP_TITLE__),
	'title'			=> $title,
	'page'			=> '',
	'author'		=> __APP_PACKAGE__,
	'description'	=> 'Colecione seus personagens no League of Legends',
	'keywords'		=> '',
	'copyright'		=> 'Todos os direitos reservados © Copyright - '.__APP_PACKAGE__.' '.date('Y'),
	'feed'			=> 'http://feeds.feedburner.com/',
);

/**
 * Social data
 */
$_SESSION['social'] = Array(
	'facebook'	=> 'https://www.facebook.com/lolcollector',
	'twitter'	=> 'https://twitter.com/LoLColector',
);

/**
 * Registration of pages.
 */
$_SESSION['pages'] = Array(
	'user' => array(null,
		'signup',
		'profile',
	),
	'index','home',
	'login-failed',
	'list-summoners',
);

/**
 * Authentication of user
 */
require_once __CONTROLLERS_DIR__.'User.php';
if(isset($_SESSION['user']['authenticated']['id'])){
	$user = new User($_SESSION['user']['authenticated']['id']);	
	if(isset($_GET['logout'])){$user->logout();}
}else{$user = new User;}

/**
 * Load data
 */
$mysql->Select('champion'	,array(),'LOWER(name)');unset($champions);$champions = $mysql->aArrayedResults;
$mysql->Select('user'		,array(),'LOWER(name)');unset($summoners);$summoners = $mysql->aArrayedResults;
//$mysql->Select('champion'	,array(),'LOWER(name)');unset($champions);foreach($mysql->aArrayedResults as $champion){$champions[$champion['id']]=$champion;}ksort($champions);
//$mysql->Select('user'		,array(),'LOWER(name)');unset($summoners);foreach($mysql->aArrayedResults as $summoner){$summoners[$summoner['id']]=$summoner;}ksort($summoners);

/**
 * Load API RIOT and check status
 */
require_once(__CONTROLLERS_DIR__.'RiotAPI.php');$api = new RiotAPI();
if(!isset($_SESSION['user']['api']['checked']) || @$_SESSION['user']['api']['checked']+300<=time()){$_SESSION['user']['api']['status']=$api->getSummonerByName('chroda')==503?'down':'up';$_SESSION['user']['api']['checked']=time();}

/**
 * Titles of knows pages
 */
define('__TITLE_SEP__', ' &bull; ');
define('__DESCR_SEP__', ' &mdash; ');
switch (rewrite(1)):default:$seo_title='';break;
	case '':case 'index':case 'home':	$seo_title = 'Início'				;break;
	case 'user':						$seo_title = 'Perfil'				;$seo_description = 'Perfil do invocador'	;break;
	case 'list-summoners':				$seo_title = 'Lista de Invocadores'	;$seo_description = 'Lista de Invocadores'	;break;
	case 'login-failed':				$seo_title = 'Falha no Login'		;$seo_description = 'Falha ao logar no site';break;
	default:							$seo_title = 'Página não encontrada';$seo_description = $seo_title				;break;
endswitch;
if(rewrite(2)=='signup'){				$seo_title = 'Registrar-se';}
if(rewrite(1)=='user' && (rewrite(2)!=='') && (rewrite(2)!=='signup')){
	$mysql->Select('user'				,array('username'=>strtolower(rewrite(2))));$title_user_id			=$mysql->aArrayedResults[0]['id'];
	$mysql->Select('user_champion'		,array('user_id'=>$title_user_id));			$title_user_champions	=$mysql->iRecords;
	$mysql->Select('user_skinchampion'	,array('user_id'=>$title_user_id));			$title_user_skins		=$mysql->iRecords;
	$seo_title		=strtoupper(rewrite(2)).' - C: '.$title_user_champions.' - S: '.$title_user_skins;
	$seo_description=$seo_title;
}
$_SESSION['seo']['title'] 	= $seo_title.__TITLE_SEP__.$_SESSION['seo']['title'];
$_SESSION['seo']['page'] 	= $seo_title;
isset($seo_description)?$_SESSION['seo']['description']=$seo_description:null;