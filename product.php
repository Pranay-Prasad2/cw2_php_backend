<?php
session_start();
include('db.php');
include('navbar.php');

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
                    <h5 class="card-title"><?php echo $product_row['product_name'] ; ?></h5>
                    <p class="card-text"><?php echo $product_row['product_desc'] ; ?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    <button class="btn like-btn" data-product-id="<?php echo $product['id']; ?>">
                        <i class="heart-icon far fa-heart"></i>
                        <span class="like-count">0</span>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize an object to store the like status of products
    var likes = {};

    // Set the initial like count for each product
    $('.like-btn').each(function() {
        var productId = $(this).data('product-id');
        likes[productId] = { liked: false, count: 0 };
    });

    // Handle the like/unlike functionality
    $('.like-btn').click(function() {
        var productId = $(this).data('product-id');
        var button = $(this);
        var heartIcon = button.find('.heart-icon');
        var likeCount = button.find('.like-count');

        // Toggle like status in the `likes` object
        if (likes[productId].liked) {
            likes[productId].liked = false;
            likes[productId].count--;
        } else {
            likes[productId].liked = true;
            likes[productId].count++;
        }

        // Update the UI based on the new like status
        likeCount.text(likes[productId].count);
        if (likes[productId].liked) {
            heartIcon.removeClass('far fa-heart').addClass('fas fa-heart liked');
        } else {
            heartIcon.removeClass('fas fa-heart liked').addClass('far fa-heart');
        }
    });
});
</script>

<style>
.heart-icon {
    font-size: 20px;
    cursor: pointer;
    color: gray;
    transition: 0.3s;
}
.heart-icon.liked {
    color: red;
}
</style>