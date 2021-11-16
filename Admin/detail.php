<?php
session_start();
include 'authorized.php';
include_once "Database/DB.php";

if (!isset($_GET["id"]) || !existAlbum($_GET["id"])) {
    header("HTTP/1.1 404 Not found");
    exit;
}
$album = getAlbumById($_GET["id"]);


//$nom = $album["titre"];
$shortName = substr($album->titre, 0, 25);
$shortName .= ((strlen($album->titre) != strlen($shortName)) ? ("...") : (""));
//$prep = $album["descriptif"];
//$prix = $album["prix"];
//$ingr = explode("|", $album["chansons"]);
$ingr = explode("|", $album->chansons);
$imgURL = (file_exists("img_cover/$album->titre.jpg") != false) ? ("img_cover/$album->titre.jpg") : ("images/tech.jpg");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include("imports.html"); ?>

    <title>Taupe Musique</title>

    <link href="../css/shop-homepage.css" rel="stylesheet">
</head>
<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="col-xs-5">
        <img style="width: 100%;" src="<?= '' . $album->PHOTO ?>"/>
    </div>
    <div class="col-xs-7">
        <h1><?= $album->titre ?></h1>
        <h3>Chansons</h3>
        <ul>
            <?php
            foreach ($ingr as $chanson)
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
