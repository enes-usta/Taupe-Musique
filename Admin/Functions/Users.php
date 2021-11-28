<?php
include 'DB.php';

function afficherUtilisateurs()
{
    ?>
    <hr>
    <table>
        <tr>
            <td><h2>Administrateurs</h2></td>
        </tr>
        <tr>
            <td>Login</td>
            <td>Prénom</td>
            <td>Nom</td>
        </tr>
        <?php
        $admins = getAdmins();
        foreach ($admins as $a) {
            ?>
            <tr>
                <td><?= $a->login . '</td><td>' . $a->prenom . '</td><td>' . $a->nom ?></td>
            </tr>
            <?php
        }
        ?>

    </table><br/><br/>
    <hr>
    <table>
        <tr>
            <td><h2>Clients</h2></td>
        </tr>
        <tr>
            <td>Login</td>
            <td>Prénom</td>
            <td>Nom</td>
        </tr>
        <?php
        $users = getAllUsers();
        foreach ($users as $u) {
            ?>
            <tr>
                <td><?= $u->login . '</td><td>' . $u->prenom . '</td><td>' . $u->nom ?></td>
                <td>
                    <a href='details.php?login=<?= $u->login ?>'> Détails </a>
                </td>
            </tr>
            <?php
        }
        ?></table>
    <?php
}
