<?php
// Routes

$app->get('/', function ($request, $response, $args) {
  echo 'LoLCollector API - lolcollector.chroda.com.br';
});

$app->get('/summoner-by-name/[{name}]', function ($request, $response, $args) {
  $r = $this->riot;
  $args = (object) $args;
  $endpoint = 'https://'.$this->riot->server.'.'.$this->riot->baseurl.'/lol/summoner/v3/summoners/by-name/'.$args->name.'?api_key='.$this->riot->key;
  $this->logger->info('Endpoint: '.$endpoint);
  $requisition = json_decode(file_get_contents($endpoint));
  return $response->withJson([
    'code' => 200,
    'data' => $requisition
  ]);
});

$app->get('/champion-mastery-by-summoner/[{summonerId}]', function ($request, $response, $args) {
  $args = (object) $args;
  $endpoint = 'https://'.$this->riot->server.'.'.$this->riot->baseurl.'/lol/champion-mastery/v3/scores/by-summoner/'.$args->summonerId.'?api_key='.$this->riot->key;
  $this->logger->info('Endpoint: '.$endpoint);
  $requisition = json_decode(file_get_contents($endpoint));
  return $response->withJson([
    'code' => 200,
    'data' => $requisition
  ]);
});


// Just stable versions

// CHAMPION-MASTERY-V3
  // /lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}
  // /lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}/by-champion/{championId}
  // /lol/champion-mastery/v3/scores/by-summoner/{summonerId}
// CHAMPION-V3
  // /lol/platform/v3/champions
  // /lol/platform/v3/champions/{id}
// LEAGUE-V3
  // /lol/league/v3/challengerleagues/by-queue/{queue}
  // /lol/league/v3/leagues/by-summoner/{summonerId}
  // /lol/league/v3/masterleagues/by-queue/{queue}
  // /lol/league/v3/positions/by-summoner/{summonerId}
// LOL-STATIC-DATA-V3
  // /lol/static-data/v3/champions
  // /lol/static-data/v3/champions/{id}
  // /lol/static-data/v3/items
  // /lol/static-data/v3/items/{id}
  // /lol/static-data/v3/language-strings
  // /lol/static-data/v3/languages
  // /lol/static-data/v3/maps
  // /lol/static-data/v3/masteries
  // /lol/static-data/v3/masteries/{id}
  // /lol/static-data/v3/profile-icons
  // /lol/static-data/v3/realms
  // /lol/static-data/v3/runes
  // /lol/static-data/v3/runes/{id}
  // /lol/static-data/v3/summoner-spells
  // /lol/static-data/v3/summoner-spells/{id}
  // /lol/static-data/v3/versions
// MASTERIES-V3
// MATCH-V2.2 ( KR, LAN )
// MATCH-V3 ( BR )
// MATCHLIST-V2.2 ( BR, EUNE, EUW, JP, KR, LAN, LAS, OCE, RU, TR )
// RUNES-V3
// SPECTATOR-V3
// STATIC-DATA-V3
// STATS-V1.3
// SUMMONER-V1.4
// SUMMONER-V3

// TOURNAMENTS-V3
  // /lol/tournament/v3/codes
