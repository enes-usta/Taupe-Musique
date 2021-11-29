<?php
include_once("Database/Database.php");
/**
 * @param $login
 * @return mixed : Données de l'utilisateur {"LOGIN","EMAIL","NOM","PRENOM","DATE","TELEPHONE","ADRESSE","CODEP","VILLE","SEXE")
 * @see index.php Ligne 41
 */
function getUser($login): mixed
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT login, email, pass, nom, prenom, date, sexe, adresse, codep, ville, telephone  FROM users WHERE LOGIN = :login;", array(PDO::ATTR_PERSISTENT => true));
    $req->execute(array(":login" => $login));
    if ($req->rowCount() > 0)
        return $req->fetch(PDO::FETCH_OBJ);
    else return null;
}

/**
 * @return bool Si l'utilisateur actuel est connecté ou non
 */
function isLogged(): bool
{
    return isset($_SESSION['user']);
}

/**
 * @return bool Si l'utilisateur actuel est administrateur ou non
 */
function isAdmin(): bool
{
    global $admins_list;
    if (!isLogged())
        return false;
    return in_array(getUser($_SESSION['user'])->login, $admins_list);
}

/**
 * Valide la commande pour chaque article du panier
 * @return bool La commande a été effectuée avec succès
 * @see confirmerCommande.php Ligne 6
 */
function validerCommande(): bool
{
    $panier = json_decode($_COOKIE["panier"]);

    $db = Database::getInstance();
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
    $db = Database::getInstance();

    $req = $db->prepare("select * from FAVS where id_prod = :produit AND LOGIN = :user;");
    $req->execute(array(":produit" => $produit, ":user" => $user));
    if ($req->rowCount() != 0)
        $update = $db->prepare("DELETE FROM favs where LOGIN = :user AND ID_PROD = :produit;");
    else
        $update = $db->prepare("INSERT INTO favs VALUES(:user, :produit);");

    $update->execute(array(":user" => $user, ":produit" => $produit));

}

/**
 * @param $user
 * @return array Favoris de l'utilisateur
 */
function getFavoris($user): array
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT ID_PROD FROM FAVS WHERE LOGIN = :user");
    $req->execute(array(":user" => $user));

    return $req->fetchAll();
}

/**
 * @param $user
 * @param $rubFilter
 * @param $filter
 * @param $favsOnly
 * @return array
 */
function getAlbumListCustom($user, $rubFilter, string $filter, bool $favsOnly): array
{
    $db = Database::getInstance();
    $sql = "SELECT titre, chansons, prix, descriptif, photo FROM produits WHERE TITRE LIKE :titre" . ($favsOnly ? ' AND ID_PROD IN (SELECT * FROM favs WHERE LOGIN = :login' : '');
    $req = $db->prepare($sql);

    $arr = array(":titre" => '%'.$filter.'%');
    if ($favsOnly)
        $arr[':login'] = $user;

    $req->execute($arr);

    return $req->fetchAll();
}

function getTopRubriques($rubList){
//    $db = Database::getInstance();
//    $req = $db->prepare("SELECT LOGIN FROM USERS WHERE LOGIN = :login");
//    $req->execute(array(":login" => $login));
//    return ($req->rowCount() != 0);
}

/**
 * @param $login
 * @return bool Si le login est déja utilisé
 */
function loginExist($login): bool
{
    $db = Database::getInstance();
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
    $db = Database::getInstance();
    $req = $db->prepare("SELECT EMAIL FROM USERS WHERE EMAIL = :email");
    $req->execute(array(":email" => $email));
    return ($req->rowCount() != 0);
}

function registerUser($login, $email, $pass, $nom, $prenom, $date, $sexe, $adresse, $codepostal, $ville, $telephone)
{
    $str = "INSERT INTO USERS VALUES (:login,:email,:pass,:nom,:prenom,:date,:sexe,:adresse,:codepostal,:ville,:telephone);";
    $db = Database::getInstance();
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
    $db = Database::getInstance();
    $req = $db->prepare("SELECT LOGIN, PASS FROM USERS WHERE LOGIN = :login");
    $req->execute(array(":login" => $login));

    if ($req->rowCount() != 0) {
        $res = $req->fetch(PDO::FETCH_OBJ);
        return password_verify($password, $res->PASS);
    }
    return false;
}


/**
 * @param $id int du produit que l'on veut
 * @return mixed Object Produit (en params : titre, chansons, prix, descriptif)
 */
function getAlbumById($id): mixed
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT titre, chansons, prix, descriptif, photo FROM produits WHERE ID_PROD = :id");
    $req->execute(array(":id" => $id));

    return $req->fetch(PDO::FETCH_OBJ);
}

function existAlbum($id): bool
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT titre, chansons, prix, descriptif FROM produits WHERE ID_PROD = :id");
    $req->execute(array(":id" => $id));

    return $req->rowCount() > 0;
}

/**
 * @param $id
 * @return bool
 */
function removeAlbumById($id): bool
{
    if (existAlbum($id)) {
        $db = Database::getInstance();
        $req = $db->prepare("DELETE FROM produits WHERE ID_PROD = :id");
        $req->execute(array(":id" => $id));
        return true;
    } else
        return false;
}

/**
 * @param $titre
 * @param $chansons
 * @param $auteur
 * @param $prix
 * @param $descriptif
 */
function createAlbum($titre, $chansons, $auteur, $prix, $descriptif)
{
    $db = Database::getInstance();
    $req = $db->prepare("insert into produits (TITRE, CHANSONS, LIBELLE, PRIX, DESCRIPTIF, PHOTO) values (?, ?, ?, ?, ?, ?);");
    $req->execute(array($titre . ' ( ' . $auteur . ' )', $chansons, '', $prix, $descriptif));
}

function getAlbums(): bool|array
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT ID_PROD, TITRE, PRIX FROM produits;");
    $req->execute(array());
    return $req->fetchAll(PDO::FETCH_OBJ);
}
/*
function getAlbumsByTitleAndFilter($rubriques, $titre): mixed
{
    $db = Database::getInstance();

    $req = $db->prepare("SELECT titre, chansons, prix, descriptif, photo FROM produits WHERE TITRE LIKE %:titre%");
    $req->execute(array(":titre" => $titre));

    return $req->fetchAll(PDO::FETCH_OBJ);
}*/

function getSousRubriques($rub_id): bool|array
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT * FROM rubrique WHERE ID_RUB IN (SELECT ID_ENFANT FROM hierarchie WHERE ID_PARENT = ? )");
    $req->execute(array($rub_id));
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function existeSousRubriques($rub_id): bool
{
    $db = Database::getInstance();
    $req = $db->prepare("SELECT COUNT(*) as count FROM hierarchie WHERE ID_PARENT = ? AND NOT (ID_ENFANT = ?)");
    $req->execute(array($rub_id, $rub_id));
    return $req->fetch(PDO::FETCH_OBJ)->count != 0;

}
