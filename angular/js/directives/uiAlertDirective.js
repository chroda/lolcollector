app.directive("uiAlert", function(){
  return {
    templateUrl: "templates/alert.html",
    replcae: true,
    restrict: "AE",
    scope: {
      title: "@"
    },
    transclude:true
  }
});
