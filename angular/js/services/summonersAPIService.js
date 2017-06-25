app.factory("summonersAPI", function($http, config, riotapi, riotsecret){

  return {
    searchByName : function(summoner){
      const address = 'http://localhost/lolcollector/slim/public/summonersbyname/chroda';
      // console.log(address);
      // return $http.get(riotapi.baseurl+'lol/summoner/v3/summoners/by-name/'+summoner+'?api_key='+riotsecret);
      return $http.get(address);
    }



  }

});
