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
</head>


<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Les Informations de <?= $user->login ?></h2>
                <table width='30%'>
                    <tr>
                        <th>
                            <hr>
                        </th>
                    </tr>
                    <tr>
                        <td><p><strong>Login d'utilisateur</strong></p></td>
                        <td><?= $user->login ?></td>
                    </tr>

                    <tr>
                        <td><p><strong>Mot de Pass<strong></p></td>
                        <td>********</td>
                    </tr>
                    <tr>
                        <td><p><strong>Email</strong></p></td>
                        <td><?= $user->email ?></td>
                    </tr>
                    <tr>
                        <td><p><strong>Nom</strong></p></td>
                        <td><?= $user->nom ?></td>
                    </tr>

                    <tr>
                        <td><p><strong>Prénom</strong></p></td>
                        <td><?= $user->prenom ?></td>
                    </tr>
                    <tr>
                        <td><p><strong>Date de Naissance</strong></p></td>
                        <td><?= $user->date ?></td>
                    </tr>
                    <tr>
                        <td><p><strong>Telephone</strong></p></td>
                        <td><?= $user->telephone ?></td>
                    </tr>

                    <tr>
                        <td><p><strong>ADRESSEe</strong></p></td>
                        <td><?= $user->adresse ?></td>
                    </tr>
                    <tr>
                        <td><p><strong>Ville</strong></p></td>
                        <td><?= $user->ville ?></td>
                    </tr>
                    <tr>
                        <td><p><strong>Code Postal</strong></p></td>
                        <td><?= $user->codep ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td><p><strong>Sexe</strong></p></td>
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