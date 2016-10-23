<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "city_marks");
$result = $conn->query("SELECT product_name, product_price, product_desc, product_short_desc, product_img, product_gender, product_id, product_category FROM products");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name":"'  . $rs["product_name"] . '",';
    $outp .= '"price":"'   . $rs["product_price"]        . '",';
    $outp .= '"description":"'. $rs["product_desc"]     . '",';
    $outp .= '"shortDescription":"'   . $rs["product_short_desc"]        . '",';
    $outp .= '"image":"'. $rs["product_img"]     . '",'; 
    $outp .= '"gender":"'  . $rs["product_gender"] . '",';
    $outp .= '"id":"'   . $rs["product_id"]        . '",';
    $outp .= '"category":"'   . $rs["product_category"]        . '" }'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>