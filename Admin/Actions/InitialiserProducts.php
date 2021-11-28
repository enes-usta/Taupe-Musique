<?php
header("HTTP/1.1 401 Unauthorized");
exit;
/*
include "Donnees.inc.php";
include "Database/Database.php";
global $Hierarchie;
$db = Database();


global $Albums;
$db = Database();
$req = $db->prepare("INSERT INTO produits VALUES (:id_prod, :libelle, :prix, :descriptif, :photo)");

foreach ($Albums as $index => $a)
    $req->execute(array(
        ":id_prod" => $index,
        ":libelle" => $a['chansons'],
        ":prix" => $a['prix'],
        ":descriptif" => $a["descriptif"]
    ));



global $Hierarchie;
$db = Database();
$req = $db->prepare("insert into rubrique (LIBELLE_RUB) values (?);");
foreach ($Hierarchie as $i => $r)
        $req->execute(array($i));


$reqRebInsert = $db->prepare("insert into rubrique (LIBELLE_RUB) values (?) ON DUPLICATE KEY UPDATE LIBELLE_RUB = LIBELLE_RUB;");
foreach ($Hierarchie as $i => $r)
{
    foreach ($r['sous-categorie'] as $scat) {
        $reqRebInsert->execute(array($scat));
    }

    foreach ($r['super-categorie'] as $supcat) {
        $reqRebInsert->execute(array($supcat));
    }
}

function getRubByLib($rub_lib): mixed
{
    $db = Database();
    $req = $db->prepare("SELECT ID_RUB from rubrique where LIBELLE_RUB = ?");
    $req->execute(array($rub_lib));
    return $req->fetch(PDO::FETCH_OBJ);
}

//INSERT INTO ma_table (champ1, champ2) VALUES (3,0) ON DUPLICATE KEY UPDATE champ2 = champ2
//$req = $db->prepare("insert into rubrique (LIBELLE_RUB) values (?);");
//$req = $db->prepare("insert into rubrique (LIBELLE_RUB) values(?) ON DUPLICATE KEY UPDATE LIBELLE_RUB = LIBELLE_RUB;");
$req = $db->prepare("insert into hierarchie (ID_PARENT, ID_ENFANT) values(?, ?) ON DUPLICATE KEY UPDATE ID_ENFANT = ID_ENFANT;");
foreach ($Hierarchie as $i => $r) {
    $index = getRubByLib($i)->ID_RUB;
    foreach ($r['sous-categorie'] as $scat) {
        $souscat = getRubByLib($scat);
        if ($souscat == false)
            echo $scat;
        if ($souscat != false && $index != null)
            $req->execute(array($index, $souscat->ID_RUB));
    }
    foreach ($r['super-categorie'] as $supcat) {
        $supercat = getRubByLib($supcat);
        if ($supercat == false)
            echo $supcat;
        if ($supercat != false && $index != null)
            $req->execute(array($supercat->ID_RUB, $index));
    }
}
*/