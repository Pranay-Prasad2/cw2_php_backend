<?php
session_start();
include('db.php');
include('navbar.php');

echo "<h1>Welcome to Home Page</h1><br>";
// if(isset($_SESSION['user'])) echo $_SESSION['user'];

$all_products = "SELECT p.product_name,p.product_desc,pr.price_cat FROM product p JOIN price pr ON p.price_id = pr.price_id";
$products = mysqli_query($conn, $all_products);
?>

<div class="container">
    <div class="d-grid gap-3" style="grid-template-columns: repeat(3, 1fr);">
        <?php while ($product_row = mysqli_fetch_assoc($products)) { ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="./assets/product.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>