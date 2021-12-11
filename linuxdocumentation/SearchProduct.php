<?php
session_start();
/*include '../Admin/authorized.php';*/
include_once 'Database/DB.php';

//echo "ca a marchÃ©";


$user = $_POST["user"];

if ($user != "") {
    $mysqli=mysqli_connect("127.0.0.1","root","","cds") or die("Problème de création de la base :".mysqli_error());
    //echo "$mysqli";
    //echo "$user";
    $req = mysqli_query($mysqli, "SELECT * FROM users WHERE NOM = '$user'");
    if($req != false){
        $cpt = 0;
        while($data = mysqli_fetch_array($req)){
            $cpt ++;
            echo '<a href="fiche.php">'.$data['NOM'].' '.$data['PRENOM'].'</a>';
            echo "<br/>";
        }
        if($cpt ==0){
            echo 'aucun résultat';
            echo"<br/>";
        }
    }
    echo"<br/>";


   //printf("error: %s\n", mysqli_error($mysqli));
   //echo " res = $req";

}
?>

<input type=button onclick=window.location.href='RechercheBarre.php'; value=retour />