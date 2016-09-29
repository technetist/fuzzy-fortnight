var app = angular.module('ProductsApp', ['ngRoute']);

app.config(function ($routeProvider) {
  $routeProvider
  	.when('/products', {
    	controller: 'productsController',
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