<?php

use JetBrains\PhpStorm\Pure;

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
 * Retourne le login de l'utilisateur connecté
 * Si celui-ci n'est pas connecté, retourne null
 * @return mixed
 */
#[Pure] function getLogin(): mixed
{
    return isLogged() ? $_SESSION['user'] : null;
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
 * Suppression du produit s'il y est déja sinon l'ajoute
 */
function updateFavoris($user, $produit): bool
{
    if (!existAlbum($produit)) return false;

    $db = Database::getInstance();

    $req = $db->prepare("select * from FAVS where id_prod = :produit AND LOGIN = :user;");
    $req->execute(array(":produit" => $produit, ":user" => $user));
    if ($req->rowCount() != 0)
        $update = $db->prepare("DELETE FROM favs where LOGIN = :user AND ID_PROD = :produit;");
    else
        $update = $db->prepare("INSERT INTO favs VALUES(:user, :produit);");

    $update->execute(array(":user" => $user, ":produit" => $produit));
    return true;

}

/**
 * Met à jour les favoris de l'utilisateur
 * Suppression du produit s'il y est déja sinon l'ajoute
 * A appeler si dans les cookies
 * @param $produit
 * @return false
 */
function updateFavorisCookies($produit): bool
{
    if (!existAlbum($produit)) return false;

    $favoris = getFavorisCookies();
    if (($key = array_search($produit, $favoris)) !== false)
        unset($favoris[$key]);
    else {
        $favoris[] = $produit;
        setFavorisCookies($favoris);
    }
    return true;

}

/**
 * @param $user
 * @return array Favoris de l'utilisateur
 */
function getFavoris($user = null): array
{
    if ($user == null)
        return [];
    $db = Database::getInstance();
    $req = $db->prepare("SELECT ID_PROD FROM FAVS WHERE LOGIN = :user");
    $req->execute(array(":user" => $user));
    return $req->fetchAll();
}

/**
 *
 * Retourne le panier de l'utilisateur stocké dans les cookies
 *
 * @return array
 */
function getFavorisCookies(): array
{
    if (isset($_COOKIE['favoris']))
        if (all(json_decode($_COOKIE['favoris']), 'is_int'))
            return json_decode($_COOKIE['favoris']);

    return array();
}

/**
 * @param array $favoris
 * @return void
 */
function setFavorisCookies(array $favoris)
{
    setcookie('favoris', json_encode($favoris));
}

/**
 * @param string $filter
 * @param $rubriques
 * @param bool $favOnly
 * @return mixed
 */
function getAlbumListFiltered(string $filter, $rubriques, bool $favOnly): mixed
{

    $arr = array(":titre" => '%' . $filter . '%');
    $db = Database::getInstance();
    $sql = 'SELECT p.id_prod as id, p.titre, p.chansons, p.prix, p.descriptif, p.photo';
    if (isLogged()){
        $sql .= ', EXISTS (SELECT * FROM `favs` WHERE favs.ID_PROD = p.ID_PROD AND favs.LOGIN = :user)';
        $arr[':user'] = getLogin();
    }
    else {
        $favorisList = getFavorisCookies();
        $i = 0;
        $in = '';
        foreach ($favorisList as $item) {
            $key = ":fav" . $i++;
            $in .= ($in ? "," : "") . $key;
            $arr[$key] = $item;
        }
        $sql .= ', EXISTS(SELECT * FROM produits WHERE ID_PROD IN ('.($in == '' ? 'NULL' : $in) .'))';
    }
    $sql .= ' as isFav FROM produits as p WHERE TITRE LIKE :titre';

    if (count($rubriques) > 0 && all($rubriques, 'is_numeric')){
        {
            $j = 0;
            $inj = '';
            foreach ($rubriques as $item) {
                $key = ":fav" . $j++;
                $inj .= ($inj ? "," : "") . $key;
                $arr[$key] = $item;
            }
            $sql .= ' AND p.id_prod IN (SELECT id_prod from appartient where id_rub IN (' .$inj .'))';
        }
    }

    $req = $db->prepare($sql);
    $req->execute($arr);
    return $req->fetchAll();
}

function getTopRubriques($rubList)
{
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
 * @param $id
 * @return mixed Object Produit (en params : titre, chansons, prix, descriptif)
 */
function getAlbumById($id): mixed
{
    if (!is_int($id)) return false;

    $db = Database::getInstance();
    $req = $db->prepare("SELECT titre, chansons, prix, descriptif, photo FROM produits WHERE ID_PROD = :id");
    $req->execute(array(":id" => $id));

    return $req->fetch(PDO::FETCH_OBJ);
}

function existAlbum($id): bool
{
    if (!is_int($id)) return false;

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
