<?php
session_start();
include 'authorized.php';
include_once 'Functions/Layout.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Administration Taupe Musique">
    <meta name="author" content="">

    <title>Administration</title>

    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/shop-homepage.css" rel="stylesheet">

    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/jq.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</head>

<body>

<?php include 'includes/navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Administration</p>
            <?php CompteLayout(); ?>
        </div>
        <div class="col-md-9">
            <div class="row carousel-holder">
                <?php if (isAdmin()) {
                    ?>
                    <a href="produits.php"><h4>Gestion de produits</h4></a><br/>
                    <a href="utilisateurs.php"><h4>Gestion d'utilisateurs</h4></a><br/>
                    <a href="commandes.php">
                        <h4>Visualiser les commandes<h4>
                    </a>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr>
    <?php include('includes/footer.php') ?>

</div>

</body>

</html>
