<?php
	if (isset($_GET['p_id'])) {
		$the_product_id = $_GET['p_id'];
	}
	$query = "SELECT * FROM products WHERE product_id = $the_product_id";
    $select_products_by_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_products_by_id)) {
        $id = escape($row['product_id']);
        $name = escape($row['product_name']);
        $price = escape($row['product_price']);
        $product_desc = escape($row['product_desc']);
        $short_desc = escape($row['product_short_desc']);
        $img = escape($row['product_img']);
        $gender = escape($row['product_gender']);
        $status = escape($row['status']);
        $type = escape($row['product_category']);
    }
    if (isset($_POST['edit_product'])) {
    	$name = escape($_POST['name']);
        $price = escape($_POST['price']);
        $gender = escape($_POST['gender']);
        $product_type = escape($_POST['product_type']);
        $availability = escape($_POST['availability']);
        $image = escape($_FILES['image']['name']);
        $image_temp = escape($_FILES['image']['tmp_name']);
        $product_desc = escape($_POST['product_desc']);
        $product_short_desc = escape($_POST['product_short_desc']);

        move_uploaded_file($image_temp, "../img/clothes/".strtolower($gender)."/".strtolower($product_type)."/$image");

    	if (empty($product_image)) {
    		$query = "SELECT * FROM products WHERE product_id = $the_product_id ";
    		$select_image = mysqli_query($connection, $query);
    		while($row = mysqli_fetch_array($select_image)) {
				$post_image = $row['product_img'];
			}
    	}

    	$query = "UPDATE products SET ";
    	$query .= "product_name = '{$name}', ";
    	$query .= "product_price = '{$price}', ";
    	$query .= "product_gender = '{$gender}', ";
    	$query .= "product_category = '{$product_type}', ";
    	$query .= "status = '{$availability}', ";
    	$query .= "product_desc = '{$product_desc}', ";
    	$query .= "product_short_desc= '{$product_short_desc}', ";
    	$query .= "product_img = 'img/clothes/".strtolower($gender)."/".strtolower($product_type)."/{$image}' ";
    	$query .= "WHERE product_id = {$the_product_id}";

    	$update_product = mysqli_query($connection, $query);

    	confirmQuery($update_product);

        echo "<p class='bg-success' style='padding: 10px'>Product Updated. <a href='products.php'>View Your Products</a>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Product Name</label>
        <input value="<?php echo $name; ?>" type="text" class="form-control" name="name">
    </div>

    <div class="form-group">
        <label for="name">Product Price</label>
        <input value="<?php echo $price; ?>" type="number" step="0.01" min="0" class="form-control" name="price">
    </div>

    <div class="form-group">
        <label for="gender">Product Gender</label>
        <select name="gender" id="gender">
            <option value="Male">Men's</option>
            <option value="Female">Women's</option>
        </select>
    </div>

    <div class="form-group">
        <label for="product_type">Product Type</label>
        <select name="product_type" id="product_type">
            <?php
                $query = "SELECT cat_title FROM categories";
                $select_categories = mysqli_query($connection, $query);

                confirmQuery($select_categories);

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_title = escape($row['cat_title']);
                    echo "<option ".(($type == $cat_title) ? "selected='selected'" : ""). " value='$cat_title'>{$cat_title}</option>";
                }
            ?>

        </select>
    </div>
    
    <div class="form-group">
        <label for="availability">Availability</label>
        <select name="availability" id="availability">
            <option value="1" <?php if($status=="1") echo 'selected="selected"'; ?> >In Stock</option>
            <option value="0" <?php if($status=="0") echo 'selected="selected"'; ?> >Out of Stock</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Product Image</label>
        <img src="../<?php echo $img; ?>" alt="Post Image" width="150">
        <input type="file" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="product_short_desc">Product Short Description</label>
        <input value="<?php echo stripslashes($short_desc); ?>" type="text" class="form-control" name="product_short_desc" id="product_short_desc"></input>
    </div>
    <div class="form-group">
        <label for="product_desc">Product Description</label>
        <textarea type="text" class="form-control" name="product_desc" id="product_desc" cols="30" rows="10"><?php echo stripslashes(str_replace('\r\n',PHP_EOL,$product_desc)); ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_product" value="Edit Product">
    </div>
</form>