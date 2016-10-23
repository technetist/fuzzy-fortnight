<?php
	include 'includes/header.php';
?>
<?php
$sql = "SELECT product_id, product_name, product_price, product_img FROM products WHERE product_id IN (".$pids.")";
                        $query = mysqli_query($conn,$sql);

                        ?>
                        <h1><?php=$product_img;?></h1>