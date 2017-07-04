<?php
// Routes

$app->get('/', function ($request, $response, $args) {
  pr($this->riot);

});

$app->get('/summonersbyname/[{name}]', function ($request, $response, $args) {
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
  $requisition = json_decode(file_get_contents($endpoint));return $response->withJson([
    'code' => 200,
    'data' => $requisition
  ]);
});
