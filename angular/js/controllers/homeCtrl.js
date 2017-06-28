app.controller("homeCtrl", function($scope, $location, summonersAPI){
  // $scope.summoner = summoner.data;
  $scope.searchSummoner = function(summoner){
    summonersAPI.searchByName(summoner.name).success(function(response){
      // $scope.summoner = response.data;
      $location.path("/details/"+response.data.name);
    });
  };


});
