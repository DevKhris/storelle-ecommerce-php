<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 featured py-5">
        <div class="my-5">
            <img class="img-fluid" src="images/logo-min.png" alt="" width="128">
            <h1 class="display-1">Welcome to our Shop</h1>
            <p class="fs-4">Your favorite products at the distance of one click</p>
        </div>
    </div>
</div>
<?php if ($_SESSION['auth']) {?>
<section>
    <h2 class="h2 text-center my-5 pb-5">Recently Added Products</h2>
    <div class="row justify-content-md-center mt-5 mb-5" id="products" onload="requestProducts()">
    </div>
</section>
<?php } ?>