<?php
	session_start();
	if(isset($_COOKIE["panier"]) && isset($_COOKIE["user"])){
					$panier = json_decode($_COOKIE["panier"]);		
					include("Parametres.php");
					include("Fonctions.inc.php");
					include("Donnees.inc.php");

					$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
					mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
					
					foreach($panier as $item){
						query($mysqli,"replace into commande (ID_PROD,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values ('".$item."','".$_COOKIE["user"]."','".date('d/m/Y')."','".$_COOKIE["civilite"]."','".$_COOKIE["nom"]."','".$_COOKIE["prenom"]."','".$_COOKIE["adresse"]."','".$_COOKIE["cp"]."','".$_COOKIE["ville"]."','".$_COOKIE["telephone"]."')");
					}
					setcookie("panier", "", time()-3600,"/");
					mysqli_close($mysqli);
					$_SESSION["paiement"] = "opération réussie";
					$_SESSION["color"] = "green";

	}else{
		$_SESSION["paiement"] = "donnees incorrectes <br/> Veuillez essayer de nouveau";
		$_SESSION["color"] = "red";
	}
	
	header('location: panier.php');

		
	

?>