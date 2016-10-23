<?php session_start(); 
include 'includes/db.php';
$itemCount = 0; 
	if(isset($_SESSION['cart'])){
		$itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array()); 
	} ?>
<?php
	include 'includes/header.php';
?>
<?php
	include 'includes/nav.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        
                        <th class="text-center"> </th>
                        <th class="text-center">Price</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    
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


                        if($row == 0){

                             echo '<p class="msg">No products found in your cart.</p>';

                        }else{
                            $totalPrice = 0;
                            while ( $product = mysqli_fetch_assoc($query)) {

                                $productImg = $product['product_img'];
                                $productId = $product['product_id'];
                                $productName = $product['product_name'];
                                $productPrice = $product['product_price'];

                                $totalPrice += $productPrice;
                                
                            
                            
                        ?>
                    <tr>
                        <td class="col-sm-9 col-md-7">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo $productImg ?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $productName ?></a></h4>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        
                        
                        
                        
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $productPrice ?></strong></td>
                        <td class="col-sm-1 col-md-1">

                        <a href="includes/cartAction.php?action=remove&pid=<?php echo $productId ?>&p=<?php echo $productName ?>" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </a></td>
                    </tr>
                    <?php }   ?>

                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        
                        <td><h5>Subtotal</h5></td>

                        <td class="text-right">
                        <h5><strong>$<?php echo $totalPrice ?></strong></h5></td>
                    </tr>
                    <?php
                        $shipping = 6.94;
                    ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$<?php echo $shipping ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$<?php echo $finalPrice = $totalPrice + $shipping;

                        $_SESSION['totalPrice'] = $finalPrice;
                        ?></strong></h3></td>
                    </tr>
                    <?php  }?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button></td>
                        <td>
                        <a href="checkout.php"><button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php 
                if($itemCount == 0) {
                  echo "<h4 class='text-center'>Nothing is in your cart. <br><small>Come back after you have added something</small></h4>";
                }
            ?>
        </div>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>