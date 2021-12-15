<?php
include "DB.php";

function afficherProduits()
{
    ?>

    <a href='ajouterProduit.php'>Ajouter un produit</a><br/>
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
        <tr style="font-weight: bold; text-align: center;">
            <td>Id</td>
            <td>Titre</td>
            <td>Prix</td>
        </tr>
        <tr>
            <td colspan='5'>
                <hr>
            </td>
        </tr>
        <?php
        foreach ($albums as $a) {
            ?>
        <tr>
            <td id='item'><a href='../detail.php?id=<?= $a->id ?>'><?= $a->id ?></a></td>
            <td><?= $a->TITRE ?></td>
            <td><?= $a->PRIX ?></td>
            <td>
                <button id='effacer' onclick='removeItem(<?= $a->id ?>)'>Effacer</button>
            </td>
        </tr>
        <tr>
            <td colspan='5'><hr></td>
        </tr>
    <?php
        }
        echo "</table>";
    }
}