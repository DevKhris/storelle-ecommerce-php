<?php
use App\Core\User;
$user = new User($_SESSION['username'],$_SESSION['balance']); 
?>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <h2 class="my-4">User Profile</h2>
        <div class="d-inline-flex">
            <img class="img-fluid rounded-circle" src="/images/user/default_male.png" alt="Profile Picture">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <p class="pl-4">
                        <i class="fa fa-user"></i>
                        Username:
                        <?= $user->username ?>
                    </p>
                </li>
                <li class="nav-item">
                    <p class="pl-4">
                        <i class="fa fa-money"></i>
                        Balance: <i class="fa fa-dollar"></i>
                        <?= $user->balance ?>
                    </p>
                </li>
            </ul>
        </div>
        <hr>
    </div>
    <div class="col-sm-2">
    </div>
</div>