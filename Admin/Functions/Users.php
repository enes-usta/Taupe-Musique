<?php
include 'DB.php';

function afficherUtilisateurs()
{
    ?>
    <hr>
    <table>
        <tr>
            <td colspan="3"><h2>Administrateurs</h2></td>
        </tr>
        <tr style="font-weight: bold">
            <td>Login</td>
            <td>Prénom</td>
            <td>Nom</td>
        </tr>
        <?php
        $admins = getAdmins();
        foreach ($admins as $a)
            echo "
        <tr>
            <td>$a->login</td>
            <td>$a->prenom</td>
            <td>$a->nom</td>
        </tr>";
        ?>
    </table>

    <br/>
    <hr>

    <table>
        <tr>
            <td colspan="4"><h2>Clients</h2></td>
        </tr>
        <tr style="font-weight: bold">
            <td>Login</td>
            <td>Prénom</td>
            <td>Nom</td>
        </tr>
    <?php
    $users = getAllUsers();
    foreach ($users as $u)
        echo "
            <tr>
                <td>$u->login</td><td>$u->prenom</td><td>$u->nom</td>
                <td>
                    <a href='details.php?login=$u->login'>Détails</a>
                </td>
            </tr>";
    echo "</table>";
}
