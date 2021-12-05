<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Panier taupe musique">
    <meta name="author" content="">

    <title>Taupe Musique</title>

    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/shop-homepage.css" rel="stylesheet">
    <script src="/public/js/jq.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js"></script>

    <script>
        function removePanier(e, p) {
            $.ajax({
                type: 'POST',
                url: 'fonctions/fonctionsRemove.php',
                data: {item: e, pos: p},
                success: function (data) {
                    alert(data);
                    location.reload();
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
        </div>
        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Panier</h2>
                <div class="panier">
                </div>
            </div>
            <div>
                <?php
                if (isLogged())
                    echo '<a class="btn btn-default" href="confirmerCommande.php">ACHETER</a>';
                else if (isset($_COOKIE["panier"]))
                    echo '<p>Connectez vous pour pouvoir acheter</p>';
                ?>
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
