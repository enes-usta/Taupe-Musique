<?php
include('../Donnees.inc.php');

$arr = array();
if(isset($_POST["item"])){
			foreach($Albums as $indice => $opt){

					if($indice != $_POST["item"]){
						$arr[] = $opt;
					}
				
			}


			$str = "\$Albums = array( \n\t\t";
			foreach($arr as $indice => $opt){
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

			$fp = fopen('../Donnees.inc.php', 'w');
			fwrite($fp, "<?php ".$str." \n\n".$file." \n?>");
			fclose($fp);
}

?>