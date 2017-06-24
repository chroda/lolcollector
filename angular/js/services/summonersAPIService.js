app.factory("summonersAPI", function($http, config){

  console.log('summonerAPI');
  return {
    searchByName : function(summoner){
      return $http.get( "https://br1.api.riotgames.com/lol/summoner/v3/summoners/by-name/"+summoner, {
        params:{api_key:''}
      });
    }



  }

});
