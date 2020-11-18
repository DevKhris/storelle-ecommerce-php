<?php

use App\Cart\ShoppingCart;
?>
<div class="row">

  <div class="col-sm-2">

  </div>
  <div class="col-sm-8">
    <h3 class="text-center ">Shopping Cart</h3>
    <hr>
    <div class="alerts">

    </div>
    <table class="table table-hover mt-5 text-center">
      <thead c>
        <tr class="table-dark">
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>

      <tbody id="cart">
      </tbody>
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
    <div class="mt-3" id="pricing">

    </div>

    <hr>
    <a class="btn btn-primary" id="backBtn" href="/">Back</a>
    <button class="btn btn-dark" type="submit" id="checkout">Checkout</button>
  </div>
  <div class="col-sm-2">
  </div>
</div>