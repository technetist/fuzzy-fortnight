<?php
	if (isset($_POST['create_product'])) {
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

		$query = "INSERT INTO products(product_category, product_name, product_price, product_desc, product_short_desc, product_img, product_gender, status) ";

		$query .= "VALUES('{$product_type}', '{$name}', '{$price}', '{$product_desc}', '{$product_short_desc}', 'img/clothes/".strtolower($gender)."/".strtolower($product_type)."/{$image}', '{$gender}','{$availability}' ) ";
		
		$create_post_query = mysqli_query($connection, $query);

		confirmQuery($create_post_query);

		$the_post_id = mysqli_insert_id($connection);

		echo "<p class='bg-success' style='padding: 10px'>Product Added. <a href='products.php'>Edit products</a>";

	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="name">Product Name</label>
		<input type="text" class="form-control" name="name">
	</div>

	<div class="form-group">
		<label for="name">Product Price</label>
		<input type="number" step="0.01" min="0" class="form-control" name="price">
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
                    echo "<option value='$cat_title'>{$cat_title}</option>";
                }
			?>

		</select>
	</div>
	
	<div class="form-group">
		<label for="availability">Availability</label>
		<select name="availability" id="availability">
            <option value="1">In Stock</option>
            <option value="0">Out of Stock</option>
        </select>
	</div>
	<div class="form-group">
		<label for="image">Product Image</label>
		<input type="file" name="image" id="image">
	</div>
	<div class="form-group">
		<label for="product_short_desc">Product Short Description</label>
		<input type="text" class="form-control" name="product_short_desc" id="product_short_desc"></input>
	</div>
	<div class="form-group">
		<label for="product_desc">Product Description</label>
		<textarea type="text" class="form-control" name="product_desc" id="product_desc" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_product" value="Add Product">
	</div>
</form>