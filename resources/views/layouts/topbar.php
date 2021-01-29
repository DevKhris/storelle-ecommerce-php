<div class="navbar navbar-expand-sm navbar-dark bg-black text-light">
    <div class="container-fluid">
        <ul class="navbar-nav mr-auto pl-3">
            <p class="nav-text text-white pt-3">Welcome,
                <?= array_key_exists('username', $_SESSION) ? ucfirst($_SESSION['username']) : 'Guest'; ?>
            </p>
        </ul>
        <div id="topbarNavDropdown">
            <ul class="navbar-nav ml-auto pr-3">
                <?php if ($_SESSION['auth']) { ?>
                <li class="nav-item">
                    
                    <a class="nav-link" href="dashboard">
                        Balance: $<?= $_SESSION['balance']; ?>
                    </a>
                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="topbarNavDropdown" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo ucfirst($_SESSION['username']);
                        } else {
                            echo 'Guest';
                        }
                        ?>
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="topbarNavDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= (!$_SESSION['auth']) ? 'login' : 'dashboard' ?>">
                                Dashboard
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li class="dropdown-item">
                            <form action="/logout" method="POST">
                                <div class="form-group">
                                    <input class="border-0" type="submit" value="Logout">
                                    <i class="fa fa-power-off">
                                    </i>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div> 
    </div>
</div>