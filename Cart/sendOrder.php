<?php
session_start();
include('Auth/log_authorized.php');
include_once("Database/DB.php");
?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="5; url=../../" />
    <title>Taupe musique - Votre commande</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        h1.error {
            color: #b04b4b;
        }

        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        i.error {
            color: #bc6666;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>

</head>
<body>

<?php

if (isLogged())
    if (validerCommande(getLogin())){
        ?>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
            </div>
            <h1>Succès</h1>
            <p>Nous avons bien réceptionné votre commande;<br/>Celle-ci vous sera envoyée sous peu !<br/>Vous allez être redirigé d'ici 5 secondes</p>
        </div>
<?php
    }
    else
    {
        ?>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark error">🗴</i>
            </div>
            <h1 class="error">Erreur</h1>
            <p>Erreur lors de votre commande... <br> Veuillez réessayer ultérieurement<br/>Vous allez être redirigé d'ici 5 secondes</p>
        </div>
        <?php
    }

?>

</body>
</html>
