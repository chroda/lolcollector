app.factory("contatosAPI", function($http, config){

  var _getContatos = function(){
    return $http.get( config.baseUrl + "backend/contatos.json");
  }

  var _getContato = function(id){
    return $http.get( config.baseUrl + "backend/contatos.php?id=" + id);
  }

  var _saveContato = function(contato){
    return $http.post( config.baseUrl + "backend/contatos.php", contato);
  }

  return {
    getContatos: _getContatos,
    getContato: _getContato,
    saveContato: _saveContato
  }

});
