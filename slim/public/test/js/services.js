angular.module('app.services', [])

.factory('ArticleService', ['$http','$q','Config',function($http,$q,Config){
  return {
    getArticles:function(interests){
      var deferred = $q.defer();
      $http.get(Config.getUrlPosts+interests).then(function(res){
        var results = res.data;
        deferred.resolve(results);
      });
      return deferred.promise;
    },
    getArticle:function(id){
      var deferred = $q.defer();
      $http.get(Config.getUrlPosts+id).then(function(res){
        deferred.resolve(res.data);
      });
      return deferred.promise;
    },
  }
}])

.factory('UserService', ['$http','$q','Config','Session',function($http,$q,Config,Session){
  return {
    tryLogin:function(params){
      var deferred = $q.defer();
      var query_params = '';
      query_params += '&username='+params.email;
      query_params += '&password='+params.password;
      var api_query = Config.getUrlApi+'?action=apiLogin'+query_params;
      $http.get(api_query).then(function(res){
        var results = res.data;
        deferred.resolve(results);
      });
      return deferred.promise;
    },
    tryRegister:function(params){
      var deferred = $q.defer();
      var query_params = '';
      query_params += '&name=' +params.name;
      query_params += '&email='+params.email;
      query_params += '&pass=' +params.password;
      var api_query = Config.getUrlApi+'?action=registerUser';
      var config = {
        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
      };
      $http.post(api_query,query_params,config).then(function(res){
        var results = res.data;
        deferred.resolve(results);
      });
      return deferred.promise;
    },
    authorize:function(user){
      var deferred = $q.defer();
      var api_query = Config.getUrlApi+'?action=apiStatus'+'&hash='+user.hash;
      $http.get(api_query).then(function(res){
        var results = res.data;
        deferred.resolve(results);
      });
      return deferred.promise;
    },
    getUser:function(){
      var deferred = $q.defer();
      var user = function(data){
        response = (data.rows.length > 0) ? data.rows.item(0) : null ;
        deferred.resolve(response);
      }
      Session.hasSession(user);
      return deferred.promise;
    },
    getAllInterests:function(){
      var deferred = $q.defer();
      $http.get(Config.getUrlApi+'?action=getAllInterests').then(function(res){
        var results = res.data.value;
        deferred.resolve(results);
      });
      return deferred.promise;
    },
    setInterests:function(interests,hash){
      var deferred = $q.defer();

      var query_params = '';
      query_params += '&interests='+interests;
      query_params += '&hash='+hash;

      var api_query = Config.getUrlApi+'?action=setInterests'+query_params;
      $http.get(api_query).then(function(res){
        var results = res.data;
        deferred.resolve(results);
      });
      return deferred.promise;
    }
  }
}])
