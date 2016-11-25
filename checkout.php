
<?php
session_start();
include 'includes/db.php';

include "functions.php";
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
?>
	<?php
		if (isset($_POST['login'])) {
			$email=$_POST['email'];
			$password=$_POST['password'];

			$sanitized_username = mysqli_real_escape_string($connection, $email);
			$sanitized_password = mysqli_real_escape_string($connection, $password);

			$query = "SELECT * FROM users WHERE user_email = '{$sanitized_username}'";
			$select_user_query = mysqli_query($connection, $query);
			if (!$select_user_query) {
				die("QUERY Failed". mysqli_error($connection));
			}
			while ($row = mysqli_fetch_array($select_user_query)) {
				$db_user_id = escape($row['user_id']);
				$db_user_firstname = escape($row['first_name']);
				$db_user_lastname = escape($row['last_name']);
				$db_user_role = escape($row['user_role']);
				$db_user_email = escape($row['user_email']);
				$db_username = escape($row['username']);
				$db_user_password = escape($row['user_password']);
			}
			if (password_verify($sanitized_password, $db_user_password)) {
				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['username'] = $db_username;
				$_SESSION['firstname'] = $db_user_firstname;
				$_SESSION['lastname'] = $db_user_lastname;
				$_SESSION['email'] = $db_user_email;
				$_SESSION['role'] = $db_user_role;
			}
			else {
				echo "<p class='text-center'>Wrong email or password.</p>";
			}
		}
	?>

 <div class="container">
	 <form method="post" action="">
	 	<h3 class="text-center">Please Log In</h3>
	 	<div class=row>
	 		<div class="col-sm-3"></div>
		 	<div class="form-group col-sm-6">
			 	<label for="email">Email</label>
			 	<input type="email" name="email" id="email" class="form-control">
		 	</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-sm-3"></div>
		 	<div class="form-group col-sm-6">
			 	<label for="password">Password</label>
			 	<input type="password" name="password" id="password" class="form-control ">
		 	</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-sm-4"></div>
		 	<div class="form-group col-sm-4">
	           <button type="submit" class="btn btn-primary btn-block" name="login">Sign in</button>
	        </div>
		</div>
	 </form>
 </div>

 <?php
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
	 	<div class="bs-callout bs-callout-warning hidden">
		  <p>There seems to be something wrong with your info.</p>
		</div>

		  <div class="card">
		    <div class="front side">
		      <span class="company">
		        CARD
		      </span>
		      PAYMENT CARD
		      <form action="includes/cartAction.php?action=placeOrder" id="demo-form" data-parsley-validate="" method="post">
			      <input type="text" placeholder="Card number" class="cc-num" name="cc-num">
			      <div>
			        Expires:
			        <input type="text" placeholder="MM/YY" class="cc-exp" name="cc-exp">
			      </div>
			    </div>
			    <div class="back side">
			      <div class="stripe"></div>
			      <div class="signature">
			        <span class="right">
			        CVC: <input type="text" placeholder="000" class="cc-cvc" name="cc-cvc" maxlength="4">
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
		   
			   <div class="addr" required="">
			   <input type="text" placeholder="Name" name="name" required="" value="John">
			   <input type="text" placeholder="Address Line 1" name="address" required="" value="123 Main St">
			    <input type="text" placeholder="Address Line 2" name="address2">
			    <input type="text" placeholder="Town" name="city" required="" value="Anytown">
			    <input type="text" placeholder="State" name="state" required="" value="Free State">
			    <input type="text" placeholder="Postcode" name="zipcode" required="" value="00000">
			    <input type="text" placeholder="Country" name="country" required="" value="USA">
			   </div>
			   <div class="text-center" style="padding: 20px;">

			    <input type="submit" class="btn btn-primary" name="complete_checkout" value="Continue">
			  </div>
		  </form>
	</div>
<?php } } } ?>
<?php foreach ($_SESSION['cart'] as $id) {
                $pids = $pids. $id.',';

            }?>
<?php include 'includes/footer.php';?>