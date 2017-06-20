angular.module('app', ['ionic', 'app.controllers', 'app.routes', 'app.services', 'app.directives' , 'app.values'])

// SESSION CHECKER AND USER ACCESS AUTHENTICATION
.run(function ($rootScope,$ionicPlatform,$location,UserService,Session,$ionicSideMenuDelegate,$ionicNavBarDelegate) {
  $rootScope.$on('$stateChangeStart', function (event, next, current) {
    $rootScope.show_register = true;
    $rootScope.show_login    = true;
    switch ($location.$$path) {
      case '/register':$rootScope.show_register = false;break;
      case '/login'   :$rootScope.show_login    = false;break;
      default:
      $rootScope.show_register = true;
      $rootScope.show_login    = true;
      break;
    }
    $rootScope.loaded = false;
    $ionicNavBarDelegate.showBackButton(false);
    $ionicSideMenuDelegate.canDragContent($rootScope.loaded);
    var user = function(data){
      if(data.rows.length === 1){
        var sessionUser = data.rows.item(0);
        UserService.authorize(sessionUser).then(function(response){
          if(response.code === 1){
            $rootScope.logged = true;
            $rootScope.loaded = true;
            $ionicSideMenuDelegate.canDragContent($rootScope.loaded);
          }else{
            $rootScope.logged = false;
            $rootScope.loaded = true;
            Session.logout();
            $location.path('#/articles');
          }
        });
      }else{
        $rootScope.logged = false;
        $rootScope.loaded = true;
        switch ($location.$$path) {
          case '/interests': $location.path('#/articles'); break;
          case '/profile'  : $location.path('#/articles'); break;
        }
      }
    };
    Session.hasSession(user);
  });
})

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if (window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})
