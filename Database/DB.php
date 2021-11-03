<?php

include_once("Database/Parametres.php");
include_once("Database/Database.php");
include_once("Donnees.inc.php");


/**
 * @param $login
 * @return mixed : Données de l'utilisateur {"LOGIN","EMAIL","NOM","PRENOM","DATE","TELEPHONE","ADRESSE","CODEP","VILLE","SEXE")
 * @see administration.php Ligne 41
 */
function getUser($login): mixed
{
    $db = Database();
    $req = $db->prepare("SELECT login, email, pass, nom, prenom, date, sexe, adresse, codep, ville, telephone  FROM users WHERE LOGIN = :login;");
    $req->execute(array(":login" => $login));
    if($req->rowCount() > 0)
        return $req->fetch(PDO::FETCH_OBJ);
    else return null;
}

/**
 * Valide la commande pour chaque article du panier
 * @return bool La commande a été effectuée avec succès
 * @see confirmerCommande.php Ligne 6
 */
function validerCommande(): bool
{
    $panier = json_decode($_COOKIE["panier"]);

    $db = Database();
    $req = $db->prepare("REPLACE into commande (ID_PROD,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values (:item,:login,:date,:civilite,:nom,:prenom,:adresse,:cp,:ville,:telephone)");
    foreach ($panier as $item)
        $req->execute(array(
            ":item" => $item,
            ":login" => $_SESSION["login"],
            ":date" => date('d/m/Y'),
            ":civilite" => $_SESSION["CIVILITE"],
            ":nom" => $_SESSION["NOM"],
            ":prenom" => $_SESSION["NOM"],
            ":adresse" => $_SESSION["ADRESSE"],
            ":cp" => $_SESSION["CP"],
            ":ville" => $_SESSION["VILLE"],
            ":telephone" => $_SESSION["TELEPHONE"]
        ));
    return false;
}

/**
 * @param $user
 * @param $produit
 * Met à jour les favoris de l'utilisateur
 * Suppresion du produit s'il y est déja sinon l'ajoute
 */
function updateFavoris($user, $produit)
{
    $db = Database();

    $req = $db->prepare("select * from FAVS where id_prod = :produit;");
    $req->execute(array(":produit" => $produit));
    if ($req->rowCount() > 0)
        $update = $db->prepare("DELETE FROM FAVS where LOGIN = :user AND id_prod = :produit;");
    else
        $update = $db->prepare("INSERT INTO FAVS VALUES(:user, :produit);");

    $update->execute(array(":user" => $user, ":produit" => $produit));

}

/**
 * @param $user
 * @return array Favoris de l'utilisateur
 */
function getFavoris($user): array
{
    $db = Database();
    $req = $db->prepare("SELECT ID_PROD FROM FAVS WHERE LOGIN = :user");
    $req->execute(array(":user" => $user));

    return $req->fetchAll();
}


/**
 * @param $login
 * @return bool Si le login est déja utilisé
 */
function loginExist($login): bool
{
    $db = Database();
    $req = $db->prepare("SELECT LOGIN FROM USERS WHERE LOGIN = :login");
    $req->execute(array(":login" => $login));
    return ($req->rowCount() != 0);
}

/**
 * @param $email
 * @return bool Si l'email est déja utilisé
 */
function emailExist($email): bool
{
    $db = Database();
    $req = $db->prepare("SELECT EMAIL FROM USERS WHERE EMAIL = :email");
    $req->execute(array(":email" => $email));
    return ($req->rowCount() != 0);
}

function registerUser($login, $email, $pass, $nom, $prenom, $date, $sexe, $adresse, $codepostal, $ville, $telephone)
{
//    $str = "INSERT INTO USERS VALUES ('" . $login . "','" . $email . "','" . password_hash($pass, PASSWORD_DEFAULT) . "','" . $nom . "','" . $prenom . "','" . $date . "','" . $sexe . "','" . $adresse . "','" . $codepostal . "','" . $ville . "','" . $telephone . "');";
    $str = "INSERT INTO USERS VALUES (:login,:email,:pass,:nom,:prenom,:date,:sexe,:adresse,:codepostal,:ville,:telephone);";
    $db = Database();
    $req = $db->prepare($str);
    $req->execute(array(
        ":login" => $login,
        ":email" => $email,
        ":pass" => password_hash($pass, PASSWORD_DEFAULT),
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":date" => $date,
        ":sexe" => $sexe,
        ":adresse" => $adresse,
        ":codepostal" => $codepostal,
        ":ville" => $ville,
        ":telephone" => $telephone
    ));
}


/**
 * @param $login
 * @param $password
 * @return bool Validite des identifiants saisis
 */
function isValid($login, $password): bool
{
    $db = Database();
    $req = $db->prepare("SELECT LOGIN, PASS FROM USERS WHERE LOGIN = :login");
    $req->execute(array(":login" => $login));

    if ($req->rowCount() != 0) {
        $res = $req->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $res->PASS))
            return true;
    }
    return false;
}