<?php
/*
session_start();
include '../Admin/authorized.php';*/

include 'SearchProductLayout.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>TaupeMusique</title>

    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/datepicker.min.css"/>
    <link rel="stylesheet" href="../public/css/datepicker3.min.css"/>
    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/jq.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>

</head>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">aled</p>
            <?php EffectuerRecherche(); ?>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>
</body>
</html>