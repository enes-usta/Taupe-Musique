<?php
session_start();
include '../authorized.php';

if(isset($_POST["item"]))
    return (removeAlbumById($_POST['item']) ? 'Suppression effectuée avec succès': 'Erreur lors de la suppresion');
else
    return 'Erreur lors de la suppression';
