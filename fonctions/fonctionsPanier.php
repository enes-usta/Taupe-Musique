<?php
	if(isset($_POST["item"])){
		if(isset($_COOKIE["panier"])){
			$arr = array();
			$arr = json_decode($_COOKIE["panier"],true);
			$arr[] = $_POST["item"];
			setcookie('panier',json_encode($arr),time() + (60*30),"/");
			echo "Produit ajouté au panier";
		}
		else{
			$arra = array();
			$arr[] = $_POST["item"];
			setcookie('panier',json_encode($arr),time() + (60*30),"/");
			echo "Produit ajouté au panier";
		}
	}
	else{
		echo "Erreur";
	}
?>