<?php

use App\Core\User;

// checks if the user is logged
if (!empty($_SESSION['name'])) {
  // get balance from current user and passes to var
    $currentBalance = json_decode(User::getBalance($_SESSION['name']), true);
    $_SESSION['balance'] = ($currentBalance[0]['balance']);
}
?>
<nav class="navbar navbar-expand-md navbar-dark bg-black align-self-center text-light">
  <ul class="navbar-nav mr-auto pl-3">
    <li class="nav-item">
      <p class="nav-text text-white pt-3">Welcome back,
        <?= array_key_exists('name', $_SESSION) ? ucfirst($_SESSION['name']) : 'Guest'; ?>
      </p>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto pr-3">
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <?php if (isset($_SESSION['balance'])) {
            echo 'Balance: $' . $_SESSION['balance'];
        }
        ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-center" href="<?php
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
        <a class="nav-link text-center" href="/logout">
          <i class="fa fa-power-off"></i>
          Logout
        </a>
      </li class="nav-item">
    <?php } ?>
  </ul>
</nav>
