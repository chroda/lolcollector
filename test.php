<style media="screen">
body{
  margin: 0;
}
img{
  width: 50px;
  float: left;
}
</style>

<?php

// {
//     "profileIconId": 552,
//     "name": "chroda",
//     "summonerLevel": 40,
//     "accountId": 1697425,
//     "id": 1765464,
//     "revisionDate": 1517728659000
// }

const url = 'https://br1.api.riotgames.com/lol/';
const key = '&api_key=RGAPI-8c61f2fd-4eda-4d32-ac23-f2bb1df0952d';
const version = '8.2.1';

date_default_timezone_set('America/Sao_Paulo');

function getFromApi($middle){
  return json_decode(file_get_contents(url.$middle.key));
}

function pr($val){
  print '<pre>';
  print_r($val);
  print '</pre>';
}

$masteries = getFromApi('champion-mastery/v3/champion-masteries/by-summoner/1765464?');
$champions = getFromApi('static-data/v3/champions?locale=en_US&dataById=false')->data;

foreach ($masteries as $masterie) {
  foreach ($champions as $key => $champion) {
    if($champion->id == $masterie->championId){
      echo "<img src='http://ddragon.leagueoflegends.com/cdn/{version}/img/champion/{$key}.png'/>";
    }
  }
}


// https://br1.api.riotgames.com/lol/static-data/v3/champions/110?locale=en_US&api_key=RGAPI-fd040cb5-319d-4462-8f3f-eda3105db8ad
// https://br1.api.riotgames.com/lol/static-data/v3/champions/110?locale=en_US?&api_key=RGAPI-fd040cb5-319d-4462-8f3f-eda3105db8ad
