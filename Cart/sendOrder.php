<?php
session_start();
include_once("Database/DB.php");
?>

<html>
<head>
    <title>Taupe musique - Votre commande</title>
</head>
<body>

<?php

if (isLogged())
    if (validerCommande(getLogin()))
        echo '';
    else
        echo 'Erreur lors de votre commande... <br> Veuillez réessayer ultérieurement';

?>

</body>
</html>
