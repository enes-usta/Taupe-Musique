<?php
session_start();
include 'authorized.php';

include_once("Database/DB.php");
$user = getUser($_GET["login"]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Taupe Musique</title>

    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/datepicker.min.css"/>
    <link rel="stylesheet" href="../public/css/datepicker3.min.css"/>
    <style>
        td{
            padding: 2px 20px 2px 20px;
        }
    </style>
</head>


<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Les Informations de <?= $user->login ?></h2>
                <table>
                    <tr>
                        <th>
                            <hr>
                        </th>
                    </tr>
                    <tr>
                        <td>Login de l'utilisateur</td>
                        <td><?= $user->login ?></td>
                    </tr>

                    <tr>
                        <td>Mot de passe</td>
                        <td>********</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $user->email ?></td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><?= $user->nom ?></td>
                    </tr>

                    <tr>
                        <td>Prénom</td>
                        <td><?= $user->prenom ?></td>
                    </tr>
                    <tr>
                        <td>Date de Naissance</td>
                        <td><?= $user->date ?></td>
                    </tr>
                    <tr>
                        <td>Téléphone</td>
                        <td><?= $user->telephone ?></td>
                    </tr>

                    <tr>
                        <td>Adresse</td>
                        <td><?= $user->adresse ?></td>
                    </tr>
                    <tr>
                        <td>Ville</td>
                        <td><?= $user->ville ?></td>
                    </tr>
                    <tr>
                        <td>Code Postal</td>
                        <td><?= $user->codep ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Sexe</td>
                        <td><?= $user->sexe ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
</div>
</body>
</html>