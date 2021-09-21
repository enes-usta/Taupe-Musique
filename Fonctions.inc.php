<?php

  function query($link,$query)
  { 
    $resultat=mysqli_query($link,$query) or die("$query : ".mysqli_error($link));
	return($resultat);
  }
  
?>