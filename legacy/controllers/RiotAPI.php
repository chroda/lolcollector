<?php
/**
* @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
* @COPYRIGHT	Dev n' Quest 2014
* @PACKAGE		DnQ LolC
* @SINCE		April 2014
* @VERSION		0.1
*
* LATEST API VERSIONS
* champion			v1.2	[BR, EUNE, EUW, LAN, LAS, NA, OCE]
* game				v1.3	[BR, EUNE, EUW, LAN, LAS, NA, OCE]
* league			v2.3	[BR, EUNE, EUW, LAN, LAS, NA, OCE, RU, TR]
* lol-static-data	v1.2	[BR, EUNE, EUW, LAN, LAS, NA, OCE, RU, TR, KR]
* stats			v1.3 	[BR, EUNE, EUW, LAN, LAS, NA, OCE]
* summoner			v1.4 	[BR, EUNE, EUW, LAN, LAS, NA, OCE]
* team				v2.2	[BR, EUNE, EUW, LAN, LAS, NA, OCE, RU, TR]
*/

class RiotAPI{
  //const API_URL					='http://prod.api.pvp.net/api/lol/';
  //const API_URL_STATIC			='http://prod.api.pvp.net/api/lol/static-data/';
  const API_URL					='.api.pvp.net/api/lol/';
  const API_URL_STATIC			='.api.pvp.net/api/lol/static-data/';
  const API_KEY_PRIMARY			=__APP_RIOTAPI_KEY__;
  const API_KEY_SECONDARY			=__APP_RIOTAPI_KEY_S__;
  const RATE_LIMIT_MINUTES 		=500;
  const RATE_LIMIT_SECONDS 		=10;
  const CACHE_ENABLED 			=false;
  const CACHE_LIFETIME_MINUTES 	=60;
  private $region;

  public function __construct($region='br'){
    $this->region=$region;
  }

  private function getVersion($type){
    switch($type){
      case 'champion'			:$v='1.2';break;
      case 'game'				:$v='1.3';break;
      case 'league'			:$v='2.3';break;
      case 'lol-static-data'	:$v='1.2';break;
      case 'stats'			:$v='1.3';break;
      case 'summoner'			:$v='1.4';break;
      case 'team'				:$v='2.2';break;
    }
    return 'v'.$v;
  }

  private function format_url($call,$version,$apiUrl,$apiKey){
    return 'https://'.$this->region.$apiUrl.$this->region.'/'.$this->getVersion($version).'/'.$call.'api_key='.$apiKey;
  }

  /**
  * @TODO //probably should put rate limiting stuff here
  */
  private function request($call,$version,$apiUrl=self::API_URL,$apiKey=self::API_KEY_PRIMARY){
    //probably should put rate limiting stuff here
    $url 				= $this->format_url($call,$version,$apiUrl,$apiKey);

    if(self::CACHE_ENABLED){
      $cacheFile 		= __ROOT__.'cache/'.md5($url);
      if(file_exists($cacheFile)) {
        $fh 		=fopen($cacheFile,'r');
        $cacheTime 	=trim(fgets($fh));
        if($cacheTime > strtotime('-'. self::CACHE_LIFETIME_MINUTES.' minutes')){return fread($fh,filesize($cacheFile));}
        fclose($fh);unlink($cacheFile);
      }
    }
    $curlHandler=curl_init($url);
    curl_setopt($curlHandler,CURLOPT_VERBOSE,true);
    curl_setopt($curlHandler,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curlHandler,CURLOPT_SSL_VERIFYPEER,false);
    $result		=curl_exec($curlHandler);
    $code		=curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);curl_close($curlHandler);
    switch($code){
      case 200://OK
      if(self::CACHE_ENABLED){$fh=fopen($cacheFile,'w');fwrite($fh,time()."\n");fwrite($fh,$result);fclose($fh);}
      return $result;
      break;
      case 400://Bad request
      case 401://Unauthorized
      case 404://Not found
      break;
      case 429://Rate limit exceeded
      $this->request($call,$version,$apiUrl,self::API_KEY_SECONDARY);
      break;
      case 500://Internal server error
      case 503://Service unavailable
      return '503';
      break;
    }
  }

  public function getSummonerByName($name){
    $call = 'summoner/by-name/'.rawurlencode($name).'?';
    return $this->request($call,'summoner');
  }

  public function getStaticDataChampionsSkins(){
    $call = 'champion?champData=skins&';
    return $this->request($call,'champion',self::API_URL_STATIC);
  }

  public function getGame($id){
    $call = 'game/by-summoner/' . $id . '/recent';

    //add API URL to the call
    $call = self::API_URL_1_2 . $call;

    return $this->request($call);
  }

  public function getLeague($id){
    $call = 'league/by-summoner/' . $id;

    //add API URL to the call
    $call = self::API_URL_2_2 . $call;

    return $this->request($call);
  }

  public function getStats($id,$option='summary'){
    $call = 'stats/by-summoner/' . $id . '/' . $option;

    //add API URL to the call
    $call = self::API_URL_1_2 . $call;

    return $this->request($call);
  }

  public function getSummoner($id,$option=null){
    $call = 'summoner/' . $id;
    switch ($option) {
      case 'masteries':
      $call .= '/masteries';
      break;
      case 'runes':
      $call .= '/runes';
      break;
      case 'name':
      $call .= '/name';
      break;

      default:
      //do nothing
      break;
    }

    //add API URL to the call
    $call = self::API_URL_1_2 . $call;

    return $this->request($call);
  }

  public function getTeam($id){
    $call = 'team/by-summoner/' . $id;

    //add API URL to the call
    $call = self::API_URL_2_1 . $call;

    return $this->request($call);
  }



}




?>
