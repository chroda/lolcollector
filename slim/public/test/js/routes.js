angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

  .state('articles', {
    url: '/articles',
    templateUrl: 'templates/articles.html',
    controller: 'ArticlesCtrl'
  })

  .state('article', {
    url: '/article/:id',
    templateUrl: 'templates/article.html',
    controller: 'ArticleCtrl'
  })

  .state('interests', {
    url: '/interests',
    templateUrl: 'templates/interests.html',
    controller: 'InterestsCtrl'
  })

  .state('profile', {
    url: '/profile',
    templateUrl: 'templates/profile.html',
    controller: 'ProfileCtrl'
  })

  .state('login', {
    url: '/login',
    templateUrl: 'templates/login.html',
    controller: 'UserCtrl'
  })
  
  .state('register', {
    url: '/register',
    templateUrl: 'templates/register.html',
    controller: 'UserCtrl'
  })

  $urlRouterProvider.otherwise('/articles')

});
