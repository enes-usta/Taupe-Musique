<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Panier taupe musique">

    <title>Taupe Musique</title>
    <?php include("includes/imports.html"); ?>

    <script type="text/javascript" src="/public/js/cart.js"></script>
    <script type="text/javascript" src="/public/js/Panier.js"></script>
</head>

<body>
<?php include("includes/navbar.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
        </div>
        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Panier</h2>
                <div id="panier">
                </div>
            </div>
            <?= (isLogged() ? '<a class="btn btn-default" href="Payment.php">ACHETER</a>' : '<p>Veuillez vous identifier pour effectuer une commande </p>'); ?>
        </div>
    </div>
</div>

<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>
</body>

</html>
