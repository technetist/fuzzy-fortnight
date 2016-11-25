var mensApp = angular.module('MensProductsApp', ['ngRoute']);

mensApp.config(function ($routeProvider) {
  $routeProvider
  	.when('/products', {
    	controller: 'mensController',
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