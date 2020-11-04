<?php

namespace App\Views;

use App\Products\Product;
$id = $_GET['id'];

$product = Product::get($id);
$imgPath = $product['product_img'];

?>
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2">
<img class="img-thumbnail" src="<?php echo $imgPath; ?>" alt="<?php echo $imgPath; ?>">
</div>
<div class="col-sm-6">

<h1><?php echo $product['product_name']; ?></h1>
<p><?php echo $product['product_price'];?>$</p>
<a href="" class="btn btn-product btn-block">Add to cart <i class="fa fa-shopping-cart"></i></a>
</div>
<div class="col-sm-2">
</div>
</div>
