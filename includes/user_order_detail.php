
<?php
    if (isset($_GET['view_order']) && isset($_SESSION['user_id'])) {
        $the_order_id = escape($_GET['view_order']);

        $query = "SELECT * FROM orders JOIN users ON orders.user_id = users.user_id WHERE id = ".$the_order_id."";
        $select_users_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_users_query)) {
        	$user_id = $row['user_id'];
            $order_id = $row['id'];
            $order_date = $row['order_date'];
            $user_firstname = $row['first_name'];
            $user_lastname = $row['last_name'];
            $user_email = $row['user_email'];
        }
	} else {
	    header("Location: index.php");
	}
	if ($_SESSION['user_id'] == $user_id) {
		
?>

<div class="container">
    <div class="row">
        <div class="col-xs-6">
		</div>
		<div class="col-xs-6 text-right">
		  <h1>Order Detail</h1>
		  <h2>Order #<?php echo $order_id ?></small></h2>
		  <?php $date = strtotime($order_date) ?>
		  <h2><small><?php echo date('g:ia \o\n l jS F Y', $date) ?></small></h2>
		</div>
		<hr>
        <div class="col-xs-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>To : <a href="#"><?php echo "".$user_firstname." ".$user_lastname."" ?></a></h4>
				</div>
				<?php
					$address_query = "SELECT * FROM addresses WHERE order_id = $the_order_id";
					$select_address_query = mysqli_query($connection, $address_query);
					$count = mysqli_num_rows($select_address_query);
					if ($count > 0) {
					
					while ($row = mysqli_fetch_assoc($select_address_query)) {
			            $line1 = $row['line1'];
			            $line2 = $row['line2'];
			            $city = $row['city'];
			            $state = $row['state'];
			            $country = $row['country'];
			            $zipcode = $row['zip'];

			        }
				?>
				<div class="panel-body">
					<p>
					<?php echo $line1 ?><br>
					<?php echo $line2 ?><br>
					<?php echo $city.", ".$state ?><br>
					<?php echo $zipcode ?><br>
					<?php echo $country ?><br>
					</p>
				</div>
			<?php }else{ ?>
				<div class="panel-body">
					<p>
					No Address<br>
					Found<br>
					</p>
				</div>
			<?php } ?>

			</div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          
        </div>

       <table class="table table-bordered">
        <thead>
          <tr>
            <th><h4>Product</h4></th>
            <th><h4 class="text-right">Price</h4></th>
          </tr>
        </thead>
        <tbody>
        <?php 

			$query = "SELECT * FROM orders ";
			$query .= "JOIN order_items ";
			$query .= "ON orders.id = order_items.order_id ";
			$query .= "WHERE order_id = ".$the_order_id;
			$join_query = mysqli_query($connection,$query);
			$subTotal = 0;
	        while ( $product = mysqli_fetch_assoc($join_query)) {
	        	$aftersellId = $product['aftersell'];
	            $productName = $product['order_product_name'];
	            $productPrice = $product['order_product_price'];
	            $totalPrice = $product['total_price'];
	            $shipping = 6.94;     
				$salesTax = 0.12;
	            $subTotal += $productPrice;
        ?>
	          <tr>
	            <td><?php echo $productName ?></td>
	         	<td class="text-right">$<?php echo $productPrice ?></td>
	          </tr>
	          <?php } ?>
	        </tbody>
  		</table>
		<?php if($aftersellId != "6"){ ?>
	  		<table class="table table-bordered">
	        <thead>
	          <tr>
	            <th><h4>Aftersell Product</h4></th>
	            <th><h4 class="text-right">Price</h4></th>
	          </tr>
	        </thead>
	        <tbody>
	        <?php 

				$aftersell_query = "SELECT * FROM aftersell WHERE order_id = ".$the_order_id."";

				$select_aftersell_query = mysqli_query($connection,$aftersell_query);
		        while ( $product = mysqli_fetch_assoc($select_aftersell_query)) {

		            $aftersellName = $product['item_name'];
		            $aftersellPrice = $product['item_price'];

		            $aftersellSubTotal = $subTotal + $aftersellPrice;
	        ?>
	          <tr>
	            <td><?php echo $aftersellName ?></td>
	         	<td class="text-right">$<?php echo $aftersellPrice ?></td>
	          </tr>
          <?php } ?>
        </tbody>
      </table>
		<?php } ?>
      <div class="text-right">
		  <div class="col-xs-2 col-xs-offset-8">
		    <p>
		      <strong>
		        Sub Total : <br>
		        Sales Tax : <br>
		        Shipping : <br>
		        Total : <br>
		      </strong>
		    </p>
		  </div>
		  <div class="col-xs-2">
		    <strong>
		      $<?php if($aftersellId != "6"){echo $aftersellSubTotal;}else{echo $subTotal;} ?> <br>
		      $<?php echo $salesTax * $subTotal ?> <br>
		      $<?php echo $shipping ?> <br>
		      $<?php echo $totalPrice ?> <br>
		    </strong>
		  </div>
		</div>
		<div class="col-xs-5">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h4>Credit Card</h4>
			  </div>
			  <div class="panel-body">
			  	<?php
					$cc_query = "SELECT * FROM cc_info WHERE order_id = ".$the_order_id." && customer_id = ".$user_id."";
					$select_cc_query = mysqli_query($connection, $cc_query);
					$cc_count = mysqli_num_rows($select_cc_query);
					if ($cc_count > 0) {
					
					while ($row = mysqli_fetch_assoc($select_cc_query)) {
			            $ccNum = $row['cc_num'];
			            $ccExp = $row['cc_exp'];
			            $ccCvc = $row['cc_cvc'];

			        }
				?>

			    <p>CC Number : <?php echo $ccNum ?></p>
			    <p>CC Expiration : <?php echo $ccExp ?></p>
			    <p>CC CVC : <?php echo $ccCvc ?></p>
			    <?php }else{ echo "No CC Info Found";} ?>

			  </div>
			</div>
		</div>
		<div class="col-xs-7">
		</div>
    </div> <!-- /row -->
</div>
<?php }else {
	    header("Location: index.php");
	}?>