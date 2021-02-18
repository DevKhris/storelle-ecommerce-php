<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ecommerce site build with PHP7">
    <title>Storelle</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="/css/styles.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Abel&family=Noto+Sans+SC:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <?= $this->render('layouts.navbar'); ?>

    </header>
    <main class="container-fluid">
        {{ display }}
    </main>
    <footer class="container-fluid sticky-bottom bg-black pb-5 py-5">
        <?= $this->render('layouts.footer'); ?>
    </footer>

    <!-- Jquery -->
    <script src="/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/js/bootstrap.bundle.min.js"></script>
    <!-- App -->
    <script src="/js/app.js"></script>
</body>

</html>