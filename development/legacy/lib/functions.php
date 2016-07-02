<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira	(chroda) <chroda@chroda.com.br>
 * @AUTHOR		Walter Luiz Martins				(urtred) <walter.martins@hotmail.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ Sistema
 * @SINCE		February 2014
 * @VERSION		0.1
 *
 * The functions in this script were produced as if needed,
 * can serve many or one projects in particular.
 */

function pr($expression,$dump=false){
	print'<pre style="z-index:9999;block;position:relative;">';
	$dump===true?var_dump($expression):print_r($expression);
	print'</pre>';
}
/**
 * ($_link=false, $_return = false)
 */
function location($_link=false,$_return=false){
	$_dns  = __DNS__;
	$_path = __PATH__;
	if($_link['0']=='/'){
		for($i=1;$i<=strlen($_link);$i++){
			@$_tmp .= $_link[$i];
		}
		$_link = $_tmp;
	}
	if($_SERVER['SERVER_PORT'] != 80){
		$_port = ":{$_SERVER['SERVER_PORT']}";
	}else{
		$_port = '';
	}
	$_url  = "http://".str_replace('//','/',"{$_dns}{$_port}{$_path}{$_link}");
	if($_return==true){return $_url;}
	echo $_url;
}
function startTimer ($_what='') {
	global $_MYTIMER; $_MYTIMER=0;
	list ($_usec, $_sec) = explode (' ', microtime());
	$_MYTIMER = ((float) $_usec + (float) $_sec);
}
function stopTimer($_return = false) {
	global $_MYTIMER; if (!$_MYTIMER) return; //no timer has been started
	list ($_usec, $_sec) = explode (' ', microtime()); //get the current time
	$_MYTIMER = ((float) $_usec + (float) $_sec) - $_MYTIMER; //the time taken in milliseconds
	if($_return == false) {
		print number_format ($_MYTIMER, 5);
	} else {
		return number_format ($_MYTIMER, 5);
	}
}
function rewrite($_index='none') {
	$_rewrite      = explode('/',removeLastCharacter(str_replace(str_replace(__PATH__, '/', $_SERVER['SCRIPT_NAME']), '', str_replace(__PATH__, '/', $_SERVER['REQUEST_URI'])), '/'));
	$_rewrite['0'] = $_request_uri = str_replace(str_replace(__PATH__, '/', $_SERVER['SCRIPT_NAME']), '', str_replace(__PATH__, '/', $_SERVER['REQUEST_URI']));
	$_return = null;
	if(is_int($_index)){
		if(isset($_rewrite[$_index ])){
			$_return = removeLastCharacter($_rewrite[$_index],'/');
			if(strpos($_return,'?')>0){
				$_tmp = explode('?', $_return);
				$_return=$_tmp[0];
			}
		}
		return $_return;
	}else{return $_rewrite;
	}
}
function removeLastCharacter($_str=false,$_last='',$_remove=1){
	$_tmp = '';
	if($_str[strlen($_str)-1]==$_last || $_last==''){
		for($i=0;$i<=strlen($_str)-($_remove+1);$i++){
			$_tmp .=  $_str[$i];
		}
		return $_tmp;
	}else{
		return $_str;
	}
}
function takeDate($timestamp,$junction = false){
	if($junction){
		return date('d/m/Y',$timestamp).' ás '.date('H:i',$timestamp);
	}
	return date('d/m/Y H:i',$timestamp);
}
function __t( $_query = false , $_ordering = array('en','es','pt')){
	if(file_exists(__CONTROLLERS_DIR__.'I18n.php')){
		require_once(__CONTROLLERS_DIR__.'I18n.php');
		$_translator = new I18n($_ordering);
		if($_query == false){
			return 'Please insert a query';
		}
		return $_translator->translate($_query);
	}else{return 'ERROR - Class I18n not found';}
}
function urlRedirect( $_HTTP_HOST, $_REQUEST_URI ){
	if($_SERVER['HTTP_HOST'] === $_HTTP_HOST && $_SERVER['REQUEST_URI'] === $_REQUEST_URI){
		header('Location: http://'.str_replace('/', '', $_REQUEST_URI).'.'.$_HTTP_HOST);
	}
}
function youtubeId($url){
	$res = explode("v=",$url);
	if(isset($res[1])){
		$res1 = explode('&',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
		$res1 = explode('#',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
		return substr($res[1],0,12);
	}
	return false;
}
function isMd5($md5){
	return !empty($md5) && preg_match('/^[a-f0-9]{32}$/', $md5);
}
function breadcrumb(){
	foreach(rewrite() as $key => $value){
		if($key == 0){
			$url='';$return='';continue;
		}
		$url .= $value.'/';
		if($key !== 1){
			$return .= ' <i class="icon-chevron-right"></i> ';
		}
		$return .=  '<a href="'.location($url,true).'">'.$value.'</a>';
	}return $return;
}
function removeAccents($string){
	$accents= array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
	$normals= array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
	return str_replace($accents,$normals,$string);
}