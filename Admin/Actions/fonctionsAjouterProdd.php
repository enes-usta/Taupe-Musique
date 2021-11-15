<?php
	include '../Donnees.inc.php';
	$file_result = '';
	$file_extension = '';
	if($_FILES['file']['error']>0){
		header('location: ../Produits.php?Erreur=img');
		exit();
		
	}else{
		$file = $_FILES['file']['name'];
		if((preg_match("/[.](jpg)$/i",$file))){
			$file_extension = '.jpg';
		}else if(preg_match("/[.](jpeg)$/i",$file)){
			$file_extension = '.jpeg';
		}else if(preg_match("/[.](gif)$/i",$file)){
			$file_extension = '.gif';
		}else if(preg_match("/[.](png)$/i",$file)){
			$file_extension = '.png';
		}else if(preg_match("/[.](bmp)$/i",$file)){
			$file_extension = '.bmp';
		}else{
			header('location: ../Produits.php?Erreur=img2');
			exit();
		}
		
		$file_result = 'img_cover/'.($_POST["auteur"]." (".$_POST["titre"].")").$file_extension;
		move_uploaded_file($_FILES['file']['tmp_name'],'../'.$file_result);

		if(isset($_POST["titre"]) && isset($_POST["auteur"]) && isset($_POST["prix"]) && isset($_POST["descriptif"])){
			
			$ok = true;
			if(!preg_match('/^([A-Za-z]{0,80}$)/', $_POST["auteur"])){
				$ok = false;
			}
			
			$ok = true;
			if(!preg_match('/^([A-Za-z]{0,80}$)/', $_POST["titre"])){
				$ok = false;
			}
		
			if(!preg_match('/^([0-9]+$)/', $_POST["prix"])){
					$ok = false;
			}
			
			$tracks = array();
			if(isset($_POST["nombre"])){
				for($i = 0; $i <= $_POST["nombre"];$i++){
						if(isset($_POST["track".$i])){
							$tracks[] = ($i+1).' '.$_POST["track".$i];
						}
				}
				
			}
			
			
				if($ok){
						
						extract($_POST);
						$arr = array('titre' => $auteur." (".$titre.")",
									'chansons' => implode("|",$tracks),
									'descriptif' => $descriptif,
									'prix' => $prix,
									'index' => array(0 => $rubrique,
													),
						);

						$Albums[] = $arr;

						$str = "\$Albums = array( \n\t\t";
						foreach($Albums as $indice => $opt){
							$str .= $indice.' => array(';
							foreach($opt as $nom => $desc){
								$str .= "  '".$nom."' => ";
								if(is_array($desc)){
									$str .= 'array(';
									foreach($desc as $d => $s){
										$str .= ''.$d." => '".$s. "', \n\t\t\t\t\t\t\t\t\t\t";
									}
									$str .= "), \n\t\t\t\t\t";
								}
								else{
									$str .= "'".$desc."', \n\t\t\t\t\t";
								}
							}
							$str .= "), \n\t\t";
							
						}
						$str .= "); \n\n";

						$file = file_get_contents('hierarchie.txt', true);

						$fp = fopen("../Donnees.inc.php", 'w');
						fwrite($fp, "<?php ".$str." \n\n".$file." \n?>");
						fclose($fp);
						header('location: ../Produits.php');
				}
				else
				{
					echo "Erreur1";
				}
						
				
		
		}else{
			echo "Erreur2";
		}
		
	}
?>