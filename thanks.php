<?php 
$itemCount = 0; 
if(isset($_SESSION['cart'])){
	$itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array()); 
} 

session_start();
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";
?>

<div class="container">
	<?php if(isset($_REQUEST['id'])){
		$orderID = $_REQUEST['id']; 
	?>
		<h1 class="text-center">Thanks for your purchase</h1>
		<h2 class="text-center">Just to review...</h2>
		<h3>Here is what you purchased:</h3>


		<?php 

			$query = "SELECT * FROM orders ";
			$query .= "JOIN order_items ";
			$query .= "ON orders.id = order_items.order_id ";
			$query .= "JOIN aftersell_items ";
			$query .= "ON orders.aftersell = aftersell_items.item_id ";

			$query .= "WHERE order_id = ".$orderID;
			$join_query = mysqli_query($connection,$query);
			$item_price = 0;
            while ( $product = mysqli_fetch_assoc($join_query)) {

                $productName = $product['order_product_name'];
                $productPrice = $product['order_product_price'];
                $totalPrice = $product['total_price'];
           		$aftersellId = $product['aftersell'];
                $aftersellImg = $product['item_img'];
                $aftersellName = $product['item_name'];
                $aftersellPrice = $product['item_price'];
                $orderDate = $product['order_date'];
                $shipping = 6.94;
                $salesTax = 0.12;
            	
                $item_price += $productPrice;
                
                
            ?>
			<div class="row item-list">
				<div class="col-xs-1 col-sm-2">
				</div>
				<div class="col-xs-8 col-sm-7 items">
					<h4><?php echo $productName; ?></h4>
				</div>
				<div class="col-xs-2 col-sm-1 price text-center">
					<p>$<?php echo $productPrice; ?></p>
				</div>
				<div class="col-xs-1 col-sm-2">
				</div>
			</div>
			<?php } ?>
			<?php if($aftersellId != "6"){ ?>
			<div class="row">
				<div class="col-xs-1 col-sm-1"></div>
				 
				<div class="col-xs-8 col-sm-7">
					<h4>Addons</h4>
				</div>
			</div>
			<div class="row item-list">
				<div class="col-xs-1 col-sm-2">
				</div>
				<div class="col-xs-8 col-sm-7 items">
					<h4><?php echo $aftersellName; ?></h4>
				</div>
				<div class="col-xs-2 col-sm-1 price text-center">
					<p>$<?php echo $aftersellPrice; ?></p>
				</div>
				<div class="col-xs-1 col-sm-2">
				</div>
			</div>
			<?php } ?>
			<div class="row total">
				<div class="col-xs-1 col-sm-2">
				</div>
				<div class="col-xs-8 col-sm-7 text-right">Sales Tax:</div>
				<div class="col-xs-2 col-sm-1 total-price">$<?php echo $taxPrice = $salesTax * $item_price; ?></div>
			</div>
			<div class="row total">
				<div class="col-xs-1 col-sm-2">
				</div>
				<div class="col-xs-8 col-sm-7 text-right">Standard Shipping:</div>
				<div class="col-xs-2 col-sm-1 total-price">$<?php echo $shipping; ?></div>
			</div>
			<div class="row total">
				<div class="col-xs-1 col-sm-2">
				</div>
				<div class="col-xs-8 col-sm-7 text-right">Total:</div>
				<div class="col-xs-2 col-sm-1 total-price">$<?php echo $totalPrice; ?></div>
			</div>
			<?php $ship_start_date = strtotime($orderDate."+ 3 days") ?>
			<?php $ship_end_date = strtotime($orderDate."+ 5 days") ?>
			<h4 class="text-center">Your package will be shipped between: <?php echo date(' l F jS\, Y', $ship_start_date) ?> - <?php echo date(' l  F jS\, Y', $ship_end_date) ?></h4>
			<div class="text-center" style="padding-bottom: 20px;">
				<a href="index.php">Click to go to the landing page</a>
			</div>
		</div>
	<?php }else {?>
		<h1>Oops! It appears there was an error.</h1>
	<?php } ?>
</div>

<?php
include "includes/footer.php";
?>