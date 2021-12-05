<?php
include_once 'DB.php';
function afficherCommandes()
{

    echo "<h2>Commandes</h2><br/>";
    $orders = getOrders();
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
}
