<?php
session_start();
include 'Parametres.php';

$user = $_POST["user"];

if ($user != "") {
    global $host, $user, $password, $database;
    $mysqli=mysqli_connect($host,$user,$password,$database) or die("Problème de création de la base :".mysqli_error());

    $req = mysqli_query($mysqli, "SELECT * FROM users WHERE NOM = '$user'");
    if($req != false){
        $cpt = 0;
        while($data = mysqli_fetch_array($req)){
            $cpt ++;
            echo '<a href="fiche.php">'.$data['NOM'].' '.$data['PRENOM'].'</a><br/>';
        }
        if($cpt ==0)
            echo 'aucun résultat<br/>';
    }
    echo"<br/>";
}
?>

<input type=button onclick=window.location.href='RechercheBarre.php'; value=retour />