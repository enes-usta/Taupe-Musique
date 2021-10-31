<?php

include("./Parametres.php");

function Database()
{
    return new PDO($host, $user, $password);
}
