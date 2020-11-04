<?php

require_once 'vendor/autoload.php';

use App\Config;
$conn = \DbConnection::dbConnect();

session_start();

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Storelle</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
      <!-- Custom Styles -->
      <link rel="stylesheet" href="./assets/css/styles.min.css">
   </head>
   <body>
      <header>
         <?php
         require_once 'views/navbar.php';
         ?>
      </header>
      <main class="container-fluid">
         <?php
         $page = isset($_GET['p']) ? strtolower($_GET['p']) : "home";
         require_once __DIR__ . '\views\\' . $page . '.php';
         ?>
      </main>
      <footer class="container-fluid bg-black position-absolute">
         <div class="row text-light">
            <div class="col-sm-4">
               <img src="res/logo.png" alt="" class="img-fluid">
               <p class="text-center text-muted pb-5">&copy; <a class="text-decoration-none text-white" href="index.php">Storelle</a> 2020 | Developed by DevKhris</p>
            </div>
            <div class="col-sm-2 py-5">
               <ul class="nav nav-footer flex-column pt-4">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="?p=home">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="p?=products" >Products</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="?p=shopping-cart">Shopping Cart</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link disabled" href="?=about">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link disabled" href="?=contact">Contact</a>
                  </li>
               </ul>
            </div>
            <div class="col-sm-6">
               
            </div>
         </div>
         <!-- Popper -->
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
         <!-- Bootstrap -->
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
         <!-- Font Awesome -->
         <script src="https://kit.fontawesome.com/9599829622.js" crossorigin="anonymous"></script>
         <script src="assets/js/app.js" crossorigin="anonymous"></script>
      </footer>
   </body>
</html>