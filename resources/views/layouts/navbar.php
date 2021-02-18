<nav class="navbar navbar-expand-sm navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/logo-min.png" alt="Storelle" class="d-inline-block align-top" width="132" height="72">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products">
                        <i class="fa fa-shopping-bag"></i>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shopping-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Shopping Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">
                        <i class="fa fa-info-circle"></i>
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">
                        <i class="fa fa-address-card"></i>
                        Contact
                    </a>
                </li>
            </ul>

            <div class="ml-auto" id="topbarNavDropdown">
                <ul class="navbar-nav">
                    <?php if ($_SESSION['auth']) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard">
                            Balance:
                            <i class="fa fa-dollar"></i><?= $_SESSION['balance']; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="topbarNavDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <?php
                        if (isset($_SESSION['username'])) {
                            echo ucfirst($_SESSION['username']);
                        } else {
                            echo 'Guest';
                        }
                        ?>

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
</nav>