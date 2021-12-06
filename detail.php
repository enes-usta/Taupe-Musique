<?php
session_start();
include_once "Database/DB.php";

$album = getAlbumById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Taupe Musique</title>

    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/shop-homepage.css" rel="stylesheet">


    <script type="text/javascript" src="public/js/cart.js"></script>

</head>
<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="col-xs-5">
        <img style="width: 100%;" src="<?= '/public/img_cover/' . $album->photo ?>"/>
    </div>
    <div class="col-xs-7">
        <h1><?= $album->titre ?></h1>
        <h3>Chansons</h3>
        <ul>
            <?php
            $res = explode('|', $album->chansons);
            foreach ($res as $chanson)
                echo "<li>" . $chanson . "</li>";
            ?>
        </ul>

        <h3>Critique</h3>
        <p><?= $album->descriptif ?></p>
        <hr>
        <h3><?= $album->prix ?> € </h3>
        <button class="btn btn-default">Ajouter au panier</button>
    </div>
</div>
<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>
</body>
</html>
