app.controller('productsController', ['$scope', 'products',  function($scope, products) {
	products.success(function(data) {
    $scope.myProducts = data.records;
  });
}]);