<?php

	include("Database/Parametres.php");
	include("Fonctions.inc.php");
	include("Donnees.inc.php");
    include("Database/DB.php");

		
		if(isset($_COOKIE["user"])){
				$user = $_COOKIE["user"];
				$produit = $_POST["id_produit"];

				//
            updateFavoris($user, $produit);

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

	
?>