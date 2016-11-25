<?php
    include "delete_modal.php";
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $productValueID) {
            $bulk_options = escape($_POST['bulk_options']);
            switch ($bulk_options) {
                case 'InStock':
                    $query = "UPDATE products SET status='1' WHERE product_id = {$productValueID} ";
                    $update_to_InStock_status = mysqli_query($connection, $query);
                    if (!$update_to_InStock_status) {
                        die(mysqli_error($connection));
                    }
                    break;
                case 'OutStock':
                    $query = "UPDATE products SET status='0' WHERE product_id={$productValueID} ";
                    $update_to_OutOfStock_status = mysqli_query($connection, $query);
                    if (!$update_to_OutOfStock_status) {
                        die(mysqli_error($connection));
                    }
                    break;
                    case 'Delete':
                    $query = "DELETE FROM products WHERE product_id={$productValueID} ";
                    $bulk_delete = mysqli_query($connection, $query);
                    break;
                    case 'Clone':
                    $query = "SELECT * FROM products WHERE product_id={$productValueID} ";
                    $bulk_clone = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($bulk_clone)){
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
                    $query = "INSERT INTO products(product_category, product_name, product_price, product_desc, product_short_desc, product_img, product_gender, status) ";
                    $query .= "VALUES('{$type}', '{$name}', '{$price}', '{$product_desc}', '{$short_desc}', '{$img}', '{$gender}','{$status}' ) ";   
                    $copy_query = mysqli_query($connection, $query);
                    if (!$copy_query) {
                         die("Query Failed" . mysqli_error($connection));
                     } 
                    break;
                    case 'Reset':
                    $query = "UPDATE posts SET post_views = 0 WHERE post_id={$postValueID} ";
                    $bulk_reset = mysqli_query($connection, $query);
                    if (!$bulk_reset) {
                        die(mysqli_error($connection));
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
?>

<form action="" method='post'>
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4 menuSpacing btnSpacing">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select An Option</option>
                <option value="InStock">In Stock</option>
                <option value="OutStock">Out of Stock</option>    
                <option value="Clone">Clone</option>
                <option value="Delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4 btnSpacing">
            <input type="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="products.php?source=add_product">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Type</th>
                <th>Short Description</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>

            <?php
                $query = "SELECT products.product_id, products.product_name, products.product_price, products.product_short_desc, products.product_img, products.product_gender, products.status, products.product_category ";
                $query .= "FROM products ";
                $query .= "ORDER BY products.product_id DESC ";
                $select_products_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_products_query)) {
                    $id = escape($row['product_id']);
                    $name = escape($row['product_name']);
                    $price = escape($row['product_price']);
                    $short_desc = escape($row['product_short_desc']);
                    $img = escape($row['product_img']);
                    $gender = escape($row['product_gender']);
                    $status = escape($row['status']);
                    $type = escape($row['product_category']);

                    if(empty($name)){
                       $post_author = 'No Name';
                    }
                    if(empty($img)){
                       $post_title = 'No Image';
                    }
                    if(empty($price)){
                       $post_image = 'No Price';
                    }
                    if(empty($$short_desc)){
                       $post_tags = 'No Description';
                    }
                    

                    echo "<tr>";
                    ?>
                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $id; ?>'></td>
                    <?php
                    echo "<td>{$id}</td>";
                    echo "<td><img src='../{$img}' alt='product image' width='150px'></td>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$gender}</td>";
                    echo "<td>{$type}</td>";
                    echo "<td>".stripslashes($short_desc)."</td>";
                    echo "<td>{$price}</td>";
                    echo "<td>{$status}</td>";
                    echo "<td><a href='products.php?source=edit_product&p_id={$id}'>Edit</a></td>";
                    echo "<td><a rel='$id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>

          
      </tbody> 
    </table>
<?php
    if (isset($_GET['delete'])) {
        $the_product_id = escape($_GET['delete']);

        $query = "DELETE FROM products WHERE product_id = {$the_product_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: products.php");
    }
?> 