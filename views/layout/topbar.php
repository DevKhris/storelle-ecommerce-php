<?php

use App\Core\User;

// checks if the user is logged
if (!empty($_SESSION['name'])) {
  // get balance from current user and passes to var
    $currentBalance = json_decode(User::getBalance($_SESSION['name']), true);
    $_SESSION['balance'] = ($currentBalance[0]['balance']);
}
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-black text-light">
  <ul class="navbar-nav mr-auto pl-3" aria-labelledby="UserMenuButton">
    <li class="nav-item">
      <p class="nav-text text-white pt-4">Welcome back,
        <?= ucfirst($_SESSION['name']) ?>
      </p>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto pr-3 mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link" href="">
        <?php if (isset($_SESSION['balance'])) {
            echo 'Balance: $' . $_SESSION['balance'];
        }
        ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            echo 'dashboard';
        } else {
            echo 'login';
        }
        ?>">
        <?php
        if (isset($_SESSION['name'])) {
            echo ucfirst($_SESSION['name']);
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
