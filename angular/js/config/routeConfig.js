app.config(function($routeProvider){

  $routeProvider.when("/home",{
    templateUrl:"templates/home.html",
    controller:"homeCtrl",
    // resolve:{
    //   contatos:function(contatosAPI){
    //     return contatosAPI.getContatos();
    //   },
    //   operadoras:function(operadorasAPI){
    //     return operadorasAPI.getOperadoras();
    //   }
    // }
  });

  $routeProvider.when("/details/:name",{
    templateUrl:"templates/details.html",
    controller:"homeCtrl",
    // resolve:{
    //   contatos:function(contatosAPI){
    //     return contatosAPI.getContatos();
    //   },
    //   operadoras:function(operadorasAPI){
    //     return operadorasAPI.getOperadoras();
    //   }
    // }
    resolve:{
      summoner: function(summonersAPI, $route){
        return summonersAPI.searchByName($route.current.params.name);
      }
    }
  });

  $routeProvider.when("/contatos",{
    templateUrl:"templates/contatos.html",
    controller:"contatosCtrl",
    resolve:{
      contatos:function(contatosAPI){
        return contatosAPI.getContatos();
      },
      operadoras:function(operadorasAPI){
        return operadorasAPI.getOperadoras();
      }
    }
  });

  $routeProvider.when("/novoContato",{
    templateUrl:"templates/novoContato.html",
    controller:"novoContatoCtrl",
    resolve:{
      operadoras:function(operadorasAPI){
        return operadorasAPI.getOperadoras();
      }
    }
  });

  $routeProvider.when("/detalhesContato/:id",{
    templateUrl:"templates/detalhesContato.html",
    controller:"detalhesContatoCtrl",
    resolve:{
      contato: function(contatosAPI, $route){
        return contatosAPI.getContato($route.current.params.id);
      }
    }
  });

  $routeProvider.when("/error",{
    templateUrl:"templates/error.html"
  });

  $routeProvider.otherwise({redirectTo:"/home"});
});
