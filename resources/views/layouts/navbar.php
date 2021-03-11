<nav class="navbar navbar-expand-sm navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/logo-min.png" alt="Storelle" class="d-inline-block align-top" width="132" height="72">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>" aria-current="page"
                        href="/">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>
                <div class="nav-item mt-2 d-sm-inline d-none">
                    <p class="text-warning"> | </p>
                </div>
                <li class="nav-item">
                    <p class="nav-text text-warning my-2">|</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/products' ? 'active' : '' ?>" href="/products">
                        <i class="fa fa-shopping-bag"></i>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <p class="nav-text text-warning my-2">|</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/about' ? 'active' : '' ?>" href="/about">
                        <i class="fa fa-info-circle"></i>
                        About Us
                    </a>
                </li>
                <div class="nav-item mt-2 d-sm-inline d-none">
                    <p class="text-warning"> | </p>
                </div>
                <li class="nav-item">
                    <p class="nav-text text-warning my-2">|</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/contact' ? 'active' : '' ?>" href="/contact">
                        <i class="fa fa-address-card"></i>
                        Contact
                    </a>
                </li>
            </ul>

            <div class="dropdown" id="topbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <?php if ($_SESSION['auth']) {?>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/shopping-cart' ? 'active' : '' ?>"
                            href="/shopping-cart">
                            <i class="fa fa-shopping-cart"></i>
                            Cart
                        </a>
                    </li>
                    <?php if (isset($_SESSION['auth'])) { ?>
                    <li class="nav-item dropdown-right">
                        <a class="nav-link  <?= $_SERVER['REQUEST_URI'] == '/dashboard' ? 'active' : '' ?> dropdown-toggle"
                            href="#" id="topbarNavDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <?php if (isset($_SESSION['username'])) {
                                    $data = [
                                        ucfirst($_SESSION['username']),
                                        "<i class='fa fa-dollar'></i>",
                                        $_SESSION['balance']
                                    ];
                                    echo $data[0] . ' (' . $data[1] . $data[2] . ')';
                                } else {
                                    echo 'Guest';
                                }
                                ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="topbarNavDropdown">
                            <li class="dropdown-item">
                                <a class="dropdown-item" href="<?= !$_SESSION['auth'] ? 'login' : 'dashboard' ?>">
                                    <?= !$_SESSION['auth'] ? 'Login' : 'Dashboard' ?>
                                </a>
                            </li>
                            <?php if ($_SESSION['auth']) { ?>
                            <div class="dropdown-divider"></div>
                            <li>
                                <form action="/logout" method="POST">
                                    <div class="form-group">
                                        <button class="dropdown-item border-0" type="submit">
                                            <i class="fa fa-power-off">
                                            </i>
                                            Logout
                                        </button>
                                    </div>
                                </form>
                            </li>
                            <?php } ?>
                        </ul>

                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>