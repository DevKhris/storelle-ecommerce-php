<div class="row" id="productDetails" onload="requestProduct()">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3" id="productImg">
        <a class="text-decoration-none" href="/<?= $product['img'] ?>" data-lightbox="product">
            <img class="img-thumbnail shadow-sm shadow-lg" src="/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"
                width=512 height=512>
            <p class="text-muted text-center">
                <?= $product['name'] ?>
            </p>
        </a>
    </div>
    <div class=" col-sm-6">
        <div id="alerts"></div>
        <div id="productInfo">
            <div>
                <h1 class="text-monospace mt-3" id="productName">
                    <?= $product['name'] ?>
                </h1>
                <h3 class="text-muted" id="productPrice">
                    <i class="fa fa-dollar"></i> <?= $product['price'] ?>
                </h3>
                <p class="reviews num" id="stars">
                    <?php for ($i = 0; $i < $product['rating']; $i++) { ?>
                    <i class="fa fa-star stars"></i>
                    <?php } ?>
                    <?php for ($i = 0; $i < 5 - $product['rating']; $i++) { ?>
                    <i class="fa fa-star stars-grey"></i>
                    <?php } ?>
                </p>
            </div>
        </div>
        <form class="form-group" method="POST" id="product-form">
            <label for="productQuantity">Qty</label>
            <input class="form-control form-control-sm" min=1 value="1" type="number" name="productQuantity"
                id="productQuantity">
            <button type="submit" name="product-add" class="btn btn-product btn-block mt-5">
                <i class="fa fa-shopping-cart"></i>
                Add to cart
            </button>
        </form>
        <br>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <h2>User Reviews</h2>
        <hr>
        <div id="reviews-box">
            <?= $this->render('reviews.show', compact('reviews')); ?>
        </div>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <?= $this->render('reviews.create', ['id' => $product['id']]); ?>
    </div>
</div>