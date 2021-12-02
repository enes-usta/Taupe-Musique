<?php
session_start();
include 'authorized.php';

include './Functions/AdminLayout.php';
include './Functions/Products.php';
include 'Functions/Layout.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Taupe Musique</title>

    <link href="../public/css/bootstrap.min.css" rel="stylesheet">

    <link href="../public/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/datepicker.min.css"/>
    <link rel="stylesheet" href="../public/css/datepicker3.min.css"/>

    <!-- jQuery -->
    <script src="../public/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../public/js/jq.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/daterangepicker.js"></script>
    <script type="text/javascript" src="../public/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../public/js/moment.min.js"></script>

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
            <?php CompteLayout(); ?>
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

</body>
</html>