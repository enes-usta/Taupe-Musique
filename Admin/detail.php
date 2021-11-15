<?php
session_start();
include 'authorized.php';
include("API.php");


if(!isset($_GET["id"]))
	header("location: ./");

$albumId = $_GET["id"];
$album = getAlbumById($albumId);

if($album == -1)
    header("Location: index.php");


$nom = $album["titre"];
$shortName = substr($nom, 0, 25);
$shortName .= ((strlen($nom) != strlen($shortName)) ? ("...") : (""));
$prep = $album["descriptif"];
$prix = $album["prix"];
$ingr = explode("|", $album["chansons"]);
$imgURL = (file_exists("img_cover/$nom.jpg") != false) ? ("img_cover/$nom.jpg") : ("images/tech.jpg");

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
	<?php include("includes/navbar.php");?>

	<div class="container">
		<div class="col-xs-5">
            <img style="width: 100%;" src="<?=$imgURL?>"/>
		</div>
		<div class="col-xs-7">
			<h1><?=$nom?></h1>
			<h3>Chansons</h3>
			<ul>
				<?php
				foreach ($ingr as $chanson)
					echo "<li>".$chanson."</li>";
				?>
			</ul>

			<h3>Critique</h3>
			<p><?=$prep?></p>
			<hr>
			<h3><?=$prix?> €  </h3><button class="btn btn-default">Ajouter au panier</button>
		</div>
	</div>
</div>
<div class="container">
	<hr>
	<?php include("includes/footer.php");?>
</body>

</html>
