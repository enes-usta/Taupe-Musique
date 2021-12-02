<?php
    include_once("Database/Database.php");
    session_start();
	if(isset($_POST["item"]) && isset($_POST["pos"])){

		/*$arr1 = array();
		$trouve = false;*/

        $db = Database::getInstance();
        $req = $db->prepare("DELETE FROM PANIER WHERE LOGIN = :login AND IDPROD = :idprod");
        $req->execute(array(
            ":login" => $_SESSION["user"],
            ":idprod" => $_POST["item"]
        ));

		/*if(isset($_COOKIE["panier"])){
		$arr = json_decode($_COOKIE["panier"],true);
		$x = 0;	
			foreach($arr as $item){
				
				if(($_POST["item"] == $item) && ($x == $_POST["pos"]) && $trouve == false){
					$trouve = true;
				}else{
					$arr1[] = $item;
					$x++;
				}
			}
		}*/
		
		/*if($arr1){
			setcookie('panier',json_encode($arr1),time() + (60*30),"/");
		}else{
			setcookie("panier", "", time()-3600,"/");
		}		*/
	}
?>