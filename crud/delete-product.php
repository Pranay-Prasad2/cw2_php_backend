<?php
include("../db.php");
include("../navbar.php");

$product_id = $_GET['product_id'];
$delete_query = "DELETE FROM product WHERE product_id = $product_id";

$result = $conn->query($delete_query);
if($result == true){
    header("Location: /healthify/business/dashboard.php");
}
else{
    echo "Error:". $delete_query . "<br>". $conn->error;; 
}

?>