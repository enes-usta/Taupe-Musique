<?php
$cardtype = array(
    "visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/", //13 à 16
    "mastercard" => "/^5[1-5][0-9]{14}$/",
    "amex" => "/^3[47][0-9]{13}$/",
    "discover" => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
);
function checkCard($number, $name, $expiry, $cvv): ?array
{
    $errors = null;
    if (!preg_match('#^[0-9]{13,16}$#', $number))
        $errors['invalidNumber'] = 'Format de numéro de carte invalide';
    if (!preg_match('#^[0-9]{3, 4}$#', $cvv))
        $errors['InvalidCVV'] = 'CVV invalide';
    if (!preg_match('#^[a-zA-Z]* ?[a-zA-Z]*$#', $name))
        $errors['InvalidCVV'] = 'CVV invalide';
    if (!preg_match('#^[0-9]{2}/[0-9]{2}$#', $expiry))
        $errors['InvalidCVV'] = 'Date invalide';
    else {
        //$date = explode('/', $expiry);
        $date = str_replace('/', '-', $expiry);
        $expiration_date = date('Y-m-d', strtotime($date.'-01'));
        if ($expiration_date < time())
            $errors['invalidExpiry'] = "Date d'expiration invalide";
    }

    return $errors;
}

$data = json_decode(file_get_contents('php://input'));


header('Content-Type: application/json;');

$res = checkCard($data->card_number ?? '', $data->card_name ?? '', $data->card_expiry ?? '', $data->card_cvv ?? '');
    if ($res != null)
        echo json_encode(array('state' => false, 'errors' => $res));
