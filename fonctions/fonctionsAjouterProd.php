<?php
	function ajouterProduit(){
		include("Donnees.inc.php");

		echo "<h2>Ajouter produit</h2><br/>";
		echo "<form  enctype='multipart/form-data' action='fonctions/fonctionsAjouterProdd.php' method='post' class='putImages'>";
		echo "<table>";
		echo "<tr><td wnameth='180px'>Auteur</td><td><input type='text' name='auteur'></input><br/></td></tr>";
		echo "<tr><td wnameth='180px'>Titre</td><td><input type='text' name='titre'></input><br/></td></tr>";
		echo "<tr><td>Prix</td><td><input type='text' name='prix'></input><br/></td></tr>";
		echo "<tr><td>Critique</td><td><textarea type='text' name='descriptif' rows='8' cols='50'></textarea><br/></td></tr>";
		echo "<tr><td>Image</td><td><input id='file' name='file' type='file' multiple/></td></tr>";
		echo "<tr><td>Genre</td><td><select name='rubrique' style='wnameth:145px'>";
		foreach($Hierarchie as $item => $cat){
			echo "<option>".$item."</option>";
			}	
		echo "</select><br/></td></tr>";
		
		
		
		echo "<tr><td>Nombre de Chansons</td><td><select id='nombre' name='nombre' style='wnameth:145px' onchange='numChansons()'>";
		echo "<option selected>0</option>";
		for($i = 1 ; $i <= 30 ; $i++){
			echo "<option>".$i."</option>";
		}
		echo "</select><br/></td></tr>";
		echo "<tr><td></td><td><div id='tracks'></div></td><tr>";
		echo "<tr><td><br/><input name='valider' type='submit' value='Valider'/></td></tr>";
		
		echo "</table>";
		echo "</form>";
	}
?>