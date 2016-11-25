var womensApp = angular.module('WomensProductsApp', ['ngRoute']);

womensApp.config(function ($routeProvider) {
  $routeProvider
  	.when('/products', {
    	controller: 'womensController',
    	templateUrl: 'views/products.html'
  })
  	.when('/courses/:productId', {
    	controller: 'ProductController',
    	templateUrl: 'views/product.html'
  })
  	.otherwise({
    	redirectTo: '/products'
  });
});