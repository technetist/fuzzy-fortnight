<?php session_start(); ?>
<?php
	include 'includes/header.php';
?>
<?php
	include 'includes/nav.php';
?>
<div class="body-content">
	
	<?php
	include 'includes/features.php';
	?>

	<div class="container" ng-view>
	</div>
	
</div>


<?php
	include 'includes/footer.php';
?>