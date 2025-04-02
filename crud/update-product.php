<?php
include("../navbar.php");
include("../db.php");

$fetch_price = "SELECT * FROM price";
$price_list = mysqli_query($conn,$fetch_price);

$productId = $_GET["product_id"];
$fetch_product = "SELECT * FROM product WHERE product_id = $productId";

$result = $conn->query($fetch_product);
if($result->num_rows > 0){
    $product = $result->fetch_assoc();
}


?>
<h1>Add Products</h1>
<div class="d-flex justify-content-center align-items-center mt-3">
    <div class="w-25 card shadow p-4">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?php echo $product['product_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Business description</label>
                <textarea name="desc" id="desc" class="form-control"><?php echo $product['product_desc']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Select Pricing category</label>
                <select name="price_id" id="price_id" class="form-control">
                    <option value="">Select Price</option>
                    <?php
                    while ($price_row = mysqli_fetch_assoc($price_list)) {
                        $selected = ($price_row['price_id'] == $product['price_id'])?"selected":"";
                        echo "<option value='" . $price_row['price_id'] . "' $selected>" . $price_row['price_cat'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" />
        </form>
    </div>
</div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $productname = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $productdesc = filter_input(INPUT_POST,"desc",FILTER_SANITIZE_SPECIAL_CHARS);
    $price = $_POST["price_id"];
    $b_id = $_SESSION["b_id"];

    $update_query = "UPDATE product SET product_name = ?, product_desc = ?,price_id=? WHERE product_id = $productId ";

    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $productname, $productdesc, $price);
        if (mysqli_stmt_execute($stmt)) {
            echo "Product Updated";
            header("Location: /healthify/business/dashboard.php");
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }


}
?>