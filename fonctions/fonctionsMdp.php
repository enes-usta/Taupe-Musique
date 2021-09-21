<?php
	//verification de l'email inseree
	if(isset($_POST["email"]) && preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#', $_POST["email"])){
		include("../Parametres.php");
		include("../Fonctions.inc.php");

		$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");	
		$result = query($mysqli,'select login,prenom,nom,email,adresse,ville,telephone from users where login = \'admin\'');
		//creation d'un nouveau mot de pass
		$newpass = substr(str_shuffle(MD5(microtime())), 0, 8);
		$message = "Monsieur, Madame, \n\n\n Votre mot de pass pour le site TaupeAchat est maintenant: ".$newpass.".\n\n\nBien cordialement, l'equipe Taupe Achat.";
		$val = mail($_POST["email"],"TaupeAchat - Nouveau mot de pass",$message,"From: noreply@taupeachat.com");
		
		//verification si l'email a été envoyé
		if($val){
			
			$result = mysql_query("insert into users (PASS) values ('".password_hash(($newpass), PASSWORD_DEFAULT)."') where email='".$_POST["email"]."'");
			echo "Nouveau mot de pass envoyé";
			
		}else{
			
			echo "Erreur : Email invalide";
			
		}
		mysqli_close($mysqli);
	}else{
		
		echo "Erreur";
		
	}

?>