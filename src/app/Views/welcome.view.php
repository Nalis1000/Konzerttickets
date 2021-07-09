<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Meine Seite</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <script src="public/js/jquery-3.6.0.min.js "></script>
    <script src="public/js/bootstrap-js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/bootstrap-css/bootstrap.css">
    <!--<link rel="stylesheet" href="public/css/app.css">-->
    <?php require 'app/Views/navbarHead.view.php'?>
</head>
<body>
    <?php require 'app/Views/navbarBody.view.php'?>
    <div class="container">
    
        <h1 class="welcome">Willkommen im 307-Framework!</h1>

        <p><?= e($hello) ?></p>

    </div>

    <script src="public/js/app.js"></script>
</body>
</html>
