<div class="row" id="productDetails" onload="requestProduct()">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3" id="productImg">
    </div>
    <div class="col-sm-6">
        <div id="alerts"></div>
        <div id="productInfo">
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
        </div>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <?= $this->render('reviews'); ?>
    </div>
</div>