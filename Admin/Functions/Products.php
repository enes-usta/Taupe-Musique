<?php
include "DB.php";

function afficherProduits()
{
    ?>

    <a href='ajouterProd.php'>Ajouter un produit</a><br/>
    <a href='ajouterRubrique.php'>Ajouter une rubrique</a><br/>
    <hr>
    <h2>Produits</h2><br/>

    <?php
    $albums = getAlbums();
    if ($albums == false)
        echo "Aucun enregistrement dans la base de données";
    else {
        ?>
        <table>
        <tr><td width='50px'>ID</td><td width='80px'>Titre</td><td width='80px'>Prix</td></tr>
        <tr><td colspan='3'><hr></td></tr>
        <?php
        foreach ($albums as $a) {
            ?>
        <tr>
            <td id='item'><a href='detail.php?prod=<?= $a->ID_PROD ?>'><?= $a->ID_PROD ?></a></td>
            <td><?= $a->TITRE ?></td>
            <td><?= $a->PRIX ?></td>
            <td><button id='effacer' onclick='removeItem(<?= $a->ID_PROD ?>)'>effacer</button></td>
        </tr>
        <tr>
            <td colspan='3'><hr></td>
        </tr>
    <?php
        }
        echo "</table>";
    }
}