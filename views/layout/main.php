<!DOCTYPE html>
<html lang="en">
<?php
require_once 'header.php';
?>

<body>
    <header>
        <?php
        require_once 'topbar.php';
        ?>
        <?php
        require_once 'navbar.php';
        ?>
    </header>
    <main class="container-fluid">
        {{ display }}
    </main>
    <?php
    require_once 'footer.php';
    ?>
</body>

</html>