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
// CHAMPION-MASTERY-V3
// CURRENT-GAME-V1.0
// FEATURED-GAMES-V1.0
// GAME-V1.3
// LEAGUE-V2.5
// LEAGUE-V3
// LOL-STATIC-DATA-V1.2
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
