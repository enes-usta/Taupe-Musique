<?php
session_start();
include_once 'Functions/indexFunctions.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include("includes/imports.html"); ?>

    <title>Taupe Musique</title>

    <!-- Bootstrap Core CSS -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/heart.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./public/css/shop-homepage.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="./public/css/datepicker.min.css"/>
    <link rel="stylesheet" href="./public/css/datepicker3.min.css"/>-->

    <script src="./public/js/jq.js"></script>
    <script src="./public/js/index.js"></script>

</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Sélectionnez un genre</p>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="favOnly"> N'afficher que vos albums favoris
                </label>
            </div>
            <div class="list-group">
                <?php
                echo displayRubriques(16,0);
                ?>
            </div>
        </div>

        <div class="col-md-9">
            <hr>
            <label for="search">Artist / Album </label><input id="search" onchange="requestAlbumList();" type="text"/>
            <hr>
            <div class="row" id="albumList">
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <h2>Pas de produits dans la base de données</h2>
                </div>
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
