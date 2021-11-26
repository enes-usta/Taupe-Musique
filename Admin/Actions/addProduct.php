<?php
session_start();
include '../authorized.php';
include_once 'Database/DB.php';

$file_result = '';
$file_extension = '';
if ($_FILES['file']['error'] > 0) {
    header('location: ../Produits.php?Erreur=img');
    exit();
} else {

    // Check Image
    $file = $_FILES['file']['name'];
    if ((preg_match("/[.](jpg)$/i", $file)))
        $file_extension = '.jpg';
    else if (preg_match("/[.](jpeg)$/i", $file))
        $file_extension = '.jpeg';
    else if (preg_match("/[.](gif)$/i", $file))
        $file_extension = '.gif';
    else if (preg_match("/[.](png)$/i", $file))
        $file_extension = '.png';
    else if (preg_match("/[.](bmp)$/i", $file))
        $file_extension = '.bmp';
    else {
        header('location: ../Produits.php?Erreur=img2');
        exit();
    }

    // Nom Fichier
    $file_name = ($_POST["auteur"] . " (" . $_POST["titre"] . ")") . $file_extension;
    $file_result = 'img_cover/' . $file_name;
    move_uploaded_file($_FILES['file']['tmp_name'], '../../' . $file_result);

    if (isset($_POST["titre"]) && isset($_POST["auteur"]) && isset($_POST["prix"]) && isset($_POST["descriptif"])) {
        $ok = true;
        if (!preg_match('/^([A-Za-z]{0,80}$)/', $_POST["auteur"]))
            $ok = false;

        if (!preg_match('/^([A-Za-z]{0,80}$)/', $_POST["titre"]))
            $ok = false;

        if (!preg_match('/^([0-9]+$)/', $_POST["prix"]))
            $ok = false;

        $tracks = array();
        if (isset($_POST["nombre"]))
            for ($i = 0; $i <= $_POST["nombre"]; $i++)
                if (isset($_POST["track" . $i]))
                    $tracks[] = ($i + 1) . ' ' . $_POST["track" . $i];


        // Insert en fichier
        if ($ok) {
            $titre = $_POST['titre'];
            $chansons = implode("|", $tracks);
            $auteur = $_POST['auteur'];
            $descriptif = $_POST["descriptif"];
            $prix = $_POST["prix"];

            createAlbum($titre, $chansons, $auteur, $prix, $descriptif, $file_name);
        }
        else
            echo "Erreur1";
    } else
        echo "Erreur2";

}
