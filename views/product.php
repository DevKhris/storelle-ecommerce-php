<?php

namespace App\Views;

use App\Products\Product;
use App\Cart\ShoppingCart;

$id = $_GET['id'];

$product = Product::get($id);
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
        <form method="POST" action="">
            <input type="submit" name="addBtn" value="1" class="btn btn-product btn-block mt-5">Add to cart <i class="fa fa-shopping-cart"></i></input>
        </form>
    </div>
    <div class="col-sm-2">
    </div>
</div>