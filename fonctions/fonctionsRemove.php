<?php
	if(isset($_POST["item"]) && isset($_POST["pos"])){
		$arr1 = array();
		$trouve = false;
		if(isset($_COOKIE["panier"])){
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
		
		}
		
		if($arr1){
			setcookie('panier',json_encode($arr1),time() + (60*30),"/");
		}else{
			setcookie("panier", "", time()-3600,"/");
		}			
	}
?>