<?php
session_start();
include ('Auth/log_authorized.php');
include_once("Database/DB.php");
?>

<html lang="fr">
<head>
    <title>Taupe musique - Votre commande</title>
</head>
<body>

<?php

if (isLogged())
    if (validerCommande(getLogin()))
        echo 'Commande effectuée avec succès';
    else
        echo 'Erreur lors de votre commande... <br> Veuillez réessayer ultérieurement';

?>

</body>
</html>
