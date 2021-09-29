<?php
	session_start();
	if(isset($_COOKIE["panier"]) && isset($_SESSION["login"])){


                    //validerCommande();

                    setcookie("panier", "", time()-3600,"/");
					$_SESSION["paiement"] = "opération réussie";
					$_SESSION["color"] = "green";

	}else{
		$_SESSION["paiement"] = "donnees incorrectes <br/> Veuillez essayer de nouveau";
		$_SESSION["color"] = "red";
	}
	
	header('location: panier.php');

?>