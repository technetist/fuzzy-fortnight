<?php session_start(); ?>
<?php include 'includes/db.php'; ?>
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
<?php 
if(isset($_SESSION['message'])) {
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
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
