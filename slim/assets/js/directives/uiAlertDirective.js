app.directive("uiAlert", function(){
  return {
    templateUrl: "view/alert.html",
    replcae: true,
    restrict: "AE",
    scope: {
      title: "@"
    },
    transclude:true
  }
});
