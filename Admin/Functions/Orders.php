<?php
include_once 'DB.php';
function afficherCommandes()
{
//		include("Parametres.php");
//		include("Fonctions.inc.php");
//		include("Donnees.inc.php");

//		$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
//		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");

    echo "<h2>Commandes</h2><br/>";
    $orders = getOrders();
//		$result = query($mysqli,'select id_com,id_client,(select prenom from users where users.login = commande.id_client limit 1) as prenom,(select nom from users where users.login = commande.id_client limit 1) as nom,id_prod,date,ADRESSE,cp,ville from commande');
/*    if (mysqli_num_rows($result) <= 0) {
        echo "Aucun enregistrement dans la base de données";
    } else {*/
        ?>
        <table>
        <tr><td width='50px'>ID</td><td width='80px'>Date</td><td width='80px'>Produit</td><td width='80px'>Client</td></tr>
        <tr><td colspan='5'><hr></td></tr>
        <?php
        foreach ($orders as $o) {
            ?>
            <tr>
                <td id='item'><?= $o->id_com ?></td>
                <td> <?= $o->date ?></td>
                <td><a href='detail.php?id=<?= $o->id_prod ?>'> <?= $o->id_prod ?><a></td>
                <td><a href='details.php?login=".$row["id_client"]."'><?= $o->nom . " " . $o->prenom ?></a></td>
            </tr>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>


            <?php
        }

        echo "</table>";
//    }
//		mysqli_close($mysqli);
}
