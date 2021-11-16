<?php
session_start();
include 'authorized.php';
include 'fonctions/Layout.php';
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

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/datepicker.min.css"/>
    <link rel="stylesheet" href="../css/datepicker3.min.css"/>
</head>

<body>
<?php include("includes/navbar.php"); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
            <?php afficherCadreCompte(); ?>
        </div>

        <div class="col-md-9">

            <div class="row carousel-holder">
                <?php afficherCommandes(); ?>
                <hr>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>

<!-- jQuery -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jq.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/moment.min.js"></script>


</body>

</html>
