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

    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/css/shop-homepage.css" rel="stylesheet" type="text/css">

    <script src="./public/js/cart.js"></script>
    <script src="./public/js/index.js"></script>
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/jq.js"></script>

</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div id="NotifyResult" class="w-100" style="text-align: center">
        </div>
        <div class="col-md-3">
            <p class="lead">Sélectionnez un genre</p>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="favOnly"> N'afficher que vos albums favoris
                </label>
            </div>
            <div class="list-group">
                <?= displayRubriques(16,0); ?>
            </div>
        </div>

        <div class="col-md-9">
            <hr>
            <label for="search">Artist / Album </label><input id="search" onchange="requestAlbumList();" type="text"/>
            <hr>
            <div class="row" id="albumList">
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

