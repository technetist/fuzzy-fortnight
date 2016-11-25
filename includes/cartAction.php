<?php
  
  session_start();
  include 'db.php';
  $itemCount = 0;

  if(isset($_SESSION['cart'])){
     
     $itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array());

  }

    if(!isset($_REQUEST['pid'])){
        
        $case = $_REQUEST['action'];
    }else{
 
    $pid = $_REQUEST['pid'];
    
    $pname = $_REQUEST['p'];

    $case = $_REQUEST['action'];
  }

    // Check if session varible is set or not
    
    if(!isset($_SESSION['cart'])){

        $_SESSION['cart'] = array();

        }

    switch($case):

    case 'add':

        // Now check if product is already stored in session variable

    if(in_array($pid, $_SESSION['cart'])){

       // redirect to product list and tell the user it was added to cart

    header('Location: ../index.php?id=' . $pid . '&p=' . $pname);

    }

    else{

        if(!preg_match('/^[0-9]{1,}$/i', $pid)){

            header('Location: ../index.php?id=' . $pid . '&p=' . $pname);

        }else{

             $_SESSION['cart'][$pid] = $pid;  

              // redirect to product list and tell user it was added to cart


            header('Location: ../index.php?id=' . $pid . '&p=' . $pname);

            }

        }
    break;

case 'remove':

    if(!preg_match('/^[0-9]{1,}$/i', $pid)){

        header('Location: ../index.php?id=' . $pid . '&p=' . $pname);

        }else{

             $_SESSION['cart'] = array_diff($_SESSION['cart'], array($pid));

               // redirect to product list and tell the user it was removed from cart

             header('Location: ../cart.php?id=' . $id . '&p=' . $pname);


                              }
break;

case 'placeOrder':
  if ($itemCount > 0 && !empty($_SESSION['user_id']))  {
    $query = "INSERT INTO orders (user_id, total_price, order_date) VALUES ('".$_SESSION['user_id']."', '".$_SESSION['totalPrice']."', now());";
    $insertOrder = mysqli_query($connection, $query);
    if($insertOrder){
          $orderID = $connection->insert_id;
          // get cart items
            $pids = "";
            foreach ($_SESSION['cart'] as $id) {

              $pids = $pids. $id.',';
              }
              $pids = rtrim($pids, ",");

              $r = "SELECT product_id, product_name, product_price, product_img FROM products WHERE product_id IN (".$pids.")";
            $query = mysqli_query($connection,$r);
            $row = mysqli_num_rows($query);
            if($row > 0){
                while ( $product = mysqli_fetch_assoc($query)) {
                    $productName = $product['product_name'];
                    $productPrice = $product['product_price'];
              
                echo $productName . "<br>";
            $sql = "INSERT INTO order_items (order_id, order_product_id, order_product_name, order_product_price) VALUES ('".$orderID."', '".$id."', '".$productName."', '".$productPrice."');";
            $insertOrderItems = $connection->multi_query($sql);
            } } 
            if($insertOrderItems){
                
                $cc_query = "INSERT INTO cc_info (order_id, customer_id, cc_num, cc_exp, cc_cvc) VALUES ('".$orderID."', '".$_SESSION['user_id']."', '".$_POST['cc-num']."', '".$_POST['cc-exp']."', '".$_POST['cc-cvc']."')";
                $insertCcInfo = $connection->multi_query($cc_query);
                
                if($insertCcInfo){

                  $address_query = "INSERT INTO addresses (order_id, user_id, line1, line2, city, state, country, zip) VALUES ('".$orderID."', '".$_SESSION['user_id']."', '".$_POST['address']."', '".$_POST['address2']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['country']."', '".$_POST['zipcode']."')";
                  $insertAddressInfo = $connection->multi_query($address_query);
                  
                  if($insertAddressInfo) {
                    unset($_SESSION['cart']);
                    header("Location: ../orderSuccess.php?id=$orderID");
                  }else{
                    print_r($address_query);
                    // header("Location: checkout.php");
                  }
                }else{
                  header("Location: checkout.php");
                }

            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }   
  }else {
    header("Location: index.php");
  }
  break;

endswitch;
?>
