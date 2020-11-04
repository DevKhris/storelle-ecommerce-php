<?php

namespace App\Views;


use App\Products\GetProducts;

$products = GetProducts::getProducts();

?>
<div class="row row-cols-sm-1 mt-5 mb-5">
    <h2 class="h2 text-center pb-5">Featured products</h2>
    <div class="col-sm-2">
    </div>
    <?php for ($i=0; $i < count($products); $i++) {?>
        <div class="col-sm-2">
            <a class="text-decoration-none" href="product?id=<?php echo $products[$i]['id']; ?>">
                <div class="card product text-center">
                    <img src="<?php echo $products[$i]['product_img'];?>" class="card-img-top" alt="<?php echo $products[$i]['product_img'];?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $products[$i]['product_name'];?></h5>
                        <p class="card-text"><? echo $products[$i]['product_price'];?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php }  ?>
</div>
<div class="col-sm-2">
</div>
</div>