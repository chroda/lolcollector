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


$app->get('/champion-mastery-by-summoner/[{name}]', function ($request, $response, $args) {
  // $this->logger->info("Slim-Skeleton '/' route");
  // /lol/champion-mastery/v3/scores/by-summoner/{summonerId}
  $args = (object) $args;
  $requisition = json_decode(file_get_contents('https://br1.api.riotgames.com/lol/summoner/v3/summoners/by-name/'.$args->name.'?api_key=2a0a5c1e-7355-42dc-8e2b-f25d5ee9771f'));
  return $response->withJson([
    'code' => 200,
    'data' => $requisition
  ]);
});
