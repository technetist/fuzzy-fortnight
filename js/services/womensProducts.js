womensApp.factory('products', ['$http', function($http) {
  //return $http.get('https://api.myjson.com/bins/5axi1')
  return $http.get('http://localhost/CityMarks/includes/womens_products_mysql.php')
  	.success(function(data) {
    	return data;
  	})
  	.error(function(err) {
    	return err;
  });
}]);