angular.module('app.controllers', [])
////////////////////////////////////////////////////////////////////////////////////////////////////////////
.controller('ArticlesCtrl',function($scope,ArticleService,$ionicNavBarDelegate,UserService){
  $ionicNavBarDelegate.showBackButton(false);
  $scope.articles = [];

  UserService.getUser().then(function(response){
    var interests = '';
    if(response){
      if(response.interests){
        var interests = '?tags='+response.interests;
      }
    }
    ArticleService.getArticles(interests).then(function(response){
      $scope.articles = response;
    });
  });
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////
.controller('ArticleCtrl',function($scope,$stateParams,ArticleService,Social){
  $scope.article = {};
  $scope.social = Social;
  ArticleService.getArticle($stateParams.id).then(function(response){
    $scope.article = response;
  });


})
////////////////////////////////////////////////////////////////////////////////////////////////////////////
.controller('InterestsCtrl',function($scope,UserService,Session,$location,$window,$state,$ionicPopup){
  $scope.interests = [];
  $scope.user_interests = [];

  UserService.getAllInterests().then(function(response){
    $scope.interests = response;
    UserService.getUser().then(function(response){
      $scope.user_interests = response.interests;
      $scope.interests.map(function(interest){
        interest.checked = $scope.user_interests.includes(interest.id);
      });
    });
  });

  $scope.saveInterests = function(){
    var arrayInterests = [];
    angular.forEach($scope.interests,function(interest){
      if(interest.checked){
        arrayInterests.push(interest.id);
      }
    });
    var interests = arrayInterests.join();
    var user = function(userdata){
      if(userdata.rows.length === 1){
        var hash = userdata.rows.item(0).hash;
        UserService.setInterests(interests,hash).then(function(response){
          if(response.code === 1){
            Session.updateInterests(interests);
            $ionicPopup.alert({
              title: 'Interesses salvos com sucesso!',
              okText: 'Ok',
              okType: 'button-aei',
            });
          }else{
            $ionicPopup.alert({
              title: 'Ooops!',
              subTitle: 'Serviço Indisponível',
              cssClass: '',
              templateUrl: 'templates/__poppup_unavailable-service.html',
              okText: 'Entendido',
              okType: 'button-aei',
            });
          }
        });
      }
    }
    Session.hasSession(user);

  };
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////
.controller('ProfileCtrl',function($scope,UserService){
  $scope.interests = [];
  UserService.getUser().then(function(response){
    $scope.profile = response;
  });
  UserService.getAllInterests().then(function(response){
    response.map(function(interest){
      if($scope.profile.interests.includes(interest.id)){
        $scope.interests.push(interest);
      }
    });
  });
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////
.controller('UserCtrl',function($scope,UserService,Session,$location,$ionicNavBarDelegate,$ionicPopup){
  $ionicNavBarDelegate.showBackButton(false);

  $scope.logout = function(){
    Session.logout();
    $location.path('#/articles');
  }

  $scope.loginUser = function(login){
    UserService.tryLogin(login).then(function(response){
      if (response.code === 1) {
        Session.login(
          response.value.name,
          response.value.email,
          response.value.hash,
          response.value.interests
        );
        $location.path('#/articles');
      } else {
        $ionicPopup.alert({
          title: 'Err!',
          subTitle: 'Suas credenciais não são válidas.',
          cssClass: '',
          templateUrl: 'templates/__poppup_unauthorized.html',
          okText: 'Entendido',
          okType: 'button-aei',
        });
      }
    });
  }

  $scope.registerUser = function(register){
    UserService.tryRegister(register).then(function(response){
      if (response.code === 1) {
        Session.login(
          response.value.name,
          response.value.email,
          response.value.hash,
          response.value.interests
        );
        $location.path('#/articles');
      } else {
        formRegister.reset();
        $ionicPopup.alert({
          title: 'Ooops!',
          subTitle: 'Usuário já existe.',
          cssClass: '',
          templateUrl: 'templates/__poppup_alreadyexists.html',
          okText: 'Entendido',
          okType: 'button-aei',
        });
      }
    });
  }

})
