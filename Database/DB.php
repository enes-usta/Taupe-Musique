<?php

include("Parametres.php");
include("Fonctions.inc.php");
include("Donnees.inc.php");

function Database()
{
    return new PDO($host, $user, $password);
}


/**
 * @param int $id : Id de l'utilisateur
 * @return array|null : Données de l'utilisateur {"LOGIN","EMAIL","NOM","PRENOM","DATE","TELEPHONE","ADRESSE","CODEP","VILLE","SEXE")
 * @see administration.php Ligne 41
 */
function getUser(int $id): ?array
{
    $db = Database();

    $req = $db->prepare("SELECT LOGIN,EMAIL,PASS,NOM,PRENOM,DATE,SEXE,ADRESSE,CODEP,VILLE,TELEPHONE FROM USERS WHERE LOGIN = :id");
    $req->execute(array(":id" => $id));
    return $req->fetch();

    /*
     * 	if(isset($_COOKIE["user"])){
              $mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
              mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
                    $result = query($mysqli,$str) or die("Impossible de se connecter");
                    $row = mysqli_fetch_assoc($result);
                    if(is_null($row["LOGIN"])){$login = "";}else{$login = $row["LOGIN"];}
                    if(is_null($row["EMAIL"])){$email = "";}else{$email = $row["EMAIL"];}
                    if(is_null($row["NOM"])){$nom = "";}else{$nom = $row["NOM"];}
                    if(is_null($row["PRENOM"])){$prenom = "";}else{$prenom = $row["PRENOM"];}
                    if(is_null($row["DATE"])){$date = "";}else{$date = $row["DATE"];}
                    if(is_null($row["TELEPHONE"])){$telephone = "";}else if((int)$row["TELEPHONE"] == 0){ $telephone = NULL;}else{$telephone = $row["TELEPHONE"];}
                    if(is_null($row["ADRESSE"])){$ADRESSEe = "";}else{$ADRESSEe = $row["ADRESSE"];}
                    if(is_null($row["CODEP"])){$codepostal = "";}else{$codepostal = $row["CODEP"];}
                    if(is_null($row["VILLE"])){$ville = "";}else{$ville = $row["VILLE"];}
                    if(is_null($row["SEXE"])){$sexe = "";}else{$sexe = $row["SEXE"];}
              mysqli_close($mysqli);
        }
     */
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
    /*				include("Parametres.php");
					include("Fonctions.inc.php");
					include("Donnees.inc.php");
    					$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
					mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");

					foreach($panier as $item){
						query($mysqli,"replace into commande (ID_PROD,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values ('".$item."','".$_SESSION["login"]."','".date('d/m/Y')."','".$_SESSION["CIVILITE"]."','".$_SESSION["NOM"]."','".$_SESSION["PRENOM"]."','".$_SESSION["ADRESSE"]."','".$_SESSION["CP"]."','".$_SESSION["VILLE"]."','".$_SESSION["TELEPHONE"]."')");
					}
					mysqli_close($mysqli);
    */
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


    $req = $db->prepare("select * from favs where id_prod = :produit;");
    $req->execute(array(":produit" => $produit));
    if ($req->rowCount() > 0)
        $update = $db->prepare("DELETE from favs where LOGIN = :user and id_prod = :produit;");
    else
        $update = $db->prepare("INSERT INTO FAVS VALUES(:user, :produit);");

    $update->execute(array(":user" => $user, ":produit" => $produit));

    /*
    $str = "INSERT INTO FAVS VALUES('".$user."','".$produit."')";
    $result = query($mysqli,$str0) or die("Impossible de ajouter produit<br>");
    if(mysqli_num_rows($result)>0){
        query($mysqli,'delete from favs where id_prod = '.$produit.' and LOGIN = \''.$_COOKIE["user"].'\'');
        echo 'delete set';
    }else{
        query($mysqli,$str);
    }

     */
}

/**
 * @param $user
 * @return array Favoris de l'utilisateur
 */
function getFavoris($user): array
{
    $db = Database();
    $req = $db->prepare("SELECT ID_PROD FROM favs WHERE LOGIN = :user");
    $req->execute(array(":user" => $user));

    return $req->fetchAll();

    /*
    $mysqliFav = mysqli_connect($host, $user, $pass) or die("Problème de création de la base :" . mysqli_error());
    mysqli_select_db($mysqliFav, $base) or die("Impossible de sélectionner la base : $base");

    $result = query($mysqliFav, "SELECT ID_PROD FROM favs WHERE LOGIN = '" . $_COOKIE["user"] . "'") or die("récupération des Albums favorites impossible");

    $favAlbums = array();
    while ($fav = mysqli_fetch_assoc($result)) {
        $favAlbums[] = $fav["ID_PROD"];
    }
    return $favAlbums;*/
}
