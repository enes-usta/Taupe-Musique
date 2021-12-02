<?php
/**
 * Initialise une connexion à la BDD
 *
 * @return PDO
 */
function Database(): PDO
{
    return new PDO('mysql:host=127.0.0.1;port=3306;dbname=cds;', 'root', '' );

// global $host, $user, $pass, $base;
// Marche pas jsp :    return new PDO('mysql:host='.$host.';port=3306;dbname='.$base.';', $user, $pass);
}