<?php
include_once 'DB.php';
function afficherCommandes()
{
        ?>
        <h2>Commandes</h2><br/>
        <table>
            <tr>
                <td>ID</td>
                <td>Date</td>
                <td>Produit</td>
                <td>Client</td>
            </tr>
            <tr>
                <td colspan='5'><hr></td>
            </tr>
        <?php
        $orders = getOrders();
        foreach ($orders as $o) {
            ?>
            <tr>
                <td id='item'><?= $o->id_order ?></td>
                <td><?= $o->date ?></td>
                <td>
                    <a href="<?= parse_url('/', PHP_URL_PATH) .'detail.php?id=' .$o->id_produit ?>"> <?= getAlbumById($o->id_produit)->titre ?><a>
                </td>
                <td>
                    <a href='details.php?login=<?= $o->id_client ?>'><?= $o->id_client ?></a>
                </td>
            </tr>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            <?php
        }
        echo '</table>';
}
