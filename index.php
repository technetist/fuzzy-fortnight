<?php include 'includes/db.php'; ?>
<?php session_start(); ?>
<?php
	$itemCount = 0; 
	if(isset($_SESSION['cart'])){
		$itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array()); 
	} 
?>
<?php
	include 'includes/header.php';
?>
<?php
	include 'includes/nav.php';
?>
<div class="body-content" ng-app="ProductsApp">
	
	<?php
	include 'includes/features.php';
	?>

	<div class="container" ng-view>
	</div>
	
</div>


<?php
	include 'includes/footer.php';
?>
