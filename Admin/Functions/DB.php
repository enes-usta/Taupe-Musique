<?php

include_once 'Database/Database.php';

/**
 * Données d'un l'utilisateur {"LOGIN","EMAIL","NOM","PRENOM","DATE","TELEPHONE","ADRESSE","CODEP","VILLE","SEXE")
 * @return array|bool : La liste de tous les utilisateurs
 */
function getAllUsers(): array|bool
{
    $db = Database();
    $req = $db->prepare("SELECT login, email, nom, prenom, date, sexe, adresse, codep, ville, telephone FROM users;");
    $req->execute(array());
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getAdmins(): bool|array
{
    global $admins_list;
    $inQuery = implode(',', array_fill(0, count($admins_list), '?'));
    $db = Database();
    $req = $db->prepare("SELECT login, email, nom, prenom, date, sexe, adresse, codep, ville, telephone FROM users WHERE login IN (" .$inQuery .")");
    foreach ($admins_list as $k => $id)
        $req->bindValue(($k+1), $id);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getRubByLib($rub_lib): mixed
{
    $db = Database();
    $req = $db->prepare("SELECT ID_RUB from rubrique where LIBELLE_RUB = ?");
    $req->execute(array($rub_lib));
    return $req->fetch(PDO::FETCH_OBJ);
}

function getMainRubriques(): bool|array
{
    $db = Database();
    $req = $db->prepare("SELECT LIBELLE_RUB FROM rubrique WHERE ID_RUB IN (SELECT ID_ENFANT FROM hierarchie WHERE ID_PARENT = ?);");
    $req->execute(array(getRubByLib('Indice')->ID_RUB));
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getAlbums(): bool|array
{
    $db = Database();
    $req = $db->prepare("SELECT ID_PROD, TITRE, PRIX FROM produits;");
    $req->execute(array());
    return $req->fetchAll(PDO::FETCH_OBJ);
}