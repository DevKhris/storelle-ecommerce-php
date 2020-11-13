<?php

namespace App\Views;

use App\Products\Product;
use App\Reviews\Reviews;
use App\Cart\ShoppingCart;

$id = $_GET['id'];

$product = Product::get($id);
$productRating = Reviews::getAverage($id);
$productName = $product['product_name'];
$productPrice = $product['product_price'];
$imgPath = $product['product_img'];

?>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
        <img class="img-fluid" src="<?php echo $imgPath; ?>" alt="<?php echo $imgPath; ?>" width=512 height=512>
    </div>
    <div class="col-sm-6">

        <h1 class="text-monospace"><?php echo $productName; ?></h1>
        <h3 class="text-muted">$<?php echo $productPrice; ?></h3>
        <p><?php echo \floor($productRating['t_rating']); ?> of 5 </p>
        <form class="form-group" method="POST" action="">
            <label for="productQuantity">Qty</label>
            <input class="form-control form-control-sm" min=1 value="1" type="number" name="productQuantity" id="">
            <button type="submit" value="" name="addBtn" class="btn btn-product btn-block mt-5">Add to cart <i class="fa fa-shopping-cart"></i></button>
        </form>
        <br>
        <?php require_once 'views/reviews.php'; ?>
    </div>


    <div class="col-sm-2">
    </div>
</div>