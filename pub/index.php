<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application();

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../views/header.php';
    ?>
</head>

<body>
    <header>
        <?php
        require_once '../views/navbar.php';
        ?>
    </header>
    <main class="container-fluid">
        <?php

        $app->router->get('/', 'home');

        $app->router->get('/products', 'products');

        $app->execute();

        ?>
    </main>
    <footer class="container-fluid bg-black position-absolute">
    <?php
        require_once '../views/footer.php';
    ?>
    </footer>
</body>

</html>