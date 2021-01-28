<?php
use App\Core\User;

// checks if the user is logged
if (!empty($_SESSION['name'])) {
// get balance from current user and passes to var
    $currentBalance = json_decode(User::getBalance($_SESSION['username']), true);
    $_SESSION['balance'] = ($currentBalance[0]['balance']);
}
?>
<nav class="navbar navbar-expand-md navbar-dark bg-black align-self-center text-light">
    <ul class="navbar-nav mr-auto pl-3">
        <li class="nav-item">
            <p class="nav-text text-white pt-3">Welcome back,
                <?= array_key_exists('username', $_SESSION) ? ucfirst($_SESSION['username']) : 'Guest'; ?>
            </p>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto pr-3">
        <li class="nav-item">
            <?php if ($_SESSION['auth']) { ?>
            <a class="nav-link" href="dashboard">
                Balance: $<?= $_SESSION['balance']; ?>
            </a>
            <?php } ?>
        </li>
        <li class="nav-item">
            <a class="nav-link text-center"
                href="<?= (!$_SESSION['auth']) ? 'login' : 'dashboard' ?>">
                <?php
                if (isset($_SESSION['username'])) {
                    echo ucfirst($_SESSION['username']);
                } else {
                    echo 'Guest';
                }
                ?>
                <i class="fa fa-user"></i>
            </a>
        </li>
        <?php if ($_SESSION['auth']) { ?>
        <li class="nav-item">
            <form action="/logout" method="POST">
                <i class="fa fa-power-off">
                <input class="bg-dark nav-link form-control border-0" type="submit" value="Logout">
                </i>
            </form>
        </li class="nav-item">
        <?php } ?>
    </ul>
</nav>