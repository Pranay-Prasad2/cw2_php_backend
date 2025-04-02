<?php
include("../navbar.php");
include("../db.php");
echo "<h1>DashBoard</h1>";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'business') {
    header("Location: /healthify/index.php");
} else {
    echo $_SESSION['user'];
}
$b_id = $_SESSION["b_id"];
$fetch_products = "SELECT p.product_id, p.product_name, p.product_desc, pr.price_cat 
                   FROM product p 
                   JOIN price pr ON p.price_id = pr.price_id  
                   WHERE p.business_id = $b_id";

$products = mysqli_query($conn, $fetch_products);
?>
<br>

<div class="d-flex justify-content-center align-items-center mt-3">
    <div class="w-75 card shadow p-4">
        <?php echo '<a href="add-products.php" class="btn btn-secondary w-25" > Add product</a>'; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($product_row = mysqli_fetch_assoc($products)) { ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($product_row['product_id']); ?></th>
                        <td><?php echo htmlspecialchars($product_row["product_name"]); ?></td>
                        <td><?php echo htmlspecialchars($product_row["product_desc"]); ?></td>
                        <td><?php echo htmlspecialchars($product_row["price_cat"]); ?></td>
                        <td><a class="btn btn-primary" href="/healthify/crud/update-product.php?product_id=<?php echo $product_row['product_id']; ?>"> Update</a>
                        <a class="btn btn-danger" href="/healthify/crud/delete-product.php?product_id=<?php echo $product_row['product_id']; ?>"> Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>