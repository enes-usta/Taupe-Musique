<?php
session_start();
include("Database/DB.php");

function isValidResetPassword(string $email, string $token)
{
    $db = Database::getInstance();
    $req = $db->prepare('SELECT * FROM reset_tokens WHERE token_value = :token AND email_address = :email AND expiry_date > now()');
    $req->execute(array(':token' => $token, ':email' => $email));
    return $req->rowCount();
}

function deleteToken($email, $token)
{
    $db = Database::getInstance();
    $req = $db->prepare('DELETE FROM reset_tokens WHERE email_address = :email AND token_value = :token');
    $req->execute(array(':email' => $email, ':token' => $token));

}

function updatePassword($email, $password)
{
    if (existByEmail($email)) {
        $db = Database::getInstance();
        $req = $db->prepare('UPDATE users SET PASS = :password WHERE EMAIL = :email');
        $req->execute(array(':email' => $email, ':password' => password_hash($password, PASSWORD_DEFAULT)));
    }
}


$data = json_decode(file_get_contents('php://input'));

$message = '';
$ok = false;
if (isValidResetPassword($data->email ?? '', $data->token ?? '')) {
    if ($data->password != $data->password_repeat)
        $message = "Vous avez saisi deux mot de passe différents";
    else if (!preg_match("#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#", $data->password))
        $message = "Veuillez saisir un mot de passe avec au moins 8 caractères dont une majuscule, une minuscule et un chiffre";
    else {
        updatePassword($data->email, $data->password);
        deleteToken($data->email, $data->token);
        $message = 'Votre mot de passe a bien été modifié ! Vous allez être redirigé...';
        $ok = true;
    }
}
else
    $message = "L'email et le mot de passe n'ont pas été saisis";


header('Content-Type: application/json;');
echo json_encode(array('ok' => $ok, 'message' => $message));
