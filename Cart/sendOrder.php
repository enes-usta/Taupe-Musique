<?php

$data = json_decode(file_get_contents('php://input'));

function checkCard($number, $name, $expiry, $cvv): bool
{
    return false;

}

if (checkCard($data->card_number ?? '', $data->card_name ?? '', $data->card_expiry ?? '', $data->card_cvv  ?? ''))
    return true;

