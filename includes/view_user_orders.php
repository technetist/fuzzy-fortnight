<?php 
if (isset($_SESSION['user_id'])): ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Total</th>
                <th>Order Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $query = "SELECT * FROM orders WHERE user_id = ".$_SESSION['user_id']." ORDER BY id DESC";
                $select_orders_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_orders_query)) {
                    $order_id = escape($row['id']);
                    $order_status = escape($row['status']);
                    $price = escape($row['total_price']);

                    if($order_status == 1) {
                        $order_status = "Unshipped";
                    }else{
                        $order_status = "Shipped";
                    }

                    echo "<tr>";
                    echo "<td>{$order_id}</td>";
                    echo "<td>$".$price."</td>";
                    echo "<td>{$order_status}</td>";

                    echo "<td><a href='user_orders.php?source=view_order&view_order={$order_id}'>View</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    
    <?php
        if (isset($_GET['change_to_shipped'])) {
            $the_order_id = escape($_GET['change_to_shipped']);

            $query = "UPDATE orders SET status = '0' WHERE id = {$the_order_id} ";
            $change_to_shipped_query = mysqli_query($connection, $query);
            header("Location: orders.php");
        }
        if (isset($_GET['change_to_unshipped'])) {
            $the_order_id = escape($_GET['change_to_unshipped']);

            $query = "UPDATE orders SET status = '1' WHERE id = {$the_order_id} ";
            $change_to_unshipped_query = mysqli_query($connection, $query);
            header("Location: orders.php");
        }
    ?> 
<?php else: ?>
    <?php header("Location: index.php") ?>
<?php endif ?>