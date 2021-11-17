<?php
session_start();
include 'authorized.php';

include 'fonctions/Layout.php';
include 'Functions/Products.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Taupe Musique</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/datepicker.min.css"/>
    <link rel="stylesheet" href="../css/datepicker3.min.css"/>
    <script>
        function removeItem(e) {
            $.ajax({
                type: 'POST',
                url: 'Actions/removeItem.php',
                data: {item: e},
                success: function (data) {
                    alert(data);
                },
            });
        }
    </script>
</head>
<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
            <?php afficherCadreCompte(); ?>
        </div>

        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Produits</h2>
                <?php afficherProduits(); ?>
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>

<!-- jQuery -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jq.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/moment.min.js"></script>
</body>
</html>
