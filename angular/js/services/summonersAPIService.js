app.factory("summonersAPI", function($http, config){
  return {
    searchByName: function(summoner){
      // return $http.post( config.baseUrl + "backend/contatos.php", contato);
      return summoner;
    }
  }
});
