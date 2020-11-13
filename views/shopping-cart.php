<?php

$totalPrice = 0;
$shippingCost = 0;
if (!empty($_GET)) {
  $shippingCost = $_GET['shipping'];
}

?>
<div class="row">

  <div class="col-sm-2">

  </div>
  <div class="col-sm-8">
    <h3 class="text-center ">Shopping Cart</h3>
    <hr>
    <table class="table table-hover mt-5">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <body>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th><button class="btn btn-close"></button></th>
        </tr>
      </body>
    </table>
    <li><a class="dropdown-item" href="shopping-cart?shipping=0">Pickup (0 USD)</a></li>
    <li><a class="dropdown-item" href="shopping-cart?shipping=5">UPS (5 USD)</a></li>
    <h4 class="text-md-right">Shipping Cost: $<?php echo $shippingCost; ?></h4>
    <h4 class="text-md-right">Total: $<?php echo $totalPrice; ?></h4>
    <hr>
    <button class="btn btn-lg btn-dark" type="submit" value="Checkout">Checkout</button>
  </div>
  <div class="col-sm-2">
  </div>
</div>