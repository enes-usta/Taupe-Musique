<?php
include("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$isValid = false;

if (isset($data->login) && isset($data->password)) {
    $isValid = isValid($data->login, $data->password);

    if ($isValid) {
        $user = getUser($data->login);

        setcookie("user", $user->login);
        setcookie("civilite", $user->sexe);
        setcookie("nom", $user->nom);
        setcookie("prenom", $user->prenom);
        setcookie("adresse", $user->adresse);
        setcookie("cp", $user->codep);
        setcookie("ville", $user->ville);
        setcookie("telephone", $user->telephone);
    }
}

header('Content-Type: application/json;');
echo json_encode(array('ok' => $isValid, 'data' => $data));
