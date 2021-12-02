

<?php
    include_once("Database/Database.php");
    session_start();

	if(isset($_POST["item"])){
        $db = Database();
        $req = $db->prepare("SELECT IDPROD FROM PANIER p WHERE p.LOGIN = :login AND p.IDPROD = :idprod");
        $req->execute(array(
            ":login" => $_SESSION["user"],
            ":idprod" => $_POST["item"]
        ));
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result)){
            $req1 = $db->prepare("UPDATE PANIER p SET NBPROD = NBPROD+1 WHERE p.IDPROD = :idprod AND p.LOGIN = :login");
            $req1->execute(array(
                ":login" => $_SESSION["user"],
                ":idprod" => $_POST["item"]
            ));
        }
        else{
            $req2 = $db->prepare("INSERT INTO PANIER VALUES (DEFAULT, :login, :itemid,1)");
            $req2->execute(array(
                ":login" => $_SESSION["user"],
                ":itemid" => $_POST["item"]
            ));
        }
	}
	else {
        echo "Erreur";
    }
?>


