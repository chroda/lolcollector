<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 *
 * Setup you project in 'Production' and 'Development' enviroments.
 */
define( '__APP_PACKAGE__'		,'DNQ');
define( '__APP_TITLE__'			,'LoL Collector');
define( '__APP_VERSION__'		,'0.1');
define( '__APP_EMAIL__'			,'devnquest@gmail.com');
define( '__APP_ADSENCE__'		,'ca-pub-9598578551181463');
define( '__APP_RIOTAPI_KEY__'	,'2a0a5c1e-7355-42dc-8e2b-f25d5ee9771f');
define( '__APP_RIOTAPI_KEY_S__'	,'602c4a60-4d56-44c3-b85e-97837d4685f3');
define( '__DEBUG__'				,true);
define( '__DNS__'				,$_SERVER['SERVER_NAME']);
define( '__IP__'				,$_SERVER['SERVER_ADDR']);
define( '__HERE__'				,$_SERVER['REQUEST_URI']);
define( '__VIEW_EXT__'			,'.php');
define( '__TPL_EXT__'			,__VIEW_EXT__);
define( '__LOGGING__'			,true);
define( '__SESSION_NAME__'		,strtoupper(str_replace('\'','', str_replace(' ','',(__APP_PACKAGE__.'-'.__APP_TITLE__)))));
define( '__SESSION_TIMEOUT__'	,3600);
define( '__LOCALE__'			,'pt-br');
define( '__TIMEZONE_LOCAL__'	,'America/Sao_Paulo');
define( '__TIMEZONE_TIME__'		,'Etc/GMT+3');
define( '__ROOT__'				,str_replace('\\','/', dirname(__FILE__)).'/');
define( '__LIB_DIR__'			,__ROOT__		. 'lib/');
define( '__CONTROLLERS_DIR__'	,__ROOT__		. 'controllers/');
define( '__VIEW_PATH__'			,__ROOT__		. 'views/');
define( '__VIEW_CPT_PATH__'		,__VIEW_PATH__	. 'components/');
define( '__VIEW_USER_PATH__'	,__VIEW_PATH__	. 'user/');
define( '__VIEW_ADM_PATH__'		,__VIEW_PATH__	. 'admin/');

header( 'Accept-Charset:utf-8,ISO-8859-1;q=0.7,*;q=0.7"',true);
header( 'Content-Type: text/html; charset=UTF-8');
header( 'Expires: '.date( 'D, d m Y H:i:s' ).' GMT');
header( 'X-Powered-By: '.__APP_PACKAGE__.'/'.__APP_VERSION__ );
header( 'X-Server-Name: '. __DNS__);
header( 'X-Developer: Christian Marcell (chroda) <chroda@chroda.com.br>');

date_default_timezone_set( __TIMEZONE_LOCAL__ );
date_default_timezone_set( __TIMEZONE_TIME__ );
mb_internal_encoding( "UTF-8" );
require_once __LIB_DIR__.'functions.php';
if(file_exists($appFunctions = __LIB_DIR__.'functions.'.trim(strtolower(str_replace(' ','',__APP_TITLE__))).'.php')){require_once $appFunctions;}
ini_set("display_errors",__DEBUG__);
setlocale(LC_ALL, __LOCALE__ . ".UTF-8");
ini_set('session.name',__SESSION_NAME__);
ini_set('session.cookie_lifetime',__SESSION_TIMEOUT__);
ini_set('session.use_trans_sid',true);
switch(__DNS__):
/**
 * Production.
 */
case 	 'lolcollector.com':
case 'www.lolcollector.com':
case 	 'lolcollector.com.br':
case 'www.lolcollector.com.br':
	define('MYSQL_HOST','mysql.hostinger.com.br');
	define('MYSQL_USER','u657450779_lolc');
	define('MYSQL_PASS','xQ30CuUG5I');
	define('MYSQL_NAME','u657450779_lolc');
	define( '__ENV__', 'prod' );
	define( '__PATH__', '/' );
	break;

/**
 * Development.
 */
case 'localhost':default:
	define('MYSQL_HOST','localhost');
	define('MYSQL_USER','root');
	define('MYSQL_PASS','');
	define('MYSQL_NAME','lolcollector');
	define( '__ENV__', 'dev' );
	define( '__PATH__', '/lolcollector/development/legacy/' );
	break;
endswitch;

define('CDN_DIR',__PATH__ .'cdn/');
define('DATA_DIR',__PATH__ .'data/');
define('PKG_DIR','http://'.__IP__.'/pkg/');

$obj = json_decode(file_get_contents('https://raw.githubusercontent.com/chroda/lolcollector/master/development/legacy/db.json'));
$db = new StdClass;
//$db->champions = (array)$obj->champions->data;
$db->users = [];
$db->champions = [];
foreach ($obj->users as $id => $dbUser){
	$db->users[$dbUser->id] = $dbUser;
}
foreach ($obj->champions->data as $id => $dbChampions){
	$db->champions[$dbChampions->name] = $dbChampions;
}
ksort($db->champions);

session_start();
