<?php
session_start();
include 'authorized.php';
include 'Functions/Layout.php';
include 'Functions/Orders.php';
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
                <?php afficherCommandes(); ?>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>

<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="../public/js/jq.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../public/js/bootstrap.min.js"></script>


</body>

</html>
