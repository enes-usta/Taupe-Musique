<?php
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

include_once 'Database/Database.php';

/**
 * Données d'un l'utilisateur {"LOGIN","EMAIL","NOM","PRENOM","DATE","TELEPHONE","ADRESSE","CODEP","VILLE","SEXE")
 * @return array|bool : La liste de tous les utilisateurs
 */
function getAllUsers(): array|bool
{
    $db = Database();
    $req = $db->prepare("SELECT login, email, nom, prenom, date, sexe, adresse, codep, ville, telephone FROM users;");
    $req->execute(array());
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getAdmins(): bool|array
{
    global $admins_list;
    $inQuery = implode(',', array_fill(0, count($admins_list), '?'));
    $db = Database();
    $req = $db->prepare("SELECT login, email, nom, prenom, date, sexe, adresse, codep, ville, telephone FROM users WHERE login IN (" .$inQuery .")");
    foreach ($admins_list as $k => $id)
        $req->bindValue(($k+1), $id);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
}