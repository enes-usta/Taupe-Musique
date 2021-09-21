<?php

	include("Parametres.php");
	include("Fonctions.inc.php");
	include("Donnees.inc.php");
									  
		$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		
		
		if(isset($_COOKIE["user"])){
				$user = $_COOKIE["user"];
				$produit = $_POST["id_produit"];
				$str0 = 'select * from favs where id_prod = '.$produit;
				$str = "INSERT INTO FAVS VALUES('".$user."','".$produit."')";
				$result = query($mysqli,$str0) or die("Impossible de ajouter produit<br>");
				if(mysqli_num_rows($result)>0){
					query($mysqli,'delete from favs where id_prod = '.$produit.' and LOGIN = \''.$_COOKIE["user"].'\'');
					echo 'delete set';
				}else{
					query($mysqli,$str);
				}
		}
		else{
			if(!isset($_COOKIE["favoris"])){
				$arr[] = $_POST["id_produit"];
				if(isset($_POST["id_produit"])){
					setcookie("favoris",json_encode($arr),time() + (86400 * 15),'/');
				}
			}
			else{
				$arr = array();
				$arr = json_decode($_COOKIE["favoris"],true);
				if(isset($_POST["id_produit"])){
					
					if(!in_array($_POST["id_produit"],$arr)){
						$arr[] = $_POST["id_produit"];
						
					}else{
						$temp = array();
						foreach($arr as $item){
							if($item != $_POST["id_produit"]){
								$temp[] = $item;
							}
						}
						$arr = $temp;
					}
				}
				setcookie("favoris",json_encode($arr), time() + (86400 * 15),'/');
			}
		}
	mysqli_close($mysqli);
	
?>