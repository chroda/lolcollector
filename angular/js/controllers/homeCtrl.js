app.controller("homeCtrl", function($scope, $location, summonersAPI){
  $scope.summoner;
  $scope.searchSummoner = function(summoner){
    summonersAPI.searchByName(summoner.name).success(function(data){
      console.log(data);
      $scope.summoner = data;
      $scope.homeForm.$setPristine();
      $location.path("/details");
    });
  };
});
