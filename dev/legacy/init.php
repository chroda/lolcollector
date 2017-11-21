<?php
/**
* @AUTHOR Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
* @COPYRIGHT Dev n' Quest 2014
* @PACKAGE DnQ LolC
* @SINCE July 2013
* @VERSION 0.1
*
* This file have purpose to serve and set before the file(required by user) be called.
*/

/**
* Setting a locale.
*/
if(!isset($_SESSION['user']['locale']))
$_SESSION['user']['locale'] = __LOCALE__;
$_SESSION['user']['beta'] = false;

/**
* Setting a platform.
*/
require_once __CONTROLLERS_DIR__.'Mobile_Detect.php';
$detect = new Mobile_Detect;
$_SESSION['user']['platform']='desktop';
if($detect->isTablet())
  $_SESSION['user']['platform']='tablet';
if($detect->isMobile())
  $_SESSION['user']['platform']='mobile';

/**
* Starting SEO.
*/
$_SESSION['seo'] = Array(
  'ptitle' => ($title = __APP_TITLE__),
  'title' => $title,
  'page' => '',
  'author' => __APP_PACKAGE__,
  'description' => 'Colecione seus personagens no League of Legends',
  'keywords' => '',
  'copyright' => 'Todos os direitos reservados © Copyright '.date('Y'),
  'feed' => 'http://feeds.feedburner.com/',
);

/**
* Social data
*/
$_SESSION['social'] = Array(
  'facebook' => 'https://www.facebook.com/lolcollector',
  'twitter' => 'https://twitter.com/LoLColector',
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
require_once __CONTROLLERS_DIR__.'FakeUser.php';
if(isset($_SESSION['user']['authenticated']['id'])){
  $user = new User($_SESSION['user']['authenticated']['id']);
  $_SESSION['user']['authenticated']['username'] = $user->getUsername();
  if(isset($_GET['logout'])){$user->logout();}
}
else{
  $user = new User;
}

/**
* Load data
*/
$summoners = $db->users;
$champions = $db->champions;
$skins = [];

foreach ($champions as $champion) {
	foreach($champion->skins as $skin) {
    if($skin->num === 0){
      continue;
    }
    $skins[] = $skin;
	}
}

/**
* Load API RIOT and check status
*/
require_once(__CONTROLLERS_DIR__.'RiotAPI.php');
$api = new RiotAPI();
if(!isset($_SESSION['user']['api']['checked']) || @$_SESSION['user']['api']['checked']+300<=time()){
  $_SESSION['user']['api']['status'] = ($api->getSummonerByName('chroda') == 503) ? 'down' : 'up' ;
  $_SESSION['user']['api']['checked'] = time();
}

/**
* Titles of knows pages
*/
define('__TITLE_SEP__', ' &bull; ');
define('__DESCR_SEP__', ' &mdash; ');
$seo_title='';
switch (rewrite(1)){
  case '':
  case 'index':
  case 'home':
    $seo_title = 'Início' ;
    break;
  case 'user':
    $seo_title = 'Perfil' ;
    $seo_description = 'Perfil do invocador' ;
    break;
  case 'list-summoners':
    $seo_title = 'Lista de Invocadores' ;
    $seo_description = 'Lista de Invocadores' ;
    break;
  case 'login-failed':
    $seo_title = 'Falha no Login' ;
    $seo_description = 'Falha ao logar no site';
    break;
  default:
    $seo_title = 'Página não encontrada';
    $seo_description = $seo_title ;
    break;
}

if(rewrite(2)=='signup'){
  $seo_title = 'Registrar-se';
}

if(rewrite(1)=='user' && (rewrite(2)!=='') && (rewrite(2)!=='signup')){
  $title_user_id = $user->getIdByUsername(rewrite(2));
  $title_user_champions = count(User::getChampions($title_user_id));
  $title_user_skins = count(User::getChampionsSkins($title_user_id));
  $seo_title = strtoupper(rewrite(2)).' - C: '.$title_user_champions.' - S: '.$title_user_skins;
  $seo_description = $seo_title;
}
$_SESSION['seo']['title'] = $seo_title.__TITLE_SEP__.$_SESSION['seo']['title'];
$_SESSION['seo']['page'] = $seo_title;
isset($seo_description) ? $_SESSION['seo']['description'] = $seo_description : null ;
