<?php
session_start();
if (isset($_COOKIE["panier"]) && isset($_COOKIE["user"])) {
    $panier = json_decode($_COOKIE["panier"]);
    include("Fonctions.inc.php");
    include("Donnees.inc.php");
    include_once("Database/DB.php");

    $db = Database();
    $req = $db->prepare("replace into commande (ID_PROD,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values (:item,:login,:date,:civilite,:nom,:prenom,:adresse,:cp,:ville,:telephone);");
    $user = getUser($_COOKIE['user']);

    foreach ($panier as $item)
        $req->execute(array(
            ':item' => $item,
            ':login' => $user->login,
            ':date' => date('d/m/Y'),
            ':civilite' => $user->sexe,
            ':nom' => $user->nom,
            ':prenom' => $user->prenom,
            ':adresse' => $user->adresse,
            ':cp' => $user->codep,
            ':ville' => $user->ville,
            ':telephone' => $user->telephone
        ));

    setcookie("panier", "", time() - 3600, "/");

    $_SESSION["paiement"] = "opération réussie";
    $_SESSION["color"] = "green";

} else {
    $_SESSION["paiement"] = "donnees incorrectes <br/> Veuillez essayer de nouveau";
    $_SESSION["color"] = "red";
}

header('location: panier.php');

