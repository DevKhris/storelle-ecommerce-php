<?php

$totalPrice = 0;
$shippingCost = 0;
if (!empty($_GET)) {
  $shippingCost = $_GET['shipping'];
  $totalPrice += $shippingCost;
}

var_dump($_SESSION);

?>
<div class="row">

  <div class="col-sm-2">

  </div>
  <div class="col-sm-8">
    <h3 class="text-center ">Shopping Cart</h3>
    <hr>
    <table class="table table-hover mt-5 text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>

      <body>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th><button class="btn btn-outline-danger">X</button></th>
        </tr>
      </body>
    </table>
    <div class="dropdown text-md-right">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
        Shipping
      </button>
      <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="?shipping=0">Pickup (0 USD)</a></li>
        <li><a class="dropdown-item" href="?shipping=5">UPS (5 USD)</a></li>
      </ul>
    </div>
    <p class="text-md-right">Shipping Cost: $<?php echo $shippingCost; ?></p>
    <p class="text-md-right">Total: $<?php echo $totalPrice; ?></p>
    <hr>
    <button class="btn btn-dark" type="submit" value="Checkout">Checkout</button>
  </div>
  <div class="col-sm-2">
  </div>
</div>