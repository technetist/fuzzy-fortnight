<?php
session_start();
$itemCount = 0;
if(isset($_SESSION['cart'])){
   
   $itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array());

}


include 'includes/db.php';
include 'includes/header.php';
include 'includes/nav.php';

?>

	<div class="container text-center">
		<h1>Order <?php if(isset($_REQUEST['id'])){	$orderID = $_REQUEST['id']; echo $orderID; } ?> Submitted Successfully</h1>
		<h2>One more thing...</h2>

		<h3>Would any of these offers interest you?</h3>
	</div>
	<div class="container">
    	<div class="row">
	    	<div class="col-md-12">
	    	    	<?php 
    		$query = "SELECT * FROM aftersell_items WHERE item_id < 6";
    		$select_aftersell_query = mysqli_query($connection, $query);
    		while ($row = mysqli_fetch_assoc($select_aftersell_query)) {
    				$itemName = $row['item_name'];
    				$itemPrice = $row['item_price'];
    				$itemDesc = $row['item_desc'];
    				$itemImg = $row['item_img'];
    				$itemID = $row['item_id'];
    	?>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail" >
						
						<img src="<?php echo $itemImg ?>" class="img-responsive">
						<div class="caption">
							<div class="row">
								<div class="col-md-6 col-xs-6">
									<h3><?php echo $itemName ?></h3>
								</div>
								<div class="col-md-6 col-xs-6 price">
									<h3>
									<label>$<?php echo $itemPrice ?></label></h3>
								</div>
							</div>
							<p><?php echo $itemDesc ?></p>
							<div class="row">
								<div class="col-sm-12">
									<a href="includes/aftersellAction.php?choice=<?php echo $itemID ?>&id=<?php echo $orderID ?>" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a></div>
							</div>

							<p> </p>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<a href="includes/aftersellAction.php?choice=6" style="padding-bottom: 20px;">No thanks...</a>
	</div>

<?php
	include 'includes/footer.php';
?>
