<?php
session_start();
include 'authorized.php';

include 'Functions/Layout.php';
include 'Functions/AddRubriqueLayout.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>TaupeMusique</title>

    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/jq.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js"></script>

    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/shop-homepage.css" rel="stylesheet">

    <script>
        function numChansons() {
            let str = '';
            for (let i = 0; i < $("#nombre").val(); i++)
                str += '<tr><td>' + (i + 1) + '</td><td><input type="text" name="track' + i + '"/></td></tr>';

            $("#tracks").html(str);
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
                <?php ajouterRubriqueLayout(); ?>
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
