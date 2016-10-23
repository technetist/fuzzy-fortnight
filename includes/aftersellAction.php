<?php
session_start();
include 'db.php';

$case = $_REQUEST['choice'];
$orderID = $_REQUEST['id'];

$sql = "SELECT item_price, item_name FROM aftersell_items WHERE item_id IN (".$case.")";
$query = mysqli_query($connection,$sql);
while($row = mysqli_fetch_assoc($query)){
	$price = $row['item_price'];
	$name = $row['item_name'];
}

switch ($case) {
	case '0':
		header("Location: ../index.php");
	break;

	case '1':
		$sql = "INSERT INTO aftersell (order_id, item_id, item_name, item_price) VALUES ('".$orderID."', '".$case."', '".$name."', '".$price."')";
		$query = mysqli_query($connection,$sql);
		if($query){
			$update = "UPDATE orders SET total_price = total_price + ".$price.", aftersell = 1 WHERE id = ".$orderID."";
			$update_query = mysqli_query($connection,$update);
			if($update_query){
				header("Location: ../index.php");
			}
			
		} else {
			die("Query Failed" . mysqli_error($connection));

		}
	break;

	case '2':
		$sql = "INSERT INTO aftersell (order_id, item_id, item_name, item_price) VALUES ('".$orderID."', '".$case."', '".$name."', '".$price."')";
		$query = mysqli_query($connection,$sql);
		if($query){
			$update = "UPDATE orders SET total_price = total_price + ".$price.", aftersell = 2 WHERE id = ".$orderID."";
			$update_query = mysqli_query($connection,$update);
			if($update_query){
				header("Location: ../index.php");
			}
			
		} else {
			die("Query Failed" . mysqli_error($connection));

		}
	break;

	case '3':
		$sql = "INSERT INTO aftersell (order_id, item_id, item_name, item_price) VALUES ('".$orderID."', '".$case."', '".$name."', '".$price."')";
		$query = mysqli_query($connection,$sql);
		if($query){
			$update = "UPDATE orders SET total_price = total_price + ".$price.", aftersell = 3 WHERE id = ".$orderID."";
			$update_query = mysqli_query($connection,$update);
			if($update_query){
				header("Location: ../index.php");
			}
			
		} else {
			die("Query Failed" . mysqli_error($connection));

		}
	break;

	default:
		header("Location: ../index.php");
	break;
}
?>