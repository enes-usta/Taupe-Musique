<?php
session_start();
include 'authorized.php';

include 'Functions/Layout.php';
include 'Functions/AddProductLayout.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>TaupeMusique</title>

    <script type="application/javascript" src="/public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.min.css"/>
    <script type="application/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/jq.js"></script>

    <script>
        numChansons = (nb) => {
            let str = '';
            for (let i = 0; i < nb; i++)
                str += `<div class="form-group mb-3">
                          <input type="text" class="form-control" name="tracks[${i}]" placeholder="Chanson n°${i}" />
                        </div>`;
            document.getElementById('tracks').innerHTML = str;
        }
    </script>
</head>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row carousel">
        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
            <?php CompteLayout(); ?>
        </div>
        <div class="col-md-9">
            <div class="row carousel-holder">
                <?php ajouterProduitLayout(); ?>
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
