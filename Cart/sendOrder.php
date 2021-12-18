<?php
session_start();
include('Auth/log_authorized.php');

function checkCard($number, $name, $expiry, $cvv): ?array
{
    $errors = null;
    if (!preg_match('#^[0-9]{13,16}$#', $number))
        $errors['invalidNumber'] = 'Format de numéro de carte invalide';
    if (!preg_match('#^[0-9]{3,4}$#', $cvv))
        $errors['InvalidCVV'] = 'CVV invalide';
    if (!preg_match('#^[a-zA-Z]+ ?[a-zA-Z]+$#', $name))
        $errors['InvalidName'] = 'Nom invalide';
    if (!preg_match('#^[0-9]{2}/[0-9]{2}$#', $expiry))
        $errors['InvalidCVV'] = 'Date invalide';
    else {
        $date = str_replace('/', '-', $expiry);
        $expiration_date = date('d-m-Y', strtotime('01-' . $date));
        if ($expiration_date < time())
            $errors['invalidExpiry'] = "Date d'expiration invalide";
    }
    return $errors;
}

$data = json_decode(file_get_contents('php://input'));
$res = checkCard($data->card_number ?? '', $data->card_name ?? '', $data->card_expiry ?? '', $data->card_cvv ?? '');

header('Content-Type: application/json;');

if ($res != null)
    echo json_encode(array('state' => false, 'errors' => $res));
else {
    $success = validerCommande(getLogin(), $data->card_number, $data->card_name, $data->card_expiry, $data->card_cvv);
    echo json_encode(array('state' => true, 'success' => $success));
}
