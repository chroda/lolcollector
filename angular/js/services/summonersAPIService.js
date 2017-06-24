app.factory("summonersAPI", function($http, config, riotapi, riotsecret){

  return {
    searchByName : function(summoner){
      console.log(riotapi);
      return $http.get(riotapi.baseurl+'lol/summoner/v3/summoners/by-name/'+summoner, {params:{api_key:riotsecret}});
    }



  }

});
