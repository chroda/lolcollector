app.controller("homeCtrl", function($scope, $location, summonersAPI, summoner){
  $scope.summoner = summoner.data;
  $scope.searchSummoner = function(summoner){
    summonersAPI.searchByName(summoner.name).success(function(data){

      $scope.summoner = data.data;

      $location.path("/details/"+$scope.summoner.name);
    });
  };


});
