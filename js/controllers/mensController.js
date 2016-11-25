mensApp.controller('mensController', ['$scope', 'products',  function($scope, products) {
	products.success(function(data) {
    $scope.myProducts = data.records;
    $scope.getGenderClass = function (strValue) {
	    if (strValue == ("Male"))
	        return "label-primary";
    }
    $scope.getProductClass = function (strValue) {
	    if (strValue == ("Shirt"))
	        return "label-info";
	    else if (strValue == ("Pants"))
	        return "label-light";
	    else if (strValue == ("Dress"))
	        return "label-purple";
	    else if (strValue == ("Shoes"))
	        return "label-yellow";
    }
  });
}]);