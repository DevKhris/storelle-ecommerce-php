<?php

use App\Core\User;

if(!empty($_SESSION['balance'])){
  $balance = User::getBalance($_SESSION['name']);
  $_SESSION['balance'] = $balance;
}

?>
<nav class="navbar navbar-expand-sm navbar-dark bg-black text-light">
  <ul class="navbar-nav mr-auto pl-3 mb-2 mb-lg-0" aria-labelledby="UserMenuButton">
    <li class="nav-item">
      <p class="nav-text text-muted pt-4">Welcome back
      </p>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto pr-3 mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link" href="">
        <?php if (isset($_SESSION['balance'])) {

          echo 'Balance: ' . $_SESSION['balance'];
        }
        ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                                  echo '/profile';
                                } else {
                                  echo 'login';
                                }
                                ?>">
        <?php
        if (isset($_SESSION['name'])) {
          echo $_SESSION['name'];
        } else {
          echo 'Guest';
        }
        ?>
        <i class="fa fa-user"></i>
      </a>
    </li>
    <?php if (isset($_SESSION['name'])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/logout">
          <i class="fa fa-power-off"></i>
        </a>
      </li class="nav-item">
    <?php } ?>


  </ul>
</nav>
<nav class="navbar navbar-expand-sm navbar-light bg-faded">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle Navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <a class="navbar-brand" href="#">
        <img src="res/logo.png" alt="Storelle" class="d-inline-block align-top" width="128" height="64">
      </a>
      <ul class="navbar-nav mr-auto font-weight-bold">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopping-cart">Shopping Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto d-flex">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-shopping-cart text-dark"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDarkDropdownMenuLink">
            <li>
              <h6 class="dropdown-header text-muted">Shopping Cart</h6>
            </li>
            <li class="nav-item">
              <div class="card">
                <a class="dropdown-item align-self-center" href="#">
                  <img class="img-thumbnail" src="res/products/apple.jpg" alt="">
                  <p class="font-weight-light"></p>
                  <p class="text-muted"></p>
                </a>
                <button class="btn btn-remove btn-outline-danger btn-block text-center"></button>
              </div>
            </li>
            <br>
            <button class="btn btn-primary btn-block" href="">Checkout</button>
          </ul>
    </div>
    </ul>
    </li>
    </ul>
  </div>
  </div>
</nav>