app.factory("summonersAPI", function($http, config, riotapi, riotsecret){

  return {
    searchByName : function(summoner){
      return $http.get(riotapi.baseurl+'lol/summoner/v3/summoners/by-name/'+summoner+'?api_key='+riotsecret);
    }



  }

});
