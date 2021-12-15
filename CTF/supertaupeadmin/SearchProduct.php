<?php
session_start();
include 'Parametres.php';

$sent_user = $_POST["user"];
if ($sent_user != "") {
    global $host, $user, $password, $database;
    $mysqli = mysqli_connect($host, $user, $password, $database);// or die("Problème de création de la base :".mysqli_error());

    $req = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$sent_user'");
    if ($req != false) {
        $cpt = 0;
        echo '
        <table>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
            </tr>
        ';
        while ($data = mysqli_fetch_array($req)) {
            $cpt++;
            ?>
            <tr>
                <td align=center><?= $data['username'] ?></td>
                <td align=center><?= $data['password'] ?></td>
                <td align=center><?= $data['email'] ?></td>
            </tr>
            <?php
        }

        echo '</table>' . ($cpt == 0 ? 'Aucun résultat<br/>' : '<br/>');
    }
}

?>

<a href="RechercheBarre.php">
    <button type='button' value="retour">
</a>
