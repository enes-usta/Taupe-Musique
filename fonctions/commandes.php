<?php
	function afficherCommandes(){
		include("Parametres.php");
		include("Fonctions.inc.php");
		include("Donnees.inc.php");

		$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		
		echo "<h2>Commandes</h2><br/>";
		$result = query($mysqli,'select id_com,(select prenom from users where users.login = commande.id_client limit 1) as prenom,(select nom from users where users.login = commande.id_client limit 1) as nom,id_prod,date,ADRESSE,cp,ville from commande');
		if(mysqli_num_rows($result)<=0){
			echo "Aucun enregistrement dans la base de données";
		}
		else{
			echo "<table>";
					echo "<tr><td width='50px'>ID</td><td width='80px'>Libelle</td><td width='80px'>Prix</td></tr>"; 
					echo "<tr><td colspan='3'><hr></td></tr>";
					while ($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td id='item'><a href='details.php?prod=".$row["id_prod"]."'>".$row["id_com"]."</a></td><td> ".$row["date"]."</td><td> ".$row["ADRESSE"]."</td>";
						echo "<td><button id='effacer'>effacer</button></td>";
						echo "</tr>";
						echo "<tr><td colspan='3'><hr></td></tr>";
					}
			echo "</table>";
		}
		mysqli_close($mysqli);
	}
	
?>