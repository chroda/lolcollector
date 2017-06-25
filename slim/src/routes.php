<?php
// Routes

$app->get('/details/[{summoner}]', function ($request, $response, $args) {
  // $this->logger->info("Slim-Skeleton '/' route");
  return $response->withJson([
    'code' => 200,
    'message' => 'OKAY'
  ]);
});
