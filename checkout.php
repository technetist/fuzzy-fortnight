
<?php
session_start();
include 'includes/db.php';
$itemCount = 0;

if(isset($_SESSION['cart'])){
   
   $itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array());

}
include 'includes/checkout_header.php';

// initializ shopping cart class
include 'includes/nav.php';

// redirect to home if cart is empty
if($itemCount <= 0){
    header("Location: index.php");
}
if(!isset($_SESSION['user_id'])){
 echo "Please log in";
}else{
// get customer details by session customer ID
$query = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id'];
$select_users_query = mysqli_query($connection, $query);
$custRow = mysqli_fetch_assoc($select_users_query);

?>

	<div class="checkout" style="padding-bottom: 20px;">
	  <h1>Checkout</h1>
	  <p>You are about to buy:</p>
	  <?php
        if($itemCount > 0){
            $pids = "";
            foreach ($_SESSION['cart'] as $id) {
                $pids = $pids. $id.',';
            }

            $pids = rtrim($pids, ",");



            $sql = "SELECT product_id, product_name, product_price, product_img FROM products WHERE product_id IN (".$pids.")";
            $query = mysqli_query($connection,$sql);
            $row = mysqli_num_rows($query);
            if($row > 0){
                while ( $product = mysqli_fetch_assoc($query)) {

                    $productImg = $product['product_img'];
                    $productId = $product['product_id'];
                    $productName = $product['product_name'];
                    $productPrice = $product['product_price'];
                    $totalPrice = $_SESSION['totalPrice'];
                
                
            ?>
	  
	  <p><img class="item" src="<?php echo $productImg ?>" /><?php echo $productName ?> for $<?php echo $productPrice ?></p>
	  <?php  }?>
	  <p>Total: $<?php echo $totalPrice;?>

	 <!--  <p>You don't have a card saved with us, so you'll need to add one now</p> -->

		  <div class="card">
		    <div class="front side">
		      <span class="company">
		        CARD
		      </span>
		      PAYMENT CARD
		      <input type="text" placeholder="Card number" class="cc-num" name="cc_num" />
		      <div>
		        Expires:
		        <input type="text" placeholder="MM/YY" class="cc-exp" name="cc-exp" />
		      </div>
		    </div>
		    <div class="back side">
		      <div class="stripe"></div>
		      <div class="signature">
		        <span class="right">
		        CVC: <input type="text" placeholder="000" class="cc-cvc" name="cc-cvc"maxlength="4" />
		        </span>
		        <span class="sig">
		          our loyal customer
		        </span>
		      </div>
		    </div>
		  </div>
		  <div class="button flip">
		    Flip over
		  </div>
		  <p>Now, where to send it?</p>
		   <div class="addr">
		   <input type="text" placeholder="Name" name="name" />
		   <input type="text" placeholder="Address Line 1" name="address" />
		    <input type="text" placeholder="Address Line 2" name="address2" />
		    <input type="text" placeholder="Town" name="city" />
		    <input type="text" placeholder="State" name="state" />
		    <input type="text" placeholder="Postcode" name="zipcode" />
		    <input type="text" placeholder="Country" name="country" />
		   </div>
		   <div class="text-center" style="padding: 20px;">

		    <a href="includes/cartAction.php?action=placeOrder"><input type="submit" class="btn btn-primary" name="complete_checkout" value="Continue"></a>
		  </div>
	</div>
<?php } } } ?>
<?php foreach ($_SESSION['cart'] as $id) {
                $pids = $pids. $id.',';

            }?>
<?php include 'includes/footer.php';?>